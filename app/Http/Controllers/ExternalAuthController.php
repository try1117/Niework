<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use ExternalAuth;
use ExternalAuthCode;
use ExternalToken;
use ExternalNetwork;
use GuzzleHttp\Client;
use Niework\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use MyDebugger;

class ExternalAuthController extends Controller
{
    public function auth(Request $request)
    {
        return view('auth/external_login', [
            'service_id' => $request->service_id,
            'redirect_url' => $request->redirect_url,
        ]);
    }

    public function redirectBack(Request $request)
    {
        if (Auth::guest()) {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                throw ValidationException::withMessages(
                    ['email' => ['These credentials do not match our records.']]
                );
            }
        }

        MyDebugger::log($request, "redirectBack");
        MyDebugger::log(json_encode(['email' => $request->email, 'user_id' => Auth::user()->id]), "Auth SUCCESS");

        $auth_code = str_random(60);
        ExternalAuthCode::create([
            'user_id' => Auth::user()->id,
            'service_id' => $request->service_id,
            'auth_code' => $auth_code,
        ]);

        return redirect($request->redirect_url.'?auth_code='.$auth_code);
    }

    public function returnToken(Request $request)
    {
        $auth_code = ExternalAuthCode::where('service_id', $request->service_id)->where('auth_code', $request->auth_code)->first();
        if ($auth_code) {
            $user = $auth_code->user;
            $token = str_random(60);
            MyDebugger::log($request, "returnToken");

            ExternalToken::create([
                'user_id' => $user->id,
                'service_id' => $request->service_id,
                'token' => $token,
            ]);
            return response()->json([
                'status' => 'ok',
                'user_id' => $user->id,
                'token' => $token,
            ]);
        }
        return response()->json(['status' => 'error']);
    }

    public function getProfile(Request $request)
    {
        $token = ExternalToken::where('service_id', $request->service_id)->where('token', $request->token)->first();
        MyDebugger::log($request, "getProfile");
        MyDebugger::log($token, "getProfile.token");

        if ($token) {
            $user = $token->user;
            return response()->json([
                'status' => 'ok',
                'login' => $user->name,
                'email' => $user->email
            ]);
        }
        return response()->json(['status' => 'error']);
    }

    public function acceptAuthCode(Request $request, $external_service_id)
    {
        MyDebugger::log($request, "acceptAuthCode");
        $network = ExternalNetwork::where('string_id', $external_service_id)->firstOrFail();
        $client = new Client();

        $postToken = $client->post(
            ($network->url).'/api/token',
            ['form_params' => [
                'service_id' => 'niework',
                'auth_code' => $request->auth_code,
                ]
            ]
        );
        $responseToken = json_decode($postToken->getBody());

        if ($responseToken->status == 'ok') {
            $getProfile = $client->get(
                ($network->url).'/api/profile/'.$responseToken->user_id,
                ['query' => [
                    'service_id' => 'niework',
                    'token' => $responseToken->token,
                    ]
                ]
            );
            $responseProfile = json_decode($getProfile->getBody());

            if ($responseProfile->status == 'ok') {
                if (ExternalAuth::where('external_user_id', $responseToken->user_id)->exists()){
                    $user = ExternalAuth::where('external_user_id', $responseToken->user_id)->firstOrFail()->user;
                }
                else{
                    if (User::where('email', $responseProfile->email)->exists()) {
                        throw ValidationException::withMessages(
                            ['email' => ['These email is already in use.']]
                        );
                    }

                    $user = User::create([
                        'name' => $responseProfile->login,
                        'email' => $responseProfile->email,
                        'password' => Hash::make('password'),
                    ]);

                    ExternalAuth::create([
                        'token' => $responseToken->token,
                        'service_id' => $network->id,
                        'user_id' => $user->id,
                        'external_user_id' => $responseToken->user_id
                    ]);
                }
            }
            else{
                throw ValidationException::withMessages(
                    ['email' => ["Couldn't get profile information"]]
                );
//                return "Couldn't get profile information"
//                return back()->withErrors[""];
            }
        }
        else{
            throw ValidationException::withMessages(
                ['email' => ["Couldn't get token"]]
            );
//            return "Couldn't get profile information"
        }
        Auth::login($user);
        return redirect('profile/'.$user->id);
    }
}

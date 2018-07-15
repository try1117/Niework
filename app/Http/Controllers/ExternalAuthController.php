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
use \Illuminate\Validation\ValidationException;

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

        error_log("\n\n\nredirectBack\n\n\n");
        error_log($request);
        error_log("\n\n\n");

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

            error_log("\n\n\nreturnToken\n\n\n");
            error_log($request);
            error_log("\n\n\n");


            ExternalToken::create([
                'user_id' => $user->getId(),
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

        error_log("\n\n\ngetProfile\n\n\n");
        error_log($request);
        error_log("\n\n\n");

        error_log("\n\n\ngetProfile.token\n\n\n");
        error_log($token);
        error_log("\n\n\n");

        if ($token) {
            $user = $token->user;
            return response()->json([
                'status' => 'ok',
                'login' => $user->nickname,
                'email' => $user->email
            ]);
        }
        return response()->json(['status' => 'error']);
    }

    public function acceptAuthCode(Request $request, $external_id)
    {
        error_log("\n\n\nacceptAuthCode\n\n\n");
        error_log($request);
        error_log("\n\n\n");

        $sc = ExternalNetwork::where('string_id', $external_id)->firstOrFail();
        $url = $sc->url;
        $client = new Client();
        $json1 = $client->post($url.'/api/token',
            ['form_params' => ['service_id' => 'niework', 'auth_code' => $request->input('auth_code')]])->getBody();
        $response = json_decode($json1);
        if ($response->status == 'ok'){
            $client = new Client();
            $json2 = $client->get($url.'/api/profile/'.$response->user_id, ['query' => ['service_id' => 'niework',
                'token' => $response->token]])->getBody();
            $response2 = json_decode($json2);
            if ($response2->status == 'ok'){
                if (ExternalAuth::where('external_user_id', $response->user_id)->exists()){
                    $user = ExternalAuth::where('external_user_id', $response->user_id)->firstOrFail()->user;
                }
                else{
                    if (User::where('email', $response2->email)->exists())
                        return 'email already exists';
                    $user = User::create([
                        'name' => $response2->login,
                        'email' => $response2->email,
                        'password' => Hash::make('external'),
                    ]);
                    ExternalAuth::create([
                        'token' => $response->token,
                        'service_id' => $sc->id,
                        'user_id' => $user->id,
                        'external_user_id' => $response->user_id
                    ]);
                }
            }
            else{
                dd('error');
            }
        }
        else{
            dd('error');
        }
        Auth::login($user, true);
        return redirect()->route('profile/'.$user->id);
    }
}

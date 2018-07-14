<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use ExternalAuth;
use ExternalAuthCode;
use ExternalToken;
use ExternalNetwork;

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
                return "Authentication error";
            }
        }

        error_log("\n\n\n");
        error_log($request);
        error_log("\n\n\n");

        $auth_code = str_random(60);
        ExternalAuthCode::create([
            'user_id' => Auth::user()->getId(),
            'service_id' => $request->service_id,
            'auth_code' => $auth_code,
        ]);

        return redirect()->away($request->redirect_url.'?auth_code='.$auth_code);
    }

    public function returnToken(Request $request)
    {
        $auth_code = ExternalAuthCode::where('service_id', $request->service_id)->where('auth_code', $request->auth_code)->first();
        if ($auth_code) {
            $user = $auth_code->user;
            $token = str_random(60);

            error_log("\n\n\n");
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
                'token' => $auth_code,
            ]);
        }
        return response()->json(['status' => 'error']);
    }

    public function getProfile(Request $request)
    {
        $token = ExternalToken::where('service_id', $request->service_id)->where('token', $request->token)->first();
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
}

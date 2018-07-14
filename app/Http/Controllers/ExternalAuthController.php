<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;

class ExternalAuthController extends Controller
{
    public function auth(Request $request)
    {
        return view('auth/external_login', [
            'service_id' => $request->service_id,
            'redirect_url' => $request->redirect_url,
        ]);
    }
}

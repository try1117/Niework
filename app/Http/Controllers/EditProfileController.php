<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class EditProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return view('edit');
        }
        return redirect('login');
    }
}

<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Niework\Models\Post;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::guest()) {
            return view('login');
        }
        return redirect('profile/'.Auth::user()->id);

//        $posts = Post::all();
//        return view('profile', [
//            'posts' => $posts,
//            'user' => Auth::user()
//        ]);
//        return view('profile')->withUser(Auth::user());
    }
}

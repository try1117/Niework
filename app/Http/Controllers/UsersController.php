<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Niework\User as User;
//use Niework\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('users')->withUsers(User::all());
    }

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function show($id)
    {
//        throwException();
//        error_log("Find id\n");
//        $user = User::all()->get;

//        error_log(User::find($id)->getEmailAddress());
//
//        error_log("\nAnd then object goes\n\n");
//
//        error_log(User::create(User::find($id)));
//        error_log("\n\n");
//
//
//        error_log(User::all());
//        error_log("\n\nAnd now object auth::user\n");
//        error_log(user()->getAvatar());
//
//        error_log("\n\n\nSingle user\n");
//
//        $user = User::all()->where('id', $id);
//        error_log($user);
//        error_log("\n\n\n");
//        throwException();
        return view('profile')->withUser(User::find($id));
    }
}

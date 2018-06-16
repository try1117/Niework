<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Niework\User as User;
use Auth;

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
        if (User::find($id)) {
            return view('profile')->withUser(User::find($id));
        }
        return back();
    }

    public function update(Request $request)
    {
        $user=Auth::user();

//        if ($request->hasFile('avatar'))
//        {
//            $avatar = $request->file('avatar');
//            $image = Image::make($avatar)->resize(200,200);
//
//            $filename=time().'.'.$avatar->getClientOriginalExtension();
//            $image->save(public_path('/avatars/'.$filename));
//
//            $user->avatar = $filename;
//            $user->save();
//        }

//        if ($avatar) {
//            $request->validate([
//                'avatar' => 'image:jpeg,png,jpg,gif,svg|max:2048',
//            ]);
//
//            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/').$filename);
//
//        }



//        Validator::make($data, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
////            'birth_date' => 'required'
//        ]);

        $user = Auth::user();
        $user->setName(request()->name);

        // validate unique
        $user->setEmailAddress(request()->email);

        $user->setBirthDate(request()->birth_date);
        $user->setCountryId(request()->country_id);

        $user->save();

//        return back()->with('success');
//        throwException();
        return redirect('home');
    }
}

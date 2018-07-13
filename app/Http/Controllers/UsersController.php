<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Niework\User as User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Rule;
//use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Niework\Models\Post;

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
            $posts = Post::all()->where('owner_id', '=', $id)->sortByDesc('created_at');
            return view('profile', [
                'posts' => $posts,
                'user' => User::find($id),
            ]);
//            return view('profile')->withUser(User::find($id));
        }
        return back();
    }

    public static function updateAvatarPreview($param)
    {
        error_log(print_r(param, TRUE));
    }

    public function update(Request $request)
    {
        $user=Auth::user();
        error_log("\n\n\n");
        error_log($request);
        error_log($request->hasFile('avatar'));
        error_log("\n\n\n");

        if ($request->hasFile('avatar'))
        {
            $request->validate([
                'avatar' => 'image:jpeg,png,jpg,gif,svg',
            ]);
            $avatar = $request->file('avatar');
            $image = Image::make($avatar)->resize(200,200);
            $filename=Str::random(8).'.'.$avatar->getClientOriginalExtension();

            error_log($filename);

            $image->save(public_path('/avatars/'.$filename));
            if ($user->getAvatar() != User::$defaultAvatar) {
                $oldfile_path = public_path().'/avatars/'.$user->getAvatar();
                unlink($oldfile_path);
            }
            $user->setAvatar($filename);
        }

        // basic information
        $this->validate($request, [
            'name' => 'required|string|max:30',
        ]);

        $user->setName($request->name);
        $user->setBirthDate($request->birth_date);
        $user->setCountryId($request->country_id);

        // change credentials
        if ($request->new_password || $request->new_password_confirmation || $request->email != $user->getEmailAddress()) {
            $this->validate($request, ['password' => 'required']);
            if (!Hash::check($request->password, $user->password)) {
                throw \Illuminate\Validation\ValidationException::withMessages(
                    ['password' => ['Wrong password']]);
            }

            if ($request->email != $user->getEmailAddress()) {
                $this->validate($request, [
                    'email' => 'required|string|email|max:40|unique:users,email,'.$user->getId(),
                ]);
                $user->setEmailAddress($request->email);
            }

            if ($request->new_password || $request->new_password_confirmation) {
                $this->validate($request, [
                    'new_password' => 'required|string|min:6|max:40|confirmed',
                ]);
                $user->setPassword($request->new_password);
            }
        }

        $user->save();

//        return back()->with('success');
        return redirect('home');
    }
}

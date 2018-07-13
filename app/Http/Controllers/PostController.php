<?php

namespace Niework\Http\Controllers;

use Niework\Models\Post;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function createPost(Request $request, $owner_id)
    {
        $this->validate($request, [
            'body' => 'required|max:2000',
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $post->owner_id = $owner_id;
        if (!$request->user()->posts()->save($post)) {
            // display error
        }
        return back();
    }
}

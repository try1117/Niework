<?php

namespace Niework\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    public function getPosts()
//    {
//        $posts = Post::all();
//        return view('profile', ['posts' => $posts]);
//    }

    public function user()
    {
        return $this->belongsTo('Niework\User', 'author_id', 'id');
    }
}

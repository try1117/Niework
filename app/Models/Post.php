<?php

namespace Niework\Models;
use Illuminate\Database\Eloquent\Model;
use Niework\Models\Comment;

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

    public function comments()
    {
//        return Comment::all()->where('id', $this->root_comment);
        error_log("\n\n\n");
        error_log(Comment::all()->where('parent_comment_id', $this->root_comment));
        error_log("\n\n\n");

        error_log("\n\n\n");
        error_log($this->root_comment);
        error_log("\n\n\n");


        return Comment::all()->where('parent_comment_id', $this->root_comment);
//        return $this->hasMany('Niework\Models\Comment','id', )
    }
}

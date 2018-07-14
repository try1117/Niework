<?php

namespace Niework\Http\Controllers;

use Illuminate\Http\Request;
use Niework\Models\Comment;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $comment = Comment::create([
            'body' => $request->answer_body,
            'parent_comment_id' => $request->parent_comment_id,
            'author_id' => $request->user_id,
        ]);
        return back();
    }
}

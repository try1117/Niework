<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Niework\Models\Post;
use Niework\Models\Comment;

class AddColumnRootCommentToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('posts', function($table) {
//            $table->integer('root_comment')->default(0);
//        });
//
        foreach(Post::all() as $post) {
            $post->root_comment = Comment::create([
                'body' => '',
                'parent_comment_id' => '0',
                'author_id' => '0',
            ])->id;
            $post->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('posts', function($table) {
//            $table->dropcolumn('root_comment');
//        });

    }
}

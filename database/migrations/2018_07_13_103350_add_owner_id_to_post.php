<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerIdToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table) {
            $table->renameColumn('user_id', 'author_id');
            $table->integer('owner_id');
        });
        DB::statement('UPDATE posts SET owner_id = author_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->renameColumn('author_id', 'user_id');
            $table->dropColumn('owner_id');
        });
    }
}

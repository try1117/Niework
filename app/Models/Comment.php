<?php

namespace Niework\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body', 'parent_comment_id', 'author_id',
    ];

    public function user()
    {
        return $this->belongsTo('Niework\User', 'author_id', 'id');
    }
}

<?php

namespace Niework\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalToken extends Model
{
    protected $table = 'external_tokens';

    public function user()
    {
        return $this->belongsTo('Niework\User', 'user_id', 'id');
    }
}

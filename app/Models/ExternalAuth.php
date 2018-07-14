<?php

namespace Niework\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalAuth extends Model
{
    protected $table = 'external_auth';

    public function user()
    {
        return $this->belongsTo('Niework\User', 'user_id', 'id');
    }
}

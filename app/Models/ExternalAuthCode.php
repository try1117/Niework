<?php

namespace Niework\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalAuthCode extends Model
{
    protected $table = 'external_auth_codes';
    protected $fillable = [
        'user_id', 'service_id', 'auth_code',
    ];

    public function user()
    {
        return $this->belongsTo('Niework\User', 'user_id', 'id');
    }
}

<?php

namespace Niework\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalAuth extends Model
{
    protected $table = 'external_auth';
    protected $fillable = [
        'user_id', 'external_user_id', 'service_id', 'token',
    ];

    public function user()
    {
        return $this->belongsTo('Niework\User', 'user_id', 'id');
    }
}

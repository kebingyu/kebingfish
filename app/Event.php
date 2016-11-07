<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'signup_events';

    protected $fillable = ['type', 'title', 'description', 'expires_at'];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
    ];
}

<?php

namespace App\Models\Signup;

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

    public function users()
    {
        return $this->belongsToMany(User::class, 'signup_event_user', 'event_id', 'user_id');
    }
}

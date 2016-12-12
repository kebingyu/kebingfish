<?php

namespace App\Models\Signup;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'signup_users';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'signup_event_user', 'event_id', 'user_id')
            ->withPivot('group_size', 'option');
    }
}

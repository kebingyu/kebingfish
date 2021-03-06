<?php

namespace App\Models\Signup;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'signup_events';

    protected $fillable = ['type', 'title', 'description', 'expires_at', 'location_id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'signup_event_user', 'event_id', 'user_id')
            ->withPivot('group_size', 'option');
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function toArray()
    {
        return parent::toArray() + [
                'expires_in' => $this->getExpiresIn(),
                'expired' => $this->expired(),
                'goer_count' => $this->getGoerCount(),
                'location' => $this->location ? $this->location->toArray() : [],
            ];
    }

    public function expired()
    {
        if ($this->expires_at) {
            return Carbon::now()->gt(Carbon::parse($this->expires_at));
        }
        return false;
    }

    protected function getExpiresIn()
    {
        if ($this->expires_at) {
            return Carbon::parse($this->expires_at)->diffForHumans();
        }
        return false;
    }

    protected function getGoerCount()
    {
        $count = 0;
        foreach ($this->users as $user) {
            $count += $user->pivot->group_size;
        }
        return $count;
    }
}

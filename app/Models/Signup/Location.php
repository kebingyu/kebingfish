<?php

namespace App\Models\Signup;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'signup_locations';

    protected $fillable = ['name', 'data'];

    protected $hidden = ['created_at', 'updated_at'];

    public function toArray()
    {
        $location = parent::toArray();
        $location['data'] = json_decode($location['data'], true);
        return $location;
    }
}

<?php

namespace App\Services\Signup;

use Carbon\Carbon;

class SignupValidator
{
    public function afterNow($attribute, $value, $parameters, $validator)
    {
        return Carbon::parse($value)->gt(Carbon::now());
    }
}

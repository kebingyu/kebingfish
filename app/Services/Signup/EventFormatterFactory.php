<?php

namespace App\Services\Signup;

class EventFormatterFactory
{
    public static function create(array $event)
    {
        switch ($event['type']) {
            case 1:
            default:
                return new RegularEventFormatter($event);
            case 2:
                return new OptionEventFormatter($event);
        }
    }
}

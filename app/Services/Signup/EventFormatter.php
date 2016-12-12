<?php

namespace App\Services\Signup;

interface EventFormatter
{
    public function getEventsViewData(): array;

    public function getEventViewData(): array;

    public function getEventPrintViewData(): array;

    public function getEventUpdateViewData(): array;
}

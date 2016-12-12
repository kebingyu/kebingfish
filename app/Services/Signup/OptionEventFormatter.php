<?php

namespace App\Services\Signup;

use Carbon\Carbon;

class OptionEventFormatter extends RegularEventFormatter
{
    public function getEventPrintViewData(): array
    {
        return $this->getEventViewData() + $this->getEventPrintBladeData($this->event);
    }

    protected function getEventPrintBladeData(array $event)
    {
        $options = [];

        foreach ($event['users'] as $user) {
            $option = $user['pivot']['option'];
            $group_size = $user['pivot']['group_size'];
            if (isset($options[$option])) {
                $options[$option] += $group_size;
            } else {
                $options[$option] = $group_size;
            }
        }

        return ['options' => $options];
    }

    public function getEventUpdateViewData(): array
    {
        $event = $this->event;
        $expire = Carbon::parse($event['expires_at'])->format('m/d/Y');
        return $this->getEventsViewData() + [
            'expire' => $expire,
            'type' => $event['type'],
            'location_id' => $event['location']['id'],
        ];
    }
}

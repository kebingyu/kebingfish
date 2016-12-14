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
        $data = parent::getEventUpdateViewData();
        $data['location_id'] = $this->event['location']['id'];
        return $data;
    }
}

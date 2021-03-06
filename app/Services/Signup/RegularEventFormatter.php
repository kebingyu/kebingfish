<?php

namespace App\Services\Signup;

use Carbon\Carbon;

class RegularEventFormatter implements EventFormatter
{
    use SignupRouteTrait;

    /* @var array */
    protected $event;

    public function __construct(array $event)
    {
        $this->event = $event;
    }

    public function getEventsViewData(): array
    {
        return [
            'title' => $this->event['title'],
            'description' => $this->event['description'],
            'href' => $this->getWebRouteEventRead($this->event['id']),
            'goerCount' => $this->event['goer_count'],
            'expired' => $this->event['expired'],
        ];
    }

    public function getEventViewData(): array
    {
        $event = $this->event;
        return $this->getEventsViewData() + [
            'users' => $this->usersToTableRows($event['id'], $event['users']),
            'expiresIn' => $event['expires_in'],
            'location' => $event['location'],
        ];
    }

    protected function usersToTableRows($eventId, array $users)
    {
        return array_map(function ($user) use ($eventId) {
            return [
                'name' => $user['name'],
                'href' => $this->getApiRouteEventUserDelete($eventId, $user['name']),
                'group_size' => $user['pivot']['group_size'],
                'option' => $user['pivot']['option'],
            ];
        }, $users);
    }

    public function getEventPrintViewData(): array
    {
        return $this->getEventViewData() + [
            'options' => [],
        ];
    }

    public function getEventUpdateViewData(): array
    {
        $event = $this->event;

        if ($event['expires_at']) {
            $expire = Carbon::parse($event['expires_at'])->format('m/d/Y');
        } else {
            $expire = '';
        }

        return $this->getEventsViewData() + [
            'expire' => $expire,
            'type' => $event['type'],
            'location_id' => null,
        ];
    }
}

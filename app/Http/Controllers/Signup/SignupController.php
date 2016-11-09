<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Services\Signup\SignupApiClient;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    /* @var SignupApiClient */
    protected $client;

    public function __construct(SignupApiClient $client)
    {
        $this->client = $client;
    }

    public function events(Request $request)
    {
        $events = array_map(function ($event) {
            return $this->getEventsBladeData($event);
        }, $this->client->getAllEvents());
        return view('signup/events', [
            'pageTitle' => 'All Events',
            'events' => $events,
            'url' => $this->client->getApiRouteEventsCreate(),
        ]);
    }

    protected function getEventsBladeData(array $event)
    {
        return [
            'title' => $this->getEventTitleHref($event),
            'description' => $event['description'],
            'userCount' => count($event['users']),
        ];
    }

    protected function getEventTitleHref(array $event)
    {
        return "<a href=\"{$this->client->getWebRouteEventRead($event['id'])}\">{$event['title']}</a>";
    }

    public function event(Request $request, string $eventId)
    {
        $event = $this->client->getEvent($eventId);
        return view('signup/event', [
            'pageTitle' => 'Event: ' . $event['title'],
            'url' => $this->client->getApiRouteEventUserCreate($event['id']),
        ] + $this->getEventBladeData($event));
    }

    protected function getEventBladeData(array $event)
    {
        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'users' => $this->usersToTableRows($event['users']),
        ];
    }

    protected function usersToTableRows(array $users)
    {
        $counter = 0;
        return array_map(function ($user) use (&$counter) {
            return [
                '#' => ++$counter,
                'name' => $user['name'],
            ];
        }, $users);
    }
}

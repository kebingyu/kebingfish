<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Services\Signup\SignupApiClient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SignupController extends Controller
{
    /* @var SignupApiClient */
    protected $client;

    public function __construct(SignupApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Show all active events.
     *
     * @param Request $request
     */
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
            'Title' => $this->getEventTitleHref($event),
            'Description' => $event['description'],
            'Goer Count' => $event['goer_count'],
            'Expires In' => $event['expires_in'],
        ];
    }

    protected function getEventTitleHref(array $event)
    {
        return "<a href=\"{$this->client->getWebRouteEventRead($event['id'])}\">{$event['title']}</a>";
    }

    /**
     * Show one events.
     *
     * @param Request $request
     */
    public function event(Request $request, string $eventId)
    {
        $event = $this->client->getEvent($eventId);
        return view('signup/event', [
            'pageTitle' => 'Event: ' . $event['title'],
            'url' => $this->client->getApiRouteEventUserCreate($event['id']),
            'goerCount' => $event['goer_count'],
        ] + $this->getEventBladeData($event));
    }

    protected function getEventBladeData(array $event)
    {
        $expire = Carbon::parse($event['expires_at'])->format('l, F d Y');
        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'users' => $this->usersToTableRows($event['id'], $event['users']),
            'expire' => "This event expires on {$expire}",
        ];
    }

    protected function usersToTableRows($eventId, array $users)
    {
        return array_map(function ($user) use ($eventId) {
            return [
                'Name' => $this->getUserNameHref($eventId, $user),
                'Group size' => $user['pivot']['group_size'],
            ];
        }, $users);
    }

    protected function getUserNameHref($eventId, array $user)
    {
        return "<a href=\"{$this->client->getApiRouteEventUserDelete($eventId, $user['name'])}\">{$user['name']}</a>";
    }
}

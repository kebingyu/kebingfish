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
        return view('signup/events', [
            'pageTitle' => 'All Events',
            'url' => $this->client->getApiRouteEventsCreate(),
        ]);
    }

    protected function getEventsBladeData(array $event)
    {
        return [
            'title' => $event['title'],
            'href' => $this->getEventTitleHref($event),
            'count' => $event['goer_count'],
        ];
    }

    protected function getEventTitleHref(array $event)
    {
        return $this->client->getWebRouteEventRead($event['id']);
    }

    /**
     * Show one event and signup users.
     *
     * @param Request $request
     */
    public function eventShow(Request $request, string $eventId)
    {
        $event = $this->client->getEvent($eventId);
        return view('signup/event', [
            'pageTitle' => 'Event: ' . $event['title'],
            'url' => $this->client->getApiRouteEventUserCreate($event['id']),
            'editUrl' => $this->client->getWebRouteEventUpdate($event['id']),
            'printUrl' => $this->client->getWebRouteEventPrint($event['id']),
            'goerCount' => $event['goer_count'],
        ] + $this->getEventBladeData($event));
    }

    /**
     * Show one event and signup users as printable.
     *
     * @param Request $request
     */
    public function eventPrint(Request $request, string $eventId)
    {
        $event = $this->client->getEvent($eventId);
        return view('signup/event-print', [
            'pageTitle' => 'Print event: ' . $event['title'],
            'url' => $this->client->getApiRouteEventUserCreate($event['id']),
            'goerCount' => $event['goer_count'],
        ] + $this->getEventBladeData($event));
    }

    /**
     * Edit one event.
     *
     * @param Request $request
     */
    public function eventUpdate(Request $request, string $eventId)
    {
        $event = $this->client->getEvent($eventId);
        return view('signup/event-update', [
            'pageTitle' => 'Edit event: ' . $event['title'],
            'url' => $this->client->getApiRouteEventUpdate($event['id']),
            'successUrl' => $this->client->getWebRouteEventRead($event['id']),
            'goerCount' => $event['goer_count'],
        ] + $this->getEventUpdateBladeData($event));
    }

    protected function getEventBladeData(array $event)
    {
        $expire = Carbon::parse($event['expires_at'])->format('l, F d Y');
        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'users' => $this->usersToTableRows($event['id'], $event['users']),
            'expire' => "This event expires on {$expire}",
            'expiresIn' => $event['expires_in'],
        ];
    }

    protected function usersToTableRows($eventId, array $users)
    {
        return array_map(function ($user) use ($eventId) {
            return [
                'name' => $user['name'],
                'href' => $this->getUserNameHref($eventId, $user),
                'group_size' => $user['pivot']['group_size'],
            ];
        }, $users);
    }

    protected function getUserNameHref($eventId, array $user)
    {
        return $this->client->getApiRouteEventUserDelete($eventId, $user['name']);
    }

    protected function getEventUpdateBladeData(array $event)
    {
        $expire = Carbon::parse($event['expires_at'])->format('m/d/Y');
        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'expire' => $expire,
        ];
    }
}

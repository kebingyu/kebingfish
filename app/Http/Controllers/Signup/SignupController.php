<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Services\Signup\SignupApiClient;
use App\Services\Signup\SignupRouteTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SignupController extends Controller
{
    use SignupRouteTrait;

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
        }, $this->client->getEvents());
        return view('signup/events', [
            'pageTitle' => 'All Events',
            'events' => $events,
            'url' => $this->getApiRouteEventsCreate(),
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
        return $this->getWebRouteEventRead($event['id']);
    }

    /**
     * Create a new event.
     *
     * @param Request $request
     */
    public function eventCreate(Request $request)
    {
        $type = $request->get('type', 1);
        return view('signup/event-create', [
            'pageTitle' => 'Create Event',
            'url' => $this->getApiRouteEventsCreate(),
            'type' => $type,
            'locations' => $this->getLocations($type),
        ]);
    }

    private function getLocations($type)
    {
        if ($type == 2) {
            return $this->client->getLocations();
        }
        return [];
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
            'url' => $this->getApiRouteEventUserCreate($event['id']),
            'editUrl' => $this->getWebRouteEventUpdate($event['id']),
            'printUrl' => $this->getWebRouteEventPrint($event['id']),
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
            'url' => $this->getApiRouteEventUserCreate($event['id']),
        ] + $this->getEventBladeData($event) + $this->getEventPrintBladeData($event));
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
            'url' => $this->getApiRouteEventUpdate($event['id']),
            'successUrl' => $this->getWebRouteEventRead($event['id']),
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
            'goerCount' => $event['goer_count'],
            'location' => $event['location'],
        ];
    }

    protected function usersToTableRows($eventId, array $users)
    {
        return array_map(function ($user) use ($eventId) {
            return [
                'name' => $user['name'],
                'href' => $this->getUserNameHref($eventId, $user),
                'group_size' => $user['pivot']['group_size'],
                'option' => $user['pivot']['option'],
            ];
        }, $users);
    }

    protected function getUserNameHref($eventId, array $user)
    {
        return $this->getApiRouteEventUserDelete($eventId, $user['name']);
    }

    protected function getEventUpdateBladeData(array $event)
    {
        $expire = Carbon::parse($event['expires_at'])->format('m/d/Y');
        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'expire' => $expire,
            'type' => $event['type'],
            'location_id' => $event['location']['id'] ?? null,
            'locations' => $this->getLocations($event['type']),
        ];
    }

    protected function getEventPrintBladeData(array $event)
    {
        $options = [];
        if ($event['location']) {
            foreach ($event['users'] as $user) {
                $option = $user['pivot']['option'];
                if (isset($options[$option])) {
                    $options[$option] += 1;
                } else {
                    $options[$option] = 1;
                }
            }
        }
        return ['options' => $options];
    }
}

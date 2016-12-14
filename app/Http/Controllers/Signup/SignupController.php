<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Services\Signup\SignupApiClient;
use App\Services\Signup\SignupRouteTrait;
use App\Services\Signup\EventFormatterFactory;
use App\Models\Signup\Event;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Auth\AuthenticationException;
use Carbon\Carbon;

class SignupController extends Controller
{
    use SignupRouteTrait;

    /* @var SignupApiClient */
    protected $client;

    /* @var Guard */
    protected $guard;

    public function __construct(SignupApiClient $client, Guard $guard)
    {
        $this->client = $client;
        $this->guard = $guard;
    }

    /**
     * Show all active events.
     *
     * @param Request $request
     */
    public function events(Request $request)
    {
        $events = array_map(function ($event) {
            return EventFormatterFactory::create($event)->getEventsViewData();
        }, $this->filterEvents($this->client->getEvents()));

        return view('signup/events', [
            'pageTitle' => 'All Events',
            'events' => $events,
            'url' => $this->getApiRouteEventsCreate(),
        ]);
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

    /**
     * Show one event and signup users.
     *
     * @param Request $request
     * @param Event   $event
     */
    public function eventShow(Request $request, Event $event)
    {
        if (!$this->canViewEvent($event['expires_at'])) {
            throw new AuthenticationException();
        }
        $event = $event->toArray();

        return view('signup/event', [
            'pageTitle' => 'Event: ' . $event['title'],
            'url' => $this->getApiRouteEventUserCreate($event['id']),
            'editUrl' => $this->getWebRouteEventUpdate($event['id']),
            'printUrl' => $this->getWebRouteEventPrint($event['id']),
            'resetUrl' => $this->getApiRouteEventReset($event['id']),
        ] + EventFormatterFactory::create($event)->getEventViewData());
    }

    /**
     * Show one event and signup users as printable.
     *
     * @param Request $request
     * @param Event   $event
     */
    public function eventPrint(Request $request, Event $event)
    {
        if (!$this->canViewEvent($event['expires_at'])) {
            throw new AuthenticationException();
        }
        $event = $event->toArray();

        return view('signup/event-print', [
            'pageTitle' => 'Print event: ' . $event['title'],
            'url' => $this->getApiRouteEventUserCreate($event['id']),
        ] + EventFormatterFactory::create($event)->getEventPrintViewData());
    }

    /**
     * Edit one event.
     *
     * @param Request $request
     * @param Event   $event
     */
    public function eventUpdate(Request $request, Event $event)
    {
        $event = $event->toArray();

        return view('signup/event-update', [
            'pageTitle' => 'Edit event: ' . $event['title'],
            'url' => $this->getApiRouteEventUpdate($event['id']),
            'successUrl' => $this->getWebRouteEventRead($event['id']),
            'locations' => $this->getLocations($event['type']),
        ] + EventFormatterFactory::create($event)->getEventUpdateViewData());
    }

    protected function getLocations($type)
    {
        if ($type == 2) {
            return $this->client->getLocations();
        }
        return [];
    }

    protected function filterEvents(array $events)
    {
        return array_filter($events, function ($event) {
            return $this->canViewEvent($event['expires_at']);
        });
    }

    protected function canViewEvent($expires_at)
    {
        return $this->guard->check() || !$this->eventExpired($expires_at);
    }

    protected function eventExpired($expires_at)
    {
        if ($expires_at) {
            return Carbon::now()->gt(Carbon::parse($expires_at));
        }
        return false;
    }
}

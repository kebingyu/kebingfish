<?php

namespace App\Services\Signup;

trait SignupRouteTrait
{
    public function getApiRouteEventsRead()
    {
        return route('api.signup.events.read');
    }

    public function getWebRouteEventsRead()
    {
        return route('signup.events.read');
    }

    public function getApiRouteEventsCreate()
    {
        return route('api.signup.events.create');
    }

    public function getApiRouteEventRead($eventId)
    {
        return route('api.signup.event.read', ['event' => $eventId]);
    }

    public function getWebRouteEventRead($eventId)
    {
        return route('signup.event.read', ['eventId' => $eventId]);
    }

    public function getApiRouteEventUpdate($eventId)
    {
        return route('api.signup.event.update', ['event' => $eventId]);
    }

    public function getWebRouteEventUpdate($eventId)
    {
        return route('signup.event.update', ['event' => $eventId]);
    }

    public function getWebRouteEventPrint($eventId)
    {
        return route('signup.event.print', ['event' => $eventId]);
    }

    public function getApiRouteEventUserCreate($eventId)
    {
        return route('api.signup.event.user.create', ['event' => $eventId]);
    }

    public function getApiRouteEventUserDelete($eventId, $userName)
    {
        return route('api.signup.event.user.delete', [
            'event' => $eventId,
            'eventUser' => $userName,
        ]);
    }

    public function getWebRouteLocationsRead()
    {
        return route('signup.locations.read');
    }

    public function getWebRouteLocationRead($id)
    {
        return route('signup.location.read', ['locationId' => $id]);
    }

    public function getApiRouteLocationsRead()
    {
        return route('api.signup.locations.read');
    }

    public function getApiRouteLocationRead($id)
    {
        return route('api.signup.location.read', ['locationId' => $id]);
    }

    public function getApiRouteEventReset($eventId)
    {
        return route('api.signup.event.reset', ['event' => $eventId]);
    }
}

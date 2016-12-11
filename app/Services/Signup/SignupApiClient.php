<?php

namespace App\Services\Signup;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SignupApiClient
{
    /* Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getEvents()
    {
        return $this->request('GET', $this->getApiRouteEventsRead());
    }

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

    public function getEvent(string $eventId)
    {
        return $this->request('GET', $this->getApiRouteEventRead($eventId));
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

    public function getLocations()
    {
        return $this->request('GET', route('api.signup.locations.read'));
    }

    protected function request(string $method, string $uri, array $options = [])
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            $result = json_decode($response->getBody(), true);
            if ($result['ok']) {
                return $result['data'];
            }
            return false;
        } catch (RequestException $e) {
            // Simply go 404
            abort(404);
        }
    }
}

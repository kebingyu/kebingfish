<?php

namespace App\Services\Signup;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SignupApiClient
{
    use SignupRouteTrait;

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

    public function getEvent(string $eventId)
    {
        return $this->request('GET', $this->getApiRouteEventRead($eventId));
    }

    public function getLocations()
    {
        return $this->request('GET', $this->getApiRouteLocationsRead());
    }

    public function getLocation(string $locationId)
    {
        return $this->request('GET', $this->getApiRouteLocationRead($locationId));
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

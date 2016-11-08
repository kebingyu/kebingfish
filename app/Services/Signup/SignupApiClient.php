<?php

namespace App\Services\Signup;

use GuzzleHttp\Client;

class SignupApiClient
{
    /* Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAllEvents()
    {
        return $this->request('GET', route('api.signup.events.all'));
    }

    protected function request(string $method, string $uri, array $options = [])
    {
        $response = $this->client->request($method, $uri, $options);
        return json_decode($response->getBody(), true);
    }
}

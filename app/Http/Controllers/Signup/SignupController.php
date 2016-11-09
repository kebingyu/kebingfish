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
        return $this->client->getAllEvents();
    }

    public function event(Request $request, string $eventId)
    {
        $event = $this->client->getEvent($eventId);
        $counter = 0;
        return view('signup/event', [
            'title' => 'Event: ' . $event['data']['title'],
            'description' => $event['data']['description'],
            'users' => array_map(function ($user) use (&$counter) {
                return [
                    'id' => ++$counter,
                    'name' => $user['name'],
                ];
            }, $event['data']['users']),
        ]);
    }
}

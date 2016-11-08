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
}

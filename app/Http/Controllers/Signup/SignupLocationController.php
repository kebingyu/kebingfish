<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Services\Signup\SignupApiClient;
use App\Services\Signup\SignupRouteTrait;
use App\Models\Signup\Location;
use Illuminate\Http\Request;

class SignupLocationController extends Controller
{
    use SignupRouteTrait;

    /* @var SignupApiClient */
    protected $client;

    public function __construct(SignupApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Show all locations.
     *
     * @param Request $request
     */
    public function locations(Request $request)
    {
        $locations = array_map(function ($location) {
            return [
                'title' => $location['name'],
                'href' => $this->getWebRouteLocationRead($location['id']),
            ];
        }, $this->client->getLocations());

        return view('signup/locations', [
            'pageTitle' => 'All Locations',
            'locations' => $locations,
        ]);
    }

    public function location(Request $request, Location $location)
    {
        $location = $location->toArray();
        return view('signup/location', [
            'pageTitle' => "Location: {$location['name']}",
            'location' => $location,
        ]);
    }
}

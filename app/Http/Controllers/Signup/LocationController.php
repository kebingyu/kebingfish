<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Models\Signup\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * List all locations.
     *
     * @return json
     */
    public function locations()
    {
        $locations = Location::all();
        return $this->responseJson(true, [
            'data' => $locations->map(function ($location) {
                return $location->toArray();
            })->all(),
        ]);
    }

    /**
     * Get info of one location.
     *
     * @param Request $request
     * @param Location $location
     *
     * @return json
     */
    public function location(Request $request, Location $location)
    {
        return $this->responseJson(true, [
            'data' => $location->toArray(),
        ]);
    }
}

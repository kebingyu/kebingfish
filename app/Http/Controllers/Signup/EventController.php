<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Signup\EventRequest;
use App\Models\Signup\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * List all events.
     *
     * @return json
     */
    public function events()
    {
        $events = Event::with('users')->get();
        return $this->responseJson(true, [
            'data' => $events->map(function ($event) {
                return $event->toArray();
            })->all(),
        ]);
    }

    /**
     * Get info of one event.
     *
     * @param Request $request
     * @param Event $event
     *
     * @return json
     */
    public function event(Request $request, Event $event)
    {
        return $this->responseJson(true, [
            'data' => $event->toArray(),
        ]);
    }

    /**
     * Create a new event.
     *
     * @param EventRequest $request
     *
     * @return json
     */
    public function add(EventRequest $request)
    {
        if (!$request->has('expires_at')) {
            $request->merge([
                'expires_at' => Carbon::now()->addWeek()->timestamp,
            ]);
        }
        $event = Event::create($request->all());
        return $this->responseJson(true, [
            'data' => $event->toArray(),
        ]);
    }

    /**
     * Delete an event.
     *
     * @param Request $request
     * @param Event $event
     *
     * @return json
     */
    public function delete(Request $request, Event $event)
    {
        try {
            // Remove all signup records attached to this event.
            $event->users()->detach();
            $deleted = $event->delete();
            $data = [];
        } catch (\Exception $e) {
            $deleted = false;
            $data = ['error' => $e->getMessage()];
        }
        return $this->responseJson($deleted, $data);
    }
}

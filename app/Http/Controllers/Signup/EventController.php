<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Event;
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
        $events = Event::all();
        return response()->json([
            'ok' => true,
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
        return response()->json([
            'ok' => true,
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
        return response()->json([
            'ok' => true,
            'data' => $event->toArray(),
        ]); 
    }

    public function delete(Request $request, Event $event)
    {
        try {
            $deleted = $event->delete();
        } catch (\Exception $e) {
            $deleted = false;
        }
        return response()->json([
            'ok' => $deleted,
        ]);
    }
}

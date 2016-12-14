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
        // Only show events not expired
        $events = Event::with('users')->get()->filter(function ($event) {
            return Carbon::now()->lte(Carbon::parse($event['expires_at']));
        });
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
     * Update an event.
     *
     * @param EventRequest $request
     * @param Event $event
     *
     * @return json
     */
    public function update(EventRequest $request, Event $event)
    {
        try {
            $request->merge(['expires_at' => $this->getExpireTimestamp($request)]);
            $updated = $event->update($request->all());
            if ($updated) {
                $data = ['data' => $event->toArray()];
            } else {
                $data = ['error' => 'Update event failed.'];
            }
        } catch (\Exception $e) {
            $updated = false;
            $data = ['error' => $e->getMessage()];
        }
        return $this->responseJson($updated, $data);
    }

    public function reset(Request $request, Event $event)
    {
        $event->users()->detach();
        return $this->responseJson(true, [
            'data' => Event::find($event->id)->toArray(),
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
        $request->merge(['expires_at' => $this->getExpireTimestamp($request)]);
        $event = Event::create($request->all());
        return $this->responseJson(true, [
            'data' => $event->toArray(),
        ]);
    }

    protected function getExpireTimestamp(EventRequest $request)
    {
        if (!$request->has('expires_at')) {
            return Carbon::now()->addWeek()->timestamp;
        }
        return Carbon::parse($request->get('expires_at'))->timestamp;
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

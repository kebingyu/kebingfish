<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Signup\UserRequest;
use App\Models\Signup\Event;
use App\Models\Signup\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventUserController extends Controller
{
    /**
     * Sign up a user to an event.
     *
     * @param UserRequest $request
     * @param Event $event
     *
     * @return json
     */
    public function add(UserRequest $request, Event $event)
    {
        $user = $this->findUser($request->get('name'));
        if (!$this->userhasSignedUp($event, $user->id)) {
            $event->users()->attach($user->id, [
                'group_size' => $this->getGroupSize($request),
            ]);
            return $this->responseJson(true, [
                'data' => Event::find($event->id)->toArray(),
            ]);
        }

        return $this->responseJson(false, [
            'error' => "User ({$user->name}) has already signed up this event.",
        ]);
    }

    /**
     * Remove a user from an event.
     *
     * @param Event $event
     * @param User $user
     *
     * @return json
     */
    public function delete(Event $event, User $user)
    {
        if ($this->userhasSignedUp($event, $user->id)) {
            $event->users()->detach($user->id);
            return $this->responseJson(true, [
                'data' => Event::find($event->id)->toArray(),
            ]);
        }

        return $this->responseJson(false, [
            'error' => "User ({$user->name}) has not signed up this event.",
        ]);
    }

    protected function findUser(string $name)
    {
        try {
            $user = User::where('name', $name)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $user = User::create([
                'name' => $name,
            ]);
        }
        return $user;
    }

    /**
     * Check if given user has already signed up the event.
     *
     * @param Event $event
     * @param int $userId
     *
     * @return bool
     */
    protected function userHasSignedUp(Event $event, int $userId)
    {
        return is_numeric($event->users()->get()->search(function ($user, $key) use ($userId) {
            return $user->id == $userId;
        }));
    }

    protected function getGroupSize(UserRequest $request)
    {
        if ($request->has('group_size')) {
            return $request->get('group_size');
        }
        return 1;
    }
}

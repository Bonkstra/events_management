<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index(Event $event)
    {
        $attendees = $event->attendees()->latest();

        return AttendeeResource::collection($attendees->paginate());
    }

    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);

        return new AttendeeResource($attendee);
    }

    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $event, Attendee $attendee) // NO NEED TO FETCH THE EVENT FROM DB
    {
        $attendee->delete();

        return response(status: 204);
    }
}

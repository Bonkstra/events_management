<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    use CanLoadRelationships;

    private array $relations = ['user'];

    public function index(Event $event)
    {
        return AttendeeResource::collection($this->loadRelationships(Event::query())->latest()->paginate());
    }

    public function store(Request $request, Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);

        return new AttendeeResource($this->loadRelationships($attendee));
    }

    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($this->loadRelationships($attendee));
    }

    public function destroy(string $event, Attendee $attendee) // NO NEED TO FETCH THE EVENT FROM DB
    {
        $attendee->delete();

        return response(status: 204);
    }
}

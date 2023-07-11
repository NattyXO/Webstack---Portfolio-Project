<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLocation;
use Illuminate\Http\Request;
use App\User;

class EventController extends Controller
{

    public function index()
    {
        return Event::all();
    }

    public function createEvent(Request $request)
    {
        $fields = $request->validate([
            // 'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'images' => 'required',
            'company_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_deadline' => 'required',
            'city' => 'required',
            'street' => 'required',
            'venue' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'economy_seats' => 'required',
            'economy_price' => 'required',
            'vip_seats' => 'required',
            'vip_price' => 'required'
        ]);

        // return $fields['economy_price'];

        // create event first
        $event = Event::create([
            'user_id' => auth()->user()->id,
            'company_id' => $fields['company_id'],
            'approved' => true,
            'approved_by' => 1,
            'title' => $fields['title'],
            'desc' => $fields['desc'],
            'event_start_time' => $fields['event_start_time'],
            'event_end_time' => $fields['event_end_time'],
            'event_deadline' => $fields['event_deadline'],
            'economy_seats' => $fields['economy_price'],
            'economy_price' => $fields['economy_price'],
            'vip_seats' => $fields['vip_seats'],
            'vip_price' => $fields['vip_price'],
        ]);

        $location = $event->location()->create([
            'city' => $fields['city'],
            'street' => $fields['street'],
            'venue' => $fields['venue'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude']
        ]);

        // upload images to that event
        foreach ($request->file('images') as $mimage) {
            $image_path = $mimage->store('image', 'public');
            $upload = $event->gallery()->create([
                'event_id' => $event->id,
                'event_photo' => $image_path
            ]);
        }

        // get current event
        $event = Event::find($event->id);

        $response = [
            'response' => 201,
            'message' => 'Event created successfully !',
            'event' => $event,
            'event_gallery' => $event->gallery,
            'event_location' => $event->location,
        ];

        return response($response, 201);
    }

    public function editEvent(Request $request, $event_id)
    {
        $fields = $request->validate([
            'images' => 'required',
            'company_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_deadline' => 'required',
            'city' => 'required',
            'street' => 'required',
            'venue' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'economy_seats' => 'required',
            'economy_price' => 'required',
            'vip_seats' => 'required',
            'vip_price' => 'required'
        ]);

        $current_event = Event::find($event_id);
        $current_event->update([
            // 'user_id' => auth()->user()->id,
            'company_id' => $fields['company_id'],
            'approved' => true,
            'approved_by' => 1,
            'title' => $fields['title'],
            'desc' => $fields['desc'],
            'event_start_time' => $fields['event_start_time'],
            'event_end_time' => $fields['event_end_time'],
            'event_deadline' => $fields['event_deadline'],
            'economy_seats' => $fields['economy_price'],
            'economy_price' => $fields['economy_price'],
            'vip_seats' => $fields['vip_seats'],
            'vip_price' => $fields['vip_price'],
        ]);
        $location = $current_event->location()->update([
            'city' => $fields['city'],
            'street' => $fields['street'],
            'venue' => $fields['venue'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude']
        ]);

        // TODO : remove all event photos or give users a permission..!


        // upload images to that event
        foreach ($request->file('images') as $mimage) {
            $image_path = $mimage->store('image', 'public');
            $upload = $current_event->gallery()->create([
                'event_id' => $current_event->id,
                'event_photo' => $image_path
            ]);
        }

        $response = [
            'response' => 201,
            'message' => 'Event updated successfully !',
            'event' => $current_event,
            'event_gallery' => $current_event->gallery,
            'event_location' => $current_event->location,

        ];

        return response($response, 201);
        return $current_event;
    }

    public function deleteEvent(Request $request, $event_id)
    {
        $current_event = Event::find($event_id);
        return $current_event->delete();
    }

    public function search($key)
    {
        return Event::where('title', 'like', '%' . $key . '%')
            ->orwhere('desc', 'like', '%' . $key . '%')
            ->get();
    }


    public function singleEvent(Request $request, $event_id)
    {
        return Event::findorfail($event_id);
    }





    //
}

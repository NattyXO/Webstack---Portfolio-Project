<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventReviews;
use Illuminate\Http\Request;

class EventReviewsController extends Controller
{
    public function getReviews(Request $request, $id)
    {
        $event = Event::find($id);

        return $event->reviews;
    }

    public function addReviews(Request $request, $id)
    {
        $fields = $request->validate([
            'comment' => 'required',
            'stars' => 'required'
        ]);

        $event = Event::find($id);
        if ($event != null) {
            $review = EventReviews::create([
                'user_id' => auth()->user()->id,
                'event_id' => $event->id,
                'comment' => $fields['comment'],
                'stars' => $fields['stars'],
            ]);

            $response = [
                'response' => 201,
                'message' => 'Review added successfully !',
                'event' => $event,
                'review' => $review,
            ];

            return response($response, 201);
        } else {
            return "event with that information not found !";
        }

        // 
    }

    public function editReviews(Request $request, $id, $rev_id)
    {
        $fields = $request->validate([
            'comment' => 'required',
            'stars' => 'required'
        ]);

        $event = Event::find($id);
        $review = EventReviews::find($rev_id);

        if ($event != null && $review != null) {

            if (
                $review->event->id == $event->id
                &&
                $review->event->user->id == auth()->user()->id
            ) {
                $review->update([
                    'comment' => $fields['comment'],
                    'stars' => $fields['stars'],
                ]);

                $response = [
                    'response' => 201,
                    'message' => 'Review updated successfully !',
                    'event' => $event,
                    'review' => $review,
                ];

                return response($response, 201);
            } else {
                return "You don't have a permission to do that !";
            }
        } else {
            return "invalid data !";
        }

        // 
    }

    public function deleteReview(Request $request, $id, $rev_id)
    {
        $event = Event::find($id);
        $review = EventReviews::find($rev_id);

        if ($event != null && $review != null) {

            if (
                $review->event->id == $event->id
                &&
                $review->event->user->id == auth()->user()->id
            ) {
                $review->delete();

                $response = [
                    'response' => 201,
                    'message' => 'Review deleted successfully !',
                ];

                return response($response, 201);
            } else {
                return "You don't have a permission to do that !";
            }
        } else {
            return "an event with that information not found !";
        }
    }








    //
}

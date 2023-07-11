<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingHistory;
use App\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function createBooking(Request $request)
    {
        $fields = $request->validate([
            'event_id' => 'required',
            'economy_count' => 'required',
            'vip_count' => 'required',
        ]);

        $booking = Booking::create([
            'user_id' => auth()->user()->id,
            'event_id' => $fields['event_id'],
            'economy_count' => $fields['economy_count'],
            'vip_count' => $fields['vip_count'],
            // auto generated fields
            'completed' => 'false',
            'booking_token' => 'n3r687c19r8b6w7r8xrhc',
            'qrcode' => 'm2kjhasfdbbbbsc87agca',
        ]);

        // add to booking-history table
        $location = $booking->bookinghistory()->create([
            'user_id' => auth()->user()->id,
            'booking_id' => $fields['event_id'],
        ]);

        $response = [
            'response' => 201,
            'message' => 'Booking successfull !',
            'booking' => $booking,
            'booking_history' => $booking->bookinghistory,
        ];

        return response($response, 201);


        // 
    }

    public function editBooking(Request $request, $booking_id)
    {
        $fields = $request->validate([
            'event_id' => 'required',
            'economy_count' => 'required',
            'vip_count' => 'required',
        ]);

        $current_booking = Booking::find($booking_id);

        if ($current_booking != null) {
            if ($current_booking->user_id == auth()->user()->id) {
                $current_booking->update([
                    'event_id' => $fields['event_id'],
                    'economy_count' => $fields['economy_count'],
                    'vip_count' => $fields['vip_count'],
                    // auto generated fields
                    'completed' => 'false',
                    'booking_token' => 'n3r687c19r8b6w7r8xrhc',
                    'qrcode' => 'm2kjhasfdbbbbsc87agca',
                ]);

                $response = [
                    'response' => 201,
                    'message' => 'Booking updated successfully !',
                    'booking' => $current_booking,
                ];
            } else {
                return "You are not authorized to do that !";
            }
        } else {
            return "A booking with that information not found !";
        }




        return response($response, 201);
        //
    }

    public function getBooking(Request $request, $id)
    {
        $booking = Booking::find($id);
        if ($booking != null) {
            if ($booking->user->id == auth()->user()->id) {
                return $booking;
            } else {
                return "You are not authorized to access this booking !";
            }
        } else {
            return "We couldn't find an event with that information";
        }
    }

    public function myBookings()
    {
        // protected route
        return auth()->user()->bookings;
        // $bookings = BookingHistory::where(
        //     'user_id',
        //     '=',
        //     auth()->user()->id
        // )->get();
        // return $bookings;
    }






    // 
}

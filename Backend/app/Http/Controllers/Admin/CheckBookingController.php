<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingUserRooms;
use Illuminate\Http\Request;

class CheckBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get user ID
        $userID = Auth()->user()->id;

        // Check booking for the user
        $bookings = BookingUserRooms::all()->where('create_by_id', $userID)->where('checked', null);

        // Return view with bookings
        return view('checkbooking.index', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function alertBooking()
    {

        //Get user ID
        $userID = auth()->user()->id;

        // Check booking for the user
        $bookings = BookingUserRooms::all()->where('create_by_id', $userID)->where('checked', null);

        $countBooking = count($bookings);

        // Return number of bookings
        return response()->json(['success' => true, 'data' => $countBooking]);

    }

    /**
     * Display the specified resource.
     */
    public function confirmBooking(Request $request)
    {

        //Update booking with checked status
        $booking = BookingUserRooms::find($request->bookingID);
        $booking->checked = 1;
        $booking->save();

        //Return success message
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function listConfirmedBooking()
    {
        //
        //Get user ID
        $userID = auth()->user()->id;

        // Check booking for the user
        $confirmBooking = BookingUserRooms::all()->where('create_by_id', $userID)->where('checked', 1);

        return response()->json(['success' => true, 'data' => $confirmBooking]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

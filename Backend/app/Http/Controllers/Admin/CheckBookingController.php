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
        $bookings = BookingUserRooms::all()->where('create_by', $userID);

        // Return view with bookings
        return view('checkbooking.index', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function alertBooking()
    {
        //
        //Get user ID
        $userID = auth()->user()->id;

        // Check booking for the user
        $bookings = BookingUserRooms::all()->where('create_by', $userID)->where('checked', null);

        $countBooking = count($bookings);

        // Return number of bookings
        return response()->json(['success' => true, 'data' => $countBooking]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

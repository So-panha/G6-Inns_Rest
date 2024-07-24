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
        //
        //User ID
        $userId = Auth()->user()->id;
        $dataBookings = BookingUserRooms::all()->where('create_by', $userId)->where('checked', null);
        return view('checkbooking.index', compact('dataBookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function alertBooking()
    {
        //User ID
        $userId = Auth()->user()->id;
        $dataBookings = BookingUserRooms::all()->where('create_by', $userId)->where('checked', null);
        return view('checkingRoom.index', compact('dataBookings'));
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

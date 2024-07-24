<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingUserRooms;
use Illuminate\Http\Request;

class CheckingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //Get user ID
        $userID = auth()->user()->id;

        // Check booking for the user
        $stayInRooms = BookingUserRooms::all()->where('create_by_id', $userID)->where('checked', 1);

        return view('checkingRoom.index',compact('stayInRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function leaveConfirmed(Request $request)
    {
        //Update booking with checked status
        $booking = BookingUserRooms::find($request->stayingID);
        $booking->checked = 2;
        $booking->save();

        //Return success message
        return redirect()->back();
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

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\BookingUserRooms;
use Illuminate\Http\Request;

class GetTiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ticketList(string $userID)
    {

        // Check booking for the user
        $bookings = BookingUserRooms::all()->where('user_id', $userID)->where('checked', null);

        // Resource the data
        $ticket = TicketResource::collection($bookings);

        // Return number of bookings
        return response()->json(['success' => true, 'data' => $ticket]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function cancelTicket(string $id)
    {
        //
        $bookings = BookingUserRooms::find( $id);
        $bookings->delete();
        return response()->json(['success' => true, 'data' => 'Ticket Cancelled']);
    }
}

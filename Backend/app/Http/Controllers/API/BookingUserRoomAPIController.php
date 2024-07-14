<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingUserRoomRequest;
use App\Http\Resources\GetBookingUserRoomTypeResource;
use App\Models\BookingUserRooms;
use Illuminate\Http\Request;

class BookingUserRoomAPIController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateBookingUserRoomRequest $request)
    {
        $validatedData = $request->validated();
    
        // Create a new BookingUserRoom record in the database
        $bookingUserRoom = BookingUserRooms::create($validatedData);
    
        // Return a JSON response with the newly created resource and status code 201 (Created)
        return response()->json(new GetBookingUserRoomTypeResource($bookingUserRoom), 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bookingUserRoom = BookingUserRooms::findOrFail($id);
        return response()->json(new GetBookingUserRoomTypeResource($bookingUserRoom));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateBookingUserRoomRequest $request, $id)
    {
        $bookingUserRoom = BookingUserRooms::findOrFail($id);
        $data = $request->validated();
        $bookingUserRoom->update($data);
        return response()->json(new GetBookingUserRoomTypeResource($bookingUserRoom));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookingUserRoom = BookingUserRooms::findOrFail($id);
        $bookingUserRoom->delete();
        return response()->json(['message' => 'BookingUserRoom deleted successfully']);
    }
}
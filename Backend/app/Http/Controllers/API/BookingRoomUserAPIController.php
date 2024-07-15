<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRoomUserRequest;
use App\Http\Resources\GetBookingRoomUserTypeResource;
use App\Models\BookingRoomUser;
use Illuminate\Http\Request;

class BookingRoomUserAPIController extends Controller
{
    
    //  * Store a newly created resource in storage.
    
    public function create(CreateBookingRoomUserRequest $request)
    {
        $validatedData = $request->validated();
    
        // Create a new BookingUserRoom record in the database
        $bookingRoomUser = BookingRoomUser::create($validatedData);
    
        // Return a JSON response with the newly created resource and status code 201 (Created)
        return response()->json(new GetBookingRoomUserTypeResource($bookingRoomUser));
    }
    

    
    //  * Display the specified resource.
    
    public function show($id)
    {
        $bookingRoomUser = BookingRoomUser::findOrFail($id);
        return response()->json(new GetBookingRoomUserTypeResource($bookingRoomUser));
    }

   
    //  * Update the specified resource in storage.
  
    public function update(CreateBookingRoomUserRequest $request, $id)
    {
        $bookingRoomUser = BookingRoomUser::findOrFail($id);
        $data = $request->validated();
        $bookingRoomUser->update($data);
        return response()->json(new GetBookingRoomUserTypeResource($bookingRoomUser));
    }

   
    //  * Remove the specified resource from storage.
 
    public function destroy($id)
    {
        $bookingRoomUser = BookingRoomUser::findOrFail($id);
        $bookingRoomUser->delete();
        return response()->json(['message' => 'BookingUserRoom deleted successfully']);
    }
}
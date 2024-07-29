<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingUserRoomRequest;
use App\Http\Resources\GetBookingUserRoomTypeResource;
use App\Models\booking;
use App\Models\BookingUserRooms;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingUserRoomAPIController extends Controller
{
    public function create(CreateBookingUserRoomRequest $request)
    {
        try {
            $validatedData = $request->validated();
            \Log::info('Validated Data:', $validatedData);

            $userExists = \App\Models\UserNormal::find($validatedData['user_id']);
            if (!$userExists) {
                \Log::error('Invalid user_id:', ['user_id' => $validatedData['user_id']]);
                return response()->json(['message' => 'The selected user id is invalid.'], 400);
            }

            $validatedData['paymented'] = floatval($validatedData['paymented']);

            // dd($request->all());

            $bookingUserRoom = BookingUserRooms::create($validatedData);

            if($bookingUserRoom){
                return response()->json(['message' => 1]);
            }

            \Log::info('Booking User Room Created:', $bookingUserRoom->toArray());
            return response()->json(new GetBookingUserRoomTypeResource($bookingUserRoom), 200);
        } catch (\Exception $e) {
            \Log::error('Error Creating Booking User Room:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create booking.'], 500);
        }
    }



    // Search range date
    public function search(Request $request)
    {
        // Validate the date range
        $request->validate([
            'departure_date' => 'required|date',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
        ]);

        $startDate = $request->departure_date;
        $endDate = $request->arrival_date;

        // Get the bookings and count them grouped by room_id
        $bookings = BookingUserRooms::select(
                'room_id',
                DB::raw('SUM(number_of_rooms) as number_rooms'),
            )
            ->whereDate('arrival_date', '<=', $endDate)
            ->whereDate('departure_date', '>=', $startDate)
            ->groupBy('room_id')
            ->get();


        // // Find rooms that free for booking base on the date that provided by clients
        $roomsCanBooking = [];
        if(count($bookings) != 0){
            foreach($bookings as $booking){
                $realNumberOfRoom = Room::find($booking->room_id)->number_of_rooms;
                if($realNumberOfRoom > $booking->number_rooms || $realNumberOfRoom - $booking->number_rooms == 1 || $realNumberOfRoom - $booking->number_rooms == 0){
                    $roomsRest = $realNumberOfRoom - $booking->number_rooms;
                    array_push($roomsCanBooking,$roomsRest);
                }
            };

            // // Set data of rooms that can booking base on the research
            foreach($roomsCanBooking as $index => $roomCanBooking){
                $bookings[$index]->number_rooms = $roomsCanBooking[$index];
            };

            return response()->json($bookings);
        }else{
            return response()->json(['success' => false]);
        }
    }


    public function getAllUser()
    {

        $data = BookingUserRooms::all();
        return $data;

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

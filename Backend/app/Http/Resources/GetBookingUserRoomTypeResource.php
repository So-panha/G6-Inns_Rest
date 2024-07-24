<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetBookingUserRoomTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            // 'id' => $this->id,
            'price' => $this->price,
            'number_of_rooms' => $this->number_of_rooms,
            'departure_date' => $this->departure_date,
            'arrival_date' => $this->arrival_date,
            'user' => new UserNormalResource($this->user), // Assuming $this->user is the user object
            'room' => new GetAllRoomsResoure($this->room),
            'create_by' => new GetUserResoure($this->user)
        ];
    }
}

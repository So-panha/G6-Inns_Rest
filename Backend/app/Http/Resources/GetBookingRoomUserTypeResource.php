<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBookingRoomUserTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'price' => $this->price,
            'number_of_rooms' => $this->number_of_rooms,
            'departure_date' => $this->departure_date,
            'arrival_date' => $this->arrival_date,
            'paymented' => $this->paymented,
            'user' => new UserNormalResource($this->user),
            'room' => new GetAllRoomsResoure($this->room)
        ];

    }
}


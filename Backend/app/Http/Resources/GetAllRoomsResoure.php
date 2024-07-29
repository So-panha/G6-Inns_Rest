<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllRoomsResoure extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'capacity' => $this->capacity,
            'bed_type' => new GetBedTypeResoure($this->bedType),
            'type_of_room' => new GetRoomTypeResoure($this->roomType),
            'number_of_rooms' => $this->number_of_rooms,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'guest_house' => new GetGuestHouseResoure($this->guestHouse),
            'user_id' => new GetUserResoure($this->user),
            'images' => GetImagesRoomResource::collection($this->photos),
        ];
    }
}

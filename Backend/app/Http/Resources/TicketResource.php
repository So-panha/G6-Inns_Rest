<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this-> id,
            'name_user' => $this->user->name,
            'room_id' => $this-> room->id,
            'room_name' => $this-> room->name,
            'guest_house' => $this-> room->guestHouse->name,
            'start_check' => $this-> departure_date,
            'check_out' => $this-> arrival_date,
            'time' => $this-> created_at->diffForHumans(),
            'email_owner' => $this->userOwner->email,
            'phone_owner' => $this->userOwner->phone_number,
            'Total' => $this->paymented,
        ];
    }
}

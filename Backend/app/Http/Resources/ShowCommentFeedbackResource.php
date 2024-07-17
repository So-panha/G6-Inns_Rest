<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCommentFeedbackResource extends JsonResource
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
            'comment' => $this->comment,
            'guestHouse' => $this->guestHouse ? [
                'id' => $this->guestHouse->id,
                'name' => $this->guestHouse->name,
                'description' => $this->guestHouse->description,
            ] : null,
            'userNormal' => $this->userNormal ? [
                'id' => $this->userNormal->id,
                'name' => $this->userNormal->name,
                'profile' => $this->userNormal->profile,
            ] : null,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}

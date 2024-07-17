<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentFeedbackResource extends JsonResource
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
            'created_at_human' => $this->created_at->diffForHumans(),
            'updated_at_human' => $this->updated_at->diffForHumans(),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllGuestHouseApiResource extends JsonResource
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
            'description' => $this->description,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by_id' => $this->created_by_id,
            'photos' => GetAllPhotosResource::collection($this->photos),
            'thumbnail' => $this->thumbnail,
            'like' => $this->getAllLike,
            'likes_count' => $this->countLikes(),
            'commentFeedback' =>CommentFeedbackResource::collection($this->commentFeedback),
            'media' => MediaResource::collection($this->media),
        ];
    }
}

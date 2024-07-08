<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;

class Room extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = ['name', 'price', 'capacity', 'status', 'bed_type', 'type_of_room', 'number_of_rooms','description','guest_house_id','user_id'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->width(1200)
        ->height(1200);
    }

    public function getPhotosAttribute()
    {
        return $this->getMedia('photos')->map(function ($media) {
            return [
                'url' => $media->getUrl(),
                'thumbnail' => $media->getUrl('thumb'),
            ];
        });
    }


}


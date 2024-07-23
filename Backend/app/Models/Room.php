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
    protected $fillable = ['name', 'price', 'capacity', 'status', 'bed_type_id', 'type_of_room_id', 'number_of_rooms','description','guest_house_id','user_id'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->width(1200)
        ->height(1200);
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

    public function bedType(){
        return $this->belongsTo(BedType::class,'bed_type_id');
    }

    public function roomType(){
        return $this->belongsTo(TypeOfRoom::class,'type_of_room_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guestHouse(){
        return $this->belongsTo(GuestHouse::class);
    }



}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;

class GuestHouse extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public $table = 'guest_houses';

    protected $appends = [
        'photos', 'thumbnail'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'deleted_at',
        'wifi',
        'active',
        'day_has',
        'real_day',
        'spend_day',
        'created_by_id',
    ];

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

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }


    public function getThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('photos', 'thumb');
    }


    // --------------------------like-----------------------------
    public function likeRoom()
    {
        return $this->hasMany(LikeGuesthouse::class, 'guestHouse_id');
    }

    public function countLikes()
    {
        return $this->hasMany(Like::class, 'guestHouse_id')->count();
    }

    public function getAllLike()
    {
        return $this->hasMany(Like::class, 'guestHouse_id');
    }

    public function commentFeedback()
    {
        return $this->hasMany(CommentFeedback::class, 'guestHouse_id');
    }

    public function create_by()
    {
        return $this->hasMany(User::class, 'created_by_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\OpeningHours\OpeningHours;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;

class GuestHouse extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;

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
        'active',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'latitude',
        'longitude',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->width(1200)
        ->height(1200);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class);
    // }

    // public function days()
    // {
    //     return $this->belongsToMany(Day::class)->withPivot('from_hours', 'from_minutes', 'to_hours', 'to_minutes');
    // }

    public function getPhotosAttribute()
{
    return $this->getMedia('photos')->map(function ($media) {
        return [
            'url' => $media->getUrl(),
            'thumbnail' => $media->getUrl('thumb'),
        ];
    });
}

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getWorkingHoursAttribute()
    {
        $hours = $this->days
            ->pluck('pivot', 'name')
            ->map(function($pivot) {
                return [
                    $pivot['from_hours'].':'.$pivot['from_minutes'].'-'.$pivot['to_hours'].':'.$pivot['to_minutes']
                ];
            });

        return OpeningHours::create($hours->toArray());
    }

    public function getThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('photos', 'thumb');
    }

    // public function scopeSearchResults($query)
    // {
    //     return $query->where('active', 1)
    //         ->when(request()->filled('search'), function($query) {
    //             $query->where(function($query) {
    //                 $search = request()->input('search');
    //                 $query->where('name', 'LIKE', "%$search%")
    //                     ->orWhere('description', 'LIKE', "%$search%")
    //                     ->orWhere('address', 'LIKE', "%$search%");
    //             });
    //         })
    //         ->when(request()->filled('category'), function($query) {
    //             $query->whereHas('categories', function($query) {
    //                 $query->where('id', request()->input('category'));
    //             });
    //         });
    // }
}

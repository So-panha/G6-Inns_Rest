<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeGuesthouse extends Model
{
    use HasFactory;
    protected $table = 'likes_guesthouse';
    protected $guarded = ['id'];

    
    public function roomLikes()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    public function userNormal()
    {
        return $this->belongsTo(UserNormal::class, 'userNormal_id');
    }

    public function guestHouse()
    {
        return $this->belongsTo(GuestHouse::class, 'guestHouse_id');
    }
}

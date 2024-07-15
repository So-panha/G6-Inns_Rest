<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoomUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'number_of_rooms',
        'departure_date',
        'arrival_date',
        'user_id',
        'room_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
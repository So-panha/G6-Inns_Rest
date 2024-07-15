<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingUserRooms extends Model
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

// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class BookingUserRoom extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'first_name', 'last_name', 'email', 'phone_number', 'price',
//         'number_of_rooms', 'departure_date', 'arrival_date', 'user_id', 'room_id',
//     ];

//     // Define relationships
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function room()
//     {
//         return $this->belongsTo(Room::class);
//     }
// }

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingUserRooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_of_rooms',
        'departure_date',
        'arrival_date',
        'paymented',
        'user_id',
        'room_id',
        'create_by_id',
        'checked'
    ];


    public function user()
    {
        return $this->belongsTo(UserNormal::class,'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');
    }


    public static function list($params)
    {

        $list = self::query();

        if (isset($params['searchDate']) && filled($params['searchDate'])) {
            $list->where('created_at', 'LIKE', '%' . $params['searchDate'] . '%');
        }

        return $list->get();
    }

    public function create_by()
{
    return $this->belongsTo(UserNormal::class, 'create_by_id');
}
}

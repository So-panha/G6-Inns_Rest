<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['guest_house_id', 'amount', 'date_paid', 'user_id'];

    public function guestHouse()
    {
        return $this->belongsTo(GuestHouse::class, 'guest_house_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Use for searching
    public static function list($params)
    {

        $list = self::query();

        if (isset($params['searchDate']) && filled($params['searchDate'])) {
            $list->where('date_paid', 'LIKE', '%' . $params['searchDate'] . '%');
        }

        return $list->get();
    }

}

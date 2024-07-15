<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentFeedback extends Model
{
    use HasFactory;

    protected $table = 'comment_feedback';
    protected $guarded = ['id'];

    public function guestHouse()
    {
        return $this->belongsTo(GuestHouse::class, 'guestHouse_id');
    }

    public function userNormal()
    {
        return $this->belongsTo(UserNormal::class, 'userNormal_id');
    }
}

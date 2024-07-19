<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestAccountService extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id', 'image_1', 'image_2', 'message', 'status','response'];
}

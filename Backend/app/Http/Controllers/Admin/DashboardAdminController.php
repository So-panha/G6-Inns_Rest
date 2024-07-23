<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNormal;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    //Get total numbers of users service
    public function getTotalUsersService(){
        $userService = User::all();
        return response()->json(['success' => true, 'data' => $userService]);
    }

    // Get total numbers of users normal
    public function getTotalUsersNormal(){
        $userNormal = UserNormal::all();
        return response()->json(['success' => true, 'data' => $userNormal]);
    }

    // Get total numbers profit
    public function getTotalProfit(){
        $profit = Transaction::all();
        return response()->json(['success' => true, 'data' => $profit]);
    }
}

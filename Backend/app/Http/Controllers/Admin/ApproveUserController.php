<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestAccountService;
use Illuminate\Http\Request;

class ApproveUserController extends Controller
{
    //
    public function index()
    {
        // Get data requst account
        $accountRequests = RequestAccountService::all()->where('response',0);
        return view('approveUser.tables', compact('accountRequests'));
    }


    // Approve Request Account Service
    public function approve(Request $request){
        $accountRequests = RequestAccountService::findOrFail($request->id);
        $accountRequests->update(['response' => 1, 'status'=> '1']);
        return response()->json(['succss'=>true, 'data' => $accountRequests]);
    }

    // Reject Request Account Service
    public function reject(Request $request){

        $accountRequests = RequestAccountService::findOrFail($request->id);
        $accountRequests->update(['response' => 1, 'status'=> '0']);
        return response()->json(['succss'=>true, 'data' => $accountRequests]);
    }
}

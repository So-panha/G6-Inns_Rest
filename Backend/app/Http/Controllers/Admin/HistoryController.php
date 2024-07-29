<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingUserRooms;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // You can pass data to the view if needed
        $this->params = $request->only('searchDate');
        $allHistories = BookingUserRooms::list($this->params);


        return view('history.index', compact('allHistories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function TotalIncome()
    {
        //
         //
        //Get user ID
        $userID = auth()->user()->id;

        // Check booking for the user
        $totalIncome = BookingUserRooms::all()->where('create_by_id', $userID);

        return response()->json(['success' => true, 'data' => $totalIncome]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

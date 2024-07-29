<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $QRCode = QRCode::where('user_id', $id)->first();
        return response()->json(['message' => true, 'QR_code' => $QRCode]);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use App\Traits\uploadImage;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    //
    use uploadImage;
    public function checkQRCode()
    {
        return view('dashboard.qrcode');
    }

    public function createQR(Request $request)
    {

        try {
            // Get user id
            $user_id = Auth()->user()->id;

            // Account request
            $QRCodeData = [
                'user_id' => $user_id,
            ];

            // Save image in storage
            if ($request->hasFile('QRCode')) {
                if ($QRImage = $this->saveImageQR($request->QRCode)) {
                    $QRCodeData['qr_codes'] = '/QRImageFiles/' . $QRImage;
                }
                // Save request to database

                QRCode::create($QRCodeData);
                return redirect()->route('admin.guest-houses.index')->with('message', 'Upload successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.guest-houses.index')->with('error', 'Failed to Upload request. Please try again.');
        }
    }
}

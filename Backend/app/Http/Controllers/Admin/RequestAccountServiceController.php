<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAccountServiceRequest;
use App\Models\RequestAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestAccountServiceController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth()->user()->id;
        $document = RequestAccountService::all()->where('user_id', $user_id)->where('response', 0)->first();
        $response = RequestAccountService::all()->where('user_id', $user_id)->where('response', 1)->where('status',0)->first();
        return view('RegisterToUser.register', compact('document','response'));
    }

    public function store(RequestAccountServiceRequest $request)
    {
        try {
            $image = $request->image;
            $name = time() . '_' . $image->getClientOriginalName();
            $filePathImage = 'document/' . $name;
            Storage::disk('public')->put($filePathImage, file_get_contents($image));

            $identity = $request->identity;
            $name = time() . '_' . $identity->getClientOriginalName();
            $filePathIdentity = 'document/' . $name;
            Storage::disk('public')->put($filePathIdentity, file_get_contents($identity));

            $user_id = Auth()->user()->id;
            RequestAccountService::create([
                'user_id' => $user_id,
                'image_1' => $filePathImage,
                'image_2' => $filePathIdentity,
                'response' => 0,
                'message' => $request->message,
            ]);

            return redirect()->route('admin.request-account-service.index');
        } catch (\Exception $e) {
            return redirect()->route('admin.request-account-service.index')->with('error', 'Failed to submit request. Please try again.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAccountServiceRequest;
use App\Models\RequestAccountService;
use App\Traits\uploadImage;
use Illuminate\Http\Request;

class RequestAccountServiceController extends Controller
{
    //
    use uploadImage;
    public function index()
    {
        $user_id = Auth()->user()->id;
        $document = RequestAccountService::all()->where('user_id', $user_id)->where('response', 0)->first();
        $response = RequestAccountService::all()->where('user_id', $user_id)->where('response', 1)->where('status', 0)->first();
        return view('RegisterToUser.register', compact('document', 'response'));
    }

    public function store(RequestAccountServiceRequest $request)
    {
        try {
            // Get user id
            $user_id = Auth()->user()->id;

            // Account request
            $accountRequest = [
                'user_id' => $user_id,
                'response' => 0,
                'message' => $request->message,
            ];

            // Save image in storage
            if ($request->hasFile('identity') && $request->hasFile('image')) {
                if($identity = $this->saveImageDocument($request->identity)){
                    $accountRequest['image_1'] = '/Document/'.$identity;

                }
                if($image = $this->saveImageDocument($request->image)){
                    $accountRequest['image_2'] = '/Document/'.$image;
                }

                // Save request to database
                RequestAccountService::create($accountRequest);
            }
            return redirect()->route('admin.request-account-service.index')->with('message', 'Submit successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.request-account-service.index')->with('message', 'Failed to submit request. Please try again.');
        }
    }
}

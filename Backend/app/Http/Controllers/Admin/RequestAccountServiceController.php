<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAccountServiceRequest;
use App\Models\RequestAccountService;
use App\Models\User;
use App\Traits\uploadImage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RequestAccountServiceController extends Controller
{
    //
    use uploadImage;
    public function index()
    {
        $user_id = Auth()->user()->id;
        $document = RequestAccountService::all()->where('user_id', $user_id)->where('response', 0)->first();
        $reject = RequestAccountService::all()->where('user_id', $user_id)->where('response', 1)->where('status', 0)->first();
        $approve = RequestAccountService::all()->where('user_id', $user_id)->where('response', 1)->where('status', 1)->first();
        return view('RegisterToUser.register', compact('document', 'approve', 'reject'));
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
                if ($identity = $this->saveImageDocument($request->identity)) {
                    $accountRequest['image_1'] = '/Document/' . $identity;

                }
                if ($image = $this->saveImageDocument($request->image)) {
                    $accountRequest['image_2'] = '/Document/' . $image;
                }

                // Save request to database
                RequestAccountService::create($accountRequest);
            }
            return redirect()->route('admin.request-account-service.index')->with('message', 'Submit successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.request-account-service.index')->with('message', 'Failed to submit request. Please try again.');
        }
    }

    public function startAccount(Request $request)
    {

        // Find ID user
        $user = User::find($request->user_id);

        // Remove the permission
        $user->revokePermissionTo(['Chat access', 'Chat user', 'Request_account_service access', 'Request_account_service create','Dashboard_service access', 'Dashboard access']);

        // Set permissions to user
        $user->givePermissionTo([

            'Chat access',
            'Chat user',

            'Dashboard access',
            'Dashboard_service access',

            'Mail access',
            'Mail edit',

            'Create_brance access',
            'Create_brance create',
            'Create_brance edit',
            'Create_brance delete',

            'Check_booking access',
            'Check_booking create',
            'Check_booking edit',
            'Check_booking delete',

            'Check_room access',
            'Check_room create',
            'Check_room edit',
            'Check_room delete',

            'history access',
            'history create',
            'history edit',
            'history delete',
        ]);

        return redirect()->route('admin.dashboard');
    }
}

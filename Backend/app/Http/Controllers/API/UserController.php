<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\ShowUserNormalResource;
use App\Http\Resources\UserNormalResource;
use App\Models\UserNormal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $userNormals = UserNormal::all();
        $userNormals = UserNormalResource::collection($userNormals);
        return response()->json([
            'users' => $userNormals
        ], 200);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $proImage = Str::random(32) . "." . $request->profile->getClientOriginalExtension();

            UserNormal::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'profile' => $proImage,
                'phoneNumber' => $request->phoneNumber
            ]);

            Storage::disk('public')->put($proImage, file_get_contents($request->profile));

            return response()->json([
                'message' => "User successfully created."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $userNormals = UserNormal::find($id);
        if (!$userNormals) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404);
        }
        $userNormals = new ShowUserNormalResource($userNormals);
        return response()->json([
            'user' => $userNormals
        ], 200);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $userNormals = UserNormal::find($id);
            if (!$userNormals) {
                return response()->json([
                    'message' => 'User Not Found.'
                ], 404);
            }
    
            // Update user data
            $userNormals->name = $request->name;
            $userNormals->email = $request->email;
            if ($request->password) {
                $userNormals->password = bcrypt($request->password);
            }
            $userNormals->phoneNumber = $request->phoneNumber;
    
            // Handle profile image update
            if ($request->hasFile('profile')) {
                $storage = Storage::disk('public');
    
                // Delete old profile image if exists and is not null
                if ($userNormals->profile && $storage->exists($userNormals->profile)) {
                    $storage->delete($userNormals->profile);
                }
    
                // Store new profile image
                $proImage = Str::random(32) . "." . $request->file('profile')->getClientOriginalExtension();
                $userNormals->profile = $proImage;
                $storage->put($proImage, file_get_contents($request->file('profile')));
    
                // Save user with updated profile image
                $userNormals->save();
            } else if ($request->profile === ' ' || $request->profile === null) {
                // Delete old profile image if exists and is not null
                if ($userNormals->profile && Storage::disk('public')->exists($userNormals->profile)) {
                    Storage::disk('public')->delete($userNormals->profile);
                }
                $userNormals->profile = null;
                $userNormals->save();
            } else {
                // Save user without updating profile image
                $userNormals->save();
            }
    
            // Return response
            return response()->json([
                'message' => "User successfully updated.",
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'message' => "Something went wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    public function destroy($id)
    {
        $userNormals = UserNormal::find($id);
        if (!$userNormals) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404);
        }

        $storage = Storage::disk('public');

        if ($storage->exists($userNormals->profile)) {
            $storage->delete($userNormals->profile);
        }

        $userNormals->delete();

        return response()->json([
            'message' => "User successfully deleted."
        ], 200);
    }
}

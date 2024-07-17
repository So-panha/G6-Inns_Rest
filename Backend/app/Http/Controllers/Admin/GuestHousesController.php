<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestHouse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuestHousesController extends Controller
{

    // list all data guesthouses
    public function index()
    {
        $guestHouses = GuestHouse::all();
        $mapGuestHouses = $guestHouses->makeHidden(['active', 'created_at', 'updated_at', 'deleted_at', 'created_by_id', 'photos', 'media']);
        $latitude = $guestHouses->average('latitude');
        $longitude = $guestHouses->average('longitude');
        return view('guesthouse.index', compact('guestHouses', 'mapGuestHouses', 'latitude', 'longitude'));
    }

    // Store multiple images in file
    public function storeMedia(Request $request)
    {

        // Validates file size
        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        // If width or height is preset - we are validating it as an image
        if ($request->has('width') || $request->has('height')) {
            $this->validate($request, [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    $request->input('width', 400000),
                    $request->input('height', 400000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during directory creation
            return response()->json([
               'message' => 'Error creating directory',
                'error' => $e->getMessage(),
            ], 500);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    // Store new guesthouse data
    public function store(Request $request)
    {
        $guestHouse = GuestHouse::create($request->all());
        foreach ($request->input('photos', []) as $file) {
            $guestHouse->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }
        return redirect()->back();
    }


    // Get to view data when click edit
    public function edit(GuestHouse $GuestHouse)
    {
        return view('guesthouse.edit', compact('GuestHouse'));
    }


    public function update(Request $request, GuestHouse $guestHouse)
    {

        $guestHouse->update($request->all());

        if (count($guestHouse->photos) > 0) {
            foreach ($guestHouse->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $guestHouse->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $guestHouse->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.guest-houses.index');
    }

    // delete guest house
    public function destroy(Request $request, string $id)
    {
        try {
            $validator = $request->validate([
                'password' => 'required|string|min:8',
            ]);
            $userId = Auth()->user()->id;
            $user = User::findOrFail($userId);
            if (Hash::check($request->password, $user->password)) {
                GuestHouse::find($id)->delete();
                return redirect()->back()->with('message', 'Delete succussfully');
            } else {
                return redirect()->back()->with('error', 'Your password is incorrect');
            }

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Your password is incorrect');
        }
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Day;
use App\Models\GuestHouse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class GuestHousesController extends Controller
{
    // Store multiple images in file

    public function index()
    {
        $guestHouses = GuestHouse::all();
        $mapGuestHouses = $guestHouses->makeHidden(['active', 'created_at', 'updated_at', 'deleted_at', 'created_by_id', 'photos', 'media']);
        $latitude = $guestHouses->average('latitude');
        $longitude = $guestHouses->average('longitude');
        return view('guesthouse.index', compact('guestHouses', 'mapGuestHouses', 'latitude', 'longitude'));
    }


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
                    $request->input('width', 100000),
                    $request->input('height', 100000)
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
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }



    public function store(Request $request)
    {
        $guestHouse = GuestHouse::create($request->all());

        // $hours = collect($request->input('from_hours'))->mapWithKeys(function($value, $id) use ($request) {
        //     return $value ? [
        //             $id => [
        //                 'from_hours'    => $value,
        //                 'from_minutes'  => $request->input('from_minutes.'.$id),
        //                 'to_hours'      => $request->input('to_hours.'.$id),
        //                 'to_minutes'    => $request->input('to_minutes.'.$id)
        //             ]
        //         ]
        //         : [];
        // });
        // $shop->days()->sync($hours);

        foreach ($request->input('photos', []) as $file) {
            $guestHouse->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        return redirect()->back();
    }

    // public function edit(GuestHouse $shop)
    // {
    //     abort_if(Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $categories = Category::all()->pluck('name', 'id');
    //     $days = Day::all();

    //     $shop->load('categories', 'created_by', 'days');

    //     return view('admin.shops.edit', compact('categories', 'shop', 'days'));
    // }

    // public function update(UpdateShopRequest $request, GuestHouse $guestHouse)
    // {
    //     if (!$request->active) {
    //         $request->merge([
    //             'active' => 0
    //         ]);
    //     }
    //     $guestHouse->update($request->all());
    //     $guestHouse->categories()->sync($request->input('categories', []));

    //     $hours = collect($request->input('from_hours'))->mapWithKeys(function ($value, $id) use ($request) {
    //         return $value ? [
    //             $id => [
    //                 'from_hours' => $value,
    //                 'from_minutes' => $request->input('from_minutes.' . $id),
    //                 'to_hours' => $request->input('to_hours.' . $id),
    //                 'to_minutes' => $request->input('to_minutes.' . $id)
    //             ]
    //         ]
    //             : [];
    //     });
    //     $guestHouse->days()->sync($hours);

    //     if (count($guestHouse->photos) > 0) {
    //         foreach ($guestHouse->photos as $media) {
    //             if (!in_array($media->file_name, $request->input('photos', []))) {
    //                 $media->delete();
    //             }
    //         }
    //     }

    //     $media = $guestHouse->photos->pluck('file_name')->toArray();

    //     foreach ($request->input('photos', []) as $file) {
    //         if (count($media) === 0 || !in_array($file, $media)) {
    //             $guestHouse->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
    //         }
    //     }

    //     return redirect()->route('admin.shops.index');
    // }




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

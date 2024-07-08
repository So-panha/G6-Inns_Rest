<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoomRequest;
use App\Models\BadType;
use App\Models\Room;
use App\Models\TypeOfRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
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
    public function store(CreateRoomRequest $request)
    {
        //
        if($request->input('photos', [])){
            $room = Room::create($request->all());
            foreach ($request->input('photos', []) as $file) {
                $room->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
            return redirect()->back()->with('message', 'Create successful');
        }else{
            return redirect()->back()->with('error', 'Your need to upload with image');
        }

    }

    // Media photos of the room
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


    /**
     * Display the specified resource.
     */
    public function show(string $guest_house_id)
    {
        $user_id = Auth()->user()->id;
        $rooms = Room::getColumns()
            ->where('guest_house_id', $guest_house_id)
            ->where('user_id', $user_id)->get();
        $bedTypes = BadType::all();
        $roomTypes = TypeOfRoom::all();
        return view('room.index',compact('bedTypes', 'roomTypes','rooms','guest_house_id','user_id'));
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

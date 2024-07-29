<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetAllRoomsResoure;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\LikeGuesthouse;
use Illuminate\Support\Facades\Auth;


class RoomAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rooms = Room::all();
        $rooms = GetAllRoomsResoure::collection($rooms);
        return response()->json(['meeesager' => true, 'rooms' => $rooms]);
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


    // ------------------Like Room to GuestHouse-------------------------

    // -------------------Room Likes---------------------------------------

    public function addLike(Request $request)
    {
        $roomId = $request->input('rooms_id');
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json([
                'error' => 'User not found',
                'message' => 'Authenticated user details not found'
            ], 404);
        }

        $userNormalId = $user->id;

        // Check if the user already liked this room
        $like = LikeGuesthouse::where('userNormal_id', $userNormalId)
            ->where('rooms_id', $roomId)
            ->first();

        if ($like) {
            // User already liked, so unlike
            $like->delete();
            $message = 'Unlike success';
        } else {
            // User hasn't liked yet, so like the room
            $newLike = LikeGuesthouse::create([
                'userNormal_id' => $userNormalId,
                'rooms_id' => $roomId,
            ]);
            $message = 'Like success';
        }

        // Retrieve guesthouse and count of likes
        $guestHouse = Room::find($roomId);
        $roomCount = $guestHouse->countLikes();

        return response()->json([
            "data" => [
                "user" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    // Include other user details as needed
                ],
                "like_status" => isset($newLike) ? 'liked' : 'unliked', // Optional: Return like status
                'roomCount' => $roomCount,
                'guesthouse' => $guestHouse,
            ],
            "message" => $message
        ]);
    }

    /**
     * Get all likes.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function removeLikes($id)
    {
        $like = LikeGuesthouse::find($id);
        if ($like) {
            $like->delete();
            return response()->json([
                "data" => true,
                "message" => "Unlike success"
            ]);
        } else {
            return response()->json([
                "data" => false,
                "message" => "Like not found"
            ]);
        }
    }

    public function getLikes($roomId)
    {
        try {
            // Retrieve likes for a specific room with relationships including guesthouse_id
            $likes = LikeGuesthouse::whereHas('room', function ($query) use ($roomId) {
                $query->where('id', $roomId);
            })
                ->with(['room' => function ($query) {
                    $query->with('guesthouse');
                }])
                ->get();

            // Calculate likes count per guesthouse
            $likesByGuesthouse = $likes->groupBy('room.guesthouse.id')->map(function ($group) {
                return $group->count();
            });

            // Total count of likes for the specified room
            $countLikes = $likes->count();

            return response()->json([
                'likes' => $likes,
                'count_likes' => $countLikes,
                'likes_by_guesthouse' => $likesByGuesthouse,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "data" => false,
                "message" => "Error occurred: " . $e->getMessage()
            ]);
        }
    }
}

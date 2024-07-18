<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetAllGuestHouseApiResource;
use App\Http\Resources\GetAllRoomsResoure;
use App\Http\Resources\ShowCommentFeedbackResource;
use App\Models\CommentFeedback;
use App\Models\GuestHouse;
use App\Models\Like;
use App\Models\Room;
use Illuminate\Http\Request;

class GuestHouseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allGuestHouse = GuestHouse::all();
        // $allGuestHouse = GuestHouse::with(['likes.userNormal', 'media'])->get();

        $allGuestHouse = GetAllGuestHouseApiResource::collection($allGuestHouse);
        return response()->json(['message' => true, 'data' => $allGuestHouse]);
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
        $rooms = Room::where('guest_house_id', [$id])->get();
        $rooms = GetAllRoomsResoure::collection($rooms);
        return response()->json(['meeesager' => true, 'rooms' => $rooms]);
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

    // public function showCommentFeedback($guestHouse_id)
    // {
    //     // Find the post
    //     $GuestHouse = GuestHouse::find($guestHouse_id);

    //     if (!$GuestHouse) {
    //         return response()->json(['success' => false, 'message' => 'Post not found'], 404);
    //     }

    //     // Retrieve comments for the post with user information
    //     $comment_feedback = CommentFeedback::where('guestHouse_id', $guestHouse_id)->with('UserNormal')->get();
    //     $comment_feedback = ShowCommentFeedbackResource::collection($comment_feedback);

    //     return response()->json(['post' => $GuestHouse, 'comment_feedback' =>  $comment_feedback], 200);
    // }

    // -------------------------------
    public function showCommentFeedback($guestHouse_id)
    {
        $guestHouse = GuestHouse::find($guestHouse_id);

        if (!$guestHouse) {
            return response()->json(['success' => false, 'message' => 'Guest house not found'], 404);
        }

        $comment_feedback = CommentFeedback::where('guestHouse_id', $guestHouse_id)->with('userNormal')->get();
        $comment_feedback = ShowCommentFeedbackResource::collection($comment_feedback);

        return response()->json(['guest_house' => $guestHouse, 'comment_feedback' =>  $comment_feedback], 200);
    }

    // -----------------like-------------------------------
    public function addLike(Request $request)
    {
        // Retrieve userNormal_id from the request
        $userNormalId = $request->input('userNormal_id');

        // Check if the userNormal_id is provided
        if (!$userNormalId) {
            return response()->json([
                "data" => false,
                "message" => "User not authenticated"
            ], 401);
        }

        try {
            $like = Like::where('userNormal_id', $userNormalId)
                ->where('guestHouse_id', $request->guestHouse_id)
                ->first();

            if ($like) {
                $like->delete();
                return response()->json([
                    "data" => true,
                    "message" => "Unlike success"
                ]);
            } else {
                $like = new Like();
                $like->userNormal_id = $userNormalId;
                $like->guestHouse_id = $request->guestHouse_id;

                if ($like->save()) {
                    return response()->json([
                        "data" => true,
                        // "message" => "liked it"
                        "like" => $like->load('userNormal') 
                    ]);
                } else {
                    return response()->json([
                        "data" => false,
                        "message" => "Something went wrong"
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                "data" => false,
                "message" => "Error occurred: " . $e->getMessage()
            ]);
        }
    }
}

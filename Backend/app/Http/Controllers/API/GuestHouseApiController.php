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
use App\Models\LikeGuesthouse;

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

    // -----------------like GuestHouse and Room------------------------------

      // -----------------like-------------------------------

      public function getLikeRoomFromGuesthouses($id)
      {
          // Fetch all rooms for the given guest house
          $rooms = Room::where('guest_house_id', $id)->get();
  
          // Transform rooms using resource (assuming you have a resource defined)
          $rooms = GetAllRoomsResoure::collection($rooms);
  
          // Fetch likes for these rooms
          $likes = LikeGuesthouse::whereIn('rooms_id', $rooms->pluck('id'))->get();
  
          $countLikes = $likes->count();
  
          // Return JSON response with likes and count
          return response()->json([
              'likes' => $rooms,
              'count_likes' => $countLikes
          ]);
      }
  
      public function countLikesByGuesthouse($guesthouseId)
      {
          try {
              // Retrieve likes count for rooms that belong to a specific guesthouse
              $likesCount = LikeGuesthouse::whereHas('room', function ($query) use ($guesthouseId) {
                  $query->where('guesthouse_id', $guesthouseId);
              })
                  ->count();
  
              return response()->json([
                  'guesthouse_id' => $guesthouseId,
                  'likes_count' => $likesCount,
              ]);
          } catch (\Exception $e) {
              return response()->json([
                  'error' => $e->getMessage()
              ], 500);
          }
      }
 
}

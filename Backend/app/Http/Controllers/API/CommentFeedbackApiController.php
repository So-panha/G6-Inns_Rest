<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentFeedbackResource;
use App\Http\Resources\ShowCommentFeedbackResource;
use App\Models\CommentFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentFeedbackApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment_feedback = CommentFeedback::with('userNormal', 'guestHouse')->get();
        $comment_feedback = CommentFeedbackResource::collection($comment_feedback);
        return response()->json(["success" => true, "comment_feedback" => $comment_feedback, "Message" => "comment list successfully"], 200);
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
    public function showComments($guestHouseId)
    {
        try {
            $comments = CommentFeedback::with('userNormal')
                ->where('guestHouse_id', $guestHouseId)
                // Order by created_at in descending order
                ->orderBy('created_at', 'desc') 
                ->get();

            $comments = ShowCommentFeedbackResource::collection($comments);

            return response()->json(['comments' => $comments], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch comments'], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'comment' => 'required|string|max:255',
        //     'userNormal_id' => 'required|exists:user_normals,id',
        // ]);

        $comment_feedback = CommentFeedback::find($id);
        if (!$comment_feedback) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment_feedback->comment = $request->comment;
        $comment_feedback->save();

        $comment_feedback->load('userNormal', 'guestHouse');
        return response()->json(["success" => true, "comment_feedback" => $comment_feedback, "Message" => "comment updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment_feedback = CommentFeedback::find($id);
        if (!$comment_feedback) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $comment_feedback->delete();
        return response()->json(['success' => true, 'message' => 'Comment removed']);
    }

    /**
     * Store a newly created comment on a post.
     */
    public function commentGuestHouse(Request $request)
    {

        // dd($request);
        $request->validate([
            'guestHouse_id' => 'required|exists:guest_houses,id',
            'comment' => 'required|string|max:255',
        ]);

        try {
            $comment_feedback = CommentFeedback::create([
                'guestHouse_id' => $request->guestHouse_id,
                'comment' => $request->comment,
                'userNormal_id' => Auth::id(),
            ]);
            $comment_feedback->load('guestHouse', 'userNormal');
            return response()->json(['comment_feedback' => $comment_feedback], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create comment', 'error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Proposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Proposition $proposition)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = $proposition->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->validated()['content'],
        ]);

        // Load the user relationship for the response
        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'display_name' => $comment->user->display_name,
                    'profile_picture_url' => $comment->user->profile_picture_url,
                ],
                'created_at' => $comment->created_at->diffForHumans(),
                'can_delete' => true, // User can delete their own comment
            ]
        ]);
    }

    public function destroy(Comment $comment)
    {
        // Check if user owns the comment or is admin
        if ($comment->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true
        ]);
    }
}

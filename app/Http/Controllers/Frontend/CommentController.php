<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Post $post)
    {
        // Check if the post is published
        if ($post->status !== 'published' ||
            !$post->published_at ||
            $post->published_at > now()) {
            abort(404);
        }

        $request->validate([
            'content' => 'required|string|min:5|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $post->id;

        // Set user_id if authenticated, otherwise it will be null for guest comments
        $comment->user_id = auth()->id();

        $comment->parent_id = $request->parent_id;
        $comment->status = 'pending'; // Will need to be approved by admin

        $comment->save();

        return redirect()->back()->with('success', 'Comment submitted successfully! It will appear after approval.');
    }
}
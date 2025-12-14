<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display posts by a specific author.
     */
    public function show(User $user, Request $request)
    {
        // Get posts by this author that are published
        $posts = Post::with(['user', 'categories', 'tags'])
            ->where('user_id', $user->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(10);

        return view('frontend.authors.show', compact(
            'user',
            'posts'
        ));
    }
}
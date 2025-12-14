<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display posts by tag.
     */
    public function show(Tag $tag, Request $request)
    {
        // Get posts with this tag that are published
        $posts = Post::with(['user', 'categories', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereHas('tags', function($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })
            ->latest('published_at')
            ->paginate(10);

        // Get all tags for navigation
        $tags = Tag::withCount('posts')->get();

        return view('frontend.tags.show', compact(
            'tag',
            'posts',
            'tags'
        ));
    }
}
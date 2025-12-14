<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle search queries.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query) {
            return redirect()->route('home');
        }

        // Search posts by title, content, or excerpt
        $posts = Post::with(['user', 'categories', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%")
                  ->orWhere('excerpt', 'LIKE', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(10)
            ->appends(['q' => $query]);

        // Get all categories for filtering
        $categories = Category::withCount('posts')->get();
        
        // Get all tags for filtering
        $tags = Tag::withCount('posts')->get();

        return view('frontend.search.results', compact(
            'posts',
            'query',
            'categories',
            'tags'
        ));
    }
}
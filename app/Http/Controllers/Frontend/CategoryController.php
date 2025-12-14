<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display posts by category.
     */
    public function show(Category $category, Request $request)
    {
        // Get posts in this category that are published
        $posts = Post::with(['user', 'categories', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereHas('categories', function($query) use ($category) {
                $query->where('categories.id', $category->id);
            })
            ->latest('published_at')
            ->paginate(10);

        // Get all categories for navigation
        $categories = Category::withCount('posts')->get();

        return view('frontend.categories.show', compact(
            'category',
            'posts',
            'categories'
        ));
    }
}
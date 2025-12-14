<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'categories', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(10);

        $featuredPosts = Post::with(['user', 'categories'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $popularCategories = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(10)
            ->get();

        $recentCategories = Category::latest()->take(5)->get();

        return view('home', compact(
            'posts',
            'featuredPosts',
            'popularCategories',
            'recentCategories'
        ));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'categories', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(10);

        return view('frontend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post (for authors).
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, ['author', 'admin'])) {
            abort(403, 'You do not have permission to create posts.');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('frontend.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Allow if user has 'author' or higher role
        if (!$user || !in_array($user->role, ['author', 'admin'])) {
            abort(403, 'You do not have permission to create posts.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_ids' => 'array|exists:categories,id',
            'tag_ids' => 'array|exists:tags,id',
            'status' => 'in:draft,published' // Authors can submit as draft initially
        ]);

        $validatedData['slug'] = $validatedData['slug'] ?? Str::slug($validatedData['title']);

        $validatedData['user_id'] = $user->id;

        $validatedData['status'] = $validatedData['status'] ?? 'draft';

        if ($user->role !== 'admin') {
            $validatedData['status'] = 'draft';
        }

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
            $validatedData['featured_image'] = $path;
        }

        $post = Post::create($validatedData);

        if (isset($validatedData['category_ids'])) {
            $post->categories()->attach($validatedData['category_ids']);
        }

        if (isset($validatedData['tag_ids'])) {
            $post->tags()->attach($validatedData['tag_ids']);
        }

        return redirect()->route('posts.show', $post->slug)
            ->with('success', 'Post created successfully! It will be reviewed before publishing.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Check if post is published
        // For unpublished posts, only the owner and admins can view them
        if ($post->status !== 'published' ||
            !$post->published_at ||
            $post->published_at > now()) {

            $user = Auth::user();

            // Allow if the current user is the post owner or an admin
            if (!$user || ($user->id !== $post->user_id && $user->role !== 'admin')) {
                abort(404);
            }
        }

        // Increment view count (only for published posts when viewed by non-owner)
        if ($post->status === 'published' && (!Auth::check() || Auth::id() !== $post->user_id)) {
            $post->increment('views_count');
        }

        // Load related posts in the same category
        $relatedPosts = Post::with(['user', 'categories'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function($query) use ($post) {
                $query->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->take(5)
            ->get();

        // Get approved comments for this post
        $comments = $post->comments()
            ->with('user', 'replies.user')
            ->whereNull('parent_id')
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('frontend.posts.show', compact(
            'post',
            'relatedPosts',
            'comments'
        ));
    }
}
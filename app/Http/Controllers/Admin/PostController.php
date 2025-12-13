<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with('user', 'categories')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->whereHas('categories', fn($q) => $q->where('categories.id', $request->category)))
            ->latest()
            ->paginate(10);

        return view('admin.post', compact('posts'));
    }

    public function create()
    {

        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:posts,slug',
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'           => 'required|in:draft,published,scheduled',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        if ($request->categories) {
            $post->categories()->attach($request->categories);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.post')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {

        return view('admin.post.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:posts,slug,' . $post->id,
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status'           => 'required|in:draft,published,scheduled',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        if ($request->hasFile(('featured_image'))) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update($data);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.post')->with('success', 'Post updated successfully.');

    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.post')->with('success', 'Post deleted successfully.');

    }

    public function show(Post $post)
    {

        return view('admin.post.show', compact('post'));
    }

}

@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Posts</h2>
    <a href="{{ route('admin.post.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Post</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 flex gap-4">
        <form method="GET" class="flex gap-2">
            <select name="status" class="border rounded px-3 py-2">
                <option value="">All Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
            </select>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filter</button>
        </form>
    </div>

    <table class="w-full">
        <thead class="border-b">
            <tr class="text-left">
                <th class="pb-3">Title</th>
                <th class="pb-3">Author</th>
                <th class="pb-3">Categories</th>
                <th class="pb-3">Status</th>
                <th class="pb-3">Date</th>
                <th class="pb-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr class="border-b">
                <td class="py-3">{{ Str::limit($post->title, 50) }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->categories->pluck('name')->join(', ') }}</td>
                <td><span class="px-2 py-1 text-xs rounded {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">{{ $post->status }}</span></td>
                <td>{{ $post->created_at->format('M d, Y') }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.post.show', $post) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('admin.post.edit', $post) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.post.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-4 text-center text-gray-500">No posts found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $posts->links() }}</div>
</div>
@endsection

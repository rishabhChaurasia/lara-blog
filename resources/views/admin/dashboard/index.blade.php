@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Posts</h3>
        <p class="text-3xl font-bold">{{ $stats['total_posts'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Published Posts</h3>
        <p class="text-3xl font-bold">{{ $stats['published_posts'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Users</h3>
        <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Pending Comments</h3>
        <p class="text-3xl font-bold">{{ $stats['total_pending_comments'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
        <div class="space-y-3">
            @forelse($stats['recent_posts'] as $post)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-medium">{{ Str::limit($post->title, 40) }}</p>
                        <p class="text-sm text-gray-500">{{ $post->user->name }}</p>
                    </div>
                    <span class="text-xs px-2 py-1 rounded {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $post->status }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500">No posts yet</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Recent Comments</h3>
        <div class="space-y-3">
            @forelse($stats['recent_comments'] as $comment)
                <div class="border-b pb-2">
                    <p class="text-sm">{{ Str::limit($comment->content, 60) }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $comment->user->name }} on {{ $comment->post->title }}</p>
                </div>
            @empty
                <p class="text-gray-500">No comments yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

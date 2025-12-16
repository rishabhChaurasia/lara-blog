@extends('layouts.admin')

@section('title', 'Comment Details')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold">Comment Details</h2>
            <p class="text-gray-600">Posted on {{ $comment->created_at->format('M d, Y \a\t H:i') }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.comment.edit', $comment) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</a>
            <a href="{{ route('admin.comment') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Back to Comments</a>
        </div>
    </div>

    <div class="mb-6">
        <span class="inline-block px-3 py-1 text-xs rounded {{ $comment->status === 'approved' ? 'bg-green-100 text-green-800' : ($comment->status === 'spam' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
            {{ ucfirst($comment->status) }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="font-medium text-gray-700 mb-2">User</h3>
            <p class="font-medium">{{ $comment->user->name }}</p>
            <p class="text-sm text-gray-600">{{ $comment->user->email }}</p>
        </div>

        <div>
            <h3 class="font-medium text-gray-700 mb-2">Post</h3>
            <a href="{{ route('admin.post.show', $comment->post) }}" class="text-blue-600 hover:underline">
                {{ $comment->post->title }}
            </a>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="font-medium text-gray-700 mb-2">Comment</h3>
        <div class="p-4 bg-gray-50 rounded border">
            <p class="text-gray-800">{{ $comment->content }}</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mt-8">
        @if($comment->status !== 'approved')
            <a href="{{ route('admin.comment.approve', $comment) }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Approve</a>
        @endif
        @if($comment->status !== 'spam')
            <a href="{{ route('admin.comment.spam', $comment) }}" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Mark as Spam</a>
        @endif
        <a href="{{ route('admin.comment') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Back to Comments</a>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Edit Comment')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Comment</h2>

    <form method="POST" action="{{ route('admin.comment.update', $comment) }}">
        @csrf
        @method('PUT')

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
            <h3 class="font-medium text-gray-700 mb-2">Original Comment</h3>
            <div class="p-4 bg-gray-50 rounded border">
                <p class="text-gray-800">{{ $comment->content }}</p>
            </div>
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
            <select name="status" id="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="pending" {{ old('status', $comment->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status', $comment->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="spam" {{ old('status', $comment->status) === 'spam' ? 'selected' : '' }}>Spam</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.comment.show', $comment) }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update Comment</button>
        </div>
    </form>
</div>
@endsection
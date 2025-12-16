@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold">Comments</h2>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4">
        <form method="GET" class="flex gap-2">
            <select name="status" class="border rounded px-3 py-2">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="spam" {{ request('status') == 'spam' ? 'selected' : '' }}>Spam</option>
            </select>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filter</button>
        </form>
    </div>

    <table class="w-full">
        <thead class="border-b">
            <tr class="text-left">
                <th class="pb-3">User</th>
                <th class="pb-3">Post</th>
                <th class="pb-3">Comment</th>
                <th class="pb-3">Status</th>
                <th class="pb-3">Date</th>
                <th class="pb-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
            <tr class="border-b">
                <td class="py-3">{{ $comment->user->name }}</td>
                <td>{{ Str::limit($comment->post->title, 30) }}</td>
                <td>{{ Str::limit($comment->content, 50) }}</td>
                <td><span class="px-2 py-1 text-xs rounded {{ $comment->status === 'approved' ? 'bg-green-100 text-green-800' : ($comment->status === 'spam' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">{{ $comment->status }}</span></td>
                <td>{{ $comment->created_at->format('M d, Y') }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.comment.show', $comment) }}" class="text-blue-500 hover:underline">View</a>
                    @if($comment->status !== 'approved')
                    <a href="{{ route('admin.comment.approve', $comment) }}" class="text-green-500 hover:underline">Approve</a>
                    @endif
                    <a href="{{ route('admin.comment.spam', $comment) }}" class="text-orange-500 hover:underline">Spam</a>
                    <form method="POST" action="{{ route('admin.comment.destroy', $comment) }}" onsubmit="return confirm('Delete this comment?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-4 text-center text-gray-500">No comments found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $comments->links() }}</div>
</div>
@endsection

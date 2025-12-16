@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <article class="bg-white overflow-hidden shadow sm:rounded-lg">
        @if($post->featured_image)
        <div class="h-96 overflow-hidden">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="p-6">
            <header class="mb-8">
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                        {{ $post->published_at->format('F d, Y') }}
                    </time>
                    <span class="mx-2">•</span>
                    <span class="text-indigo-600">{{ $post->user->name }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->views_count }} views</span>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($post->categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" 
                       class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>

                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}" 
                       class="text-sm text-gray-500 hover:text-indigo-600">
                        #{{ $tag->name }}
                    </a>
                    @endforeach
                </div>
            </header>

            <div class="prose prose-indigo max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>

    <!-- Related Posts Section -->
    @if($relatedPosts->count() > 0)
    <section class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($relatedPosts as $relatedPost)
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        <a href="{{ route('posts.show', $relatedPost->slug) }}" class="hover:text-indigo-600">
                            {{ $relatedPost->title }}
                        </a>
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ Str::limit($relatedPost->excerpt ?? $relatedPost->content, 100) }}
                    </p>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                        <time datetime="{{ $relatedPost->published_at->format('Y-m-d') }}">
                            {{ $relatedPost->published_at->format('M d, Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span>{{ $relatedPost->user->name }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Comments Section -->
    <section class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Comments</h2>
        
        @auth
        <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-8">
            @csrf
            <div class="shadow-sm border rounded-md p-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                <textarea id="content" name="content" rows="4" required
                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Post Comment
                    </button>
                </div>
            </div>
        </form>
        @else
        <div class="mb-8 text-center py-4 bg-gray-50 rounded-md">
            <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">log in</a> to leave a comment.</p>
        </div>
        @endauth

        <div class="space-y-6">
            @forelse($comments as $comment)
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between">
                    <div>
                        <span class="font-medium text-gray-900">{{ $comment->user ? $comment->user->name : 'Guest' }}</span>
                        <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <p class="mt-2 text-gray-700">{{ $comment->content }}</p>

                @auth
                <div class="mt-3">
                    <button type="button" 
                            class="text-sm text-indigo-600 hover:text-indigo-900 reply-btn" 
                            data-comment-id="{{ $comment->id }}">
                        Reply
                    </button>
                </div>
                @endauth
            </div>

            <!-- Replies -->
            @if($comment->replies->count() > 0)
            <div class="ml-8 mt-4 space-y-4">
                @foreach($comment->replies as $reply)
                <div class="bg-white border-l-4 border-indigo-500 pl-4 py-2">
                    <div class="flex justify-between">
                        <div>
                            <span class="font-medium text-gray-900">{{ $reply->user ? $reply->user->name : 'Guest' }}</span>
                            <span class="text-sm text-gray-500 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <p class="mt-1 text-gray-700">{{ $reply->content }}</p>
                </div>
                @endforeach
            </div>
            @endif
            @empty
            <p class="text-gray-500">No comments yet. Be the first to share your thoughts!</p>
            @endforelse
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const replyButtons = document.querySelectorAll('.reply-btn');
    replyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-comment-id');
            // In a real implementation, you would show a reply form here
            alert('Reply functionality would be implemented here. Comment ID: ' + commentId);
        });
    });
});
</script>
@endsection
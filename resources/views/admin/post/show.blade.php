@extends('layouts.admin')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
            <p class="text-gray-600">{{ $post->created_at->format('M d, Y \a\t H:i') }} by {{ $post->user->name }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.post.edit', $post) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</a>
            <a href="{{ route('admin.post') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Back to Posts</a>
        </div>
    </div>

    <div class="mb-6">
        <span class="inline-block px-3 py-1 text-xs rounded {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
            {{ ucfirst($post->status) }}
        </span>
        @if($post->published_at)
            <span class="ml-2 inline-block px-3 py-1 text-xs rounded bg-blue-100 text-blue-800">
                Published: {{ $post->published_at->format('M d, Y \a\t H:i') }}
            </span>
        @endif
    </div>

    @if($post->featured_image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full max-w-2xl h-64 object-cover rounded">
        </div>
    @endif

    @if($post->excerpt)
        <div class="mb-6 p-4 bg-gray-50 rounded">
            <h3 class="font-medium text-gray-700 mb-2">Excerpt</h3>
            <p>{{ $post->excerpt }}</p>
        </div>
    @endif

    <div class="mb-6">
        <h3 class="font-medium text-gray-700 mb-2">Content</h3>
        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="font-medium text-gray-700 mb-2">Categories</h3>
            <div class="flex flex-wrap gap-2">
                @forelse($post->categories as $category)
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">{{ $category->name }}</span>
                @empty
                    <p class="text-gray-500">No categories assigned</p>
                @endforelse
            </div>
        </div>

        <div>
            <h3 class="font-medium text-gray-700 mb-2">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @forelse($post->tags as $tag)
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm">{{ $tag->name }}</span>
                @empty
                    <p class="text-gray-500">No tags assigned</p>
                @endforelse
            </div>
        </div>
    </div>

    @if($post->meta_title || $post->meta_description || $post->meta_keywords)
        <div class="border-t pt-6">
            <h3 class="font-medium text-gray-700 mb-4">SEO Information</h3>
            
            @if($post->meta_title)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Meta Title</p>
                    <p class="font-medium">{{ $post->meta_title }}</p>
                </div>
            @endif

            @if($post->meta_description)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Meta Description</p>
                    <p class="font-medium">{{ $post->meta_description }}</p>
                </div>
            @endif

            @if($post->meta_keywords)
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Meta Keywords</p>
                    <p class="font-medium">{{ $post->meta_keywords }}</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
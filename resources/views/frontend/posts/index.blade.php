@extends('layouts.frontend')

@section('title', 'Blog Posts')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Latest Posts</h1>
        <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
            Discover our latest articles and insights
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <div class="bg-white overflow-hidden shadow rounded-lg">
            @if($post->featured_image)
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
            @endif
            
            <div class="p-6">
                <div class="flex items-center text-sm text-gray-500">
                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                        {{ $post->published_at->format('M d, Y') }}
                    </time>
                    <span class="mx-2">•</span>
                    <span class="text-indigo-600">{{ $post->user->name }}</span>
                </div>
                
                <div class="mt-2">
                    <h3 class="text-xl font-semibold text-gray-900">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-indigo-600">
                            {{ $post->title }}
                        </a>
                    </h3>
                    
                    <p class="mt-3 text-base text-gray-500">
                        {{ Str::limit($post->excerpt ?? $post->content, 120) }}
                    </p>
                </div>
                
                <div class="mt-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->categories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}" 
                           class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 flex items-center">
                        <div class="flex space-x-1">
                            @foreach($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}" 
                               class="text-sm text-gray-500 hover:text-indigo-600">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                        <div class="ml-auto text-sm text-gray-500">
                            {{ $post->views_count }} views
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <h3 class="text-lg font-medium text-gray-900">No posts found</h3>
            <p class="mt-1 text-gray-500">There are no published posts yet.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>
@endsection
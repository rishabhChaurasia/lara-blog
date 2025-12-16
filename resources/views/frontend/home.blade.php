@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center py-20">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
            Welcome to Our Blog
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-500">
            Discover insightful articles and stories on technology, lifestyle, and more.
        </p>
        <div class="mt-10">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                Browse Articles
            </a>
        </div>
    </div>

    <!-- Featured Posts Section -->
    @if($featuredPosts && $featuredPosts->count() > 0)
    <div class="py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">Featured Posts</h2>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Most popular articles on our blog
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
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
            @endforeach
        </div>
    </div>
    @endif

    <!-- Categories Section -->
    @if($popularCategories && $popularCategories->count() > 0)
    <div class="py-12 bg-gray-50">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">Popular Categories</h2>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Browse articles by category
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($popularCategories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" 
               class="flex flex-col items-center justify-center p-6 bg-white shadow rounded-lg hover:shadow-md transition-shadow duration-300">
                <h3 class="text-lg font-medium text-gray-900 text-center">{{ $category->name }}</h3>
                <p class="mt-2 text-sm text-gray-500">{{ $category->posts_count }} posts</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Recent Posts Section -->
    @if($posts && $posts->count() > 0)
    <div class="py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">Latest Posts</h2>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Recently published articles
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
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
            @endforeach
        </div>
        
        <div class="mt-12 text-center">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                View All Posts
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
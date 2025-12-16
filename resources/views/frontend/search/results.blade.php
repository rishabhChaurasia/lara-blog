@extends('layouts.frontend')

@section('title', 'Search Results for "' . $query . '"')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Search Results</h1>
        <p class="mt-3 text-xl text-gray-500">
            Found {{ $posts->total() }} results for "{{ $query }}"
        </p>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-3/4">
            @if($posts->count() > 0)
                <div class="space-y-8">
                    @foreach($posts as $post)
                    <div class="bg-white overflow-hidden shadow rounded-lg">
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
                            
                            <div class="mt-4 flex flex-wrap gap-2">
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
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <h3 class="text-lg font-medium text-gray-900">No results found</h3>
                    <p class="mt-1 text-gray-500">Sorry, we couldn't find any posts matching "{{ $query }}".</p>
                    <div class="mt-6">
                        <form method="GET" action="{{ route('search.index') }}" class="max-w-lg mx-auto">
                            <div class="flex">
                                <input type="text" name="q" value="{{ $query }}" 
                                       class="flex-grow rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                       placeholder="Search again...">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="md:w-1/4">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Refine Search</h3>
                <form method="GET" action="{{ route('search.index') }}">
                    <div class="mb-4">
                        <label for="q" class="block text-sm font-medium text-gray-700 mb-1">Search Term</label>
                        <input type="text" name="q" id="q" value="{{ $query }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Search
                    </button>
                </form>
            </div>

            <div class="mt-6 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Categories</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('categories.show', $category->slug) }}" 
                           class="flex items-center justify-between text-gray-600 hover:text-indigo-600">
                            <span>{{ $category->name }}</span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded-full">
                                {{ $category->posts_count }}
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-6 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Popular Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}" 
                       class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200">
                        {{ $tag->name }}
                        <span class="ml-1 bg-white text-xs rounded-full px-1.5 py-0.5">
                            {{ $tag->posts_count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
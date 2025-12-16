@extends('layouts.frontend')

@section('title', $user->name . ' - Author')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row items-start gap-8">
        <div class="md:w-1/4">
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <div class="flex justify-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center text-4xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="mt-1 text-gray-500">{{ $user->email }}</p>
                
                @if($user->bio)
                    <div class="mt-4">
                        <p class="text-gray-600">{{ $user->bio }}</p>
                    </div>
                @endif
                
                @php
                    $socialLinks = is_string($user->social_links) ? json_decode($user->social_links, true) : $user->social_links;
                @endphp
                
                @if($socialLinks)
                    <div class="mt-6 flex justify-center space-x-4">
                        @if(isset($socialLinks['facebook']) && $socialLinks['facebook'])
                        <a href="{{ $socialLinks['facebook'] }}" target="_blank" title="Facebook" class="text-blue-600 hover:text-blue-800">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        @endif
                        @if(isset($socialLinks['twitter']) && $socialLinks['twitter'])
                        <a href="{{ $socialLinks['twitter'] }}" target="_blank" title="Twitter" class="text-blue-400 hover:text-blue-600">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        @endif
                        @if(isset($socialLinks['linkedin']) && $socialLinks['linkedin'])
                        <a href="{{ $socialLinks['linkedin'] }}" target="_blank" title="LinkedIn" class="text-blue-700 hover:text-blue-900">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        @endif
                    </div>
                @endif
                
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Member since</span>
                        <span class="font-medium">{{ $user->created_at->format('F Y') }}</span>
                    </div>
                    <div class="mt-2 flex justify-between text-sm">
                        <span class="text-gray-500">Posts</span>
                        <span class="font-medium">{{ $posts->total() }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="md:w-3/4">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Posts by {{ $user->name }}</h2>
                <p class="mt-1 text-gray-600">{{ $posts->total() }} posts published</p>
            </div>
            
            @if($posts->count() > 0)
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

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <h3 class="text-lg font-medium text-gray-900">No posts found</h3>
                    <p class="mt-1 text-gray-500">{{ $user->name }} hasn't published any posts yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
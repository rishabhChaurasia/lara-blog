<x-frontend-layout>
    <!-- Hero Section -->
    @if($featuredPosts->isNotEmpty())
        @php
            $heroPost = $featuredPosts->first();
        @endphp
        <div class="relative bg-gray-900 overflow-hidden">
            <div class="absolute inset-0">
                @if($heroPost->featured_image)
                    <img class="w-full h-full object-cover" src="{{ Storage::url($heroPost->featured_image) }}" alt="{{ $heroPost->title }}">
                @else
                    <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1499750310159-52f0f834224a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80" alt="Blog background">
                @endif
                <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
            </div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">{{ $heroPost->title }}</h1>
                <p class="mt-6 text-xl text-gray-300 max-w-3xl">
                    {{ $heroPost->excerpt ?? Str::limit(strip_tags($heroPost->content), 150) }}
                </p>
                <div class="mt-10">
                    <a href="{{ route('posts.show', $heroPost->slug) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-white hover:bg-gray-50 md:py-4 md:text-lg">
                        Read Article
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Fallback Hero -->
        <div class="relative bg-indigo-800 overflow-hidden">
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Welcome to {{ config('app.name') }}</h1>
                <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                    Discover stories, thinking, and expertise from writers on any topic.
                </p>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                
                <!-- Category Section -->
                @if($popularCategories->isNotEmpty())
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Popular Topics</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($popularCategories as $category)
                                <a href="{{ route('categories.show', $category->slug) }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition">
                                    {{ $category->name }}
                                    <span class="ml-1 text-gray-400 text-xs">({{ $category->posts_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Latest Posts Grid -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Latest Articles</h2>
                    
                    @if($posts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                            @foreach($posts as $post)
                                <article class="flex flex-col bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            @if($post->featured_image)
                                                <img class="h-48 w-full object-cover" src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                                            @else
                                                <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="flex-1 p-6 flex flex-col justify-between">
                                        <div class="flex-1">
                                            @if($post->categories->isNotEmpty())
                                                <p class="text-sm font-medium text-indigo-600 mb-2">
                                                    @foreach($post->categories->take(1) as $category)
                                                        <a href="{{ route('categories.show', $category->slug) }}" class="hover:underline">{{ $category->name }}</a>
                                                    @endforeach
                                                </p>
                                            @endif
                                            <a href="{{ route('posts.show', $post->slug) }}" class="block mt-2">
                                                <p class="text-xl font-semibold text-gray-900">{{ $post->title }}</p>
                                                <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                                                </p>
                                            </a>
                                        </div>
                                        <div class="mt-6 flex items-center">
                                            <div class="flex-shrink-0">
                                                <span class="sr-only">{{ $post->user->name }}</span>
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-lg">
                                                    {{ substr($post->user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('authors.show', $post->user) }}" class="hover:underline">{{ $post->user->name }}</a>
                                                </p>
                                                <div class="flex space-x-1 text-sm text-gray-500">
                                                    <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('M d, Y') }}</time>
                                                    <span aria-hidden="true">&middot;</span>
                                                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        
                        <div class="mt-10">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No posts found</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new blog post.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 border-l border-gray-100 pl-8 hidden lg:block">
                @if($recentCategories->isNotEmpty())
                    <div class="mb-10">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Discover More</h3>
                        <ul class="space-y-3">
                            @foreach($recentCategories as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category->slug) }}" class="group flex items-center text-gray-600 hover:text-indigo-600">
                                        <span class="w-2 h-2 rounded-full bg-gray-300 mr-2 group-hover:bg-indigo-600 transition"></span>
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($featuredPosts->count() > 1)
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Trending</h3>
                        <div class="space-y-6">
                            @foreach($featuredPosts->skip(1) as $post)
                                <div class="flex flex-col">
                                    @if($post->categories->isNotEmpty())
                                        <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide mb-1">
                                            {{ $post->categories->first()->name }}
                                        </p>
                                    @endif
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-base font-medium text-gray-900 hover:text-indigo-600 transition">
                                        {{ $post->title }}
                                    </a>
                                    <p class="text-sm text-gray-500 mt-1">{{ $post->published_at->format('M d') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-frontend-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Author Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">My Posts</h1>
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Post
                        </a>
                    </div>

                    <!-- Search Form -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('dashboard') }}">
                            <div class="flex">
                                <input 
                                    type="text" 
                                    name="search" 
                                    placeholder="Search posts..." 
                                    value="{{ request('search') }}"
                                    class="flex-grow border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                <button 
                                    type="submit" 
                                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-r"
                                >
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Posts Table -->
                    @if($posts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-700 text-left">
                                        <th class="py-3 px-4 border-b">Title</th>
                                        <th class="py-3 px-4 border-b">Status</th>
                                        <th class="py-3 px-4 border-b">Created At</th>
                                        <th class="py-3 px-4 border-b">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 border-b">{{ Str::limit($post->title, 40) }}</td>
                                            <td class="py-3 px-4 border-b">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 
                                                       ($post->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 border-b">{{ $post->created_at->format('M d, Y') }}</td>
                                            <td class="py-3 px-4 border-b">
                                                <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                                                <a href="{{ route('posts.edit', $post->slug) }}" class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                                                <form method="POST" action="{{ route('posts.destroy', $post->slug) }}" class="inline-block" 
                                                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No posts found.</p>
                            <a href="{{ route('posts.create') }}" class="text-blue-500 hover:underline mt-2 inline-block">
                                Create your first post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@extends('layouts.admin')

@section('title', 'Media')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Media</h2>
    <a href="{{ route('admin.media.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Upload Media</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search files..." class="border rounded px-3 py-2 flex-1">
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Search</button>
        </form>
    </div>

    <div class="grid grid-cols-4 gap-4">
        @forelse($medias as $media)
        <div class="border rounded p-4">
            @if(str_contains($media->file_type, 'image'))
            <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->alt_text }}" class="w-full h-32 object-cover rounded mb-2">
            @else
            <div class="w-full h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                <span class="text-gray-500">{{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}</span>
            </div>
            @endif
            <p class="text-sm font-medium truncate">{{ $media->file_name }}</p>
            <p class="text-xs text-gray-500">{{ number_format($media->file_size / 1024, 2) }} KB</p>
            <div class="flex gap-2 mt-2">
                <a href="{{ route('admin.media.edit', $media) }}" class="text-yellow-500 text-sm hover:underline">Edit</a>
                <form method="POST" action="{{ route('admin.media.destroy', $media) }}" onsubmit="return confirm('Delete this file?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-4 py-8 text-center text-gray-500">No media files found</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $medias->links() }}</div>
</div>
@endsection

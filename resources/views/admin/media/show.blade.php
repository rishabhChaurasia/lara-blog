@extends('layouts.admin')

@section('title', $media->file_name)

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold">{{ $media->file_name }}</h2>
            <p class="text-gray-600">Uploaded on {{ $media->created_at->format('M d, Y \a\t H:i') }} by {{ $media->user->name }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.media.edit', $media) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</a>
            <a href="{{ route('admin.media') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Back to Media</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="font-medium text-gray-700 mb-2">File Preview</h3>
            <div class="border rounded p-4">
                @if(str_contains($media->file_type, 'image'))
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->alt_text }}" class="w-full h-64 object-contain rounded">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded flex items-center justify-center">
                        <span class="text-gray-500 text-2xl">{{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <h3 class="font-medium text-gray-700 mb-2">File Information</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">File Name</p>
                    <p class="font-medium">{{ $media->file_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">File Type</p>
                    <p class="font-medium">{{ $media->file_type }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">File Size</p>
                    <p class="font-medium">{{ number_format($media->file_size / 1024, 2) }} KB</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Upload Date</p>
                    <p class="font-medium">{{ $media->created_at->format('M d, Y \a\t H:i') }}</p>
                </div>
                @if($media->alt_text)
                    <div>
                        <p class="text-sm text-gray-600">Alt Text</p>
                        <p class="font-medium">{{ $media->alt_text }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-2">
        <a href="{{ asset('storage/' . $media->file_path) }}" target="_blank" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">View Full Size</a>
        <a href="{{ asset('storage/' . $media->file_path) }}" download class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Download</a>
        <a href="{{ route('admin.media') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Back to Media</a>
    </div>
</div>
@endsection
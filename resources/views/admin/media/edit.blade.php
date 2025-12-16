@extends('layouts.admin')

@section('title', 'Edit Media')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Media</h2>

    <form method="POST" action="{{ route('admin.media.update', $media) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <h3 class="font-medium text-gray-700 mb-2">Current File</h3>
            <div class="border rounded p-4">
                @if(str_contains($media->file_type, 'image'))
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->alt_text }}" class="w-full max-w-xs h-32 object-cover rounded mb-2">
                @else
                    <div class="w-full max-w-xs h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                        <span class="text-gray-500">{{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}</span>
                    </div>
                @endif
                <p class="text-sm font-medium">{{ $media->file_name }}</p>
                <p class="text-xs text-gray-500">{{ number_format($media->file_size / 1024, 2) }} KB</p>
            </div>
        </div>

        <div class="mb-6">
            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Replace File</label>
            <input type="file" name="file" id="file"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <p class="mt-1 text-sm text-gray-500">Accepted formats: jpeg, png, jpg, gif, webp, pdf, doc, docx. Max size: 10MB</p>
            @error('file')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
            <input type="text" name="alt_text" id="alt_text" value="{{ old('alt_text', $media->alt_text) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            @error('alt_text')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.media') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update Media</button>
        </div>
    </form>
</div>
@endsection
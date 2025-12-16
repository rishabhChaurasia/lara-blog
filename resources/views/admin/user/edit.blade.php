@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <form method="POST" action="{{ route('admin.user.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                <select name="role" id="role" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                    <option value="author" {{ old('role', $user->role) === 'author' ? 'selected' : '' }}>Author</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
            <input type="file" name="avatar" id="avatar"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            @error('avatar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            
            @if($user->avatar)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current avatar:</p>
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover mt-1">
                </div>
            @endif
        </div>

        <div class="mb-6">
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" id="bio" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @php
            $socialLinks = is_string($user->social_links) ? json_decode($user->social_links, true) : $user->social_links;
        @endphp

        <div class="mb-6">
            <label for="social_links[facebook]" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
            <input type="url" name="social_links[facebook]" id="social_links[facebook]" value="{{ old('social_links.facebook', $socialLinks['facebook'] ?? '') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="social_links[twitter]" class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
            <input type="url" name="social_links[twitter]" id="social_links[twitter]" value="{{ old('social_links.twitter', $socialLinks['twitter'] ?? '') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="social_links[linkedin]" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
            <input type="url" name="social_links[linkedin]" id="social_links[linkedin]" value="{{ old('social_links.linkedin', $socialLinks['linkedin'] ?? '') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.user') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update User</button>
        </div>
    </form>
</div>
@endsection
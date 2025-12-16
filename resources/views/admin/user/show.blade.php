@extends('layouts.admin')

@section('title', $user->name)

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.user.edit', $user) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</a>
            <a href="{{ route('admin.user') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Back to Users</a>
        </div>
    </div>

    <div class="mb-6">
        <span class="inline-block px-3 py-1 text-xs rounded bg-blue-100 text-blue-800">
            {{ ucfirst($user->role) }}
        </span>
        <span class="ml-2 inline-block px-3 py-1 text-xs rounded bg-gray-100 text-gray-800">
            Joined: {{ $user->created_at->format('M d, Y') }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="text-center">
            <div class="mx-auto">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover mx-auto">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center mx-auto text-4xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Role</p>
                    <p class="font-medium">{{ ucfirst($user->role) }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Member Since</p>
                    <p class="font-medium">{{ $user->created_at->format('F j, Y') }}</p>
                </div>
                
                @if($user->last_login_at)
                    <div>
                        <p class="text-sm text-gray-600">Last Login</p>
                        <p class="font-medium">{{ $user->last_login_at->format('F j, Y \a\t H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($user->bio)
        <div class="mb-6 p-4 bg-gray-50 rounded">
            <h3 class="font-medium text-gray-700 mb-2">Bio</h3>
            <p>{{ $user->bio }}</p>
        </div>
    @endif

    @php
        $socialLinks = is_string($user->social_links) ? json_decode($user->social_links, true) : $user->social_links;
    @endphp

    @if($socialLinks && (isset($socialLinks['facebook']) || isset($socialLinks['twitter']) || isset($socialLinks['linkedin'])))
        <div class="border-t pt-6">
            <h3 class="font-medium text-gray-700 mb-4">Social Links</h3>
            <div class="flex flex-wrap gap-4">
                @if(isset($socialLinks['facebook']) && $socialLinks['facebook'])
                    <a href="{{ $socialLinks['facebook'] }}" target="_blank" class="text-blue-600 hover:underline">
                        Facebook
                    </a>
                @endif
                @if(isset($socialLinks['twitter']) && $socialLinks['twitter'])
                    <a href="{{ $socialLinks['twitter'] }}" target="_blank" class="text-blue-400 hover:underline">
                        Twitter
                    </a>
                @endif
                @if(isset($socialLinks['linkedin']) && $socialLinks['linkedin'])
                    <a href="{{ $socialLinks['linkedin'] }}" target="_blank" class="text-blue-700 hover:underline">
                        LinkedIn
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
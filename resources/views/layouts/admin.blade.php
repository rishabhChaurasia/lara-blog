<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0 min-h-screen">
            <div class="p-4 border-b border-gray-700">
                <h2 class="text-xl font-bold">{{ config('app.name') }}</h2>
                <p class="text-xs text-gray-400 mt-1">Admin Panel</p>
            </div>
            <nav class="mt-4">
                <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">Dashboard</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.post') }}" :active="request()->routeIs('admin.post*')">Posts</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.category') }}" :active="request()->routeIs('admin.category*')">Categories</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.tag') }}" :active="request()->routeIs('admin.tag*')">Tags</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.comment') }}" :active="request()->routeIs('admin.comment*')">Comments</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.media') }}" :active="request()->routeIs('admin.media*')">Media</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.user') }}" :active="request()->routeIs('admin.user*')">Users</x-admin-nav-link>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h1 class="text-2xl font-semibold">@yield('title', 'Dashboard')</h1>
                    <div class="flex items-center gap-4">
                        <span>{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

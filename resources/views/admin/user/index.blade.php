@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Users</h2>
    <a href="{{ route('admin.user.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create User</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-4 flex gap-2">
        <form method="GET" class="flex gap-2 flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="border rounded px-3 py-2 flex-1">
            <select name="role" class="border rounded px-3 py-2">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="author" {{ request('role') == 'author' ? 'selected' : '' }}>Author</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filter</button>
        </form>
    </div>

    <table class="w-full">
        <thead class="border-b">
            <tr class="text-left">
                <th class="pb-3">Avatar</th>
                <th class="pb-3">Name</th>
                <th class="pb-3">Email</th>
                <th class="pb-3">Role</th>
                <th class="pb-3">Joined</th>
                <th class="pb-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="border-b">
                <td class="py-3">
                    @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full">
                    @else
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">{{ substr($user->name, 0, 1) }}</div>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">{{ $user->role }}</span></td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.user.show', $user) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('admin.user.edit', $user) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.user.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-4 text-center text-gray-500">No users found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection

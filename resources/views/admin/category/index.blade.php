@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Categories</h2>
    <a href="{{ route('admin.category.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Category</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full">
        <thead class="border-b">
            <tr class="text-left">
                <th class="pb-3">Image</th>
                <th class="pb-3">Name</th>
                <th class="pb-3">Slug</th>
                <th class="pb-3">Description</th>
                <th class="pb-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="border-b">
                <td class="py-3"><img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded"></td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ Str::limit($category->description, 50) }}</td>
                <td class="flex gap-2 py-3">
                    <a href="{{ route('admin.category.edit', $category) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.category.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="py-4 text-center text-gray-500">No categories found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>
@endsection

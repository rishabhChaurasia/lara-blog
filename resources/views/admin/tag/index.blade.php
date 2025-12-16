@extends('layouts.admin')

@section('title', 'Tags')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Tags</h2>
    <a href="{{ route('admin.tag.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Tag</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full">
        <thead class="border-b">
            <tr class="text-left">
                <th class="pb-3">Name</th>
                <th class="pb-3">Slug</th>
                <th class="pb-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
            <tr class="border-b">
                <td class="py-3">{{ $tag->name }}</td>
                <td>{{ $tag->slug }}</td>
                <td class="flex gap-2 py-3">
                    <a href="{{ route('admin.tag.edit', $tag) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.tag.destroy', $tag) }}" onsubmit="return confirm('Delete this tag?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="py-4 text-center text-gray-500">No tags found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $tags->links() }}</div>
</div>
@endsection

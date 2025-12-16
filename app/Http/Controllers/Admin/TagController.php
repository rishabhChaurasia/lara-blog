<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {

        $tags = Tag::paginate(10);

        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tags,slug',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        Tag::create($data);

        return redirect()->route('admin.tag')->with('success', 'Tag created successfully');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tags,slug,' . $tag->id,
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $tag->update($data);

        return redirect()->route('admin.tag')->with('success', 'Tag updated successfully');
    }


    public function destroy(Tag $tag){
        $tag->delete();
        return redirect()->route('admin.tag')->with('success', 'Tag deleted successfully');
    }
}

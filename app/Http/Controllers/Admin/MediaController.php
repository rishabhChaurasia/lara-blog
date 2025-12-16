<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {

        $medias = Media::with('user')
            ->when($request->search, function ($query, $search) {
                return $query->where('file_name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.media.index', compact('medias'));
    }

    public function create()
    {

        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'file'     => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx|max:10240',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $file              = $request->file('file');
            $data['file_path'] = $file->store('media', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getMimeType();
            $data['file_size'] = $file->getSize();
        }

        unset($data['file']);
        $data['user_id'] = auth()->id();

        Media::create($data);

        return redirect()->route('admin.media')->with('success', 'Media created successfully');
    }

    public function edit(Media $media)
    {

        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $data = $request->validate([
            'file'     => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,pdf,doc,docx|max:10240',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {

            if ($media->file_path) {
                Storage::disk('public')->delete($media->file_path);
            }

            $file              = $request->file('file');
            $data['file_path'] = $file->store('media', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getMimeType();
            $data['file_size'] = $file->getSize();
        }

        unset($data['file']);

        $media->update($data);

        return redirect()->route('admin.media')->with('success', 'Media updated successfully');
    }

    public function destroy(Media $media)
    {

        if ($media->file_path) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('admin.media')->with('success', 'Media deleted successfully');
    }

    public function show(Media $media)
    {
        return view('admin.media.show', compact('media'));
    }

}

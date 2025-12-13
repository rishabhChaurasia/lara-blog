<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::query()
            ->with('post', 'user')
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->latest()
            ->paginate(10);

        return view('admin.comment', compact('comments'));
    }

    public function edit(Comment $comment)
    {

        return view('admin.comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,spam',
        ]);

        $comment->update($data);

        return redirect()->route('admin.comment')->with('success', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comment')->with('success', 'Comment deleted successfully');
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);

        return redirect()->route('admin.comment')->with('success', 'Comment approved successfully');
    }

    public function spam(Comment $comment)
    {
        $comment->update(['status' => 'spam']);

        return redirect()->route('admin.comment')->with('success', 'Comment marked as spam successfully');
    }

    public function show(Comment $comment)
    {
        return view('admin.comment.show', compact('comment'));
    }

}

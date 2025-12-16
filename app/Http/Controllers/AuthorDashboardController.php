<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get posts created by the current user
        $postsQuery = Post::where('user_id', $user->id);
        
        // Add search/filter capabilities if needed
        if ($request->has('search')) {
            $postsQuery->where('title', 'like', '%' . $request->search . '%');
        }
        
        $posts = $postsQuery->paginate(10);
        
        return view('author.dashboard', compact('posts'));
    }
}
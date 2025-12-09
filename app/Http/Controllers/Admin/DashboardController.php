<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        // kpi card stats
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'total_users' => User::count(),
            'total_authors' => User::where('role', 'author')->count(),
            'total_comments' => Comment::count(),
            'total_pending_comments' => Comment::where('status', 'pending')->count(),
            'total_categories' => Category::count(),
            'recent_posts' => Post::with('author')->latest()->take(5)->get(),
            'recent_comments' => Comment::with(['post', 'user'])->latest()->take(5)->get()
        ];

        // bar graph stats
        $chartData = $this->getPostChartData($startDate, $endDate);


        return view('admin.dashboard', compact('stats', 'chartData'));
    }


    private function getPostChartData($startDate = null, $endDate = null)
    {
        $query = Post::selectRaw('status, DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('status', 'DATE(created_at)')
            ->orderBy('date');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {

            $query->whereDate('created_at', '<=', $endDate);
        }

        $results = $query->get();

        // Reorganize the data for the chart
        $dates = $results->pluck('date')->unique()->sort()->values();
        $data = [];

        foreach ($dates as $date) {
            $dayData = $results->where('date', $date)->pluck('count', 'status')->toArray();
            $data[] = [
                'date' => $date,
                'draft' => $dayData['draft'] ?? 0,
                'published' => $dayData['published'] ?? 0,
                'scheduled' => $dayData['scheduled'] ?? 0,
            ];
        }

        return [
            'dates' => $dates->toArray(),
            'data' => $data
        ];
    }

}
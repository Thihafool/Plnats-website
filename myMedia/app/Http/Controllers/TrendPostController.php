<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post page
    public function index()
    {
        $post = ActionLog::select('action_logs.*', 'posts.*', DB::raw('COUNT(action_logs.post_id) as post_count'))
            ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
            ->groupBy('action_logs.post_id')

            ->get();
        // dd($post->toArray());
        return view('admin.trend_post.index', compact('post'));
    }
    //direct trend post details page
    public function trendPostDetails($id)
    {
        $post = Post::where('post_id', $id)->first();
        return view('admin.trend_post.details', compact('post'));
    }
}
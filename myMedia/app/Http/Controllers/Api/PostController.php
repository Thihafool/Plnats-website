<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPost()
    {
        $post = Post::get();
        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }
    //post search
    public function postSearch(Request $request)
    {
        $category = Post::where('title', 'like', '%' . $request->key . '%')->get();
        return response()->json([
            'searchData' => $category,
        ]);
    }
    //post details
    public function postDetails(Request $request)
    {
        $id = $request->postId;

        $post = Post::where('post_id', $id)->first();
        return response()->json([
            'post' => $post,
        ]);
    }
}
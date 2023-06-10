<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get all category
    public function getAllCategory()
    {
        $category = Category::select('category_id', 'title', 'description')->get();
        return response()->json([
            'category' => $category,
        ]);
    }

    public function categorySearch(Request $request)
    {
        $category = Category::select('posts.*')
            ->join('posts', 'categories.category_id', 'posts.category_id')
            ->where('categories.title', 'like', '%' . $request->key . '%')->get();
        return response()->json([
            'result' => $category,
        ]);
    }

}
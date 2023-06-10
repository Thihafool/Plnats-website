<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function index()
    {
        $category = Category::get();

        return view('admin.category.index', compact('category'));
    }

    //create category
    public function createCategory(Request $request)
    {
        $this->validationCheck($request);
        $data = $this->getCategoryData($request);

        $category = Category::create($data);
        return back();
    }

    //category search
    public function categorySearch(Request $request)
    {

        $category = Category::when(request('categorySearch'), function ($query) {
            $query->where('title', 'like', '%' . request('categorySearch') . '%');

        })->get();

        return view('admin.category.index', compact('category'));

    }
    //category edit page
    public function categoryeditPage($id)
    {
        $category = Category::get();

        $updateData = Category::where('category_id', $id)->first();

        return view('admin.category.edit', compact('updateData', 'category'));
    }

    //category update
    public function categoryUpdate(Request $request)
    {

        $id = $request->categoryId;
        $updateData = $this->updateCategory($request);

        Category::where('category_id', $id)->update($updateData);
        return redirect()->route('admin#category');
    }

    //delete category
    public function categoryDelete($id)
    {
        Category::where('category_id', $id)->delete();
        return back()->with(['deleteSuccses' => 'category deleted successfully']);
    }

    //get category data
    private function getCategoryData($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

    }
    //create category validationCheck
    private function validationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|min:4',
            'categoryDescription' => 'required',
        ])->validate();
    }

    //update category data
    private function updateCategory($request)
    {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now(),
        ];
    }
}
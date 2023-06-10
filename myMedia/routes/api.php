<?php

use App\Http\Controllers\Api\ActionLogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

Route::get('category', function () {
    $category = Category::get();

    return response()->json([
        'category' => $category,

    ]);

})->middleware('auth:sanctum');
//post
Route::get('getAllPost', [PostController::class, 'getAllPost']);
Route::post('post/search', [PostController::class, 'postSearch']);
Route::post('post/details', [PostController::class, 'postDetails']);

//category
Route::get('allCategory', [CategoryController::class, 'getAllCategory']);
Route::post('category/search', [CategoryController::class, 'categorySearch']);

//action log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);
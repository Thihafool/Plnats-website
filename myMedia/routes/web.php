<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//admin
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class, 'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword', [ProfileController::class, 'changePasswordPage'])->name('admin#changePaswword');
    Route::post('admin/changePassword', [ProfileController::class, 'adminChangePassword'])->name('admin#passwordChange');
//admin list
    Route::get('admin/list', [ListController::class, 'index'])->name('admin#list');
    Route::get('admin/delete/{id}', [ListController::class, 'deleteAccount'])->name('admin#deleteAccount');
    Route::post('admin/list', [ListController::class, 'adminListSearch'])->name('admin#listSearch');
//category
    Route::get('category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('category/create', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
    Route::get('category/delete{id}', [CategoryController::class, 'categoryDelete'])->name('admin#deleteCategory');
    Route::post('category/search', [CategoryController::class, 'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}', [CategoryController::class, 'categoryeditPage'])->name('admin#categoryeditPage');
    Route::post('category/update', [CategoryController::class, 'categoryUpdate'])->name('admin#categoryUpdate');

//post
    Route::get('post', [PostController::class, 'index'])->name('admin#post');
    Route::post('admin/createPost', [PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('post/delete/{id}', [PostController::class, 'postDelete'])->name('admin#deletePost');
    Route::get('post/editpage/{id}', [PostController::class, 'postEditPage'])->name('admin#postEdit');
    Route::get('admin/updatePage/{id}', [PostController::class, 'updatePostPage'])->name('admin#updatePostPage');
    Route::post('admin/updatePost', [PostController::class, 'updatePost'])->name('admin#updatePost');

//trend post
    Route::get('trendPost', [TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}', [TrendPostController::class, 'trendPostDetails'])->name('admin#trendPostDetails');
});
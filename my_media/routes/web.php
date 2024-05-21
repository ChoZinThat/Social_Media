<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostsController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function ()
 {

    // profile
    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('/adminAccountUpdate',[ProfileController::class,'adminAccountUpdate'])->name('admin#accountUpdate');
    Route::get('/adminPW_change',[ProfileController::class,'adminPW_change'])->name('admin#PWchange');
    Route::post('/admin_change_password',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    //list
    Route::get('/list',[ListController::class,'index'])->name('admin#list');
    Route::get('/delete/{id}',[ListController::class,'deleteAdmin'])->name('admin#delete');
    Route::post('/list',[ListController::class,'searchAdmin'])->name('admin#search');

    //category
    Route::get('/category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('/category',[CategoryController::class,'categoryAdd'])->name('admin#addCategory');
    Route::get('/category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#deleteCategory');
    Route::post('/category/search',[CategoryController::class,'searchCategory'])->name('admin#categorySearch');
    Route::get('/updateData/{id}',[CategoryController::class,'updatePage'])->name('admin#categoryUpdatePage');
    Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('admin#categoryUpdate');

    //post
    Route::get('/post',[PostsController::class,'index'])->name('admin#post');
    Route::post('/post/create',[PostsController::class,'create'])->name('admin#postCreate');
    Route::get('/post/delete/{id}',[PostsController::class,'deletePost'])->name('admin#postDelete');
    Route::get('/post/editPage/{id}',[PostsController::class,'editPostPage'])->name('admin#editPostPage');
    Route::post('/post/edit/{id}',[PostsController::class,'editPost'])->name('admin#editPost');

    //trend post
    Route::get('/trend_post',[TrendPostsController::class,'index'])->name('admin#trendPost');
    //trend post details
    Route::get('/trendPost/Details/{id}',[TrendPostsController::class,'postDetails'])->name('admin#trendPostDetails');
});

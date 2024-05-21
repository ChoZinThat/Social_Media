<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

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

Route::post('/user/login',[AuthController::class,'loginUser']);

Route::get('/category',[AuthController::class,'getCategory'])->middleware('auth:sanctum');

Route::post('/user/register',[AuthController::class,'registerUser']);

//get post data
Route::get('/getPostData',[PostController::class,'getPostData']);
//search post
Route::post('/searchPost',[PostController::class,'searchPost']);
//post details
Route::post('/postDetails',[PostController::class,'postDetails']);

//get category data
Route::get('/getCategoryData',[CategoryController::class,'getCategory']);
//search category
Route::post('/searchCategory',[CategoryController::class,'searchCategory']);

//create view count
Route::post('/create/view_count',[ActionLogController::class,'createAction']);


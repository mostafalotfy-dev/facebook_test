<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(["prefix"=>"panel","middleware"=>"auth:admin"],function()
{
    Route::resource('admins', AdminController::class);
    Route::resource('recipes', RecipeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('replies', ReplyController::class);
    Route::resource('shortVideos', ShortVideoController::class);
    Route::resource('cheifs', CheifController::class);
    Route::resource('followings', FollowingController::class);
    Route::resource('comics', ComicController::class);
    Route::resource('hashTags', HashTagController::class);
    Route::resource('users', UserController::class);
});









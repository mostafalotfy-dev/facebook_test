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


Route::post("form/{groupId}","FacebookController@postForm")->name("publish.facebook");
Route::get("group","FacebookController@form");
Route::get("album/{albumId}","FacebookController@album")->name("create.album");
Route::post("album/{albumId}","FacebookController@addPhotos");
Route::get("video/{groupId}","FacebookController@createVideo")->name("group.video.create");
Route::post("video/{groupId}","FacebookController@addVideoToGroup");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

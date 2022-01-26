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
Route::get("/","FacebookController@index");
Route::get("code","FacebookController@code");
Route::post("form/{groupId}","FacebookController@postForm")->name("publish.facebook");
Route::get("form","FacebookController@form");
Route::get("album/{albumId}","FacebookController@album")->name("create.album");
Route::post("album/{albumId}","FacebookController@addPhotos");

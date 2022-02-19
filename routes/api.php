<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

  
    Route::post("register","RegisterController@register");
});
Route::group([
    "middleware"=>"api",
    "prefix"=>"auth/cheif"
],function()
{
    Route::post("register","Cheif\RegisterController@register");
    Route::post('login', 'Cheif\LoginController@login');
  
});
Route::post("posts","PostController@store");
Route::group([
    "middleware"=>["auth:cheif_api","verified"],
    "prefix"=>"cheif"
],function()
{
    Route::get("profile","Cheif\ProfileController@index");
   
});
Route::post("cheif/verify","Cheif\VerificationController@verify");
Route::group([
    "middleware"=>["auth:api","verified"],
],function(){
    Route::get("profile","ProfileController@index");
    Route::resource('followings', FollowingAPIController::class);
    Route::post("followings","FollowingAPIController@store");
    Route::get("followings","FollowingAPIController@index");
    Route::get("followings/{id}","FollowingAPIController@show");
    Route::post("comics/add","PostController@addComic");
    
});
Route::post("provider","ProviderController@index");
Route::post("verify","VerificationController@verify");
Route::get("cheif/{userId}/comics","ComicAPIController@byUserId");
Route::post('recipes',"RecipeAPIController@index");
Route::post("recipes/store","RecipeAPIController@store");
Route::resource("recipes","RecipeAPIController")->except("store","index");
Route::post("recipes/get","RecipeAPIController@index");
Route::resource('short_videos', ShortVideoAPIController::class);

Route::post("comics","ComicAPIController@index");
Route::post("comics/store","ComicAPIController@store");
Route::resource('hash_tags', HashTagAPIController::class);
Route::get("categories","CategoryAPIController@index");
Route::apiResource("comics","ComicAPIController")->except("store");

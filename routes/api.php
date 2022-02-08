<?php

use Illuminate\Http\Request;
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

    Route::post('login', 'LoginController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post("register","RegisterController@register");
    

});
Route::group([
    "middleware"=>"api",
    "prefix"=>"auth/cheif"
],function()
{
    Route::post('login', 'Cheif/LoginController@login');
  
  
});
Route::group([
    "middleware"=>"auth:sanctum",
],function(){
    Route::get("profile","ProfileController@index");
    Route::get("posts","PostsControlle@index");
    Route::get("posts/{categoryId}/category","PostsController@byCategory");
   
});

Route::resource('recipes',RecipeAPIController::class);
Route::resource('short_videos', ShortVideoAPIController::class);


Route::resource('followings', App\Http\Controllers\API\FollowingAPIController::class);

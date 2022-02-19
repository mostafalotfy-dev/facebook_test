<?php

use Illuminate\Support\Facades\Route;

Route::get("hashtag","AjaxController@hashtags")->name("hashtags.ajax");
Route::get("recipes/album","AjaxController@recipesAlbum")->name("recipes.album.ajax");
Route::get("users","AjaxController@users")->name("users.ajax");
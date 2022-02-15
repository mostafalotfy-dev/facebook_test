<?php

use Illuminate\Support\Facades\Route;

Route::get("hashtag","AjaxController@hashtags")->name("hashtags.ajax");
Route::get("recipes/album","AjaxController@recipesAlbum")->name("recipes.album.ajax");
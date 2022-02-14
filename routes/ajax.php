<?php

use Illuminate\Support\Facades\Route;

Route::get("hashtag","AjaxController@hashtags")->name("hashtags.ajax");
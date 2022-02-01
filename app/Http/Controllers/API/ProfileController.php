<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Resources\ProfileResource;
class ProfileController extends Controller
{

    public function index()
    {
        $user = request()->user();
        return new ProfileResource($user);
    }
}

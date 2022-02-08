<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;


use App\Http\Resources\ProfileResource;
class ProfileController extends AppBaseController
{

    public function index()
    {
        $user = request()->user();
        return new ProfileResource($user);
    }
}

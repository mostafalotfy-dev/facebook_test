<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;


use App\Http\Resources\ProfileResource;
class ProfileController extends AppBaseController
{

    public function index()
    {
        $user = auth("api")->user();
        return new ProfileResource($user);
    }
}

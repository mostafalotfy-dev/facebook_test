<?php

namespace App\Http\Controllers\API\Cheif;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CheifProfileController;

class ProfileController extends AppBaseController
{

    public function index()
    {
        $user = auth("cheif_api")->user();
        return $this->sendResponse(new CheifProfileController($user)
           
        , __('messages.retrieved', ['model' => __('models/cheifs.plural')]));
    }
}

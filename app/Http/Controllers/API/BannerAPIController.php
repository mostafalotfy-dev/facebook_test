<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use App\Models\Banner;
use Carbon\Carbon;

class BannerAPIController extends AppBaseController
{
    public function index()
    {
        return $this->sendResponse(
            Cache::remember("banners",now()->addDays(30),function()
            {
                return Banner::all();
            }),
        __("messages.retrieved")
    );
    }
}

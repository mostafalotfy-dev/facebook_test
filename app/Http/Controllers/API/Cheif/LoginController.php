<?php

namespace App\Http\Controllers\API\Cheif;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CheifLoginResource;
use App\Http\Resources\LoginResource;
use App\Models\Cheif;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends AppBaseController
{
    use AuthenticatesUsers;
    public function username()
    {
        return "phone_number";
    }
    protected function login(Request $request)
    {

        $user = $this->findUser($request);
        if ($user) {
            if (!Hash::check(request("password"), $user->password)) {
                return $this->sendFailedLoginResponse($request);
            } else {
                return $this->sendResponse(
                    new LoginResource($user),
                    __("messages.retrieved", ["model" => "cheifs.plural"])
                );
            }
        } else {
            return $this->sendFailedLoginResponse($request);
        }
    }
    private function findUser(Request $request)
    {
        return  Cheif::where($this->username()
        , request($this->username()))
        ->first();
    }
}

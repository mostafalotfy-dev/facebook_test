<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
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
        if (!Hash::check(request("password"),$user->password)) {
                return $this->sendFailedLoginResponse($request);
            } else {
                return $user->phone_number_verified_at === null 
                ? $this->sendResponse([
                    "token"=>$user->createToken(env("APP_NAME"))->plainTextToken,
                    "is_verified"=> (bool) $user->phone_number_verified_at
                ],"Account Not Verified") : $this->sendResponse(new LoginResource($user),"Login Successfull");
            }
        }else
        {
            return $this->sendFailedLoginResponse($request);
        }
    }
    private function findUser(Request $request)
    {
       
        return  User::where([
            [
                $this->username(),
                "=",
                request($this->username()),
            ],
        ])->first();
    }
 
}

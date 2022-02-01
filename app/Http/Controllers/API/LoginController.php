<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Facebook\Authentication\AccessToken;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function username()
    {
        return "phone_number";
    }
    protected function login(Request $request)
    {
        $user = User::where([
            [
                $this->username(),
                "=",
                request($this->username()),
            ],
    
            ])->first();
            if(!$user)
            {
                return $this->sendFailedLoginResponse($request);
            }else{
                return response()->json([
                    "data"=>[
                        "token"=> $user->createToken(env("APP_NAME"))->plainTextToken,
                        "user"=>[
                            "id"=>$user->id,
                            "avatar"=>asset("storage/$user->avatar"),
                            "name"=>$user->name,
                            "is_waiting"=>(bool) $user->waiting()->value("user_id"),
                            "youtube_channel_link"=>(string) $user->youtube_channel,
                            "facebook_link"=>(string)$user->facebook_link,
                            "description"=> (string) $user->description
                        ]
                    ]
                    ]);
            }

    }

    
    
}

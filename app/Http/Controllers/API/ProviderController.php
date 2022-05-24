<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use App\Models\User;
use Facebook\Facebook;
use Illuminate\Support\Facades\Http;

class ProviderController extends AppBaseController
{
    private $facebook;
    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }
    public function index()
    {
        $this->validate(request(), [
            "provider_token" => "required|string",
            "provider_name" => "required|string|in:facebook,google,apple",
            "provider_id" => "required|string|max:15",
            "avatar" => "required|url",
            "name" => "required|string"
        ]);

        $token = [
            "facebook" => function () {
                return  $this->facebook->getOAuth2Client()->getLongLivedAccessToken(request("provider_token"));
            },
            "google" => function () {
                return $this->facebook->
            },
            "apple" => function () {
                
            }
        ];
       
         $token = $token[request("provider_name")]();
       
        $fileName = uniqid();
        Http::sink(public_path("storage/" . $fileName))->get(request("avatar"));
        $user = User::where("provider_id", request("provider_id"))->first();
        if (!$user) {
            $user = User::create([
                "name" => request("name"),
                "avatar" => $fileName,
                "provider_id" => request("provider_id"),
                "provider_token" => $token,
                "provider_name" => request("provider_name"),
                "verify_number" => 1234,
                "phone_number_verified_at" => now(),
                "user_ip" => request()->ip(),
            ]);
        } else {
            $user->update([
                "name" => request("name"),
                "avatar" => $fileName,
                "provider_id" => request("provider_id"),
                "provider_token" => $token,
                "provider_name" => request("provider_name"),
                "verify_number" => 1234,
                "phone_number_verified_at" => now(),
                "user_ip" => request()->ip(),
            ]);
        }
        return $this->sendResponse(
            new LoginResource($user),
            __("messages.created", ["model" => __("provider.plural")])
        );
    }
}

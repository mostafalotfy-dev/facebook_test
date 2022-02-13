<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
class ProviderController extends AppBaseController
{
   public function index()
   {
       $this->validate(request(),[
        "provider_token"=>"required|string",
        "provider_name"=>"required|string|in:facebook,google,apple",
        "provider_id"=>"required|string|max:15",
        "avatar"=>"required|url",
        "name"=>"required|string"
       ]);
       $fileName = uniqid();
       Http::sink(public_path("storage/".$fileName))->get(request("avatar"));
       $user = User::where("provider_id",request("provider_id"))->first();
       if(!$user)
       {
        $user->create([
            "name"=> request("name"),
            "avatar"=> $fileName,
            "provider_id"=>request("provider_id"),
            "provider_token"=>request("provider_token"),
            "provider_name"=>request("provider_name"),
            "verify_number"=>1234,
            "phone_number_verified_at" => now(),
            "user_ip" => request()->ip(),
        ]);
       }else{
        $user->update([
            "name"=> request("name"),
            "avatar"=> $fileName,
            "provider_id"=>request("provider_id"),
            "provider_token"=>request("provider_token"),
            "provider_name"=>request("provider_name"),
            "verify_number"=>1234,
            "phone_number_verified_at" => now(),
            "user_ip" => request()->ip(),
        ]);
       }
       return $this->sendResponse(
           new LoginResource($user),
       __("messages.created",["model"=>__("provider.plural")]));
    
   }
}

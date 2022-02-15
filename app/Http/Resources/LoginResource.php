<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "token" => $this->createToken(env("APP_NAME"))->plainTextToken,
            "user" => [
                "avatar" => asset("storage/".$this->avatar),
                "name" => $this->name,
              
                "description" => (string) $this->description
            ]
        ];
    }
}

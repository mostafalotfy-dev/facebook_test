<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheifRegisterResource extends JsonResource
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
                "name" => $this->name,
                "avatar" => asset("storage/".$this->avatar),
                "is_waiting" => (bool) $this->waiting()->value("user_id"),
                "description" => (string) $this->description,
                "address"=> (string) $this->address
            ]
        ];
    }
}

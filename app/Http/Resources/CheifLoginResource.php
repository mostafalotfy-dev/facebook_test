<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheifLoginResource extends JsonResource
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
                
                "avatar" => asset("storage/$this->avatar"),
                "name" => $this->name,
                "is_waiting" => (bool) $this->waiting()->value("user_id"),
                "youtube_channel_link" => (string) $this->youtube_channel,
                "facebook_link" => (string)$this->facebook_link,
                "description" => (string) $this->description
            ]x
        ];
    }
}

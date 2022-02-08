<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            "name"=>(string) $this->name,
            "avatar"=>(string)$this->avatar,
            "interaction_count"=> (int) $this->likes()->avg(),
            "following"=> (int) $this->following()->count(),
            "followers"=>(int) $this->followers()->count(),
            "youtube_link"=>(string)$this->youtube_link,
            "facebook_link"=> (string) $this->facebook_link,
            "description"=>(string) $this->description
        ];
    }
}

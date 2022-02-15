<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheifProfileController extends JsonResource
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
            "avatar"=>(string) asset("storage/$this->avatar"),
            "recipes"=> (int) $this->recipes()->count(),
            "following"=> (int) $this->following()->count(),
            "followers"=>(int) $this->followers()->count(),
            "youtube_link"=>(string)$this->youtube_link,
            "facebook_link"=> (string) $this->facebook_link,
            "description"=>(string) $this->description
        ];
    }
}

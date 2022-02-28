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
            "avatar"=>asset("storage/$this->avatar"),
            "interaction_count"=> (int) $this->likes()->avg("user_id"),
            "description"=>(string) $this->description,
            "address"=>(string) $this->address,
            "facebook_link"=>(string) $this->facebook_link,
            "youtube_link"=>(string) $this->youtube_channel,
            "is_cheif" => (bool) $this->is_cheif,
            "followers"=>$this->followers()->count(),
            "following"=>$this->followings()->count(),
        ];
    }
}

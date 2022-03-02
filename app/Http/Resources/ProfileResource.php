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
            "name" => (string) $this->name,
            "avatar" => asset("storage/$this->avatar"),
            "interaction_count" => (int) $this->likes()->avg("user_id"),
            "description" => (string) $this->description,
            "is_active" => (bool) $this->is_active,
            "follower_count" => $this->followers()->count(),
            "following_count" => $this->following()->count(),
            "youtube_channel" => (string) $this->youtube_channel,
            "address" => (string) $this->address,
            "recipes_count" => $this->recipes()->count(),
        ];
    }
}

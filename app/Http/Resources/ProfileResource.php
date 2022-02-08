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
            "description"=>(string) $this->description
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HashTagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'user_id' => $this->user_id,
            'postable_type' => $this->postable_type,
            'postable_id' => $this->postable_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortVideoResource extends JsonResource
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
            'description' => (string) $this->description,
            'view_count' => (int) $this->view_count,
            'user_id' => (string) $this->user->name,
            
            'updated_at' => (string) $this->updated_at
        ];
    }
}

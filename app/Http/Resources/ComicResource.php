<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->user;
        $category = $this->category;
        return [
            'id' => $this->id,
            'username' => $user ? $user->name : $this->createdBy->full_name,
            'categoryname' => app()->getLocale() == "en" ? $category->name_en : $category->name_ar,
            'title' => $this->title,
            
            'description' => $this->description,
            'updated_at' => $this->updated_at ? $this->updated_at->format("Y-m-d") : (string) $this->update_at,
        ];
    }
}

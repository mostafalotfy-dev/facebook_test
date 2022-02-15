<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $category = $this->category;
        
        return [
            'id' => $this->id,
            'view_count' => (int)$this->view_count,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'category' => [
                "en"=>$category->name_en,
                "ar"=>$category->name_ar,
            ],
            "hashtags"=> $this->hashtags()->get()->map(fn($hashtag)=>[
                "title"=>$hashtag->title
            ]),
            'people_count' => $this->people_count,
            'cooking_time' => $this->cooking_time->format("H:i"),
            
            'created_at' => !$this->created_at ?  (string)$this->created_at :  $this->created_at->diffForHumans(),
        ];
    }
}

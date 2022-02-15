<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "category_name"=>[
                "name_en"=>$this->name_en,
                "name_ar"=>$this->name_ar
            ],
            "image"=>asset("storage/".$this->image),
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\ComicAlbums;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
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
            
            'username' => $user ? $user->name : $this->createdBy->full_name,
            'categoryname' => app()->getLocale() == "en" ? $category->name_en : $category->name_ar,
            'title' => Str::of($this->title)->limit(120),
            
            'description' => $this->description,
            'updated_at' => $this->updated_at ? $this->updated_at->format("Y-m-d") : (string) $this->update_at,
            "albums"=>ComicAlbumResource::collection($this->comicsAlbums)
        ];
    }
}

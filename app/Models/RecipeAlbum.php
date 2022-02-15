<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeAlbum extends Model
{
    use HasFactory;
    protected $table = "recipes_album";
    protected $fillable = [
        "file_name",
        "mime_type",
        "recipe_id",
        "user_id",
    ];
}

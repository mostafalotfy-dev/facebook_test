<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicAlbum extends Model
{
    use HasFactory;
    protected $table= "comics_album";
    protected $fillable = [
        "file_name",
        "mime_type",
        "comic_id",
        "user_id",
    ];
}

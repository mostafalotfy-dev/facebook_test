<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();
        return PostResource::collection($posts->getCollection()->shuffle());
    }

    public function byCategory($categoryId)
    {
      $posts = Post::where("category_id",$categoryId)->get();
      return PostResource::collection($posts);  
    }
}

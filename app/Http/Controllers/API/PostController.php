<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Repositories\ComicRepository;
use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;


class PostController extends AppBaseController
{

    private ComicRepository $comicRepo;
    private RecipeRepository $recipeRepo;
    public function __construct(ComicRepository $comicRepo,RecipeRepository $recipeRepo)
    {
        $user_type = Str::title(request("user_type"));
         if($user_type == "Cheif")
         {
             $this->middleware("auth:cheif_api");
         }elseif($user_type == "User")
         {
            $this->middleware("auth:api"); 
         }
         $this->recipeRepo = $recipeRepo;
         $this->comicRepo = $comicRepo;
         
    }
    public function store()
    {
        $this->validate(request(),
        [
            "media"=>"required|array",
            "media.*"=>"mimes:jpg,gif,jpeg,jpeg,webp,mp4,3gp,mov,avi,wmv",
            "user_type"=>"required|in:User,Cheif",
            "post_type"=>"required|in:Comic,Recipe",
            "post_title"=>"required|string|max:255",
            "post_description"=>"required|string",
            "category_id"=>"required|exists:categories,id",
            "hashtag_title"=>"required|string",
            "people_count"=>"required|int",
            "cooking_time"=>"required|string|regex:(\d:\d{2})"
        ]);
        $files = request("media");
        
        foreach($files as $file)
        {
            $fileName = uniqid().$file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();
            $file->move("storage",$fileName);
            $user_type = Str::title(request("user_type"));
            $guard = $user_type == "Cheif" ? auth("cheif_api") : auth("api");
            if(request("post_type") == "Comic")
            {
               $this->addPost("comics",$guard,$fileName,$mimeType);
            }elseif(request("post_type") == "Recipe"){
               $this->addPost("recipes",$guard,$fileName,$mimeType);
            }
        }
    
        return $this->sendSuccess("Post Uploaded Successfully");
    }
    public function addPost(
                            $tableName
                            ,$guard
                            ,$fileName,
                            $mimeType
                            )
    {
        $id =  DB::table($tableName)->insert([
            "title"=>request("post_title"),
            "description"=>request("post_description"),
            "user_id"=>$guard->id(),
            "category_id"=>request("category_id"),
            "people_count"=>request("people_count"),
            "cooking_time"=>request("cooking_time"),
            "created_at"=>now(),
           
        ]);
          DB::table($tableName."_album")->insertGetId([
            "file_name" => $fileName,
            "mime_type" => $mimeType,
            "user_type" => "App\Models\\".Str::title(request("user_type")),
            "user_id" => $guard->id(),
            "created_at"=> now(),
            "recipe_id"=>$id
        ]);
        DB::table("hashtags")->insert([
            "title"=>request("hashtag_title"),
            "user_id"=>$guard->id(),
            "postable_type"=> $tableName == "recipes" ? Recipe::class : Comic::class,
            "postable_id"=>$id
        ]);
    }
    
    public function recipes()
    {
        $recipes = $this->recipeRepo->all([],request("skip"),request("limit"));
        return $this->sendResponse(RecipeResource::collection($recipes)
        ,__("messages.retrieved",["model"=>"recipes.plural"]));
    }
}

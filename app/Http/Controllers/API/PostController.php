<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Jobs\PublishImageToFacebook;
use App\Jobs\PublishVideoToFacebook;
use App\Models\Comic;
use App\Models\HashTag;
use App\Models\Recipe;
use App\Repositories\ComicRepository;
use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use DB;
use Facebook\Facebook;
use Illuminate\Support\Str;
use Providers\Facebook\FacebookAlbum\Album;
use Providers\Facebook\Group;

class PostController extends AppBaseController
{


    private RecipeRepository $recipeRepo;
    private Facebook $facebook;
    public function __construct(RecipeRepository $recipeRepo, Facebook $facebook)
    {

        $this->middleware("auth:api");
        $this->recipeRepo = $recipeRepo;

        $this->facebook = $facebook;
    }
    public function store()
    {
        $this->validate(
            request(),
            [
                "media" => "required|array",
                "media.*" => "mimes:jpg,gif,jpeg,jpeg,webp,mp4,3gp,mov,avi,wmv",

                "post_title" => "required|string|max:255",
                "post_description" => "required|string",
                "category_id" => "required|exists:categories,id",
                "hashtag" => "required|string",
                "people_count" => "required|int",
                "cooking_time" => "required|string|regex:(\d:\d{2})",
                "steps" => "required|string"
            ]
        );
        $files = request("media");
        $user = auth("api")->user();
        $id = $this->addPost("recipes", auth("api"), Recipe::class);
        $this->completeRecipe($id);
        $is_image = explode("/", $files[0]->getClientMimeType())[0] == "image";


        if ($is_image) {

            $albumId = $this->createAlbum();


            foreach ($files as $file) {
                $fileName = uniqid() . $file->getClientOriginalExtension();
                $mimeType = $file->getClientMimeType();
                $file->move("storage", $fileName);
                DB::table("recipes_album")->insertGetId([
                    "file_name" => $fileName,
                    "mime_type" => $mimeType,
                    "user_id" => auth("api")->id(),
                    "created_at" => now(),
                    "recipe_id" => $id,
                ]);
                $this->postToAlbum($albumId, $user, "storage/" . $fileName);
            }
        } else {
            $file = request("media")[0];
            $fileName = uniqid() . $file->getClientOriginalExtension();
            $file->move("storage", $fileName);
            $this->publishVideo($user, "storage/" . $fileName);
        }

        return $this->sendSuccess("Post Uploaded Successfully");
    }

    public function addPost(
        $tableName,
        $guard,
        $postType
    ) {
        $id =  DB::table($tableName)->insertGetId([
            "title" => request("post_title"),
            "description" => request("post_description"),
            "user_id" => $guard->id(),
            "category_id"  => request("category_id"),
            "people_count" => request("people_count"),
            "cooking_time" => request("cooking_time"),
            "created_at" => now(),
            "is_active"  => 0,
            "created_by" => 1

        ]);

        $data = array_map(function ($hashtag) use ($guard, $postType, $id) {
            return [
                "title" => $hashtag,
                "user_id" => $guard->id(),
                "postable_type" =>  $postType,
                "postable_id" => $id,
                "created_at" => now(),
            ];
        }, explode(",", request("hashtag")));
        DB::table("hashtags")->insert($data);

        return $id;
    }

    private function completeRecipe($id)
    {
        $ingredients = explode(",", request("ingredients"));

        $ingredients = array_map(function ($ingredient) {
            $data = explode(":", $ingredient);
            return ["description" => $data[0], "user_id" => auth("api")->id(), "created_at" => now()];
        }, $ingredients);

        DB::table("ingredients")->insert($ingredients);
        $steps = array_map(function ($step) use ($id) {
            return [
                "recipe_id" => $id,
                "step_description" => $step,
            ];
        }, explode(":", request("steps")));
        DB::table("steps")->insert($steps);
        return $id;
    }
    public function addComic()
    {
        $this->validate(
            request(),
            [
                "media" => "required|array",
                "media.*" => "mimes:jpg,gif,jpeg,jpeg,webp,mp4,3gp,mov,avi,wmv",
                "post_title" => "required|string|max:255",
                "description" => "required|string",
                "category_id" => "required|exists:categories,id",
                "hashtag" => "required|string",

            ]
        );
        $files = request("media");
        $id = DB::table("comics")->insert([
            "title" => request("post_title"),
            "description" => request("description"),
            "category_id" => request("category_id"),
            "created_at" => now(),
            "user_id" => auth("api")->id(),
            "is_active" => 0,
        ]);
        $user = auth("api")->user();
        $is_image = explode("/", $files[0]->getClientMimeType())[0] == "image";
        if ($user->provider_token && $user->provider_name == "facebook") {
            $albumId = $this->createAlbum();
        }
        if ($is_image) {
            foreach ($files as $file) {
                $fileName = uniqid() . $file->getClientOriginalExtension();
                $mimeType = $file->getClientMimeType();
                $file->move("storage", $fileName);
                DB::table("comics_album")->insertGetId([
                    "file_name" => $fileName,
                    "mime_type" => $mimeType,
                    "user_id" => auth("api")->id(),
                    "created_at" => now(),
                    "comic_id" => $id,
                ]);
                if ($albumId != 0) {

                    $this->postToAlbum($albumId, $user, "storage/" . $fileName);
                }
            }
        } else {
            foreach ($files as $file) {
                $fileName = uniqid() . $file->getClientOriginalExtension();
                $mimeType = $file->getClientMimeType();
                $file->move("storage", $fileName);
                DB::table("comics_album")->insertGetId([
                    "file_name" => $fileName,
                    "mime_type" => $mimeType,
                    "user_id" => auth("api")->id(),
                    "created_at" => now(),
                    "comic_id" => $id,
                ]);
                if ($albumId != 0) {

                    $this->publishVideo($user, "storage/$fileName");
                }
            }
        }

         array_map(function ($hashtag) use ($id) {
            $hashtagId =  HashTag::insertGetId([
                "title" => $hashtag,
                "user_id" => auth("api")->id(),
                "created_at" => now(),
            ]);
            DB::table("recipe_hashtag")->insert([
                "recipe_id" => $id,
                "hash_tag_id" => $hashtagId,
            ]);
        }, explode(",", request("hashtag")));









        return $this->sendSuccess("Comic Uploaded Successfully");
    }
    public function recipes()
    {
        $recipes = $this->recipeRepo
            ->all([], request("skip"), request("limit"));
        return $this->sendResponse(
            RecipeResource::collection($recipes),
            __("messages.retrieved", ["model" => "recipes.plural"])
        );
    }

    private function createAlbum()
    {
        $user = auth("api")->user();

        $group = new Group($this->facebook);
        $album = $group->createAlbum(env("FACEBOOK_GROUPID"), [
            "name" => request("post_title"),
            "description" => request("post_description"),
            "privacy_message" => "open"
        ], $user->provider_token);
        return $album->getGraphAlbum()->getId();
    }

    private function postToAlbum($album, $user, $filePath)
    {

        dispatch(new PublishImageToFacebook(
            $album,
            $filePath,
            $user->provider_token
        ));
    }
    private function publishVideo($user, $filePath)
    {
        dispatch(new PublishVideoToFacebook(
            env("FACEBOOK_GROUPID"),
            public_path($filePath),
            [
                "title" => request("post_title"),
                "description" => request("post_description")
            ],
            $user->provider_token
        ));
    }
}

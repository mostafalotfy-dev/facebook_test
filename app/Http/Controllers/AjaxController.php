<?php

namespace App\Http\Controllers;


use App\Http\Resources\HashTagAjaxResource;
use App\Http\Resources\UserAjaxResource;
use App\Repositories\HashTagRepository;
use App\Models\User;
class AjaxController extends Controller
{
    private $hashtagRepo;
    public function __construct(HashTagRepository $hashtagRepo)
    {
        $this->hashtagRepo = $hashtagRepo;
    }
   public function hashtags()
   {
       $hashtags = $this->hashtagRepo->allQuery(request("q") ? [
           "title" => request("q")
       ]:[])->paginate(15);
        return response()->json([
            "results" => HashtagAjaxResource::collection($hashtags),
        ]);
   }
   public function users()
   {
       $users = User::orWhere("name","LIKE","%".request("q")."%")->paginate();
       return response()->json([
          "results"=>UserAjaxResource::collection($users),
          "pagination" => [
            "more" => $users->hasMorePages()
        ]
       ]);
   }
 
}

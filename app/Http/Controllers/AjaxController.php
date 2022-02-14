<?php

namespace App\Http\Controllers;


use App\Http\Resources\HashTagAjaxResource;
use App\Repositories\HashTagRepository;
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
            "results"=>HashtagAjaxResource::collection($hashtags),
        ]);
   }
}

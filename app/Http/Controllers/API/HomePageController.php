<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ShortVideoResource;
use App\Http\Resources\HashTagResource;
use App\Http\Resources\BannerResource;
use App\Repositories\BannerRepository;
use App\Repositories\HashTagRepository;
use App\Repositories\ShortVideoRepository;
use App\Models\Category;
class HomePageController extends AppBaseController
{
    private $shortVideoRepository;
    private $hashTagRepository;
    private $bannerRepository;


    public function __construct(
        ShortVideoRepository $shortVideoRepository,
        BannerRepository $bannerRepository,
        HashTagRepository $hashTagRepository
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->hashTagRepository = $hashTagRepository;
        $this->shortVideoRepository = $shortVideoRepository;
    }
    public function index()
    {
        $this->validate(request(),
        [
            "category_ids"=>"required|string",
        ]);
        $shortVideos = $this->shortVideoRepository->allQuery()->take(10);
        $hashtags = Category::find(request("category_ids"));
        $banners = $this->bannerRepository->allQuery()->take(10);
        return response()->json([
            "data" => [
                "shortvideos" => ShortVideoResource::collection($shortVideos),
                "hashtags" => HashTagResource::collection($hashtags),
                "banners" => BannerResource::collection($banners)
            ],
            "message" => __("messages.home"),
        ]);
    }
}

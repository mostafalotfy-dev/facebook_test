<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryNameResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
class CategoryAPIController extends AppBaseController
{
    private CategoryRepository $categoryRepo;
   public function __construct(CategoryRepository $categoryRepo)
   {
    $this->categoryRepo = $categoryRepo;
   }
   public function index()
   {
       $categories = $this->categoryRepo
       ->all([],request("skip",0),request("limit",15));
       if(request("name_only",0) == 1)
       {
            return $this->sendResponse(CategoryNameResource::collection($categories),__("messsages.retrieved",["model"=>__("categories.plural")]));
       }
       return $this->sendResponse(CategoryResource::collection($categories),__("messsages.retrieved",["model"=>__("categories.plural")]));
   }
   
}

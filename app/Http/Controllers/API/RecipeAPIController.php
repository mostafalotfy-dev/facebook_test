<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRecipeAPIRequest;
use App\Http\Requests\API\UpdateRecipeAPIRequest;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\RecipeShowResource;
use App\Jobs\PublishImageToFacebook;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class RecipeController
 * @package App\Http\Controllers\API
 */

class RecipeAPIController extends AppBaseController
{
    /** @var  RecipeRepository */
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepo)
    {
        $this->recipeRepository = $recipeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/recipes",
     *      summary="Get a listing of the Recipes.",
     *      tags={"Recipe"},
     *      description="Get all Recipes",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Recipe")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $recipes = $this->recipeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip',0),
            $request->get('limit',10)
        );

        return $this->sendResponse(
            RecipeResource::collection($recipes),
            __('messages.retrieved', ['model' => __('models/recipes.plural')])
        );
    }

    /**
     * @param CreateRecipeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/recipes",
     *      summary="Store a newly created Recipe in storage",
     *      tags={"Recipe"},
     *      description="Store Recipe",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Recipe that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Recipe")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Recipe"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRecipeAPIRequest $request)
    {
        $input = $request->all();

        $recipe = $this->recipeRepository->create($input);
// dispatch(new PublishImageToFacebook($recipe->id,"storage/".$input[""]));
        return $this->sendResponse(
            new RecipeResource($recipe),
            __('messages.saved', ['model' => __('models/recipes.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/recipes/{id}",
     *      summary="Display the specified Recipe",
     *      tags={"Recipe"},
     *      description="Get Recipe",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Recipe",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Recipe"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Recipe $recipe */
        $recipe = DB::table("recipes")->where("id",$id)->first();

        if (empty($recipe)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/recipes.singular')])
            );
        }

        return $this->sendResponse(
            new RecipeShowResource($recipe),
            __('messages.retrieved', ['model' => __('models/recipes.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateRecipeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/recipes/{id}",
     *      summary="Update the specified Recipe in storage",
     *      tags={"Recipe"},
     *      description="Update Recipe",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Recipe",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Recipe that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Recipe")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Recipe"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRecipeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/recipes.singular')])
            );
        }

        $recipe = $this->recipeRepository->update($input, $id);

        return $this->sendResponse(
            new RecipeResource($recipe),
            __('messages.updated', ['model' => __('models/recipes.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/recipes/{id}",
     *      summary="Remove the specified Recipe from storage",
     *      tags={"Recipe"},
     *      description="Delete Recipe",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Recipe",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/recipes.singular')])
            );
        }

        $recipe->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/recipes.singular')])
        );
    }
}

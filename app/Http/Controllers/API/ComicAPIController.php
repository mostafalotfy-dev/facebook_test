<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateComicAPIRequest;
use App\Http\Requests\API\UpdateComicAPIRequest;
use App\Models\Comic;
use App\Repositories\ComicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ComicResource;
use App\Http\Resources\ShortVideoResource;
use App\Traits\HasImage;
use Response;

/**
 * Class ComicController
 * @package App\Http\Controllers\API
 */

class ComicAPIController extends AppBaseController
{
    use HasImage;
    /** @var  ComicRepository */
    private $comicRepository;

    public function __construct(ComicRepository $comicRepo)
    {
        $this->comicRepository = $comicRepo;
        
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/comics",
     *      summary="Get a listing of the Comics.",
     *      tags={"Comic"},
     *      description="Get all Comics",
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
     *                  @SWG\Items(ref="#/definitions/Comic")
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
        $this->validate($request,
        [
            "category_ids"=>"required|string"
        ]);
        $comics = $this->comicRepository->allQuery()->whereIn("category_id",explode(",",$request->categories))
        ->paginate();
        return $this->sendResponse(
            ComicResource::collection($comics),
            __('messages.retrieved', ['model' => __('models/comics.plural')])
        );
    }
    public function byProfile()
    {
        request()->validate([
            "user_id"=> "required"
        ]);
        $shortVideos = Comic::where("user_id",request("user_id"))->paginate();
        return $this->sendResponse(ShortVideoResource::collection($shortVideos),__("messages.retrieved"));
    }
  
    public function show($id)
    {
        /** @var Comic $comic */
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/comics.singular')])
            );
        }

        return $this->sendResponse(
            new ComicResource($comic),
            __('messages.retrieved', ['model' => __('models/comics.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateComicAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/comics/{id}",
     *      summary="Update the specified Comic in storage",
     *      tags={"Comic"},
     *      description="Update Comic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Comic",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Comic that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Comic")
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
     *                  ref="#/definitions/Comic"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateComicAPIRequest $request)
    {
        $input = $request->validated();

        
        /** @var Comic $comic */
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/comics.singular')])
            );
        }
        
        $comic = $this->comicRepository->update($input, $id);

        return $this->sendResponse(
            new ComicResource($comic),
            __('messages.updated', ['model' => __('models/comics.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/comics/{id}",
     *      summary="Remove the specified Comic from storage",
     *      tags={"Comic"},
     *      description="Delete Comic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Comic",
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
        /** @var Comic $comic */
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/comics.singular')])
            );
        }

        $comic->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/comics.singular')])
        );
    }
}

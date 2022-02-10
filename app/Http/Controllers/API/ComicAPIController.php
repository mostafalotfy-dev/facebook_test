<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateComicAPIRequest;
use App\Http\Requests\API\UpdateComicAPIRequest;
use App\Models\Comic;
use App\Repositories\ComicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ComicResource;
use Response;

/**
 * Class ComicController
 * @package App\Http\Controllers\API
 */

class ComicAPIController extends AppBaseController
{
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
        $comics = $this->comicRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            ComicResource::collection($comics),
            __('messages.retrieved', ['model' => __('models/comics.plural')])
        );
    }
    /*
     *
     * @SWG\Get(
     *      path="/cheif/{userId}/comics/",
     *      summary="Get a listing of the Comics by User Id.",
     *      tags={"Comic"},
     *      description="Get all Comics Belongs To Cheif",
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
    public function byUserId($userId)
    {
        
        $comics = $this->comicRepository->allQuery()
        ->where("user_id",$userId)
        ->paginate();
            
        return $this->sendResponse(
            ComicResource::collection($comics)
            , __('messages.retrieved', ['model' => __('models/cheifs.plural')])
        );
    }

    /**
     * @param CreateComicAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/comics",
     *      summary="Store a newly created Comic in storage",
     *      tags={"Comic"},
     *      description="Store Comic",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Comic that should be stored",
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
    public function store(CreateComicAPIRequest $request)
    {
        $input = $request->all();

        $comic = $this->comicRepository->create($input);

        return $this->sendResponse(
            new ComicResource($comic),
            __('messages.saved', ['model' => __('models/comics.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/comics/{id}",
     *      summary="Display the specified Comic",
     *      tags={"Comic"},
     *      description="Get Comic",
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
        $input = $request->all();

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

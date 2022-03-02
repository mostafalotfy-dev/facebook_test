<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateShortVideoAPIRequest;
use App\Http\Requests\API\UpdateShortVideoAPIRequest;
use App\Models\ShortVideo;
use App\Repositories\ShortVideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ShortVideoProfileResource;
use App\Http\Resources\ShortVideoResource;
use Response;

/**
 * Class ShortVideoController
 * @package App\Http\Controllers\API
 */

class ShortVideoAPIController extends AppBaseController
{
    /** @var  ShortVideoRepository */
    private $shortVideoRepository;

    public function __construct(ShortVideoRepository $shortVideoRepo)
    {
        $this->shortVideoRepository = $shortVideoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/shortVideos",
     *      summary="Get a listing of the ShortVideos.",
     *      tags={"ShortVideo"},
     *      description="Get all ShortVideos",
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
     *                  @SWG\Items(ref="#/definitions/ShortVideo")
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
        $shortVideos = $this->shortVideoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip',0),
            $request->get('limit',15)
        );

        return $this->sendResponse(
            ShortVideoProfileResource::collection($shortVideos),
            __('messages.retrieved', ['model' => __('models/shortVideos.plural')])
        );
    }

    /**
     * @param CreateShortVideoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/shortVideos",
     *      summary="Store a newly created ShortVideo in storage",
     *      tags={"ShortVideo"},
     *      description="Store ShortVideo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ShortVideo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ShortVideo")
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
     *                  ref="#/definitions/ShortVideo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateShortVideoAPIRequest $request)
    {
        $input = $request->all();

        $shortVideo = $this->shortVideoRepository->create($input);

        return $this->sendResponse(
            new ShortVideoResource($shortVideo),
            __('messages.saved', ['model' => __('models/shortVideos.singular')])
        );
    }
    public function byProfile()
    {
        $this->validate(request(),[
            "user_id"=>"required",
        ]);
        $shortVideos = ShortVideo::where("user_id",request("user_id"))->cursor();
        return $this->sendResponse(ShortVideoProfileResource::collection($shortVideos),__("messages.retrieved"));
    }
    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/shortVideos/{id}",
     *      summary="Display the specified ShortVideo",
     *      tags={"ShortVideo"},
     *      description="Get ShortVideo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShortVideo",
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
     *                  ref="#/definitions/ShortVideo"
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
        /** @var ShortVideo $shortVideo */
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/shortVideos.singular')])
            );
        }

        return $this->sendResponse(
            new ShortVideoResource($shortVideo),
            __('messages.retrieved', ['model' => __('models/shortVideos.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateShortVideoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/shortVideos/{id}",
     *      summary="Update the specified ShortVideo in storage",
     *      tags={"ShortVideo"},
     *      description="Update ShortVideo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShortVideo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ShortVideo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ShortVideo")
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
     *                  ref="#/definitions/ShortVideo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateShortVideoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ShortVideo $shortVideo */
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/shortVideos.singular')])
            );
        }

        $shortVideo = $this->shortVideoRepository->update($input, $id);

        return $this->sendResponse(
            new ShortVideoResource($shortVideo),
            __('messages.updated', ['model' => __('models/shortVideos.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/shortVideos/{id}",
     *      summary="Remove the specified ShortVideo from storage",
     *      tags={"ShortVideo"},
     *      description="Delete ShortVideo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShortVideo",
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
        /** @var ShortVideo $shortVideo */
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/shortVideos.singular')])
            );
        }

        $shortVideo->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/shortVideos.singular')])
        );
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFollowingAPIRequest;
use App\Http\Requests\API\UpdateFollowingAPIRequest;
use App\Models\Following;
use App\Repositories\FollowingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FollowingResource;
use Response;

/**
 * Class FollowingController
 * @package App\Http\Controllers\API
 */

class FollowingAPIController extends AppBaseController
{
    /** @var  FollowingRepository */
    private $followingRepository;

    public function __construct(FollowingRepository $followingRepo)
    {
        $this->followingRepository = $followingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/followings",
     *      summary="Get a listing of the Followings.",
     *      tags={"Following"},
     *      description="Get all Followings",
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
     *                  @SWG\Items(ref="#/definitions/Following")
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
        $followings = $this->followingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            FollowingResource::collection($followings),
            __('messages.retrieved', ['model' => __('models/followings.plural')])
        );
    }

    /**
     * @param CreateFollowingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/followings",
     *      summary="Store a newly created Following in storage",
     *      tags={"Following"},
     *      description="Store Following",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Following that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Following")
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
     *                  ref="#/definitions/Following"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFollowingAPIRequest $request)
    {
        $input = $request->all();

        $following = $this->followingRepository->create($input);

        return $this->sendResponse(
            new FollowingResource($following),
            __('messages.saved', ['model' => __('models/followings.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/followings/{id}",
     *      summary="Display the specified Following",
     *      tags={"Following"},
     *      description="Get Following",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Following",
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
     *                  ref="#/definitions/Following"
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
        /** @var Following $following */
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/followings.singular')])
            );
        }

        return $this->sendResponse(
            new FollowingResource($following),
            __('messages.retrieved', ['model' => __('models/followings.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateFollowingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/followings/{id}",
     *      summary="Update the specified Following in storage",
     *      tags={"Following"},
     *      description="Update Following",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Following",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Following that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Following")
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
     *                  ref="#/definitions/Following"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFollowingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Following $following */
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/followings.singular')])
            );
        }

        $following = $this->followingRepository->update($input, $id);

        return $this->sendResponse(
            new FollowingResource($following),
            __('messages.updated', ['model' => __('models/followings.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/followings/{id}",
     *      summary="Remove the specified Following from storage",
     *      tags={"Following"},
     *      description="Delete Following",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Following",
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
        /** @var Following $following */
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/followings.singular')])
            );
        }

        $following->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/followings.singular')])
        );
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHashTagAPIRequest;
use App\Http\Requests\API\UpdateHashTagAPIRequest;
use App\Models\HashTag;
use App\Repositories\HashTagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\HashTagResource;
use Response;

/**
 * Class HashTagController
 * @package App\Http\Controllers\API
 */

class HashTagAPIController extends AppBaseController
{
    /** @var  HashTagRepository */
    private $hashTagRepository;

    public function __construct(HashTagRepository $hashTagRepo)
    {
        $this->hashTagRepository = $hashTagRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/hashTags",
     *      summary="Get a listing of the HashTags.",
     *      tags={"HashTag"},
     *      description="Get all HashTags",
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
     *                  @SWG\Items(ref="#/definitions/HashTag")
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
        request()->validate([
            "categories"=>"required"
        ]);
        $hashTags = $this->hashTagRepository->whereIn("category_id",explode(",",request("categories")))->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
        );

        return $this->sendResponse(
            HashTagResource::collection($hashTags),
            __('messages.retrieved', ['model' => __('models/hashTags.plural')])
        );
    }

    /**
     * @param CreateHashTagAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/hashTags",
     *      summary="Store a newly created HashTag in storage",
     *      tags={"HashTag"},
     *      description="Store HashTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="HashTag that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/HashTag")
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
     *                  ref="#/definitions/HashTag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHashTagAPIRequest $request)
    {
        $input = $request->all();

        $hashTag = $this->hashTagRepository->create($input);

        return $this->sendResponse(
            new HashTagResource($hashTag),
            __('messages.saved', ['model' => __('models/hashTags.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/hashTags/{id}",
     *      summary="Display the specified HashTag",
     *      tags={"HashTag"},
     *      description="Get HashTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of HashTag",
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
     *                  ref="#/definitions/HashTag"
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
        /** @var HashTag $hashTag */
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/hashTags.singular')])
            );
        }

        return $this->sendResponse(
            new HashTagResource($hashTag),
            __('messages.retrieved', ['model' => __('models/hashTags.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateHashTagAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/hashTags/{id}",
     *      summary="Update the specified HashTag in storage",
     *      tags={"HashTag"},
     *      description="Update HashTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of HashTag",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="HashTag that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/HashTag")
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
     *                  ref="#/definitions/HashTag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHashTagAPIRequest $request)
    {
        $input = $request->all();

        /** @var HashTag $hashTag */
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/hashTags.singular')])
            );
        }

        $hashTag = $this->hashTagRepository->update($input, $id);

        return $this->sendResponse(
            new HashTagResource($hashTag),
            __('messages.updated', ['model' => __('models/hashTags.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/hashTags/{id}",
     *      summary="Remove the specified HashTag from storage",
     *      tags={"HashTag"},
     *      description="Delete HashTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of HashTag",
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
        /** @var HashTag $hashTag */
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/hashTags.singular')])
            );
        }

        $hashTag->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/hashTags.singular')])
        );
    }
}

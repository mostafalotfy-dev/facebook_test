<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHashTagRequest;
use App\Http\Requests\UpdateHashTagRequest;
use App\Repositories\HashTagRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HashTagController extends AppBaseController
{
    /** @var HashTagRepository $hashTagRepository*/
    private $hashTagRepository;

    public function __construct(HashTagRepository $hashTagRepo)
    {
        $this->hashTagRepository = $hashTagRepo;
    }

    /**
     * Display a listing of the HashTag.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $hashTags = $this->hashTagRepository->all();

        return view('hash_tags.index')
            ->with('hashTags', $hashTags);
    }

    /**
     * Show the form for creating a new HashTag.
     *
     * @return Response
     */
    public function create()
    {
        return view('hash_tags.create');
    }

    /**
     * Store a newly created HashTag in storage.
     *
     * @param CreateHashTagRequest $request
     *
     * @return Response
     */
    public function store(CreateHashTagRequest $request)
    {
        $input = $request->all();

        $hashTag = $this->hashTagRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/hashTags.singular')]));

        return redirect(route('hashTags.index'));
    }

    /**
     * Display the specified HashTag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hashTags.singular')]));

            return redirect(route('hashTags.index'));
        }

        return view('hash_tags.show')->with('hashTag', $hashTag);
    }

    /**
     * Show the form for editing the specified HashTag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hashTags.singular')]));

            return redirect(route('hashTags.index'));
        }

        return view('hash_tags.edit')->with('hashTag', $hashTag);
    }

    /**
     * Update the specified HashTag in storage.
     *
     * @param int $id
     * @param UpdateHashTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHashTagRequest $request)
    {
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hashTags.singular')]));

            return redirect(route('hashTags.index'));
        }

        $hashTag = $this->hashTagRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/hashTags.singular')]));

        return redirect(route('hashTags.index'));
    }

    /**
     * Remove the specified HashTag from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hashTag = $this->hashTagRepository->find($id);

        if (empty($hashTag)) {
            Flash::error(__('messages.not_found', ['model' => __('models/hashTags.singular')]));

            return redirect(route('hashTags.index'));
        }

        $this->hashTagRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/hashTags.singular')]));

        return redirect(route('hashTags.index'));
    }
}

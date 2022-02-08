<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFollowingRequest;
use App\Http\Requests\UpdateFollowingRequest;
use App\Repositories\FollowingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FollowingController extends AppBaseController
{
    /** @var FollowingRepository $followingRepository*/
    private $followingRepository;

    public function __construct(FollowingRepository $followingRepo)
    {
        $this->followingRepository = $followingRepo;
    }

    /**
     * Display a listing of the Following.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $followings = $this->followingRepository->all();

        return view('followings.index')
            ->with('followings', $followings);
    }

    /**
     * Show the form for creating a new Following.
     *
     * @return Response
     */
    public function create()
    {
        return view('followings.create');
    }

    /**
     * Store a newly created Following in storage.
     *
     * @param CreateFollowingRequest $request
     *
     * @return Response
     */
    public function store(CreateFollowingRequest $request)
    {
        $input = $request->all();

        $following = $this->followingRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/followings.singular')]));

        return redirect(route('followings.index'));
    }

    /**
     * Display the specified Following.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followings.singular')]));

            return redirect(route('followings.index'));
        }

        return view('followings.show')->with('following', $following);
    }

    /**
     * Show the form for editing the specified Following.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followings.singular')]));

            return redirect(route('followings.index'));
        }

        return view('followings.edit')->with('following', $following);
    }

    /**
     * Update the specified Following in storage.
     *
     * @param int $id
     * @param UpdateFollowingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFollowingRequest $request)
    {
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followings.singular')]));

            return redirect(route('followings.index'));
        }

        $following = $this->followingRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/followings.singular')]));

        return redirect(route('followings.index'));
    }

    /**
     * Remove the specified Following from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            Flash::error(__('messages.not_found', ['model' => __('models/followings.singular')]));

            return redirect(route('followings.index'));
        }

        $this->followingRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/followings.singular')]));

        return redirect(route('followings.index'));
    }
}

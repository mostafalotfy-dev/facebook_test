<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortVideoRequest;
use App\Http\Requests\UpdateShortVideoRequest;
use App\Repositories\ShortVideoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ShortVideoController extends AppBaseController
{
    /** @var ShortVideoRepository $shortVideoRepository*/
    private $shortVideoRepository;

    public function __construct(ShortVideoRepository $shortVideoRepo)
    {
        $this->shortVideoRepository = $shortVideoRepo;
    }

    /**
     * Display a listing of the ShortVideo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $shortVideos = $this->shortVideoRepository->paginate(15);

        return view('short_videos.index')
            ->with('shortVideos', $shortVideos);
    }

    /**
     * Show the form for creating a new ShortVideo.
     *
     * @return Response
     */
    public function create()
    {
        return view('short_videos.create');
    }

    /**
     * Store a newly created ShortVideo in storage.
     *
     * @param CreateShortVideoRequest $request
     *
     * @return Response
     */
    public function store(CreateShortVideoRequest $request)
    {
        $input = $request->all();

        $shortVideo = $this->shortVideoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/shortVideos.singular')]));

        return redirect(route('shortVideos.index'));
    }

    /**
     * Display the specified ShortVideo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortVideos.singular')]));

            return redirect(route('shortVideos.index'));
        }

        return view('short_videos.show')->with('shortVideo', $shortVideo);
    }

    /**
     * Show the form for editing the specified ShortVideo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortVideos.singular')]));

            return redirect(route('shortVideos.index'));
        }

        return view('short_videos.edit')->with('shortVideo', $shortVideo);
    }

    /**
     * Update the specified ShortVideo in storage.
     *
     * @param int $id
     * @param UpdateShortVideoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShortVideoRequest $request)
    {
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortVideos.singular')]));

            return redirect(route('shortVideos.index'));
        }

        $shortVideo = $this->shortVideoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/shortVideos.singular')]));

        return redirect(route('shortVideos.index'));
    }

    /**
     * Remove the specified ShortVideo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shortVideo = $this->shortVideoRepository->find($id);

        if (empty($shortVideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortVideos.singular')]));

            return redirect(route('shortVideos.index'));
        }

        $this->shortVideoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/shortVideos.singular')]));

        return redirect(route('shortVideos.index'));
    }
}

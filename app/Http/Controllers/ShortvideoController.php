<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortvideoRequest;
use App\Http\Requests\UpdateShortvideoRequest;
use App\Repositories\ShortvideoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ShortvideoController extends AppBaseController
{
    /** @var ShortvideoRepository $shortvideoRepository*/
    private $shortvideoRepository;

    public function __construct(ShortvideoRepository $shortvideoRepo)
    {
        $this->shortvideoRepository = $shortvideoRepo;
    }

    /**
     * Display a listing of the Shortvideo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $shortvideos = $this->shortvideoRepository->paginate(15);

        return view('shortvideos.index')
            ->with('shortvideos', $shortvideos);
    }

    /**
     * Show the form for creating a new Shortvideo.
     *
     * @return Response
     */
    public function create()
    {
        return view('shortvideos.create');
    }

    /**
     * Store a newly created Shortvideo in storage.
     *
     * @param CreateShortvideoRequest $request
     *
     * @return Response
     */
    public function store(CreateShortvideoRequest $request)
    {
        $input = $request->all();

        $shortvideo = $this->shortvideoRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/shortvideos.singular')]));

        return redirect(route('shortvideos.index'));
    }

    /**
     * Display the specified Shortvideo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shortvideo = $this->shortvideoRepository->find($id);

        if (empty($shortvideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortvideos.singular')]));

            return redirect(route('shortvideos.index'));
        }

        return view('shortvideos.show')->with('shortvideo', $shortvideo);
    }

    /**
     * Show the form for editing the specified Shortvideo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shortvideo = $this->shortvideoRepository->find($id);

        if (empty($shortvideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortvideos.singular')]));

            return redirect(route('shortvideos.index'));
        }

        return view('shortvideos.edit')->with('shortvideo', $shortvideo);
    }

    /**
     * Update the specified Shortvideo in storage.
     *
     * @param int $id
     * @param UpdateShortvideoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShortvideoRequest $request)
    {
        $shortvideo = $this->shortvideoRepository->find($id);

        if (empty($shortvideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortvideos.singular')]));

            return redirect(route('shortvideos.index'));
        }

        $shortvideo = $this->shortvideoRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/shortvideos.singular')]));

        return redirect(route('shortvideos.index'));
    }

    /**
     * Remove the specified Shortvideo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shortvideo = $this->shortvideoRepository->find($id);

        if (empty($shortvideo)) {
            Flash::error(__('messages.not_found', ['model' => __('models/shortvideos.singular')]));

            return redirect(route('shortvideos.index'));
        }

        $this->shortvideoRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/shortvideos.singular')]));

        return redirect(route('shortvideos.index'));
    }
}

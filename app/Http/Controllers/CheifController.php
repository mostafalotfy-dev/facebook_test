<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheifRequest;
use App\Http\Requests\UpdateCheifRequest;
use App\Repositories\CheifRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CheifController extends AppBaseController
{
    /** @var CheifRepository $cheifRepository*/
    private $cheifRepository;

    public function __construct(CheifRepository $cheifRepo)
    {
        $this->cheifRepository = $cheifRepo;
    }

    /**
     * Display a listing of the Cheif.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cheifs = $this->cheifRepository->paginate(15);

        return view('cheifs.index')
            ->with('cheifs', $cheifs);
    }

    /**
     * Show the form for creating a new Cheif.
     *
     * @return Response
     */
    public function create()
    {
        return view('cheifs.create');
    }

    /**
     * Store a newly created Cheif in storage.
     *
     * @param CreateCheifRequest $request
     *
     * @return Response
     */
    public function store(CreateCheifRequest $request)
    {
        $input = $request->all();

        $cheif = $this->cheifRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/cheifs.singular')]));

        return redirect(route('cheifs.index'));
    }

    /**
     * Display the specified Cheif.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cheif = $this->cheifRepository->find($id);

        if (empty($cheif)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cheifs.singular')]));

            return redirect(route('cheifs.index'));
        }

        return view('cheifs.show')->with('cheif', $cheif);
    }

    /**
     * Show the form for editing the specified Cheif.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cheif = $this->cheifRepository->find($id);

        if (empty($cheif)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cheifs.singular')]));

            return redirect(route('cheifs.index'));
        }

        return view('cheifs.edit')->with('cheif', $cheif);
    }

    /**
     * Update the specified Cheif in storage.
     *
     * @param int $id
     * @param UpdateCheifRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCheifRequest $request)
    {
        $cheif = $this->cheifRepository->find($id);

        if (empty($cheif)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cheifs.singular')]));

            return redirect(route('cheifs.index'));
        }

        $cheif = $this->cheifRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/cheifs.singular')]));

        return redirect(route('cheifs.index'));
    }

    /**
     * Remove the specified Cheif from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cheif = $this->cheifRepository->find($id);

        if (empty($cheif)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cheifs.singular')]));

            return redirect(route('cheifs.index'));
        }

        $this->cheifRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/cheifs.singular')]));

        return redirect(route('cheifs.index'));
    }
}

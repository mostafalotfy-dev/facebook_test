<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Repositories\ReplyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReplyController extends AppBaseController
{
    /** @var ReplyRepository $replyRepository*/
    private $replyRepository;

    public function __construct(ReplyRepository $replyRepo)
    {
        $this->replyRepository = $replyRepo;
    }

    /**
     * Display a listing of the Reply.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $replies = $this->replyRepository->all();

        return view('replies.index')
            ->with('replies', $replies);
    }

    /**
     * Show the form for creating a new Reply.
     *
     * @return Response
     */
    public function create()
    {
        return view('replies.create');
    }

    /**
     * Store a newly created Reply in storage.
     *
     * @param CreateReplyRequest $request
     *
     * @return Response
     */
    public function store(CreateReplyRequest $request)
    {
        $input = $request->all();

        $reply = $this->replyRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/replies.singular')]));

        return redirect(route('replies.index'));
    }

    /**
     * Display the specified Reply.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reply = $this->replyRepository->find($id);

        if (empty($reply)) {
            Flash::error(__('messages.not_found', ['model' => __('models/replies.singular')]));

            return redirect(route('replies.index'));
        }

        return view('replies.show')->with('reply', $reply);
    }

    /**
     * Show the form for editing the specified Reply.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reply = $this->replyRepository->find($id);

        if (empty($reply)) {
            Flash::error(__('messages.not_found', ['model' => __('models/replies.singular')]));

            return redirect(route('replies.index'));
        }

        return view('replies.edit')->with('reply', $reply);
    }

    /**
     * Update the specified Reply in storage.
     *
     * @param int $id
     * @param UpdateReplyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReplyRequest $request)
    {
        $reply = $this->replyRepository->find($id);

        if (empty($reply)) {
            Flash::error(__('messages.not_found', ['model' => __('models/replies.singular')]));

            return redirect(route('replies.index'));
        }

        $reply = $this->replyRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/replies.singular')]));

        return redirect(route('replies.index'));
    }

    /**
     * Remove the specified Reply from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reply = $this->replyRepository->find($id);

        if (empty($reply)) {
            Flash::error(__('messages.not_found', ['model' => __('models/replies.singular')]));

            return redirect(route('replies.index'));
        }

        $this->replyRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/replies.singular')]));

        return redirect(route('replies.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComicRequest;
use App\Http\Requests\UpdateComicRequest;
use App\Repositories\ComicRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ComicController extends AppBaseController
{
    /** @var ComicRepository $comicRepository*/
    private $comicRepository;

    public function __construct(ComicRepository $comicRepo)
    {
        $this->comicRepository = $comicRepo;
    }

    /**
     * Display a listing of the Comic.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $comics = $this->comicRepository->paginate(15);

        return view('comics.index')
            ->with('comics', $comics);
    }

    /**
     * Show the form for creating a new Comic.
     *
     * @return Response
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created Comic in storage.
     *
     * @param CreateComicRequest $request
     *
     * @return Response
     */
    public function store(CreateComicRequest $request)
    {
        $input = $request->all();
        $input["is_active"] = 1;
        $input["user_id"] = auth()->id();
        $comic = $this->comicRepository->create($input);
        if (request("media")) {
            $media = collect(request()->file("media"));

            $media =  $media->map(function ($media, $i) use ($comic) {
                $fileName = uniqid() . request("media.$i")->getClientOriginalExtension();
                request()->file("media.$i")->storeAs("public", $fileName);
                return [
                    "file_name" => $fileName,
                    "mime_type" => $media->getMimeType(),
                    "comic_id" => $comic->id,
                    "user_id" => auth()->id()
                ];
            });
            $comic->comicsAlbums()->insert(
                $media->toArray()
            );
        }
        Flash::success(__('messages.saved', ['model' => __('models/comics.singular')]));

        return redirect(route('comics.index'));
    }

    /**
     * Display the specified Comic.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comics.singular')]));

            return redirect(route('comics.index'));
        }

        return view('comics.show')->with('comic', $comic);
    }

    /**
     * Show the form for editing the specified Comic.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comics.singular')]));

            return redirect(route('comics.index'));
        }

        return view('comics.edit')->with('comic', $comic);
    }

    /**
     * Update the specified Comic in storage.
     *
     * @param int $id
     * @param UpdateComicRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComicRequest $request)
    {
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comics.singular')]));

            return redirect(route('comics.index'));
        }
        $input = $request->all();
        $input["is_active"] = 1;
        $comic = $this->comicRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/comics.singular')]));

        return redirect(route('comics.index'));
    }

    /**
     * Remove the specified Comic from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comic = $this->comicRepository->find($id);

        if (empty($comic)) {
            Flash::error(__('messages.not_found', ['model' => __('models/comics.singular')]));

            return redirect(route('comics.index'));
        }

        $this->comicRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/comics.singular')]));

        return redirect(route('comics.index'));
    }
}

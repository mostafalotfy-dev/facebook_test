<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Repositories\RecipeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RecipeController extends AppBaseController
{
    /** @var RecipeRepository $recipeRepository*/
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepo)
    {
        $this->recipeRepository = $recipeRepo;
    }

    /**
     * Display a listing of the Recipe.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $recipes = $this->recipeRepository->all();

        return view('recipes.index')
            ->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new Recipe.
     *
     * @return Response
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created Recipe in storage.
     *
     * @param CreateRecipeRequest $request
     *
     * @return Response
     */
    public function store(CreateRecipeRequest $request)
    {
        $input = $request->all();

        $recipe = $this->recipeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/recipes.singular')]));

        return redirect(route('recipes.index'));
    }

    /**
     * Display the specified Recipe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            Flash::error(__('messages.not_found', ['model' => __('models/recipes.singular')]));

            return redirect(route('recipes.index'));
        }

        return view('recipes.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified Recipe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            Flash::error(__('messages.not_found', ['model' => __('models/recipes.singular')]));

            return redirect(route('recipes.index'));
        }

        return view('recipes.edit')->with('recipe', $recipe);
    }

    /**
     * Update the specified Recipe in storage.
     *
     * @param int $id
     * @param UpdateRecipeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecipeRequest $request)
    {
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            Flash::error(__('messages.not_found', ['model' => __('models/recipes.singular')]));

            return redirect(route('recipes.index'));
        }

        $recipe = $this->recipeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/recipes.singular')]));

        return redirect(route('recipes.index'));
    }

    /**
     * Remove the specified Recipe from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            Flash::error(__('messages.not_found', ['model' => __('models/recipes.singular')]));

            return redirect(route('recipes.index'));
        }

        $this->recipeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/recipes.singular')]));

        return redirect(route('recipes.index'));
    }
}

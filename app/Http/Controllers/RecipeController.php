<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Repositories\RecipeRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Steps;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Step;
use App\Models\Recipe;
use App\Models\HashTag;
use App\Models\RecipeAlbum;
use App\Models\User;


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
          
            $recipes = Recipe::paginate();
       
       

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
        $categories = Category::all()->pluck("name_" . app()->getLocale(), "id");
        return view('recipes.create', compact("categories"));
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
        $input = $request->except("ingredients", "steps","media");
        $input["created_by"] = auth("admin")->id();
        $input["is_active"] = 1;
        \DB::beginTransaction();
        $recipe = $this->recipeRepository->create($input);
        $ingredients = json_decode($request->ingredients);
        $ingredients = array_map(function ($ingredient) use ($recipe) {
            return [
                "description" => $ingredient->value,
                "recipe_id" => $recipe,
                "created_at" => now(),
            ];
        }, $ingredients);

        $steps = json_decode($request->steps);
        $steps = array_map(function ($step) use ($recipe) {
            return [
                "step_description" => $step->value,
                "recipe_id" => $recipe,
                "created_at" => now(),
            ];
        }, $steps);

        Ingredient::insert($ingredients);
        Step::insert($steps);
        Hashtag::find(request("hash_tag_id"))->recipes()->attach($recipe);
        if(request("media"))
        {        
        $files = collect(request("media"));
        
        $files = $files->map(function($file) use($recipe){
          
            $fileName = uniqid().$file->getclientoriginalextension();
          
            $file->move("storage",$fileName);
         
            RecipeAlbum::create([
                "mime_type"=>$file->getClientMimeType(),
                "file_name"=>$fileName,
                "recipe_id"=>$recipe,
                "user_id"=>auth("admin")->id(),
                "created_at"=>now()
            ]);
        });
    
      
    }
    \DB::commit();
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
        $recipe = Recipe::find($id);

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
        $recipe = Recipe::find($id);

        if (empty($recipe)) {
            Flash::error(__('messages.not_found', ['model' => __('models/recipes.singular')]));

            return redirect(route('recipes.index'));
        }
        $categories = Category::all()->pluck("name_" . app()->getLocale(), "id");
        return view('recipes.edit')->with('recipe', $recipe)->with("categories", $categories);
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
        $input = $request->except("ingredients","steps","media");

        $recipe = $this->recipeRepository->update($input, $id);

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

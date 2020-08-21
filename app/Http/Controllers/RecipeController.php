<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Recipe;
use App\RecipeCategory;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|View
     */
    public function index()
    {
        $categoryId = request()->category;
        $categoryName = $categoryId === null
            ? 'Wszystkie'
            : RecipeCategory::find($categoryId)->name;
        $recipes = $categoryId === null
            ? Recipe::paginate(15)
            : Recipe::whereRecipeCategoryId(request()->get('category'))->paginate(15);

        $recipes->appends(\request()->except('page'));

        return view('recipe.index', compact('recipes', 'categoryName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $this->authorize('create', Recipe::class);
        $recipe = new Recipe();

        return view('recipe.create', compact('recipe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRecipeRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(StoreRecipeRequest $request)
    {
        $this->authorize('create', Recipe::class);

        $dictionary = 'recipes-pic';
        $uploadedFile = $request->file('picture');
        $uploadedFile = $uploadedFile != null
            ? $uploadedFile->store($dictionary, 'public')
            : null;

        $recipe = Recipe::create(
            array_merge($request->validated(),
                [
                    'user_id' => auth()->user()->id,
                    'picture' => $uploadedFile,
                ]
            )
        );

        $recipe->recipeIngredients()->createMany($request->validated()['ingredients']);
        foreach ($request->validated()['steps'] as $key => $step) {
            $dictionary = 'recipe-steps-pic';
            $uploadedFile = $request->file('steps.'.$key.'.picture');
            $uploadedFile = $uploadedFile != null
                ? $uploadedFile->store($dictionary, 'public')
                : null;

            $recipe->recipeSteps()->create([
                'instruction' => $step['instruction'],
                'order' => $key,
                'picture' => $uploadedFile,
            ]);
        }

        return redirect(route('recipes.show', $recipe), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Recipe $recipe
     * @return Application|Factory|Response|View
     */
    public function show(Recipe $recipe)
    {
        return view('recipe.show', ['recipe' => $recipe]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Recipe $recipe
     * @return Application|Factory|Response|View
     * @throws AuthorizationException
     */
    public function edit(Recipe $recipe)
    {
        $this->authorize('update', Recipe::class);

        return view('recipe.create', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Recipe $recipe
     * @return Response
     */
    public function update(Request $request, Recipe $recipe): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Recipe $recipe
     * @return RedirectResponse|Response
     */
    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return back();
    }
}

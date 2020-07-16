<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RecipeCategory $category
     * @return Response|View
     */
    public function index()
    {
        $categoryId = request()->get('category');
        $categoryName = $categoryId === null
            ? 'Wszystkie'
            : RecipeCategory::find($categoryId)->name;
        $recipes = $categoryId === null
            ? Recipe::paginate(15)
            : Recipe::whereRecipeCategoryId(request()->get('category'))->paginate(15);

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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        dd($request);
        $this->validate($request, [
            'name' => 'required|text|min:3',
            'description' => 'max:255'
        ]);

        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Recipe $recipe
     * @return Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Recipe $recipe
     * @return Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Recipe $recipe
     * @return Response
     */
    public function update(Request $request, Recipe $recipe)
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

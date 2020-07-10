<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RecipeCategory $category
     * @return Response|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
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
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|text|min:3',
            'description' => 'max:255'
        ]);

        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Recipe $recipe
     * @return Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Recipe $recipe
     * @return Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Recipe $recipe
     * @return Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Recipe $recipe
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return back();
    }
}

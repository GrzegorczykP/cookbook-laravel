<?php

namespace App\Http\Requests;

use App\Ingredient;
use App\MeasureUnit;
use App\Recipe;
use App\RecipeCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'description' => 'required|string',
            'picture' => 'image|nullable',
            'recipe_category_id' => ['bail', 'required', Rule::in(RecipeCategory::all()->pluck('id'))],
            'prepare_time' => 'required|numeric|min:1|max:360',
            'difficulty' => 'required|in:easy,medium,hard',
            'serves' => 'required|numeric|min:1|max:16',
            'recipe_steps' => 'required|array',
            'recipe_steps.*.instruction' => 'required|string',
            'recipe_steps.*.picture' => 'nullable|image',
            'recipe_ingredients' => 'required|array',
            'recipe_ingredients.*.quantity' => 'required|numeric|min:1',
            'recipe_ingredients.*.measure_unit_id' => ['bail', 'required', Rule::in(MeasureUnit::all()->pluck('id'))],
            'recipe_ingredients.*.ingredient_id' => ['bail', 'required', Rule::in(Ingredient::all()->pluck('id'))],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nazwa',
            'description' => 'opis',
            'picture' => 'zdjęcie',
            'recipe_category_id' => 'kategoria',
            'prepare_time' => 'czas przygotowania',
            'difficulty' => 'trudność przygotowania',
            'serves' => 'porcje',
            'recipe_steps' => 'instrukcje przygotowania',
//            'steps.*.instructions' => 'instrukcja przygotowania',
//            'steps.*.picture' => 'zdjęcie kroku',
            'recipe_ingredients' => 'lista składników',
//            'ingredients.*.quantity' => 'ilość składników',
//            'ingredients.*.unit' => 'jednostka miary',
//            'ingredients.*.ingredient' => 'nazwa składnika',
        ];
    }
}

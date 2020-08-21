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
            'steps' => 'required|array',
            'steps.*.instruction' => 'required|string',
            'steps.*.picture' => 'nullable|image',
            'ingredients' => 'required|array',
            'ingredients.*.quantity' => 'required|numeric|min:1',
            'ingredients.*.measure_unit_id' => ['bail', 'required', Rule::in(MeasureUnit::all()->pluck('id'))],
            'ingredients.*.ingredient_id' => ['bail', 'required', Rule::in(Ingredient::all()->pluck('id'))],
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
            'steps' => 'instrukcje przygotowania',
//            'steps.*.instructions' => 'instrukcja przygotowania',
//            'steps.*.picture' => 'zdjęcie kroku',
            'ingredients' => 'lista składników',
//            'ingredients.*.quantity' => 'ilość składników',
//            'ingredients.*.unit' => 'jednostka miary',
//            'ingredients.*.ingredient' => 'nazwa składnika',
        ];
    }
}

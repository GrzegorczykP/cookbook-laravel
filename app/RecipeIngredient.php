<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeIngredient
 *
 * @property int $recipe_id
 * @property int $ingredient_id
 * @property int $measure_unit_id
 * @property string $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient whereIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient whereMeasureUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeIngredient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecipeIngredient extends Model
{
    protected $with = ['ingredient', 'measure_unit'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function measure_unit()
    {
        return $this->belongsTo(MeasureUnit::class);
    }
}

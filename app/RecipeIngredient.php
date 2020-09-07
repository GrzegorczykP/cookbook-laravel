<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\RecipeIngredient
 *
 * @property int $recipe_id
 * @property int $ingredient_id
 * @property int $measure_unit_id
 * @property string $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RecipeIngredient newModelQuery()
 * @method static Builder|RecipeIngredient newQuery()
 * @method static Builder|RecipeIngredient query()
 * @method static Builder|RecipeIngredient whereCreatedAt($value)
 * @method static Builder|RecipeIngredient whereIngredientId($value)
 * @method static Builder|RecipeIngredient whereMeasureUnitId($value)
 * @method static Builder|RecipeIngredient whereQuantity($value)
 * @method static Builder|RecipeIngredient whereRecipeId($value)
 * @method static Builder|RecipeIngredient whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Ingredient $ingredient
 * @property-read MeasureUnit $measure_unit
 */
class RecipeIngredient extends Model
{
    protected $fillable = ['ingredient_id', 'measure_unit_id', 'quantity'];

    protected $with = ['ingredient', 'measureUnit'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function measureUnit()
    {
        return $this->belongsTo(MeasureUnit::class);
    }
}

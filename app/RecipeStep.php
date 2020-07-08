<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeStep
 *
 * @property int $recipe_id
 * @property string|null $picture
 * @property string $instructions
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeStep whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecipeStep extends Model
{
    //
}

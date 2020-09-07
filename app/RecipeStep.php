<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\RecipeStep
 *
 * @property int $recipe_id
 * @property string|null $picture
 * @property string $instructions
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RecipeStep newModelQuery()
 * @method static Builder|RecipeStep newQuery()
 * @method static Builder|RecipeStep query()
 * @method static Builder|RecipeStep whereCreatedAt($value)
 * @method static Builder|RecipeStep whereInstructions($value)
 * @method static Builder|RecipeStep whereOrder($value)
 * @method static Builder|RecipeStep wherePicture($value)
 * @method static Builder|RecipeStep whereRecipeId($value)
 * @method static Builder|RecipeStep whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $instruction
 * @method static Builder|RecipeStep whereInstruction($value)
 */
class RecipeStep extends Model
{
    protected $fillable = [
        'instruction', 'order', 'picture'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

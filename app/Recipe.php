<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Recipe
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $picture
 * @property int $recipe_category_id
 * @property int $prepare_time
 * @property int $user_id
 * @property string $difficulty
 * @property int $serves
 * @property int $verified
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RecipeIngredient[] $recipeIngredients
 * @property-read int|null $recipe_ingredients_count
 * @property-read Collection|RecipeStep[] $steps
 * @property-read int|null $steps_count
 * @method static Builder|Recipe newModelQuery()
 * @method static Builder|Recipe newQuery()
 * @method static Builder|Recipe query()
 * @method static Builder|Recipe whereCreatedAt($value)
 * @method static Builder|Recipe whereDescription($value)
 * @method static Builder|Recipe whereDifficulty($value)
 * @method static Builder|Recipe whereId($value)
 * @method static Builder|Recipe whereName($value)
 * @method static Builder|Recipe wherePicture($value)
 * @method static Builder|Recipe wherePrepareTime($value)
 * @method static Builder|Recipe whereRecipeCategoryId($value)
 * @method static Builder|Recipe whereServes($value)
 * @method static Builder|Recipe whereUpdatedAt($value)
 * @method static Builder|Recipe whereUserId($value)
 * @method static Builder|Recipe whereVerified($value)
 * @mixin Eloquent
 * @property-read Collection|RecipeStep[] $recipeSteps
 * @property-read int|null $recipe_steps_count
 */
class Recipe extends Model
{
    const DIFFICULTY = [
        'easy' => 'łatwy',
        'medium' => 'średni',
        'hard' => 'trudny',
    ];

    protected $fillable = [
        'name', 'description', 'picture', 'prepare_time', 'difficulty', 'serves', 'recipe_category_id', 'user_id'
    ];

    public function recipeSteps()
    {
        return $this->hasMany(RecipeStep::class)->orderBy('order');
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Recipe
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $picture
 * @property int $prepare_time
 * @property int $user_id
 * @property string $difficulty
 * @property int $serves
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe wherePrepareTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereServes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recipe whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeIngredient[] $ingredients
 * @property-read int|null $ingredients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeStep[] $steps
 * @property-read int|null $steps_count
 */
class Recipe extends Model
{
    protected $fillable = [
        'name', 'description', 'picture', 'prepare_time', 'difficulty', 'serves'
    ];

    public function steps()
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RecipeCategory
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RecipeCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RecipeCategory extends Model
{
    /**
     * @return string
     */
    public function getNameAttribute($value): string
    {
        return ucfirst($value);
    }
}

<?php

use App\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recipe::class, 10)->create()->each(function ($recipe) {
            for ($i = 0; $i < rand(1, 10); $i++) {
                $recipe->recipeSteps()->create(
                    factory(App\RecipeStep::class)->make(['order' => $i])->toArray()
                );
            }
            $recipe->recipeIngredients()->createMany(
                factory(App\RecipeIngredient::class, rand(3, 8))->make()->toArray()
            );
        });
    }
}

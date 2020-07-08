<?php

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
        factory(\App\Recipe::class, 100)->create()->each(function ($recipe) {
            $order = $recipe->steps()->count();
            for ($i = 0; $i < rand(1, 10); $i++) {
                $recipe->steps()->create(
                    factory(App\RecipeStep::class)->make(['order' => $i])->toArray()
                );
            }
            $recipe->recipeIngredients()->createMany(
                factory(App\RecipeIngredient::class, rand(3, 8))->make()->toArray()
            );
        });
    }
}

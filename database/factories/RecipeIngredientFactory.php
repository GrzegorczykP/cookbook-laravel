<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RecipeIngredient;
use Faker\Generator as Faker;

$factory->define(RecipeIngredient::class, function (Faker $faker) {
    return [
        'recipe_id' => \App\Recipe::all()->isNotEmpty() ? \App\Recipe::all()->random()->id : factory(App\Recipe::class),
        'ingredient_id' => \App\Ingredient::all()->isNotEmpty() ? \App\Ingredient::all()->random()->id : factory(App\Ingredient::class),
        'measure_unit_id' => \App\MeasureUnit::all()->isNotEmpty() ? \App\MeasureUnit::all()->random()->id : factory(App\MeasureUnit::class),
        'quantity' => $faker->randomFloat(2, 0.01, 10000),
    ];
});

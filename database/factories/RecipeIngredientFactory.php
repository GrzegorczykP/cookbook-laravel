<?php

/** @var Factory $factory */

use App\Ingredient;
use App\MeasureUnit;
use App\Recipe;
use App\RecipeIngredient;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(RecipeIngredient::class, function (Faker $faker) {
    return [
        'recipe_id' => Recipe::all()->isNotEmpty() ? Recipe::all()->random() : factory(App\Recipe::class),
        'ingredient_id' => Ingredient::all()->isNotEmpty() ? Ingredient::all()->random() : factory(App\Ingredient::class),
        'measure_unit_id' => MeasureUnit::all()->isNotEmpty() ? MeasureUnit::all()->random() : factory(App\MeasureUnit::class),
        'quantity' => $faker->randomFloat(2, 0.01, 10000),
    ];
});

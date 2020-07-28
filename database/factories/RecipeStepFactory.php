<?php

/** @var Factory $factory */

use App\Recipe;
use App\RecipeStep;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;


$factory->define(RecipeStep::class, function (Faker $faker) {
    static $order = 0;
    return [
        'recipe_id' => Recipe::all()->isNotEmpty() ? Recipe::all()->random() : factory(App\Recipe::class),
        'instructions' => $faker->realText(),
        'order' => $order++,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RecipeStep;
use Faker\Generator as Faker;


$factory->define(RecipeStep::class, function (Faker $faker) {
    static $order = 0;
    return [
        'recipe_id' => \App\Recipe::all()->isNotEmpty() ? \App\Recipe::all()->random()->id : factory(App\Recipe::class),
        'instructions' => $faker->paragraph(),
        'order' => $order++,
    ];
});

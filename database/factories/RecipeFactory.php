<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'prepare_time' => $faker->numberBetween(2, 72) * 5, // from 10 to 360 every 5
        'recipe_category_id' => \App\RecipeCategory::all()->isNotEmpty() ? \App\RecipeCategory::all()->random()->id : factory(App\RecipeCategory::class),
        'user_id' => \App\User::all()->isNotEmpty() ? \App\User::all()->random()->id : factory(App\User::class),
        'difficulty' => $faker->randomElement(['easy', 'medium', 'hard']),
        'serves' => $faker->numberBetween(1, 12),
        'verified' => $faker->boolean,
    ];
});

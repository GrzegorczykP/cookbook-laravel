<?php

/** @var Factory $factory */

use App\Recipe;
use App\RecipeCategory;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(),
        'prepare_time' => $faker->numberBetween(2, 72) * 5, // from 10 to 360 every 5
        'recipe_category_id' => RecipeCategory::all()->isNotEmpty() ? RecipeCategory::all()->random() : factory(App\RecipeCategory::class),
        'user_id' => \App\User::all()->isNotEmpty() ? \App\User::all()->random()->id : factory(App\User::class),
        'difficulty' => $faker->randomElement(['easy', 'medium', 'hard']),
        'serves' => $faker->numberBetween(1, 12),
        'verified' => $faker->boolean,
    ];
});

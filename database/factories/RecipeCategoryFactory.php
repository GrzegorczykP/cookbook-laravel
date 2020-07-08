<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RecipeCategory;
use Faker\Generator as Faker;

$factory->define(RecipeCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
    ];
});

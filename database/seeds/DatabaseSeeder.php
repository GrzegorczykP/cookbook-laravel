<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(MeasureUnitSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(RecipeCategorySeeder::class);
        $this->call(RecipeSeeder::class);
    }
}

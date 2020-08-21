<?php

namespace Tests\Feature;

use App\Ingredient;
use App\Recipe;
use App\RecipeIngredient;
use App\RecipeStep;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

/**
 * Class RecipeTest
 * @package Tests\Feature
 */
class RecipeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanAddRecipeByUser()
    {
        $user = $this->getUserByRoles('user');

        $this->withoutExceptionHandling();

        $recipe = $this->recipeData();
        $response = $this->actingAs($user)->post(route('recipes.store'), $recipe);

        $response->assertCreated();
        $this->assertDatabaseHas('recipes', ['name' => $recipe['name']]);
    }

    /**
     *
     */
    public function testCantAddRecipeByGuest()
    {
        $this->get(route('recipes.create'))->assertForbidden();

        $recipe = $this->recipeData();
        $response = $this->post(route('recipes.store'), $recipe);

        $response->assertForbidden();
        $this->assertDatabaseMissing('recipes', ['name' => $recipe['name']]);
    }

    /**
     *
     */
    public function testCanUploadRecipePicture()
    {
        $user = $this->getUserByRoles('user');

        $recipe = $this->recipeData();
        $file = UploadedFile::fake()->image('image.jpg')->size(1000);
        $recipe['picture'] = $file;

        $this->actingAs($user)->post(route('recipes.store'), $recipe);

        Storage::disk('public')->assertExists('recipes-pic/' . $file->hashName());
        $this->assertDatabaseHas('recipes', ['picture' => 'recipes-pic/' . $file->hashName()]);
    }

    /**
     *
     */
    public function testIngredientsAreAddedToRecipe()
    {
        $user = $this->getUserByRoles('user');

        $recipe = $this->recipeData();
        $this->actingAs($user)->post(route('recipes.store'), $recipe);

        $newRecipe = Recipe::all()->sortByDesc('created_at')->first();
        $this->assertDatabaseHas('recipe_ingredients', ['recipe_id' => $newRecipe->id]);
        $addedIngredients = RecipeIngredient::whereRecipeId($newRecipe->id)->get()->toArray();
        $this->assertSameSize($addedIngredients, $recipe['ingredients']);
    }

    public function testStepsAreAddedToRecipe()
    {
        $user = $this->getUserByRoles('user');

        $recipe = $this->recipeData();
        $this->actingAs($user)->post(route('recipes.store'), $recipe);

        $newRecipe = Recipe::all()->sortByDesc('created_at')->first();
        $this->assertDatabaseHas('recipe_steps', ['recipe_id' => $newRecipe->id]);
        $addedSteps = RecipeStep::whereRecipeId($newRecipe->id)->get()->toArray();
        $this->assertSameSize($addedSteps, $recipe['steps']);
    }

    public function testPictureToStepCanBeAdded()
    {
        $user = $this->getUserByRoles('user');

        $recipe = $this->recipeData();
        foreach ($recipe['steps'] as $key => &$step) {
            $file = UploadedFile::fake()->image('image'.$key.'.jpg')->size(1000);
            $step['picture'] = $file;
        }

        $this->actingAs($user)->post(route('recipes.store'), $recipe);

        $newRecipe = Recipe::all()->sortByDesc('created_at')->first();
        $this->assertDatabaseHas('recipe_steps', ['recipe_id' => $newRecipe->id]);
        $recipeSteps = RecipeStep::whereRecipeId($newRecipe->id)->get();
        foreach ($recipeSteps as $recipeStep) {
            $this->assertNotNull($recipeStep['picture']);
        }
        $this->assertSameSize($recipeSteps->toArray(), $recipe['steps']);
    }


    /**
     * @param string $role
     * @return User
     */
    public function getUserByRoles(string $role)
    {
        $user = User::role($role)
            ->inRandomOrder()
            ->first();
        if ($user == null) {
            $user = factory(User::class)->create();
            $user->assignRole($role);
        }
        return $user;
    }

    private function recipeData(): array
    {
        $recipe = factory(Recipe::class)->make()->toArray();
        unset($recipe['user_id'], $recipe['verified']);
        $recipe['ingredients'] = factory(RecipeIngredient::class, rand(1, 6))->make()
            ->map(function ($value) {
                return $value->only('quantity', 'measure_unit_id', 'ingredient_id');
            })->toArray();
        $recipe['steps'] = factory(RecipeStep::class, rand(2, 8))->make()
            ->map(function ($value) {
                return $value->only('instruction');
            })->toArray();

        return $recipe;
    }
}

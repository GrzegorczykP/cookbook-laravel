<?php

namespace Tests\Feature;

use App\Ingredient;
use App\Recipe;
use App\RecipeIngredient;
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

        $recipe = factory(Recipe::class)->make(['user_id' => $user->id]);
        $response = $this->actingAs($user)->post(route('recipes.store'), $recipe->toArray());

        $response->assertCreated();
        $this->assertDatabaseHas('recipes', ['name' => $recipe->name]);
    }

    /**
     *
     */
    public function testCantAddRecipeByGuest()
    {
        $this->get(route('recipes.create'))->assertForbidden();

        $recipe = factory(Recipe::class)->make();
        $response = $this->post(route('recipes.store'), $recipe->toArray());

        $response->assertForbidden();
        $this->assertDatabaseMissing('recipes', $recipe->toArray());
    }

    /**
     *
     */
    public function testCanUploadRecipePicture()
    {
        $user = $this->getUserByRoles('user');

        $recipe = factory(Recipe::class)->make(['user_id' => $user->id]);
        $file = UploadedFile::fake()->image('image.jpg')->size(1000);
        $recipe->picture = $file;

        $this->actingAs($user)->post(route('recipes.store'), $recipe->toArray());

        Storage::disk('public')->assertExists('recipes-pic/' . $file->hashName());
        $this->assertDatabaseHas('recipes', ['picture' => 'recipes-pic/' . $file->hashName()]);
    }

    public function testIngredientsAreAddedToRecipe()
    {
        $user = $this->getUserByRoles('user');

        $recipe = factory(Recipe::class)->make(['user_id' => $user->id]);
        $ingredients = factory(RecipeIngredient::class, rand(1, 6))->make();
        dd($ingredients);
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
}

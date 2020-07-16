<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddingRecipeByUser()
    {
        $user = factory(User::class)->create();
        $user->assignRole('user');

        $response = $this->post(route('recipes.store'));
    }
}

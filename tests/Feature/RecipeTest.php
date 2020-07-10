<?php

namespace Tests\Feature;

use Tests\TestCase;

class RecipeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddingRecipe()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

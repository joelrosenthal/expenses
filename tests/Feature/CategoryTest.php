<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function itGetsCategories()
    {
        $categories = factory(Category::class, 3)->create();

        $response = $this->get(route('categories.index'));

        $response->assertJsonFragment(
            [
                'data' => $categories->toArray()
            ]
        );
    }
}

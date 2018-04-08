<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

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

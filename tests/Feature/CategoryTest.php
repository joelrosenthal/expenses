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
                'data' => $categories->toArray(),
            ]
        );
    }

    /** @test */
    public function itCreatesACategory()
    {
        $category = factory(Category::class)->make();

        $response = $this->post(route('categories.store'), $category->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseHas($category->getTable(), $category->toArray());
    }

    /** @test */
    public function itSeesACategory()
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('categories.show', $category->id));

        $response->assertStatus(200);
        $response->assertJsonFragment($category->toArray());
    }

    /** @test */
    public function itUpdatesACategory()
    {
        $category = factory(Category::class)->create();

        $response = $this->patch(
            route('categories.update', $category->id),
            [
                                     'name' => $name = str_random(10),
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(
            [
                'name' => $name,
            ]
        );

        $this->assertDatabaseHas(
            $category->getTable(),
            [
                                     'id'   => $category->id,
                                     'name' => $name,
            ]
        );
    }

    /** @test */
    public function itSoftDeletesACategory()
    {
        $category = factory(Category::class)->create();

        $response = $this->delete(route('categories.destroy', $category->id));

        $response->assertStatus(200);

        $this->assertDatabaseMissing(
            $category->getTable(),
            [
                                         'id'         => $category->id,
                                         'name'       => $category->name,
                                         'deleted_at' => null,
            ]
        );

        $this->assertDatabaseHas(
            $category->getTable(),
            [
                                     'id'   => $category->id,
                                     'name' => $category->name,
            ]
        );
    }
}

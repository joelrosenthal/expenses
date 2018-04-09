<?php

namespace Tests\Feature;

use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubcategoryTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function itGetsSubcategories()
    {
        $subcategories = factory(Subcategory::class, 3)->create();

        $response = $this->get(route('subcategories.index'));

        $response->assertJsonFragment(
            [
                'data' => $subcategories->toArray(),
            ]
        );
    }

    /** @test */
    public function itCreatesASubcategory()
    {
        $subcategory = factory(Subcategory::class)->make();

        $response = $this->post(route('subcategories.store'), $subcategory->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseHas($subcategory->getTable(), $subcategory->toArray());
    }

    /** @test */
    public function itSeesASubcategory()
    {
        $subcategory = factory(Subcategory::class)->create();

        $response = $this->get(route('subcategories.show', $subcategory->id));

        $response->assertStatus(200);
        $response->assertJsonFragment($subcategory->toArray());
    }

    /** @test */
    public function itUpdatesASubcategory()
    {
        $subcategory = factory(Subcategory::class)->create();

        $response = $this->patch(
            route('subcategories.update', $subcategory->id),
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
            $subcategory->getTable(),
            [
                'id'   => $subcategory->id,
                'name' => $name,
            ]
        );
    }

    /** @test */
    public function itSoftDeletesASubcategory()
    {
        $subcategory = factory(Subcategory::class)->create();

        $response = $this->delete(route('subcategories.destroy', $subcategory->id));

        $response->assertStatus(200);

        $this->assertDatabaseMissing(
            $subcategory->getTable(),
            [
                'id'          => $subcategory->id,
                'name'        => $subcategory->name,
                'category_id' => $subcategory->category_id,
                'deleted_at'  => null,
            ]
        );

        $this->assertDatabaseHas(
            $subcategory->getTable(),
            [
                'id'   => $subcategory->id,
                'name' => $subcategory->name,
                'category_id' => $subcategory->category_id,
            ]
        );
    }
}

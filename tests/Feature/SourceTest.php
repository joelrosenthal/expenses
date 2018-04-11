<?php

namespace Tests\Feature;

use App\Models\Source;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function itGetsSubcategories()
    {
        $sources = factory(Source::class, 3)->create();

        $response = $this->get(route('sources.index'));

        $response->assertJsonFragment(
            [
                'data' => $sources->toArray(),
            ]
        );
    }

    /** @test */
    public function itCreatesASource()
    {
        $source = factory(Source::class)->make();

        $response = $this->post(route('sources.store'), $source->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseHas($source->getTable(), $source->toArray());
    }

    /** @test */
    public function itSeesASource()
    {
        $source = factory(Source::class)->create();

        $response = $this->get(route('sources.show', $source->id));

        $response->assertStatus(200);
        $response->assertJsonFragment($source->toArray());
    }

    /** @test */
    public function itUpdatesASource()
    {
        $source = factory(Source::class)->create();

        $response = $this->patch(
            route('sources.update', $source->id),
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
            $source->getTable(),
            [
                'id'   => $source->id,
                'name' => $name,
            ]
        );
    }

    /** @test */
    public function itSoftDeletesASource()
    {
        $source = factory(Source::class)->create();

        $response = $this->delete(route('sources.destroy', $source->id));

        $response->assertStatus(200);

        $this->assertDatabaseMissing(
            $source->getTable(),
            [
                'id'          => $source->id,
                'name'        => $source->name,
                'deleted_at'  => null,
            ]
        );

        $this->assertDatabaseHas(
            $source->getTable(),
            [
                'id'   => $source->id,
                'name' => $source->name,
            ]
        );
    }
}

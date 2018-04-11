<?php

namespace Tests\Feature;

use App\Models\Expenditure;
use App\Models\User;
use function GuzzleHttp\Psr7\str;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenditureTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function itGetsExpenditures()
    {
        $expenditures = factory(Expenditure::class, 3)->create();

        $response = $this->get(route('expenditures.index'));

        $expenditures->each(function ($expenditure) use ($response) {
            $response->assertJsonFragment($expenditure->toArray());
        });
    }

    /** @test */
    public function itCreatesAnExpenditure()
    {
        $expenditure = factory(Expenditure::class)->make();

        $response = $this->post(route('expenditures.store'), $expenditure->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseHas($expenditure->getTable(), $expenditure->toArray());
    }

    /** @test */
    public function itSeesAnExpenditure()
    {
        $expenditure = factory(Expenditure::class)->create();

        $response = $this->get(route('expenditures.show', $expenditure->id));

        $response->assertStatus(200);
        $response->assertJsonFragment($expenditure->toArray());
    }

    /** @test */
    public function itUpdatesAnExpenditure()
    {
        $expenditure = factory(Expenditure::class)->create();

        $response = $this->patch(
            route('expenditures.update', $expenditure->id),
            [
                'location' => $location = str_random(10),
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonFragment(
            [
                'location' => $location,
            ]
        );

        $this->assertDatabaseHas(
            $expenditure->getTable(),
            [
                'id'       => $expenditure->id,
                'location' => $location,
            ]
        );
    }

    /** @test */
    public function itSoftDeletesAnExpenditure()
    {
        $expenditure = factory(Expenditure::class)->create();

        $response = $this->delete(route('expenditures.destroy', $expenditure->id));

        $response->assertStatus(200);

        $this->assertDatabaseMissing(
            $expenditure->getTable(),
            [
                'id'         => $expenditure->id,
                'deleted_at' => null,
            ]
        );

        $this->assertDatabaseHas(
            $expenditure->getTable(),
            [
                'id' => $expenditure->id,
            ]
        );
    }
}

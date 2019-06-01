<?php

namespace Tests\Feature;

use App\City;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\ChecksApiResponse;

class CityTest extends TestCase
{
    use ChecksApiResponse, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItListsCity()
    {
        $response = $this->get('/city');

        $cities = City::with('state.country')->paginate(5);

        $expectedResponse = $this->getResponseFromCollection(
            \App\Http\Resources\City::collection(
                $cities
            )
        );

        $response->assertExactJson($expectedResponse);

        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItCreatedNewCity()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->postJson('/city', [
            'name' => 'Fortaleza ABC',
            'state_id' => 1
        ]);

        $this->assertDatabaseHas('cities', [
            'name' => 'Fortaleza ABC',
            'state_id' => 1
        ]);

        $response->assertStatus(201);
    }
}

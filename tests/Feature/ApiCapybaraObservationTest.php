<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCapybaraObservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_observation()
    {
        $observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);
    }

    /** @test */
    public function it_cannot_create_observation_for_unknown_capybara()
    {
        $observation = [
            'name' => 'Bob',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $observation);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => "A capybara by the name of {$observation['name']} doesn't exist in the system."
            ]);
    }

    /** @test */
    public function it_cannot_create_duplicate_observation()
    {
        $observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);

        $observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => true,
        ];

        $response = $this->postJson(route('api.observation.store'), $observation);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => "{$observation['name']} has already been observed in {$observation['city']} on {$observation['seen_on']}.",
            ]);
    }

    /** @test */
    public function it_can_create_multiple_observations_for_different_cities()
    {
        $observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);

        $observation = [
            'name' => 'Steven',
            'city' => 'San Francisco',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $observation);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);
    }
    
    /** @test */
    public function it_cannot_create_observation_for_unwanted_city()
    {
        $observation = [
            'name' => 'Steven',
            'city' => 'Tokyo',
            'seen_on' => '2021-02-27',
            'wearing_hat' => true,
        ];


        $response = $this->postJson(route('api.observation.store'), $observation);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => "We currently aren't interested in capybara observations in {$observation['city']}.",
            ]);
    }
}

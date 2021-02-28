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
        $successful_observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $successful_observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);

        $failed_observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => true,
        ];

        $response = $this->postJson(route('api.observation.store'), $failed_observation);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => "{$failed_observation['name']} has already been observed in {$failed_observation['city']} on {$failed_observation['seen_on']}.",
            ]);
    }

    /** @test */
    public function it_can_create_multiple_observations_for_same_capybara_different_cities()
    {
        $chicago_observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $chicago_observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);
        
        $sf_observation = [
            'name' => 'Steven',
            'city' => 'San Francisco',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $sf_observation);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);
    }

    /** @test */
    public function it_can_create_multiple_observations_for_same_capybara_different_dates()
    {
        $first_day_observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $first_day_observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);

        $second_day_observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-28',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $second_day_observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);
    }

    /** @test */
    public function it_can_create_multiple_observations_for_different_capybara_same_date_and_city()
    {
        $first_capybara_observation = [
            'name' => 'Steven',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $first_capybara_observation);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);

        $second_capybara_observation = [
            'name' => 'Colossus',
            'city' => 'Chicago',
            'seen_on' => '2021-02-27',
            'wearing_hat' => false,
        ];

        $response = $this->postJson(route('api.observation.store'), $second_capybara_observation);
        
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

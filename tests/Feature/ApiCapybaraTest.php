<?php

namespace Tests\Feature;

use App\Models\Capybara;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CapybaraTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_cannot_create_duplicate_name_capybara() 
    {
        $newCapybara = Capybara::factory()
            ->make([
                'name' => 'Steven'
            ])
            ->toArray();

        $response = $this
            ->handleValidationExceptions()
            ->postJson(route('api.capybara.store'), $newCapybara);

        $response
            ->assertStatus(422)
            ->assertJsonPath('errors.name', ['The name has already been taken.']);
    }

    /** @test */
    public function it_can_create_a_capybara()
    {
        $newCapybara = Capybara::factory()->make()->toArray();

        $response = $this->postJson(route('api.capybara.store'), $newCapybara);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);
    }
}

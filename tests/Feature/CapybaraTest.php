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
        
    }
}

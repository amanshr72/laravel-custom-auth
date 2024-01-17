<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuoteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function testApiRouteExists()
    {
        $response = $this->get('/api/quotes');
        $response->assertStatus(200);
    }

    public function testApiResponseStructure()
    {
        $response = $this->get('/api/quotes');
        $responseData = $response->json();

        $this->assertIsArray($responseData);
        $this->assertArrayHasKey('quote', $responseData);
    }
}

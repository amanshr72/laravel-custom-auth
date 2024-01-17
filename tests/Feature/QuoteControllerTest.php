<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ApiToken;

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

    public function testTokenSecuredRoute()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $apiToken = Str::random(60);

        ApiToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $apiToken),
        ]);
        
        $response = $this->actingAs($user)->withHeader('Authorization', 'Bearer ' . $apiToken)->get('/api/quotes');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'quote',
        ]);
    }
}

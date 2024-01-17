<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    
    public function testUnauthorizedAccess()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function testAuthenticationForm()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Sign in to your account');
    }
}

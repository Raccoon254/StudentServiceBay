<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class ScreenTests extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test the two-factor form page can be rendered.
     */
    public function testTwoFactorFormCanBeRendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('two-factor.form'));

        $response->assertStatus(200);
    }

}

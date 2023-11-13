<?php

namespace Tests\Feature;

use App\Models\ScamAlert;
use App\Models\ServiceProvider;
use App\Models\ServiceReviewRating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    /**
     * @throws JsonException
     */
//    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
//    {
//        $user = User::factory()->create();
//
//        $response = $this
//            ->actingAs($user)
//            ->patch('/profile', [
//                'name' => 'Test User',
//                'email' => $user->email,
//            ]);
//
//        $response
//            ->assertSessionHasNoErrors()
//            ->assertRedirect('/profile');
//
//        $this->assertNotNull($user->refresh()->email_verified_at);
//    }

    /**
     * @throws JsonException
     */
    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }

    public function test_dashboard_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertOk();
    }

    public function test_scam_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/scam');

        $response->assertOk();
    }


    public function test_scam_create_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/scam/create');

        $response->assertOk();
    }

    //can create scam

    /**
     * @throws JsonException
     */
    public function test_scam_can_be_created(): void
    {
        $user = User::factory()->create();
        $serviceProvider = ServiceProvider::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/scam', [
                'service_provider' => $serviceProvider->id,
                'description' => 'This is a test scam',
                'date_reported' => '2021-01-01',
                'location_area' => 'Lagos',
                'reported_by' => $user->id,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/scam/' . ScamAlert::first()->id);

        $this->assertDatabaseCount('scam_alerts', 1);
    }

    public function test_service_providers_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/service/providers');

        $response->assertOk();
    }


    public function test_reviews_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/reviews');

        $response->assertOk();
    }

    public function test_two_factor_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/two-factor');

        $response->assertOk();
    }

    public function test_two_factor_page_is_displayed_when_user_is_not_logged_in(): void
    {
        $response = $this
            ->get('/two-factor');

        $response->assertOk();
    }

    public function test_two_factor_page_is_displayed_when_user_is_not_verified(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/two-factor');

        $response->assertOk();
    }


}

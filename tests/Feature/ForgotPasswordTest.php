<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_request_a_password_reset()
    {
        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        $response->assertValid();

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }

    /**
     * @test
     */
    public function user_cannot_request_a_password_reset_with_unregistered_email()
    {
        $response = $this->post(route('password.email'), [
            'email' => 'invalidEmail@email.com',
        ]);

        $response->assertInvalid('email');
    }
}

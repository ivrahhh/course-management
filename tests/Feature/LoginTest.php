<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_login_with_valid_data()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.auth'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertValid();
        $this->assertAuthenticated();
    }

    /**
     * @test
     */    
    public function user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.auth'), [
            'email' => $user->email,
            'password' => 'wrong_password',
        ]);

        $response->assertInvalid('email');
        $this->assertGuest();
    }

    /**
     * @test
     */   
    public function user_cannot_login_with_non_existing_account()
    {
        $response = $this->post(route('login.auth'), [
            'email' => 'nonexisting@email.com',
            'password' => 'password',
        ]);

        $response->assertInvalid('email');
        $this->assertGuest();
    }
}

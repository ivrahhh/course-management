<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_reset_their_password_with_correct_token()
    {   
        Event::fake(PasswordReset::class);
        $user = User::factory()->create();
        $token = app('auth.password.broker')->createToken($user);

        $newPassword = 'new_password';
        
        $response = $this->put(route('password.update'), [
            'email' => $user->email,
            'token' => $token,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertValid();

        Event::assertDispatched(PasswordReset::class);

        $this->assertTrue(
            Hash::check($newPassword, $user->fresh()->password)
        );
    }

    /**
     * @test
     */
    public function reset_password_token_is_removed_when_password_reset_finished()
    {
        $user = User::factory()->create();
        $token = app('auth.password.broker')->createToken($user);

        $newPassword = 'new_password';
        
        $response = $this->put(route('password.update'), [
            'email' => $user->email,
            'token' => $token,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $this->assertDatabaseMissing('password_resets', [
            'email' => $user->email,
        ]);
    }
}

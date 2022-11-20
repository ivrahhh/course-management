<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_verify_their_email_with_correct_hash()
    {
        $user = User::factory()->unverified()->create();
        
        Event::fake();

        $url = URL::temporarySignedRoute('verification.verify', now()->addHour(), [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]);

        $this->actingAs($user)->get($url);

        Event::assertDispatched(Verified::class);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    /**
     * @test
     */
    public function user_cannot_verify_their_email_with_wrong_hash()
    {
        $user = User::factory()->unverified()->create();
        
        Event::fake();

        $url = URL::temporarySignedRoute('verification.verify', now()->addHour(), [
            'id' => $user->id,
            'hash' => sha1('wrong_hash'),
        ]);

        $this->actingAs($user)->get($url);

        Event::assertNotDispatched(Verified::class);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

use Illuminate\Auth\Notifications\VerifyEmail;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified()
    {
        Event::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
    public function test_VerifyEmailValidatesUser()
    {

        $notification = new VerifyEmail();
        $user = User::factory()->create();


        $this->assertTrue($user->hasVerifiedEmail());

        $mail = $notification->toMail($user);
        $uri = $mail->actionUrl;


        $this->actingAs($user)
            ->get($uri);


        $this->assertTrue(User::find($user->id)->hasVerifiedEmail());
    }

    public function test_VerifyEmailValidatesRoutes()
    {

        $notification = new VerifyEmail();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/verify-email');

        $this->assertTrue($user->hasVerifiedEmail());

        $mail = $notification->toMail($user);
        $uri = $mail->actionUrl;

        $this->actingAs($user)->get($uri);
        $this->assertTrue(User::find($user->id)->hasVerifiedEmail());
    }
}

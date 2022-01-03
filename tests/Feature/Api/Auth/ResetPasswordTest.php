<?php

namespace Tests\Feature\Api\Auth;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Feature\UtilsTrait;
use Illuminate\Support\Facades\Notification;

class ResetPasswordTest extends TestCase
{
    use UtilsTrait, RefreshDatabase;

    public function test_error_reset_password()
    {
        $response = $this->postJson('/forgot-password');
        $response->assertStatus(422);
    }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = $this->createUser();
        $response = $this->postJson('/forgot-password', [
            'email' => $user->email,
        ]);
        $response->assertStatus(200);

        Notification::assertSentTo($user, ResetPasswordNotification::class);
    }

    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = $this->createUser();
        
        $this->postJson('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPasswordNotification::class, function ($notification) use ($user) {
            $response = $this->postJson('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}

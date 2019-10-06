<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class ForgotPasswordTest
 *
 * @credit: https://medium.com/@DCzajkowski/testing-laravel-authentication-flow-573ea0a96318
 * @package Tests\Feature\Auth
 */
class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_forgot_password_form()
    {
        $response = $this->get(route('password.request'));
        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    /** @test */
    public function authenticated_user_cannot_see_forgot_password_form()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(route('password.request'));
        $response->assertRedirect(route('dashboard'));
    }
    
    /** @test */
    public function user_receive_an_email_with_password_reset_link()
    {
        Notification::fake();
        $user = factory(User::class)->create([
            'email' => 'user@email.com',
        ]);

        $response = $this->post(route('password.email'), [
            'email' => 'user@email.com',
        ]);

        $this->assertNotNull($token = DB::table('password_resets')->first());
        Notification::assertSentTo($user, ResetPassword::class, function ($notification, $channels) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }

    /** @test */
    public function non_registered_user_will_not_receive_an_email()
    {
        Notification::fake();
        $response = $this->from(route('password.email'))->post(route('password.email'), [
            'email' => 'user@email.com',
        ]);

        $response->assertRedirect(route('password.email'));
        $response->assertSessionHasErrors('email');
        Notification::assertNotSentTo(factory(User::class)->make(['email' => 'user@email.com']), ResetPassword::class);
    }
    
    /** @test */
    public function email_field_is_required()
    {
        $response = $this->from(route('password.email'))->post(route('password.email'), []);

        $response->assertRedirect(route('password.email'));
        $response->assertSessionHasErrors('email');
    }
    
    /** @test */
    public function email_must_be_a_valid_email_address()
    {
        $response = $this->from(route('password.email'))->post(route('password.email'), [
            'email' => 'invalid-email',
        ]);

        $response->assertRedirect(route('password.email'));
        $response->assertSessionHasErrors('email');
    }
}

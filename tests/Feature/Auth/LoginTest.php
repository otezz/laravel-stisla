<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class LoginTest
 *
 * @credit: https://medium.com/@DCzajkowski/testing-laravel-authentication-flow-573ea0a96318
 * @package Tests\Feature\Auth
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful()
            ->assertViewIs('auth.login')
            ->assertSee('Login')
            ->assertSee('Email')
            ->assertSee('Password');
    }

    /** @test */
    public function authenticated_user_cannot_see_login_page()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(route('login'));
        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function authenticated_user_can_access_dashboard()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertSuccessful()
            ->assertViewIs('dashboard');
    }

    /** @test */
    public function unauthenticated_user_redirected_to_login_page_when_accessing_dashboard()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function user_with_valid_credentials_can_login()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = '12345678'),
        ]);

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_with_invalid_credentials_cannot_login()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = '12345678'),
        ]);

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/')
            ->assertSessionHasErrors('email');

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /** @test */
    public function user_can_logout()
    {
        $this->be(factory(User::class)->create());
        $response = $this->post(route('logout'));
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}

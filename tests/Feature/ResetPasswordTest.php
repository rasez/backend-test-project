<?php

namespace Tests\Feature;

use App\PasswordReset;
use App\User;
use App\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @test
     */
    public function user_cannot_reset_password_with_incorrect_token()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('old-password'),
        ]);
        $passwordReset = factory(PasswordReset::class)->create();
        $this->post('/reset-password', [
            'token' => $passwordReset->token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function user_cannot_reset_password_without_new_password()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('old-password'),
        ]);
        $passwordReset = factory(PasswordReset::class)->create();

        $response = $this->post('reset-password', [
            'token' => $passwordReset->token,
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function user_cannot_reset_password_without_email()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('old-password'),
        ]);
        $passwordReset = factory(PasswordReset::class)->create();
        $response = $this->post('reset-pasword', [
            'token' => $passwordReset->token,
            'email' => '',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $this->assertEquals($user->email, $user->fresh()->email);
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        $this->assertGuest();
    }
}

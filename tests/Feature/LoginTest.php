<?php

namespace Tests\Feature;

use App\Jobs\ResetPasswordEmailJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function user_can_see_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * @test
     */
    public function user_can_login_with_correct_credentials()
    {

        $user = factory(\App\User::class)->create([
            'password' => bcrypt($password = '12345678'),
        ]);
        $credentionial = [
            'email' => $user->email,
            'password' => $password,
        ];
        $response = $this->post('/login', $credentionial);

        $response->assertRedirect('/upload-csv');
        $this->assertAuthenticatedAs($user);
    }


    /**
     * @test
     */
    public function user_can_logout()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $response = $this->get('logout');

        $response->assertRedirect('login');
        $this->assertGuest();
    }
}

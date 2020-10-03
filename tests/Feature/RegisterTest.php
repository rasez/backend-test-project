<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_register()
    {

        $response = $this->post('register', [
            'name' => 'John Doe',
            'email' => 'info@snappmarket.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertRedirect('/login');
        $this->assertCount(1, $users = User::all());
        $user = $users->first();
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('info@snappmarket.com', $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));
    }
    /**
     * @test
     */
    public function user_cannot_register_without_name()
    {
        $response = $this->post('register', [
            'name' => '',
            'email' => 'info@snappmarket.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('name');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function user_cannot_register_without_email()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => '',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * @test
     */
    public function user_cannot_register_without_password()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'info@snappmarket.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
//
    public function user_cannot_register_without_password_confirmation()
    {
        $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'info@ucarft.com',
            'password' => '12345678',
            'password_confirmation' => '',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function user_cannot_register_without_passwords_not_matching()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'info@snappmarket.com',
            'password' => '12345678',
            'password_confirmation' => '123asd',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}

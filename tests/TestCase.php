<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    public function logIn($user = null)
    {
//        $this->withoutExceptionHandling();
        $user = $user ?: factory('App\User')->create();

        $this->actingAs($user);

        return $user;
    }
}

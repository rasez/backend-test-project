<?php

namespace App\Http\Repositories\Interfaces;

interface UserRepositoryInterface
{

    public function register($request);

    public function registerWithSocial($providerUser, $provider);

    public function checkToken($request);

    public function verifyEmail($request);
}


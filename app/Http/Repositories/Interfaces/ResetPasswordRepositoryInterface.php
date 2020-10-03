<?php

namespace App\Http\Repositories\Interfaces;

interface ResetPasswordRepositoryInterface
{

    public function makeToken($request);

    public function checkToken($request);

    public function resetPassword($request);
}


<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\ResetPasswordRepositoryInterface;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Jobs\ResetPasswordEmailJob;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    private $resetPasswordRepository;

    public function __construct(ResetPasswordRepositoryInterface $resetPasswordRepository)
    {
        $this->resetPasswordRepository = $resetPasswordRepository;
    }

    public function getPassword($token)
    {

        return view('auth.reset-password', ['token' => $token]);
    }


    public function updatePassword(UpdatePasswordRequest $request)
    {

        if (!$this->resetPasswordRepository->checkToken($request)) {
            return back()->withInput()->withError('Invalid token!');
        }
        $this->resetPasswordRepository->resetPassword($request);

        return redirect('/login')->with('message', 'Your password has been changed!');

    }

    public function getEmail()
    {

        return view('auth.forget-password');
    }

    public function postEmail(ResetPasswordRequest $request)
    {
        $resetPassword = $this->resetPasswordRepository->makeToken($request);

        dispatch(new ResetPasswordEmailJob($resetPassword->token,$request->all()));

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
}

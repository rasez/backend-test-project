<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\UserRegisterRequest;

class RegisterController extends Controller
{
    private $userRepository;

    /**
     * RegisterController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register()
    {
        return view('auth.register');
    }

    /**
     * @param UserRegisterRequest $request
     * @return mixed
     */
    public function store(UserRegisterRequest $request)
    {
        $this->userRepository->register($request);
        return redirect('login');
    }

    public function verifyEmail($token)
    {
        if (!$this->userRepository->checkToken($token)) {
            return view('auth.verify')->with('message', '')->withErrors('Invalid token!');
        }
        $this->userRepository->verifyEmail($token);

        return view('auth.verify')->with('message', 'Your email has been verified!');
    }

}

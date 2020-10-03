<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\TokenRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Servises\JsonResult;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegisterAuthRequest;

class JwtController extends Controller
{
    use JsonResult;
    private $userRepository;

    /**
     * RegisterController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterAuthRequest $request)
    {
        $user = $this->userRepository->register($request);

        return $this->result(
            'User Successfuly created!',
            $user,
            '',
            Response::HTTP_CREATED
        );
    }

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $input = $request->only('email', 'password');
        $jwtToken = null;

        if (!$jwtToken = auth('api')->attempt($input)) {

            return $this->result(
                'Invalid Email or Password',
                '',
                'error',
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->result(
            '',
            ['token' => $jwtToken],
            'success',
            Response::HTTP_OK
        );
    }

    /**
     * @param TokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(TokenRequest $request)
    {
        try {
            auth('api')->logout();
            return $this->result(
                'User logged out successfully',
                '',
                'success',
                Response::HTTP_OK
            );
        } catch (JWTException $exception) {
            return $this->result(
                'Sorry, the user cannot be logged out',
                '',
                'error',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}

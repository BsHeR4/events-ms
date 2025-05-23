<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\Interfaces\AuthServiceInterface;

class AuthController extends Controller
{
    /**
     * Service to handle auth-related logic 
     * and separating it from the controller
     * 
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     * AuthController constructor
     *
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        // Inject the AuthService to handle auth-related logic
        $this->authService = $authService;
    }

    /**
     * Handle user registration
     *
     * @param RegistrationRequest $request Validates the registration credentials
     * @return JsonResponse The success response including token and user details or an error message
     */
    public function register(RegistrationRequest $request)
    {
        try {

            $data = $request->validated();
            $success = $this->authService->register($data);

            return $this->registerResponse($success);
        } catch (\Throwable $th) {

            return $this->errorResponse("Something went wrong, Please try again later");
        }
    }


    /**
     * Handle user login
     *
     * @param LoginRequest $request The incoming request containing email and password
     * @return JsonResponse success response including user details and token (error message on failure)
     */
    public function login(LoginRequest $request)
    {
        try {

            $data = $request->validated();
            $success = $this->authService->login($data);

            if ($success)
                return $this->loginResponse($success['user'], $success['token']);

            return $this->errorResponse("Your inputs do not match our credential!");
        } catch (\Throwable $th) {

            return $this->errorResponse('Something went wrong, Please try again later');
        }
    }

    /**
     * Handle user logout
     *
     * @return JsonResponse The success message or an error message.
     */
    public function logout()
    {
        try {
            $success = $this->authService->logout();

            if ($success)
                return $this->logoutResponse();

            return $this->errorResponse('Logged out faild');
        } catch (\Throwable $th) {
            return $this->errorResponse('Something went wrong, Please try again later');
        }
    }
}

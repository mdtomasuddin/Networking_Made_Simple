<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\Api\V1\Auth\LoginResponce;
use App\Http\Resources\Api\V1\Auth\RegisterUserResource;
use App\Services\Api\V1\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * Constructor for initializing the class with the AuthService dependency.
     * @param AuthService $authService The authentication service instance used for handling authentication-related operations.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handles the user registration process by validating the request and delegating
     * the registration logic to the AuthService.
     * @param RegisterRequest $request
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $response = $this->authService->register($validatedData);

            return $this->success(200, 'Registration Successful', new RegisterUserResource($response));
        } catch (Exception $e) {
            Log::error('AuthController::register', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * Handles the user registration process.
     * Validates the incoming registration request data, calls the AuthService to register the user,
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $response = $this->authService->login($validatedData);

            return $this->success(200, 'Login Successful', new LoginResponce($response));
        } catch (Exception $e) {
            Log::error('AuthController::login', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * Handles user logout by terminating the user's session.
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            $this->authService->logout();
            return $this->success(200, 'Logout Successful');
        } catch (Exception $e) {
            Log::error('AuthController::logout', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * Refreshes the authentication token for the user.
     * @return JsonResponse The JSON response containing the updated token or an error message.
     */
    public function refresh(): JsonResponse
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return $this->success(200, 'Token Updated', ['token' => $token]);
        } catch (Exception $e) {
            Log::error('AuthController::refresh', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * Delete the authenticated user's account.
     * @return JsonResponse
     */
    public function deleteAccount(): JsonResponse
    {
        try {
            // Get the authenticated user
            $user = auth()->user();

            // Check if the user is authenticated
            if (!$user) {
                return $this->error(401, 'Unauthenticated user.');
            }
            // Optionally, logout the user before deleting to invalidate the token
            $this->authService->logout();

            // Delete the user
            $user->delete();

            // Return a success response
            return $this->success(200, 'Account deleted successfully.');
        } catch (Exception $e) {
            // Log the error for debugging purposes
            Log::error('AuthController::deleteAccount', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }
}

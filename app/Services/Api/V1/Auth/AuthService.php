<?php

namespace App\Services\Api\V1\Auth;

use App\Interfaces\Api\V1\Auth\OTPRepositoryInterface;
use App\Interfaces\Api\V1\Auth\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthService
{
    protected UserRepositoryInterface $userRepository;
    protected OTPRepositoryInterface $otpRepository;


    /**
     * Constructor for initializing the class with UserRepository and OTPRepository dependencies.
     *
     * @param UserRepositoryInterface $userRepository The repository used for user-related data operations.
     * @param OTPRepositoryInterface $otpRepository The repository used for OTP-related data operations.
     */
    public function __construct(UserRepositoryInterface $userRepository, OTPRepositoryInterface $otpRepository)
    {
        $this->userRepository = $userRepository;
        $this->otpRepository = $otpRepository;
    }

    /**
     * Registers a new user and generates an authentication token.
     * Creates a user using the provided credentials, sends an OTP to the user's email, and generates a JWT token.
     */
    public function register(array $credentials): array
    {
        try {

            DB::beginTransaction();
            $user = $this->userRepository->createUser($credentials);
            $otp = $this->otpRepository->sendOtp($user, 'email');

            $token = $token = JWTAuth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);

            if (!$token) {
                throw new Exception('Token generation failed.', 500);
            }
            DB::commit();
            $user->load(['profile' => function ($query) {
                $query->select('id', 'user_id');
            }, 'role']);
            return ['token' => $token, 'user' => $user, 'verify' => false];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('AuthService::register', ['error' => $e->getMessage()]);
            throw $e;
        }
    }



    /**
     * Authenticates a user and generates a JWT token.     
     * Validates the user's credentials, generates a JWT token, and returns the token along with the user's role
     */
    public function login(array $credentials): array
    {
        try {
            $user = $this->userRepository->login($credentials);

            $token = JWTAuth::fromUser($user);

            if (!$token) {
                throw new Exception('Token generation failed.');
            }

            $verify = false;
            if ($user->email_verified_at) {
                $verify = true;
            }

            $user->load(['profile' => function ($query) {
                $query->select('id', 'user_id');
            }, 'role']);

            return ['token' => $token, 'user' => $user, 'verify' => $verify];
        } catch (Exception $e) {
            Log::error('AuthService::login', ['error' => $e->getMessage()]);
            throw $e;
        }
    }



    /**
     * Logs out the user by invalidating the current JWT token.
     * @return void
     */
    public function logout(): void
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
        } catch (Exception $e) {
            Log::error('AuthService::logout', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

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
        $this->otpRepository  = $otpRepository;
    }

    /**
     * Registers a new user and generates an authentication token.
     * Creates a user using the provided credentials, sends an OTP to the user's email, and generates a JWT token.
     */
    public function register(array $credentials): array
    {
        try {

            DB::beginTransaction();

            // Create the user using the UserRepository
            $user = $this->userRepository->createUser($credentials);

            // Generate and send OTP to the user's email
            $token = $token = JWTAuth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);

            if (! $token) {
                throw new Exception('Token generation failed.', 500);
            }
            DB::commit();
            $user->load('role');

            // Return the token, user data, and verification status
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

            //handle case where user is not found
            if (! $user) {
                throw new Exception('Invalid credentials.', 401);
            }
            $token = JWTAuth::fromUser($user);

            // Check if token generation was successful
            if (! $token) {
                throw new Exception('Token generation failed.');
            }

            // Check if the user's email is verified
            $verify = false;
            if ($user->email_verified_at) {
                $verify = true;
            }

            // Load the user's role relationship to include it in the response
            $user->load('role');

            // Return the token, user data, and verification status
            return ['token' => $token, 'user' => $user, 'verify' => $verify];
        } catch (Exception $e) {
            //Handle exceptions and log errors for debugging purposes
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

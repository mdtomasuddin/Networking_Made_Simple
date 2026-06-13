<?php
namespace App\Repositories\Api\V1\Auth;

use App\Interfaces\Api\V1\Auth\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Summary of createUser
     * @param array $credentials
     * @param int $role
     * @return User
     */
    public function createUser(array $credentials, int $role = 2): User
    {
        try {
            // creating user
            $user = User::create([
                'email'                => $credentials['email'],
                'password'             => Hash::make($credentials['password']),
                'role_id'              => $role,
                'terms_and_conditions' => $credentials['terms_and_conditions'] ?? false,
                'email_verified_at'    => now(),
            ]);

            // return the created user
            return $user;
        } catch (Exception $e) {
            // Log the error and rethrow it for higher-level handling
            Log::error('UserRepository::createUser', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Attempts to retrieve a user by their email address
     * @throws Exception If there is an error during the query.
     */
    public function login(array $credentials): User | null
    {
        try {
            return User::where('email', $credentials['email'])->first();
        } catch (Exception $e) {
            Log::error('UserRepository::login', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

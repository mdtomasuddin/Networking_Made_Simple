<?php

namespace App\Services\Api\V1\Auth;

use App\Exceptions\SocialLoginException;
use App\Interfaces\Api\V1\Auth\SocialLoginRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginService
{
    protected $socialLoginRepository;

    /**
     * Constructor for initializing the class with the SocialLoginRepository dependency.
     * @param SocialLoginRepositoryInterface $socialLoginRepository The repository used for handling social login data and operations.
     */
    public function __construct(SocialLoginRepositoryInterface $socialLoginRepository)
    {
        $this->socialLoginRepository = $socialLoginRepository;
    }

    /**
     * Handles the social login process for a user via a third-party provider.
     */
    public function handleSocialLogin(array $credentials)
    {
        try {
            // Get user info from the social login provider
            $socialUser = Socialite::driver($credentials['provider'])->stateless()->userFromToken($credentials['token']);

            if (! $socialUser) {
                throw new SocialLoginException("Invalid social login token or provider.", 401);
            }

            // Find the user by email
            $user = $this->socialLoginRepository->findByEmail($socialUser->getEmail());

            if ($user && ! empty($user->deleted_at)) {
                throw new SocialLoginException("Your account has been deleted.", 410);
            }

            if (! $user) {
                // Generate a random password for new user
                $password = Str::random(8);

                $name      = $socialUser->getName();
                $nameParts = explode(' ', $name, 2);
                $firstName = $nameParts[0] ?? '';
                $lastName  = $nameParts[1] ?? '';

                // Create the new user
                $newUser = $this->socialLoginRepository->create([
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'email'      => $socialUser->getEmail(),
                    'password'   => $password,
                    'address'    => null,
                ]);

                // Log the user in
                return $this->socialLoginRepository->login(['email' => $newUser->email]);
            }

            // If user exists, login logic
            return $this->socialLoginRepository->login(['email' => $socialUser->getEmail()]);
        } catch (SocialLoginException $e) {
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('SocialLoginService::handleSocialLogin', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

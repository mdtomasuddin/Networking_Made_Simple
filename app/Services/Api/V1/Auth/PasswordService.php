<?php

namespace App\Services\Api\V1\Auth;

use App\Interfaces\Api\V1\Auth\PasswordRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class PasswordService
{
    protected PasswordRepositoryInterface $passwordRepository;

    /**
     * Constructor for initializing the class with the PasswordRepository dependency.
     *
     * @param PasswordRepositoryInterface $passwordRepository The repository used for handling password-related operations such as reset and update.
     */
    public function __construct(PasswordRepositoryInterface $passwordRepository)
    {
        $this->passwordRepository = $passwordRepository;
    }

    /**
     * Changes the user's password based on the provided email and new password.
     * @return bool
     */
    public function changePassword(string $email, string $password): bool
    {
        try {
            return $this->passwordRepository->changePassword($email, $password);
        } catch (Exception $e) {
            Log::error('PasswordService::changePassword', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

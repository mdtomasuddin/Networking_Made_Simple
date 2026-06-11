<?php

namespace App\Services\Api\V1\Auth;

use App\Exceptions\OtpNotVerifiedException;
use App\Interfaces\Api\V1\Auth\ForgetPasswordRepositoryInterface;
use App\Models\User;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ForgerPasswordService
{

    protected ForgetPasswordRepositoryInterface $forgetPasswordRepository;


    /**
     * Constructor for initializing the class with the ForgetPasswordRepository dependency.
     *
     * @param ForgetPasswordRepositoryInterface $forgetPasswordRepository The repository used for handling password reset-related operations.
     */
    public function __construct(ForgetPasswordRepositoryInterface $forgetPasswordRepository)
    {
        $this->forgetPasswordRepository = $forgetPasswordRepository;
    }



    /**
     * Resets the user's password based on the provided credentials.
     */
    public function resetPassword(array $credentials): bool
    {
        try {
            return $this->forgetPasswordRepository->resetPassword($credentials);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (OtpNotVerifiedException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error('ForgerPasswordService::resetPassword', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

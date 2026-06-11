<?php

namespace App\Services\Api\V1\Auth;

use App\Exceptions\OTPExpiredException;
use App\Exceptions\OTPMismatchException;
use App\Exceptions\UserAlreadyVarifiedException;
use App\Interfaces\Api\V1\Auth\OTPRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OTPService
{
    protected OTPRepositoryInterface $otpRepository;

    /**
     * Constructor for initializing the class with the OTPRepository dependency.
     *
     * @param OTPRepositoryInterface $otpRepository The repository used for handling OTP-related data and operations.
     */
    public function __construct(OTPRepositoryInterface $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    /**
     * Sends an OTP (One-Time Password) to the specified user's email for a given operation.
     * @return int The generated OTP.
     */
    public function sendOtp(string $email, string $operation): int
    {
        try {
            // Retrieve user by email
            $user = User::whereEmail($email)->first();
            if (! $user) {
                throw new ModelNotFoundException('User not found', 404);
            }
            // Generate and save OTP
            $otp = $this->otpRepository->sendOtp($user, $operation);
            return $otp;
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error('OTPService::sendOtp', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Matches the provided OTP with the user's record for a given operation.
     * @return ?array The user's role if OTP is valid and the operation is successful, or null if invalid.
     */
    public function matchOtp(string $email, string $operation, string $otp): ?array
    {
        try {
            // Retrieve user by email
            $user = User::whereEmail($email)->first();
            if (! $user) {
                throw new ModelNotFoundException('User Not Found', 404);
            }

            if ($user->email_verified_at && $operation == 'email') {
                throw new UserAlreadyVarifiedException();
            }

            // Match OTP using the repository
            $isValid = $this->otpRepository->matchOtp($user, $operation, $otp);

            if ($isValid) {
                DB::beginTransaction();

                // Perform operation-specific logic
                if ($operation === 'email') {
                    $user->email_verified_at = now();
                    $user->save();
                }

                DB::commit();
                return ['role' => $user->role->name];
            }

            return null;
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (UserAlreadyVarifiedException $e) {
            throw $e;
        } catch (OTPMismatchException $e) {
            DB::rollBack();
            throw $e;
        } catch (OTPExpiredException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('OTPService::matchOtp', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

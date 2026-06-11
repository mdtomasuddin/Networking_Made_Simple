<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\OTPNotVerifiedException;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Auth\ForgetPasswordResetRequest;
use App\Services\Api\V1\Auth\ForgerPasswordService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ForgerPasswordController extends Controller
{
    protected ForgerPasswordService $forgerPasswordService;


    /**
     * Constructor for initializing the class with the ForgerPasswordService dependency.
     */
    public function __construct(ForgerPasswordService $forgerPasswordService)
    {
        $this->forgerPasswordService = $forgerPasswordService;
    }


    /**
     * Resets the user's password based on the provided reset request data.
     * @param ForgetPasswordResetRequest $forgetPasswordResetRequest
     */
    public function resetPassword(ForgetPasswordResetRequest $forgetPasswordResetRequest): JsonResponse
    {
        try {
            $validatedData = $forgetPasswordResetRequest->validated();
            $response = $this->forgerPasswordService->resetPassword($validatedData);
            if ($response) {
                return $this->success(200, 'Password Reset Successfull');
            }
            throw new Exception('Server Error', 500);
        } catch (ModelNotFoundException $e) {
            return $this->error(500, 'User Not Found', $e->getMessage());
        } catch (OTPNotVerifiedException $e) {
            return $this->error(500, 'OTP Not Verified', $e->getMessage());
        } catch (Exception $e) {
            Log::error('ForgerPasswordController::resetPassword', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }
}

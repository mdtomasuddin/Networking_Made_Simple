<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Exceptions\SocialLoginException;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Auth\SocialLoginRequest;
use App\Services\Api\V1\Auth\SocialLoginService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SocialLoginController extends Controller
{
    /// Define the SocialLoginService property to be used for handling social login operations.
    protected SocialLoginService $socialLoginService;

    /**
     * Constructor for initializing the class with the SocialLoginService dependency.
     * @param SocialLoginService $socialLoginService The service used for handling social login integrations.
     */
    public function __construct(SocialLoginService $socialLoginService)
    {
        $this->socialLoginService = $socialLoginService;
    }

    /**
     * Handles the social login process for the user.
     * @param SocialLoginRequest $socialLoginRequest The request containing the social login data, such as provider and token.
     */
    public function socialLogin(SocialLoginRequest $socialLoginRequest): JsonResponse
    {
        try {
            $validatedData = $socialLoginRequest->validated();
            $token         = $this->socialLoginService->handleSocialLogin($validatedData);
            return $this->success(200, 'SocilLogin Successfull', ['token' => $token]);
        } catch (SocialLoginException $e) {
            Log::error('SocialLoginController::socialLogin', ['error' => $e->getMessage()]);
            return $this->error($e->getCode(), $e->getMessage());
        } catch (Exception $e) {
            Log::error('SocialLoginController::socialLogin', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }
}

<?php
namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Auth\PasswordChangeRequest;
use App\Services\Api\V1\Auth\PasswordService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{

    // @var PasswordService
    protected PasswordService $passwordService;

    /**
     * Constructor for initializing the class with the PasswordService dependency.
     */
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * Changes the user's password based on the provided request data.     *
     * Validates the incoming request, processes the password change using the PasswordService,
     * @param PasswordChangeRequest $request
     */
    public function changePassword(PasswordChangeRequest $request): JsonResponse
    {
        try {
            //Get the authenticated user
            $user = auth()->user();

            // If no authenticated user is found, return an error response
            if (! $user) {
                return $this->error(401, 'Unauthenticated user.', []);
            }

            // Call the password service to change the password
            $this->passwordService->changePassword($user->email, $request->password);

            // Return a success response indicating the password was changed successfully
            return $this->success(202, 'Password Changed Successfully', []);
        } catch (Exception $e) {
            // Log the error for debugging purposes and return a server error response
            Log::error('PasswordController::changePassword', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }
}

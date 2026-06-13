<?php

namespace App\Http\Controllers\Api\V1\User\Profile;

use App\Http\Requests\Api\v1\Profile\ProfileUpdateRequest;
use App\Http\Resources\Api\V1\User\ProfileResource;
use App\Services\Api\v1\ProfileService;
use App\Traits\V1\ApiResponse;
use Exception;

class ProfileController
{
    //traits for API response formatting
    use ApiResponse;

    // ProfileService to handle the profile logic
    protected ProfileService $profileService;

    /**
     * Create a new controller instance.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Update the authenticated user's profile.
     * @param ProfileUpdateRequest $request
     */
    public function store(ProfileUpdateRequest $request)
    {
        try {
            // Get the authenticated user
            $user = auth()->user();

            // Check if user is authenticated
            if (! $user) {
                return $this->error(401, 'Unauthenticated user.');
            }

            // Validate and update profile using the service
            $validatedData = $request->validated();
            $data          = $this->profileService->updateProfile($user, $validatedData);

            // Return success response with updated user data
            $dataresource = new ProfileResource($data);
            return $this->success(200, 'Profile updated successfully.', $dataresource);
        } catch (Exception $e) {
            return $this->error(500, 'Failed to update profile.', ['error' => $e->getMessage()]);
        }
    }
}

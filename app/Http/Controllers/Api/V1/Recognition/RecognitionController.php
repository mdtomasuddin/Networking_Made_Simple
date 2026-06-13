<?php

namespace App\Http\Controllers\Api\V1\Recognition;

use App\Http\Requests\Api\V1\Recognition\RecognitionRequest;
use App\Http\Resources\Api\V1\Recognition\RecognitionResource;
use App\Models\Recognition;
use App\Traits\V1\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class RecognitionController
{
    //use the ApiResponse trait for standardized API responses.
    use ApiResponse;

    /**
     * Store a newly created recognition in storage.
     * @param RecognitionRequest $request
     */
    public function store(RecognitionRequest $request)
    {
        try {
            // Get the authenticated user
            $user = auth()->user();
            // Check if the user is authenticated
            if (! $user) {
                return $this->error(401, 'Unauthenticated user.');
            }

            //data validation
            $validatedData            = $request->validated();
            $validatedData['user_id'] = $user->id;

            //create the recognition
            $recognition = Recognition::create($validatedData);

            //create the resource
            $data = new RecognitionResource($recognition);
            //return the resource
            return $this->success(201, 'Recognition created successfully.', $data);
        } catch (Exception $e) {
            //handle the exceptionand return an error response.
            return $this->error(500, 'Failed to create recognition.', ['error' => $e->getMessage()]);
        }
    }


}

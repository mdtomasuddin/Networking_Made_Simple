<?php

namespace App\Http\Controllers\Api\V1\Expertise;

use App\Http\Requests\Api\V1\Expertise\ExpertiseRequest;
use App\Http\Resources\Api\V1\Expertise\ExpertiseResource;
use App\Models\Expertise;
use App\Traits\V1\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class ExpertiseController
{
    //use the ApiResponse trait for standardized API responses.
    use ApiResponse;

    /**
     * Display a listing of the user's expertises.
     */
    public function index(Request $request)
    {
        try {
            // Get the authenticated user
            $user   = auth()->user();
            $search = $request->query('search');

            // Check if the user is authenticated
            if (! $user) {
                return $this->error(401, 'Unauthenticated user.');
            }

            //Get the expertises.
            $expertises = Expertise::where('user_id', $user->id);

            //handle search query if provided.
            if (! empty($search)) {
                $expertises->where('name', 'like', '%' . $search . '%');
            }

            //get the expertises
            $expertises = $expertises->get();

            //return the expertises as a resource collection.
            $data = ExpertiseResource::collection($expertises);
            return $this->success(200, 'Expertises retrieved successfully.', $data);
        } catch (Exception $e) {
            //handle the exceptionand return an error response.
            return $this->error(500, 'Failed to retrieve expertises.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created expertise in storage.
     * @param ExpertiseRequest $request
     */
    public function store(ExpertiseRequest $request)
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

            //create the expertise
            $expertise = Expertise::create($validatedData);

            //create the resource
            $data = new ExpertiseResource($expertise);
            //return the resource
            return $this->success(201, 'Expertise created successfully.', $data);
        } catch (Exception $e) {
            //handle the exceptionand return an error response.
            return $this->error(500, 'Failed to create expertise.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified expertise in storage.
     * @param ExpertiseRequest $request
     * @param string $id
     */
    public function update(ExpertiseRequest $request, $id)
    {
        try {
            // Get the authenticated user
            $user = auth()->user();
            // Check if the user is authenticated
            if (! $user) {
                return $this->error(401, 'Unauthenticated user.');
            }

            //find the expertise by id and user_id
            $expertise = Expertise::where('id', $id)->where('user_id', $user->id)->first();

            if (! $expertise) {
                return $this->error(404, 'Expertise Not Found');
            }

            //update the expertise
            $validatedData = $request->validated();
            $expertise->update($validatedData);

            //create the resource and return the response
            $data = new ExpertiseResource($expertise);
            return $this->success(200, 'Expertise updated successfully.', $data);
        } catch (Exception $e) {
            //handle the exceptionand return an error response.
            return $this->error(500, 'Failed to update expertise.', ['error' => $e->getMessage()]);
        }
    }

}

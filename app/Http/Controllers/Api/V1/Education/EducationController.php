<?php

namespace App\Http\Controllers\Api\V1\Education;

use App\Http\Requests\Api\V1\Education\EducationRequest;
use App\Http\Resources\Api\V1\Education\EducationResource;
use App\Models\Education;
use App\Traits\V1\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class EducationController
{
    //use the ApiResponse trait for standardized API responses.
    use ApiResponse;

    /**
     * Display a listing of the user's education.
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

            //Get the education.
            $educations = Education::where('user_id', $user->id);

            //handle search query if provided.
            if (! empty($search)) {
                $educations->where('degree', 'like', '%' . $search . '%')
                    ->orWhere('institution', 'like', '%' . $search . '%')
                    ->orWhere('year', 'like', '%' . $search . '%');
            }

            //get the educations
            $educations = $educations->get();

            //return the educations as a resource collection.
            $data = EducationResource::collection($educations);
            return $this->success(200, 'Education retrieved successfully.', $data);
        } catch (Exception $e) {
            //handle the exceptionand return an error response.
            return $this->error(500, 'Failed to retrieve education.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created education in storage.
     * @param EducationRequest $request
     */
    public function store(EducationRequest $request)
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

            //create the education
            $education = Education::create($validatedData);

            //create the resource
            $data = new EducationResource($education);
            //return the resource
            return $this->success(201, 'Education created successfully.', $data);
        } catch (Exception $e) {
            //handle the exceptionand return an error response.
            return $this->error(500, 'Failed to create education.', ['error' => $e->getMessage()]);
        }
    }

 
}

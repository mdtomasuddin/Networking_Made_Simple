<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Models\Content;
use App\Traits\V1\ApiResponse;
use Exception;

class TermsAndPrivacyController
{
    //traits for API response
    use ApiResponse;

    /**
     * Display the specified resource.
     * @param  string  $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(string $type)
    {
        try {
            //Get the content based on the type and status
            $data = Content::select('id', 'type', 'title', 'content')->where('type', $type)->where('status', 'active')->first();

            // Check if data is found
            if (! $data) {
                return $this->error(404, 'Content Not Found');
            }

            // Return the data in a structured format
            return $this->success(200, 'Data retrieved successfully.', $data);
        } catch (Exception $e) {
            // Handle any unexpected errors
            return $this->error(500, 'Failed to retrieve Data.', ['error' => $e->getMessage()]);
        }
    }
}

<?php
namespace App\Http\Controllers\Api\V1\CMS\SocialMedia;

use App\Models\SocialMedia;
use App\Traits\V1\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class SocialMediaController
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            //get all data
            $data = SocialMedia::all();

            //response
            return $this->success(200, 'Data retrieved successfully.', $data);
        } catch (Exception $e) {
            //response error
            return $this->error(500, 'Failed to retrieve records.', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            //get data by id
            $data = SocialMedia::find($id);
            //check data not found
            if (! $data) {
                return $this->error(404, 'Data not found.');
            }
            //response success
            return $this->success(200, 'Data retrieved successfully.', $data);
        } catch (Exception $e) {
            //response error
            return $this->error(500, 'Failed to retrieve record.', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}

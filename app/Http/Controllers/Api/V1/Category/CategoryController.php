<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Models\Category;
use App\Traits\V1\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class CategoryController
{
    use ApiResponse; //trait to response standard.

    // index function to show all category with pagination
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 50);
            $data    = Category::where('status', 'active')->paginate($perPage);

            //response in pagination
            return $this->success(200, 'Data retrieved successfully.', $data);
        } catch (Exception $e) {
            return $this->error(500, 'Failed to retrieve Data.', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    // show function to show single category by id
    public function show($id)
    {
        try {
            $data = Category::where('status', 'active')->find($id);

            //  show data not found
            if (! $data) {
                return $this->error(404, 'Data Not Found');
            }
            //show data
            return $this->success(200, 'Data retrieved successfully.', $data);
        } catch (Exception $e) {
            return $this->error(500, 'Failed to retrieve Data.', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}

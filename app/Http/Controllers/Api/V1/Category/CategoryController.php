<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Helpers\Helper;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController
{

    /**
     * index get.
     * par page default=50
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 50);
            $data    = Category::where('status', 'active')->select('id', 'name', 'image')->paginate($perPage);
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * show
     * Experience Room ID .
     */
    public function show($id)
    {
        try {
            $data = Category::with('jobResponsibities:id,category_id,job_title,responsibility,skill')->select('id', 'name', 'image')->where('status', 'active')->find($id);
            if (! $data) {
                return Helper::jsonResponse(false, 'Data Not Found', 404);
            }
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}

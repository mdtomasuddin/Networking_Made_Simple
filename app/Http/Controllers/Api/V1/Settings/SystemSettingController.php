<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Models\SystemSetting;
use App\Traits\V1\ApiResponse;
use Exception;

class SystemSettingController
{
    //trait for api response
    use ApiResponse;

    /**
     * Display a listing of the resource.
     * system settings only one record in database, so we will return the latest record
     */
    public function index()
    {
        try {
            // Retrieve the latest system settings
            $data = SystemSetting::latest('id')->first();

            // Return a successful response with the retrieved data
            return $this->success(200, 'System settings retrieved successfully.', $data);
        } catch (Exception $e) {
            // Return an error response if something goes wrong
            return $this->error(500, 'Failed to retrieve system settings.', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}

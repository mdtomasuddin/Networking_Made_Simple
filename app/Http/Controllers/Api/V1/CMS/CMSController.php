<?php

namespace App\Http\Controllers\Api\V1\CMS;

use App\Helpers\Helper;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class CMSController
{
    /**
     * ExperiencsPage And AboutPage api
     */
    public function aboutPage()
    {
        try {

            $data = CMS::select('id', 'page', 'section', 'image', 'description')->where('page', 'AboutPage')->where('section', 'AboutSection')->where('status', 'active')->first();
            if (!$data) {
                return Helper::jsonResponse(false, 'No Data Found .', 404);
            }
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data .', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * get .
     */
    public function experiencePage()
    {
        try {

            $data = CMS::select('id', 'page', 'section', 'sub_image', 'description')->where('page', 'ExperiencsPage')->where('section', 'HeroSection')->where('status', 'active')->first();
            if (!$data) {
                return Helper::jsonResponse(false, 'No Data Found .', 404);
            }
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to retrieve Data .', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}

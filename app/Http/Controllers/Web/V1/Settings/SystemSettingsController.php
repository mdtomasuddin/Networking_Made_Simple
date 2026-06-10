<?php

namespace App\Http\Controllers\Web\V1\Settings;

use App\Helpers\Helper;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemSettingsController
{

    /**
     * Create a new controller instance.
     * Display the system settings page.
     */
    public function index(): View
    {
        //Get system setting
        $setting = SystemSetting::latest('id')->first();
        return view('backend.layouts.settings.system_settings', compact('setting'));
    }

    /**
     * Update the system settings.
     * @param Request $request
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title'          => 'nullable|string',
            'system_name'    => 'nullable|string',
            'email'          => 'nullable|string|email',
            'phone'          => 'nullable|string|max:25',
            'address'        => 'nullable|string',
            'copyright_text' => 'nullable|string',
            'description'    => 'nullable|string',
            'logo'           => 'nullable|image',
            'favicon'        => 'nullable|image',
            'sidebar'        => 'nullable|image',
            'remove_logo'    => 'nullable|boolean',
            'remove_favicon' => 'nullable|boolean',
            'remove_sidebar' => 'nullable|boolean',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $setting = SystemSetting::firstOrNew();
            $setting->title          = $request->title;
            $setting->system_name    = $request->system_name;
            $setting->email          = $request->email;
            $setting->phone          = $request->phone;
            $setting->address        = $request->address;
            $setting->copyright_text = $request->copyright_text;
            $setting->description    = $request->description;

            // * Handle logo file
            if ($request->boolean('remove_logo')) {
                if ($setting->logo) {
                    Helper::fileDelete(public_path($setting->logo));
                    $setting->logo = null;
                }
            } elseif ($request->hasFile('logo')) {
                if ($setting->logo) {
                    Helper::fileDelete(public_path($setting->logo));
                }
                $setting->logo = Helper::fileUpload($request->file('logo'), 'logo', $setting->logo);
            }

            // * Handle favicon file
            if ($request->boolean('remove_favicon')) {
                if ($setting->favicon) {
                    Helper::fileDelete(public_path($setting->favicon));
                    $setting->favicon = null;
                }
            } elseif ($request->hasFile('favicon')) {
                if ($setting->favicon) {
                    Helper::fileDelete(public_path($setting->favicon));
                }
                $setting->favicon = Helper::fileUpload($request->file('favicon'), 'favicon', $setting->favicon);
            }

            // * Handle sidebar file
            if ($request->boolean('remove_sidebar')) {
                if ($setting->sidebar) {
                    Helper::fileDelete(public_path($setting->sidebar));
                    $setting->sidebar = null;
                }
            } elseif ($request->hasFile('sidebar')) {
                if ($setting->sidebar) {
                    Helper::fileDelete(public_path($setting->sidebar));
                }
                $setting->sidebar = Helper::fileUpload($request->file('sidebar'), 'sidebar', $setting->sidebar);
            }
            // Save the updated settings to the database
            $setting->save();
            // Redirect back with a success message
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception $e) {
            // Log the error for debugging purposes
            return back()->with('t-error', $e->getMessage());
        }
    }
}

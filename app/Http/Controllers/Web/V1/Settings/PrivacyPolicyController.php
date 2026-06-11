<?php

namespace App\Http\Controllers\Web\V1\Settings;

use App\Http\Controllers\Web\V1\Controller;
use App\Models\Content;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    /**
     * Display the privacy policy page.
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse
    {
        try {
            // Get the privacy policy
            $privacy_policy = Content::where('type', 'privacyPolicy')->first();

            // Return the view with the privacy policy data
            return view('backend.layouts.settings.privacy_policy', compact('privacy_policy'));
        } catch (Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store the privacy policy.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string|max:20000',
        ]);

        //Failed validation response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Get the privacy policy
            $privacy_policy = Content::where('type', 'privacyPolicy')->first();

            // Update the privacy policy
            if ($privacy_policy) {
                $privacy_policy->title   = $request->input('title');
                $privacy_policy->slug    = Str::slug($request->input('title'));
                $privacy_policy->content = $request->input('content');
                $privacy_policy->save();
            } else {
                Content::create([
                    'type'    => 'privacyPolicy',
                    'title'   => $request->input('title'),
                    'slug'    => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                ]);
            }
            // Return success response
            return back()->with('t-success', 'Privacy Policy Updated Successfully');
        } catch (Exception $e) {
            // Return error response
            return back()->with('t-error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

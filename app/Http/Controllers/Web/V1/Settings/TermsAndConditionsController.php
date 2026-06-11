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

class TermsAndConditionsController extends Controller
{
    /**
     * Display the terms and conditions page.
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse
    {
        try {
            // Get the terms and conditions
            $terms_and_conditions = Content::where('type', 'termsAndConditions')->first();

            // Return the view with the terms and conditions data
            return view('backend.layouts.settings.terms_and_conditions', compact('terms_and_conditions'));
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
     * Store the terms and conditions.
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
            // Get the terms and conditions
            $terms_and_conditions = Content::where('type', 'termsAndConditions')->first();

            // Update or create the terms and conditions
            if ($terms_and_conditions) {
                $terms_and_conditions->title   = $request->input('title');
                $terms_and_conditions->slug    = Str::slug($request->input('title'));
                $terms_and_conditions->content = $request->input('content');
                $terms_and_conditions->save();
            } else {
                Content::create([
                    'type'    => 'termsAndConditions',
                    'title'   => $request->input('title'),
                    'slug'    => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                ]);
            }

            // Return success response
            return back()->with('t-success', 'Terms & Conditions Updated Successfully');
        } catch (Exception $e) {
            // Return error response
            return back()->with('t-error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

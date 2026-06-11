<?php

namespace App\Http\Controllers\Web\V1\Settings;

use App\Http\Controllers\Web\V1\Controller;
use App\Models\SocialMedia;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SocialMediaController extends Controller
{
    /**
     * Display social media settings.
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse
    {
        try {
            // Get SocialMedia links
            $social_link = SocialMedia::latest('id')->get();

            // Return view
            return view('backend.layouts.settings.socialMedia.index', compact('social_link'));
        } catch (Exception $e) {
            // Error fallback
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store social media links createOrUpdate.
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'social_media.*'    => 'required|string',
            'profile_link.*'    => 'required|url',
            'social_media_id.*' => 'sometimes|nullable|integer',
        ]);

        // Check validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Collect IDs
            $idsToUpdate = collect($request->social_media_id)->filter()->all();

            // Process links
            foreach ($request->social_media as $index => $media) {
                $profileLink   = $request->profile_link[$index] ?? null;
                $socialMediaId = $request->social_media_id[$index] ?? null;

                // Skip empty
                if ($media && $profileLink) {
                    $socialMedia               = $socialMediaId ? SocialMedia::find($socialMediaId) : new SocialMedia();
                    $socialMedia->social_media = $media;
                    $socialMedia->profile_link = $profileLink;
                    $socialMedia->save();

                    // Remove processed ID
                    if (($key = array_search($socialMediaId, $idsToUpdate)) !== false) {
                        unset($idsToUpdate[$key]);
                    }
                }
            }

            // Delete remaining IDs
            SocialMedia::whereIn('id', $idsToUpdate)->delete();

            // Success response
            return back()->with('t-success', 'Social media links updated successfully.');
        } catch (Exception) {
            // Error fallback
            return back()->with('t-error', 'Social media links failed update.');
        }
    }

    /**
     * Delete a social media link.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            // Delete  the social media link
            SocialMedia::destroy($id);

            // Success response
            return response()->json([
                'success' => true,
                'message' => 'Social media link deleted successfully.',
            ]);
        } catch (Exception $e) {
            // Error fallback
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete social media link.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}

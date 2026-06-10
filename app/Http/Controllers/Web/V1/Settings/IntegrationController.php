<?php
namespace App\Http\Controllers\Web\V1\Settings;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class IntegrationController
{
    /**
     * Display integration settings page.
     * @return View
     */
    public function index(): View
    {
        return view('backend.layouts.settings.integration_settings');
    }

    /**
     * Update google credentials settings.
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateGoogleCredentials(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'GOOGLE_CLIENT_ID'     => 'nullable|string',
            'GOOGLE_CLIENT_SECRET' => 'nullable|string',
        ]);
        try {
            // Read the contents of the .env file
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";

            //Handle client id (optional)
            if (strpos($envContent, 'GOOGLE_CLIENT_ID=') === false) {
                $envContent .= $lineBreak . 'GOOGLE_CLIENT_ID=' . $request->GOOGLE_CLIENT_ID . $lineBreak;
            } else {
                $envContent = preg_replace(
                    '/GOOGLE_CLIENT_ID=(.*)/',
                    'GOOGLE_CLIENT_ID=' . $request->GOOGLE_CLIENT_ID,
                    $envContent
                );
            }

            // Handle client secret (optional)
            if (strpos($envContent, 'GOOGLE_CLIENT_SECRET=') === false) {
                $envContent .= $lineBreak . 'GOOGLE_CLIENT_SECRET=' . $request->GOOGLE_CLIENT_SECRET . $lineBreak;
            } else {
                $envContent = preg_replace(
                    '/GOOGLE_CLIENT_SECRET=(.*)/',
                    'GOOGLE_CLIENT_SECRET=' . $request->GOOGLE_CLIENT_SECRET,
                    $envContent
                );
            }

            // End of webhook secret handling
            File::put(base_path('.env'), $envContent);

            // Return a success response
            return redirect()->back()->with('success', 'Google settings updated successfully.');
        } catch (Exception $e) {
            //Handle the exception and return an error response
            return redirect()->back()->with('error', 'Failed to update Google settings: ' . $e->getMessage());
        }
    }

    /**
     * Update stripe credentials settings.
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateStripeCredentials(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'STRIPE_KEY'            => 'nullable|string|max:500',
            'STRIPE_SECRET'         => 'nullable|string|max:500',
            'STRIPE_WEBHOOK_SECRET' => 'nullable|string|max:500',
        ]);
        try {
            // Read the contents of the .env file
            $envContent = File::get(base_path('.env'));
            $lineBreak  = "\n";

            //Handle public key
            if (strpos($envContent, 'STRIPE_KEY=') === false) {
                $envContent .= $lineBreak . 'STRIPE_KEY=' . $request->STRIPE_KEY . $lineBreak;
            } else {
                $envContent = preg_replace(
                    '/STRIPE_KEY=(.*)/',
                    'STRIPE_KEY=' . $request->STRIPE_KEY,
                    $envContent
                );
            }

            //Handle secret key
            if (strpos($envContent, 'STRIPE_SECRET=') === false) {
                $envContent .= $lineBreak . 'STRIPE_SECRET=' . $request->STRIPE_SECRET . $lineBreak;
            } else {
                $envContent = preg_replace(
                    '/STRIPE_SECRET=(.*)/',
                    'STRIPE_SECRET=' . $request->STRIPE_SECRET,
                    $envContent
                );
            }

            // Handle webhook secret (optional)
            if ($request->filled('STRIPE_WEBHOOK_SECRET')) {
                if (strpos($envContent, 'STRIPE_WEBHOOK_SECRET=') === false) {
                    $envContent .= $lineBreak . 'STRIPE_WEBHOOK_SECRET=' . $request->STRIPE_WEBHOOK_SECRET . $lineBreak;
                } else {
                    $envContent = preg_replace(
                        '/STRIPE_WEBHOOK_SECRET=(.*)/',
                        'STRIPE_WEBHOOK_SECRET=' . $request->STRIPE_WEBHOOK_SECRET,
                        $envContent
                    );
                }
            }

            // End of webhook secret handling
            File::put(base_path('.env'), $envContent);

            // Return a success response
            return redirect()->back()->with('success', 'Stripe settings updated successfully.');
        } catch (Exception $e) {
            //Handle the exception and return an error response
            return redirect()->back()->with('error', 'Failed to update Stripe settings: ' . $e->getMessage());
        }
    }
}

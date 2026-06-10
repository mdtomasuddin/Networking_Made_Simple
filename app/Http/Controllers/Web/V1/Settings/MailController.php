<?php
namespace App\Http\Controllers\Web\V1\Settings;

use App\Http\Requests\Web\V1\Setting\Mail\StoreRequest;
use App\Services\Web\V1\Setting\MailService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailController
{
    // Mail Service
    private MailService $mailService;

    /**
     * MailController constructor.
     * @param \App\Services\Web\V1\Setting\MailService $mailService
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Mail settings page view
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): View
    {
        return view('backend.layouts.settings.mail.edit');
    }

    /**
     * store
     * @param \App\Http\Requests\Web\V1\Setting\Mail\StoreRequest $storeRequest
     * @return RedirectResponse
     */
    public function store(StoreRequest $storeRequest): RedirectResponse
    {
        try {
            // Extract only the relevant fields from the request
            $data = $storeRequest->only([
                'mail_mailer',
                'mail_host',
                'mail_port',
                'mail_username',
                'mail_password',
                'mail_encryption',
                'mail_address',
            ]);

            // Update the mail configuration using the MailService
            $this->mailService->updateMailConfig($data);

            // Redirect back with a success message
            return back()->with('t-success', 'Setting Saved');
        } catch (Exception $e) {
            // Log the error for debugging purposes
            Log::error('App\Http\Controllers\Web\V1\Setting\MailController:store', ['error' => $e->getMessage()]);
            // Redirect back with an error message
            return back()->with('t-error', 'Failed to update');
        }
    }
}

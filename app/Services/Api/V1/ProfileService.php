<?php

namespace App\Services\Api\V1;

use App\Helpers\Helper;
use App\Models\BusinessCard;
use App\Models\Contact;
use App\Models\PaymentLink;
use App\Models\Theme;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    /**
     * Update user profile, contact, business card, payment link, and theme via DB Transaction.
     */
    public function updateProfile(User $user, array $data): User
    {
        // Start transaction
        DB::beginTransaction();
        try {
            // Extract user data while excluding related models and null values
            $userData = collect($data)->except(['contact', 'business_card', 'payment_link', 'theme'])
                ->filter(fn($value) => ! is_null($value))->toArray();

            //Handle avatar and cover photo upload and deletion
            if (! empty($userData)) {

                // Generate handle if not provided and user doesn't have one
                if (empty($user->handle) && empty($userData['handle'])) {
                    $firstName = $userData['first_name'] ?? $user->first_name;
                    $lastName  = $userData['last_name'] ?? $user->last_name;
                    $name      = trim($firstName . ' ' . $lastName);
                    if (! empty($name)) {
                        $userData['handle'] = Helper::generateUniqueSlug($name, 'users', 'handle');
                    }
                }

                //Handle avatar upload and deletion
                if (isset($userData['avatar']) && $userData['avatar']) {
                    if ($user->avatar) {
                        Helper::deleteFile($user->avatar);
                    }
                    //Upload new avatar
                    $userData['avatar'] = Helper::uploadFile($userData['avatar'], 'avatar');
                }

                //Handle cover photo upload and deletion
                if (isset($userData['cover_photo']) && $userData['cover_photo']) {
                    if ($user->cover_photo) {
                        Helper::deleteFile($user->cover_photo);
                    }
                    //Upload new cover photo
                    $userData['cover_photo'] = Helper::uploadFile($userData['cover_photo'], 'cover_photo');
                }

                //User Data Update
                $user->update($userData);
            }

            // Handle Contact Update or Create
            if (isset($data['contact'])) {
                Contact::updateOrCreate(
                    ['user_id' => $user->id],
                    $data['contact']
                );
            }

            // Handle Business Card Update or Create
            if (isset($data['business_card'])) {
                $businessCardData = collect($data['business_card'])->only([
                    'front_image',
                    'back_image',
                ])->toArray();

                $existingCard = null;

                // Handle front image upload and deletion
                $existingCard = $user->businessCard()->first();
                if (isset($businessCardData['front_image']) && $businessCardData['front_image']) {
                    if ($existingCard && $existingCard->front_image) {
                        Helper::deleteFile($existingCard->front_image);
                    }
                    $businessCardData['front_image'] = Helper::uploadFile($businessCardData['front_image'], 'business_card');
                }

                // Handle back image upload and deletion
                if (isset($businessCardData['back_image']) && $businessCardData['back_image']) {
                    if ($existingCard && $existingCard->back_image) {
                        Helper::deleteFile($existingCard->back_image);
                    }
                    $businessCardData['back_image'] = Helper::uploadFile($businessCardData['back_image'], 'business_card');
                }

                // Handle Business Card Update or Create
                BusinessCard::updateOrCreate(
                    ['user_id' => $user->id],
                    $businessCardData
                );
            }

            // Handle Payment Link Update or Create
            if (isset($data['payment_link'])) {
                PaymentLink::updateOrCreate(
                    ['user_id' => $user->id],
                    $data['payment_link']
                );
            }

            //Handle Theme Update or Create
            if (isset($data['theme'])) {
                Theme::updateOrCreate(
                    ['user_id' => $user->id],
                    $data['theme']
                );
            }

            // Commit transaction
            DB::commit();

            // Return user with loaded relationships
            return $user->load(['contact', 'businessCard', 'paymentLink', 'theme']);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback transaction
            throw $e;
        }
    }
}

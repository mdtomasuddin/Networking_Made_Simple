<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define social media platforms with profile links and timestamps
        $data = [
            [
                'id'           => 1,
                'social_media' => 'facebook',
                'profile_link' => 'https://www.facebook.com/',
                'created_at'   => '2025-02-19 00:03:21',
                'updated_at'   => '2025-03-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'social_media' => 'instagram',
                'profile_link' => 'https://www.instagram.com/',
                'created_at'   => '2025-04-19 00:03:21',
                'updated_at'   => '2025-05-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 3,
                'social_media' => 'twitter',
                'profile_link' => 'https://x.com/',
                'created_at'   => '2025-06-19 00:03:21',
                'updated_at'   => '2025-07-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 4,
                'social_media' => 'linkedin',
                'profile_link' => 'https://www.linkedin.com/',
                'created_at'   => '2025-08-19 00:03:21',
                'updated_at'   => '2025-09-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 7,
                'social_media' => 'youtube',
                'profile_link' => 'https://www.youtube.com/',
                'created_at'   => '2025-12-19 00:03:21',
                'updated_at'   => '2026-01-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 9,
                'social_media' => 'whatsapp',
                'profile_link' => 'https://www.whatsapp.com/',
                'created_at'   => '2026-04-19 00:03:21',
                'updated_at'   => '2026-04-24 00:03:21',
                'deleted_at'   => null,
            ],

        ];

        // Insert the data into the database
        foreach ($data as $newData) {
            SocialMedia::create($newData);
        }
    }
}

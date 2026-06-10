<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'Networking Made Simple',
                'system_name'    => 'Networking Made Simple',
                'email'          => 'info@support.com',
                'phone'          => '01100000000',
                'address'        => 'Dhaka, Dhaka, Bangladesh',
                'copyright_text' => '©copy right Networking Made Simple',
                'description'    => '<p>About System...</p>',
                'logo'           => null,
                'favicon'        => null,
                'sidebar'        => null,
                'created_at'     => '2024-12-08 05:08:00',
                'updated_at'     => '2024-12-08 05:08:00',
            ],
        ]);
    }
}

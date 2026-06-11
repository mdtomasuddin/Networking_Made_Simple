<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name'        => 'Farisha',
                'last_name'         => '.',
                'handle'            => 'farisha',
                'email'             => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
                'avatar'            => NULL,
                'role_id'           => 1,
                'status'            => true,
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'first_name'        => 'Tofial',
                'last_name'         => 'Islam',
                'handle'            => 'tofial',
                'email'             => 'user@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
                'avatar'            => "assets/backend/images/avatar/avatar-1.png",
                'role_id'           => 2,
                'status'            => true,
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'first_name'        => 'shakib',
                'last_name'         => 'Islam',
                'handle'            => 'shakib',
                'email'             => 'user1@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
                'avatar'            => "assets/backend/images/avatar/avatar.png",
                'role_id'           => 2,
                'status'            => true,
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'first_name'        => 'Tomas',
                'last_name'         => 'Uddin',
                'handle'            => 'tomas',
                'email'             => 'mdtomsuddin1@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
                'avatar'            => null,
                'role_id'           => 1,
                'status'            => true,
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

        ]);
    }
}

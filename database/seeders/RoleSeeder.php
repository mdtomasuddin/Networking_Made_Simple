<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('roles')->insert([
            [
                'id'         => 1,
                'slug'       => 'admin',
                'name'       => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'         => 2,
                'slug'       => 'user',
                'name'       => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

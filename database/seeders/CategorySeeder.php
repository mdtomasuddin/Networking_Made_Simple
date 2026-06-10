<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fine Art',
                'type' => 'myitem',
                'image' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?q=80&w=800',
                'status' => 'active',
            ],
            [
                'name' => 'Luxury Watches',
                'type' => 'myitem',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800',
                'status' => 'active',
            ],
            [
                'name' => 'Classic Cars',
                'type' => 'myitem',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800',
                'status' => 'active',
            ],
            [
                'name' => 'Rare Spirits',
                'type' => 'myitem',
                'image' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=800',
                'status' => 'active',
            ],
            [
                'name' => 'Designer Jewelry',
                'type' => 'myitem',
                'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=800',
                'status' => 'active',
            ],
        ];
        // seed the categories
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

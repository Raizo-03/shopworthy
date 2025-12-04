<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Fashion', 'description' => 'Clothing, shoes, and accessories'],
            ['name' => 'Home & Garden', 'description' => 'Home decor and garden supplies'],
            ['name' => 'Sports', 'description' => 'Sports equipment and fitness gear'],
            ['name' => 'Books', 'description' => 'Books and magazines'],
            ['name' => 'Toys', 'description' => 'Toys and games for all ages'],
            ['name' => 'Beauty', 'description' => 'Beauty and personal care products'],
            ['name' => 'Automotive', 'description' => 'Auto parts and accessories'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}

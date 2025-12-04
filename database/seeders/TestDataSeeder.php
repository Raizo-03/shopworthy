<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        Cart::create(['user_id' => $user->id]);

        // Create test seller
        $seller = Seller::create([
            'name' => 'Test Seller',
            'email' => 'seller@test.com',
            'password' => Hash::make('password'),
            'shop_name' => 'Amazing Tech Store',
            'shop_description' => 'Your one-stop shop for all tech needs',
            'phone' => '+1234567890',
        ]);

        // Create some sample products
        $categories = Category::all();
        
        if ($categories->count() > 0) {
            $products = [
                [
                    'name' => 'Premium Wireless Headphones',
                    'description' => 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
                    'price' => 199.99,
                    'stock' => 50,
                ],
                [
                    'name' => 'Smart Fitness Watch',
                    'description' => 'Track your fitness goals with this advanced smartwatch featuring heart rate monitoring.',
                    'price' => 149.99,
                    'stock' => 30,
                ],
                [
                    'name' => 'Laptop Stand Pro',
                    'description' => 'Ergonomic aluminum laptop stand for comfortable working and improved posture.',
                    'price' => 49.99,
                    'stock' => 100,
                ],
                [
                    'name' => 'Mechanical Gaming Keyboard',
                    'description' => 'RGB mechanical keyboard with customizable keys for ultimate gaming experience.',
                    'price' => 129.99,
                    'stock' => 40,
                ],
                [
                    'name' => 'Wireless Mouse',
                    'description' => 'Precision wireless mouse with ergonomic design and long battery life.',
                    'price' => 39.99,
                    'stock' => 75,
                ],
            ];

            foreach ($products as $index => $productData) {
                Product::create([
                    'seller_id' => $seller->id,
                    'category_id' => $categories->random()->id,
                    'name' => $productData['name'],
                    'slug' => \Illuminate\Support\Str::slug($productData['name']) . '-' . \Illuminate\Support\Str::random(6),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'is_active' => true,
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get category IDs
        $stitchedCategory = Category::where('name', 'Stitched')->first()->id;
        $unstitchedCategory = Category::where('name', 'Unstitched')->first()->id;

        // Create 10 products dynamically
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'actual_price' => rand(10, 100),
                'discount' => rand(0, 50),
                'discounted_price' => null, // You may calculate discounted price if needed
                'description' => 'Description of Product ' . $i,
                'rating' => rand(1, 5),
                'colors' => ['Color ' . $i], // You may adjust the colors as needed
                'image_url' => 'https://via.placeholder.com/300?text=Product' . $i,
                'category_id' => ($i % 2 == 0) ? $stitchedCategory : $unstitchedCategory,
            ]);
        }
    }
}

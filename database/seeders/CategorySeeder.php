<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create two categories: 'Stitched' and 'Unstitched'
        Category::create(['name' => 'Stitched']);
        Category::create(['name' => 'Unstitched']);
    }
}

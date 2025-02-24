<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Science', 'Technology', 'History', 'Literature', 'Economy', 'Children', 'Novel', 'News', 'Other'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

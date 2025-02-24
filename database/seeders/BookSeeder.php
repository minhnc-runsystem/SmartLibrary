<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there are at least 6 categories before creating books
        Category::factory(9)->create();

        Book::create([
            'title' => 'Laravel for Beginners',
            'author' => 'John Doe',
            'published_year' => 2022,
            'total_quantity' => 10,
            'quantity' => 10,
            'status' => 'available',
            'category_id' => 2,
        ]);

        Book::factory(20)->create(); // Create 10 random books
    }
}


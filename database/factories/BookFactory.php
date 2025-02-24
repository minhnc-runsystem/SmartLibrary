<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = \App\Models\Book::class;

    public function definition()
    {
        $total_quantity = $this->faker->numberBetween(5, 20);
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'published_year' => $this->faker->year,
            'total_quantity' => $total_quantity,
            'quantity' => $total_quantity, // Ban đầu số lượng còn lại bằng tổng số
            'status' => 'available',
            'category_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}


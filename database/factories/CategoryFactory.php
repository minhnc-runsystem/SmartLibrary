<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = \App\Models\Category::class;

    private static $index = 0;

    public function definition()
    {
        $categories = ['Science', 'Technology', 'History', 'Literature', 'Economy', 'Children', 'Novel', 'News', 'Other'];

        $name = $categories[self::$index % count($categories)];
        self::$index++;

        return [
            'name' => $name,
        ];
    }
}

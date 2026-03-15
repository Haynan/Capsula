<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(10, 999),
            'short_description' => fake()->sentence(),
            'full_description' => fake()->paragraph(),
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => fake()->numberBetween(1, 50),
        ];
    }
}

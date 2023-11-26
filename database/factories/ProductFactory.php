<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->colorName(),
            'product_num' => "BSP-0".mt_rand(100000000,999999999),
            'seo_title' => fake()->colorName(),
            'slug' => fake()->unique()->firstNameMale(),
            'image' => '/images/products/product'.fake()->numberBetween('1','5').'.jpg',
            'price' => fake()->numberBetween('10000','999999'),
            'description' => Str::random(200),
            'seo_description' => Str::random(120),
            'status' => 1,
            'inventory' => fake()->numberBetween('10','50'),
            'max_order' => fake()->numberBetween('1','10'),
        ];
    }
}

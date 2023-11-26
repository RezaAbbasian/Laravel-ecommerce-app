<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
            'seo_title' => fake()->colorName(),
            'slug' => fake()->unique()->firstNameMale(),
            'image' => '/images/categories/cat'.fake()->numberBetween('1','11').'.jpg',
            'description' => Str::random(200),
            'seo_description' => Str::random(120),
            'status' => 1,
        ];
    }
}

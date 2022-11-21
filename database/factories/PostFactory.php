<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->text(30);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->sentence(100),
            'image' => $this->faker->imageUrl($width = 1200, $height = 400),
        ];
    }
}

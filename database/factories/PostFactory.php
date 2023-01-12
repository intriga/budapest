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
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->sentence(1000),
            'image' => $this->faker->imageUrl($width = 1920, $height = 1080),
        ];
    }
}

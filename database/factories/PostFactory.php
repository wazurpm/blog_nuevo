<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'img_path' => fake()->imageUrl(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}

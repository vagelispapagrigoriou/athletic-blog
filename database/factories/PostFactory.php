<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Override;

/**
 * @extends Factory<Post>
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
            'author_id' => User::factory(),
            'title' => [
                'el' => fake()->sentence(),
                'en' => fake()->sentence(),
                ],
            'description' => [
                'el' => fake()->paragraph(),
                'en' => fake()->paragraph(),
                ],
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Post $post){
            $categoryIds = Category::query()
                ->inRandomOrder()
                ->pluck('id');

            $post->categories()->attach($categoryIds);
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'likes' => $this->faker->numberBetween(0, 100),
            'dislikes' => $this->faker->numberBetween(0, 100),
            'likeable_type' => $this->faker->randomElement(['Article']),
            //'likeable_id' => $this->faker->numberBetween(1, 50),
            // article_id references the articles table
            'likeable_id' => \App\Models\Article::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

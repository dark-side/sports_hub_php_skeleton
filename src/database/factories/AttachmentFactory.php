<?php

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->url,
            'article_id' => \App\Models\Article::factory(),
            'user_id' => \App\Models\User::factory(),
            'filename' => $this->faker->word,
            'content_type' => 'image/jpeg',
            'metadata' => $this->faker->sentence,
            'byte_size' => $this->faker->numberBetween(1000, 9000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'encrypted_password' => Hash::make('default_password'),
            'reset_password_token' => Str::random(60),
            'reset_password_sent_at' => $this->faker->dateTime,
            'remember_created_at' => $this->faker->dateTime,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

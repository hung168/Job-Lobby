<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobSeeker>
 */
class JobseekerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'address' => fake()->streetAddress . ', ' . fake()->city . ', ' . fake()->state . ', ' . fake()->randomElement(['43000', '50000', '60000']) . ', Malaysia',
            'date_of_birth' => fake()->date,
            'gender' => fake()->randomElement(['Male', 'Female']),
            'nationality' => fake()->country,
            'email' => fake()->unique()->safeEmail,
            'telephone' => fake()->phoneNumber,
            'field_of_major' => fake()->word,
            'education_level' => fake()->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
        ];
    }
}

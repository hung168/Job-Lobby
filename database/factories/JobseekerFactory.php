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
            'user_id' => User::factory()->create()->id, // Create a user and use its ID as the foreign key
            'name' => $faker->name,
            'address' => $faker->address,
            'date_of_birth' => $faker->date,
            'gender' => $faker->randomElement(['Male', 'Female']),
            'nationality' => $faker->country,
            'email' => $faker->unique()->safeEmail,
            'telephone' => $faker->phoneNumber,
            'field_of_major' => $faker->word,
            'education_level' => $faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
        ];
    }

}

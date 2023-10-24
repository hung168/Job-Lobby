<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $developerWordList = ['backend', 'API', 'database', 'C++', 'python', 'C#', 'testing', 'Java'];
        shuffle($developerWordList);
        $randomWords = array_slice($developerWordList, 0, 3);

        return [
            'title' => $this->faker->sentence(),
            'tags' => implode(', ', $randomWords),
            'company' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->url(),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(5),
            'reported' => rand(0, 1),
            'verified' => function () {
                // Generate a random value between 0 and 1
                $verified = rand(0, 1);

                // If 'reported' is 1, set 'verified' to 0; otherwise, keep the random value
                return $verified && rand(0, 1) === 1 ? 0 : $verified;
            },
            'boosted' => rand(0, 1),
        ];
    }
}

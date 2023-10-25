<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_profile_pic' => 'images/employer.png',
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'function_title' => fake()->jobTitle,
            'department' => fake()->randomElement(['Sales', 'Marketing', 'Finance', 'IT', 'HR']),
            'company_name' => fake()->company,
            'company_industry' => fake()->word,
            'company_overview' => fake()->sentence,
            'company_registration_number' => fake()->numerify('##########'),
            'address' => fake()->streetAddress . ', ' . fake()->city . ',Kuala Lumpur,' . fake()->randomElement(['43000', '50000', '60000']) . ', Malaysia',
            'company_contact_number' => '05' . fake()->regexify('[2-9]{7}'),
            'company_website' => fake()->url,
            'company_size' => fake()->randomElement(['Small', 'Medium', 'Large']),
            'company_working_hour' => fake()->randomElement(['Full-time', 'Part-time']),
            'company_dress_code' => fake()->sentence,
            'company_benefits' => fake()->sentence,

        ];
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use App\Models\Jobseeker;
use App\Models\Employer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::factory(10)->create();

        User::where('user_type', 'employer')->get()->each(function ($user) {
            $employer = Employer::factory()->create(['user_id' => $user->id]);
        
            // Create listings for this specific employer
            Listing::factory(5)->create([
                'employer_user_id' => $employer->user_id
            ]);
        });
        
        User::where('user_type', 'job_seeker')->get()->each(function ($user) {
            $jobseeker = Jobseeker::factory()->create(['user_id' => $user->id]);
        });
        

    }
}

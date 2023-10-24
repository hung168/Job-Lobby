<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use App\Models\Jobseeker;
use App\Models\Employer;
use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users (either Employer or Job Seekers)
        User::factory(10)->create();

        // Create Employer users
        User::where('user_type', 'employer')->get()->each(function ($user) {
            $employer = Employer::factory()->create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

            // Create Address record
            $addressParts = explode(', ', $employer->address);
            Address::create([
                'user_id' => $employer->user_id,
                'address' => $employer->address,
                'street_address' => $addressParts[0],
                'city' => $addressParts[1],
                'state_province' => $addressParts[2],
                'postal_code' => $addressParts[3],
                'country' => $addressParts[4],
            ]);

            // Create listings for this specific employer
            $listings = Listing::factory(5)->create([
                'employer_user_id' => $employer->user_id
            ]);
        });

        // Create Job seeker users
        User::where('user_type', 'job seeker')->get()->each(function ($user) {
            $jobseeker = Jobseeker::factory()->create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

            // Create Address record
            $addressParts = explode(', ', $jobseeker->address);
            Address::create([
                'user_id' => $jobseeker->user_id,
                'address' => $jobseeker->address,
                'street_address' => $addressParts[0],
                'city' => $addressParts[1],
                'state_province' => $addressParts[2],
                'postal_code' => $addressParts[3],
                'country' => $addressParts[4],
            ]);
        });

        // Create 1 Admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'user_type' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now()
        ]);
    }
}

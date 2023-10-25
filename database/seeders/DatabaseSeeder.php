<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use App\Models\Jobseeker;
use App\Models\Employer;
use App\Models\Address;
use App\Models\EmpRating;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Store images into storage 
        // Path to the directory where your images are in the public directory
        $imageDirectory = public_path('images');

        // Path where you want to store the images in the storage directory
        $storageDirectory = public_path('storage/images');

        // Ensure the storage directory exists
        File::makeDirectory($storageDirectory, 0755, true, true);

        // List of image file names in the public directory
        $imageFiles = File::files($imageDirectory);

        foreach ($imageFiles as $imageFile) {
            // Get the filename of the image
            $fileName = $imageFile->getFilename();

            // Copy the image from public to the storage directory
            File::copy($imageDirectory . '/' . $fileName, $storageDirectory . '/' . $fileName);
        }

        // Path to the directory where your images are in the public directory
        $imageDirectory2 = public_path('logos');

        // Path where you want to store the images in the storage directory
        $storageDirectory2 = public_path('storage/logos');

        // Ensure the storage directory exists
        File::makeDirectory($storageDirectory2, 0755, true, true);

        // List of image file names in the public directory
        $imageFiles2 = File::files($imageDirectory2);

        foreach ($imageFiles2 as $imageFile) {
            // Get the filename of the image
            $fileName = $imageFile->getFilename();

            // Copy the image from public to the storage directory
            File::copy($imageDirectory2 . '/' . $fileName, $storageDirectory2 . '/' . $fileName);
        }

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
            $addressParts = explode(',', $employer->address);
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
            $addressParts = explode(',', $jobseeker->address);
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

        // Create Rating for Employer
        $employers = User::where('user_type', 'employer')->get();
        $jobSeekerIds = User::where('user_type', 'job seeker')->pluck('id')->toArray();
        foreach ($employers as $employer){
            EmpRating::create([
                'user_id' => $employer->id,
                'rateable_id' => $jobSeekerIds[array_rand($jobSeekerIds)],
                'rateable_type' => 'Job Seeker', // Set the rateable_type to the Jobseeker model
                'rating' => rand(1, 5), // Generate a random rating
                'comments' => 'The employer is reviewed by me',
            ]);
        }

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

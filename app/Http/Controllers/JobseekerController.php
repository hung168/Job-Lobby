<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jobseeker;
use App\Models\Address;
use App\Models\JobseekerJobExperience;
use Illuminate\Support\Facades\Validator;


class JobseekerController extends Controller
{
    //Show job seeker registration page
    public function register(){
        return view('users.jobseeker_register');
    }

    //Create job seeker user
    public function createNewUser(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6',
        ]);

        $firstTimeLogin = $request->input('firstTimeLogin', 'No'); // Default to 'No' if not present


        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['user_type'] = 'Job Seeker';

        //Create user
        $user = User::create($formFields);

        $newUserId = $user->id;
        $newUserName = $user->name;
        $newEmail = $user->email;

        Jobseeker::create([
            'user_id' => $newUserId,
            'name' => $newUserName,
            'email' => $newEmail,
        ]);

        //Login
        auth()->login($user);

        return redirect("/editProfile/{{$newUserName}}/JobSeeker")->with('message', 'User created and logged in')->with('firstTimeLogin', $firstTimeLogin);
        ;
    }

    //Show job seeker profile edit page
    public function editProfile()
    {
        $user = auth()->user(); // Get the currently authenticated user
        $jobSeeker = Jobseeker::where('user_id', $user->id)->first(); // Retrieve the associated JobSeeker record
        
        // Retrieve the Address record associated with the same user_id
        $address = Address::where('user_id', $user->id)->first();
        $jobExperiences = JobseekerJobExperience::where('job_seeker_id', $jobSeeker->user_id)->get();

        $options = [
            'StateProvince' => [
                'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan',
                'Pahang', 'Penang', 'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu'
            ],
            'Gender' => [
                'Male', 'Female'
            ],
            'EducationLevel' => [
                'High School', "Bachelor's Degree", "Master's Degree", 'Doctorate'
            ],
            'CompanyDressCode' => [
                'Not Specified', 'Casual (e.g. T-shirts)', 'Business (e.g. Shirts)', 'Formal (e.g. Shirts + Ties)', 'Others (Please Specify)'
            ],
            'EmployerBenefits' => [
                'Health Insurance', 'Dental Coverage', 'Retirement Plan', 'Paid Time Off', 'Parking',
                'Vision', 'Education Support', 'Allowance', 'Others (Please specify)'
            ]
        ];
        
        
        $selectedOptions = [
            'SelectedGender' => $jobSeeker->gender ?? '',
            'SelectedEducationLevel' => $jobSeeker->education_level ?? '', // Set it to the correct field from the database
            'SelectedCompanyDressCode' => $jobSeeker->company_dress_code ?? '',
        ];


        return view('users.jobseeker_profile_edit', compact('jobSeeker', 'address', 'options', 'selectedOptions','jobExperiences'));
    }
    //update job seeker profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $jobSeeker = Jobseeker::where('user_id', $user->id)->first(); // Find the job seeker record associated with the user

        // Update the profile picture if a new one is provided
        if ($request->hasFile('jobseeker_profile_pic')) {
            $profilePicPath = $request->file('jobseeker_profile_pic')->store('images', 'public');
            $jobSeeker->update(['jobseeker_profile_pic' => $profilePicPath]);
        }
        
        // $request->validate([
        //     // 'name' => 'required|string|max:255',
        //     // 'email' => 'required|email|unique:users,email,' . $user->id,
        //     // 'date_of_birth' => 'required|date',
        //     // 'user_type' => 'required|in:Job Seeker,male', // Adjust as needed
        //     'street_address' => 'max:255',
        //     'city' => 'max:255',
        //     'state_province' => 'required',
        //     'nationality' => 'max:255',
        //     'postal_code' => 'regex:/^\d{5}$/',
        //     'telephone' => 'required|malaysia_phone',
        // ]);

        // Update the JobSeeker's address
        $jobSeeker->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
            'nationality' => $request->input('nationality'),
            'telephone' => $request->input('telephone'),
            'education_level' => $request->input('education_level'),
            'field_of_major' => $request->input('field_of_major'),
        ]);
        
        $existingAddress = Address::where('user_id', $user->id)->first();
  
        if ($existingAddress) {
            // Address record with the specified user_id exists; update it
            $existingAddress->update([
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state_province' => $request->input('state_province'),
                'postal_code' => $request->input('postal_code'),
                'country' => "Malaysia",
                'address' => implode(', ', [
                    $request->input('street_address'),
                    $request->input('city'),
                    $request->input('state_province'),
                    $request->input('postal_code'),
                    'Malaysia',
                ]),
            ]);
        
            // Update the JobSeeker's address
            $jobSeeker->update([
                'address' => $existingAddress->address, // Update with existing address
            ]);
        } else {
            // Address record with the specified user_id does not exist; create a new one
            $address = Address::create([
                'user_id' => $jobSeeker->user_id,
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state_province' => $request->input('state_province'),
                'postal_code' => $request->input('postal_code'),
                'country' => "Malaysia",
                'address' => implode(', ', [
                    $request->input('street_address'),
                    $request->input('city'),
                    $request->input('state_province'),
                    $request->input('postal_code'),
                    'Malaysia',
                ]),
            ]);
        
            // Update the JobSeeker's information with the new address
            $jobSeeker->update([
                'address' => $address->address, // Update with new address
            ]);
        }

        // Update the user's information
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $jobTitles = $request->input('job_titles');
        $companyNames = $request->input('company_names');
        $jobDescriptions = $request->input('job_descriptions');
        $startDates = $request->input('start_dates');
        $endDates = $request->input('end_dates');
        $experienceIds = $request->input('experience_ids'); // Assuming you have a hidden input for experience IDs

        // Check if job experiences exist before processing
        if (!empty($jobTitles)) {
            // Loop through the job experiences and update or create records
            foreach ($jobTitles as $key => $jobTitle) {
                $jobExperienceId = $experienceIds[$key] ?? 0; // Default to 0 if not provided

                if ($jobExperienceId) {
                    // Update the existing job experience record
                    $jobExperience = JobseekerJobExperience::find($jobExperienceId);
                    if ($jobExperience) {
                        $jobExperience->update([
                            'job_title' => $jobTitle,
                            'company_name' => $companyNames[$key],
                            'job_description' => $jobDescriptions[$key],
                            'start_date' => $startDates[$key],
                            'end_date' => $endDates[$key],
                        ]);
                    }
                } else {
                    // Create a new job experience entry
                    JobseekerJobExperience::create([
                        'job_seeker_id' => auth()->user()->jobSeeker->user_id, // Assuming you have a relationship between User and JobSeeker
                        'job_title' => $jobTitle,
                        'company_name' => $companyNames[$key],
                        'job_description' => $jobDescriptions[$key],
                        'start_date' => $startDates[$key],
                        'end_date' => $endDates[$key],
                        'job_seeker_name' => $jobSeeker->name, // Add the job seeker's name
                        // Add other fields as needed
                    ]);
                }
            }
        }


        // Redirect back to the profile edit page with a success message
        return redirect('/')->with('success', 'Profile updated successfully');
    }


    public function deleteJobExperience($experienceId)
    {

        try {

            
            // Find the job experience record by its ID
            $jobExperience = JobseekerJobExperience::findOrFail($experienceId);
    
            // Check if the authenticated user owns this job experience (for security)
            if ($jobExperience->job_seeker_id === auth()->user()->jobSeeker->user_id) {
                // Delete the job experience
                $jobExperience->delete();
    
                return response()->json(['success' => true]);
            }
    
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    
}
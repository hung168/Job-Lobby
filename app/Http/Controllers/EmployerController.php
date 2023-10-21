<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use App\Models\Address;


class EmployerController extends Controller
{
    //Show employer registration page
    public function register(){
        return view('users.employer_register');
    }

    //Retrieve employer list
    public function retrieveEmployerList(){
        return view('pages.employer_list', [
            'employers' => Employer::latest()->get()
        ]);
    }

    public function showEmployerDetails($id){
        $employer = Employer::find($id);
        return view('pages.employer_details', compact('employer'));
    }

    //Create employer user
    public function createNewUser(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6',
        ]);

        $firstTimeLogin = $request->input('firstTimeLogin', 'No'); // Default to 'No' if not present


        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['user_type'] = 'Employer';

        //Create user
        $user = User::create($formFields);

        $newUserId = $user->id;
        $newUserName = $user->name;
        $newEmail = $user->email;

        Employer::create([
            'user_id' => $newUserId,
            'name' => $newUserName, 
            'email' => $newEmail,
        ]);
        
        //Login
        auth()->login($user);


        return redirect("/editProfile/{$newUserName}/Employer")
            ->with('message', 'User created and logged in')
            ->with('firstTimeLogin', $firstTimeLogin);
        }

    //Show job seeker profile edit page
    public function editProfile()
    {
        $user = auth()->user(); // Get the currently authenticated user
        $employer = Employer::where('user_id', $user->id)->first(); // Retrieve the associated Employer record

        // Retrieve the Address record associated with the same user_id
         $address = Address::where('user_id', $user->id)->first();

         $options = [
            'StateProvince' => [
                'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan',
                'Pahang', 'Penang', 'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu'
            ],
            'CompanySize' => [
                'Not Specified', '1-50', '51-200', '201-500', '501-1000', '1001-2000', 'More than 2000'
            ],
            'CompanyWorkingHours' => [
                'Not Specified', 'Regular hours, Mondays-Fridays', 'Saturdays or Shift required', 'Long hours'
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
            'SelectedBenefits' => explode(', ', $employer->company_benefits),
            'SelectedCompanySize' => $employer->company_size ?? '',
            'SelectedCompanyWorkingHour' => $employer->company_working_hour ?? '',
            'SelectedCompanyDressCode' => $employer->company_dress_code ?? '',
        ];


        return view('users.employer_profile_edit', compact('employer','address','options','selectedOptions'));

    }

    public function updateProfile(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Find the employer record associated with the user
        $employer = Employer::where('user_id', $user->id)->first();
    
        // Update the profile picture if a new one is provided
        if ($request->hasFile('employer_profile_pic')) {
            $profilePicPath = $request->file('employer_profile_pic')->store('images', 'public');
            $employer->update(['employer_profile_pic' => $profilePicPath]);
        }
    
        // Validation rules
        $ProfileValidation = [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
            'department' => 'required|string',
            'function_title' => 'required|string',
            'company_name' => 'required|string',
            'company_industry' => 'required|string',
            'company_contact_number' => 'required|integer',
            'company_overview' => 'required|string',
            'company_registration_number' => 'required|integer',
            'company_website' => 'nullable|url',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state_province' => 'required',
            'postal_code' => 'required|integer',
        ];
    
        // Custom validation messages
        $messages = [
            'email.unique' => 'The email address has already been taken.',
        ];
    
        // Validate the request data
        $request->validate($ProfileValidation, $messages);
        
        // Update the employer's company address and other fields
        $employer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'department' => $request->input('department'),
            'function_title' => $request->input('function_title'),
            'company_name' => $request->input('company_name'),
            'company_industry' => $request->input('company_industry'),
            'company_contact_number' => $request->input('company_contact_number'),
            'company_overview' => $request->input('company_overview'),
            'company_registration_number' => $request->input('company_registration_number'),
            'company_website' => $request->input('company_website'),
            'company_size' => $request->input('company_size'),
            'company_working_hour' => $request->input('company_working_hour'),
            'company_dress_code' => $request->input('company_dress_code'),
        ]);
    
        // Update employer benefits
        $selectedBenefits = $request->input('employer_benefits', []);
        $othersText = $request->input('employer_benefits_other');
    
        $selectedBenefits = array_diff($selectedBenefits, ['Others (Please specify)']);
    
        if (in_array('Others (Please specify)', $selectedBenefits) && !empty($othersText)) {
            $selectedBenefits[] = $othersText;
        }
    
        $employer->update(['company_benefits' => implode(', ', $selectedBenefits)]);
    
        // Update the employer's address
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
    
            // Update the employer's address
            $employer->update(['address' => $existingAddress->address]);
        } else {
            // Address record with the specified user_id does not exist; create a new one
            $address = Address::create([
                'user_id' => $employer->user_id,
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
    
            // Update the employer's information with the new address
            $employer->update(['address' => $address->address]);
        }
    
        // Update the user's information
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        // Redirect back to the profile edit page with a success message
        return redirect('/')->with('success', 'Profile updated successfully');
    }
    
}

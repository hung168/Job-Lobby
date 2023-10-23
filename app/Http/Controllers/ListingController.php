<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\UserListing;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
    //show all listings

    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(8)
        ]);
        
    }

    //Show single listing
    public function showSingleListing(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show single listing
    public function retrieveSingleListingData($id) {
        $listing = Listing::find($id);
        return response()->json($listing);
    }

    public function create() {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required', Rule::unique('listings','company')],
            'academic_field'=> 'required',
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description'=> 'required',
            'slots_available' => 'required|integer|min:1'

        ]);

        if($request->hasFIle('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['employer_user_id'] = auth()->id();
        $formFields['reported'] = 0;
        $formFields['verified'] = 0;

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //edit listing data
    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);
    }

    //update listing data
    public function update(Request $request, Listing $listing) {

        if($listing->employer_user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required'],
            'academic_field'=> 'required',
            'location'=> 'required',
            'website'=> 'required',
            'email'=> ['required', 'email'],
            'tags'=> 'required',
            'description'=> 'required',
            'slots_available' => 'required|integer|min:1'

        ]);

        if($request->hasFIle('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return redirect('/')->with('message', 'Listing updated successfully!');
    }

    //update listing data
    public function delete(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted successfully!');
    }

    public function manage(){
        // Get the currently authenticated user
        $user = auth()->user();
        
        // Check if the user is of type 'Employer'
        if ($user->user_type === 'Employer') {
            // Retrieve the listings associated with the employer
            $listings = Listing::where('employer_user_id', $user->id)->get();
        
            return view('listings.manage', compact('listings'));
        }
    
        // Handle the case where the user is not an employer (optional)
        // You can redirect or show an error message.
        return redirect('/')->with('error', 'Access denied.');
    }

    public function showApplicationList()
    {
        // Get the currently authenticated job seeker
        $user = auth()->user();
        
        // Check if the user is of type 'Job Seeker'
        if ($user->user_type === 'Job Seeker') {
            // Retrieve the job applications associated with the job seeker
            $applications = UserListing::where('user_id', $user->id)->with('listing')->get();
            return view('listings.application', compact('applications'));
        }
    
        // Handle the case where the user is not a job seeker (optional)
        // You can redirect or show an error message.
        return redirect('/')->with('error', 'Access denied.');
    }
    
    

    public function apply(Request $request, $listing)
    {
        // Check if the user is authenticated (signed in)
        if (Auth::check()) {
            // User is signed in, proceed with the job application
    
            // Create a new job application using the create() method
            UserListing::create([
                'user_id' => auth()->user()->id,
                'listing_id' => $listing,
                'status' => "Job Application In Review",
            ]);
    
            // Redirect with a success message
            return redirect('/')->with('message', 'Your job application has been submitted.');
        } else {
            // User is not signed in, show a message or redirect to the login page
            return redirect('/login')->with('message', 'Please sign in to apply for this job.');
        }
    }

    public function report($id)
    {
        $listing = Listing::find($id);

        if ($listing) {
            // Update the 'reported' field to 1
            $listing->update(['reported' => 1]);

            return redirect()->back()->with('success', 'Listing reported successfully');
        }
    }
}

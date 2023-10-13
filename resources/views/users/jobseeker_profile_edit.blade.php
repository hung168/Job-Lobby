<x-layout>
    <x-card class="!p-10 !max-w-lg !mx-auto !mt-24">

        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Profile
            </h2>
            <p class="mb-4">Make the best profile</p>
        </header>

        <form method="POST" action="/editProfile/{{$jobSeeker->name}}/submit">
            @csrf

            <!-- Name -->
            <x-text-input label="Name" name="name" type="text" :value="$jobSeeker->name" />

            <!-- Email -->
            <x-text-input name="email" label="Email" type="email" :value="$jobSeeker->email" />


            <!-- Date of Birth -->
            <div class="mb-6">
                <label for="date_of_birth" class="inline-block text-lg mb-2">Date of Birth</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="date_of_birth" value="{{ old('date_of_birth', $jobSeeker->date_of_birth) }}" />
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <x-dropdown name="gender" label="Gender" :options="$options['Gender']" :selected="old('gender', $selectedOptions['SelectedGender'])" />

            <!-- Job seeker street address -->
            <x-text-input name="street_address" label="Street Address" :value="old('street_address', optional($address)->street_address)" />
                
            <!-- Job seeker city -->
            <x-text-input name="city" label="City" :value="old('city', optional($address)->city)" />
                
            <!-- Job seeker state -->
            <x-dropdown name="state_province" label="State/Province" :options="$options['StateProvince']" :selected="old('state_province', optional($address)->state_province)" />

            <!-- Job seeker postal code -->
            <x-text-input name="postal_code" label="Postal Code" :value="old('postal_code', optional($address)->postal_code)" />      

            <!-- Job seeker country/region -->
            <div class="mb-6">
                <label for="country" class="inline-block text-lg mb-2">Country/Region: Malaysia</label>
            </div>            

            <!-- Job seeker nationality -->
            <x-text-input name="nationality" label="Nationality" :value="old('nationality', optional($jobSeeker)->nationality)" />      
          
            <!-- Job seeker telephone -->
            <x-text-input name="telephone" label="Telephone" :value="old('telephone', optional($jobSeeker)->telephone)" />      

            <!-- Job seeker education level -->
            <x-dropdown name="education_level" label="Highest Education Level" :options="$options['EducationLevel']" :selected="old('education_level', $selectedOptions['SelectedEducationLevel'])" />

            <!-- Job seeker field of major -->
            <x-text-input name="field_of_major" label="Field of Major" :value="old('field_of_major', optional($jobSeeker)->field_of_major)" />   

            <!-- Job Experiences Section -->
            <h2 class="text-lg font-semibold mt-4 mb-2">Job Experiences</h2>
            <div id="job-experiences">
            @if (!empty($jobExperiences))
                @foreach ($jobExperiences as $experience)
                    <div class="job-experience mb-4">
                        <input type="hidden" name="experience_ids[]" value="{{ $experience->id }}">
                        <input type="text" name="job_titles[]" placeholder="Job Title" class="border border-gray-200 rounded p-2 w-full" value="{{ old('job_titles.'.$loop->index, $experience->job_title) }}">
                        <input type="text" name="company_names[]" placeholder="Company Name" class="border border-gray-200 rounded p-2 w-full" value="{{ old('company_names.'.$loop->index, $experience->company_name) }}">
                        <textarea name="job_descriptions[]" placeholder="Job Description" class="border border-gray-200 rounded p-2 w-full">{{ old('job_descriptions.'.$loop->index, $experience->job_description) }}</textarea>
                        <input type="date" name="start_dates[]" class="border border-gray-200 rounded p-2 w-full" value="{{ old('start_dates.'.$loop->index, $experience->start_date) }}">
                        <input type="date" name="end_dates[]" class="border border-gray-200 rounded p-2 w-full" value="{{ old('end_dates.'.$loop->index, $experience->end_date) }}">
                        <button class="remove-experience mt-2 bg-red-500 text-white rounded px-3 py-1 text-sm" type="button" data-experience-id="{{ $experience->id }}">Remove</button>
                    </div>
                @endforeach
            @endif
            </div>
            <button id="add-experience" type="button" class="bg-green-500 text-white rounded px-3 py-1 mt-2 text-sm">Add Job Experience</button>

            <div class="mb-6">
                <button
                    type="submit"
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Done
                </button>
            </div>

            <div class="mt-8">
                <p>
                    Already have an account?
                    <a href="/login" class="text-laravel"
                        >Login</a
                    >
                </p>
            </div>

        </form>
    </x-card>
</x-layout>

<script>
    // Function to add a new job experience input fields
    function addJobExperience() {
        const jobExperiences = document.getElementById('job-experiences');
        const newExperience = document.createElement('div');
        newExperience.className = 'job-experience mb-4';

        // Create input fields for the new experience
        newExperience.innerHTML = `
            <input type="hidden" name="experience_ids[]" value=""> <!-- Hidden input for experience ID -->
            <input type="text" name="job_titles[]" placeholder="Job Title" class="border border-gray-200 rounded p-2 w-full">
            <input type="text" name="company_names[]" placeholder="Company Name" class="border border-gray-200 rounded p-2 w-full">
            <textarea name="job_descriptions[]" placeholder="Job Description" class="border border-gray-200 rounded p-2 w-full"></textarea>
            <input type="date" name="start_dates[]" class="border border-gray-200 rounded p-2 w-full">
            <input type="date" name="end_dates[]" class="border border-gray-200 rounded p-2 w-full">
            <button class="remove-experience mt-2 bg-red-500 text-white rounded px-3 py-1 text-sm" type="button" data-experience-id="">Remove</button>
        `;

        // Append the new experience fields to the container
        jobExperiences.appendChild(newExperience);

        // Add a click event listener to the "Remove" button
        newExperience.querySelector('.remove-experience').addEventListener('click', removeJobExperience);
    }

    // Function to remove a job experience
    function removeJobExperience() {
        const experienceId = this.getAttribute('data-experience-id');
        const jobExperiences = document.getElementById('job-experiences');
        const experienceDiv = this.closest('.job-experience');

        if (experienceId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Get the CSRF token from the "meta" tag in your HTML
            console.log('Remove experience button clicked');
            

            // Send an AJAX request to delete the record from the database
            fetch(`/delete-job-experience/${experienceId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If the record is successfully deleted, remove the corresponding job experience from the page
                    experienceDiv.remove();
                } else {
                    // Handle error or show a notification to the user
                    console.error('Error deleting record:', data.message);
                }
            })
            .catch(error => {
                console.error('Error deleting record:', error);
            });
        } else {
            // If experienceId is empty, simply remove the experience from the form
            experienceDiv.remove();
        }
    }

    // Add an event listener to the "Add Job Experience" button
    document.getElementById('add-experience').addEventListener('click', addJobExperience);

    // Add event listeners to existing "Remove" buttons
    const removeButtons = document.querySelectorAll('.remove-experience');
    removeButtons.forEach(button => {
        button.addEventListener('click', removeJobExperience);
    });
</script>




<x-basic-layout>
    @include('partials._jobseekernavbar')

    <x-card class="p-6 max-w mx-auto max-w-5xl mt-10 rounded-lg shadow-md mb-20">
        <header class="text-center">
            <h2 class="text-2xl font-semibold text-gray-900">Job Seeker Profile</h2>
            <p class="mt-2 text-sm text-gray-600">Fill in your details</p>
        </header>

        <form method="POST" action="/editProfile/{{ $jobSeeker->name }}/submit">
            @csrf
            <div class="mx-auto max-w-2xl">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-6">
                    <!-- Name -->
                    <div class="sm:col-span-3">
                        <x-text-input label="Name" name="name" type="text" :value="$jobSeeker->name" />
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-3">
                        <x-text-input name="email" label="Email" type="email" :value="$jobSeeker->email" />
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-6 sm:col-span-4">
                        <label for="date_of_birth" class="inline-block text-lg mb-2">Date of Birth</label>
                        <input type="date" class="border border-gray-200 rounded p-2 w-full" name="date_of_birth"
                            value="{{ old('date_of_birth', $jobSeeker->date_of_birth) }}" />
                        @error('date_of_birth')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="sm:col-span-2">
                        <x-dropdown name="gender" label="Gender" :options="$options['Gender']" :selected="old('gender', optional($jobSeeker)->gender)" />
                    </div>
                    {{-- $selectedOptions['SelectedGender'] --}}
                    <!-- Job seeker street address -->
                    <div class="sm:col-span-6">
                        <x-text-input name="street_address" label="Street Address" :value="old('street_address', optional($address)->street_address)" />
                    </div>

                    <!-- Job seeker city -->
                    <div class="sm:col-span-2">
                        <x-text-input name="city" label="City" :value="old('city', optional($address)->city)" />
                    </div>

                    <!-- Job seeker state -->
                    <div class="sm:col-span-2">
                        <x-dropdown name="state_province" label="State/Province" :options="$options['StateProvince']" :selected="old('state_province', optional($address)->state_province)" />
                    </div>

                    <!-- Job seeker postal code -->
                    <div class="sm:col-span-2">
                        <x-text-input name="postal_code" label="Postal Code" :value="old('postal_code', optional($address)->postal_code)" />
                    </div>

                    <!-- Job seeker country/region -->
                    <div class="sm:col-span-6 mb-6">
                        <label for="country" class="inline-block text-lg mb-2">Country/Region: Malaysia</label>
                    </div>

                    <!-- Job seeker nationality -->
                    <div class="sm:col-span-3">
                        <x-text-input name="nationality" label="Nationality" :value="old('nationality', optional($jobSeeker)->nationality)" />
                    </div>

                    <!-- Job seeker telephone -->
                    <div class="sm:col-span-3">
                        <x-text-input name="telephone" label="Telephone" :value="old('telephone', optional($jobSeeker)->telephone)" />
                    </div>

                    <!-- Job seeker education level -->
                    <div class="sm:col-span-2">
                        <x-dropdown name="education_level" label="Highest Education Level" :options="$options['EducationLevel']"
                            :selected="old('education_level', optional($jobSeeker)->education_level)" />
                    </div>

                    <!-- Job seeker field of major -->
                    <div class="sm:col-span-4">
                        <x-text-input name="field_of_major" label="Field of Major" :value="old('field_of_major', optional($jobSeeker)->field_of_major)" />
                    </div>

                    <hr class="sm:col-span-full border-t border-gray-500" />

                    <!-- Job Experiences Section -->
                    <div class="sm:col-span-4">
                        <h2 class="text-2xl font-semibold text-gray-900">Job Experiences</h2>
                    </div>
                    <div class="sm:col-span-4">
                        <div id="job-experiences">
                            @if (!empty($jobExperiences))
                                @foreach ($jobExperiences as $experience)
                                    <div class="job-experience mb-4">
                                        <input type="hidden" name="experience_ids[]" value="{{ $experience->id }}">
                                        <input type="text" name="job_titles[]" placeholder="Job Title"
                                            class="border border-gray-200 rounded p-2 w-full"
                                            value="{{ old('job_titles.' . $loop->index, $experience->job_title) }}">
                                        <input type="text" name="company_names[]" placeholder="Company Name"
                                            class="border border-gray-200 rounded p-2 w-full"
                                            value="{{ old('company_names.' . $loop->index, $experience->company_name) }}">
                                        <textarea name="job_descriptions[]" placeholder="Job Description" class="border border-gray-200 rounded p-2 w-full">{{ old('job_descriptions.' . $loop->index, $experience->job_description) }}</textarea>
                                        <input type="date" name="start_dates[]"
                                            class="border border-gray-200 rounded p-2 w-full"
                                            value="{{ old('start_dates.' . $loop->index, $experience->start_date) }}">
                                        <input type="date" name="end_dates[]"
                                            class="border border-gray-200 rounded p-2 w-full"
                                            value="{{ old('end_dates.' . $loop->index, $experience->end_date) }}">
                                        <button
                                            class="remove-experience mt-2 bg-red-500 text-white rounded px-3 py-1 text-sm"
                                            type="button" data-experience-id="{{ $experience->id }}">Remove</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <button id="add-experience" type="button"
                            class="bg-green-500 text-white rounded p-2 py-2 text-lg">Add Job Experience</button>
                    </div>

                    <!-- Save Button -->
                    <div class="sm:col-span-6 text-center">
                        <button type="submit"
                            class="bg-theme-color text-white font-semibold rounded-md py-2 px-4">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </x-card>
</x-basic-layout>

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

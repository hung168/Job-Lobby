<x-basic-layout>
    @auth
        @if (auth()->user()->user_type == 'Employer')
            @include('partials._employernavbar')
        @else
            @include('partials._jobseekernavbar')
        @endif
    @else
        @include('partials._whitenavbar')
    @endauth

    <div class="mx-80 mt-20">
        <x-card>
            <div class="sm:col-span-6">
                <!-- Profile Picture -->
                <div class="mb-6">
                    <div class="mt-2 text-center">
                        @if ($jobSeeker)
                            <img src="{{ asset('storage/' . $jobSeeker->jobseeker_profile_pic) }}"
                                class="w-40 h-40 rounded-full mx-auto" style="display: block;">
                        @else
                            <!-- Display a default image or message when $jobSeeker is null -->
                            <p>No profile picture available</p>
                        @endif

                    </div>
                </div>
            </div>
            <div class="mt-6 border-t border-gray-300">
                <dl class="divide-y divide-gray-300">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $jobSeeker->name }}
                        </dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $jobSeeker->email }}
                        </dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Date of Birth</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $jobSeeker->date_of_birth }}
                        </dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Gender</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $jobSeeker->gender }}
                        </dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Telephone</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $jobSeeker->telephone }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $jobSeeker->address }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Resume</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            @if ($resume)
                                <a href="{{ asset($resume->file_path) }}" target="_blank" class="file-link">
                                    <div class="file-content">
                                        <div class="file-icon" style="display: inline-flex; align-items: center">
                                            <i class="far fa-file-pdf fa-3x"></i>
                                            <label class="file-name"
                                                style="margin-left: 1em">{{ $resume->name }}</label>
                                        </div>
                                        <div class="file-details">
                                            <p class="file-info" style="text-decoration: underline; font-weight: bold">
                                                View
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @elseif (!$resume)
                                <p class="text-gray-700">No resume available.</p>
                            @endif
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <div class="sm:col-span-3">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">Job Experiences</h2>
                        </div>
                        @if (!empty($jobExperiences))
                            @foreach ($jobExperiences as $experience)
                                <div class="border border-gray-200 p-4 rounded-lg">
                                    <p class="text-gray-700"><strong>Job Title:</strong> {{ $experience->job_title }}</p>
                                    <p class="text-gray-700"><strong>Company Name:</strong>
                                        {{ $experience->company_name }}</p>
                                    <p class="text-gray-700"><strong>Job Description:</strong>
                                        {{ $experience->job_description }}</p>
                                    <p class="text-gray-700"><strong>Start Date:</strong> {{ $experience->start_date }}
                                    </p>
                                    <p class="text-gray-700"><strong>End Date:</strong> {{ $experience->end_date }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-700">No job experiences available.</p>
                        @endif
                    </div>
                </dl>
            </div><br>
            <div class="sm:col-span-6 text-center">
                <a href="{{ URL::previous() }}" class="bg-theme-color text-white font-semibold rounded-md py-2 px-4">Back</a>
            </div>
    </div>
    </x-card>
    </div>

</x-basic-layout>

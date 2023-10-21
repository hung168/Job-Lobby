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
                        <img src="{{ asset('storage/' . $employer->employer_profile_pic) }}" class="w-40 h-40 rounded-full mx-auto" style="display: block;">
                    </div>
                </div>
            </div>
            <div class="mt-6 border-t border-gray-300">
                    <dl class="divide-y divide-gray-300">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Name</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->name}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->email}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Department</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->department}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Function Title</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->function_title}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company Name</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->company_name}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company Industry</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->company_industry}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company Contact Number</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->company_contact_number}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company Overview</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->company_overview}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company Registration Number</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->company_registration_number}}</dd>
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company Website</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$employer->company_website}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Location</dt>
                        </div>
                    </dl>
                </div><br>
                <div class="sm:col-span-6 text-center">
                    <a href="/employers" class="bg-theme-color text-white font-semibold rounded-md py-2 px-4">Back</a>
                </div>
            </div>
        </x-card>
    </div>

</x-basic-layout>

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
            <div>
                <div class="px-4 sm:px-0 flex items-center justify-center flex-col">
                  <h3 class="text-base font-semibold leading-7 text-gray-900">{{$listing->title}}</h3>
                  <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{$listing->company}}</p>
                  <img src="{{ asset('storage/' . $listing->logo) }}" alt="Profile Image"  class="object-cover w-40 h-40 rounded-full">
                </div>
        
                <div class="mt-6 border-t border-gray-300">
                    <dl class="divide-y divide-gray-300">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Job Title</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$listing->title}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Company</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$listing->company}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Academic Field</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$listing->academic_field}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Slots Available</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$listing->slots_available}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Categories</dt>
                            <x-listing-categories :tagsCsv="$listing->tags"/>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Location</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$listing->location}}</dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">About</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$listing->description}}</dd>
                        </div>
                        @auth
                            @if(($listing->employer_user_id == auth()->user()->id) && (auth()->user()->user_type == 'Employer'))
                                <div class="flex items-center justify-center space-x-4">
                                    <div class="p-10 flex items-center justify-center space-x-10">
                                        <a href="/listings/{{$listing['id']}}/edit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                                            Edit
                                        </a>
                                        
                                        <form method="POST" action="/listings/{{$listing['id']}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 text-white rounded py-2 px-4 hover:bg-black">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                    
                                    
                                </div>
                            @elseif (auth()->user()->user_type == 'Job Seeker')       
                                <div class="p-10 flex items-center justify-center space-x-10">
                                    <form method="POST" action="{{ url('/' . $listing->id . '/apply') }}">
                                        @csrf
                                        <div class="mb-6">
                                            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="submit">
                                                Apply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @else
                            <div class="p-10 flex items-center justify-center space-x-10">
                                <form method="POST" action="{{ url('/' . $listing->id . '/apply') }}">
                                    @csrf
                                    <div class="sm:col-span-full">
                                        <div class="mt-6 flex items-center justify-end gap-x-6 mb-10">
                                            <button type="submit" class="bg-theme-color text-white font-semibold rounded-md py-2 px-4">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endauth
                        
                    </dl>
                </div>
            </div>
        </x-card>
    </div>
</x-basic-layout>

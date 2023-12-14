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
                        <img src="{{ asset('storage/' . $employer->employer_profile_pic) }}"
                            class="w-40 h-40 rounded-full mx-auto" style="display: block;">
                    </div>
                </div>
            </div>
            <div class="mt-6 border-t border-gray-300">
                <dl class="divide-y divide-gray-300">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employer->name }}
                        </dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employer->email }}
                        </dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Department</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->department }}</dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Function Title</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->function_title }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Company Name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->company_name }}</dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Company Industry</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->company_industry }}</dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Company Contact Number</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->company_contact_number }}</dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Company Overview</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->company_overview }}</dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Company Registration Number</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->company_registration_number }}</dd>
                        <dt class="text-sm font-medium leading-6 text-gray-900">Company Website</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $employer->company_website }}</dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employer->address }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Review</dt>
                        @if (!$empRating->isEmpty())
                            <!-- Display existing rating and review -->
                            @foreach ($empRating as $onerating)
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="rated">
                                                @for ($i = 1; $i <= $onerating->rating; $i++)
                                                    ⭐
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p>{{ $onerating->comments }}</p>
                                        <p><strong> - {{ $onerating->user_name }} </strong> </p>
                                    </div>
                                </dd>
                                <dt class="text-sm font-medium leading-6 text-gray-900"></dt>
                            @endforeach
                        @else
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">No Review Available
                            </dd>
                        @endif
                </dl>
            </div><br>
            @if (auth()->user()->id !== $employer->user_id)
                <div class="ratings-and-reviews">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Update Review (Old review will be replaced)
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <form method="POST" action="/employer/rating/{{ $employer->id }}">
                            @csrf
                            <input type="hidden" name="rating_ids[]" value="">
                            <!-- Hidden input for rating ID -->
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5">
                                <label for="star5" title="5 stars"><span class="star-number">5</span></label>
                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4" title="4 stars"><span class="star-number">4</span></label>
                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3" title="3 stars"><span class="star-number">3</span></label>
                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2" title="2 stars"><span class="star-number">2</span></label>
                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1" title="1 star"><span class="star-number">1</span></label>
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <textarea name="comments" placeholder="comments" class="border border-gray-200 rounded p-2 w-full"></textarea>
                            @error('comments')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <button
                                class="remove-rating-and-review mt-2 bg-red-500 text-white rounded px-3 py-1 text-sm"
                                type="submit">Save</button>
                        </form>
                    </dd>
                </div>
            @endif
            <div class="sm:col-span-6 text-center">
                <a href="/employers" class="bg-theme-color text-white font-semibold rounded-md py-2 px-4">Back</a>
            </div>
    </div>
    </x-card>
    </div>

</x-basic-layout>

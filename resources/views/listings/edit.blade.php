<x-layout>
    <x-card class="!p-10 !max-w-lg !mx-auto !mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Job
            </h2>
            <p class="mb-4">Edit: {{$listing->title}}</p>
        </header>

        <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label
                    for="company"
                    class="inline-block text-lg mb-2"
                    >Company Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="company"
                    value="{{$listing->company}}"
                />

                @error('company')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2"
                    >Job Title</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    placeholder="Example: Senior Laravel Developer"
                    value="{{$listing->title}}"

                />

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="academic_field" class="inline-block text-lg mb-2">
                    Academic Field
                </label>
                <select name="academic_field" class="border border-gray-200 rounded p-2 w-full">
                    <option value="Business" @if(old('academic_field', $listing->academic_field) === 'Business') selected @endif>Business</option>
                    <option value="Health" @if(old('academic_field', $listing->academic_field) === 'Health') selected @endif>Health</option>
                    <option value="Engineering" @if(old('academic_field', $listing->academic_field) === 'Engineering') selected @endif>Engineering</option>
                    <option value="History" @if(old('academic_field', $listing->academic_field) === 'History') selected @endif>History</option>
                    <option value="Computer Science" @if(old('academic_field', $listing->academic_field) === 'Computer Science') selected @endif>Computer Science</option>
                    <option value="Psychology" @if(old('academic_field', $listing->academic_field) === 'Psychology') selected @endif>Psychology</option>
                    <option value="Mathematics" @if(old('academic_field', $listing->academic_field) === 'Mathematics') selected @endif>Mathematics</option>
                    <option value="Biology" @if(old('academic_field', $listing->academic_field) === 'Biology') selected @endif>Biology</option>
                    <option value="Physics" @if(old('academic_field', $listing->academic_field) === 'Physics') selected @endif>Physics</option>
                    <option value="Chemistry" @if(old('academic_field', $listing->academic_field) === 'Chemistry') selected @endif>Chemistry</option>
                    <option value="Art and Design" @if(old('academic_field', $listing->academic_field) === 'Art and Design') selected @endif>Art and Design</option>                
                </select>
                
                @error('academic_field')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="location"
                    class="inline-block text-lg mb-2"
                    >Job Location</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="location"
                    placeholder="Example: Remote, Boston MA, etc"
                    value="{{$listing->location}}"

                />
                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2"
                    >Contact Email</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value="{{$listing->email}}"

                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="website"
                    class="inline-block text-lg mb-2"
                >
                    Website/Application URL
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="website"
                    value="{{$listing->website}}"

                />
                @error('website')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="tags"
                    placeholder="Example: Laravel, Backend, Postgres, etc"
                    value="{{$listing->tags}}"

                />
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />

                <img src="{{ asset('storage/' . $listing->logo) }}" alt="Profile Image"  class="object-cover w-40 h-40 rounded-full">

                @error('logo')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Job Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    placeholder="Include tasks, requirements, salary, etc">
                    {{$listing->description}}
                </textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Update Job
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>
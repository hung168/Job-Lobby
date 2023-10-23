<x-basic-layout>
    @auth
        @include('partials._jobseekernavbar')
    @else
        @include('partials._whitenavbar')
    @endauth

    <!-- component -->
    <div class="flex flex-col bg-white m-auto p-auto">
        <h1 class="flex py-5 lg:px-20 md:px-10 px-5 lg:mx-40 md:mx-20 mx-5 font-bold text-4xl text-gray-800">Employers</h1>
        <div class="flex flex-wrap justify-center pb-10">
            @foreach($employers as $employer)
            <div class="w-1/3 p-4">
                <div class="container max-w-xl items-center justify-center overflow-hidden rounded-2xl bg-slate-200 shadow-xl">
                    <div class="h-10"></div>
                    <div class="flex justify-center">
                        <a href="{{ route('employer_details', ['id' => $employer->id]) }}">
                            <img src="{{ asset('storage/' . $employer->employer_profile_pic) }}" alt="Profile Image"  class="object-cover w-40 h-40 rounded-full">
                        </a>
                    </div>
                    <div class="mt-2 mb-1 px-3 text-center font-bold text-xl">
                        <a href="{{ route('employer_details', ['id' => $employer->id]) }}">{{ $employer->company_name }}</a>
                    </div>
                    <div class="mb-2 px-3 text-center text-xl text-sky-500">{{ $employer->company_industry }}</div>
                    <div class="mx-2 mb-7 text-center text-base">{{ $employer->address }}</div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-basic-layout>

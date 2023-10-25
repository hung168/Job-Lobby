@props(['listing'])

@if($listing->boosted == 1)
<div class="flex items-center justify-center">
    <div class="w-full max-w-4xl py-8 flex flex-row items-center justify-center mb-8 rounded-lg shadow-md" onclick="window.location.href = '/listings/{{$listing->id}}';" style="cursor: pointer; background: linear-gradient(45deg, #2E94B9, #043e81);">
        <div class="flex flex-col md:flex-row w-11/12 space-x-10">
            <div class="w-full flex flex-col items-center justify-center">
                <figure class="w-1/2 md:w-full overflow-hidden">
                    <img src="{{ asset('storage/' . $listing->logo) }}" alt="Profile Image" class="object-cover w-40 h-40 rounded-full">
                </figure>
            </div>
            <div class="w-full space-y-4 flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center">
                    <h1 class="text-center md:text-left text-2xl font-bold text-white"><a>{{$listing->title}}</a></h1>
                    <p class="inline text-center text-white font-normal leading-6 w-full text-base pt-2">{{$listing->company}}</p>
                </div>
                <ul class="space-y-4  md:space-y-0 space-x-0 md:space-x-4 flex flex-col md:flex-row text-left justify-center">
                    <li class="text-sm text-white"><i class="fa-solid fa-location-dot text-white"></i> {{$listing->location}}</li>
                    <li class="text-sm text-white"><i class="fa-solid fa-user text-white"></i> {{$listing->slots_available}}</li>
                </ul>

                <ul class="space-x-4 flex flex-row justify-center w-full mb-4">
                    <x-listing-categories :tagsCsv="$listing->tags" />
                </ul>
                <ul class="w-full ">
                    <div class="flex justify-center">
                        @if (auth()->check() && auth()->user()->user_type == "Employer")
                        <form method="POST" action="{{ route('report-listing', ['id' => $listing->id]) }}">
                            @csrf
                            <button type="submit" class="transition-colors bg-red-500 hover:bg-red-600 p-2 rounded-lg w-full text-white text-hover shadow-md custom shadow">
                                Report
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ url('/' . $listing->id . '/apply') }}">
                            @csrf
                            <button type="submit" class="transition-colors bg-theme-color hover-bg-theme-color p-2 mr-10 rounded-lg w-full text-white text-hover shadow-md custom shadow">Apply</button>
                        </form>
                        <form method="POST" action="{{ route('report-listing', ['id' => $listing->id]) }}">
                            @csrf
                            <button type="submit" class="transition-colors bg-red-500 hover:bg-red-600 p-2 ml-5 rounded-lg w-full text-white text-hover shadow-md custom shadow">Report</button>
                        </form>
                        @endif
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@else
<div class="flex items-center justify-center">
    <div class="w-full max-w-4xl py-8 flex flex-row items-center justify-center mb-8 bg-gray-50 rounded-lg shadow-md" onclick="window.location.href = '/listings/{{$listing->id}}';" style="cursor: pointer;">
        <div class="flex flex-col md:flex-row w-11/12 space-x-10">
            <div class="w-full flex flex-col items-center justify-center">
                <figure class="w-1/2 md:w-full overflow-hidden">
                    <img src="{{ asset('storage/' . $listing->logo) }}" alt="Profile Image" class="object-cover w-40 h-40 rounded-full">
                </figure>
            </div>
            <div class="w-full space-y-4 flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center">
                    <h1 class="text-center md:text-left text-2xl font-bold text-gray-900"><a>{{$listing->title}}</a></h1>
                    <p class="inline text-center text-gray-700 font-normal leading-6 w-full text-base pt-2">{{$listing->company}}</p>
                </div>
                <ul class="space-y-4  md:space-y-0 space-x-0 md:space-x-4 flex flex-col md:flex-row text-left justify-center">
                    <li class="text-sm"><i class="fa-solid fa-location-dot"></i> {{$listing->location}}</li>
                    <li class="text-sm"><i class="fa-solid fa-user"></i> {{$listing->slots_available}}</li>
                </ul>

                <ul class="space-x-4 flex flex-row justify-center w-full mb-4">
                    <x-listing-categories :tagsCsv="$listing->tags" />
                </ul>
                <ul class="w-full ">
                    <div class="flex justify-between">
                        @if (auth()->check() && auth()->user()->user_type == "Employer")
                        <form method="POST" action="{{ route('report-listing', ['id' => $listing->id]) }}">
                            @csrf
                            <button type="submit" class="transition-colors bg-red-500 hover:bg-red-600 p-2 rounded-lg w-full text-white text-hover shadow-md custom shadow">
                                Report
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ url('/' . $listing->id . '/apply') }}">
                            @csrf
                            <button type="submit" class="transition-colors bg-theme-color hover-bg-theme-color p-2 rounded-lg w-full text-white text-hover shadow-md custom shadow mr-2">Apply</button>
                        </form>
                        <form method="POST" action="{{ route('report-listing', ['id' => $listing->id]) }}">
                            @csrf
                            <button type="submit" class="transition-colors bg-red-500 hover:bg-red-600 p-2 rounded-lg w-full text-white text-hover shadow-md custom shadow">Report</button>
                        </form>
                        @endif
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
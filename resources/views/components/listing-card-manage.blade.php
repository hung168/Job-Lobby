@props(['listing'])

<div class="flex items-center justify-center">
    <div class="w-full max-w-4xl py-8 flex flex-row items-center justify-center mb-8 bg-gray-50 rounded-lg shadow-md" onclick="window.location.href = '/listings/{{$listing->id}}';" style="cursor: pointer;">
        <div class="flex flex-col md:flex-row w-11/12 space-x-10">
            <div class="w-full flex flex-col items-center justify-center">
                <figure class="w-1/2 md:w-full overflow-hidden">
                    <img src="https://images.pexels.com/photos/1820559/pexels-photo-1820559.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=600" alt="woman wearing a headwrap and an Africa-shaped earring while smiling" figure="">
                </figure>
            </div>
            <div class="w-full space-y-4 flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center">  
                    <h1 class="text-center md:text-left text-2xl font-bold text-gray-900"><a>{{$listing->title}}</a></h1>
                    <p class="inline text-center text-gray-700 font-normal leading-6 w-full text-base pt-2">{{$listing->company}}</p>
                </div>
                <ul class="space-y-4  md:space-y-0 space-x-0 md:space-x-4 flex flex-col md:flex-row text-left justify-center">
                    <li class="text-sm"><i class="fa-solid fa-location-dot"></i> {{$listing->location}}</li>
                    <li class="text-sm"><i class="iconoir-calendar mr-2"></i>Member since 2019 </li>
                </ul>

                <ul class="space-x-4 flex flex-row justify-center w-full mb-4">
                    <x-listing-categories :tagsCsv="$listing->tags"/>
                </ul>
                
                <ul class="space-x-4 flex flex-row justify-center w-full mb-4">
                    <a href="/listings/{{$listing['id']}}/edit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                        Edit
                    </a>                
                </ul>
            </div>
        </div>
    </div>
</div>
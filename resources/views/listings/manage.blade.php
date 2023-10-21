<x-basic-layout>
    @include('partials._employernavbar')
    <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase pt-6">
            Manage Listings
        </h1>
    </header>
    @if(count($listings) > 0)

        @foreach($listings as $listing)
            <x-listing-card-manage :listing="$listing"/>
        @endforeach
        <li style="text-align: center;">
            <a href="/listings/create" class="bg-theme-color text-white py-2 px-4 text-laravel rounded-lg py-1 font-semibold text-lg">Post New Jobs</a>
        </li>

    @else
        <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <p class="text-center">No listings Found</p>
            </td><br>
            <li style="text-align: center;">
                <a href="/listings/create" class="bg-theme-color text-white py-2 px-4 text-laravel rounded-lg py-1 font-semibold text-lg">Post</a>
            </li>
        </tr>
    @endif
    
</x-basic-layout>



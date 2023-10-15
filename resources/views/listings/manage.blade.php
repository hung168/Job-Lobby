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
    @else
        <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <p class="text-center">No listings Found</p>
            </td>
        </tr>
    @endif
    
</x-basic-layout>



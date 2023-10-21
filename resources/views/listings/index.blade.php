<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <div class="flex flex-wrap justify-center mx-auto px-4 sm:px-8 md:px-12 lg:px-16">
        @unless (count($listings) == 0)

        @foreach ($listings as $listing)
            <div class="w-full sm:w-1/2 md:w-1/3 p-4">
                <x-listing-card :listing="$listing"/>
            </div>
        @endforeach

        @else
            <p>No listings found</p>
        @endunless
    </div>

    <div class="mt-6 mx-auto px-4 sm:px-8 md:px-12 lg:px-16">
        {{$listings->links()}}
    </div>
</x-layout>

<x-basic-layout>
    @include('partials._jobseekernavbar')
    <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase pt-6">
            Applications
        </h1>
    </header>
    @if(count($applications) > 0)

        @foreach($applications as $application)
                <x-listing-card-application :application="$application"/>
        @endforeach
    @else
        <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <p class="text-center">No application Found</p>
            </td>
        </tr>
    @endif
    
</x-basic-layout>


<x-basic-layout>
    @include('partials._jobseekernavbar')

    <x-card class="!p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Application Gigs
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @if(!empty($applications))
                @foreach($applications as $application)
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="/listings/{{$application->listing->id}}"> {{$application->listing->title}} </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="/listings/{{$application['id']}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                class="fa-solid fa-pen-to-square"></i>
                            Edit</a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <form method="POST" action="/listings/{{$application['id']}}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No application Found</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </x-card>
</x-basic-layout>

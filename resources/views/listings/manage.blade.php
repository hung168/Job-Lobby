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

        @foreach($listings as $listing)
        <div id="boostModal{{$listing->id}}" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal{{$listing->id}}">&times;</span>
                <p>Do you want to boost {{$listing->title}} for 3 days?</p>
                
                <form action="/listings/{{$listing->id}}/boost" method="post">
                    @csrf
                    <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black confirm-button">
                        Confirm
                    </button>
                </form>                
            </div>
        </div>
    @endforeach
    
    

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

<script>
    const boostButtons = document.querySelectorAll('.boost-button');
    const confirmButtons = document.querySelectorAll('.confirm-button');
    const modals = document.querySelectorAll('.modal');
    
    boostButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            modals[index].style.display = 'block';
        });
    });
    
    confirmButtons.forEach((confirmButton, index) => {
        confirmButton.addEventListener('click', () => {
            // Handle the action when the user confirms the boost, e.g., make an API call.
            console.log(`Confirmed boost for listing ${index + 1}`);
            modals[index].style.display = 'none';
        });
    });
    
    modals.forEach((modal, index) => {
        const closeModal = modal.querySelector('.close');
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    function handleCardClick(event, url) {
    if (!event.target.classList.contains('boost-button') && !event.target.classList.contains('bg-laravel')) {
        // Do not redirect if the clicked element is the "Boost" or "Edit" button
        window.location.href = url;
    }
}
</script>
    


    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <form action="" method="GET">
        <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            placeholder="Search Jobs..."
            value="{{ request('search') }}"
        />
        </form>
        <div class="absolute top-2 right-2">
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-laravel"
            >
                Search
            </button>
            <button id="filterButton" class="bg-laravel text-white rounded-lg py-2 px-4">Filter</button>
        </div>
    </div>


<div id="filterModal" class="hidden fixed inset-0 bg-black bg-opacity-50 w-screen h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg">
        <form method="post" action="{{ route('filter_listings') }}">
            @csrf
            <div class="mb-4">
                <label for="academic_field" class="block text-gray-700 font-bold">Academic Field</label>
                <select name="academic_field" id="academic_field" class="border rounded p-2 w-full">
                    <option value="Business">Business</option>
                    <option value="Health">Health</option>
                    <option value="Engineering">Engineering</option>
                    <option value="History">History</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Biology">Biology</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Art and Design">Art and Design</option>                
                </select>
            </div>
            <div class="text-right">
                <button type="submit" class="bg-laravel text-white rounded-lg py-2 px-4">Filter</button>
                <button id="filterCloseButton" class="text-gray-700 ml-2">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const filterCloseButton = document.getElementById('filterCloseButton');

    filterButton.addEventListener('click', () => {
        filterModal.classList.remove('hidden');
    });

    filterCloseButton.addEventListener('click', () => {
        filterModal.classList.add('hidden');
    });

    filterModal.addEventListener('click', (event) => {
        if (event.target === filterModal) {
            filterModal.classList.add('hidden');
        }
    });
</script>

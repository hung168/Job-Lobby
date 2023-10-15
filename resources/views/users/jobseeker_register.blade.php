<x-basic-layout>
    <nav style="padding: 5px 0; background-color: #2E94B9;">
        <div class="mx-auto max-w-7xl ">
            <div class="relative flex h-16 items-center justify-between">
                <a href="/"
                    ><img class="w-24" src="{{asset('images/Logo.png')}}" alt="" class="logo"
                /></a>
            </div>
        </div>
    </nav>
    <div class="flex items-center justify-center">
        <x-card class="!p-10 !max-w-lg !mx-auto !mt-24 rounded-xl shadow-md">

            <header class="text-center">
                <h2 class="text-2xl font-medium uppercase mb-1">
                    Job Seeker Registration
                </h2>
                <p class="mb-4">Create an account to apply for jobs</p>
            </header>

            <form method="POST" action="/createJobSeekerUser">
                @csrf
                <x-text-input name="name" label="Name" :value="old('name')" />

                <x-text-input name="email" label="Email" :value="old('email')" />
                
                <x-text-input name="password" label="Password" :value="old('password')" type="password" />
                
                <x-text-input name="password_confirmation" label="Confirm Password" :value="old('password_confirmation')" type="password" />

                <input type="hidden" name="firstTimeLogin" value="Yes">

                <div class="mb-6">
                    <button
                        type="submit"
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    >
                        Sign Up
                    </button>
                </div>

                <div class="mt-8">
                    <p>
                        Already have an account?
                        <a href="/login" class="text-laravel font-medium"
                            >Login</a
                        >
                    </p>
                </div>

            </form>
        </x-card>
    </div>
</x-basic-layout>
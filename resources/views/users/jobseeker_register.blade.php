<x-layout>
    <x-card class="!p-10 !max-w-lg !mx-auto !mt-24">

        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Register
            </h2>
            <p class="mb-4">Create an account to apply a job</p>
        </header>

        <form method="POST" action="/createJobSeekerUser">
            @csrf
            <x-text-input name="name" label="Name" :value="old('name')" />

            <x-text-input name="email" label="Email" :value="old('email')" />
            
            <x-text-input name="password" label="Password" :value="old('password')" type="password" />
            
            <x-text-input name="password_confirmation" label="Confirm Password"/>

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
                    <a href="/login" class="text-laravel"
                        >Login</a
                    >
                </p>
            </div>

        </form>
    </x-card>
</x-layout>
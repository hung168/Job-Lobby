<x-basic-layout>
    <div class="bg-gray-100 flex justify-center items-center h-screen">
            <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="https://placehold.co/800x/667fff/ffffff.png?text=Your+Image&font=Montserrat" alt="Placeholder Image" class="object-cover w-full h-full">
        </div>
        <!-- Right: Login Form -->
        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <h1 class="text-4xl text-theme-color font-semibold mb-2">Login</h1>
                <p class="mb-4 font-semibold">Sign in as employer or jobseeker</p>
            <form method="POST" action="/users/authenticate">
                @csrf
                
                <!-- Email -->
                <x-login-input-text name="email" label="Email" :value="old('email')" type="email" />

                <!-- Password -->
                <x-login-input-text name="password" label="Password" :value="old('password')" type="password" />            

                <!-- Remember Me Checkbox -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="text-blue-500">
                    <label for="remember" class="text-gray-600 ml-2">Remember Me</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="bg-theme-color text-white font-semibold rounded-md py-2 px-4 w-full">Login</button>
            </form>
            <!-- Sign up  Link -->
            <div class="mt-2">
                <p>
                    Don't have an account?
                    <a href="/" class="text-laravel font-semibold"
                        >Register</a
                    >
                </p>
            </div>
        </div>
    </div>
    @if(session('message'))
        <div x-data="{show: true}" x-init="setTimeout(()=>show = false, 3000)">
            {{ session('message') }}
        </div>
    @endif
</x-basic-layout>

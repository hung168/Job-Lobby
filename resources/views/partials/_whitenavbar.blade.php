<nav style="padding: 5px 0; background-color: white;">
    <div class="mx-auto max-w-7xl ">
        <div class="relative flex h-16 items-center justify-between">
            @auth
                @if(auth()->user()->user_type == 'Employer')
                    <ul class="flex items-center justify-center">
                        <a href="/"
                            ><img class="w-24" src="{{asset('images/Logo.png')}}" alt="" class="logo"
                        /></a>
                        <li>
                            {{-- chg url --}}
                            <a href="/register/jobseeker" class="text-laravel rounded-lg py-1 font-semibold text-lg pl-10">Applications 
                            </a>
                        </li>
             
                    </ul>
                    <ul class="flex space-x-6 mr-6 text-lg">
                        <div class="dropdown">
                            <button class="text-theme-color rounded-lg py-1 px-2 font-semibold" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                                <span class="mr-1">
                                    <i class="fa-solid fa-circle" style="font-size: 48px;"></i>
                                </span>
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class= "dropdown-item" href="/editProfile/{{ auth()->user()->name }}/Employer">Edit Profile</a></li>
                                <li><a class="dropdown-item" href="/listings/manage">Manage Listings</a></li>
                                <li>
                                    <form class="dropdown-item" method="POST" action="/logout">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </ul>
                @elseif (auth()->user()->user_type == 'Job Seeker')
                    <ul class="flex items-center justify-center">
                        <a href="/"
                            ><img class="w-24" src="{{asset('images/Logo.png')}}" alt="" class="logo"
                        /></a>
                        <li>
                            <a href="/" class="text-laravel rounded-lg py-1 font-semibold text-xl pl-10">Jobs 
                            </a>
                        </li>
                        <li>
                            <a href="/employers" class="text-laravel rounded-lg py-1 font-semibold text-xl pl-10">Employers 
                            </a>
                        </li>
                    </ul>
                    <ul class="flex space-x-6 mr-6 text-lg">
                        <div class="dropdown">
                            <button class="text-theme-color rounded-lg py-1 px-2 font-semibold" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                                <span class="mr-1">
                                    <i class="fa-solid fa-circle" style="font-size: 48px;"></i>
                                </span>
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/editProfile/{{auth()->user()->name}}/JobSeeker">Edit Profile</a></li>
                                <li><a class="dropdown-item" href="/listings/applications">Job Applications</a></li>
                                <li>
                                    <form class="dropdown-item" method="POST" action="/logout">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </ul>
                @endif
            @else
                <ul class="flex items-center justify-center">
                    <a href="/"
                        ><img class="w-24" src="{{asset('images/Logo.png')}}" alt="" class="logo"
                    /></a>
                    <li>
                        <a href="/listings/create" class="text-laravel rounded-lg py-1 font-semibold text-lg pl-10">Post 
                        </a>
                    </li>
                </ul>
                <ul class="flex space-x-6 mr-6 text-lg">
                    <li>
                        <a href="/register/jobseeker" class="button-hover-background-color blue-border rounded-lg px-3 py-2 text-sm font-medium"
                            ><i class="fa-solid fa-user-plus"></i> Job Seeker Register
                        </a>
                    </li>
                
                    <li>
                        <a href="/register/employer" class="button-hover-background-color blue-border rounded-lg px-3 py-2 text-sm font-medium">
                            <i class="fa-solid fa-user-plus"></i> Employer Register
                        </a>
                    </li>
                    
                    <li>
                        <a href="/login" class="hover:text-laravel font-medium"
                            ><i class="fa-solid fa-arrow-right-to-bracket"></i>Login</a>
                    </li>
                </ul>
            @endauth
    </div>
</nav>

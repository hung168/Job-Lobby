<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" type="text/css" href="{{ asset('app.css') }}">
        <script src="//unpkg.com/alpinejs" defer></script>

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#2E94B9",
                        },
                    },
                },
            };
        </script>
        <title>LaraGigs | Find Laravel Jobs & Projects</title>
    </head>
    <body class="mb-48">
        <body class="mb-48">
            <nav  style="padding: 20px 0">
                <div class="mx-auto max-w-7xl ">
                    <div class="relative flex h-16 items-center justify-between">
                        <a href="/"
                            ><img class="w-24" src="{{asset('images/Logo.png')}}" alt="" class="logo"
                        /></a>
                        <ul class="flex space-x-6 mr-6 text-lg">
                            @auth
                            <li>
                                <span class="font-bold uppercase">
                                    Welcome {{auth()->user()->name}}
                                </span>
                            </li>
                                @if(auth()->user()->user_type == 'Employer')
                                    <li>
                                        <a href="/listings/manage" class="hover:text-laravel"
                                            ><i class="fa-solid fa-gear"></i>
                                            Manage Listings</a
                                        >
                                    </li>
                                    <li>
                                        <a href="/editProfile/{{auth()->user()->name}}/Employer" class="hover:text-laravel">
                                            <i class="fa-solid fa-user-edit"></i> Edit Profile
                                        </a>
                                    </li>
                                    <li>
                                        <form class="inline" method="POST" action="/logout">
                                            @csrf
                                            <button type="submit">
                                                <i class="fa-solid fa-door-closed"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                @elseif (auth()->user()->user_type == 'Job Seeker')
            
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown button
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/editProfile/{{auth()->user()->name}}/JobSeeker">View Profile</a></li>
                                            <li><a class="dropdown-item" href="/listings/applications">Job Applications</a></li>
                                        </ul>
                                    </div>
            
                                    <li>
                                        <form class="inline" method="POST" action="/logout">
                                            @csrf
                                            <button type="submit">
                                                <i class="fa-solid fa-door-closed"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            @else
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
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

        <main>
        {{$slot}}
        </main>
        
        <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

            <a
                href="/listings/create"
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
                >Post Job</a
            >
        </footer>

        <x-flash-message/>
    </body>
</html>

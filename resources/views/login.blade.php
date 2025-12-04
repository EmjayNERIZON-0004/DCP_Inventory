<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - DCP Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 opacity-10">
        <div
            class="absolute top-0 -left-4 w-52 h-52 sm:w-72 sm:h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl animate-float">
        </div>
        <div class="absolute top-0 -right-4 w-52 h-52 sm:w-72 sm:h-72 bg-green-400 rounded-full mix-blend-multiply filter blur-xl animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-10 w-52 h-52 sm:w-72 sm:h-72 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl animate-float"
            style="animation-delay: 4s;"></div>
    </div>

    <div class="z-10 relative flex items-center justify-center p-2  ">
        <div
            class="w-full max-w-full grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-12 items-center md:my-10 my-0 md:mx-10    ">

            <!-- LEFT: Hero -->
            <div class="text-center lg:text-left md:space-y-6 space-y-1  ">
                <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold leading-tight md:inline   hidden">
                    <span style="font-family:Verdana, Geneva, Tahoma, sans-serif;"
                        class="
                        
                        text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-400 drop-shadow-lg">eDCP
                        Hub</span>
                    <br>
                    <span class="text-white md:block hidden text-xl sm:text-2xl lg:text-4xl font-medium mt-4 block">
                        A Centralized ICT Package Management <br class="hidden sm:block">for SDO San Carlos City Public
                        Schools
                    </span>
                </h1>
                <img class="h-40 md:inline  hidden shadow-md" src="{{ asset('icon/header.png') }}" alt="">

                <p
                    class="text-green-100 text-base sm:text-lg lg:text-xl max-w-2xl leading-relaxed hidden md:block  hidden ">
                    Welcome to the Inventory Management System – your dedicated companion for tracking inventory and
                    fostering a productive environment!
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        Incorrect Login Credentials, Please Try Again<br>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- RIGHT: Login -->
            <div class="flex justify-center lg:justify-end   ">
                <div class="w-full max-w-md">
                    <div class="bg-white/95   rounded-lg  p-6 sm:p-8 border border-white/20  ">

                        <!-- Logo -->
                        <div class="flex justify-center mb-2 sm:mb-8">
                            <div class="relative md:block hidden">
                                <div
                                    class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                    <img src="{{ asset('icon/logo.png') }}" class="w-20 h-20 sm:w-24 sm:h-24 "
                                        alt="">
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-7 h-7 sm:w-8 sm:h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-800" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                            <img class="h-40 md:hidden block shadow-md" src="{{ asset('icon/header.png') }}"
                                alt="">

                        </div>

                        <!-- Header -->
                        <div class="text-center mb-2 sm:mb-8">
                            <h2 class="text-xl sm:text-2xl font-semibold font-[Verdana] text-gray-700 mb-1 sm:mb-2">
                                Welcome Back</h2>
                            <p class="text-gray-600 font-[Verdana] text-sm sm:text-base">Please sign in to your account
                            </p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('submit-login') }}" class="space-y-5">
                            @csrf
                            @method('POST')
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" id="username" name="username" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg  bg-gray-50"
                                    placeholder="Enter your username">
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg   bg-gray-50"
                                        placeholder="Enter your password">
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-green-600 border-gray-300 rounded">
                                <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition transform hover:scale-[1.02] focus:ring-2 focus:ring-green-500">
                                Sign In
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-xs sm:text-sm text-gray-500">
                                Secured by <span class="font-semibold text-blue-600">eDCP Hub</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        if (type === 'password') {
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"></path>
                `;
        } else {
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
        }
    });
</script>

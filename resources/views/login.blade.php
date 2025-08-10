<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - DCP Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href=" {{ asset('icon/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-green-800 text-white min-h-screen flex items-center justify-center bg-cover bg-center">

    <div class="w-full flex flex-col md:flex-row items-center justify-center md:justify-between md:px-20 px-4">

        <!-- LEFT SIDE (HIDDEN on MOBILE) -->
        <div class="hidden md:flex flex-col max-w-2xl justify-start">
            <h1 class="text-5xl font-bold text-yellow-300 mb-2">Inventory Management <br>
                <span class="text-white">DepEd
                    Computerization Program (DCP)</span>
            </h1>
            <p class="text-white mt-4">
                Welcome to the Inventory Management System – your dedicated companion for tracking inventory and
                fostering a
                productive environment! Our system is crafted to streamline item management, providing a seamless
                experience for users.
            </p>
        </div>
        <div class="text-center md:hidden mt-1">
            <h1 class="text-lg font-bold text-yellow-300 ">Inventory Management <br>
                <span class="text-white">DepEd
                    Computerization Program (DCP)</span>
            </h1>
        </div>

        <!-- RIGHT SIDE - LOGIN FORM -->
        <div class="bg-white text-black rounded-lg shadow-lg p-6 w-full max-w-sm mt-1 md:mt-0 md:mr-10 ">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('icon/logo.png') }}" alt="Logo"
                    class="w-40 h-40 rounded-full object-contain border border-gray-300 shadow-md">
            </div>
            <h2 class="text-center text-xl font-semibold mb-4">Login Form</h2>
            @if ($errors->any())
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Whoops!</strong> There were some problems with your input.<br>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('submit-login') }}">
                @csrf

                <div class="mb-4">
                    <label for="username" class="block font-semibold mb-1">Username:</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="mb-4">

                    <div class="mb-4 relative">
                        <label for="password" class="block   font-medium mb-1">Password:</label>

                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500 pr-10">

                        <!-- Eye Icon -->
                        <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 absolute right-3 top-10 text-gray-500 cursor-pointer" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>

                    <script>
                        const toggle = document.getElementById('togglePassword');
                        const input = document.getElementById('password');

                        toggle.addEventListener('click', () => {
                            input.type = input.type === 'password' ? 'text' : 'password';
                        });
                    </script>
                </div>
                <div class="form-group remember mb-2">
                    <input type="checkbox" name="remember"> Remember me
                </div>
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition">
                    Login
                </button>
            </form>
        </div>

    </div>
</body>

</html>

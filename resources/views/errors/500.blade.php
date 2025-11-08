<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Server Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-xl rounded-lg p-10 max-w-lg text-center">
        <div class="flex justify-center">
            <img src="{{ asset('icon/logo.png') }}" class="h-32" alt="">
        </div>
        {{-- <h1 class="text-4xl font-bold text-gray-800 mt-6">500</h1> --}}
        <h1 class="text-3xl font-bold text-gray-800 mt-6">Oops! Something went wrong</h1>
        <p class="text-gray-600 mt-3">We encountered an error while processing your request.</p>
        <p class="text-gray-500 text-sm mt-1">Please contact the administrator if this problem continues.</p>

        <a href="{{ url('/') }}"
            class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            Go Back Home
        </a>
    </div>
</body>

</html>

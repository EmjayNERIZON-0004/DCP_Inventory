<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bad Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-xl rounded-lg p-10 max-w-lg text-center">
        <div class="flex justify-center">
            <div class="w-20 h-20 flex items-center justify-center bg-yellow-100 rounded-full">
                <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856C18.944 19 20 17.944 20 16.707V7.293C20 6.056 18.944 5 17.707 5H6.293C5.056 5 4 6.056 4 7.293v9.414C4 17.944 5.056 19 6.293 19z" />
                </svg>
            </div>
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mt-6">400</h1>
        <p class="text-lg text-gray-600 mt-2">Bad Request</p>
        <p class="text-sm text-gray-500 mt-1">Your request could not be understood. Please check and try again.</p>

        <a href="{{ url('/') }}"
            class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            Go Back Home
        </a>
    </div>
</body>

</html>

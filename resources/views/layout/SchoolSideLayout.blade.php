<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Dashboard-specific CDN assets -->
    <!-- Tailwind CSS via JSDelivr (CSS version - CSP-compatible) -->
    <link rel="icon" type="image/png"
        href="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-green-700 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <img src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        alt="School Logo" class="h-10 w-auto rounded-full object-contain">

                    <a href="https://www.nid.deped.gov.ph"
                        class="text-2xl font-bold hover:text-gray-50 transition">DepEd Computerization Program (DCP)</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('logout') }}" class="text-white hover:text-gray-50 transition">Login</a>
                </div>
            </div>
        </div>
    </header>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Add Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <div x-data="{ open: false }" class="bg-white border-b border-gray-200">
        <!-- Mobile toggle (only visible on small screens) -->
        <div class="flex justify-between items-center px-4 py-2 sm:hidden">
            <div class="text-green-700 font-semibold text-lg">Menu</div>
            <button @click="open = !open" class="text-green-700">
                <svg :class="{ 'rotate-180': open }" class="w-6 h-6 transform transition-transform duration-300"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <!-- Navigation links -->
        <!-- Navigation links -->
        <div class="px-4 py-2 sm:flex sm:flex-wrap sm:gap-3 sm:justify-start sm:block"
            :class="{ 'hidden': !open, 'flex flex-wrap gap-3 justify-center': open }" x-cloak>

            @php
                $navLinks = [
                    ['label' => 'Home', 'route' => 'school.dashboard', 'match' => 'School/dashboard'],
                    ['label' => 'School Profile', 'route' => 'school.profile', 'match' => 'School/profile'],
                    ['label' => 'DCP Batch Profile', 'route' => 'school.dcp_batch', 'match' => 'School/dcp-batch'],
                    ['label' => 'DCP Inventory', 'route' => 'school.dcp_inventory', 'match' => 'School/DCPInventory'],
                    [
                        'label' => 'Packages Information',
                        'route' => 'schools.packages.info',
                        'match' => 'School/packages-info/0',
                        'params' => [0],
                    ],
                    [
                        'label' => 'Item Condition',
                        'route' => 'schools.item.condition',
                        'match' => 'School/item-condition/0',
                        'params' => [0],
                    ],
                ];
            @endphp

            @foreach ($navLinks as $link)
                <a href="{{ route($link['route'], $link['params'] ?? []) }}"
                    class="px-5 py-2 rounded-lg font-semibold border transition-all duration-200 text-sm
               {{ Request::is($link['match'])
                   ? 'bg-green-700 text-white border-green-800'
                   : 'bg-white text-green-700 border-green-400 hover:bg-green-50 hover:border-green-700' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>



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
    <main class="flex-grow">@yield('content')</main>


    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-2">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-sm text-gray-500">
                <p>
                    &copy; 2025 Department of Education. National Inventory Data
                    Collection System.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>

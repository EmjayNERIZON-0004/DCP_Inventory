<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Dashboard-specific CDN assets -->
    <link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">

    <!-- Tailwind CSS via JSDelivr (CSS version - CSP-compatible) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<style>
    html {
        scroll-behavior: smooth;
    }

    /* in your global CSS file */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari */
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <header
        class="bg-gradient-to-r from-green-600 via-green-500 to-yellow-500 text-gray-900 shadow-md fixed top-0 left-0 right-0 z-50">

        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center">
                <div class="flex items-center md:space-x-4 space-x-0">
                    <a class="text-2xl font-bold text-white transition md:block hidden">DepEd Computerization
                        Program (DCP) -
                        Admin Panel</a>
                    <a class="text-2xl font-bold text-white transition md:hidden block">

                        e-DCP Hub Admin Panel</a>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <!-- Profile button -->
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ asset('icon/logo.png') }}" alt="Profile"
                            class="w-10 h-10 rounded-full border border-white">
                        <svg class="w-5 h-5 text-white transform transition-transform duration-300"
                            :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <style>
                        [x-cloak] {
                            display: none !important;
                        }
                    </style>
                    <!-- Dropdown menu -->
                    <div x-show="open" x-cloak @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg border z-50 py-1">

                        <a href="{{ route('admin.account.index') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-green-50">Account</a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-green-50">Reports</a>
                        <a href="{{ url('logout') }}" class="block px-4 py-2 text-red-600 hover:bg-red-50">Logout</a>
                    </div>
                </div>


            </div>
        </div>
    </header>

    @php
        $navLinks = [
            [
                'label' => 'Home',
                'url' => url('Admin/DCP-Dashboard'),
                'active' => Request::is('Admin/DCP-Dashboard'),
            ],
            [
                'label' => 'School Profile',
                'url' => route('index.schools'),
                'active' => Request::is('Schools/index'),
            ],
            [
                'label' => 'School Users',
                'url' => route('user.schools'),
                'active' => Request::is('Admin/Schools-User'),
            ],
            ['label' => 'DCP Items', 'url' => route('index.item_type'), 'active' => Request::is('item-type')],
            [
                'label' => 'DCP Packages',
                'url' => route('index.package_type'),
                'active' => Request::is('package-type/create'),
            ],
            [
                'label' => 'DCP Batch',
                'url' => route('index.batch'),
                'active' => Request::is('Admin/DCPBatch/index'),
            ],
            [
                'label' => 'DCP Inventory',
                'url' => route('index.SchoolsInventory'),
                'active' => request()->routeIs('index.SchoolsInventory'),
            ],
            [
                'label' => 'Item Details',
                'url' => route('index.crud'),
                'active' => request()->routeIs('index.crud'),
            ],
            [
                'label' => 'ISP Details',
                'url' => route('isp.index.list'),
                'active' => request()->routeIs('isp.index.list'),
            ],
            [
                'label' => 'Equipment Details',
                'url' => route('equipment.index.list'),
                'active' => request()->routeIs('equipment.index.list'),
            ],
        ];
    @endphp
    <div class="bg-white w-full border-b border-gray-200 pt-2 shadow-md z-10 fixed top-12" x-data="{ open: false }">
        <div class="flex flex-wrap items-center justify-between px-4 py-1">
            <!-- Menu Button -->
            <button @click="open = !open"
                class="flex items-center space-x-1 px-3 py-1 rounded-md text-green-700 border border-green-800 hover:bg-green-50 transition sm:hidden">
                <span class="font-semibold">Menu</span>
                <!-- Chevron Icon -->
                <svg class="w-5 h-5 transform transition-transform duration-300" :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Nav Links -->
            <div id="nav-links"
                class="w-full grid grid-cols-2 gap-2 mt-2 sm:mt-0 sm:flex sm:flex-wrap sm:justify-start sm:w-auto hidden"
                :class="{ 'grid': open, 'hidden': !open }" x-transition x-cloak>
                @foreach ($navLinks as $link)
                    <a href="{{ $link['url'] }}"
                        class="px-5 py-1 rounded-sm font-semibold border text-center transition-all duration-200
            {{ $link['active'] ? 'bg-green-700 text-white border-green-800' : 'bg-white text-green-700 border-green-800 hover:bg-green-50 hover:border-green-700' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

        </div>
    </div>


    <main class="flex-grow mt-24">

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

        @yield('content')


    </main>
    {{-- <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-sm text-gray-500">
                <p>
                    &copy; 2025 Department of Education. National Inventory Data
                    Collection System.
                </p>
            </div>
        </div>
    </footer> --}}
</body>
<style>
    [x-cloak] {
        display: none !important;
    }
</style> <!-- Add Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

</html>

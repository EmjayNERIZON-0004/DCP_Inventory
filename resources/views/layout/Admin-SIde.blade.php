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
</style>

<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-green-700 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="https://www.nid.deped.gov.ph"
                        class="text-2xl font-bold hover:text-gray-50 transition">DepEd Computerization Program (DCP)</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('logout') }}" class="text-white hover:text-gray-50 transition">Login</a>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white border-b border-gray-200">
        <div class="flex flex-wrap gap-3 justify-center sm:justify-start px-4 py-2">
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
                    [
                        'label' => 'DCP Packages',
                        'url' => route('index.package_type'),
                        'active' => Request::is('package-type/create'),
                    ],
                    ['label' => 'DCP Items', 'url' => route('index.item_type'), 'active' => Request::is('item-type')],
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
                ];
            @endphp

            @foreach ($navLinks as $link)
                <a href="{{ $link['url'] }}"
                    class="px-5 py-2 rounded-lg font-semibold border transition-all duration-200
                {{ $link['active'] ? 'bg-green-700 text-white border-green-800' : 'bg-white text-green-700 border-green-800 hover:bg-green-50 hover:border-green-700' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    <main class="flex-grow">

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
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
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

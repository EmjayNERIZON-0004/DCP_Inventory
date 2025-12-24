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

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>

<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-gray-600 text-white fixed top-0  z-50 shadow-md w-full">
        <div class="w-full md:py-2 py-1 px-4">
            <div class="flex md:justify-between justify-start items-center w-full">

                <!-- Left Side -->
                <div class="flex items-center space-x-2">
                    <img src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        alt="School Logo" class="h-10 w-10 rounded-full object-cover shadow-lg">

                    <div
                        class="text-lg md:text-2xl font-bold transition 
                truncate overflow-hidden  whitespace-normal max-w-[150px] md:max-w-none">
                        DCP - {{ Auth::guard('school')->user()->school->SchoolName ?? 'School Not Found' }}
                    </div>
                </div>


                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <a href="{{ url('logout') }}" class="text-white hover:text-gray-50 transition md:block hidden">
                        SchoolLogin
                    </a>
                    <a class="transition md:block hidden" href="{{ route('schools.report.index') }}">Reports</a>

                    <a class="transition md:block hidden" href="{{ route('schools.account.index') }}">Account</a>
                </div>

            </div>
        </div>
        <div x-data="{ open: false }">
            <!-- Mobile toggle (only visible on small screens) -->
            <div class="flex justify-between items-center px-4 py-2 sm:hidden">
                <div class="text-white font-semibold text-lg">Menu</div>
                <button @click="open = !open" class="text-white">
                    <svg :class="{ 'rotate-180': open }" class="w-6 h-6 transform transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- Navigation links -->
            <!-- Navigation links -->
            <div class="px-4 py-2 sm:flex sm:flex-wrap sm:gap-1 sm:justify-start sm:block"
                :class="{ 'hidden': !open, 'flex flex-wrap gap-1 justify-center': open }" x-cloak>

                @php
                    $navLinks = [
                        ['label' => 'Home', 'route' => 'school.dashboard', 'match' => 'School/dashboard'],
                        ['label' => 'School Information ', 'route' => 'school.profile', 'match' => 'School/profile'],
                        ['label' => ' DCP Batch ', 'route' => 'school.dcp_batch', 'match' => 'School/dcp-batch'],
                        [
                            'label' => '  School Inventory',
                            'route' => 'school.dcp_inventory',
                            'match' => 'School/DCPInventory',
                        ],

                        // [
                        //     'label' => 'Item Status',
                        //     'route' => 'schools.item.condition',
                        //     'match' => 'School/items-condition/0',
                        //     'params' => [0],
                        // ],
                        [
                            'label' => 'Internet ',
                            'route' => 'schools.isp.index',
                            'match' => 'School/ISP/index',
                            'params' => [0],
                        ],
                        [
                            'label' => 'Equipment  ',
                            'route' => 'schools.equipment.index',
                            'match' => 'School/Equipment/index',
                            'params' => [0],
                        ],
                        // [
                        //     'label' => 'School Reports',
                        //     'route' => 'schools.report.index',
                        //     'match' => 'School/Report/index',
                        //     'params' => [0],
                        // ],
                        [
                            'label' => 'Digital Identity ',
                            'route' => 'schools.employee.index',
                            'match' => 'School/Employee/index',
                            'params' => [0],
                        ],

                        [
                            'label' => 'Non DCP Item',
                            'route' => 'schools.nondcpitem.index',
                            'match' => 'School/NonDCPItem/index',
                            'params' => [0],
                        ],
                        [
                            'label' => 'About Packages',
                            'route' => 'schools.packages.info',
                            'match' => 'School/packages-info/0',
                            'params' => [0],
                        ],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route'], $link['params'] ?? []) }}"
                        class="px-5 py-1 rounded-sm font-semibold   transition-all duration-200 text-sm
               {{ Request::is($link['match'])
                   ? 'bg-blue-500 text-white   tracking-wider'
                   : 'bg-white text-gray-700  hover:bg-gray-50  tracking-wider' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ url('logout') }}"
                    class="px-5 py-1  rounded-sm font-semibold transition-all duration-200 text-sm bg-white text-gray-700 hover:bg-gray-50 tracking-wider sm:hidden">
                    SchoolLogin
                </a>
                <a href="{{ route('schools.report.index') }}"
                    class="px-5 py-1 rounded-sm font-semibold   transition-all duration-200 text-sm sm:hidden
               {{ Request::is('School/Report/index')
                   ? 'bg-blue-500 text-white   tracking-wider'
                   : 'bg-white text-gray-700  hover:bg-gray-50  tracking-wider' }}">
                    Reports
                </a>
                <a href="{{ route('schools.account.index') }}"
                    class="px-5 py-1 rounded-sm font-semibold   transition-all duration-200 text-sm sm:hidden
               {{ Request::is('School/Account/index')
                   ? 'bg-blue-500 text-white   tracking-wider'
                   : 'bg-white text-gray-700  hover:bg-gray-50  tracking-wider' }}">
                    Account
                </a>
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



    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Success checkmark animation */
        .success-icon {
            animation: scaleIn 0.5s ease-out, pulse 2s infinite 0.5s;
        }

        .checkmark {
            stroke-dasharray: 16;
            stroke-dashoffset: 16;
            animation: checkmark 0.6s ease-in-out 0.3s forwards;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0) rotate(-180deg);
                opacity: 0;
            }

            50% {
                transform: scale(1.2) rotate(-10deg);
            }

            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 16;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
            }
        }

        /* Error icon animation */
        .error-icon {
            animation: shake 0.6s ease-in-out, errorPulse 2s infinite 0.6s;
        }

        .warning-lines {
            stroke-dasharray: 12;
            stroke-dashoffset: 12;
            animation: drawLine 0.4s ease-out 0.2s forwards;
        }

        .warning-dot {
            opacity: 0;
            animation: fadeInDot 0.3s ease-out 0.6s forwards;
        }

        @keyframes shake {

            0%,
            20%,
            40%,
            60%,
            80%,
            100% {
                transform: translateX(0) scale(1);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-3px) scale(1.05);
            }
        }

        @keyframes drawLine {
            0% {
                stroke-dashoffset: 12;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes fadeInDot {
            0% {
                opacity: 0;
                transform: scale(0);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes errorPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
            }
        }

        /* Modal entrance animation */
        .modal-enter {
            animation: modalSlideIn 0.4s ease-out;
        }

        @keyframes modalSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Button hover effects */
        .btn-hover {
            transition: all 0.2s ease;
        }

        .btn-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>


    <main class="flex-grow mt-24">

        <!-- Success Modal -->
        <div x-data="{ open: @if ($errors->any() || session('error') || session('success')) true @else false @endif }" x-show="open"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>

            <div
                class="bg-white rounded-lg shadow-lg max-w-sm w-full text-center relative overflow-hidden mx-5 modal-enter">

                <!-- Close Button -->
                <button @click="open = false"
                    class="absolute top-2 right-2 w-8 h-8 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 transition-colors">✕</button>

                <!-- SUCCESS MODAL -->
                @if (session('success'))
                    <!-- Icon -->
                    <div class="flex justify-center mt-6">
                        <div class="w-16 h-16 rounded-full bg-green-600 flex items-center justify-center success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <h2 class="mt-4 text-lg font-bold text-green-600">SUCCESS</h2>
                    <p class="text-gray-600 px-6 mt-2 text-sm">
                        {{ session('success') }}
                    </p>

                    <!-- Footer -->
                    <div class="mt-6 py-3">
                        <button @click="open = false"
                            class="text-white bg-green-600 rounded-full py-2 px-4 font-medium btn-hover">Continue</button>
                    </div>

                    <!-- ERROR MODAL -->
                @elseif ($errors->any() || session('error'))
                    <!-- Icon -->
                    <div class="flex justify-center mt-6">
                        <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center error-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path class="warning-lines" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" d="M12 9v2" />
                                <path class="warning-dot" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3" d="M12 17h.01" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <h2 class="mt-4 text-lg font-bold text-red-600">ERROR</h2>
                    <p class="text-gray-600 px-6 mt-2 text-sm">
                        @if (session('error'))
                            {{ session('error') }}
                        @else
                            Please fix the following issues:
                            <ul class="mt-2 list-disc list-inside text-sm text-center text-red-700 mx-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </p>

                    <!-- Footer -->
                    <div class="mt-6 py-3">
                        <button @click="open = false"
                            class="text-white bg-red-600 rounded-full px-4 py-2 font-medium btn-hover">Continue</button>
                    </div>
                @endif
            </div>
        </div>


        @yield('content')
    </main>


    <!-- Footer -->
    {{-- <footer class="bg-white border-t border-gray-200 mt-2">
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

</html>

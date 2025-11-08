
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="3qrATmyK6FPJWi9ycBVnqrm3ngPSsvbMq8Dg69W8">
    <title>National Inventory Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Dashboard-specific CDN assets -->
    <!-- Tailwind CSS via JSDelivr (CSS version - CSP-compatible) -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- Chart.js via JSDelivr (CSP-compatible) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    
    <link rel="preload" as="style" href="https://nid.deped.gov.ph/build/assets/app-Bxd1hS3p.css" /><link rel="modulepreload" href="https://nid.deped.gov.ph/build/assets/app-eMHK6VFw.js" /><link rel="stylesheet" href="https://nid.deped.gov.ph/build/assets/app-Bxd1hS3p.css" data-navigate-track="reload" /><script type="module" src="https://nid.deped.gov.ph/build/assets/app-eMHK6VFw.js" data-navigate-track="reload"></script>        
    <!-- Dashboard-specific styles -->
    <link href="https://nid.deped.gov.ph/css/dashboard.css" rel="stylesheet">
</head>
<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-indigo-700 text-white shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="https://www.nid.deped.gov.ph" class="text-2xl font-bold hover:text-indigo-200 transition">NID Data Collection</a>
                    
                    <a href="/public-dashboard" class="text-white hover:text-indigo-200 transition font-medium">
                        Submission Dashboard
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                                            <a href="https://www.nid.deped.gov.ph/login" class="text-white hover:text-indigo-200 transition">
                            Login
                        </a>
                                        
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Compact Breadcrumb Section -->
<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-3">
            <!-- Left: Navigation -->
            <div class="flex items-center space-x-2">
                <h2 class="text-lg font-semibold text-gray-900">National Overview</h2>
            </div>
            
            <!-- Right: Last Updated -->
            <div class="text-sm text-gray-500">
                <span id="last-updated">Last updated: Jun 24, 2025 at 9:19 PM</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="fade-in">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">National Inventory Dashboard</h1>
            <p class="text-gray-600">Regional overview of school submission status and project progress</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Schools</dt>
                                <dd class="text-2xl font-bold text-gray-900">47,944</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Not Started</dt>
                                <dd class="text-2xl font-bold text-gray-900">783</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">API Imported</dt>
                                <dd class="text-2xl font-bold text-orange-600">593</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Submitted</dt>
                                <dd class="text-2xl font-bold text-green-600">46,568</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Projects</dt>
                                <dd class="text-2xl font-bold text-purple-600">77,560</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Overview -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">National Progress Overview</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Completion Progress -->
                    <div>
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Overall Completion Rate</span>
                            <span class="font-medium">97.1%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-green-600 h-4 rounded-full" style="width: 97.1%"></div>
                        </div>
                    </div>
                    
                    <!-- Workflow Progress -->
                    <div>
                                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>API Import Progress</span>
                            <span class="font-medium">98.4%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-orange-600 h-4 rounded-full" style="width: 98.4%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Completion Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Completion Rates by Region</h3>
                <div class="relative" style="height: 300px;">
                    <canvas id="completionChart"></canvas>
                </div>
            </div>

            <!-- Submissions Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Schools and Submissions by Region</h3>
                <div class="relative" style="height: 300px;">
                    <canvas id="submissionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Regional Breakdown Table -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Regional Breakdown</h3>
                <p class="mt-1 text-sm text-gray-500">Click on a region to view detailed division information</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Region</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Schools</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Not Started</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">API Imported</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Completion Rate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Projects</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20I'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region I
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,863
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                6
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,857
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 99.8%"></div>
                                    </div>
                                    <span class="text-sm font-medium">99.8%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,216
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20II'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region II
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,543
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                2
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                197
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,344
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 92.2%"></div>
                                    </div>
                                    <span class="text-sm font-medium">92.2%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,312
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20III'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region III
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                3,737
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                3,737
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                5,364
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20IV-A'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region IV-A
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                3,581
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                1
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                3,580
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,774
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/MIMAROPA'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                MIMAROPA
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,391
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                42
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                51
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,298
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 96.1%"></div>
                                    </div>
                                    <span class="text-sm font-medium">96.1%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                3,059
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20V'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region V
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                3,872
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                3,872
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                6,106
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20VI'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region VI
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,835
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,835
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,305
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20VII'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region VII
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,818
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                3
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,815
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 99.9%"></div>
                                    </div>
                                    <span class="text-sm font-medium">99.9%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,625
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20VIII'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region VIII
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                4,191
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                16
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                32
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                4,143
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 98.9%"></div>
                                    </div>
                                    <span class="text-sm font-medium">98.9%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                5,719
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20IX'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region IX
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,552
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,552
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,282
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20X'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region X
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,534
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,534
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                5,783
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20XI'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region XI
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,226
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,226
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                3,851
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/Region%20XII'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                Region XII
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,166
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,166
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,385
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/CARAGA'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                CARAGA
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,104
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                33
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,071
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 98.4%"></div>
                                    </div>
                                    <span class="text-sm font-medium">98.4%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                4,890
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/BARMM'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                BARMM
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,625
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                716
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                249
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                1,660
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 63.2%"></div>
                                    </div>
                                    <span class="text-sm font-medium">63.2%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                3,374
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/CAR'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                CAR
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                1,841
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                1,841
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                3,495
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/NCR'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                NCR
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                828
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                828
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-medium">100%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                1,408
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='https://www.nid.deped.gov.ph/public-dashboard/region/NIR'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                NIR
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                2,237
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                6
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">
                                22
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                2,209
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 98.7%"></div>
                                    </div>
                                    <span class="text-sm font-medium">98.7%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">
                                3,612
                            </td>
                        </tr>
                                            </tbody>
                </table>
            </div>
        </div>

        <!-- Auto-refresh indicator -->
        <div class="mt-6 flex justify-center">
            <div class="inline-flex items-center px-4 py-2 bg-white shadow border border-gray-200 rounded-full text-sm text-gray-600">
                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                Data refreshes automatically every 5 minutes
            </div>
        </div>
    </div>
</div>
    </main>

    <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="text-center text-sm text-gray-500">
            <p>&copy; 2025 Department of Education. National Inventory Data Collection System.</p>
        </div>
    </div>
</footer>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
    <!-- Dashboard-specific scripts -->
    <script>
// Wait for libraries to load before initializing
document.addEventListener('DOMContentLoaded', function() {
    // Check if Chart.js loaded successfully
    if (typeof Chart === 'undefined') {
        console.error('Chart.js failed to load. Dashboard charts will not work.');
        // Hide chart containers if Chart.js failed to load
        document.querySelectorAll('.chart-container').forEach(container => {
            container.innerHTML = '<div class="flex items-center justify-center h-full text-gray-500">Charts temporarily unavailable</div>';
        });
    } else {
        console.log('Chart.js loaded successfully');
    }

    // Initialize charts
    initializeCharts();
    
    // Set up auto-refresh
    setInterval(refreshData, 300000); // 5 minutes
});

// Utility functions for dashboard
window.Dashboard = {
    // Format numbers with commas
    formatNumber: function(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    
    // Update last updated timestamp
    updateTimestamp: function() {
        const now = new Date();
        const options = { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric', 
            hour: 'numeric', 
            minute: '2-digit',
            hour12: true,
            timeZone: 'Asia/Manila'
        };
        const timestampElement = document.getElementById('last-updated');
        if (timestampElement) {
            timestampElement.textContent = 'Last updated: ' + now.toLocaleDateString('en-US', options);
        }
    },
    
    // Show loading spinner
    showLoading: function(containerId) {
        const container = document.getElementById(containerId);
        if (container) {
            container.innerHTML = '<div class="loading-spinner"></div>';
        }
    },
    
    // Navigate to drill-down page
    navigateTo: function(url) {
        window.location.href = url;
    }
};

// Auto-refresh timestamp every minute
setInterval(Dashboard.updateTimestamp, 60000);

function initializeCharts() {
    // Chart data from Laravel
    const regionData = [{"region":"Region I","total_schools":2863,"not_started":0,"api_imported":6,"submitted":2857,"completion_percentage":99.8,"projects":4216},{"region":"Region II","total_schools":2543,"not_started":2,"api_imported":197,"submitted":2344,"completion_percentage":92.2,"projects":4312},{"region":"Region III","total_schools":3737,"not_started":0,"api_imported":0,"submitted":3737,"completion_percentage":100,"projects":5364},{"region":"Region IV-A","total_schools":3581,"not_started":1,"api_imported":0,"submitted":3580,"completion_percentage":100,"projects":4774},{"region":"MIMAROPA","total_schools":2391,"not_started":42,"api_imported":51,"submitted":2298,"completion_percentage":96.1,"projects":3059},{"region":"Region V","total_schools":3872,"not_started":0,"api_imported":0,"submitted":3872,"completion_percentage":100,"projects":6106},{"region":"Region VI","total_schools":2835,"not_started":0,"api_imported":0,"submitted":2835,"completion_percentage":100,"projects":4305},{"region":"Region VII","total_schools":2818,"not_started":0,"api_imported":3,"submitted":2815,"completion_percentage":99.9,"projects":4625},{"region":"Region VIII","total_schools":4191,"not_started":16,"api_imported":32,"submitted":4143,"completion_percentage":98.9,"projects":5719},{"region":"Region IX","total_schools":2552,"not_started":0,"api_imported":0,"submitted":2552,"completion_percentage":100,"projects":4282},{"region":"Region X","total_schools":2534,"not_started":0,"api_imported":0,"submitted":2534,"completion_percentage":100,"projects":5783},{"region":"Region XI","total_schools":2226,"not_started":0,"api_imported":0,"submitted":2226,"completion_percentage":100,"projects":3851},{"region":"Region XII","total_schools":2166,"not_started":0,"api_imported":0,"submitted":2166,"completion_percentage":100,"projects":4385},{"region":"CARAGA","total_schools":2104,"not_started":0,"api_imported":33,"submitted":2071,"completion_percentage":98.4,"projects":4890},{"region":"BARMM","total_schools":2625,"not_started":716,"api_imported":249,"submitted":1660,"completion_percentage":63.2,"projects":3374},{"region":"CAR","total_schools":1841,"not_started":0,"api_imported":0,"submitted":1841,"completion_percentage":100,"projects":3495},{"region":"NCR","total_schools":828,"not_started":0,"api_imported":0,"submitted":828,"completion_percentage":100,"projects":1408},{"region":"NIR","total_schools":2237,"not_started":6,"api_imported":22,"submitted":2209,"completion_percentage":98.7,"projects":3612}];
    
    // Completion Chart
    const completionCtx = document.getElementById('completionChart').getContext('2d');
    new Chart(completionCtx, {
        type: 'bar',
        data: {
            labels: regionData.map(r => r.region),
            datasets: [{
                label: 'Completion Percentage',
                data: regionData.map(r => r.completion_percentage),
                backgroundColor: 'rgba(34, 197, 94, 0.8)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Submissions Chart
    const submissionsCtx = document.getElementById('submissionsChart').getContext('2d');
    new Chart(submissionsCtx, {
        type: 'bar',
        data: {
            labels: regionData.map(r => r.region),
            datasets: [
                {
                    label: 'Total Schools',
                    data: regionData.map(r => r.total_schools),
                    backgroundColor: 'rgba(156, 163, 175, 0.8)',
                    borderColor: 'rgba(156, 163, 175, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Not Started',
                    data: regionData.map(r => r.not_started),
                    backgroundColor: 'rgba(107, 114, 128, 0.8)',
                    borderColor: 'rgba(107, 114, 128, 1)',
                    borderWidth: 2
                },
                {
                    label: 'API Imported',
                    data: regionData.map(r => r.api_imported),
                    backgroundColor: 'rgba(245, 158, 11, 0.8)',
                    borderColor: 'rgba(245, 158, 11, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Submitted',
                    data: regionData.map(r => r.submitted),
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: false
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function refreshData() {
    Dashboard.updateTimestamp();
    location.reload();
}
</script>
</body>
</html>
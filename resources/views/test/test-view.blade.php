<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DepEd DCP Inventory Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0056b3;
            --secondary: #6c757d;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        .sidebar {
            transition: all 0.3s;
        }

        .dashboard-card {
            transition: transform 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .equipment-card {
            border-left: 4px solid var(--primary);
        }

        .status-functional {
            border-left-color: var(--success);
        }

        .status-needs-repair {
            border-left-color: var(--warning);
        }

        .status-ber {
            border-left-color: var(--danger);
        }

        .status-missing {
            border-left-color: var(--secondary);
        }

        .nav-tabs .nav-link.active {
            border-bottom: 3px solid var(--primary);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1000;
                left: -100%;
            }

            .sidebar.active {
                left: 0;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 shadow-md fixed h-full z-10 md:left-0 left-[-100%] transition-all">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/05cfa652-8a85-4bba-9474-32f16b247b0d.png"
                        alt="DepEd Logo" class="rounded-full">
                    <div class="ml-3">
                        <h2 class="font-bold text-lg">DCP Inventory</h2>
                        <p class="text-xs text-gray-500">Management System</p>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="mb-6">
                    <p class="text-xs uppercase text-gray-500 font-semibold mb-2">Main Menu</p>
                    <ul>
                        <li class="mb-1">
                            <a href="#"
                                class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50 active-nav"
                                onclick="showDashboard()">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#" class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50"
                                onclick="showInventory()">
                                <i class="fas fa-boxes mr-3"></i>
                                <span>Inventory</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#" class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50"
                                onclick="showReports()">
                                <i class="fas fa-chart-bar mr-3"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#" class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50"
                                onclick="showUsers()">
                                <i class="fas fa-users mr-3"></i>
                                <span>User Management</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#" class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50"
                                onclick="showMasterData()">
                                <i class="fas fa-database mr-3"></i>
                                <span>Master Data</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs uppercase text-gray-500 font-semibold mb-2">Quick Actions</p>
                    <ul>
                        <li class="mb-1">
                            <a href="#" class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50"
                                onclick="showAddEquipment()">
                                <i class="fas fa-plus-circle mr-3"></i>
                                <span>Add Equipment</span>
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#" class="flex items-center p-2 text-gray-700 rounded hover:bg-blue-50"
                                onclick="showPhysicalValidation()">
                                <i class="fas fa-clipboard-check mr-3"></i>
                                <span>Physical Validation</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
                <div class="flex items-center">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/eb8c2ceb-9db0-4611-83da-6fd33be46ddd.png"
                        alt="User Profile" class="rounded-full">
                    <div class="ml-3">
                        <p class="font-medium">John Doe</p>
                        <p class="text-xs text-gray-500">SDO Admin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay for mobile -->
        <div class="overlay" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto ml-0 md:ml-64 transition-all">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button class="md:hidden mr-4 text-gray-600" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 id="page-title" class="text-xl font-semibold">Dashboard</h1>
                </div>
                <div class="flex items-center">
                    <div class="relative mr-4">
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bell"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </button>
                    </div>
                    <div class="relative">
                        <button class="flex items-center text-gray-700" id="user-menu-button">
                            <span class="mr-2">John Doe</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden"
                            id="user-menu">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-4">
                <!-- Dashboard Content -->
                <div id="dashboard-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="dashboard-card bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Total Equipment</p>
                                    <h3 class="text-2xl font-bold">1,245</h3>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-boxes text-blue-500"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-green-500"><i class="fas fa-arrow-up"></i> 12% from last year
                                </p>
                            </div>
                        </div>
                        <div class="dashboard-card bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Functional</p>
                                    <h3 class="text-2xl font-bold">987</h3>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-green-500"><i class="fas fa-arrow-up"></i> 5% from last quarter
                                </p>
                            </div>
                        </div>
                        <div class="dashboard-card bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Needs Repair</p>
                                    <h3 class="text-2xl font-bold">143</h3>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-full">
                                    <i class="fas fa-tools text-yellow-500"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-red-500"><i class="fas fa-arrow-up"></i> 8% from last quarter
                                </p>
                            </div>
                        </div>
                        <div class="dashboard-card bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500">Schools</p>
                                    <h3 class="text-2xl font-bold">56</h3>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <i class="fas fa-school text-purple-500"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-green-500"><i class="fas fa-arrow-up"></i> 3 new this year</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Equipment Status Overview</h3>
                                <div class="flex">
                                    <button class="px-3 py-1 bg-blue-50 text-blue-600 rounded-l-md">Monthly</button>
                                    <button
                                        class="px-3 py-1 bg-white text-gray-600 border border-gray-200">Quarterly</button>
                                    <button
                                        class="px-3 py-1 bg-white text-gray-600 rounded-r-md border border-gray-200">Yearly</button>
                                </div>
                            </div>
                            <div class="h-64">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1898b545-d7ae-4aac-8afd-4961600fbb93.png"
                                    alt="Bar chart showing equipment status distribution with functional at 70%, needs repair at 20%, BER at 7%, and missing at 3%"
                                    class="w-full h-full object-contain">
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Recent Activities</h3>
                                <a href="#" class="text-sm text-blue-500">View All</a>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-plus text-blue-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">New equipment added</p>
                                        <p class="text-xs text-gray-500">Ilocos Norte National HS - 5 Desktop PCs</p>
                                        <p class="text-xs text-gray-400">2 hours ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-green-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-check text-green-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Inventory approved</p>
                                        <p class="text-xs text-gray-500">San Fernando Central ES</p>
                                        <p class="text-xs text-gray-400">1 day ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-yellow-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-exclamation text-yellow-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Inventory returned</p>
                                        <p class="text-xs text-gray-500">Bacnotan NHS - Missing asset tags</p>
                                        <p class="text-xs text-gray-400">2 days ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-purple-100 p-2 rounded-full mr-3">
                                        <i class="fas fa-clipboard-check text-purple-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">Physical validation scheduled</p>
                                        <p class="text-xs text-gray-500">Bangui Central School - June 15, 2023</p>
                                        <p class="text-xs text-gray-400">3 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold">Submission Status by School</h3>
                            <a href="#" class="text-sm text-blue-500">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            School</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            District</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Last Updated</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Ilocos Norte National HS</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">District 1</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Approved</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 10, 2023
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">San
                                            Fernando Central ES</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">District 2</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Approved</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 8, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Bacnotan NHS</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">District 3</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Returned</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 5, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Bangui Central School</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">District 4</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 3, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700">Review</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Pagudpud NHS</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">District 5</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Not
                                                Submitted</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 15, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700">Remind</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Inventory Content -->
                <div id="inventory-content" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Equipment Inventory</h2>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                onclick="showAddEquipment()">
                                <i class="fas fa-plus mr-2"></i> Add Equipment
                            </button>
                            <div class="relative">
                                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                            <div class="relative">
                                <input type="text" placeholder="Search..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                        <ul class="flex border-b border-gray-200 nav-tabs">
                            <li class="mr-1">
                                <a href="#" class="nav-link active py-3 px-4 inline-block"
                                    onclick="filterInventory('all')">All Equipment</a>
                            </li>
                            <li class="mr-1">
                                <a href="#" class="nav-link py-3 px-4 inline-block"
                                    onclick="filterInventory('functional')">Functional</a>
                            </li>
                            <li class="mr-1">
                                <a href="#" class="nav-link py-3 px-4 inline-block"
                                    onclick="filterInventory('needs-repair')">Needs Repair</a>
                            </li>
                            <li class="mr-1">
                                <a href="#" class="nav-link py-3 px-4 inline-block"
                                    onclick="filterInventory('ber')">BER</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link py-3 px-4 inline-block"
                                    onclick="filterInventory('missing')">Missing</a>
                            </li>
                        </ul>

                        <div class="p-4">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Asset Tag</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Equipment</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                School</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Location</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="inventory-table-body">
                                        <!-- Equipment items will be loaded here -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <div class="text-sm text-gray-500">
                                    Showing <span id="start-item">1</span> to <span id="end-item">10</span> of <span
                                        id="total-items">124</span> entries
                                </div>
                                <div class="flex space-x-1">
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 disabled">Previous</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-blue-600 text-white">1</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">2</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">3</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Content -->
                <div id="reports-content" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Reports</h2>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                <i class="fas fa-file-export mr-2"></i> Export
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="font-semibold mb-4">Predefined Reports</h3>
                            <div class="space-y-3">
                                <div class="p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Division-wide Inventory Summary</p>
                                            <p class="text-sm text-gray-500">Total units by equipment type and status
                                            </p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </div>
                                <div class="p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Non-Functional Equipment Report</p>
                                            <p class="text-sm text-gray-500">List of all items marked "Needs Repair",
                                                "BER", or "Missing"</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </div>
                                <div class="p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">DCP Batch Breakdown</p>
                                            <p class="text-sm text-gray-500">Inventory count per DCP batch/year</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </div>
                                <div class="p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Submission Compliance Report</p>
                                            <p class="text-sm text-gray-500">List of schools and their current
                                                inventory submission status</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="font-semibold mb-4">Custom Report Builder</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Fields</label>
                                    <select multiple
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md h-32">
                                        <option>Asset Tag</option>
                                        <option>Serial Number</option>
                                        <option>Equipment Type</option>
                                        <option>Brand</option>
                                        <option>Model</option>
                                        <option>Status</option>
                                        <option>School</option>
                                        <option>District</option>
                                        <option>DCP Batch</option>
                                        <option>Acquisition Date</option>
                                        <option>Location</option>
                                        <option>Remarks</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Filters</label>
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <select
                                                class="block w-1/3 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                <option>Status</option>
                                                <option>Equipment Type</option>
                                                <option>DCP Batch</option>
                                                <option>School</option>
                                                <option>District</option>
                                            </select>
                                            <select
                                                class="block w-1/3 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                <option>equals</option>
                                                <option>contains</option>
                                                <option>starts with</option>
                                                <option>ends with</option>
                                            </select>
                                            <input type="text"
                                                class="block w-1/3 pl-3 pr-3 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        </div>
                                        <button class="text-sm text-blue-500 hover:text-blue-700 flex items-center">
                                            <i class="fas fa-plus mr-1"></i> Add Filter
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                                    <div class="flex items-center space-x-2">
                                        <select
                                            class="block w-1/2 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option>Asset Tag</option>
                                            <option>Equipment Type</option>
                                            <option>Status</option>
                                            <option>School</option>
                                        </select>
                                        <select
                                            class="block w-1/2 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option>Ascending</option>
                                            <option>Descending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <button
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 w-full">
                                        Generate Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold">Recent Reports</h3>
                            <a href="#" class="text-sm text-blue-500">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Report Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Generated By</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Format</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Division Inventory Summary</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Doe</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 10, 2023
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PDF</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#"
                                                class="text-blue-500 hover:text-blue-700 mr-3">Download</a>
                                            <a href="#" class="text-blue-500 hover:text-blue-700">Regenerate</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Non-Functional Equipment</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Maria Santos</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 8, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Excel</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#"
                                                class="text-blue-500 hover:text-blue-700 mr-3">Download</a>
                                            <a href="#" class="text-blue-500 hover:text-blue-700">Regenerate</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DCP
                                            Batch 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Juan Dela Cruz
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 5, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PDF</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#"
                                                class="text-blue-500 hover:text-blue-700 mr-3">Download</a>
                                            <a href="#" class="text-blue-500 hover:text-blue-700">Regenerate</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- User Management Content -->
                <div id="users-content" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">User Management</h2>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                onclick="showAddUserModal()">
                                <i class="fas fa-user-plus mr-2"></i> Add User
                            </button>
                            <div class="relative">
                                <input type="text" placeholder="Search users..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                        <ul class="flex border-b border-gray-200 nav-tabs">
                            <li class="mr-1">
                                <a href="#" class="nav-link active py-3 px-4 inline-block">All Users</a>
                            </li>
                            <li class="mr-1">
                                <a href="#" class="nav-link py-3 px-4 inline-block">SDO Staff</a>
                            </li>
                            <li class="mr-1">
                                <a href="#" class="nav-link py-3 px-4 inline-block">School Staff</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link py-3 px-4 inline-block">Inactive</a>
                            </li>
                        </ul>

                        <div class="p-4">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Name</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Role</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Affiliation</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Last Login</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/aa95ca92-9baa-4692-baf6-e72bc08b3bb9.png"
                                                            alt="User profile photo" class="h-10 w-10 rounded-full">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                        <div class="text-sm text-gray-500">john.doe@deped.gov.ph</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SDO Admin
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SDO Ilocos
                                                Norte</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 10, 2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="#"
                                                    class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                                <a href="#"
                                                    class="text-red-500 hover:text-red-700">Deactivate</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/42d66c8f-5958-4043-8416-c80da7bdb678.png"
                                                            alt="User profile photo" class="h-10 w-10 rounded-full">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Maria Santos
                                                        </div>
                                                        <div class="text-sm text-gray-500">maria.santos@deped.gov.ph
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SDO IT
                                                Officer</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">SDO Ilocos
                                                Norte</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 8, 2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="#"
                                                    class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                                <a href="#"
                                                    class="text-red-500 hover:text-red-700">Deactivate</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ad832d5d-1acc-49ca-8b57-5940c0338b10.png"
                                                            alt="User profile photo" class="h-10 w-10 rounded-full">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Juan Dela Cruz
                                                        </div>
                                                        <div class="text-sm text-gray-500">juan.delacruz@deped.gov.ph
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">School Head
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ilocos Norte
                                                National HS</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 5, 2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="#"
                                                    class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                                <a href="#"
                                                    class="text-red-500 hover:text-red-700">Deactivate</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/a6276ed0-7566-4de3-81cc-172a0589184c.png"
                                                            alt="User profile photo" class="h-10 w-10 rounded-full">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Ana Reyes</div>
                                                        <div class="text-sm text-gray-500">ana.reyes@deped.gov.ph</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Property
                                                Custodian</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">San Fernando
                                                Central ES</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">June 3, 2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="#"
                                                    class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                                <a href="#"
                                                    class="text-red-500 hover:text-red-700">Deactivate</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <div class="text-sm text-gray-500">
                                    Showing 1 to 4 of 24 entries
                                </div>
                                <div class="flex space-x-1">
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 disabled">Previous</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-blue-600 text-white">1</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">2</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">3</button>
                                    <button
                                        class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Master Data Content -->
                <div id="master-data-content" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Master Data Management</h2>
                        <div class="flex space-x-2">
                            <div class="relative">
                                <input type="text" placeholder="Search..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Schools</h3>
                                <button class="text-blue-500 hover:text-blue-700" onclick="showAddSchoolModal()">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                            <div class="overflow-y-auto max-h-64">
                                <ul class="divide-y divide-gray-200">
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Ilocos Norte National HS</p>
                                            <p class="text-sm text-gray-500">District 1</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">San Fernando Central ES</p>
                                            <p class="text-sm text-gray-500">District 2</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Bacnotan NHS</p>
                                            <p class="text-sm text-gray-500">District 3</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Bangui Central School</p>
                                            <p class="text-sm text-gray-500">District 4</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Equipment Categories</h3>
                                <button class="text-blue-500 hover:text-blue-700" onclick="showAddCategoryModal()">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                            <div class="overflow-y-auto max-h-64">
                                <ul class="divide-y divide-gray-200">
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Desktop PC</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Laptop</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Printer</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Projector</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Status Types</h3>
                                <button class="text-blue-500 hover:text-blue-700" onclick="showAddStatusModal()">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                            <div class="overflow-y-auto max-h-64">
                                <ul class="divide-y divide-gray-200">
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Functional</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Needs Repair</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Beyond Economical Repair</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">Missing</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold">DCP Batches</h3>
                            <button class="text-blue-500 hover:text-blue-700" onclick="showAddBatchModal()">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Batch Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Program Year</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Items</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DCP
                                            Batch 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">245</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                            <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DCP
                                            Batch 2022</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2022</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">198</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                            <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">DCP
                                            Batch 2021</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2021</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">175</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                            <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Equipment Modal -->
                <div id="add-equipment-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Add New Equipment</h3>
                            <button class="text-gray-500 hover:text-gray-700"
                                onclick="hideModal('add-equipment-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <ul class="flex border-b border-gray-200">
                                    <li class="mr-1">
                                        <a href="#" class="nav-link active py-2 px-4 inline-block"
                                            onclick="showEquipmentTab('new-batch')">New DCP Delivery</a>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link py-2 px-4 inline-block"
                                            onclick="showEquipmentTab('individual')">Individual Item</a>
                                    </li>
                                </ul>
                            </div>

                            <div id="new-batch-tab">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">DCP Batch/Program
                                            Year</label>
                                        <select class="w-full border border-gray-300 rounded-md p-2">
                                            <option>Select Batch</option>
                                            <option>DCP Batch 2023</option>
                                            <option>DCP Batch 2022</option>
                                            <option>DCP Batch 2021</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Delivery
                                            Date</label>
                                        <input type="date" class="w-full border border-gray-300 rounded-md p-2">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Receipt
                                        (Optional)</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label
                                            class="flex flex-col w-full h-32 border-2 border-dashed hover:border-gray-400 hover:bg-gray-50 rounded-md cursor-pointer">
                                            <div class="flex flex-col items-center justify-center pt-7">
                                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                                <p class="text-sm text-gray-500">Click to upload or drag and drop</p>
                                                <p class="text-xs text-gray-500">PDF, JPG, PNG (max. 5MB)</p>
                                            </div>
                                            <input type="file" class="hidden">
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="font-medium mb-2">Equipment Items</h4>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Asset Tag</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Serial No.</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Type</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Brand/Model</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="text"
                                                            class="border border-gray-300 rounded-md p-1 w-full"
                                                            placeholder="DCP-2023-001">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="text"
                                                            class="border border-gray-300 rounded-md p-1 w-full"
                                                            placeholder="SN12345678">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <select class="border border-gray-300 rounded-md p-1 w-full">
                                                            <option>Desktop PC</option>
                                                            <option>Laptop</option>
                                                            <option>Printer</option>
                                                            <option>Projector</option>
                                                        </select>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="text"
                                                            class="border border-gray-300 rounded-md p-1 w-full"
                                                            placeholder="Brand/Model">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <select class="border border-gray-300 rounded-md p-1 w-full">
                                                            <option>Functional</option>
                                                            <option>Needs Repair</option>
                                                            <option>BER</option>
                                                            <option>Missing</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button
                                        class="mt-2 px-3 py-1 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                                        <i class="fas fa-plus mr-1"></i> Add Another Item
                                    </button>
                                </div>
                            </div>

                            <div id="individual-tab" class="hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Asset Tag</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                            placeholder="DCP-2023-001">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Serial
                                            Number</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                            placeholder="SN12345678">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Equipment
                                            Type</label>
                                        <select class="w-full border border-gray-300 rounded-md p-2">
                                            <option>Desktop PC</option>
                                            <option>Laptop</option>
                                            <option>Printer</option>
                                            <option>Projector</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Brand/Model</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                            placeholder="Brand/Model">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Year of
                                            Acquisition</label>
                                        <input type="number" class="w-full border border-gray-300 rounded-md p-2"
                                            placeholder="2023" min="2000" max="2023">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select class="w-full border border-gray-300 rounded-md p-2">
                                            <option>Functional</option>
                                            <option>Needs Repair</option>
                                            <option>BER</option>
                                            <option>Missing</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Specific Location in
                                        School</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                        placeholder="e.g., ICT Lab 1, Library">
                                </div>

                                <div class="mb-4">
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1">Remarks/Condition</label>
                                    <textarea class="w-full border border-gray-300 rounded-md p-2" rows="3"
                                        placeholder="Any additional notes about the equipment's condition"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('add-equipment-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Equipment
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div id="add-user-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Add New User</h3>
                            <button class="text-gray-500 hover:text-gray-700" onclick="hideModal('add-user-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" class="w-full border border-gray-300 rounded-md p-2">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                    <select class="w-full border border-gray-300 rounded-md p-2">
                                        <option>SDO Admin</option>
                                        <option>SDO IT Officer</option>
                                        <option>SDO Supply Officer</option>
                                        <option>School Head</option>
                                        <option>Property Custodian</option>
                                        <option>ICT Coordinator</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Affiliation</label>
                                    <select class="w-full border border-gray-300 rounded-md p-2">
                                        <option>SDO Ilocos Norte</option>
                                        <option>Ilocos Norte National HS</option>
                                        <option>San Fernando Central ES</option>
                                        <option>Bacnotan NHS</option>
                                        <option>Bangui Central School</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Initial
                                        Password</label>
                                    <input type="password" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm
                                        Password</label>
                                    <input type="password" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('add-user-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Create User
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Physical Validation Modal -->
                <div id="physical-validation-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Schedule Physical Validation</h3>
                            <button class="text-gray-500 hover:text-gray-700"
                                onclick="hideModal('physical-validation-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Select School</label>
                                <select class="w-full border border-gray-300 rounded-md p-2">
                                    <option>Ilocos Norte National HS</option>
                                    <option>San Fernando Central ES</option>
                                    <option>Bacnotan NHS</option>
                                    <option>Bangui Central School</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Validation Date</label>
                                    <input type="date" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Validation Team</label>
                                    <select multiple class="w-full border border-gray-300 rounded-md p-2 h-32">
                                        <option>John Doe (SDO Admin)</option>
                                        <option>Maria Santos (SDO IT Officer)</option>
                                        <option>Juan Dela Cruz (SDO Supply Officer)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Purpose/Notes</label>
                                <textarea class="w-full border border-gray-300 rounded-md p-2" rows="3"
                                    placeholder="Brief description of the validation purpose"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('physical-validation-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Schedule Validation
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add School Modal -->
                <div id="add-school-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Add New School</h3>
                            <button class="text-gray-500 hover:text-gray-700" onclick="hideModal('add-school-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">School ID</label>
                                <input type="text" class="w-full border border-gray-300 rounded-md p-2">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-md p-2">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">School Head</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-md p-2">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Information</label>
                                <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Email/Phone">
                            </div>

                            <div class="mb-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">Mark as DCP recipient</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('add-school-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save School
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div id="add-category-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Add Equipment Category</h3>
                            <button class="text-gray-500 hover:text-gray-700"
                                onclick="hideModal('add-category-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                    placeholder="e.g., Desktop PC, Laptop">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description
                                    (Optional)</label>
                                <textarea class="w-full border border-gray-300 rounded-md p-2" rows="3"
                                    placeholder="Brief description of the category"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('add-category-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Category
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add Status Modal -->
                <div id="add-status-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Add Status Type</h3>
                            <button class="text-gray-500 hover:text-gray-700" onclick="hideModal('add-status-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                    placeholder="e.g., Functional, Needs Repair">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea class="w-full border border-gray-300 rounded-md p-2" rows="3"
                                    placeholder="Brief description of what this status means"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Color Indicator</label>
                                <div class="flex space-x-2">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full bg-green-500 mr-1"></div>
                                        <span class="text-sm">Green</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full bg-yellow-500 mr-1"></div>
                                        <span class="text-sm">Yellow</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full bg-red-500 mr-1"></div>
                                        <span class="text-sm">Red</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 rounded-full bg-gray-500 mr-1"></div>
                                        <span class="text-sm">Gray</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('add-status-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Status
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Add Batch Modal -->
                <div id="add-batch-modal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold">Add DCP Batch</h3>
                            <button class="text-gray-500 hover:text-gray-700" onclick="hideModal('add-batch-modal')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Batch Name</label>
                                <input type="text" class="w-full border border-gray-300 rounded-md p-2"
                                    placeholder="e.g., DCP Batch 2023">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Program Year</label>
                                <input type="number" class="w-full border border-gray-300 rounded-md p-2"
                                    placeholder="2023" min="2000" max="2023">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description
                                    (Optional)</label>
                                <textarea class="w-full border border-gray-300 rounded-md p-2" rows="3"
                                    placeholder="Any notes about this batch"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 border-t border-gray-200 p-4">
                            <button
                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50"
                                onclick="hideModal('add-batch-modal')">
                                Cancel
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Batch
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sample inventory data
        const inventoryData = [{
                assetTag: "DCP-2023-001",
                equipment: "Desktop PC",
                school: "Ilocos Norte National HS",
                status: "Functional",
                location: "ICT Lab 1",
                serialNo: "SN12345678",
                brandModel: "Dell OptiPlex 3080",
                acquisitionDate: "2023-01-15",
                dcpBatch: "DCP Batch 2023"
            },
            {
                assetTag: "DCP-2023-002",
                equipment: "Laptop",
                school: "San Fernando Central ES",
                status: "Functional",
                location: "Principal's Office",
                serialNo: "SN23456789",
                brandModel: "Lenovo ThinkPad E15",
                acquisitionDate: "2023-01-20",
                dcpBatch: "DCP Batch 2023"
            },
            {
                assetTag: "DCP-2022-045",
                equipment: "Printer",
                school: "Bacnotan NHS",
                status: "Needs Repair",
                location: "Admin Office",
                serialNo: "SN34567890",
                brandModel: "HP LaserJet Pro M404n",
                acquisitionDate: "2022-05-10",
                dcpBatch: "DCP Batch 2022"
            },
            {
                assetTag: "DCP-2021-078",
                equipment: "Projector",
                school: "Bangui Central School",
                status: "BER",
                location: "Grade 6 Classroom",
                serialNo: "SN45678901",
                brandModel: "Epson EB-E01",
                acquisitionDate: "2021-08-15",
                dcpBatch: "DCP Batch 2021"
            },
            {
                assetTag: "DCP-2020-112",
                equipment: "Desktop PC",
                school: "Pagudpud NHS",
                status: "Missing",
                location: "Library",
                serialNo: "SN56789012",
                brandModel: "Acer Veriton M2610G",
                acquisitionDate: "2020-11-05",
                dcpBatch: "DCP Batch 2020"
            }
        ];

        // DOM elements
        const pageTitle = document.getElementById('page-title');
        const dashboardContent = document.getElementById('dashboard-content');
        const inventoryContent = document.getElementById('inventory-content');
        const reportsContent = document.getElementById('reports-content');
        const usersContent = document.getElementById('users-content');
        const masterDataContent = document.getElementById('master-data-content');
        const inventoryTableBody = document.getElementById('inventory-table-body');

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Load inventory data
            loadInventoryData();

            // User menu toggle
            document.getElementById('user-menu-button').addEventListener('click', function() {
                document.getElementById('user-menu').classList.toggle('hidden');
            });

            // Close user menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('#user-menu-button') && !event.target.closest('#user-menu')) {
                    document.getElementById('user-menu').classList.add('hidden');
                }
            });
        });

        // Navigation functions
        function showDashboard() {
            hideAllContent();
            dashboardContent.classList.remove('hidden');
            pageTitle.textContent = 'Dashboard';
            updateActiveNav('dashboard');
        }

        function showInventory() {
            hideAllContent();
            inventoryContent.classList.remove('hidden');
            pageTitle.textContent = 'Inventory';
            updateActiveNav('inventory');
        }

        function showReports() {
            hideAllContent();
            reportsContent.classList.remove('hidden');
            pageTitle.textContent = 'Reports';
            updateActiveNav('reports');
        }

        function showUsers() {
            hideAllContent();
            usersContent.classList.remove('hidden');
            pageTitle.textContent = 'User Management';
            updateActiveNav('users');
        }

        function showMasterData() {
            hideAllContent();
            masterDataContent.classList.remove('hidden');
            pageTitle.textContent = 'Master Data';
            updateActiveNav('master-data');
        }

        function hideAllContent() {
            dashboardContent.classList.add('hidden');
            inventoryContent.classList.add('hidden');
            reportsContent.classList.add('hidden');
            usersContent.classList.add('hidden');
            masterDataContent.classList.add('hidden');
        }

        function updateActiveNav(current) {
            const navItems = document.querySelectorAll('.sidebar a');
            navItems.forEach(item => {
                item.classList.remove('active-nav');
                item.classList.remove('bg-blue-50');
                item.classList.remove('text-blue-600');
            });

            if (current === 'dashboard') {
                document.querySelector('.sidebar a:nth-child(1)').classList.add('active-nav', 'bg-blue-50',
                    'text-blue-600');
            } else if (current === 'inventory') {
                document.querySelector('.sidebar a:nth-child(2)').classList.add('active-nav', 'bg-blue-50',
                    'text-blue-600');
            } else if (current === 'reports') {
                document.querySelector('.sidebar a:nth-child(3)').classList.add('active-nav', 'bg-blue-50',
                    'text-blue-600');
            } else if (current === 'users') {
                document.querySelector('.sidebar a:nth-child(4)').classList.add('active-nav', 'bg-blue-50',
                    'text-blue-600');
            } else if (current === 'master-data') {
                document.querySelector('.sidebar a:nth-child(5)').classList.add('active-nav', 'bg-blue-50',
                    'text-blue-600');
            }
        }

        // Inventory functions
        function loadInventoryData(filter = 'all') {
            inventoryTableBody.innerHTML = '';

            let filteredData = inventoryData;
            if (filter === 'functional') {
                filteredData = inventoryData.filter(item => item.status === 'Functional');
            } else if (filter === 'needs-repair') {
                filteredData = inventoryData.filter(item => item.status === 'Needs Repair');
            } else if (filter === 'ber') {
                filteredData = inventoryData.filter(item => item.status === 'BER');
            } else if (filter === 'missing') {
                filteredData = inventoryData.filter(item => item.status === 'Missing');
            }

            filteredData.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'equipment-card';

                if (item.status === 'Functional') {
                    row.classList.add('status-functional');
                } else if (item.status === 'Needs Repair') {
                    row.classList.add('status-needs-repair');
                } else if (item.status === 'BER') {
                    row.classList.add('status-ber');
                } else if (item.status === 'Missing') {
                    row.classList.add('status-missing');
                }

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.assetTag}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.equipment}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.school}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full ${getStatusColorClass(item.status)}">${item.status}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.location}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <button class="text-blue-500 hover:text-blue-700 mr-3" onclick="editEquipment('${item.assetTag}')">Edit</button>
                        <button class="text-red-500 hover:text-red-700" onclick="deleteEquipment('${item.assetTag}')">Delete</button>
                    </td>
                `;

                inventoryTableBody.appendChild(row);
            });

            // Update pagination info
            document.getElementById('start-item').textContent = '1';
            document.getElementById('end-item').textContent = filteredData.length;
            document.getElementById('total-items').textContent = filteredData.length;
        }

        function getStatusColorClass(status) {
            switch (status) {
                case 'Functional':
                    return 'bg-green-100 text-green-800';
                case 'Needs Repair':
                    return 'bg-yellow-100 text-yellow-800';
                case 'BER':
                    return 'bg-red-100 text-red-800';
                case 'Missing':
                    return 'bg-gray-100 text-gray-800';
                default:
                    return 'bg-blue-100 text-blue-800';
            }
        }

        function filterInventory(filter) {
            // Update active tab
            const tabs = document.querySelectorAll('.nav-tabs .nav-link');
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            // Filter data
            loadInventoryData(filter);
        }

        function editEquipment(assetTag) {
            const item = inventoryData.find(i => i.assetTag === assetTag);
            if (item) {
                alert(Editing equipment with asset tag: $ {
                        assetTag
                    }\
                    nEquipment: $ {
                        item.equipment
                    }\
                    nStatus: $ {
                        item.status
                    });
                // In a real app, this would open a modal with the item's details for editing
            }
        }

        function deleteEquipment(assetTag) {
            if (confirm(Are you sure you want to delete equipment with asset tag: $ {
                    assetTag
                } ? )) {
                alert(Equipment $ {
                        assetTag
                    }
                    deleted successfully.);
                // In a real app, this would make an API call to delete the item
            }
        }

        // Modal functions
        function showAddEquipment() {
            showModal('add-equipment-modal');
            showEquipmentTab('new-batch');
        }

        function showAddUserModal() {
            showModal('add-user-modal');
        }

        function showPhysicalValidation() {
            showModal('physical-validation-modal');
        }

        function showAddSchoolModal() {
            showModal('add-school-modal');
        }

        function showAddCategoryModal() {
            showModal('add-category-modal');
        }

        function showAddStatusModal() {
            showModal('add-status-modal');
        }

        function showAddBatchModal() {
            showModal('add-batch-modal');
        }

        function showEquipmentTab(tabId) {
            document.getElementById('new-batch-tab').classList.toggle('hidden', tabId !== 'new-batch');
            document.getElementById('individual-tab').classList.toggle('hidden', tabId !== 'individual');

            // Update active tab style
            const tabs = document.querySelectorAll('#add-equipment-modal .nav-link');
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');
        }

        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.querySelector('.overlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.querySelector('.overlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Sidebar toggle for mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        }
    </script>
</body>

</html>

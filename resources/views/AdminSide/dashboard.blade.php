@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>



@section('content')
    <div class="mx-5 my-5 bg-white shadow-xl rounded-lg overflow-hidden p-6">

        <div class="flex flex-col md:flex-row items-center justify-between gap-5">
            <div class="items-center justify-center">
                <h2 class="text-2xl text-center font-bold text-gray-800 mb-4" style="font-weight: 600">Inventory Management
                    System</h2>
                <div class="flex  items-center justify-center md:items-start md:justify-start md:mx-0">
                    <img src="{{ asset('icon/logo.png') }}" width="70" height="70" alt="">
                    <img src="{{ asset('icon/bagong-pilipinas.jpg') }}" width="70" height="70" alt="">
                </div>
                <div class="text-center md:text-left md:mx-0">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Schools Division Office
                    </h3>
                    <p>
                        San Carlos City, Pangasinan
                    </p>
                </div>

            </div>
            <img class="rounded-full shadow-lg  " style="border:1px solid #ccc"
                src="{{ asset('icon/logo-dcpinventory.jpg') }}" width="200" height="200" alt="">
        </div>

    </div>

    <div class="     my-5 mx-5     ">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Total Schools -->

            <div
                class="flex justify-between bg-white shadow-md rounded-xl border border-gray-200 p-4 flex items-center space-x-4">
                <div>
                    Stakeholder
                    <div>
                        <div class="text-gray-700 font-semibold text-xl">Norman A. Flores</div>
                        <div class="text-gray-500 ">Project Manager</div>
                    </div>
                </div>
                <div
                    class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-semibold text-lg border-2 border-gray-500">
                    NA
                </div>

            </div>

            <div
                class="flex justify-between bg-white shadow-md rounded-xl border border-gray-200 p-5 flex items-center space-x-4">
                <div>
                    Development Team
                    <div>
                        <div class="text-gray-700 font-semibold text-xl">Em-jay A. Nerizon</div>
                        <div class="text-gray-500 ">Project Developer</div>
                    </div>
                </div>
                <div> <img class="rounded-full" src="{{ asset('icon/mj.jpg') }}" height="70" width="70"
                        alt=""></div>

            </div>
            <div
                class="flex justify-between bg-white shadow-md rounded-xl border border-gray-200 p-5 flex items-center space-x-4">
                <div>
                    Development Team
                    <div>
                        <div class="text-gray-700 font-semibold text-xl">Joerenz Carl M. Miranda</div>
                        <div class="text-gray-500 ">Development Assistant</div>
                    </div>
                </div>
                <div
                    class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-semibold text-lg border-2 border-gray-500">
                    JC
                </div>
            </div>


        </div>
    </div>
    <div class="   rounded-lg overflow-hidden p-6">
        <div class="text-2xl font-bold text-gray-800 mb-4">Infomation about the system</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Total Schools -->
            <div class="bg-white shadow-md rounded-xl border border-gray-200 p-5 flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-600 rounded-full p-3">
                    <!-- Academic Cap Icon -->
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14.25c2.485 0 4.5-.965 4.5-2.157V9.75L12 7.5 7.5 9.75v2.343c0 1.192 2.015 2.157 4.5 2.157z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14.25v3.375m0 0c-3 0-5.25-.563-5.25-1.688V13.5M12 17.625c3 0 5.25-.563 5.25-1.688V13.5" />
                    </svg>
                </div>
                <div class="w-1/2">
                    <p class="text-md text-gray-500">Total Schools</p>
                    <h3 class="text-xl font-bold text-gray-700">{{ $totalSchools }}</h3>
                </div>

                <div class="flex    justify-end w-1/3">
                    <a href="{{ url('Schools/index') }}"
                        class="text-sm text-white bg-blue-500 text-center rounded p-1 mt-5 w-20">Show</a>
                </div>
            </div>

            <!-- Total Batches -->
            <div class="bg-white shadow-md rounded-xl border border-gray-200 p-5 flex items-center space-x-4">
                <div class="bg-green-100 text-green-600 rounded-full p-3">
                    <!-- Clipboard Icon -->
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 3.75h6A2.25 2.25 0 0117.25 6v12A2.25 2.25 0 0115 20.25H9A2.25 2.25 0 016.75 18V6A2.25 2.25 0 019 3.75z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75V6h6V3.75" />
                    </svg>
                </div>
                <div class="w-1/2">
                    <p class="text-md text-gray-500">Total Batches</p>
                    <h3 class="text-xl font-bold text-gray-700">{{ $totalBatches }}</h3>
                </div>
                <div class="flex    justify-end w-1/3">
                    <a href="{{ url('Admin/DCPBatch/index') }}"
                        class="text-sm text-white bg-green-500 text-center rounded p-1 mt-5 w-20">Show</a>
                </div>
            </div>

            <!-- Total Items -->
            <div class="bg-white shadow-md rounded-xl border border-gray-200 p-5 flex items-center space-x-4">
                <div class="bg-yellow-100 text-yellow-600 rounded-full p-3">
                    <!-- Archive Box Icon -->
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v1.5a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75v-1.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 9.75h18v7.5A2.25 2.25 0 0118.75 19.5H5.25A2.25 2.25 0 013 17.25v-7.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5h6" />
                    </svg>
                </div>
                <div class="w-1/2">
                    <p class="text-md text-gray-500">Total Items</p>
                    <h3 class="text-xl font-bold text-gray-700">{{ $totalItems }}</h3>
                </div>
                <div class="flex    justify-end w-1/3">
                    <a href="{{ url('item-type') }}"
                        class="text-sm text-white bg-yellow-500 text-center rounded p-1 mt-5 w-20">Show</a>
                </div>
            </div>

            <!-- Total Packages -->
            <div class="bg-white shadow-md rounded-xl border border-gray-200 p-5 flex items-center space-x-4">
                <div class="bg-red-100 text-red-600 rounded-full p-3 ">
                    <!-- Cube Icon -->
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 16.5V7.5a2.25 2.25 0 00-1.126-1.95l-7.5-4.125a2.25 2.25 0 00-2.248 0l-7.5 4.125A2.25 2.25 0 003 7.5v9a2.25 2.25 0 001.126 1.95l7.5 4.125a2.25 2.25 0 002.248 0l7.5-4.125A2.25 2.25 0 0021 16.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 7.219l8.625 4.781 8.625-4.781" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v9" />
                    </svg>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-gray-500">Total Packages</p>
                    <h3 class="text-xl font-bold text-gray-700">{{ $totalPackages }}</h3>
                </div>
                <div class="flex    justify-end w-1/3">
                    <a href="{{ url('package-type/create') }}"
                        class="text-sm text-white bg-red-500 text-center rounded p-1 mt-5 w-20">Show</a>
                </div>
            </div>

        </div>



    </div>
    <!-- <div class="bg-white shadow-sm border-b border-gray-200">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="flex justify-between items-center py-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h2 class="text-lg font-semibold text-gray-900">Admin Dashboard   </h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="text-sm text-gray-500">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <span id="last-updated">Last updated: Jun 24, 2025 at 9:19 PM</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div> -->
@endsection

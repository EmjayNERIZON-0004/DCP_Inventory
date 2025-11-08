@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>



@section('content')
    <div class="mt-5 mx-5 bg-white shadow-md rounded-xl border border-gray-300 px-6 py-4 flex justify-between">
        <div class="w-full flex flex-col items-start justify-center">
            <div class="text-lg md:text-4xl font-bold text-gray-700 ">e-DCP Hub - Admin Panel</div>
            <div class="text-md md:text-2xl font-semibold text-gray-700 ">Welcome back, Admin</div>
            <div class="text-sm md:text-lg text-gray-500">
                <span id="current-date-time">Jun 24, 2025 at 9:19 PM</span>
                <script>
                    function updateDateTime() {
                        const now = new Date();
                        const options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric',
                            hour12: true
                        };
                        const formattedDateTime = now.toLocaleString('en-US', options);
                        document.getElementById('current-date-time').textContent = formattedDateTime;
                    }
                    updateDateTime();
                    setInterval(updateDateTime, 1000);
                </script>
            </div>
        </div>
        <div>
            <img src="{{ asset('icon/logo.png') }}" class="md:w-40 w-24" alt="">

        </div>
    </div>
    <div class="rounded-lg overflow-hidden px-6 py-2">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


            <!-- Total Schools -->
            <div class="bg-white  shadow-md rounded-xl border border-gray-300 p-5 flex flex-col items-center space-x-4">
                <div class="flex flex-row w-full gap-3">
                    <div class="bg-blue-100 text-blue-600 w-14  h-14 rounded-full p-3">
                        <!-- Academic Cap Icon -->
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21 10L12 5L3 10L6 11.6667M21 10L18 11.6667M21 10V10C21.6129 10.3064 22 10.9328 22 11.618V16.9998M6 11.6667L12 15L18 11.6667M6 11.6667V17.6667L12 21L18 17.6667L18 11.6667"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="w-full">
                        <p class="md:text-xl text-md font-normal text-gray-500">Total Number of Schools</p>
                        <h3 class="md:text-2xl text-xl font-bold text-gray-700">{{ $totalSchools }}</h3>
                    </div>
                </div>
                <div class="flex items-end   justify-end w-full h-full">
                    <a href="{{ url('Schools/index') }}"
                        class="md:text-lg text-md text-white bg-blue-500 text-center rounded p-1  w-20">Show</a>
                </div>
            </div>

            <!-- Total Batches -->
            <div class="bg-white shadow-md rounded-xl border border-gray-300 p-5 flex flex-col items-center space-x-4">
                <div class="flex flex-row w-full gap-3">
                    <div class="bg-green-100 w-14 h-14 text-green-600 rounded-full p-3">
                        <!-- Clipboard Icon -->
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M20.3873 7.1575L11.9999 12L3.60913 7.14978" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 12V21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M11 2.57735C11.6188 2.22008 12.3812 2.22008 13 2.57735L19.6603 6.42265C20.2791 6.77992 20.6603 7.44017 20.6603 8.1547V15.8453C20.6603 16.5598 20.2791 17.2201 19.6603 17.5774L13 21.4226C12.3812 21.7799 11.6188 21.7799 11 21.4226L4.33975 17.5774C3.72094 17.2201 3.33975 16.5598 3.33975 15.8453V8.1547C3.33975 7.44017 3.72094 6.77992 4.33975 6.42265L11 2.57735Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M8.5 4.5L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="w-full">
                        <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Batch Distributed</p>
                        <h3 class="md:text-2xl text-xl font-bold text-gray-700">{{ $totalBatches }}</h3>
                    </div>
                </div>
                <div class="flex justify-end items-end   h-full w-full">
                    <a href="{{ url('Admin/DCPBatch/index') }}"
                        class="md:text-lg text-md text-white bg-green-500 text-center rounded p-1  w-20">Show</a>
                </div>
            </div>

            <!-- Total Items -->
            <div class="bg-white shadow-md rounded-xl border border-gray-300 p-5 flex flex-col items-center space-x-4">
                <div class="flex flex-row w-full gap-3 ">
                    <div class="bg-yellow-100  w-14 h-14 text-yellow-600 rounded-full p-3">
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
                    <div class="w-full">
                        <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Items</p>
                        <h3 class="md:text-2xl text-xl font-bold text-gray-700">{{ $totalItems }}</h3>
                    </div>
                </div>
                <div class="flex justify-end items-end   h-full w-full">
                    <a href="{{ url('item-type') }}"
                        class="md:text-lg text-md text-white bg-yellow-500 text-center rounded p-1   w-20">Show</a>
                </div>
            </div>

            <!-- Total Packages -->
            <div class="bg-white shadow-md rounded-xl border border-gray-300 p-5 flex flex-col items-center space-x-4">
                <div class="flex flex-row w-full gap-3">
                    <div class="bg-red-100 text-red-600 w-14 h-14 rounded-full p-3 ">
                        <!-- Cube Icon -->
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 16.5V7.5a2.25 2.25 0 00-1.126-1.95l-7.5-4.125a2.25 2.25 0 00-2.248 0l-7.5 4.125A2.25 2.25 0 003 7.5v9a2.25 2.25 0 001.126 1.95l7.5 4.125a2.25 2.25 0 002.248 0l7.5-4.125A2.25 2.25 0 0021 16.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.375 7.219l8.625 4.781 8.625-4.781" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v9" />
                        </svg>
                    </div>
                    <div class="w-full">
                        <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Package </p>
                        <h3 class="md:text-2xl text-xl font-bold text-gray-700">{{ $totalPackages }}</h3>
                    </div>
                </div>
                <div class="flex    justify-end w-full h-full items-end">
                    <a href="{{ url('package-type/create') }}"
                        class="md:text-lg text-md text-white bg-red-500 text-center rounded p-1   w-20">Show</a>
                </div>
            </div>

        </div>



    </div>
    {{-- <div class="mx-5 my-1 bg-white border border-gray-300 shadow-xl rounded-lg overflow-hidden p-6">

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
            <style>
                @keyframes float {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-10px);
                    }
                }

                .animate-float {
                    animation: float 2.5s ease-in-out infinite;
                }
            </style>

            <img src="{{ asset('icon/logo-dcpinventory.jpg') }}" alt="DCP Logo"
                class="rounded-full border-2 border-blue-600 shadow-lg animate-float" width="200" height="200">

        </div>

    </div> --}}

    <!-- Card Container -->
    <div class="md:text-2xl text-lg font-semibold text-gray-800 mx-5 my-2 mt-5">DCP Batch Items Summary</div>
    <div class="grid grid-cols-1 md:grid-cols-2   ">
        <div id="card-condition-container" class="flex flex-col  md:gap-2 gap-2 mx-5    ">

            {{-- <div id="card-1"
                class="max-w-full flex flex-row justify-between mx-auto bg-green-100 w-full border border-gray-300 rounded-sm shadow-md p-3 text-center
                transform scale-100 hover:scale-105 transition duration-300 ease-in-out
                ">
                <div class="flex flex-row items-center gap-2">
                    <svg viewBox="0 0 20 20" class="text-green-800 md:h-8 md:w-8 w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg" fill="none">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M3 10a7 7 0 019.307-6.611 1 1 0 00.658-1.889 9 9 0 105.98 7.501 1 1 0 00-1.988.22A7 7 0 113 10zm14.75-5.338a1 1 0 00-1.5-1.324l-6.435 7.28-3.183-2.593a1 1 0 00-1.264 1.55l3.929 3.2a1 1 0 001.38-.113l7.072-8z">
                            </path>
                        </g>
                    </svg>
                    <div class="md:text-xl text-md  font-semibold text-gray-800">Good </div>
                </div>
                <div class="md:text-lg text-md font-semibold  text-gray-800">

                    <span class="total  font-semibold mt-2   ">0</span>/<span class="overall  ">0

                    </span>
                    ( <span class="percentage   font-semibold  mt-3">0%</span> )


                </div>

            </div>

            <div id="card-2"
                class="max-w-full mx-auto w-full flex flex-row justify-between  bg-yellow-100 rounded-sm border border-gray-300 shadow-md p-4 text-center transform scale-100 hover:scale-105 transition duration-300 ease-in-out">
                <div class="flex flex-row gap-2 justify-center items-center">

                    <div>
                        <svg version="1.1" id="svg2" class="md:h-8 md:w-8 h-6 w-6 text-yellow-800"
                            xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"
                            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg"
                            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" sodipodi:docname="wrench.svg"
                            inkscape:version="0.48.4 r9939" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1200 1200"
                            enable-background="new 0 0 1200 1200" xml:space="preserve" fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path id="path26345" inkscape:connector-curvature="0"
                                    d="M984.091,19.305C868.695-22.216,734.617,3.236,642.153,95.7 c-92.463,92.463-117.916,226.542-76.396,341.937L0,1003.396L196.604,1200l565.759-565.76 c115.396,41.521,249.474,16.068,341.937-76.396c92.464-92.463,117.917-226.542,76.396-341.937L981.742,414.861l-141.708-54.896 l-54.896-141.708L984.091,19.305z M236.18,963.82c22.563,22.562,22.563,59.143,0,81.705c-22.562,22.562-59.143,22.562-81.705,0 c-22.563-22.563-22.563-59.144,0-81.705C177.037,941.258,213.618,941.258,236.18,963.82z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="md:text-xl text-md font-semibold text-gray-800">Need Repair </div>

                </div>
                <div class="md:text-lg text-md font-semibold text-gray-800 ">

                    <span class="total mt-2 ">0</span>/<span class="overall ">0

                    </span>
                    ( <span class="percentage  font-semibold   mt-3">0%</span> )


                </div>
            </div>

            <div id="card-3"
                class="max-w-full mx-auto w-full flex flex-row justify-between bg-blue-100 rounded-sm border border-gray-300 shadow-md p-4 text-center transform scale-100 hover:scale-105 transition duration-300 ease-in-out">
                <div class="flex flex-row gap-2 items-center">
                    <svg viewBox="0 0 24 24" class="text-gray-800 md:h-8 md:w-8 h-6 w-6" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.50001 6.00391L7.50007 18.0039H8.91786L17.9999 12.7771V11.2229L8.91787 6.00391H7.50001ZM16.3459 12L9.00006 16.2244L9.00003 7.78339L16.3459 12Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                    <div class="md:text-xl text-md font-semibold text-gray-800">Fair</div>
                </div>
                <div class="md:text-lg text-md text-gray-800  text-md font-semibold">

                    <span class="total mt-2   ">0</span>/<span class="overall  ">0

                    </span>
                    ( <span class="percentage font-semibold   mt-3">0%</span> )


                </div>
            </div>

            <div id="card-4"
                class="max-w-full w-full flex flex-row justify-between mx-auto bg-red-100 rounded-sm border border-gray-300 shadow-md p-4 text-center transform scale-100 hover:scale-105 transition duration-300 ease-in-out">

                <div class="flex flex-row gap-2 items-center">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 md:h-8 md:w-8 text-red-800"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill-rule="nonzero"
                                    d="M19 9h-5V4H5v7.857l1.5 1.393L10 9.5l3 5 2-2.5 3 3-3-.5-2 2.5-3-4-3 3.5-2-1.25V20h14V9zm2-1v12.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.449 2 4.002 2h10.995L21 8z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="md:text-xl text-md font-semibold text-gray-800">Damaged</div>
                </div>
                <div class="md:text-lg text-md  text-gray-800 font-semibold">

                    <span class="total mt-2   ">0</span>/<span class="overall ">0

                    </span>
                    ( <span class="percentage  font-semibold mt-3">0%</span> )


                </div>
            </div>

            <div id="card-5"
                class="max-w-full w-full flex flex-row justify-between mx-auto bg-indigo-100 rounded-sm border border-gray-300 shadow-md p-4 text-center transform scale-100 hover:scale-105 transition duration-300 ease-in-out">


                <div class="flex flex-row gap-2 items-center">
                    <svg fill="currentColor" class="w-6 h-6 md:h-8 md:w-8 text-indigo-800" viewBox="-6.7 0 122.88 122.88"
                        version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 109.48 122.88"
                        xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill-rule: evenodd;
                                    clip-rule: evenodd;
                                }
                            </style>
                            <g>
                                <path class="st0"
                                    d="M2.35,9.63h38.3V3.76C40.64,1.69,42.33,0,44.4,0h21.14c2.07,0,3.76,1.69,3.76,3.76v5.87h37.83 c1.29,0,2.35,1.06,2.35,2.35V23.5H0V11.98C0,10.69,1.05,9.63,2.35,9.63L2.35,9.63z M8.69,29.61h92.92c1.94,0,3.7,1.6,3.52,3.52 l-7.86,86.23c-0.18,1.93-1.59,3.52-3.52,3.52l-77.3,0c-1.93,0-3.35-1.59-3.52-3.52L5.17,33.13C4.99,31.2,6.75,29.61,8.69,29.61 L8.69,29.61L8.69,29.61z M33.93,95.11l-6.16-10.59c-1.11-1.92-1.53-3.42-0.6-5.64l3.62-6.09l-3.63-1.95l12.17-0.05l6.07,10.61 l-3.75-2.15l-6.08,10.78c-0.58,1.02-1.06,1.8-1.35,2.96C34.05,93.7,33.96,94.41,33.93,95.11L33.93,95.11z M36.38,62.36l5.86-10.2 c1.65-2.05,3.7-2.79,5.65-2.24c1.68,0.48,2.15,1.23,3.04,2.6c1.07,1.63,2,3.37,2.98,5.08l-6.55,11.26L36.38,62.36L36.38,62.36z M49.71,48.43l12.26-0.04c2.22-0.01,3.73,0.39,5.18,2.3l3.46,6.18l3.51-2.17l-6.04,10.56l-12.23-0.05l3.74-2.17l-6.3-10.66 c-0.6-1.01-1.03-1.81-1.89-2.65C50.88,49.23,50.31,48.81,49.71,48.43L49.71,48.43z M76.4,67.42l5.9,10.17 c0.95,2.45,0.57,4.6-0.89,6.01c-1.25,1.22-2.14,1.24-3.77,1.34c-1.95,0.11-3.92,0.05-5.89,0.04l-6.47-11.3L76.4,67.42L76.4,67.42z M81.8,85.93l-6.09,10.64c-1.1,1.92-2.2,3.03-4.58,3.34l-7.08-0.09l0.12,4.12l-6.13-10.52l6.15-10.56l0.01,4.32l12.38-0.12 c1.17-0.01,2.09,0.01,3.24-0.31C80.52,86.54,81.17,86.26,81.8,85.93L81.8,85.93z M52.67,99.7l-11.76,0.02 c-2.6-0.4-4.27-1.81-4.77-3.77c-0.43-1.69-0.01-2.48,0.73-3.94c0.88-1.74,1.92-3.42,2.91-5.12l13.02,0.05L52.67,99.7L52.67,99.7z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="md:text-xl text-md font-semibold text-gray-800">For Disposal </div>
                </div>
                <div class="md:text-lg  text-md text-gray-800 font-semibold">

                    <span class="total mt-2  ">0</span>/<span class="overall  ">0

                    </span>
                    ( <span class="percentage font-semibold mt-3">0%</span> )


                </div>

            </div>
            <div id="card-6"
                class="max-w-full w-full flex flex-row justify-between mx-auto bg-gray-100 rounded-sm border border-gray-300 shadow-md p-4 text-center transform scale-100 hover:scale-105 transition duration-300 ease-in-out">


                <div class="flex flex-row gap-2 items-center">
                    <svg class="w-6 h-6 md:h-8 md:w-8 text-gray-800" version="1.1" id="_x32_"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 512 512" xml:space="preserve" fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">

                            <g>
                                <path class="st0" fill="currentColor"
                                    d="M396.138,85.295c-13.172-25.037-33.795-45.898-59.342-61.03C311.26,9.2,280.435,0.001,246.98,0.001 c-41.238-0.102-75.5,10.642-101.359,25.521c-25.962,14.826-37.156,32.088-37.156,32.088c-4.363,3.786-6.824,9.294-6.721,15.056 c0.118,5.77,2.775,11.186,7.273,14.784l35.933,28.78c7.324,5.864,17.806,5.644,24.875-0.518c0,0,4.414-7.978,18.247-15.88 c13.91-7.85,31.945-14.173,58.908-14.258c23.517-0.051,44.022,8.725,58.016,20.717c6.952,5.941,12.145,12.594,15.328,18.68 c3.208,6.136,4.379,11.5,4.363,15.574c-0.068,13.766-2.742,22.77-6.603,30.442c-2.945,5.729-6.789,10.813-11.738,15.744 c-7.384,7.384-17.398,14.207-28.634,20.479c-11.245,6.348-23.365,11.932-35.612,18.68c-13.978,7.74-28.77,18.858-39.701,35.544 c-5.449,8.249-9.71,17.686-12.416,27.641c-2.742,9.964-3.98,20.412-3.98,31.071c0,11.372,0,20.708,0,20.708 c0,10.719,8.69,19.41,19.41,19.41h46.762c10.719,0,19.41-8.691,19.41-19.41c0,0,0-9.336,0-20.708c0-4.107,0.467-6.755,0.917-8.436 c0.773-2.512,1.206-3.14,2.47-4.668c1.29-1.452,3.895-3.674,8.698-6.331c7.019-3.946,18.298-9.276,31.07-16.176 c19.121-10.456,42.367-24.646,61.972-48.062c9.752-11.686,18.374-25.758,24.323-41.968c6.001-16.21,9.242-34.431,9.226-53.96 C410.243,120.761,404.879,101.971,396.138,85.295z">
                                </path>
                                <path class="st0" fill="currentColor"
                                    d="M228.809,406.44c-29.152,0-52.788,23.644-52.788,52.788c0,29.136,23.637,52.772,52.788,52.772 c29.136,0,52.763-23.636,52.763-52.772C281.572,430.084,257.945,406.44,228.809,406.44z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="md:text-xl text-md font-semibold text-gray-800">Missing</div>
                </div>
                <div class="md:text-lg text-md text-gray-800 font-semibold">

                    <span class="total mt-2  ">0</span>/<span class="overall  ">0

                    </span>
                    ( <span class="percentage  font-semibold mt-3">0%</span> )


                </div>

            </div> --}}

            <!-- Chart container -->

        </div>
        <div class="px-5">

            <div
                class="w-full border border-gray-300 col-span-5   border border-gray-300  bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Item Condition Totals</h2>
                <canvas id="conditionChart" class="w-full  "></canvas>
            </div>
        </div>
    </div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let totals = [];
        let labels = [];
        const bgColors = [
            "bg-green-100", // green-100
            "bg-yellow-100", // yellow-100
            "bg-gray-100", // gray-100
            "bg-red-100", // red-100
            "bg-indigo-100", // indigo-100
            "bg-gray-100", // gray-200
        ];
        // Fetch all 5 conditions
        fetch("api/item-conditions")
            .then(res => res.json())
            .then(results => {
                results.forEach((data, index) => {
                    totals.push(data.count); // only use total_count
                    labels.push(data.condition); // only use total_count
                    const newCard = document.createElement("div");
                    newCard.id = `card-${index + 1}`;
                    newCard.onclick = () => {
                        toggleCard(data.id);
                    }
                    newCard.className =
                        `max-w-full flex flex-row justify-between mx-auto ${bgColors[data.id-1]} w-full border border-gray-500 rounded-sm shadow-md p-3 text-center transform scale-100 hover:scale-105 transition duration-300 ease-in-out`;
                    newCard.innerHTML = `
                        <div class="md:text-lg text-md font-semibold text-gray-800">${data.condition}</div>
                        <div class="md:text-lg text-md text-gray-800 font-semibold">
                            <span class="total mt-2">${data.count}</span>
                        
                            </div>
                    `;

                    document.getElementById("card-condition-container").appendChild(newCard);
                });
                console.log(totals);
                const ctx = document.getElementById("conditionChart").getContext("2d");
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total Count",
                            data: totals,
                            backgroundColor: [
                                "#fef3c7", // yellow-100
                                "#d1fae5", // green-100
                                "#dbeafe", // gray-100
                                "#fee2e2", // red-100
                                "#e0e7ff", // indigo-100
                                "#f3f4f6", // gray-200
                            ],

                            borderColor: "rgba(0,0,0,0.5)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching data:", error));

        function toggleCard(cardId) {
            console.log(cardId);
            window.location.href = `/Admin/ItemConditions/${cardId}`
        }
    </script>
    <div class="md:text-2xl text-lg font-semibold text-gray-800 mx-5 my-2 mt-5">School Equipments Summary</div>
    <div class="grid grid-cols-1 md:grid-cols-4 md:gap-6 gap-2 mx-5 my-2 ">
        <!-- Total Schools Card -->
        <div class="bg-white rounded-sm border border-gray-300 shadow-md p-4 text-center">
            <h2 class="md:text-2xl  text-md font-semibold text-gray-700">Total Number of Schools</h2>
            <p id="total_schools" class="md:text-4xl text-2xl font-bold text-purple-600 mt-3">--</p>
        </div>
        <!-- ISP Card -->
        <div class="bg-white rounded-sm shadow-md p-4 border border-gray-300 text-center">
            <h2 class="md:text-2xl  text-md font-semibold text-gray-700">Total Number of Schools with Internet Service
                Provider</h2>
            <p id="isp_count" class="md:text-4xl text-2xl font-bold text-blue-600 mt-3">--</p>
        </div>

        <!-- Biometric Card -->
        <div class="bg-white rounded-sm shadow-md p-4 border border-gray-300 text-center">
            <h2 class="md:text-2xl  text-md font-semibold text-gray-700">Total Number of Schools with Biometrics</h2>
            <p id="biometric_count" class="md:text-4xl text-2xl font-bold text-green-600 mt-3">--</p>
        </div>

        <!-- CCTV Card -->
        <div class="bg-white rounded-sm shadow-md border border-gray-300 p-4 text-center">
            <h2 class="md:text-2xl  text-md font-semibold text-gray-700">Total Number of Schools with CCTV</h2>
            <p id="cctv_count" class="md:text-4xl text-2xl  font-bold text-red-500 mt-3">--</p>
        </div>

    </div>
    <script>
        fetch('/Admin/api/count-equipment')
            .then(response => response.json())
            .then(data => {
                document.getElementById("cctv_count").textContent = `${data.cctv_count}`;
                document.getElementById("biometric_count").textContent = `${data.biometric_count}`;
                document.getElementById("isp_count").textContent = `${data.isp_count}`;
                document.getElementById("total_schools").textContent = `${data.total_schools}`;
            })
            .catch(error => console.error('Error fetching data:', error));



        // Loop through each endpoint and fetch data
        // apiUrls.forEach((url, index) => {
        //     fetch(url)
        //         .then(response => response.json())
        //         .then(data => {
        //             const card = document.getElementById(`card-${index + 1}`);
        //             if (card) {
        //                 card.querySelector(".total").textContent = `${data.total_count}`;
        //                 card.querySelector(".overall").textContent = `${data.overall_count}`;
        //                 card.querySelector(".percentage").textContent = `${data.percentage}%`;
        //             }
        //         })
        //         .catch(error => console.error(`Error fetching ${url}:`, error));
        // });
    </script>


    <div class="space-y-5 mx-5 my-5">

        <!-- Folder 1 -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md">
            <button
                class="folder-btn flex
                    md:text-xl text-md font-medium font-[Verdana]

                justify-between items-center w-full text-left bg-blue-600 text-white px-5 py-3 rounded-t-lg"
                data-target="folder-item-type">
                DCP BATCH ITEM CLASSIFICATION - DISTRIBUTION
                <span class="arrow">▶</span>
            </button>

            <div id="folder-item-type" class="folder-content hidden border-t border-gray-300 p-6">
                <div class="flex md:flex-row flex-col gap-4">
                    <div class="w-full">
                        <div class="h-[400px]"><canvas id="myPieChart"></canvas></div>
                    </div>
                    <div class="w-full">
                        <table class="border-collapse w-full table-auto">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300">Item Type</th>
                                    <th class="px-4 py-2 border border-gray-300">Count</th>
                                </tr>
                            </thead>
                            <tbody id="item-type-table"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Folder 2 -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md">
            <button
                class="folder-btn flex justify-between
                 items-center w-full text-left 
                    md:text-xl text-md font-medium font-[Verdana]
                 
                 bg-blue-600 text-white px-5 py-3 rounded-t-lg"
                data-target="folder-package">
                MOST PACKAGE ASSIGN TO SCHOOLS
                <span class="arrow">▶</span>
            </button>

            <div id="folder-package" class="folder-content hidden border-t border-gray-300 p-6">
                <div class="flex md:flex-row flex-col gap-4">
                    <div class="w-full">
                        <div class="h-[400px]"><canvas id="pie_package"></canvas></div>
                    </div>
                    <div class="overflow-y-auto shadow-md w-full">
                        <table class="border-collapse w-full">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-300">Package Code</th>
                                    <th class="px-4 py-2 border border-gray-300">Package Name</th>
                                    <th class="px-4 py-2 border border-gray-300">Total Package Acquired</th>
                                </tr>
                            </thead>
                            <tbody id="package-type-table"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Folder 3 -->
        <div class="bg-white border border-gray-300 rounded-lg shadow-md">
            <button
                class="folder-btn flex justify-between items-center w-full text-left 
                    md:text-xl text-md font-medium font-[Verdana]
                bg-blue-600 text-white px-5 py-3 rounded-t-lg"
                data-target="folder-school">
                SCHOOL DCP BATCH DISTRIBUTION
                <span class="arrow">▶</span>
            </button>

            <div id="folder-school" class="folder-content hidden border-t border-gray-300 p-6">
                <div class="h-[400px] overflow-y-auto">
                    <canvas id="school_pie"></canvas>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.querySelectorAll('.folder-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.dataset.target;
                const target = document.getElementById(targetId);
                const arrow = btn.querySelector('.arrow');
                const isHidden = target.classList.contains('hidden');

                // Close others
                document.querySelectorAll('.folder-content').forEach(c => c.classList.add('hidden'));
                document.querySelectorAll('.arrow').forEach(a => a.textContent = '▶');

                // Open selected
                if (isHidden) {
                    target.classList.remove('hidden');
                    arrow.textContent = '▼';
                    // Initialize charts once
                    setTimeout(() => {
                        if (targetId === 'folder-item-type' && !window.itemTypeChartLoadedOnce) {
                            window.itemTypeChartLoadedOnce = true;
                            itemTypeChartLoaded();
                        }
                        if (targetId === 'folder-package' && !window.packageChartLoadedOnce) {
                            window.packageChartLoadedOnce = true;
                            packageChartLoaded();
                        }
                        if (targetId === 'folder-school' && !window.schoolChartLoadedOnce) {
                            window.schoolChartLoadedOnce = true;
                            schoolChartLoaded();
                        }
                    }, 150);
                }
            });
        });
    </script>





    <script>
        function itemTypeChartLoaded() {
            fetch('api/item-categories')
                .then(response => response.json())
                .then(data => {
                    data.sort((a, b) => b.total - a.total);

                    const labels = data.map(item => item.dcp_item_type.code);
                    const counts = data.map(item => item.total);

                    // ✅ Define your bar colors once
                    const colors = [
                        "#fca5a5", // red-300
                        "#fde047", // yellow-300
                        "#86efac", // green-300
                        "#93c5fd", // blue-300
                        "#c4b5fd", // purple-300
                        "#fcd34d", // amber-300
                        "#f9a8d4", // pink-300
                        "#67e8f9", // cyan-300
                    ];

                    let rows = '';
                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            const color = colors[index % colors.length]; // cycle colors if more items
                            rows += `
                        <tr>
                            <td class="px-4 py-1 border border-gray-300 break-words" style="max-width: 300px>${item.dcp_item_type.code}</td>
                            <td class="px-4 py-1 border border-gray-300">${item.dcp_item_type.name}</td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-semibold" 
                                style="background-color: ${color}; color: #000;">
                                ${item.total}
                            </td>
                        </tr>
                    `;
                        });
                    } else {
                        rows += `
                    <tr>
                        <td colspan="3" class="px-4 py-1 border border-gray-300 text-center font-semibold">
                            No Data Found
                        </td>
                    </tr>
                `;
                    }

                    document.getElementById('item-type-table').innerHTML = rows;

                    // Create Bar Chart
                    // Get canvas and parent container
                    const canvas = document.getElementById("myPieChart");
                    const parentDiv = canvas.parentElement;

                    // Dynamic height based on data length
                    parentDiv.style.height = `${labels.length * 40}px`;

                    // Get 2D context
                    const ctx = canvas.getContext("2d");

                    // Initialize Chart.js
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Items Count",
                                data: counts,
                                // Map colors dynamically to match labels length
                                backgroundColor: labels.map((_, i) => colors[i % colors.length]),
                                borderColor: "#4b5563",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false, // fill parent container
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Items Count per Category'
                                },
                                datalabels: {
                                    anchor: 'end',
                                    align: 'right',
                                    color: '#000',
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    },
                                    formatter: v => v
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Items'
                                    },
                                    ticks: {
                                        precision: 0
                                    }
                                },
                                y: {
                                    ticks: {
                                        autoSkip: false
                                    },
                                    title: {
                                        display: true,
                                        text: 'Item Category'
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });

                })
                .catch(error => console.error('Error fetching data:', error));
        }
    </script>

    <script>
        function packageChartLoaded() {
            fetch('api/package-categories')
                .then(response => response.json())
                .then(data => {
                    data.sort((a, b) => b.total - a.total);

                    const labels = data.map(item => item.dcp_package_type.code);
                    const counts = data.map(item => item.total);

                    // ✅ Define bar colors (same used in chart)
                    const colors = [
                        "#fca5a5", // red-300
                        "#fde047", // yellow-300
                        "#86efac", // green-300
                        "#93c5fd", // blue-300
                        "#c4b5fd", // purple-300
                        "#fcd34d", // amber-300
                        "#f9a8d4", // pink-300
                        "#67e8f9", // cyan-300
                    ];

                    let rows = '';
                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            const color = colors[index % colors.length]; // cycle colors if needed
                            rows += `
                        <tr>
                            <td class="px-4 py-1 border border-gray-300">${item.dcp_package_type.code}</td>
                            <td class="px-4 py-1 border border-gray-300">${item.dcp_package_type.name}</td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-semibold"
                                style="background-color: ${color}; color: #000;">
                                ${item.total}
                            </td>
                        </tr>
                    `;
                        });
                    } else {
                        rows += `
                    <tr>
                        <td colspan="3" class="px-4 py-1 border border-gray-300 text-center font-semibold">
                            No Data Found
                        </td>
                    </tr>
                `;
                    }

                    // 🧱 Update table content
                    document.getElementById('package-type-table').innerHTML = rows;

                    // 🎨 Setup canvas + chart
                    const canvas = document.getElementById("pie_package");

                    const parentDiv = canvas.parentElement;

                    // Dynamic height based on data length
                    parentDiv.style.height = `${labels.length * 40}px`;

                    const ctx = canvas.getContext("2d");

                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Total Package Acquired",
                                data: counts,
                                backgroundColor: colors,
                                borderColor: "#4b5563",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Total Package Acquired per Category'
                                },
                                datalabels: {
                                    anchor: 'end',
                                    align: 'right',
                                    color: '#000',
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    },
                                    formatter: value => value
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Packages'
                                    },
                                    ticks: {
                                        precision: 0
                                    }
                                },
                                y: {
                                    ticks: {
                                        autoSkip: false
                                    },
                                    title: {
                                        display: true,
                                        text: 'Package Type'
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    </script>




    <script>
        function schoolChartLoaded() {
            fetch('api/school-categories')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.school.SchoolName);
                    const counts = data.map(item => item.total);
                    let rows = '';
                    data.sort((a, b) => b.total - a.total);



                    const canvas = document.getElementById("school_pie");
                    const parentDiv = canvas.parentElement;

                    // Dynamic height based on data length
                    parentDiv.style.height = `${labels.length * 40}px`;


                    const ctx = canvas.getContext("2d");

                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Total DCP Batch Received",
                                data: counts,
                                backgroundColor: [
                                    "#fca5a5", "#fde047", "#86efac", "#93c5fd",
                                    "#c4b5fd", "#fcd34d", "#f9a8d4", "#67e8f9"
                                ],
                                borderColor: "#4b5563",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: 'y', // Horizontal bar chart
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Total DCP Batch Received per School'
                                },
                                datalabels: { // 👇 Show count value on each bar
                                    anchor: 'end',
                                    align: 'right',
                                    color: '#000',
                                    font: {
                                        weight: 'bold'
                                    },
                                    formatter: function(value) {
                                        return value;
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                },
                                y: {
                                    ticks: {
                                        autoSkip: false // 🔹 Ensures all labels show
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels] // ✅ Enable datalabels plugin
                    });

                })
                .catch(error => console.error('Error fetching data:', error));

        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
@endsection

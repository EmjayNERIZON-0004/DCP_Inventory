@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>



@section('content')
    {{-- <div class="mt-5 mx-5 bg-white shadow-md rounded-xl border border-gray-300 px-6 py-4 flex justify-between">
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
    </div> --}}
    <div class="p-2 md:mx-5 md:my-5 mx-0 my-0">
        <div class="rounded-lg overflow-hidden  py-2">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mb-4">

                <!-- Total Schools -->
                <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-row w-full gap-4">

                        <div
                            class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">
                            <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center">
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 10L12 5L3 10L12 15L21 10Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M6 11.5V17.5L12 21L18 17.5V11.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21 10V17" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>

                        <div class="w-full">
                            <p class="md:text-xl text-md font-normal text-gray-500">Total Number of Schools</p>
                            <h3 class="md:text-3xl text-2xl font-bold text-gray-700">{{ $totalSchools }}</h3>
                        </div>

                        <div class="flex justify-end items-center mt-5">
                            <a href="{{ url('Schools/index') }}"
                                class="md:text-lg text-md  shadow-md text-white bg-blue-600 text-center rounded p-2 w-24">
                                Schools
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Batches -->
                <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-row w-full gap-4">
                        <div
                            class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">
                            <div class="bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center">
                                <!-- Clipboard Icon -->
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 12V21" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 8L12 12L4 8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11 2.6L19 7C20 7.6 20 8 20 9V16C20 17 20 17.6 19 18L12 22L5 18C4 17.6 4 17 4 16V9C4 8 4 7.6 5 7L11 2.6Z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Batch Distributed</p>
                            <h3 class="md:text-3xl text-2xl font-bold text-gray-700">{{ $totalBatches }}</h3>
                        </div>

                        <div class="flex justify-end items-center mt-5">
                            <a href="{{ url('Admin/DCPBatch/index') }}"
                                class="md:text-lg text-md   shadow-md  text-white bg-green-600 text-center rounded p-2 w-24">
                                Batches
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Items -->
                <div class="bg-white shadow-md rounded-md   border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-row w-full gap-4">
                        <div
                            class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">

                            <div class="bg-yellow-500 text-white w-16 h-16 rounded-full flex items-center justify-center">
                                <!-- Archive Icon -->
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 7H21V10H3V7Z" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5 10H19V18C19 19 18 20 17 20H7C6 20 5 19 5 18V10Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 14H15" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Items</p>
                            <h3 class="md:text-3xl text-2xl font-bold text-gray-700">{{ $totalItems }}</h3>
                        </div>

                        <div class="flex justify-end items-center mt-5">
                            <a href="{{ url('item-type') }}"
                                class="md:text-lg text-md   shadow-md  text-white bg-yellow-500 text-center rounded p-2 w-24">
                                Items
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                    <div class="flex flex-row w-full gap-4">
                        <div
                            class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">

                            <div class="bg-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center">
                                <!-- Cube Icon -->
                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 3L3 8V16L12 21L21 16V8L12 3Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M3.5 7.8L12 12.5L20.5 7.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 12.5V21" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Package</p>
                            <h3 class="md:text-3xl text-2xl font-bold text-gray-700">{{ $totalPackages }}</h3>
                        </div>

                        <div class="flex justify-end items-center mt-5">
                            <a href="{{ url('package-type/create') }}"
                                class="md:text-lg text-md   shadow-md  text-white bg-red-600 text-center rounded p-2 w-24">
                                Packages
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div style="letter-spacing: 0.05rem" class="md:text-xl text-lg font-semibold text-gray-800  my-2 mt-5">School
            Equipments Summary</div>
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-2 gap-2   my-2 ">
            <!-- Total Schools Card -->
            <div class="bg-white rounded-sm border border-gray-300 shadow-md p-1 text-center">
                <div class="bg-blue-600 h-full text-white p-4 text-center">

                    <h2 class="md:text-2xl  text-md font-semibold  ">Total Number of Schools</h2>
                    <p id="total_schools" class="md:text-4xl text-2xl font-bold mt-3">--</p>
                </div>
            </div>
            <!-- ISP Card -->
            <div class="bg-white rounded-sm shadow-md p-1 border border-gray-300 text-center">
                <div style="background-color:#F7931E;" class="  h-full text-white p-4 text-center">

                    <h2 class="md:text-2xl  text-md font-semibold  ">Total Number of Schools with Internet Service
                        Provider</h2>
                    <p id="isp_count" class="md:text-4xl text-2xl font-bold  mt-3">--</p>
                </div>
            </div>

            <!-- Biometric Card -->
            <div class="bg-white rounded-sm shadow-md p-1 border border-gray-300 text-center">
                <div style="background-color:#8DC63F;" class="  h-full text-white p-4 text-center">

                    <h2 class="md:text-2xl  text-md font-semibold  ">Total Number of Schools with Biometrics</h2>
                    <p id="biometric_count" class="md:text-4xl text-2xl font-bold  mt-3">--</p>
                </div>
            </div>
            <!-- CCTV Card -->
            <div class="bg-white rounded-sm shadow-md border border-gray-300 p-1 text-center">
                <div style="background-color:#4CAF50;" class="  h-full text-white p-4 text-center">

                    <h2 class="md:text-2xl  text-md font-semibold ">Total Number of Schools with CCTV</h2>
                    <p id="cctv_count" class="md:text-4xl text-2xl  font-bold  mt-3">--</p>
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
        <div style="letter-spacing: 0.05rem" class="md:text-xl text-lg font-semibold text-gray-800 my-2 mt-5">DCP Batch
            Items Summary</div>
        <div class="grid grid-cols-1     ">
            <div id="card-condition-container" class="grid md:grid-cols-3 grid-cols-2 md:gap-4 gap-2 mb-2    ">

            </div>
            <table class="w-full bg-white  border-collapse border border-gray-300 mt-3" style="letter-spacing: 0.05rem">
                <thead class="bg-white">
                    <tr>
                        <th class="px-4 py-3 border uppercase">Condition</th>
                        <th class="px-4 py-3 border uppercase">Count</th>
                        <th class="px-4 py-3 border uppercase">Visualization</th>
                    </tr>
                </thead>
                <tbody id="condition-table"></tbody>
            </table>

            <style>
                .progress-container {
                    width: 100%;
                    background: #e5e7eb;
                    /* gray-300 */
                    border-radius: 6px;
                    height: 20px;
                    overflow: hidden;
                }

                .progress-bar {
                    height: 100%;
                    border-radius: 6px;
                    transition: width 0.4s ease;
                }
            </style>
        </div>


        <style>
            .tab-active {
                background-color: #1D4ED8;
                /* bg-blue-700 */
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                /* text-white */
                color: white;
                /* scale-105 */
                /* shadow-md */
                transition: all 0.2s ease;
                /* smooth animation */
            }

            .tab-inactive {
                background-color: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                /* bg-blue-600 */
                color: black;
                /* text-white */
                opacity: 0.95;
                /* opacity-95 */
                transition: all 0.2s ease;
                /* smooth animation */
            }

            .tab-btn:hover {
                scale: 1.05;
                /* hover:bg-blue-500 */
            }
        </style>


        <div class="space-y-5 my-5">

            <!-- TAB BUTTONS -->
            <div class="flex gap-3 mb-4" style="letter-spacing: 0.05rem">
                <button id="btn-item" class="tab-btn tab-active px-5 py-2 rounded-md  font-medium text-md">
                    DCP Product
                </button>

                <button id="btn-package" class="tab-btn tab-inactive px-5 py-2 rounded-md   font-medium  text-md">
                    DCP Package to School
                </button>

                <button id="btn-school" class="tab-btn tab-inactive px-5 py-2 rounded-md  font-medium  text-md">
                    DCP Batch to School
                </button>
            </div>

            <!-- TAB CONTENT 1 -->
            <div id="tab-item" class="tab-content">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="flex md:flex-row flex-col gap-4">
                        <div class="w-full">
                            <div class="h-[400px]"><canvas id="myPieChart"></canvas></div>
                        </div>
                        <div class="w-full">
                            <table class="border-collapse w-full table-auto" style="letter-spacing:0.05rem">
                                <thead class="bg-white sticky top-0">
                                    <tr>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Item Type</th>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Count</th>
                                    </tr>
                                </thead>
                                <tbody id="item-type-table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 2 -->
            <div id="tab-package" class="tab-content hidden">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="flex md:flex-row flex-col gap-4">
                        <div class="w-full">
                            <div class="h-[400px]"><canvas id="pie_package"></canvas></div>
                        </div>
                        <div class="overflow-y-auto shadow-md w-full">
                            <table class="border-collapse w-full" style="letter-spacing:0.05rem">
                                <thead class="bg-white sticky top-0">
                                    <tr>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Package Code</th>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Package Name</th>
                                        <th class="px-4 py-2 border border-gray-300 uppercase">Total Package Acquired</th>
                                    </tr>
                                </thead>
                                <tbody id="package-type-table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 3 -->
            <div id="tab-school" class="tab-content hidden">
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <div class="h-[400px] overflow-y-auto">
                        <canvas id="school_pie"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <!-- SIMPLE TAB JS -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                const tabs = {
                    "btn-item": "tab-item",
                    "btn-package": "tab-package",
                    "btn-school": "tab-school"
                };

                Object.keys(tabs).forEach(btnId => {
                    document.getElementById(btnId).addEventListener("click", () => {

                        // Hide all contents
                        document.querySelectorAll(".tab-content").forEach(div => {
                            div.classList.add("hidden");
                        });

                        // Reset button styles
                        document.querySelectorAll(".tab-btn").forEach(btn => {
                            btn.classList.remove("tab-active");
                            btn.classList.add("tab-inactive");
                        });

                        // Show selected content
                        document.getElementById(tabs[btnId]).classList.remove("hidden");

                        // Highlight clicked button
                        const button = document.getElementById(btnId);
                        button.classList.add("tab-active");
                        button.classList.remove("tab-inactive");
                    });
                });

            });
        </script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let totals = [];
        let labels = [];
        const bgColors = [
            "#16A34A", // green
            "#DC2626", // red
            "#3B82F6", // blue fair
            "#FACC15", // yellow
            "#4F46E5", // indigo
            "#4B5563", // light gray - missing
            "#9CA3AF ", // light gray
            "#9CA3AF ", // light gray
            "#9CA3AF ", // light gray


        ];



        fetch("api/item-conditions")
            .then(res => res.json())
            .then(results => {

                const cardContainer = document.getElementById("card-condition-container");
                const tableBody = document.getElementById("condition-table");

                // Compute maxCount for progress bar percentages
                const maxCount = Math.max(...results.map(d => d.count));

                results.forEach((data, index) => {

                    // Collect totals and labels
                    totals.push(data.count);
                    labels.push(data.condition);

                    // --- Create colored card ---
                    const wrapper = document.createElement("div");
                    wrapper.className = "bg-white p-1 rounded-md shadow-sm border border-gray-300";

                    const newCard = document.createElement("div");
                    newCard.id = `card-${index + 1}`;
                    newCard.className =
                        "max-w-full flex flex-col justify-center mx-auto w-full rounded-sm p-3 text-center";

                    newCard.innerHTML = `
                    <div style="letter-spacing:0.05rem;" class="md:text-lg text-md uppercase font-semibold text-dark">
                        ${data.condition}
                    </div>
                    <div>
                        <div onclick="toggleCard(${data.id})" class="bg-white transform scale-100 hover:scale-110 transition duration-300 ease-in-out p-1 rounded-full shadow-md inline-flex border border-gray-300 items-center justify-center">
                            <div style="background-color:${bgColors[data.id - 1]};" 
                                class="w-12 h-12 md:w-16 md:h-16 text-white font-semibold flex items-center justify-center rounded-full">
                                <span class="md:text-lg text-lg">${data.count}</span>
                            </div>
                        </div>
                    </div>
                `;

                    wrapper.appendChild(newCard);
                    cardContainer.appendChild(wrapper);

                    // --- Create table row with progress bar ---
                    const percent = (data.count / maxCount) * 100;
                    const color = bgColors[data.id - 1];

                    const row = document.createElement("tr");
                    row.innerHTML = `
                    <td class="border px-4 py-2">${data.condition}</td>
                    <td class="border px-4 py-2 font-semibold text-center">${data.count}</td>
                    <td class="border px-4 py-2">
                        <div class="progress-container">
                            <div class="progress-bar" style="width: ${percent}%; background-color: ${color};"></div>
                        </div>
                    </td>
                `;
                    tableBody.appendChild(row);

                });

                console.log("Totals:", totals, "Labels:", labels);

            })
            .catch(error => console.error("Error fetching data:", error));

        function toggleCard(cardId) {
            console.log(cardId);
            window.location.href = `/Admin/ItemConditions/${cardId}`
        }
    </script>

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
                    arrow.textContent = '';
                    // Initialize charts once
                    setTimeout(() => {
                        if (targetId === 'folder-item-type' && !window.itemTypeChartLoadedOnce) {}
                        if (targetId === 'folder-package' && !window.packageChartLoadedOnce) {}
                        if (targetId === 'folder-school' && !window.schoolChartLoadedOnce) {}
                    }, 150);
                }
            });
        });
    </script>





    <script>
        document.addEventListener('DOMContentLoaded', function() {
            schoolChartLoaded();
            packageChartLoaded();
            itemTypeChartLoaded();
        });

        function itemTypeChartLoaded() {
            fetch('api/item-categories')
                .then(response => response.json())
                .then(data => {
                    data.sort((a, b) => b.total - a.total);

                    const labels = data.map(item => item.dcp_item_type.code);
                    const counts = data.map(item => item.total);

                    // ✅ Define your bar colors once
                    const colors = [
                        '#E94B3C',
                        '#F7931E',
                        '#8DC63F',
                        '#4CAF50',
                        '#F7931E',
                        '#E94B3C',
                        '#4CAF50',
                        '#8DC63F',
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
                                style="background-color: ${color}; color: #fff;">
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
                                borderColor: "#ccc",
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
                        '#E94B3C',
                        '#F7931E',
                        '#8DC63F',
                        '#4CAF50',
                        '#F7931E',
                        '#E94B3C',
                        '#4CAF50',
                        '#8DC63F',
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
                                style="background-color: ${color}; color: #fff;">
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
                                borderColor: "#333",
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
                                    '#E94B3C',
                                    '#F7931E',
                                    '#8DC63F',
                                    '#4CAF50',
                                    '#F7931E',
                                    '#E94B3C',
                                    '#4CAF50',
                                    '#8DC63F',
                                ],
                                borderColor: "#ccc",
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

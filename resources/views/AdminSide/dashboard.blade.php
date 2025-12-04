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
    <div class="rounded-lg overflow-hidden px-6 py-2">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mb-4">

            <!-- Total Schools -->
            <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                <div class="flex flex-row w-full gap-4">

                    <div
                        class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">
                        <div class="w-20 h-20 rounded-full bg-blue-600 flex items-center justify-center">
                            <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10L12 5L3 10L12 15L21 10Z" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 11.5V17.5L12 21L18 17.5V11.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 10V17" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>

                    <div class="w-full">
                        <p class="md:text-xl text-md font-normal text-gray-500">Total Number of Schools</p>
                        <h3 class="md:text-3xl text-2xl font-bold text-gray-700">{{ $totalSchools }}</h3>
                    </div>
                </div>

                <div class="flex justify-end mt-5">
                    <a href="{{ url('Schools/index') }}"
                        class="md:text-lg text-md  shadow-md text-white bg-blue-600 text-center rounded p-2 w-24">
                        Schools
                    </a>
                </div>
            </div>

            <!-- Total Batches -->
            <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                <div class="flex flex-row w-full gap-4">
                    <div
                        class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">
                        <div class="bg-green-600 text-white w-20 h-20 p-5 rounded-full flex items-center justify-center">
                            <!-- Clipboard Icon -->
                            <svg class="w-12 h-12" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
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
                </div>

                <div class="flex justify-end mt-5">
                    <a href="{{ url('Admin/DCPBatch/index') }}"
                        class="md:text-lg text-md   shadow-md  text-white bg-green-600 text-center rounded p-2 w-24">
                        Batches
                    </a>
                </div>
            </div>

            <!-- Total Items -->
            <div class="bg-white shadow-md rounded-md   border border-gray-300 p-5 flex flex-col justify-between">
                <div class="flex flex-row w-full gap-4">
                    <div
                        class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">

                        <div class="bg-yellow-500 text-white w-20 h-20 p-5 rounded-full flex items-center justify-center">
                            <!-- Archive Icon -->
                            <svg class="w-12 h-12" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
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
                </div>

                <div class="flex justify-end mt-5">
                    <a href="{{ url('item-type') }}"
                        class="md:text-lg text-md   shadow-md  text-white bg-yellow-500 text-center rounded p-2 w-24">
                        Items
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-md border border-gray-300 p-5 flex flex-col justify-between">
                <div class="flex flex-row w-full gap-4">
                    <div
                        class="bg-white p-1 rounded-full shadow-md border border-gray-300 flex items-center justify-center shadow">

                        <div class="bg-red-600 text-white w-20 h-20 p-5 rounded-full flex items-center justify-center">
                            <!-- Cube Icon -->
                            <svg class="w-12 h-12" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 3L3 8V16L12 21L21 16V8L12 3Z" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.5 7.8L12 12.5L20.5 7.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 12.5V21" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="md:text-xl text-md font-normal text-gray-500">Total DCP Package</p>
                        <h3 class="md:text-3xl text-2xl font-bold text-gray-700">{{ $totalPackages }}</h3>
                    </div>
                </div>

                <div class="flex justify-end mt-5">
                    <a href="{{ url('package-type/create') }}"
                        class="md:text-lg text-md   shadow-md  text-white bg-red-600 text-center rounded p-2 w-24">
                        Packages
                    </a>
                </div>
            </div>
        </div>


    </div>
    <div class="md:text-2xl text-lg font-semibold text-gray-800 mx-5 my-2 mt-5">School Equipments Summary</div>
    <div class="grid grid-cols-1 md:grid-cols-4 md:gap-2 gap-2 mx-5 my-2 ">
        <!-- Total Schools Card -->
        <div class="bg-white rounded-sm border border-gray-300 shadow-md p-1 text-center">
            <div style="background-color:#E94B3C;" class=" 0 h-full text-white p-4 text-center">

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
    <div class="md:text-2xl text-lg font-semibold text-gray-800 mx-5 my-2 mt-5">DCP Batch Items Summary</div>
    <div class="grid grid-cols-1     ">
        <div id="card-condition-container" class="grid md:grid-cols-3 grid-cols-2 md:gap-4 gap-2 mx-5 mb-2    ">

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
            '#E94B3C',
            '#F7931E',
            '#8DC63F',
            '#4CAF50',
            '#F7931E',
            '#E94B3C',
            '#4CAF50',
            '#8DC63F',

        ];
        // Fetch all 5 conditions
        fetch("api/item-conditions")
            .then(res => res.json()).then(results => {
                results.forEach((data, index) => {

                    index + 1;

                    totals.push(data.count);
                    labels.push(data.condition);

                    // Outer white box
                    const wrapper = document.createElement("div");
                    wrapper.className =
                        "bg-white p-1 rounded-md shadow-sm border border-gray-300 transform scale-100 hover:scale-105 transition duration-300 ease-in-out ";

                    // Inner card
                    const newCard = document.createElement("div");
                    newCard.id = `card-${index + 1}`;
                    newCard.onclick = () => toggleCard(data.id);
                    newCard.className = `
                        max-w-full flex flex-col justify-center mx-auto 
                        w-full  
                        rounded-sm  p-3 text-center 
                        
                    `;

                    newCard.innerHTML = `
                    <div style="letter-spacing:0.05rem;" class="md:text-lg text-md uppercase font-semibold text-dark">
                        ${data.condition}
                    </div>
                    <div >
                        <div class="bg-white p-1 rounded-full shadow-md inline-flex border border-gray-300  items-center justify-center">
                        <div 
                            style="background-color:${bgColors[index]};" 
                            class="w-12 h-12 md:w-16 md:h-16  text-white font-semibold flex items-center justify-center rounded-full"
                        >
                            <span class="md:text-lg text-md">${data.count}</span>
                        </div>
                        </div>
                    </div>
                `;


                    // Put the colored card inside the bg-white wrapper
                    wrapper.appendChild(newCard);

                    // Append wrapper to container
                    document.getElementById("card-condition-container").appendChild(wrapper);
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
                                '#E94B3C',
                                '#F7931E',
                                '#8DC63F',
                                '#4CAF50',
                                '#F7931E',
                                '#E94B3C',
                                '#4CAF50',
                                '#8DC63F',
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
                <span class="arrow"></span>
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
                <span class="arrow"></span>
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
                <span class="arrow"></span>
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
                    arrow.textContent = '';
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

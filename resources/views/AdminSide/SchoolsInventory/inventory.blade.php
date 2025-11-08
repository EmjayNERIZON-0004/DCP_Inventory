@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            if ($.fn.select2) {
                $('.select2').select2({
                    placeholder: "Select School",
                    allowClear: true
                });
            } else {
                console.error('Select2 plugin not loaded.');
            }
        });
    </script>

    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.35rem 0.75rem;
            height: auto;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .select2-selection__rendered {
            color: #1f2937;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .select2-selection__arrow {
            height: 100%;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

    <div class="mx-5 my-5">

        <div class="bg-white border border-gray-400 shadow-xl rounded-lg overflow-hidden p-6 mb-2  mx-0 my-0"
            class="bg-white ">
            <h1 class="text-2xl font-bold text-blue-700">DCP Inventory</h1>
            <div class="mb-4 text-gray-600" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                Select a school to filter items, or view all by default.
            </div>

            <!-- Filters -->
            <div class="rounded mb-4">
                <div class="text-blue-700 font-semibold text-xl font-bold mb-2">Search & Filter</div>
                <form method="GET" action="{{ route('index.SchoolsInventory') }}"
                    class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">

                    <!-- School Dropdown -->
                    <div>
                        <div class="text-gray-700 font-normal text-md"
                            style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                            School</div>
                        <div class=" rounded-md">
                            <select name="school" onchange="this.form.submit()"
                                class="select2 w-full px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                                <option value="">-- All Schools --</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->pk_school_id }}"
                                        {{ $selectedSchool == $school->pk_school_id ? 'selected' : '' }}>
                                        {{ $school->SchoolName }} - {{ $school->SchoolLevel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Budget Year Dropdown -->
                    <div class="w-full">
                        <div class="text-gray-700 font-normal text-md"
                            style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                            Budget Year</div>
                        <select name="budget_year" onchange="this.form.submit()"
                            class="border border-gray-300 px-3 py-2 w-full rounded"
                            style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                            <option value=""> All Years </option>
                            @foreach ($budgetYears as $year)
                                <option value="{{ $year }}" {{ $selectedBudgetYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @php
                        $count = $school_items_count->count();

                    @endphp
                    @php
                        $batch_item_count = 0;
                    @endphp
                    @foreach ($school_items_count as $batch)
                        @foreach ($batch['items'] as $item)
                            @php
                                $batch_item_count = $batch_item_count + 1;
                            @endphp
                        @endforeach
                    @endforeach
                    <div class="flex flex-col items-end h-full   w-full  ">
                        <div class="w-full text-md text-left text-gray-700 font-normal">Result</div>
                        <div class=" border w-full mt-auto    gap-2   flex flex-row ">
                            <div
                                class=" bg-blue-200 border rounded-sm border-gray-800 md:py-2 py-1  w-1/2 text-center   font-[Verdana] items-end text-gray-800 md:text-lg text-md font-normal  ">


                                {{ $count }} Batch</div>

                            <div
                                class="bg-green-200 border rounded-sm border-gray-800 w-1/2 text-center   md:py-2 py-1 font-[Verdana] items-end text-gray-800 md:text-lg text-md font-normal  ">


                                {{ $batch_item_count }} Items</div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="text-md font-[Verdana] text-gray-700">List of Items</div>

        <!-- Batch Cards -->
        <div id="batchContainer">
            @if ($school_items->isNotEmpty())
                @foreach ($school_items as $batch)
                    <div class="bg-white border border-gray-300 shadow rounded p-4 mb-4" x-data="{ open: false }">

                        <!-- Header -->
                        <div class="flex md:flex-row flex-col justify-between items-center">
                            <div class="w-full">
                                <h3 class="font-bold text-lg text-blue-600 mb-1">Batch: {{ $batch->batch_label }}</h3>
                                <p class="text-md text-gray-600 mb-2">
                                    School: {{ $batch->school->SchoolName ?? 'Unknown' }}
                                </p>
                            </div>
                            <div class="flex w-full md:justify-end justify-start">
                                <button @click="open = !open"
                                    class="bg-gray-200 border border-gray-800 hover:bg-gray-300 text-sm rounded px-3 py-1 font-semibold">
                                    <span x-show="!open">Show Items</span>
                                    <span x-show="open">Hide Items</span>
                                </button>
                            </div>
                            <!-- Toggle Button -->

                        </div>

                        <!-- Totals -->
                        <div class="flex gap-2 mt-2 flex-wrap">
                            @php
                                $totalGood = 0;
                                $totalDamaged = 0;
                                $totalForRepair = 0;
                                $nostatus = 0;
                                $totalForDisposal = 0;
                                $totalForMissing = 0;

                                foreach ($batch->dcpBatchItems ?? [] as $items) {
                                    $current_condition = App\Models\DCPItemCondition::where(
                                        'dcp_batch_item_id',
                                        $items->pk_dcp_batch_items_id,
                                    )->value('current_condition_id');

                                    if ($current_condition == 1) {
                                        $totalGood++;
                                    } elseif ($current_condition == 2) {
                                        $totalForRepair++;
                                    } elseif ($current_condition == 4) {
                                        $totalDamaged++;
                                    } elseif ($current_condition == 5) {
                                        $totalForDisposal++;
                                    } elseif ($current_condition == 7) {
                                        $totalForMissing++;
                                    } else {
                                        $nostatus++;
                                    }
                                }
                            @endphp
                            <div
                                class="bg-blue-200 text-gray-900 border border-gray-800 px-3 py-1 rounded-sm md:inline hidden">

                                <b>{{ count($batch->dcpBatchItems ?? []) }}</b> <span>-
                                    Items</span>
                            </div>
                            <div
                                class="flex items-center gap-1 bg-green-200 text-gray-900 border border-gray-800 px-3 py-1 rounded-sm">
                                <!-- Mobile: icon + dash -->
                                <span class="flex items-center ">
                                    <svg viewBox="0 0 20 20" class="text-green-800 h-5 w-5"
                                        xmlns="http://www.w3.org/2000/svg" fill="none">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M3 10a7 7 0 019.307-6.611 1 1 0 00.658-1.889 9 9 0 105.98 7.501 1 1 0 00-1.988.22A7 7 0 113 10zm14.75-5.338a1 1 0 00-1.5-1.324l-6.435 7.28-3.183-2.593a1 1 0 00-1.264 1.55l3.929 3.2a1 1 0 001.38-.113l7.072-8z">
                                        </path>
                                    </svg>

                                </span>

                                <!-- Count -->
                                <b>{{ $totalGood }}</b>

                                <!-- Desktop label -->
                                <span class="hidden md:inline">- Good</span>
                            </div>

                            <div
                                class=" flex items-center gap-1 bg-red-200 text-gray-900 border border-gray-800 px-3 py-1 rounded-sm">

                                <span class="flex items-center">
                                    <svg viewBox="0 0 24 24" class="w-5 h-5 text-red-800" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor">
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
                                </span>
                                <b>{{ $totalDamaged }}</b> <span class="md:inline hidden">- Damaged</span>

                            </div>
                            <div
                                class="flex items-center gap-1 bg-yellow-200 text-gray-900 border border-gray-800 px-3 py-1 rounded-sm">
                                <!-- Mobile: icon + dash -->
                                <span class="flex items-center">
                                    <svg version="1.1" id="svg2" class="w-5 h-5 text-yellow-800"
                                        xmlns:dc="http://purl.org/dc/elements/1.1/"
                                        xmlns:cc="http://creativecommons.org/ns#"
                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                        xmlns:svg="http://www.w3.org/2000/svg"
                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                        sodipodi:docname="wrench.svg" inkscape:version="0.48.4 r9939"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 1200 1200" enable-background="new 0 0 1200 1200" xml:space="preserve"
                                        fill="currentColor">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path id="path26345" inkscape:connector-curvature="0"
                                                d="M984.091,19.305C868.695-22.216,734.617,3.236,642.153,95.7 c-92.463,92.463-117.916,226.542-76.396,341.937L0,1003.396L196.604,1200l565.759-565.76 c115.396,41.521,249.474,16.068,341.937-76.396c92.464-92.463,117.917-226.542,76.396-341.937L981.742,414.861l-141.708-54.896 l-54.896-141.708L984.091,19.305z M236.18,963.82c22.563,22.562,22.563,59.143,0,81.705c-22.562,22.562-59.143,22.562-81.705,0 c-22.563-22.563-22.563-59.144,0-81.705C177.037,941.258,213.618,941.258,236.18,963.82z">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                                <b>{{ $totalForRepair }}</b> <span class="md:inline hidden">- Needs Repair</span>
                            </div>
                            <div
                                class=" flex items-center gap-1 bg-purple-200 text-gray-900 border border-gray-800 px-3 py-1 rounded-sm">

                                <span class="flex items-center">
                                    <svg fill="currentColor" class="w-5 h-5 text-indigo-800"
                                        viewBox="-6.7 0 122.88 122.88" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        style="enable-background:new 0 0 109.48 122.88" xml:space="preserve">
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
                                </span>
                                <b>{{ $totalForDisposal }}</b> <span class="md:inline hidden">- For Disposal</span>
                            </div>

                            <div
                                class=" flex items-center gap-1 bg-gray-200 text-gray-900 border border-gray-800 px-3 py-1 rounded-sm">

                                <span class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-800" version="1.1" id="_x32_"
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
                                </span>
                                <b>{{ $totalForMissing }}</b> <span class="md:inline hidden">- Missing</span>
                            </div>
                            <div
                                class="bg-gray-200 md:inline hidden text-gray-800 border border-gray-800 px-3 py-1 rounded-sm">
                                <b>{{ $nostatus }}</b> <span>- No Status </span>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div x-show="open" x-transition class="mt-3 overflow-x-auto">
                            <div class="grid gap-3">
                                @foreach ($batch->dcpBatchItems ?? [] as $index => $item)
                                    @php
                                        $condition_id = \App\Models\DCPItemCondition::where(
                                            'dcp_batch_item_id',
                                            $item->pk_dcp_batch_items_id,
                                        )->value('current_condition_id');

                                        $condition_name = $condition_id
                                            ? \App\Models\DCPCurrentCondition::where(
                                                'pk_dcp_current_conditions_id',
                                                $condition_id,
                                            )->value('name')
                                            : null;

                                        // Background color classes per status
                                        $rowColor = match ($condition_name) {
                                            'Good' => 'bg-green-200',
                                            'Needs Repair' => 'bg-yellow-200',
                                            'Damaged' => 'bg-red-200',
                                            'For Disposal' => 'bg-purple-200',
                                            default => 'bg-gray-200',
                                        };

                                        $itemName = \App\Models\DCPItemTypes::where(
                                            'pk_dcp_item_types_id',
                                            $item->item_type_id,
                                        )->value('name');
                                    @endphp

                                    <div
                                        class="grid md:grid-cols-4 cols-span-1 items-center p-3 rounded border border-gray-500  bg-white shadow-md hover:bg-opacity-80">
                                        <!-- Code -->
                                        <div class="text-md md:col-span-2">
                                            <span
                                                class="{{ $rowColor }} border border-gray-800 rounded-full inline-flex justify-center items-center px-2 py-0 ">{{ $index + 1 }}.</span>
                                            {{ $item->generated_code }}
                                        </div>

                                        <!-- Item -->
                                        <div class="text-md">
                                            (<span class="mx-2">{{ $itemName }}</span>)
                                        </div>

                                        <!-- Action -->
                                        <div class="text-right">
                                            <a href="{{ route('show.SchoolsInventory', ['code' => $item->generated_code]) }}"
                                                class="bg-blue-500 hover:bg-blue-700 border border-gray-300 text-white text-md font-semibold py-1 px-3 rounded shadow-md">
                                                Details
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">No DCP items found.</p>
            @endif
        </div>


        <!-- Load More Button -->
        @if ($school_items->hasMorePages())
            <div class="text-center mt-4">
                <button id="loadMoreBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Show More
                </button>
            </div>
        @endif

        <script>
            let currentPage = {{ $school_items->currentPage() }};
            const lastPage = {{ $school_items->lastPage() }};

            $('#loadMoreBtn').on('click', function() {
                currentPage++;

                $.ajax({
                    url: "{{ route('index.SchoolsInventory') }}" + "?page=" + currentPage +
                        "&school={{ $selectedSchool }}&budget_year={{ $selectedBudgetYear }}",
                    type: "GET",
                    success: function(data) {
                        const newBatches = $(data).find("#batchContainer").html();
                        $("#batchContainer").append(newBatches);

                        if (currentPage >= lastPage) {
                            $("#loadMoreBtn").remove();
                        }
                    }
                });
            });
        </script>
    </div>
@endsection

<script src="//unpkg.com/alpinejs" defer></script>

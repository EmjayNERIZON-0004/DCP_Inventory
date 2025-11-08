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
        <h1 class="text-2xl font-bold text-blue-700">DCP Inventory</h1>
        <div class="mb-4 text-gray-600" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
            Select a school to filter items, or view all by default.
        </div>

        <!-- Filters -->
        <div class="rounded mb-4">
            <div class="text-blue-700 font-semibold text-xl font-bold">Search & Filter</div>
            <form method="GET" action="{{ route('index.SchoolsInventory') }}"
                class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">

                <!-- School Dropdown -->
                <div>
                    <div class="text-gray-700 font-medium text-lg" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
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
                    <div class="text-gray-700 font-medium text-lg" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
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
                <div class="flex flex-row items-end h-full   w-full  ">
                    <div class=" border w-full mt-auto    gap-2   flex flex-row ">
                        <div
                            class=" bg-blue-200 border rounded-sm border-gray-800 py-2  w-1/2 text-center   font-[Verdana] items-end text-gray-800 text-2xl font-normal  ">
                            Total
                            Batch:
                            {{ $count }}</div>

                        <div
                            class="bg-blue-200 border rounded-sm border-gray-800 w-1/2 text-center   py-2 font-[Verdana] items-end text-gray-800 text-2xl font-normal  ">
                            Total
                            Items:
                            {{ $batch_item_count }}</div>
                    </div>

                </div>
            </form>
        </div>

        <!-- Batch Cards -->
        <div id="batchContainer">
            @if ($school_items->isNotEmpty())
                @foreach ($school_items as $batch)
                    <div class="bg-white border border-blue-500 shadow rounded p-4 mb-4" x-data="{ open: false }">
                        <div class="flex justify-between cursor-pointer" @click="open = !open">
                            <div>
                                <h3 class="font-bold text-lg text-blue-600 mb-1">Batch: {{ $batch->batch_label }}</h3>
                                <p class="text-md text-gray-600 mb-2">School: {{ $batch->school->SchoolName ?? 'Unknown' }}
                                </p>
                            </div>
                            <div>
                                <a href="#top"
                                    class="text-blue-600 hover:text-blue-800 underline flex items-center space-x-1"
                                    @click.stop>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    <span>Back to Top</span>
                                </a>
                            </div>
                        </div>

                        <!-- Totals -->
                        <div class="flex gap-2 mt-2">
                            @php
                                $totalGood = 0;
                                $totalDamaged = 0;
                                $totalForRepair = 0;
                                $nostatus = 0;
                                $totalForDisposal = 0;

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
                                    } else {
                                        $nostatus++;
                                    }
                                }
                            @endphp

                            <div class="bg-blue-200 text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                                <b>{{ count($batch->dcpBatchItems ?? []) }}</b> - Items
                            </div>
                            <div class="bg-green-200 text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                                <b>{{ $totalGood }}</b> - Good
                            </div>
                            <div class="bg-red-200 text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                                <b>{{ $totalDamaged }}</b> - Damaged
                            </div>
                            <div class="bg-yellow-200 text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                                <b>{{ $totalForRepair }}</b>- Needs Repair
                            </div>
                            <div class="bg-purple-200 text-gray-900 border border-gray-800 px-4 py-2 rounded-sm">
                                <b>{{ $totalForDisposal }}</b>- For Disposal
                            </div>
                            <div class="bg-gray-200 text-gray-800 border border-gray-800 px-4 py-2 rounded-sm">
                                <b>{{ $nostatus }}</b> - No Status
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div x-show="open" x-transition class="list-disc ml-6 text-gray-700 mt-2">
                            <table>
                                @foreach ($batch->dcpBatchItems ?? [] as $item)
                                    <tr class="hover:text-blue-700">
                                        <td class="py-1"><strong>Code:</strong> {{ $item->generated_code }}</td>
                                        <td class="w-5 py-1"></td>
                                        <td>
                                            <strong>Item:</strong>
                                            @php
                                                $itemName = App\Models\DCPItemTypes::firstWhere(
                                                    'pk_dcp_item_types_id',
                                                    $item->item_type_id,
                                                )->value('name');
                                            @endphp
                                            {{ $itemName }}
                                        </td>
                                        <td class="py-2 px-5 flex justify-center">
                                            @php
                                                $current_condition = App\Models\DCPItemCondition::where(
                                                    'dcp_batch_item_id',
                                                    $item->pk_dcp_batch_items_id,
                                                )->value('current_condition_id');

                                                if ($current_condition) {
                                                    $condition_name = App\Models\DCPCurrentCondition::where(
                                                        'pk_dcp_current_conditions_id',
                                                        $current_condition,
                                                    )->value('name');
                                                } else {
                                                    $condition_name = null;
                                                }
                                            @endphp
                                            <div
                                                class="w-full py-1 text-gray-800 border border-gray-800 px-2 rounded text-center
                                                {{ isset($condition_name)
                                                    ? ($condition_name === 'Good'
                                                        ? 'bg-green-200'
                                                        : ($condition_name === 'Needs Repair'
                                                            ? 'bg-yellow-200'
                                                            : ($condition_name === 'Damaged'
                                                                ? 'bg-red-200'
                                                                : 'bg-gray-200')))
                                                    : 'bg-gray-200' }}">
                                                {{ $condition_name ?? 'No Status' }}
                                            </div>
                                        </td>
                                        <td class="w-5"></td>
                                        <td class="py-2">
                                            <a href="{{ route('show.SchoolsInventory', ['code' => $item->generated_code]) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded"
                                                style="text-decoration: none;">
                                                Show Item Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
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

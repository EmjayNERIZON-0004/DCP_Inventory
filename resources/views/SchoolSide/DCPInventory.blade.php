@extends('layout.SchoolSideLayout')

@section('title', 'DCP Inventory')

@section('content')
    <div class="max-w-full mx-5 bg-white rounded shadow p-6 px-5  mt-8" style="border:1px solid #ccc">
        <h1 class="text-2xl font-bold text-blue-700 ">DCP Inventory</h1>
        <p class="mb-2">Below is a sample list of DCP equipment assigned to your school.</p>
        <input type="text" id="searchBatchItem" placeholder="Search for items..."
            class="border border-gray-300 rounded-lg px-4 py-2 mb-4 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">


        <div class="overflow-x-auto border border-gray-200 h-96  rounded-sm md:border-b shadow-md md:shadow-none">

            <table class="min-w-full w-full md:w-full bg-white border  ">
                <thead class="bg-gray-700 text-white text-left sticky top-0">
                    <tr>
                        <th class="px-4 py-2  ">Code</th>
                        <th class="px-4 py-2  ">Warranty</th>
                        <th class="px-4 py-2  whitespace-nowrap">Batch Label</th>

                        <th class="px-4 py-2  ">Item</th>
                        <th class="px-4 py-2  ">Brand</th>
                        <th class="px-4 py-2   whitespace-nowrap">Other Details</th>
                    </tr>
                </thead>
                <tbody id="batchItemsTableBody">
                    @foreach ($batch_items as $batch_item)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">
                                {{ $batch_item->generated_code }}
                            </td>
                            <td class="px-4 py-2 w-fit  border border-gray-300">

                                <a href="{{ route('school.dcp_item_warranty', $batch_item->pk_dcp_batch_items_id) }}"
                                    class="text-green-600 rounded  whitespace-nowrap   py-1 underline hover:text-green-700">
                                    Show Status
                                </a>
                            </td>
                            <td class="px-4 py-2  md:w-fit border border-gray-300">{{ $batch_item->batch_label }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                @php
                                    $item_name = \App\Models\DCPItemTypes::firstWhere(
                                        'pk_dcp_item_types_id',
                                        $batch_item->item_type_id,
                                    );
                                @endphp
                                {{ $item_name->name }}</td>
                            <td class="px-4 py-2 border border-gray-300">

                                {{ $batch_item->brand }}
                            </td>
                            <td class="px-4 py-2 w-fit  border border-gray-300">
                                <a href="{{ route('school.dcp_inventory.items', $batch_item->generated_code) }}"
                                    style="font-size:16px"
                                    class="  text-xs font-semibold  text-blue-500 rounded hover:text-blue-600 underline">
                                    Show More
                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/search/school.inventory.js') }}"></script>
@endsection

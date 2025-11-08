@extends('layout.SchoolSideLayout')

@section('title', 'DCP Inventory')

@section('content')
    <div class="max-w-full mx-5 bg-white rounded shadow p-6 px-5  mt-8" style="border:1px solid #ccc">
        <div class="flex justify-between     space-x-4">
            <div>
                <div class="mb-2 mt-2">
                    <a class="bg-blue-200 text-gray-800 px-2 py-1  mb-2 rounded hover:bg-blue-600  hover:text-white border border-gray-800"
                        href="{{ url('School/items-condition/0') }}">Show Status of items</a>
                </div>
                <h1 class="text-2xl font-bold text-blue-700 ">
                    DCP Inventory
                </h1>
                <p class="mb-2">Below is a sample list of DCP equipment assigned to your school.</p>
            </div>

            <div class="h-16 w-16    text-blue-600">
                <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-seam">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z">
                        </path>
                    </g>
                </svg>
            </div>
        </div>
        <input type="text" id="searchBatchItem" placeholder="Search for items..."
            class="border border-gray-300 rounded-lg px-4 py-2   mb-4 md:w-1/3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">


        <div class="overflow-x-auto border border-gray-200 h-96  rounded-sm md:border-b shadow-md md:shadow-none">

            <table class="min-w-full w-full md:w-full bg-white border  ">
                <thead class="bg-gray-200 border border-gray-500 text-left sticky top-0">
                    <tr>
                        <th class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800 ">Code
                        </th>
                        <th class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800 ">Warranty
                        </th>
                        <th
                            class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800 whitespace-nowrap">
                            Batch Label</th>

                        <th class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800 ">Item
                        </th>
                        <th class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800">Brand
                        </th>
                        <th
                            class=" tracking-wider px-4 py-2 font-semibold border-b border-gray-500 text-gray-800  whitespace-nowrap">
                            Other Details</th>
                    </tr>
                </thead>
                <tbody id="batchItemsTableBody">
                    @foreach ($batch_items as $batch_item)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">
                                {{ $batch_item->generated_code }}
                            </td>
                            <td class="px-4 py-2 w-fit   border border-gray-300">

                                <a href="{{ route('school.dcp_item_warranty', $batch_item->pk_dcp_batch_items_id) }}"
                                    class="  bg-green-200 text-black rounded  whitespace-nowrap  border border-gray-800 px-2 py-1   hover:bg-green-600 hover:text-white    transition-all duration-200">
                                    Show Warranty
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
                                @php
                                    $brand_name = \App\Models\DCPBatchItemBrand::where(
                                        'pk_dcp_batch_item_brands_id',
                                        $batch_item->brand,
                                    )->value('brand_name');

                                @endphp
                                {{ $brand_name ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-2 w-fit   border border-gray-300">
                                <a href="{{ route('school.dcp_inventory.items', $batch_item->generated_code) }}"
                                    class="  text-md font-normal bg-blue-200  text-gray-800 border border-gray-800 px-2 rounded hover:bg-blue-600 hover:text-white   px-2 py-1   transition-all duration-200">
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

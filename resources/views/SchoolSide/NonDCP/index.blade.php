@extends('layout.SchoolSideLayout')

<title>
    @yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class=" p-6 ">
        <div class="flex justify-start space-x-4">
            <div
                class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                <div class="text-white bg-blue-600 p-2 rounded-full">
                    <svg class="w-10 h-10" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                        fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-width: 2;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-miterlimit: 10;
                                }
                            </style>
                            <g>
                                <path
                                    d="M16,12H3c-0.6,0-1,0.4-1,1v9c0,0.6,0.4,1,1,1h13c0.6,0,1-0.4,1-1v-9C17,12.4,16.6,12,16,12z">
                                </path>
                                <path d="M13,25H6c-0.6,0-1,0.4-1,1s0.4,1,1,1h7c0.6,0,1-0.4,1-1S13.6,25,13,25z"></path>
                                <path
                                    d="M29,5H19c-0.6,0-1,0.4-1,1v20c0,0.6,0.4,1,1,1h10c0.6,0,1-0.4,1-1V6C30,5.4,29.6,5,29,5z M28,7v9h-8V7H28z">
                                </path>
                                <path d="M22,11h4c0.6,0,1-0.4,1-1s-0.4-1-1-1h-4c-0.6,0-1,0.4-1,1S21.4,11,22,11z"></path>
                                <path d="M26,12h-1c-0.6,0-1,0.4-1,1s0.4,1,1,1h1c0.6,0,1-0.4,1-1S26.6,12,26,12z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div>

                <div class="text-2xl font-bold text-blue-800">Non DCP Items</div>
                <div class="text-md font-medium tracking-wider text-gray-600 mb-4">eg. Computer, Laptop, Smart TV - Unit
                    Price, Date
                    Acquired
                </div>

            </div>

        </div>
        <div class="flex justify-start my-2">
            <div
                class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                <button title="Show Info Modal" type="button" onclick="openModal()"
                    class="btn-submit h-8 py-1 px-4 rounded-full">
                    Add New Item
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto  border border-gray-300 w-full table-collapse">
                <thead class="bg-gray-100  border border-gray-500 text-white">
                    <tr>
                        <th
                            class="tracking-wider whitespace-nowrap border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800">
                            No. </th>

                        <th
                            class="tracking-wider whitespace-nowrap  border-b border-gray-500   py-2 px-2 font-semibold  text-gray-800">
                            Item - Description </th>
                        <th
                            class="tracking-wider whitespace-nowrap  border-b border-gray-500   py-2 px-2 font-semibold  text-gray-800">
                            Unit - Price </th>
                        <th
                            class="tracking-wider whitespace-nowrap  border-b border-gray-500   py-2 px-2 font-semibold  text-gray-800">
                            Date Acquired </th>
                        <th
                            class="tracking-wider whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800">
                            Functional </th>
                        <th
                            class="tracking-wider whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800">
                            Fund Source </th>
                        <th
                            class="tracking-wider whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800">
                            Item Holder - Location </th>
                        <th
                            class="tracking-wider whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800">
                            Remarks</th>
                        <th
                            class="tracking-wider whitespace-nowrap  border-b border-gray-500   py-2 px-2 font-semibold  text-gray-800">
                            Action</th>

                    </tr>
                </thead>
                <tbody class="tracking-wider">

                    @foreach ($non_dcp as $index => $item)
                        <tr>
                            <td class="py-2 px-2 bg-gray-300 border border-gray-500 text-center py-2 text-center">
                                {{ $index + 1 }}</td>
                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->item_description }}
                            </td>
                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->unit_price }}</td>

                            <td class="py-2 px-2 border border-gray-300 text-center">
                                {{ \Carbon\Carbon::parse($item->date_acquired)->format('F j Y') }}
                            </td>



                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->total_functional }}
                                /
                                {{ $item->total_item }}</td>
                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                {{ $item->fund_source->name ?? 'N/A' }}
                            </td>
                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                {{ $item->item_holder_and_location ?? 'N/A' }}</td>
                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->remarks }}</td>
                            <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                <div class="flex flex-row gap-2 justify-center">


                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                            onclick='editModal(
                                        {{ $item->pk_non_dcp_item_id }},
                                        @json($item->item_description),
                                        {{ $item->unit_price }},
                                        "{{ $item->date_acquired }}",
                                        {{ $item->total_functional }},
                                        {{ $item->total_item }},
                                        {{ $item->fund_source_id }},
                                        @json($item->item_holder_and_location),
                                        @json($item->remarks)
                                      )'>
                                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="Edit / Edit_Pencil_Line_02">
                                                        <path id="Vector"
                                                            d="M4 20.0001H20M4 20.0001V16.0001L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L8 20.0001L4 20.0001Z"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button type="button" title="Remove ISP"
                                            onclick="deleteItem({{ $item->pk_non_dcp_item_id }})"
                                            class="btn-delete p-1 rounded-full">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('SchoolSide.NonDCP.partials._modalAdd')
    @include('SchoolSide.NonDCP.partials._modalEdit')
    @include('SchoolSide.NonDCP.partials._script')
@endsection

@foreach ($batch_items as $batch_item)
    <tr>
        <td class="px-2 py-2 text-center  bg-gray-300 border border-gray-500">
            {{ $loop->iteration }}
        </td>
        <td class="px-4 py-2 border border-gray-300">
            {{ $batch_item->generated_code }}
        </td>

        <td class="px-4 py-2  md:w-fit border border-gray-300">{{ $batch_item->batch_label }}</td>
        <td class="px-4 py-2 border border-gray-300">
            @php
                $item_name = \App\Models\DCPItemTypes::firstWhere('pk_dcp_item_types_id', $batch_item->item_type_id);
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
            <div class="flex flex-row justify-center">


                <a href="{{ route('school.dcp_inventory.items', $batch_item->generated_code) }}">

                    <div
                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                        <button title="Insert Area" class="  btn-submit  p-1 rounded-full">
                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1.5 12c0-2.25 3.75-7.5 10.5-7.5S22.5 9.75 22.5 12s-3.75 7.5-10.5 7.5S1.5 14.25 1.5 12zM12 16.75a4.75 4.75 0 1 0 0-9.5 4.75 4.75 0 0 0 0 9.5zM14.7 12a2.7 2.7 0 1 1-5.4 0 2.7 2.7 0 0 1 5.4 0z"
                                        fill="currentColor"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </a>
            </div>
        </td>

    </tr>
@endforeach

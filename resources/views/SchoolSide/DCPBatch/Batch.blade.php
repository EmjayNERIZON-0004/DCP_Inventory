{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Batch.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'My DCP Batches')

@section('content')
    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5" style="border:1px solid #ccc">
        <div class="flex justify-between   space-x-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800   text-blue-600">School DCP Batches</h2>
                <p class="mb-2">Here are the list of DCP Batches for your school.</p>
            </div>

            <div class="h-14 w-14 md:block hidden text-blue-600">
                <svg fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 551.852 551.852" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path
                                d="M545.933,106.575l0.377-0.999L276.049,0L6.228,106.671l-0.881-0.35v0.684l-0.038,0.021l0.038,0.115v338.651 l270.579,106.059l270.617-106.064V106.326L545.933,106.575z M275.797,20.755l91.666,32.829L117.578,150.6l-84.647-33.39 L275.797,20.755z M266.281,527.927L164.94,487.013l-50.859-19.107l-89.396-35.267V134.737l88.499,34.909v74.49l7.887-2.202 l5.33,7.324l7.421-1.732l7.187,7.592l6.272-2.161l10.125,10.041v-75.911l7.877,3.11l100.999,39.834V527.927L266.281,527.927z M275.948,213.077l-98.808-38.983L420.832,75.33l100.504,40.944L275.948,213.077z M527.218,432.639l-241.612,95.288V230.032 l241.589-95.301v297.901L527.218,432.639L527.218,432.639z">
                            </path>
                        </g>
                    </g>
                </svg>

            </div>
        </div>
        <div class="overflow-x-auto border border-gray-200 rounded-sm md:border-none shadow-md md:shadow-none">
            <table class="min-w-full border-collapse  text-left  ">
                <thead class="bg-gray-100 border border-gray-500">
                    <tr>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-500 whitespace-nowrap tracking-wider text-gray-800  ">
                            Batch Label</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-500 whitespace-nowrap  tracking-wider text-gray-800   ">
                            DCP Items</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-500 whitespace-nowrap  tracking-wider text-gray-800   ">
                            DCP Files</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-500 whitespace-nowrap  tracking-wider text-gray-800   ">
                            Package Type</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-500  whitespace-nowrap tracking-wider text-gray-800   ">
                            Budget Year</th>
                        <th
                            class="px-4 py-2 font-semibold border-b border-gray-500  whitespace-nowrap tracking-wider text-gray-800   ">
                            Delivery Date</th>
                        <th class="px-4 py-2 font-semibold border-b border-gray-500   tracking-wider text-gray-800   ">
                            Supplier</th>
                        <th class="px-4 py-2 font-semibold border-b border-gray-500   tracking-wider text-gray-800   ">
                            Status</th>
                        <th class="px-4 py-2 font-semibold border-b border-gray-500   tracking-wider text-gray-800   ">
                            Submit</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($batch as $b)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border border-gray-300">{{ $b->batch_label }} </td>
                            @php
                                $batch_items = App\Models\DCPBatchItem::where(
                                    'dcp_batch_id',
                                    $b->pk_dcp_batches_id,
                                )->get();
                                $completed_count = 0;
                                $bg_color = '';
                                foreach ($batch_items as $index => $items) {
                                    if (
                                        isset($items->brand) &&
                                        $items->dcpItemCurrentCondition &&
                                        $items->dcpItemCurrentCondition->current_condition_id
                                    ) {
                                        $completed_count++;
                                    }
                                    if ($completed_count == count($batch_items)) {
                                        $bg_color = 'bg-green-200 hover:bg-green-300  ';
                                    } else {
                                        $bg_color = 'bg-gray-200 hover:bg-gray-300  ';
                                    }
                                }

                            @endphp
                            <td class="px-2 py-3 md:px-4 space-x-2 border border-gray-300">
                                <a href="{{ route('school.dcp_items', $b->id ?? $b->pk_dcp_batches_id) }}"
                                    class=" flex items-center gap-2 text-md  {{ $bg_color }} text-gray-800 px-2 py-1   rounded    border border-gray-800">
                                    <div class="inline-block h-6 w-6">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M20.3873 7.1575L11.9999 12L3.60913 7.14978" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12 12V21" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M11 2.57735C11.6188 2.22008 12.3812 2.22008 13 2.57735L19.6603 6.42265C20.2791 6.77992 20.6603 7.44017 20.6603 8.1547V15.8453C20.6603 16.5598 20.2791 17.2201 19.6603 17.5774L13 21.4226C12.3812 21.7799 11.6188 21.7799 11 21.4226L4.33975 17.5774C3.72094 17.2201 3.33975 16.5598 3.33975 15.8453V8.1547C3.33975 7.44017 3.72094 6.77992 4.33975 6.42265L11 2.57735Z"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M8.5 4.5L16 9" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    {{ $completed_count }}/{{ $batch_items->count() }}
                                    Items
                                </a>
                            </td>
                            <td class="px-4 py-3 border border-gray-300 ">
                                @php
                                    $item_status = '';
                                    if ($completed_count == $batch_items->count()) {
                                        $item_status = 'Completed';
                                    } else {
                                        $item_status = 'Pending';
                                    }

                                    $status = '';
                                    $bg_color = '';
                                    $hover = '';

                                    $obj = App\Models\DCPBatchItem::where(
                                        'dcp_batch_id',
                                        $b->id ?? $b->pk_dcp_batches_id,
                                    )->first();
                                    if (
                                        $obj->iar_value !== null &&
                                        $obj->itr_value !== null &&
                                        $obj->coc_status !== null &&
                                        $obj->training_acceptance_status !== null &&
                                        $obj->delivery_receipt_status !== null &&
                                        $obj->invoice_receipt_status !== null
                                    ) {
                                        $status = 'Completed';
                                        $bg_color = 'bg-green-200';
                                        $hover = 'hover:bg-green-300';
                                    } else {
                                        $status = 'Pending';
                                        $bg_color = 'bg-gray-200';
                                        $hover = 'hover:bg-gray-300';
                                    }
                                @endphp
                                <div class="text-left">
                                    <a href="{{ route('school.index.batch_status', $b->id ?? $b->pk_dcp_batches_id) }}"
                                        class="flex justify-center items-center
                                    text-md {{ $bg_color }} {{ $hover }} text-gray-800 px-2 py-1
                                    rounded      border border-gray-800">


                                        {{ $status ?? '' }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->dcpPackageType->name ?? '' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->budget_year }}</td>
                            <td class="px-4 py-3 border border-gray-300">
                                {{ $b->delivery_date ? \Carbon\Carbon::parse($b->delivery_date)->format('F d, Y') : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->supplier_name }}</td>
                            <td class="px-4 py-3 border border-gray-300">
                                {{ $b->submission_status }}
                            </td>
                            <td class="px-4 py-3 border border-gray-300 text-center">
                                @if (!$b->approval?->status)
                                    <form action="{{ route('submit.dcp_batch') }}" method="POST">
                                        @csrf
                                        <input class="hidden" type="text" name="dcp_batch_id"
                                            value="{{ $b->pk_dcp_batches_id }}">


                                        @php
                                            $isDisabled = !($status === 'Completed' && $item_status === 'Completed');
                                        @endphp

                                        <button {{ $isDisabled ? 'disabled' : '' }}
                                            title="{{ $isDisabled ? 'Items are not completed' : 'You can now submit information to admin' }}"
                                            class="bg-blue-500 hover:bg-blue-600 {{ $isDisabled ? 'cursor-not-allowed opacity-50' : '' }} text-white py-1 px-4 rounded">
                                            Submit
                                        </button>
                                    </form>
                                @else
                                    @php
                                        $text_color = '';
                                        $title = '';
                                        if ($b->approval?->status == 'Approved') {
                                            $title = 'This batch is already seen by admin';

                                            $text_color = 'bg-green-600';
                                        } elseif ($b->approval?->status == 'Rejected') {
                                            $title = 'This batch has been rejected by admin';
                                            $text_color = 'bg-red-500';
                                        } elseif ($b->approval?->status == 'Pending') {
                                            $title = 'This batch is pending for admin approval';
                                            $text_color = 'bg-yellow-500';
                                        }
                                    @endphp
                                    <span title="{{ $title }}"
                                        class="{{ $text_color }} px-2 py-1 text-white   font-normal text-lg">{{ $b->approval?->status }}</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No DCP batches found for your school.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
@endsection

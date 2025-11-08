@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <div class="mx-5 my-5 px-5 max-w-full mx-auto">
        <a href="{{ route('school.dcp_inventory') }}"
            class="inline-flex  items-center text-blue-600 text-md font-semibold hover:underline mb-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            DCP Inventory
        </a>
        @foreach ($items as $item)
            @php
                $batch = \App\Models\DCPBatch::where('pk_dcp_batches_id', $item->dcp_batch_id)->first();
                $batchName = $batch ? $batch->batch_label : 'N/A';

                // File paths
                $iarPath = $item->iar_file ? asset("certificates/iar/{$item->iar_file}") : null;
                $itrPath = $item->itr_file ? asset("certificates/itr/{$item->itr_file}") : null;
                $cocPath = $item->certificate_of_completion
                    ? asset("certificates/certificate-completion/{$item->certificate_of_completion}")
                    : null;
                $trainingPath = $item->training_acceptance_file
                    ? asset("certificates/training-acceptance/{$item->training_acceptance_file}")
                    : null;
                $deliveryPath = $item->delivery_receipt_file
                    ? asset("certificates/delivery-receipt/{$item->delivery_receipt_file}")
                    : null;
                $invoicePath = $item->invoice_receipt_file
                    ? asset("certificates/invoice-receipt/{$item->invoice_receipt_file}")
                    : null;
            @endphp

            <div class="bg-white border border-gray-300 rounded-sm shadow-sm p-6 mb-8">
                <div class="border-b border-gray-200 pb-4 mb-6 flex md:flex-row flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800"> DCP Item </h2>
                        <p class="text-lg text-gray-600 mt-1"> <span
                                class=" text-gray-800 tracking-wider font-semibold text-xl">{{ $item->generated_code }}</span>
                        </p>
                    </div>
                    @php
                        $bg_color = '';
                        if ($item->condition_id == '1') {
                            $bg_color = 'bg-green-200';
                        } elseif ($item->condition_id == '2') {
                            $bg_color = 'bg-yellow-200';
                        } elseif ($item->condition_id == '3') {
                            $bg_color = 'bg-yellow-200';
                        } elseif ($item->condition_id == '4') {
                            $bg_color = 'bg-red-200';
                        } elseif ($item->condition_id == '5') {
                            $bg_color = 'bg-indigo-200';
                        }
                    @endphp
                    <div>
                        Item Current Status
                        <div
                            class="font-semibold text-center text-gray-700 px-4 py-1 text-md border border-gray-800 {{ $bg_color }}">
                            {{ $item->dcpItemCurrentCondition->dcpCurrentCondition->name ?? 'N/A' }} </div>
                    </div>

                </div>
                <div class=" col-span-2 md:col-span-1  flex   gap-2">

                </div>
                <div class="grid  grid-cols-2 gap-y-4 text-lg text-gray-800">
                    <div class=" col-span-2 md:col-span-1  flex gap-2">
                        <div class="flex  flex-row  justify-center items-center gap-2">
                            <div class="font-semibold text-gray-700">Batch: </div>
                            <div class=" bg-gray-100 px-2 py-1   border border-gray-800"> {{ $batchName }} </div>

                        </div>

                    </div>

                    <div class=" col-span-2 md:col-span-1  flex gap-2">
                        <span class="font-semibold text-gray-700">Item:</span>
                        @php
                            $itemType = \App\Models\DCPItemTypes::where(
                                'pk_dcp_item_types_id',
                                $item->item_type_id,
                            )->first();
                            $itemTypeName = $itemType->name;
                        @endphp
                        {{ $itemTypeName }}
                    </div>


                    <div class="col-span-2 md:col-span-1 ">
                        <span class="font-semibold text-gray-700">Quantity:</span> {{ $item->quantity }}
                    </div>
                    <div class="col-span-2 md:col-span-1 ">
                        <span class="font-semibold text-gray-700">Unit Price:</span>
                        {{ number_format($item->unit_price, 2) }}
                    </div>
                    <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Unit:</span>
                        {{ trim($item->unit) }}</div>
                    <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Brand:</span>
                        @php
                            $brand_name = \App\Models\DCPBatchItemBrand::where(
                                'pk_dcp_batch_item_brands_id',
                                $item->brand,
                            )->value('brand_name');

                        @endphp
                        {{ $brand_name ?? 'N/A' }}
                    </div>
                    <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Serial Number:</span>
                        {{ $item->serial_number ?? 'N/A' }}
                    </div>
                    <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Assigned User for this
                            Item:</span>
                        {{ $user_type ?? 'N/A' }} - {{ $user_name ?? 'N/A' }}</div>
                    <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Location of the
                            Item:</span>
                        {{ $item_location ?? 'N/A' }} </div>
                    <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Date Assigned:</span>
                        {{ $user_date_assigned ?? 'N/A' }} </div>


                    {{-- IAR Section --}}
                    <div class="grid grid-cols-3 gap-1 mt-1 text-lg text-gray-800 col-span-2">
                        <div
                            class="col-span-3 bg-green-200 p-2 border border-gray-400 text-center font-semibold text-gray-700">
                            Inspection and Acceptance Report
                        </div>
                        <div class="bg-green-200 p-2 border border-gray-400">
                            <span class="font-semibold text-gray-700">Ref Code:</span>
                            {{ $item->iar_ref_code ?? 'N/A' }}
                        </div>
                        <div class="bg-green-200 p-2 border border-gray-400">
                            <span class="font-semibold text-gray-700">Date:</span>
                            {{ $item->iar_date ?? 'N/A' }}
                        </div>
                        @if ($iarPath)
                            <div class="bg-green-200 p-2 border border-gray-400 col-span-1">
                                <span class="font-semibold text-gray-700">File:</span>
                                <a href="{{ $iarPath }}" class="text-blue-600 underline ml-1" target="_blank">View IAR
                                    File</a>
                            </div>
                        @else
                            <div class="bg-green-200 p-2 border border-gray-400 col-span-1">
                                <span class="font-semibold text-gray-700">File:</span>
                                N/A
                            </div>
                        @endif
                    </div>

                    {{-- ITR Section --}}
                    <div class="grid grid-cols-3 gap-1 mt-1 text-lg text-gray-800 col-span-2">
                        <div
                            class="col-span-3 bg-yellow-100 p-2 border border-gray-400 text-center font-semibold text-gray-700">
                            Inventory Transfer Report
                        </div>
                        <div class="bg-yellow-100 p-2 border border-gray-400">
                            <span class="font-semibold text-gray-700">Ref Code:</span>
                            {{ $item->itr_ref_code ?? 'N/A' }}
                        </div>
                        <div class="bg-yellow-100 p-2 border border-gray-400">
                            <span class="font-semibold text-gray-700">Date:</span>
                            {{ $item->itr_date ?? 'N/A' }}
                        </div>
                        @if ($itrPath)
                            <div class="bg-yellow-100 p-2 border border-gray-400 col-span-1">
                                <span class="font-semibold text-gray-700">File:</span>
                                <a href="{{ $itrPath }}" class="text-blue-600 underline ml-1" target="_blank">View ITR
                                    File</a>
                            </div>
                        @else
                            <div class="bg-yellow-100 p-2 border border-gray-400 col-span-1">
                                <span class="font-semibold text-gray-700">File:</span>
                                N/A
                            </div>
                        @endif
                    </div>
                    <div class="col-span-2">Files Uploaded </div>
                    @php
                        $hasAnyFile =
                            $iarPath || $itrPath || $cocPath || $trainingPath || $deliveryPath || $invoicePath;
                    @endphp

                    {{-- Files --}}
                    @if ($hasAnyFile)
                        @if ($iarPath)
                            <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">IAR
                                    File:</span>
                                <a href="{{ $iarPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($itrPath)
                            <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">ITR
                                    File:</span>
                                <a href="{{ $itrPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($cocPath)
                            <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Certificate of
                                    Completion:</span>
                                <a href="{{ $cocPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($trainingPath)
                            <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Training
                                    Acceptance:</span>
                                <a href="{{ $trainingPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($deliveryPath)
                            <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Delivery
                                    Receipt:</span>
                                <a href="{{ $deliveryPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($invoicePath)
                            <div class="col-span-2 md:col-span-1 "><span class="font-semibold text-gray-700">Invoice
                                    Receipt:</span>
                                <a href="{{ $invoicePath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif
                    @else
                        <div class="col-span-2 md:col-span-1 text-gray-600 italic">Training Acceptance Report : N/A
                        </div>
                        <div class="col-span-2 md:col-span-1 text-gray-600 italic">Delivery Receipt: N/A
                        </div>
                        <div class="col-span-2 md:col-span-1 text-gray-600 italic">Invoice Receipt: N/A
                        </div>
                        <div class="col-span-2 md:col-span-1 text-gray-600 italic">

                            Certificate of Completion: N/A
                        </div>

                        <div class="col-span-2 md:col-span-1 text-gray-600 italic">No uploaded file found for this item.
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
@endsection

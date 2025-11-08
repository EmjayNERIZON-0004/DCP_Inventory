@extends('layout.Admin-Side')

@section('title', 'DCP Inventory')

@section('content')
    <div class="px-6 py-10 max-w-5xl mx-auto">
        <div class="bg-white rounded shadow p-4 mb-4">
            <form method="GET" action="{{ route('index.SchoolsInventory') }}" class="mb-1">
                <input type="hidden" value="{{ $school_pk }}" name="school">

                <button type="submit"
                    class="inline-flex items-center text-2xl font-bold text-blue-700 mb-2 hover:text-blue-800 transition"
                    title="Back">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    {{ $schoolName }}
                </button>

            </form>
            <p class="mb-2">Below are the details of items selected.</p>
        </div>

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

            <div class="bg-white border border-gray-300 rounded-2xl shadow-sm p-6 mb-8">
                <div class="border-b border-gray-200 pb-4 mb-6">

                    <h2 class="text-2xl font-bold text-gray-800">📦 DCP Item Details</h2>
                    <p class="text-lg text-gray-600 mt-1">Code: <span
                            class="font-mono text-gray-800">{{ $item->generated_code }}</span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-10 text-lg text-gray-800">
                    <div><span class="font-semibold text-gray-700">Batch:</span> {{ $batchName }}</div>

                    <div><span class="font-semibold text-gray-700">Product Type:</span>
                        @php
                            $itemType = \App\Models\DCPItemTypes::where(
                                'pk_dcp_item_types_id',
                                $item->item_type_id,
                            )->first();
                            $itemTypeName = $itemType->name;
                        @endphp
                        {{ $itemTypeName }}</div>


                    <div><span class="font-semibold text-gray-700">Quantity:</span> {{ $item->quantity }}</div>
                    <div><span class="font-semibold text-gray-700">Unit:</span> {{ trim($item->unit) }}</div>
                    <div><span class="font-semibold text-gray-700">Brand:</span> {{ $item->brand ?? 'N/A' }}</div>
                    <div><span class="font-semibold text-gray-700">Serial Number:</span> {{ $item->serial_number ?? 'N/A' }}
                    </div>

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
                            <div><span class="font-semibold text-gray-700">IAR File:</span>
                                <a href="{{ $iarPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($itrPath)
                            <div><span class="font-semibold text-gray-700">ITR File:</span>
                                <a href="{{ $itrPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($cocPath)
                            <div><span class="font-semibold text-gray-700">Certificate of Completion:</span>
                                <a href="{{ $cocPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($trainingPath)
                            <div><span class="font-semibold text-gray-700">Training Acceptance:</span>
                                <a href="{{ $trainingPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($deliveryPath)
                            <div><span class="font-semibold text-gray-700">Delivery Receipt:</span>
                                <a href="{{ $deliveryPath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif

                        @if ($invoicePath)
                            <div><span class="font-semibold text-gray-700">Invoice Receipt:</span>
                                <a href="{{ $invoicePath }}" class="text-blue-600 underline ml-1" target="_blank">View</a>
                            </div>
                        @endif
                    @else
                        <div class="text-gray-600 italic">No uploaded file found for this item.</div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

@endsection

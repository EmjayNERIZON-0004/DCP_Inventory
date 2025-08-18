{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Items.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'Batch Items')

@section('content')
    <style>
        input,
        select {
            border: 1px solid #282828;
        }
    </style>

    <div style="transform:translateY(1rem)" class=" p-0 mx-5 ">

        <a href="{{ route('school.dcp_batch') }}" style="font-size:16px"
            class="inline-flex items-center text-blue-600 text-md font-semibold hover:underline mb-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            DCP Batch Package
        </a>
    </div>

    <div id="print-qr-section" style="display:none;">
        <div style="width:210mm;min-height:297mm;padding:0;margin:0;">
            <h2 style="text-align:center;font-size:24px;margin:16px 0;">Batch Items QR Codes</h2>
            <div
                style="
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0;
            width: 140%;
            margin: 0;
            padding: 0;
        ">
                @foreach ($items as $item)
                    <div style="padding:0;box-sizing:border-box;page-break-inside:avoid;">
                        <div style="border:1px solid #ccc;padding:10px;text-align:center;">
                            <div>
                                @php
                                    $url = url("/School/DCPInventory/{$item->generated_code}");
                                    $svg = SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                                        ->size(120)
                                        ->generate($url);
                                @endphp
                                {!! $svg !!}
                            </div>
                            <div style="font-size:14px;margin-top:8px;">
                                <b>{{ $item->generated_code }}</b><br>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function printAllQRCodes() {
            const printContents = document.getElementById('print-qr-section').innerHTML;
            const printWindow = window.open('', '', 'height=900,width=1500');
            printWindow.document.write('<html><head><title>Print QR Codes</title>');
            printWindow.document.write(
                '<style>@media print { body { margin:0;  } }</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }
    </script>
    @if ($batch_approved === null)
        <div class="mx-5 px-2 my-5">
            <h2 class="text-2xl font-bold text-gray-800   text-blue-600">My DCP Batch Item</h2>
            <p class="mb-2">Encode the serial number of the item and other important information.</p>
        </div>
        <div class="bg-white border border-gray-800 rounded-md overflow-hidden p-6 mx-5 my-5  ">


            {{-- Check if we're in display mode (all data submitted) --}}
            @php
                $displayMode =
                    ($batchStatus->coc_status === 'yes' || $batchStatus->coc_status === 'no') &&
                    ($batchStatus->delivery_receipt_status === 'yes' ||
                        $batchStatus->delivery_receipt_status === 'no') &&
                    ($batchStatus->invoice_receipt_status === 'yes' || $batchStatus->invoice_receipt_status === 'no') &&
                    ($batchStatus->training_acceptance_status === 'yes' ||
                        $batchStatus->training_acceptance_status === 'no') &&
                    ($batchStatus->iar_value === 'with IAR' || $batchStatus->iar_value === 'without IAR') &&
                    ($batchStatus->itr_value === 'with ITR' || $batchStatus->itr_value === 'without ITR');
            @endphp

            <h2 class="text-2xl font-bold text-gray-800  mb-4 flex items-center gap-2">
                DCP Batch Status
                @if ($displayMode)
                    <div class="ml-3 text-green-600 font-semibold text-lg">Submitted</div>
                @else
                @endif
            </h2>
            @if ($displayMode)

                <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
                    <div class="bg-blue-200 border border-gray-800 p-3">
                        <label class="font-semibold text-gray-800">Delivery Receipt: <span
                                class="font-medium">{{ ucfirst($batchStatus->delivery_receipt_status) }}</span></label>
                        @if ($batchStatus->delivery_receipt_status === 'yes' && $batchStatus->delivery_receipt_file)
                            <p class="text-gray-800 font-semibold mt-2">Submitted File: <a
                                    href="{{ asset('certificates/delivery-receipt/' . $batchStatus->delivery_receipt_file) }}"
                                    class="text-sm text-blue-800 underline" target="_blank">View File</a></p>
                        @endif
                    </div>
                    <div class="bg-green-200 border border-gray-800 p-3">
                        <label class="font-semibold text-gray-800">Training Acceptance: <span
                                class="font-medium">{{ ucfirst($batchStatus->training_acceptance_status) }}</span></label>
                        @if ($batchStatus->training_acceptance_status === 'yes' && $batchStatus->training_acceptance_file)
                            <p class="text-gray-800 font-semibold mt-2">Submitted File: <a
                                    href="{{ asset('certificates/training-acceptance/' . $batchStatus->training_acceptance_file) }}"
                                    class="text-sm text-blue-800 underline" target="_blank">View File</a></p>
                        @endif
                    </div>
                    <div class="bg-yellow-200 border border-gray-800 p-3">
                        <label class="font-semibold text-gray-800">Invoice Receipt: <span
                                class="font-medium">{{ ucfirst($batchStatus->invoice_receipt_status) }}</span></label>
                        @if ($batchStatus->invoice_receipt_status === 'yes' && $batchStatus->invoice_receipt_file)
                            <p class="text-gray-800 font-semibold mt-2">Submitted File: <a
                                    href="{{ asset('certificates/invoice-receipt/' . $batchStatus->invoice_receipt_file) }}"
                                    class="text-sm text-blue-800 underline" target="_blank">View File</a></p>
                        @endif
                    </div>
                    <div class="bg-red-200 border border-gray-800 p-3">
                        <label class="font-semibold text-gray-800">Inventory Acceptance Report (IAR): <span
                                class="font-medium">{{ $batchStatus->iar_value ? ucfirst(str_replace('_', ' ', $batchStatus->iar_value)) : 'Not Set' }}</span></label>
                        @if ($batchStatus->iar_value === 'with IAR')
                            <div class="mt-2 space-y-2">
                                <p class="font-semibold text-gray-800">IAR Ref Code:
                                    {{ $batchStatus->iar_ref_code ?? 'Not provided' }}</p>
                                <p class="font-semibold text-gray-800">IAR Date:
                                    {{ $batchStatus->iar_date ? date('F j, Y', strtotime($batchStatus->iar_date)) : 'Not provided' }}
                                </p>
                                @if ($batchStatus->iar_file)
                                    <p class="font-semibold text-gray-800">IAR File: <a
                                            href="{{ asset('certificates/iar/' . $batchStatus->iar_file) }}"
                                            class="text-sm text-blue-800 underline" target="_blank">View File</a></p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="bg-purple-200 border border-gray-800 p-3">
                        <label class="font-semibold text-gray-800">Inventory Transfer Report (ITR): <span
                                class="font-medium">{{ $batchStatus->itr_value ? ucfirst(str_replace('_', ' ', $batchStatus->itr_value)) : 'Not Set' }}</span></label>
                        @if ($batchStatus->itr_value === 'with ITR')
                            <div class="mt-2 space-y-2">
                                <p class="font-semibold text-gray-800">ITR Ref Code:
                                    {{ $batchStatus->itr_ref_code ?? 'Not provided' }}</p>
                                <p class="font-semibold text-gray-800">ITR Date:
                                    {{ $batchStatus->itr_date ? date('F j, Y', strtotime($batchStatus->itr_date)) : 'Not provided' }}
                                </p>
                                @if ($batchStatus->itr_file)
                                    <p class="font-semibold text-gray-800">ITR File: <a
                                            href="{{ asset('certificates/itr/' . $batchStatus->itr_file) }}"
                                            class="text-sm text-blue-800 underline" target="_blank">View File</a></p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="bg-indigo-200 border border-gray-800 p-3">
                        <label class="font-semibold text-gray-800">Certificate of Completion: <span
                                class="font-medium">{{ ucfirst($batchStatus->coc_status) }}</span></label>
                        @if ($batchStatus->coc_status === 'yes' && $batchStatus->certificate_of_completion)
                            <p class="text-gray-800 font-semibold mt-2">Submitted File: <a
                                    href="{{ asset('certificates/certificate-completion/' . $batchStatus->certificate_of_completion) }}"
                                    class="text-sm text-blue-800 underline" target="_blank">View File</a></p>
                        @endif
                    </div>
                </div>

                <div class="mt-4 flex justify-start">
                    <button type="button"
                        class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition"
                        onclick="toggleEditMode()">Edit </button><span class="font-semibold text-gray-600"> Not Yet
                        Functional</span>
                </div>
            @else
                {{-- EDIT MODE - Show form inputs --}}
                <form action="{{ route('school.update.batch_status', ['batchId' => $batchId]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-1">

                        {{-- DELIVERY RECEIPT --}}
                        <div class="bg-blue-200 border border-gray-800 p-3">
                            <label class="font-semibold text-gray-800">Delivery Receipt:</label>
                            <select name="delivery_receipt_status" id="delivery_receipt_status"
                                class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                                onchange="toggleFileInput('delivery_receipt')" required>
                                <option value="">Select</option>
                                <option value="yes"
                                    {{ $batchStatus->delivery_receipt_status == 'yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="no"
                                    {{ $batchStatus->delivery_receipt_status == 'no' ? 'selected' : '' }}>No
                                </option>
                            </select>

                            <div id="delivery_receipt_input"
                                class="mt-2 {{ $batchStatus->delivery_receipt_status === 'yes' ? '' : 'hidden' }}">
                                @if ($batchStatus->delivery_receipt_status == 'yes' && !empty($batchStatus->delivery_receipt_file))
                                    <p class="text-gray-800 font-semibold">Submitted File:</p>
                                    <p class="text-sm text-blue-800 underline"><a
                                            href="{{ asset('storage/' . $batchStatus->delivery_receipt_file) }}"
                                            target="_blank">View File</a></p>
                                @else
                                    <label class="font-semibold text-gray-800">Upload File:</label>
                                    <input type="file" name="delivery_receipt_file"
                                        class="border rounded px-3 py-2 w-full mt-1 text-gray-800 bg-white" />
                                @endif
                            </div>
                        </div>

                        {{-- TRAINING ACCEPTANCE --}}
                        <div class="bg-green-200 border border-gray-800 p-3">
                            <label class="font-semibold text-gray-800">Training Acceptance:</label>
                            <select name="training_acceptance_status" id="training_acceptance_status"
                                class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                                onchange="toggleFileInput('training_acceptance')" required>
                                <option value="">Select</option>
                                <option value="yes"
                                    {{ $batchStatus->training_acceptance_status == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no"
                                    {{ $batchStatus->training_acceptance_status == 'no' ? 'selected' : '' }}>No</option>
                            </select>

                            <div id="training_acceptance_input"
                                class="mt-2 {{ $batchStatus->training_acceptance_status === 'yes' ? '' : 'hidden' }}">
                                @if ($batchStatus->training_acceptance_status == 'yes' && !empty($batchStatus->training_acceptance_file))
                                    <p class="text-gray-800 font-semibold">Submitted File:</p>
                                    <p class="text-sm text-blue-800 underline"><a
                                            href="{{ asset('storage/' . $batchStatus->training_acceptance_file) }}"
                                            target="_blank">View File</a></p>
                                @else
                                    <label class="font-semibold text-gray-800">Upload File:</label>
                                    <input type="file" name="training_acceptance_file"
                                        class="border rounded px-3 py-2 w-full mt-1 text-gray-800 bg-white" />
                                @endif
                            </div>
                        </div>

                        {{-- INVOICE RECEIPT --}}
                        <div class="bg-yellow-200 border border-gray-800 p-3">
                            <label class="font-semibold text-gray-800">Invoice Receipt:</label>
                            <select name="invoice_receipt_status" id="invoice_receipt_status"
                                class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                                onchange="toggleFileInput('invoice_receipt')"required>
                                <option value="">Select</option>
                                <option value="yes"
                                    {{ $batchStatus->invoice_receipt_status == 'yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="no"
                                    {{ $batchStatus->invoice_receipt_status == 'no' ? 'selected' : '' }}>No
                                </option>
                            </select>

                            <div id="invoice_receipt_input"
                                class="mt-2 {{ $batchStatus->invoice_receipt_status === 'yes' ? '' : 'hidden' }}">
                                @if ($batchStatus->invoice_receipt_status == 'yes' && !empty($batchStatus->invoice_receipt_file))
                                    <p class="text-gray-800 font-semibold">Submitted File:</p>
                                    <p class="text-sm text-blue-800 underline"><a
                                            href="{{ asset('storage/' . $batchStatus->invoice_receipt_file) }}"
                                            target="_blank">View File</a></p>
                                @else
                                    <label class="font-semibold text-gray-800">Upload File:</label>
                                    <input type="file" name="invoice_receipt_file"
                                        class="border rounded px-3 py-2 w-full mt-1 text-gray-800 bg-white" />
                                @endif
                            </div>
                        </div>

                        {{-- IAR SECTION --}}
                        <div class="bg-red-200 border border-gray-800 p-3">
                            <label class="font-semibold text-gray-800">IAR Status:</label>
                            <select name="iar_value" id="iar_status" required
                                class="border rounded px-3 py-2 w-full mt-1 text-gray-800" onchange="toggleIARFields()">
                                <option value="">Select</option>
                                <option value="yes" {{ $batchStatus->iar_value == 'with IAR' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="no" {{ $batchStatus->iar_value == 'without IAR' ? 'selected' : '' }}>No
                                </option>
                            </select>

                            <div id="iar_fields"
                                class="mt-2 {{ $batchStatus->iar_value == 'with IAR' ? '' : 'hidden' }}">
                                <label class="font-semibold text-gray-800">IAR Ref Code:</label>
                                <input type="text" name="iar_ref_code"
                                    class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                                    value="{{ $batchStatus->iar_ref_code ?? '' }}" />

                                <label class="font-semibold text-gray-800">IAR Date:</label>
                                <input type="date" name="iar_date"
                                    class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                                    value="{{ $batchStatus->iar_date ?? '' }}" />

                                <label class="font-semibold text-gray-800">Upload IAR File:</label>
                                <input type="file" name="iar_file"
                                    class="border rounded px-3 py-2 w-full text-gray-800 bg-white" />

                                @if (!empty($batchStatus->iar_file))
                                    <p class="text-sm text-gray-700 mt-1">Current file: {{ $batchStatus->iar_file }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- ITR SECTION --}}
                        <div class="bg-purple-200 border border-gray-800 p-3">
                            <label class="font-semibold text-gray-800">ITR Status:</label>
                            <select name="itr_value" id="itr_status" required
                                class="border rounded px-3 py-2 w-full mt-1 text-gray-800" onchange="toggleITRFields()">
                                <option value="">Select</option>
                                <option value="yes" {{ $batchStatus->itr_value == 'with ITR' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="no" {{ $batchStatus->itr_value == 'without ITR' ? 'selected' : '' }}>No
                                </option>
                            </select>

                            <div id="itr_fields"
                                class="mt-2 {{ $batchStatus->itr_value == 'with ITR' ? '' : 'hidden' }}">
                                <label class="font-semibold text-gray-800">ITR Ref Code:</label>
                                <input type="text" name="itr_ref_code"
                                    class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                                    value="{{ $batchStatus->itr_ref_code ?? '' }}" />

                                <label class="font-semibold text-gray-800">ITR Date:</label>
                                <input type="date" name="itr_date"
                                    class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white"
                                    value="{{ $batchStatus->itr_date ?? '' }}" />

                                <label class="font-semibold text-gray-800">Upload ITR File:</label>
                                <input type="file" name="itr_file"
                                    class="border rounded px-3 py-2 w-full text-gray-800 bg-white" />

                                @if (!empty($batchStatus->itr_file))
                                    <p class="text-sm text-gray-700 mt-1">Current file: {{ $batchStatus->itr_file }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- CERTIFICATE OF COMPLETION --}}
                        <div class="bg-indigo-200 border border-gray-800 p-3">
                            <label class="font-semibold text-gray-800">Certificate of Completion:</label>
                            <select name="coc_status" id="cert_completion_status"
                                class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                                onchange="toggleFileInput('cert_completion')" required>
                                <option value="">Select</option>
                                <option value="yes" {{ $batchStatus->coc_status == 'yes' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="no" {{ $batchStatus->coc_status == 'no' ? 'selected' : '' }}>No
                                </option>
                            </select>

                            <div id="cert_completion_input"
                                class="mt-2 {{ $batchStatus->coc_status === 'yes' ? '' : 'hidden' }}">
                                @if ($batchStatus->coc_status == 'yes' && !empty($batchStatus->certificate_of_completion))
                                    <p class="text-gray-800 font-semibold">Submitted File:</p>
                                    <p class="text-sm text-blue-800 underline"><a
                                            href="{{ asset('storage/' . $batchStatus->certificate_of_completion) }}"
                                            target="_blank">View File</a></p>
                                @else
                                    <label class="font-semibold text-gray-800">Upload File:</label>
                                    <input type="file" name="certificate_of_completion"
                                        class="border rounded px-3 py-2 w-full mt-1 text-gray-800 bg-white" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-start">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                            Submit
                        </button>
                    </div>
                </form>
            @endif

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toggleFileInput('delivery_receipt');
                toggleFileInput('training_acceptance');
                toggleFileInput('invoice_receipt');
                toggleFileInput('cert_completion');
                toggleIARFields();
                toggleITRFields();
            });

            function toggleFileInput(name) {
                const select = document.getElementById(`${name}_status`);
                const inputWrapper = document.getElementById(`${name}_input`);
                if (!inputWrapper || !select) return;
                inputWrapper.classList.toggle('hidden', select.value !== 'yes');
            }

            function toggleIARFields() {
                const select = document.getElementById('iar_status');
                const fields = document.getElementById('iar_fields');
                if (!fields || !select) return;
                fields.classList.toggle('hidden', select.value !== 'yes');
            }

            function toggleITRFields() {
                const select = document.getElementById('itr_status');
                const fields = document.getElementById('itr_fields');
                if (!fields || !select) return;
                fields.classList.toggle('hidden', select.value !== 'yes');
            }

            function toggleEditMode() {
                // You can implement this to switch back to edit mode
                // This would typically involve reloading the page with edit=true parameter
                // or making an AJAX call to switch modes
                window.location.href = window.location.href + '?edit=true';
            }
        </script>

        <div class="   overflow-hidden p-6 mx-5 my-1">

            <div class="flex justify-between py-1 px-4 bg-blue-200 border border-gray-800 ">
                <h2 class="text-2xl font-semibold text-gray-800 ">Items for Batch:
                    {{ $batch->batch_label ?? '' }}
                </h2>
                <button type="button" onclick="printAllQRCodes()"
                    class="   text-gray-700 font-[Verdana] text-lg  underline hover:text-gray-800  ">
                    Print All QR Codes
                </button>
            </div>
            <!-- Place this somewhere above your table, e.g. after <h2> -->
            <div id="result" class="hidden mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center gap-2"
                    role="alert">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span id="result-message"></span>
                </div>
            </div>




            <div class="overflow-x-auto">
                <table class="min-w-full   text-left border border-gray-200 table-fixed font-medium  text-gray-700 mb-4"
                    style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif  ">
                    <!-- <thead style="background: #2563eb;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">Generated Code</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </thead> -->
                    <tbody class="  divide-y divide-gray-200 space-y-6">
                        @forelse($items as $index => $item)
                            <tr style="border:1px solid white">
                                <td style="height: 30px; border:none; color:white"></td>
                            </tr>

                            <tr>
                                <td x-data="{ open: false }" colspan="13"
                                    class="px-4 py-3 shadow-md bg-white border border-gray-800">
                                    <form id="dcp_update_form_{{ $item->pk_dcp_batch_items_id }}" method="POST"
                                        action="{{ route('school.dcp_items.update', $item->pk_dcp_batch_items_id) }}"
                                        enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <span style="font-bold ">{{ $index + 1 }}.</span>
                                        @php

                                            $status_button = '';
                                            $status_button_bg = ' ';

                                            if ($item->condition_id && $item->brand && $item->serial_number) {
                                                echo '<span class="bg-green-600 px-2 py-1 rounded text-white">Completed</span>';
                                                $status_button = 'Update ';
                                                $status_button_bg = 'bg-yellow-500 ';
                                            } else {
                                                echo '<span class="text-gray-600">Not Completed</span>';
                                                $status_button = 'Submit ';
                                                $status_button_bg = 'bg-blue-600 ';
                                            }
                                        @endphp

                                        {{-- Header --}}
                                        <div @click="open = !open"
                                            class="flex items-center flex-col font-bold cursor-pointer transform scale-100 hover:scale-105 transition duration-200   text-2xl pb-0 "
                                            style="font-family:'Courier New', Courier, monospace; ">
                                            {{ $item->generated_code }}



                                            <div style="font-family:'Verdana', Geneva, Tahoma, sans-serif;"
                                                class="text-sm text-gray-600">
                                                @php
                                                    $item_type = DB::table('dcp_item_types')
                                                        ->where('pk_dcp_item_types_id', $item->item_type_id)
                                                        ->first();
                                                @endphp
                                                ({{ $item_type->name }})
                                            </div>


                                        </div>

                                        {{-- Flex container: QR + Inputs + Buttons --}}
                                        <div x-show="open" x-transition
                                            class="flex flex-col md:flex-row items-start md:items-end md:space-x-6">
                                            {{-- QR on the left --}}


                                            {{-- Inputs + Buttons on the right --}}
                                            <div class="flex-1 space-y-4">
                                                {{-- First row: inputs --}}
                                                <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                                    <div>
                                                        <label class="font-semibold">Quantity:</label>
                                                        <input type="number" name="quantity"
                                                            value="{{ $item->quantity }}"
                                                            class="border rounded px-3 py-2 w-full" />
                                                    </div>
                                                    <div>
                                                        <label class="font-semibold">Condition:</label>
                                                        <select name="condition_id"
                                                            class="border rounded px-3 py-2 w-full">
                                                            <option value="">Select Condition</option>
                                                            @foreach ($conditions as $cond)
                                                                <option value="{{ $cond->pk_dcp_delivery_conditions_id }}"
                                                                    {{ $item->condition_id == $cond->pk_dcp_delivery_conditions_id ? 'selected' : '' }}>
                                                                    {{ $cond->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="font-semibold">Brand:</label>
                                                        {{-- <input type="text" name="brand" value="{{ $item->brand }}"
                                                            class="border rounded px-3 py-2 w-full" /> --}}
                                                        @php
                                                            if ($item->brand) {
                                                                $readonly = 'disabled';
                                                            } else {
                                                                # code...
                                                                $readonly = '';
                                                            }
                                                        @endphp
                                                        <select name="brand" {{ $readonly }}
                                                            class="border rounded px-3 py-2 w-full" id="">
                                                            <option value="" {{ $item->brand ? '' : 'selected' }}>
                                                                Select Brand</option>
                                                            @foreach ($brand_list as $brand)
                                                                <option
                                                                    {{ $item->brand == $brand->pk_dcp_batch_item_brands_id ? 'selected' : '' }}
                                                                    value="{{ $brand->pk_dcp_batch_item_brands_id }}">
                                                                    {{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="font-semibold">Serial Number:</label>
                                                        <input type="text" name="serial_number"
                                                            id="selectedSerialNumber_{{ $item->pk_dcp_batch_items_id }}"
                                                            value="{{ $item->serial_number }}"
                                                            class="border rounded px-3 py-2 w-full" />
                                                    </div>
                                                </div>

                                                {{-- Second row: action buttons --}}
                                                <div class="flex space-x-2">
                                                    <button type="button"
                                                        onclick="update({{ $item->pk_dcp_batch_items_id }})"
                                                        class="px-4 py-2 text-md font-semibold text-white {{ $status_button_bg }} rounded transform scale-100 hover:scale-105 transition duration-200">
                                                        {{ $status_button }}
                                                    </button>
                                                    <a href="/School/DCPInventory/{{ $item->generated_code }}"
                                                        class="px-4 py-2 text-md font-semibold text-white bg-gray-400 rounded hover:bg-gray-500">
                                                        Show in Inventory
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 mb-4 md:mb-0 mt-3 md:mt-0">
                                                @php
                                                    $url = url("/School/DCPInventory/{$item->generated_code}");
                                                    $svg = SimpleSoftwareIO\QrCode\Facades\QrCode::format(
                                                        'svg',
                                                    )->generate($url);
                                                    $base64QrCode = base64_encode($svg);
                                                @endphp
                                                <div class="p-2 border-2 border-dashed border-gray-300">
                                                    <img src="data:image/svg+xml;base64,{{ $base64QrCode }}"
                                                        class="w-28 h-28" alt="QR Code">
                                                    <p class="text-center text-sm mt-1">Scan to show</p>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- Success message --}}
                                        <div id="result_{{ $item->pk_dcp_batch_items_id }}"
                                            class="hidden mt-2 bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded flex items-center gap-2 text-md">
                                            <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span id="result-message-{{ $item->pk_dcp_batch_items_id }}"></span>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-gray-500">
                                    No items found for this batch.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    @else
        <div class="mx-5 my-5 bg-white rounded shadow-xl overflow-hidden p-6 flex flex-col px-auto justify-center">
            <h2 class="text-2xl font-bold text-blue-700">Batch: {{ $batchName }}</h2>
            <h2 class="text-2xl font-bold text-gray-800  ">Check Status of the Items.</h2>
            <span class="text-gray-600">This batch has been approved by admin.</span>
            <div class="mt-5"> <span class="text-sm text-gray-600">Click here.</span>

                <a href="{{ route('school.dcp_item_status', $batchId) }}"
                    class="px-8 py-2 text-md font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">DCP Batch
                    Status</a>
            </div>


        </div>
    @endif
    <script>
        function update(itemId) {
            const form = document.getElementById('dcp_update_form_' + itemId);
            const formData = new FormData(form);
            // Delivery Condition
            if (formData.get('condition_id') === '2' || formData.get('condition_id') === '3') {


            }
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }

                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message inside this form
                        const resultDiv = document.getElementById('result_' + itemId);
                        const resultMsg = document.getElementById('result-message-' + itemId);
                        resultMsg.innerText = "Item updated successfully!";
                        resultDiv.classList.remove('hidden');
                        const serialInput = document.getElementById('selectedSerialNumber_' + itemId);
                        serialInput.classList.remove('border-red-500');
                        console.log(data);

                    } else {
                        const serialInput = document.getElementById('selectedSerialNumber_' + itemId);
                        serialInput.value = '';
                        serialInput.classList.add('border-red-500'); // highlight as error
                        alert('Error: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the item.');
                });
        }
    </script>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach($items as $item): ?>
        toggleIARInputs(<?= $item->pk_dcp_batch_items_id ?>);
        toggleITRInputs(<?= $item->pk_dcp_batch_items_id ?>);
        <?php endforeach; ?>
    });

    function toggleIARInputs(id) {
        var iarValue = document.getElementById('iar_value_' + id).value;
        var refCode = document.getElementById('iar_ref_code_' + id);
        var date = document.getElementById('iar_date_' + id);
        if (iarValue !== 'with IAR') {
            refCode.disabled = true;
            date.disabled = true;
        } else {
            refCode.disabled = false;
            date.disabled = false;
        }
    }



    document.addEventListener('DOMContentLoaded', function() {
        // Generate an array of item IDs using Blade/PHP and pass to JS
        const itemIds = <?php json_encode($items->pluck('pk_dcp_batch_items_id')); ?>;
        itemIds.forEach(function(id) {
            toggleIARInputs(id);
            toggleITRInputs(id);
        });
    });
</script>
<script src="//unpkg.com/alpinejs" defer></script>

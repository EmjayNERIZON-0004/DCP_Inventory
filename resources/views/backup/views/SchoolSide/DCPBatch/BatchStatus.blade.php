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

        <a href="{{ route('school.dcp_batch') }}"
            class="inline-flex items-center text-blue-600 text-md font-semibold hover:underline mb-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            DCP Batch Package
        </a>
    </div>
         <div class="mx-5 px-2 my-5">
            <h2 class="text-2xl font-bold text-gray-800   text-blue-600">School DCP Batch Status</h2>
            <p class="mb-2">This is required to comply with the DCP Regulations.</p>
        </div>

<div class="my-5 mx-5">
        <div class="bg-white border border-gray-300 shadow-md rounded-md overflow-hidden p-6 mx-5 my-5  ">


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
@endsection
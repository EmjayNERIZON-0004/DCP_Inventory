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
    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5 border border-gray-300">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">DCP Batch Status</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
            <!-- Delivery Receipt -->
            <div class="bg-blue-200 border border-gray-800  border border-gray-800  p-3">
                <label class="font-semibold text-gray-800">Delivery Receipt:</label>
                <select name="delivery_receipt_status" id="delivery_receipt_status"
                    class="border rounded px-3 py-2 w-full mt-1 text-gray-800" onchange="toggleFileInput('delivery_receipt')">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label class="font-semibold text-gray-800 hidden" id="delivery_receipt_label">Upload Delivery
                    Receipt:</label>
                <input type="file" name="delivery_receipt_file" id="delivery_receipt_file"
                    class="border rounded px-3 py-2 w-full mt-2 hidden text-gray-800 bg-white" />
            </div>

            <!-- Training Acceptance -->
            <div class="bg-green-200  border border-gray-800  p-3">
                <label class="font-semibold text-gray-800">Training Acceptance Report:</label>
                <select name="training_acceptance_status" id="training_acceptance_status"
                    class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                    onchange="toggleFileInput('training_acceptance')">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label class="font-semibold text-gray-800 hidden" id="training_acceptance_label">Upload TAR:</label>

                <input type="file" name="training_acceptance_file" id="training_acceptance_file"
                    class="border rounded px-3 py-2 w-full mt-2 hidden text-gray-800 bg-white" />
            </div>

            <!-- Invoice Receipt -->
            <div class="bg-yellow-200  border border-gray-800  p-3">
                <label class="font-semibold text-gray-800">Invoice-Receipt for Property:</label>
                <select name="invoice_receipt_status" id="invoice_receipt_status"
                    class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                    onchange="toggleFileInput('invoice_receipt')">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <label class="font-semibold text-gray-800 hidden" id="invoice_receipt_label">Upload Invoice-Receipt:</label>

                <input type="file" name="invoice_receipt_file" id="invoice_receipt_file"
                    class="border rounded px-3 py-2 w-full mt-2 hidden text-gray-800 bg-white" />
            </div>

            <!-- IAR Section -->
            <div class="bg-red-200  border border-gray-800  p-3">
                <label class="font-semibold text-gray-800">IAR Status:</label>
                <select name="iar_status" id="iar_status" class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                    onchange="toggleIARFields()">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <div id="iar_fields" class="mt-2 hidden">
                    <label class="font-semibold text-gray-800">IAR Ref Code:</label>
                    <input type="text" name="iar_ref_code"
                        class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white" />
                    <label class="font-semibold text-gray-800">IAR Date:</label>
                    <input type="date" name="iar_date"
                        class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white" />
                    <label class="font-semibold text-gray-800">Upload IAR File:</label>
                    <input type="file" name="iar_file" class="border rounded px-3 py-2 w-full text-gray-800 bg-white" />
                </div>
            </div>

            <!-- ITR Section -->
            <div class="bg-purple-200  border border-gray-800  p-3">
                <label class="font-semibold text-gray-800">ITR Status:</label>
                <select name="itr_status" id="itr_status" class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                    onchange="toggleITRFields()">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <div id="itr_fields" class="mt-2 hidden">
                    <label class="font-semibold text-gray-800">ITR Ref Code:</label>
                    <input type="text" name="itr_ref_code"
                        class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white" />
                    <label class="font-semibold text-gray-800">ITR Date:</label>
                    <input type="date" name="itr_date"
                        class="border rounded px-3 py-2 w-full mb-2 text-gray-800 bg-white" />
                    <label class="font-semibold text-gray-800">Upload ITR File:</label>
                    <input type="file" name="itr_file" class="border rounded px-3 py-2 w-full text-gray-800 bg-white" />
                </div>
            </div>

            <!-- Certification of Completion -->
            <div class="bg-indigo-200    border border-gray-800  p-3">
                <label class="font-semibold text-gray-800">Certification of Completion:</label>
                <select name="cert_completion_status" id="cert_completion_status"
                    class="border rounded px-3 py-2 w-full mt-1 text-gray-800"
                    onchange="toggleFileInput('cert_completion')">
                    <option value="">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>

                <label class="font-semibold text-gray-800 hidden" id="cert_completion_label">Upload Certificate of
                    Completion:</label>

                <input type="file" name="cert_completion_file" id="cert_completion_file"
                    class="border rounded px-3 py-2 w-full mt-2 hidden text-gray-800 bg-white" />
            </div>
        </div>
    </div>






    <script>
        function toggleIARFields() {
            const status = document.getElementById('iar_status').value;
            const fields = document.getElementById('iar_fields');
            fields.classList.toggle('hidden', status !== 'yes');
        }

        function toggleITRFields() {
            const status = document.getElementById('itr_status').value;
            const fields = document.getElementById('itr_fields');
            fields.classList.toggle('hidden', status !== 'yes');
        }

        function toggleFileInput(name) {
            const status = document.getElementById(`${name}_status`).value;
            const fileInput = document.getElementById(`${name}_file`);
            const fileLabel = document.getElementById(`${name}_label`);
            fileInput.classList.toggle('hidden', status !== 'yes');
            fileLabel.classList.toggle('hidden', status !== 'yes');
        }
    </script>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Items for Batch: {{ $batch->batch_label ?? '' }}</h2>

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
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-20">Unit</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-20">Quantity</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">Condition</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">Brand</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-40">Serial Number</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">IAR Ref Code</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">IAR Date</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">ITR Ref Code</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">ITR Date</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-40">Certificate of Completion</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-32">Date Approved</th>
                                                                                                                                                                                                                                                                                                                                <th class="px-4 py-3 text-white border-r border-blue-700 w-40">Action</th>
                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                        </thead> -->
                <tbody class="bg-white divide-y divide-gray-200 space-y-6">
                    @forelse($items as $item)
                        <tr style="border:1px solid  white">
                            <td style="height: 30px;border:none;color:white"> </td>
                        </tr>

                        <tr>
                            <td colspan="13" class="px-4 py-3  shadow-md " style="border:1px solid #ccc">
                                <form id="dcp_update_form_{{ $item->pk_dcp_batch_items_id }}" method="POST"
                                    action="{{ route('school.dcp_items.update', $item->pk_dcp_batch_items_id) }}"
                                    enctype="multipart/form-data" class="space-y-2">
                                    @csrf
                                    @method('PUT')

                                    <div class="font-bold text-2xl pb-5  "
                                        style="font-family:'Courier New', Courier, monospace;">
                                        {{ $item->generated_code }}
                                        @php
                                            $item_type = DB::table('dcp_item_types')
                                                ->where('pk_dcp_item_types_id', $item->item_type_id)
                                                ->first();
                                        @endphp
                                        ({{ $item_type->name }})
                                    </div>

                                    <!-- First row -->
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                        <div>
                                            <label class="font-semibold">Quantity:</label>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                class="border rounded px-3 py-2 w-full" />
                                        </div>
                                        <div>
                                            <label class="font-semibold">Condition:</label>
                                            <select name="condition_id" class="border rounded px-3 py-2 w-full">
                                                <option value=""> Select Condition </option>
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
                                            <input type="text" name="brand" value="{{ $item->brand }}"
                                                class="border rounded px-3 py-2 w-full" />
                                        </div>
                                        <div>
                                            <label class="font-semibold">Serial Number:</label>
                                            <input type="text" name="serial_number"
                                                value="{{ $item->serial_number }}"
                                                class="border rounded px-3 py-2 w-full" />
                                        </div>
                                    </div>

                                    <!-- Second row -->


                                    <!-- Success message for this form -->
                                    <div class="md:col-span-4  hidden" id="result_{{ $item->pk_dcp_batch_items_id }}"
                                        class="hidden mt-2">
                                        <div
                                            class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded flex items-center gap-2 text-md">
                                            <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span id="result-message-{{ $item->pk_dcp_batch_items_id }}"></span>
                                        </div>
                                    </div>

                                    <div class="md:col-span-1 col-span-4 flex gap-2 mt-2">
                                        <button type="button" onclick="update(<?= $item->pk_dcp_batch_items_id ?>)"
                                            class="px-3 py-2 w-1/2 md:w-1/12 text-md font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                                            Update
                                        </button>

                                        <button type="button"
                                            class="px-3 py-2 w-1/2 md:w-1/12 text-md font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">More
                                            Details</button>

                                    </div>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="13" class="text-center py-4 text-gray-500">No items found for this batch.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script>
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

    // function toggleITRInputs(id) {
    //     var itrValue = document.getElementById('itr_value_' + id).value;
    //     var refCode = document.getElementById('itr_ref_code_' + id);
    //     var date = document.getElementById('itr_date_' + id);
    //     if (itrValue !== 'with ITR') {
    //         refCode.disabled = true;
    //         date.disabled = true;
    //     } else {
    //         refCode.disabled = false;
    //         date.disabled = false;
    //     }
    // }


    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach($items as $item): ?>
        toggleIARInputs(<?= $item->pk_dcp_batch_items_id ?>);
        toggleITRInputs(<?= $item->pk_dcp_batch_items_id ?>);
        <?php endforeach; ?>
    });
</script>


<script>
    function update(itemId) {
        const form = document.getElementById('dcp_update_form_' + itemId);
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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

                } else {
                    alert('Error: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the item.');
            });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate an array of item IDs using Blade/PHP and pass to JS
        const itemIds = <?php json_encode($items->pluck('pk_dcp_batch_items_id')); ?>;
        itemIds.forEach(function(id) {
            toggleIARInputs(id);
            toggleITRInputs(id);
        });
    });
</script>

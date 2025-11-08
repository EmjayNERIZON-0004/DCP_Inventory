{{-- filepath: resources/views/AdminSide/DCPBatch/Items.blade.php --}}

@extends('layout.Admin-Side')

@section('title', 'Batch Items')

@section('content')
    <!-- MODAL OVERLAY -->
    <div id="addItemModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
        <!-- MODAL CONTENT -->
        <div class="bg-white shadow-xl rounded-lg p-6 border border-blue-500 w-full max-w-4xl relative">
            <button onclick="closeAddItemModal()"
                class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl font-bold">&times;</button>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add Item to Batch: {{ $batch->batch_label }}</h2>

            <!-- SUCCESS RESULT -->
            <div id="result" class="hidden mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center gap-2"
                    role="alert" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span id="result-message"></span>
                </div>
            </div>

            <!-- FORM -->
            <form method="POST" id="add_item_form" action="{{ route('store.items', $batch->pk_dcp_batches_id) }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="font-semibold">Item Type</label>
                        <select name="item_type_id" class="w-full border rounded px-2 py-1" required>
                            <option value="">-- Select Item Type --</option>
                            @foreach ($itemTypes as $type)
                                <option value="{{ $type->pk_dcp_item_types_id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">Quantity</label>
                        <input type="number" name="quantity" class="w-full border rounded px-2 py-1" required>
                    </div>

                    <div>
                        <label class="font-semibold">Unit</label>
                        <input type="text" name="unit" class="w-full border rounded px-2 py-1" required>
                    </div>

                    <div>
                        <label class="font-semibold">Condition Upon Delivery</label>
                        <select name="condition_id" class="w-full border rounded px-2 py-1">
                            <option value="" selected>-- Edit Upon Delivery --</option>
                            @foreach ($conditions as $condition)
                                <option disabled value="{{ $condition->pk_dcp_delivery_condition_id }}">
                                    {{ $condition->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- FORM BUTTONS -->
                <div class="mt-6 flex justify-end gap-2">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Add Item
                    </button>
                    <button type="button" onclick="closeAddItemModal()"
                        class="px-6 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openAddItemModal() {
            document.getElementById('addItemModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // disable background scroll

        }

        function closeAddItemModal() {
            document.getElementById('addItemModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden'); // re-enable scroll
            document.getElementById('add_item_form').reset(); // optional: reset form
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('add_item_form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
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
                            form.reset();
                            const resultDiv = document.getElementById('result');
                            const resultMsg = document.getElementById('result-message');
                            resultMsg.innerText = "Item added successfully!";
                            resultDiv.classList.remove('hidden');
                            // Refresh the table

                            refreshItemsTable(data.pk_dcp_batch_id);
                        } else {
                            alert('Error adding item: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        function refreshItemsTable(batchId) {
            fetch(`/Admin/DCPBatch/${batchId}/items/json`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#table_item tbody');
                    tbody.innerHTML = '';

                    // Group items by item_type_id
                    const grouped = {};
                    data.items.forEach(item => {
                        if (!grouped[item.item_type_id]) {
                            grouped[item.item_type_id] = [];
                        }
                        grouped[item.item_type_id].push(item);
                    });

                    // You may need a mapping of item_type_id to name (from PHP or via AJAX)
                    // For demo, let's assume you have a JS object like:
                    // const itemTypeNames = {1: 'Laptop', 2: 'Tablet', ...};
                    // You can render this from PHP as a JS variable if needed.
                    const itemTypeNames = window.itemTypeNames || {};

                    // Render grouped rows
                    Object.keys(grouped).forEach(typeId => {
                        // Group header row
                        const groupRow = document.createElement('tr');
                        groupRow.className = 'bg-blue-100';
                        groupRow.innerHTML = `
                        <td colspan="7" class="font-bold text-blue-900 px-4 py-2">
                            ${itemTypeNames[typeId] || typeId}
                        </td>
                    `;
                        tbody.appendChild(groupRow);

                        // Group items
                        grouped[typeId].forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td class="px-4 py-3 border-r border-gray-200"></td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.generated_code}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.unit_price}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.quantity}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.unit}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.condition_name ?? '--'}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.brand ?? '--'}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.serial_number ?? '--'}</td>
                        `;
                            tbody.appendChild(row);
                        });
                    });
                });
        }

        window.itemTypeNames = @json($itemTypes->pluck('name', 'pk_dcp_item_types_id'));
    </script>




    <div class="bg-white shadow-xl rounded-lg border border-gray-500 overflow-hidden p-6 mx-5 my-5 mt-8">
        <h2 class="text-2xl font-bold text-gray-800">Batch Items List</h2>
        <div class="text-md text-gray-600 mb-5">For Viewing and Monitoring the items in the batch</div>

        @php
            $groupedItems = $items->groupBy('item_type_id');
        @endphp

        <div class="space-y-6">
            @foreach ($groupedItems as $typeId => $groupByType)
                @php
                    $itemType = $itemTypes->firstWhere('pk_dcp_item_types_id', $typeId);
                    $itemTypeName = $itemType->name ?? 'Unknown Type';
                    $groupedByName = $groupByType->groupBy('item_name');
                @endphp

                <!-- Group Header -->
                <div class="border-l-4 border-blue-500 pl-3">
                    <h3 class="text-xl font-semibold text-blue-700">{{ $itemTypeName }}</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($groupedByName as $itemName => $groupedItemsByName)
                        @foreach ($groupedItemsByName as $item)
                            <div
                                class="bg-white shadow-md rounded-sm border border-gray-300 p-4 hover:shadow-lg transition">
                                <h4 class="text-lg font-bold text-gray-800 mb-2">
                                    {{ $itemName ?? 'Unnamed Item' }}
                                </h4>
                                <p class="text-sm text-gray-600"><span class="font-semibold">Generated Code:</span>
                                    {{ $item->generated_code }}</p>
                                <p class="text-sm text-gray-600"><span class="font-semibold">Price:</span>
                                    ₱{{ number_format($item->unit_price, 2) }}</p>
                                <p class="text-sm text-gray-600"><span class="font-semibold">Quantity:</span>
                                    {{ $item->quantity }} {{ $item->unit }}</p>
                                <p class="text-sm text-gray-600"><span class="font-semibold">Condition:</span>
                                    {{ $item->dcpCondition->name ?? 'N/A' }}</p>
                                @php
                                    $brandName = null;
                                    if ($item->brand) {
                                        $brandName = App\Models\DCPBatchItemBrand::where(
                                            'pk_dcp_batch_item_brands_id',
                                            $item->brand,
                                        )->value('brand_name');
                                    }
                                @endphp
                                <p class="text-sm text-gray-600"><span class="font-semibold">Brand:</span>
                                    {{ $brandName ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600"><span class="font-semibold">Serial No.:</span>
                                    {{ $item->serial_number ?? 'N/A' }}</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>



    <button type="button"
        class="px-6 py-1 hidden text-md bg-red-500 text-white rounded-md hover:bg-red-600 transition mb-4"
        onclick="clearContent(<?= $batch->pk_dcp_batches_id ?>)">Clear All</button>
    <script>
        function clearContent(batchId) {
            if (confirm("Are you sure you want to clear the content?")) {
                fetch(`/Admin/DCPBatch/${batchId}/items/clear`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Content cleared successfully!');
                            refreshItemsTable(batchId);
                        } else {
                            alert('Error clearing content: ' + data.message);
                        }
                    })

            }
        }
    </script>

@endsection

{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Items.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'Batch Items')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Items for Batch: {{ $batch->batch_label ?? '' }}</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <thead style="background: #2563eb;">
                <tr>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Generated Code</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Item Type</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Unit</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Condition</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Brand</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Serial Number</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Action  </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                <tr id="row-{{ $item->pk_dcp_batch_items_id }}">
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->generated_code }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">
                        {{ $itemTypes->firstWhere('pk_dcp_item_types_id', $item->item_type_id)->name ?? $item->item_type_id }}
                    </td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->unit }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">
                        @php
                            $condition = $conditions->firstWhere('pk_dcp_delivery_conditions_id', $item->condition_id);
                        @endphp
                        {{ $condition ? $condition->name : '--' }}
                    </td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->brand ?? '--' }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->serial_number ?? '--' }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">
                        <button type="button"
                            class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600"
                            onclick="showEditForm(<?= $item->pk_dcp_batch_items_id ?>)">
                            Select
                        </button>
                    </td>
                </tr>
                <!-- Hidden Edit Row -->
                <tr id="edit-row-{{ $item->pk_dcp_batch_items_id }}" style="display:none;">
                    <td colspan="7">
                        <form method="POST" action="{{ route('school.dcp_items.update', $item->pk_dcp_batch_items_id) }}" class="flex flex-wrap gap-2 items-center">
                            @csrf
                            @method('PUT')
                            <input type="text" name="brand" value="{{ $item->brand }}" placeholder="Brand" class="border rounded px-2 py-1" />
                            <input type="text" name="serial_number" value="{{ $item->serial_number }}" placeholder="Serial Number" class="border rounded px-2 py-1" />
                            <select name="condition_id" class="border rounded px-2 py-1">
                                <option value="">-- Select Condition --</option>
                                @foreach($conditions as $cond)
                                    <option value="{{ $cond->pk_dcp_delivery_conditions_id }}" {{ $item->condition_id == $cond->pk_dcp_delivery_conditions_id ? 'selected' : '' }}>
                                        {{ $cond->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded hover:bg-green-600">Update</button>
                            <button type="button" class="px-3 py-1 text-xs font-semibold text-white bg-gray-500 rounded hover:bg-gray-600" onclick="hideEditForm(<?= $item->pk_dcp_batch_items_id ?>)">Cancel</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No items found for this batch.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script>
function showEditForm(id) {
    document.getElementById('edit-row-' + id).style.display = '';
}
function hideEditForm(id) {
    document.getElementById('edit-row-' + id).style.display = 'none';
}
</script>
@endsection
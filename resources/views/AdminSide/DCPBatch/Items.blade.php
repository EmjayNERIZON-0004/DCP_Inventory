{{-- filepath: resources/views/AdminSide/DCPBatch/Items.blade.php --}}

@extends('layout.Admin-Side')

@section('title', 'Batch Items')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Add Item to Batch: {{ $batch->batch_label }}</h2>
    <form method="POST" action="{{ route('store.items', $batch->pk_dcp_batches_id) }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="font-semibold">Item Type</label>
                <select name="item_type_id" class="w-full border rounded px-2 py-1" required>
                    <option value="">-- Select Item Type --</option>
                    @foreach($itemTypes as $type)
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
            
          

                <div>  <label class="font-semibold">Condition Upon Delivery</label>
                <select name="condition_id" class="w-full border rounded px-2 py-1"  >
                    <option value="" selected>-- Edit Upon Delivery  --</option>
                    @foreach($conditions as $condition)
                        <option disabled value="{{ $condition->pk_dcp_delivery_condition_id }}">{{ $condition->name }}</option>
                    @endforeach
                </select></div>
            
            <!-- Add more fields as needed -->
        </div>
        <div class="mt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Add Item</button>
        </div>
    </form>
</div>

<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Batch Items List</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <thead style="background: #2563eb;">
                <tr>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Item Type</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Generated Code</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Quantity</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Unit</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Condition</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Brand</th>
                    <th class="px-4 py-3 text-white border-r border-blue-700">Serial Number</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($items as $item)
                <tr>
                    <td class="px-4 py-3 border-r border-gray-200">
                        {{ $itemTypes->firstWhere('pk_dcp_item_types_id', $item->item_type_id)->name ?? $item->item_type_id }}
                    </td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->generated_code }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->quantity }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $item->unit }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">
             @php
        $condition = $conditions->firstWhere('pk_dcp_delivery_conditions_id', $item->condition_id);
    @endphp
    {{ $condition ? $condition->name : '--' }}
 
                    </td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ ($item->brand != null) ? $item->brand : '--' }}</td>
                    <td class="px-4 py-3 border-r border-gray-200"> {{($item->serial_number != null) ? $item->serial_number : '--' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\AdminSide\DCPBatch\Batch.blade.php --}}

@extends('layout.Admin-Side')

@section('title', 'DCP Batches')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Add DCP Batch</h2>
    <form method="POST"  action="{{ route('store.batch') }}" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="font-semibold">Package Type</label>
                <select name="dcp_package_type_id" class="w-full border rounded px-2 py-1" required>
                    <option value="">-- Select Package Type --</option>
                    @foreach($packageTypes as $type)
                        <option value="{{ $type->pk_dcp_package_types_id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">School</label>
                <select name="school_id" class="w-full border rounded px-2 py-1" required>
                    <option value="">-- Select School --</option>
                @foreach($schools as $school)
                   
    <option 
        value="{{ $school->pk_school_id }}" 
        data-email="{{ $school->SchoolEmailAddress }}"
    >
        {{ $school->SchoolName }} - {{ $school->SchoolLevel }}
    </option>
@endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Batch Label</label>
                <input type="text" name="batch_label" class="w-full border rounded px-2 py-1" required>
            </div>
            <div>
                <label class="font-semibold">Budget Year</label>
                <input type="number" name="budget_year" class="w-full border rounded px-2 py-1" required>
            </div>
            <div>
                <label class="font-semibold">Delivery Date</label>
                <input type="date" name="delivery_date" class="w-full border rounded px-2 py-1" required>
            </div>
            <div>
                <label class="font-semibold">Supplier Name</label>
                <input type="text" name="supplier_name" class="w-full border rounded px-2 py-1" required>
            </div>
            <div>
                <label class="font-semibold">Mode of Delivery</label>
                <input type="text" name="mode_of_delivery" class="w-full border rounded px-2 py-1" required>
            </div>
            <div>
                <label class="font-semibold">Submission Status</label>
                <div class="flex space-x-2 mt-1">
                    <button type="button" class="px-3 py-1 rounded bg-green-500 text-white opacity-50 cursor-not-allowed" disabled>
                        Approved
                    </button>
                    <button type="button" class="px-3 py-1 rounded bg-yellow-500 text-white font-bold" disabled style="opacity:1;">
                        For Editing
                    </button>
                    <button type="button" class="px-3 py-1 rounded bg-blue-500 text-white opacity-50 cursor-not-allowed" disabled>
                        For Updating
                    </button>
                </div>
                <input type="hidden" name="submission_status" value="For Editing">
            </div>

             <div class="md:col-span-1">
             
    <label class="font-semibold">School Email Address</label>
    <input type="email" id="school-email" name="school_email" class="w-full border rounded px-2 py-1" readonly>
 
            </div>

            <div class="md:col-span-3">
                <label class="font-semibold">Description</label>
                <textarea name="description" class="w-full border rounded px-2 py-1"></textarea>
            </div>
           
        </div>
        <div class="mt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Add Batch</button>
        </div>
    </form>
</div>

<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">DCP Batch List</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <thead style="background: #2563eb;">
                <tr>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Batch Label</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Description</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">School ID</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">School</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">School Level</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Package Type</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Budget Year</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Delivery Date</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Supplier</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Mode of Delivery</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Status</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($dcpBatches as $batch)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->batch_label }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->description }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->school_id ?? 'N/A' }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->school_name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->school_level }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->package_type_name ?? 'N/A' }}</td>
                    
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->budget_year }}</td>
               <td class="px-4 py-3 border-r border-gray-200">
    {{ $batch->delivery_date ? \Carbon\Carbon::parse($batch->delivery_date)->format('F d, Y') : 'N/A' }}
</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->supplier_name }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->mode_of_delivery }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $batch->submission_status }}</td>
           <td class="px-4 py-3 space-x-2">
    <a href="{{ route('index.items', $batch->id ?? $batch->pk_dcp_batches_id) }}"
       class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
        Add Items
    </a>
    <a  
       class="inline-block px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded hover:bg-green-600">
        Edit
    </a>
    <form   method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit"
                onclick="return confirm('Are you sure you want to delete this batch?')"
                class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600">
            Delete
        </button>
    </form>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const schoolSelect = document.querySelector('select[name="school_id"]');
    const emailInput = document.getElementById('school-email');

    if (schoolSelect && emailInput) {
        schoolSelect.addEventListener('change', function () {
            const selected = schoolSelect.options[schoolSelect.selectedIndex];
            emailInput.value = selected.getAttribute('data-email') || '';
        });

        // Optionally, trigger on page load if a school is pre-selected
        if (schoolSelect.value) {
            const selected = schoolSelect.options[schoolSelect.selectedIndex];
            emailInput.value = selected.getAttribute('data-email') || '';
        }
    }
});
</script>
@endsection
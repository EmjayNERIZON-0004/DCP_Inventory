{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Batch.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'My DCP Batches')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
    <h2 class="text-2xl font-bold text-gray-800 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">My DCP Batches</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <thead style="background: #2563eb;">
                <tr>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Batch Label</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Package Type</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Budget Year</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Delivery Date</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Supplier</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Status</th>
                    <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($batch as $b)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-4 py-3 border-r border-gray-200">{{ $b->batch_label }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $b->package_type_name }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $b->budget_year }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">
                        {{ $b->delivery_date ? \Carbon\Carbon::parse($b->delivery_date)->format('F d, Y') : 'N/A' }}
                    </td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $b->supplier_name }}</td>
                    <td class="px-4 py-3 border-r border-gray-200">{{ $b->submission_status }}</td>
                 <td class="px-4 py-3 space-x-2">
    <a href="{{ route('school.dcp_items', $b->id ?? $b->pk_dcp_batches_id) }}"
       class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
        Show Items
    </a>
                 </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No DCP batches found for your school.</td>
                </tr>
                @endforelse
            </tbody>
        </table>


 </div>
</div>
@endsection
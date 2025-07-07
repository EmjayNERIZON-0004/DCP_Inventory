@extends('layout.SchoolSideLayout')

@section('title', 'DCP Documents')

@section('content')
    <div class="max-w-7xl mx-auto bg-white rounded shadow p-8 mt-8">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">DCP Inventory</h1>
        <p class="mb-2">Below is a sample list of DCP equipment assigned to your school.</p>
        <table class="min-w-full bg-white border mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Batch Label</th>
                    <th class="px-4 py-2 border">School</th>
                    <th class="px-4 py-2 border">Item</th>
                    <th class="px-4 py-2 border">Code</th>
                    <th class="px-4 py-2 border">Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($batch_items as $batch_item)
                    <tr>
                        <td class="px-4 py-2 border">{{ $batch_item->batch_label }}</td>
                        <td class="px-4 py-2 border">
                            @php
                                $school = \App\Models\School::firstWhere('pk_school_id', $batch_item->school_id);
                            @endphp
                            {{ $school->SchoolName }}
                        </td>
                        <td class="px-4 py-2 border">
                            @php
                                $item_name = \App\Models\DCPItemTypes::firstWhere(
                                    'pk_dcp_item_types_id',
                                    $batch_item->item_type_id,
                                );
                            @endphp
                            {{ $item_name->name }}</td>

                        <td class="px-4 py-2 border">
                            {{ $batch_item->generated_code }}
                        </td>
                        <td>
                            <a href="{{ route('school.dcp_inventory.items', $batch_item->generated_code) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1   px-5 rounded">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

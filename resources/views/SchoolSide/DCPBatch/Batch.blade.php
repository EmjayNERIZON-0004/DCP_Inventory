{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Batch.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'My DCP Batches')

@section('content')
    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5" style="border:1px solid #ccc">
        <h2 class="text-2xl font-bold text-gray-800   text-blue-600">My DCP Batches</h2>
        <p class="mb-2">Here are thelist of DCP Batches for your school.</p>

        <div class="overflow-x-auto border border-gray-200 rounded-sm md:border-none shadow-md md:shadow-none">
            <table class="min-w-full   text-left border border-gray-200" style="  font-size: 16px ">
                <thead class="bg-gray-700  border border-gray-700 ">
                    <tr>
                        <th class="px-4 py-3 font-bold  whitespace-nowrap tracking-wider text-white  ">
                            Batch Label</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap  tracking-wider text-white  ">
                            DCP Items</th>
                        <th class="px-4 py-3 font-bold whitespace-nowrap  tracking-wider text-white  ">
                            Package Type</th>
                        <th class="px-4 py-3 font-bold  whitespace-nowrap tracking-wider text-white  ">
                            Budget Year</th>
                        <th class="px-4 py-3 font-bold  whitespace-nowrap tracking-wider text-white  ">
                            Delivery Date</th>
                        <th class="px-4 py-3 font-bold   tracking-wider text-white  ">
                            Supplier</th>
                        <th class="px-4 py-3 font-bold   tracking-wider text-white  ">
                            Status</th>
                        <th class="px-4 py-3 font-bold   tracking-wider text-white  ">
                            Submit</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($batch as $b)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border border-gray-300">{{ $b->batch_label }} </td>
                            <td class="px-2 py-3 md:px-4 space-x-2 border border-gray-300">
                                <a href="{{ route('school.dcp_items', $b->id ?? $b->pk_dcp_batches_id) }}"
                                    style="font-size:16px"
                                    class="  text-xs font-semibold  text-blue-500 rounded hover:text-blue-600 underline">
                                    Show Items
                                </a>
                            </td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->package_type_name }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->budget_year }}</td>
                            <td class="px-4 py-3 border border-gray-300">
                                {{ $b->delivery_date ? \Carbon\Carbon::parse($b->delivery_date)->format('F d, Y') : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->supplier_name }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $b->submission_status }}</td>

                            <td class="px-4 py-3 border border-gray-300">
                                @if (!$b->status_submitted)
                                    <form action="{{ route('submit.dcp_batch') }}" method="POST">
                                        @csrf
                                        <input class="hidden" type="text" name="dcp_batch_id"
                                            value="{{ $b->id }}">

                                        <button
                                            class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-4 rounded">Submit</button>
                                    </form>
                                @else
                                    @php
                                        $text_color = '';
                                        if ($b->status_submitted == 'Approved') {
                                            $text_color = 'text-green-500';
                                        } elseif ($b->status_submitted == 'Rejected') {
                                            $text_color = 'text-red-500';
                                        } elseif ($b->status_submitted == 'Pending') {
                                            $text_color = 'text-yellow-500';
                                        }
                                    @endphp
                                    <span class="{{ $text_color }} font-bold">{{ $b->status_submitted }}</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No DCP batches found for your school.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
@endsection

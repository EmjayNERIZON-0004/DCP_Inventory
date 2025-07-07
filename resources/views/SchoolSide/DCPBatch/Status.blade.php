@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Batch')</title>
@section('content')
    <div class="mx-5 my-5">

        <h2 class="text-2xl font-bold text-blue-700">{{ $batchName }}</h2>
        <span class="text-gray-600">Date Delivered: {{ $batchDeliveryDate ?? 'N/A' }}</span>
        <table>
            <thead>
                <th class="px-4 py-3 bg-blue-600 text-white">Item Code</th>
                <th class="px-4 py-3 bg-blue-600 text-white">Quantity</th>
                <th class="px-4 py-3 bg-blue-600 text-white">Unit</th>
                <th class="px-4 py-3 bg-blue-600 text-white"> Condition upon Delivery</th>
                <th class="px-4 py-3 bg-blue-600 text-white">Brand</th>
                <th class="px-4 py-3 bg-blue-600 text-white"> Serial</th>
            </thead>
            <tbody>

                @foreach ($items as $item)
                    <tr>
                        <td class="px-4 py-3 border border-gray-300">{{ $item->generated_code ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $item->quantity ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $item->unit ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $item->condition_id ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $item->brand ?? 'N/A' }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $item->serial_number ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
@endsection

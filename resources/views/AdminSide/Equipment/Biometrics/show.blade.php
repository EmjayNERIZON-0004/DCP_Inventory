    @extends('layout.Admin-Side')
    <title>
        @yield('title', 'DCP Dashboard')</title>

    @section('content')
        <div class="bg-white my-5 mx-5 px-5 py-5 rounded-sm shadow-md border border-gray-300  ">

            <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">No. </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">School Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Total Biometrics Units</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($totals as $index => $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $item->schools->SchoolName ?? 'N/A' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $item->total_amount }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach ($biometrics_model as $brand)
                    <div class="bg-white border border-gray-200 rounded-lg shadow p-4">
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Brand: {{ $brand->brand->name ?? 'Unknown Brand' }}
                        </h3>
                        {{-- <p class="text-gray-600 text-sm">Count: {{ $brand->count }}</p> --}}
                        {{-- <p class="text-gray-600 text-sm">Units: {{ $brand->total_units }}</p> --}}
                        <p class="text-green-700 font-bold mt-1">
                            Total: {{ $brand->total }}
                        </p>
                    </div>
                @endforeach
            </div>


            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach ($biometrics_power_source as $power)
                    <div class="bg-white border border-gray-200 rounded-lg shadow p-4">
                        <h3 class="font-semibold text-gray-800 mb-1">
                            Power Source: {{ $power->power_source->name ?? 'Unknown Brand' }}
                        </h3>
                        <p class="text-gray-600 text-sm">Count: {{ $power->count }}</p>
                        <p class="text-gray-600 text-sm">Units: {{ $power->total_units }}</p>
                        <p class="text-green-700 font-bold mt-1">
                            Total: {{ $power->total }}
                        </p>
                    </div>
                @endforeach
            </div>

        </div>
    @endsection

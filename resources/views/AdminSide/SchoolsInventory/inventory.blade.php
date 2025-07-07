@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')


    <div class="mx-5 my-5">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">DCP Inventory</h1>
        <p class="mb-2">Select a school to filter items, or view all by default.</p>

        <form method="GET" action="{{ route('index.SchoolsInventory') }}" class="mb-4">
            <select name="school" onchange="this.form.submit()" class="border px-3 py-2 rounded">
                <option value="">-- All Schools --</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->pk_school_id }}"
                        {{ $selectedSchool == $school->pk_school_id ? 'selected' : '' }}>
                        {{ $school->SchoolName }} - {{ $school->SchoolLevel }}
                    </option>
                @endforeach
            </select>
        </form>

        @if ($school_items->isNotEmpty())
            @foreach ($school_items as $batch)
                <div class="bg-white shadow rounded p-4 mb-4">
                    <h3 class="font-bold text-lg text-blue-600 mb-1">Batch: {{ $batch['batch_label'] }}</h3>
                    <p class="text-md text-gray-600 mb-2">School: {{ $batch['school_name'] }}</p>
                    <table class="list-disc ml-6 text-gray-700">
                        @foreach ($batch['items'] as $item)
                            <tr>
                                <td class="py-2"><strong>Code:</strong> {{ $item->generated_code }}</td>
                                <td class="w-5 py-2"></td>
                                <td><strong>Item:</strong>
                                    @php
                                        $itemName = App\Models\DCPItemTypes::firstWhere(
                                            'pk_dcp_item_types_id',
                                            $item->item_type_id,
                                        )->value('name');
                                    @endphp
                                    {{ $itemName }}</td>
                                <td class="w-5"></td>
                                <td class="py-2">
                                    <a href="{{ route('show.SchoolsInventory', ['code' => $item->generated_code]) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1   px-5 rounded">
                                        Show Item Details
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endforeach
        @else
            <p class="text-gray-500">No DCP items found.</p>
        @endif
    </div>
@endsection

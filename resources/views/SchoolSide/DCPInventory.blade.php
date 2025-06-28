@extends('layout.SchoolSideLayout')

@section('title', 'DCP Documents')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-8 mt-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">DCP Inventory</h1>
    <p class="mb-2">Below is a sample list of DCP equipment assigned to your school.</p>
    <table class="min-w-full bg-white border mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Equipment</th>
                <th class="px-4 py-2 border">Serial Number</th>
                <th class="px-4 py-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">Laptop</td>
                <td class="border px-4 py-2">SN123456</td>
                <td class="border px-4 py-2">Working</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Projector</td>
                <td class="border px-4 py-2">PJ987654</td>
                <td class="border px-4 py-2">For Repair</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
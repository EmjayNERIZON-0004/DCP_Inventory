@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <div class="p-2 md:mx-5 md:my-5 mx-0 my-0">
        <h1 style="letter-spacing: 0.05rem" class="text-2xl font-bold text-gray-800 uppercase">PRODUCT FOUND</h1>

        <table class="table border-collapse bg-white w-full " style="letter-spacing: 0.05rem">
            <thead>
                <tr>
                    <th class="border p-2 uppercase">Product Description</th>
                    <th class="border p-2 uppercase"> </th>
                </tr>
            </thead>
            <tbody>


                <tr>
                    <td class="border p-2">Product Code</td>
                    <td class="border p-2">{{ $items['generated_code'] }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Product Name</td>
                    <td class="border p-2">{{ $items->dcpItemType->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Product Price</td>
                    <td class="border p-2">{{ $items->unit_price ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Product Brand</td>
                    <td class="border p-2">{{ $items->brand_details->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Product Current Condition</td>
                    <td class="border p-2">{{ $items->dcpItemCurrentCondition->dcpCurrentCondition->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Serial Number</td>
                    <td class="border p-2">{{ $items->serial_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Batch</td>
                    <td class="border p-2">{{ $items->dcpBatch->batch_label ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">School Recipient</td>
                    <td class="border p-2">{{ $items->dcpBatch->school->SchoolName ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">School Level Recipient </td>
                    <td class="border p-2">{{ $items->dcpBatch->school->SchoolLevel ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Assigned User </td>
                    <td class="border p-2">{{ $items->dcpAssignedUsers->assigned_user_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Assigned Type </td>
                    <td class="border p-2">{{ $items->dcpAssignedUsers->dcpAssignedType->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">Assigned Location </td>
                    <td class="border p-2">{{ $items->dcpBatchItemLocation->dcpAssignedLocation->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="border p-2">IAR File </td>
                    <td class="border p-2">
                        @if ($items->iar_file == null)
                            No File
                        @else
                            <a href="{{ asset('certificates/iar/' . $items->iar_file) }}" target="_blank"
                                class="text-blue-600 underline hover:text-blue-800">
                                {{ $items->iar_file ?? 'N/A' }}
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="border p-2">ITR File </td>
                    <td class="border p-2">
                        @if ($items->itr_file == null)
                            No File
                        @else
                            <a href="{{ asset('certificates/itr/' . $items->itr_file) }}" target="_blank"
                                class="text-blue-600 underline hover:text-blue-800">
                                {{ $items->itr_file ?? 'N/A' }}
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="border p-2">Certificate of Completion </td>
                    <td class="border p-2">
                        @if ($items->certificate_of_completion == null)
                            No File
                        @else
                            <a href="{{ asset('certificates/certificate-completion/' . $items->certificate_of_completion) }}"
                                target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                {{ $items->certificate_of_completion ?? 'N/A' }}
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="border p-2">Training Acceptance File </td>
                    <td class="border p-2">
                        @if ($items->training_acceptance_file == null)
                            No File
                        @else
                            <a href="{{ asset('certificates/training-acceptance/' . $items->training_acceptance_file) }}"
                                target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                {{ $items->training_acceptance_file ?? 'N/A' }}
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="border p-2">Delivery Receipt File </td>
                    <td class="border p-2">
                        @if ($items->delivery_receipt_file == null)
                            No File
                        @else
                            <a href="{{ asset('certificates/delivery-receipt/' . $items->delivery_receipt_file) }}"
                                target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                {{ $items->delivery_receipt_file ?? 'N/A' }}
                            </a>
                        @endif
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
@endsection

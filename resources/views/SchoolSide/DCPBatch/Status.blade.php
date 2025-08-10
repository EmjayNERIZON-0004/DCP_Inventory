@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Batch')</title>

@section('content')
    <div class="mx-5 mt-5 border-1">
        <a href="{{ route('school.dcp_items', $batchId) }}" style="font-size:16px"
            class="inline-flex items-center text-blue-600 text-md font-semibold hover:underline">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            DCP Items
        </a>
        <h2 class="text-2xl font-semibold text-blue-700">Batch: {{ $batchName }} </h2>
        <span class="text-gray-600">Date Delivered: {{ $batchDeliveryDate ?? 'N/A' }}</span>
        <h2 class="text-2xl font-bold text-blue-700">Status</h2>

        <div class="overflow-x-auto border border-gray-200 h-96  rounded-sm md:border-b shadow-md md:shadow-none">
            <table class="w-full bg-white border-collapse">
                <thead class="bg-gray-700 sticky top-0">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap text-white">Item Code</th>
                        <th class="px-4 py-3  text-white">Quantity</th>
                        <th class="px-4 py-3  text-white">Unit</th>
                        <th class="px-4 py-3 whitespace-nowrap text-white">Condition upon Delivery</th>
                        <th class="px-4 py-3  text-white">Brand</th>
                        <th class="px-4 py-3  text-white">Serial</th>
                        <th class="px-4 py-3  text-white">Recipient</th>
                        <th class="px-4 py-3  text-white">Warranty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->generated_code ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->quantity ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->unit ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->condition_id ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->brand ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border border-gray-300">{{ $item->serial_number ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border text-center gap-0 ">

                                @php
                                    $assignedCount = \App\Models\DCPItemAssignedUser::where(
                                        'dcp_batch_item_id',
                                        $item->pk_dcp_batch_items_id,
                                    )->count();

                                    $originalClass = $assignedCount > 0 ? 'text-blue-600' : 'text-blue-600';

                                @endphp

                                <button type="button"
                                    class="{{ $originalClass }} {{ $originalClass = $assignedCount > 0 ? 'font-bold' : 'underline' }} underline rounded border-1   py-1"
                                    onclick="openUserRecipientModal({
        pk_dcp_batch_items_id: '{{ $item->pk_dcp_batch_items_id }}',
        assigned_user_type_id: '{{ $type_value_item ?? '' }}',
        assigned_user_name: '{{ $name_value_item ?? '' }}',
        assigned_user_location_id: '{{ $location_value_item ?? '' }}',
        isAssigned: {{ $assignedCount > 0 ? 'true' : 'false' }}
    })">
                                    User Recipient
                                </button><span class="text-red-600 text-lg"
                                    style="text-decoration:none">{{ $assignedCount > 0 ? '' : '*' }}
                                </span>

                            </td>
                            <td class="px-4 py-3 whitespace-nowrap border text-center  ">




                                <a href="{{ route('school.dcp_item_warranty', $item->pk_dcp_batch_items_id) }}"
                                    class="text-green-600 rounded  underline hover:text-green-700   py-1">
                                    Show Warranty
                                </a>
                            </td>
                        </tr>
                        @php
                            $assignedCount = \App\Models\DCPItemAssignedUser::where(
                                'dcp_batch_item_id',
                                $item->pk_dcp_batch_items_id,
                            )->count();
                            $if_assigned_exists = $assignedCount > 0 ? 'yes' : 'no';
                        @endphp

                        <!-- Hidden form row -->
                        <tr id="form-row-{{ $index }}" style="display: none;  ">

                            <td colspan="7" class=" h-full  p-0">
                                @if ($if_assigned_exists == 'no')
                                    <form method="POST" action="{{ route('school.assignment.items') }}">
                                        @csrf
                                        @method('POST')


                                        @php
                                            $type_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assignment_type_id');

                                            $name_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_user_name');

                                            $locations = \App\Models\DCPItemLocation::all();

                                            $location_value_item = \App\Models\DCPItemAssignedLocation::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_location_id');
                                        @endphp

                                        <input type="hidden" name="pk_dcp_batch_items_id"
                                            value="{{ $item->pk_dcp_batch_items_id }}">

                                        <h2 class="text-lg font-semibold text-blue-600  ">Encode the User Details for
                                            this
                                            Item</h2>
                                        <div class="grid md:grid-cols-4 gap-1 grid-cols-1 gap-0 items-start">
                                            <!-- User Icon -->



                                            <!-- User Type -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-blue-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">User Type <span
                                                        class="text-red-600">*</span></label>
                                                <select name="assigned_user_type_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Type</option>
                                                    @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                                                        <option value="{{ $type->pk_dcp_assignment_types_id }}"
                                                            {{ $type_value_item == $type->pk_dcp_assignment_types_id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- User Name -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-yellow-200">
                                                <label class="block text-sm font-medium  text-gray-700 mb-1">Staff/Student
                                                    Name
                                                    <span class="text-red-600">*</span></label>
                                                <input type="text" name="assigned_user_name"
                                                    value="{{ $name_value_item ?? '' }}"
                                                    class="w-full border border-gray-800 rounded px-3 py-2">
                                            </div>

                                            <!-- Assigned Location -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-green-200">
                                                <label class="block text-sm font-medium  text-gray-700 mb-1">Assigned
                                                    Location
                                                    <span class="text-red-600">*</span></label>
                                                <select name="assigned_user_location_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Location</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->pk_dcp_assigned_locations_id }}"
                                                            {{ $location_value_item == $location->pk_dcp_assigned_locations_id ? 'selected' : '' }}>
                                                            {{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Submit Button -->
                                            <div
                                                class="w-full h-full border border-gray-800 px-6 py-4 bg-white items-center justify-center   ">
                                                <label class="block text-sm font-medium  text-gray-700 mb-1">Save the
                                                    assigned
                                                    user </label>
                                                <button type="submit"
                                                    class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                                    Save User
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @elseif ($if_assigned_exists == 'yes')
                                    <form action="{{ route('school.assignment.items') }}" method="POST">
                                        @csrf
                                        @method('POST')


                                        @php
                                            $type_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assignment_type_id');

                                            $name_value_item = \App\Models\DCPItemAssignedUser::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_user_name');

                                            $locations = \App\Models\DCPItemLocation::all();

                                            $location_value_item = \App\Models\DCPItemAssignedLocation::where(
                                                'dcp_batch_item_id',
                                                $item->pk_dcp_batch_items_id,
                                            )->value('assigned_location_id');
                                        @endphp

                                        <input type="hidden" name="pk_dcp_batch_items_id"
                                            value="{{ $item->pk_dcp_batch_items_id }}">

                                        <h2 class="text-lg font-semibold text-blue-600  ">This item has already
                                            been
                                            assigned. You can update the user details below.</h2>
                                        <div class="grid md:grid-cols-4 grid-cols-1 gap-1 items-start">
                                            <!-- User Type -->

                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-blue-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">User Type <span
                                                        class="text-red-600">*</span></label>
                                                <select name="assigned_user_type_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Type</option>
                                                    @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                                                        <option value="{{ $type->pk_dcp_assignment_types_id }}"
                                                            {{ $type_value_item == $type->pk_dcp_assignment_types_id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- User Name -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-yellow-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Staff/Student
                                                    Name
                                                    <span class="text-red-600">*</span></label>
                                                <input type="text" name="assigned_user_name"
                                                    value="{{ $name_value_item ?? '' }}"
                                                    class="w-full border border-gray-800 rounded px-3 py-2">
                                            </div>

                                            <!-- Assigned Location -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-green-200">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned
                                                    Location
                                                    <span class="text-red-600">*</span></label>
                                                <select name="assigned_user_location_id"
                                                    class="w-full border border-gray-800 rounded px-3 py-2" required>
                                                    <option value="">Select Location</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->pk_dcp_assigned_locations_id }}"
                                                            {{ $location_value_item == $location->pk_dcp_assigned_locations_id ? 'selected' : '' }}>
                                                            {{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Update Button -->
                                            <div class="w-full h-full border border-gray-800 px-6 py-4 bg-white">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Update the
                                                    Details</label>
                                                <button type="submit"
                                                    class="w-full border border-gray-800 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                                    Update User
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- User Recipient Modal -->
        <div id="user-recipient-modal-overlay"
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div id="user-recipient-modal" class="bg-white rounded-lg shadow-xl p-6 w-full mx-5 max-w-2xl relative">
                <button type="button" onclick="closeUserRecipientModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
                <h2 id="user-recipient-modal-title" class="text-xl font-bold mb-4 text-blue-700"></h2>
                <form id="user-recipient-form" method="POST" action="{{ route('school.assignment.items') }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="pk_dcp_batch_items_id" id="modal_pk_dcp_batch_items_id">
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">User Type <span
                                    class="text-red-600">*</span></label>
                            <select name="assigned_user_type_id" id="modal_assigned_user_type_id"
                                class="w-full border border-gray-800 rounded px-3 py-2" required>
                                <option value="">Select Type</option>
                                @foreach (\App\Models\DCPItemAssignedType::all() as $type)
                                    <option value="{{ $type->pk_dcp_assignment_types_id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Staff/Student Name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="assigned_user_name" id="modal_assigned_user_name"
                                class="w-full border border-gray-800 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Location <span
                                    class="text-red-600">*</span></label>
                            <select name="assigned_user_location_id" id="modal_assigned_user_location_id"
                                class="w-full border border-gray-800 rounded px-3 py-2" required>
                                <option value="">Select Location</option>
                                @foreach (\App\Models\DCPItemLocation::all() as $location)
                                    <option value="{{ $location->pk_dcp_assigned_locations_id }}">{{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2  ">
                        <button type="submit"
                            class="bg-green-600 w-40 text-white px-4 py-1 rounded hover:bg-green-700">Save</button>
                        <button type="button" onclick="closeUserRecipientModal()"
                            class="bg-gray-500 w-40 text-white px-4 py-1 rounded hover:bg-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openUserRecipientModal(item) {
            // Set modal title
            document.getElementById('user-recipient-modal-title').innerText = item.isAssigned ? 'Edit User Recipient' :
                'Assign User Recipient';

            // Set form values
            document.getElementById('modal_pk_dcp_batch_items_id').value = item.pk_dcp_batch_items_id || '';
            document.getElementById('modal_assigned_user_type_id').value = item.assigned_user_type_id || '';
            document.getElementById('modal_assigned_user_name').value = item.assigned_user_name || '';
            document.getElementById('modal_assigned_user_location_id').value = item.assigned_user_location_id || '';
            document.body.classList.add('overflow-hidden');
            // Show modal
            document.getElementById('user-recipient-modal-overlay').classList.remove('hidden');
        }

        function closeUserRecipientModal() {
            document.body.classList.remove('overflow-hidden');
            document.getElementById('user-recipient-modal-overlay').classList.add('hidden');
            document.getElementById('user-recipient-form').reset();
        }
    </script>
    <script>
        let activeIndex = null;

        function toggleForm(index) {
            const row = document.getElementById(`form-row-${index}`);
            const btn = document.getElementById(`assign-btn-${index}`);
            const originalClass = btn.getAttribute('data-original-class');

            // Close previous active form if different
            if (activeIndex !== null && activeIndex !== index) {
                const prevRow = document.getElementById(`form-row-${activeIndex}`);
                const prevBtn = document.getElementById(`assign-btn-${activeIndex}`);
                if (prevRow) prevRow.style.display = 'none';
                if (prevBtn) {
                    prevBtn.classList.remove('text-gray-700');
                    prevBtn.classList.add(prevBtn.getAttribute('data-original-class'));
                    prevBtn.innerText = " User Recipient";
                }
            }

            // Toggle current form row
            const isHidden = row.style.display === 'none';

            if (isHidden) {
                row.style.display = 'table-row';
                btn.classList.remove(originalClass);

                btn.classList.add('font-bold'); // ✅ Always gray when active

                btn.innerText = "Cancel";
                activeIndex = index;
            } else {
                row.style.display = 'none';

                btn.classList.remove('font-bold');
                btn.classList.add(originalClass); // ✅ Back to original (green/blue)
                btn.innerText = "About User Recipient";
                activeIndex = null;
            }
        }
    </script>
@endsection

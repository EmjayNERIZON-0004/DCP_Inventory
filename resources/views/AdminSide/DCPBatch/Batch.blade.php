{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\AdminSide\DCPBatch\Batch.blade.php --}}

@extends('layout.Admin-Side')

@section('title', 'DCP Batches')

@section('content')

    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #282828;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .table th,
        .table td {
            border: 1px solid #282828;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background: #2563eb;
            color: #fff;
        }

        .table td {
            background-color: #fff;
        }

        input,
        textarea,
        select {
            border: 1px solid #ccc
        }
    </style>
    <!-- ✅ First load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ✅ Then load Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <!-- Modal Overlay for Add DCP Batch -->
    <div id="add-batch-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="add-batch-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden border border-green-700 p-6 w-full max-w-full mx-10 relative"
            style="max-height: 80vh; overflow-y: auto;">
            <button type="button" onclick="cancelAddBatch()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <h2 class="text-2xl font-bold w-full text-center md:text-left text-gray-800 mb-4"
                style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Add DCP
                Batch</h2>
            {{-- <div class="flex justify-center md:justify-start mb-4">
                <div class="rounded-full bg-green-100 p-4 shadow-md flex items-center justify-center w-32 h-32">
                    <!-- SVG Icon -->
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="w-16 h-16 text-green-700" stroke="currentColor">
                        <path
                            d="M20.5 7.27783L12 12.0001M12 12.0001L3.49997 7.27783M12 12.0001L12 21.5001M14 20.889L12.777 21.5684C12.4934 21.726 12.3516 21.8047 12.2015 21.8356C12.0685 21.863 11.9315 21.863 11.7986 21.8356C11.6484 21.8047 11.5066 21.726 11.223 21.5684L3.82297 17.4573C3.52346 17.2909 3.37368 17.2077 3.26463 17.0893C3.16816 16.9847 3.09515 16.8606 3.05048 16.7254C3 16.5726 3 16.4013 3 16.0586V7.94153C3 7.59889 3 7.42757 3.05048 7.27477C3.09515 7.13959 3.16816 7.01551 3.26463 6.91082C3.37368 6.79248 3.52345 6.70928 3.82297 6.54288L11.223 2.43177C11.5066 2.27421 11.6484 2.19543 11.7986 2.16454C11.9315 2.13721 12.0685 2.13721 12.2015 2.16454C12.3516 2.19543 12.4934 2.27421 12.777 2.43177L20.177 6.54288C20.4766 6.70928 20.6263 6.79248 20.7354 6.91082C20.8318 7.01551 20.9049 7.13959 20.9495 7.27477C21 7.42757 21 7.59889 21 7.94153L21 12.5001M7.5 4.50008L16.5 9.50008M16 18.0001L18 20.0001L22 16.0001"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div> --}}



            <div id="result" class="hidden mt-4">

                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center gap-2"
                    role="alert" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span id="result-message"></span>
                </div>
            </div>

            <form method="POST" action="{{ route('store.batch') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="font-semibold">Package Type <span class="text-red-600">*</span></label>
                        <select name="dcp_package_type_id" id="package_type" class="w-full border rounded px-2 py-1"
                            required>
                            <option value=""> Select Package </option>
                            @foreach ($packageTypes as $type)
                                <option value="{{ $type->pk_dcp_package_types_id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">Receipient School <span class="text-red-600">*</span></label><br>
                        <select name="school_id" class=" border rounded px-2 py-2   select2  " style="width: 100%; ">
                            <option value=""> Select School</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->pk_school_id }}" data-email="{{ $school->SchoolEmailAddress }}">
                                    {{ $school->SchoolName }} - {{ $school->SchoolLevel }}
                                </option>
                            @endforeach
                        </select>


                    </div>
                    <div>
                        <label class="font-semibold">Budget Year <span class="text-red-600">*</span></label>
                        <input type="number" name="budget_year" id="budget_year" class="w-full border rounded px-2 py-1"
                            required>
                    </div>

                    <div>
                        <label class="font-semibold">Batch Label <span class="text-gray-500">- (Auto
                                Generated)</span></label>
                        <input type="text" name="batch_label" id="batch_label" readonly
                            class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label class="font-semibold">Delivery Date <span class="text-red-600">*</span></label>
                        <input type="date" name="delivery_date" class="w-full border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label class="font-semibold">Supplier Name <span class="text-red-600">*</span></label>
                        @php
                            $suppliers = \App\Models\DCPItemBrand::all();
                        @endphp
                        <select name="supplier_name" class="w-full border rounded px-2 py-1" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">Mode of Delivery <span class="text-red-600">*</span></label>

                        <select name="mode_of_delivery" id="" class="w-full border rounded px-2 py-1" required>

                            @php
                                $modes = \App\Models\DCPItemModeDelivery::all();
                            @endphp
                            <option value="">Select Mode of Delivery</option>
                            @foreach ($modes as $mode)
                                <option value="{{ $mode->name }}">{{ $mode->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="md:col-span-1">

                        <label class="font-semibold">School Email Address <span class="text-gray-500">- (Auto
                                Generated)</span></label>
                        <input type="email" id="school-email" name="school_email" class="w-full border rounded px-2 py-1"
                            readonly>

                    </div>
                    <div>
                        <label class="font-semibold">Submission Status</label>
                        <div class="flex space-x-2 mt-1">
                            <button type="button"
                                class="px-3 py-1 rounded  shadow-md bg-green-500 text-white   cursor-not-allowed">
                                Approved
                            </button>
                            <button type="button"
                                class="px-3 py-1 rounded shadow-md  bg-yellow-500 text-white  cursor-not-allowed">
                                For Editing
                            </button>
                            <button type="button"
                                class="px-3 py-1 rounded shadow-md  bg-blue-500 text-white   cursor-not-allowed">
                                For Updating
                            </button>
                        </div>
                        <input type="hidden" name="submission_status" value="For Editing">
                    </div>
                    <div class="md:col-span-3">
                        <label class="font-semibold">Description<span class="text-gray-500">- (Auto
                                Generated)</span></label>
                        <textarea name="description" class="w-full border rounded px-2 py-1"></textarea>
                    </div>
                    <div id="batch-items-section" class="w-full overflow-hidden col-span-1 md:col-span-3  hidden">
                        <h3 class="text-lg font-semibold mb-2">Package Contents</h3>
                        <div id="batch-items-flex-container" class="flex flex-col md:flex-row flex-wrap gap-4 mx-5"
                            style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                            <table class="table w-full   border border-gray-300 text-sm">
                                <thead class="bg-gray-100" id="batch-items-table-head">
                                    <tr>
                                        <th class="px-4 py-2 border">Product Content</th>
                                    </tr>
                                </thead>
                                <tbody id="batch-items-table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Add
                        Batch</button>
                </div>
            </form>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schoolSelect = document.querySelector('select[name="school_id"]');
            const emailInput = document.getElementById('school-email');

            schoolSelect.addEventListener('change', function() {
                const selectedOption = schoolSelect.options[schoolSelect.selectedIndex];
                const email = selectedOption.getAttribute('data-email') || '';
                emailInput.value = email;
            });
        });
    </script>
    <script>
        function showAddBatchModal() {
            document.getElementById('add-batch-modal-overlay').classList.remove('hidden');
            document.getElementById('add-batch-form-section').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cancelAddBatch() {
            document.getElementById('add-batch-modal-overlay').classList.add('hidden');
            document.getElementById('add-batch-form-section').classList.add('hidden');
            document.querySelector('#add-batch-form-section form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packageTypeSelect = document.getElementById('package_type');
            const budgetYearInput = document.getElementById('budget_year');
            const batchLabelInput = document.getElementById('batch_label');

            function updateBatchLabel() {
                const selectedOption = packageTypeSelect.options[packageTypeSelect.selectedIndex];
                const packageName = selectedOption ? selectedOption.text : '';
                const year = budgetYearInput.value;

                if (packageName && year) {
                    batchLabelInput.value = `DCP ${year} - ${packageName}`;
                } else {
                    batchLabelInput.value = '';
                }
            }

            packageTypeSelect.addEventListener('change', updateBatchLabel);
            budgetYearInput.addEventListener('input', updateBatchLabel);
        });
    </script>


    <script>
        const bgColors = [
            'bg-red-100',
            'bg-yellow-100',
            'bg-green-100',
            'bg-blue-100',
            'bg-indigo-100',
            'bg-purple-100',
            'bg-pink-100',
            'bg-orange-100',
            'bg-teal-100',
            'bg-cyan-100'
        ];

        document.addEventListener('DOMContentLoaded', function() {
            const packageSelect = document.querySelector('[name="dcp_package_type_id"]');
            const itemsSection = document.getElementById('batch-items-section');
            const itemsTableBody = document.getElementById('batch-items-table-body');
            const descriptionInput = document.querySelector('textarea[name="description"]');

            packageSelect.addEventListener('change', function() {
                const packageTypeId = this.value;
                itemsTableBody.innerHTML = ''; // clear previous

                if (packageTypeId) {
                    const itemsTableHead = document.querySelector('#batch-items-table-head');
                    const itemsTableBody = document.querySelector('#batch-items-table-body');

                    const itemsFlexContainer = document.getElementById('batch-items-flex-container');

                    fetch(`/api/package-items/${packageTypeId}`)
                        .then(res => res.json())
                        .then(data => {
                            itemsFlexContainer.innerHTML = ''; // clear previous
                            data.sort((a, b) => b.quantity - a.quantity);

                            if (data.length > 0) {
                                let descriptionParts = [];

                                data.forEach((item, index) => {

                                    const bgColor = bgColors[index % bgColors.length];
                                    const itemBox = `
                    <div class="flex-1 min-w-[200px] bg-white border  rounded shadow p-4 ${bgColor} text-center"
                    style="border: 1px solid #282828;"
                    >
                        <p class=" text-gray-800"><b>${item.quantity}</b> - ${item.item_name}</p>
                       
                    </div>
                `;
                                    itemsFlexContainer.insertAdjacentHTML('beforeend', itemBox);
                                    // Build description string
                                    descriptionParts.push(`${item.quantity} ${item.item_name}`);
                                });

                                // Set description value
                                descriptionInput.value = `(${descriptionParts.join('; ')})`;
                                itemsSection.classList.remove('hidden');
                            } else {
                                itemsSection.classList.add('hidden');
                            }
                        })


                        .catch(err => {

                            console.error('Error fetching items:', err);
                            itemsSection.classList.add('hidden');
                        });
                } else {
                    itemsSection.classList.add('hidden');
                }
            });
        });
    </script>

    <div class="bg-white border border-blue-500 shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5 mt-8">



        <div class="flex justify-between  ">
            <div>
                <h2 class="text-2xl font-bold text-blue-700  " style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                    DCP
                    Batch List</h2>

                <div class="text-md text-gray-600  mb-5">List of Batches assigned in every Schools under DepEd
                    Computerization
                    Program</div>

            </div>
            <button type="button" onclick="showAddBatchModal()"
                class="bg-green-700 hover:bg-green-800 text-white py-1 h-10 px-4 rounded mb-4">
                Add DCP Batch
            </button>
        </div>

        <input type="text" id="searchBatch" placeholder="Search by batch label, school, etc."
            class="mb-4 p-2 border border-gray-300 rounded w-1/3">




        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200"
                style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">No.
                        </th>

                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Batch Label</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Description</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            School ID</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            School</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            School Level</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Package Type</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Budget Year</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Delivery Date</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Supplier</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Mode of Delivery</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white  ">
                            Status</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white">Actions</th>
                    </tr>
                </thead>
                <tbody id="batchTableBody" class="bg-white divide-y divide-gray-200">

                    @foreach ($dcpBatches as $batch)
                        <tr id="row-{{ $batch->pk_dcp_batches_id }}" class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-r border-gray-200">{{ $loop->iteration }}</td>

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
                            <td class="px-4 py-3 border-r border-gray-200 whitespace-nowrap">
                                <div class="flex flex-col">


                                    {{ $batch->approval_status ? $batch->approval_status : '' }}


                                    @if ($batch->approval_status == 'Pending')
                                        <form method="POST"
                                            action="{{ route('approve.batch', $batch->id ?? $batch->pk_dcp_batches_id) }}"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded hover:bg-green-700 {{ strtoupper($batch->submission_status) === 'APPROVED' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ strtoupper($batch->submission_status) === 'APPROVED' ? 'disabled' : '' }}>
                                                Approve
                                            </button>
                                        </form>
                                    @elseif ($batch->approval_status == 'Approved')
                                        <span class="text-green-600 font-bold">{{ $batch->date_approved }}</span>
                                    @else
                                        <span class="text-blue-600">For Submission</span>
                                    @endif
                                </div>

                            </td>

                            <td class="px-4 py-3 flex flex-wrap gap-2">

                                <a href="{{ route('index.items', $batch->id ?? $batch->pk_dcp_batches_id) }}"
                                    class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                                    Items
                                </a>
                                <a
                                    class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                <button type="button" onclick="deleteBatch(<?= $batch->pk_dcp_batches_id ?>)"
                                    class="min-w-[80px] text-center px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                    Delete
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Only load jQuery and Select2 once, and initialize after both are loaded -->
    <script>
        $(document).ready(function() {
            // Initialize Select2
            if ($.fn.select2) {
                $('.select2').select2({
                    placeholder: "Select School",
                    allowClear: true
                });
            } else {
                console.error('Select2 plugin not loaded.');
            }

            // Auto-fill school email address on selection
            $('select[name="school_id"]').on('change', function() {
                var email = $(this).find('option:selected').data('email') || '';
                $('#school-email').val(email);
            });
        });
    </script>
    <script src="{{ asset('js/dcp-batch/dcp_batch.js') }}"></script>
@endsection

@extends('layout.Admin-Side')

@section('content')
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
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
    </style>
    <div id="insert-form-section" class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5 hidden">
        <form id="insert-form" method="POST" action="{{ route('insert.package_item') }}">
            @csrf
            <input type="hidden" name="insert_package_id" id="insert_package_id">

            <h2 class="text-2xl font-bold mb-2">Insert Item to <span class="insert_package_name font-semibold"></span></h2>

            <div class="flex flex-col md:flex-row gap-4 mb-4 w-full">
                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 font-semibold mb-2">Package Content</label>
                    <select name="insert_package_content_id" id="insert_package_content_id"
                        class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                        required>
                        <option value="">-- Select Content --</option>
                        @foreach ($itemTypes as $itemType)
                            <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 font-semibold mb-2">Quantity</label>
                    <input type="number" name="insert_quantity" id="insert_quantity"
                        class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                        required>
                </div>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded">Insert Item</button>
            <button type="button" onclick="cancelInsert()"
                class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-2">Cancel</button>
        </form>
    </div>





    <script>
        function showInsertForm(dcp_packages_id, package_name) {
            // Fill form values
            document.getElementById('insert_package_id').value = dcp_packages_id;
            document.querySelectorAll('.insert_package_name').forEach(el => el.textContent = package_name);

            // Reset and show the insert form
            document.getElementById('insert-form').reset();
            document.getElementById('insert-form-section').classList.remove('hidden');

            // Hide edit form if open
            document.getElementById('edit-form-section').classList.add('hidden');

            // Disable already used items except the one being inserted
            const select = document.getElementById('insert_package_content_id');
            const usedIds = usedItemsPerPackage[dcp_packages_id] || [];

            for (const option of select.options) {
                const originalText = option.text.replace(' (Already Exist)', '');
                option.text = originalText; // reset label
                option.disabled = false;

                if (
                    usedIds.includes(parseInt(option.value))

                ) {
                    option.disabled = true;
                    option.text += ' (Already Exist)';
                }
            }


        }

        function cancelInsert() {
            document.getElementById('insert-form-section').classList.add('hidden');
            document.getElementById('insert-form').reset();
        }
    </script>

    <div id="edit-form-section" class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5 hidden">
        <form id="edit-form" method="POST" action="{{ route('update.package_type') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="package_id" id="edit-package-id">

            <h2 class="text-2xl font-bold mb-2">Edit DCP Package Content </h2>
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="package_id" id="package_id">

            <div class="flex flex-col md:flex-row gap-4 mb-4 w-full">
                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 font-semibold mb-2">DCP Package Name</label>
                    <input type="text" name="package_name"
                        class="package_name shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                        readonly>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 font-semibold mb-2">DCP Package Content</label>
                    <select name="package_content_name" id="package_content_name"
                        class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                        <option value="">-- Select Content --</option>
                        @foreach ($itemTypes as $itemType)
                            <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 font-semibold mb-2">Item Quantity</label>
                    <input type="text" name="quantity" id="quantity"
                        class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                        required>
                </div>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-1 px-4 rounded">Update
                Package</button>
            <button type="button" onclick="cancelEdit()"
                class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-2">Cancel</button>
        </form>
    </div>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5"
        style="  border-radius: 8px;font-family: Verdana, Geneva, Tahoma, sans-serif;    overflow-x: auto;
    -webkit-overflow-scrolling: touch;">



        @php
            $groupedPackages = $packages->groupBy('package_name');
            $colors = ['#C9E4CA', '#F7D2C4', '#C5CAE9', '#F2C464'];
            $colorIndex = 0;
        @endphp
        <h2 class="text-2xl font-bold mb-2"> DCP Batch Package List</h2>

        <table class="table" style="border: 1px solid #ddd;
">
            <thead>
                <tr>
                    <th style="border: 1px solid #282828;">Package Type</th>
                    <th style="border: 1px solid #282828;">Package Content</th>
                    <th style="border: 1px solid #282828;">Quantity</th>
                    <th style="border: 1px solid #282828;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedPackages as $packageName => $items)
                    @php
                        $rowspan = $items->count();
                        $color = $colors[$colorIndex % count($colors)];
                        $colorIndex++;
                    @endphp

                    @foreach ($items as $index => $package)
                        <tr>
                            @if ($index === 0)
                                <td style="border: 1px solid #282828; background-color: {{ $color }};"
                                    rowspan="{{ $rowspan }}">
                                    {{ $packageName }}
                                </td>
                            @endif
                            <td style="border: 1px solid #282828; background-color: {{ $color }};">
                                {{ $package->item_name }}
                            </td>
                            <td style="border: 1px solid #282828; background-color: {{ $color }};">
                                {{ $package->quantity }}
                            </td>
                            <td class="w-35" style="border: 1px solid #282828; background-color: {{ $color }};">
                                <button type="button" style="border: 1px solid black"
                                    onclick="showEditForm('{{ $package->dcp_packages_id }}','{{ $package->item_type_id }}','{{ $package->id }}','{{ $packageName }}', '{{ $package->item_name }}', `{{ $package->quantity }}`)"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-4 rounded">
                                    Edit Content
                                </button>
                                @if ($index === 0)
                                    <button type="button"
                                        onclick="showInsertForm('{{ $package->dcp_packages_id }}', '{{ $packageName }}')"
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-4 rounded mt-2"
                                        style="border: 1px solid black">
                                        Insert Item
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>




    <script>
        const usedItemsPerPackage = @json(
            $packages->groupBy('dcp_packages_id')->map(function ($group) {
                return $group->pluck('item_type_id');
            }));
    </script>


    <script>
        function showEditForm(dcp_packages_id, item_type_id, id, package_name, package_content_name, quantity) {
            document.querySelectorAll('.package_name').forEach(el => el.value = package_name);
            document.getElementById('id').value = id;
            document.getElementById('quantity').value = quantity;
            document.getElementById('package_id').value = dcp_packages_id;
            document.getElementById('insert-form-section').classList.add('hidden');
            const select = document.getElementById('package_content_name');
            const usedIds = usedItemsPerPackage[dcp_packages_id] || [];

            for (const option of select.options) {
                const originalText = option.text.replace(' (Already Exist)', '');
                option.text = originalText; // reset label
                option.disabled = false;

                if (
                    usedIds.includes(parseInt(option.value)) &&
                    parseInt(option.value) !== parseInt(item_type_id)
                ) {
                    option.disabled = true;
                    option.text += ' (Already Exist)';
                }
            }

            // Set the selected value after updating options
            select.value = item_type_id;

            document.getElementById('edit-form-section').classList.remove('hidden');

        }


        function cancelEdit() {
            document.getElementById('edit-form-section').classList.add('hidden');
            document.getElementById('edit-form').reset();
        }
    </script>



    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">



        <form action="{{ route('store.package_type') }}" method="POST">
            @csrf
            <h2 class="text-2xl font-bold mb-2"> DCP Package Details</h2>

            <div class=" flex flex-col md:flex-row gap-4 mb-4 w-full">
                <div class="w-full md:w-1/3">
                    <div class="mb-4">
                        <label for="code" class="block text-gray-700   font-semibold mb-2">DCP Package
                            Code</label>
                        <input type="text"
                            class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="code" name="code" required>
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700   font-semibold  mb-2">DCP Package
                            Name</label>
                        <input type="text"
                            class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="name" name="name" required>
                    </div>
                </div>

                <div class="w-full md:w-1/3">
                </div>
            </div>
            <div id="package-contents">
                <h4 class="text-lg font-bold mb-2">DCP Package Contents</h4>







                <div id="package-content-list">
                    <div class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full">
                        <div class="w-full md:w-1/3">
                            <label for="item_type_id" class="block text-gray-700   font-semibold  mb-2 w-full">Product
                            </label>
                            <select name="item_type_id[]"
                                class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                <option value="">-- Select Product --</option>
                                @foreach ($itemTypes as $itemType)
                                    <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full md:w-1/3">
                            <label for="quantity"
                                class="block text-gray-700    font-semibold  mb-2 w-full">Quantity</label>
                            <input type="number"
                                class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="quantity" name="quantity[]" required>
                        </div>
                        <div class="w-full md:w-1/3 flex items-end">
                            <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white   py-1 px-2 rounded"
                                id="add-package-content">Add More Item</button>
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white   py-1 px-2 rounded">Create New
                Package
            </button>
        </form>
    </div>






    <div id="item-type-options" class="hidden">
        @foreach ($itemTypes as $itemType)
            <option value="{{ $itemType->pk_dcp_item_types_id }}">{{ $itemType->name }}</option>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPackageContentButton = document.getElementById('add-package-content');
            const packageContentList = document.getElementById('package-content-list');
            const itemTypeOptions = document.getElementById('item-type-options').innerHTML;

            addPackageContentButton.addEventListener('click', function() {
                const newRow = `
                <div class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full">
                    <!-- Product -->
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700    font-semibold mb-2">Product</label>
                        <select name="item_type_id[]"
                            class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                            required>
                            <option value="">-- Select Product --</option>
                            ${itemTypeOptions}
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700   font-semibold  mb-2">Quantity</label>
                        <input type="number"
                            name="quantity[]"
                            class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>

                    <!-- Remove Button -->
                    <div class="w-full md:w-1/3 flex items-end">
                        <button type="button"
                            class="remove-package-content bg-red-500 hover:bg-red-700 text-white   py-1 px-2 rounded">
                            Remove
                        </button>
                    </div>
                </div>
            `;
                packageContentList.insertAdjacentHTML('beforeend', newRow);
            });

            packageContentList.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-package-content')) {
                    const row = event.target.closest('.package-content');
                    if (row) row.remove();
                }
            });
        });
    </script>
@endsection

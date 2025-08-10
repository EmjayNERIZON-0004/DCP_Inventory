@extends('layout.Admin-Side')

@section('content')
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;

        }

        .table th,
        .table td {

            padding: 10px;
            text-align: left;
        }

        .table th {

            color: #fff;
        }

        .table td {
            background-color: #fff;
        }
    </style>
    <div id="create-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center overflow-y-auto justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="create-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden
             border border-green-700 p-6 w-full max-w-4xl relative"
            style="max-height: 80vh; overflow-y: auto;">
            <button type="button" onclick="cancelCreate()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <form id="create-form" action="{{ route('store.package_type') }}" method="POST"> @csrf
                <h2 class="text-2xl font-bold  w-full text-center md:text-left"> DCP Package Details

                    <span class="bg-green-600 text-white py-1 px-2 rounded-xl text-sm font-semibold">New</span>
                </h2>
                <div class="flex justify-center md:justify-start  ">
                    {{-- <div class="rounded-full bg-green-100 p-3 shadow-md flex items-center justify-center"
                        style="width: 130px; height: 130px;">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="w-16 h-16 text-green-700 stroke-current">
                            <path
                                d="M20.5 7.27783L12 12.0001M12 12.0001L3.49997 7.27783M12 12.0001L12 21.5001M14 20.889L12.777 21.5684C12.4934 21.726 12.3516 21.8047 12.2015 21.8356C12.0685 21.863 11.9315 21.863 11.7986 21.8356C11.6484 21.8047 11.5066 21.726 11.223 21.5684L3.82297 17.4573C3.52346 17.2909 3.37368 17.2077 3.26463 17.0893C3.16816 16.9847 3.09515 16.8606 3.05048 16.7254C3 16.5726 3 16.4013 3 16.0586V7.94153C3 7.59889 3 7.42757 3.05048 7.27477C3.09515 7.13959 3.16816 7.01551 3.26463 6.91082C3.37368 6.79248 3.52345 6.70928 3.82297 6.54288L11.223 2.43177C11.5066 2.27421 11.6484 2.19543 11.7986 2.16454C11.9315 2.13721 12.0685 2.13721 12.2015 2.16454C12.3516 2.19543 12.4934 2.27421 12.777 2.43177L20.177 6.54288C20.4766 6.70928 20.6263 6.79248 20.7354 6.91082C20.8318 7.01551 20.9049 7.13959 20.9495 7.27477C21 7.42757 21 7.59889 21 7.94153L21 12.5001M7.5 4.50008L16.5 9.50008M19 21.0001V15.0001M16 18.0001H22"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div> --}}
                </div>
                <div class=" flex flex-col md:flex-row gap-4  w-full">
                    <div class="w-full md:w-1/3">
                        <div class="mb-2">
                            <label for="code" class="block text-gray-700   font-semibold mb-2">DCP Package
                                Code</label>
                            <input type="text"
                                class="shadow appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="code" name="code" required>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3">
                        <div>
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
                            <div class="w-full md:w-1/2">
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
                            @php
                                $brands = \App\Models\DCPBatchItemBrand::all();

                            @endphp
                            <div id="brand-options" class="hidden">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </div>
                            <div class="w-full md:w-1/3">
                                <label for="item_brand_id" class="block text-gray-700   font-semibold  mb-2 w-full">Brand
                                </label>

                                <select name="item_brand_id[]"
                                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">-- Select Brand --</option>

                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                        </option>
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
                                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white   py-1 px-2 rounded"
                                    id="add-package-content">Add More Item</button>
                            </div>
                        </div>

                    </div>
                </div>
                <button type="submit" class="bg-green-700 hover:bg-green-700 text-white   py-1 px-2 rounded">Create New
                    Package
                </button>
            </form>
        </div>
    </div>
    <script>
        function showCreateForm() {
            document.getElementById('create-form').reset();
            document.getElementById('create-modal-overlay').classList.remove('hidden');
            document.getElementById('create-form-section').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cancelCreate() {
            document.getElementById('create-modal-overlay').classList.add('hidden');
            document.getElementById('create-form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>



    <!-- Modal Overlay for Insert Form -->
    <div id="insert-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="insert-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden border border-blue-500 p-6 w-full max-w-2xl relative">
            <button type="button" onclick="cancelInsert()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <form id="insert-form" method="POST" action="{{ route('insert.package_item') }}">
                @csrf
                <input type="hidden" name="insert_package_id" id="insert_package_id">

                <h2 class="text-2xl font-bold mb-2">Insert Item to <span class="insert_package_name font-semibold"></span>
                    <span class="bg-blue-600 text-white py-1 px-2 rounded-xl text-sm font-semibold">Insert</span>
                </h2>

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
                        <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                        <select name="insert_item_brand_id" id="insert_item_brand_id"
                            class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                            required>
                            <option value="">-- Select Brand --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                </option>
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

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded">Insert
                    Item</button>
                <button type="button" onclick="cancelInsert()"
                    class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-1">Cancel</button>
            </form>
        </div>
    </div>





    <script>
        function showInsertForm(dcp_packages_id, package_name) {
            document.getElementById('insert_package_id').value = dcp_packages_id;
            document.querySelectorAll('.insert_package_name').forEach(el => el.textContent = package_name);

            document.getElementById('insert-form').reset();
            document.getElementById('insert-modal-overlay').classList.remove('hidden');
            document.getElementById('insert-form-section').classList.remove('hidden');

            // Hide edit modal if open
            document.getElementById('edit-modal-overlay').classList.add('hidden');
            document.body.classList.add('overflow-hidden');
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
            document.getElementById('insert-modal-overlay').classList.add('hidden');
            document.getElementById('insert-form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    <!-- Modal Overlay -->
    <div id="edit-modal-overlay"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <!-- Modal Content -->
        <div id="edit-form-section"
            class="bg-white shadow-xl rounded-lg overflow-hidden p-6 border border-yellow-500 w-full max-w-4xl relative">
            <button type="button" onclick="cancelEdit()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <form id="edit-form" method="POST" action="{{ route('update.package_type') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="package_id" id="edit-package-id">

                <h2 class="text-2xl font-bold mb-2">Edit Package Content Items
                    <span class="bg-yellow-500 text-white py-1 px-2 rounded-xl text-sm font-semibold">Update</span>
                </h2>
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
                        <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                        <select name="edit_item_brand_id" id="edit_item_brand_id"
                            class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                            required>
                            <option value="">-- Select Brand --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->pk_dcp_batch_item_brands_id }}">{{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 font-semibold mb-2">Item Quantity</label>
                        <input type="text" name="quantity" id="edit-quantity"
                            class="shadow border border-gray-400 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                </div>

                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-4 rounded">Update
                    Package</button>
                <button type="button" onclick="cancelEdit()"
                    class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-1">Cancel</button>
            </form>
        </div>
    </div>


    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5"
        style="  border-radius: 8px;font-family: Verdana, Geneva, Tahoma, sans-serif;    overflow-x: auto;
             -webkit-overflow-scrolling: touch;">



        @php
            $groupedPackages = $packages->groupBy('package_name');
            $colors = ['#C9E4CA', '#F7D2C4', '#C5CAE9', '#F2C464'];
            $colorIndex = 0;
        @endphp
        <div class="flex justify-between">
            <div>
                <h2 class="text-2xl font-bold "> DCP Packages Offered</h2>
                <div class="text-md text-gray-600  mb-5">List of Package Type with Item Content</div>
            </div>
            <div>
                <button type="button" onclick="showCreateForm()"
                    class="bg-green-700 hover:bg-green-800 text-white py-2 px-4 rounded mb-4">
                    Create New Package
                </button>

            </div>
        </div>
        @if ($packages->isEmpty())
            <div class="text-center text-gray-500 py-8">No packages found.</div>
        @else
            <table class="table" style="border: 1px solid #ddd;
            ">
                <thead>
                    <tr>
                        <th class="bg-gray-700">Package </th>
                        <th class="bg-gray-700">Package Items</th>
                        <th class="bg-gray-700">Brand</th>
                        <th class="bg-gray-700" style="text-align:center">Quantity</th>
                        <th class="bg-gray-700 text-center" style="text-align: center">Action</th>
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
                                    <td class="border border-gray-700" style="  background-color: {{ $color }};"
                                        rowspan="{{ $rowspan }}">
                                        {{ $packageName }}
                                        <div class="mt-2"><button type="button"
                                                onclick="showInsertForm('{{ $package->dcp_packages_id }}', '{{ $packageName }}')"
                                                class="text-blue-500 hover:text-blue-700 underline">
                                                Insert Item
                                            </button></div>

                                        <form action="{{ route('delete.package_type', $package->dcp_packages_id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this package?')"
                                                class="text-red-500 hover:text-red-700 underline">Delete
                                                Package</button>
                                        </form>
                                    </td>
                                @endif
                                <td class="border border-gray-700" style="  background-color: {{ $color }};">
                                    {{ $package->item_name }}

                                </td>
                                <td class="border border-gray-700" style="  background-color: {{ $color }};">

                                    @php
                                        $brand_name = \App\Models\DCPBatchItemBrand::where(
                                            'pk_dcp_batch_item_brands_id',
                                            $package->dcp_batch_item_brands_id,
                                        )->value('brand_name');
                                    @endphp
                                    {{ $brand_name }}

                                </td>
                                <td
                                    style="border: 1px solid #282828; background-color: {{ $color }};text-align:center">
                                    {{ $package->quantity }}
                                </td>
                                <td
                                    style="border: 1px solid #282828; background-color: {{ $color }}; width: 1%; white-space: nowrap;">
                                    <div class="flex gap-2 flex-col md:flex-row" style="width: fit-content;  ">
                                        <button type="button" style="border: 1px solid black"
                                            onclick="showEditForm(
                                            '{{ $package->dcp_packages_id }}',
                                            '{{ $package->item_type_id }}',
                                            '{{ $package->id }}',
                                            '{{ $packageName }}',
                                            '{{ $package->item_name }}',
                                            `{{ $package->quantity }}`,
                                            '{{ $package->dcp_batch_item_brands_id }}' // Pass brand ID here
                                                  )"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-4 rounded">
                                            Edit Content
                                        </button>
                                        <form action="{{ route('delete.package_item', $package->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to remove this item?')"
                                                style="border:1px solid #282828"
                                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded">
                                                Remove Item
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>




    <script>
        const usedItemsPerPackage = @json(
            $packages->groupBy('dcp_packages_id')->map(function ($group) {
                return $group->pluck('item_type_id');
            }));
    </script>


    <script>
        function showEditForm(dcp_packages_id, item_type_id, id, package_name, package_content_name, quantity, brand_id) {
            document.querySelectorAll('.package_name').forEach(el => el.value = package_name);
            document.getElementById('id').value = id;
            document.getElementById('edit-quantity').value = quantity;
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

            // Set the brand dropdown value
            document.getElementById('edit_item_brand_id').value = brand_id;

            // Show modal
            document.getElementById('edit-modal-overlay').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cancelEdit() {
            document.getElementById('edit-modal-overlay').classList.add('hidden');
            document.getElementById('edit-form').reset();
            document.body.classList.remove('overflow-hidden');
        }
    </script>










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
            const brandOptions = document.getElementById('brand-options').innerHTML;

            addPackageContentButton.addEventListener('click', function() {
                const newRow = `
        <div class="package-content flex flex-col md:flex-row gap-4 mb-4 w-full">
            <!-- Product -->
            <div class="w-full md:w-1/2">
                <label class="block text-gray-700 font-semibold mb-2">Product</label>
                <select name="item_type_id[]"
                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="">-- Select Product --</option>
                    ${itemTypeOptions}
                </select>
            </div>
            <!-- Brand -->
            <div class="w-full md:w-1/3">
                <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                <select name="item_brand_id[]"
                    class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="">-- Select Brand --</option>
                    ${brandOptions}
                </select>
            </div>
            <!-- Quantity -->
            <div class="w-full md:w-1/3">
                <label class="block text-gray-700 font-semibold mb-2">Quantity</label>
                <input type="number"
                    name="quantity[]"
                    class="w-full shadow appearance-none border border-gray-400 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <!-- Remove Button -->
            <div class="w-full md:w-1/3 flex items-end">
                <button type="button"
                    class="remove-package-content bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded">
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

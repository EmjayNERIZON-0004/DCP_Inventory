@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')


    <div class="flex flex-col md:flex-row gap-6 mx-5 my-5">

        {{-- Left Form (fixed height) --}}
        <div class="md:w-1/2 bg-white shadow-xl rounded-lg p-6"
            style="font-family: Verdana, Geneva, Tahoma, sans-serif; height: 450px;">


            <form id="item-type-form" method="POST" action="{{ route('store.item_type') }}"
                class="h-full flex flex-col justify-between">
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">

                <div>
                    <h2 class="text-2xl text-blue-700 font-bold mb-3">DCP Batch Item Types</h2>
                    <div class="flex justify-center mb-4">
                        <div class="rounded-full bg-blue-100 p-3 shadow-md flex items-center justify-center"
                            style="width: 130px; height: 130px;">
                            <!-- SVG Icon: Box / Item -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="w-18 h-18 text-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 7l9 5 9-5M3 17l9 5 9-5M3 7v10m18-10v10M3 17l9-5m9 5l-9-5" />
                            </svg>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="code" class="block text-gray-700 mb-1">Code for Items - Unique</label>
                        <input type="text" name="code" id="code"
                            class="shadow border border-gray-400 rounded w-full py-1 px-2 text-gray-700 focus:outline-none focus:shadow-outline"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="block text-gray-700 mb-1">Name of Item</label>
                        <textarea name="name" id="name" rows="2"
                            class="shadow border border-gray-400 rounded w-full py-1 px-2 text-gray-700 focus:outline-none focus:shadow-outline"
                            required></textarea>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" id="addBtn"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded">Add Item Type</button>

                    <button type="submit" id="updateBtn"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-1 px-4 rounded hidden">Update Item
                        Type</button>
                </div>
            </form>

        </div>

        {{-- Right Table (fixed height + scrollable) --}}
        <div class="md:w-full bg-white shadow-xl rounded-lg p-6" style=" height: 460px;">
            <label class="text-xl font-semibold text-gray-700 mb-5">Existing Item Types</label>

            <div class="overflow-y-auto"
                style="max-height: 380px;border:1px solid #ccc;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <table class="table-auto w-full">
                    <thead class="sticky top-0 bg-gray-700 text-white">
                        <tr>
                            <th class="px-4 py-2 border">Item Code</th>
                            <th class="px-4 py-2 border">Item Name</th>
                            <th class="px-2 py-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($itemTypes == null || $itemTypes->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center py-1">No item types available.</td>
                            </tr>
                        @else
                            @foreach ($itemTypes as $itemType)
                                <tr>
                                    <td class="border px-4 py-1 w-1/3">{{ $itemType->code }}</td>
                                    <td class="border px-4 py-1 w-1/2">{{ $itemType->name }}</td>
                                    <td class="border px-6   py-1 w-1/3">
                                        <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                            <!-- Edit Button -->
                                            <button type="button"
                                                onclick="editItem('{{ $itemType->pk_dcp_item_types_id }}', '{{ $itemType->code }}', `{{ $itemType->name }}`)"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-4 rounded w-full md:w-auto m-0 p-0">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('delete.item_type', $itemType->pk_dcp_item_types_id) }}"
                                                method="POST" class="m-0 p-0 flex"
                                                onsubmit="return confirm('Are you sure you want to delete this item type?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white py-1 px-4 rounded w-full md:w-auto m-0 p-0">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        function editItem(id, code, name) {
            document.getElementById('edit_id').value = id;
            document.getElementById('code').value = code;
            document.getElementById('name').value = name;

            // Change form action to update route
            const form = document.getElementById('item-type-form');
            form.action = `/Admin/update-item-type/${id}`;

            // Toggle buttons
            document.getElementById('addBtn').classList.add('hidden');
            document.getElementById('updateBtn').classList.remove('hidden');
        }
    </script>

    <div class="text-2xl font-semibold text-gray-800 mb-4 mx-5 my-5">Other Details</div>
    <div class="flex flex-col md:flex-row gap-6 mx-5 my-5">
        <div class="w-full   bg-white shadow-xl rounded-lg overflow-hidden p-6">
            <form id="update_delivery_form" method="POST" action="{{ route('store.delivery_mode') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="delivery_id" id="delivery_id">
                <label for="delivery_mode"
                    class="block text-gray-700 text-xl font-semibold mb-2 text-center w-full">Delivery Mode</label>
                <div class="flex justify-center mb-4">
                    <div class="rounded-full bg-green-100 p-5 shadow-md flex items-center justify-center"
                        style="width: 130px; height: 130px;">
                        <!-- SVG Icon: Delivery Truck -->
                        <svg class="w-full h-full text-green-700 fill-current" fill="#ffffff" height="200px" width="200px"
                            version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 188" xml:space="preserve"
                            stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M63,133c-13,0-23.5,10.5-23.5,23.5s10.5,23.5,23.5,23.5c13,0,23.5-10.5,23.5-23.5S76,133,63,133z M63,165.4 c-4.9,0-9-4.1-9-9c0-4.9,4.1-9,9-9c4.9,0,9,4.1,9,9C72,161.4,68,165.4,63,165.4z M210.8,132c-13,0-23.5,10.5-23.5,23.5 s10.5,23.5,23.5,23.5c13,0,23.5-10.5,23.5-23.5S223.8,132,210.8,132z M210.8,164.4c-4.9,0-9-4.1-9-9c0-4.9,4.1-9,9-9 c4.9,0,9,4.1,9,9C219.8,160.4,215.8,164.4,210.8,164.4z M-0.5,143.1c0,4.6,3.7,8.2,8.2,8.2h22.6c0.9,0,1.7-0.7,1.9-1.5 c2.6-14.7,15.4-24.9,30.8-24.9s28.3,10.2,30.8,24.9c0.2,0.9,0.9,1.5,1.9,1.5H99h30.9V115H-0.5V143.1z M253.6,134.5h-5v-22 c0-7.5-6.1-13.6-13.7-13.6h-24.3c-0.5,0-1-0.3-1.4-0.6l-38-37c-1.7-1.7-4.1-2.7-6.6-2.8h-27.5v92.8h40.9c0.9,0,1.7-0.7,1.9-1.5 c2.6-14.7,15.4-25.9,30.8-25.9s28.3,11.2,30.8,25.9c0.2,0.9,0.9,1.5,1.9,1.5h3.2c4.9,0,8.7-3.9,8.7-8.7v-6.3 C255.5,135.4,254.6,134.5,253.6,134.5z M191.1,99h-41.4c-1,0-1.9-0.9-1.9-1.9V70.7c0-1,0.9-1.9,1.9-1.9h13.9c0.5,0,1,0.3,1.5,0.6 l27.5,26.3C193.5,97,192.7,99,191.1,99z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                                <path
                                    d="M57.8,101.5H17.1V60.8h15.7v13h9.3v-13h15.7V101.5z M110.9,101.5H70.3V60.8H86v13h9.3v-13h15.7V101.5z M84.7,48.3H44V7.6 h15.7v13H69v-13h15.7V48.3z">
                                </path>
                            </g>
                        </svg>
                    </div>

                </div>

                <div class="mb-3 flex flex-col md:flex-row gap-2  ">
                    <input type="text " name="delivery_mode" style="border: 1px solid #282828" id="delivery_mode"
                        class="w-full border rounded px-2 py-1">


                    <button
                        class="px-6 py-2 w-full md:w-1/2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        id="delivery_addBtn" style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Add
                    </button>


                    <button id="delivery_updateBtn"
                        class="px-6 py-2 w-full md:w-1/2 bg-green-600 text-white rounded-md hover:bg-green-700 transition hidden"
                        style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Update
                    </button>



                </div>
            </form>

            <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                <table class="table-auto   w-full" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                    <thead class="bg-gray-700 sticky top-0">
                        <tr>
                            <th class="text-white px-4 py-2 border border-gray-300">Delivery Mode</th>
                            <th class="text-white px-4 py-2 border border-gray-300">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $modes = \App\Models\DCPItemModeDelivery::all();
                        @endphp

                        @foreach ($modes as $mode)
                            <tr>
                                <td class="px-4 py-1 border border-gray-300">{{ $mode->name }}</td>
                                <td class="  border border-gray-300 px-4 py-1">
                                    <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                        <!-- Edit Button -->
                                        <button
                                            onclick="editItemDelivery('{{ $mode->pk_dcp_item_mode_delivery_id }}', '{{ $mode->name }}')"
                                            class="px-6 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-all m-0">
                                            Edit
                                        </button>

                                        <!-- Delete Form/Button -->
                                        <form
                                            action="{{ route('delete.delivery_mode', $mode->pk_dcp_item_mode_delivery_id) }}"
                                            method="POST" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this delivery mode?')"
                                                class="px-6 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md transition-all m-0">
                                                Delete
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function editItemDelivery(id, name) {
                document.getElementById('delivery_id').value = id;

                document.getElementById('delivery_mode').value = name;

                // Change form action to update route
                const form = document.getElementById('update_delivery_form');
                form.action = `/delivery-type/edit/${id}`;

                // Toggle buttons
                document.getElementById('delivery_addBtn').classList.add('hidden');
                document.getElementById('delivery_updateBtn').classList.remove('hidden');
            }
        </script>


        <div class="w-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
            <label for="brand_name" class="block text-gray-700 text-xl font-semibold mb-2 text-center w-full">Supplier
                Name</label>
            <div class="flex justify-center mb-4">

                <div class="rounded-full bg-blue-100 p-5 shadow-md flex flex-col items-center justify-center"
                    style="width: 130px; height: 130px;">

                    <svg class="  text-blue-700 fill-current stroke-current stroke-[2]" fill="#ffffff" version="1.1"
                        id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 444.185 444.184" xml:space="preserve" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <g>
                                    <path
                                        d="M404.198,205.738c-0.917-0.656-2.096-0.83-3.165-0.467c0,0-119.009,40.477-122.261,41.598 c-2.725,0.938-4.487-1.42-4.487-1.42l-37.448-46.254c-0.935-1.154-2.492-1.592-3.89-1.098c-1.396,0.494-2.332,1.816-2.332,3.299 v167.891c0,1.168,0.583,2.26,1.556,2.91c0.584,0.391,1.263,0.59,1.945,0.59c0.451,0,0.906-0.088,1.336-0.267l168.045-69.438 c1.31-0.541,2.163-1.818,2.163-3.234v-91.266C405.66,207.456,405.116,206.397,404.198,205.738z">
                                    </path>
                                    <path
                                        d="M443.487,168.221l-32.07-42.859c-0.46-0.615-1.111-1.061-1.852-1.27L223.141,71.456c-0.622-0.176-1.465-0.125-2.096,0.049 L34.62,124.141c-0.739,0.209-1.391,0.654-1.851,1.27L0.698,168.271c-0.672,0.898-0.872,2.063-0.541,3.133 c0.332,1.07,1.157,1.918,2.219,2.279l157.639,53.502c0.369,0.125,0.749,0.187,1.125,0.187c1.035,0,2.041-0.462,2.718-1.296 l44.128-54.391l13.082,3.6c0.607,0.168,1.249,0.168,1.857,0v-0.008c0.064-0.016,0.13-0.023,0.192-0.041l13.082-3.6l44.129,54.391 c0.677,0.834,1.683,1.295,2.718,1.295c0.376,0,0.756-0.061,1.125-0.186l157.639-53.502c1.062-0.361,1.887-1.209,2.219-2.279 C444.359,170.283,444.159,169.119,443.487,168.221z M222.192,160.381L88.501,123.856l133.691-37.527l133.494,37.479 L222.192,160.381z">
                                    </path>
                                    <path
                                        d="M211.238,198.147c-1.396-0.494-2.955-0.057-3.889,1.098L169.901,245.5c0,0-1.764,2.356-4.488,1.42 c-3.252-1.121-122.26-41.598-122.26-41.598c-1.07-0.363-2.248-0.189-3.165,0.467c-0.918,0.658-1.462,1.717-1.462,2.846v91.267 c0,1.416,0.854,2.692,2.163,3.233l168.044,69.438c0.43,0.178,0.885,0.266,1.336,0.266c0.684,0,1.362-0.199,1.946-0.59 c0.972-0.65,1.555-1.742,1.555-2.91V201.445C213.57,199.963,212.635,198.641,211.238,198.147z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </svg>

                </div>
            </div>

            <form id="update_supplier_form" method="POST" action="{{ route('store.supplier') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="brand_id" id="supplier_id">

                <div class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="brand_name" id="supplier_name" style="border: 1px solid #282828"
                        class="w-full md:w-full border rounded px-2 py-1">

                    <!-- Add Button -->
                    <button id="supplier_addBtn" type="submit"
                        class="px-6 w-full md:w-1/2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                        Add
                    </button>

                    <!-- Update Button -->
                    <button id="supplier_updateBtn" type="submit"
                        class="hidden px-6 w-full md:w-1/2 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                        style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                        Update
                    </button>
                </div>
            </form>




            <div class="overflow-y-auto " style=" height:300px">
                <table class="table-auto w-full  " style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                    <thead class="bg-gray-700 sticky top-0">
                        <tr>
                            <th class="text-white px-4 py-2 border border-gray-300">Supplier Name</th>
                            <th class="text-white px-4 py-2 border border-gray-300">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $brands = \App\Models\DCPItemBrand::all();
                        @endphp

                        @foreach ($brands as $brand)
                            <tr>
                                <td class="px-4 py-1 border border-gray-300">{{ $brand->name }}</td>
                                <td class="border border-gray-300 px-4 py-1">
                                    <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                                        <!-- Edit Button -->
                                        <button
                                            onclick="editSupplier('{{ $brand->pk_dcp_item_brand_id }}', '{{ $brand->name }}')"
                                            class="px-6 py-1 h-[36px] bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form method="POST"
                                            action="{{ route('delete.supplier', $brand->pk_dcp_item_brand_id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this brand?')"
                                            class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-6 py-1 h-[36px] bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        <div class="w-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
            <label for="brand_name" class="block text-gray-700 text-xl font-semibold mb-2 text-center w-full">Brand
                Name</label>
            <div class="flex justify-center mb-4">

                <div class="rounded-full bg-red-100 shadow-md flex items-center justify-center"
                    style="width: 130px; height: 130px; padding: 1rem;">

                    <svg class="w-16 h-16 text-red-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 994.2 994.201">
                        <path d="M25,623.951h25.5c10.9,0,20.5-7,23.8-17.5c8.6-26.701,20.8-47.201,36.3-60.9c15.5-13.701,34.5-21.1,57.7-22.4l-0.1,294.9
                                                                                    c0,8.5-3.9,10.6-23.4,12.6h-0.2c-8.9,0.9-18.3,1.801-28.6,2.6c-12.9,1-23,12-23,24.9v25.9c0,13.799,11.2,25,25,25h111.6h0.1h111.6
                                                                                    c13.801,0,25-11.201,25-25v-25.9c0-12.9-10.1-23.9-23-24.9c-10.3-0.799-19.699-1.699-28.6-2.6h-0.2c-19.5-2-23.4-4.199-23.4-12.6
                                                                                    l-0.1-294.9c23.2,1.301,42.2,8.699,57.7,22.4c15.5,13.699,27.7,34.1,36.3,60.9c3.3,10.398,12.9,17.5,23.8,17.5h25.5
                                                                                    c13.801,0,25-11.201,25-25V469.75c0-13.8-11.199-25-25-25H229.7h-0.1H25c-13.8,0-25,11.2-25,25v129.099
                                                                                    C0,612.65,11.2,623.951,25,623.951z" />
                        <path
                            d="M964.2,85.15h-329.1h-0.2h-329c-16.6,0-30,13.4-30,30v200.2c0,16.6,13.4,30,30,30h32.3c13,0,24.4-8.3,28.5-20.6
                                                                                    c28.7-86.9,83.6-145.8,184.4-144.3L551,776.349c0,31.5-27.899,34.301-53.2,36.9c-14.1,1.5-28.1,2.701-42.199,3.9
                                                                                    C440,818.451,428,831.451,428,847.05v31.799c0,16.602,13.4,30,30,30h177h0.2h177c16.6,0,30-13.398,30-30V847.05
                                                                                    c0-15.6-12-28.6-27.6-29.9c-14.101-1.1-28.101-2.4-42.2-3.9c-25.3-2.6-53.2-5.4-53.2-36.9l-0.1-595.899
                                                                                    c100.8-1.5,155.699,57.4,184.399,144.3c4.101,12.3,15.5,20.6,28.5,20.6h32.2c16.6,0,30-13.4,30-30v-200.2
                                                                                    C994.2,98.55,980.8,85.15,964.2,85.15z" />
                    </svg>
                </div>

            </div>

            <form id="update_brand_form" method="POST" action="{{ route('store.brand') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="brand_id" id="brand_id">

                <div class="flex flex-col md:flex-row gap-2">
                    <input type="text" name="brand_name" id="brand_name" style="border: 1px solid #282828"
                        class="w-full md:w-full border rounded px-2 py-1">

                    <!-- Add Button -->
                    <button id="brand_addBtn" type="submit"
                        class="px-6 w-full md:w-1/2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                        Add
                    </button>

                    <!-- Update Button -->
                    <button id="brand_updateBtn" type="submit"
                        class="hidden px-6 w-full md:w-1/2 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                        style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                        Update
                    </button>
                </div>
            </form>



            <div class="overflow-y-auto " style=" height:300px">
                <table class="table-auto w-full " style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                    <thead class="bg-gray-700 sticky top-0">
                        <tr>
                            <th class="text-white px-4 py-2 border border-gray-300">Brand</th>
                            <th class="text-white px-4 py-2 border border-gray-300">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $brands = \App\Models\DCPBatchItemBrand::all();
                        @endphp

                        @foreach ($brands as $brand)
                            <tr>
                                <td class="px-4 py-1 border border-gray-300">{{ $brand->brand_name }}</td>
                                <td class="border border-gray-300 px-4 py-1">
                                    <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                                        <!-- Edit Button -->
                                        <button
                                            onclick="editBrand('{{ $brand->pk_dcp_batch_item_brands_id }}', '{{ $brand->brand_name }}')"
                                            class="px-6 py-1 h-[36px] bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form method="POST" {{-- action="{{ route('delete.brand', $brand->pk_batch_item_brands_id) }}" --}}
                                            onsubmit="return confirm('Are you sure you want to delete this brand?')"
                                            class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-6 py-1 h-[36px] bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function editBrand(id, name) {
            document.getElementById('brand_id').value = id;
            document.getElementById('brand_name').value = name;

            // Change form action to update route
            const form = document.getElementById('update_brand_form');
            form.action = `/brand/edit/${id}`; // adjust route if needed

            // Toggle buttons
            document.getElementById('brand_addBtn').classList.add('hidden');
            document.getElementById('brand_updateBtn').classList.remove('hidden');
        }

        function editSupplier(id, name) {
            document.getElementById('supplier_id').value = id;
            document.getElementById('supplier_name').value = name;

            // Change form action to update route
            const form = document.getElementById('update_supplier_form');
            form.action = `/supplier/edit/${id}`; // adjust route if needed

            // Toggle buttons
            document.getElementById('supplier_addBtn').classList.add('hidden');
            document.getElementById('supplier_updateBtn').classList.remove('hidden');
        }
    </script>
@endsection

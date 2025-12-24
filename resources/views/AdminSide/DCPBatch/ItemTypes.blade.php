@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        button {
            letter-spacing: 0.05rem;
            font-weight: 500 !important;
        }
    </style>
    <div id="add-modal" class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden "
        style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

        <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md relative md:max-w-sm max-w-7xl w-full">
            <form id="item-type-form" method="POST" action="{{ route('store.item_type') }}" class="  flex flex-col gap-2 mt-4">
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">

                <h2 class="text-2xl text-gray-700 font-bold ">DCP Batch Item - Product</h2>


                <div>
                    <label for="code" class="block text-gray-700 mb-1">Code for Items - Unique</label>
                    <input type="text" name="code" id="code"
                        class="shadow border border-gray-400 rounded w-full py-1 px-2 text-gray-700 focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <div>
                    <label for="name" class="block text-gray-700 mb-1">Name of Item</label>
                    <textarea name="name" id="name" rows="2"
                        class="shadow border border-gray-400 rounded w-full py-1 px-2 text-gray-700 focus:outline-none focus:shadow-outline"
                        required></textarea>
                </div>


                <div class="flex gap-2">
                    <button type="submit" id="addBtn"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded">Save</button>

                    <button type="submit" id="updateBtn"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded hidden">Update </button>
                    <button type="button" onclick="document.getElementById('add-modal').classList.add('hidden')"
                        class="w-full bg-gray-400 hover:bg-gray-500 text-white py-1 px-4 rounded  "
                        id="cancelBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div class="p-2  md:mx-5 md:my-5 mx-0 my-0" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="flex md:flex-row flex-col justify-between items-center mb-4">
            <div class="w-full">
                <h2 class="text-2xl font-bold text-gray-800 uppercase">Product List</h2>
                <p class="text-md text-gray-500">Create, Edit, and Delete Item Types</p>
            </div>
            <div class="w-full flex md:justify-end items-center">
                <button onclick="openModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow text-md font-normal">
                    + Add New Product
                </button>
            </div>

        </div>

        <!-- Search -->
        <div class="mb-4">
            <div class="text-md text-gray-700">Search</div>

            <input type="text" id="searchItemType" placeholder="Search Item Name..."
                class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>


        <!-- Card Grid -->
        <div id="itemTypeCardGrid"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 max-h-[380px] overflow-y-auto pr-2">
            @forelse ($itemTypes as $index => $itemType)
                <div
                    class="bg-white border border-gray-300 rounded-xl shadow hover:shadow-lg transition-all duration-300 p-4 flex flex-col gap-2 justify-between">

                    <!-- Top -->
                    <div class="flex-1" style="letter-spacing: 0.05rem">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 break-words">
                            <span
                                class="inline-flex items-center text-white justify-center min-w-8 h-8 px-2 border border-gray-500 bg-green-600 rounded-full">
                                {{ $index + 1 }}
                            </span>

                            {{ $itemType->name }}
                        </h3>
                        <p class="text-md text-gray-600 break-words" style="letter-spacing: 0.05rem">
                            <span class="font-semibold break-words">Code:</span>
                            {{ $itemType->code }}
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-row gap-2 mt-2 sm:mt-0 w-full">
                        <form action="{{ route('delete.item_type', $itemType->pk_dcp_item_types_id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this item type?');"
                            class="flex flex-row gap-2">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="editItem('{{ $itemType->pk_dcp_item_types_id }}', '{{ $itemType->code }}', `{{ $itemType->name }}`)"
                                class="w-full whitespace-nowrap bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-md text-md shadow-md">
                                Edit Product
                            </button>
                            <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-md text-md shadow-md flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>

            @empty
                <p class="col-span-full text-center text-gray-500">No item types available.</p>
            @endforelse
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $('#searchItemType').on('keyup', function() {
            const keyword = $(this).val();

            $.ajax({
                url: '/item-type/search',
                type: 'GET',
                data: {
                    query: keyword
                },
                success: function(response) {
                    let cards = '';

                    if (response.length > 0) {
                        response.forEach((item, index) => {
                            cards += `
                            <div class="bg-white border border-gray-300 rounded-xl shadow hover:shadow-lg transition-all duration-300 p-4 flex flex-col gap-2 justify-between">
                                <!-- Top -->
                                <div style="letter-spacing: 0.05rem">
                                    <h3 class="text-lg font-bold text-gray-800 break-words mb-1">
                                        <span
                                        class="inline-flex items-center justify-center min-w-8 h-8 px-2 text-white bg-green-600 rounded-full">
                                        ${index + 1 }
                                    </span>

                                        ${item.name}</h3>
                                    <p class="text-md break-words text-gray-600"><span class="font-semibold">Code:</span> ${item.code}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-row gap-2 mt-2 sm:mt-0">
                                    
                                     <form class="flex flex-row gap-2" action="item-type/${item.pk_dcp_item_types_id}" method="POST" class="flex-1"
                                    onsubmit="return confirm('Are you sure you want to delete this item type?');">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button"
                                        onclick="editItem('${item.pk_dcp_item_types_id}', '${item.code}', '${(item.name)}')"
                                        class="w-full whitespace-nowrap bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded-lg text-md shadow-md">
                                         Edit Product
                                    </button>
                                          <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-md text-md shadow-md flex items-center justify-center space-x-2">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        `;
                        });
                    } else {
                        cards =
                            `<p class="col-span-full text-center text-gray-500">No item types found.</p>`;
                    }

                    // Replace grid content
                    $('#itemTypeCardGrid').html(cards);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            })
        });

        function openModal() {
            document.getElementById('add-modal').classList.remove('hidden');
        }

        function editItem(id, code, name) {
            console.log(id, code, name);
            // Populate form fields
            document.getElementById('add-modal').classList.remove('hidden');
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
@endsection

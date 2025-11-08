@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <div id="add-modal" class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden "
        style="font-family: Verdana, Geneva, Tahoma, sans-serif;  ">

        <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md ">
            <form id="item-type-form" method="POST" action="{{ route('store.item_type') }}" class="  flex flex-col gap-2 mt-4">
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">

                <h2 class="text-2xl text-gray-700 font-bold ">DCP Batch Item Types</h2>


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
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-1 px-4 rounded hidden">Update </button>
                    <button type="button" onclick="document.getElementById('add-modal').classList.add('hidden')"
                        class="w-full bg-gray-400 hover:bg-gray-500 text-white py-1 px-4 rounded  "
                        id="cancelBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>



    {{-- Left Form (fixed height) --}}


    {{-- Right Table (fixed height + scrollable) --}}
    <div class="bg-white   border border-gray-400 shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5"
        style="  border-radius: 8px;font-family: Verdana, Geneva, Tahoma, sans-serif;    overflow-x: auto;
             -webkit-overflow-scrolling: touch;">

        <div class="flex justify-between" style="font-family: Verdana, Geneva, Tahoma, sans-serif;  ">
            <div class="flex flex-col w-full">
                <h2 class="text-2xl font-bold text-gray-700"> Item List</h2>
                <div class="text-md text-gray-600  mb-5">Create, Edit, and Delete Item Types</div>

                <input type="text" name="searchItemType" id="searchItemType"
                    class="w-1/2 mb-4 px-3 py-2 border border-gray-300 rounded shadow focus:outline-blue-400"
                    placeholder="Search Item Name...">
            </div>
            <div class="w-full flex justify-end items-start">
                <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded text-lg">Add
                    New
                    Item</button>
            </div>

        </div>

        <div class="overflow-y-auto"
            style="max-height: 380px;border:1px solid #ccc;font-family: Verdana, Geneva, Tahoma, sans-serif;">
            <table class="table-auto w-full border-collapse">
                <thead class="sticky top-0 bg-gray-700 text-white">
                    <tr>
                        <th class="px-4 py-2  ">No.</th>

                        <th class="px-4 py-2  ">Item Code</th>
                        <th class="px-4 py-2  ">Item Name</th>
                        <th class="px-2 py-2  ">Action</th>
                    </tr>
                </thead>
                <tbody id="itemTypeTableBody">
                    @if ($itemTypes == null || $itemTypes->isEmpty())
                        <tr>
                            <td colspan="2" class="text-center py-1">No item types available.</td>
                        </tr>
                    @else
                        @foreach ($itemTypes as $index => $itemType)
                            <tr>
                                <td class="border text-center  ">{{ $index + 1 }}</td>

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

                    let rows = '';
                    if (response.length > 0) {
                        response.forEach((items, index) => {
                            rows +=
                                `

                                <tr>
                                    <td class="border text-center  ">${index + 1 }</td>
                                    <td class="border px-4 py-1 w-1/3"> ${items.code }</td>
                                    <td class="border px-4 py-1 w-1/2">${items.name }</td>
                                    <td class="border px-6   py-1 w-1/3">
                                        <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                            <!-- Edit Button -->
                                            <button type="button" 
                                  onclick="editItem('${items.pk_dcp_item_types_id }', '${items.code }', ${JSON.stringify(items.name)})"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-4 rounded w-full md:w-auto m-0 p-0">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                             <form action="item-type/${items.pk_dcp_item_types_id}"
                                                method="POST" class="m-0 p-0 flex"
                                                onsubmit="return confirm('Are you sure you want to delete this item type?');">
                                                   <input type="hidden" name="_token" value="${csrfToken}">
                                                 <input type="hidden" name="_method" value="DELETE"> 
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white py-1 px-4 rounded w-full md:w-auto m-0 p-0">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>


                                </tr>
                                        `;


                        });
                    } else {
                        rows += `
                            <tr>
                                <td colspan="4" class="text-center py-1">No item types found.</td>
                            </tr>
                        `;
                    }
                    $('#itemTypeTableBody').html(rows);
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

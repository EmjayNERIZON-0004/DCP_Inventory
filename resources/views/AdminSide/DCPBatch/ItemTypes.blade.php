@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')


    <div class="flex flex-col md:flex-row gap-6 mx-5 my-5">

        {{-- Left Form (fixed height) --}}
        <div class="md:w-1/2 bg-white shadow-xl rounded-lg p-6"
            style="font-family: Verdana, Geneva, Tahoma, sans-serif; height: 300px;">


            <form id="item-type-form" method="POST" action="{{ route('store.item_type') }}"
                class="h-full flex flex-col justify-between">
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">

                <div>
                    <h2 class="text-2xl font-bold mb-3">DCP Batch Item Types</h2>

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
        <div class="md:w-full bg-white shadow-xl rounded-lg p-6"
            style="font-family: Verdana, Geneva, Tahoma, sans-serif; height: 460px;">
            <h2 class="text-xl font-bold mb-3">Existing Item Types</h2>

            <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                <table class="table-auto w-full">
                    <thead class="sticky top-0 bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 border">Item Code</th>
                            <th class="px-4 py-2 border">Item Name</th>
                            <th class="px-2 py-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($itemTypes == null || $itemTypes->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center py-2">No item types available.</td>
                            </tr>
                        @else
                            @foreach ($itemTypes as $itemType)
                                <tr>
                                    <td class="border px-4 py-2 w-1/3">{{ $itemType->code }}</td>
                                    <td class="border px-4 py-2 w-1/2">{{ $itemType->name }}</td>
                                    <td class="border px-6 py-2 w-1/3">
                                        <div class="flex flex-col md:flex-row gap-0 md:gap-2">
                                            {{-- View Button --}}
                                            {{-- Delete Button --}}
                                            <form action="{{ route('delete.item_type', $itemType->pk_dcp_item_types_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this item type?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded w-full md:w-auto">
                                                    Delete
                                                </button>
                                            </form>

                                            {{-- Edit Button --}}
                                            <button type="button"
                                                onclick="editItem('{{ $itemType->pk_dcp_item_types_id }}', '{{ $itemType->code }}', `{{ $itemType->name }}`)"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded w-full md:w-auto"
                                                style="height:fit-content">
                                                Edit
                                            </button>
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

@endsection

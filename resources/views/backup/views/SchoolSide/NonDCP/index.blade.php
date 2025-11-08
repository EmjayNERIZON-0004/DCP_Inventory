@extends('layout.SchoolSideLayout')

<title>
    @yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class="mx-5 my-5">

        <div class=" p-6 border bg-white border-gray-300 rounded-lg shadow-md">
            <div class="text-2xl font-bold text-gray-800">Non DCP Items</div>
            <div class="text-md font-normal text-gray-600 mb-4">eg. Computer, Laptop, Smart TV - Unit Price, Date Acquired
            </div>
            <button onclick="openModal()" class="bg-blue-600 text-white rounded-sm mb-2 py-1 px-4">Add Non-DCP Item</button>
            <div class="overflow-x-auto">
                <table class="table-auto w-full table-collapse">
                    <thead class="bg-gray-200 border border-gray-600 text-white">
                        <tr>
                            <td
                                class="text-lg tracking-wider font-semibold border-b border-gray-500 text-gray-800 text-center  text-gray-800 font-normal px-3 py-1">
                                No. </td>

                            <td
                                class="text-lg tracking-wider font-semibold border-b border-gray-500 text-gray-800 text-center  text-gray-800 font-normal px-3 py-1">
                                Item - Description </td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Unit - Price </td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Date Acquired </td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Funcitonal </td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Fund Source </td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Item Holder - Location </td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Remarks</td>
                            <td
                                class="text-lg tracking-wider text-gray-800 font-semibold border-b border-gray-500 text-gray-800 text-center  font-normal px-3 py-1">
                                Action</td>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($non_dcp as $index => $item)
                            <tr>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $index + 1 }}</td>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->item_description }}
                                </td>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->unit_price }}</td>

                                <td class="py-2 px-2 border border-gray-300 text-center">
                                    {{ \Carbon\Carbon::parse($item->date_acquired)->format('F j Y') }}
                                </td>



                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->total_functional }}
                                    /
                                    {{ $item->total_item }}</td>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                    {{ $item->fund_source->name ?? 'N/A' }}
                                </td>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                    {{ $item->item_holder_and_location ?? 'N/A' }}</td>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">{{ $item->remarks }}</td>
                                <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                    <div class="flex flex-row gap-2">
                                        <button
                                            onclick='editModal(
                                        {{ $item->pk_non_dcp_item_id }},
                                        @json($item->item_description),
                                        {{ $item->unit_price }},
                                        "{{ $item->date_acquired }}",
                                        {{ $item->total_functional }},
                                        {{ $item->total_item }},
                                        {{ $item->fund_source_id }},
                                        @json($item->item_holder_and_location),
                                        @json($item->remarks)
                                    )'
                                            class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 rounded">
                                            Edit
                                        </button>

                                        <button onclick="deleteItem({{ $item->pk_non_dcp_item_id }})"
                                            class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="add-modal"
            class=" modal fixed inset-0 bg-black bg-opacity-40 flex md:items-center items-start justify-center z-50 hidden overflow-y-auto overflow-x-hidden">
            <div class="modal-content px-4 bg-white rounded-md   my-5">
                <div class="text-2xl font-bold text-blue-600 mt-4">
                    Add Non-DCP Item
                </div>
                <div>This information will be included for reports.</div>
                <form action="{{ route('schools.nondcpitem.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="grid  grid-cols-2   gap-2">
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="item_description" class="">Item Description</label>
                            <textarea placeholder="eg. Computer, Laptop, Smart TV" name="item_description"
                                class="border border-gray-300 px-2  w-full  py-1"></textarea>
                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="unit_price" class="">Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" placeholder="0.00"
                                class="border border-gray-300 w-full  px-2 py-1">
                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="date_acquired" class="">Date Acquired</label>
                            <input type="date" name="date_acquired" class="border border-gray-300  w-full px-2 py-1">
                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="total_item" class="">Total Item</label>
                            <input placeholder="0" type="text" name="total_item"
                                class="border border-gray-300 w-full  px-2 py-1">
                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="total_functional" class="">Total Functional</label>
                            <input type="text" placeholder="0" name="total_functional"
                                class="border border-gray-300 w-full  px-2 py-1">
                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="fund_source">Fund Source</label>
                            <select name="fund_source_id" class="w-full border border-gray-400 w-full  rounded px-2 py-1">
                                @php
                                    $fund_sources = App\Models\FundSource::all();
                                @endphp
                                <option value="">Select </option>
                                @foreach ($fund_sources as $fund_source)
                                    <option value="{{ $fund_source->pk_fund_source_id }}">{{ $fund_source->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="item_holder_and_location">Item Holder - Location</label>
                            <textarea name="item_holder_and_location" class="border border-gray-300  w-full px-2 py-1"
                                placeholder="Name and Location of the Item User"></textarea>
                        </div>
                        <div class="mb-2 md:col-span-1 col-span-2">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="border border-gray-300   w-full px-2 py-1"
                                placeholder="Description of the Non-DCP item"></textarea>
                        </div>
                        <div class="flex justify-end  col-span-2 gap-2  ">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  py-1 px-4 rounded">
                                Save this Item
                            </button>
                            <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white  py-1 px-4 rounded"
                                onclick="document.getElementById('add-modal').classList.add('hidden')">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="edit-modal"
            class="modal fixed inset-0 bg-black  overflow-y-auto  bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content px-4 bg-white rounded-md mx-5 my-20">
                <div class="text-2xl font-bold text0-blue-600 mt-4">
                    Edit Non-DCP Item
                </div>
                <div>This information will be included for reports.</div>
                <form action="{{ route('schools.nondcpitem.update') }}" method="POST"
                    class="grid md:grid-cols-2 grid-cols-1 gap-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pk_non_dcp_item_id" id="pk_non_dcp_item_id">
                    <div class="mb-2  md:col-span-1 col-span-2">
                        <label for="item_description" class="">Item Description</label>
                        <textarea id="item_description" placeholder="eg. Computer, Laptop, Smart TV" name="item_description"
                            class="border border-gray-300 px-2  w-full  py-1"></textarea>
                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="unit_price" class="">Unit Price</label>
                        <input type="number" id="unit_price" step="0.01" name="unit_price" placeholder="0.00"
                            class="border border-gray-300 w-full  px-2 py-1">
                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="date_acquired" class="">Date Acquired</label>
                        <input type="date" id="date_acquired" name="date_acquired"
                            class="border border-gray-300  w-full px-2 py-1">
                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="total_item" class="">Total Item</label>
                        <input placeholder="0" id="total_item" type="text" name="total_item"
                            class="border border-gray-300 w-full  px-2 py-1">
                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="total_functional" class="">Total Functional</label>
                        <input type="text" placeholder="0" id="total_functional" name="total_functional"
                            class="border border-gray-300 w-full  px-2 py-1">
                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="fund_source">Fund Source</label>
                        <select name="fund_source_id" id="fund_source_id"
                            class="w-full border border-gray-400 w-full  rounded px-2 py-1">
                            @php
                                $fund_sources = App\Models\FundSource::all();
                            @endphp
                            <option value="">Select </option>
                            @foreach ($fund_sources as $fund_source)
                                <option value="{{ $fund_source->pk_fund_source_id }}">{{ $fund_source->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="item_holder_and_location">Item Holder - Location</label>
                        <textarea name="item_holder_and_location" id="item_holder_and_location"
                            class="border border-gray-300  w-full px-2 py-1" placeholder="Name and Location of the Item User"></textarea>
                    </div>
                    <div class="mb-2 md:col-span-1 col-span-2">
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" id="remarks" class="border border-gray-300   w-full px-2 py-1"
                            placeholder="Description of the Non-DCP item"></textarea>
                    </div>
                    <div class="flex justify-end  col-span-2 gap-2  ">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  py-1 px-4 rounded">
                            Update this Item
                        </button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white  py-1 px-4 rounded"
                            onclick="document.getElementById('edit-modal').classList.add('hidden')">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function openModal() {
                document.getElementById('add-modal').classList.remove('hidden');

            }

            function editModal(pk_non_dcp_item_id, item_description, unit_price, date_acquired, total_item,
                total_functional, fund_source_id, item_holder_and_location, remarks) {

                console.log(pk_non_dcp_item_id, item_description, unit_price, date_acquired, total_item, );
                document.getElementById('edit-modal').classList.remove('hidden');
                document.getElementById('pk_non_dcp_item_id').value = pk_non_dcp_item_id;
                document.getElementById('item_description').value = item_description;
                document.getElementById('unit_price').value = unit_price;
                document.getElementById('date_acquired').value = date_acquired;
                document.getElementById('total_item').value = total_item;
                document.getElementById('total_functional').value = total_functional;
                document.getElementById('fund_source_id').value = fund_source_id;
                document.getElementById('item_holder_and_location').value = item_holder_and_location;
                document.getElementById('remarks').value = remarks;

            }

            function deleteItem(pk_non_dcp_item_id) {

                if (confirm("Are you sure you want to delete this item?")) {
                    $.ajax({
                        url: "{{ url('School/NonDCPItem/delete') }}/" + pk_non_dcp_item_id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}", // ✅ important for Laravel
                            pk_non_dcp_item_id: pk_non_dcp_item_id
                        },
                        success: function(data) {
                            location.reload();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert("Failed to delete item.");
                        }
                    });
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </div>
@endsection

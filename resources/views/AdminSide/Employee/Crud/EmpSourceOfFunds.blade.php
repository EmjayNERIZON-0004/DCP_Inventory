@php
    $emp_source_of_funds = App\Models\EmpSourceOfFund::all();
@endphp
<div class="bg-white px-5 py-5 rounded-sm shadow-md border border-gray-300  ">

    <div>

        <div class="text-2xl font-bold text-gray-700    ">Source of Fund</div>
        <div class="text-lg font-normal text-gray-600     ">For Employee Digital Identity</div>

        <button onclick="openAddModalSourceOfFund()"
            class="px-6 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add Source of
            Fund</button>

    </div>
    <table class="bg-white  rounded-sm shadow-md border border-gray-300 w-full">
        <thead class="bg-gray-100 text-white bg-gray-700  ">
            <th class="px-2 py-2 text-center">No. </th>
            <th class="px-2 py-2 text-start">Source of Fund</th>
            <th class="px-2 py-2">Action</th>

        </thead>
        <tbody>

            @forelse ($emp_source_of_funds as $emp_source_of_fund)
                <tr>
                    <td class="px-2 py-2 border border-gray-300  w-10 bg-gray-100  text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-2 border border-gray-300">
                        {{ $emp_source_of_fund->name }}
                    </td>

                    <td class="px-2 py-2 border border-gray-300">
                        <div class="flex flex-col md:flex-row justify-center  gap-3">

                            <form class="flex flex-col md:flex-row justify-center text-center gap-2"
                                action="{{ route('emp-source-of-fund.destroy', $emp_source_of_fund->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this Source of Fund Name?')">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                    onclick="openEditModalSourceOfFund({{ $emp_source_of_fund->id }}, '{{ $emp_source_of_fund->name }}')"
                                    class="bg-blue-500  justify-center  flex items-center shadow-md hover:bg-blue-600 text-white py-1 px-2 rounded">
                                    Edit
                                </button>
                                <button type="submit"
                                    class="px-2 py-1  justify-center  bg-red-600 text-white rounded-sm hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No Record Found.</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>

<div id="add-source_of_fund-modal"
    class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

        <form action="{{ route('emp-source-of-fund.store') }}" method="POST" class="mt-2">
            <h2 class="font-bold text-2xl text-gray-700">Add Source of Fund</h2>
            @csrf
            @method('POST')
            <div>
                <label for="name">Name</label>
                <input type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 " name="name">
            </div>
            <div class="flex  flex-row   gap-2">
                <button type="submit"
                    class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Save</button>
                <button onclick="closeModalSourceOfFund()" type="button"
                    class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
            </div>
        </form>
    </div>
</div>
<div id="edit-source_of_fund-modal"
    class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

        <form id="edit-source_of_fund-form" method="POST" class="mt-2">
            <h2 class="font-bold text-2xl text-gray-700">Update Source of Fund</h2>
            @csrf
            @method('PUT')
            <div>
                <input type="hidden" id="id_source_of_fund" name="id">
                <label for="name">Name</label>
                <input id="name_source_of_fund" type="text"
                    class="w-full p-1 border border-gray-400 rounded-sm my-2 " name="name">
            </div>
            <div class="flex flex-row   gap-2">
                <button type="submit"
                    class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Update
                </button>
                <button onclick="closeModalSourceOfFund()" type="button"
                    class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openAddModalSourceOfFund() {
        document.getElementById('add-source_of_fund-modal').classList.remove('hidden');
    }

    function openEditModalSourceOfFund(id, name) {
        document.getElementById('edit-source_of_fund-modal').classList.remove('hidden');
        const form = document.getElementById('edit-source_of_fund-form');
        document.getElementById('id_source_of_fund').value = id;
        document.getElementById('name_source_of_fund').value = name;
        form.action = `/emp-source-of-fund/${id}`;
    }

    function deleteItemSourceOfFund(id) {
        if (confirm("Are you sure you want to delete this Source Of Fund?")) {
            fetch(`/emp-source-of-fund/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message || "Failed to delete.");
                    }
                })
                .catch(error => {
                    alert(error.message);
                });
        }
    }


    function closeModalSourceOfFund() {
        document.getElementById('add-source_of_fund-modal').classList.add('hidden');
        document.getElementById('edit-source_of_fund-modal').classList.add('hidden');
    }
</script>

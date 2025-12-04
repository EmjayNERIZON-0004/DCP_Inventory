    @extends('layout.Admin-Side')
    <title>@yield('title', 'DCP Dashboard')</title>

    @section('content')
        <style>
            th {
                text-transform: uppercase;
                letter-spacing: 0.05rem
            }

            td {
                letter-spacing: 0.05rem
            }

            button {
                letter-spacing: 0.05rem;
                font-weight: 500 !important;
                border-radius: 5px !important;
            }
        </style>
        <div class="bg-white my-5 mx-5 px-5 py-5 rounded-sm shadow-md border border-gray-300  ">

            <div>

                <div class="text-2xl font-bold text-gray-700    ">Employee Position</div>
                <div class="text-lg font-normal text-gray-600     ">For Digital Identity</div>

                <button onclick="openAddModal()"
                    class="px-6 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                    Position</button>

            </div>
            <table class="bg-white  rounded-sm shadow-md border border-gray-300 w-full">
                <thead class="bg-gray-600 text-white border border-gray-500 ">
                    <th class="px-4 py-2 text-center">No. </th>
                    <th class="px-4 py-2 text-start">Employee Position</th>
                    <th class="px-4 py-2">Action</th>

                </thead>
                <tbody>

                    @foreach ($employee_position as $position)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 text-center">{{ $loop->iteration }}</td>

                            <td class="px-4 py-2  border border-gray-300">{{ $position->name }}</td>
                            <td class="px-4 py-2   border border-gray-300">
                                <div class="flex flex-col md:flex-row gap-3">
                                    <button
                                        onclick="openEditModal({{ $position->pk_school_position_id }}, '{{ $position->name }}')"
                                        class="bg-blue-500 flex items-center shadow-md hover:bg-blue-600 text-white py-1 px-4 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button onclick="deleteItem({{ $position->pk_school_position_id }})"
                                        class="bg-red-600 flex items-center shadow-md hover:bg-red-700 text-white py-1 px-4 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="add-employee-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

                <form action="{{ route('employee.store') }}" method="POST" class="mt-2">
                    <h2 class="font-bold text-2xl text-gray-700">Add New Employee Position</h2>
                    @csrf
                    @method('POST')
                    <div>
                        <label for="name">Employee Position</label>
                        <input type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 " name="name">
                    </div>
                    <div class="flex  flex-row   gap-2">
                        <button type="submit"
                            class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Add
                            New Position </button>
                        <button onclick="closeModal()" type="button"
                            class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="edit-employee-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

                <form action="{{ route('employee.update') }}" method="POST" class="mt-2">
                    <h2 class="font-bold text-2xl text-gray-700">Add New Employee Position</h2>
                    @csrf
                    @method('PUT')
                    <div>
                        <input type="hidden" id="id" name="id">
                        <label for="name">Employee Position</label>
                        <input id="name" type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 "
                            name="name">
                    </div>
                    <div class="flex flex-row   gap-2">
                        <button type="submit"
                            class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Update
                            Position </button>
                        <button onclick="closeModal()" type="button"
                            class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function openAddModal() {
                document.getElementById('add-employee-modal').classList.remove('hidden');
            }

            function openEditModal(id, name) {
                document.getElementById('edit-employee-modal').classList.remove('hidden');

                document.getElementById('id').value = id;
                document.getElementById('name').value = name;
            }

            function deleteItem(id) {
                if (confirm("Are you sure you want to delete this position?")) {
                    window.location.href = "/Admin/Employee/delete/" + id

                }
            }

            function closeModal() {
                document.getElementById('add-employee-modal').classList.add('hidden');
                document.getElementById('edit-employee-modal').classList.add('hidden');
            }
        </script>
    @endsection

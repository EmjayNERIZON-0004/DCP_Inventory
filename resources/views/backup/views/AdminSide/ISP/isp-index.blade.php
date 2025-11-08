@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class="my-5">
        <div class="text-2xl font-bold text-gray-700  mx-5 ">Internet Service Providers Details</div>
        <div class="text-lg font-normal text-gray-600 mb-4 mx-5  ">Create, View, Edit and Remove Details</div>
    </div>


    <div class="grid md:grid-cols-2 grid-cols-1 md:gap-4 gap-2 mx-5 mb-10">
        {{-- INTERNET SERVICE PROVIDERS --}}
        <div id="edit-isp-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white py-1 rounded-md px-4   mx-5">
                <form action="{{ route('isp.update.list') }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="isp_list_id" name="isp_list_id">
                    <h2 class="font-bold text-2xl  text-gray-700">Edit ISP Details</h2>
                    <div>
                        <label for="isp_name">Internet Service Provider</label>
                        <input class="w-full p-1 my-2 border border-gray-400 rounded-sm" type="text" name="isp_name"
                            id="isp_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">

                        <button type="submit"
                            class="px-6 py-1 w-full whitespace-nowrap bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Update
                            Internet Service Provider</button>
                        <button onclick="closeAddISPModal('ISP','edit')" type="button"
                            class="px-6 py-1 bg-gray-400  w-full text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="add-isp-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden ">
            <div class="modal-content bg-white py-1  rounded-md px-4   mx-5">

                <form action="{{ route('isp.submit.list') }}" method="POST" class="mt-2">
                    <h2 class="font-bold text-2xl text-gray-700">Add New Internet Service Provider</h2>
                    @csrf
                    @method('POST')
                    <div>
                        <label for="isp_name">Internet Service Provider</label>
                        <input class="w-full p-1 border border-gray-400 my-2 rounded-sm" type="text" name="isp_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">


                        <button type="submit"
                            class="px-6 py-1 bg-blue-600 w-full whitespace-nowrap text-white rounded-sm hover:bg-blue-700 transition">Add
                            New Internet Service Provider</button>
                        <button onclick="closeAddISPModal('ISP','add')" type="button"
                            class="px-4 py-1  w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
        <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

            <div class="flex flex-col h-full">
                <div>

                    <div class="text-2xl font-bold text-gray-700    ">Internet Service Providers List</div>
                    <div class="text-lg font-normal text-gray-600     ">Here are the list of name for ISP</div>

                    <button onclick="showAddISPModal('ISP')"
                        class="px-6 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                        Internet
                        Service Provider</button>

                </div>

                <div class="overflow-y-auto h-full    border border-gray-500">
                    <table class="table-auto w-full border-collapse">
                        <thead class="bg-gray-700 sticky top-0 z-1 ">
                            <tr>
                                <th class="py-2 px-2 text-white  border border-gray-800 ">
                                    No.
                                </th>
                                <th class="py-2 px-2 text-white  border border-gray-800 text-left ">
                                    Internet Service Providers
                                </th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($ISPList as $index => $list)
                                <tr>
                                    <td class="border border-gray-800 text-center">{{ $index + 1 }}</td>
                                    <td class="border   border-gray-800 px-5 ">
                                        <div class="py-1 flex flex-row gap-4">
                                            <div class="w-full py-1">
                                                {{ $list->name }}
                                            </div>

                                            <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                <button type="button"
                                                    onclick="showEditISPModal({{ $list->pk_isp_list_id }}, '{{ $list->name }}', 'ISP')"
                                                    class="px-6 py-1  ml-auto bg-blue-500 text-white text-sm rounded-sm hover:bg-blue-600 transition-all m-0">Edit</button>

                                                <button type="button"
                                                    onclick="deleteFunction({{ $list->pk_isp_list_id }},'ISP')"
                                                    class="px-6
                                          
                                        py-1 bg-red-600 hover:bg-red-700 text-sm text-white rounded-sm transition-all
                                        m-0">Delete</button>
                                            </div>
                                        </div>


                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        {{-- ISP CONNECTION TYPE --}}

        <div id="add-connection-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

                <form action="{{ route('isp.submit.connection_type') }}" method="POST" class="mt-2">
                    <h2 class="font-bold text-2xl  text-gray-700">Add New ISP type of connection</h2>
                    @csrf
                    @method('POST')
                    <div>
                        <label for="isp_connection_name">Internet Service Provider</label>
                        <input type="text" class="w-full p-1 border border-gray-400 my-2 rounded-sm "
                            name="isp_connection_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">
                        <button type="submit"
                            class="px-6 py-1 bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Add
                            New ISP Connection Type</button>
                        <button onclick="closeAddISPModal('ISPConnectionType','add')" type="button"
                            class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
        <div id="edit-connection-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white rounded-md py-1 px-4 ">
                <form action="{{ route('isp.update.connection_type') }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="isp_connection_type_id" name="isp_connection_type_id">
                    <h2 class="font-bold text-2xl  text-gray-700">Edit ISP Details</h2>
                    <div>
                        <label for="isp_name">Internet Service Provider</label>
                        <input class="w-full p-1 my-2 border border-gray-400 rounded-sm" type="text"
                            name="isp_connection_type_name" id="isp_connection_type_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">
                        <button type="submit"
                            class="px-6 py-1 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Update
                            ISP Connection Name</button>
                        <button onclick="closeAddISPModal('ISPConnectionType','edit')" type="button"
                            class="px-6 py-1 bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>

                    </div>

                </form>
            </div>
        </div>
        <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">
            <div class="flex flex-col h-full">
                <div>
                    <div class="text-2xl font-bold text-gray-700    ">Connection Type for the ISP</div>
                    <div class="text-lg font-normal text-gray-600     ">Here are the list of name for the types of
                        connection</div>

                    <button onclick="showAddISPModal('ISPConnectionType')"
                        class="px-6 py-1 my-1 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New ISP
                        Connection
                        Type</button>
                </div>

                <div class="overflow-y-auto h-full border border-gray-500">

                    <table class="table-auto border-collapse w-full">
                        <thead class="bg-gray-700 sticky top-0 z-1">
                            <tr>
                                <th class="py-2 px-0 text-white">
                                    No.
                                </th>
                                <th class="py-2 px-2 text-white text-left">
                                    ISP Connection Type
                                </th>

                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($ISPConnectionType as $index => $type)
                                <tr>
                                    <td class="border border-gray-500 text-center ">{{ $index + 1 }}</td>

                                    <td class="border border-gray-500  px-5">
                                        <div class="flex py-1 flex-row">

                                            <div class="w-full py-1">{{ $type->name }}</div>
                                            <div class="mt-1 flex flex-row gap-2 justify-end w-full">
                                                <button type="button"
                                                    onclick="showEditISPModal({{ $type->pk_isp_connection_type_id }}, '{{ $type->name }}', 'ISPConnectionType')"
                                                    class="px-6 py-1 text-sm bg-blue-500 text-white rounded-sm hover:bg-blue-600 transition-all m-0">Edit</button>


                                                <button type="button"
                                                    onclick="deleteFunction({{ $type->pk_isp_connection_type_id }}, 'ISPConnectionType')"
                                                    class="px-6 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-sm transition-all m-0">Delete</button>
                                            </div>


                                        </div>
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>









        {{-- ISP AREA LOCATION  --}}
        <div id="add-area-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

                <form action="{{ route('isp.submit.area') }}" method="POST" class="mt-2">
                    <h2 class="font-bold text-2xl text-gray-700">Add New ISP Area Location</h2>
                    @csrf
                    @method('POST')
                    <div>
                        <label for="isp_area_name">ISP Area Name</label>
                        <input type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 "
                            name="isp_area_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">
                        <button type="submit"
                            class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Add
                            New Area </button>
                        <button onclick="closeAddISPModal('Area','add')" type="button"
                            class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
        <div id="edit-area-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white rounded-md px-4 py-1">
                <form action="{{ route('isp.update.area') }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="isp_area_id" name="isp_area_id">
                    <h2 class="font-bold text-2xl  text-gray-700">Edit Area Details</h2>
                    <div>
                        <label for="isp_name">Area Covered for the ISP</label>
                        <input class="w-full p-1 my-2 border border-gray-400 rounded-sm" type="text"
                            name="isp_area_name" id="isp_area_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">
                        <button type="submit"
                            class="px-6 py-1 bg-blue-600 text-white w-full rounded-sm hover:bg-blue-700 transition">Update
                            ISP Area Name</button>
                        <button onclick="closeAddISPModal('Area','edit')" type="button"
                            class="px-6 py-1 bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>

                    </div>

                </form>
            </div>
        </div>
        <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">
            <div class="flex flex-col h-full">
                <div>
                    <div class="text-2xl font-bold text-gray-700    ">Area Distribution for the ISP</div>
                    <div class="text-lg font-normal text-gray-600     ">Here are the list of name for the types of
                        area</div>

                    <button onclick="showAddISPModal('Area')"
                        class="px-6 py-1 my-1 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New ISP
                        Area</button>
                </div>

                <div class="overflow-y-auto h-full border border-gray-500">
                    <table class="table-auto border border-gray-300 w-full border-collapse">
                        <thead class="bg-gray-700 sticky top-0 z-10">
                            <tr>
                                <th class="py-2 px-0 text-white border border-gray-500">No.</th>
                                <th class="py-2 px-2 text-white text-left border border-gray-500">Area of ISP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ISPArea as $index => $area)
                                <tr>
                                    <td class="border border-gray-500 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border border-gray-500 px-5">
                                        <div class="flex flex-row justify-between items-center">
                                            <div>{{ $area->name }}</div>
                                            <div class="flex flex-row gap-2">
                                                <button type="button"
                                                    onclick="showEditISPModal({{ $area->pk_isp_area_available_id }}, '{{ $area->name }}', 'Area')"
                                                    class="px-6 py-1 text-sm bg-blue-500 text-white rounded-sm hover:bg-blue-600 transition-all m-0">
                                                    Edit
                                                </button>
                                                <button type="button"
                                                    onclick="deleteFunction({{ $area->pk_isp_area_available_id }}, 'Area')"
                                                    class="px-6 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        {{-- ISP QUALITY TYPE  --}}
        <div id="add-quality-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md">

                <form action="{{ route('isp.submit.quality') }}" method="POST" class="mt-2">
                    <h2 class="font-bold text-2xl text-gray-700">Add New ISP Internet Quality</h2>
                    @csrf
                    @method('POST')
                    <div>
                        <label for="isp_quality">ISP Quality </label>
                        <input type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 "
                            name="isp_quality">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">
                        <button type="submit"
                            class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Save
                        </button>
                        <button onclick="closeAddISPModal('Quality','add')" type="button"
                            class="px-6 py-1 w-full bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
        <div id="edit-quality-modal"
            class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="modal-content bg-white rounded-md px-4 py-1">
                <form action="{{ route('isp.update.quality') }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="isp_quality_id" name="isp_quality_id">
                    <h2 class="font-bold text-2xl  text-gray-700">Edit Quality Details</h2>
                    <div>
                        <label for="quality_name">Quality Name</label>
                        <input class="w-full p-1 my-2 border border-gray-400 rounded-sm" type="text"
                            name="isp_quality_name" id="isp_quality_name">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2">
                        <button type="submit"
                            class="px-6 py-1 bg-blue-600 text-white w-full rounded-sm hover:bg-blue-700 transition">Update
                            ISP Quality Name</button>
                        <button onclick="closeAddISPModal('Quality','edit')" type="button"
                            class="px-6 py-1 bg-gray-400 text-white rounded-sm hover:bg-gray-500 transition">Cancel</button>

                    </div>

                </form>
            </div>
        </div>
        <div class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">
            <div>
                <div class="text-2xl font-bold text-gray-700    "> Internet Quality for the ISP</div>
                <div class="text-lg font-normal text-gray-600     ">Add, Edit and Remove </div>
                <button onclick="showAddISPModal('Quality')"
                    class="px-6 py-1 my-1 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add Quality
                    Name</button>

            </div>

            <table class="table-auto border border-gray-300 w-full border-collapse">
                <thead class="bg-gray-700 sticky top-0 z-10">
                    <tr>
                        <th class="py-2 px-0 text-white border border-gray-500">No.</th>
                        <th class="py-2 px-2 text-white text-left border border-gray-500">Internet Quality of ISP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ISPInternetQ as $index => $q)
                        <tr>
                            <td class="border border-gray-500 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-500 px-5">
                                <div class="flex flex-row justify-between items-center">
                                    <div>{{ $q->name }}</div>
                                    <div class="flex flex-row gap-2">
                                        <button type="button"
                                            onclick="showEditISPModal({{ $q->pk_isp_internet_quality_id }}, '{{ $q->name }}', 'Quality')"
                                            class="px-6 py-1 text-sm bg-blue-500 text-white rounded-sm hover:bg-blue-600 transition-all m-0">
                                            Edit
                                        </button>
                                        <button type="button"
                                            onclick="deleteFunction({{ $q->pk_isp_internet_quality_id }}, 'Quality')"
                                            class="px-6 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function deleteFunction(id, target_content) {
            if (target_content == 'ISPConnectionType') {
                if (confirm('Are you sure you want to delete this ISP?')) {
                    fetch('/Admin/ISP/delete-connection/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else if (target_content == 'ISP') {
                if (confirm('Are you sure you want to delete this ISP?')) {
                    fetch('/Admin/ISP/delete-list/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else if (target_content == 'Area') {
                if (confirm('Are you sure you want to delete this Area for ISP?')) {
                    fetch('/Admin/ISP/delete-area/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP Area deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else if (target_content == "Quality") {
                if (confirm('Are you sure you want to delete this Quality for ISP?')) {
                    fetch('/Admin/ISP/delete-quality/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP Quality deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            }

        }

        function closeAddISPModal(target_content, type) {
            if (target_content == 'ISPConnectionType') {
                if (type == 'edit') {
                    document.getElementById('edit-connection-modal').classList.add('hidden');
                }

                document.getElementById('add-connection-modal').classList.add('hidden');

            } else if (target_content == 'ISP') {
                if (type == 'edit') {
                    document.getElementById('edit-isp-modal').classList.add('hidden');
                }

                document.getElementById('add-isp-modal').classList.add('hidden');
            } else if (target_content == 'Area') {
                if (type == 'edit') {
                    document.getElementById('edit-area-modal').classList.add('hidden');
                }

                document.getElementById('add-area-modal').classList.add('hidden');
            } else if (target_content == "Quality") {
                if (type == 'edit') {
                    document.getElementById('edit-quality-modal').classList.add('hidden');
                }
                document.getElementById('add-quality-modal').classList.add('hidden');
            }
        }

        function showAddISPModal(target_content) {
            if (target_content == 'ISPConnectionType') {

                document.getElementById('add-connection-modal').classList.remove('hidden');

            } else if (target_content == 'ISP') {

                document.getElementById('add-isp-modal').classList.remove('hidden');
            } else if (target_content == 'Area') {

                document.getElementById('add-area-modal').classList.remove('hidden');
            } else if (target_content == "Quality") {

                document.getElementById('add-quality-modal').classList.remove('hidden');
            }
        }

        function showEditISPModal(id, name, target_content) {
            if (target_content == 'ISP') {

                document.getElementById('edit-isp-modal').classList.remove('hidden');
                document.getElementById('isp_list_id').value = id;
                document.getElementById('isp_name').value = name;
            } else if (target_content == 'ISPConnectionType') {

                document.getElementById('edit-connection-modal').classList.remove('hidden');
                document.getElementById('isp_connection_type_id').value = id;
                document.getElementById('isp_connection_type_name').value = name;
            } else if (target_content == 'Area') {

                document.getElementById('edit-area-modal').classList.remove('hidden');
                document.getElementById('isp_area_id').value = id;
                document.getElementById('isp_area_name').value = name;
            } else if (target_content == "Quality") {
                document.getElementById('edit-quality-modal').classList.remove('hidden');
                document.getElementById('isp_quality_id').value = id;
                document.getElementById('isp_quality_name').value = name;
            }
        }
    </script>
@endsection

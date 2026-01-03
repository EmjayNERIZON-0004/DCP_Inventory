 <div class="bg-white  px-5 py-5 rounded-sm shadow-md border border-gray-300  ">

     <div>

         <div class="text-2xl font-bold text-gray-700    ">Employee Title</div>
         <div class="text-lg font-normal text-gray-600     ">For Digital Identity</div>

         <button onclick="openAddModal()"
             class="px-6 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add
             Title</button>

     </div>
     <table class="bg-white  rounded-sm shadow-md border border-gray-300 w-full">
         <thead class="  text-white bg-gray-700  ">
             <th class="px-2 py-2 text-center">No. </th>
             <th class="px-2 py-2 text-start">Employee Title</th>
             <th class="px-2 py-2">Action</th>

         </thead>
         <tbody>

             @foreach ($employee_position as $position)
                 <tr>
                     <td class="px-2 py-2 border border-gray-300 text-center  w-10 bg-gray-100 ">{{ $loop->iteration }}
                     </td>

                     <td class="px-2 py-2  border border-gray-300">{{ $position->name }}</td>
                     <td class="px-2 py-2   border border-gray-300">
                         <div class="flex flex-col md:flex-row justify-center gap-2">
                             <button
                                 onclick="openEditModal({{ $position->pk_school_position_id }}, '{{ $position->name }}')"
                                 class="bg-blue-500 flex  justify-center items-center shadow-md hover:bg-blue-600 text-white py-1 px-2 rounded">

                                 Edit
                             </button>
                             <button onclick="deleteItem({{ $position->pk_school_position_id }})"
                                 class="bg-red-600 flex  justify-center  items-center shadow-md hover:bg-red-700 text-white py-1 px-2 rounded">

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
             <h2 class="font-bold text-2xl text-gray-700">Add Title</h2>
             @csrf
             @method('POST')
             <div>
                 <label for="name">Employee Title</label>
                 <input type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 " name="name">
             </div>
             <div class="flex  flex-row   gap-2">
                 <button type="submit"
                     class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Save
                 </button>
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
             <h2 class="font-bold text-2xl text-gray-700">Add Employee Title</h2>
             @csrf
             @method('PUT')
             <div>
                 <input type="hidden" id="id" name="id">
                 <label for="name">Name</label>
                 <input id="name" type="text" class="w-full p-1 border border-gray-400 rounded-sm my-2 "
                     name="name">
             </div>
             <div class="flex flex-row   gap-2">
                 <button type="submit"
                     class="px-6 py-1  bg-blue-600 whitespace-nowrap w-full text-white rounded-sm hover:bg-blue-700 transition">Update
                 </button>
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

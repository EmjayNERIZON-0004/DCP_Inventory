   <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-300 px-5 py-5">
       <div class="flex flex-col h-full">
           <div>

               <div class="text-2xl font-bold text-gray-700    ">CCTV Camera Type</div>
               <div class="text-md font-normal text-gray-600">
                   A list of available CCTV camera types.
               </div>
               <button onclick="openModal('camera_type')"
                   class="px-2 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Create New
               </button>

           </div>
           <div class="overflow-y-auto h-full scrollable-element">
               <table class="table-auto w-full border-collapse">
                   <thead class="bg-gray-700 sticky top-0 z-1 ">
                       <tr>
                           <th class="py-2 px-2 text-white  ">
                               No.
                           </th>
                           <th class="py-2 px-2 text-white  text-left ">
                               Camera Type
                           </th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($cameraType as $index => $type)
                           <tr>
                               <td class="border border-gray-300 text-center  bg-gray-100">{{ $index + 1 }}</td>
                               <td class="border border-gray-300 px-5 ">
                                   <div class="py-1 flex flex-row gap-4">
                                       <div class="w-full py-1">
                                           {{ $type->name }}
                                       </div>
                                       <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                           <button type="button"
                                               onclick="openEditModal({{ $type->pk_e_cctv_camera_type_id }},'{{ $type->name }}','camera_type')"
                                               class="px-2 py-1 flex items-center shadow-md  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                   fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                   stroke-width="2">
                                                   <path stroke-linecap="round" stroke-linejoin="round"
                                                       d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                               </svg>
                                               Edit</button>

                                           <button type="button"
                                               onclick="deleteFunction({{ $type->pk_e_cctv_camera_type_id }},'camera_type')"
                                               class="px-2 flex items-center py-1  shadow-md bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
                                                            m-0">
                                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                   fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                   stroke-width="2">
                                                   <path stroke-linecap="round" stroke-linejoin="round"
                                                       d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                               </svg>
                                               Delete</button>
                                       </div>
                               </td>
                           </tr>
                       @endforeach

                   </tbody>
               </table>
           </div>
       </div>
   </div>

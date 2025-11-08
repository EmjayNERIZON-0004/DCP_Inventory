 @extends('layout.Admin-Side')
 <title>@yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="my-5">
         <div class="text-2xl font-bold text-gray-700  mx-5 ">Biometric and CCTV Equipment Details</div>
         <div class="text-lg font-normal text-gray-600 mb-4 mx-5  ">Create, View, Edit and Remove Details</div>
     </div>
     <div class="grid md:grid-cols-2 grid-cols-1 md:gap-4 gap-2 mx-5 mb-10">

         {{-- CCTV CAMERA TYPE   --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">
             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">CCTV Camera Type</div>
                     <div class="text-md font-normal text-gray-600">
                         A list of available CCTV camera types.
                     </div>
                     <button onclick="openModal('camera_type')"
                         class="px-4 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
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
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $type->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $type->pk_e_cctv_camera_type_id }},'{{ $type->name }}','camera_type')"
                                                     class="px-4 py-1 flex items-center shadow-md  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>
                                                     Edit</button>

                                                 <button type="button"
                                                     onclick="deleteFunction({{ $type->pk_e_cctv_camera_type_id }},'camera_type')"
                                                     class="px-4 flex items-center py-1  shadow-md bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
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

         {{-- BIOMETRIC TYPE --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">Biometric Authentication Type</div>
                     <div class="text-md font-normal text-gray-600     ">Here are the available biometric authentication
                         methods</div>

                     <button onclick="openModal('biometric_type')"
                         class="px-4 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
                     <table class="table-auto w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-1 ">
                             <tr>
                                 <th class="py-2 px-2 text-white    ">
                                     No.
                                 </th>
                                 <th class="py-2 px-2 text-white    text-left ">
                                     Camera Type
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($biometric as $index => $type)
                                 <tr>
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border   border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $type->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $type->pk_e_biometric_type_id }}, '{{ $type->name }}', 'biometric_type')"
                                                     class="px-4 py-1 flex items-center shadow-md  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>
                                                     Edit</button>
                                                 <button type="button"
                                                     onclick="deleteFunction({{ $type->pk_e_biometric_type_id }},'biometric_type')"
                                                     class="px-4 flex items-center  shadow-md  py-1 bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
                                                            m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                     </svg>
                                                     Delete</button>
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
         {{-- POWERSOURCE  --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">Equipment Power Source</div>
                     <div class="text-md font-normal text-gray-600     "> Specify the type of power supply used for the
                         equipment</div>

                     <button onclick="openModal('powersource')"
                         class="px-4 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
                     <table class="table-auto w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-1 ">
                             <tr>
                                 <th class="py-2 px-2 text-white   ">
                                     No.
                                 </th>
                                 <th class="py-2 px-2 text-white   text-left ">
                                     Power Source
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($powersource as $index => $type)
                                 <tr>
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border   border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $type->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $type->pk_equipment_power_source_id }}, '{{ $type->name }}', 'powersource')"
                                                     class="px-4 shadow-md flex items-center py-1  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>
                                                     Edit</button>
                                                 <button type="button"
                                                     onclick="deleteFunction({{ $type->pk_equipment_power_source_id }},'powersource')"
                                                     class="px-4 flex items-center shadow-md  py-1 bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
                                                            m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                     </svg>
                                                     Delete</button>
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
         {{-- INSTALLER --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">Equipment Installer/Contactor</div>
                     <div class="text-md font-normal text-gray-600     "> Record the name of the installer or contractor.
                     </div>

                     <button onclick="openModal('installer')"
                         class="px-4 py-1  my-1 bg-blue-600 text-white rounded-sm   hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
                     <table class="table-auto w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-1 ">
                             <tr>
                                 <th class="py-2 px-2 text-white    ">
                                     No.
                                 </th>
                                 <th class="py-2 px-2 text-white    text-left ">
                                     Installer / Contractor
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($installer as $index => $installer)
                                 <tr>
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border   border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $installer->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $installer->pk_equipment_installer_id }},'{{ $installer->name }}','installer')"
                                                     class="px-4 py-1 flex items-center shadow-md ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>Edit</button>

                                                 <button type="button"
                                                     onclick="deleteFunction({{ $installer->pk_equipment_installer_id }},'installer')"
                                                     class="px-4 flex items-center py-1 shadow-md  bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
                                                            m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                     </svg>
                                                     Delete</button>
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
         {{-- BRAND MODEL --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">Equipment Brand / Model</div>
                     <div class="text-md font-normal text-gray-600     ">Identify the brand and model number of the
                         installed equipment.</div>

                     <button onclick="openModal('brand')"
                         class="px-4 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
                     <table class="table-auto w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-1 ">
                             <tr>
                                 <th class="py-2 px-2 text-white    ">
                                     No.
                                 </th>
                                 <th class="py-2 px-2 text-white   text-left ">
                                     Equipment Brand / Model
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($brand as $index => $model)
                                 <tr>
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border   border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $model->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $model->pk_equipment_brand_model_id }}, '{{ $model->name }}', 'brand')"
                                                     class="px-4 py-1 shadow-md flex items-center  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>
                                                     Edit</button>

                                                 <button type="button"
                                                     onclick="deleteFunction({{ $model->pk_equipment_brand_model_id }},'brand')"
                                                     class="px-4 flex items-center shadow-md   py-1 bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
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
         {{-- LOCATION  --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">Equipment Location </div>
                     <div class="text-md font-normal text-gray-600     ">Indicate the exact location or area where the
                         equipment is installed.</div>

                     <button onclick="openModal('location')"
                         class="px-4 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
                     <table class="table-auto w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-1 ">
                             <tr>
                                 <th class="py-2 px-2 text-white   ">
                                     No.
                                 </th>
                                 <th class="py-2 px-2 text-white   text-left ">
                                     Equipment Location Deployed
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($location as $index => $loc)
                                 <tr>
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border   border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $loc->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $loc->pk_equipment_location_id }}, '{{ $loc->name }}', 'location')"
                                                     class="px-4 py-1 flex  items-center shadow-md  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">

                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>
                                                     Edit</button>
                                                 <button type="button"
                                                     onclick="deleteFunction({{ $loc->pk_equipment_location_id }},'location')"
                                                     class="px-4 flex items-center shadow-md  py-1 bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
                                                            m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                     </svg>
                                                     Delete</button>
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
         {{-- INCHARGE  --}}
         <div style="max-height: 400px" class=" bg-white shadow-xl h-full rounded-lg   border border-gray-600 px-5 py-5">

             <div class="flex flex-col h-full">
                 <div>

                     <div class="text-2xl font-bold text-gray-700    ">Person In-Charge to the Equipment</div>
                     <div class="text-md font-normal text-gray-600     "> Provide the name of the person responsible for
                         monitoring and maintaining the equipment.</div>

                     <button onclick="openModal('incharge')"
                         class="px-4 py-1 my-1  bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition">Add New
                     </button>

                 </div>
                 <div class="overflow-y-auto h-full    border border-gray-500">
                     <table class="table-auto w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-1 ">
                             <tr>
                                 <th class="py-2 px-2 text-white   ">
                                     No.
                                 </th>
                                 <th class="py-2 px-2 text-white   text-left ">
                                     Person In-Charge
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($incharge as $index => $person)
                                 <tr>
                                     <td class="border border-gray-300 text-center">{{ $index + 1 }}</td>
                                     <td class="border   border-gray-300 px-5 ">
                                         <div class="py-1 flex flex-row gap-4">
                                             <div class="w-full py-1">
                                                 {{ $person->name }}
                                             </div>
                                             <div class="mt-1   flex flex-row gap-2  " style="height: fit-content">
                                                 <button type="button"
                                                     onclick="openEditModal({{ $person->pk_equipment_incharge_id }}, '{{ $person->name }}' , 'incharge')"
                                                     class="px-4 shadow-md flex items-center py-1  ml-auto bg-blue-500 text-white text-md rounded-sm hover:bg-blue-600 transition-all m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                                     </svg>
                                                     Edit</button>
                                                 <button type="button"
                                                     onclick="deleteFunction({{ $person->pk_equipment_incharge_id }},'incharge')"
                                                     class="px-4 flex items-center shadow-md  py-1 bg-red-600 hover:bg-red-700 text-md text-white rounded-sm transition-all
                                                            m-0">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                         stroke-width="2">
                                                         <path stroke-linecap="round" stroke-linejoin="round"
                                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                     </svg>
                                                     Delete</button>
                                             </div>

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
     </div>

     <form id="delete-form" method="POST" style="display:none;">
         @csrf
         @method('DELETE')
     </form>
     <div id="overall-modal"
         class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
         <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md md:w-1/4 w-full">
             <form id="modal-form" class="  mt-2" method="POST">
                 @csrf
                 @method('POST')
                 <div class="text-2xl font-bold text-gray-700 w-full   " id="modal-title"></div>
                 <div class="text-lg font-normal text-gray-600 w-full  " id="modal-subtitle"></div>
                 <input type="hidden" name="target" id="target">
                 <div>

                     <input class="w-full border border-gray-400 rounded py-1 px-3 my-1" type="text" name="name"
                         id="name">
                 </div>
                 <div class="flex flex-row w-full gap-2">

                     <button type="submit" class=" w-full bg-blue-600 text-white px-4 py-1 rounded-sm">Save</button>
                     <button type="button" onclick="closeModal()"
                         class="w-full bg-gray-400 text-white px-4 py-1 rounded-sm">Cancel</button>
                 </div>

             </form>
         </div>
     </div>

     <div id="edit-overall-modal"
         class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
         <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md md:w-1/4 w-full">
             <form id="edit-modal-form" class="  mt-2" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="text-2xl font-bold text-gray-700 w-full   " id="edit-modal-title"></div>
                 <div class="text-lg font-normal text-gray-600 w-full  " id="edit-modal-subtitle"></div>
                 <input type="hidden" name="target" id="edit_target">
                 <div>
                     <input type="hidden" name="id" id="edit_id">
                     <input class="w-full border border-gray-400 rounded py-1 px-3 my-1" type="text" name="name"
                         id="edit_name">
                 </div>
                 <div class="flex flex-row w-full gap-2">

                     <button type="submit"
                         class=" w-full bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded-sm">Update</button>
                     <button type="button" onclick="closeEditModal()"
                         class="w-full bg-gray-400 text-white px-4 py-1 rounded-sm">Cancel</button>
                 </div>

             </form>
         </div>
     </div>
     <script>
         function deleteFunction(id, type) {
             if (confirm("Are you sure you want to delete this " + type + "?")) {
                 let actionUrl = "{{ route('equipment.delete', [':id', ':type']) }}";
                 actionUrl = actionUrl.replace(':id', id).replace(':type', type);

                 document.getElementById('delete-form').action = actionUrl;
                 document.getElementById('delete-form').submit();
             }
         }

         function openModal(type) {
             document.getElementById('modal-form').action = "{{ route('equipment.store') }}";
             if (type == "camera_type") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = " CCTV Camera type";
                 document.getElementById('target').value = type;
             } else if (type == "biometric_type") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Biometric Authentication type";
                 document.getElementById('target').value = type;
             } else if (type == "powersource") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Power Source  ";
                 document.getElementById('target').value = type;
             } else if (type == "incharge") {
                 document.getElementById('overall-modal').classList.remove('hidden')

                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Person Incharge to the Equipment ";
                 document.getElementById('target').value = type;
             } else if (type == "location") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Location";
                 document.getElementById('target').value = type;
             } else if (type == "brand") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Brand/Model";
                 document.getElementById('target').value = type;
             } else if (type == "installer") {
                 document.getElementById('overall-modal').classList.remove('hidden')
                 document.getElementById('modal-title').textContent = "Create and Save ";
                 document.getElementById('modal-subtitle').textContent = "Equipment Installer/Contractor";
                 document.getElementById('target').value = type;
             }
         }

         function openEditModal(id, name, type) {
             console.log(id + " " + name + " " + type);
             document.getElementById('edit-modal-form').action = "{{ route('equipment.update') }}";
             document.getElementById('edit-overall-modal').classList.remove('hidden');
             if (type === "powersource") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Power Source";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "camera_type") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = " CCTV Camera type";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "biometric_type") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Biometric Authentication type";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "incharge") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Person Incharge to the Equipment ";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "location") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Location";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "brand") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Brand/Model";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             } else if (type === "installer") {
                 document.getElementById('edit-overall-modal').classList.remove('hidden')
                 document.getElementById('edit-modal-title').textContent = "Edit and Save ";
                 document.getElementById('edit-modal-subtitle').textContent = "Equipment Installer/Contractor";
                 document.getElementById('edit_target').value = type;
                 document.getElementById('edit_id').value = id;
                 document.getElementById('edit_name').value = name;
             }
         }

         function closeModal() {
             document.getElementById('overall-modal').classList.add('hidden')
         }

         function closeEditModal() {
             document.getElementById('edit-overall-modal').classList.add('hidden')
         }
     </script>
 @endsection

 @extends('layout.Admin-Side')
 <title>@yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="text-2xl font-semibold text-gray-800 mb-4 mx-5 my-5">Other Details</div>
     <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mx-5 my-5">
         {{-- DELIVERY MODE  FOR THE DCP ITEMS/BATCH - CRUD --}}

         <div class="w-full  border border-gray-400  h-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
             <form id="update_delivery_form" method="POST" action="{{ route('store.delivery_mode') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="delivery_id" id="delivery_id">
                 <label for="delivery_mode"
                     class="block text-gray-700 bg-blue-200 border border-gray-800 py-1 px-2 text-center text-xl font-semibold mb-2 text-left w-full">Delivery
                     Mode</label>

                 <div class="mb-3 flex flex-col md:flex-row gap-2  ">
                     <input type="text " placeholder="e.g., Pick Up, Delivery" name="delivery_mode"
                         style="border: 1px solid #282828" id="delivery_mode" class="w-full border rounded px-2 py-1">


                     <button
                         class="px-4 py-2 w-full md:w-1/2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         id="delivery_addBtn" style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Add
                     </button>


                     <button id="delivery_updateBtn"
                         class="px-4 py-2 w-full md:w-1/2 bg-green-600 text-white rounded-md hover:bg-green-700 transition hidden"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Update
                     </button>



                 </div>
             </form>

             <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                 <table class="table-auto   w-full" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2 text-white">No.</th>

                             <th class="text-white px-4 py-2 whitespace-nowrap  ">Delivery Mode</th>
                             <th class="text-white px-4 py-2  whitespace-nowrap   ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $modes = \App\Models\DCPItemModeDelivery::all();
                         @endphp

                         @foreach ($modes as $index => $mode)
                             <tr>
                                 <td class="border text-center  ">{{ $index + 1 }}</td>

                                 <td class="px-4 py-1 border border-gray-300">{{ $mode->name }}</td>
                                 <td class="  border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                         <!-- Edit Button -->
                                         <button
                                             onclick="editItemDelivery('{{ $mode->pk_dcp_item_mode_delivery_id }}', '{{ $mode->name }}')"
                                             class="px-4 py-1 shadow-md  bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition-all m-0">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>

                                         <!-- Delete Form/Button -->
                                         <form
                                             action="{{ route('delete.delivery_mode', $mode->pk_dcp_item_mode_delivery_id) }}"
                                             method="POST" class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 onclick="return confirm('Are you sure you want to delete this delivery mode?')"
                                                 class="px-4 py-1  shadow-md bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>

                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
         <script>
             function editItemDelivery(id, name) {
                 document.getElementById('delivery_id').value = id;

                 document.getElementById('delivery_mode').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_delivery_form');
                 form.action = `/delivery-type/edit/${id}`;

                 // Toggle buttons
                 document.getElementById('delivery_addBtn').classList.add('hidden');
                 document.getElementById('delivery_updateBtn').classList.remove('hidden');
             }
         </script>

         {{-- CONDITION OF THE DCP ITEMS UPON DELIVERY - CRUD --}}
         <div class="w-full  border border-gray-400  h-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
             <form id="update_delivery_condition_form" method="POST" action="{{ route('store.delivery_condition') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="delivery_condition_id" id="delivery_condition_id">
                 <label for="delivery_condition"
                     class="block text-gray-700 bg-purple-200 border border-gray-800 py-1 px-2 text-center text-xl font-semibold mb-2 text-left w-full">

                     Item Condition Upon Delivery</label>

                 <div class="mb-3 flex flex-col md:flex-row gap-2  ">
                     <input type="text " name="delivery_condition" placeholder="e.g., Functional, Needs Repair"
                         style="border: 1px solid #282828" id="delivery_condition" class="w-full border rounded px-2 py-1">


                     <button
                         class="px-4 py-2 w-full md:w-1/2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         id="delivery_condition_addBtn" style="font-family: Verdana, Geneva, Tahoma, sans-serif"
                         type="submit">Add
                     </button>


                     <button id="delivery_condition_updateBtn"
                         class="px-4 py-2 w-full md:w-1/2 bg-green-600 text-white rounded-md hover:bg-green-700 transition hidden"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Update
                     </button>



                 </div>
             </form>

             <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                 <table class="table-auto   w-full" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2 text-white ">No.</th>

                             <th class="text-white px-4 py-2 whitespace-nowrap  ">Item Condition</th>
                             <th class="text-white px-4 py-2  whitespace-nowrap   ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $delivery_condition = \App\Models\DCPDeliveryCondintion::all();
                         @endphp

                         @foreach ($delivery_condition as $index => $d_condition)
                             <tr>
                                 <td class="border text-center  ">{{ $index + 1 }}</td>

                                 <td class="px-4 py-1 border border-gray-300">{{ $d_condition->name }}</td>
                                 <td class="  border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                         <!-- Edit Button -->
                                         <button
                                             onclick="editItemDeliveryCondition('{{ $d_condition->pk_dcp_delivery_conditions_id }}', '{{ $d_condition->name }}')"
                                             class="px-4 py-1  shadow-md bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition-all m-0">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>

                                         <!-- Delete Form/Button -->
                                         <form
                                             action="{{ route('delete.delivery_condition', $d_condition->pk_dcp_delivery_conditions_id) }}"
                                             method="POST" class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 onclick="return confirm('Are you sure you want to delete this condition of item upon delivery?')"
                                                 class="px-4 py-1 shadow-md  bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>

                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
         <script>
             function editItemDeliveryCondition(id, name) {
                 document.getElementById('delivery_condition_id').value = id;

                 document.getElementById('delivery_condition').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_delivery_condition_form');
                 form.action = `/delivery-condition/edit/${id}`;

                 // Toggle buttons
                 document.getElementById('delivery_condition_addBtn').classList.add('hidden');
                 document.getElementById('delivery_condition_updateBtn').classList.remove('hidden');
             }
         </script>

         {{-- SUPPLIER NAME FOR THE DCP ITEMS - CRUD --}}
         <div class="w-full h-full bg-white  border border-gray-400 shadow-xl rounded-lg overflow-hidden p-6">
             <label for="supplier_name"
                 class="block text-gray-700  bg-green-200 border border-gray-800 py-1 px-2 text-xl font-semibold mb-2 text-center w-full">Supplier
                 Name</label>


             <form id="update_supplier_form" method="POST" action="{{ route('store.supplier') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="brand_id" id="supplier_id">

                 <div class="flex flex-col md:flex-row gap-2">
                     <input type="text" name="brand_name" placeholder="e.g., Samsung, Apple, LG, Sony, etc."
                         id="supplier_name" style="border: 1px solid #282828"
                         class="w-full md:w-full border rounded px-2 py-1">

                     <!-- Add Button -->
                     <button id="supplier_addBtn" type="submit"
                         class="px-4 w-full md:w-1/2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                         Add
                     </button>

                     <!-- Update Button -->
                     <button id="supplier_updateBtn" type="submit"
                         class="hidden px-4 w-full md:w-1/2 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                         Update
                     </button>
                 </div>
             </form>




             <div class="overflow-y-auto " style=" height:300px">
                 <table class="table-auto w-full  " style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2  text-white">No.</th>
                             <th class="text-white px-4 py-2 ">Supplier Name</th>
                             <th class="text-white px-4 py-2 ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $brands = \App\Models\DCPItemBrand::all();
                         @endphp

                         @foreach ($brands as $index => $brand)
                             <tr>
                                 <td class="border text-center  ">{{ $index + 1 }}</td>


                                 <td class="px-4 py-1 border border-gray-300">{{ $brand->name }}</td>
                                 <td class="border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                                         <!-- Edit Button -->
                                         <button
                                             onclick="editSupplier('{{ $brand->pk_dcp_item_brand_id }}', '{{ $brand->name }}')"
                                             class="px-4 py-1 h-[36px]  shadow-md  bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>

                                         <!-- Delete Button -->
                                         <form method="POST"
                                             action="{{ route('delete.supplier', $brand->pk_dcp_item_brand_id) }}"
                                             onsubmit="return confirm('Are you sure you want to delete this brand?')"
                                             class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 class="px-4 py-1 h-[36px]  shadow-md  bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>
                                 </td>

                             </tr>
                         @endforeach

                     </tbody>
                 </table>
             </div>
         </div>

         {{-- BRAND NAME FOR THE DCP ITEMS - CRUD --}}
         <div class="w-full h-full bg-white border border-gray-400 shadow-xl rounded-lg overflow-hidden p-6">
             <label for="brand_name"
                 class="block text-gray-700 bg-yellow-200 border border-gray-800 py-1 px-2  text-xl font-semibold mb-2 text-center w-full">Brand
                 Name</label>


             <form id="update_brand_form" method="POST" action="{{ route('store.brand') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="brand_id" id="brand_id">

                 <div class="flex flex-col md:flex-row gap-2">
                     <input type="text" name="brand_name" placeholder="e.g., Samsung, Apple, LG, Sony, etc."
                         id="brand_name" style="border: 1px solid #282828"
                         class="w-full md:w-full border rounded px-2 py-1">

                     <!-- Add Button -->
                     <button id="brand_addBtn" type="submit"
                         class="px-4 w-full md:w-1/2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                         Add
                     </button>

                     <!-- Update Button -->
                     <button id="brand_updateBtn" type="submit"
                         class="hidden px-4 w-full md:w-1/2 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                         Update
                     </button>
                 </div>
             </form>



             <div class="overflow-y-auto " style=" height:300px">
                 <table class="table-auto w-full " style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2 text-white ">No.</th>

                             <th class="text-white px-4 py-2  ">Brand</th>
                             <th class="text-white px-4 py-2  ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $brands = \App\Models\DCPBatchItemBrand::all();
                         @endphp

                         @foreach ($brands as $index => $brand)
                             <tr>
                                 <td class="border text-center  ">{{ $index + 1 }}</td>

                                 <td class="px-4 py-1 border border-gray-300">{{ $brand->brand_name }}</td>
                                 <td class="border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                                         <!-- Edit Button -->
                                         <button
                                             onclick="editBrand('{{ $brand->pk_dcp_batch_item_brands_id }}', '{{ $brand->brand_name }}')"
                                             class="px-4 py-1 h-[36px] bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>

                                         <!-- Delete Button -->
                                         <form method="POST"
                                             action="{{ route('delete.brand', $brand->pk_dcp_batch_item_brands_id) }}"
                                             onsubmit="return confirm('Are you sure you want to delete this brand?')"
                                             class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 class="px-4 py-1 h-[36px] bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>
                                 </td>

                             </tr>
                         @endforeach

                     </tbody>
                 </table>
             </div>
         </div>

         <script>
             function editBrand(id, name) {
                 document.getElementById('brand_id').value = id;
                 document.getElementById('brand_name').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_brand_form');
                 form.action = `/brand/edit/${id}`; // adjust route if needed

                 // Toggle buttons
                 document.getElementById('brand_addBtn').classList.add('hidden');
                 document.getElementById('brand_updateBtn').classList.remove('hidden');
             }

             function editSupplier(id, name) {
                 document.getElementById('supplier_id').value = id;
                 document.getElementById('supplier_name').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_supplier_form');
                 form.action = `/supplier/edit/${id}`; // adjust route if needed

                 // Toggle buttons
                 document.getElementById('supplier_addBtn').classList.add('hidden');
                 document.getElementById('supplier_updateBtn').classList.remove('hidden');
             }
         </script>






         {{-- CURRENT CONDITION OF THE DCP ITEMS - CRUD --}}

         <div class="w-full  border border-gray-400  h-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
             <form id="update_current_condition_form" method="POST" action="{{ route('store.current_condition') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="current_condition_id" id="current_condition_id">
                 <label for="current_condition"
                     class="block text-gray-700 bg-blue-200 border border-gray-800 py-1 px-2 text-center text-xl font-semibold mb-2 text-left w-full">

                     Item Current Condition </label>

                 <div class="mb-3 flex flex-col md:flex-row gap-2  ">
                     <input type="text " placeholder="e.g., Functional, Needs Repair" name="current_condition"
                         style="border: 1px solid #282828" id="current_condition"
                         class="w-full border rounded px-2 py-1">


                     <button
                         class="px-4 py-2 w-full md:w-1/2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         id="current_condition_addBtn" style="font-family: Verdana, Geneva, Tahoma, sans-serif"
                         type="submit">Add
                     </button>


                     <button id="current_condition_updateBtn"
                         class="px-4 py-2 w-full md:w-1/2 bg-green-600 text-white rounded-md hover:bg-green-700 transition hidden"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Update
                     </button>



                 </div>
             </form>

             <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                 <table class="table-auto   w-full" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2 text-white 
                             ">No.</th>

                             <th class="text-white px-4 py-2 whitespace-nowrap  ">Item Current Condition</th>
                             <th class="text-white px-4 py-2  whitespace-nowrap   ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $current_condition = \App\Models\DCPCurrentCondition::all();
                         @endphp

                         @foreach ($current_condition as $index => $c_condition)
                             <tr>
                                 <td class="border text-center  ">{{ $c_condition->pk_dcp_current_conditions_id }}</td>

                                 <td class="px-4 py-1 border border-gray-300">{{ $c_condition->name }}</td>
                                 <td class="  border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                         <!-- Edit Button -->
                                         <button
                                             onclick="editItemCondition('{{ $c_condition->pk_dcp_current_conditions_id }}', '{{ $c_condition->name }}')"
                                             class="px-4 py-1 shadow-md bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition-all m-0">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>

                                         <!-- Delete Form/Button -->
                                         <form
                                             action="{{ route('delete.current_condition', $c_condition->pk_dcp_current_conditions_id) }}"
                                             method="POST" class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 onclick="return confirm('Are you sure you want to delete this current mode?')"
                                                 class="px-4 py-1  shadow-md  bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>

                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
         <script>
             function editItemCondition(id, name) {
                 document.getElementById('current_condition_id').value = id;

                 document.getElementById('current_condition').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_current_condition_form');
                 form.action = `/current-condition/edit/${id}`;

                 // Toggle buttons
                 document.getElementById('current_condition_addBtn').classList.add('hidden');
                 document.getElementById('current_condition_updateBtn').classList.remove('hidden');
             }
         </script>


         {{-- ASSIGNED USER FOR THE DCP ITEMS - CRUD --}}

         <div class="w-full  border border-gray-400  h-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
             <form id="update_assigned_user_type_form" method="POST" action="{{ route('store.assigned_user_type') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="assigned_user_type_id" id="assigned_user_type_id">
                 <label for="assigned_user_type"
                     class="block text-gray-700 bg-gray-200 border border-gray-800 py-1 px-2 text-center text-xl font-semibold mb-2 text-left w-full">

                     Assigned User Types for DCP Items</label>

                 <div class="mb-3 flex flex-col md:flex-row gap-2  ">
                     <input type="text " placeholder="e.g., Student, Learners" name="assigned_user_type"
                         style="border: 1px solid #282828" id="assigned_user_type"
                         class="w-full border rounded px-2 py-1">


                     <button
                         class="px-4 py-2 w-full md:w-1/2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         id="assigned_user_type_addBtn" style="font-family: Verdana, Geneva, Tahoma, sans-serif"
                         type="submit">Add
                     </button>


                     <button id="assigned_user_type_updateBtn"
                         class="px-4 py-2 w-full md:w-1/2 bg-green-600 text-white rounded-md hover:bg-green-700 transition hidden"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Update
                     </button>



                 </div>
             </form>

             <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                 <table class="table-auto   w-full" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2 text-white  ">No.</th>

                             <th class="text-white px-4 py-2 whitespace-nowrap  ">Assigned Type of User</th>
                             <th class="text-white px-4 py-2  whitespace-nowrap   ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $assigned_user_type = \App\Models\DCPItemAssignedType::all();
                         @endphp

                         @foreach ($assigned_user_type as $index => $assigned_user)
                             <tr>
                                 <td class="border text-center  ">{{ $index + 1 }}</td>

                                 <td class="px-4 py-1 border border-gray-300">{{ $assigned_user->name }}</td>
                                 <td class="  border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                         <!-- Edit Button -->
                                         <button
                                             onclick="editAssignedUserType('{{ $assigned_user->pk_dcp_assignment_types_id }}', '{{ $assigned_user->name }}')"
                                             class="px-4 py-1  shadow-md  bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition-all m-0">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>

                                         <!-- Delete Form/Button -->
                                         <form
                                             action="{{ route('delete.assigned_user_type', $assigned_user->pk_dcp_assignment_types_id) }}"
                                             method="POST" class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 onclick="return confirm('Are you sure you want to delete this Assigned Type?')"
                                                 class="px-4  shadow-md  py-1 bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>

                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
         <script>
             function editAssignedUserType(id, name) {
                 document.getElementById('assigned_user_type_id').value = id;

                 document.getElementById('assigned_user_type').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_assigned_user_type_form');
                 form.action = `/assigned_user_type/edit/${id}`;

                 // Toggle buttons
                 document.getElementById('assigned_user_type_addBtn').classList.add('hidden');
                 document.getElementById('assigned_user_type_updateBtn').classList.remove('hidden');
             }
         </script>

         {{-- ASSIGNED LOCATION FOR THE DCP ITEMS - CRUD --}}
         <div class="w-full  border border-gray-400  h-full bg-white shadow-xl rounded-lg overflow-hidden p-6">
             <form id="update_assigned_location_form" method="POST" action="{{ route('store.assigned_location') }}">
                 @csrf
                 @method('POST')
                 <input type="hidden" name="assigned_location_id" id="assigned_location_id">
                 <label for="assigned_location"
                     class="block text-gray-700 bg-gray-200 border border-gray-800 py-1 px-2 text-center text-xl font-semibold mb-2 text-left w-full">

                     Assigned Location for DCP Items</label>

                 <div class="mb-3 flex flex-col md:flex-row gap-2  ">
                     <input type="text " placeholder="e.g., Office, Classrooms" name="assigned_location"
                         style="border: 1px solid #282828" id="assigned_location"
                         class="w-full border rounded px-2 py-1">


                     <button
                         class="px-4 py-2 w-full md:w-1/2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                         id="assigned_location_addBtn" style="font-family: Verdana, Geneva, Tahoma, sans-serif"
                         type="submit">Add
                     </button>


                     <button id="assigned_location_updateBtn"
                         class="px-4 py-2 w-full md:w-1/2 bg-green-600 text-white rounded-md hover:bg-green-700 transition hidden"
                         style="font-family: Verdana, Geneva, Tahoma, sans-serif" type="submit">Update
                     </button>



                 </div>
             </form>

             <div class="overflow-y-auto" style="max-height: 380px;border:1px solid #ccc;">
                 <table class="table-auto   w-full" style="font-family: Verdana, Geneva, Tahoma, sans-serif">
                     <thead class="bg-gray-700 sticky top-0">
                         <tr>
                             <th class="px-4 py-2 text-white ">No.</th>

                             <th class="text-white px-4 py-2 whitespace-nowrap  ">Assigned Type of User</th>
                             <th class="text-white px-4 py-2  whitespace-nowrap   ">Action </th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $assigned_location = \App\Models\DCPItemLocation::all();
                         @endphp

                         @foreach ($assigned_location as $index => $assigned_loc)
                             <tr>
                                 <td class="border text-center  ">{{ $index + 1 }}</td>

                                 <td class="px-4 py-1 border border-gray-300">{{ $assigned_loc->name }}</td>
                                 <td class="  border border-gray-300 px-4 py-1">
                                     <div class="flex flex-col md:flex-row gap-2 justify-center items-center p-0 m-0">
                                         <!-- Edit Button -->

                                         <button
                                             onclick='editAssignedLocation({{ $assigned_loc->pk_dcp_assigned_locations_id }}, @json($assigned_loc->name))'
                                             class="px-4 py-1  shadow-md  bg-blue-500 flex items-center text-white rounded-sm hover:bg-blue-500 transition-all m-0">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M16.5 3.5a2.121 2.121 0 113 3L12 14l-4 1 1-4 7.5-7.5z" />
                                             </svg>
                                             Edit
                                         </button>


                                         <!-- Delete Form/Button -->
                                         <form
                                             action="{{ route('delete.assigned_location', $assigned_loc->pk_dcp_assigned_locations_id) }}"
                                             method="POST" class="m-0 p-0">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 onclick="return confirm('Are you sure you want to delete this Assigned Type?')"
                                                 class="px-4 py-1  shadow-md  bg-red-600 flex items-center hover:bg-red-700 text-white rounded-sm transition-all m-0">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                     <path stroke-linecap="round" stroke-linejoin="round"
                                                         d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                 </svg>
                                                 Delete
                                             </button>
                                         </form>
                                     </div>

                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
         <script>
             function editAssignedLocation(id, name) {
                 document.getElementById('assigned_location_id').value = id;
                 console.log(id);
                 document.getElementById('assigned_location').value = name;

                 // Change form action to update route
                 const form = document.getElementById('update_assigned_location_form');
                 form.action = `/assigned_location/edit/${id}`;

                 // Toggle buttons
                 document.getElementById('assigned_location_addBtn').classList.add('hidden');
                 document.getElementById('assigned_location_updateBtn').classList.remove('hidden');
             }
         </script>
     </div>
 @endsection

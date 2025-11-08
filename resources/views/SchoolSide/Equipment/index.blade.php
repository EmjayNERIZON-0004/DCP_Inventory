 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="my-10 mx-5">
         <div id="add-cctv-modal"
             class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
             <div class="modal-content p-4 bg-white rounded-md">
                 <form action="{{ route('schools.equipment.store') }}" method="POST">
                     @csrf
                     @method('POST')
                     <h2 class="font-bold text-2xl text-gray-800">CCTV Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                     <div>
                         <label for="e_type"></label>
                         <select class="hidden " name="selected_equipment" id="selected_equipment_cctv">
                             @foreach ($equipment_type as $e_type)
                                 <option value="{{ $e_type->pk_equipment_type_id }}">{{ $e_type->name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="grid md:grid-cols-2 grid-cols-1 gap-2">



                         <div>
                             <label for="e_brand">Brand/Model</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="e_brand"
                                 id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_brand_model as $e_brand)
                                     <option value="{{ $e_brand->pk_equipment_brand_model_id }}">{{ $e_brand->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="e_cctv_type">CCTV Camera Type</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_cctv_type" id="">
                                 <option value="">Select</option>

                                 @foreach ($cctv_type as $e_cctv_type)
                                     <option value="{{ $e_cctv_type->pk_e_cctv_camera_type_id }}">
                                         {{ $e_cctv_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="no_of_cctv">Total No. of Camera</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="text"
                                 name="no_of_cctv" id="no_of_cctv" placeholder="0">
                         </div>
                         <div>
                             <label for="e_power_source">Power Source</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_power_source" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_power_source as $e_power_source)
                                     <option value="{{ $e_power_source->pk_equipment_power_source_id }}">
                                         {{ $e_power_source->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="e_location">Location</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_location">
                                 <option value="">Select</option>

                                 @foreach ($equipment_location as $e_location)
                                     <option value="{{ $e_location->pk_equipment_location_id }}">{{ $e_location->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="date_installed">Date Installed</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="date"
                                 name="date_installed" id="date_installed">
                         </div>
                         <div>
                             <label for="total_amount">Total Amount</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 step="0.01" name="total_amount" id="total_amount" placeholder="₱ 0.00">
                         </div>

                         <div>
                             <label for="e_installer">Installer</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 "
                                 name="e_installer" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_installer as $e_installer)
                                     <option value="{{ $e_installer->pk_equipment_installer_id }}">
                                         {{ $e_installer->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="no_of_functional">Total No. of Functional</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 name="no_of_functional" placeholder="0">
                         </div>
                         <div>
                             <label for="e_incharge">Person In Charge</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_incharge" id="">
                                 <option value="">Select</option>
                                 @foreach ($equipment_incharge as $e_incharge)
                                     <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="flex justify-end gap-2 mt-4">
                         <button type="submit" class="bg-blue-500 text-white px-6 py-1 rounded">
                             Submit
                         </button>
                         <button type="button" onclick="closeModal(1)" class="bg-gray-500 text-white px-6 py-1 rounded">
                             Cancel
                         </button>
                     </div>

                 </form>
             </div>
         </div>

         <div id="edit-overall-modal"
             class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
             <div class="modal-content p-4 bg-white rounded-md">
                 <form action="{{ route('schools.equipment.update') }}" method="POST">
                     @csrf
                     @method('PUT')
                     <h2 class="font-bold text-2xl text-gray-800" id="edit-modal-title">Update CCTV Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                     <input type="hidden" name="edit_primary_key" id="edit_primary_key">


                     <div class="grid md:grid-cols-2 grid-cols-1 gap-2">


                         <input type="hidden" id="target" name="target">
                         <div>
                             <label for="edit_e_brand">Brand/Model</label>
                             <select class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" name="edit_e_brand"
                                 id="edit_e_brand">
                                 <option value="">Select</option>

                                 @foreach ($equipment_brand_model as $e_brand)
                                     <option value="{{ $e_brand->pk_equipment_brand_model_id }}">{{ $e_brand->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div id="for-cctv" class="hidden">
                             <label for="edit_e_cctv_type">CCTV Camera Type</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_cctv_type" id="edit_e_cctv_type">
                                 <option value="">Select</option>

                                 @foreach ($cctv_type as $e_cctv_type)
                                     <option value="{{ $e_cctv_type->pk_e_cctv_camera_type_id }}">
                                         {{ $e_cctv_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div id="for-biometric" class="hidden">
                             <label for="edit_e_biometric_type">Biometric Authentication Type</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_biometric_type" id="edit_e_biometric_type">
                                 <option value="">Select</option>

                                 @foreach ($biometric_type as $e_bio_type)
                                     <option value="{{ $e_bio_type->pk_e_biometric_type_id }}">
                                         {{ $e_bio_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="edit_no_of_unit">Total No. of Camera</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="text"
                                 name="edit_no_of_unit" id="edit_no_of_unit" placeholder="0">
                         </div>
                         <div>
                             <label for="edit_e_power_source">Power Source</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_power_source" id="edit_e_power_source">
                                 <option value="">Select</option>

                                 @foreach ($equipment_power_source as $e_power_source)
                                     <option value="{{ $e_power_source->pk_equipment_power_source_id }}">
                                         {{ $e_power_source->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="edit_e_location">Location</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" id="edit_e_location"
                                 name="edit_e_location">
                                 <option value="">Select</option>

                                 @foreach ($equipment_location as $e_location)
                                     <option value="{{ $e_location->pk_equipment_location_id }}">{{ $e_location->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="edit_date_installed">Date Installed</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="date"
                                 name="edit_date_installed" id="edit_date_installed">
                         </div>
                         <div>
                             <label for="edit_total_amount">Total Amount</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 step="0.01" name="edit_total_amount" id="edit_total_amount" placeholder="₱ 0.00">
                         </div>

                         <div>
                             <label for="edit_e_installer">Installer</label>
                             <select class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 "
                                 name="edit_e_installer" id="edit_e_installer">
                                 <option value="">Select</option>

                                 @foreach ($equipment_installer as $e_installer)
                                     <option value="{{ $e_installer->pk_equipment_installer_id }}">
                                         {{ $e_installer->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="edit_no_of_functional">Total No. of Functional</label>
                             <input class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2" type="number"
                                 name="edit_no_of_functional" id="edit_no_of_functional" placeholder="0">
                         </div>
                         <div>
                             <label for="edit_e_incharge">Person In Charge</label>
                             <select class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="edit_e_incharge" id="edit_e_incharge">
                                 <option value="">Select</option>
                                 @foreach ($equipment_incharge as $e_incharge)
                                     <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="flex justify-end gap-2 mt-4">
                         <button type="submit" class="bg-blue-500 text-white px-6 py-1 rounded">
                             Update
                         </button>
                         <button type="button" onclick="closeModal(3)" class="bg-gray-500 text-white px-6 py-1 rounded">
                             Cancel
                         </button>
                     </div>

                 </form>
             </div>
         </div>

         <div id="add-biometric-modal"
             class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
             <div class="modal-content p-4 bg-white rounded-md">
                 <form action="{{ route('schools.equipment.store') }}" method="POST">
                     @csrf
                     @method('POST')
                     <h2 class="font-bold text-2xl text-gray-800">Biometrics Equipment Information</h2>
                     <h3 class="font-normal text-lg text-gray-800 mb-4">Save Information for Reports</h3>
                     <div>
                         <label for="e_type"></label>
                         <select class="hidden " name="selected_equipment" id="selected_equipment_biometric">
                             @foreach ($equipment_type as $e_type)
                                 <option value="{{ $e_type->pk_equipment_type_id }}">{{ $e_type->name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="grid md:grid-cols-2 grid-cols-1 gap-2">



                         <div>
                             <label for="e_brand">Brand/Model</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_brand" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_brand_model as $e_brand)
                                     <option value="{{ $e_brand->pk_equipment_brand_model_id }}">{{ $e_brand->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="e_biometric_type">Biometric Authentication Type</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_biometric_type" id="">
                                 <option value="">Select</option>

                                 @foreach ($biometric_type as $e_biometric_type)
                                     <option value="{{ $e_biometric_type->pk_e_biometric_type_id }}">
                                         {{ $e_biometric_type->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div>
                             <label for="no_of_cctv">Total No. of Biometric</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="text" name="no_of_cctv" id="no_of_cctv" placeholder="0">
                         </div>
                         <div>
                             <label for="e_power_source">Power Source</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_power_source" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_power_source as $e_power_source)
                                     <option value="{{ $e_power_source->pk_equipment_power_source_id }}">
                                         {{ $e_power_source->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="e_location">Location</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_location">
                                 <option value="">Select</option>

                                 @foreach ($equipment_location as $e_location)
                                     <option value="{{ $e_location->pk_equipment_location_id }}">{{ $e_location->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="date_installed">Date Installed</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="date" name="date_installed" id="date_installed">
                         </div>
                         <div>
                             <label for="total_amount">Total Amount</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="number" step="0.01" name="total_amount" id="total_amount"
                                 placeholder="₱ 0.00">
                         </div>

                         <div>
                             <label for="e_installer">Installer</label>
                             <select required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2 "
                                 name="e_installer" id="">
                                 <option value="">Select</option>

                                 @foreach ($equipment_installer as $e_installer)
                                     <option value="{{ $e_installer->pk_equipment_installer_id }}">
                                         {{ $e_installer->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <label for="no_of_functional">Total No. of Functional</label>
                             <input required class="px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 type="number" name="no_of_functional" placeholder="0">
                         </div>
                         <div>
                             <label for="e_incharge">Person In Charge</label>
                             <select required class=" px-2 py-1 w-full border border-gray-400 rounded-sm mb-2"
                                 name="e_incharge" id="">
                                 <option value="">Select</option>
                                 @foreach ($equipment_incharge as $e_incharge)
                                     <option value="{{ $e_incharge->pk_equipment_incharge_id }}">{{ $e_incharge->name }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="flex justify-end gap-2 mt-4">
                         <button type="submit" class="bg-blue-500 text-white px-6 py-1 rounded">
                             Submit
                         </button>
                         <button type="button" onclick="closeModal(2)" class="bg-gray-500 text-white px-6 py-1 rounded">
                             Cancel
                         </button>
                     </div>

                 </form>
             </div>
         </div>





         <script>
             function openEditModal(type, id, brand, total_object, object_type, powersource, location, total_amount, installer,
                 functional, incharge, date_installed) {
                 console.log(id, brand, total_object, object_type, powersource, location, total_amount, installer,
                     functional, incharge, "DATE", date_installed);
                 if (type == 'cctv') {
                     document.getElementById("edit-overall-modal").classList.remove('hidden');
                     document.getElementById('for-cctv').classList.remove('hidden');
                     document.getElementById('edit-modal-title').textContent = "Update CCTV Details";
                     document.getElementById('edit_primary_key').value = id;
                     document.getElementById('edit_e_brand').value = brand;
                     document.getElementById('edit_no_of_unit').value = total_object;
                     document.getElementById('edit_e_cctv_type').value = object_type;
                     document.getElementById('edit_e_power_source').value = powersource;
                     document.getElementById('edit_e_location').value = location;
                     document.getElementById('edit_total_amount').value = total_amount;
                     document.getElementById('edit_e_installer').value = installer;
                     document.getElementById('edit_no_of_functional').value = functional;
                     document.getElementById('edit_e_incharge').value = incharge;
                     document.getElementById('edit_date_installed').value = date_installed;
                     document.getElementById('target').value = 'cctv';

                 } else if (type == 'biometrics') {
                     document.getElementById("edit-overall-modal").classList.remove('hidden');

                     document.getElementById('for-biometric').classList.remove('hidden');
                     document.getElementById('edit-modal-title').textContent = "Update Biometric Details";
                     document.getElementById('edit_primary_key').value = id;
                     document.getElementById('edit_e_brand').value = brand;
                     document.getElementById('edit_no_of_unit').value = total_object;
                     document.getElementById('edit_e_biometric_type').value = object_type;
                     document.getElementById('edit_e_power_source').value = powersource;
                     document.getElementById('edit_e_location').value = location;
                     document.getElementById('edit_total_amount').value = total_amount;
                     document.getElementById('edit_e_installer').value = installer;
                     document.getElementById('edit_no_of_functional').value = functional;
                     document.getElementById('edit_e_incharge').value = incharge;
                     document.getElementById('edit_date_installed').value = date_installed;
                     document.getElementById('target').value = 'biometric';

                 }


             }

             function openModal(type) {
                 if (type == '1') {
                     document.getElementById('add-cctv-modal').classList.remove('hidden')

                     document.getElementById('selected_equipment_cctv').value = type;
                 } else if (type == '2') {
                     document.getElementById('selected_equipment_biometric').value = type;
                     document.getElementById('add-biometric-modal').classList.remove('hidden')

                 }
             }

             function closeModal(type) {
                 if (type == '1') {

                     document.getElementById('add-cctv-modal').classList.add('hidden')
                 } else if (type == '2') {

                     document.getElementById('add-biometric-modal').classList.add('hidden')
                 } else if (type == '3') {
                     document.getElementById('edit-overall-modal').classList.add('hidden')
                 }

             }

             function deleteFunction(id, type) {
                 if (confirm("Are you sure you want to delete this record?")) {
                     fetch('/School/Equipment/delete/' + id + '/' + type, {
                             method: 'DELETE',
                             headers: {
                                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                             }
                         })
                         .then(response => {
                             if (response.ok) {
                                 alert('Record deleted successfully!');
                                 location.reload();
                             } else {
                                 alert('Failed to delete record.');
                             }
                         })
                         .catch(error => console.error('Error:', error));
                 }

             }
         </script>


         <div class="px-5 py-5  mb-2 bg-white rounded-md border border-gray-300">
             <div class="flex justify-between">
                 <div>
                     <div class="text-2xl font-bold text-gray-700   ">School's CCTV Details</div>
                     <div class="text-md font-normal text-gray-600 mb-2  ">Create, View, Edit and Remove Details</div>
                     <div>
                         <button onclick="openModal(1)" class="bg-blue-600 text-white rounded-sm py-1 px-4 mb-2"> Add New
                             Record</button>
                     </div>

                 </div>
                 <div class="h-16 w-16  text-blue-600">
                     <svg fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 280.606 280.606" xmlns:xlink="http://www.w3.org/1999/xlink"
                         enable-background="new 0 0 280.606 280.606" transform="matrix(-1, 0, 0, 1, 0, 0)">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <g>
                                 <path
                                     d="m278.161,191.032l-149.199-149.199c-3.89-3.89-10.253-3.89-14.143,0l-55.861,55.861c-3.89,3.89-3.89,10.411 0,14.302l14.098,14.256h-40.056v-23.317c0-5.5-4.44-9.683-9.94-9.683h-13c-5.5,0-10.06,4.183-10.06,9.683v79c0,5.5 4.56,10.317 10.06,10.317h13c5.5,0 9.94-4.817 9.94-10.317v-22.683h73.056l78.767,78.607c3.89,3.891 11.097,4.979 16.016,2.52l75.449-37.764c4.919-2.459 5.763-7.693 1.873-11.583zm-162.104-127.81c3.223-3.222 8.445-3.222 11.668-7.10543e-15 3.222,3.223 3.222,8.445 0,11.667-3.223,3.223-8.445,3.223-11.668,0.001-3.222-3.222-3.222-8.445 1.42109e-14-11.668zm53.349,135.373l-94.007-94.007 11.313-11.313 94.007,94.007-11.313,11.313z">
                                 </path>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>
             <div class="overflow-x-auto ">
                 @if ($cctv_info->isNotEmpty())
                     <div class="grid gap-4">
                         @foreach ($cctv_info as $index => $info)
                             <div class="border border-gray-400 rounded-lg shadow p-4 bg-white">
                                 <div class="flex justify-between items-center  border-b border-gray-400 pb-2 mb-3">
                                     <h3 class="font-semiboldtext-gray-700">CCTV #{{ $index + 1 }}</h3>
                                     <span
                                         class="text-sm text-gray-500">{{ $info->equipment_details->date_installed ?? '' }}</span>
                                 </div>

                                 <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-md">
                                     <div>
                                         <span class="font-semibold">Brand / Model:</span>
                                         <p>{{ $info->equipment_details->brand_model->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">No. of Cameras:</span>
                                         <p>{{ $info->no_of_units ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Camera Type:</span>
                                         <p>{{ $info->cctv_type->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Power Source:</span>
                                         <p>{{ $info->equipment_details->powersource->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Location:</span>
                                         <p>{{ $info->equipment_details->location->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Total Amount:</span>
                                         <p>{{ $info->equipment_details->total_amount ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Installer/Contractor:</span>
                                         <p>{{ $info->equipment_details->installer->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         @php
                                             $percentage = ($info->no_of_functional / $info->no_of_units) * 100;
                                         @endphp
                                         <span class="font-semibold">Functional Cameras:</span>
                                         <p>{{ $info->no_of_functional ?? '' }}/{{ $info->no_of_units ?? '' }} -
                                             {{ $percentage . '%' ?? '' }}</p>

                                     </div>
                                     <div>
                                         <span class="font-semibold">Person In-Charge:</span>
                                         <p>{{ $info->equipment_details->incharge->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <button type="button"
                                             onclick="openEditModal('cctv',{{ $info->equipment_details->pk_equipment_details_id }},{{ $info->equipment_details->brand_model->pk_equipment_brand_model_id }},{{ $info->no_of_units }},{{ $info->cctv_type->pk_e_cctv_camera_type_id }},{{ $info->equipment_details->powersource->pk_equipment_power_source_id }},{{ $info->equipment_details->location->pk_equipment_location_id }},{{ $info->equipment_details->total_amount }},{{ $info->equipment_details->installer->pk_equipment_installer_id }},{{ $info->no_of_functional }}, {{ $info->equipment_details->incharge->pk_equipment_incharge_id }},'{{ $info->equipment_details->date_installed }}')"
                                             class="text-blue-600 border border-blue-600  hover:bg-blue-600 hover:text-white rounded-sm py-1 px-4">Edit
                                             Data</button>
                                         <button onclick="deleteFunction({{ $info->pk_e_cctv_details_id }},'cctv')"
                                             class=" text-red-600 border border-red-600  hover:bg-red-600 hover:text-white rounded-sm py-1 px-4">Remove</button>

                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 @else
                     <div class="text-center  text-md font-normal text-gray-600">
                         No CCTV Details Available.
                     </div>
                 @endif

             </div>

         </div>


         <div class="px-5 py-5 bg-white mb-4 rounded-md border border-gray-300">
             <div class="flex justify-between">
                 <div>
                     <div class="text-2xl font-bold text-gray-700   ">School's Biometric Details</div>
                     <div class="text-md font-normal text-gray-600 mb-2  ">Create, View, Edit and Remove Details</div>
                     <div>
                         <button onclick="openModal(2)" class="bg-blue-600 text-white rounded-sm mb-2 py-1 px-4"> Add New
                             Record</button>
                     </div>
                 </div>
                 <div class="text-blue-600 h-16 w-16">
                     <svg fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <g>
                                 <path
                                     d="M1,19c0.552,0,1-0.448,1-1V2h16c0.552,0,1-0.448,1-1s-0.448-1-1-1H0v18C0,18.552,0.448,19,1,19z">
                                 </path>
                                 <path
                                     d="M59,42c-0.552,0-1,0.448-1,1v15H43c-0.552,0-1,0.448-1,1s0.448,1,1,1h17V43C60,42.448,59.552,42,59,42z">
                                 </path>
                                 <path
                                     d="M43,0c-0.552,0-1,0.448-1,1s0.448,1,1,1h15v16c0,0.552,0.448,1,1,1s1-0.448,1-1V0H43z">
                                 </path>
                                 <path
                                     d="M18,58H2V43c0-0.552-0.448-1-1-1s-1,0.448-1,1v17h18c0.552,0,1-0.448,1-1S18.552,58,18,58z">
                                 </path>
                                 <path
                                     d="M32.743,51.946c0.61-17.503-1.61-22.969-1.705-23.193c-0.214-0.507-0.794-0.742-1.304-0.531 c-0.508,0.211-0.749,0.795-0.54,1.305c0.021,0.052,2.14,5.439,1.55,22.35c-0.019,0.552,0.413,1.015,0.965,1.034 c0.012,0,0.023,0,0.035,0C32.28,52.911,32.724,52.486,32.743,51.946z">
                                 </path>
                                 <path
                                     d="M17.08,12.307c0.301,0.463,0.921,0.595,1.383,0.293c1.197-0.778,2.508-1.466,3.899-2.046C24.833,9.523,27.441,9,30.118,9 c8.109,0,15.391,4.826,18.55,12.294c1.26,2.978,1.981,5.929,2.337,9.571c0.05,0.517,0.485,0.903,0.994,0.903 c0.032,0,0.065-0.001,0.098-0.005c0.55-0.054,0.952-0.542,0.898-1.092c-0.376-3.853-1.143-6.985-2.485-10.156 C47.036,12.305,39.032,7,30.118,7c-2.942,0-5.811,0.575-8.525,1.708c-1.501,0.626-2.921,1.371-4.219,2.215 C16.91,11.224,16.779,11.844,17.08,12.307z">
                                 </path>
                                 <path
                                     d="M15.206,13.803c-0.388-0.394-1.021-0.399-1.414-0.011c-3.967,3.909-6.149,9.159-6.311,15.182 c-0.092,3.412,0.451,7.121,1.614,11.025c0.129,0.434,0.527,0.715,0.958,0.715c0.095,0,0.191-0.014,0.286-0.042 c0.529-0.158,0.831-0.715,0.673-1.244c-1.103-3.701-1.618-7.2-1.532-10.4c0.15-5.575,2.073-10.222,5.715-13.811 C15.588,14.829,15.593,14.196,15.206,13.803z">
                                 </path>
                                 <path
                                     d="M44.822,24.893c0.455,1.342,0.796,2.737,1.042,4.266c0.613,3.813,0.631,8.411,0.462,14.593 c-0.015,0.552,0.42,1.012,0.972,1.027c0.009,0,0.019,0,0.028,0c0.54,0,0.984-0.43,0.999-0.973 c0.172-6.298,0.151-10.998-0.486-14.965c-0.264-1.64-0.631-3.142-1.123-4.591c-2.232-6.581-9.395-12.125-15.966-12.36 c-2.519-0.09-4.964,0.354-7.279,1.321c-6.393,2.667-10.563,8.861-10.622,15.78v0v0v0v0c-0.014,1.633,0.206,3.262,0.653,4.842 c0.234,0.825,0.473,1.703,0.6,2.57c0.275,1.877,0.577,5.382,0.45,11.422c-0.011,0.552,0.427,1.009,0.979,1.021 c0.007,0,0.014,0,0.021,0c0.542,0,0.988-0.434,1-0.979c0.129-6.178-0.186-9.802-0.472-11.753c-0.144-0.986-0.402-1.937-0.655-2.826 c-0.396-1.396-0.59-2.836-0.577-4.279l0,0l0,0c0.052-6.116,3.738-11.593,9.392-13.951c2.046-0.854,4.213-1.251,6.437-1.167 C36.39,14.093,42.867,19.133,44.822,24.893z">
                                 </path>
                                 <path
                                     d="M24.186,20.625c0.452-0.317,0.561-0.941,0.244-1.393c-0.317-0.451-0.941-0.561-1.393-0.244 c-3.13,2.197-4.993,5.835-5.111,9.982c0,0.001,0,0.002,0,0.003c-0.041,1.435,0.131,2.873,0.509,4.267 c0,0.003,0.026,0.096,0.027,0.099c0.854,3.129,1.176,9.135,0.905,16.911c-0.019,0.552,0.413,1.015,0.965,1.034 c0.012,0,0.023,0,0.035,0c0.536,0,0.98-0.425,0.999-0.965c0.282-8.087-0.055-14.141-0.999-17.596 c-0.329-1.212-0.478-2.455-0.442-3.694c0,0,0-0.001,0-0.002C20.024,25.519,21.577,22.456,24.186,20.625z">
                                 </path>
                                 <path
                                     d="M42.28,48.845c0.012,0,0.023,0,0.035,0c0.536,0,0.98-0.425,0.999-0.965c0.343-9.832,0.361-14.919-0.439-19.07 c0-0.001,0-0.002,0-0.003c-0.309-1.602-0.751-3.07-1.352-4.49c-1.943-4.592-6.419-7.559-11.405-7.559 c-0.896,0-1.79,0.097-2.656,0.288c-0.54,0.119-0.88,0.652-0.762,1.191c0.118,0.54,0.651,0.879,1.191,0.762 c0.726-0.16,1.475-0.241,2.226-0.241c4.181,0,7.935,2.488,9.563,6.338c0.545,1.29,0.948,2.628,1.23,4.092c0,0.001,0,0.001,0,0.002 c0.763,3.96,0.741,8.945,0.403,18.619C41.296,48.362,41.728,48.825,42.28,48.845z">
                                 </path>
                                 <path
                                     d="M37.544,45.219c-0.002,0-0.005,0-0.007,0c-0.549,0-0.996,0.443-1,0.993c-0.004,0.642-0.013,1.304-0.026,1.987 c-0.01,0.552,0.429,1.008,0.981,1.019c0.006,0,0.013,0,0.02,0c0.543,0,0.989-0.435,1-0.981c0.013-0.69,0.022-1.361,0.026-2.011 C38.541,45.673,38.096,45.223,37.544,45.219z">
                                 </path>
                                 <path
                                     d="M25.428,29.028c0.051-1.851,1.182-3.505,2.883-4.214c0.577-0.241,1.185-0.363,1.807-0.363c1.889,0,3.585,1.124,4.324,2.872 c0.119,0.282,0.368,0.869,0.652,1.936c0.557,2.085,1.255,6.02,1.413,12.918c0.012,0.544,0.458,0.977,0.999,0.977 c0.008,0,0.016,0,0.023,0c0.552-0.012,0.989-0.47,0.977-1.022c-0.128-5.617-0.64-10.246-1.479-13.389 c-0.321-1.201-0.606-1.875-0.747-2.207c-1.05-2.481-3.469-4.084-6.163-4.084c-0.888,0-1.755,0.174-2.577,0.517 c-2.426,1.012-4.04,3.369-4.112,6.005c-0.024,0.884,0.125,1.752,0.426,2.528c0.07,0.216,1.713,5.455,1.199,20.179 c-0.019,0.552,0.413,1.015,0.965,1.034c0.012,0,0.023,0,0.035,0c0.536,0,0.98-0.425,0.999-0.965 c0.517-14.818-1.109-20.291-1.314-20.917C25.516,30.253,25.411,29.646,25.428,29.028z">
                                 </path>
                                 <circle cx="5" cy="55" r="1"></circle>
                                 <circle cx="9" cy="55" r="1"></circle>
                                 <circle cx="13" cy="55" r="1"></circle>
                                 <circle cx="11" cy="53" r="1"></circle>
                                 <circle cx="15" cy="53" r="1"></circle>
                                 <circle cx="17" cy="55" r="1"></circle>
                                 <circle cx="21" cy="55" r="1"></circle>
                                 <circle cx="19" cy="53" r="1"></circle>
                                 <circle cx="7" cy="53" r="1"></circle>
                                 <circle cx="25" cy="55" r="1"></circle>
                                 <circle cx="29" cy="55" r="1"></circle>
                                 <circle cx="33" cy="55" r="1"></circle>
                                 <circle cx="35" cy="53" r="1"></circle>
                                 <circle cx="23" cy="53" r="1"></circle>
                                 <circle cx="37" cy="55" r="1"></circle>
                                 <circle cx="41" cy="55" r="1"></circle>
                                 <circle cx="39" cy="53" r="1"></circle>
                                 <circle cx="45" cy="55" r="1"></circle>
                                 <circle cx="49" cy="55" r="1"></circle>
                                 <circle cx="53" cy="55" r="1"></circle>
                                 <circle cx="51" cy="53" r="1"></circle>
                                 <circle cx="55" cy="53" r="1"></circle>
                                 <circle cx="43" cy="53" r="1"></circle>
                                 <circle cx="47" cy="53" r="1"></circle>
                                 <circle cx="5" cy="51" r="1"></circle>
                                 <circle cx="9" cy="51" r="1"></circle>
                                 <circle cx="13" cy="51" r="1"></circle>
                                 <circle cx="11" cy="49" r="1"></circle>
                                 <circle cx="17" cy="51" r="1"></circle>
                                 <circle cx="7" cy="49" r="1"></circle>
                                 <circle cx="45" cy="51" r="1"></circle>
                                 <circle cx="49" cy="51" r="1"></circle>
                                 <circle cx="53" cy="51" r="1"></circle>
                                 <circle cx="51" cy="49" r="1"></circle>
                                 <circle cx="55" cy="49" r="1"></circle>
                                 <circle cx="47" cy="49" r="1"></circle>
                                 <circle cx="5" cy="47" r="1"></circle>
                                 <circle cx="9" cy="47" r="1"></circle>
                                 <circle cx="7" cy="45" r="1"></circle>
                                 <circle cx="49" cy="47" r="1"></circle>
                                 <circle cx="53" cy="47" r="1"></circle>
                                 <circle cx="51" cy="45" r="1"></circle>
                                 <circle cx="55" cy="45" r="1"></circle>
                                 <circle cx="5" cy="43" r="1"></circle>
                                 <circle cx="9" cy="43" r="1"></circle>
                                 <circle cx="7" cy="41" r="1"></circle>
                                 <circle cx="53" cy="43" r="1"></circle>
                                 <circle cx="55" cy="41" r="1"></circle>
                                 <circle cx="5" cy="39" r="1"></circle>
                                 <circle cx="53" cy="39" r="1"></circle>
                                 <circle cx="55" cy="37" r="1"></circle>
                                 <circle cx="5" cy="35" r="1"></circle>
                                 <circle cx="53" cy="35" r="1"></circle>
                                 <circle cx="55" cy="33" r="1"></circle>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>
             <div class="overflow-x-auto ">

                 @if ($biometric_info->isNotEmpty())
                     <div class="grid gap-4">
                         @foreach ($biometric_info as $index => $info)
                             <div class="border border-gray-400 rounded-lg shadow p-4 bg-white">
                                 <div class="flex justify-between items-center border-b border-gray-400 pb-2 mb-2">
                                     <h3 class="font-semibold text-gray-700">Biometric #{{ $index + 1 }}</h3>
                                     <span
                                         class="text-sm text-gray-500">{{ $info->equipment_details->date_installed ?? '' }}</span>
                                 </div>

                                 <div class="grid grid-cols-2 md:grid-cols-5 gap-3 text-md">
                                     <div>
                                         <span class="font-semibold">Brand / Model:</span>
                                         <p>{{ $info->equipment_details->brand_model->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">No. of Biometrics:</span>
                                         <p>{{ $info->no_of_units ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Authentication Type:</span>
                                         <p>{{ $info->biometric_type->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Power Source:</span>
                                         <p>{{ $info->equipment_details->powersource->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Location:</span>
                                         <p>{{ $info->equipment_details->location->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Total Amount:</span>
                                         <p>{{ $info->equipment_details->total_amount ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Installer/Contractor:</span>
                                         <p>{{ $info->equipment_details->installer->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         @php
                                             $percentage = ($info->no_of_functional / $info->no_of_units) * 100;

                                         @endphp
                                         <span class="font-semibold">Functional Biometrics:</span>
                                         <p>{{ $info->no_of_functional ?? '' }}/{{ $info->no_of_units ?? '' }} -
                                             {{ $percentage . '%' ?? '' }}</p>
                                     </div>
                                     <div>
                                         <span class="font-semibold">Person In-Charge:</span>
                                         <p>{{ $info->equipment_details->incharge->name ?? '' }}</p>
                                     </div>
                                     <div>
                                         <button
                                             onclick="openEditModal('biometrics', {{ $info->equipment_details->pk_equipment_details_id }},{{ $info->equipment_details->brand_model->pk_equipment_brand_model_id }},{{ $info->no_of_units }},{{ $info->biometric_type->pk_e_biometric_type_id }},{{ $info->equipment_details->powersource->pk_equipment_power_source_id }},{{ $info->equipment_details->location->pk_equipment_location_id }},{{ $info->equipment_details->total_amount }},{{ $info->equipment_details->installer->pk_equipment_installer_id }},{{ $info->no_of_functional }}, {{ $info->equipment_details->incharge->pk_equipment_incharge_id }},'{{ $info->equipment_details->date_installed }}')"
                                             class="text-blue-600 border border-blue-600  hover:bg-blue-600 hover:text-white rounded-sm py-1 px-4">Edit
                                             Data</button>
                                         <button
                                             onclick="deleteFunction({{ $info->pk_e_biometric_details_id }},'biometrics')"
                                             class=" text-red-600 border border-red-600  hover:bg-red-600 hover:text-white rounded-sm py-1 px-4">Remove</button>

                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 @else
                     <div class="text-center  text-md font-normal text-gray-600">
                         No Biometric Details Available.
                     </div>
                 @endif
             </div>
         </div>

     </div>
 @endsection

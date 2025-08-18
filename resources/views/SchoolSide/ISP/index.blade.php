 @extends('layout.Admin-Side')
 <title>@yield('title', 'DCP Dashboard')</title>

 @section('content')
     <div class="my-10 mx-5">
         <div>
             <h2 class="font-bold text-2xl text-gray-800">Schools Internet Service Provider Information</h2>
             <h2 class="font-normal text-lg text-gray-600">Bulletin</h2>
             <div class="bg-white py-5 px-5 border border-gray-600">
                 <button onclick="openISPDetailsModal()" class="bg-blue-600 text-white rounded-md py-1 px-4">
                     Encode Internet Service Providers Details

                 </button>

                 <div class="mt-4 border border-gray-600 p-4 overflow-x-auto">
                     <table class="table-auto border border-gray-300 w-full border-collapse">
                         <thead class="bg-gray-700 sticky top-0 z-10">
                             <tr>
                                 <th class="py-2 px-2 text-white border border-gray-500">No.</th>
                                 <th class="py-2 px-2 text-white text-center border border-gray-500">Internet Service
                                     Provider</th>
                                 <th class="py-2 px-2 text-white text-center border border-gray-500">Connection Type</th>
                                 <th class="py-2 px-2 text-white text-center border border-gray-500">Purpose</th>
                                 <th class="py-2 px-2 text-white text-center border border-gray-500">Speed Test Result</th>
                                 <th class="py-2 px-2 text-white text-center border border-gray-500">Internet Quality</th>
                                 <th class="py-2 px-2 text-white text-center border border-gray-500">Areas Available</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($isp_content as $index => $content)
                                 <tr>
                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">{{ $index + 1 }}</td>
                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">{{ $content->isp_name }}
                                     </td>
                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">
                                         {{ $content->connection_type_name }}</td>
                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">
                                         {{ $content->purpose }}</td>
                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">

                                         <div class="flex flex-col">
                                             <div class="font-normal">Upload: {{ $content->upload }} mbps</div>
                                             <div class="font-normal">Download: {{ $content->download }} mbps</div>
                                             <div class="font-normal">Ping: {{ $content->ping }} mbps</div>

                                         </div>

                                     </td>
                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">
                                         {{ $content->quality }}</td>


                                     <td class="py-2 px-2 border border-gray-500 py-2 text-center">
                                         @foreach ($content->areas as $area)
                                             <div class="font-normal" data-id="{{ $area['id'] }}">
                                                 {{ $area['name'] }}
                                             </div>
                                         @endforeach
                                         <button class="text-blue-600 underline hover:text-blue-800">Edit Areas</button>

                                     </td>
                                     <td>
                                         <button
                                             onclick='editISPDetailsModal({{ $content->id }}, {{ $content->list_id }}, {{ $content->connection_type_id }}, {{ $content->quality_id }} ,{{ $content->upload }},{{ $content->download }},{{ $content->ping }}, "{{ $content->purpose }}",
                                             @json($content->areas))'
                                             class="text-blue-600 underline hover:text-blue-800">Change Details</button>
                                     </td>

                                 </tr>
                             @endforeach
                         </tbody>

                     </table>

                 </div>
             </div>
             <div id="add-details-modal"
                 class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden py-10">
                 <div
                     class="bg-white rounded-lg   shadow-lg w-full max-w-lg md:max-w-2xl lg:max-w-3xl p-6 mx-4 md:mx-0 overflow-y-auto max-h-[90vh]">
                     <div>
                         <form action="{{ route('schools.isp.store') }}" method="POST">
                             @csrf
                             @method('POST')
                             <div class="font-bold text-xl">
                                 Internet Service Provider Information
                             </div>
                             <div class="mb-4 flex flex-col">
                                 @php
                                     $isp_list = App\Models\ISP\ISPList::all();

                                 @endphp
                                 <label for="isp_list_id">Internet Service Provider</label>
                                 <select class="border border-gray-600 rounded-sm py-1 px-2" name="isp_list_id">
                                     <option value="" selected>Select ISP</option>
                                     @foreach ($isp_list as $list)
                                         <option value="{{ $list->pk_isp_list_id }}">{{ $list->name }}</option>
                                     @endforeach


                                 </select>
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_connection_type">Connection Type</label>
                                     <select name="isp_connection_type" class="border border-gray-600 rounded-sm py-1 px-2">
                                         <option value="" selected>Select type</option>
                                         @php
                                             $isp_conn = App\Models\ISP\ISPConnectionType::all();

                                         @endphp
                                         @foreach ($isp_conn as $type)
                                             <option value="{{ $type->pk_isp_connection_type_id }}">{{ $type->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_internet_quality">Internet Quality</label>
                                     <select name="isp_internet_quality" class="border border-gray-600 rounded-sm px-2 py-1"
                                         id="">
                                         <option value="" selected>Select</option>
                                         @php
                                             $internetQuality = App\Models\ISP\ISPInternetQuality::all();

                                         @endphp
                                         @foreach ($internetQuality as $quality)
                                             <option value="{{ $quality->pk_isp_internet_quality_id }}">
                                                 {{ $quality->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-4 flex flex-col">
                                 <label for="isp_purpose">Purpose</label>
                                 <input class="border border-gray-600 rounded-sm py-1 px-2" type="text"
                                     name="isp_purpose">
                             </div>

                             <div class="font-bold text-xl">
                                 Speed Test Results
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_upload">Upload</label>
                                     <input class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                                         name="isp_upload">
                                 </div>
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_download">Download</label>

                                     <input class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                                         name="isp_download">
                                 </div>
                                 <div class="mb-4 flex flex-col">
                                     <label for="isp_ping">Ping</label>
                                     <input class="border border-gray-600 rounded-sm py-1 px-2" type="number"
                                         name="isp_ping">
                                 </div>
                             </div>



                             @php
                                 $isp_area = App\Models\ISP\ISPAreaAvailable::all();
                             @endphp
                             <div class="mb-4 flex flex-col">
                                 <label for="isp_area">ISP Area of Connection</label>
                                 <div class="flex flex-row gap-2">
                                     <select class="border border-gray-600 px-2 py-1 rounded-sm" name="isp_area"
                                         id="isp_area">
                                         <option value="" selected>Select area</option>
                                         @foreach ($isp_area as $area)
                                             <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}
                                             </option>
                                         @endforeach

                                     </select>
                                     <button type="button" onclick="addArea()"
                                         class="bg-blue-600 rounded-sm px-2 py-1 text-white ">
                                         Add More Area
                                     </button>
                                 </div>

                                 <div class="flex flex-row items-center mt-4">
                                     Selected Area/s:
                                     <div id="selected-areas"></div>
                                 </div>

                             </div>
                             <div class="flex gap-2">
                                 <button type="submit" class="bg-blue-600 font-normal text-white px-4 py-1 rounded-sm">Save
                                     ISP
                                     Details
                                 </button>
                                 <button type="button" onclick="closeISPDetailsModal()"
                                     class="bg-gray-400 text-white py-1 px-4 font-normal rounded-sm">
                                     Cancel
                                 </button>
                             </div>

                         </form>
                     </div>
                 </div>
             </div>
             <div id="edit-details-modal"
                 class="modal inset-0 fixed  overflow-y-auto  bg-black bg-opacity-40 flex items-center justify-center z-50 hidden py-10">
                 <div
                     class="bg-white rounded-lg   shadow-lg w-full max-w-lg md:max-w-2xl lg:max-w-3xl p-6 mx-4 md:mx-0 overflow-y-auto max-h-[90vh]">
                     <div>
                         <form action="{{ route('schools.isp.store') }}" method="POST">
                             @csrf
                             @method('PUT')
                             <div class="font-bold text-xl">
                                 Internet Service Provider Information
                             </div>
                             <input type="hidden" name="isp_details_id" id="edit_isp_details_id">
                             <div class="mb-4 flex flex-col">
                                 @php
                                     $isp_list = App\Models\ISP\ISPList::all();

                                 @endphp
                                 <label for="isp_list_id">Internet Service Provider</label>
                                 <select id="edit_isp_list_id" class="border border-gray-600 rounded-sm py-1 px-2"
                                     name="isp_list_id">
                                     <option value="" selected>Select ISP</option>
                                     @foreach ($isp_list as $list)
                                         <option value="{{ $list->pk_isp_list_id }}">{{ $list->name }}</option>
                                     @endforeach


                                 </select>
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_connection_type">Connection Type</label>
                                     <select id="edit_isp_connection_type_id" name="isp_connection_type"
                                         class="border border-gray-600 rounded-sm py-1 px-2">
                                         <option value="" selected>Select type</option>
                                         @php
                                             $isp_conn = App\Models\ISP\ISPConnectionType::all();

                                         @endphp
                                         @foreach ($isp_conn as $type)
                                             <option value="{{ $type->pk_isp_connection_type_id }}">{{ $type->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="mb-4 flex flex-col w-full">
                                     <label for="isp_internet_quality">Internet Quality</label>
                                     <select name="isp_internet_quality" id="edit_isp_internet_quality_id"
                                         class="border border-gray-600 rounded-sm px-2 py-1" id="">
                                         <option value="" selected>Select</option>
                                         @php
                                             $internetQuality = App\Models\ISP\ISPInternetQuality::all();

                                         @endphp
                                         @foreach ($internetQuality as $quality)
                                             <option value="{{ $quality->pk_isp_internet_quality_id }}">
                                                 {{ $quality->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-4 flex flex-col">
                                 <label for="isp_purpose">Purpose</label>
                                 <input class="border border-gray-600 rounded-sm py-1 px-2" type="text"
                                     id="edit_isp_purpose" name="isp_purpose">
                             </div>

                             <div class="font-bold text-xl">
                                 Speed Test Results
                             </div>
                             <div class="flex md:flex-row flex-col gap-4">
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_upload">Upload</label>
                                     <input id="edit_isp_upload" class="border border-gray-600 rounded-sm py-1 px-2"
                                         type="number" name="isp_upload">
                                 </div>
                                 <div class="mb-2 flex flex-col">
                                     <label for="isp_download">Download</label>

                                     <input id="edit_isp_download" class="border border-gray-600 rounded-sm py-1 px-2"
                                         type="number" name="isp_download">
                                 </div>
                                 <div class="mb-4 flex flex-col">
                                     <label for="isp_ping">Ping</label>
                                     <input id="edit_isp_ping" class="border border-gray-600 rounded-sm py-1 px-2"
                                         type="number" name="isp_ping">
                                 </div>
                             </div>

                             <h3 class="font-bold mt-3">Areas</h3>

                             <div id="edit_areas_container" class="flex flex-row gap-2"></div>



                             {{-- @php
                                 $isp_area = App\Models\ISP\ISPAreaAvailable::all();
                             @endphp
                             <div class="mb-4 flex flex-col">
                                 <label for="isp_area">ISP Area of Connection</label>
                                 <div class="flex flex-row gap-2">
                                     <select class="border border-gray-600 px-2 py-1 rounded-sm" name="isp_area"
                                         id="isp_area">
                                         <option value="" selected>Select area</option>
                                         @foreach ($isp_area as $area)
                                             <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}
                                             </option>
                                         @endforeach

                                     </select>
                                     <button type="button" onclick="addArea()"
                                         class="bg-blue-600 rounded-sm px-2 py-1 text-white ">
                                         Add More Area
                                     </button>
                                 </div>

                                 <div class="flex flex-row items-center mt-4">
                                     Selected Area/s:
                                     <div id="selected-areas"></div>
                                 </div>

                             </div> --}}
                             <div class="flex gap-2">
                                 <button type="submit"
                                     class="bg-blue-600 font-normal text-white px-4 py-1 rounded-sm">Update
                                     ISP
                                     Details
                                 </button>
                                 <button type="button" onclick="closeEditModal()"
                                     class="bg-gray-400 text-white py-1 px-4 font-normal rounded-sm">
                                     Cancel
                                 </button>
                             </div>

                         </form>
                     </div>
                 </div>
             </div>
             <script>
                 function closeEditModal() {
                     document.getElementById('edit-details-modal').classList.add('hidden');
                 }

                 function editISPDetailsModal(isp_id, isp_list, isp_connection_type, isp_internet_quality, isp_upload,
                     isp_download,
                     isp_ping, isp_purpose, areas) {
                     document.getElementById('edit-details-modal').classList.remove('hidden');
                     document.getElementById('edit_isp_details_id').value = isp_id
                     document.getElementById('edit_isp_list_id').value = isp_list
                     document.getElementById('edit_isp_connection_type_id').value = isp_connection_type;
                     document.getElementById('edit_isp_internet_quality_id').value = isp_internet_quality;
                     document.getElementById('edit_isp_purpose').value = isp_purpose;
                     document.getElementById('edit_isp_upload').value = isp_upload;
                     document.getElementById('edit_isp_download').value = isp_download;
                     document.getElementById('edit_isp_ping').value = isp_ping;
                     // 👉 Handle Areas
                     let container = document.getElementById("edit_areas_container");
                     container.innerHTML = ""; // clear old

                     if (areas && areas.length > 0) {
                         areas.forEach((area, index) => {
                             container.innerHTML += `
                    <input 
                        type="text" 
                        class="border px-2 py-1 w-1/2 mt-1 mb-2 border-gray-600 rounded-sm "
                        name="areas[]" 
                        value="${area}" 
                        data-index="${index}" />
                `;
                         });
                     } else {
                         container.innerHTML = "<p class='text-gray-500 text-sm'>No areas added yet.</p>";
                     }

                 }

                 function openISPDetailsModal() {
                     document.getElementById('add-details-modal').classList.remove('hidden');
                 }

                 function closeISPDetailsModal() {
                     document.getElementById('add-details-modal').classList.add('hidden');

                 }
             </script>
         </div>
     </div>


     <script>
         let areas = [];

         function addArea() {
             let dropdown = document.getElementById('isp_area');
             let selected_area = dropdown.value;
             let selected_text = dropdown.options[dropdown.selectedIndex].text;
             if (selected_area && !areas.includes(selected_area)) {
                 areas.push(selected_area);
                 document.getElementById('selected-areas').innerHTML =
                     areas.map(a => {
                         let optionText = dropdown.querySelector(`option[value="${a}"]`).text;
                         return ` <span class="px-2 py-1 bg-gray-200 rounded inline-block m-1">
                            ${optionText}
                        </span>
                          <input type="hidden" name="areas[]" value="${a}">`;
                     }).join("");
             }


         }
     </script>
 @endsection

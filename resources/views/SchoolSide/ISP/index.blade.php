 @extends('layout.SchoolSideLayout')
 <title>
     @yield('title', 'DCP Dashboard')</title>

 @section('content')


     <div class="p-6">
         <div class="flex justify-start mb-4 space-x-4">
             <div
                 class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                 <div class="text-white bg-blue-600 p-2 rounded-full">
                     <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
                         <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                         <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                         <g id="SVGRepo_iconCarrier">
                             <title></title>
                             <g>
                                 <path d="M48,60A12,12,0,1,0,60,72,12.0081,12.0081,0,0,0,48,60Z"></path>
                                 <path
                                     d="M22.6055,46.6289A5.9994,5.9994,0,1,0,31.1133,55.09a24.2258,24.2258,0,0,1,33.7734,0,5.9512,5.9512,0,0,0,4.2539,1.77,6,6,0,0,0,4.2539-10.23C59.7773,32.918,36.2227,32.918,22.6055,46.6289Z">
                                 </path>
                                 <path
                                     d="M90.27,29.7773a59.1412,59.1412,0,0,0-84.539,0,5.9994,5.9994,0,1,0,8.5312,8.4375c18.1172-18.3281,49.3594-18.3281,67.4766,0A5.9994,5.9994,0,1,0,90.27,29.7773Z">
                                 </path>
                             </g>
                         </g>
                     </svg>
                 </div>
             </div>
             <div>
                 <h2 class="font-bold text-2xl text-blue-700">Schools Internet Service Provider Information</h2>
                 <h2 class="font-normal text-lg text-gray-600">Bulletin</h2>


             </div>


         </div>
         <div class="flex justify-start my-2">
             <div
                 class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                 <button title="Show Info Modal" type="button" onclick="openISPDetailsModal()"
                     class="btn-submit h-8 py-1 px-4 rounded-full">
                     Add New ISP
                 </button>
             </div>
         </div>



         <div class=" py-4 overflow-x-auto">
             @if ($isp_content->isNotEmpty())
                 <table class="table-auto border border-gray-300 w-full border-collapse ">
                     <thead class="bg-gray-100 border border-gray-500 sticky top-0 z-10">
                         <tr>
                             <td
                                 class=" tracking-wider whitespace-nowrap border-b border-gray-500   py-2 px-2 font-semibold  text-gray-800">
                                 No.</td>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold   text-gray-800 text-center ">
                                 Service
                                 Provider</th>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800 text-center ">
                                 Connection Type
                             </td>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold  text-gray-800 text-center ">
                                 Purpose</ttdh>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold   text-gray-800 text-center ">
                                 Speed Test
                             </td>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold text-gray-800 text-center  ">
                                 Internet Quality
                             </td>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold   text-gray-800 text-center  ">
                                 Areas Available
                             </td>
                             <td
                                 class=" tracking-wider  whitespace-nowrap   border-b border-gray-500  py-2 px-2 font-semibold text-gray-800 text-center  ">
                                 Action</td>
                         </tr>
                     </thead>
                     <tbody class="tracking-wide">
                         @foreach ($isp_content as $index => $content)
                             <tr>
                                 <td class="py-2 px-2 border border-gray-500 py-2 bg-gray-300 text-center">
                                     {{ $index + 1 }}
                                 </td>
                                 <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                     {{ $content->isp_name }}
                                 </td>
                                 <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                     {{ $content->connection_type_name }}</td>
                                 <td class="py-2 px-2 border border-gray-300 py-2 text-center " style="width: 20%">
                                     @php
                                         $purpose = App\Models\ISP\ISPPurpose::where(
                                             'pk_isp_purpose_id',
                                             $content->isp_purpose_id,
                                         )->value('name');

                                     @endphp
                                     {{ $purpose ?? '' }}</td>
                                 <td class="py-2 px-2 border border-gray-300 py-2 text-center">

                                     <div class="flex flex-col">
                                         <div class="font-normal">Upload: {{ $content->upload }} mbps</div>
                                         <div class="font-normal">Download: {{ $content->download }} mbps</div>
                                         <div class="font-normal">Ping: {{ $content->ping }} mbps</div>

                                     </div>

                                 </td>
                                 <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                     {{ $content->quality }}</td>


                                 <td class="py-2 px-2 border border-gray-300 py-2 text-center">
                                     <div class="flex flex-col">
                                         <div class="  text-left mb-2">
                                             <div class="flex justify-start  ">
                                                 <div
                                                     class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                                     <button title="Show Info Modal" type="button"
                                                         onclick="showInsertArea({{ $content->id }}) "
                                                         class="btn-submit whitespace-nowrap h-8 py-1 px-4 rounded-full">
                                                         Insert Area
                                                     </button>
                                                 </div>
                                             </div>
                                         </div>
                                         @foreach ($content->areas as $area)
                                             <div
                                                 class="flex md:flex-row flex-col justify-between md:gap-5 gap-2 border border-gray-300 px-2 py-1 rounded-sm shadow-sm mb-1">
                                                 <div class="font-normal whitespace-nowrap" data-id="{{ $area['id'] }}">

                                                     {{ $area['name'] }}


                                                 </div>
                                                 <div class="flex flex-row gap-2">
                                                     <button type="button"
                                                         onclick="editAreaModal({{ $content->id }}, {{ $area['id'] }})"
                                                         class="text-blue-600 tracking-wider font-medium hover:text-blue-800">Edit
                                                     </button>
                                                     <button type="button"
                                                         onclick="deleteArea({{ $content->id }}, {{ $area['id'] }})"
                                                         class="text-red-600 tracking-wider font-medium hover:text-red-800">Remove
                                                     </button>
                                                 </div>
                                             </div>
                                         @endforeach
                                     </div>



                                 </td>
                                 <td class="py-2 px-2 border border-gray-300   text-center">


                                     <div class="flex flex-row gap-1 justify-center items-start">

                                         <div
                                             class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                             <button title="Insert Area" class="  btn-submit  p-1 rounded-full"
                                                 onclick="showInsertArea({{ $content->id }})">
                                                 <svg class="w-8 h-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                                     fill="none">
                                                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                         stroke-linejoin="round"></g>
                                                     <g id="SVGRepo_iconCarrier">
                                                         <path fill="currentColor" fill-rule="evenodd"
                                                             d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z">
                                                         </path>
                                                     </g>
                                                 </svg>
                                             </button>
                                         </div>
                                         <div
                                             class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                             <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                                 onclick='editISPDetailsModal({{ $content->id }}, {{ $content->list_id }}, {{ $content->connection_type_id }}, {{ $content->quality_id }} ,{{ $content->upload }},{{ $content->download }},{{ $content->ping }}, "{{ $content->isp_purpose_id ?? '' }}", @json($content->areas))'>
                                                 <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                         stroke-linejoin="round">
                                                     </g>
                                                     <g id="SVGRepo_iconCarrier">
                                                         <g id="Edit / Edit_Pencil_Line_02">
                                                             <path id="Vector"
                                                                 d="M4 20.0001H20M4 20.0001V16.0001L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L8 20.0001L4 20.0001Z"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                             </path>
                                                         </g>
                                                     </g>
                                                 </svg>
                                             </button>
                                         </div>
                                         <div
                                             class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                             <button type="button" title="Remove ISP"
                                                 onclick="deleteISP({{ $content->id }})"
                                                 class="btn-delete p-1 rounded-full">
                                                 <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                         stroke-linejoin="round"></g>
                                                     <g id="SVGRepo_iconCarrier">
                                                         <path
                                                             d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                         </path>
                                                     </g>
                                                 </svg>
                                             </button>
                                         </div>
                                         <div
                                             class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                                             @php
                                                 $if_exist = App\Models\ISPInfo\ISPInfo::where(
                                                     'school_internet_id',
                                                     $content->id,
                                                 )->first();

                                             @endphp
                                             <button title="Internet Information"
                                                 onclick="{{ $if_exist ? "showTableInfo($content->id)" : "showInfoModal($content->id)" }}"
                                                 class="{{ $if_exist ? 'btn-green' : 'btn-cancel' }} p-1 rounded-full">
                                                 <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                         stroke-linejoin="round"></g>
                                                     <g id="SVGRepo_iconCarrier">
                                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                                             d="M13.6 3H10V6.6H13.6V3ZM13.6 10.2H10V21H13.6V10.2Z"
                                                             fill="currentColor">
                                                         </path>
                                                     </g>
                                                 </svg>
                                             </button>

                                         </div>
                                     </div>
                                 </td>

                             </tr>
                         @endforeach
                     </tbody>

                 </table>
             @else
                 <div class="text-center  text-base font-normal text-gray-600">
                     No ISP Details Available.
                 </div>
             @endif
         </div>
     </div>
     @include('SchoolSide.ISP.partials._areaModal')
     @include('SchoolSide.ISP.partials._detailsModal')
     @include('SchoolSide.ISP.partials._modalAddInfo')
     @include('SchoolSide.ISP.partials._modalEditInfo')
     @include('SchoolSide.ISP.partials._tableInfo')
     @include('SchoolSide.ISP.partials.scripts')

 @endsection

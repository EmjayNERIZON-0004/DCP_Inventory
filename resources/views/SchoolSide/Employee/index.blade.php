  @extends('layout.SchoolSideLayout')
  <title>
      @yield('title', 'DCP Dashboard')</title>

  @section('content')
      {{-- ===== Add Employee Modal ===== --}}
      {{-- Add Employee Modal --}}

      @include('SchoolSide.Employee.partials._modalAdd')


      {{-- ===== Edit Employee Modal ===== --}}
      @include('SchoolSide.Employee.partials._modalEdit')





      <div class="p-6">
          <div class="flex justify-start space-x-4">

              <div
                  class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                  <div class="text-white bg-blue-600 p-2 rounded-full">
                      <svg class="w-10 h-10" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                          fill="currentColor">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">

                              <g>
                                  <path class="st0"
                                      d="M256.008,411.524c54.5,0,91.968-7.079,92.54-13.881c2.373-28.421-34.508-43.262-49.381-48.834 c-7.976-2.984-19.588-11.69-19.588-17.103c0-3.587,0-8.071,0-14.214c4.611-5.119,8.095-15.532,10.183-27.317 c4.857-1.738,7.627-4.524,11.095-16.65c3.69-12.93-5.548-12.5-5.548-12.5c7.468-24.715-2.357-47.944-18.825-46.246 c-11.358-19.857-49.397,4.54-61.31,2.841c0,6.818,2.834,11.92,2.834,11.92c-4.143,7.882-2.548,23.564-1.389,31.485 c-0.667,0-9.016,0.079-5.468,12.5c3.452,12.126,6.23,14.912,11.088,16.65c2.079,11.786,5.571,22.198,10.198,27.317 c0,6.143,0,10.627,0,14.214c0,5.413-12.35,14.548-19.611,17.103c-14.953,5.262-51.746,20.413-49.373,48.834 C164.024,404.444,201.491,411.524,256.008,411.524z">
                                  </path>
                                  <path class="st0"
                                      d="M404.976,56.889h-75.833v16.254c0,31.365-25.524,56.889-56.889,56.889h-32.508 c-31.366,0-56.889-25.524-56.889-56.889V56.889h-75.834c-25.444,0-46.071,20.627-46.071,46.071v362.969 c0,25.444,20.627,46.071,46.071,46.071h297.952c25.445,0,46.072-20.627,46.072-46.071V102.96 C451.048,77.516,430.421,56.889,404.976,56.889z M402.286,463.238H109.714V150.349h292.572V463.238z">
                                  </path>
                                  <path class="st0"
                                      d="M239.746,113.778h32.508c22.405,0,40.635-18.23,40.635-40.635V40.635C312.889,18.23,294.659,0,272.254,0 h-32.508c-22.406,0-40.635,18.23-40.635,40.635v32.508C199.111,95.547,217.341,113.778,239.746,113.778z M231.619,40.635 c0-4.492,3.634-8.127,8.127-8.127h32.508c4.492,0,8.127,3.635,8.127,8.127v16.254c0,4.492-3.635,8.127-8.127,8.127h-32.508 c-4.493,0-8.127-3.635-8.127-8.127V40.635z">
                                  </path>
                              </g>
                          </g>
                      </svg>
                  </div>
              </div>
              <div>
                  <div class="text-2xl font-bold text-blue-700">Digital Identity</div>
                  <div class="text-md font-medium tracking-wider text-gray-600 mb-2">Employee Information</div>


              </div>
          </div>

          <div id="cards" class="grid grid-cols-2 md:grid-cols-6 gap-3 my-2 "></div>
          <div class="d-flex justify-content-end my-2">

              <div class="flex justify-start  ">
                  <div
                      class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                      <button title="Show Info Modal" type="button" onclick="openModal()"
                          class="btn-submit h-8 py-1 px-4 rounded-full">
                          Add Employee
                      </button>
                  </div>
              </div>

          </div>
          <div class="text-md font-medium tracking-wider text-gray-600 ">Employee List</div>
          <div class="overflow-y-auto md:shadow-none shadow-md text-xs">
              <table class="w-full tracking-wider table-auto border-collapse" id="employeeTable">
                  @foreach ($employee as $index => $emp)
                      {{-- ===== BASIC INFO ===== --}}

                      <tr class="medium-text">

                          <td colspan="8" class=" uppercase py-2 large-text font-medium text-left">

                              <div class="flex justify-start  ">
                                  <div
                                      class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-sm flex items-center justify-center">

                                      <button title="Show Info Modal" type="button"
                                          class="bg-green-600 text-white flex items-center  font-medium tracking-wider h-8 py-1 px-4 rounded-sm">


                                          {{ $index + 1 }}. Employee No. ({{ $emp->employee_number ?? '' }})
                                      </button>
                                  </div>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="8" style="height: 10px;font-size:10px;"
                              class="bg-gray-300 border border-gray-500 text-gray-800 font-bold text-center">
                              BASIC INFO
                          </td>
                      </tr>

                      <tr class="medium-text">
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Name</td>
                          <td class="px-4 py-2 border border-gray-500" colspan="5">{{ $emp->fname }}
                              {{ $emp->mname }} {{ $emp->lname }} {{ $emp->suffix_name }}</td>

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Employee No.</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->employee_number }}</td>
                      </tr>

                      <tr class="medium-text">

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Sex</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->sex }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Birthdate</td>
                          <td class="px-4 py-2 border border-gray-500">
                              {{ \Carbon\Carbon::parse($emp->birthdate)->format('F j, Y') }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Salary Grade</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->salary_grade }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Employee Title</td>
                          <td class="px-4 py-2 border border-gray-500">{{ optional($emp->positionTitle)->name }}</td>
                      </tr>



                      {{-- ===== LOGIN / EMAIL STATUS ===== --}}
                      <tr>
                          <td colspan="8" style="height: 10px;font-size:10px;"
                              class="bg-gray-300 border border-gray-500 text-gray-800 font-bold text-center">
                              LOGIN / EMAIL STATUS
                          </td>
                      </tr>

                      <tr class="medium-text">

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">DepEd Email</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->deped_email }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">DepEd Email Status</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->deped_email_status }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">M365 Email Status</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->m365_email_status }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">L4NT Recipient</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->l4nt_recipient }}</td>
                      </tr>

                      <tr class="medium-text">

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Canva Login Status</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->canva_login_status }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">LR Portal Status</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->lr_portal_status }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">L4T Recipient</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->l4t_recipient }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Smart TV Recipient</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->smart_tv_recipient }}</td>
                      </tr>

                      {{-- ===== OFFICE / POSITION INFO ===== --}}
                      <tr>
                          <td colspan="8" style="height: 10px;font-size:10px;"
                              class="bg-gray-300 border border-gray-500 text-gray-800 font-bold text-center">
                              OFFICE / POSITION INFO
                          </td>
                      </tr>

                      <tr class="medium-text">

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Personal Email</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->personal_email_address }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">RO Office</td>
                          <td class="px-4 py-2 border border-gray-500">{{ optional($emp->roOffice)->name }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">SDO Office</td>
                          <td class="px-4 py-2 border border-gray-500">{{ optional($emp->sdoOffice)->name }}</td>
                          <td rowspan="2" class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Officer in
                              Charge
                          </td>
                          <td rowspan="2" class="px-4 py-2 border border-gray-500">
                              {{ $emp->officer_in_charge ? 'Yes' : 'No' }}</td>
                      </tr>

                      <tr class="medium-text">

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Position</td>
                          <td class="px-4 py-2 border border-gray-500"> {{ optional($emp->position)->name }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Mobile No 1</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->mobile_no_1 }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Mobile No 2</td>
                          <td colspan="4" class="px-4 py-2 border border-gray-500">{{ $emp->mobile_no_2 }}</td>

                      </tr>

                      {{-- ===== EMPLOYMENT DATES / STATUS ===== --}}
                      <tr>
                          <td colspan="8" style="height: 10px;font-size:10px;"
                              class="bg-gray-300 border border-gray-500 text-gray-800 font-bold text-center">
                              EMPLOYMENT DATES / STATUS
                          </td>
                      </tr>

                      <tr class="medium-text">

                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Date Hired</td>
                          <td class="px-4 py-2 border border-gray-500">
                              {{ \Carbon\Carbon::parse($emp->date_hired)->format('F j, Y') }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Inactive</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->inactive ? 'Yes' : 'No' }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Date of Separation</td>
                          <td class="px-4 py-2 border border-gray-500">{{ $emp->date_of_separation }}</td>
                          <td class="px-4 py-1 bg-gray-100 border border-gray-500 font-semibold">Cause of Separation</td>
                          <td class="px-4 py-2 border border-gray-500">{{ optional($emp->causeOfSeparation)->name }}</td>
                      </tr>

                      {{-- ===== ACTION BUTTONS ===== --}}
                      <tr class="medium-text">

                          <td colspan="8">
                              <div class="mb-5 mt-1 flex flex-row justify-end gap-2">

                                  <div
                                      class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                      <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                          onclick='editModal(@json($emp))'>
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
                                                          stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round">
                                                      </path>
                                                  </g>
                                              </g>
                                          </svg>
                                      </button>
                                  </div>
                                  <div
                                      class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                      <button type="button" title="Remove ISP"
                                          onclick="delete_employee('{{ $emp->pk_schools_employee_id }}')"
                                          class="btn-delete p-1 rounded-full">
                                          <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                              xmlns="http://www.w3.org/2000/svg">
                                              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                  stroke-linejoin="round">
                                              </g>
                                              <g id="SVGRepo_iconCarrier">
                                                  <path
                                                      d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                  </path>
                                              </g>
                                          </svg>
                                      </button>
                                  </div>

                              </div>

                          </td>
                      </tr>

                      {{-- Separator Row --}}
                      <tr>
                          <td colspan="8" class="h-3"></td>
                      </tr>
                  @endforeach
              </table>

          </div>
      </div>
      @include('SchoolSide.Employee.partials._script')
  @endsection

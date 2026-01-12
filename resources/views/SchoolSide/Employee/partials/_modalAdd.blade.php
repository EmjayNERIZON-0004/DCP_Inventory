 <div id="add-employee-modal" class="modal hidden">
     <div class="modal-content super-large-modal thin-scroll">
         <form action="{{ route('schools.employee.store') }}" method="POST">
             @csrf
             @method('POST')
             <div class="flex items-center gap-2">


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

                     <div class="text-2xl font-bold text-gray-700 mt-4">Employee Information</div>
                     <div class="text-md text-gray-600 mb-4">Encode the information needed for the employee</div>
                 </div>
             </div>

             <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mb-4">

                 {{-- Basic Info --}}
                 <div>
                     <label for="fname">First Name <span class="text-red-600">(required)</span></label>
                     <input type="text" name="fname" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="mname">Middle Name</label>
                     <input type="text" name="mname" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="lname">Last Name <span class="text-red-600">(required)</span></label>
                     <input type="text" name="lname" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div>
                     <label for="suffix_name">Suffix</label>
                     <select name="suffix_name" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Sr.">Sr.</option>
                         <option value="Jr.">Jr.</option>
                         <option value="II">II </option>
                         <option value="III">III </option>
                         <option value="IV">IV </option>
                         <option value="V">V </option>
                         <option value="VI">VI </option>
                         <option value="VII">VII </option>
                     </select>
                 </div>
                 <div>
                     <label for="sex">Sex <span class="text-red-600">(required)</span></label>
                     <select name="sex" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="M">Male</option>
                         <option value="F">Female</option>
                     </select>
                 </div>
                 <div>
                     <label for="birthdate">Birthdate <span class="text-red-600">(required)</span></label>
                     <input type="date" name="birthdate" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div>
                     <label for="employee_number">Employee Number <span class="text-red-600">(required)</span></label>
                     <input type="text" name="employee_number"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="position_title_id">Employee Title</label>
                     <select name="position_title_id" class="w-full border border-gray-400 rounded px-2 py-1" required>
                         <option value="">Select</option>
                         @foreach (App\Models\EmployeePosition::all() as $position)
                             <option value="{{ $position->pk_school_position_id }}">{{ $position->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="position_id">Employee Position</label>
                     <select name="position_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpPosition::all() as $position)
                             <option value="{{ $position->id }}">{{ $position->name }}</option>
                         @endforeach
                     </select>
                 </div>

                 <div>
                     <label for="salary_grade">Salary Grade <span class="text-red-600">(required)</span></label>
                     <input type="text" name="salary_grade" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div class="hidden">
                     <label for="school_id">School Designated</label>
                     <input type="text" name="school_id"
                         value="{{ Auth::guard('school')->user()->school->pk_school_id }}" readonly
                         class="w-full border border-gray-400 rounded px-2 py-1 cursor-not-allowed">
                 </div>
                 <div>
                     <label for="deped_email">Deped Email <span class="text-red-600">(required)</span></label>
                     <input type="email" name="deped_email" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div>
                     <label for="deped_email_status">Deped Email Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="deped_email_status" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>
                 <div>
                     <label for="m365_email_status">M365 Email Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="m365_email_status" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>
                 <div>
                     <label for="canva_login_status">Canva Login Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="canva_login_status" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>

                 <div>
                     <label for="lr_portal_status">LR Portal Status <span
                             class="text-red-600">(required)</span></label>
                     <select name="lr_portal_status" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Active">Active</option>
                         <option value="Inactive">Inactive</option>
                     </select>
                 </div>
                 <div>
                     <label for="l4t_recipient">L4T Recipient <span class="text-red-600">(required)</span></label>
                     <select name="l4t_recipient" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>
                 <div>
                     <label for="smart_tv_recipient">Smart TV Recipient <span
                             class="text-red-600">(required)</span></label>
                     <select name="smart_tv_recipient" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>

                 <div>
                     <label for="l4nt_recipient">L4NT Recipient <span class="text-red-600">(required)</span></label>
                     <select name="l4nt_recipient" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>

                 <div>
                     <label for="officer_in_charge">Officer in Charge</label>
                     <select name="officer_in_charge" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="0">No</option>
                         <option value="1">Yes</option>
                     </select>
                 </div>
                 <div>
                     <label for="mobile_no_1">Mobile No 1</label>
                     <input type="text" name="mobile_no_1"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="mobile_no_2">Mobile No 2</label>
                     <input type="text" name="mobile_no_2"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

                 <div>
                     <label for="personal_email_address">Personal Email</label>
                     <input type="email" name="personal_email_address"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="date_hired">Date Hired</label>
                     <input type="date" name="date_hired" class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="inactive">Inactive <span class="text-red-600">(required)</span></label>
                     <select name="inactive" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="0">No</option>
                         <option value="1">Yes</option>
                     </select>
                 </div>

                 <div>
                     <label for="date_of_separation">Date of Separation</label>
                     <input type="date" name="date_of_separation"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="cause_of_separation_id">Cause of Separation</label>
                     <select name="cause_of_separation_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpCauseOfSeparation::all() as $cause)
                             <option value="{{ $cause->id }}">{{ $cause->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="non_deped_fund">Non Deped Fund</label>
                     <select name="non_deped_fund" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         <option value="0">No</option>
                         <option value="1">Yes</option>
                     </select>
                 </div>

                 <div>
                     <label for="sources_of_fund_id">Source of Fund</label>
                     <select name="sources_of_fund_id" class="w-full border border-gray-400 rounded px-2 py-1">
                         <option value="">Select</option>
                         @foreach (App\Models\EmpSourceOfFund::all() as $fund)
                             <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                         @endforeach
                     </select>
                 </div>

                 <div>
                     <label for="detailed_transfer_from">Detailed Transfer From</label>
                     <input type="text" name="detailed_transfer_from"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>
                 <div>
                     <label for="detailed_transfer_to">Detailed Transfer To</label>
                     <input type="text" name="detailed_transfer_to"
                         class="w-full border border-gray-400 rounded px-2 py-1">
                 </div>

             </div>

             <div class="flex gap-2  ">
                 <button type="submit"
                     class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 tracking-wider font-medium rounded shadow">Save
                     Employee</button>
                 <button type="button" onclick="closeModal()"
                     class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 tracking-wider font-medium rounded shadow">Cancel</button>
             </div>
         </form>
     </div>
 </div>

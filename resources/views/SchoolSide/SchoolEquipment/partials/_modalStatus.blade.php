 <div id="show-status-list"
     class="modal inset-0 fixed overflow-y-auto bg-black bg-opacity-40 flex items-center  justify-center z-50 hidden">
     <div class="modal-content bg-white p-4 px-5 my-5 mx-5 rounded-md max-w-xl w-full ">
         <div id="statusForm"></div>
     </div>
 </div>
 <script>
     async function showStatusModal(equipmentId) {
         if (equipmentId) {
             try {
                 const btnStatus = document.getElementById(`btnStatus-${equipmentId}`);
                 btnStatus.innerHTML = `
                        <div class="w-8 h-8  flex items-center justify-center" >
                            <div style="
                            border: 3px solid #fff;       /* White border */
                            border-top: 3px solid transparent; /* Transparent top */
                            border-radius: 50%;
                           height:18px ; width:18px;
                            animation: spin 1s linear infinite;
                            margin: auto;
                        "> 


                        </div>
                            </div>
                    `;
                 const response = await fetch(`/School/school-equipment-status/${equipmentId}`);
                 const res = await response.json();
                 const responseCondition = await fetch('/School/school-equipment-condition');
                 const resCondition = await responseCondition.json();
                 const responseDisposition = await fetch('/School/school-equipment-disposition');
                 const resDisposition = await responseDisposition.json();
                 renderStatusForm(res, resCondition.data, resDisposition.data, equipmentId);
                 document.getElementById('show-status-list').classList.remove('hidden');
                 btnStatus.innerHTML = ` 
                  <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 22 22" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M9.42857143,5.5 C9.42857143,5.02857143 9.74285714,4.71428571 10.2142857,4.71428571 L11.7857143,4.71428571 C12.2571429,4.71428571 12.5714286,5.02857143 12.5714286,5.5 L12.5714286,11.7857143 C12.5714286,12.2571429 12.2571429,12.5714286 11.7857143,12.5714286 L10.2142857,12.5714286 C9.74285714,12.5714286 9.42857143,12.2571429 9.42857143,11.7857143 L9.42857143,5.5 M9.42857143,14.9285714 C9.42857143,14.4571429 9.74285714,14.1428571 10.2142857,14.1428571 L11.7857143,14.1428571 C12.2571429,14.1428571 12.5714286,14.4571429 12.5714286,14.9285714 L12.5714286,16.5 C12.5714286,16.9714286 12.2571429,17.2857143 11.7857143,17.2857143 L10.2142857,17.2857143 C9.74285714,17.2857143 9.42857143,16.9714286 9.42857143,16.5 L9.42857143,14.9285714"
                                            id="Shape"></path>
                                    </g>
                                </svg>`;
             } catch (error) {
                 console.error(error);
             }
         }
     }

     function renderStatusForm(res, condition, disposition, equipmentId) {
         const form = document.getElementById('statusForm');
         const data = res?.data ?? null
         const isUpdate = !!data;

         console.log(isUpdate);
         form.innerHTML = `
                <form class="space-y-6" method="POST" action="${isUpdate ? '/School/school-equipment-status/' + data.id : '/School/school-equipment-status'}">
                    ${isUpdate ? '<input type="hidden" name="_method" value="PUT">' : ''}
                      <div class="flex flex-col items-center justify-center gap-0">
                          <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                 <div class="w-full flex flex-row items-center justify-center">
                     <div
                         class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                         <div class="text-white ${isUpdate ? 'bg-green-600' : 'bg-blue-600'} p-2 rounded-full">
                              <svg fill="currentColor" class="w-10 h-10" viewBox="0 0 22 22" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M9.42857143,5.5 C9.42857143,5.02857143 9.74285714,4.71428571 10.2142857,4.71428571 L11.7857143,4.71428571 C12.2571429,4.71428571 12.5714286,5.02857143 12.5714286,5.5 L12.5714286,11.7857143 C12.5714286,12.2571429 12.2571429,12.5714286 11.7857143,12.5714286 L10.2142857,12.5714286 C9.74285714,12.5714286 9.42857143,12.2571429 9.42857143,11.7857143 L9.42857143,5.5 M9.42857143,14.9285714 C9.42857143,14.4571429 9.74285714,14.1428571 10.2142857,14.1428571 L11.7857143,14.1428571 C12.2571429,14.1428571 12.5714286,14.4571429 12.5714286,14.9285714 L12.5714286,16.5 C12.5714286,16.9714286 12.2571429,17.2857143 11.7857143,17.2857143 L10.2142857,17.2857143 C9.74285714,17.2857143 9.42857143,16.9714286 9.42857143,16.5 L9.42857143,14.9285714"
                                            id="Shape"></path>
                                    </g>
                                </svg>
                         </div>
                     </div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-700">School Equipment Status</div>
                        <div class="text-md text-gray-600 mb-4">Assigning Status to School Equipment</div>
                    </div>
                </div>

                    <input type="hidden" name="school_equipment_id" value="${equipmentId ?? ''}">
                    <input type="hidden" name="id" value="${data?.id ?? ''}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Equipment Condition</label>
                        <select name="equipment_condition_id" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select </option>
                            ${condition.map(cond => `
                                                                            <option value="${cond.id}"
                                                                                ${cond.id === data?.equipment_condition_id ? 'selected' : ''}>
                                                                                ${cond.name}  
                                                                            </option>
                                                                        `).join('')}
                        </select>
                    </div>


                    <div class="flex flex-col">
                        <label class="font-semibold text-gray-700 mb-1">Status Disposition Status</label>
                        <select name="disposition_status_id"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select </option>
                            ${disposition.map(dispo => `
                                                                    <option value="${dispo.id}"
                                                                        ${dispo.id === data?.disposition_status_id ? 'selected' : ''}>
                                                                        ${dispo.name}  
                                                                    </option>
                                                                `).join('')}
                        </select>
                    </div>

                  
                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Warranty Start Date</label>
                            <input type="date" name="start_warranty_date" value="${data?.start_warranty_date ?? ''}"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                    <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Warranty End Date</label>
                            <input type="date" name="end_warranty_date" value="${data?.end_warranty_date ?? ''}"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                     
                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Equipment Location</label>
                            <input type="text" name="equipment_location" value="${data?.equipment_location ?? ''}"  
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div class="flex flex-col">
                            <label class="font-semibold text-gray-700 mb-1">Non Functional</label>
                            <select name="non_functional" required
                                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="" >Select  </option>
                                <option value="1" ${data?.non_functional === 1, 'selected', ''}>Yes</option>
                                <option value="0" ${data?.non_functional === 0, 'selected', ''}>No</option>
                            </select>    
                        </div>
                        </div>
                    <div class="flex md:flex-row flex-col gap-2 my-2 w-full">
                        <button type="submit"
                                class="w-full ${isUpdate ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700'} text-white font-semibold px-4 py-2 rounded transition-colors">
                            ${isUpdate ? 'Update Status' : 'Save Status'}
                        </button>

                        <button type="button" onclick="closeStatusModal()"
                                class="  w-full bg-gray-400 hover:bg-gray-500 text-white font-semibold px-4 py-2 rounded transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            `;

     }

     function closeStatusModal() {
         const modal = document.getElementById('show-status-list');

         modal.classList.add('hidden');
     }
 </script>

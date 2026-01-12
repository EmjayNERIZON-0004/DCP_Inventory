<div id="modal-table-info" class="modal hidden">
    <div class="modal-content super-large-modal thin-scroll">
        <div class="flex flex-col items-center justify-center gap-0">

            <div class="w-full flex flex-row items-center justify-center">
                <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-green-600 p-2 rounded-full">
                        <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                            </g>
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
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-700  ">Additional Information for Internet Service</div>
                <div class="text-base text-green-600 mb-4">Information of School's Internet</div>
            </div>
        </div>
        <div id="infoTable"></div>
    </div>
</div>
<script>
    async function showTableInfo(school_internet_id) {
        const response = await fetch('/School/ISP-Info/' + school_internet_id);
        const res = await response.json();
        console.log(res.data);
        renderInfoTable(res.data);
        document.getElementById('school_internet_id').value = school_internet_id;
        document.getElementById('modal-table-info').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function renderInfoTable(data) {
        const tableContainer = document.getElementById('infoTable');
        tableContainer.innerHTML = '';
        const table = document.createElement('table');

        const tbody = document.createElement('tbody');
        table.classList.add('table', 'w-full', 'border-collapse');
        tbody.innerHTML = `
            <tr>
                <td class="bg-green-600 td-cell text-white text-lg font-medium tracking-wider text-center" colspan="6">
                         Internet Service Provider Information   
             
                    </td>
                </tr>
                
                
                  <tr>
                    <td class="bg-gray-100 td-cell"  >
                    ISP Account Number
                    </td>
                <td class=" td-cell" >
                    ${data[0].account_number ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                   Cost Per Month
                    </td>
                <td class=" td-cell" >
                    ${data[0].cost_per_month ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                    ISP Account Number
                    </td>
                <td class=" td-cell" >
                    ${data[0].subscription_type ?? ''}
                    </td>
                </tr>
                
                   <tr>
                    <td class="bg-gray-100 td-cell"  >
                    Description
                    </td>
                <td class=" td-cell" >
                    ${data[0].description ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                   Start of Contract
                    </td>
                <td class=" td-cell" >
                    ${data[0].contract_start ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                    End Of Contract
                    </td>
                <td class=" td-cell" >
                    ${data[0].contract_end ?? ''}
                    </td>
                </tr>

                     <tr>
                    <td class="bg-gray-100 td-cell"  >
                   Is Contract Inactive/Ended ?
                    </td>
                <td class=" td-cell" >
                    ${data[0].inactive_contract ? 'Yes' : 'No'}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                   Mode of Acquisition
                    </td>
                <td class=" td-cell" >
                    ${data[0].mode_of_acq?.name ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                    Source of Acquisition
                    </td>
                <td class=" td-cell" >
                    ${data[0].source_of_acq?.name ?? ''}
                    </td>
                </tr>

                  <tr>
                    <td class="bg-gray-100 td-cell"  >
                   Donor Name
                    </td>
                <td class=" td-cell" >
                    ${data[0].donor ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                   Mode of Acquisition
                    </td>
                <td class=" td-cell" >
                    ${data[0].source_of_fund?.name ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                    Total Number of Access Points
                    </td>
                <td class=" td-cell" >
                    ${data[0].total_no_access_points ?? ''}
                    </td>
                </tr>

                   <tr>
                    <td class="bg-gray-100 td-cell"  >
                   Location of Access Points
                    </td>
                <td class=" td-cell" >
                    ${data[0].location_of_access_points ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                  Number of Admin Area Rooms covered by ISP
                    </td>
                <td class=" td-cell" >
                    ${data[0].total_admin_area_isps ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                   ISP Rating for Admin Area Covered  
                    </td>
                <td class=" td-cell" >
                
                    ${data[0].admin_area_rate?.name ?? ''}
                    </td>
                </tr>


                  <tr>
                    <td class="bg-gray-100 td-cell"  >
                  Total Classrooms Covered by ISP
                    </td>
                <td class=" td-cell" >
                    ${data[0].total_classroom_isps ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                  Number of Admin Area Rooms covered by ISP
                    </td>
                <td class=" td-cell" >
                    ${data[0].classroom_area_rate?.name ?? ''}
                    </td>
                     <td class="bg-gray-100 td-cell"  >
                   Overall Rating for ISP
                    </td>
                <td class=" td-cell" >
                
                    ${data[0].rate ? data[0].rate + ' star'  : ''}
                    </td>
                </tr>


                <tr>
                    <div class="flex justify-start my-2">
                    <div class="flex justify-start ">
                        <div
                            class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                            <button title="Show Edit Modal" type="button" onclick='showEditInfoModal(${data[0].id},${data[0].school_internet_id},${JSON.stringify(data[0])})'  
                                class="btn-green whitespace-nowrap h-8 py-1 px-4 rounded-full">
                                Edit Information
                            </button>
                        </div>
                    </div>

                       <div class="flex justify-start  ">
                        <div
                            class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                            <button title="Close" type="button" onclick="document.getElementById('modal-table-info').classList.add('hidden');document.body.classList.remove('overflow-hidden');"  
                                class="btn-cancel h-8 py-1 px-4 rounded-full">
                               Close
                            </button>
                        </div>
                    </div>
                    </div>
                    </tr>
                `;



        table.appendChild(tbody);
        tableContainer.appendChild(table);


    }
</script>

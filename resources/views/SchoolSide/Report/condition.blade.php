@extends('layout.SchoolSideLayout')

<title>@yield('title', 'School Report')</title>

@section('content')
    <style>
        @media print {
            thead tr th {
                background-color: #eeeeee !important;
                /* Blue background */
                border: 1px solid #cecece !important;
                color: #303030 !important;
                /* White text */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
    <div class="bg-white border border-gray-300 shadow-md">
        <div class="p-4">
            <h1 class="text-2xl font-semibold text-blue-700 mb-4">DCP Condition Report</h1>
            <p class="mb-2">View and submit condition reports for your DCP equipment.</p>
            <div>
                <select name="" id="condition_id" class="border border-gray-300 py-1 px-4">
                    <option value="">Select Condition</option>
                    @php
                        $conditions = App\Models\DCPCurrentCondition::all();
                        foreach ($conditions as $index => $condition) {
                            echo '<option value="' .
                                $condition->pk_dcp_current_conditions_id .
                                '">' .
                                $condition->name .
                                '</option>';
                        }
                    @endphp

                </select>
                <button onclick="getConditionReport()" class="bg-blue-600 px-4 py-1 rounded-md shadow-md text-white">Load
                    Report</button>
            </div>
        </div>

    </div>
    <div class="  mx-5">
        <button class="bg-blue-600 my-2 text-white px-4 py-2 rounded-md hover:bg-blue-700"
            onclick="printDiv('printArea')">Print
            Report</button>
    </div>
    <div id="printArea" class="mx-5 my-2 hidden bg-white border border-gray-300 px-4 py-2">
        @include('SchoolSide.Report.includes.report-header')
        <div id="report-container" class="flex flex-col justify-center px-2">
        </div>


    </div>

    <script>
        async function getConditionReport() {
            const id = document.getElementById('condition_id').value;
            const response = await fetch('/School/Report/api/condition/' + id);
            const res = await response.json();
            const data = res.data;
            const printArea = document.getElementById('printArea');
            const printContainer = document.getElementById('report-container');
            printContainer.innerHTML = '';
            printArea.classList.remove('hidden');
            const content = document.createElement('div');
            const overview = document.createElement('div');
            overview.innerHTML = `
            Overview for Items in Condition: ${res.current_condition}
            `;
            overview.classList.add('text-xl', 'font-bold', 'text-gray-800', 'w-full', 'text-left', 'mb-2');
            content.appendChild(overview);
            const tableSummary = document.createElement('table');
            tableSummary.classList.add('w-full', 'table-auto', 'border-collapse', 'mb-5');
            const thead = document.createElement('thead');
            thead.innerHTML = `
                <tr>
                    <th class="px-3 py-2 border w-1/4 font-semibold bg-gray-100">Batch</th>
                    <th class="px-3 py-2 border w-1/4 font-semibold bg-gray-100">Total Item ( ${res.current_condition} )</th> 

                    </tr>
                `;
            tableSummary.appendChild(thead);

            const tbody = document.createElement('tbody');
            data.forEach((item, index) => {
                tbody.innerHTML += `  
                <tr>
                <td class="px-3 py-2 border">${item.batch_label}</td>
                <td class="px-3 py-2 border">${item.dcp_batch_items.length}</td>
                </tr>

                `;
            });

            tableSummary.appendChild(tbody);

            content.appendChild(tableSummary);
            const listOverview = document.createElement('div');
            listOverview.innerHTML = `
            List of Batch Items
            `;
            listOverview.classList.add('text-xl', 'font-bold', 'text-gray-800', 'w-full', 'text-left', 'mb-2');
            content.appendChild(listOverview);
            const divContainer2 = document.createElement('div');
            data.forEach((item, index) => {
                const headerDiv = document.createElement('div');
                headerDiv.innerHTML =
                    `
                <div class="text-lg font-semibold text-gray-800 w-full text-left mb-2">
                   ${index + 1}. ${item.batch_label}
                    </div>
                `;
                divContainer2.appendChild(headerDiv);
                const table = document.createElement('table');
                const thead = document.createElement('thead');
                thead.innerHTML = `
                    <tr>
                    <th class="px-3 py-2 border   font-semibold bg-gray-100">No.</th>
                    <th class="px-3 py-2 border   font-semibold bg-gray-100">Item</th>
                    <th class="px-3 py-2 border   font-semibold bg-gray-100">Code</th>
                    <th class="px-3 py-2 border  font-semibold bg-gray-100">Unit Price</th>
                    <th class="px-3 py-2 border  font-semibold bg-gray-100">Unit</th>
                    <th class="px-3 py-2 border   font-semibold bg-gray-100">Brand/Model</th>
                    <th class="px-3 py-2 border  font-semibold bg-gray-100">Serial Number</th>
 
                    </tr>
                `;
                table.appendChild(thead);
                const tbody = document.createElement('tbody');
                if (item.dcp_batch_items && item.dcp_batch_items.length > 0) {
                    item.dcp_batch_items?.forEach((batchItem, index) => {
                        const tr = document.createElement('tr');

                        tr.innerHTML = `
                    <td class="px-4 py-1 text-center border border-gray-300">
                        ${index + 1}
                    </td>  
                     <td class="px-4 py-1 border border-gray-300">
                        ${batchItem.dcp_item_type?.name ?? 'N/A'}
                    </td> 
                     <td class="px-4 py-1 border border-gray-300">
                        ${batchItem.generated_code ?? 'N/A'}
                    </td> 
                     <td class="px-4 py-1 border border-gray-300">
                        ${batchItem.unit_price ?? 'N/A'}
                    </td>
                     <td class="px-4 py-1 border border-gray-300">
                        ${batchItem.unit ?? 'N/A'}
                    </td>
                       <td class="px-4 py-1 border border-gray-300">
                        ${batchItem.brand_details?.brand_name ?? 'N/A'}
                    </td>
                     </td>
                       <td class="px-4 py-1 border border-gray-300">
                        ${batchItem.serial_number ?? 'N/A'}
                    </td>
                `;

                        tbody.appendChild(tr);
                    });
                } else {
                    // If there are no items, maybe show a placeholder row
                    const emptyRow = `
                    <tr>
                        <td colspan="7">
                            <div class="px-4 py-1 border border-gray-300 text-gray-500 text-center">
                                No Item Found for ${res.current_condition} 
                            </div>
                        </td>
                    </tr>
                `;
                    tbody.insertAdjacentHTML('beforeend', emptyRow);

                }

                table.appendChild(tbody);
                table.classList.add('w-full', 'table-auto', 'border-collapse', 'mb-5');
                divContainer2.appendChild(table);
            });
            content.appendChild(divContainer2);

            console.log(data);
            printContainer.appendChild(content);
        }

        function printDiv(divId) {
            let printContents = document.getElementById(divId).innerHTML;
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection

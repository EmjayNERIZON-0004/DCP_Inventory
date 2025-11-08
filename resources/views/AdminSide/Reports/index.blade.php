@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        /* Show everything normally on screen */
        @media screen {
            #displayResult {
                padding: 10px;
            }
        }

        /* Print styling */
        @media print {
            body * {
                visibility: hidden;
                /* hide everything */
            }

            th {
                text-align: center;
                background-color: #f3f4f6 !important;
                /* matches Tailwind bg-gray-100 */
                font-weight: bold !important;
                -webkit-print-color-adjust: exact !important;
                /* ensures color prints */
                print-color-adjust: exact !important;
            }

            /* Total row styling */
            .total-row {
                background-color: #f3f4f6 !important;
                /* same gray background */
                font-weight: bold !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            #displayResult,
            #displayResult * {
                visibility: visible;
                /* only show this section */
            }

            #displayResult {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
    <style>
        /* Spinner styling */
        .loader {
            border: 4px solid #e5e7eb;
            /* light gray */
            border-top: 4px solid #2563eb;
            /* blue */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="bg-white mx-5 my-5 p-4 border border-gray-300 shadow-md">
        <button onclick="window.print()" class="bg-blue-500 px-4 py-1 rounded-sm shadow-md text-white font-semibold">Generate
            Report</button>
        <div id="spinner">
            <div class="loader"></div>
        </div>
        <div id="displayResult">

        </div>

    </div>
    <script>
        async function getReport() {
            const spinner = document.getElementById('spinner');

            try {
                const res = await fetch('/Admin/api/Reports');
                if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
                const response = await res.json();

                const outerDiv = document.getElementById("displayResult");
                const headerDiv = document.createElement('div');
                headerDiv.classList.add('text-center', 'mb-6');
                headerDiv.innerHTML = `
                <h2 class="text-2xl font-bold text-gray-800">
                    DepEd Computerization Program Report
                </h2>
                <span class="text-sm text-gray-500 font-semibold">
                    Generated on: ${new Date().toLocaleString()}
                </span>`;
                outerDiv.appendChild(headerDiv);

                // 🔤 Sort alphabetically by SchoolName
                const sortedSchools = response.data.sort((a, b) =>
                    a.SchoolName.localeCompare(b.SchoolName)
                );

                let school_index = 1;
                sortedSchools.forEach(school => {
                    const schoolTitle = document.createElement('h2');
                    schoolTitle.textContent = `${school_index++}. ${school.SchoolName} - ${school.SchoolLevel}`;
                    schoolTitle.classList.add('text-lg', 'font-bold', 'mt-6', 'mb-3', 'text-gray-800');
                    schoolTitle.style.borderBottom = "2px solid #333";
                    outerDiv.appendChild(schoolTitle);

                    // 🏫 If the school has no batches
                    if (!school.dcpBatches || school.dcpBatches.length === 0) {
                        const noBatchMsg = document.createElement('p');
                        noBatchMsg.textContent = "No DCP Batches found for this school.";
                        noBatchMsg.classList.add('text-gray-500', 'mb-4', 'ml-4');
                        outerDiv.appendChild(noBatchMsg);
                        return;
                    }

                    // 🔁 Loop through each batch
                    const sortedBatches = (school.dcpBatches || []).sort((a, b) => {
                        return new Date(b.delivery_date) - new Date(a.delivery_date);
                    });

                    sortedBatches.forEach((batch, batch_index) => {

                        const title = document.createElement('h4');
                        title.classList.add('font-semibold', 'text-base', 'mb-2', 'ml-2');
                        title.textContent =
                            `${batch_index + 1}. Batch: ${batch.batch_label}`;
                        outerDiv.appendChild(title);

                        const table = document.createElement('table');
                        table.classList.add('border', 'border-gray-300', 'w-full', 'mb-3',
                            'text-sm');

                        const thead = document.createElement('thead');
                        thead.innerHTML = `
                    <tr class="bg-gray-100 font-semibold">
                        <th class="border border-gray-300 px-2 py-1">No.</th>
                        <th class="border border-gray-300 px-2 py-1">Item Type</th>
                        <th class="border border-gray-300 px-2 py-1">Unit Price</th>
                        <th class="border border-gray-300 px-2 py-1">Total Cost</th>
                        <th class="border border-gray-300 px-2 py-1">Functional</th>
                    </tr>`;
                        table.appendChild(thead);

                        const tbody = document.createElement('tbody');
                        let grandTotalCost = 0,
                            grandTotalFunctional = 0,
                            grandTotalItems = 0;
                        let index = 1;

                        for (const itemType in batch.grouped_items) {
                            const items = batch.grouped_items[itemType];
                            let unitPrice = 0,
                                totalCost = 0,
                                totalFunctional = 0;
                            const totalItems = items.length;

                            items.forEach(item => {
                                const price = parseFloat(item.unit_price) || 0;
                                unitPrice = price;
                                totalCost += price;
                                grandTotalCost += price;
                                if (item.item_status == 1) totalFunctional++;
                            });

                            grandTotalFunctional += totalFunctional;
                            grandTotalItems += totalItems;
                            const functionalRate = Math.round((totalFunctional /
                                totalItems) * 100);

                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                    <td class="border border-gray-300 px-2 py-1 text-center">${index++}</td>
                    <td class="border border-gray-300 px-2 py-1">${itemType}</td>
                    <td class="border border-gray-300 px-2 py-1 text-right">₱${unitPrice.toLocaleString()}</td>
                    <td class="border border-gray-300 px-2 py-1 text-right">₱${totalCost.toLocaleString()}</td>
                    <td class="border border-gray-300 px-2 py-1 text-center">
                        ${totalFunctional} / ${totalItems} (${functionalRate}%)
                    </td>`;
                            tbody.appendChild(tr);
                        }

                        if (grandTotalItems !== 0) {
                            const grandTotalRate = Math.round((grandTotalFunctional /
                                    grandTotalItems) *
                                100);
                            const totalRow = document.createElement('tr');
                            totalRow.classList.add('font-bold', 'bg-gray-100');
                            totalRow.innerHTML = `
                    <td colspan="3" class="border border-gray-300 px-2 py-1 text-right">TOTAL</td>
                    <td class="border border-gray-300 px-2 py-1 text-right">
                        ₱${grandTotalCost.toLocaleString()}
                    </td>
                    <td class="border border-gray-300 px-2 py-1 text-center">
                        ${grandTotalFunctional} / ${grandTotalItems} (${grandTotalRate}%)
                    </td>`;
                            tbody.appendChild(totalRow);
                        }

                        table.appendChild(tbody);
                        outerDiv.appendChild(table);
                    });
                });

                // Footer (prepared by / noted by)
                const bottomDiv = document.createElement('div');
                bottomDiv.innerHTML = `
                    <div class="grid grid-cols-1 gap-4 mt-8">
                        <div class="text-md">Prepared By:</div>
                        <div class="text-center mt-2 font-semibold">NORMAN A. FLORES</div>
                        <div class="text-sm border-t-2 border-gray-900 mx-auto w-64"></div>
                        <div class="text-md text-center">Information Technology Officer I</div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mt-8">
                        <div class="text-md text-center">Noted:</div>
                        <div class="text-md text-center mt-2 font-semibold">DIOSDADO I. CAYABYAB, CESO VI</div>
                        <div class="text-sm border-t-2 border-gray-900 mx-auto w-80"></div>
                        <div class="text-md text-center">Schools Division Superintendent</div>
                    </div>`;
                outerDiv.appendChild(bottomDiv);

                spinner.classList.add('hidden');
            } catch (error) {
                console.error('Error fetching report:', error);
                document.getElementById('displayResult').innerText = 'Failed to load report.';
                document.getElementById('spinner').classList.add('hidden');
            }


        }
        document.addEventListener('DOMContentLoaded', function() {
            getReport();
        });
    </script>
@endsection

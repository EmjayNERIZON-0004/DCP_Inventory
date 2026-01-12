<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let delayTimer;
    $('#searchBatchItem').on('keyup', function() {
        clearTimeout(delayTimer);
        const keyword = $(this).val();

        delayTimer = setTimeout(() => {
            $.ajax({
                url: '/School/batch-items/search',
                type: 'GET',
                data: {
                    query: keyword
                },
                success: function(data) {
                    let rows = '';
                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            rows += `                                    <tr>
                            <td class="px-2 py-2 border bg-gray-300 text-center border-gray-500">${index + 1}</td>
                            <td class="px-4 py-2 border border-gray-300">${item.generated_code}</td>
                            <td class="px-4 py-2 md:w-fit border border-gray-300">${item.batch_label}</td>
                            <td class="px-4 py-2 border border-gray-300">${item.item_name}</td>
                            <td class="px-4 py-2 border border-gray-300">${item.the_brand ?? ""}</td>
                            <td class="px-4 py-2 w-fit border border-gray-300">
                                <div class="flex flex-row justify-center">
                                <a href="/School/DCPInventory/${item.generated_code}" >
                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                        <button title="Insert Area" class="  btn-submit  p-1 rounded-full">
                                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M1.5 12c0-2.25 3.75-7.5 10.5-7.5S22.5 9.75 22.5 12s-3.75 7.5-10.5 7.5S1.5 14.25 1.5 12zM12 16.75a4.75 4.75 0 1 0 0-9.5 4.75 4.75 0 0 0 0 9.5zM14.7 12a2.7 2.7 0 1 1-5.4 0 2.7 2.7 0 0 1 5.4 0z"
                                                        fill="currentColor"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    </a>
                                    </div>
                            </td>
                        </tr>              `;
                        });
                    } else {
                        rows =
                            `<tr><td colspan="6" class="text-center py-4 text-gray-500">No results found.</td></tr>`;
                    }

                    $('#batchItemsTableBody').html(rows);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }, 300); // delay of 300ms
    });
</script>

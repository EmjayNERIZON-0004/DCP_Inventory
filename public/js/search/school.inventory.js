let delayTimer;
$('#searchBatchItem').on('keyup', function () {
    clearTimeout(delayTimer);
    const keyword = $(this).val();

    delayTimer = setTimeout(() => {
        $.ajax({
            url: '/School/batch-items/search',
            type: 'GET',
            data: { query: keyword },
            success: function (data) {
                let rows = '';
                if (data.length > 0) {
                    data.forEach(item => {
                        rows += `
                           <tr>
    <td class="px-4 py-2 border border-gray-300">${item.generated_code}</td>
    
    <td class="px-4 py-2 w-fit border border-gray-300">
        <a href="/School/dcp-batch/${item.pk_dcp_batch_items_id}/warranty" 
           class="text-gray-800 bg-green-200 rounded whitespace-nowrap py-1 px-2  hover:bg-green-600 hover:text-white border border-gray-800">
           Show Warranty
        </a>
    </td>
    
    <td class="px-4 py-2 md:w-fit border border-gray-300">${item.batch_label}</td>
    
    <td class="px-4 py-2 border border-gray-300">${item.item_name}</td>
    
    <td class="px-4 py-2 border border-gray-300">${item.brand ?? ""}</td>
    
    <td class="px-4 py-2 w-fit border border-gray-300">
        <a href="/School/DCPInventory/${item.generated_code}" 
         
           class="text-md  bg-blue-200   text-gray-800 border border-gray-800 px-2 py-1 hover:bg-blue-600 rounded hover:text-white  ">
           Show More
        </a>
    </td>
    
       
</tr>
                        `;
                    });
                } else {
                    rows = `<tr><td colspan="6" class="text-center py-4 text-gray-500">No results found.</td></tr>`;
                }

                $('#batchItemsTableBody').html(rows);
            }, error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }, 300); // delay of 300ms
});

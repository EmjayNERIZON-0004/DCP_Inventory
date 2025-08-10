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
           class="text-green-600 rounded whitespace-nowrap py-1 underline hover:text-green-700">
           Show Status
        </a>
    </td>
    
    <td class="px-4 py-2 md:w-fit border border-gray-300">${item.batch_label}</td>
    
    <td class="px-4 py-2 border border-gray-300">${item.item_name}</td>
    
    <td class="px-4 py-2 border border-gray-300">${item.brand ?? ""}</td>
    
    <td class="px-4 py-2 w-fit border border-gray-300">
        <a href="/School/DCPInventory/${item.generated_code}" 
           style="font-size:16px"
           class="text-xs font-semibold text-blue-500 rounded hover:text-blue-600 underline">
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

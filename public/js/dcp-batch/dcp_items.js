    
   document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('add_item_form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                const formData = new FormData(form);
                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            form.reset();
                            const resultDiv = document.getElementById('result');
                            const resultMsg = document.getElementById('result-message');
                            resultMsg.innerText = "Item added successfully!";
                            resultDiv.classList.remove('hidden');
                            // Refresh the table

                            refreshItemsTable(data.pk_dcp_batch_id);
                        } else {
                            alert('Error adding item: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        function refreshItemsTable(batchId) {
            fetch(`/Admin/DCPBatch/${batchId}/items/json`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#table_item tbody');
                    tbody.innerHTML = '';

                    // Group items by item_type_id
                    const grouped = {};
                    data.items.forEach(item => {
                        if (!grouped[item.item_type_id]) {
                            grouped[item.item_type_id] = [];
                        }
                        grouped[item.item_type_id].push(item);
                    });

                    // You may need a mapping of item_type_id to name (from PHP or via AJAX)
                    // For demo, let's assume you have a JS object like:
                    // const itemTypeNames = {1: 'Laptop', 2: 'Tablet', ...};
                    // You can render this from PHP as a JS variable if needed.
                    const itemTypeNames = window.itemTypeNames || {};

                    // Render grouped rows
                    Object.keys(grouped).forEach(typeId => {
                        // Group header row
                        const groupRow = document.createElement('tr');
                        groupRow.className = 'bg-blue-100';
                        groupRow.innerHTML = `
                        <td colspan="7" class="font-bold text-blue-900 px-4 py-2">
                            ${itemTypeNames[typeId] || typeId}
                        </td>
                    `;
                        tbody.appendChild(groupRow);

                        // Group items
                        grouped[typeId].forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td class="px-4 py-3 border-r border-gray-200"></td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.generated_code}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.quantity}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.unit}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.condition_name ?? '--'}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.brand ?? '--'}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${item.serial_number ?? '--'}</td>
                        `;
                            tbody.appendChild(row);
                        });
                    });
                });
        }



            function clearContent(batchId) {
                if (confirm("Are you sure you want to clear the content?")) {
                    fetch(`/Admin/DCPBatch/${batchId}/items/clear`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Content cleared successfully!');
                                refreshItemsTable(batchId);
                            } else {
                                alert('Error clearing content: ' + data.message);
                            }
                        })

                }
            }
     
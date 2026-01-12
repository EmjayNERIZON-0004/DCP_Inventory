   <script>
       function openModal() {
           document.getElementById('add-modal').classList.remove('hidden');

       }

       function editModal(pk_non_dcp_item_id, item_description, unit_price, date_acquired, total_item,
           total_functional, fund_source_id, item_holder_and_location, remarks) {

           console.log(pk_non_dcp_item_id, item_description, unit_price, date_acquired, total_item, );
           document.getElementById('edit-modal').classList.remove('hidden');
           document.getElementById('pk_non_dcp_item_id').value = pk_non_dcp_item_id;
           document.getElementById('item_description').value = item_description;
           document.getElementById('unit_price').value = unit_price;
           document.getElementById('date_acquired').value = date_acquired;
           document.getElementById('total_item').value = total_item;
           document.getElementById('total_functional').value = total_functional;
           document.getElementById('fund_source_id').value = fund_source_id;
           document.getElementById('item_holder_and_location').value = item_holder_and_location;
           document.getElementById('remarks').value = remarks;

       }

       function deleteItem(pk_non_dcp_item_id) {

           if (confirm("Are you sure you want to delete this item?")) {
               $.ajax({
                   url: "{{ url('School/NonDCPItem/delete') }}/" + pk_non_dcp_item_id,
                   type: "DELETE",
                   data: {
                       _token: "{{ csrf_token() }}", // ✅ important for Laravel
                       pk_non_dcp_item_id: pk_non_dcp_item_id
                   },
                   success: function(data) {
                       location.reload();
                   },
                   error: function(xhr) {
                       console.error(xhr.responseText);
                       alert("Failed to delete item.");
                   }
               });
           }
       }
   </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

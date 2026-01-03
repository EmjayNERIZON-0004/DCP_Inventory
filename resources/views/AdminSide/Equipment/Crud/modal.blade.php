 <form id="delete-form" method="POST" style="display:none;">
     @csrf
     @method('DELETE')
 </form>
 <div id="overall-modal" class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
     <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md md:w-1/4 w-full">
         <form id="modal-form" class="  mt-2" method="POST">
             @csrf
             @method('POST')
             <div class="text-2xl font-bold text-gray-700 w-full   " id="modal-title"></div>
             <div class="text-lg font-normal text-gray-600 w-full  " id="modal-subtitle"></div>
             <input type="hidden" name="target" id="target">
             <div>

                 <input class="w-full border border-gray-400 rounded py-1 px-3 my-1" type="text" name="name"
                     id="name">
             </div>
             <div class="flex flex-row w-full gap-2">

                 <button type="submit" class=" w-full bg-blue-600 text-white px-4 py-1 rounded-sm">Save</button>
                 <button type="button" onclick="closeModal()"
                     class="w-full bg-gray-400 text-white px-4 py-1 rounded-sm">Cancel</button>
             </div>

         </form>
     </div>
 </div>

 <div id="edit-overall-modal"
     class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
     <div class="modal-content bg-white px-4 py-1 mx-5 rounded-md md:w-1/4 w-full">
         <form id="edit-modal-form" class="  mt-2" method="POST">
             @csrf
             @method('PUT')
             <div class="text-2xl font-bold text-gray-700 w-full   " id="edit-modal-title"></div>
             <div class="text-lg font-normal text-gray-600 w-full  " id="edit-modal-subtitle"></div>
             <input type="hidden" name="target" id="edit_target">
             <div>
                 <input type="hidden" name="id" id="edit_id">
                 <input class="w-full border border-gray-400 rounded py-1 px-3 my-1" type="text" name="name"
                     id="edit_name">
             </div>
             <div class="flex flex-row w-full gap-2">

                 <button type="submit"
                     class=" w-full bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded-sm">Update</button>
                 <button type="button" onclick="closeEditModal()"
                     class="w-full bg-gray-400 text-white px-4 py-1 rounded-sm">Cancel</button>
             </div>

         </form>
     </div>
 </div>

  <div id="insert_area_modal" class="modal hidden">
      <div class="modal-content small-modal">
          <form action="{{ route('schools.isp.add.area') }}" class="mt-2" method="POST">
              @csrf
              @method('POST')
              <div class="flex flex-col items-center justify-center gap-0">

                  <div class="w-full flex flex-row items-center justify-center">
                      <div
                          class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                          <div class="text-white bg-blue-600 p-2 rounded-full">
                              <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
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
                      <div class="text-2xl font-bold text-gray-700  ">ISP Area/Location</div>
                      <div class="text-base text-blue-600 mb-4">Add New Area</div>
                  </div>
              </div>
              <input type="hidden" name="insert_isp_details_id" id="insert_isp_details_id">
              <div class="mb-2">
                  <label for="insert_isp_area_available_id">ISP Area of Connection</label>
                  <select class="border border-gray-400 rounded-md py-1 px-2 w-full" required
                      name="insert_isp_area_available_id" id="insert_isp_area_available_id">
                      @php
                          $isp_area = App\Models\ISP\ISPAreaAvailable::all();

                      @endphp
                      <option value="">Select Area</option>
                      @foreach ($isp_area as $area)
                          <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="flex flex-row gap-2">

                  <div class="w-full">
                      <div
                          class="h-10 w-full bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                          <button title="Show Edit Modal" type="submit"
                              class="btn-submit w-full whitespace-nowrap h-8 py-1 px-4 rounded-full">
                              Save Area
                          </button>
                      </div>
                  </div>
                  <div class="  w-full ">
                      <div
                          class="h-10 w-full bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                          <button title="Show Edit Modal" type="button" onclick="closeInsertAreaModal(1)"
                              class="btn-cancel whitespace-nowrap w-full h-8 py-1 px-4 rounded-full">
                              Cancel
                          </button>
                      </div>
                  </div>

              </div>
          </form>
      </div>
  </div>
  <div id="edit_area_modal" class="modal hidden">
      <div class="modal-content small-modal">
          <form action="{{ route('schools.isp.update.area') }}" class="mt-2" method="POST">
              @csrf
              @method('PUT')
              <div class="flex flex-col items-center justify-center gap-0">

                  <div class="w-full flex flex-row items-center justify-center">
                      <div
                          class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                          <div class="text-white bg-green-600 p-2 rounded-full">
                              <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
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
                      <div class="text-2xl font-bold text-gray-700  ">ISP Area/Location</div>
                      <div class="text-base text-green-600 mb-4">Edit/Update</div>
                  </div>
              </div>

              <div class="mb-2">
                  <input type="hidden" id="old_isp_area_id" name="old_isp_area_id">
                  <input type="hidden" id="isp_details_id" name="isp_details_id">
                  <label for="isp_area">ISP Area of Connection</label>
                  <select class="border border-gray-400 px-2 py-1 w-full rounded-sm" required
                      name="isp_area_available_id" id="isp_area_available_id">
                      <option value="" selected>Select area</option>
                      @php
                          $isp_area = App\Models\ISP\ISPAreaAvailable::all();
                      @endphp
                      @foreach ($isp_area as $area)
                          <option value="{{ $area->pk_isp_area_available_id }}">{{ $area->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
              <div class="flex flex-row gap-2">
                  <div class="w-full">
                      <div
                          class="h-10 w-full bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                          <button title="Show Edit Modal" type="submit"
                              class="btn-green w-full whitespace-nowrap h-8 py-1 px-4 rounded-full">
                              Update Area
                          </button>
                      </div>
                  </div>
                  <div class="  w-full ">
                      <div
                          class="h-10 w-full bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                          <button title="Show Edit Modal" type="button" onclick="closeEditAreaModal()"
                              class="btn-cancel whitespace-nowrap w-full h-8 py-1 px-4 rounded-full">
                              Cancel
                          </button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>

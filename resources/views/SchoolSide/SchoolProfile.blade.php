@extends('layout.SchoolSideLayout')

@section('title', 'School Profile')

@section('content')





    <!-- Main Content -->
    <main class="flex-grow justify-center px-5" style=" font-family:Verdana, Geneva, Tahoma, sans-serif">
        <div class="max-w-full   shadow-lg  mt-8">
            <div style="border:1px solid #ccc"
                class="bg-white rounded-md   overflow-hidden p-6 flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Logo and School Name (Left) -->
                <div class="flex flex-col items-center md:items-start">
                    <img class="w-40 h-40 max-w-full rounded-full object-cover shadow-lg mb-0" style="border: 1px solid #ccc;"
                        src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        alt="Profile Photo">
                    <h2 class="text-2xl font-bold text-gray-800 mt-2 mb-1 md:text-left text-center">
                        {{ Auth::guard('school')->user()->school->SchoolName }}</h2>
                    <div class="text-gray-600 text-sm mb-2">School ID: <span
                            class="font-semibold">{{ Auth::guard('school')->user()->school->SchoolID }}</span></div>
                    <div class="text-gray-600 text-sm mb-2">Level: <span
                            class="font-semibold">{{ Auth::guard('school')->user()->school->SchoolLevel }}</span></div>
                    <div
                        class="text-blue-600 flex flex-col items-center md:flex-row md:justify-center md:items-center   space-y-1 md:space-y-0 md:space-x-1">
                        <a href="#school_info" class="text-blue-600 hover:text-blue-800 underline">School Info</a>
                        <span class="hidden md:inline">|</span>
                        <a href="#school_officials" class="text-blue-600 hover:text-blue-800 underline">School Officials</a>
                        <span class="hidden md:inline">|</span>
                        <a href="#school_others" class="text-blue-600 hover:text-blue-800 underline">Other Details</a>
                    </div>


                </div>
                <!-- Map and location (Right) -->
                <div class="flex flex-col items-center md:items-end justify-start" style="min-width: 240px;">
                    <div id="school-map"
                        style="width: 220px; height: 180px; border-radius: 8px; border: 1px solid #e5e7eb;"></div>
                    <div id="location-name" class="mt-2 text-sm text-gray-700 text-right w-full"></div>
                </div>
            </div>
        </div>
        <!-- <div class="bg-white shadow-sm border-b border-gray-200">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="flex justify-between items-center py-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <h2 class="text-lg font-semibold text-gray-900">School Dashboard</h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="text-sm text-gray-500">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span id="last-updated">Last updated: Jun 24, 2025 at 9:19 PM</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div> -->

        <div class="max-w-full  py-6   sm:px-0 lg:px-0 pt-0" style=" font-family:Verdana, Geneva, Tahoma, sans-serif">
            @if (Auth::guard('school')->user() && Auth::guard('school')->user()->school)

                <!-- Additional School Info Container -->
                <div id="school_info" style="border:1px solid #ccc"
                    class="bg-white rounded-md shadow-md overflow-hidden p-6 mt-6">
                    <!-- File upload for logo -->
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold text-blue-700 mb-4">School Information</h3>
                        </div>
                        <div>
                            <a href="#top"
                                class="text-blue-600 hover:text-blue-800 underline flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span class="hidden md:block ">Back to Top</span>
                            </a>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('school.update.details') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" value="{{ Auth::guard('school')->user()->school->pk_school_id }}"
                            name="pk_school_id" class="hidden" />
                        <img id="logoPreview"
                            src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                            class="rounded-full w-20 h-20 object-cover" alt="">
                        <div class="mb-4 flex items-center gap-6">

                            <input type="file" id="logo-upload" name="image_path" accept="image/*" class="hidden"
                                onchange="previewLogo(event)">
                            <button type="button" onclick="document.getElementById('logo-upload').click();"
                                class="   text-blue-600 hover:text-blue-700 underline rounded-md transition">Change
                                School Logo </button>
                        </div>
                        <div><span class="font-semibold">School ID:</span>
                            {{ Auth::guard('school')->user()->school->SchoolID }}</div>
                        <div><span class="font-semibold">School Name:</span>
                            {{ Auth::guard('school')->user()->school->SchoolName }}</div>
                        <div class="mb-4"><span class="font-semibold">School Level:</span>
                            {{ Auth::guard('school')->user()->school->SchoolLevel }}
                        </div>
                        {{-- <div><span class="font-semibold">Region:</span>
                            {{ Auth::guard('school')->user()->school->Region }}</div>
                        <div><span class="font-semibold">Province:</span>
                            {{ Auth::guard('school')->user()->school->Province }}</div>
                        <div><span class="font-semibold">City:</span>
                            {{ Auth::guard('school')->user()->school->CityMunicipality }}</div>
                        <div class="mb-4"><span class="font-semibold">Division Office:</span>
                            {{ Auth::guard('school')->user()->school->Division }}</div> --}}

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                            <div class="flex flex-col">
                                <label class="mb-1 font-semibold text-gray-700">School Level</label>
                                <input type="text" id="SchoolLevelInput"
                                    class="px-3 py-2 border border-gray-0 rounded bg-gray-100"
                                    value="{{ Auth::guard('school')->user()->school->SchoolLevel }}" readonly>
                            </div>

                            <!-- District Dropdown -->
                            <div>
                                <label class="font-semibold">School Email Address:</label>
                                <input type="email" name="SchoolEmailAddress"
                                    value="{{ Auth::guard('school')->user()->school->SchoolEmailAddress }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2" disabled />
                            </div>
                            <div>
                                <label class="font-semibold">Region:</label>
                                <input type="text" name="Region" value="Region I"
                                    class="w-full border   rounded px-3 py-2" disabled />
                                <input type="hidden" name="Region" value="Region I" />
                            </div>
                            <div>
                                <label class="font-semibold">Province:</label>
                                <input type="text" name="Province" value="Pangasinan"
                                    class="w-full border   rounded px-2 py-1" disabled />
                                <input type="hidden" name="Province" value="Pangasinan" />
                            </div>
                            <div>
                                <label class="font-semibold">City/Municipality:</label>
                                <input type="text" name="CityMunicipality" value="San Carlos City"
                                    class="w-full border   rounded px-2 py-1" disabled />
                                <input type="hidden" name="CityMunicipality" value="San Carlos City" />
                            </div>
                            <div>
                                <label class="font-semibold">Division:</label>
                                <input type="text" name="Division" value="San Carlos City"
                                    class="w-full border   rounded px-2 py-1" disabled />
                                <input type="hidden" name="Division" value="San Carlos City" />
                            </div>
                            <div class="col-span-1 md:col-span-3 text-blue-700">Update this Details <span
                                    class="text-red-600">*</span>
                            </div>
                            <div>
                                <label class="font-semibold">School Contact Number
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="SchoolContactNumber"
                                    value="{{ Auth::guard('school')->user()->school->SchoolContactNumber }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2" />
                            </div>

                            <div class="flex flex-col">
                                <label for="District" class="mb-1 font-semibold text-gray-700">District

                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="District" id="District"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                            <div class=" flex flex-col items-start justify-end text-right">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Update
                                    Details</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- Principal, ICT, Custodian Info Container -->
                <div id="school_officials" style="border:1px solid #ccc"
                    class="bg-white rounded-md shadow-md overflow-hidden p-6 mt-6">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold text-blue-700  ">School Officials</h3>
                            <div class="text-gray-500 text-sm mb-4">Encode the details of the School Officials</div>
                        </div>
                        <div>
                            <a href="#top"
                                class="text-blue-600 hover:text-blue-800 underline flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span class="hidden md:block ">Back to Top</span>
                            </a>
                        </div>
                    </div>


                    <form method="POST" action="{{ route('school.update.officials') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700">
                            <!-- Principal -->
                            <div>
                                <h4 class="font-semibold text-blue-600 mb-2">School Head</h4>
                                <div class="mb-2">
                                    <label class="font-semibold">Name:</label>
                                    <input type="text" name="PrincipalName"
                                        value="{{ Auth::guard('school')->user()->school->PrincipalName }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                                <div class="mb-2">
                                    <label class="font-semibold">Contact:</label>
                                    <input type="text" name="PrincipalContact"
                                        value="{{ Auth::guard('school')->user()->school->PrincipalContact }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                                <div class="mb-2">
                                    <label class="font-semibold">Email:</label>
                                    <input type="email" name="PrincipalEmail"
                                        value="{{ Auth::guard('school')->user()->school->PrincipalEmail }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                            </div>
                            <!-- ICT Coordinator -->
                            <div>
                                <h4 class="font-semibold text-blue-600 mb-2">School ICT Coordinator</h4>
                                <div class="mb-2">
                                    <label class="font-semibold">Name:</label>
                                    <input type="text" name="ICTName"
                                        value="{{ Auth::guard('school')->user()->school->ICTName }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                                <div class="mb-2">
                                    <label class="font-semibold">Contact:</label>
                                    <input type="text" name="ICTContact"
                                        value="{{ Auth::guard('school')->user()->school->ICTContact }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                                <div class="mb-2">
                                    <label class="font-semibold">Email:</label>
                                    <input type="email" name="ICTEmail"
                                        value="{{ Auth::guard('school')->user()->school->ICTEmail }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                            </div>
                            <!-- Property Custodian -->
                            <div>
                                <h4 class="font-semibold text-blue-600 mb-2">School Property Custodian</h4>
                                <div class="mb-2">
                                    <label class="font-semibold">Name:</label>
                                    <input type="text" name="CustodianName"
                                        value="{{ Auth::guard('school')->user()->school->CustodianName }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                                <div class="mb-2">
                                    <label class="font-semibold">Contact:</label>
                                    <input type="text" name="CustodianContact"
                                        value="{{ Auth::guard('school')->user()->school->CustodianContact }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                                <div class="mb-2">
                                    <label class="font-semibold">Email:</label>
                                    <input type="email" name="CustodianEmail"
                                        value="{{ Auth::guard('school')->user()->school->CustodianEmail }}"
                                        class="w-full border rounded px-2 py-1" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 text-right">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Update
                                Officials</button>
                        </div>
                    </form>
                </div>
                <!-- Additional School Data Submission -->
                @php
                    $schoolLevel = Auth::guard('school')->user()->school->SchoolLevel ?? '';
                    $gradeLevels = [];
                    if ($schoolLevel === 'Elementary School') {
                        $gradeLevels = [
                            ['id' => 'K', 'name' => 'Kinder'],
                            ['id' => '1', 'name' => 'Grade I'],
                            ['id' => '2', 'name' => 'Grade II'],
                            ['id' => '3', 'name' => 'Grade III'],
                            ['id' => '4', 'name' => 'Grade IV'],
                            ['id' => '5', 'name' => 'Grade V'],
                            ['id' => '6', 'name' => 'Grade VI'],
                        ];
                    } elseif ($schoolLevel === 'Junior High School') {
                        $gradeLevels = [['id' => 'JHS', 'name' => 'Junior High School']];
                    } elseif ($schoolLevel === 'Senior High School') {
                        $gradeLevels = [['id' => 'SHS', 'name' => 'Senior High School']];
                    }
                @endphp

                <div id="school_others" style="border:1px solid #ccc"
                    class="bg-white rounded-md shadow-md overflow-hidden p-6 mt-6">

                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold text-blue-700 ">Submit School Data</h3>
                            <div class="text-gray-500 mb-4 text-sm">Encode your school data here</div>
                        </div>
                        <div>
                            <a href="#top"
                                class="text-blue-600 hover:text-blue-800 underline flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span class="hidden md:block ">Back to Top</span>
                            </a>
                        </div>
                    </div>

                    <form id="school-data-form" method="POST" action="{{ route('school.submit.schooldata') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="font-semibold">Grade Level <span class="text-red-500">*</span></label>
                                <select name="GradeLevelID" class="w-full border rounded px-2 py-1" required>
                                    <option value="">-- Select Grade Level --</option>
                                    @foreach ($gradeLevels as $level)
                                        <option value="{{ $level['id'] }}"
                                            {{ in_array($level['id'], $submittedGradeLevels ?? []) ? 'disabled' : '' }}>
                                            {{ $level['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="font-normal">Total Number of <b>Registered Learners</b> </label>
                                <input type="number" name="RegisteredLearners" min="0"
                                    class="w-full border  border-gray-300 rounded px-2 py-1" required>
                            </div>
                            <div>
                                <label class="font-normal">Total Number of <b>Teachers</b></label>
                                <input type="number" name="Teachers" min="0"
                                    class="w-full border border-gray-300  rounded px-2 py-1" required>
                            </div>
                            <div>
                                <label class="font-normal">Total Number of <b>Sections</b></label>
                                <input type="number" name="Sections" min="0"
                                    class="w-full border border-gray-300  rounded px-2 py-1" required>
                            </div>
                            <div>
                                <label class="font-normal"> Total Number of <b>Classrooms</b></label>
                                <input type="number" name="Classrooms" min="0"
                                    class="w-full border border-gray-300 rounded px-2 py-1" required>
                            </div>

                        </div>
                        <input type="hidden" name="pk_school_id"
                            value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
                        <div class="mt-6 text-right">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Submit
                                Data</button>
                        </div>
                    </form>
                </div>


                <div
                    class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center border border-red-800 justify-center z-50 hidden  ">
                    <div class="modal-content bg-white rounded-md shadow-md p-6 mx-10">

                        <div class="text-blue-600 text-2xl font-bold mb-4">Update School Data Form</div>
                        <form id="school-data-form_update" method="POST"
                            action="{{ route('school.update.schooldata') }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="pk" name="pk">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="font-semibold">Grade Level <span class="text-red-500">*</span></label>
                                    <select name="GradeLevelID" id="GradeLevelID" class="w-full border rounded px-2 py-1"
                                        required>

                                        <option value="">-- Select Grade Level --</option>
                                        @foreach ($gradeLevels as $level)
                                            <option value="{{ $level['id'] }}"
                                                {{ in_array($level['id'], $submittedGradeLevels ?? []) ? 'disabled' : '' }}>
                                                {{ $level['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="font-normal">Total Number of <b>Registered Learners</b> </label>
                                    <input type="number" name="RegisteredLearners" id="RegisteredLearners"
                                        min="0" class="w-full border  border-gray-300 rounded px-2 py-1" required>
                                </div>
                                <div>
                                    <label class="font-normal">Total Number of <b>Teachers</b></label>
                                    <input type="number" name="Teachers" id="Teachers" min="0"
                                        class="w-full border border-gray-300  rounded px-2 py-1" required>
                                </div>
                                <div>
                                    <label class="font-normal">Total Number of <b>Sections</b></label>
                                    <input type="number" name="Sections" id="Sections" min="0"
                                        class="w-full border border-gray-300  rounded px-2 py-1" required>
                                </div>
                                <div>
                                    <label class="font-normal"> Total Number of <b>Classrooms</b></label>
                                    <input type="number" name="Classrooms" id="Classrooms" min="0"
                                        class="w-full border border-gray-300 rounded px-2 py-1" required>
                                </div>

                            </div>
                            <input type="hidden" name="pk_school_id"
                                value="{{ Auth::guard('school')->user()->school->pk_school_id }}">
                            <div class="mt-6 text-right flex justify-end gap-2">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Update
                                    Data</button>
                                <button type="button"
                                    class="px-6 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-600"
                                    onclick="closeEditModal()">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>

                <script>
                    function closeEditModal() {
                        document.querySelector('.modal').classList.add('hidden');
                    }

                    function showEditForm(pk_id, gradeLevelId, registeredLearners, teachers, sections, classrooms) {

                        const select = document.getElementById('GradeLevelID');

                        // Set the selected value
                        select.value = gradeLevelId;

                        // Disable all other options
                        for (let option of select.options) {
                            option.disabled = option.value !== gradeLevelId;
                        }
                        document.getElementById('RegisteredLearners').value = registeredLearners;
                        document.getElementById('Teachers').value = teachers;
                        document.getElementById('Sections').value = sections;
                        document.getElementById('Classrooms').value = classrooms;
                        document.getElementById('pk').value = pk_id;
                        document.querySelector('.modal').classList.remove('hidden');
                    }
                </script>
                <!-- Table of Submitted Data -->
                @if (isset($schoolData) && count($schoolData))
                    <div class="bg-white rounded-md shadow-md p-6 mt-6 " style="border:1px solid #ccc">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="text-2xl font-semibold text-blue-700  ">Submitted School Data</h3>
                                <div class="text-gray-500 mb-4 text-sm">List of encoded data </div>

                            </div>
                            <div>
                                <a href="#top"
                                    class="text-blue-600 hover:text-blue-800 underline flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    <span class="hidden md:block ">Back to Top</span>
                                </a>
                            </div>
                        </div>

                        @foreach ($schoolData as $data)
                            <div class="mb-6    rounded border border-gray-200 shadow-sm">
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
                                    <div class="md:col-span-5 col-span-1 w-full p-0">
                                        <button
                                            onclick="showEditForm({{ $data->ID }}, '{{ $data->GradeLevelID }}',{{ $data->RegisteredLearners }},{{ $data->Teachers }},{{ $data->Sections }},{{ $data->Classrooms }})"
                                            class="text-blue-500 hover:text-blue-700 underline">Edit</button>
                                    </div>
                                    <div class="flex flex-col text-center px-2 py-2 items-center justify-center bg-green-200 "
                                        style="border:1px solid #282828">
                                        <label class="text-gray-700 font-normal">Grade Level</label>
                                        <div class="text-gray-800 text-2xl font-bold">
                                            {{ collect($gradeLevels)->firstWhere('id', $data->GradeLevelID)['name'] ?? $data->GradeLevelID }}
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-col  text-center items-center justify-center p-2 bg-red-200"style="border:1px solid #282828">
                                        <label class="text-gray-700 font-normal  font-xl">Registered Learners</label>
                                        <div class="text-gray-800 text-2xl font-bold">{{ $data->RegisteredLearners }}
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-col  text-center items-center justify-center p-2 bg-blue-200"style="border:1px solid #282828">
                                        <label class="text-gray-700 font-normal  font-xl">Teachers</label>
                                        <div class="text-gray-800 text-2xl font-bold">{{ $data->Teachers }}</div>
                                    </div>
                                    <div
                                        class="flex flex-col p-2 text-center  items-center justify-center text-center bg-purple-200"style="border:1px solid #282828">
                                        <label class="text-gray-700 font-normal  font-xl">Sections</label>
                                        <div class="text-gray-800 text-2xl font-bold">{{ $data->Sections }}</div>
                                    </div>
                                    <div
                                        class="flex flex-col p-2  text-center items-center justify-center bg-yellow-200"style="border:1px solid #282828">
                                        <label class="text-gray-700 font-normal  font-xl">Classrooms</label>
                                        <div class="text-gray-800 text-2xl font-bold">{{ $data->Classrooms }}</div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="bg-white rounded-md shadow-md overflow-hidden p-6 text-center">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">No school information found for this account.</h3>
                    <p class="text-gray-600">Please contact your administrator to link your account to a school.</p>
                </div>
            @endif
        </div>
    </main>


    <!-- Add Leaflet.js for map display -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @php
        $lat = optional(Auth::guard('school')->user()->school->schoolCoordinates)->Latitude ?? 15.928;
        $lon = optional(Auth::guard('school')->user()->school->schoolCoordinates)->Longitude ?? 120.348;
    @endphp

    <input type="hidden" name="latitude" id="latitude" value="{{ $lat }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ $lon }}">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // School map display
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            var lat = parseFloat(latitude);
            var lon = parseFloat(longitude);
            var map = L.map('school-map').setView([lat, lon], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 14,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            L.marker([lat, lon]).addTo(map);
            // Reverse geocode to get location only
            fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lon)
                .then(response => response.json())
                .then(function(data) {
                    var address = data.address || {};
                    var street = address.road || address.pedestrian || address.cycleway || address.footway ||
                        '';
                    var barangay = address.suburb || address.village || address.neighbourhood || address
                        .hamlet || address.barangay || '';
                    var city = address.city || address.town || address.municipality || address.village ||
                        address.county || '';
                    var province = address.state || address.region || address.province || '';
                    var parts = [street, barangay, city, province].filter(Boolean);
                    var location = parts.length ? parts.join(', ') : 'Location not found.';
                    document.getElementById('location-name').textContent = 'Location: ' + location;
                })
                .catch(function() {
                    document.getElementById('location-name').textContent = 'Unable to fetch location info.';
                });
        });
    </script>

    <script>
        function previewLogo(event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // --- District Dropdown Logic ---
            const schoolLevelInput = document.getElementById('SchoolLevelInput');
            const district = document.getElementById('District');
            const elementaryDistricts = [
                '1A', '1B', '2A', '2B', '3A', '3B', '4A', '4B',
            ];
            const highSchoolDistricts = ['5A', '5B'];

            function populateDistricts(level) {
                district.innerHTML = '<option value="">Select District</option>';
                if (level === 'Elementary School') {
                    elementaryDistricts.forEach(function(d) {
                        const opt = document.createElement('option');
                        opt.value = d;
                        opt.textContent = d;
                        district.appendChild(opt);
                    });
                    district.disabled = false;
                } else if (level === 'Junior High School' || level === 'Senior High School') {
                    highSchoolDistricts.forEach(function(d) {
                        const opt = document.createElement('option');
                        opt.value = d;
                        opt.textContent = d;
                        district.appendChild(opt);
                    });
                    district.disabled = false;
                } else {
                    district.disabled = true;
                }
            }

            // Use the actual school level value from the readonly input
            const currentLevel = schoolLevelInput ? schoolLevelInput.value : '';
            populateDistricts(currentLevel);

            // Set selected district if available
            const currentDistrict = "{{ Auth::guard('school')->user()->school->District }}";
            if (currentDistrict) {
                district.value = currentDistrict;
            }
            // No need for change event since school level is readonly
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Disable submit button if no grade level is selected
            const gradeLevelSelect = document.querySelector('select[name="GradeLevelID"]');
            const submitBtn = document.querySelector('#school-data-form button[type="submit"]');

            function toggleSubmitBtn() {
                if (gradeLevelSelect && submitBtn) {
                    submitBtn.disabled = !gradeLevelSelect.value;
                    submitBtn.classList.toggle('opacity-50', !gradeLevelSelect.value);
                    submitBtn.classList.toggle('cursor-not-allowed', !gradeLevelSelect.value);
                }
            }

            if (gradeLevelSelect && submitBtn) {
                gradeLevelSelect.addEventListener('change', toggleSubmitBtn);
                toggleSubmitBtn(); // Initial check
            }
        });
    </script>
@endsection

@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        input[type="text"] {
            border: 1px solid #ccc;
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
            font-size: 0.95rem;
            padding: 0.5rem 0.75rem;
        }

        .add-school-flex {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            align-items: stretch;
            justify-content: center;
            width: 100%;
        }

        .add-school-col {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            flex: 1 1 0;
        }

        .add-school-logo {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e5e7eb;
            box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.08);
            margin-bottom: 1rem;
        }

        @media (max-width: 900px) {
            .add-school-flex {
                flex-direction: column;
                gap: 1.5rem;
            }

            .add-school-col {
                min-width: unset;
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('school_add_form').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Hide previous errors
                        const errorDiv = document.getElementById('school-errors');
                        const errorList = document.getElementById('school-errors-list');
                        errorDiv.classList.add('hidden');
                        errorList.innerHTML = '';

                        if (data.success) {
                            // Show styled success message
                            const resultDiv = document.getElementById('school-result');
                            const resultMsg = document.getElementById('school-result-message');
                            resultMsg.innerText = data.message || "School added successfully!";
                            resultDiv.classList.remove('hidden');
                            form.reset();
                        } else if (data.errors) {
                            // Show validation errors
                            errorDiv.classList.remove('hidden');
                            for (const key in data.errors) {
                                data.errors[key].forEach(msg => {
                                    const li = document.createElement('li');
                                    li.textContent = msg;
                                    errorList.appendChild(li);
                                });
                            }
                        } else {
                            alert('Error adding school: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the school.');
                    });
            });
        });

        function deleteSchool(schoolId) {
            if (confirm('Are you sure you want to delete this school?')) {
                fetch(`/schools/${schoolId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const resultDiv = document.getElementById('school-result');
                            const resultMsg = document.getElementById('school-result-message');
                            resultMsg.innerText = data.message || "School deleted successfully!";
                            resultDiv.classList.remove('hidden');


                            const row = document.getElementById(`row-${schoolId}`);
                            if (row) {
                                row.innerHTML = `
                            <td colspan="100%" class="bg-green-100 text-green-700 text-center py-4    rounded">
                           
                                <svg class="w-6 h-6 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            School deleted successfully!
                            </td>
                        `;
                            }



                        } else if (data.errors) {
                            const errorDiv = document.getElementById('school-errors');
                            const errorList = document.getElementById('school-errors-list');
                            errorDiv.classList.remove('hidden');
                            errorList.innerHTML = '';
                            for (const key in data.errors) {
                                data.errors[key].forEach(msg => {
                                    const li = document.createElement('li');
                                    li.textContent = msg;
                                    errorList.appendChild(li);
                                });
                            }

                        } else {
                            alert('Error deleting school: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the school.');
                    });
            }
        }
    </script>

    <div class="w-full p-4 ">
        <div class="flex flex-col lg:flex-row-reverse gap-4 ">
            <!-- Add School Form -->
            <div class="w-full mx-auto p-0 flex-1 flex flex-col justify-stretch">


                <div id="school-errors" class="hidden mt-2">
                    <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-md"
                        id="school-errors-list"></ul>


                </div>

                <div id="school-result" class="hidden mt-2">
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center gap-2 text-md">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="school-result-message"></span>
                    </div>
                </div>
                <form id="school_add_form" style="border: 1px solid #ccc;" action="{{ route('store.schools') }}"
                    enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg mt-5 w-full max-full mx-0">
                    @csrf
                    <div class="add-school-flex">
                        <!-- Left: Logo -->
                        <div class="add-school-col" style="flex:1">
                            <img src="{{ asset('icon/logo.png') }}" alt="School Logo" class="add-school-logo" />
                        </div>
                        <!-- Center: School ID and School Name with Submit Button below -->
                        <div class="add-school-col" style="flex:1; align-items: stretch; justify-content: center;">
                            <div class="flex flex-col mb-4">
                                <h2 class="text-2xl font-bold text-blue-700 mb-2">Add School</h2>

                                <label for="SchoolID" class="mb-1 font-medium text-gray-700">School ID</label>
                                <input type="text" name="SchoolID" id="SchoolID"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required />
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="SchoolName" class="mb-1 font-medium text-gray-700">School Name</label>
                                <input type="text" name="SchoolName" id="SchoolName"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required />
                            </div>


                            <div class="flex flex-col mb-4">
                                <label for="SchoolEmailAddress" class="mb-1 font-medium text-gray-700">School Email
                                    Address</label>
                                <input type="email" name="SchoolEmailAddress" id="SchoolEmailAddress"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required />
                            </div>



                            <div class="flex flex-col items-end mt-2">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition w-full">
                                    Submit
                                </button>
                            </div>
                        </div>

                        <!-- Right: Map and Coordinates -->
                        <div class="add-school-col" style="flex:1; align-items: stretch;">
                            <div class="flex flex-col mb-4">
                                <label for="SchoolLevel" class="mb-1 font-medium text-gray-700">School Level</label>
                                <select name="SchoolLevel" id="SchoolLevel"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                                    <option value="" disabled selected>-- Select School Level --</option>
                                    <option value="Elementary School">Elementary School</option>
                                    <option value="Junior High School">Junior High School</option>
                                    <option value="Senior High School">Senior High School</option>
                                </select>
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="mb-1 font-medium text-gray-700">School Location (Select on Map)</label>
                                <div id="map" style="height: 180px; border-radius: 8px; margin-bottom: 8px;"></div>
                                <div class="flex gap-2">
                                    <div class="w-1/2 flex flex-col">
                                        <label for="Latitude" class="mb-1 font-medium text-gray-700">Latitude</label>
                                        <input type="text" name="Latitude" id="latitude"
                                            class="px-3 py-2 border border-gray-300 rounded" placeholder="Latitude" readonly
                                            required>
                                    </div>
                                    <div class="w-1/2 flex flex-col">
                                        <label for="Longitude" class="mb-1 font-medium text-gray-700">Longitude</label>
                                        <input type="text" name="Longitude" id="longitude"
                                            class="px-3 py-2 border border-gray-300 rounded" placeholder="Longitude"
                                            readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Leaflet.js for map selector -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Map selector logic
            var map = L.map('map').setView([15.928, 120.348], 12); // Centered on Pangasinan
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            var marker;

            function setLatLng(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }
            map.on('click', function(e) {
                if (marker) map.removeLayer(marker);
                marker = L.marker(e.latlng).addTo(map);
                setLatLng(e.latlng.lat, e.latlng.lng);
            });
            // Auto-search map when School Name changes
            var schoolNameInput = document.getElementById('SchoolName');
            if (schoolNameInput) {
                var schoolNameTimeout;
                schoolNameInput.addEventListener('input', function(e) {
                    clearTimeout(schoolNameTimeout);
                    var value = this.value.trim();
                    if (value.length > 2) {
                        schoolNameTimeout = setTimeout(function() {
                            var query = value + ', San Carlos Pangasinan';
                            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' +
                                    encodeURIComponent(query))
                                .then(function(response) {
                                    return response.json();
                                })
                                .then(function(data) {
                                    if (data && data.length > 0) {
                                        var lat = parseFloat(data[0].lat);
                                        var lon = parseFloat(data[0].lon);
                                        map.setView([lat, lon], 16);
                                        if (marker) map.removeLayer(marker);
                                        marker = L.marker([lat, lon]).addTo(map);
                                        setLatLng(lat, lon);
                                    }
                                })
                                .catch(function(err) {
                                    // Optionally handle error
                                    // console.error('Map search error:', err);
                                });
                        }, 600); // debounce
                    }
                });
            }
        });
    </script>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
        <h2 class="text-lg font-bold text-gray-800 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">School
            List</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border border-gray-200"
                style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <thead style="background: #2563eb;">
                    <tr>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700"
                            style="background: #2563eb;">School ID</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700"
                            style="background: #2563eb;">School Name</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700"
                            style="background: #2563eb;">School Level</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700"
                            style="background: #2563eb;">School Head</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700"
                            style="background: #2563eb;">School Contact</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white border-r border-blue-700"
                            style="background: #2563eb;">School Email</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white"
                            style="background: #2563eb;">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($schools as $school)
                        <tr class="hover:bg-blue-50 transition" id="row-{{ $school->pk_school_id }}">
                            <td class="px-4 py-3 border-r border-gray-200">{{ $school->SchoolID }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-200">
                                {{ $school->SchoolName }}</td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $school->SchoolLevel }}</td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $school->PrincipalName }}</td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $school->SchoolContactNumber }}</td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $school->SchoolEmailAddress }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-col gap-2 items-stretch">
                                    <a href="{{ route('schools.show', $school->SchoolID) }}"
                                        class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 text-center">View</a>
                                    <a href="#"
                                        class="px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded hover:bg-green-600 text-center">Edit</a>
                                    <button type="button" onclick="deleteSchool('{{ $school->pk_school_id }}')"
                                        class="px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600 text-center">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

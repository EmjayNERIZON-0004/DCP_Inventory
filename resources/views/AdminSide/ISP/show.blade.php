@extends('layout.Admin-Side')
<title>
    @yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class="bg-white my-5 mx-5">
        <input type="text" id="searchSchool" placeholder="Search school..."
            class="border border-gray-300 rounded-lg px-4 py-2 mb-4 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <div id="isp-content">
            @foreach ($isp_content as $school_id => $school_isp)
                <h1 class="text-2xl font-bold text-center my-5">
                    @php
                        $school = App\Models\School::findOrFail($school_id);
                    @endphp
                    {{ $school->SchoolName }} <span class="text-gray-700 text-md font-semibold">
                        ({{ $school->SchoolLevel }})
                    </span></h1>

                <table>
                    <thead>
                        <th>ISP Type</th>
                        <th>Connection Type</th>
                        <th>Internet Quality</th>
                        <th>Area Locations</th>
                        <th>Purpose</th>
                        <th>Speed Test</th>
                    </thead>
                    <tbody>
                        @foreach ($school_isp as $isp)
                            <tr>
                                <td class="px-4 py-2 border">{{ $isp->ispList->name }}</td>
                                <td class="px-4 py-2 border">{{ $isp->ispConnectionType->name }}</td>
                                <td class="px-4 py-2 border">{{ $isp->ispInternetQuality->name }}</td>
                                <td class="px-4 py-2 border">{{ $isp->ispPurpose->name }}</td>


                                <td class="px-4 py-2 border">
                                    @foreach ($isp->ispAreaDetails as $details)
                                        {{ $details->ispAreaAvailable->name }} @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>

                                <td class="px-4 py-2 border">
                                    @foreach ($isp->ispSpeedTest as $speed)
                                        <div>
                                            <div>Download: {{ $speed->download }} ms</div>
                                            <div>Upload: {{ $speed->upload }} ms</div>
                                            <div>Ping: {{ $speed->ping }} ms</div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#searchSchool').on('keyup', function() {
            var keyword = $(this).val();

            $.ajax({
                url: '/Admin/ISP/search',
                type: 'GET',
                data: {
                    query: keyword
                },
                success: function(response) {
                    console.log(response); // you’ll get grouped JSON data
                    $('#isp-content').empty(); // clear old content

                    $.each(response, function(school_id, school_isp) {
                        // Get school info (from the first ISP entry)
                        var school = school_isp[0].school;
                        var schoolHtml = `
                    <h1 class="text-2xl font-bold text-center my-5">
                        ${school.SchoolName} 
                        <span class="text-gray-700 text-md font-semibold">
                            (${school.SchoolLevel})
                        </span>
                    </h1>
                    <table>
                        <thead>
                            <th>ISP Type</th>
                            <th>Connection Type</th>
                            <th>Internet Quality</th>
                            <th>Purpose</th>
                            <th>Area Locations</th>
                            <th>Speed Test</th>
                        </thead>
                        <tbody>
                `;

                        $.each(school_isp, function(i, isp) {

                            let areas = isp.isp_area_details.map(a =>
                                a.isp_area_available.name).join(', ');

                            let speeds = isp.isp_speed_test.map(s => `
                            <div>Download: ${s.download} ms</div>
                            <div>Upload: ${s.upload} ms</div>
                            <div>Ping: ${s.ping} ms</div>
                        `).join('');

                            schoolHtml += `
                        <tr>
                            <td class="px-4 py-2 border">${isp.isp_list.name}</td>
                            <td class="px-4 py-2 border">${isp.isp_connection_type.name}</td>
                            <td class="px-4 py-2 border">${isp.isp_internet_quality.name}</td>
                            <td class="px-4 py-2 border">${isp.isp_purpose.name}</td>
                            <td class="px-4 py-2 border">${areas}</td>
                            <td class="px-4 py-2 border">${speeds}</td>
                        </tr>
                    `;
                        });

                        schoolHtml += `</tbody></table>`;
                        $('#isp-content').append(schoolHtml);
                    });
                }
            });
        });
    </script>
@endsection

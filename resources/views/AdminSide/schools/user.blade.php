@extends('layout.Admin-Side')
<title>@yield('title', 'School  Users')</title>

@section('content')
    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 mx-5 my-5">
        <h2 class="text-2xl font-bold text-gray-800 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">School
            User Account</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200"
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
                            style="background: #2563eb;">School Username</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white"
                            style="background: #2563eb;">School Default Password</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-r border-gray-200">{{ $user->SchoolID }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-200">{{ $user->SchoolName }}
                            </td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $user->SchoolLevel }}</td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $user->user_username }}</td>
                            <td class="px-4 py-3">{{ $user->default_password }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

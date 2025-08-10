@extends('layout.Admin-Side')
<title>@yield('title', 'School  Users')</title>

@section('content')
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-blue-500 p-6 mx-5 my-5">
        <h2 class="text-2xl font-bold text-gray-800 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">School
            User Account</h2>
        <input type="text" id="searchSchoolUser" placeholder="Search school..."
            class="border border-gray-300 rounded-lg px-4 py-2 mb-4 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200"
                style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white   ">
                            School ID</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white   ">
                            School Name</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white   ">
                            School Level</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white   ">
                            School Username</th>
                        <th class="px-4 py-3 font-semibold uppercase tracking-wider text-white">School Default Password</th>
                        <th class="px-4 py-3 whitespace-nowrap font-semibold uppercase tracking-wider text-white">Open
                            Account</th>

                    </tr>
                </thead>
                <tbody id="schoolUsersTableBody" class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-r border-gray-200">{{ $user->SchoolID }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-200">{{ $user->SchoolName }}
                            </td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $user->SchoolLevel }}</td>
                            <td class="px-4 py-3 border-r border-gray-200">{{ $user->user_username }}</td>
                            <td class="px-4 py-3">{{ $user->default_password }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center">
                                    <form action="{{ route('submit-login') }}" method="POST">
                                        @csrf
                                        <input type="text" id="username" name="username" required
                                            value="{{ $user->user_username }}"
                                            class="w-full hidden px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <input type="text" id="password" name="password" required
                                            value="{{ $user->default_password }}"
                                            class="w-full px-3 hidden py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500 pr-10">
                                        <input class="hidden" type="text" value="fromAdmin" name="fromAdmin">
                                        <button type="submit" class="bg-blue-600 rounded-md px-4 py-1 text-white">Log in
                                        </button>
                                    </form>
                                </div>

                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.appRoutes = {
            submitLogin: "{{ route('submit-login') }}",
        };
    </script>
    <script src="{{ asset('js/search/user.js') }}"></script>
@endsection

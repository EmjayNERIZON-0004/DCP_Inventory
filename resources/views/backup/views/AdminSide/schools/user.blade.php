@extends('layout.Admin-Side')
<title>@yield('title', 'School  Users')</title>

@section('content')
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-blue-500 p-6 mx-5 my-5">
        <h2 class="text-2xl font-bold text-gray-700 mb-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">School
            User Account</h2>
        <input type="text" id="searchSchoolUser" placeholder="Search school..."
            class="border border-gray-300 rounded-lg px-4 py-2 mb-4 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse text-sm text-left border border-gray-200"
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
                            Account and Reset Password</th>

                    </tr>
                </thead>
                <tbody id="schoolUsersTableBody" class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border border-gray-200">{{ $user->SchoolID }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 border border-gray-200">{{ $user->SchoolName }}
                            </td>
                            <td class="px-4 py-3 border border-gray-200">{{ $user->SchoolLevel }}</td>
                            <td class="px-4 py-3 border border-gray-200">{{ $user->user_username }}</td>
                            <td class="px-4 py-3 border border-gray-200">{{ $user->default_password }}</td>
                            <td class="px-4 py-3 border border-gray-200">
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
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700  rounded-sm border border-gray-300 shadow-sm px-4 py-2 text-white">Log
                                            in
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reset.school_user.password') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="id" value="{{ $user->user_id }}" hidden>

                                        <button type="submit"
                                            class="bg-gray-500 hover:bg-gray-600 rounded-sm border border-gray-300 shadow-sm px-4 py-2 text-white ml-2">Reset
                                            Password</button>
                                    </form>
                                </div>

                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.appRoutes = {
            submitLogin: "{{ route('submit-login') }}",
            resetPassword: "{{ route('admin.reset.school_user.password', ':id') }}",
        };


        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const submitLoginRoute = window.appRoutes.submitLogin;
        const resetPasswordRouteTemplate = window.appRoutes.resetPassword;

        $('#searchSchoolUser').on('keyup', function() {
            const keyword = $(this).val();

            $.ajax({
                url: '/Admin/SchoolUser/search',
                type: 'GET',
                data: {
                    query: keyword
                },
                success: function(data) {
                    let rows = '';
                    if (data.length > 0) {
                        data.forEach(user => {
                            // replace :id with actual user ID
                            let resetPasswordRoute = resetPasswordRouteTemplate.replace(':id',
                                user.user_id);

                            rows += `
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border border-gray-200">${user.SchoolID}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 border border-gray-200">${user.SchoolName}</td>
                            <td class="px-4 py-3 border border-gray-200">${user.SchoolLevel}</td>
                            <td class="px-4 py-3 border border-gray-200">${user.user_username}</td>
                            <td class="px-4 py-3 border border-gray-200">${user.default_password}</td>
                            <td class="px-4 py-3 border border-gray-200">
                                <div class="flex justify-center">
                                    <!-- Login Form -->
                                    <form action="${submitLoginRoute}" method="POST">
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="username" value="${user.user_username}">
                                        <input type="hidden" name="password" value="${user.default_password}">
                                        <input type="hidden" name="fromAdmin" value="fromAdmin">
                                        <button type="submit" class=" bg-blue-600 hover:bg-blue-700 border border-gray-300 shadow-md rounded-sm px-4 py-2 text-white">Log in</button>
                                    </form>

                                    <!-- Reset Password Form -->
                                    <form action="${resetPasswordRoute}" method="POST" class="ml-2">
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="text" name="id" value=" ${user.user_id}" hidden>
                                    
                                        <button type="submit" class="bg-gray-500 hover:bg-gray-600 border border-gray-300 shadow-md rounded-sm px-4 py-2 text-white">Reset Password</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;
                        });
                    } else {
                        rows =
                            `<tr><td colspan="6" class="px-4 py-3 text-center text-gray-500">No results found.</td></tr>`;
                    }

                    $('#schoolUsersTableBody').html(rows);
                }
            });
        });
    </script>
@endsection

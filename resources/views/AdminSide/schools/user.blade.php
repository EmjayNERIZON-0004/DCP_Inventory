@extends('layout.Admin-Side')
<title>@yield('title', 'School Users')</title>

@section('content')
    <style>
        button {
            letter-spacing: 0.05rem;
            font-weight: 500 !important;
        }
    </style>
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-300 p-6  md:mx-5 md:my-5 mx-0 my-0">
        <h2 class="text-2xl font-bold text-gray-700 mb-4"
            style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            School User Account
        </h2>

        <input type="text" id="searchSchoolUser" placeholder="Search school..."
            class="border border-gray-300 rounded-lg px-4 py-2 mb-4 md:w-1/3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

        <!-- Cards Container -->
        <div id="schoolUsersCardContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($users as $user)
                <div
                    class="bg-gradient-to-br from-white to-gray-50 border border-gray-300 rounded-2xl p-6 shadow-md hover:shadow-md transition duration-300">
                    <!-- Header -->
                    <div class="grid grid-cols-3   items-center justify-between mb-6">

                        <div>
                            <img class=" md:w-24 md:h-24 w-20 h-20 rounded-full object-cover "
                                src="{{ $user->image_path ? asset('school-logo/' . $user->image_path) : asset('icon/logo.png') }}"
                                alt="">
                        </div>
                        <div class="col-span-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $user->SchoolName }}</h3>
                            <div class="my-2"><span
                                    class="px-3 mt-2 py-1 text-xs font-medium text-white bg-blue-600 rounded-full">
                                    {{ $user->SchoolLevel }}
                                </span></div>

                            <p class="text-sm text-gray-500">School ID: {{ $user->SchoolID }}</p>
                        </div>

                    </div>

                    <!-- Body -->
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Username</p>
                            <p class="font-medium text-gray-800">{{ $user->user_username }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Default Password</p>
                            <p class="font-medium text-gray-800">{{ $user->default_password }}</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-3">
                        <form action="{{ route('submit-login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="username" value="{{ $user->user_username }}">
                            <input type="hidden" name="password" value="{{ $user->default_password }}">
                            <input type="hidden" name="fromAdmin" value="fromAdmin">
                            <button type="submit"
                                class="w-full md:w-auto inline-flex justify-center items-center px-5 py-2.5 text-sm font-semibold text-white   bg-blue-600 rounded-md shadow-md hover:bg-blue-700 transition">
                                Log in
                            </button>
                        </form>

                        <form action="{{ route('admin.reset.school_user.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->user_id }}">
                            <button type="submit"
                                class="w-full md:w-auto inline-flex justify-center items-center px-5 py-2.5 text-sm font-semibold   text-gray-700 bg-gray-100 rounded-md shadow-md hover:bg-gray-200 transition">
                                Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $users->links() }}
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
                    let cards = '';
                    if (data.length > 0) {
                        data.forEach(user => {
                            let resetPasswordRoute = resetPasswordRouteTemplate.replace(':id',
                                user.user_id);

                            cards += `
                                <div class="bg-gradient-to-br from-white to-gray-50 border border-gray-300 rounded-2xl p-6 shadow-md hover:shadow-md transition duration-300">
                                    <!-- Header -->
                                    <div class="grid grid-cols-3   items-center justify-between mb-6">

                        <div>
                        <img class="w-24 h-24 object-cover"
        src="${user.image_path ? '/school-logo/' + user.image_path : '/icon/logo.png'}"
                                alt="School Logo">
                        </div>
                        <div class="col-span-2">
                                            <h3 class="text-xl font-bold text-gray-900">${user.SchoolName}</h3>
                                            <div class="my-2">
                                                <span class="px-3 mt-2 py-1 text-xs font-medium text-white bg-blue-600 rounded-full">
                                                    ${user.SchoolLevel}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500">School ID: ${user.SchoolID}</p>
                                        </div>
                                    </div>

                                    <!-- Body -->
                                    <div class="space-y-4">
                                        <div class="flex justify-between">
                                            <p class="text-sm text-gray-500">Username</p>
                                            <p class="font-medium text-gray-800">${user.user_username}</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-sm text-gray-500">Default Password</p>
                                            <p class="font-medium text-gray-800">${user.default_password}</p>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t border-gray-200 my-6"></div>

                                    <!-- Actions -->
                                    <div class="flex flex-wrap gap-3">
                                        <form action="${submitLoginRoute}" method="POST">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <input type="hidden" name="username" value="${user.user_username}">
                                            <input type="hidden" name="password" value="${user.default_password}">
                                            <input type="hidden" name="fromAdmin" value="fromAdmin">
                                            <button type="submit"
                                                class="w-full md:w-auto inline-flex justify-center items-center px-5 py-2.5 text-sm font-semibold text-white border border-gray-300 bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 transition">
                                                Log in
                                            </button>
                                        </form>

                                        <form action="${resetPasswordRoute}" method="POST">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="id" value="${user.user_id}">
                                            <button type="submit"
                                                class="w-full md:w-auto inline-flex justify-center items-center px-5 py-2.5 text-sm font-semibold border border-gray-300 text-gray-700 bg-gray-100 rounded-md shadow-sm hover:bg-gray-200 transition">
                                                Reset Password
                                            </button>
                                        </form>
                                    </div>
                                </div>`;

                        });
                    } else {
                        cards = `<p class="text-center text-gray-500 col-span-3">No results found.</p>`;
                    }

                    $('#schoolUsersCardContainer').html(cards);
                }
            });
        });
    </script>
@endsection

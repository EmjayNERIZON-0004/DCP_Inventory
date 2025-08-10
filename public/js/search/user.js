const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const submitLoginRoute = window.appRoutes.submitLogin;
$('#searchSchoolUser').on('keyup', function () {
    const keyword = $(this).val();

    $.ajax({
        url: '/Admin/SchoolUser/search',
        type: 'GET',
        data: { query: keyword },
        success: function (data) {
            let rows = '';
            if (data.length > 0) {
                data.forEach(user => {
                    rows += `
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 border-r border-gray-200">${user.SchoolID}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-200">${user.SchoolName}</td>
                                <td class="px-4 py-3 border-r border-gray-200">${user.SchoolLevel}</td>
                                <td class="px-4 py-3 border-r border-gray-200">${user.user_username}</td>
                                <td class="px-4 py-3">${user.default_password}</td>
                                    <td class="px-4 py-3">
                                <div class="flex justify-center">
                                    <form action="${submitLoginRoute}" method="POST">
                                      <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="text" id="username" name="username" required
                                            value="${user.user_username}"
                                            class="w-full hidden px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <input type="text" id="password" name="password" required
                                            value="${user.default_password}"
                                            class="w-full px-3 hidden py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500 pr-10">
                                       <input type="text" value="fromAdmin" name="fromAdmin">
                                            <button type="submit" class="bg-blue-600 rounded-md px-4 py-1 text-white">Log in
                                        </button>
                                    </form>
                                </div>

                            </td>
                            </tr>
                        `;
                });
            } else {
                rows = `<tr><td colspan="5" class="px-4 py-3 text-center text-gray-500">No results found.</td></tr>`;
            }

            $('#schoolUsersTableBody').html(rows);
        }
    });
}); 

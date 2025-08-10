
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$('#searchSchool').on('keyup', function () {
    const keyword = $(this).val();

    $.ajax({
        url: '/Admin/schools/search',
        type: 'GET',
        data: { query: keyword },
        success: function (data) {
            let rows = '';
            if (data.length > 0) {
                data.forEach(school => {
                    rows += `
                        <tr id="row-${school.pk_school_id}" class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-r border-gray-200">${school.SchoolID}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-200">${school.SchoolName}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${school.SchoolLevel}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${school.PrincipalName ?? ''}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${school.SchoolContactNumber ?? ''}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${school.SchoolEmailAddress ?? ''}</td>
                            <td class="px-4 py-3 border-r border-gray-200">${school.last_login ?? ''}</td>
                            <td class="px-4 py-3 border-r border-gray-200">
                                <form action="/send-mail/${school.pk_school_id}" method="POST">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-4 rounded">
                                        Notify
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-col gap-2 items-stretch">
                                    <a href="/schools/${school.pk_school_id}"
                                        class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 text-center">
                                        View
                                    </a>
                                    <button
                                        onclick="showEditSchoolForm(
                                            '${school.pk_school_id}',
                                            '${school.SchoolID}',
                                            '${school.SchoolName}',
                                            '${school.SchoolLevel}',
                                            '${school.SchoolEmailAddress}'
                                        )"
                                        class="px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded hover:bg-green-600 text-center">
                                        Edit
                                    </button>
                                    <button type="button" onclick="deleteSchool('${school.pk_school_id}')"
                                        class="px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600 text-center">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                });
            } else {
                rows = `<tr><td colspan="8" class="text-center text-gray-500 px-4 py-3">No results found.</td></tr>`;
            }
            $('#schoolTableBody').html(rows);
        }
    });
});

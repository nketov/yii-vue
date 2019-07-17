$(document).ready(function () {

    $('body').on('click', '#project-table tbody tr td:not(:last-child)',
        function () {
            var action_id = $(this).closest('tr').data('key');
            location.href = '/admin/project/update?id=' + action_id;
        }
    );


});


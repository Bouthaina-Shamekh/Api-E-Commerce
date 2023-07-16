let host = document.location;

let TableUrl = new URL('/admin/contact', host.origin);
var table = $('#get_contact').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "title", name: "title" },
        { data: "message", name: "message" },
        { data: "user.name", name: "user.name" },
        { data: "action", name: "action" },
    ]
});

let DeleteUrl = new URL('admin/contact', host.origin);
$(document).on('click', '#showModalDeleteContact', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    console.log(id);
    $('#modalContactDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteContact").on("click", "#deleteContact", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: DeleteUrl + '/' + id,
            data: '',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == false) {
                    // errors
                    $('#list_error_message3').html("");
                    $('#list_error_message3').addClass("alert alert-danger");
                    $('#list_error_message3').text(response.message);
                } else {
                    $('#error_message').html("");
                    $('#error_message').addClass("alert alert-success");
                    $('#error_message').text(response.message);
                    $('#modalContactDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

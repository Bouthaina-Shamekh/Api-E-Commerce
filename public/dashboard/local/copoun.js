let host = document.location;

let TableUrl = new URL('/admin/copoun', host.origin);
var table = $('#get_copoun').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "code", name: "code" },
        { data: "discount", name: "discount" },
        { data: "status", name: "status" },
        { data: "action", name: "action" },
    ]
});
//  view modal copoun
$(document).on('click', '#ShowModalCopoun', function (e) {
    e.preventDefault();
    $('#modalCopounAdd').modal('show');
});

let AddUrl = new URL('admin/copoun', host.origin);
// copoun admin
$(document).on('click', '#addCopoun', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formCopounAdd')[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: AddUrl,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == false) {
                // errors
                $('#list_error_message').html("");
                $('#list_error_message').addClass("alert alert-danger");
                $('#list_error_message').text(response.message);
            } else {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-success");
                $('#error_message').text(response.message);
                $('#modalCopounAdd').modal('hide');
                $('#formCopounAdd')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let EditUrl = new URL('admin/copoun', host.origin);
// view modification data
$(document).on('click', '#showModalEditCopoun', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalCopounUpdate').modal('show');
    $.ajax({
        type: 'GET',
        url: EditUrl + '/' + id + '/edit',
        data: "",
        success: function (response) {
            if (response.status == 404) {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id').val(id);
                $('#code').val(response.data.code);
                $('#discount').val(response.data.discount);
                $("#status option[value='" + response.data.status + "']").prop("selected", true);
            }
        }
    });
});

let UpdateUrl = new URL('admin/copoun', host.origin);
$(document).on('click', '#updateCopoun', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formCopounUpdate')[0]);
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: UpdateUrl + '/' + id,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == false) {
                // errors
                $('#list_error_message2').html("");
                $('#list_error_message2').addClass("alert alert-danger");
                $('#list_error_message2').text(response.message);
            } else {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-success");
                $('#error_message').text(response.message);
                $('#modalCopounUpdate').modal('hide');
                $('#formCopounUpdate')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let DeleteUrl = new URL('admin/copoun', host.origin);
$(document).on('click', '#showModalDeleteCopoun', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    console.log(id);
    $('#modalCopounDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteCopoun").on("click", "#deleteCopoun", function (e) {
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
                    $('#modalCopounDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

let statusUrl = new URL('admin/status/copoun', host.origin);
$(document).on('click', '#status', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: statusUrl + '/' + id,
        data: "",
        success: function (response) {
            if (response.status == 400) {
                // errors
                $('#list_error_message3').html("");
                $('#list_error_message3').addClass("alert alert-danger");
                $('#list_error_message3').text(response.message);
            } else {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-success");
                $('#error_message').text(response.message);
                table.ajax.reload(null, false);
            }
        }
    });
});

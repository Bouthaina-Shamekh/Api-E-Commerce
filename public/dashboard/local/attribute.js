let host = document.location;

let TableUrl = new URL('/admin/attribute', host.origin);

let pathSegments = host.pathname.split('/');
let currentLang = pathSegments[1];
if (currentLang !== 'ar' && currentLang !== 'en') {
    currentLang = 'en';
}

var table = $('#get_attribute').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "title_"+currentLang , name: "title_"+currentLang },
        { data: "action", name: "action" },
    ]
});
//  view modal Category
$(document).on('click', '#ShowModalCategory', function (e) {
    e.preventDefault();
    $('#modalAttributeAdd').modal('show');
});

let AddUrl = new URL('admin/attribute', host.origin);
// category admin
$(document).on('click', '#addAttribute', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formAttributeAdd')[0]);
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
                $('#modalAttributeAdd').modal('hide');
                $('#formAttributeAdd')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let EditUrl = new URL('admin/attribute', host.origin);
// view modification data
$(document).on('click', '#showModalEditAttribute', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalAttributeUpdate').modal('show');
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
                $('#title_en').val(response.data.title_en);
                $('#title_ar').val(response.data.title_ar);

            }
        }
    });
});

let UpdateUrl = new URL('admin/attribute', host.origin);
$(document).on('click', '#updateAttribute', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formAttributeUpdate')[0]);
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
                $('#modalAttributeUpdate').modal('hide');
                $('#formAttributeUpdate')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let DeleteUrl = new URL('admin/attribute', host.origin);
$(document).on('click', '#showModalDeleteAttribute', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    console.log(id);
    $('#modalAttributeDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteAttribute").on("click", "#deleteAttribute", function (e) {
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
                    $('#modalAttributeDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}








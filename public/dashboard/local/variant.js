let host = document.location;

let TableUrl = new URL('/admin/variant', host.origin);

let pathSegments = host.pathname.split('/');
let currentLang = pathSegments[1];
if (currentLang !== 'ar' && currentLang !== 'en') {
    currentLang = 'en';
}

var table = $('#get_variant').DataTable({
    processing: true,
    ajax: TableUrl,
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" },
        { data: "product_name", name: "product_name" },
        { data: "image", name: "image" },
        { data: "price", name: "price" },
        { data: "discount", name: "discount" },
        { data: "attribute", name: "attribute" },
        { data: "action", name: "action" },
    ]
});
//  view modal variant
//  $(document).on('click', '#ShowModalVariant', function (e) {
//      e.preventDefault();
//     $('#modalVariantAdd').modal('show');
//  });

let AddUrl = new URL('admin/variant', host.origin);
// variant admin
$(document).on('click', '#addVariant', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formVariantAdd')[0]);
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
                $('#modalCategoryAdd').modal('hide');
                $('#formCategoryAdd')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let EditUrl = new URL('admin/variant', host.origin);
// view modification data
$(document).on('click', '#showModalEditVariant', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalVariantUpdate').modal('show');
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
                $("#status option[value='" + response.data.status + "']").prop("selected", true);
            }
        }
    });
});

let UpdateUrl = new URL('admin/variant', host.origin);
$(document).on('click', '#updateVariant', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formVariantUpdate')[0]);
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
                $('#modalVariantUpdate').modal('hide');
                $('#formVariantUpdate')[0].reset();
                table.ajax.reload(null, false);
            }
        }
    });
});

let DeleteUrl = new URL('admin/variant', host.origin);
$(document).on('click', '#showModalDeleteVariant', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    console.log(id);
    $('#modalVariantDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteVariant").on("click", "#deleteVariant", function (e) {
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
                    $('#modalVariantDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

// let statusUrl = new URL('admin/status/category', host.origin);
// $(document).on('click', '#status', function (e) {
//     e.preventDefault();
//     var id = $(this).data('id');
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type: 'PUT',
//         url: statusUrl + '/' + id,
//         data: "",
//         success: function (response) {
//             if (response.status == 400) {
//                 // errors
//                 $('#list_error_message3').html("");
//                 $('#list_error_message3').addClass("alert alert-danger");
//                 $('#list_error_message3').text(response.message);
//             } else {
//                 $('#error_message').html("");
//                 $('#error_message').addClass("alert alert-success");
//                 $('#error_message').text(response.message);
//                 table.ajax.reload(null, false);
//             }
//         }
//     });
// });

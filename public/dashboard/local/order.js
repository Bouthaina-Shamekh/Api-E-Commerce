let host = document.location;

let TableUrl = new URL('/admin/order', host.origin);

let pathSegments = host.pathname.split('/');
let currentLang = pathSegments[1];
if (currentLang !== 'ar' && currentLang !== 'en') {
    currentLang = 'en';
}

var table = $('#get_order').DataTable({
    processing: true,
    serverSide: true,
    ajax: TableUrl,
    ajax: {
        url: TableUrl,
        data: function (d) {
            d.userId = $('select[name=user_h]').val();
            d.statusId = $('select[name=status_h]').val();
            d.fromId = $('#from_1_h').val();
            d.toId = $('#to_1_h').val();
            d.fromId2 = $('#from_2_h').val();
            d.toId2 = $('#to_2_h').val();

        }
    },


    columns: [

        { data: "user_id", name: "user_id" },
        { data: "copoun_id", name: "copoun_id" },
        { data: "address_id", name: "address_id" },
        { data: "total", name: "total"},
        { data: "discount", name: "discount" },
        { data: "price", name: "price" },

        {"mRender": function ( data, type, row ) {
            var sel = '<select style="width:120px" onchange="myFunction(this)" id="'+row.id+'" name="print_e" class="form-control">';
            var op1 = '<option value="pending">pending</option>';
            if(row.status=='pending'){
                op1 = '<option selected value="pending">pending</option>';
            }
            var op2 = '<option value="processing"> processing</option>';
            if(row.status=='processing'){
                op2 = '<option selected value="processing">processing</option>';
            }
            var op3 = '<option value="shipped">shipped</option>';
            if(row.status=='shipped'){
                op3 = '<option selected value="shipped">shipped</option>';
            }
            var op4 = '<option value="cancelled">cancelled</option>';
            if(row.status=='cancelled'){
                op4 = '<option selected value="cancelled">cancelled</option>';
            }
            var op5 = '<option value="completed">completed</option>';
            if(row.status=='completed'){
                op5 = '<option selected value="completed">completed</option>';
            }
            var se = '</select>';

            var all = sel + op1 + op2 + op3 +op4 +op5 + se;

            return all;
        }
        ,orderable: false},
        { data: "payment_status", name: "payment_status"},
        { data: "action", name: "action" },

    ]
});

   //filtering
   $('#user_h').change(function() {
    table.draw();
});

$('#status_h').change(function() {
    table.draw();
});

$('#search_1_h').click(function(e) {
    e.preventDefault();
    table.draw();
});

$('#search_2_h').click(function(e) {
    e.preventDefault();
    table.draw();
});




function myFunction(selectID) {
    var status=selectID.value;
    var id=selectID.id;
    $.get("/admin/order/Status/"+id+"/"+status);
       not7();
}

//  view modal Category
$(document).on('click', '#ShowModalCategory', function (e) {
    e.preventDefault();
    $('#modalCategoryAdd').modal('show');
});

let AddUrl = new URL('admin/category', host.origin);
// category admin
$(document).on('click', '#addCategory', function (e) {
    e.preventDefault();
    let formdata = new FormData($('#formCategoryAdd')[0]);
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


let DeleteUrl = new URL('admin/order', host.origin);
$(document).on('click', '#showModalDeleteOrder', function (e) {
    e.preventDefault();
    $('#nameDetele').val($(this).data('name'));
    var id = $(this).data('id');
    console.log(id);
    $('#modalOrderDelete').modal('show');
    gg(id);
});
function gg(id) {
    $(document).off("click", "#deleteOrder").on("click", "#deleteOrder", function (e) {
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
                    $('#modalOrderDelete').modal('hide');
                    table.ajax.reload(null, false);
                }
            }
        });
    });
}

let statusUrl = new URL('admin/status/category', host.origin);
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

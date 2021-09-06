var myTable;
$(document).ready(function(){
    data_table();
    $('#frmEmployee').validate({
        errorElement: 'span',
        rules: {
            employee_id: {required: true},
        },
        messages: {
            employee_id: {required: "Please select employee"},
        }
    });
});

$(document).on('submit','#frmEmployee', function (e) {
    e.preventDefault();
    var myform = $("#frmEmployee");
    var url = myform.attr("action");
    var fd = new FormData(document.getElementById("frmEmployee"));
    $(".loader").show();
    $.ajax({
        url: url,
        type: myform.attr("method"),
        dataType: "JSON",
        data: fd,
        processData: false,
        contentType: false,
        success: function (data, status)
        {
            if(data.success == 1)
            {
                toastr.success(data.message);
                $('#frmEmployee')[0].reset();
                myTable.ajax.reload();
            }
            else
            {
                toastr.error(data.message);
            }
            $(".loader").hide();
        },
        error: function (xhr, desc, err)
        {
            toastr.error(desc);
        }
    });
})


function data_table()
{
    $.fn.dataTable.ext.errMode = 'none';
    myTable = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "employee/ajax"
        },
        "order": [],
        "ordering": false,
        // "searching": false,
        // 'displayLength' : 1,
        columns: [
            {data: 'id', name: 'id', orderable: false},
            {data: 'name', name: 'name', orderable: false},
            {data: 'punchin_date', name: 'punchin_date', orderable: false},
            {data: 'punchin_time', name: 'punchin_time', orderable: false},
            {data: 'punchout_date', name: 'punchout_date', orderable: false},
            {data: 'punchout_time', name: 'punchout_time', orderable: false},
            {data: 'action', name: 'action', orderable: false},
        ],
        oLanguage: {
            sSearch: "",
            sSearchPlaceholder: "Search",
            sEmptyTable: "No data found.",
            sProcessing: '<div class="loader"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div>'
        }
    });
    $('.dataTables_filter input').addClass('form-control');
    $('.dataTables_length select').addClass('form-control');
    $('.dataTables_length select').css("display","inline");
    $('.dataTables_length select').css("width","auto");
}

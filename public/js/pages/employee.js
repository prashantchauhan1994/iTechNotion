$(document).ready(function(){
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

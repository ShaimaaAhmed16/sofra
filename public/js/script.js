$(document).on('click','.destroy',function(){
    var route   = $(this).data('route');
    var token   = $(this).data('token');
    $.confirm({
        icon                : 'glyphicon glyphicon-floppy-remove',
        animation           : 'rotateX',
        closeAnimation      : 'rotateXR',
        title               : 'Confirm the deletion process',
        autoClose           : 'cancel|6000',
        text             : 'Are you sure you want to delete this records?',
        confirmButtonClass  : 'btn-outline',
        cancelButtonClass   : 'btn-outline',
        confirmButton       : 'delete',
        cancelButton        : 'cancel',
        dialogClass         : "modal-danger modal-dialog",
        confirm: function () {
            $.ajax({
                url     : route,
                type    : 'post',
                data    : {_method: 'delete', _token :token},
                dataType:'json',
                success : function(data){
                    if(data.status == 0)
                    {
                        //toastr.error(data.msg)
                        swal("error!", data.msg, "error")
                    }else{
                        $("#removable"+data.id).remove();
                        swal("success!", data.msg, "success")
                        //toastr.success(data.msg)
                    }
                }
            });
        },
    });
});












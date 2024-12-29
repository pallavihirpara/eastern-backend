
$(document).ready(function(){
    $(".swal-footer").addClass("text-center");
});
$(function () {
    $('body').on('keydown', 'input', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }  
    });
    $('body').on('keydown', 'textarea', function(e) {
        if (e.which === 32 &&  e.target.selectionStart === 0) {
            return false;
        }  
    });
});


function statusChange(id)
{
    swal({
        title: "Are you sure?",
        text: "Do you really want to change status?",
        icon: "warning",
        buttons: ["Cancel", "Change Now"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type:'POST',
                url: statusRoute,
                data:{id:id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                if(data == 1)
                {
                    swal({
                        title: "Status",
                        text: "The status has been changed!",
                        icon: "success",
                    });
                    location.reload(true);
                }else{
                        swal("The status is not changed!");
                    }
                }
            });
        } else {
            swal("The list is not changed!");
        }
    });
}
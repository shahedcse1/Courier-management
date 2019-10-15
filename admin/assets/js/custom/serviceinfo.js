function editservice(id) {
    $('#editval').val(id);
    $.ajax({
        type: 'POST',
        url: base_url + "services/editservice",
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (response) {

            $('#service_name').val(response.service_name);
            $('#description').val(response.description);
            $('#link').val(response.link);
        }

    });
    $('#editmodal').modal('show');
}
$(document).ready(function () {
    $('.item_delete').click(function () {
        var id = $(this).val();

        swal({
            title: "Are you sure to delete?",
            text: "You will not be able to recover this!",
            icon: "warning",
            buttons: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            dangerMode: true,
        })
            .then((willDelete) => {
                if (!willDelete)
                    return;

                $.ajax({
                    url : base_url + "services/deleteService",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function () {
                        swal("Done!", "It was succesfully deleted!", "success");
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
                });
            });
    });
});
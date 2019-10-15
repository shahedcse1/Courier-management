$('.requestReceive').click(function () {
    var id = $(this).parent().parent().attr('data-id');

    swal({
        title: "Are you sure about the payment?",
        text: "You will not be able to recover this!",
        icon: "warning",
        buttons: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, collect from the delivery man!",
        dangerMode: true,
    })
        .then((willDelete) => {
            if (!willDelete)
                return;

            $.ajax({
                url : base_url + "accounts/collectfromdeliveryman",
                type: "POST",
                data: {
                    id: id,
                },
                success: function () {
                    swal("Done!", "Successfully updated!", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error updating!", "Please try again", "error");
                }
            });
        });
});
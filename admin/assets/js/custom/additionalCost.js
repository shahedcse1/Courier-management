$('.date-picker').datepicker( {
    format: "dd/mm/yyyy",
    endDate : new Date()
});

$('.cost_delete').click(function () {
    var id = $(this).parent().parent().attr('data-id');

    swal({
        title: "Are you sure to delete this cost?",
        text: "You will not be able to recover this!",
        icon: "warning",
        buttons: true,
        confirmButtonColor: "#DD6B55",
        dangerMode: true,
    })
        .then((willDelete) => {
            if (!willDelete)
                return;

            $.ajax({
                url : base_url + 'accounts/deletecost/' + id,
                type: "DELETE",
                dataType: 'json',
                success: function (response) {
                    if (response.error) {
                        swal(response.message, {
                            icon: "error",
                        });
                    } else {
                        swal(response.message, {
                            icon: "success",
                        });
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                }
            });
        });
});

$('.cost_edit').click(function () {
    var id = $(this).parent().parent().attr('data-id');

    $.ajax({
        type: 'GET',
        url: base_url + 'accounts/editcost/' + id,
        dataType: 'json',
        cache: false,
        success: function (response) {
            if (response.error) {
                $('#alertMsg').html(response.message);
            } else {
                $('#additionalCostId').val(response.costs.id);
                $('#editDateOfCost').val(moment(response.costs.date, 'YYYY-MM-DD').format('DD/MM/YYYY'));
                $('#editPurpose').html(response.costs.purpose);
                $('#editAmount').val(Math.abs(parseFloat(response.costs.amount)).toFixed(2));
            }
        }
    });

    $('#editmodal').modal('show');
});
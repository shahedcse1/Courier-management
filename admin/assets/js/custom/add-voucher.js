$(document).ready(function() {
    $('#summernote').summernote({
        height: 100
    });
});

$('#marchent_name').change(function() {
    $("#trackId").html('');
    var userId = $("#marchent_name").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: base_url + 'accounts/payableproducts',
        data: {
            userId: userId
        },
        success: function(data) {
            var payableList = '';
            for (var i = 0; i < data.length; i++) {
                payableList += '<label for="tracking' + data[i].trackingId + '"><input type="checkbox" ' +
                        'class="payable-list" ' +
                        'data-id="' + data[i].id + '" ' +
                        'name="tracking[]" ' +
                        'id="tracking' + data[i].trackingId + '" ' +
                        'value="' + data[i].id + '" /> ' + data[i].trackingId + '--৳' + data[i].price + ' -- From ' + data[i].customer_name + '</label><br />';

            }
            $("#trackId").html(payableList);

        }
    });
});

$(document).on('change', '.payable-list', function() {
    var amount = '',
            newAmount = '',
            thisVar = $(this),
            id = thisVar.data('id');

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: base_url + 'accounts/payableproduct',
        data: 'id=' + id,
        success: function(data) {
            amount = parseFloat($('#amount').val());

            if (thisVar.is(':checked')) {
                newAmount = parseFloat(data.price) + amount;
            } else {
                newAmount = parseFloat(data.price) - amount;
            }
            $('#amount').val(Math.abs(parseFloat(newAmount)).toFixed(2));
        }
    });
});
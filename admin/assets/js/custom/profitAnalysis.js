$('#monthOfProfitForm').submit(function(e){
    e.preventDefault();

    var month = $('#monthOfProfit').val();

    $.ajax({
        url : base_url + "accounts/monthofprofit",
        type: "POST",
        dataType: 'json',
        data: {
            month: month
        },
        success: function (response) {
            $('#debit').html(Math.abs(parseFloat(response.debit)).toFixed(2));
            $('#credit').html(Math.abs(parseFloat(response.credit)).toFixed(2));

            var profit = response.debit - response.credit;

            $('#profit').html(profit > 0 ? 'Dr. ৳ ' + Math.abs(parseFloat(profit)).toFixed(2) : 'Cr. ৳ ' + Math.abs(parseFloat(profit)).toFixed(2));

            $('#showProfit').show();
        },
        error: function () {

        }
    });
});
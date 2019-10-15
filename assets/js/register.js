$('#registerForm').submit(function(e) {
    e.preventDefault();

    var form_data = new FormData($(this)[0]);
    $.ajax({
        url: base_url + 'home/registermerchant',
        type: 'POST',
        dataType: 'json',
        data: form_data,
        processData: false,
        contentType: false,
        error: function(response) {
        },
        success: function(response) {
            if (response.error) {
                $('#reg-validation-alert').html('<div class="alert alert-danger text-center">' + response.message + '</div>');
            } else {

                $('#reg-validation-alert').html('<div class="alert alert-success text-center">' + response.message + '</div>');
                var userpin = response.pin;
                var password = response.pass;
                window.setTimeout(function() {
                    window.location = base_url + 'admin/auth/logindirect?userpin=' + userpin + '&password=' + password;
                }, 1000);
            }
        }
    });
});
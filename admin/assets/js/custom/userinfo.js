function passresetmodal(userid) {
    $('#userid').val(userid);
    $('#myModal').modal('show');
}
function edituser(userid) {
    $('#editval').val(userid);
    $.ajax({
        type: 'POST',
        url: base_url + "userinfo/edituser",
        dataType: 'json',
        data: {
            id: userid
        },
        cache: false,
        success: function (response) {
            $('#name').val(response.name);
            $('#email').val(response.email);
            $('#company_name').val(response.company_name);
            $('#user_pin').val(response.user_pin);
            $('#phone').val(response.phone);
            $('#address').val(response.address);
            $('#status').val(response.status).change();


            var image=response.image_path;
            if (image == '') {
                $('#upload_image').html( '<img src="'+base_url+'uploads/'+'login.png'+'" style="width: 200px;"/>');

            } else {
                $('#upload_image').html( '<img src="'+base_url+'uploads/'+response.image_path+'" style="width: 200px;"/>');
            }

            var userrole = response.role_id;
            var dropdown = $('#role');
            dropdown.empty();

            var sel = document.getElementById('role');

            for (var i = 0; i < response.userrole.length; i++) {

                select =  document.getElementById('role');
                var opt = document.createElement('option');
                if (userrole == response.userrole[i].id) {
                    opt.selected = true;
                } else {
                    opt.selected = false;
                }
                opt.value = response.userrole[i].id;
                opt.innerHTML = response.userrole[i].role_name;
                sel.appendChild(opt);
            }
        }

    });
    $('#editmodal').modal('show');
}
function updatePassword() {

    var npassword = $("#npassword").val();
    var rpassword = $("#rpassword").val();

    if (npassword == '') {
        $("#update_cpassword").text("");
        $("#update_npassword").css('color', 'red');
        $("#update_npassword").text("New Password required !!!");
        return false;
    }
    else if (rpassword == '') {
        $("#update_npassword").text("");
        $("#update_rpassword").css('color', 'red');
        $("#update_rpassword").text("Repeat Password required !!!");
        return false;
    }
    else if (npassword != rpassword) {
        $("#update_rpassword").text("");
        $("#update_rpassword").css('color', 'red');
        $("#update_rpassword").text("Password not match !!!");
        return false;
    }
    else {
        return true;
    }
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
                    url : base_url + "userinfo/deleteUser",
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
$('#newUserPin').change(function () {
    var pin = $(this).val();
    $.ajax({
        type: 'GET',
        url: base_url + 'userinfo/checkpin',
        data: {
            pin : pin
        },
        success: function (response) {
            if(response === '1'){
                $('#addUserMessage').hide();
                $("#alertMsg").text('');
                $('#add').removeAttr("disabled");
            } else {
                $('#addUserMessage').show();
                $("#alertMsg").text("Your given pin exist in our system. Please try another one.");
                $('#add').attr("disabled", true);
            }
        }
    });
});

$('#user_pin').change(function () {
    var pin = $(this).val();
    var id = $('#editval').val();
    $.ajax({
        type: 'GET',
        url: base_url + 'userinfo/changepin',
        data: {
            pin : pin,
            id: id
        },
        cache: false,
        success: function (response) {
            if(response === '1'){
                $("#pinval").css('color', 'green').text("Valid User Pin !!!");
                $('#submitpin').removeAttr("disabled");
            }else{
                $("#pinval").css('color', 'red').text("Already Exist User Pin !!!");
                $('#submitpin').attr("disabled", true);
            }
        }


    });
});


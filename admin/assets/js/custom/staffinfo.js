$(document).ready(function() {
    $('#category_one').hide();
    $('#category_two').hide();
});
$('#category').change(function() {

    var category = $(this).val();

    if (category == 1 || category == 2) {
        $('#category_two').hide();
        $('#category_one').show();
        $('#zone').val('');
        $('#area').val('');
    }
    else if (category == 3) {
        $('#category_one').hide();
        $('#category_two').show();
        $('#position').val('');
        $('#fb').val('');
        $('#twitter').val('');
        $('#google').val('');
        $('#linkdin').val('');

    }
    else {
        $('#category_one').hide();
        $('#category_two').hide();
    }

});

$('select[name="zone"]').change(function() {
    var id = $(this).val();

    $.ajax({
        type: 'GET',
        url: base_url + 'staffs/getarea',
        dataType: 'json',
        data: {
            zone: id
        },
        cache: false,
        success: function(response) {
            console.log(response);
            $("select#area option")
                    .remove();
            $('select#area')
                    .append($("<option value=''>-- Select --</option>"))
            $.each(response, function(key, value) {
                $('select#area')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.area_name));

            });
        }
    });
});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
$('#categoryid').change(function() {
    var category = $(this).val();
    if (category == 1 || category == 2) {
        $('#category_2').hide();
        $('#category_1').show();
        $('#zoneid').val('');
        $('#areaid').val('');
    }
    else if (category == 3) {
        $('#category_1').hide();
        $('#category_2').show();
        $('#pos').val('');
        $('#facebook').val('');
        $('#twit').val('');
        $('#goog').val('');
        $('#link').val('');
    }
    else {
        $('#category_1').hide();
        $('#category_2').hide();
    }

});

$('#zoneid').change(function() {
    var id = $(this).val();
    if (id == 10) {
        $("#area_name").hide();
        $("#district_name").show();
    }
    else {
        $("#district_name").hide();
        $("#area_name").show();
    }

    $.ajax({
        type: 'GET',
        url: base_url + 'staffs/getarea',
        dataType: 'json',
        data: {
            zone: id
        },
        cache: false,
        success: function(response) {
            console.log(response);
            $("select#areaid option")
                    .remove();
            $('select#areaid')
                    .append($("<option value=''>-- Select --</option>"))
            $.each(response, function(key, value) {
                $('select#areaid')
                        .append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.area_name));

            });
        }
    });
});

$(document).ready(function() {
    $('#infomodal').modal('show');
});

function calculate_net() {
    var price = $('#p_price').val();
    var quantity = $('#quantity').val();
    if (price != '' && quantity != '') {
        var netprice = price * quantity;
        document.getElementById('total_price').value = netprice;
        $("#takadiv").show();
    }
    else {
        alert('please set product Price');
    }
}
function editstaff(id) {
    $('#editval').val(id);
    $.ajax({
        type: 'POST',
        url: base_url + "staffs/editstaff",
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function(response) {
            $('#name').val(response.name);
            $('#phone').val(response.phone);
            $('#address').val(response.address);

            var image = response.image_path;
            if (image == '') {
                $('#upload_image').html('<img src="' + base_url + 'uploads/' + 'login.png' + '" style="width: 100px;"/>');

            } else {
                $('#upload_image').html('<img src="' + base_url + 'uploads/' + response.image_path + '" style="width: 100px;"/>');
            }

            var category = response.category;
            var dropdown = $('#categoryid');
            dropdown.empty();

            var sel = document.getElementById('categoryid');
            for (var i = 0; i < response.staffcategory.length; i++) {
                select = document.getElementById('categoryid');
                var opt = document.createElement('option');
                if (category == response.staffcategory[i].id) {
                    opt.selected = true;
                } else {
                    opt.selected = false;
                }
                opt.value = response.staffcategory[i].id;
                opt.innerHTML = response.staffcategory[i].staff_category;
                sel.appendChild(opt);
            }
            if (category == 1 || category == 2) {

                $('#pos').val(response.position);
                $('#facebook').val(response.fb);
                $('#twit').val(response.twitter);
                $('#goog').val(response.google);
                $('#link').val(response.linkedin);

                $('#category_2').hide();
                $('#category_1').show();
            }
            else if (category == 3) {

                $('#category_1').hide();
                $('#category_2').show();

                var zone = response.zone;
                var dropdown = $('#zoneid');
                dropdown.empty();

                var sel = document.getElementById('zoneid');
                for (var i = 0; i < response.zones.length; i++) {
                    select = document.getElementById('zoneid');
                    var opt = document.createElement('option');
                    if (zone == response.zones[i].id) {
                        opt.selected = true;
                    } else {
                        opt.selected = false;
                    }
                    opt.value = response.zones[i].id;
                    opt.innerHTML = response.zones[i].zone_name;
                    sel.appendChild(opt);
                }

                var area = response.area;
                var dropdown = $('#areaid');
                dropdown.empty();

                var sel = document.getElementById('areaid');

                opt.value = '';
                opt.innerHTML = '--Select--';
                sel.appendChild(opt);
                for (var i = 0; i < response.areas.length; i++) {
                    select = document.getElementById('areaid');
                    var opt = document.createElement('option');
                    if (area == response.areas[i].id) {
                        opt.selected = true;
                    } else {
                        opt.selected = false;
                    }
                    opt.value = response.areas[i].id;
                    opt.innerHTML = response.areas[i].area_name;
                    sel.appendChild(opt);
                }
            }
            else {
                $('#category_1').hide();
                $('#category_2').hide();
            }
        }

    });
    $('#editmodal').modal('show');
}
$(document).ready(function() {
    $('.item_delete').click(function() {
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
                    url: base_url + "staffs/deletestaff",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function() {
                        swal("Done!", "It was succesfully deleted!", "success");
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
                });
            });
    });
});
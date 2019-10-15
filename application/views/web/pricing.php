<article> 
 
    <section class="calculate pt-100">
        <div class="theme-container container">  
            <span class="bg-text right wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> calculate </span>
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="<?= base_url('assets/img/block/Courier-Man.png') ?>" alt="" class="wow slideInLeft" data-wow-offset="50" data-wow-delay=".20s" />
                </div>
                <div class="col-md-6">   
                    <div class="pad-10"></div>
                    <h2 class="section-title pb-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" > calculate your cost </h2>
                    <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">Delivery Cost can be Changed On Special requirements.Please Contact with Authority For your Special requirements.</p>
                    <div class="calculate-form">
                        <form class="">
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <div class="col-sm-3"> <label for="location_from" class="title-2">Location From: </label></div>
                                <div class="col-sm-9"> <input  name="location_from" id="location_from" required="" style="color:black;" readonly="" type="text" value="Dhaka" class="form-control"> </div>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <div class="col-sm-3"> <label class="title-2"> Location To: </label></div>
                                <div class="col-sm-9" style="color:black;">
                                    <select  class="form-control selectpicker" name="location_to" required="" id="location_to" data-live-search="true" title="select">
                                        <?php foreach ($delivery_location as $value): ?>
                                            <option value="<?= $value->id ?>"><?= $value->location_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <div class="col-sm-3"> <label class="title-2">Weight: </label></div>
                                <div class="col-sm-9" style="color:black;">
                                    <select  class="selectpicker form-control" required="" name="weight" id="weight" data-live-search="true" title="select">
                                        <?php foreach ($weight_info as $value): ?>
                                            <option value="<?= $value->id ?>"><?= $value->weight ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <div class="col-sm-3"> <label class="title-2">Delivery Type: </label></div>
                                <div class="col-sm-9" style="color:black;">
                                    <select  class="selectpicker form-control" required="" id="d_type" name="d_type" data-live-search="true" title="select">
                                        <option value="0">Normal Delivery</option>
                                        <option value="1">Urgent Delivery</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="col-sm-4" id="checkCost" style="padding-left: 0">
                                        <button class="btn-1" type="button" style="background-color: #03a84e;padding: 10px 14px;">Check Cost</button>
                                    </div>
                                    <div class="col-sm-8" data-wow-offset="50" id="cost" data-wow-delay=".20s" style="background-color: #FAD91B; color: black; height: 50px; padding: 12px;" ></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="pt-80 hidden-lg"></div>
                </div>
            </div>
        </div>
    </section>


</article>

<script>
    $('#checkCost').click(function() {
        var locto = $("#location_to").val();
        var weight = $("#weight").val();

        $.ajax({
            type: "GET",
            url: "<?= base_url('home/get_cost'); ?>",
            data: {
                location_to: locto,
                weight: weight
            },
            success: function(data) {
                $('#cost').html(data);
            }
        });
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }



</script>

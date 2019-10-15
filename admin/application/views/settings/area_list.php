<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">All Area</div>
                    </div>
                    <div class="portlet-body">

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-toggle="modal"
                                    data-target="#addModal">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Add New Area
                            </button>
                        </div>

                        <br><br>
                        <?php
                        if ($this->session->userdata('add')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Congrats !!! </strong> ' . $this->session->userdata('add') . '</div>' . '<br>' . '<br>';
                            $this->session->unset_userdata('add');

                        elseif ($this->session->userdata('notadd')):
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('notadd') . '</div>';
                            $this->session->unset_userdata('notadd');
                        else:
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover text-center"
                                               id="sample_1">
                                            <thead class="table-background">
                                                <tr>
                                                    <th class="text-center">Serial</th>
                                                    <th class="text-center">Area Name</th>
                                                    <th class="text-center">Zone Name</th>
                                                    <th class="text-center">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (sizeof($areainfo)):
                                                    foreach ($areainfo as $value):
                                                        ?>
                                                        <tr>
                                                            <td><?= $value->id; ?></td>
                                                            <td><?= $value->area_name; ?></td>
                                                            <td><?= $value->zone_name; ?></td>
                                                            <td>
                                                                <button class="editmodal btn btn-primary btn-circle  btn-xs"
                                                                        onclick="editarea(<?= $value->id; ?>);">
                                                                    <i class="fa fa-pencil">Edit</i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="<?= base_url('settings/addarea'); ?>" method="post"
      enctype="multipart/form-data">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header table-background">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Area</h4>
                </div>
                <div class="modal-body col-md-12">
                    <div class="col-md-12">
                        <label class="form-group col-md-3">Zone Name :</label>
                        <div class="form-group col-md-6">
                            <Select class="form-control" name="zone_name"
                                    required>
                                <option value="">--Select--</option>
                                <?php
                                foreach ($zoneinfo as $value):
                                    ?>
                                    <option value="<?= $value->id ?>"><?= $value->zone_name ?></option>
                                <?php endforeach;
                                ?>
                            </select>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <label class="form-group col-md-3">Area Name :</label>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="area_name"
                                   required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary" id="add">Add 
                    </button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="<?= base_url('settings/updatearea'); ?>" method="post"
      enctype="multipart/form-data">
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header table-background">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Zone</h4>
                </div>
                <div class="modal-body col-md-12">
                    <div class="col-md-12">
                        <label class="form-group col-md-3">Zone Name :</label>
                        <div class="form-group col-md-6">
                            <input type="hidden" class="form-control" name="id" id="editval">
                            <Select class="form-control" name="zone_id"id="zone_name"
                                    required>
                                <option value="">--Select--</option>
                                <?php
                                foreach ($zoneinfo as $value):
                                    ?>
                                    <option value="<?= $value->id ?>"><?= $value->zone_name ?></option>
                                <?php endforeach;
                                ?>
                            </select>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <label class="form-group col-md-3">Area Name :</label>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="area_name" id="area_name"
                                   required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary" id="add">Update Area
                    </button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function editarea(id) {
        $('#editval').val(id);
        $.ajax({
            type: 'POST',
            url: base_url + "settings/editarea",
            dataType: 'json',
            data: {
                id: id
            },
            cache: false,
            success: function(response) {
                //  alert(response.zone_id);
                $('#zone_name').val(response.zone_id);
                $('#area_name').val(response.area_name);

            }

        });
        $('#editmodal').modal('show');
    }
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>QUALIFICATION</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-users"></i>Qualifications</li>
        </ol>
    </div>
</div>
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <header class="panel-heading">
                    Manage Qualification
                </header>
                <div class="panel-body">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('staff/save_qualification') ?>" name="qualification_form" id="qualification_form" autocomplete="off" novalidate>
                            <input type="hidden" id="qualification_id" name="qualification_id">
                            <br><br>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Qualification :</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="qualification" id="qualification" data-validation="required" data-validation-error-msg-required="Field is empty" name="stf_qualification">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description :</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <div class="col-md-3">
                                </div>
                                <button type="button" class="btn btn-info btn-md" name="submit_btn" id="submit_btn" onclick="submit_form();">Submit</button>
                                <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_id()">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel">
                <header class="panel-heading">
                    Look Up
                </header>
                <div class="panel-body">
                    <div class="col-md-12">

                        <table id="quali_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr bgcolor="#F0F8FF">
                                    <th>#</th>
                                    <th>Qualification</th>
                                    <!--<th>Description</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($qualifications)) {
                                    foreach ($qualifications as $row) {
                                        ?>
                                        <tr>
                                            <th><?php echo $row['id'] ?></th>
                                            <th><?php echo $row['qualification'] ?></th>
                                            <!--<th><?php //echo $row['description']  ?></th>-->
                                            <th>
                                                <button type="button" class="btn btn-info btn-xs" title="edit" data-original-title="Toggle Navigation" data-placement="bottom" onclick="edit_quali_load('<?php echo $row['id'] ?>', '<?php echo $row['qualification'] ?>', '<?php echo $row['description'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                                <?php if ($row['deleted']) { ?>
                                                    <button type="button" class="btn btn-success btn-xs" title="activate" onclick="change_status('<?php print_r($row['id']) ?>', '<?php print_r($row['qualification']) ?>', '0')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></th>
                                            <?php } else { ?>
                                        <button type="button" class="btn btn-warning btn-xs" title="deactivate" onclick="change_status('<?php print_r($row['id']) ?>','<?php print_r($row['qualification']) ?>', '1')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                    <?php } ?></tr>
                                <?php }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $.validate({
            form: '#qualification_form'
        });
        $(document).ready(function () {
            $('#quali_look').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });

        });

        function edit_quali_load(id, qual, des) {
            $('#qualification_id').val(id);
            $('#qualification').val(qual);
            $('#description').val(des);
        }
        function reset_id() {
            $('#qualification_id').val("");
        }
        function change_status(qualification_id, qualification, new_status)
        {
            $.post("<?php echo base_url('staff/change_qualification_status') ?>", {"qualification_id": qualification_id,"qualification":qualification,"new_status": new_status},
                    function (data)
                    {
                        location.reload();
                    },
                    "json"
                    );
        }

    function submit_form(){
        var qualification = $('#qualification').val();
        $.ajax(
            {
                url: "<?php echo base_url('staff/check_duplicate_qualification') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'qualification': qualification},
                success: function (data) {
                    if (data == true) {
                        funcres = {status: 'danger', message: 'Same Qualification exists. Please retry with another qualification name.'};
                        result_notification(funcres);
                    } else {
                       $('#qualification_form').submit();
                    }
                }
            });
    }
    </script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> HALL </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Exams and Assignments</li>
            <li><i class="fa fa-graduation-cap"></i>Hall</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Manage Halls
            </header>
            <div class="panel-body">
                <div class="col-md-12">	

                    <form class="form-horizontal" role="form" action="<?php echo base_url('hall/save_hall') ?>" method="post"  id="hall_form" autocomplete="off" novalidate>	
                        <div class="form-group">
                            <input type="hidden" name="hall_id" id="hall_id">
                            <label for="comcode" class="col-md-3 control-label">Center name</label>
                            <div class="col-md-7">
                                <select class="form-control" id="c_name" name="c_name" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    <option value="">---Select Center---</option>
                                    <?php foreach ($centers as $row) { ?>
                                        <option value="<?php echo $row['br_id'] ?>"><?php echo $row['br_code']."-".$row['br_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Hall Name:</label>
                            <div class="col-md-7">
                                <input type="text" height="70"  class="form-control" id="h_name" name="h_name"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                            <div class="col-md-7">
                                <input type="text" height="70"  class="form-control" id="des" name="des" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button onclick="event.preventDefault();$('#hall_form').trigger('reset');$('#hall_id').val('');" class="btn btn-default">Reset</button>
                            </div>
                        </div>	

                    </form>
                </div>	
            </div>
        </section>
    </div>
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Look Up
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped viewregstudent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Center name</th>
                                <th>Hall Name</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($halls as $va) {
                                ?>
                                <tr>
                                    <td><?php echo $va['hall_id']; ?></td>
                                    <td><?php echo $va['br_name']; ?></td>
                                    <td><?php echo $va['hall_name']; ?></td>
                                    <td><a class='btn btn-info btn-xs' title="edit" onclick="edit_hall_load('<?php print_r($va['hall_id']) ?>', '<?php print_r($va['id']) ?>', '<?php print_r($va['hall_name']) ?>', '<?php print_r($va['description']) ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a> |
                                        <?php if ($va['deleted']) { ?>    
                                            <button type="button" title="activate" class="btn btn-success btn-xs" onclick="change_status('<?php print_r($va['hall_id']) ?>', '0')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></th>
                                        <?php } else { ?>
                                            <button type="button" title="deactivate" class="btn btn-warning btn-xs" onclick="change_status('<?php print_r($va['hall_id']) ?>', '1')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                            <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>


    <script>

        save_method = 'update';
        $(function () {
           $('.viewregstudent').DataTable(
                    {
                'ordering': true,
                'lengthMenu': [5, 10, 15, 20, 25]
            });
        });

    </script>


    <script type="text/javascript">

        $.validate({
            form: '#hall_form'
        });



        function edit_hall_load(id, center, name, descri) {
            $('#hall_id').val(id);
            $('#c_name').val(center);
            $('#h_name').val(name);
            $('#des').val(descri);
        }

        function change_status(hall_id, new_status)
        {
            $.post("<?php echo base_url('hall/change_subject_status') ?>", {"hall_id": hall_id, "new_status": new_status},
                    function (data)
                    {
                        location.reload();
                    },
                    "json"
                    );
        }



        save_method = 'update';
//        $(function () {
//            $('.viewregstudent').DataTable();
//        });

        $(function () {
            $("#datepicker").datepicker();
        });

    </script>

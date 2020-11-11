<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> DEGREE </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Degree</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Manage Degree Programs
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='degree_form' class="form-horizontal" role="form" action="<?php echo base_url('degree/save_degree') ?>" id="degree_form" method="post"  autocomplete="off" novalidate>		
                        <input type="hidden" id="degree_id" name="degree_id">  
                        <div class="form-group">
                            <label for="faculty" class="col-md-3 control-label">Faculty Code : </label>
                            <div class="col-md-7">
                                <?php 
                                    global $facultydrop;
                                    global $selectedfac;
                                    $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                    echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-md-3 control-label">Degree Code : </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" maxlength="10" id="d_code" name="d_code" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Degree Name:</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="d_name" name="d_name"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Total Credits:</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="t_creadit" name="t_creadit" placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="1-500" data-validation-error-msg-number="Invalid Credit Amount." data-validation-allowing="range[1;500],int">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" id="des" name="des"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button type="reset" name="Reset" class="btn btn-default" onclick="reset_id()">Reset</button>
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
                <table id="degree_lookup" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Faculty Code</th>
                            <th>Degree Code</th>
                            <th>Total Credits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($all_degree)) {
                            $i = 1;
                            foreach ($all_degree as $va) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $va['faculty_code']; ?></td>
                                    <td><?php echo $va['degree_code']; ?></td>
                                    <td><?php echo $va['total_creadit']; ?></td>
                                    <td><a class='btn btn-info btn-xs' title ="edit" onclick="edit_degree_load('<?php print_r($va['id']) ?>', '<?php print_r($va['degree_code']) ?>', '<?php print_r($va['degree_name']) ?>', '<?php print_r($va['total_creadit']) ?>', '<?php print_r($va['description']) ?>', '<?php print_r($va['faculty_id']) ?>')"/><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a>|

                                        <?php
                                        if ($va['degree_deleted']) {
                                            ?>    
                                            <button type="button" class="btn btn-success btn-xs" title="activate" onclick="change_status('<?php print_r($va['degree_id']) ?>', '0', '<?php print_r($va['degree_code']) ?>')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" ></span></button></th>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-warning btn-xs" title="deactivate" onclick="change_status('<?php print_r($va['degree_id']) ?>', '1', '<?php print_r($va['degree_code']) ?>')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                            <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>                        
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#degree_lookup').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 15, 20, 25]
        });
    });
    function edit_degree_load(id, code, name, credit, descri, faculty_id) {

        $('#degree_id').val(id);
        $('#d_code').val(code);
        $('#d_name').val(name);
        $('#t_creadit').val(credit);
        $('#des').val(descri);
        $('#faculty').val(faculty_id);
    }

    function change_status(degree_id, new_status, degree_code)
    {
        $.post("<?php echo base_url('degree/change_degree_status') ?>", {"degree_id": degree_id, "new_status": new_status, "degree_code": degree_code},
        function (data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                location.reload();
            }
        },
        "json"
        );
    }

    save_method = 'update';
    $(function () {
        $('.viewregstudent').DataTable();
    });

    $(function () {
        $("#datepicker").datepicker();
    });

</script>
<script type="text/javascript">


    $.validate({
        form: '#degree_form'
    });

    function edit_group_load(id, code, name, credit, description)
    {
        $('#degree_id').val(id);
        $('#d_code').val(code);
        $('#d_name').val(name);
        $('#t_creadit').val(credit);
        $('#des').val(description);
    }

    function reset_id() {
        $('#degree_id').val("");
    }
</script>

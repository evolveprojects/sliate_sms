<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> COURSE </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Course</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Manage Course Programs
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='course_form' class="form-horizontal" role="form" action="<?php echo base_url('course/save_course') ?>" id="course_form" method="post"  autocomplete="off" novalidate>		
                        <input type="hidden" id="course_id" name="course_id">  
<!--                        <div class="form-group">
                            <label for="faculty" class="col-md-3 control-label">Faculty Code : </label>
                            <div class="col-md-7">
                                <?php 
                                    //global $facultydrop;
                                    //global $selectedfac;
                                    //$facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                   // echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                ?>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="comcode" class="col-md-3 control-label"> Course Code : </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" maxlength="25" id="d_code" name="d_code" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Course Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="d_name" name="d_name"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Total Credits:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="t_creadit" name="t_creadit" placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="1-500" data-validation-error-msg-number="Invalid Credit Amount." data-validation-allowing="range[1;500],int">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                            <div class="col-md-9">
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
                <table id="course_lookup" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Total Credits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($all_courses)) {
                            $i = 1;
                            foreach ($all_courses as $va) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td style="white-space: initial;"><?php echo "[".$va['course_code']."]-".$va['course_name']; ?></td>
                                    <td><?php echo $va['total_creadit']; ?></td>
                                    <td><a class='btn btn-info btn-xs' title ="edit" onclick="edit_course_load('<?php print_r($va['id']) ?>', '<?php print_r($va['course_code']) ?>', '<?php print_r($va['course_name']) ?>', '<?php print_r($va['total_creadit']) ?>', '<?php print_r($va['description']) ?>')"/><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a>|

                                        <?php
                                        if ($va['course_deleted']) {
                                            ?>    
                                            <button type="button" class="btn btn-success btn-xs" title="activate" onclick="change_status('<?php print_r($va['course_id']) ?>', '0', '<?php print_r($va['course_code']) ?>')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" ></span></button></th>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-warning btn-xs" title="deactivate" onclick="change_status('<?php print_r($va['course_id']) ?>', '1', '<?php print_r($va['course_code']) ?>')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
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
        $('#course_lookup').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 15, 20, 25]
        });
        $('#course_lookup td').css('white-space','initial');
    });
    function edit_course_load(id, code, name, credit, descri) {

        $('#course_id').val(id);
        $('#d_code').val(code);
        $('#d_name').val(name);
        $('#t_creadit').val(credit);
        $('#des').val(descri);
//        $('#faculty').val(faculty_id);
    }

    function change_status(course_id, new_status, course_code)
    {
        $.post("<?php echo base_url('course/change_course_status') ?>", {"course_id": course_id, "new_status": new_status, "course_code": course_code},
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
        form: '#course_form'
    });

    function edit_group_load(id, code, name, credit, description)
    {
        $('#course_id').val(id);
        $('#d_code').val(code);
        $('#d_name').val(name);
        $('#t_creadit').val(credit);
        $('#des').val(description);
    }

    function reset_id() {
        $('#course_id').val("");
    }
</script>

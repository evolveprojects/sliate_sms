<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> SUBJECT</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Subject</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Subject Details 
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" action="<?php echo base_url('subject/save_subject') ?>" method="post"  id="subject_form" autocomplete="off" novalidate>
                        <input type="hidden" id="subject_id" name="subject_id">
                        <input type="hidden" id="subject_old_version" name="subject_old_version">
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Code:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" maxlength="10" id="subject_code" name="subject_code" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Subject:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" >
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Component: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="component_type" name="component_type" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    <option value="1">General</option>			
                                    <option value="2">Academic</option>
                                    <option value="3">Professional</option>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Type: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="subject_type" name="subject_type" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    <option value="">Select Type</option>			
                                    <option value="1">Core</option>
                                    <option value="2">Elective</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Credits:</label>
                            <div class="col-sm-8">
                                <!--<input type="text" class="form-control" id="subject_credit" name="subject_credit" placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="0-1000" data-validation-error-msg-number="Must be numbers." data-validation-error-msg-length="Invalid. Please Try Again" >-->
                                <input type="text" class="form-control" id="subject_credit" name="subject_credit" placeholder="" data-validation=" required" data-validation-error-msg-required="field can not be empty" onblur="validate_credit();" onkeyup="validate_credit()">
                                <label id="lbl_validate_credit" class="col-md-10 control-label" style="color: red; margin-left: 210px"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Version: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="subject_version" name="subject_version" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    <option value="">Select version</option>			
                                    <?php
                                    foreach ($versions as $key => $value) {
                                        echo '<option value="' . $value['version_id'] . '">' . $value['version_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Is GPA Apply </label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="chk_is_gpa_apply" id="chk_is_gpa_apply" checked="true" value="Yes" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label">Is Training subject </label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="chk_is_training_apply" id="chk_is_training_apply" value="Yes" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button type="reset" name="Reset" class="btn btn-default" onclick="clear_subject_id()">Reset</button>
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
                Lookup
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <table class="table table-bordered table-striped viewregstudent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($subjects)) {
                                foreach ($subjects as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo "[" . $row['code'] . "]-" . $row['subject'] ?></td>
                                        <td><?php
                                            if ($row['type'] == 1) {
                                                echo 'Core';
                                            } else {
                                                echo 'Elective';
                                            }
                                            ?></td>                                                                                 
                                        <td> 
                                            <button type="button" class="btn btn-info btn-xs" onclick="edit_subject_load('<?php echo $row['id'] ?>', '<?php echo $row['code'] ?>', '<?php echo $row['subject'] ?>', '<?php echo $row['component'] ?>', '<?php echo $row['type'] ?>', '<?php echo $row['credits'] ?>', '<?php echo $row['version_id'] ?>', '<?php echo $row['is_gpa_apply'] ?>', '<?php echo $row['is_training_apply'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></button> |
                                            <?php if ($row['deleted']) { ?>
                                                <!--<button title='activate' type="button" class="btn btn-success btn-xs" onclick="change_status('<?php print_r($row['id']) ?>', '0', '<?php print_r($row['code']) ?>')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></td>-->
                                        <?php } else { ?>
                                    <!--<button title='deactivate' type="button" class="btn btn-warning btn-xs" onclick="change_status('<?php print_r($row['id']) ?>', '1', '<?php print_r($row['code']) ?>')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></td>-->
                                    <?php } ?>
                                </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">

    save_method = 'update';
    $(function () {
        $('.viewregstudent').DataTable(
                {
                    'ordering': true,
                    'lengthMenu': [5, 10, 15, 20, 25]
                });
        $('.viewregstudent td').css('white-space', 'initial');

    });
    $('#subject_form').on('submit', function(e) {   
        
        validate_credit(e);
        var zscore_vali = $('#lbl_validate_credit').text();
        if(zscore_vali != '')
        {
            funcres = {status: "denied", message: zscore_vali};
            result_notification(funcres);
        }
    });
    function validate_credit(e)
    {
        if($('#subject_credit').val())
        {
            var zscore = $('#subject_credit').val();

            myRegExp = new RegExp(/^\d+(\.\d{1,1})?$/);

            if(parseFloat(zscore) > 10.0) {
                $('#lbl_validate_credit').text('Invalid credit!');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
            else {
                
                if(myRegExp.test(zscore)){
                    $('#lbl_validate_credit').text('');
                }
                else{
                    $('#lbl_validate_credit').text('Invalid credit!');
                    $('#save_btn').attr('disabled', false);
                    e.preventDefault();
                }
            }  
        }
        else{
            $('#lbl_validate_credit').text('');
        }
    } 

    $.validate({
        form: '#subject_form'
    });

    function edit_subject_load(id, code, cus_name, component, type, credit, version, is_gpa_apply, is_training_apply) {
        $('#subject_id').val(id);
        $('#subject_code').val(code);
        $('#subject_name').val(cus_name);
        $('#component_type').val(component);
        $('#subject_type').val(type);
        $('#subject_credit').val(credit);
        $('#subject_version').val(version);
        $('#subject_old_version').val(version);
        if(is_gpa_apply  == 1)
            $("#chk_is_gpa_apply").prop("checked", true);
        else
            $("#chk_is_gpa_apply").prop("checked", false);
        
        if(is_training_apply  == 1)
            $("#chk_is_training_apply").prop("checked", true);
        else
            $("#chk_is_training_apply").prop("checked", false);
    }

    function change_status(subject_id, new_status, subject_code)
    {
        $.post("<?php echo base_url('subject/change_subject_status') ?>", {"subject_id": subject_id, "new_status": new_status, "subject_code": subject_code},
                function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        location.reload();
                    }
                },
                "json"
                );
    }
    
    function clear_subject_id() {
        $('#subject_id').val("");
    }
    
    $(document).ready(function(){
        
        
        $(":checkbox[name='chk_is_training_apply']").change(function() {
                if($('#chk_is_training_apply').is(":checked")==true)
                {
                         $( "#chk_is_gpa_apply").prop('checked', false);
                }
         });
         $(":checkbox[name='chk_is_gpa_apply']").change(function() {
                
                if($('#chk_is_gpa_apply').is(":checked")==true)
                {
                    
                    if($('#chk_is_training_apply').is(":checked")==true)
                    {
                        $( "#chk_is_gpa_apply").prop('checked', false);
                        funcres = {status: "denied", message: "Cannot add GPA for a Training Subject !"};
                        result_notification(funcres);
                    }
                    else
                    {
                        $( "#chk_is_gpa_apply").prop('checked', true);
                    }
                }
         });

//        $('#chk_is_gpa_apply').change(function() {
//
//           alert('s');
//                if(this.checked != true){
//                     alert('you need to be fluent in English to apply for the job '+$("#myname").val());
//                   }
//              }); 
    });
     
</script>
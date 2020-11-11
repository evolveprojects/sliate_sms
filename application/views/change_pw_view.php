<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Change Password </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Change Password</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Change Password
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='changepw_form' class="form-horizontal" role="form" action="<?php echo base_url('change_pw/change_password') ?>" id="changepw_form" method="post"  autocomplete="off" novalidate>		
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
                            <label for="comcode" class="col-md-3 control-label"> User Name:</label>
                            <div class="col-md-9">
                             
								<?php echo $this->session->userdata('u_name')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Old Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="password" name="password"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> New Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="new_password" name="newpass"  data-validation="required" data-validation-error-msg-required="Field can not be empty" onblur="check_new_password_2()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Re-type Password:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="new2_password" name="new2pass"  data-validation="required" data-validation-error-msg-required="Field can not be empty" onblur="check_new_password()">
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
   
</div>                        
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#course_lookup').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 15, 20, 25]
        });
    });
    

</script>
<script type="text/javascript">


$.validate({
        form: '#changepw_form'
    });
function check_new_password()
{
    if($('#new_password').val() != $('#new2_password').val())
    {
        var funcres = {status:"worning", message:"Password and re-type passwords does not match !"};
        result_notification(funcres);
    }
    
}
function check_new_password_2()
{
    if($('#new2_password').val() != '')
    {
        check_new_password();
    }
}
    $(document).ready(function () 
    {
        $('#course_lookup').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 15, 20, 25]
        });
        
    });
    
</script>

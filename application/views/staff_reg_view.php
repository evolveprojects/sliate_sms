<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Jquery File Uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput.css'); ?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput-rtl.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/purify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/fileinput.min.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STAFF REGISTRATION</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-users"></i>Add Staff</li>
        </ol>
    </div>
</div>
<div class="panel">
    <header class="panel-heading">
        Staff Registration
    </header>
    
    <div class="panel-body">
        <div class="row">
            
            <div class="col-md-11">
                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('staff/save_staff'); ?>" id="stf_reg" enctype="multipart/form-data" autocomplete="off" novalidate>
                    <input type="hidden" id="edit_image_url" name="edit_image_url" value="">
                    <input type="hidden" id="stf_id" name="stf_id" value="<?php echo $stf_data['stf_id']; ?>">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label" style="left: 15px;">ATI Center<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-6" style="left: 60px;">
                                
                                <select class="form-control" id="center_id" name="center_id" style="width:100%" data-validation="required" onchange="load_course_list(this.value,null,this)">
                                    <option value="">---Select center---</option>
                                    <?php
                                        foreach ($centers as $row):
                                            ?>
                                        <option value="<?php echo $row['br_id']; ?>">
                                        <?php echo $row['br_code']." - ".$row['br_name']; ?>
                                        </option>
                                            <?php
                                        endforeach;
                                        ?>
                                </select>  
                            </div>
                        </div>
                        <br>
                    </div>
                           
                      
                    <div class="form-group col-md-12">
                        <label for="staffprof_pic" class="col-md-2 control-label">Profile Picture:</label>
                        <div class="col-md-6">
                            <input id="staffprof_pic" name="staffprof_pic" type="file" class="staffprof_picture" value="" accept="image/*">
                        </div>
                        <label id="lbl_staff_validate" class="col-md-8 control-label" style="color: red;left: 186px;">Upload max size : 4MB</label>
                    </div>
                    <!-- Academic & Non Academic-->
                    <div class="form-group col-md-12" >
                        <label for="academic" class="col-md-2 control-label">Academic Status:</label>
                        <div class="col-md-6">
                            <table style="width:70%" cellspacing="0">
                                <tr>
                                    <td><input id="aca_status" type="radio" name="aca_status" value="1" checked=""> Academic</td>
                                    <td><input id="aca_status" type="radio" name="aca_status" value="0"> Non-Academic</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- user group -->
                    <div class="form-group" id="userGroupDiv" style="display: none">
                        <div class="col-md-2" style="padding-left: 30px;">
                            <label>User Group:</label>
                        </div>
                        <div class="col-md-6" style="left: 20px;padding-left: 0px;;padding-right: 295px;">

                            <select class="form-control" id="user_group"  name="user_group" style="width:100%" data-validation="required">
                                <option value="">---Select User Group---</option>
                                <?php
                                    foreach ($user_group as $row):
                                         if($row['ug_level'] < 5){
                                        ?>
                                    <option value="<?php echo $row['ug_id']; ?>">
                                    <?php echo $row['ug_name']; ?>
                                    </option>
                                        <?php
                                         }
                                    endforeach;
                                    ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group col-md-12" >
                        <label for="name" class="col-md-2 control-label">Title:</label>
                        <div class="col-md-6">
                            <table id="staff_look" style="width:70%" cellspacing="0">
                                <tr>
                                    <?php
                                    $i = 1;
                                    foreach ($title_new as $row) {
                                        if ($i == 1) {
                                            ?>
                                            <td><input id="tit_name" type="radio" name="tit_name" value="<?php echo $row['id'] ?>" checked=""> <?php echo $row['title_name'] ?></td>
                                        <?php } else { ?>
                                            <td><input type="radio" name="tit_name" value="<?php echo $row['id'] ?>"> <?php echo $row['title_name'] ?></td>
                                        <?php }
                                        ?>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name" class="col-md-2 control-label">Employee Name:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="First_name" data-validation="required" data-validation-error-msg-required="Field can not be empty" name="stf_fname" id="stf_fname">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="last_name" name="stf_lname" id="stf_lname">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Address:</label>
                        <div class="col-md-4">
                            <textarea  rows="4" class="form-control" placeholder="Personal Adderss" data-validation="required" data-validation-error-msg-required="Field can not be empty" name="stf_address" id="stf_address"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                    
                        <div class="col-md-2" style="padding-left: 30px;">
                            
                            <label>Designation:</label>
                        </div>
                        <div class="col-md-6" style="left: 20px;padding-left: 0px;;padding-right: 295px;">
                                
                                <select class="form-control" id="designation"  name="designation" style="width:100%" data-validation="required" onchange="load_designation_list(this.value,null,this)">
                                    <option value="">---Select Designation---</option>
                                    <?php
                                        foreach ($designation as $row):
                                             if($row['type'] == 'DSG'){
                                            ?>
                                        <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['name']; ?>
                                        </option>
                                            <?php
                                             }
                                        endforeach;
                                        ?>
                                </select>  
                            </div>
                        
                        
<!--                        <div class="col-md-2" style="left: 5px;">
                            <input type="radio" data-validation="required" data-validation-error-msg-required="Empty" name="stf_acc" id="stf_acc" value="1">
                            <label class="control-label" >Academic</label>
                        </div>
                        <div class="col-md">
                            <input type="radio" data-validation="required" name="stf_acc" id="stf_acc" value="2">
                            <label class="control-label">Non-Academic</label>
                        </div>-->
                        
                    </div>
                    
                    
                    
<!--                    <div class="form-group col-md-12">
                        <div class="col-md-4" style="left: 180px;">
                            
                            <label for="stf_acc"></label>
                            
                            
                            
                            <input type="radio" data-validation="required" data-validation-error-msg-required="Empty" name="stf_acc" class="col-md-1" value="1">
                            <label class="col-md-5 control-label" >Academic</label>
                            
                            <input type="radio" data-validation="required" name="stf_acc" class="col-md-1" value="2">
                            <label class="col-md-5 control-label">Non-Academic</label>
                        </div>
                    </div>-->
<!--                    <div class="form-group">
                        
                        <label class="col-md-2 control-label" style="padding-left: 30px;">Faculty:</label>
                        <div class="col-md-4" style="padding-left: 19px;padding-right: 29px;">
                            <?php 
                                //global $facultydrop;
                                //global $selectedfac;
                                //$facextraattrs = 'id="stf_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                //echo form_dropdown('stf_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                            ?>
                        </div>
                    </div>-->
                    
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Mobile No:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_mobi" id="stf_mobi" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" maxlength="10">
                        </div>
                        <label class="col-md-2 control-label">Home No:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_home" id="stf_home" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-optional="true" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Email:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_email" id="stf_email" data-validation="required email" data-validation-error-msg-required="Field can not be empty" data-validation-error-msg-email="Invalid E-mail">
                        </div>
                    </div>
<!--                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Nationality:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stf_national" id="stf_national">
                        </div>
                    </div>-->
                <div class="form-group">    
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="stf_marital" class="col-sm-5 control-label" style="padding-left: 30px;">Marital Status:</label>
                            <div class="col-sm-7" style="right: 25px;left: 0px;padding-left: 0px;">
                                
                                <input type="radio" data-validation="required" data-validation-error-msg-required="Empty" name="stf_marital" id="stf_marital" class="col-md-2"  value="1">
                                <label class="col-md-3 control-label">Married</label>
                                
                                <input type="radio" data validation="required" name="stf_marital" id="stf_marital" class="col-md-3" value="2">
                                <label class="col-md-3 control-label">Unmarried</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left: 86px;">
                            <label for="nic" class="col-sm-1 control-label" style="padding-left: 0px;">NIC:</label>
                            <div class="col-sm-7" style="padding-left: 50px;padding-right: 0px;margin-left: 80px;">
                                <input style="width: 226px;"class="form-control" type="text" name="nic" id="nic" value="" maxlength="12" onblur="validate_duplicate_nic_number()" onkeyup="validate_nic()">      
                                <label id="lbl_nic_validate" class="col-md-10 control-label" style="color: red"></label>
                                <label class="col-md-10 control-label" style="color: red" id="nic_duplicate"></label>
                            </div>
                        </div>
            </div>
                        <div class="form-group">
                    
                        <div class="col-md-2" style="padding-left: 30px;">
                            
                            <label>Qualifications:</label>
                        </div>
                        <div class="col-md-6" style="left: 20px;padding-left: 0px;;padding-right: 295px;">
                                <select class="form-control" id="qualification"  name="qualification" style="width:100%" data-validation="required" onchange="load_qualification_list(this.value,null,this)">
                                    <option value="">---Select Qualification---</option>
                                    <?php
                                        foreach ($designation as $row):
                                            
                                            if($row['type'] == 'QLF'){
                                            ?>
                                        <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['name']; ?>
                                        </option>
                                            <?php
                                            }
                                        endforeach;
                                        ?>
                                </select>  
                            </div>
                        
                        
<!--                        <div class="col-md-2" style="left: 5px;">
                            <input type="radio" data-validation="required" data-validation-error-msg-required="Empty" name="stf_acc" id="stf_acc" value="1">
                            <label class="control-label" >Academic</label>
                        </div>
                        <div class="col-md">
                            <input type="radio" data-validation="required" name="stf_acc" id="stf_acc" value="2">
                            <label class="control-label">Non-Academic</label>
                        </div>-->
                        
                    </div>
                    
                   
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Other Details:</label>
                        <div class="col-md-4">
                            <textarea  title="Research Interest" rows="4" class="form-control" placeholder="" name="research_interest" id="research_interest"></textarea>
                        </div>
<!--                        <div class="col-md-4">
                            <textarea  title="Publications" rows="4" class="form-control" placeholder="Publications" name="publications_achive" id="publications_achive"></textarea>
                        </div>-->
                    </div>
<!--                    <div class="form-group col-md-12">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <textarea title="Awards" rows="4" class="form-control" placeholder="Awards" name="awards_achive" id="awards_achive"></textarea>
                        </div>
                        <div class="col-md-4">
                            <textarea title="Memberships" rows="4" class="form-control" placeholder="Memberships" name="memberships_achive" id="memberships_achive"></textarea>
                        </div>
                    </div>-->
                    <div class="col-md-1"></div>
<!--                    <div class="form-group">
                        <label for="public_achievements" class="col-sm-5 control-lable">Publish all lecturing qualifications with achievements in the web site :</label>
                        <input type="radio" name="public_achievements" id="public_achievements" value="1" checked=""> Yes <br>
                        <input type="radio" name="public_achievements" id="public_achievements" value="2"> No
                    </div>-->
                    <br>
                    <div class="form-group">
                        <div class="col-md-2">
                        </div>
                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-info btn-md" name="submit">Submit</button>
                        <button onclick="event.preventDefault();$('#stf_reg').trigger('reset');$('#stf_id').val('');$('#userGroupDiv').css('display','none');" class="btn btn-default">Reset</button>
                    </div>     
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript">
                            $.validate({
                                form: '#stf_reg'
                            });
/////////////////////Get edit info//////////////////////           
function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }



    var center_code         = '-';
    //var stf_marital         = '1';
    //var stf_acc             = '1';
    //var tit_name            = '1';
    //var public_achievements = '1';
    

var pre_nic_no = "";
$(document).ready(function ()
    {
        $('form').bind('submit', function () {
            $(this).find(':input').prop('disabled', false);
        });

        //$('#div_course_type').hide();
        //$("#reg_no_part1").prop('readonly', true);
        //$('.select22').select2();
        //get Edit student Details
        var form_type = getUrlVars()["type"];
        
        if (form_type == "edit")
        {
            var stf_id = $('#stf_id').val();
            $.post("<?php echo base_url('staff/load_staff_details') ?>", {stf_id: stf_id},
                    function (data)
                    {
                       console.log(data);
                        profpic = "<?php echo base_url() ?>"+data['profileimage'];
                        
                       // alert(data['profileimage']);
                        
                        if(data['profileimage'] == ""  || data['profileimage']==null)
                        {
                            profpic ="<?php echo base_url('uploads/defprof.png'); ?>";
                        }
                        
                        //alert(profpic);
                        $('#edit_image_url').val(data['profileimage']);

                        $('#staffprof_pic').fileinput({showCaption: false,showUpload:false,defaultPreviewContent: '<img src="'+profpic+'" width="212px">'});
                        //$('#stuprof_pic').val(profpic);
                        $('#center_id').val(data['center_id']);
                        //console.info(data['district']);
                        $('#center_id').val(data['center_id']).attr('disabled', true);
                        
                        //$('#staffprof_pic').val(data['staffprof_pic']);
                        
                        $('#stf_fname').val(data['stf_fname']);
                        $('#stf_lname').val(data['stf_lname']);
                        $('#stf_address').val(data['stf_address']);
                        
                        $('#designation').val(data['designation']);
                        $('#qualification').val(data['qualification']);
                        
                        
                        $('#nic').val(data['nic']);
                        pre_nic_no = data['nic_no'];
                        
                        //$('#permanent_address').val(data['permanent_address']);
                        $('#stf_mobi').val(data['stf_mobi']);
                        $('#stf_home').val(data['stf_home']);
                        $('#stf_email').val(data['stf_email']);
                        //$('#stf_national').val(data['stf_national']);
                        
                        $('#research_interest').val(data['research_interest']);
                        //$('#publications_achive').val(data['publications_achive']);
                        //$('#awards_achive').val(data['awards_achive']);
                        //$('#memberships_achive').val(data['memberships_achive']);
                        
                        
                        $('input[name=tit_name][value=' + data['tit_name'] + ']').attr('checked', 'checked');
                        //$('input[name=stf_acc][value=' + data['stf_acc'] + ']').attr('checked', 'checked');
                        $('input[name=stf_marital][value=' + data['stf_marital'] + ']').attr('checked', 'checked');
                        $('input[name=public_achievements][value=' + data['public_achievements'] + ']').attr('checked', 'checked');
                        
                        //academic status
                        $("input[name=aca_status][value=" + data['academic_status'] + "]").attr('checked', 'checked');
                        
                        if( data['academic_status'] == 0){
                            $('#userGroupDiv').css('display','block');
                            
                            if ( typeof(data['user_data']) !== "undefined" && data['user_data'] !== null ) {
                                $('#user_group').val(data['user_data']['user_ugroup']);
                            }
                              
                        } else{
                            $('#userGroupDiv').css('display','none');
                        }
                        
//                        var tit_name = data['tit_name'];
//                        if(tit_name == "1"){
//                            $('input[name=tit_name][value=' + tit_name + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=tit_name][value=1]').attr({disabled:'true'});
//                        }
//                        else if(tit_name == "2"){
//                            $('input[name=tit_name][value=' + tit_name + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=tit_name][value=1]').attr({disabled:'true'});
//                        }
//                        else if(tit_name == "3"){
//                            $('input[name=tit_name][value=' + tit_name + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=tit_name][value=1]').attr({disabled:'true'});
//                        }
//                        else if(tit_name == "4"){
//                            $('input[name=tit_name][value=' + tit_name + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=tit_name][value=1]').attr({disabled:'true'});
//                        }
//                        else if(tit_name == "5"){
//                            $('input[name=tit_name][value=' + tit_name + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=tit_name][value=1]').attr({disabled:'true'});
//                        }
//                        else if(tit_name == "6"){
//                            $('input[name=tit_name][value=' + tit_name + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=tit_name][value=1]').attr({disabled:'true'});
//                        }else{
//                            
//                        }
                        
                        
//                        var public_achievements = data['public_achievements'];
//                        if(public_achievements == "1"){
//                            $('input[name=public_achievements][value=' + public_achievements + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=public_achievements][value=1]').attr({disabled:'true'});
//                        }
//                        if(public_achievements == "2"){
//                            $('input[name=public_achievements][value=' + public_achievements + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=public_achievements][value=1]').attr({disabled:'true'});
//                        }else{
//                            
//                        }
                                                     
                        
//                        var stf_marital = data['stf_marital'];
//                        if(stf_marital == "1"){
//                            $('input[name=stf_marital][value=' + stf_marital + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=stf_marital][value=1]').attr({disabled:'true'});
//                        }
//                        if(stf_marital == "2"){
//                            $('input[name=stf_marital][value=' + stf_marital + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=stf_marital][value=2]').attr({disabled:'true'});
//
//                            //$('#div_course_type').show();
//                            //$('#div_apply_mahapola').hide();
//                        }
//                        else{
//                            //$('#div_course_type').hide();
//                            //$('#div_apply_mahapola').show();
//                        }
                        
//                        var stf_acc = data['stf_acc'];
//                        if(stf_acc == "1"){
//                            $('input[name=stf_acc][value=' + stf_acc + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=stf_acc][value=1]').attr({disabled:'true'});
//                        }
//                        if(stf_acc == "2"){
//                            $('input[name=stf_acc][value=' + stf_acc + ']').attr({checked:'checked', disabled:'true'});
//                            $('input[name=stf_acc][value=2]').attr({disabled:'true'});
//
//                            //$('#div_course_type').show();
//                            //$('#div_apply_mahapola').hide();
//                        }
//                        else{
//                            //$('#div_course_type').hide();
//                            //$('#div_apply_mahapola').show();
//                        }
                        
                        
                        
                        },
                    "json");


        } else {
        $(document).on('ready', function () {
            $("#staffprof_pic").fileinput({showCaption: false, showUpload: false});
        });
        }
     
     // on change academic & non-academic
     $('input[type=radio][name=aca_status]').change(function() {
        if (this.value == 0) { //non-academic
            $('#userGroupDiv').css('display','block');
        }
        else if (this.value == 1) { //academic
            $('#userGroupDiv').css('display','none');
        }
    });

    });








//validating Staff Profile picture exist.
    function validate_profile_picture(e){
        var filename = $('#staffprof_pic').val();
        
        var msg1 = "";
        var msg2 = "";
        
        var extension = filename.replace(/^.*\./, '');
        if(filename != '')
            {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray(filename.split('.').pop().toLowerCase(), fileExtension) == -1) {
                msg1 ="Uplaoded file is not a valid : "+fileExtension.join(', ') + " !";

                e.preventDefault();
                $('#lbl_staff_validate').text(msg1);
                funcres = {status: "denied", message: msg1};
                result_notification(funcres);
            }
            else
            {
                msg1 = '';
            }
            
            //check for file  size.
            var size=$('#staffprof_pic')[0].files[0].size;    // THE SIZE OF THE FILE.
//            alert(size);
            if(size > 4194304)
            {
                if(msg1 != "")
                {
                    msg2 = msg1 + "<br/>Maximum file upload size 4MB !";
                }
                else
                {
                    msg2 = "Maximum file upload size 4MB !";
                }
                e.preventDefault();
                $('#lbl_staff_validate').html(msg2);
                funcres = {status: "denied", message: msg2};
                result_notification(funcres);
            }
            
        }
        
        
        /*if (! $('#stuprof_pic').val()){
            if(!$('#edit_image_url').val()){
                e.preventDefault();
                $('#lbl_stu_validate').text('Profile picture cannot be empty !');
                funcres = {status: "denied", message: "Profile picture cannot be empty !"};
                result_notification(funcres);
            }
        }
        else
        {
            $('#lbl_stu_validate').text('');
        }*/
        
    }
    
    $('#stf_reg').on('submit', function(e) {   
        
        $("#reg_form :input").prop("disabled", false);
        //$('#save_btn').prop('disabled', true);
        
        //validateRegNoField(e);
        validate_profile_picture(e);
        validate_nic(e);
        
        var nic_vali = $('#lbl_nic_validate').text();
        if(nic_vali != '')
        {
            funcres = {status: "denied", message: nic_vali};
            result_notification(funcres);
        }
        //Check for duplicate NIC numbers.
        var dup_nic = $('#nic_duplicate').text();
        if(dup_nic != '')
        {
            funcres = {status: "denied", message: dup_nic};
            result_notification(funcres);
            e.preventDefault();
        }
    });
    
    function validateRegNoField(e) 
    {
       var txt = $('#reg_no_error_txt').text();

        var frm_type = getUrlVars()["type"];
        if(frm_type != "edit"){

            var reg_no_part2 = $('#reg_no_part2').val();

            if(reg_no_part2 == ""){
                e.preventDefault();

                funcres = {status: "denied", message: "Invalid Register Number"};
                result_notification(funcres);

                $('#reg_no_error_txt2').text("Invalid Register Number");
                $('#save_btn').attr('disabled', false);

                return false;
            }
        }


        if(frm_type == "edit"){

            var final_reg = ($('#reg_no_part1').val()+$('#reg_no_part2').val());

            if(final_reg != reg_part2){
                if(txt != ""){
                    
                    funcres = {status: "denied", message: "Register Number Already Exists"};
                    result_notification(funcres);

                    return false;
                }
            }

        }else{
            if(txt != ""){
                e.preventDefault();

                funcres = {status: "denied", message: "Register Number Already Exists"};
                result_notification(funcres);

                return false;
            }
        }

    };
    
     //Validate the NIC
    function validate_nic(e)
    {
        if($('#nic').val())
        {
            var nic = $('#nic').val();
            if(nic.length == 10 || nic.length == 12)
            {
                if(nic.length == 10)
                {
                    var idToTest = nic,
                    myRegExp = new RegExp(/[0-9]{9}[x|X|v|V]$/);

                    if(myRegExp.test(idToTest)) {
                        $('#lbl_nic_validate').text('');
                    }
                    else {
                        $('#lbl_nic_validate').text('Invalid NIC number format !');
                        $('#save_btn').attr('disabled', false);
                        e.preventDefault();
                    }
                }
                else{
                    var idToTest = nic,
                    myRegExp = new RegExp(/[0-9]{9}$/);

                    if(myRegExp.test(idToTest)) {
                        $('#lbl_nic_validate').text('');
                    }
                    else {
                        $('#lbl_nic_validate').text('Invalid NIC number format !');
                        $('#save_btn').attr('disabled', false);
                        e.preventDefault();
                    }
                }
            }
            else
            {
                $('#lbl_nic_validate').text('NIC Length should be 10 0r 12 characters !');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
        }
        else
        {
            $('#lbl_nic_validate').text('NIC cannot be empty !');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        }
    }
       
    function validate_duplicate_nic_number()
    {
        var frm_type = getUrlVars()["type"];
        var nic_no = $('#nic').val();
        $('#nic_duplicate').text("");
        $.post("<?php echo base_url('staff/check_duplicate_nic_no_for_staff') ?>", {'nic_no':nic_no},
        function (data)
        {
            if(data['stf_nic_count'] >=1)
            {
                //alert(frm_type + " - " + reg_part2 + " - " + reg_no)
                if(frm_type == "edit")
                {
                    if(nic_no != pre_stf_nic){
                        //e.preventDefault();
                        var message = "NIC Number Already Exists!";
                        $('#nic_duplicate').text(message);
                        
                        return false;
//                        funcres = {status: "denied", message: message};
//                        result_notification(funcres);
                    }
                    else{
                        $('#nic_duplicate').text("");
                        //$("#reg_form").submit();
                    }

                }else{
                    //e.preventDefault();
                    var message = "NIC Number Already Exists!";
                    $('#nic_duplicate').text(message);

                }
            }
            else{
                $('#nic_duplicate').text("");
                //$("#reg_form").submit();
            }
        },"json");
    }
               
//function load_course_list(center_id, selectedid, selected)
//    {
//        //set REG NUmber..
//        var sel_val = selected.options[selected.selectedIndex].text;
//        center_code = sel_val.split('-')[0].trim();
//
//        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');
//
//        $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
//
//        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
//                function (data)
//                {
//                    for (var i = 0; i < data.length; i++)
//                    {
//
//                        $("#course_id").append($('<option>', { value: data[i]['course_id'], text: data[i]['course_code'] + ' - ' + data[i]['course_name']}));
//
//
//                       // if (selectedid == data[i]['id'])
//                        //{
//                       //     $('#course_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
//                      //  } else
//                      //  {
//                          //  $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
//                      //  }
//                    }
//                },
//                "json"
//                );
//
//    }
                            

//                            $(document).on('ready', function() {
//                                $("#staffprof_pic").fileinput({showCaption: false,showUpload:false});
//                            });
</script>
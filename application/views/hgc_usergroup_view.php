<div class="se-pre-con"></div>
<?php                           
    $predata = $this->auth->get_ugroup_options();
?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> USER GROUP MANAGEMENT</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-lock"></i>System Access</li>
            <li><i class="fa fa-users"></i>User Group</li>
        </ol>
    </div>
</div>
<div>
<section class="panel">
    <header class="panel-heading">
        <div class="col-md-4">
            Create / Edit User Group
        </div>
    </header>
    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('user/save_usergroup')?>" id="ugroupform" autocomplete="off" novalidate>
    <div class="panel-body">  
        <div class="row">
            <div class="col-md-5">  
                <br>
				<div class="form-group">
                    <label for="acc_level" class="col-md-3 control-label">Access Level</label>
                    <div class="col-md-9">
                        <select type="text" class="form-control" onchange="changegrpview(this.value,'','','')" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="acc_level" name="acc_level">
                            <option value=''></option>
                            <?php
                                echo $predata['ops'];
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="level_name_div" style="display: none">
                    <label for="grp_type" class="col-md-3 control-label">Level Name</label>
                    <div id="div_type" style="padding-left: 135px;">
                        <input type="radio" id="grp_type_name" name="grp_type_name" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="director_" onclick="grp_type_change(this.value)"> <label>Director</label><br/>
                        <input type="radio" id="grp_type_name" name="grp_type_name" value="hod_" onclick="grp_type_change(this.value)"> <label>HOD</label><br/>
                        <input type="radio" id="grp_type_name" name="grp_type_name" value="exam_" onclick="grp_type_change(this.value)"> <label>Exam</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grp_name" class="col-md-3 control-label">Name</label>
                    <div id="div_pref" class="col-md-2">
                        <input type="hidden" name="grp_id" id="grp_id">
                        <input type="text" readonly="true" class="form-control" id="ugrp_name_pref" name="ugrp_name_pref" value="stu_" style="width:72px">
                    </div>
                    <div class="col-md-5">
                        <input type="text" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="ugrp_name" name="ugrp_name" placeholder="" style="width:240px">
                    </div>
                </div>
                
<!--                <div class="form-group">
                    <label for="comp" class="col-md-3 control-label">Company</label>
                    <div class="col-md-9">
                        <select type="text" class="form-control" data-validation="required" onchange="load_branches(this.value,'')" data-validation-error-msg-required="Field can not be empty" id="comp" name="comp" disabled>
                            <option value=''></option>
                            <?php
                                foreach ($company as $grp) 
                                {
                                    if($predata['comp']=='all')
                                    {
                                        echo "<option value='".$grp['grp_id']."'>".$grp['grp_name']."</option>";
                                    }
                                    else
                                    {
                                        if($predata['comp']==$grp['grp_id'])
                                        {
                                            echo "<option value='".$grp['grp_id']."'>".$grp['grp_name']."</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                  </div>
                </div>-->
                <div class="form-group" id="grp_center_div">
<!--                    <label for="branch" class="col-md-3 control-label">Branch</label>
                    <div class="col-md-9">
                        <select type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="branch" name="branch" disabled>
                        </select>
                    </div>-->
                    <label for="center" class="col-md-3 control-label">Center</label>
                    <div class="col-md-9">
                        <select name="user_grp_center" id="user_grp_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" disabled onchange="load_assigned_courses(this.value,'')">
                            <option value=""></option>
                                <?php 
                                    foreach($branches as $brnch)
                                    { 
                                        echo '<option value="'.$brnch['br_id'].'"> ['.$brnch['br_code'].'] - '.$brnch['br_name'].'</option>';
                                    }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="grp_course_div" style="display: none">
                    <label for="center" class="col-md-3 control-label">Course</label>
                    <div class="col-md-9">
                        <select name="user_grp_course" id="user_grp_course" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty">   
                        <option value=""></option>
                        </select>
                    </div>
                </div>
                <br/>
                <label style="width:100%;margin-left: 18px;color: red" id="duplicate_error_txt"></label>
            </div>
            <div class="col-md-7">
                <table id="ugrouptable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User Group</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($groups as $grp) 
                            {
                                echo "<tr>";
                                echo "<td>".$grp['ug_name']."</td>"; 

                                if($predata['comp']=='all')
                                {
                                    echo "<td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_group(".$grp['ug_id'].",\"".$grp['ug_name']."\",".$grp['ug_level'].",".((empty($grp['ug_company']))?"null":$grp['ug_company']).",".((empty($grp['ug_branch']))?"null":$grp['ug_branch']).",".$grp['ug_course'].")'>Edit</a> | "
                                            . "<a class='btn btn-danger btn-xs' onclick='event.preventDefault();delete_group(".$grp['ug_id'].")'>Delete</a></td>";
                                }
                                else
                                {
                                    if(($predata['comp']==$grp['ug_company']) && ($grp['ug_level']==2))
                                    {
                                       echo "<td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_group(".$grp['ug_id'].",\"".$grp['ug_name']."\",".$grp['ug_level'].",".((empty($grp['ug_company']))?"null":$grp['ug_company']).",".((empty($grp['ug_branch']))?"null":$grp['ug_branch']).",".$grp['ug_course'].")'>Edit</a> | "
                                               . "<a class='btn btn-danger btn-xs' onclick='event.preventDefault();delete_group(".$grp['ug_id'].")'>Delete</a></td>";
                                    }
                                    else if($grp['ug_level']>2)
                                    {
                                        echo "<td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_group(".$grp['ug_id'].",\"".$grp['ug_name']."\",".$grp['ug_level'].",".((empty($grp['ug_company']))?"null":$grp['ug_company']).",".((empty($grp['ug_branch']))?"null":$grp['ug_branch']).",".$grp['ug_course'].")'>Edit</a> | "
                                                . "<a class='btn btn-danger btn-xs' onclick='event.preventDefault();delete_group(".$grp['ug_id'].")'>Delete</a></td>";
                                    }
                                    else
                                    {
                                        echo "<td></td>";
                                    }
                                } 
                                
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" id="usr_grp_save" name="usr_grp_save" class="btn btn-info">Save</button> 
        <button type="button" class="btn btn-default" onclick="clear_fields()">Reset</button>
    </div>
    </form>
</section>
    <div id="dialog-confirm"></div>
</div>
<script type="text/javascript">
    
var usr_flag = 0;
var usr_pre_name = '';

$.validate({
    form : '#ugroupform'
});

function clear_fields()
{
    $('#ugrp_name_pref').val('');
    $('#grp_id').val('');
    $('#ugrp_name').val('');
    $('#acc_level').val('');
    $('#user_grp_center').val('');
    $('#div_pref').hide(); 
}

//$("#clearButton").click(function() {
//  $("label.error").hide();
//  $(".error").removeClass("error");
//});

var table = $('#ugrouptable').DataTable( {
        "pageLength": 5,
        "dom" : '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-4"i><"col-md-8"p>><"clear">',
        "columnDefs": [ {
        "targets": 1,
        "orderable": false
        } ]
    } );

function delete_group(ug_id)
{
    $("#dialog-confirm").html("Are you sure want to delete this record ?");
                    
    $("#dialog-confirm").dialog({
    resizable: false,
    modal: true,
    title: "Delete User Group",
    height: 140,
    width: 400,
    draggable: false,
    buttons: [
        {
            text: "Yes",
            "class": 'btn btn',
            click: function() {
            $(this).dialog('close');
                $.post("<?php echo base_url('user/delet_user_group') ?>", {'ug_id':ug_id},
                function (data)
                {
                    if (data != "")
                    {
                        //clear_fields();
                        location.reload();
                        //funcres = {status: "worning", message: "User group deleted successfully !"};
                       // result_notification(funcres);
                    }
                },
                "json"
                );
            }
        },
        {
            text: "No",
            "class": 'btn btn-info',
            click: function() {
                $(this).dialog('close');
            }
        }
    ]
    }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'}); 

}
function edit_group(id,uname,lvl,comp,brnch,course)
{
    $('#duplicate_error_txt').text("");
    usr_pre_name = uname;
    usr_flag = 1;

    $('#grp_id').val(id);
    $('#ugrp_name').val(uname);
    $('#acc_level').val(lvl);
    $('#user_grp_center').val(brnch);
    
    changegrpview(lvl,uname,brnch,course); 
   
}

//function load_branches(id,br)
//{
//    $('#branch').empty();
//    $('#branch').append("<option value=''></option>");
//
//    level = $('#acc_level').val();
//
//    if(level==3)
//    {
//        $('#branch').prop('disabled', false);
//    }
//    else
//    {
//        $('#branch').prop('disabled', true);
//    }
//
//    $.post("<?php //echo base_url('company/load_branches')?>",{'id':id},
//        function(data)
//        { 
//            if(data == 'denied')
//            {
//                funcres = {status:"denied", message:"You have no right to proceed the action"};
//                result_notification(funcres);
//            }
//            else
//            {  
//                if(data.length>0)
//                {   
//                    for (i = 0; i<data.length; i++) {
//                        if(br==data[i]['br_id'])
//                        {
//                            seltxt = 'selected';
//                        }
//                        else
//                        {
//                            seltxt = '';
//                        }
//                        $('#branch').append("<option value='"+data[i]['br_id']+"' "+seltxt+">["+data[i]['br_code']+'] - '+data[i]['br_name']+"</option>");
//                    }
//                }
//            }
//        },  
//        "json"
//    );
//}

function changegrpview(level,uname,branch, course)
{   
    $('#ugrp_name').css('width',166)
    $('#level_name_div').hide();
    $('#grp_center_div').show();
    if(level==1)
    {
        $('#user_grp_center').prop('disabled', true);
        $('#user_grp_center').val('');
        //$('#ugrp_name').val('');
        $('#ugrp_name_pref').val('');
        $('#div_pref').hide();
    }
    else if(level==5){
        if(uname == ''){
            $('#ugrp_name_pref').val('stu_');
            $('#user_grp_center').prop('disabled', false);
            $('#div_pref').show(); 
        }
        else{
            var final_name = uname.split('_')[1].trim();
            
            $('#ugrp_name_pref').val('stu_');
            $('#user_grp_center').prop('disabled', false);
            $('#div_pref').show();
            $('#ugrp_name').val(final_name);
        }
        
    }
    else if(level==4){
        if(uname == ''){
            $('#ugrp_name_pref').val('lec_');
            $('#user_grp_center').prop('disabled', false);
            $('#div_pref').show(); 
        }
        else{
            var final_name = uname.split('_')[1].trim();
            
            $('#ugrp_name_pref').val('lec_');
            $('#user_grp_center').prop('disabled', false);
            $('#div_pref').show();
            $('#ugrp_name').val(final_name);
        }
        
    }
    else if(level==3){
        if(uname == ''){
            $('#ugrp_name_pref').val('reg_');
            $('#user_grp_center').prop('disabled', false);
            $('#div_pref').show(); 
        }
        else{
            var final_name = uname.split('_')[1].trim();
            
            $('#ugrp_name_pref').val('reg_');
            $('#user_grp_center').prop('disabled', false);
            $('#div_pref').show();
            $('#ugrp_name').val(final_name);
        }
        
    }
    else if(level==2){
       
            $('#div_pref').show();
            $('#level_name_div').show();
            $('#user_grp_center').prop('disabled', false);
       if(uname == ''){
            
        } else {
            var temp = uname.split('_');
            var type_name = temp[0].trim()+"_";
            $('#ugrp_name_pref').val(type_name);
            $('#ugrp_name').val(temp[1].trim());
            
            $("input[name=grp_type_name][value=" + type_name + "]").attr('checked', 'checked');
            grp_type_change(type_name);
            if(type_name == 'hod_'){
                $('#grp_course_div').show();
                $('#grp_center_div').show();
                load_assigned_courses(branch,course);
            } else if(type_name == 'exam_'){
                $('#grp_center_div').hide();
            } else {
                $('#grp_center_div').show();
            }
        }
       
    }
    
}


$("#ugrp_name").blur(function duplicate_check(){
    var name = $('#ugrp_name').val();
    var prefix = $('#ugrp_name_pref').val();
    var edit_id = $('#grp_id').val();
    $.post("<?php echo base_url('user/check_user_group') ?>", {'name':(prefix+name)},
    function (data)
    {
        if(edit_id == null || edit_id == ''){
            if(data['name_count'] > 0)
            {
                $('#duplicate_error_txt').text("User Group Already Exists! Use Another Name.");
                $('#usr_grp_save').prop("disabled", true);
            }
            else{
                $('#duplicate_error_txt').text("");
                $('#usr_grp_save').prop("disabled", false);
            }
        } else {
            if(usr_pre_name != (prefix+name)){
                if(data['name_count'] > 0)
                {
                    $('#duplicate_error_txt').text("User Group Already Exists! Use Another Name.");
                    $('#usr_grp_save').prop("disabled", true);
                }
                else{
                    $('#duplicate_error_txt').text("");
                    $('#usr_grp_save').prop("disabled", false);
                }
            } else {
                $('#duplicate_error_txt').text("");
            }
            
        }
        
    },
    "json"
    );
});

$('#ugrp_name').bind('keyup blur', function () {
    var temp = $(this).val($(this).val().replace(/_/g, ''));
});

$('#ugroupform').on('submit', function(e) {        
    validateUserGroupField(e)
});

function validateUserGroupField(e) 
{
    var txt = $('#duplicate_error_txt').text();
    if(txt != ""){
        e.preventDefault();

        //funcres = {status: "denied", message: "Register Number Already Exists"};
        //result_notification(funcres);

        return false;
    }
    
};

 $(document).ready(function ()
{
    $('#div_pref').hide();
    $('#ugrp_name_pref').val('');
    $('#usr_grp_save').prop("disabled", false);
    
});

function grp_type_change(type_name) 
{
    $('#ugrp_name_pref').val(type_name);
    if(type_name == 'hod_'){
        $('#grp_course_div').show();
    } else {
        $('#grp_course_div').hide();
    }
    
    if(type_name == 'exam_'){
        $('#grp_center_div').hide();
    } else {
        $('#grp_center_div').show();
    }
}

    function load_assigned_courses(center_id,course_id){

        $('#user_grp_course').find('option').remove().end();
        $('#user_grp_course').append('<option value=""></option>').val('');

        $.post("<?php echo base_url('User/load_center_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        if(data[i]['course_id'] == course_id){
                            $('#user_grp_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']).attr("selected","selested"));
                        } else {
                            $('#user_grp_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        } 
                        
                    }

                },
                "json"
                );
    }
    

</script>

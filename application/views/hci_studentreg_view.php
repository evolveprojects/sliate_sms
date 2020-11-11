<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Jquery File Uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput.css'); ?>"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput-rtl.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/purify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/fileinput.min.js') ?>"></script>

<style type="text/css">

    .affix-top {
        position: relative;
    }

    .affix {
        top: 70px;
    }

    .affix, 
    .affix-bottom {
        width: 168px;
    }

    .affix-bottom {
        position: absolute;
    }
	.select2-container--open .select2-dropdown--below{
		z-index: 1;
	}

</style>

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT INFORMATION</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Student Edit</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="container col-md-12">
        <form class="form-horizontal" role="form" method="post"  id="reg_form" action="<?php echo base_url('student/save_student') ?>"  autocomplete="on" novalidate enctype="multipart/form-data">
            <section class="panel affixpanel" id="generaldata">
                <header class="panel-heading">
                    Registration information
                </header>
                <input type="hidden" id="edit_image_url" name="edit_image_url" value="">
                <input type="hidden" id="stu_id" name="stu_id" value="<?php echo $stu_data['stu_id']; ?>">
                <input type="hidden" id="batch_id" name="batch_id" value="<?php echo $stu_data['batch_id']; ?>">
                <div class="panel-body" style="padding-bottom: 30px;">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-md-3 control-label">ATI Center<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-6">
                                <?php
                                global $branchdrop;
                                global $selectedbr;
//
//                                if (isset($stu_data)) {
//                                    $selectedbr = $stu_data['center_id'];
//                                }
//                                $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" onchange="load_course_list(this.value,null,this)"';
//                                echo form_dropdown('center_id', $branchdrop, $selectedbr, $extraattrs);
                                ?>
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
                        <div class="form-group col-md-6">
                            <label for="fax" class="col-md-2 control-label">Course<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-8">
                                <select class="form-control" id="course_id" name="course_id" style="width:100%" data-validation="required" onchange="set_reg_no(this)">

                                </select>  
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fax" class="col-md-4 control-label">Course Type</label>
                            <div class="col-md-8">
                                <input type="radio" name="course_type" class="col-md-1" id="course_type" value="F" checked="checked" onchange="course_type_on_change()">
                                <label class="col-md-3 control-label">Full Time</label>

                                <input type="radio" name="course_type" id="course_type" class="col-md-1" value="P" onchange="course_type_on_change()">
                                <label class="col-md-4 control-label">Part Time</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <!--                    <div class="form-group col-md-6">
                                                <label for="fax" class="col-md-3 control-label">Reg. No. <span style="color:red;font-size: 16px">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="reg_no" name="reg_no" placeholder="" value="<?php //echo $stu_data['reg_no']; ?>" style="width:100%">
                                                </div>
                                            </div>-->
                        <div class="form-group col-md-6">
                            <label for="fax" class="col-md-3 control-label">Reg. No. <span style="color:red;font-size: 16px">*</span></label>
                            <table>
                                <tr>
                                    <td style="">
                                        <input type="text" class="form-control" id="reg_no_part1" name="reg_no_part1" placeholder="" value="" style="width:100%;margin-left: 18px;">
                                    </td>
                                    <td id="td_reg_no_2">

<!--<input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" placeholder="" value="" style="width:70px">-->
                                        <select class="form-control select22" name="reg_no_part2"  name="state" id="reg_no_part2" onchange="reg_range_on_change()" style="z-index: 2;">
                                            <option value=""></option>
                                            <?php
                                            $array_reg = explode("-", $student_reg_range[0]['RANGE_VALUES']);
                                            for ($i = $array_reg[0]; $i <= $array_reg[1]; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="width:100%;margin-left: 18px;color: red" id="reg_no_error_txt"></label>
                                    </td>
                                    <td>
                                        <label style="width:100%;margin-left: 18px;color: red" id="reg_no_error_txt2"></label>
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
            </section>
            <section class="panel affixpanel" id="studentinfo">
                <header class="panel-heading">
                    Primary Student Information
                </header>
                <div class="panel-body">
                    <div class="row">
                        <label for="stuprof_pic" class="col-md-2 control-label">Profile Picture:</label>
                        <div class="col-md-6">
                            <input id="stuprof_pic" name="stuprof_pic" type="file" value="" class="stuprof_picture" accept="image/*">
                            <label id="lbl_stu_validate" class="col-md-8 control-label" style="color: red">Upload max size : 4MB</label>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php //echo $stu_data['id']; ?>">
                    <input type="hidden" id="ref_t" name="ref_t" value="<?php //echo $type ?>">
                    <div class="row">
                        <div class="form-group col-md-6">
                        <?php
                        // $firstname = $stu_data['first_name'];
                        // $lastname = $stu_data['last_name'];
                        ?>
                            <div class="col-md-9">
                                <label for="name" class="control-label">Full Name<span style="color:red;font-size: 16px">*</span></label>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="first_name" name="first_name" placeholder="" value="<?php //echo $firstname; ?>" style="width:100%" onfocusout="initialName()">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class=" form-group col-md-6">
                            <div class="col-md-9">
                                <label for="brnum" class=" control-label">Name with initials<span style="color:red;font-size: 16px">*</span></label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="last_name" name="last_name" placeholder="" value="<?php //echo $lastname; ?>" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <br>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label  class="col-sm-3 control-label">Date Of Birth<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-sm-6">
                                <div id="" class="input-group date" >
                                    <input class="form-control datepicker" type="text" name="birth_date" id="birth_date"  data-format="YYYY-MM-DD" value="" data-validation="required" onkeydown="return false" data-validation-error-msg-required="Field can not be empty">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group col-md-6">
                            <label for="comcode" class="control-label col-sm-3">Civil Status </label>
                            <div class="col-sm-7">
                                <label class="col-md-3 control-label">Single</label>
                                <input type="radio" name="civil_status" class="col-md-1" id="civil_status" value="S" <?php //echo $selected_cvlstat  ?>>

                                <label class="col-md-3 control-label">Married</label>
                                <input type="radio" name="civil_status" id="civil_status" class="col-md-1" value="M" <?php //echo  $selected_cvlstat2  ?>>
                            </div>
                        </div>-->
                        <div class="form-group col-md-6">
                            <label for="nic_no" class="col-sm-1 control-label">NIC<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" name="nic_no" id="nic_no" value="" maxlength="12" onblur="call_genderSelectiionFromNIC_validate_duplicate_nic_number()" onkeyup="validate_nic()">     
                                <label id="lbl_nic_validate" class="col-md-10 control-label" style="color: red"></label><br>
                                <label class="col-md-10 control-label" style="color: red" id="nic_no_error_txt"></label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="comcode" class="control-label col-sm-3">Gender </label>
                            <div class="col-sm-7">
                                <label class="col-md-3 control-label">Male</label>
                                <input type="radio" name="sex" class="col-md-1" id="sex" value="M" checked="true" <?php //echo $selected_sex1  ?>>

                                <label class="col-md-3 control-label">Female</label>
                                <input type="radio" name="sex" id="sex" class="col-md-1" value="F" <?php //echo  $selected_sex2  ?>>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="form-group col-md-6">
                            <label for="inputEmail3" class="col-sm-3 control-label">Date Of Birth</label>
                            <div class="col-sm-6">
                                <div id="" class="input-group date" >
                                    <input class="form-control datepicker" type="text" name="birth_date" id="birth_date"  data-format="YYYY-MM-DD" value="" data-validation="required" data-validation-error-msg-required="*">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>-->
						<div class="form-group col-md-6">
                            <label for="comcode" class="control-label col-sm-3">Civil Status </label>
                            <div class="col-sm-7">
                                <label class="col-md-3 control-label">Single</label>
                                <input type="radio" name="civil_status" class="col-md-1" id="civil_status" value="S" checked="true" <?php //echo $selected_cvlstat  ?>>

                                <label class="col-md-3 control-label">Married</label>
                                <input type="radio" name="civil_status" id="civil_status" class="col-md-1" value="M" <?php //echo  $selected_cvlstat2  ?>>
                            </div>
                        </div>

                        <div class="form-group col-md-9">
                            <label for="comcode" class="control-label col-sm-1">Age</label>

                            <label for="comcode" class="control-label col-sm-1">Years</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txtAgeYear" name="txtAgeYear" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid year"  data-validation-optional="true" value="" readonly="true">

                            </div>
                            <label for="comcode" class="control-label col-sm-1">Months</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="txtAgeMonth" name="txtAgeMonth" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid month"  data-validation-optional="true" value="" readonly="true">

                            </div>
                            <label for="comcode" class="control-label col-sm-1">Days</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="txtAgeDays" name="txtAgeDays" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid days"  data-validation-optional="true" value="" readonly="true">
                            </div>
                        </div>
                    </div>
					<br>

                    <div class="row">
<!--                        <div class="form-group col-md-6">
                            <label for="comcode" class="col-sm-3 control-label">Place of Birth </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="place_birth" name="place_birth" placeholder="" value="<?php //echo $stu_data['place_birth'] ?>">
                            </div>
                        </div>-->
                        <div class="form-group col-md-6">
                            <label for="religion" class="col-md-3 control-label">Religion</label>
                            <div class="col-md-6">
                                <select class="form-control" id="religion" name="religion"  style="width: 100%;">
                                    <option value=""></option>
                                        <?php
                                        $rlgn = $this->db->get('com_religion')->result_array();
                                        foreach ($rlgn as $row):
                                            //$selected="selected";
                                            //     if($row['rel_id']==$stu_data['religion']){
                                            //         $selected="selected";
                                            //     }
                                        ?>
                                        <option value="<?php echo $row['rel_id']; ?>">
                                        <?php echo $row['rel_name']; ?>
                                        </option>
                                            <?php
                                        endforeach;
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="panel affixpanel" id="emergencycont">
                <header class="panel-heading">
                    Contact Details
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fax" class="col-md-3 control-label">Address<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="permanent_address" name="permanent_address" placeholder="" value="<?php //echo $stu_data['permanent_address'] ?>" data-validation="required">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fax" class="col-md-3 control-label">Administrative District:</label>
                            <div class="col-md-6">
    <!--                            <input type="text" class="form-control" id="district" name="district" value="<?php //echo $stu_data['district'] ?>">-->

                                <select class="form-control" id="district" name="district"  style="width: 100%;">
                                        <?php
                                        foreach ($districts as $row):
                                            ?>
                                        <option value="<?php echo $row['code']; ?>">
                                        <?php echo $row['district']; ?>
                                        </option>
                                            <?php
                                        endforeach;
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="comcode" class="col-sm-3 control-label">Home Number<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" data-validation=" required number length" maxlength="10" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" id="fixed_tp" name="fixed_tp" placeholder="" value="<?php //echo $stu_data['fixed_tp'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-sm-7">
                                <input value="07" type="text" class="form-control" data-validation="number length" data-validation-length="10-10" maxlength="10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" id="mobile_no" name="mobile_no" placeholder=""  data-validation-optional="true" value="<?php //echo $stu_data['mobile_no'] ?>">
                            </div>
                            <label id="lbl_mobileNo" class="col-md-10 control-label" style="color: red; margin-left: 140px;"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fax" class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="email" name="email" placeholder="" data-validation="email" data-validation-error-msg-email="Invalid E-mail"  data-validation-optional="true" value="<?php //echo $stu_data['email']   ?>" style="width:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="panel affixpanel" id="stuhistory">
                <header class="panel-heading">
                    Results of GCE Advanced Level Examination
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="al_year" class="col-md-1 control-label">Year<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="al_year" name="al_year" value="" data-validation="required number length" data-validation-length="4-4">
                            </div>
                            <label for="al_index_no" class="col-md-2 control-label">Index No.<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="al_index_no" name="al_index_no" value="" data-validation="required number length" data-validation-length="6-10">
                            </div>
                        </div>
                        <label for="al_medium" class="col-md-1 control-label">Medium<span style="color:red;font-size: 16px">*</span></label>
                        <div class="col-md-2">
                            <select class="form-control" id="al_medium" name="al_medium" >
                                <option>Sinhala</option>
                                <option>Tamil</option>>
                                <option>English</option>
                            </select>  
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="en_mat_sc[o/l]" class="col-md-3 control-label">Stream<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-6">
                                <!--<input type="text" class="form-control" id="al_stream" name="al_stream" placeholder="" value="<?php //echo $stu_data['al_stream'] ?>">-->
                                <select class="form-control" id="al_stream" name="al_stream"  style="width: 100%;" onchange="load_subjects(this.value,null,this);alStreamLoadValidation();subject_grade_validation();" data-validation="required">
                                    <option value="">---Select Stream---</option>
                                        <?php
                                        foreach ($stream as $row):
                                            ?>
                                        <option value="<?php echo $row['stream_id']; ?>">
                                        <?php echo $row['stream_name']; ?>
                                        </option>
                                            <?php
                                        endforeach;
                                        ?>
                                </select>
                            </div><label class="col-md-10 control-label" id="select_subject_alert" style="color:red;"></label>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="al_en_cgt" class="col-md-3 control-label">A/L Result</label>
                            <div class="col-md-8">
    <!--                            <input type="text" class="form-control" id="al_en_cgt" name="al_en_cgt" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tr><td> <!--<input type="text" class="form-control" id="al_subject1" name="al_subject1" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                            <select class="form-control" id="al_subject1" name="al_subject1" onchange="subject_grade_validation();validate_al_subjects();alStreamLoadValidation();" style="width:100%">
                                               <option value=""></option>
                                            </select>
                                        </td>
                                        <td><!--<input type="text" class="form-control" id="al_subject1_grade" name="al_subject1_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                            <select class="form-control" id="al_subject1_grade" name="al_subject1_grade"  style="width: 90%;" onchange="subject_grade_validation();">
                                                <option value="">-Grade-</option>
                                                    <?php
                                                    foreach ($al_grade as $row):
                                                        ?>
                                                    <option value="<?php echo $row['grade_id']; ?>">
                                                    <?php echo $row['grade']; ?>
                                                    </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                            </select>
                                            <p id="demo1" style="color: red"></p>
                                            
                                            
                                        </td></tr>
                                    <tr><td><!--<input type="text" class="form-control" id="al_subject2" name="al_subject2" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                            <select class="form-control" id="al_subject2" name="al_subject2" style="width:100%" onchange="subject_grade_validation();validate_al_subjects();alStreamLoadValidation();">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td>
<!--                                            <input type="text" class="form-control" id="al_subject2_grade" name="al_subject2_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="al_subject2_grade" name="al_subject2_grade"  style="width: 90%;" onchange="subject_grade_validation();">
                                                    <option value="">-Grade-</option>
                                                        <?php
                                                        foreach ($al_grade as $row):
                                                            ?>
                                                        <option value="<?php echo $row['grade_id']; ?>">
                                                        <?php echo $row['grade']; ?>
                                                        </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>
                                            <p id="demo2" style="color: red"></p>
                                        </td></tr>
                                </table>
                                <label id="lbl_al_subjects" class="col-md-10 control-label" style="color: red"></label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>
                                            <!--<input type="text" class="form-control" id="al_subject3" name="al_subject3" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                            <select class="form-control" id="al_subject3" name="al_subject3" style="width:100%" onchange="subject_grade_validation();validate_al_subjects();alStreamLoadValidation();">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td>
<!--                                            <input type="text" class="form-control" id="al_subject3_grade" name="al_subject3_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="al_subject3_grade" name="al_subject3_grade"  style="width: 90%;" onchange="subject_grade_validation();">
                                                    <option value="">-Grade-</option>
                                                        <?php
                                                        foreach ($al_grade as $row):
                                                            ?>
                                                        <option value="<?php echo $row['grade_id']; ?>">
                                                        <?php echo $row['grade']; ?>
                                                        </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>
                                            <p id="demo3" style="color: red"></p>
                                        </td>
                                    </tr>
                                    <tr><td>
                                            <!--<input type="text" class="form-control" id="al_subject4" name="al_subject4" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                            <select class="form-control" id="al_subject4" name="al_subject4" style="width:100%" onchange="subject_grade_validation();validate_al_subjects();alStreamLoadValidation();">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td>
<!--                                            <input type="text" class="form-control" id="al_subject4_grade" name="al_subject4_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="al_subject4_grade" name="al_subject4_grade"  style="width: 90%;" onchange="subject_grade_validation();">
                                                    <option value="">-Grade-</option>
                                                            <?php
                                                            foreach ($al_grade as $row):
                                                                ?>
                                                            <option value="<?php echo $row['grade_id']; ?>">
                                                            <?php echo $row['grade']; ?>
                                                            </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                    </select>
                                            <p id="demo4" style="color: red"></p>
                                        </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="col-md-4 control-label" style="width: 170px;">General Marks Index No<span style="color:red;font-size: 16px"></span></label>
                            <div class="col-md-5">
    <!--                            <input type="text" class="form-control" id="en_mat_sc[o/l]" name="en_mat_sc[o/l]" placeholder=""  value="<?php //echo $stu_data['en_mat_sc[o/l]'] ?>">-->
                                <input type="text" class="form-control" id="common_gen_paper_index_no" name="common_gen_paper_index_no" placeholder=""  value="" onkeyup="validate_com_gen_paper_index();">
                            </div>
                            <label id="lbl_gen_mark_index" class="col-md-10 control-label" style="color: red; margin-left: 130px"></label>
                        </div>
                        <div class="form-group col-md-6" style="right: 200px;" >
                            <label for="" class="col-md-5 control-label" style="width: 210px;">Common General Paper Marks<span style="color:red;font-size: 16px">*</span></label>
                            <div class="col-md-5">
    <!--                            <input type="text" class="form-control" id="en_mat_sc[o/l]" name="en_mat_sc[o/l]" placeholder=""  value="<?php //echo $stu_data['en_mat_sc[o/l]'] ?>">-->
                                <input type="text" class="form-control" id="com_gen_paper" name="com_gen_paper" placeholder=""  value="" onblur="validate_com_gen_paper();" onkeyup="validate_com_gen_paper();" data-validation="required number" data-validation-length="1-3">
                            </div>
                            <!--<label id="lbl_com_gen_validate" class="col-md-10 control-label" style="color: red; margin-left: 130px"></label>-->
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="al_z_core" class="col-md-3 control-label" style="margin-right: 14px;">A/L Z-Score<span style="color:red;font-size: 16px">*</span></label>
                            <table >
                                <tr>
                                    <td>
                                        <select class="form-control" id="al_score_mode" name="al_score_mode" style="width:70px">
                                            <option>+</option>
                                            <option>-</option>>
                                        </select>
                                    </td>
                                    <td style="position: absolute;">
                                        <input type="text" class="form-control" id="al_z_core" name="al_z_core" placeholder="" value="" data-validation="required" onblur="validate_z_score();" onkeyup="validate_z_score();">                                       
                                    </td>
                                </tr>
                            </table>
                            <label id="lbl_zscore_validate" class="col-md-10 control-label" style="color: red; margin-left: 210px"></label>

                        </div>
                    </div>
                    <br>
                </div>
            </section>
            <section class="panel affixpanel" id="stuhistory">
                <header class="panel-heading">
                    Results of GCE Ordinary Level Examination:-
                </header>
                <div class="panel-body">
                    <div class="row">
<!--                        <div class="form-group col-md-6">
                            <label for="ol_year" class="col-md-1 control-label">Year</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="ol_year" name="ol_year" value="" data-validation="number length" data-validation-length="4-4" data-validation-optional="true">
                            </div>
                            <label for="ol_index_no" class="col-md-2 control-label">Index No.</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="ol_index_no" name="ol_index_no" value="" data-validation="number length" data-validation-length="6-10" data-validation-optional="true">
                            </div>
                        </div>-->
                        <label for="ol_stream" class="col-md-1 control-label">Medium</label>
                        <div class="col-md-2">
                            <select class="form-control" id="ol_medium" name="ol_medium" >
                                <option>Sinhala</option>
                                <option>Tamil</option>>
                                <option>English</option>
                            </select>  
                        </div>
                    </div>
                    <br>
                    <div class="panel-body">
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="comcode" class="control-label col-sm-3">Sat for exam in </label>
                            <div class="col-sm-7">
                                <label class="col-md-4 control-label">Single year</label>
                                <input type="radio" name="ol_sityear" class="col-md-1" id="ol_sityear" value="1" checked="true" <?php //echo $selected_sex1  ?>>

                                <label class="col-md-5 control-label">Several Years</label>
                                <input type="radio" name="ol_sityear" id="ol_sityear" class="col-md-1" value="2" <?php //echo  $selected_sex2  ?>>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        </div>
                    </div>
                    
                    <br>
                    <div id="div_english" class="row">
                        <div class="form-group col-md-2"><label for="al_en_cgt" class="col-md-3 control-label">Result</label></div>
                        <div class="form-group col-md-7">
                            <!--<div class="col-md-8">-->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                            <th>Year</th>
                                            <th>Index</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="ol_maths" class="col-md-1 control-label">Maths<span style="color:red;font-size: 16px">*</span></label>
                                            </td>
                                            <td style="width: 116px;">
                                                <!--<input type="text" class="form-control" id="ol_maths_grade" name="ol_maths_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="ol_maths_grade" name="ol_maths_grade" style="width: 90%;" data-validation="required">
                                                    <option value="">-Grade-</option>
                                                        <?php
                                                        foreach ($ol_grade as $row):
                                                            ?>
                                                        <option value="<?php echo $row['grade_id']; ?>">
                                                        <?php echo $row['grade']; ?>
                                                        </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>
                                            </td>
                                            <td>
                                                <!--<div class="col-md">-->
                                                <input type="text" class="form-control" id="ol_year" name="ol_year" value="" data-validation-has-keyup-event="true" data-validation="required number length" data-validation-length="4-4"  data-validation-current-error="This is a required field">
                                                <!--</div>-->
                                                
                                            </td>
                                            <td>
                                                <input type="text" width="150px" class="form-control" id="ol_index_no" name="ol_index_no" value="" data-validation="required number length" data-validation-length="6-20">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th><label id="lbl_ol_year" class="col-md-1 control-label">Year</label></th>
                                        <th><label id="lbl_ol_index" class="col-md-1 control-label">Index</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="ol_english" class="col-md-1 control-label">English<span style="color:red;font-size: 16px">*</span></label>
                                        </td>
                                        <td style="width: 116px;">
                                            <!--<input type="text" class="form-control" id="ol_english_grade" name="ol_english_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                            <select class="form-control" id="ol_english_grade" name="ol_english_grade"  style="width: 90%;" data-validation="required">
                                                <option value="">-Grade-</option>
                                                    <?php
                                                    foreach ($ol_grade as $row):
                                                        ?>
                                                    <option value="<?php echo $row['grade_id']; ?>">
                                                    <?php echo $row['grade']; ?>
                                                    </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                            </select>
                                        </td>
                                        <td style="width: 116px;">
                                            <div id="div_txt_ol_english_year">
                                            <input type="text" class="form-control" id="ol_english_year" name="ol_english_year" value="" data-validation="required number length" data-validation-length="4-4">
                                            </div>
                                        </td>
                                        <td style="width: 116px;">
                                            <div id="div_txt_ol_english_index_no">
                                            <input type="text" class="form-control" id="ol_english_index_no" name="ol_english_index_no" value="" data-validation="required number length" data-validation-length="6-10">
                                            <div id="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section id="div_course_type" class="panel affixpanel">
                <header class="panel-heading">
                    Part Time Course Details
                </header>

                <div class="panel-body">

                    <div class="row">

                        <label for="prt_present_emp" class="col-md-4 control-label">Details of Present Employment / Self-employment</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_Present_emp" name="prt_Present_emp" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label for="prt_post" class="col-md-4 control-label">Post</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_post" name="prt_post" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label for="prt_EPF" class="col-md-4 control-label">E.P.F. Number</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_EPF" name="prt_EPF" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label for="prt_address" class="col-md-4 control-label">Place of Work and Address</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_address" name="prt_address" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label for="prt_app_date" class="col-md-4 control-label">Date of Appointments</label>
                        <div class="col-md-6">
                            <div id="" class="input-group date" >
                                <input class="form-control datepicker" type="text" name="prt_app_date" id="prt_app_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label for="prt_br" class="col-md-4 control-label">Business Registration Number</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_br" name="prt_br" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <label for="prt_date_br" class="col-md-4 control-label">Date of BR</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <div id="" class="input-group date" >
                                <input class="form-control datepicker" type="text" name="prt_date_br" id="prt_date_br"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="div_apply_mahapola" class="panel affixpanel">
                <header class="panel-heading">
                    Mahapola
                </header>
                <div class="panel-body">
                    <div class="row">
                        <label for="prt_present_emp" class="col-md-2 control-label">Apply for Mahapola</label>

                            <div class="col-sm-7">
                                <label class="col-md-1 control-label">Yes</label>
                                <input type="radio" name="apply_mahapola" id="apply_mahapola" class="col-md-1" value="1" onclick="show_mahapola_message()">

                                <label class="col-md-1 control-label">No</label>
                                <input type="radio" name="apply_mahapola" id="apply_mahapola" class="col-md-1" value="0" checked="" onclick="show_mahapola_message()">
                            </div>
                        
                        <div class="col-md-5" style="display:none" id="mahapola_message_div">
                            <p style="color:red;">Please submit the "Mahapola"  application form after   submit this screen.</p>
                        </div>
                    </div>
                    </br>
                </div>
            </section>

            <section class="panel">
                <div class="panel-body">
                    <br>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-11">
<?php
// if($_GET['type']=='edit')
// {
?>
                            <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();validate_reg_no();">Save</button>
                            <?php
                            // }
                            // if($_GET['type']=='regi')
                            // {
                            ?>
                            <!--  <button type="submit" onclick="event.preventDefault();verify_data()" name="regi_btn" id="regi_btn" class="btn btn-info">Register</button> -->
                            <?php
                            // }
                            ?>
                            <button onclick="event.preventDefault();$('#reg_form').trigger('reset');$('#id');$('#ref_t').val('');" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css') ?>">
<script type="text/javascript">
$.validate({
        form: '#reg_form'
    });

//                            $('.datepicker').datepicker({
//                                autoclose: true
//                            });

    $('.datepicker').datepicker({
        autoclose: true,
        setDate: '2015-01-01'
    }).on('changeDate', function(ev){
           //my work here
           calculate_age($('#birth_date').val());

       });

    function show_mahapola_message() {

//                                if ($('input[name=apply_mahapola]').prop('checked')) {
//                                    $('#mahapola_message_div').css("display", "block");
//                                } else {
//                                    $('#mahapola_message_div').css("display", "none");
//                                }
    }

    //function calculate_age()
    function calculate_age(dob) 
    {
        $('#txtAgeYear').val("0");
        $('#txtAgeMonth').val("0");
        $('#txtAgeDays').val("0");

        var split_dob = dob.split("-");
        dobYear = split_dob[0];
        dobMonth = split_dob[1];
        dobDay = split_dob[2];

        var bthDate, curDate, days;
        var ageYears, ageMonths, ageDays;
        bthDate = new Date(dobYear, dobMonth-1, dobDay);
        curDate = new Date();
        if (bthDate>curDate) return;
        days = Math.floor((curDate-bthDate)/(1000*60*60*24));
        ageYears = Math.floor(days/365);
        ageMonths = Math.floor((days%365)/31);
        ageDays = days - (ageYears*365) - (ageMonths*31);
        if (ageYears>0) {
                //console.log(ageYears+" year");
                $('#txtAgeYear').val(ageYears);
        }
        if (ageMonths>0) {
                //console.log(ageMonths+" month");
                $('#txtAgeMonth').val(ageMonths);
        }
        if (ageDays>0) {
                //console.log(ageDays+" day");
                $('#txtAgeDays').val(ageDays);
        }
        if(ageYears <= 25 )
        {
            $('#div_apply_mahapola').show();
        }
        else
        {
            $('#div_apply_mahapola').hide();
            $('input[name=apply_mahapola][value=' + 0 + ']').attr('checked', 'checked');
        }
    }

    function load_course_list(center_id, selectedid, selected)
    {
        //set REG NUmber..
        var sel_val = selected.options[selected.selectedIndex].text;
        center_code = sel_val.split('-')[0].trim();

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list_add_student') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {

                        $("#course_id").append($('<option>', { value: data[i]['course_id'], text: data[i]['course_code'] + ' - ' + data[i]['course_name']}));


                       // if (selectedid == data[i]['id'])
                        //{
                       //     $('#course_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                      //  } else
                      //  {
                          //  $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                      //  }
                    }
                },
                "json"
                );

    }
    function load_subjects(stream_id)
    {
        $('#al_subject1').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject2').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject3').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject4').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');

        $.post("<?php echo base_url('Student/load_al_subject_list') ?>", {'stream_id': stream_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $("#al_subject1").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }
                },
                "json"
                );

    }
    //load_subjects_edit_load(data['al_stream'], data['al_subject1'], data['al_subject2'], data['al_subject3'], data['al_subject4']);
    function load_subjects_edit_load(stream_id, al_subject1, al_subject2, al_subject3, al_subject4)
    {
        $('#al_subject1').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject2').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject3').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject4').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');

        $.post("<?php echo base_url('Student/load_al_subject_list') ?>", {'stream_id': stream_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $("#al_subject1").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }

                    $('#al_subject1').val(al_subject1);
                    $('#al_subject2').val(al_subject2);
                    $('#al_subject3').val(al_subject3);
                    $('#al_subject4').val(al_subject4);
                },
                "json"
                );

    }
    function load_course_list_by_id(center_id, selected_course_id)
    {

        $.post("<?php echo base_url('Student/load_course_list_add_student') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        if(selected_course_id == data[i]['course_id'])
                        {
                            $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        }
                        else
                        {
                            $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        }
                    }
                    $('#course_id').val(selected_course_id);
                },
                "json"
                );
    }

    function set_reg_no(sel)
    {
        //set REG NUmber..
        var sel_val = sel.options[sel.selectedIndex].text;
        course_code = sel_val.split('-')[0].trim();

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        if($('#reg_no_part2').val() != ""){
            load_data($('#reg_no_part1').val()+$('#reg_no_part2').val());
        }
    }

    function load_batches(id, selectedid, selected)
    {

        $('#batch_id').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('student/load_batches') ?>", {'id': id},
                function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        for (var i = 0; i < data.length; i++) {

                            if (selectedid == data[i]['id'])
                            {
                                $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['batch_code'] + ' - ' + data[i]['description']));
                            } else
                            {
                                $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code'] + ' - ' + data[i]['description']));
                            }
                        }
                    }
                },
                "json"
                );
    }

    function course_type_on_change()
    {
        var course_type_full = $('input[name=course_type]:checked').val();

        if (course_type_full == 'F')
        {
            course_type = 'F';
            $('#div_course_type').hide();
            $('#div_apply_mahapola').show();
        } else if (course_type_full == 'P')
        {
            course_type = 'P';
            $('#div_course_type').show();
            $('#div_apply_mahapola').hide();
            $('input[name=apply_mahapola][value=' + 0 + ']').attr('checked', 'checked');
        }
        var sel_val = $("#center_id option:selected").text();
        center_code = sel_val.split('-')[0].trim();

        var sel_val2 = $("#course_id option:selected").text();
        course_code = sel_val2.split('-')[0].trim();
        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        if($('#reg_no_part2').val() != ""){
            load_data($('#reg_no_part1').val()+$('#reg_no_part2').val());
        }
    }

    function reg_range_on_change()
    {
        $.post("<?php echo base_url('student/load_student_reg_range') ?>", {},
                function (data)
                {
                    var range = data[0]['RANGE_VALUES'].split('-');
                    var range_array = [];
                    console.info(range[0] + '-' + range[1]);
                    for (var i = range[0]; i <= range[1]; i++)
                    {
                        range_array.push(i);
                    }
                    $("#reg_no_part2").autocomplete({
                        source: range_array
                    });
                },
                "json");

        if(($('#reg_no_part2').val()) != ""){
            $('#reg_no_error_txt2').text("");
        }

            load_data($('#reg_no_part1').val()+$('#reg_no_part2').val());
    }

    function load_data(reg_no)
    {
        var frm_type = getUrlVars()["type"];

        $.post("<?php echo base_url('student/check_student_reg_no') ?>", {'reg_no':reg_no},
                function (data)
                {
                    if(data['reg_count'] >= "1")
                    {
                        if(frm_type == "edit"){

                            if(reg_no != reg_part2){

                                $('#reg_no_error_txt').text("Register Number Already Exists");
                            }
                            else{
                                $('#reg_no_error_txt').text("");
                            }

                        }else{
                            $('#reg_no_error_txt').text("Register Number Already Exists");
                        }
                    }
                    else{
                        $('#reg_no_error_txt').text("");
                    }
                },
                "json"
                );
    }
    
    function validate_reg_no()
    {
        var frm_type = getUrlVars()["type"];
        var reg_no = $('#reg_no_part1').val()+$('#reg_no_part2').val();
        
        $.post("<?php echo base_url('student/check_student_reg_no') ?>", {'reg_no':reg_no},
        function (data)
        {
            if(data['reg_count'] >="1")
            {
                //alert(frm_type + " - " + reg_part2 + " - " + reg_no)
                if(frm_type == "edit")
                {
                    if(reg_no != reg_part2){
                        var message = "Register Number Already Exists !";
                        $('#reg_no_error_txt').text(message);
                        funcres = {status: "denied", message: message};
                        result_notification(funcres);
                    }
                    else{
                        $('#reg_no_error_txt').text("");
                        $("#reg_form").submit();
                    }

                }else{
                    var message = "Register Number Already Exists !";
                        $('#reg_no_error_txt').text(message);
                        funcres = {status: "denied", message: message};
                        result_notification(funcres);
                }
            }
            else{
                $('#reg_no_error_txt').text("");
                $("#reg_form").submit();
            }
        },"json");
    }

    $('#reg_form').on('submit', function(e) {   
        
        $("#reg_form :input").prop("disabled", false);
        $('#save_btn').prop('disabled', true);
        
        validateRegNoField(e);
        validate_profile_picture(e);
        
        validate_nic(e);
        alStreamLoadValidation(e);
        subject_grade_validation(e);
        
                var al_stream = $('#al_stream').val();
                var alsub1 = $('#al_subject1').val();
                var alsub2 = $('#al_subject2').val();
                var alsub3 = $('#al_subject3').val();
                var alsub4 = $('#al_subject4').val();

                var alsub1G = $('#al_subject1_grade').val();
                var alsub2G = $('#al_subject2_grade').val();
                var alsub3G = $('#al_subject3_grade').val();
                var alsub4G = $('#al_subject4_grade').val();
                
                if(al_stream != ""){
                    if(alsub1 == "" && alsub2 == "" && alsub3 == "" && alsub4 == ""){
                        funcres = {status: "denied", message: 'Select A/L Subjects'};
                        result_notification(funcres);
                    }
                }
                

                if(alsub1 != "" && alsub1G == ""){
                    funcres = {status: "denied", message: 'Select Grade'};
                    result_notification(funcres);
                }else if(alsub1 == "" && alsub1G != ""){
                    funcres = {status: "denied", message: 'You cant select grade without selecting subject'};
                    result_notification(funcres);
                }

                if(alsub2 != "" && alsub2G == ""){
                    funcres = {status: "denied", message: 'Select Grade'};
                    result_notification(funcres);
                }else if(alsub2 == "" && alsub2G != ""){
                    funcres = {status: "denied", message: 'You cant select grade without selecting subject'};
                    result_notification(funcres);
                }

                if(alsub3 != "" && alsub3G == ""){
                    funcres = {status: "denied", message: 'Select Grade'};
                    result_notification(funcres);
                }else if(alsub3 == "" && alsub3G != ""){
                    funcres = {status: "denied", message: 'You cant select grade without selecting subject'};
                    result_notification(funcres);
                }

                if(alsub4 != "" && alsub4G == ""){
                    funcres = {status: "denied", message: 'Select Grade'};
                    result_notification(funcres);
                }else if(alsub4 == "" && alsub4G != ""){
                    funcres = {status: "denied", message: 'You cant select grade without selecting subject'};
                    result_notification(funcres);
                }
        
//        subject_load_validation(e);
        var nic_vali = $('#lbl_nic_validate').text();
        if(nic_vali != '')
        {
            funcres = {status: "denied", message: nic_vali};
            result_notification(funcres);
        }
        //check for Duplicate NICNUmbers.
        var dup_nic = $('#nic_no_error_txt').text();
        if(dup_nic != '')
        {
            funcres = {status: "denied", message: dup_nic};
            result_notification(funcres);
            e.preventDefault();
        }
        
        validate_al_subjects(e);
        var al_vali = $('#lbl_al_subjects').text();
        if(al_vali != '')
        {
            funcres = {status: "denied", message: al_vali};
            result_notification(funcres);
        }
        
        //validate_com_gen_paper_index(e);
        
        validate_com_gen_paper_index(e);
        var com_index_vali = $('#lbl_gen_mark_index').text();
        if(com_index_vali != '')
        {
            funcres = {status: "denied", message: com_index_vali};
            result_notification(funcres);
        }
        validate_com_gen_paper(e);
        var com_vali = $('#lbl_com_gen_validate').text();
        if(com_vali != '')
        {
            funcres = {status: "denied", message: "Common general paper marks value invalid !"};
            result_notification(funcres);
        }
        
        validate_z_score(e);
        var zscore_vali = $('#lbl_zscore_validate').text();
        if(zscore_vali != '')
        {
            funcres = {status: "denied", message: zscore_vali};
            result_notification(funcres);
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
                    e.preventDefault();

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

    //validating Profile picture exist.
    function validate_profile_picture(e){
        var filename = $('#stuprof_pic').val()
        var msg1 = "";
        var msg2 = "";
        
        var extension = filename.replace(/^.*\./, '');
        if(filename != '')
            {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
            if ($.inArray(filename.split('.').pop().toLowerCase(), fileExtension) == -1) {
                msg1 ="Uplaoded file is not a valid : "+fileExtension.join(', ') + " !";

                e.preventDefault();
                $('#lbl_stu_validate').text(msg1);
                funcres = {status: "denied", message: msg1};
                result_notification(funcres);
            }
            else
            {
                msg1 = ''
            }
            
            //check for file  size.
            var size=$('#stuprof_pic')[0].files[0].size;    // THE SIZE OF THE FILE.
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
                $('#lbl_stu_validate').html(msg2);
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
    
    function call_genderSelectiionFromNIC_validate_duplicate_nic_number()
    {
        genderSelectiionFromNIC();
        validate_duplicate_nic_number();
    }

    //Validate the NIC
    function validate_nic(e)
    {
        //genderSelectiionFromNIC();
        
        if($('#nic_no').val())
        {
            var nic = $('#nic_no').val();
            
            var date   = $('#birth_date').val();
            var year   = date.split("-", 1);
            var first_year = date.substr(2, 2);

            if(nic.length == 10 || nic.length == 12)
            {
                if(nic.length == 10 && year < 2000)
                {
                    
                    var idToTest = nic,
                    myRegExp = new RegExp(/[0-9]{9}[x|X|v|V]$/);

                    if(myRegExp.test(idToTest)) {
                        
                        var first_two = nic.substr(0, 2);
                        if(first_two == first_year){
                            $('#lbl_nic_validate').text('');
                            //genderSelectiionFromNIC();
                        }else{
                            $('#lbl_nic_validate').text('Invalid NIC number');
                            $('#save_btn').attr('disabled', false);
                            e.preventDefault();
                        }
                        
                        //$('#lbl_nic_validate').text('');
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
                        //$('#lbl_nic_validate').text('');
                        var first_four = nic.substr(0, 4);
                        if(first_four == year){
                            $('#lbl_nic_validate').text('');
                            genderSelectiionFromNIC();
                        }else{
                            $('#lbl_nic_validate').text('Invalid NIC number!');
                            $('#save_btn').attr('disabled', false);
                            e.preventDefault();
                        }
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
        var nic_no = $('#nic_no').val();
        
        $.post("<?php echo base_url('student/check_duplicate_nic_no') ?>", {'nic_no':nic_no},
        function (data)
        {
            if(data['nic_count'] >=1)
            {
                //alert(frm_type + " - " + reg_part2 + " - " + reg_no)
                if(frm_type == "edit")
                {
                    if(nic_no != pre_nic_no){
                        //e.preventDefault();
                        var message = "NIC Number Already Exists!";
                        $('#nic_no_error_txt').text(message);
                        
                        return false;
//                        funcres = {status: "denied", message: message};
//                        result_notification(funcres);
                    }
                    else{
                        $('#nic_no_error_txt').text("");
                        //$("#reg_form").submit();
                    }

                }else{
                    //e.preventDefault();
                    var message = "NIC Number Already Exists!";
                    $('#nic_no_error_txt').text(message);

                    return false;
//                        funcres = {status: "denied", message: message};
//                        result_notification(funcres);
                }
            }
            else{
                $('#nic_no_error_txt').text("");
                //$("#reg_form").submit();
            }
        },"json");
    }

   //validate the AL subject to check same subject has been selected.
   function validate_al_subjects(e)
   {
       var sub1 = $('#al_subject1').val();
       var sub2 = $('#al_subject2').val();
       var sub3 = $('#al_subject3').val();
       var sub4 = $('#al_subject4').val();
       //alert(sub1 + "-" + sub2 + "-" + sub3 + "-" + sub4);
        if(sub1 != "" || sub2 != "" || sub3 != "" || sub4 != "")
        {
            if(sub1 == sub2 || sub1 == sub3 || sub1 == sub4 || 
                    sub2 == sub1 || sub2 == sub3 || sub1 == sub4 || 
                    sub3 == sub1 || sub3 == sub2 || sub3 == sub4 ||
                    sub4 == sub1 || sub4 == sub2 || sub4 == sub3)
            {
                 //if(sub1 != "" && sub2 != "" && sub3 != "" && sub4 != "")
                     $('#lbl_al_subjects').text('Same subject has been selected one or more !');
                     $('#save_btn').attr('disabled', false);
                     e.preventDefault();
            }
            else
            {
                $('#lbl_al_subjects').text('');
            }
        }
   }
                           
// Read a page's GET URL variables and return them as an associative array.
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

    var center_code = '-';
    var course_code = '-';
    var course_type = 'F';

    var year = (new Date).getFullYear();

    var reg_part2 = "";
    var pre_nic_no = "";
    
    $(document).ready(function ()
    {
        $('form').bind('submit', function () {
            $(this).find(':input').prop('disabled', false);
        });

        $('#div_course_type').hide();
        $("#reg_no_part1").prop('readonly', true);
        $('.select22').select2();
        
        $('#ol_english_year').hide();
        $('#ol_english_index_no').hide();
        $('#lbl_ol_year').hide();
        $('#lbl_ol_index').hide();
        $('#div_txt_ol_english_year').hide();
        $('#div_txt_ol_english_index_no').hide();
        
        
        //get Edit studetn Details
        var form_type = getUrlVars()["type"];
        if (form_type == "edit")
        {
            var stu_id = $('#stu_id').val();
            $.post("<?php echo base_url('student/load_student_details') ?>", {stu_id: stu_id},
                    function (data)
                    {

                        profpic = "<?php echo base_url() ?>"+data['profileimage'];
                        
                       // alert(data['profileimage']);
                        
                        if(data['profileimage'] == ""  || data['profileimage']==null)
                        {
                            profpic ="<?php echo base_url('uploads/defprof.png'); ?>";
                        }
                        
                       $('#edit_image_url').val(data['profileimage']);

                       $("#stuprof_pic").fileinput({showCaption: false,showUpload:false,defaultPreviewContent: '<img src="'+profpic+'" width="212px">'});
                       //$('#stuprof_pic').val(profpic);
                        $('#center_id').val(data['center_id']);
                        //console.info(data['district']);
                        $('#center_id').val(data['center_id']).attr('disabled', true);
                        $('#course_id').val(data['course_id']).attr('disabled', true);
                        load_course_list_by_id(data['center_id'], data['course_id']);
                        var course_type = data['course_type'];

                        if(course_type == "F"){
                            $('input[name=course_type][value=' + course_type + ']').attr({checked:'checked', disabled:'true'});
                            $('input[name=course_type][value="P"]').attr({disabled:'true'});
                        }
                        if(course_type == "P"){
                            $('input[name=course_type][value=' + course_type + ']').attr({checked:'checked', disabled:'true'});
                            $('input[name=course_type][value="F"]').attr({disabled:'true'});

                            $('#div_course_type').show();
                            $('#div_apply_mahapola').hide();
                        }
                        else{
                            $('#div_course_type').hide();
                            $('#div_apply_mahapola').show();
                        }


                       // $('input[name=course_type][value=' + course_type + ']').attr({checked:'checked', disabled:'true'});
                        //if (course_type == "P")
                       // {
                       //     $('#div_course_type').show();
                       // } else
                       // {
                       //     $('#div_course_type').hide();
                       // }
                        var reg = data['reg_no'];
                        var reg_array = reg.split('/');
                        //console.info(reg_array);
                        $('#reg_no_part1').val(reg_array[0] + "/" + reg_array[1] + "/" + reg_array[2] + "/" + reg_array[3] + "/" + reg_array[4]);
                        //$('#select2-reg_no_part2-container').text(reg_array[4]);
                        $('#td_reg_no_2').hide();

                       // $('#reg_no_part2').val(reg_array[4]);


                        var reg_part1 = $('#reg_no_part1').val();
                        reg_part2 = reg_part1;//+reg_array[4];
                        
                        $('#first_name').val(data['first_name']);
                        $('#last_name').val(data['last_name']);

                        $('input[name=civil_status][value=' + data['civil_status'] + ']').attr('checked', 'checked');
                        $('input[name=sex][value=' + data['sex'] + ']').attr('checked', 'checked');
                        $('#nic_no').val(data['nic_no']);
                        pre_nic_no = data['nic_no'];
                        
                        
                        $('#birth_date').val(data['birth_date']);
                        $('#txtAgeYear').val(data['age_year']);
                        $('#txtAgeMonth').val(data['age_month']);
                        $('#txtAgeDays').val(data['age_days']);
                        $('#place_birth').val(data['place_birth']);
                        $('#religion').val(data['religion']);

                        $('#permanent_address').val(data['permanent_address']);
                        $('#district').val(data['district']);
                        $('#fixed_tp').val(data['fixed_tp']);
                        $('#mobile_no').val(data['mobile_no']);
                        $('#email').val(data['email']);

                        $('#al_year').val(data['al_year']);
                        $('#al_index_no').val(data['al_index_no']);
                        $('#al_medium').val(data['al_medium']);

                        $('#al_stream').val(data['al_stream']);
                        load_subjects_edit_load(data['al_stream'], data['al_subject1'], data['al_subject2'], data['al_subject3'], data['al_subject4']);
                        //('#al_subject1').val(data['al_subject1']);
                        //$('#al_subject2').val(data['al_subject2']);
                        //$('#al_subject3').val(data['al_subject3']);
                        //$('#al_subject4').val(data['al_subject4']);
                        $('#al_subject1_grade').val(data['al_subject1_grade']);
                        $('#al_subject2_grade').val(data['al_subject2_grade']);
                        $('#al_subject3_grade').val(data['al_subject3_grade']);
                        $('#al_subject4_grade').val(data['al_subject4_grade']);
                        $('#com_gen_paper').val(data['common_gen_paper']);
                        var score = data['al_z_core'];
                        $('#al_score_mode').val(score.substring(0, 1));
                        $('#al_z_core').val(score.substring(1));
                        
                        if(data['ol_year'] == 0){
                          $('#ol_year').val("");  
                        }
                        else{
                          $('#ol_year').val(data['ol_year']);
                        }
                        //common_gen_paper_index_no
                        if( data['common_gen_paper_index_no'] != null || data['common_gen_paper_index_no'] == "")
                        {
                            $('#common_gen_paper_index_no').val(data['common_gen_paper_index_no']);
                        }
                        $('input[name=ol_sityear][value=' + data['is_ol_single_year'] + ']').attr('checked', 'checked');
                        if(data['is_ol_single_year'] == 1)
                        {
                            $('#ol_english_year').hide();
                            $('#ol_english_index_no').hide();
                            $('#lbl_ol_year').hide();
                            $('#lbl_ol_index').hide();

                            $('#div_txt_ol_english_year').hide();
                            $('#div_txt_ol_english_index_no').hide();
                        }
                        else
                        {
                            $('#ol_english_year').show();
                            $('#ol_english_index_no').show();
                            $('#lbl_ol_year').show();
                            $('#lbl_ol_index').show();
                            $('#div_txt_ol_english_year').show();
                            $('#div_txt_ol_english_index_no').show();
                            
                            $('#ol_english_year').val(data['ol_english_year']);
                            $('#ol_english_index_no').val(data['ol_english_index_no']);
                        }
                        
                        $('#ol_index_no').val(data['ol_index_no']);
                        $('#ol_medium').val(data['ol_medium']);
                        $('#ol_maths_grade').val(data['ol_maths_grade']);
                        $('#ol_english_grade').val(data['ol_english_grade']);

                        $('#prt_Present_emp').val(data['employment']);
                        $('#prt_post').val(data['position']);
                        $('#prt_EPF').val(data['epf_no']);
                        $('#prt_address').val(data['work_place_address']);
                        $('#prt_app_date').val(data['appointment_date']);
                        $('#prt_br').val(data['business_reg_no']);
                        $('#prt_date_br').val(data['business_reg_date']);

                        $('input[name=apply_mahapola][value=' + data['apply_mahapola'] + ']').attr('checked', 'checked');
                    },
                    "json");


        } else {
        $(document).on('ready', function () {
            $("#stuprof_pic").fileinput({showCaption: false, showUpload: false});
        });
        }
        /*$('#stuprof_pic').on("change", function()
        {
            $('#lbl_stu_validate').text('');
        });*/

        
        $('input[name="ol_sityear"]').on('change', function() {
            var ol_sityear = $('input[name="ol_sityear"]:checked').val();
            
            if(ol_sityear == '1')
            {
                $('#ol_english_year').hide();
                $('#ol_english_index_no').hide();
                $('#lbl_ol_year').hide();
                $('#lbl_ol_index').hide();
                
                $('#div_txt_ol_english_year').hide();
                $('#div_txt_ol_english_index_no').hide();
            }
            else
            {
                $('#ol_english_year').show();
                $('#ol_english_index_no').show();
                $('#lbl_ol_year').show();
                $('#lbl_ol_index').show();
                $('#div_txt_ol_english_year').show();
                $('#div_txt_ol_english_index_no').show();
            }
          });
        
    });
    
    
    //Validate the Common general paper index Number
    function validate_com_gen_paper_index(e)
    {
        if($('#common_gen_paper_index_no').val())
        {
            var gen_mark_index = $('#common_gen_paper_index_no').val();
            //alert(gen_mark_index.length);
            if(gen_mark_index.length < 6 || gen_mark_index.length > 10){
                $('#lbl_gen_mark_index').text('Invalid length of index number !');
                $('#save_btn').attr('disabled', false);
                return false;
            }
            else{
                $('#lbl_gen_mark_index').text('');
                if($.isNumeric(gen_mark_index)){
                    $('#lbl_gen_mark_index').text('');
                }
                else{
                    $('#lbl_gen_mark_index').text('Ivalid index number format !');
                    
                    $('#save_btn').attr('disabled', false);
                    return false;
                }
        }
           
              
        }
        else{
            $('#lbl_gen_mark_index').text('');
        }
    } 


    //Validate the Common general paper marks
    function validate_com_gen_paper(e)
    {
        if($('#com_gen_paper').val())
        {
            var com_marks = $('#com_gen_paper').val();

            myRegExp = new RegExp(/^[0-9][0-9]?$|^100$/);

            if(myRegExp.test(com_marks)) {
                $('#lbl_com_gen_validate').text('');
            }
            else {
                $('#lbl_com_gen_validate').text('Invalid marks !');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
              
        }
        else{
            $('#lbl_com_gen_validate').text('');
        }
    } 
    
    //Validate the Common general paper marks
    function validate_z_score(e)
    {
        if($('#al_z_core').val())
        {
            var zscore = $('#al_z_core').val();

            myRegExp = new RegExp(/^[0-3](\.\d{0,4})?$/);

            if(parseFloat(zscore) > 3.0) {
                $('#lbl_zscore_validate').text('Invalid z-score value.');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
            else {
                
                if(myRegExp.test(zscore)){
                    $('#lbl_zscore_validate').text('');
                }
                else{
                    $('#lbl_zscore_validate').text('Invalid z-score value.');
                    $('#save_btn').attr('disabled', false);
                    e.preventDefault();
                }
            }  
        }
        else{
            $('#lbl_zscore_validate').text('');
        }
    } 
    
    
    $(document).on('input','#mobile_no',function(){
        var phone=$('#mobile_no').val();
        if(phone.indexOf('0')!==0){
              //alert('First number must be 0');
              $('#lbl_mobileNo').text('First number must be 0');
              $('#mobile_no').val('07');
        }else{
                if(phone.indexOf('7')!==1){
                     //alert('Second number must be 7');
                     $('#lbl_mobileNo').text('Second number must be 7');
                     $('#mobile_no').val('07');
                }
                else{
                    if(phone.indexOf('')!==2){
                        $('#lbl_mobileNo').text('');
                    }
                }    
        }
    });

function initialName(){
    
    var name = document.getElementById("first_name").value;
    var fname = document.getElementById("first_name").value;

    var res = fname.split(' ');
    var iname = res[(res.length)-1];
    var getInitials = function (name) {
    var parts = name.split(' ');
    var initials = '';
      
      
      
      for (var i = 0; i < parts.length; i++) {
//          initials = (initials + parts[i].substr(0,1));
        if(i != (parts.length)-1){
            if (parts[i].length > 0 && parts[i] !== '') {
                initials += parts[i][0].trim() + ".";
            }
        }
        
      }
      return initials;
    }
    
    document.getElementById("last_name").value = getInitials(name) +" "+iname;
//    alert(getInitials(name))
} 

function nicFormatValidate(){
    var date   = document.getElementById("birth_date").value;
    var year   = date.split("-", 1);
    var first_year = date.substr(2, 2);
    
    var nic_no = document.getElementById("nic_no").value;
    var nic = nic_no.length;
    
//    alert(year);
    
    if(nic > 10 && nic <= 12){
        var first_four = nic_no.substr(0, 4);
        if(first_four == year){
            alert("the 12 digit format correct");
        }else{
            alert("Incorrect 12 digit Format");
        }
    }else if(nic == 10){
        var first_two = nic_no.substr(0, 2);
        if(first_two == first_year){
            alert("the 12 digit format correct");
        }else{
            alert("Incorrect 12 digit Format");
        }
    }
    
    
    
}

//if(nic_no.length > 10 && nic_no.length =< 12){
//        var first_four = nic_no.substr(0, 4);
//        if(first_four == year){
//            alert("the format correct");
//        }else{
//            alert("Incorrect Format");
//        }
//    }




function genderSelectiionFromNIC(){
    var gender_nic = $('#nic_no').val();
    
    var stu_byear = 0;
    
    var nicLength = gender_nic.length;

    if(nicLength > 10 && nicLength <= 12){
        stu_byear = gender_nic.substr(4, 3);
        
        if(stu_byear > 0 && stu_byear <= 366){
            $('input[name=sex][value="M"]').attr({checked:'checked'});
        } 

        if(stu_byear > 500 && stu_byear <= 866){
//            alert("ssss");
            $('input[name=sex][value="F"]').attr({checked:'checked'});
        }
    }
    
    if(nicLength == 10){
        stu_byear = gender_nic.substr(2, 3);
        
        if(stu_byear > 0 && stu_byear <= 366){
//            document.getElementById("sexM").checked = true;
            $('input[name=sex][value="M"]').attr({checked:'checked'});
//            $('input[name=sex]:checked').val('M');
        } 

        if(stu_byear > 500 && stu_byear <= 866){
//            document.getElementById("sexF").checked = true;
            $('input[name=sex][value="F"]').attr({checked:'checked'});
//            $('input[name=sex]:checked').val('F');
        }
    }
    
    
    
}

function alSubjectsValidate(e){
    var alsub1 = $('#al_subject1').val();
    var alsub2 = $('#al_subject2').val();
    var alsub3 = $('#al_subject3').val();
    var alsub4 = $('#al_subject4').val();
    
    var alsub1G = $('#al_subject1_grade').val();
    var alsub2G = $('#al_subject2_grade').val();
    var alsub3G = $('#al_subject3_grade').val();
    var alsub4G = $('#al_subject4_grade').val();
    
    var alReq;
    /////////checking if subject select on ling grade can enter validation
    if(alsub1 != ""){
        alReq = "Grade Required";
        document.getElementById("demo1").innerHTML = alReq;
        $('#save_btn').attr('disabled', true);
        e.preventDefault();
    }else{
        if(alsub1G != ""){
            alReq = "You can't enter grade without subject";
            document.getElementById("demo1").innerHTML = alReq;
            $('#save_btn').attr('disabled', true);
            e.preventDefault();
        }
        else{
            alReq = "";
            document.getElementById("demo1").innerHTML = alReq;
        
        }
    }
    
    if(alsub2 != ""){
        alReq = "Grade Required";
        document.getElementById("demo2").innerHTML = alReq;
        $('#save_btn').attr('disabled', true);
        e.preventDefault();
    }else{
        if(alsub2G != ""){
            alReq = "You can't enter grade without subject";
            document.getElementById("demo2").innerHTML = alReq;
            $('#save_btn').attr('disabled', true);
            e.preventDefault();
        }
        else{
            alReq = "";
            document.getElementById("demo2").innerHTML = alReq;
        }
    }
    
    if(alsub3 != ""){
        alReq = "Grade Required";
        document.getElementById("demo3").innerHTML = alReq;
        $('#save_btn').attr('disabled', true);
        e.preventDefault();
    }else{
        if(alsub3G != ""){
            alReq = "You can't enter grade without subject";
            document.getElementById("demo3").innerHTML = alReq;
            $('#save_btn').attr('disabled', true);
            e.preventDefault();
        }
        else{
            alReq = "";
            document.getElementById("demo3").innerHTML = alReq;
        }
    }

    if(alsub4 != ""){
        alReq = "Grade Required";
        document.getElementById("demo4").innerHTML = alReq;
        $('#save_btn').attr('disabled', true);
        e.preventDefault();
    }else{
        if(alsub4G != ""){
            alReq = "You can't enter grade without subject";
            document.getElementById("demo4").innerHTML = alReq;
            $('#save_btn').attr('disabled', true);
            e.preventDefault();
        }
        else{
            alReq = "";
            document.getElementById("demo4").innerHTML = alReq;
        }
        
        
    }
    
//    ////////if there is grade without subjet show notifications
//    if(alsub1 == "" && alsub1G != ""){
//        alReq = "You can't enter grade without subject";
//        document.getElementById("demo1").innerHTML = alReq;
//        $('#save_btn').attr('disabled', false);
//        e.preventDefault();
//    }
//    if(alsub2 == "" && alsub2G != ""){
//        alReq = "You cant enter grade without subject";
//        document.getElementById("demo2").innerHTML = alReq;
//        $('#save_btn').attr('disabled', false);
//        e.preventDefault();
//    }
//    if(alsub3 == "" && alsub3G != ""){
//        alReq = "You cant enter grade without subject";
//        document.getElementById("demo3").innerHTML = alReq;
//        $('#save_btn').attr('disabled', false);
//        e.preventDefault();
//    }
//    if(alsub4 == "" && alsub4G != ""){
//        alReq = "You cant enter grade without subject";
//        document.getElementById("demo4").innerHTML = alReq;
//        $('#save_btn').attr('disabled', false);
//        e.preventDefault();
//    }

}

function gradeValidation(e){
    var alsub1 = $('#al_subject1').val();
    var alsub2 = $('#al_subject2').val();
    var alsub3 = $('#al_subject3').val();
    var alsub4 = $('#al_subject4').val();
    
    var alsub1G = $('#al_subject1_grade').val();
    var alsub2G = $('#al_subject2_grade').val();
    var alsub3G = $('#al_subject3_grade').val();
    var alsub4G = $('#al_subject4_grade').val();
    
    var alReq;
    
    //////////Checking if there is grade hide the notification
    if(alsub1G != ""){
        alReq = "";
        document.getElementById("demo1").innerHTML = alReq;
    }else{
        alReq = "Grade Required";
        document.getElementById("demo1").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    
    if(alsub2G != ""){
        alReq = "";
        document.getElementById("demo2").innerHTML = alReq;
    }else{
        alReq = "Grade Required";
        document.getElementById("demo2").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    
    if(alsub3G != ""){
        alReq = "";
        document.getElementById("demo3").innerHTML = alReq;
    }else{
        alReq = "Grade Required";
        document.getElementById("demo3").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    
    if(alsub4G != ""){
        alReq = "";
        document.getElementById("demo4").innerHTML = alReq;
    }else{
        alReq = "Grade Required";
        document.getElementById("demo4").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    
    
    //////////if there is empty subject and grade hide the notifications
    if(alsub1 == "" && alsub1G ==""){
        alReq = "";
        document.getElementById("demo1").innerHTML = alReq;
    }
    if(alsub2 == "" && alsub2G ==""){
        alReq = "";
        document.getElementById("demo2").innerHTML = alReq;
    }
    if(alsub3 == "" && alsub3G ==""){
        alReq = "";
        document.getElementById("demo3").innerHTML = alReq;
    }
    if(alsub4 == "" && alsub4G ==""){
        alReq = "";
        document.getElementById("demo4").innerHTML = alReq;
    }
    
    ////////if there is grade without subjet show notifications
    if(alsub1 == "" && alsub1G != ""){
        alReq = "You cant enter grade without subject";
        document.getElementById("demo1").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    if(alsub2 == "" && alsub2G != ""){
        alReq = "You cant enter grade without subject";
        document.getElementById("demo2").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    if(alsub3 == "" && alsub3G != ""){
        alReq = "You cant enter grade without subject";
        document.getElementById("demo3").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    if(alsub4 == "" && alsub4G != ""){
        alReq = "You cant enter grade without subject";
        document.getElementById("demo4").innerHTML = alReq;
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }
    
}


function alStreamLoadValidation(e){
    var al_stream = $('#al_stream').val();
   
    var alsub1 = $('#al_subject1').val();
    var alsub2 = $('#al_subject2').val();
    var alsub3 = $('#al_subject3').val();
    var alsub4 = $('#al_subject4').val();
    
    if(al_stream != ""){
        if(alsub1 == "" && alsub2 == "" && alsub3 == "" && alsub4 == ""){
            $('#select_subject_alert').text('Please select all subject');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        }else{
            $('#select_subject_alert').text('');
        }
    }else{
        $('#select_subject_alert').text('');
    }
}

function subject_grade_validation(e){
    var alsub1 = $('#al_subject1').val();
    var alsub2 = $('#al_subject2').val();
    var alsub3 = $('#al_subject3').val();
    var alsub4 = $('#al_subject4').val();
    
    var alsub1G = $('#al_subject1_grade').val();
    var alsub2G = $('#al_subject2_grade').val();
    var alsub3G = $('#al_subject3_grade').val();
    var alsub4G = $('#al_subject4_grade').val();
    
    if(alsub1 != "" && alsub1G == ""){
        $('#demo1').text('Select A/L Grade');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else if(alsub1 == "" && alsub1G != ""){
        $('#demo1').text('You cant select grade without selecting subject');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else{
        $('#demo1').text('');
    }
    
    if(alsub2 != "" && alsub2G == ""){
        $('#demo2').text('Select A/L Grade');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else if(alsub2 == "" && alsub2G != ""){
        $('#demo2').text('You cant select grade without selecting subject');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else{
        $('#demo2').text('');
    }
    
    if(alsub3 != "" && alsub3G == ""){
        $('#demo3').text('Select A/L Grade');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else if(alsub3 == "" && alsub3G != ""){
        $('#demo3').text('You cant select grade without selecting subject');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else{
        $('#demo3').text('');
    }
    
    if(alsub4 != "" && alsub4G == ""){
        $('#demo4').text('Select A/L Grade');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else if(alsub4 == "" && alsub4G != ""){
        $('#demo4').text('You cant select grade without selecting subject');
        $('#save_btn').attr('disabled', false);
        e.preventDefault();
    }else{
        $('#demo4').text('');
    }
}
</script>
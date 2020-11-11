<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js')?>"></script><!--jquery-->
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

</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT INFORMATION</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard')?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Student Edit</li>
        </ol>
    </div>
</div>
<div class="row">
<!--    <div class="col-md-2 scrollspy">
        <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="60" data-offset-bottom="200" id="myAffix">
            <li role="presentation" class="active" onclick="change_displaysize('generaldata');"><a href="#generaldata">General</a></li>
            <li role="presentation" onclick="change_displaysize('studentinfo');"><a href="#studentinfo">Student Information</a></li>
            <li role="presentation" onclick="change_displaysize('emergencycont1');"><a href="#emergencycont">Contact</a></li>
            <li role="presentation" onclick="change_displaysize('stuhistory');"><a href="#stuhistory">Educational History</a></li>
            <li role="presentation" onclick="change_displaysize('admissiondata');"><a href="#admissiondata">Academic Data</a></li>
        </ul>
    </div>-->
    <div class="container col-md-12">
        <form class="form-horizontal" role="form" method="post"  id="reg_form" action="<?php echo base_url('student/save_student')?>"  autocomplete="off" novalidate>
        <section class="panel affixpanel" id="generaldata">
            <br>
            <div class="panel-body" style="padding-bottom: 30px;">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-md-3 control-label">ATI Center<span style="color:red;font-size: 16px">*</span></label>
                        <div class="col-md-6">
                            <?php 
                                global $branchdrop;
                                global $selectedbr;

                                if(isset($stu_data))
                                {
                                    $selectedbr = $stu_data['center_id'];
                                }
                                $extraattrs = 'id="tt_branch" class="form-control" style="width:100%" data-validation="required" onchange="load_course_list(this.value,null,this)"';
                                echo form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fax" class="col-md-2 control-label">Course<span style="color:red;font-size: 16px">*</span></label>
                        <div class="col-md-8">
                            <select class="form-control" id="course_id" name="course_id" style="width:100%" data-validation="required" onchange="set_reg_no(this)">
                                <option value=""></option>
                                <?php
                                   // $course = $this->db->get('com_religion')->result_array();
                                    foreach($courses as $row):
                                        $selected="";
                                        if($row['id']==$stu_data['course_id']){
                                            $selected="selected";
                                        }
                                        ?>
                                        <option value="<?php echo $row['id'];?>"  <?php echo $selected?>>
                                            <?php echo $row['course_code']."-".$row['course_name'];?>
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
                    <div class="form-group col-md-6">
                        
                       <?php
//                            $time = $stu_data['time'];
//                            $selected_time1 =  '';
//                            $selected_time2 =  '';
//                            if($time == 'Full Time')
//                            {
//                                $selected_time1 =  'checked="checked"';
//                            }elseif($time == 'Part Time')
//                            {
//                                $selected_time2 =  'checked="checked"';
//                            }
//                        ?>
                        
                        
                        <label for="fax" class="col-md-4 control-label">Course Type</label>
                        <div class="col-md-8">
                            <input type="radio" name="course_type" class="col-md-1" id="course_type_full" value="F" <?php //echo $selected_time1 ?> onchange="course_type_on_change()">
                            <label class="col-md-3 control-label">Full Time</label>

                            <input type="radio" name="course_type" id="course_type_part" class="col-md-1" value="P" <?php //echo $selected_time2 ?> onchange="course_type_on_change()">
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
                            <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="reg_no" name="reg_no" placeholder="" value="<?php //echo $stu_data['reg_no'];?>" style="width:100%">
                        </div>
                    </div>-->
                <div class="form-group col-md-6">
                    <label for="fax" class="col-md-3 control-label">Reg. No. <span style="color:red;font-size: 16px">*</span></label>
                    <table >
                        <tr>
                            <td style="">
                                <input type="text" class="form-control" id="reg_no_part1" name="reg_no_part1" placeholder="" value="" style="width:100%;margin-left: 18px;">
                            </td>
                            <td>
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="reg_no_part2" name="reg_no_part2" placeholder="" value="" style="width:70px">
                                <select class="js-example-basic-single" name="state">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>
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
                <input type="hidden" id="id" name="id" value="<?php //echo $stu_data['id'];?>">
                <input type="hidden" id="ref_t" name="ref_t" value="<?php //echo $type?>">
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php 
                             $firstname = $stu_data['first_name'];
                             $lastname = $stu_data['last_name'];
                        ?>
                            <div class="col-md-9">
                                <label for="name" class="control-label">Name with  initials<span style="color:red;font-size: 16px">*</span></label>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="first_name" name="first_name" placeholder="" value="<?php echo $firstname;?>" style="width:100%">
                            </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class=" form-group col-md-6">
                        <div class="col-md-9">
                            <label for="brnum" class=" control-label">Name/Names denoted by Initials<span style="color:red;font-size: 16px">*</span></label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="last_name" name="last_name" placeholder="" value="<?php echo $lastname;?>" style="width:100%">
                        </div>
                    </div>
                </div>
                <br>  
                <div class="row">
                    <div class="form-group col-md-6">
                        
                        <?php
                            $status = $stu_data['civil_status'];
                            $selected_status1 =  '';
                            $selected_status2 =  '';
                            if($status == 'S')
                            {
                                $selected_status1 =  'checked="checked"';
                            }elseif($status == 'M')
                            {
                                $selected_status2 =  'checked="checked"';
                            }
////                        ?>
                        
                        <label for="comcode" class="control-label col-sm-3">Civil Status </label>
                        <div class="col-sm-7">
                            <label class="col-md-3 control-label">Single</label>
                            <input type="radio" name="civil_status" class="col-md-1" id="civil_status" value="S" <?php echo $selected_status1 ?>>

                            <label class="col-md-3 control-label">Married</label>
                            <input type="radio" name="civil_status" id="civil_status" class="col-md-1" value="M" <?php echo  $selected_status2 ?>>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail3" class="col-sm-3 control-label">NIC</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="nic_no" id="nic_no"  data-format="YYYY-MM-DD" value="<?php echo $stu_data['nic_no']?>">      
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        
                        <?php
                            $gender = $stu_data['sex'];
                            $selected_gender1 =  '';
                            $selected_gender2 =  '';
                            if($gender == 'M')
                            {
                                $selected_gender1 =  'checked="checked"';
                            }elseif($gender == 'F')
                            {
                                $selected_gender2 =  'checked="checked"';
                            }
//                        ?>
                        
                        <label for="comcode" class="control-label col-sm-3">Gender </label>
                        <div class="col-sm-7">
                            <label class="col-md-3 control-label">Male</label>
                            <input type="radio" name="sex" class="col-md-1" id="sex" value="M" <?php echo $selected_gender1 ?>>

                            <label class="col-md-3 control-label">Female</label>
                            <input type="radio" name="sex" id="sex" class="col-md-1" value="F" <?php echo  $selected_gender2 ?>>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail3" class="col-sm-3 control-label">Date Of Birth</label>
                        <div class="col-sm-6">
                            <div id="" class="input-group date" >
                                <input class="form-control datepicker" type="text" name="birth_date" id="birth_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'')?>">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-8">
                        <label for="comcode" class="control-label col-sm-1">Age</label>
                        
                        <label for="comcode" class="control-label col-sm-1">Year</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="txtAgeYear" name="txtAgeYear" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid year"  data-validation-optional="true" value="<?php echo $stu_data['age_year']?>">

                        </div>
                         <label for="comcode" class="control-label col-sm-1">Month</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="txtAgeMonth" name="txtAgeMonth" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid month"  data-validation-optional="true" value="<?php echo $stu_data['age_month']?>">

                        </div>
                          <label for="comcode" class="control-label col-sm-1">Days</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="txtAgeDays" name="txtAgeDays" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid days"  data-validation-optional="true" value="<?php echo $stu_data['age_days']?>">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="comcode" class="col-sm-3 control-label">Place of Birth </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="place_birth" name="place_birth" placeholder="" value="<?php echo $stu_data['place_birth']?>">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="religion" class="col-md-3 control-label">Religion</label>
                        <div class="col-md-6">
                            <select class="form-control" id="religion" name="religion"  style="width: 100%;">
                                <option value=""></option>
                                <?php
                                    $rlgn = $this->db->get('com_religion')->result_array();
                                    foreach($rlgn as $row):
                                        $selected="";
                                        if($row['rel_id']==$stu_data['religion']){
                                            $selected="selected";
                                        }
                                        ?>
                                        <option value="<?php echo $row['rel_id'];?>" <?php echo $selected?>>
                                            <?php echo $row['rel_name'];?>
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
                        <label for="fax" class="col-md-3 control-label">Address</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="permanent_address" name="permanent_address" placeholder="" value="<?php echo $stu_data['permanent_address']?>">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fax" class="col-md-3 control-label">Administrative District:</label>
                        <div class="col-md-6">
<!--                            <input type="text" class="form-control" id="district" name="district" value="<?php //echo $stu_data['district']?>">-->
                            
                            <select class="form-control" id="district" name="district"  style="width: 100%;">
                                <option value=""></option>
                                <?php
                                    foreach($districts as $row):
                                        $selected="";
                                        if($row['district'] == $stu_data['district']){
                                            $selected = "selected";
                                        }
                                        ?>
                                        <option value="<?php echo $row['code'];?>" <?php echo $selected?>>
                                            <?php echo $row['district'];?>
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
                        <label for="comcode" class="col-sm-3 control-label">Home Number </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" data-validation="number length" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" id="fixed_tp" name="fixed_tp" placeholder=""  data-validation-optional="true" value="<?php echo $stu_data['fixed_tp']?>">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" data-validation="number length" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" id="mobile_no" name="mobile_no" placeholder=""  data-validation-optional="true" value="<?php echo $stu_data['mobile_no']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fax" class="col-md-3 control-label">Email Address</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="email" name="email" placeholder="" data-validation="email" data-validation-error-msg-email="Invalid E-mail"  data-validation-optional="true" value="<?php echo $stu_data['email']  ?>" style="width:100%">
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
                        <label for="al_year" class="col-md-1 control-label">Year</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="al_year" name="al_year" value="<?php echo $stu_data['al_year']?>">
                        </div>
                        <label for="al_index_no" class="col-md-2 control-label">Index No.</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="al_index_no" name="al_index_no" value="<?php echo $stu_data['al_index_no']?>">
                        </div>
                    </div>
                    <label for="al_medium" class="col-md-1 control-label">Medium</label>
                        <div class="col-md-2">
                            <select class="form-control" id="al_medium" name="al_medium" >
                                <?php 
                                    if($stu_data['al_medium'] == 'Sinhala'){
                                    ?>
                                    <option selected>Sinhala</option>
                                    <option>Tamil</option>
                                    <option>English</option>
                                    <?php
                                    } 
                                    if($stu_data['al_medium'] == 'Tamil'){
                                    ?>
                                    <option>Sinhala</option>
                                    <option selected>Tamil</option>
                                    <option>English</option>
                                    <?php
                                    } 
                                    if($stu_data['al_medium'] == 'English'){
                                    ?>
                                    <option>Sinhala</option>
                                    <option>Tamil</option>
                                    <option selected>English</option>
                                    <?php
                                    }
                                ?>
                            </select>  
                        </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="en_mat_sc[o/l]" class="col-md-3 control-label">Stream</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="al_stream" name="al_stream" placeholder="" value="<?php echo $stu_data['al_stream']?>">
                        </div>
                    </div>
                </div>
                
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="al_en_cgt" class="col-md-3 control-label">A/L Result</label>
                        <div class="col-md-8">
<!--                            <input type="text" class="form-control" id="al_en_cgt" name="al_en_cgt" placeholder="" value="<?php //echo $stu_data['al_en_cgt']?>">-->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                  <th>Subject</th>
                                  <th>Grade</th>
                                </tr>
                              </thead>
                                <tr><td><input type="text" class="form-control" id="al_subject1" name="al_subject1" placeholder="" value="<?php echo $stu_data['al_subject1']?>"></td><td><input type="text" class="form-control" id="al_subject1_grade" name="al_subject1_grade" placeholder="" value="<?php echo $stu_data['al_subject1_grade']?>"></td></tr>
                                <tr><td><input type="text" class="form-control" id="al_subject2" name="al_subject2" placeholder="" value="<?php echo $stu_data['al_subject2']?>"></td><td><input type="text" class="form-control" id="al_subject2_grade" name="al_subject2_grade" placeholder="" value="<?php echo $stu_data['al_subject2_grade']?>"></td></tr>
                            </table>
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
                                <tr><td><input type="text" class="form-control" id="al_subject3" name="al_subject3" placeholder="" value="<?php echo $stu_data['al_subject3']?>"></td><td><input type="text" class="form-control" id="al_subject3_grade" name="al_subject3_grade" placeholder="" value="<?php echo $stu_data['al_subject3_grade']?>"></td></tr>
                                <tr><td><input type="text" class="form-control" id="al_subject4" name="al_subject4" placeholder="" value="<?php echo $stu_data['al_subject4']?>"></td><td><input type="text" class="form-control" id="al_subject4_grade" name="al_subject4_grade" placeholder="" value="<?php echo $stu_data['al_subject4_grade']?>"></td></tr>
                                </tbody>
                            </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="en_mat_sc[o/l]" class="col-md-4 control-label">Common General Paper</label>
                        <div class="col-md-3">
<!--                            <input type="text" class="form-control" id="en_mat_sc[o/l]" name="en_mat_sc[o/l]" placeholder=""  value="<?php //echo $stu_data['en_mat_sc[o/l]']?>">-->
                            <input type="text" class="form-control" id="com_gen_paper" name="com_gen_paper" placeholder=""  value="<?php echo $stu_data['common_gen_paper']?>">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="al_z_core" class="col-md-4 control-label">A/L Z-core</label>
                        <table >
                            <tr>
                                <td>
                                    <select class="form-control" id="al_score_mode" name="al_score_mode" style="width:70px">
                                        <?php 
                                            $zcore = $stu_data['al_z_core'];
                                            
                                            $operator = $zcore[0];
                                            $core = substr($zcore, 1);
                                            
                                            if($operator == '+'){    
                                            ?>
                                                <option selected>+</option>
                                                <option>-</option>
                                            <?php
                                            }
                                            
                                            if($operator == '-'){
                                            ?>
                                               <option>+</option>
                                               <option selected>-</option> 
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="al_z_core" name="al_z_core" placeholder="" value="<?php echo $core?>" data-validation="number" data-validation-error-msg-number="Invalid score"  data-validation-optional="true">
                                </td>
                            </tr>
                        </table>
                        
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
                    <div class="form-group col-md-6">
                        <label for="ol_year" class="col-md-1 control-label">Year</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="ol_year" name="ol_year" value="<?php echo $stu_data['ol_year']?>">
                        </div>
                        <label for="ol_index_no" class="col-md-2 control-label">Index No.</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="ol_index_no" name="ol_index_no" value="<?php echo $stu_data['ol_index_no']?>">
                        </div>
                    </div>
                    <label for="ol_stream" class="col-md-1 control-label">Medium</label>
                        <div class="col-md-2">
                            <select class="form-control" id="ol_medium" name="ol_medium" >
                                <?php 
                                    if($stu_data['ol_medium'] == 'Sinhala'){
                                    ?>
                                    <option selected>Sinhala</option>
                                    <option>Tamil</option>
                                    <option>English</option>
                                    <?php
                                    } 
                                    if($stu_data['ol_medium'] == 'Tamil'){
                                    ?>
                                    <option>Sinhala</option>
                                    <option selected>Tamil</option>
                                    <option>English</option>
                                    <?php
                                    } 
                                    if($stu_data['ol_medium'] == 'English'){
                                    ?>
                                    <option>Sinhala</option>
                                    <option>Tamil</option>
                                    <option selected>English</option>
                                    <?php
                                    }
                                ?>
                            </select>  
                        </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="al_en_cgt" class="col-md-3 control-label">Result</label>
                        <div class="col-md-8">
                            
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                  <th>Subject</th>
                                  <th>Grade</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr><td><label for="ol_maths" class="col-md-1 control-label">Maths</label></td><td><input type="text" class="form-control" id="ol_Sub1_grade" name="ol_Sub1_grade" placeholder="" value="<?php echo $stu_data['ol_maths_grade']?>"></td></tr>
                                </tbody>
                            </table>
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
                                <tr><td><label for="ol_english" class="col-md-1 control-label">English</label></td><td><input type="text" class="form-control" id="ol_Sub2_grade" name="ol_Sub2_grade" placeholder="" value="<?php echo $stu_data['ol_english_grade']?>"></td></tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section id="div_course_type" class="panel affixpanel" id="admissiondata">
            <header class="panel-heading">
                Part Time Course Details
            </header>
            
            <div class="panel-body">
                
                <div class="row">
                    
                    <label for="prt_present_emp" class="col-md-4 control-label">Details of Present Employment / Self-employment</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_Present_emp" name="prt_Present_emp" placeholder="" value="<?php //echo $stu_data['al_z_core']?>">
                        </div>
                </div>
                </br>
                <div class="row">
                    <label for="prt_post" class="col-md-4 control-label">Post</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_post" name="prt_post" placeholder="" value="<?php //echo $stu_data['al_z_core']?>">
                        </div>
                </div>
                </br>
                <div class="row">
                    <label for="prt_EPF" class="col-md-4 control-label">E.P.F. Number</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_EPF" name="prt_EPF" placeholder="" value="<?php //echo $stu_data['al_z_core']?>">
                        </div>
                </div>
                </br>
                <div class="row">
                    <label for="prt_address" class="col-md-4 control-label">Place of Work and Address</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <input type="text" class="form-control" id="prt_address" name="prt_address" placeholder="" value="<?php //echo $stu_data['al_z_core']?>">
                        </div>
                </div>
                </br>
                <div class="row">
                    <label for="prt_app_date" class="col-md-4 control-label">Date of Appointments</label>
                        <div class="col-md-6">
                            <div id="" class="input-group date" >
                                <input class="form-control datepicker" type="text" name="prt_app_date" id="prt_app_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'')?>">
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
                            <input type="text" class="form-control" id="prt_br" name="prt_br" placeholder="" value="<?php //echo $stu_data['al_z_core']?>">
                        </div>
                </div>
                </br>
                <div class="row">
                    <label for="prt_date_br" class="col-md-4 control-label">Date of BR</label>
                        <div class="col-md-6">
                            <!-- prt = Part time-->
                            <div id="" class="input-group date" >
                                <input class="form-control datepicker" type="text" name="prt_date_br" id="prt_date_br"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'')?>">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                </span>
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <!--<section class="panel affixpanel" id="admissiondata">
            <header class="panel-heading">
                Admission Data
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fax" class="col-md-4 control-label">Faculty</label>
                        <div class="col-md-8">
                            <?php 

//                                global $facultydrop;
//                                global $selectedfac;
//
//                                if(isset($stu_data))
//                                {
//                                    $selectedfac = $stu_data['faculty_id'];
//                                }
//
//                                $facextraattrs = 'id="faculty_id" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"  onchange="load_degrees_list(this.value,null)"  style="width:100%"';
//                                echo form_dropdown('faculty_id',$facultydrop,$selectedfac, $facextraattrs); 

                            ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fax" class="col-md-4 control-label">Batch</label>
                        <div class="col-md-8">
                            <select class="form-control" id="batch_id" name="batch_id" style="width:100%">
                             
                            </select>  
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="panel">
            <div class="panel-body">
                <br>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-11">
                        <?php 
                            // if($_GET['type']=='edit')
                            // {
                        ?>
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
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
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js")?>'></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css')?>">
<script type="text/javascript">
    
    $.validate({
        form: '#reg_form'
    });

//$('.datepicker').datepicker({
//    autoclose: true
//});

   
    $('#birth_date').datepicker({
        autoclose: true
    });
    $('#birth_date').datepicker("setDate", '<?php echo $stu_data['birth_date'];?>');
        
                



function load_course_list(center_id,selectedid,selected)
{
    //set REG NUmber..
    var sel_val = selected.options[selected.selectedIndex].text;
    center_code = sel_val.split('-')[0].trim();
    
    $('#reg_no_part1').val(center_code+'/'+course_code+'/'+year+'/'+course_type+'/');

    $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

    $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

    function (data)
    {
        for (var i = 0; i < data.length; i++) 
        {

            if(selectedid == data[i]['id'])
            {
                $('#course_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['degree_code']+' - '+data[i]['degree_name']));
            }
            else
            {
                $('#course_id').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['degree_code']+' - '+data[i]['degree_name']));

            }
        }
    },
    "json"
    );
}

function set_reg_no(sel)
{
    //set REG NUmber..
    var sel_val = sel.options[sel.selectedIndex].text;
    course_code = sel_val.split('-')[0].trim();
    
    $('#reg_no_part1').val(center_code+'/'+course_code+'/'+year+'/'+course_type+'/');
    
}

function load_batches(id,selectedid,selected)
{
    
    $('#batch_id').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

    $.post("<?php echo base_url('student/load_batches') ?>", {'id': id},
    function (data)
    {
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
        }
        else
        {
            for (var i = 0; i < data.length; i++) {

                if(selectedid == data[i]['id'])
                {
                    $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['batch_code']+' - '+data[i]['description']));
                }
                else
                {
                    $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']+' - '+data[i]['description']));
                }
            }
        }
    },
    "json"
    );
}

function course_type_on_change()

{
    var course_type_full = $('#course_type_full').prop('checked');
    if(course_type_full == true)
    {
        $('#div_course_type').hide();
        course_type= 'F';
    }
    else
    {
        $('#div_course_type').show();
        course_type= 'P';
    }
    $('#reg_no_part1').val(center_code+'/'+course_code+'/'+year+'/'+course_type+'/');
}

    var center_code='-';
    var course_code = '-';
    var course_type= 'F';
    
    var year = (new Date).getFullYear();
    
$(document).ready(function()
{
    $('#div_course_type').hide();
    $("#reg_no_part1").prop('disabled', true);
    
    //get student REG number in to auto complete.
    $.post("<?php echo base_url('student/load_student_reg_range') ?>", {},
    function (data)
    {
        var range = data[0]['RANGE_VALUES'].split('-');
        var range_array= [];
        console.info(range[0] +  '-' + range[1]);
        for(var i=range[0];i<=range[1];i++)
        {
            range_array.push(i);
        }
        $( "#reg_no_part2" ).autocomplete({
            source: range_array
          });
        
    },
    "json");
    
});

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
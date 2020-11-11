<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>LECTURER SUBJECTS REPORT VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Lecturer Subjects View</li>
        </ol>
    </div>
</div>


<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a class="fa fa-user" href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab"> Lecturers Report</a></li>
    <li role="presentation"><a class="fa fa-university" href="#subject_tab" aria-controls="subject_tab" role="tab" data-toggle="tab"> Semester Subject Report</a></li>
    <li role="presentation"><a class="fa fa-university" href="#subject_exam_tab" aria-controls="subject_exam_tab" role="tab" data-toggle="tab"> Semester Exam Timetable Report</a></li>
    <li role="presentation"><a class="fa fa-university" href="#student_sem_sub_tab" aria-controls="student_sem_sub_tab" role="tab" data-toggle="tab"> Student Semester Subjects</a></li>   
    <li role="presentation"><a class="fa fa-university" href="#dip_eligible_students_tab" aria-controls="dip_eligible_students_tab" role="tab" data-toggle="tab"> Report for Diploma Eligible Students</a></li>
    <li role="presentation"><a class="fa fa-university" href="#stu_request_tab" aria-controls="stu_request_tab" role="tab" data-toggle="tab"> Student Request</a></li>
    <li role="presentation"><a class="fa fa-university" href="#paper_setter_tab" aria-controls="paper_setter_tab" role="tab" data-toggle="tab"> Paper Setter & Moderator</a></li>
    <li role="presentation"><a class="fa fa-university" href="#transferred_students_tab" aria-controls="transferred_students_tab" role="tab" data-toggle="tab"> Transferred Students</a></li>
</ul>


<div class="tab-content">
    <!--First Tab--> 
    <div role="tabpanel" class="tab-pane  active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Lecturer Subjects View
            </div>
<div class="panel-body">
       <div class="row">                    
           <div class="col-md-12">
                        <div class="form-group col-md-5">
                            <div class="form-group">
                                <input type="hidden" id="user_level" name="user_level" value="<?php echo      $ug_level ?>">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-7">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
//                                    $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="load_lecturers(this.value);" data-validation="required" data-validation-error-msg-required="Field can not be empty"';

                                    if (isset($stu_data)) {
                                        $selectedbr = $stu_data['center_id'];
                                    }
                                   
                                    $extraattrs = 'id="center_id" class="form-control" onchange="load_lecturers(this.value);" '
                                            . 'style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty"';

                                    echo form_dropdown('center_id', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                                </div>
                            </div>				
                        </div>


                        <div class="form-group col-md-5">
                            <div class="form-group">
                                <input type="hidden" id="user_level" name="user_level" value="<?php echo $ug_level ?>">
                                <div class="col-sm-12">
                   </div>
                                
                             
                                <div class="col-md-6">
                                    
                                    <input type="radio" name="app_status" class="" id="app_status" value="1" checked style="margin: 9px 0 0;" onclick="sub_radio_change()">  Subject:
                                    <!--<input type="hidden" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="subject_id" name="subject_id" placeholder="">-->
                                    <select class="form-control" id="subject_id" name="subject_id" onchange="changeSubValue(this.value);" required>
                                        
                                        <option value="all">---All---</option>
                                        <?php
                                        for ($sub = 0; $sub < sizeof($subjects); $sub++) {
                                            echo '<option value="' . $subjects[$sub]['id'] . '">' . $subjects[$sub]['code'] . "-" . $subjects[$sub]['subject'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class ="col-md-6">
                                    
                                   <input type="radio" name="app_status" class="" id="app_status" value="2" style="margin: 9px 0 0;" onclick="sub_radio_change()">  Lecturer:
                                   <select class="form-control" id="lecturer_id" name="lecturer_id" onchange="changeValue(this.value);"
                                            data-validation="required" data-validation-error-msg-required="Field can not be empty"
                                            value="" style="width:100%">
                                        
                                        <option value="all">---All---</option>
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ------------------- -->
                </div>

                <div class="row">
                    <div class="col-md-11">
                        <div id ="subject_div">
                        <div class="form-group" style="padding-right: 30px; float: right;">
                            <button type="button" class='btn btn-primary' onclick='event.preventDefault(); load_staff_data();'>Search</button>
                        </div>
                    

                    <div class="col-md-1" style="float: right;">
                        <div class="form-group">
                            <button type="button" id="load_staff_full_data_btn" name="load_staff_full_data_btn" class="btn btn-success" onclick="load_staff_full_data();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                        </div>
                    </div>

                    
                 <div id="with_sub_div">
                      <table class="table table-bordered" id="staff_detail_tbl_all">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Center</th>
                            <th>Subject</th>
                            <th>Staff Index</th>
                            <th>Staff Name</th>
                            <!--<th>Actions</th>-->
                        </tr>
                    </thead>
                    <tbody id="staff_detail_tbl_body_all">

                    </tbody>
                    </table>  
                 </div>
                   
            <div id="without_sub_div">
                    <table class="table table-bordered" id="staff_detail_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Center</th>
                            <th>Staff Index</th>
                            <th>Staff Name</th>
                            <!--<th>Actions</th>-->
                        </tr>
                    </thead>
                    <tbody id="staff_detail_tbl_body">

                    </tbody>
                    </table>  
           </div>
                    
                        
                
</div>
      
       <div id ="lecturer_div">
            <div class="form-group" style="padding-right: 30px; float: right;">
                <button type="button" class='btn btn-primary' onclick='event.preventDefault(); load_subject_data();'>Search</button>
            </div>
                    

                <div class="col-md-1" style="float: right;">
                    <div class="form-group">
                        <button type="button" id="load_subject_full_data_btn" name="load_subject_full_data_btn" class="btn btn-success" onclick="load_subject_full_data();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>

                    <div id="with_lec_name_div">
                        <table class="table table-bordered" id="subject_detail_tbl_all">
                        <thead id="load_thead">
                            <tr>
                                <th>#</th>
                                <th>Center</th>
                                <th>Lecturer Name</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <!--<th>Actions</th>-->
                            </tr>
                        </thead>
                        <tbody id="subject_detail_tbl_all_body">

                        </tbody>
                    </table>
                    </div>
                    <div id="without_lec_name_div">
                        <table class="table table-bordered" id="subject_detail_tbl">
                        <thead id="load_thead">
                            <tr>
                                <th>#</th>
                                <th>Center</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <!--<th>Actions</th>-->
                            </tr>
                        </thead>
                        <tbody id="subject_detail_tbl_body">

                        </tbody>
                    </table>
                    </div>
                
</div>                    
                        </div> 

                </div>

            </div>

        </div>
    </div>     

    <!--Second Tab--> 
    <div role="tabpanel" class="tab-pane" id="subject_tab">
        <div class="panel">
            <div class="panel-heading">
                Semester Subject Report
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="defined_exam_course" name="defined_exam_course" onchange="load_year_list_for_semsubject();">
                                        <option value="">---Select Course---</option>
                                        <?php
                                        for ($sub = 0; $sub < sizeof($courses); $sub++) {
                                            echo '<option value="' . $courses[$sub]['id'] . '">' . $courses[$sub]['course_code'] . ' - ' . $courses[$sub]['course_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Year</label>
                                <div class="col-md-7">
                                    <select id="defined_year" class="form-control" style="width:100%" name="defined_year" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_semesters_list_for_semsubject(this.value);">
                                        <option value="">---All---</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Semester</label>
                                <div class="col-md-7">
                                    <select id="defined_semester" class="form-control" style="width:100%" name="defined_semester" data-validation="required" data-validation-error-msg-required="Field can not be empty" <!--onchange="load_exam(this.value);"-->>
                                            <option value="">---All---</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- ------------------- -->
                </div>
                <br>

                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group" style="padding-right: 30px; float: right;">
                            <button type="button" class='btn btn-primary' onclick='event.preventDefault();search_load_semester_sub_data();'>Search</button>
                        </div>
                    </div>

                    <div class="col-md-1" style="float: right;">
                        <div class="form-group">
                            <button type="button" id="print_semester_sub_data_btn" name="print_semester_sub_data_btn" class="btn btn-success" onclick="print_semester_sub_data();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                        </div>
                    </div>

                   
                </div>

                <table class="table table-bordered" id="semester_sub_detail_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Batch Code</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Subject Group</th>
                            <th>Subject Name</th>
                            <th>Subject Code</th>
                            <!--<th>Actions</th>-->
                        </tr>
                    </thead>
                    <tbody id="staff_detail_tbl_body">

                    </tbody>
                </table>

          </div>
        </div>
    </div>

    <!--Third Tab--> 
    <div role="tabpanel" class="tab-pane" id="subject_exam_tab">
        <div class="panel">
            <div class="panel-heading">
                Semester Exam Timetable Report
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="defined_sem_exam_course" name="defined_sem_exam_course" onchange="load_year_list_for_semsubject_exam();">
                                        <option value="">---Select Course---</option>
                                        <?php
                                        for ($sub = 0; $sub < sizeof($courses); $sub++) {
                                            echo '<option value="' . $courses[$sub]['id'] . '">' . $courses[$sub]['course_code'] . ' - ' . $courses[$sub]['course_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Year</label>
                                <div class="col-md-7">
                                    <select id="defined_sem_year" class="form-control" style="width:100%" name="defined_sem_year" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_semesters_list_for_semsubject_exam(this.value);">
                                        <option value="">---All---</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Semester</label>
                                <div class="col-md-7">
                                    <select id="defined_sem_semester" class="form-control" style="width:100%" name="defined_sem_semester" data-validation="required" data-validation-error-msg-required="Field can not be empty" <!--onchange="load_exam(this.value);"-->>
                                            <option value="">---All---</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- ------------------- -->
                </div>
                <br>
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group" style="padding-right: 30px;">
                            <button type="button" class='btn btn-primary' onclick='event.preventDefault();search_load_semester_sub_exam_data();' style="float: right;">Search</button>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" id="print_semester_sub_exam_data_btn" name="print_semester_sub_exam_data_btn" class="btn btn-success" onclick="print_semester_sub_exam_data();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                        </div>
                    </div>

                    <!--                    <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md">
                                                    <button type="button" id="print_bulk_btn" name="print_btn" class="btn btn-success" onclick="window.open('<?php echo base_url("report/load_staff_pdf") ?>');">Bulk Report</button>
                                                </div>
                                            </div>
                                        </div>-->
                </div>

                <table class="table table-bordered" id="semester_sub_exam_detail_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
<!--                            <th>Study Season</th>-->
                            <th>Time Table</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Schedule</th>

<!--                            <th>Actions</th>-->
                        </tr>
                    </thead>
                    <tbody id="semester_sub_exam_detail_tbl_body">

                    </tbody>
                </table>





            </div>
        </div>
    </div>

    <!--Fourth Tab--> 
    <div role="tabpanel" class="tab-pane" id="student_sem_sub_tab">
        <div class="panel">
            <div class="panel-heading">
                Student Semester Subjects Report
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-9">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    //$extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);"';
                                    //echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                    ?>
                                    <select class="form-control" id="l_center" name="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="sem_load_course_list(this.value, 1, null);">
                                        <option value="">---Select center---</option>
                                        <?php
                                        foreach ($centers as $row):
                                            ?>
                                            <option value="<?php echo $row['br_id']; ?>">
                                                <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>  
                                </div>
                            </div>  			
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_year(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters(this.value, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11" style="padding-right: 50px;">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_students_semester_subject()" style="float: right;">Search Students</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-success btn-md" id="print_students_semester_subject_btn" name="print_students_semester_subject_btn" onclick="print_students_semester_subject();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>


                <table class="table table-bordered" id="student_semester_subjects_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>

                            <th style="width:100px;">Registration No</th>
                            <th style="width:100px;">Student Name</th>
                            <th style="width:20px;">Year</th>
                            <th style="width:20px;">Semester</th>
                            <th>Subject Code</th>


<!--                            <th>Actions</th>-->
                        </tr>
                    </thead>
                    <tbody id="student_semester_subjects_tbl_body">
                    </tbody>
                </table>





            </div>
        </div>
    </div>


    <!--Sixth Tab--> 
    <div role="tabpanel" class="tab-pane" id="dip_eligible_students_tab">
        <div class="panel">
            <div class="panel-heading">
                Eligible Students List for Graduation Report
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-9">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    //$extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);"';
                                    //echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                    ?>
                                    <select class="form-control" id="eligible_dip_center" name="eligible_dip_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="eligible_list_load_course_list(this.value, 1, null);">
                                        <option value="">---Select center---</option>
                                        <?php
                                        foreach ($centers as $row):
                                            ?>
                                            <option value="<?php echo $row['br_id']; ?>">
                                                <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>  
                                </div>
                            </div>  			
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="eligible_dip_course" name="eligible_dip_course" onchange="eligible_dip_get_course_year(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="eligible_dip_batch" name="eligible_dip_batch" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>

                </div>
                <div class="row">                   
                    <div class="col-md-11" style="padding-right: 50px;">
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();search_diploma_eligible_students();" style="float: right;">Search</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" id="print_search_diploma_eligible_students_btn" name="print_search_diploma_eligible_students_btn" class="btn btn-success" onclick="print_search_diploma_eligible_students();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>
                <table class="table table-bordered" id="dip_eligible_students_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Registration No</th>
                            <th>Student Full Name</th>
                            <th>NIC</th>
                        </tr>
                    </thead>
                    <tbody id="dip_eligible_students_tbl_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Sixth Tab--> 
    <div role="tabpanel" class="tab-pane" id="stu_request_tab">
        <div class="panel">
            <div class="panel-heading">
                Eligible Students List for Graduation Report
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-9">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    //$extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);"';
                                    //echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                    ?>
                                    <select class="form-control" id="stu_request_center" name="stu_request_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="stu_request_course_course_list(this.value, 1, null);">
                                        <option value="">---Select center---</option>
                                        <?php
                                        foreach ($centers as $row):
                                            ?>
                                            <option value="<?php echo $row['br_id']; ?>">
                                                <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>  
                                </div>
                            </div>  			
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="stu_request_course" name="stu_request_course" onchange="graduation_dip_get_course_year(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="stu_request_batch" name="stu_request_batch" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>

                </div>
                              
                
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-11">
                        <input type="radio" name="request_type" class="col-md-1" id="current_exam" value="1" onclick="reset_fields_deferements(this.value);" checked=""><label class="col-md-2 control-label" style="text-align: left;">Postpone</label>

                        <input type="radio" name="request_type" class="col-md-1" id="repeat_exam" value="2" onclick="reset_fields_deferements(this.value);"><label class="col-md-2 control-label" style="text-align: left;">Graduation Approval</label>
                        
                        <input type="radio" name="request_type" class="col-md-1" id="repeat_exam" value="3" onclick="reset_fields_deferements(this.value);"><label class="col-md-2 control-label" style="text-align: left;">Graduation Rejected</label>
                    </div>
                </div>
                <br>
                <div class="row">                   
                    <div class="col-md-8" style="padding-right: 50px;">
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();stu_request_course_students_load();" style="float: right;">Search</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" id="print_stu_request_course_students_load_btn" name="print_stu_request_course_students_load_btn" class="btn btn-success" onclick="print_stu_request_course_students_load();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="excel_stu_request_course_students_load_btn" name="excel_stu_request_course_students_load_btn" class="btn btn-success" onclick="excel_stu_request_course_students_load();" style="float: right;"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Export Excel</button>
                    </div>
                </div>
               
                <br>
                <table class="table table-bordered" id="stu_request_table">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Registration No</th>
                            <th>Student Name</th>
                            <th>NIC</th>
                            <th>Telephone No</th>
                            <th>Address</th>
                            <th>Course</th>
                            <th>Center</th>
                            <th>CGPA</th>
                            
                        </tr>
                    </thead>
                    <tbody id="stu_request_table_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!--Paper Setter Tab--> 
    <div role="tabpanel" class="tab-pane" id="paper_setter_tab">
        <div class="panel">
            <div class="panel-heading">
                Paper Setter & Moderator
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="setter_exam_course" name="setter_exam_course" onchange="setter_east_load_years(this.value, 1, null, null, 1);">
                                        <option value="">---Select Course---</option>
                                        <?php
                                        for ($sub = 0; $sub < sizeof($courses); $sub++) {
                                            echo '<option value="' . $courses[$sub]['id'] . '">' . $courses[$sub]['course_code'] . ' - ' . $courses[$sub]['course_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="east_course" class="col-md-3 control-label">Batch</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="setter_batch" name="setter_batch" style="width:100%">
                                        <option value="">---Select Batch---</option>          
                                    </select>                                           
                                </div>                       
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Year</label>
                                <div class="col-md-7">
                                    <select id="setter_year" class="form-control" style="width:100%" name="setter_year" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="setter_load_semester(this.value)">
                                        <option value="">---Select Year---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Semester</label>
                                <div class="col-md-7">
                                    <select id="setter_semester" class="form-control" style="width:100%" name="setter_semester" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="setter_load_semester_exam();">
                                            <option value="">---Select Semester---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                    <div class="col-md-3">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Exam</label>
                                <div class="col-md-9">
                                    <select id="setter_exam" class="form-control" style="width:100%" name="setter_exam"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" onchange="setter_load_exam_subjects();">
                                        <option value="">---Select Exam---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-4" style="">
                                <div class="form-group">
                                    <label for="sign_subject" class="col-md-3 control-label">Exam Subject</label>
                                    <div class="col-md-7">
                                        <select class="form-control" id="setter_exam_subject" name="setter_exam_subject" style="width:100%" onchange="">
                                            <option value="">---Select Subject---</option>            
                                        </select>                                           
                                    </div>                       
                                </div>
                            </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" id="setter_data_btn" name="setter_data_btn" onclick="setter_data()">Search</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-md" id="setter_data_pdf_btn" name="setter_data_pdf_btn" onclick="setter_data_pdf();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>
                
                              
                
                
               
                <br>
                <table class="table table-bordered" id="setter_table">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Exam</th>
                            <th>Subject</th>
                            <th>Paper Setter</th>
                            <th>Paper Moderator</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody id="stu_request_table_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
            <!--Transferred Students Tab--> 
    <div role="tabpanel" class="tab-pane" id="transferred_students_tab">
        <div class="panel">
            <div class="panel-heading">
                Transferred Students
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course" class="col-md-3 control-label">Center</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="tr_center_id" name="tr_center_id" >
                                        <option value="">---Select Center---</option>
                                        <?php
                                        foreach ($centers as $row):
                                            ?>
                                            <option value="<?php echo $row['br_id']; ?>">
                                                <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
               </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" id="transfer_data_btn" name="transfer_data_btn" onclick="load_transfer_students();">Search</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-md" id="load_transfer_full_data_btn" name="load_transfer_full_data_btn" onclick="load_transfer_full_data();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>
                
                              
                
                
               
                <br>
                <table class="table table-bordered" id="transfer_student_table">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Old Register Number</th>
                            <th>New Register Number</th>
                            <th>Old Center</th>
                            <th>New Center</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody id="transferred_students_table_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>



<!--</div>-->
</div>

</div>  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script type="text/javascript"
src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><!--jquery-->
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><!--jquery-->
<script type="text/javascript"
src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script><!--jquery-->
<script type="text/javascript"
src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><!--jquery-->
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><!--jquery-->
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><!--jquery-->
<script type="text/javascript">

                                        $(document).ready(function () {
                                            $('#staff_detail_tbl').DataTable();
                                            $('#staff_detail_tbl_all').DataTable();
                                            $('#subject_detail_tbl').DataTable();
                                            $('#subject_detail_tbl_all').DataTable();

                                            $('#semester_sub_detail_tbl').DataTable();
                                            $('#semester_sub_exam_detail_tbl').DataTable();
                                            $('#student_semester_subjects_tbl').DataTable();
                                            $('#student_attended_for_exams_tbl').DataTable();
                                            $('#dip_eligible_students_tbl').DataTable();
                                            $('#stu_request_table').DataTable();
                                            $('#setter_table').DataTable();
                                            $('#transfer_student_table').DataTable();

                                            $('#load_staff_full_data_btn').attr('disabled', 'disabled');
                                            $('#load_subject_full_data_btn').attr('disabled', 'disabled');
                                            $('#load_transfer_full_data_btn').attr('disabled', 'disabled');
                                            $('#print_semester_sub_data_btn').attr('disabled', 'disabled');
                                            $('#print_semester_sub_exam_data_btn').attr('disabled', 'disabled');

                                            $('#print_students_semester_subject_btn').attr('disabled', 'disabled');
                                            $('#print_search_exam_attendended_students_data_btn').attr('disabled', 'disabled');
                                            $('#print_exam_attendees_btn').attr('disabled', 'disabled');
                                            $('#print_search_diploma_eligible_students_btn').attr('disabled', 'disabled');
                                            
                                            $('#print_stu_request_course_students_load_btn').attr('disabled', 'disabled');
                                            $('#excel_stu_request_course_students_load_btn').attr('disabled', 'disabled');
                                            
                                            $('#setter_data_pdf_btn').attr('disabled', 'disabled');
                                            
                                            sub_radio_change();
                                            
                                            var lec_id = $('#lecturer_id').val();
                                            changeValue(lec_id);
                                            
                                            var sub_id = $('#subject_id').val();
                                            changeSubValue(sub_id);

                                            

                                        });


/////////// First Staff Subject Report Functions/////////////////
                                         function load_staff_data() {
                                            $('.se-pre-con').fadeIn('slow');
                                            var center_id = $('#center_id').val();
                                            var subject_id = $('#subject_id').val();
                                           
                                            if (center_id == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else {



                                                $.post("<?php echo base_url('Report/search_pdf_staff_lookup') ?>", {'center_id': center_id, 'subject_id': subject_id},
                                                        function (data)
                                                        {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#staff_detail_tbl').DataTable().destroy();
                                                                $('#staff_detail_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]




                                                                });
                                                                $('#staff_detail_tbl').DataTable().clear().draw();

                                                                if (data.length > 0) {
                                                                    $('#load_staff_full_data_btn').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_destaff_detail_tblfined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";
                                                                     if(subject_id=='all'){
                                                                        $('#staff_detail_tbl_all').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['br_name'],
                                                                            data[j]['subject'],
                                                                            data[j]['staffindex'],
                                                                            data[j]['stf_fname'] + ' ' + data[j]['stf_lname']
                                                                                    //                                  ,action_content

                                                                        ]).draw(false);
                                                                    }
                                                                    else{
                                                                        $('#staff_detail_tbl').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['br_name'],
                                                                            data[j]['staffindex'],
                                                                            data[j]['stf_fname'] + ' ' + data[j]['stf_lname']
                                                                                    //                                  ,action_content

                                                                        ]).draw(false);
                                        
                                                                        
                                                                    }
                                                                    }
                                                                } else {
                                                                    $('#load_staff_full_data_btn').attr('disabled', 'disabled');
                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                            $('.se-pre-con').fadeOut('slow');
                                                        },
                                                        "json"
                                                        );
                                            }
                                        }


                                        function load_staff_full_data() {

                                            var center_id = $('#center_id').val();
                                            var subject_id = $('#subject_id').val();




                                            window.open('<?php echo base_url("report/load_staff_pdf") ?>?cen=' + center_id + '&sub=' + subject_id);

                                        }
///////////First End Staff Subject Report Functions/////////////



///////////Second Semester Subject Report Functions//////////////
                                        function load_year_list_for_semsubject() {
                                            if (($('#defined_exam_course').val()) != "0") {
                                                var cou_id = $('#defined_exam_course').val();

                                                $.post("<?php echo base_url('Report/load_year_list_for_semsubject') ?>", {'selected_course_id': cou_id},
                                                        function (data)
                                                        {
                                                            var year = data['no_of_year'];
                                                            var id = data['id'];

                                                            //console.log(year+"-"+id);

                                                            $('#defined_year').find('option').remove().end();
                                                            $('#defined_year').prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Year---"));

                                                            for (var i = 1; i <= year; i++)
                                                            {
                                                                $('#defined_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                                                            }

                                                            load_semesters_list_for_semsubject($('#defined_year').val());
                                                        },
                                                        "json"
                                                        );
                                            }
                                        }

                                        function load_semesters_list_for_semsubject(year_no) {
                                            var sel_year = "";
                                            var sel_year_id = "";

                                            if (year_no != "all") {
                                                sel_year = year_no.split('-')[0].trim();
                                                sel_year_id = year_no.split('-')[1].trim();
                                            }

                                            $.post("<?php echo base_url('Report/load_semesters_list_for_semsubject') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
                                                    function (data)
                                                    {
                                                        $('#defined_semester').find('option').remove().end();
                                                        $("#defined_semester").prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Semester---"));
                                                        //$('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                                                        for (var i = 1; i <= data; i++)
                                                        {
                                                            $('#defined_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function search_load_semester_sub_data() {

                                            $('.se-pre-con').fadeIn('slow');
                                            var course_id = $('#defined_exam_course').val();
                                            var year_no = $('#defined_year').val();
                                            var semester_no = $('#defined_semester').val();

                                            if (course_id == "") {
                                                funcres = {status: "denied", message: "Course cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else {

                                                $.post("<?php echo base_url('Report/search_load_semester_sub_data') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
                                                        function (data) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#semester_sub_detail_tbl').DataTable().destroy();
                                                                $('#semester_sub_detail_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                                });

                                                                $('#semester_sub_detail_tbl').DataTable().clear().draw();

                                                                if (data.length > 0) {
                                                                    $('#print_semester_sub_data_btn').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                        $('#semester_sub_detail_tbl').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['course_code'],
                                                                            data[j]['batch_code'],
                                                                            data[j]['year_no'],
                                                                            data[j]['semester_no'],
                                                                            data[j]['group_name'],
                                                                            data[j]['subject'],
                                                                            data[j]['code']
                                                                                    //                                  ,action_content


                                                                                    //action_content
                                                                        ]).draw(false);
                                                                    }
                                                                } else {
                                                                    $('#print_semester_sub_data_btn').attr('disabled', 'disabled');
                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                        },
                                                        "json"
                                                        );
                                                $('.se-pre-con').fadeOut('slow');
                                            }
                                        }

                                        function print_semester_sub_data() {
                                            var course_id = $('#defined_exam_course').val();
                                            var year_no = $('#defined_year').val();
                                            var semester_no = $('#defined_semester').val();

                                            window.open('<?php echo base_url("report/load_sem_subject_pdf") ?>?cou=' + course_id + '&yea=' + year_no + '&sem=' + semester_no);
                                        }
///////////Second End of Semester Subject Report Functions/////////////




///////////Third Semester Exam Subject Report Functions//////////////

                                        function load_year_list_for_semsubject_exam() {
                                            if (($('#defined_sem_exam_course').val()) != "0") {
                                                var cou_id = $('#defined_sem_exam_course').val();

                                                $.post("<?php echo base_url('Report/load_year_list_for_semsubject') ?>", {'selected_course_id': cou_id},
                                                        function (data)
                                                        {
                                                            var year = data['no_of_year'];
                                                            var id = data['id'];

                                                            //console.log(year+"-"+id);

                                                            $('#defined_sem_year').find('option').remove().end();
                                                            $('#defined_sem_year').prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Year---"));

                                                            for (var i = 1; i <= year; i++)
                                                            {
                                                                $('#defined_sem_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                                                            }

                                                            load_semesters_list_for_semsubject_exam($('#defined_sem_year').val());
                                                        },
                                                        "json"
                                                        );
                                            }
                                        }

                                        function load_semesters_list_for_semsubject_exam(year_no) {
                                            var sel_year = "";
                                            var sel_year_id = "";

                                            if (year_no != "all") {
                                                sel_year = year_no.split('-')[0].trim();
                                                sel_year_id = year_no.split('-')[1].trim();
                                            }

                                            $.post("<?php echo base_url('Report/load_semesters_list_for_semsubject') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
                                                    function (data)
                                                    {
                                                        $('#defined_sem_semester').find('option').remove().end();
                                                        $("#defined_sem_semester").prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Semester---"));
                                                        //$('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                                                        for (var i = 1; i <= data; i++)
                                                        {
                                                            $('#defined_sem_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function search_load_semester_sub_exam_data() {

                                            $('.se-pre-con').fadeIn('slow');
                                            var course_id = $('#defined_sem_exam_course').val();
                                            var year_no = $('#defined_sem_year').val();
                                            var semester_no = $('#defined_sem_semester').val();

                                            if (course_id == "") {
                                                funcres = {status: "denied", message: "Course cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else {

                                                $.post("<?php echo base_url('Report/search_load_semester_sub_exam_data') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
                                                        function (data) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#semester_sub_exam_detail_tbl').DataTable().destroy();
                                                                $('#semester_sub_exam_detail_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                                });

                                                                $('#semester_sub_exam_detail_tbl').DataTable().clear().draw();

                                                                if (data.length > 0) {
                                                                    $('#print_semester_sub_exam_data_btn').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {
                                                                        var code = '';
                                                                        var date = '';
                                                                        var schedule = '';
                                                                        
                                                                        for (e = 0; e < data[j]['subjects'].length; e++) {
                                                                            code += data[j]['subjects'][e]['code'] + ' <br> ';
                                                                        }
                                                                        
                                                                        for (e = 0; e < data[j]['subjects'].length; e++) {
                                                                            date += data[j]['subjects'][e]['esch_date'] + ' <br> ';
                                                                        }
                                                                        
                                                                        for (e = 0; e < data[j]['subjects'].length; e++) {
                                                                            schedule += data[j]['subjects'][e]['esch_stime'].substr(0, 5) + ' - ' +  data[j]['subjects'][e]['esch_etime'].substr(0, 5) +'<br> ';
                                                                        }

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
            <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
            <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                        $('#semester_sub_exam_detail_tbl').DataTable().row.add([
                                                                            number_content,
//                                                                            data[j]['ac_startdate'] + ' - ' + data[j]['ac_enddate'],
                                                                            '[ ' + data[j]['ttbl_code'] + ' ]' + data[j]['ttbl_description'],
                                                                            data[j]['course_code'],
                                                                            data[j]['batch_code'],
                                                                            data[j]['ttbl_year'],
                                                                            data[j]['ttbl_semester'],
                                                                            code,
                                                                            date,
                                                                            schedule

                                                                                    //                                    '[ ' + data[j]['exam_code'] + ' ]' + data[j]['exam_name']
                                                                                    //                                  ,action_content


                                                                                    //action_content
                                                                        ]).draw(false);
                                                                    }
                                                                } else {
                                                                    $('#print_semester_sub_exam_data_btn').attr('disabled', 'disabled');
                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                        },
                                                        "json"
                                                        );
                                                $('.se-pre-con').fadeOut('slow');
                                            }
                                        }

                                        function print_semester_sub_exam_data() {
                                            var course_id = $('#defined_sem_exam_course').val();
                                            var year_no = $('#defined_sem_year').val();
                                            var semester_no = $('#defined_sem_semester').val();

                                            window.open('<?php echo base_url("report/load_sem_subject_exam_pdf") ?>?cou=' + course_id + '&yea=' + year_no + '&sem=' + semester_no);
                                        }
///////////Third End of Semester Exam Subject Report Functions//////////////





///////////Fourth Student Semester Subject Tab Functions//////////////

                                        function sem_load_course_list(center_id, status, edit_course) {
                                            if (status == 1) {
                                                $('#l_Dcode').find('option').remove().end();
                                                $('#l_Dcode').append('<option value="">---Select Course---</option>').val('');

                                                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                                                        function (data)
                                                        {
                                                            for (var i = 0; i < data.length; i++)
                                                            {
                                                                $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                            }

                                                        },
                                                        "json"
                                                        );
                                            } else {
                                                $('#load_Dcode').find('option').remove().end();
                                                $('#load_Dcode').append('<option value="">---Select Course---</option>').val('');

                                                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                                                        function (data)
                                                        {
                                                            for (var i = 0; i < data.length; i++)
                                                            {
                                                                if (data[i]['course_id'] == edit_course) {
                                                                    $('#load_Dcode').append($("<option></option>").attr('selected', true).attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                                } else {
                                                                    $('#load_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                                }
                                                            }

                                                        },
                                                        "json"
                                                        );
                                            }
                                        }

                                        function get_batch(year_no, batch_id, lookup_flag) {
                                            if (lookup_flag) {
                                                var id = $('#l_Dcode').val();
                                            } else {
                                                var id = $('#load_Dcode').val();
                                            }

                                            //$('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $('#l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                                                    function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                                                    function (data)
                                                                    {
                                                                        for (j = 0; j < data.length; j++) {
                                                                            if (data[j]['id'] == batch_id) {
                                                                                if (lookup_flag) {
                                                                                    $('#l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                            } else {
                                                                                if (lookup_flag) {
                                                                                    $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                            }
                                                                        }

                                                                    },
                                                                    "json"
                                                                    );
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function get_course_year(id, flag, year_no, batch_id, lookup_flag) {
                                            $('#load_Dname').val(id);
                                            $('#l_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
                                            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                                            $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $('#l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                                                    function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            if (data != null) {
                                                                console.log(data);
                                                                if (typeof data['current_year'] === 'undefined') {
                                                                    //alert('true');
                                                                    for (var i = 1; i <= data['no_of_year']; i++) {
                                                                        if (flag) {
                                                                            if (i == year_no) {
                                                                                if (lookup_flag) {
                                                                                    $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                                                }
                                                                                $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                                            } else {
                                                                                if (lookup_flag) {
                                                                                    $('#l_no_year').append($("<option></option>").attr("value", i).text(i));
                                                                                }
                                                                                $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                                                            }
                                                                        } else {
                                                                            if (lookup_flag) {
                                                                                $('#l_no_year').append($("<option></option>").text(i));
                                                                            }
                                                                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                                                        }
                                                                    }
                                                                } else {


                                                                    //alert('false');
                                                                    var current_year = data['current_year'];

                                                                    if (flag) {

                                                                        if (lookup_flag) {
                                                                            $('#l_no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                                                                        }
                                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));

                                                                    } else {
                                                                        if (lookup_flag) {
                                                                            $('#l_no_year').append($("<option></option>").text(current_year));
                                                                        }
                                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                                                                    }





                                                                }


                                                                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                                                        function (data)
                                                                        {

                                                                            if (typeof data['current_year'] === 'undefined') {
                                                                                for (j = 0; j < data.length; j++) {
                                                                                    if (data[j]['id'] == batch_id) {
                                                                                        if (lookup_flag) {
                                                                                            $('#l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                        }
                                                                                        $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                    } else {
                                                                                        if (lookup_flag) {
                                                                                            $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                        }
                                                                                        $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                    }
                                                                                }
                                                                            } else {


                                                                                if (lookup_flag) {
                                                                                    $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                                                                            }






                                                                        },
                                                                        "json"
                                                                        );
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );




                                        }

                                        function load_semesters(year_no, semester_no, lookup_flag) {
                                            $('#l_no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                                            $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                                            if (lookup_flag) {
                                                var course_id = $('#l_Dcode').val();
                                            } else {
                                                var course_id = $('#load_Dcode').val();
                                            }
                                            if (course_id == '' || course_id == null) {
                                                var course_id = $('#course').val();
                                            }
                                            $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
                                                    function (data)
                                                    {
                                                        if (data != null) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else
                                                            {
                                                                if (typeof data['current_semester'] === 'undefined' || data['current_semester'] === null) {
                                                                    for (var i = 1; i <= data; i++) {
                                                                        if (semester_no == i) {
                                                                            if (lookup_flag) {
                                                                                $('#l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                                                                            }
                                                                            $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                                                                        } else {
                                                                            if (lookup_flag) {
                                                                                $('#l_no_semester').append($("<option></option>").attr("value", i).text(i));
                                                                            }
                                                                            $('#no_semester').append($("<option></option>").attr("value", i).text(i));
                                                                        }
                                                                    }
                                                                } else {

                                                                    var current_semester = data['current_semester'];

                                                                    if (lookup_flag) {
                                                                        $('#l_no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester));
                                                                    }
                                                                    $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester));


                                                                }



                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function search_students_semester_subject() {
                                            $('.se-pre-con').fadeIn('slow');
                                            var center_id = $('#l_center').val();
                                            var course_id = $('#l_Dcode').val();
                                            var batch_id = $('#l_Bcode').val();
                                            var year_no = $('#l_no_year').val();
                                            var semester_no = $('#l_no_semester').val();

                                            //        else if (batch_id == "") {
                                            //            funcres = {status: "denied", message: "Batch cannot be empty!"};
                                            //            result_notification(funcres);
                                            //        }


                                            if (center_id == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('fast');
                                            } else if (course_id == "") {
                                                funcres = {status: "denied", message: "Course cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('fast');
                                            } else if (batch_id == "") {
                                                funcres = {status: "denied", message: "Batch cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('fast');
                                            } else if (year_no == "") {
                                                funcres = {status: "denied", message: "Year cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('fast');
                                            } else if (semester_no == "") {
                                                funcres = {status: "denied", message: "Semester cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('fast');
                                            } else {
                                                $.post("<?php echo base_url('Report/search_students_semester_subject') ?>", {'center_id': center_id, 'course_id': course_id, 'batch_id': batch_id, 'year_no': year_no, 'semester_no': semester_no},
                                                        function (data) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#student_semester_subjects_tbl').DataTable().destroy();
                                                                $('#student_semester_subjects_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                                });

                                                                $('#student_semester_subjects_tbl').DataTable().clear().draw();



                                                                if (data.length > 0) {
                                                                    $('#print_students_semester_subject_btn').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {
                                                                        var code = '';
                                                                        for (e = 0; e < data[j]['subjects'].length; e++) {

                                                                            code += data[j]['subjects'][e]['code'] + " - " + data[j]['subjects'][e]['subject'] + ' <br> ';

                                                                        }

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
                    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
                    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                        $('#student_semester_subjects_tbl').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['reg_no'],
                                                                            data[j]['first_name'],
                                                                            data[j]['year_no'],
                                                                            data[j]['semester_no'],
                                                                            code


                                                                                    //                                    '[ ' + data[j]['exam_code'] + ' ]' + data[j]['exam_name']
                                                                                    //                                  ,action_content


                                                                                    //action_content
                                                                        ]).draw(false);
                                                                    }
                                                                } else {
                                                                    $('#print_students_semester_subject_btn').attr('disabled', 'disabled');
                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                            $('.se-pre-con').fadeOut('slow');
                                                        },
                                                        "json"
                                                        );
                                            }
                                        }

                                        function print_students_semester_subject() {
                                            var center_id = $('#l_center').val();
                                            var course_id = $('#l_Dcode').val();
                                            var batch_id = $('#l_Bcode').val();
                                            var year_no = $('#l_no_year').val();
                                            var semester_no = $('#l_no_semester').val();


                                            window.open('<?php echo base_url("report/print_students_semester_subject") ?>?cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id + '&yea=' + year_no + '&sem=' + semester_no);
                                        }


///////////Fourth End of Student Semester Subject Tab Functions//////////////



///////////Fifth Student Exam Report//////////////////////////////

                                        function load_exams(eh_year, eh_semester, eh_course, eh_season, selexm) {
                                            if (eh_course == null)
                                                eh_course = $('#eh_course').val();

                                            if (eh_year == null)
                                                eh_year = $('#eh_year').val();

                                            if (eh_semester == null)
                                                eh_semester = $('#eh_semester').val();

                                            if (eh_season == null)
                                                eh_season = $('#eh_season').val();

                                            $.post("<?php echo base_url('exam/load_exams') ?>", {'tt_semester': eh_semester, 'tt_course': eh_course, 'tt_year': eh_year, 'tt_season': eh_season},
                                                    function (data)
                                                    {
                                                        $('#eh_exam').empty();
                                                        $('#eh_exam').append("<option value=''></option>");
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            if (data.length > 0)
                                                            {
                                                                for (i = 0; i < data.length; i++) {
                                                                    selectedtxt = '';
                                                                    if (selexm == data[i]['id'])
                                                                    {
                                                                        selectedtxt = 'selected';
                                                                    }
                                                                    $('#eh_exam').append("<option value='" + data[i]['id'] + "' " + selectedtxt + ">" + data[i]['exam_code'] + " - " + data[i]['exam_name'] + "</option>");
                                                                }
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function load_course_list(center_id) {
                                            $('#eh_course').find('option').remove().end();
                                            $('#eh_course').append('<option value="">---Select Course Code---</option>').val('');

                                            $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
                                                    function (data)
                                                    {
                                                        for (var i = 0; i < data.length; i++)
                                                        {

                                                            // if(selectedid == data[i]['id'])
                                                            // {
                                                            //     $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']+' - '+data[i]['course_name']));
                                                            // }
                                                            //  else
                                                            //  {
                                                            $('#eh_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));

                                                            //  }
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function load_years(eh_course, selyear) {
                                            $.post("<?php echo base_url('time_table/load_years') ?>", {'tt_course': eh_course},
                                                    function (data)
                                                    {
                                                        $('#eh_year').empty();
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            $('#eh_year').append("<option value=''></option>");
                                                            if (data > 0)
                                                            {
                                                                for (i = 0; i < data; i++) {
                                                                    selectedtxt = '';
                                                                    if (selyear == (i + 1))
                                                                    {
                                                                        selectedtxt = 'selected';
                                                                    }

                                                                    $('#eh_year').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + "</option>");
                                                                }
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function load_semester(eh_year, selsemester, eh_course) {
                                            if (eh_course == null)
                                            {
                                                eh_course = $('#eh_course').val();
                                            }

                                            $.post("<?php echo base_url('time_table/load_semester') ?>", {'tt_year': eh_year, "tt_course": eh_course},
                                                    function (data)
                                                    {
                                                        $('#eh_semester').empty();
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            $('#eh_semester').append("<option value=''></option>");
                                                            if (data > 0)
                                                            {
                                                                for (i = 0; i < data; i++) {

                                                                    selectedtxt = '';
                                                                    if (selsemester == (i + 1))
                                                                    {
                                                                        selectedtxt = 'selected';
                                                                    }

                                                                    $('#eh_semester').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + "</option>");
                                                                }
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }


//        function load_exams(eh_year, eh_semester, eh_course, eh_season, selexm) {
//            if (eh_course == null)
//                eh_course = $('#eh_course').val();
//
//            if (eh_year == null)
//                eh_year = $('#eh_year').val();
//
//            if (eh_semester == null)
//                eh_semester = $('#eh_semester').val();
//
//            if (eh_season == null)
//                eh_season = $('#eh_season').val();
//
//            $.post("<?php echo base_url('exam/load_exams') ?>", {'tt_semester': eh_semester, 'tt_course': eh_course, 'tt_year': eh_year, 'tt_season': eh_season},
//                    function (data)
//                    {
//                        $('#eh_exam').empty();
//                        $('#eh_exam').append("<option value=''></option>");
//                        if (data == 'denied')
//                        {
//                            funcres = {status: "denied", message: "You have no right to proceed the action"};
//                            result_notification(funcres);
//                        } else
//                        {
//                            if (data.length > 0)
//                            {
//                                for (i = 0; i < data.length; i++) {
//                                    selectedtxt = '';
//                                    if (selexm == data[i]['id'])
//                                    {
//                                        selectedtxt = 'selected';
//                                    }
//                                    $('#eh_exam').append("<option value='" + data[i]['id'] + "' " + selectedtxt + ">" + data[i]['exam_code'] + " - " + data[i]['exam_name'] + "</option>");
//                                }
//                            }
//                        }
//                    },
//                    "json"
//                    );
//        }


                                        function load_schedules() {
                                            var eh_course = $('#eh_course').val();
                                            var eh_year = $('#eh_year').val();
                                            var eh_semester = $('#eh_semester').val();
                                            var eh_exam = $('#eh_exam').val();
                                            var eh_season = $('#eh_season').val();
                                            var eh_branch = $('#eh_branch').val();
                                            var eh_faculty = $('#eh_faculty').val();

                                            $('#stulistbody').empty();
                                            $('#stulistbody').append("<tr><td colspan='3'>Search students who applied attendance</td></tr>");
                                            $('#schedulediv').empty();

                                            if (eh_season == "") {
                                                funcres = {status: "denied", message: "Study season cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (eh_branch == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (eh_course == "") {
                                                funcres = {status: "denied", message: "Course cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (eh_year == "") {
                                                funcres = {status: "denied", message: "Year cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (eh_semester == "") {
                                                funcres = {status: "denied", message: "Semester cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (eh_exam == "") {
                                                funcres = {status: "denied", message: "Exam cannot be empty!"};
                                                result_notification(funcres);
                                            } else
                                                $.post("<?php echo base_url('exam/load_schedules') ?>", {'eh_course': eh_course, 'eh_year': eh_year, 'eh_semester': eh_semester, 'eh_exam': eh_exam, 'eh_season': eh_season, 'eh_branch': eh_branch, 'reqby': 'attendance', 'eh_faculty': eh_faculty},
                                                        function (data)
                                                        {
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else
                                                            {
                                                                if (data.length > 0)
                                                                {
                                                                    listnewstr = '<div class="just-padding">';
                                                                    for (i = 0; i < data.length; i++)
                                                                    {
                                                                        schedary = data[i]['schedules'];
                                                                        listnewstr += '<h4>' + data[i]['ttbl_code'] + ' - ' + data[i]['ttbl_description'] + '</h4>';
                                                                        listnewstr += '<div class="list-group list-group-root well">';

                                                                        if (schedary.length > 0)
                                                                        {
                                                                            for (x = 0; x < schedary.length; x++)
                                                                            {
                                                                                displaytxt = '[ ' + schedary[x]['code'] + ' ] ' + schedary[x]['subject'] + ' - ' + schedary[x]['name'] + ' ( ' + schedary[x]['esch_date'] + ' / ' + schedary[x]['esch_stime'] + ' - ' + schedary[x]['esch_etime'] + ' )';

                                                                                listnewstr += '<a href="#item_' + schedary[x]['esch_id'] + '" class="list-group-item"  onclick="load_studentlist(' + schedary[x]['esch_subject'] + ')">';
                                                                                listnewstr += '<i class="glyphicon glyphicon-chevron-right"></i>' + displaytxt;
                                                                                listnewstr += '</a>';
                                                                                listnewstr += '<div class="list-group collapse" id="item_' + schedary[x]['esch_id'] + '">';

                                                                                if (schedary[x]['halls'].length > 0)
                                                                                {
                                                                                    for (y = 0; y < schedary[x]['halls'].length; y++)
                                                                                    {
                                                                                        listnewstr += '<a href="#" class="list-group-item" data-toggle="collapse" onclick="load_studentlist(' + schedary[x]['halls'][y]['ehall_id'] + ')">';
                                                                                        listnewstr += schedary[x]['halls'][y]['hall_name'];
                                                                                        listnewstr += '</a>';
                                                                                    }
                                                                                }

                                                                                listnewstr += '</div>';
                                                                            }
                                                                        } else
                                                                        {
                                                                            listnewstr += '<a href="#" class="list-group-item list-group-item-danger">No Schedule Found</a>';
                                                                        }

                                                                        listnewstr += '</div>';
                                                                    }

                                                                    listnewstr += '</div>';

                                                                    $('#schedulediv').append(listnewstr);
                                                                } else
                                                                {
                                                                    $('#schedulediv').append('<a href="#" class="list-group-item list-group-item-danger">No Schedule Found</a>');
                                                                }
                                                            }
                                                        },
                                                        "json"
                                                        );
                                        }

                                        function load_studentlist(subject_id) {
                                            $('#stulistbody').empty();
                                            // $('#ehall').val(id);
                                            $('#exam_subject_id').val(subject_id);
                                            var exam_id = $('#eh_exam').val();
                                            var center_id = $('#eh_branch').val();

                                            $.post("<?php echo base_url('report/load_student_subjectwise') ?>", {'id': subject_id, 'exam_id': exam_id, 'center_id': center_id},
                                                    function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            if (data.length > 0)
                                                            {
                                                                $('#print_exam_attendees_btn').removeAttr('disabled');

                                                                for (x = 0; x < data.length; x++)
                                                                {
                                                                    isattend = '';
                                                                    if (data[x]['is_attend'] == 1)
                                                                    {
                                                                        isattend = 'checked';
                                                                    }
                                                                    $('#stulistbody').append('<tr><td>' + data[x]['reg_no'] + '</td><td>' + data[x]['last_name'] + ' ' + data[x]['first_name'] + '</td></tr>');
                                                                }
                                                            } else
                                                            {
                                                                $('#print_exam_attendees_btn').attr('disabled', 'disabled');
                                                                $('#stulistbody').append('<tr><td colspan="3" align="center">No students for the schedule</td></tr>');
                                                            }

                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function print_exam_attendees() {
                                            var center_id = $('#eh_branch').val();
                                            var subject_id = $('#exam_subject_id').val();
                                            var exam_id = $('#eh_exam').val();

                                            window.open('<?php echo base_url("report/print_exam_attendees") ?>?cen=' + center_id + '&sub=' + subject_id + '&ex=' + exam_id);

                                        }

                                        function search_exam_attendended_students_data() {

                                            var study_season_id = $('#eh_season').val();
                                            var center_id = $('#eh_branch').val();
                                            var course_id = $('#eh_course').val();
                                            var year_no = $('#eh_year').val();
                                            var semester_no = $('#eh_semester').val();
                                            var exam_id = $('#eh_exam').val();

                                            if (study_season_id == "") {
                                                funcres = {status: "denied", message: "Study season cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (center_id == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (course_id == "") {
                                                funcres = {status: "denied", message: "Course cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (year_no == "") {
                                                funcres = {status: "denied", message: "Year cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (semester_no == "") {
                                                funcres = {status: "denied", message: "Semester cannot be empty!"};
                                                result_notification(funcres);
                                            } else if (exam_id == "") {
                                                funcres = {status: "denied", message: "Exam cannot be empty!"};
                                                result_notification(funcres);
                                            } else {

                                                $.post("<?php echo base_url('Report/search_exam_attendended_students_data') ?>", {'study_season_id': study_season_id,
                                                    'center_id': center_id,
                                                    'course_id': course_id,
                                                    'year_no': year_no,
                                                    'semester_no': semester_no,
                                                    'exam_id': exam_id},
                                                        function (data) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#student_attended_for_exams_tbl').DataTable().destroy();
                                                                $('#student_attended_for_exams_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                                });

                                                                $('#student_attended_for_exams_tbl').DataTable().clear().draw();

                                                                if (data.length > 0) {




                                                                    $('#print_search_exam_attendended_students_data_btn').removeAttr('disabled');
                                                                    $('#student_attended_for_exams_tbl').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {

                                                                        var code = '';
                                                                        var attempts = '';
                                                                        //var subject = '';
                                                                        for (e = 0; e < data[j]['subjectsatt'].length; e++) {
                                                                            code += data[j]['subjectsatt'][e]['code'] + " - " + data[j]['subjectsatt'][e]['subject'] + "<br> ";
                                                                            attempts += data[j]['subjectsatt'][e]['no_of_attempts'] + "<br>";
                                                                        }

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                        $('#student_attended_for_exams_tbl').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['first_name'],
                                                                            data[j]['reg_no'],
                                                                            attempts,
                                                                            code



                                                                                    //                                    '[ ' + data[j]['exam_code'] + ' ]' + data[j]['exam_name']
                                                                                    //                                  ,action_content


                                                                                    //action_content
                                                                        ]).draw(false);
                                                                    }
                                                                } else {
                                                                    $('#print_semester_sub_exam_data_btn').attr('disabled', 'disabled');
                                                                    $('#print_search_exam_attendended_students_data_btn').attr('disabled', 'disabled');

                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                        },
                                                        "json"
                                                        );

                                            }

                                        }

                                        function print_search_exam_attendended_students_data() {
                                            var study_season_id = $('#eh_season').val();
                                            var center_id = $('#eh_branch').val();
                                            var course_id = $('#eh_course').val();
                                            var year_no = $('#eh_year').val();
                                            var semester_no = $('#eh_semester').val();
                                            var exam_id = $('#eh_exam').val();


                                            window.open('<?php echo base_url("report/print_search_exam_attendended_students_data") ?>?ssid=' + study_season_id + '&cen=' + center_id + '&cou=' + course_id + '&yea=' + year_no + '&sem=' + semester_no + '&exm=' + exam_id);

                                        }

///////////Fifth End Student Exam Report//////////////////////////////




///////////Sixth Tab Exam Report//////////////////////////////

                                        function eligible_list_load_course_list(center_id, status, edit_course) {
                                            if (status == 1) {
                                                $('#eligible_dip_course').find('option').remove().end();
                                                $('#eligible_dip_course').append('<option value="">---Select Course---</option>').val('');

                                                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                                                        function (data)
                                                        {
                                                            for (var i = 0; i < data.length; i++)
                                                            {
                                                                $('#eligible_dip_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                            }
                                                        },
                                                        "json"
                                                        );
                                            } else {
                                                $('#eligible_dip_course').find('option').remove().end();
                                                $('#eligible_dip_course').append('<option value="">---Select Course---</option>').val('');

                                                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                                                        function (data)
                                                        {
                                                            for (var i = 0; i < data.length; i++)
                                                            {
                                                                if (data[i]['course_id'] == edit_course) {
                                                                    $('#eligible_dip_course').append($("<option></option>").attr('selected', true).attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                                } else {
                                                                    $('#eligible_dip_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                                }
                                                            }

                                                        },
                                                        "json"
                                                        );
                                            }
                                        }

                                        function eligible_dip_get_course_year(id, flag, year_no, batch_id, lookup_flag) {
                                            $('#load_Dname').val(id);
                                            $('#l_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
                                            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                                            $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $('#eligible_dip_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                                                    function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            if (data != null) {
                                                                console.log(data);
                                                                if (typeof data['current_year'] === 'undefined') {
                                                                    //alert('true');
                                                                    for (var i = 1; i <= data['no_of_year']; i++) {
                                                                        if (flag) {
                                                                            if (i == year_no) {
                                                                                if (lookup_flag) {
                                                                                    $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                                                }
                                                                                $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                                            } else {
                                                                                if (lookup_flag) {
                                                                                    $('#l_no_year').append($("<option></option>").attr("value", i).text(i));
                                                                                }
                                                                                $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                                                            }
                                                                        } else {
                                                                            if (lookup_flag) {
                                                                                $('#l_no_year').append($("<option></option>").text(i));
                                                                            }
                                                                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                                                        }
                                                                    }
                                                                } else {


                                                                    //alert('false');
                                                                    var current_year = data['current_year'];

                                                                    if (flag) {

                                                                        if (lookup_flag) {
                                                                            $('#l_no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                                                                        }
                                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));

                                                                    } else {
                                                                        if (lookup_flag) {
                                                                            $('#l_no_year').append($("<option></option>").text(current_year));
                                                                        }
                                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                                                                    }





                                                                }


                                                                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                                                        function (data)
                                                                        {

                                                                            if (typeof data['current_year'] === 'undefined') {
                                                                                for (j = 0; j < data.length; j++) {
                                                                                    if (data[j]['id'] == batch_id) {
                                                                                        if (lookup_flag) {
                                                                                            $('#eligible_dip_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                        }
                                                                                        $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                    } else {
                                                                                        if (lookup_flag) {
                                                                                            $('#eligible_dip_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                        }
                                                                                        $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                    }
                                                                                }
                                                                            } else {


                                                                                if (lookup_flag) {
                                                                                    $('#eligible_dip_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                                                                            }






                                                                        },
                                                                        "json"
                                                                        );
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );




                                        }

                                        function eligible_dip_get_batch(year_no, batch_id, lookup_flag) {
                                            if (lookup_flag) {
                                                var id = $('#l_Dcode').val();
                                            } else {
                                                var id = $('#load_Dcode').val();
                                            }

                                            //$('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $('#eligible_dip_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                                                    function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                                                    function (data)
                                                                    {
                                                                        for (j = 0; j < data.length; j++) {
                                                                            if (data[j]['id'] == batch_id) {
                                                                                if (lookup_flag) {
                                                                                    $('#eligible_dip_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                            } else {
                                                                                if (lookup_flag) {
                                                                                    $('#eligible_dip_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                            }
                                                                        }

                                                                    },
                                                                    "json"
                                                                    );
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }

                                        function search_diploma_eligible_students() {

                                            $('.se-pre-con').fadeIn('slow');
                                            var center_id = $('#eligible_dip_center').val();
                                            var course_id = $('#eligible_dip_course').val();
                                            var batch_id = $('#eligible_dip_batch').val();


                                            if (center_id == "") {
                                                funcres = {status: "denied", message: "Study season cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else if (course_id == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else if (batch_id == "") {
                                                funcres = {status: "denied", message: "Batch cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else {

                                                $.post("<?php echo base_url('Report/search_diploma_eligible_students') ?>", {'center_id': center_id,
                                                    'course_id': course_id,
                                                    'batch_id': batch_id
                                                },
                                                        function (data) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#dip_eligible_students_tbl').DataTable().destroy();
                                                                $('#dip_eligible_students_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                                });

                                                                $('#dip_eligible_students_tbl').DataTable().clear().draw();

                                                                if (data.length > 0) {




                                                                    $('#print_search_diploma_eligible_students_btn').removeAttr('disabled');
                                                                    $('#dip_eligible_students_tbl').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                        $('#dip_eligible_students_tbl').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['reg_no'],
                                                                            data[j]['first_name'] + ' ' + data[j]['last_name'],
                                                                            data[j]['nic_no']

                                                                        ]).draw(false);
                                                                    }
                                                                } else {
                                                                    $('#print_semester_sub_exam_data_btn').attr('disabled', 'disabled');
                                                                    $('#print_search_diploma_eligible_students_btn').attr('disabled', 'disabled');

                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                        },
                                                        "json"
                                                        );

                                            }
                                            $('.se-pre-con').fadeOut('slow');

                                        }

                                        function print_search_diploma_eligible_students() {
                                            var center_id = $('#eligible_dip_center').val();
                                            var course_id = $('#eligible_dip_course').val();
                                            var batch_id = $('#eligible_dip_batch').val();

                                            window.open('<?php echo base_url("report/print_search_diploma_eligible_students") ?>?&cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id);
                                        }

///////////End of Sixth Tab Exam Report//////////////////////////////



///////////Seventh Tab Exam Report- GRADUATION REPORT//////////////////////////////

                                        function stu_request_course_course_list(center_id, status, edit_course) {
                                            if (status == 1) {
                                                $('#stu_request_course').find('option').remove().end();
                                                $('#stu_request_course').append('<option value="">---Select Course---</option>').val('');

                                                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                                                        function (data)
                                                        {
                                                            for (var i = 0; i < data.length; i++)
                                                            {
                                                                $('#stu_request_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                            }
                                                        },
                                                        "json"
                                                        );
                                            } else {
                                                $('#stu_request_course').find('option').remove().end();
                                                $('#stu_request_course').append('<option value="">---Select Course---</option>').val('');

                                                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                                                        function (data)
                                                        {
                                                            for (var i = 0; i < data.length; i++)
                                                            {
                                                                if (data[i]['course_id'] == edit_course) {
                                                                    $('#stu_request_course').append($("<option></option>").attr('selected', true).attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                                } else {
                                                                    $('#stu_request_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                                                                }
                                                            }

                                                        },
                                                        "json"
                                                        );
                                            }
                                        }
                                        
                                        function graduation_dip_get_course_year(id, flag, year_no, batch_id, lookup_flag) {
                                            $('#load_Dname').val(id);
                                            $('#l_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
                                            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                                            $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $('#stu_request_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                                                    function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            if (data != null) {
                                                                console.log(data);
                                                                if (typeof data['current_year'] === 'undefined') {
                                                                    //alert('true');
                                                                    for (var i = 1; i <= data['no_of_year']; i++) {
                                                                        if (flag) {
                                                                            if (i == year_no) {
                                                                                if (lookup_flag) {
                                                                                    $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                                                }
                                                                                $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                                            } else {
                                                                                if (lookup_flag) {
                                                                                    $('#l_no_year').append($("<option></option>").attr("value", i).text(i));
                                                                                }
                                                                                $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                                                            }
                                                                        } else {
                                                                            if (lookup_flag) {
                                                                                $('#l_no_year').append($("<option></option>").text(i));
                                                                            }
                                                                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                                                        }
                                                                    }
                                                                } else {


                                                                    //alert('false');
                                                                    var current_year = data['current_year'];

                                                                    if (flag) {

                                                                        if (lookup_flag) {
                                                                            $('#l_no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                                                                        }
                                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));

                                                                    } else {
                                                                        if (lookup_flag) {
                                                                            $('#l_no_year').append($("<option></option>").text(current_year));
                                                                        }
                                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                                                                    }





                                                                }


                                                                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                                                        function (data)
                                                                        {

                                                                            if (typeof data['current_year'] === 'undefined') {
                                                                                for (j = 0; j < data.length; j++) {
                                                                                    if (data[j]['id'] == batch_id) {
                                                                                        if (lookup_flag) {
                                                                                            $('#stu_request_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                        }
                                                                                        $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                    } else {
                                                                                        if (lookup_flag) {
                                                                                            $('#stu_request_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                        }
                                                                                        $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                    }
                                                                                }
                                                                            } else {


                                                                                if (lookup_flag) {
                                                                                    $('#stu_request_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                                }
                                                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                                                                            }






                                                                        },
                                                                        "json"
                                                                        );
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );




                                        }
                                        
                                        function stu_request_course_students_load() {

                                            $('.se-pre-con').fadeIn('slow');
                                            var center_id = $('#stu_request_center').val();
                                            var course_id = $('#stu_request_course').val();
                                            var batch_id = $('#stu_request_batch').val();
                                            var selected_type = $('input[name=request_type]:checked').val();


                                            if (center_id == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
//                                                $('.se-pre-con').fadeOut('slow');
                                            } else if (course_id == "") {
                                                funcres = {status: "denied", message: "Course cannot be empty!"};
                                                result_notification(funcres);
//                                                $('.se-pre-con').fadeOut('slow');
                                            } else if (batch_id == "") {
                                                funcres = {status: "denied", message: "Batch cannot be empty!"};
                                                result_notification(funcres);
//                                                $('.se-pre-con').fadeOut('slow');
                                            } else {
                                                
                                                $('#stu_request_table').DataTable().destroy();
                                                $('#stu_request_table').DataTable({
                                                    'ordering': true,
                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                });

                                                $('#stu_request_table').DataTable().clear().draw();
                                                

                                                $.post("<?php echo base_url('Report/search_stu_request_course_students_load') ?>", {
                                                    'center_id': center_id,
                                                    'course_id': course_id,
                                                    'batch_id': batch_id,
                                                    'request_type':selected_type
                                                    
                                                },
                                                        function (data) {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                if (data.length > 0) {
//                                                                    data[0]['student_id'] != null
                                                                    $('#print_stu_request_course_students_load_btn').removeAttr('disabled');
                                                                    $('#excel_stu_request_course_students_load_btn').removeAttr('disabled');
                                                                    $('#stu_request_table').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                        $('#stu_request_table').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['reg_no'],
                                                                            data[j]['first_name'],
                                                                            data[j]['nic_no'],
                                                                            data[j]['mobile_no'],
                                                                            data[j]['permanent_address'],
                                                                            data[j]['course_code'],
                                                                            data[j]['br_name'],
                                                                            data[j]['max']
                                                                            

                                                                        ]).draw(false);
                                                                    }
                                                                } else {
                                                                    $('#print_stu_request_course_students_load_btn').attr('disabled', 'disabled');
                                                                    $('#excel_stu_request_course_students_load_btn').attr('disabled', 'disabled');
//                                                                    $('#print_search_diploma_eligible_students_btn').attr('disabled', 'disabled');

                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                        },
                                                        "json"
                                                        );

                                            }
                                            $('.se-pre-con').fadeOut('slow');

                                        }
                                        
                                        
                                        
                                        
                                        
                                        function print_stu_request_course_students_load() {
                                            var center_id = $('#stu_request_center').val();
                                            var course_id = $('#stu_request_course').val();
                                            var batch_id = $('#stu_request_batch').val();
                                            var selected_type = $('input[name=request_type]:checked').val();

                                            window.open('<?php echo base_url("report/print_stu_request_course_students_load") ?>?&cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id + '&sel=' + selected_type);
                                        }
                                        
                                        function excel_stu_request_course_students_load(){
                                            var center_id = $('#stu_request_center').val();
                                            var course_id = $('#stu_request_course').val();
                                            var batch_id = $('#stu_request_batch').val();
                                            var selected_type = $('input[name=request_type]:checked').val();

                                            window.open('<?php echo base_url("report/excel_stu_request_course_students_load_btn") ?>?&cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id + '&sel=' + selected_type);
                                        
                                        }
                                        
///////////End of Seventh Tab Exam Report//////////////////////////////

///////Paper Setter///////////


function setter_east_load_years(id, flag, year_no, batch_id, lookup_flag) {
                                $('#load_Dname').val(id);
                                $('#setter_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
                                $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                                $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                $('#setter_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                $.post("<?php echo base_url('Report/analysis_get_course') ?>", {'id': id},
                                        function (data)
                                        {
                                            if (data == 'denied')
                                            {
                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                result_notification(funcres);
                                            } else
                                            {
                                                if (data != null) {
                                                    //console.log(data);
                                                    if (typeof data['current_year'] === 'undefined') {
                                                        //alert('true');
                                                        for (var i = 1; i <= data['no_of_year']; i++) {
                                                            if (flag) {
                                                                if (i == year_no) {
                                                                    if (lookup_flag) {
                                                                        $('#setter_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                                                    }
                                                                    $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                                                } else {
                                                                    if (lookup_flag) {
                                                                        $('#setter_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                                                    }
                                                                    $('#no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                                                }
                                                            } else {
                                                                if (lookup_flag) {
                                                                    $('#setter_year').append($("<option></option>").text(i + " Year"));
                                                                }
                                                                $('#no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                                            }
                                                        }
                                                    } else {
                                                        //alert('false');
                                                        var current_year = data['current_year'];

                                                        if (current_year != 0) {
                                                            if (flag) {
                                                                if (lookup_flag) {
                                                                    $('#setter_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                                                }
                                                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                                            } else {
                                                                if (lookup_flag) {
                                                                    $('#setter_year').append($("<option></option>").text(current_year + " Year"));
                                                                }
                                                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                                            }
                                                        }
                                                    }

                                                    $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                                            function (data)
                                                            {
                                                                if (typeof data['current_year'] === 'undefined') {
                                                                    for (j = 0; j < data.length; j++) {
                                                                        if (data[j]['id'] == batch_id) {
                                                                            if (lookup_flag) {
                                                                                $('#setter_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                            }
                                                                            $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                        } else {
                                                                            if (lookup_flag) {
                                                                                $('#setter_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                            }
                                                                            $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                        }
                                                                    }
                                                                } else {
                                                                    if (lookup_flag) {
                                                                        $('#setter_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                    }
                                                                    $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                                }
                                                            },
                                                            "json"
                                                            );
                                                }
                                            }
                                        },
                                        "json"
                                        );
                            }
                            
function setter_load_semester(eh_year, selsemester, eh_course) {
//$('#setter_semester').find('option').remove().end().append('<option value="">---Select Exam---</option>').val('');
                                            if (eh_course == null)
                                            {
                                                eh_course = $('#setter_exam_course').val();
                                            }
                                            
                                            
                                            
                                            $.post("<?php echo base_url('time_table/load_semester') ?>", {'tt_year': eh_year, "tt_course": eh_course},
                                                    function (data)
                                                    {
                                                        $('#setter_semester').empty();
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {
                                                            $('#setter_semester').append("<option value=''></option>");
                                                            if (data > 0)
                                                            {
                                                                for (i = 0; i < data; i++) {

                                                                    selectedtxt = '';
                                                                    if (selsemester == (i + 1))
                                                                    {
                                                                        selectedtxt = 'selected';
                                                                    }

                                                                    $('#setter_semester').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + "</option>");
                                                                }
                                                            }
                                                        }
                                                    },
                                                    "json"
                                                    );
                                        }  
                                        
function setter_load_semester_exam(){
                            
                                var analys_course_id = $('#setter_exam_course').val();
                                var batch_id = $('#setter_batch').val();
                                var analys_year = $('#setter_year').val();
                                var analys_semester = $('#setter_semester').val();
                            
                                $('#setter_exam').find('option').remove().end().append('<option value="">---Select Exam---</option>').val('');
                                $.post("<?php echo base_url('Report/analysis_load_semester_exam') ?>", {'batch_id': batch_id, 'analys_course_id': analys_course_id, 'analys_year': analys_year, 'analys_semester': analys_semester},
                                        function (data) {
                                            for (var i = 0; i < data.length; i++) {

                                                $('#setter_exam').append($("<option></option>").attr("value", data[i]['sem_exam_id']).text(data[i]['exam_code'] + " - " + data[i]['exam_name']));
                                            }
                                        },
                                        "json"
                                        );
                            }
                            
function setter_load_exam_subjects(eh_batch, eh_branch, eh_course, eh_year, eh_semester, eh_exam, selexm) {
        
//        $('#east_exam_subject').empty();
        
        
        if (eh_batch == null)
            eh_batch = $('#setter_batch').val();

//        if (eh_branch == null)
//            eh_branch = $('#east_branch').val();

        if (eh_course == null)
            eh_course = $('#setter_exam_course').val();

        if (eh_year == null)
            eh_year = $('#setter_year').val();

        if (eh_semester == null)
            eh_semester = $('#setter_semester').val();

        if (eh_exam == null)
            eh_exam = $('#setter_exam').val();

        $.post("<?php echo base_url('report/setter_load_exam_subjects') ?>", {
            'tt_course_id': eh_course,
            'tt_year_no': eh_year,
            'tt_semester_no': eh_semester,
            'tt_sem_exam_id': eh_exam,
            'tt_batch_id': eh_batch
            },
                function (data)
                {
                    $('#setter_exam_subject').empty();
                    $('#setter_exam_subject').append("<option value='all'>---Select subject---</option>");
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        if (data.length > 0)
                        {
                            for (i = 0; i < data.length; i++) {
                                selectedtxt = '';
                                if (selexm == data[i]['id'])
                                {
                                    selectedtxt = 'selected';
                                }
                                $('#setter_exam_subject').append("<option value='" + data[i]['subject_id'] + "' " + selectedtxt + ">" + data[i]['code'] + " - " + data[i]['subject'] + "</option>");
                            }
                        }
                    }
                },
                "json"
                );
            }
                            
function setter_data(){
            $('.se-pre-con').fadeIn('slow');
            
            var course_id = $('#setter_exam_course').val();
            var batch_id = $('#setter_batch').val();
            var year_no = $('#setter_year').val();
            var semester_no = $('#setter_semester').val();
            var exam_id = $('#setter_exam').val();
            var subject_id = $('#setter_exam_subject').val();
//            var is_attend = $('#east_defer').val();

            
            if (course_id == "") {
                funcres = {status: "denied", message: "Course cannot be empty!"};
                result_notification(funcres);
            } else if (batch_id == "") {
                funcres = {status: "denied", message: "Batch cannot be empty!"};
                result_notification(funcres);
            } else if (year_no == "") {
                funcres = {status: "denied", message: "Year cannot be empty!"};
                result_notification(funcres);
            } else if (semester_no == "") {
                funcres = {status: "denied", message: "Semester cannot be empty!"};
                result_notification(funcres);
            } else if (exam_id == "") {
                funcres = {status: "denied", message: "Exam cannot be empty!"};
                result_notification(funcres);
            } else if (subject_id == "") {
                funcres = {status: "denied", message: "Exam Subject cannot be empty!"};
                result_notification(funcres);
            } else {
                $.post("<?php echo base_url('Report/setter_paper_data') ?>", {
                    
                    'course_id': course_id,
                    'batch_id': batch_id,
                    'year_no': year_no,
                    'semester_no': semester_no,
                    'exam_id': exam_id,
                    'subject_id': subject_id
//                    'east_type':east_type,
                    
                },
                        function (data) {
                            console.log(data);
                            if (data == 'denied')
                            {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else {
                                $('#setter_table').DataTable().destroy();
                                $('#setter_table').DataTable({
                                    'ordering': true,
                                    'lengthMenu': [10, 25, 50, 75, 100],
                                    "columnDefs": [{
                                            "targets": 0,
                                            "className": 'text-center'
                                        }]
                                });

                                $('#setter_table').DataTable().clear().draw();

                                if (data.length > 0) {
                                    $('#setter_data_pdf_btn').removeAttr('disabled');
                                    for (j = 0; j < data.length; j++) {

                                        
                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                        action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
                <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
                <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                        $('#setter_table').DataTable().row.add([
                                            number_content,
                                            data[j]['ese_description'],
                                            data[j]['code'],
                                            data[j]['set_tit']+" "+data[j]['set_name']+" "+data[j]['set_lname'],
                                            data[j]['mod_tit']+" "+data[j]['mod_name']+" "+data[j]['setm_lname']
//                                            subj_status,
//                                            reject_reason,
                                            
                                        ]).draw(false);
                                    }
                                } else {
                                    $('#setter_data_pdf_btn').attr('disabled', 'disabled');
                                }
                            }
                        },
                        "json"
                        );
            }
            $('.se-pre-con').fadeOut('slow');
        }
        
function setter_data_pdf(){
    var course_id = $('#setter_exam_course').val();
    var batch_id = $('#setter_batch').val();
    var year_no = $('#setter_year').val();
    var semester_no = $('#setter_semester').val();
    var exam_id = $('#setter_exam').val();
    var subject_id = $('#setter_exam_subject').val();


    window.open('<?php echo base_url("report/setter_data_pdf") ?>?&cou=' + course_id + '&bat=' + batch_id + '&yea=' + year_no + '&sem=' + semester_no + '&exm=' + exam_id + '&sub=' + subject_id);

}

function load_lecturers(center_id)
    {       
       $('#lecturer_id').find('option').remove().end();
       $('#lecturer_id').append('<option value="all">---All---</option>').val('');
       
        $.post("<?php echo base_url('Staff/load_lecturers_for_center') ?>", {'center_id': center_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    
              $('#lecturer_id').append($("<option></option>").attr("value", data[i]['stf_id']).text(data[i]['title_name']+' '+data[i]['stf_fname']+' '+data[i]['stf_lname']));
                 
              }
            },
            "json"
        ); 
    }

//.....................................load subject data.........................................
    
                                            function load_subject_data() {
                                            $('.se-pre-con').fadeIn('slow');
                                            
                                            var center_id = $('#center_id').val();
                                            var lecturer_id = $('#lecturer_id').val();
                                          
                                            if (center_id == "") {
                                                funcres = {status: "denied", message: "Center cannot be empty!"};
                                                result_notification(funcres);
                                                $('.se-pre-con').fadeOut('slow');
                                            } else {

                                                $.post("<?php echo base_url('Report/search_pdf_subject_lookup') ?>", {'center_id': center_id, 'lecturer_id': lecturer_id},
                                                        function (data)
                                                        {
                                                            console.log(data);
                                                            if (data == 'denied')
                                                            {
                                                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                                result_notification(funcres);
                                                            } else {
                                                                $('#subject_detail_tbl').DataTable().destroy();
                                                                $('#subject_detail_tbl').DataTable({
                                                                    'ordering': true,
                                                                    'lengthMenu': [10, 25, 50, 75, 100]
                                                                });
                                                                $('#subject_detail_tbl').DataTable().clear().draw();

                                                                if (data.length > 0) {
                                                                    $('#load_subject_full_data_btn').removeAttr('disabled');
                                                                    for (j = 0; j < data.length; j++) {

                                                                        number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                      if(lecturer_id=='all'){
                                                                        $('#subject_detail_tbl_all').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['br_name'],
                                                                            data[j]['stf_fname']+" "+data[j]['stf_lname'],
                                                                            data[j]['code'],
                                                                            data[j]['subject']
                                                                            ]).draw(false); 
                                                                        }    
                                                                       else{
                                                                        $('#subject_detail_tbl').DataTable().row.add([
                                                                            number_content,
                                                                            data[j]['br_name'],
                                                                            data[j]['code'],
                                                                            data[j]['subject']
                                                                            
                                                                            ]).draw(false);
                                                                            }
                                                       
                                                                    }
                                                                } else {
                                                                    $('#load_subject_full_data_btn').attr('disabled', 'disabled');
                                                                    //$('#bulk_approve').attr('disabled', true);
                                                                }
                                                            }
                                                            $('.se-pre-con').fadeOut('slow');
                                                        },
                                                        "json"
                                                        );
                                            }
                                        }
                                        


    function sub_radio_change(){
        var radioValue = $('input:radio[name="app_status"]:checked').val();

        
        if(radioValue == 1){
            $('#subject_div').show();
            $('#lecturer_div').hide();
            $('#subject_id').prop( "disabled", false );
            $('#lecturer_id').prop( "disabled", true );
      }
        else
        {
           $('#subject_div').hide();
           $('#lecturer_div').show();
           $('#lecturer_id').prop( "disabled", false );
           $('#subject_id').prop( "disabled", true );
        } 
    }
     function load_subject_full_data() {
       var center_id = $('#center_id').val();
       var lecturer_id = $('#lecturer_id').val();
       window.open('<?php echo base_url("report/load_subject_pdf") ?>?cen=' + center_id + '&lec=' + lecturer_id);
   }
                                
                                
    function changeValue(value){
        $('#subject_detail_tbl_all').DataTable().clear().draw();
        $('#subject_detail_tbl').DataTable().clear().draw();
                                            
        if(value == 'all'){
            $('#with_lec_name_div').show();
            $('#without_lec_name_div').hide();
        } else {
           $('#with_lec_name_div').hide();
           $('#without_lec_name_div').show(); 
        } 
        
        
      } 
      
     function changeSubValue(value){
        if(value == 'all'){
            $('#with_sub_div').show();
            $('#without_sub_div').hide();
        } else {
           $('#with_sub_div').hide();
           $('#without_sub_div').show(); 
        } 
      } 
      
      function load_transfer_students() {
       $('.se-pre-con').fadeIn('slow');
       var tr_center_id = $('#tr_center_id').val();
       if (tr_center_id == "") {
           funcres = {status: "denied", message: "Center cannot be empty!"};
           result_notification(funcres);
           $('.se-pre-con').fadeOut('slow');

       } else {

           $.post("<?php echo base_url('Report/search_pdf_transfer_lookup') ?>", {'tr_center_id': tr_center_id},
                   function (data)
                   {
                       console.log(data);
                       if (data == 'denied')
                       {
                           funcres = {status: "denied", message: "You have no right to proceed the action"};
                           result_notification(funcres);
                       } else {
                           $('#transfer_student_table').DataTable().destroy();
                           $('#transfer_student_table').DataTable({
                               'ordering': true,
                               'lengthMenu': [10, 25, 50, 75, 100]
                           });
                           $('#transfer_student_table').DataTable().clear().draw();

                           if (data.length > 0) {
                               $('#load_transfer_full_data_btn').removeAttr('disabled');
                               for (j = 0; j < data.length; j++) {

                                   number_content = "<td align='center'>" + (j + 1) + "</td>";

                                   action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();subject_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_destaff_detail_tblfined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                $('#transfer_student_table').DataTable().row.add([
                                       number_content,
                                       data[j]['first_name'],
                                       data[j]['old_reg_no'],
                                       data[j]['new_reg_no'],
                                       data[j]['old_center'],
                                       data[j]['new_center']

                                       ]).draw(false);



                                               //                                  ,action_content


                                               //action_content

                               }
                           } else {
                               $('#load_transfer_full_data_btn').attr('disabled', 'disabled');
                               //$('#bulk_approve').attr('disabled', true);
                           }
                       }
                       $('.se-pre-con').fadeOut('slow');
                   },
                   "json"
                   );
              }
    }
                                        
        function load_transfer_full_data()
        {
            var tr_center_id = $('#tr_center_id').val();
            window.open('<?php echo base_url("report/load_transfer_pdf") ?>?cen=' + tr_center_id);
        }


</script>

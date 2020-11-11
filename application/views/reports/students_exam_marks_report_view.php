<div class="se-pre-con"></div>
<style>
    .btn-red{
        display:none;
    }
    .jconfirm {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 13px;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STUDENT EXAM MARK REPORT</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Students Exam Report View</li>
        </ol>
    </div>
</div>


<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a class="fa fa-user" href="#students_exam_marks_tab" aria-controls="students_exam_marks_tab" role="tab" data-toggle="tab"> Students Exam Marks Report</a></li>
    <li role="presentation" class=""><a class="fa fa-user" href="#students_exam_marks_rpt_tab" aria-controls="students_exam_marks_rpt_tab" role="tab" data-toggle="tab"> Repeat Students Exam Marks Report</a></li>
    <li role="presentation" class=""><a class="fa fa-user" href="#students_exam_marks_recorrect_tab" aria-controls="students_exam_marks_recorrect_tab" role="tab" data-toggle="tab"> Re-correction Students Exam Marks Report</a></li>
    <li role="presentation" class=""><a class="fa fa-user" href="#students_exam_marks_full_tab" aria-controls="students_exam_marks_full_tab" role="tab" data-toggle="tab"> Students Full Exam Marks Report</a></li>
</ul>


<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="students_exam_marks_tab">
        <div class="panel">
            <div class="panel-heading">
                <div class="row container">
                    <div align="left" class="col-sm-3">Student Exam Mark Report</div>
                    <?php
                    if ($ug_level == 5) {
//                           $gpa = data[j]['gpa']
                        $extraattrs = "<div align='right' class='col-sm'>Overall GPA : <label id='student_gpa' name='student_gpa' value='' readonly>$overallgpa</label></div>";
                    } else {
                        $extraattrs = "";
                    }
//                        $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                    echo $extraattrs;
                    ?>
                    <!--<div align="right" class="col-sm"><input value="<?php echo $ug_level; ?>"></div>-->
                </div>
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
                                    <select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_year(this.value, 1, null, null, 1); load_year_list(this.value);" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" onchange="" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
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
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters_list(this.value);" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" onchange="load_semester_exam()" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Exam</label>
                                <div class="col-md-7">
                                    <select id="exam" class="form-control" style="width:100%" name="exam"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value="">---Select Exam---</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="load_student_data()">Search Students</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-md" id="print_students_semester_subject_btn" name="print_students_semester_subject_btn" onclick="print_load_student_data();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>
                <br>
                <br>

                <div style="overflow-x:auto;">
                   <table class="table table-bordered exam_marks_tbl" id="exam_marks_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Reg No</th>
                            <th>Admission No</th>
                            <th>Student</th>
                        </tr>
                    </thead>
                    <tbody id="load_student">
                    <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                    </tbody>
                </table> 
                </div>
                
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="students_exam_marks_rpt_tab">
        <div class="panel">
            <div class="panel-heading">
                <div class="row container">
                    <div align="left" class="col-sm-3">Repeat Student Exam Mark Report</div>
                    <?php
                    if ($ug_level == 5) {
//                           $gpa = data[j]['gpa']
                        $extraattrs = "<div align='right' class='col-sm'>Overall GPA : <label id='student_gpa_rpt' name='student_gpa_rpt' value='' readonly>$overallgpa</label></div>";
                    } else {
                        $extraattrs = "";
                    }
//                        $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                    echo $extraattrs;
                    ?>
                    <!--<div align="right" class="col-sm"><input value="<?php echo $ug_level; ?>"></div>-->
                </div>
            </div>
            <div class="panel-body">
            <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="exam_mark_tab"><br/>
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="center" class="col-md-3 control-label">Center</label>
                        <div class="col-md-7">
                            <?php
                            global $branchdrop;
                            global $selectedbr;
                            $extraattrs = 'id="rpt_prom_centre" class="form-control" style="width:100%" onchange="rpt_get_courses(this.value, 1, null)"';
                            echo form_dropdown('rpt_prom_centre', $branchdrop, $selectedbr, $extraattrs);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Mark course" class="col-md-3 control-label">Course</label>
                        <div class="col-md-9">
                            <select class="form-control" id="rpt_mark_course" name="rpt_mark_course"
                                    onchange="rpt_get_course_code(this.value, false)" data-validation="required"
                                    data-validation-error-msg-required="Field can not be empty">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="batch" class="col-md-3 control-label">Batch</label>
                        <div class="col-md-7">
                            <select id="rpt_mark_batch" name="rpt_mark_batch" class="form-control" style="width:100%"
                                    onchange="event.preventDefault();rpt_load_year_data(this.value,'')"
                                    data-validation="required"
                                    data-validation-error-msg-required="Field can not be empty">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Mark course" class="col-md-3 control-label">Year</label>
                        <div class="col-md-9">
                            <select class="form-control" id="rpt_mark_year" name="rpt_mark_year"
                                    onchange="rpt_load_semesters(this.value)" data-validation="required"
                                    data-validation-error-msg-required="Field can not be empty">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rpt_Mark course" class="col-md-3 control-label">Semester</label>
                        <div class="col-md-9">
                            <select class="form-control" id="rpt_mark_semester" name="rpt_mark_semester" onchange="event.preventDefault();rpt_load_semester_exam()"
                                    data-validation="required"
                                    data-validation-error-msg-required="Field can not be empty">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exam" class="col-md-3 control-label">Exam</label>
                        <div class="col-md-7">
                            <select id="rpt_mark_exam" name="rpt_mark_exam" class="form-control"
                                    onchange=""
                                    style="width:100%" data-validation="required"
                                    data-validation-error-msg-required="Field can not be empty">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-11">
                        <button type='button' class='btn btn-primary'
                                onclick='event.preventDefault(); load_repeat_student_data_report();'>
                            Search Students
                        </button>
                        <button type='button' class='btn btn-success' id='prnt_load_repeat_student_data_report_btn'
                                onclick='event.preventDefault(); prnt_load_repeat_student_data_report();'><span class="glyphicon glyphicon-print" id="basic-addon1"></span> 
                            Print Report
                        </button>
                    </div></div>
                </div>
            </div>
            </div>




            <br/>
            <div style="overflow-x:auto;">
            <table class="table table-bordered rpt_exam_marks_tbl" id="rpt_exam_marks_tbl" style="overflow-y: auto;">
                <thead id="rpt_exam_marks_load_thead">
                <tr>
                    <th>#</th>
                    <th>Reg No</th>
                    <th>Admission No</th>
                    <th>Student</th>
                </tr>
                </thead>
                <tbody id="exam_marks_load_student">

                </tbody>
            </table>
            </div>

            </div>
        </div>
    </div>
				

        
    </div>
    <div role="tabpanel" class="tab-pane" id="students_exam_marks_recorrect_tab">
        <form class="form-horizontal" role="form" method="post" action="" id="req_recorrection_form"
              name="req_recorrection_form" autocomplete="off">
            <div class="panel">
                <div class="panel-heading">
                <div class="row container">
                    <div align="left" class="col-sm-6">Re-correction Student Exam Mark Report</div>
                    <?php
                    if ($ug_level == 5) {
//                           $gpa = data[j]['gpa']
                        $extraattrs = "<div align='right' class='col-sm'>Overall GPA : <label id='student_gpa_rec' name='student_gpa_rec' value='' readonly>$overallgpa</label></div>";
                    } else {
                        $extraattrs = "";
                    }
//                        $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                    echo $extraattrs;
                    ?>
                    <!--<div align="right" class="col-sm"><input value="<?php echo $ug_level; ?>"></div>-->
                </div>
            </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="req_recorrection_center" class="col-md-3 control-label">Center</label>
                                <div class="col-md-7">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="req_recorrection_centre" class="form-control" style="width:100%" onchange="load_recorrection__course_list(this.value);"';
                                    echo form_dropdown('rpt_centre', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="req_recorrection_course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="req_recorrection_course"
                                            name="req_recorrection_course"
                                            onchange="get_batch_for_recorrection(this.value)"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="req_recorrection_batch"
                                       class="col-md-3 control-label">Batch</label>
                                <div class="col-md-7">
                                    <select id="req_recorrection_batch" class="form-control"
                                            style="width:100%" name="req_recorrection_batch"
                                            onchange="event.preventDefault();recorrection_load_year_data();"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Mark course" class="col-md-3 control-label">Year</label>
                                <div class="col-md-7">
                                    <select class="form-control" id="recorrection_mark_year" name="recorrection_mark_year"
                                            onchange="recorrection_load_semesters(this.value)" style="width:100%" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rpt_Mark course" class="col-md-3 control-label">Semester</label>
                                <div class="col-md-7">
                                    <select class="form-control" id="recorrection_mark_semester" name="recorrection_mark_semester"
                                            style="width:100%" onchange="load_semester_exam_recorrection(this.value)" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="req_recorrection_exam"
                                       class="col-md-3 control-label">Exam</label>
                                <div class="col-md-7">
                                    <select id="req_recorrection_exam" class="form-control"
                                            onchange=""
                                            style="width:100%" name="req_recorrection_exam"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-4 pull-right">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-11">
                                    <button type='button' class='btn btn-primary'
                                            onclick='event.preventDefault(); load_recorrection_student_data();'>
                                        Search Students
                                    </button>
                                    
                                    <button type='button' class='btn btn-success btn-md' id='prnt_load_recorrection_student_data_btn'
                                            onclick='event.preventDefault(); prnt_load_recorrection_student_data();'> <span class="glyphicon glyphicon-print" id="basic-addon1"></span> 
                                        Print Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div style="overflow-x:auto;">
                        <table class="table table-bordered" id="apply_recorrection_exam_tbl" style="overflow-x: auto; max-height: 200px; overflow-y: auto; -ms-overflow-style: -ms-autohiding-scrollbar;">  <!--display: block;-->
                            <thead id="apply_recorrection_exam_load_thead">
                                <tr>
                                    <th>#</th>
                                    <th>Reg No</th>
                                    <th>Admission No</th>
                                    <th>Student</th>
    <!--                                <th>Grade</th>
                                    <th>Result</th>
                                    <th></th>-->
                                </tr>
                            </thead>
                            <tbody id="apply_recorrection_exam_load_student">
    <!--                                                    <tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <!--<button type="submit" class="btn btn-primary" id="submitbtn" onclick="event.preventDefault(); apply_exam()">Apply</button>-->
                </div>
            </div>
        </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="students_exam_marks_full_tab">
        <div class="panel">
            <div class="panel-heading">
                <div class="row container">
                    <div align="left" class="col-sm-3">Student Full Exam Mark Report</div>
                    <?php
                    if ($ug_level == 5) {
//                           $gpa = data[j]['gpa']
                           $extraattrs = "";
                        //$extraattrs = "<div align='right' class='col-sm'>CGPA : <label id='student_gpa_full' name='student_gpa_full' value='' readonly>$overallgpa</label></div>";
                    } else {
                        $extraattrs = "";
                    }
//                        $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                    echo $extraattrs;
                    ?>
                    <!--<div align="right" class="col-sm"><input value="<?php echo $ug_level; ?>"></div>-->
                </div>
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
                                    <select class="form-control" id="full_center" name="full_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_full_result_course_list(this.value);">
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
                                    <select type="text" class="form-control" id="full_course" name="full_course" onchange="get_full_result_batch_list(this.value);" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="full_batch" name="full_batch" onchange="" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>

                </div>

<!--                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters_list(this.value);" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" onchange="load_semester_exam()" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Exam</label>
                                <div class="col-md-7">
                                    <select id="exam" class="form-control" style="width:100%" name="exam"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value="">---Select Exam---</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search_full" onclick="load_student_data_full_result()">Search Students</button>
                    </div>
                    <div class="col-md-2">
<!--                        <button type="button" class="btn btn-success btn-md" id="print_students_marks_full_btn" name="print_students_marks_full_btn" onclick="print_load_student_full_data();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>-->
                    </div>
                </div>
                <br>
                <br>

                <div style="overflow-x:auto;">
                   <table class="table table-bordered exam_marks_tbl" id="full_exam_results_tbl">
                    <thead id="load_thead">
                        <tr>
                            <th>#</th>
                            <th>Reg No</th>
                            <th>Student Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="load_student">
                    <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                    </tbody>
                </table> 
                </div>
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="fullMrkModal" role="dialog">
    <div class="modal-dialog" style="width: 75%;">
         Modal content
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Academic Details</b> </h4><br>
            </div>
            <div class="modal-body"> 
                <label style="font-size: 15px; margin-left:13%;" id="stu_reg_no"></label><br>
                <label style="font-size: 15px; margin-left:13%;" id="stu_name"></label><br>
                <label style="font-size: 15px; margin-left:13%;" id="stu_course"></label>
                <br>
                <br>
                <table width="75%" class="table table-bordered" id="view_full_results_tbl" style="overflow-x: auto; max-height: 200px; overflow-y: auto; -ms-overflow-style: -ms-autohiding-scrollbar;">  <!--display: block;-->
                    <thead id="view_full_marks_thead">
                        <tr style="background-color:#ffebcd">
                            <th>2</th>
                            <th id="cumulativegpa" style="font-size: initial; text-align:left;">Cumulative GPA-: --</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Subject</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody id="view_full_marks_tbody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
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
                                $('#student_gpa').hide();
                                $('#student_gpa_rec').hide();
                                
                                
                                $('#student_gpa_rpt').hide();
                                
                                $('#exam_marks_tbl').DataTable({
                                    'paging': false
                                });
                                
                                $('#print_students_semester_subject_btn').attr("disabled", true);
                                
                                $('#rpt_exam_marks_tbl').DataTable({
                                    'paging': false
                                });
                                
                                $('#apply_recorrection_exam_tbl').DataTable({
                                    'paging': false
                                });
                                
                                $('#prnt_load_repeat_student_data_report_btn').attr("disabled", true);
                                $('#print_recorrection_student_data_btn').attr("disabled", true);
                                
                                if($('#rpt_prom_centre').val() != ""){
                                    rpt_get_courses($('#rpt_prom_centre').val(), 1, '');
                                }
                                
                                if($('#req_recorrection_centre').val() != ""){
                                    load_recorrection__course_list($('#req_recorrection_centre').val());
                                }
                                
                                $('#prnt_load_recorrection_student_data_btn').attr("disabled", true);
                                
                                $('#full_exam_results_tbl').DataTable();
                                
                                <?php
                                $access_level = $this->Util_model->check_access_level();
                                $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>                
                                document.getElementById("l_center").selectedIndex = "1";
                                sem_load_course_list(($('#l_center').val()), 1, null);
                                document.getElementById("full_center").selectedIndex = "1";
                                load_full_result_course_list(($('#full_center').val()));
                                <?php } ?>
                                
                            });
                            
                            
//                            var user_level = "<?//php echo $user_level; ?>";
//                            alert(user_level);
////////////////First Tab/////////////
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
                                            <?php
                                            $access_level = $this->Util_model->check_access_level();
                                            $ug_level = $access_level[0]['ug_level']; 
                                            ?>

                                            <?php if($ug_level == 5){ ?>                
                                                document.getElementById("l_Dcode").selectedIndex = "1";
                                                get_course_year(($('#l_Dcode').val()), 1, null, null, 1); 
                                                load_year_list(($('#l_Dcode').val()));
                                            <?php } ?>

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
                              //  $('#l_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
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
                                                    //console.log(data);
                                                    if (typeof data['current_year'] === 'undefined') {
                                                        //alert('true');
                                                        for (var i = 1; i <= data['no_of_year']; i++) {
                                                            if (flag) {
                                                                if (i == year_no) {
                                                                    if (lookup_flag) {
                                                                        //$('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                                                    }
                                                                    $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                                                } else {
                                                                    if (lookup_flag) {
                                                                      //  $('#l_no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                                                    }
                                                                    $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                                                }
                                                            } else {
                                                                if (lookup_flag) {
                                                                  //  $('#l_no_year').append($("<option></option>").text(i+" Year"));
                                                                }
                                                                $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                                            }
                                                        }
                                                    } else {
                                                        //alert('false');
                                                        var current_year = data['current_year'];
                                                        
                                                        if(current_year != 0){
                                                            if (flag) {
                                                                if (lookup_flag) {
                                                                   // $('#l_no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                                                }
                                                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                                            } else {
                                                                if (lookup_flag) {
                                                                  //  $('#l_no_year').append($("<option></option>").text(current_year+" Year"));
                                                                }
                                                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
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
                                                                <?php
                                                                $access_level = $this->Util_model->check_access_level();
                                                                $ug_level = $access_level[0]['ug_level']; 
                                                                ?>

                                                                <?php if($ug_level == 5){ ?>                
                                                                    document.getElementById("l_Bcode").selectedIndex = "1";
                                                                <?php } ?>
                                                            },
                                                            "json"
                                                            );
                                                }
                                            }
                                        },
                                        "json"
                                        );
                            }
                            
                            
                            function load_year_list(cou_id) {
                            //var cou_id = $('#course_id').val();
                                $.post("<?php echo base_url('Student/load_year_list') ?>", {'selected_course_id': cou_id},
                                    function (data) {
                                        var year = data['no_of_year'];
                                        var id = data['id'];

                                        $('#l_no_year').find('option').remove().end();
                                        $('#l_no_year').append('<option value="">---Select Year---</option>').val('');

                                        for (var i = 1; i <= year; i++) {
                                            $('#l_no_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                                        }
                                    },
                                    "json"
                                );
                            }
                            
                            
                             function load_semesters_list(year_no) {
                                var sel_year = year_no.split('-')[0].trim();
                                var sel_year_id = year_no.split('-')[1].trim();

                                $('#l_no_semester').find('option').remove().end();
                                $('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                                $.post("<?php echo base_url('Student/load_semesters_from_year') ?>", {'year_id': sel_year_id, 'year_no': sel_year},

                                    function (data) {
                                        for (var i = 1; i <= data; i++) {
                                            $('#l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                                        }
                                    },
                                    "json"
                                );
                            }


                            function load_semesters(year_no, semester_no, lookup_flag) {
                               // $('#l_no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
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
                                                //console.log(data);
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
                                                                  //  $('#l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                                                                }
                                                                $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                                                            } else {
                                                                if (lookup_flag) {
                                                                   // $('#l_no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                                                                }
                                                                $('#no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                                                            }
                                                        }
                                                    } else {
                                                        var current_semester = data['current_semester'];
                                                        if (lookup_flag) {
                                                          //  $('#l_no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester+" Semester"));
                                                        }
                                                        $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester+" Semester"));
                                                    }
                                                }
                                            }
                                        },
                                        "json"
                                        );
                            }

                            function search_students_exam_marks() {
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
                                } else if (course_id == "") {
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
                                } else {
                                    $.post("<?php echo base_url('Report/search_students_exam_marks') ?>", {'center_id': center_id,
                                        'course_id': course_id,
                                        'batch_id': batch_id,
                                        'year_no': year_no,
                                        'semester_no': semester_no
                                    },
                                            function (data) {
                                                //console.log(data);
                                                if (data == 'denied')
                                                {
                                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                    result_notification(funcres);
                                                } else {
                                                    $('#student_exam_marks_tbl').DataTable().destroy();
                                                    $('#student_exam_marks_tbl').DataTable({
                                                        'ordering': true,
                                                        'lengthMenu': [10, 25, 50, 75, 100],
                                                        'paging': false
                                                    });
                                                    $('#student_exam_marks_tbl').DataTable().clear().draw();
                                                    if (data.length > 0) {
                                                        $('#print_students_semester_subject_btn').removeAttr('disabled');
                                                        for (j = 0; j < data.length; j++) {
                                                            var code = '';
                                                            for (e = 0; e < data[j]['subjects'].length; e++) {

                                                                code += data[j]['subjects'][e]['code'] + " - " + data[j]['subjects'][e]['overall_grade'] + ' <br> ';
                                                            }

                                                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                                                            action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
                <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
                <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";
                                                            $('#student_exam_marks_tbl').DataTable().row.add([
                                                                number_content,
                                                                data[j]['reg_no'],
                                                                data[j]['last_name'] + " " + data[j]['first_name'],
                                                                data[j]['year_no'],
                                                                data[j]['semester_no'],
                                                                code
//                                    data[j]['code'] + " - " + data[j]['total_marks'] + " - " + data[j]['overall_grade']



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
                                            },
                                            "json"
                                            );
                                }
                            }

                            function load_student_data() {
                            $('.se-pre-con').fadeIn('slow');
//                            var center_id   = $('#l_center').val();
//                            var course_id   = $('#l_Dcode').val();
//                            var batch_id    = $('#l_Bcode').val();
//                            var year_no     = $('#l_no_year').val();
//                            var semester_no = $('#l_no_semester').val();
//    

                                var res = [];
                                var sem_subject_ids = [];
                                var sem_subject_names = [];
                                var sem_subject_code = [];
                                var sem_subject_types = [];
                                var applied_subjects = [];
                                var stu_sem_applied_subjects = [];
                                var subjects_marks = {};
                                var subjects_code = [];
                                var subjects_names = [];
                                var center_id = $('#l_center').val();
                                var batch_id = $('#l_Bcode').val();
                                var course_id = $('#l_Dcode').val();
                                var year = $('#l_no_year').val().split('-')[0].trim();
                                var semester = $('#l_no_semester').val();
                                var exam_id = $('#exam').val();
                                var exam_name = $('#exam').text().replace("---Select Exam---", "");
                                
                                // alert(exam_id);

                                if (batch_id == '' || course_id == '' || year == '' || semester == '' || exam_id == '') {
                                    res['status'] = 'denied';
                                    res['message'] = 'Please Select all batch, course, year, semester and exam to search';
                                    result_notification(res);
                                    $('.se-pre-con').fadeOut('slow');
                                } else {
                                    $('#exam_marks_tbl').DataTable().clear();
                                    $("#exam_marks_tbl").find('tbody').empty();
                                    $('#load_thead').find('tr').remove();
                                                            
                                    $.post("<?php echo base_url('Report/semester_subjects_by_semester') ?>", {
                                        'batch_id': batch_id,
                                        'course_id': course_id,
                                        'year': year,
                                        'semester': semester
                                    },
                                            function (data) {
                                             //   console.info(data)

                                                /* for (var i = 0; i < data.length; i++) {
                                                 sem_subject_ids.push(data[i]['subject_id']);
                                                 sem_subject_code.push(data[i]['code']);
                                                 sem_subject_names.push(data[i]['subject']);
                                                 if (data[i]['subject_type'] == '1') {
                                                 sem_subject_types.push("Core");
                                                 } else {
                                                 sem_subject_types.push("Elective");
                                                 }
                                                 
                                                 }*/
                                                for (var i = 0; i < data[(data.length - 1)]['lecturer_subject'].length; i++) {
                                                    sem_subject_ids.push(data[(data.length - 1)]['lecturer_subject'][i]['subject_id']);
                                                    sem_subject_code.push(data[(data.length - 1)]['lecturer_subject'][i]['code']);
                                                    subjects_names.push(data[(data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+data[(data.length - 1)]['lecturer_subject'][i]['code']+"]");
                                                    // sem_subject_names.push(header_data[i]['subject']);


                                                }
                                                
                                                //console.log("sem_subject_code="+sem_subject_code);
                                                
                                                $.post("<?php echo base_url('Report/load_student_for_exam_mark_report') ?>", {
                                                    'center_id': center_id,
                                                    'batch_id': batch_id,
                                                    'course_id': course_id,
                                                    'year': year,
                                                    'semester': semester,
                                                    'exam_id': exam_id


                                                },
                                                        function (data) {

                                                            $('#exam_marks_tbl').DataTable().clear();
                                                            
                                                            //$('#exam_marks_tbl').DataTable()
                                                            //style="height: 500px; overflow-y: scroll;"
                                                            
                                                            $("#exam_marks_tbl").find('tbody').empty();
                                                            
                                                            $('#load_thead').find('tr').remove();
                                                            if (data['students'].length > 0) {

                                                                $('#exam_marks_tbl').DataTable().rows().remove();
                                                                $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                                                                $('#exam_marks_tbl tr:last').append(subjects_names
                                                                        .map(id => `<th>${id}</th>`)
                                                                        .join(''))
                                                                        .appendTo($('#load_thead'));
                                                                  $('#exam_marks_tbl tr:last').append(`<th>SGPA</th>`).appendTo($('#load_thead'));
                                                                for (j = 0; j < data['students'].length; j++) {
                                                                    $('#exam_marks_tbl').DataTable().row.add([
                                                                        (j + 1),
                                                                        data['students'][j]['reg_no'],
                                                                        data['students'][j]['reg_no'],
                                                                        data['students'][j]['first_name']
                                                                    ]).draw(false);
                                                                    for (x = 0; x < data['students'][j]['applied_subjects'].length; x++) {
                                                                        applied_subjects.push(data['students'][j]['applied_subjects'][x]['subject_code']);
                                                                        
//                                                                        if (data[j]['applied_subjects'][x]['is_approved'] >2)//is_approved
//                                                                           applied_subjects.push(data[j]['applied_subjects'][x]['subject_code'])= "any";
//                                                                        else //if (data[j]['applied_subjects'][x]['is_approved'] == 2)
//                                                                            subjects_marks[data[j]['applied_subjects'][x]['subject_code']] = "Mark not Entered";

                                                                    }
                                                                    
                                                                    for (x = 0; x < data['students'][j]['stu_sem_applied_subjects'].length; x++) {
                                                                        stu_sem_applied_subjects.push(data['students'][j]['stu_sem_applied_subjects'][x]['subject_code']);
                                                                    }
                                                                    
                                                                    
                                                                    //console.log("applied_subjects"+applied_subjects);
                                                                    //console.log(data['students'][j]['reg_no']);
                                                                    //console.log(data['students'][j]['exam_mark']);
                                                                    //console.log(data['students'][j]['applied_subjects']);
                                                                    for (z = 0; z < data['students'][j]['exam_mark'].length; z++) {
                                                                        
                                                                        var mark = '';


                                                                        var rel_result = 0;
                                                                        
                                                                        if(data['students'][j]['exam_mark'][z]['release_result'] == 1){
                                                                            var examData = searchArray(data['students'][j]['exam_mark'][z]['subject_code'],data['students'][j]['applied_subjects']);
                                                                               if (typeof examData == 'undefined' || examData == null){ // no data in exam mark table
                                                                                   mark = "INC"; 
                                                                               }else if ((examData['is_approved'] == '3' || examData['is_approved'] == '4') && examData['is_repeat'] != 1){ //rejected
                                                                                    mark = 'NE';
                                                                               } else if(data['students'][j]['exam_mark'][z]['is_ex_director_mark_approved'] == 1){
                                                                                   // done SE process
                                                                                   //console.info('ex dir app 1')
    //                                                                                if(data['students'][j]['exam_mark'][z]['overall_grade'] == 'AB'){
    //                                                                                    mark = 'AB';
    //                                                                                } else {
                                                                                        if(data['students'][j]['exam_mark'][z]['result'] === '-'){
                                                                                            // if the student is absent
                                                                                            if(examData['is_absent'] == '1'){
                                                                                                // deferment
                                                                                                if(examData['is_absent_approve'] == '1'){
                                                                                                    if(examData['absent_deferement'] != '' || examData['absent_deferement'] != null ){
                                                                                                        mark = 'DFR';
                                                                                                    } else {
                                                                                                        mark = 'AB';
                                                                                                    }
                                                                                                } else {
                                                                                                   mark = 'AB'; 
                                                                                                }
                                                                                            } else {
                                                                                                mark = data['students'][j]['exam_mark'][z]['result'];
                                                                                            } 
                                                                                        } else {
                                                                                            mark = data['students'][j]['exam_mark'][z]['result'];
                                                                                        }
    //                                                                                }
                                                                            //done only CA process
                                                                            } else if(data['students'][j]['exam_mark'][z]['is_hod_mark_aproved'] == 1 && data['students'][j]['exam_mark'][z]['is_director_mark_approved'] == 1 && data['students'][j]['exam_mark'][z]['is_ex_director_mark_approved'] == 0){
                                                                                 mark = "I(SE)";        
                                                                            // incomplete 
                                                                            } else {
                                                                               mark = "INC"; 
                                                                            }
                                                                        }
                                                                        else{
                                                                            rel_result = 1;
                                                                            mark = "Results not released.";
                                                                        }
                                                                        
                                                                        subjects_marks[data['students'][j]['exam_mark'][z]['subject_code']] = mark;
                                                                    }

                                                                    $('#exam_marks_tbl').css("height", "200px");
                                                                    $('#exam_marks_tbl').css("overflow-y", "scroll");
                                                                    $('#exam_marks_tbl tr:last').append(sem_subject_code
                                                                            .map(e => `<td align="center">${stu_sem_applied_subjects.includes(e) ? (applied_subjects.includes(e) ? '<a id="' + data['students'][j]['stu_id'] + '_subject_mark_' + e + '" ><span>' + subjects_marks[e] +'</span></a>' : "INC") : " "}</td>`)
                                                                            .join(''))
                                                                            .appendTo($('#load_student'));
                                                                    
                                                                    if(data['students'][j]['gpa'] == null){
                                                                        if(rel_result == 1){
                                                                            gpa = "Results not released."; 
                                                                        }
                                                                        else{
                                                                           gpa = "-"; 
                                                                        }
                                                                    }
                                                                    else{
                                                                        if(rel_result == 1){
                                                                           $('#student_gpa').show();
                                                                           $('#student_gpa').text("Results not released");
                                                                           gpa = "Results not released."; 
                                                                        }
                                                                        else{
                                                                            $('#student_gpa').show();
                                                                            $('#student_gpa').text("<?php echo $overallgpa?>");
                                                                            gpa = data['students'][j]['gpa'];
                                                                        }
                                                                    }
                                                                    
                                                                    $('#exam_marks_tbl tr:last').append('<td align="center">'+gpa+'</td>').appendTo($('#load_student'));
//                                                                    $('#student_gpa').val(data[j]['overall_gpa']);
                                                                    applied_subjects = [];
                                                                    stu_sem_applied_subjects = [];
                                                                    subjects_marks = {};
//
                                                                }
                                                                $('#print_students_semester_subject_btn').attr("disabled", false);

                                                            }
                                                            else{
                                                                
                                                                if(data['release_results'].length > 0){
                                                                    if(data['release_results'][0]['release_result'] == 0){
                                                                        $('#print_students_semester_subject_btn').attr("disabled", true);                                                              

                                                                        $('#load_student').find('tr').remove();
                                                                        $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admision No</th><th>Student</th></tr>");
        //                                                                $('#exam_marks_tbl tr:last').append(sem_subject_code
        //                                                                    .map(id => `<th>${id}</th>`)
        //                                                                    .join(''))
        //                                                                    .appendTo($('#load_thead'));
                                                                        $('#exam_marks_tbl tr:last').append(
                                                                            '<th>Subject</th><th>SGPA</th>')
                                                                            .appendTo($('#load_thead'));

                                                                        $('#load_student').append("<tr><td colspan='6' align='center' >No records to show.</td></tr>");


                                                                        $.confirm({
                                                                            title: 'Result View',
                                                                            content: 'Results have not been released yet for '+exam_name+' exam.',
                                                                            type: 'red',
                                                                            typeAnimated: true,
                                                                            buttons: {
                                                                                tryAgain: {
                                                                                    text: 'Try again',
                                                                                    btnClass: 'btn-default',
                                                                                    action: function(){
                                                                                    }
                                                                                },
                                                                                close: function () {
                                                                                }
                                                                            }
                                                                        }); 
                                                                    }
                                                                    else{
                                                                        $('#print_students_semester_subject_btn').attr("disabled", true);                                                              

                                                                        $('#load_student').find('tr').remove();
                                                                        $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admision No</th><th>Student</th></tr>");
        //                                                                $('#exam_marks_tbl tr:last').append(sem_subject_code
        //                                                                    .map(id => `<th>${id}</th>`)
        //                                                                    .join(''))
        //                                                                    .appendTo($('#load_thead'));
                                                                        $('#exam_marks_tbl tr:last').append(
                                                                            '<th>Subject</th><th>SGPA</th>')
                                                                            .appendTo($('#load_thead'));

                                                                        $('#load_student').append("<tr><td colspan='6' align='center' >No records to show.</td></tr>");
                                                                    }
                                                                }
                                                                else{
                                                                    $('#print_students_semester_subject_btn').attr("disabled", true);                                                              

                                                                    $('#load_student').find('tr').remove();
                                                                    $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admision No</th><th>Student</th></tr>");
    //                                                                $('#exam_marks_tbl tr:last').append(sem_subject_code
    //                                                                    .map(id => `<th>${id}</th>`)
    //                                                                    .join(''))
    //                                                                    .appendTo($('#load_thead'));
                                                                    $('#exam_marks_tbl tr:last').append(
                                                                        '<th>Subject</th><th>SGPA</th>')
                                                                        .appendTo($('#load_thead'));

                                                                    $('#load_student').append("<tr><td colspan='6' align='center' >No records to show.</td></tr>");
                                                                }
                                                            }
                                                            $('.se-pre-con').fadeOut('slow');
                                                        },
                                                        "json"
                                                        );
                                            },
                                            "json"
                                            );
                                
                                }


                            }
                            
                            function searchArray(nameKey, myArray){

                                for (var i=0; i < myArray.length; i++) {
                                    if (myArray[i].subject_code === nameKey) {
                                        return myArray[i];
                                    }
                                }
                            }

                            function print_load_student_data() {

                                var center_id = $('#l_center').val();
                                var course_id = $('#l_Dcode').val();
                                var batch_id = $('#l_Bcode').val();
                                var year = $('#l_no_year').val().split('-')[0].trim();
                                var semester = $('#l_no_semester').val();
                                var exam = $('#exam').val();

                                window.open('<?php echo base_url("report/print_load_student_data") ?>?&cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id + '&yea=' + year + '&sem=' + semester + '&exm=' + exam);
                            }
                            
                            
                            function load_semester_exam(batch_id) {
                                
                                var mrk_course = $('#l_Dcode').val();
                                var mrk_year = $('#l_no_year').val().split('-')[0].trim();
                                var mrk_semester = $('#l_no_semester').val();
                                var mrk_batch = $('#l_Bcode').val();
                                
                                $('#exam').find('option').remove().end().append('<option value="">---Select Exam---</option>').val('');
                                $.post("<?php echo base_url('exam/load_mark_semester_exam') ?>", {'mrk_course': mrk_course, 'mrk_year': mrk_year, 'mrk_semester': mrk_semester, 'mrk_batch': mrk_batch},
                                    function (data) {
                                        for (var i = 0; i < data.length; i++) {

                                            $('#exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
                                        }
                                    },
                                    "json"
                                );
                            }



//////////////First Tab End///////////



//////////////Second Tab Start/////////
    function rpt_get_courses(center_id, flag, course_id) {

        $('#rpt_mark_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
       
        //$('#lecture_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');
        //$('#exam_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        
                        $('#rpt_mark_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                        
                    }
                                <?php
                                $access_level = $this->Util_model->check_access_level();
                                $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>                
                                document.getElementById("rpt_mark_course").selectedIndex = "1";
                                rpt_get_course_code(($('#rpt_mark_course').val()), false);
                                <?php } ?>
                },
                "json"
            );
        }
    }
    
    function rpt_get_course_code(course_id, lookup_flag) {
        
        $('#rpt_mark_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

        $('#lecture_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');


        $.post("<?php echo base_url('report/load_repeat_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    
                    $('#rpt_mark_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                       
                }
                                <?php
                                $access_level = $this->Util_model->check_access_level();
                                $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>                
                                document.getElementById("rpt_mark_batch").selectedIndex = "1";
                                rpt_load_year_data(($('#rpt_mark_year').val()));
                                <?php } ?>
            },
            "json"
        );
    }
    
    function rpt_load_semester_exam() {
        
        var mrk_batch = $('#rpt_mark_batch').val();
        var mrk_course = $('#rpt_mark_course').val();
        var mrk_year = $('#rpt_mark_year').val().split('-')[0].trim();
        var mrk_semester = $('#rpt_mark_semester').val();
        //$('#rpt_exam').find('option').remove().end();
        //$('#rpt_exam').append('<option value="">---Select Exam---</option>').val('');
        $('#rpt_mark_exam').find('option').remove().end();
        $('#rpt_mark_exam').append('<option value="">---Select Exam---</option>').val('');


        //if(flag ===1){
        $.post("<?php echo base_url('exam/load_mark_semester_exam_repeat') ?>", {'mrk_batch': mrk_batch, 'mrk_course': mrk_course, 'mrk_year': mrk_year, 'mrk_semester': mrk_semester},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    //$('#exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
                    $('#rpt_mark_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));

                }
            },
            "json"
        );
        //}
    }
    
    function rpt_load_year_data(exam_id, year_no) {
        $('#rpt_mark_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');

        var course_id = $('#rpt_mark_course').val();

        //$.post("<?php //echo base_url('course/get_course_for_repeat_stu_mark') ?>", {'id': course_id},
        $.post("<?php echo base_url('Student/load_year_list') ?>", {'selected_course_id': course_id},
            function (data) {
                
                
                if (data != null) {
                    
                    var id = data['id'];
                    
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        //if (flag) {
                        if (i == year_no) {
                            $('#rpt_mark_year').append($("<option></option>").attr("value", i + '-' + id).attr('selected', 'selected').text(i+" Year"));
                        } else {
                            $('#rpt_mark_year').append($("<option></option>").attr("value", i + '-' + id).text(i+" Year"));
                        }
                        /* } else {
                             $('#year').append($("<option></option>").attr("value", i).text(i));
                         }*/
                    }
                }

            },
            "json"
        );
    }
    
    function rpt_load_semesters(year_no) {
        $('#rpt_mark_semester').find('option').remove().end().append('<option value="0">---Select Semester---</option>').val('');
        var course_id = $('#rpt_mark_course').val();
        
        var sel_year = year_no.split('-')[0].trim();
        var sel_year_id = year_no.split('-')[1].trim();
                                
        $.post("<?php echo base_url('subject/load_semesters_for_repeat_stu_mark_report') ?>", {'course_id': course_id, 'year_no': sel_year, 'year_id': sel_year_id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    for (var i = 1; i <= data; i++) {
                        $('#rpt_mark_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                    }
                }
            },
            "json"
        );
    }
    
    function load_repeat_student_data_report() {
        
        $('.se-pre-con').fadeIn('slow');
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var applied_subjects = [];
        var subjects_marks = {};
        var subjects_code = [];
        var sbj_stat_array = [];
        
        var year = "";
        
        var batch_id    = $('#rpt_mark_batch').val();
        var course_id   = $('#rpt_mark_course').val();
        var year        = $('#rpt_mark_year').val().split('-')[0].trim();
        var semester    = $('#rpt_mark_semester').val();
        var exam_id     = $('#rpt_mark_exam').val();
        var center_id   = $('#rpt_prom_centre').val();
        
        
//        if($('#rpt_mark_year').val() != ""){
//            year = $('#rpt_mark_year').val().split('-')[0].trim();
//        }

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('report/load_rpt_semester_subjects_by_semester') ?>", {
                'center_id': center_id,
                'batch_id': batch_id,
                'course_id': course_id,
                'year': year,
                'semester': semester
            },
                function (header_data) {
                    
                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject'] + "<br/>[" + header_data[(header_data.length - 1)]['lecturer_subject'][i]['code'] + "]");
                        // sem_subject_names.push(header_data[i]['subject']);
                    }

                    //create table heard
                    $('#rpt_exam_marks_tbl').DataTable().clear();
                    $('#rpt_exam_marks_tbl').find('tbody').empty();
                    $('#rpt_exam_marks_load_thead').find('tr').remove();
                    $('#rpt_exam_marks_tbl').DataTable().rows().remove();
                    $('#rpt_exam_marks_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                    $('#rpt_exam_marks_tbl tr:last').append(sem_subject_code
                        .map(id => `<th style="width:10%;">${id}</th>`)
                        .join(''))
                        .appendTo($('#rpt_exam_marks_load_thead'));
                    $('#rpt_exam_marks_tbl tr:last').append(`<th>SGPA</th>`).appendTo($('#rpt_exam_marks_load_thead'));    
                    // end create table heard
                    $.post("<?php echo base_url('report/load_rpt_student_for_exam_marks') ?>", {
                        'batch_id': batch_id,
                        'course_id': course_id,
                        'year': year,
                        'semester': semester,
                        'exam_id': exam_id,
                        'center_id': center_id

                    },
                        function (data) {
                            //console.info(data);
                            $('#exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {
                                $('#prnt_load_repeat_student_data_report_btn').removeAttr('disabled');
                                for (j = 0; j < data.length; j++) {
                                    $('#rpt_exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);
                                    
                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs
                                        applied_subjects.push(data[j]['exam_mark'][z]['subject_id']);
                                        
                                        var mark = '';
                                        var rel_result_rpt = 0;
                                        
                                        if(data[j]['exam_mark'][z]['release_result'] == 1){
                                            var examData = searchArray(data[j]['exam_mark'][z]['subject_code'],data[j]['applied_subjects']);
                                            if (typeof examData == 'undefined' || examData == null){ // no data in exam mark table
                                                //mark = "INC"; 
                                                mark = "";
                                            } else if(examData['repeat_reject'] == '3') {
                                                mark = "NE"; 
                                            } else if(data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == 1){
                                                // if the student is absent
                                                if(examData['rpt_is_absent'] == '1'){
                                                    // deferment
                                                    if(examData['rpt_is_absent_approve'] == '1'){
                                                        if(examData['rpt_absent_deferement'] != '' || examData['rpt_absent_deferement'] != null ){
                                                            mark = 'DFR';
                                                        } else {
                                                            mark = 'AB';
                                                        }
                                                    } else {
                                                       mark = 'AB'; 
                                                    }
                                                } else {
                                                    mark = data[j]['exam_mark'][z]['result'];
                                                }
                                            //done only CA process
                                            } else if(data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1 && data[j]['exam_mark'][z]['is_director_mark_approved'] == 1 && data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == 0){
                                                 mark = "I(SE)";        
                                            // incomplete 
                                            } else {
                                               mark = "INC"; 
                                            }
                                            
                                        }
                                        else{
                                            rel_result_rpt = 1;
                                            mark = "Results not released.";
                                        }
                                        
                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = mark;
       
                                    }
                                    
                                    $('#rpt_exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="text-align:center; width:10%;">${applied_subjects.includes(e) ? '<span>' + subjects_marks[e] + '</span></a>' : " "}</td>`)
                                        .join(''))
                                        .appendTo($('#exam_marks_load_student'));
                                
                                if(data[j]['gpa'] == null){
                                    if(rel_result_rpt == 1){
                                        gpa = "Results not released."; 
                                    }
                                    else{
                                        gpa = "-";
                                    }
                                }
                                else{
                                    if(rel_result_rpt == 1){
                                       $('#student_gpa_rpt').show();
                                       $('#student_gpa_rpt').text("Results not released");
                                       gpa = "Results not released."; 
                                    }
                                    else{
                                        $('#student_gpa_rpt').show();
                                        $('#student_gpa_rpt').text("<?php echo $overallgpa?>");
                                        gpa = data[j]['gpa'];
                                    }
                                }

                                $('#rpt_exam_marks_tbl tr:last').append('<td align="center">'+gpa+'</td>').appendTo($('#exam_marks_load_student'));
                                        applied_subjects=[];
                                        subjects_marks=[];
                                }

                            } else {
                                $('#prnt_load_repeat_student_data_report_btn').attr('disabled', true);
                                
                                var numCols = $("#rpt_exam_marks_tbl").find('tr')[0].cells.length;
                                $('#exam_marks_load_student').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");

                            }
                            
                            $('.se-pre-con').fadeOut('slow');
                        },
                        "json"
                        );
                    },
                    "json"
                    );

        
        }


    }
    
    function prnt_load_repeat_student_data_report(){
        
//        var year = "";
        var batch_id    = $('#rpt_mark_batch').val();
        var course_id   = $('#rpt_mark_course').val();
        
        
        var year        = $('#rpt_mark_year').val();
        var semester    = $('#rpt_mark_semester').val();
        var exam_id     = $('#rpt_mark_exam').val();
        var center_id   = $('#rpt_prom_centre').val();
        
        window.open('<?php echo base_url("report/prnt_load_repeat_student_data_report") ?>?&cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id + '&yea=' + year + '&sem=' + semester + '&exm=' + exam_id);
    }
    
//////////////Second Tab End/////////


//////////////Third Tab Start////////
    function load_recorrection__course_list(center_id) {
        $('#req_recorrection_course').find('option').remove().end();
        $('#req_recorrection_course').append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('exam/load_course_list_recorrection') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#req_recorrection_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }
                <?php
                $access_level = $this->Util_model->check_access_level();
                $ug_level = $access_level[0]['ug_level']; 
                ?>
        
                <?php if($ug_level == 5){ ?>                
                    document.getElementById("req_recorrection_course").selectedIndex = "1";
                    get_batch_for_recorrection(($('#req_recorrection_course').val()));
                <?php } ?>
                },
                "json"
                );
    }
    
    function get_batch_for_recorrection(course_id) {
        $('#req_recorrection_batch').find('option').remove().end();
        $('#req_recorrection_batch').append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('exam/load_batches_recorrection') ?>", {'course_id': course_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#req_recorrection_batch').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']));
                    }
                <?php
                $access_level = $this->Util_model->check_access_level();
                $ug_level = $access_level[0]['ug_level']; 
                ?>
        
                <?php if($ug_level == 5){ ?>                
                    document.getElementById("req_recorrection_batch").selectedIndex = "1";
                    recorrection_load_year_data();
                <?php } ?>
                },
                "json"
                );
    }
    
    function load_semester_exam_recorrection() {
        $('#req_recorrection_exam').find('option').remove().end();
        $('#req_recorrection_exam').append('<option value="">---Select Exam---</option>').val('');
        
        var mrk_batch = $('#req_recorrection_batch').val();
        var mrk_course = $('#req_recorrection_course').val();
        var mrk_year = $('#recorrection_mark_year').val().split('-')[0].trim();
        var mrk_semester = $('#recorrection_mark_semester').val();

        $.post("<?php echo base_url('exam/load_semester_exam_recorrection_marks') ?>", {'mrk_batch': mrk_batch, 'mrk_course': mrk_course, 'mrk_year': mrk_year, 'mrk_semester': mrk_semester},
                function (data) {
                  //  console.log("exam=" + data);
                    for (var i = 0; i < data.length; i++) {
                        $('#req_recorrection_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code'] + " - " + data[i]['exam_name']));
                    }
                },
                "json"
                );
    }
    
    
    function recorrection_load_year_data() {
        $('#recorrection_mark_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');

        var course_id = $('#req_recorrection_course').val();

        //$.post("<?php //echo base_url('report/get_recorrection_years') ?>", {'course_id': course_id},
        $.post("<?php echo base_url('Student/load_year_list') ?>", {'selected_course_id': course_id},
            function (data) {
                if (data != null) {
                    var id = data['id'];
                    
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        $('#recorrection_mark_year').append($("<option></option>").attr("value", i + '-' + id).text(i+" Year"));
                    }
                }

            },
            "json"
        );
    }
    
    function recorrection_load_semesters(year_no) {
        
        $('#recorrection_mark_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        
        var sel_year = year_no.split('-')[0].trim();
        var sel_year_id = year_no.split('-')[1].trim();
        
        var course_id = $('#req_recorrection_course').val();
        $.post("<?php echo base_url('report/get_recorrection_semesters_marks') ?>", {'course_id': course_id, 'year_no': sel_year, 'year_id': sel_year_id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    for (var i = 1; i <= data['no_of_semester']; i++) {
                        $('#recorrection_mark_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                    }
                }
            },
            "json"
        );
    }
    
    function load_recorrection_student_data(){
        
        $('.se-pre-con').fadeIn('slow');
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var applied_subjects = [];
        var subjects_marks = {};
        var subjects_code = [];
        var sbj_stat_array = [];
        
        var name = "";
        var regNo = "";
        var stu_id = "";

        var btn_content = "";
        var btn_content2 = "";
        
        
        var center_id = $('#req_recorrection_centre').val();
        var course_id = $('#req_recorrection_course').val();
        var batch_id  = $('#req_recorrection_batch').val();
        var exam_id   = $('#req_recorrection_exam').val();
        var year   = $('#recorrection_mark_year').val().split('-')[0].trim();
        var semester   = $('#recorrection_mark_semester').val();
        
        if (batch_id == '' || course_id == '' || center_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all center, batch, course, and exam';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('report/load_semester_subjects_recorrection') ?>", {
                'batch_id': batch_id,
                'course_id': course_id,
                'year': year,
                'semester': semester
            },
            function(data){
              // console.log(data);
                for (var i = 0; i < data.length; i++) {
                    sem_subject_ids.push(data[i]['subj_id']);
                    sem_subject_code.push(data[i]['code']);
                    sem_subject_names.push(data[i]['subject']+"<br/>["+data[i]['code']+"]");// sem_subject_names.push(header_data[i]['subject']);
                }
                
                //create table heard
                $('#apply_recorrection_exam_tbl').DataTable().clear();
                $('#apply_recorrection_exam_tbl').find('tbody').empty();
                $('#apply_recorrection_exam_load_thead').find('tr').remove();
                //$('#apply_recorrection_exam_tbl').DataTable().rows().remove();
                $('#apply_recorrection_exam_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                $('#apply_recorrection_exam_tbl tr:last').append(sem_subject_names
                    .map(id => `<th style="width:10%;">${id}</th>`)
                    .join(''))
                    .appendTo($('#apply_recorrection_exam_load_thead'));
                $('#apply_recorrection_exam_tbl tr:last').append(`<th>SGPA</th>`).appendTo($('#apply_recorrection_exam_load_thead'));
                $.post("<?php echo base_url('report/load_recorrection_students') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'exam_id': exam_id,
                    'center_id':center_id,
                    'year':year,
                    'semester':semester
                },
                function(data){
                   // console.log(data);
                    
                    $('#apply_recorrection_exam_load_student').find('tr').remove();
                    if (data.length > 0) {
                        $('#prnt_load_recorrection_student_data_btn').removeAttr('disabled');
                        for (j = 0; j < data.length; j++) {
                            $('#apply_recorrection_exam_tbl').DataTable().row.add([
                                (j + 1),
                                data[j]['reg_no'],
                                data[j]['reg_no'],
                                data[j]['first_name']
                            ]).draw(false);
                            
                            console.log(data[j]['subjects']);
                            if(data[j]['subjects'].length > 0){
                                for (x = 0; x < data[j]['subjects'].length; x++) {
                                    applied_subjects.push(data[j]['subjects'][x]['subject_id']);
                                    var mark = '';
                                    var rel_result_rec = 0;
                                    
                                    if(data[j]['subjects'][x]['release_result'] == 1){
                                        mark = data[j]['subjects'][x]['result'];
                                    } else{
                                        rel_result_rec = 1;
                                        mark = "Results not released."; 
                                    }

                                    subjects_marks[data[j]['subjects'][x]['subject_id']] = mark;

                                    //console.log(data[j]['subjects'][x]['subject_id']);

                                    //console.log(subjects_marks);
                                    //console.log(sem_subject_ids);


                                }
                            }
                            
                            if(data[j]['gpa'] == null){
                                if(rel_result_rec == 1){
                                    gpa = "Results not released."; 
                                }
                                else{
                                    gpa = "-";
                                }
                            }
                            else{
                                if(rel_result_rec == 1){
                                   $('#student_gpa_rec').show();
                                   $('#student_gpa_rec').text("Results not released");
                                   gpa = "Results not released."; 
                                }
                                else{
                                    $('#student_gpa_rec').show();
                                    $('#student_gpa_rec').text("<?php echo $overallgpa?>");
                                    gpa = data[j]['gpa'];
                                }
                            }
                            
                            console.log("sem_subject_ids = "+sem_subject_ids);
                            console.log("applied_subjects = "+applied_subjects);
                                                                    
                            $('#apply_recorrection_exam_tbl tr:last').append(sem_subject_ids
                                .map(e => `<td style="text-align:center; width:10%;">${applied_subjects.includes(e) ? '<span>' + subjects_marks[e] + '</span></a>' : " "}</td>`)
                                .join(''))
                                .appendTo($('#apply_recorrection_exam_load_student'));
                                
                                $('#apply_recorrection_exam_tbl tr:last').append('<td align="center">'+gpa+'</td>').appendTo($('#apply_recorrection_exam_load_student'));
                                applied_subjects=[];
                                subjects_marks=[];
                        }
                    }else{
                        $('#prnt_load_recorrection_student_data_btn').attr('disabled', 'disabled');
                        
                        var numCols2 = $("#apply_recorrection_exam_tbl").find('tr')[0].cells.length;
                        $('#apply_recorrection_exam_load_student').append("<tr><td colspan='"+numCols2+"' align='center' >No records to show.</td></tr>");
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
            );
            },
            "json"
           );
        
        }
        
        
        
        
    }
    
    function prnt_load_recorrection_student_data(){
        var center_id = $('#req_recorrection_centre').val();
        var course_id = $('#req_recorrection_course').val();
        var batch_id  = $('#req_recorrection_batch').val();
        var exam_id   = $('#req_recorrection_exam').val();
        var year   = $('#recorrection_mark_year').val();
        var semester   = $('#recorrection_mark_semester').val();

        window.open('<?php echo base_url("report/prnt_load_recorrection_student_data") ?>?&cen=' + center_id + '&cou=' + course_id + '&bat=' + batch_id + '&exm=' + exam_id + '&yr=' + year + '&sem=' + semester);
    
    }
    
    
    //Student Full Marks Report
    function load_full_result_course_list(center_id){
        $('#full_course').find('option').remove().end();
        $('#full_course').append('<option value="">---Select Course---</option>').val('');
        
        $('#full_batch').find('option').remove().end();
        $('#full_batch').append('<option value="">---Select Course---</option>').val('');
        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
        function (data)
        {
            for (var i = 0; i < data.length; i++)
            {
                $('#full_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
            }
            
                                <?php
                                $access_level = $this->Util_model->check_access_level();
                                $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>                
                                document.getElementById("full_course").selectedIndex = "1";
                                get_full_result_batch_list(($('#full_course').val()));
                                <?php } ?>

        },
        "json"
        );
    }
    

    function get_full_result_batch_list(course_id){
        $('#full_batch').find('option').remove().end();
        $('#full_batch').append('<option value="">---Select Course---</option>').val('');
        $.post("<?php echo base_url('report/load_batches_full_results') ?>", {'course_id': course_id},
        function (data) {
            for (var i = 0; i < data.length; i++) {
                $('#full_batch').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']));
            }
                                <?php
                                $access_level = $this->Util_model->check_access_level();
                                $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>                
                                document.getElementById("full_batch").selectedIndex = "1";
                                <?php } ?>
        },
        "json"
        );
    }
    
    
    
    function load_student_data_full_result(){
        
        $('.se-pre-con').fadeIn('slow');
        
        var center_id = $('#full_center').val();
        var course_id = $('#full_course').val();
        var batch_id  = $('#full_batch').val();
        
        $.post("<?php echo base_url('report/load_student_data_full_results') ?>", {'center_id': center_id, 'course_id':course_id, 'batch_id':batch_id},
        function (data) {           
            $('#full_exam_results_tbl').DataTable().destroy();
            $('#full_exam_results_tbl').DataTable({
                'ordering': false,
                'searching': false,
                'paging': false,
                "columnDefs": [
                {
                    "targets": [0,3],
                    "className": 'text-center'               
                }]
            });
            $('#full_exam_results_tbl').DataTable().clear().draw();
            
            
            if(data.length > 0){
                var y = 1;
                for (var x = 0; x < data.length; x++) {
                    
                    var view_btn = '<button data-toggle="tooltip" title="View" id="view_full_marks" name="view_full_marks" class="btn btn-warning btn-xs" onclick="event.preventDefault();view_full_results_info('+data[x]['stu_id']+');"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>';
                    
                    var print_btn = '<button data-toggle="tooltip" title="Print" id="print_full_marks" name="print_full_marks" class="btn btn-success btn-xs" onclick="event.preventDefault();print_stu_full_results('+data[x]['stu_id']+');"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>';
                    
                    var action_content = view_btn+" | "+print_btn;
                    
                    $('#full_exam_results_tbl').DataTable().row.add([ 
                        y,
                        data[x]['reg_no'],
                        data[x]['first_name'],
                        action_content
                    ]).draw(false); 
                    
                    y++;
                }
            }
            
            $('.se-pre-con').fadeOut('slow');
        },
        "json"
        );
    }
    
    
    function view_full_results_info(stu_id){
        
        $('#view_full_results_tbl').DataTable().destroy();
        $('#view_full_results_tbl').DataTable({
            'ordering': false,
            'searching': false,
            'paging': false,
            'info': false,
            "columnDefs": [{
                "targets": [0],
                "visible":false
            },
            {
                "targets": 2,
                "className": 'text-center'               
            }],
            "createdRow": function( row, data, dataIndex ) {
                if (data[0] == 1) {        
                    $( row ).css( "background-color", "#D7D7D7" );        	        	
                }
            }
        });
        $('#view_full_results_tbl').DataTable().clear().draw();
        
        $.post("<?php echo base_url('report/load_student_full_results_list') ?>", {'stu_id':stu_id},
            function (data) {
                $('#fullMrkModal').modal('show');

                var prevId = "";
                var yearId = "";
                var semId = "";
                var prevSemId = "";
                var sgpa = "";
                var cgpa = "";

                for (var i = 0; i < data['mark_details'].length; i++) { 

                    yearId = data['mark_details'][i]['year'];
                    semId = data['mark_details'][i]['semester'];
                    
                    //sgpa
                    sgpa = data['mark_details'][i]['stu_data']['gpa'];
                    
                    if(sgpa == null){
                        sgpa = "  --";
                    }else if(sgpa == ""){
                        sgpa = "  --";
                    }
                    else{
                        sgpa = data['mark_details'][i]['stu_data']['gpa'];
                    }
                    
//                    //cgpa
//                    cgpa = data[i]['stu_data']['cgpa'];
//                    
//                    if(cgpa == null){
//                        cgpa = "  --";
//                    }else if(cgpa == ""){
//                        cgpa = "  --";
//                    }
//                    else{
//                        cgpa = data[i]['stu_data']['cgpa'];
//                    }
//                    
//                    $('#cumulativegpa').text("Overall GPA-: "+cgpa);
                    
//                    $('#view_full_results_tbl').DataTable().row.add([ 
//                        '1',
//                        "<b>Cumulative GPA -: "+cgpa+"</b>",
//                        ''
//                    ]).draw(false);  
                    

                    if(i > 0){
                        prevId = data['mark_details'][i-1]['year'];
                        prevSemId = data['mark_details'][i-1]['semester'];
                    }

                    if(data['mark_details'][i]['stu_data']['exam_mark'].length > 0){
                        if(yearId != prevId){
                            $('#view_full_results_tbl').DataTable().row.add([ 
                                '1',
                                "<b>"+yearId+" Year - "+semId+" Semester</b>",
                                "<b>SGPA -: "+sgpa+"</b>"
                            ]).draw(false);  
                        }
                        else{
                           if(semId != prevSemId){
                                $('#view_full_results_tbl').DataTable().row.add([ 
                                    '1',
                                    "<b>"+yearId+" Year - "+semId+" Semester</b>",
                                    "<b>SGPA -: "+sgpa+"</b>"
                                ]).draw(false);  
                            } 
                        }
                    }
                    
                    for (var t = 0; t < data['mark_details'][i]['stu_data']['exam_mark'].length; t++) {
                        
                        var result = '';
                        if(data['mark_details'][i]['stu_data']['exam_mark'][t]['release_result'] == 0){
                            result = "Results not released.";
                        }
                        else{
                            result = data['mark_details'][i]['stu_data']['exam_mark'][t]['result'];
                        }
                        
                        //cgpa
                        cgpa = data['mark_details'][i]['stu_data']['cgpa'];

                        if(cgpa == null){
                            cgpa = "  --";
                        }else if(cgpa == ""){
                            cgpa = "  --";
                        }
                        else{
                            cgpa = data['mark_details'][i]['stu_data']['cgpa'];
                        }

                        $('#cumulativegpa').text("Overall GPA-: "+cgpa);
                        $('#stu_reg_no').text("Student Reg.No:  "+data['stu_details'][0]['reg_no']).css("font-weight","Bold");
                        $('#stu_name').text("Student Name:  "+data['stu_details'][0]['first_name']).css("font-weight","Bold");
                        $('#stu_course').text("Course:  "+data['stu_details'][0]['course_name']).css("font-weight","Bold");
                        
                        $('#view_full_results_tbl').DataTable().row.add([
                            '0',
                            "["+data['mark_details'][i]['stu_data']['exam_mark'][t]['subject_code']+"] - "+data['mark_details'][i]['stu_data']['exam_mark'][t]['subject'],
                            result
                        ]).draw(false);  
                    }
                }
            },
            "json"
        );
    }
 
 
    function print_stu_full_results(stu_id){
        
        var course = $('#full_center').val();
        var center = $('#full_course').val();
        var batch = $('#full_batch').val();
        
        window.open('<?php echo base_url("report/print_stu_full_results") ?>?&stu=' + stu_id + '&cou=' + course + '&cen=' + center + '&bat=' + batch);
    }
    
    
</script>
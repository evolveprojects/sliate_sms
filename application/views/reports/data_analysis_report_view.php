<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Jquery File Uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput-rtl.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/morris.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/purify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/fileinput.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/xepOnline.jqPlugin.js') ?>"></script>

<script src="<?php echo base_url('assets/raphael.min.js') ?>"></script>
<script src="<?php echo base_url('assets/morris.min.js') ?>"></script>

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Data Analysis Report</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-users"></i>Data Analysis Report</li>
        </ol>
    </div>
</div>



<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a class="fa fa-university" href="#sem_analysis_report" aria-controls="sem_analysis_report" role="tab" data-toggle="tab"> Semester Analysis Report</a></li>
    <li role="presentation"><a class="fa fa-university" href="#subject_wise_analysis" aria-controls="subject_wise_analysis" role="tab" data-toggle="tab"> Subject Wise Semester Analysis Report</a></li>
</ul>

<div class="tab-content ">
    <div role="tabpanel" class="tab-pane active" id="sem_analysis_report">
        <div class="panel">
            <div class="panel-heading">
                Semester Data Analysis
            </div>
            <br/>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <!--                        <div class="form-group col-md-4">
                                                    <div class="form-group">
                                                        <label for="center" class="col-md-3 control-label">Center : </label>
                                                        <div class="col-md-9">
                        <?php
                        global $branchdrop;
                        global $selectedbr;
                        //$extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);"';
                        //echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                        ?>
                                                            <select class="form-control" id="analysis_l_center" name="analysis_l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="analysis_sem_load_course_list(this.value, 1, null);">
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
                                                </div>-->
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_l_Dcode" name="analysis_l_Dcode" onchange="analysis_get_course_year(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                        <?php
                                        foreach ($courses as $row):
                                            ?>
                                            <option value="<?php echo $row['course_id']; ?>">
                                                <?php echo $row['course_code'] . " - " . $row['course_name']; ?>
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
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_l_Bcode" name="analysis_l_Bcode" onchange="" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_l_no_year" name="analysis_l_no_year" onchange="analysis_load_semesters(this.value, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Year---</option>
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
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_l_no_semester" name="analysis_l_no_semester" onchange="analysis_load_semester_exam();" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Exam</label>
                                <div class="col-md-7">
                                    <select id="analysis_exam" class="form-control" style="width:100%" name="analysis_exam"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value="">---Select Exam---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Attempt</label>
                                <div class="col-md-7">
                                    <select id="analysis_attempt" class="form-control" style="width:100%" name="analysis_attempt"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value="">---Select Attempt---</option>
                                        <option value="1">1 Attempt</option>
                                        <option value="2">2 Attempt</option>
                                        <option value="3">3 Attempt</option>
                                        <option value="4">4 Attempt</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                </div><br>
                <div class="row">
                    <!--                    <div class="col-md-6" style="margin-left: 125px;">-->
                    <div class="col-md" style="margin-left: 100px;">
                        <input type="radio" name="time" class="col-md-1" id="full_time" value="1" checked="checked">
                        <label class="col-md-1 control-label">Full Time</label>

                        <input type="radio" name="time" class="col-md-1" id="part_time" value="2">
                        <label class="col-md control-label">Part Time</label>
                    </div>
                    <!--</div>-->
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" id="analysis_load_student_data_btn" name="analysis_load_student_data_btn" onclick="analysis_load_student_data()">Search Students</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-md" id="analysis_print_students_btn" name="analysis_print_students_btn" onclick="analysis_print_load_student_data();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>
                <br>
                <br>

                <div style="overflow-x:auto;">
                    <table class="table table-bordered analysis_exam_marks_tbl" id="analysis_exam_marks_tbl">
                        <thead id="analysis_load_thead">
                            <tr>
                                <th>Institute</th>
                                <th>Full Time/ Part Time</th>
                                <th>No of Total Applicants</th>
                                <th>Sat for the exam</th>
                                <th>Passed All Subjects</th>
                                <th>In-completed</th>
                                <th>All AB+NE</th>
                                <th>Pass Rate %</th>
                            </tr>
                        </thead>
                        <tbody id="analysis_load_student" style="align:center;">
                        <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th></th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                            </tr>
                        </tfoot>
                    </table> 
                </div>

                <div style="overflow-x:auto;">
                    <div class="col-md-offset-9 col-md-12" id="chart1_div" style="display: none">
                        <br/><button type="button" class="btn btn-info btn-md" id="chart1" onclick="print_charts_summary();">Export As PDF</button>
                    </div>
                    <div class="col-md-12">
                        <br/><div id="chart">
                        </div><br/>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <div class="col-md-offset-9 col-md-12" id="chart2_div" style="display: none">
                        <br/><button type="button" class="btn btn-info btn-md" id="chart2" onclick="print_charts_pass_rate();">Export As PDF</button>
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <div id="chartPassRate"></div><br/>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <div role="tabpanel" class="tab-pane " id="subject_wise_analysis">
        <div class="panel">
            <div class="panel-heading">
                Subject Wise Analysis
            </div>
            <br/>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <!--                        <div class="form-group col-md-4">
                                                    <div class="form-group">
                                                        <label for="center" class="col-md-3 control-label">Center : </label>
                                                        <div class="col-md-9">
                        <?php
                        global $branchdrop;
                        global $selectedbr;
                        //$extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);"';
                        //echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                        ?>
                                                            <select class="form-control" id="analysis_sub_l_center" name="analysis_sub_l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="analysis_sub_sem_load_course_list(this.value, 1, null);">
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
                                                </div>-->
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_sub_l_Dcode" name="analysis_sub_l_Dcode" onchange="analysis_sub_get_course_year(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                        <?php
                                        foreach ($courses as $row):
                                            ?>
                                            <option value="<?php echo $row['course_id']; ?>">
                                                <?php echo $row['course_code'] . " - " . $row['course_name']; ?>
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
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_sub_l_Bcode" name="analysis_sub_l_Bcode" onchange="" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_sub_l_no_year" name="analysis_sub_l_no_year" onchange="analysis_sub_load_semesters(this.value, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Year---</option>
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
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="analysis_sub_l_no_semester" name="analysis_sub_l_no_semester" onchange="analysis_sub_load_semester_exam()" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Exam</label>
                                <div class="col-md-7">
                                    <select id="analysis_sub_exam" class="form-control" style="width:100%" name="analysis_sub_exam"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value="">---Select Exam---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exam" class="col-md-3 control-label">Attempts</label>
                                <div class="col-md-7">
                                    <select id="analysis_sub_attempt" class="form-control" style="width:100%" name="analysis_sub_attempt"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value="0">---Select Attempt---</option>
                                        <option value="1">1 Attempt</option>
                                        <option value="2">2 Attempt</option>
                                        <option value="3">3 Attempt</option>
                                        <option value="4">4 Attempt</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="analysis_sub_wise_search();">Search Students</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-md" id="print_analysis_sub_wise" name="print_analysis_sub_wise" onclick="print_analysis_sub_wise_data_load();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-md" style="margin-left: 100px;">
                        <input type="radio" name="category" class="col-md-1" id="subj_wise_details" value="1" checked="checked" onchange="subj_wise_radio_click(this.value);">
                        <label class="col-md-1 control-label">Subject wise Details</label>

                        <input type="radio" name="category" class="col-md-1" id="students_vs_subjects" value="2" onchange="subj_wise_radio_click(this.value);">
                        <label class="col-md-1 control-label">No of Students VS Subjects</label>

                        <input type="radio" name="category" class="col-md-1" id="precent_vs_subjects" value="3" onchange="subj_wise_radio_click(this.value);">
                        <label class="col-md-1 control-label">Percentage VS Subjects</label>

                        <input type="radio" name="category" class="col-md-1" id="subj_wise_pass_rate" value="4" onchange="subj_wise_radio_click(this.value);">
                        <label class="col-md-1 control-label">Individual Subject wise Pass Rate</label>
                    </div>
                    <!--</div>-->
                </div>
                <br>
                <br>

                <div style="overflow-x:auto;" id="subj_wise_details_table">
                    <table class="table table-bordered" id="analysis_subj_wise_tbl" style="width: 100%;">
                        <thead id="analysis_subj_wise_load_thead">
                            <tr>
                                <th></th>
                                <th>Institute</th>
                                <th>No:of Applicant</th>
                                <th>No:of Student sat for the Examination</th>
                                <th>Pass</th>
                                <th>Fail</th>
                                <th>Absent</th>
                                <th>% Pass</th>
                            </tr>
                        </thead>
                        <tbody id="analysis_subj_wise_load_student">
                        <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                        </tbody>
                    </table> 
                </div>

                <div style="overflow-x:auto;" id="student_vs_subj_table">
                    <table class="table table-bordered" id="student_vs_subj_tbl">
                        <thead id="student_vs_subj_load_thead">
                            <tr>
                                <th>Subject</th>
                                <th>Total Applicant</th>
                                <th>Sat for the Exam</th>
                                <th>Passed</th>
                                <th>Failed</th>
                                <th>Absentees</th>
                                <th>Pass Rate %</th>
                            </tr>
                        </thead>
                        <tbody id="student_vs_subj_load_student">
                        <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                        </tbody>
                    </table> 
                </div>


                <div style="overflow-x:auto;" id="student_vs_subj_chart">
                    <div class="col-md-offset-9 col-md-12" id="chartsubj1_div" style="display: none">
                        <br/><button type="button" class="btn btn-info btn-md" id="print_chart1" onclick="print_student_vs_subj_charts_summary();">Export As PDF</button>
                    </div>
                    <div class="col-md-12">
                        <br/><div id="chartsubj1">
                        </div><br/>
                    </div>
                </div>



                <div style="overflow-x:auto;" id="percent_vs_subj_table">
                    <table class="table table-bordered" id="percent_vs_subj_tbl">
                        <thead id="percent_vs_subj_load_thead">
                            <tr>
                                <th>Subject</th>
                                <th>Pass Rate</th>
                            </tr>
                        </thead>
                        <tbody id="percent_vs_subj_load_student">
                        <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                        </tbody>
                    </table> 
                </div>

                <div style="overflow-x:auto;" id="percent_vs_subj_chart">
                    <div class="col-md-offset-9 col-md-12" id="chartsubj2_div" style="display: none">
                        <br/><button type="button" class="btn btn-info btn-md" id="print_chart2" onclick="print_percent_vs_subj_charts_summary();">Export As PDF</button>
                    </div>
                    <div class="col-md-12">
                        <br/><div id="chartsubj2">
                        </div><br/>
                    </div>
                </div>

                <div id="subj_vs_pass_rate_table">
                    <br>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="analysis_subject" class="col-md-3 control-label">Subject</label>
                            <div class="col-md-7">
                                <select id="analysis_subject" class="form-control" style="width:100%" name="analysis_subject"
                                        data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty" onchange="individual_subject_pass_rate_load(this.value);">
                                    <option value="0">---Select Subject---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div style="overflow-x:auto;" class="col-md-12">
                        <table class="table table-bordered" id="subj_vs_pass_rate_tbl">
                            <thead id="subj_vs_pass_rate_load_thead">
                                <tr>
                                    <th>Institute</th>
                                    <th>% Pass</th>
                                </tr>
                            </thead>
                            <tbody id="subj_vs_pass_rate_load_student">
                            <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                            </tbody>
                        </table> 
                    </div>
                </div>

                <div id="subj_vs_pass_rate_chart">
                    <div style="overflow-x:auto;" id="subj_vs_pass_rate_chart">
                        <div class="col-md-offset-9 col-md-12" id="chartsubj3_div" style="display: none">
                            <br/><button type="button" class="btn btn-info btn-md" id="print_chart3" onclick="individual_subject_pass_rate_charts_summary();">Export As PDF</button>
                        </div>
                        <div class="col-md-12">
                            <br/><div id="chartsubj3">
                            </div><br/>
                        </div>
                    </div>

                    <div style="overflow-x:auto;" id="subj_vs_pass_rate_chart_line">
                        <div class="col-md-offset-9 col-md-12" id="chartsubj4_div" style="display: none">
                            <br/><button type="button" class="btn btn-info btn-md" id="print_chart4" onclick="individual_subject_pass_rate_line_charts_summary();">Export As PDF</button>
                        </div>
                        <div class="col-md-12">
                            <br/><div id="chartsubj4">
                            </div><br/>
                        </div>
                    </div>
                </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>

<script type="text/javascript">
                                var loadedData = [];
                                $(document).ready(function () {
                                $('#analysis_exam_marks_tbl').DataTable({
                                //        'ordering': true,
                                //        'paging': false
                                });
                                $('#exam_sub_tbl').DataTable();
                                $('#analysis_print_students_btn').prop('disabled', true);
                                $('#analysis_subj_wise_tbl').DataTable({
                                'ordering': false,
                                        'paging': false,
                                        'searching': false
                                });
                                $('#print_analysis_sub_wise').attr('disabled', true);
                                subj_wise_radio_click(1);
                                //----------------START - No of students VS subjects---------------

                                $('#student_vs_subj_tbl').DataTable({
                                'ordering': false,
                                        'paging': false,
                                        'searching': false
                                });
                                //----------------END - No of students VS subjects---------------

                                //----------------START - Percentage VS Subject---------------

                                $('#percent_vs_subj_tbl').DataTable({
                                'ordering': false,
                                        'paging': false,
                                        'searching': false
                                });
                                //----------------END - Percentage VS Subject---------------

                                //----------------START - Individual Subject wise Pass Rate---------------

                                $('#subj_vs_pass_rate_tbl').DataTable({
                                'ordering': false,
                                        'paging': false,
                                        'searching': false
                                });
                                //----------------END - Individual Subject wise Pass Rate---------------

                                });
                                function analysis_sem_load_course_list(center_id, status, edit_course) {
                                if (status == 1) {
                                $('#analysis_l_Dcode').find('option').remove().end();
                                $('#analysis_l_Dcode').append('<option value="">---Select Course---</option>').val('');
                                $.post("<?php echo base_url('Report/analysis_load_subject_selection_course_list') ?>", {'center_id': center_id},
                                        function (data)
                                        {
                                        for (var i = 0; i < data.length; i++)
                                        {
                                        $('#analysis_l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
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

                                function analysis_get_course_year(id, flag, year_no, batch_id, lookup_flag) {
                                $('#load_Dname').val(id);
                                $('#analysis_l_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
                                $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                                $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                $('#analysis_l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
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
                                        $('#analysis_l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_l_no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                        }
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_l_no_year').append($("<option></option>").text(i + " Year"));
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
                                        $('#analysis_l_no_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_l_no_year').append($("<option></option>").text(current_year + " Year"));
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
                                                $('#analysis_l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                                $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                } else {
                                                if (lookup_flag) {
                                                $('#analysis_l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                                }
                                                } else {
                                                if (lookup_flag) {
                                                $('#analysis_l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
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

                                function analysis_load_semester_exam() {

                                var analys_course_id = $('#analysis_l_Dcode').val();
                                var batch_id = $('#analysis_l_Bcode').val();
                                var analys_year = $('#analysis_l_no_year').val();
                                var analys_semester = $('#analysis_l_no_semester').val();
                                $('#analysis_exam').find('option').remove().end().append('<option value="">---Select Exam---</option>').val('');
                                $.post("<?php echo base_url('Report/analysis_load_semester_exam') ?>", {'batch_id': batch_id, 'analys_course_id': analys_course_id, 'analys_year': analys_year, 'analys_semester': analys_semester},
                                        function (data) {
                                        for (var i = 0; i < data.length; i++) {

                                        $('#analysis_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code'] + " - " + data[i]['exam_name']));
                                        }
                                        },
                                        "json"
                                        );
                                }

                                function analysis_load_semesters(year_no, semester_no, lookup_flag) {
                                $('#analysis_l_no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                                $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                                if (lookup_flag) {
                                var course_id = $('#analysis_l_Dcode').val();
                                } else {
                                var course_id = $('#load_Dcode').val();
                                }
                                if (course_id == '' || course_id == null) {
                                var course_id = $('#course').val();
                                }
                                $.post("<?php echo base_url('Report/analysis_load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
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
                                        $('#analysis_l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                                        }
                                        }
                                        } else {
                                        var current_semester = data['current_semester'];
                                        if (lookup_flag) {
                                        $('#analysis_l_no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester + " Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester + " Semester"));
                                        }
                                        }
                                        }
                                        },
                                        "json"
                                        );
                                }

                                function analysis_load_student_data() {
                                $('.se-pre-con').fadeIn('slow');
                                $('#chart').empty();
                                $('#chartPassRate').empty();
                                $('#analysis_print_students_btn').attr('disabled', true);
                                var res = [];
                                var sem_subject_ids = [];
                                var sem_subject_names = [];
                                var sem_subject_code = [];
                                var sem_subject_types = [];
                                var applied_subjects = [];
                                var subjects_marks = {};
                                var subjects_code = [];
                                //var center_id = $('#l_center').val();
                                var course_id = $('#analysis_l_Dcode').val();
                                var batch_id = $('#analysis_l_Bcode').val();
                                var year = $('#analysis_l_no_year').val();
                                var semester = $('#analysis_l_no_semester').val();
                                var exam_id = $('#analysis_exam').val();
                                var analysis_attempt = $('#analysis_attempt').val();
                                var time = $('input[name=time]:checked').val();
                                var exam_name = $('#analysis_exam').text().replace("---Select Exam---", "");
                                if (batch_id == '' || course_id == '' || year == '' || semester == '' || exam_id == '') {
                                res['status'] = 'denied';
                                res['message'] = 'Please Select all batch, course, year, semester and exam to search';
                                result_notification(res);
                                $('.se-pre-con').fadeOut('slow');
                                } else {
//                                        $('#analysis_exam_marks_tbl').DataTable().destroy();
//                                        $('#analysis_exam_marks_tbl').DataTable().clear().draw();
//                                        $('#analysis_load_thead').find('tr').remove();


                                $.post("<?php echo base_url('Report/analysis_student_mark_details') ?>", {
                                'batch_id': batch_id,
                                        'course_id': course_id,
                                        'year': year,
                                        'semester': semester,
                                        'exam_id': exam_id,
                                        'analysis_attempt': analysis_attempt,
                                        'time': time
                                },
                                        function (data) {
                                        //console.log(data);
                                        if (data == 'denied')
                                        {
                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                        result_notification(funcres);
                                        } else {
                                        $('#analysis_exam_marks_tbl').DataTable().destroy();
                                        $('#analysis_exam_marks_tbl').DataTable({
                                        'ordering': true,
                                                'paging': false,
                                                'columnDefs': [{
                                                "targets": 2,
                                                        "className": "text-center"
                                                }, {
                                                "targets": 3,
                                                        "className": "text-center"
                                                }, {
                                                "targets": 4,
                                                        "className": "text-center"
                                                }, {
                                                "targets": 5,
                                                        "className": "text-center"
                                                }, {
                                                "targets": 6,
                                                        "className": "text-center"
                                                }, {
                                                "targets": 7,
                                                        "className": "text-center"
                                                }],
                                                'footerCallback': function (row, data, start, end, display){
                                                var api = this.api(), data;
                                                // Remove the formatting to get integer data for summation
                                                var intVal = function (i) {
                                                return typeof i === 'string' ?
                                                        i.replace(/[\$,]/g, '') * 1 :
                                                        typeof i === 'number' ?
                                                        i : 0;
                                                };
                                                // Total over all pages
                                                total_2 = api
                                                        .column(2)
                                                        .data()
                                                        .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                        }, 0);
                                                total_3 = api
                                                        .column(3)
                                                        .data()
                                                        .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                        }, 0);
                                                total_4 = api
                                                        .column(4)
                                                        .data()
                                                        .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                        }, 0);
                                                total_5 = api
                                                        .column(5)
                                                        .data()
                                                        .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                        }, 0);
                                                total_6 = api
                                                        .column(6)
                                                        .data()
                                                        .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                        }, 0);
                                                total_7 = api
                                                        .column(7)
                                                        .data()
                                                        .reduce(function (a, b) {
                                                        return intVal(a) + intVal(b);
                                                        }, 0);
                                                $(api.column(0).footer()).html(
                                                        'Grand Total'
                                                        );
                                                $(api.column(1).footer()).html(
                                                        ' '
                                                        );
                                                $(api.column(2).footer()).html(
                                                        total_2
                                                        );
                                                $(api.column(3).footer()).html(
                                                        total_3
                                                        );
                                                $(api.column(4).footer()).html(
                                                        total_4
                                                        );
                                                $(api.column(5).footer()).html(
                                                        total_5
                                                        );
                                                $(api.column(6).footer()).html(
                                                        total_6
                                                        );
                                                $(api.column(7).footer()).html(
                                                        total_7
                                                        );
                                                }
                                        });
                                        $('#analysis_exam_marks_tbl').DataTable().clear();
//                                                    $('#analysis_exam_marks_tbl').DataTable().clear().draw();
                                        //$('#analysis_exam_marks_tbl').DataTable().clear();



                                        if (data.length > 0) {
                                        $('#analysis_print_students_btn').prop('disabled', false);
                                        $('#analysis_print_students_btn').attr('disabled', false);
//                                                        $('#print_students_semester_subject_btn').removeAttr('disabled');
                                        var chart_data = [];
                                        var pass_rate_data = [];
                                        for (j = 0; j < data.length; j++) {

                                        if (data[j]['course_type'] == 'F') {
                                        var time_type = "Full Time";
                                        } else {
                                        var time_type = "Part Time";
                                        }

                                        $('#analysis_exam_marks_tbl').DataTable().row.add([
                                                data[j]['br_name'],
                                                time_type,
                                                data[j]['stu_count'],
                                                data[j]['sat_exam'],
                                                data[j]['pass_count'],
                                                data[j]['inc_count'],
                                                data[j]['ab_ne_count'],
                                                data[j]['pass_rate_round']
                                        ]).draw(false);
                                        chart_data [j] = { Center: data[j]['br_name'], Pass: data[j]['pass_count'], Fail:data[j]['inc_count'], ABNE: data[j]['ab_ne_count']};
                                        pass_rate_data[j] = {PassRate:data[j]['pass_rate_round'], Center: data[j]['br_name'] };
                                        }

                                        $('#chart1_div').show();
                                        $('#chart2_div').show();
                                        Morris.Bar({
                                        barGap:2,
                                                barSizeRatio:0.55,
                                                element: 'chart',
                                                data: chart_data,
                                                xkey: 'Center',
                                                horizontal: true,
                                                ykeys:['Pass', 'Fail', 'ABNE'],
                                                labels: ['Pass', 'Fail', 'AB&NE'],
                                                hideHover:'auto',
                                                stacked:true,
                                                xLabelAngle: 80
                                        });
                                        Morris.Bar({
                                        barGap:2,
                                                barSizeRatio:0.55,
                                                element: 'chartPassRate',
                                                data: pass_rate_data,
                                                xkey: 'Center',
                                                ykeys: ['PassRate'],
                                                labels: ['Pass Rate'],
                                                horizontal: true,
                                                xLabelAngle: 80
                                        });
                                        } else {
                                        $('#print_students_semester_subject_btn').attr('disabled', 'disabled');
                                        $('#analysis_print_students_btn').attr('disabled', true);
                                        }
                                        }
                                        $('.se-pre-con').fadeOut('slow');
                                        },
                                        "json"
                                        );
                                }
                                }

                                function analysis_print_load_student_data() {
                                var course_id = $('#analysis_l_Dcode').val();
                                var batch_id = $('#analysis_l_Bcode').val();
                                var year = $('#analysis_l_no_year').val();
                                var semester = $('#analysis_l_no_semester').val();
                                var exam_id = $('#analysis_exam').val();
                                var analysis_attempt = $('#analysis_attempt').val();
                                var time = $('input[name=time]:checked').val();
                                window.open('<?php echo base_url("report/analysis_print_load_student_data") ?>?&cou=' + course_id + '&bat=' + batch_id + '&yea=' + year + '&sem=' + semester + '&exm=' + exam_id + '&analy_att=' + analysis_attempt + '&time=' + time);
                                }




/////////////////////////////////////////////////////////////////// SUBJECT WISE ANALYSIS ///////////////////////////////////////////////////////////////////

                                function analysis_sub_get_course_year(id, flag, year_no, batch_id, lookup_flag) {
                                $('#load_Dname').val(id);
                                $('#analysis_sub_l_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
                                $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                                $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                                $('#analysis_sub_l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
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
                                        $('#analysis_sub_l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_sub_l_no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                        }
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_sub_l_no_year').append($("<option></option>").text(i + " Year"));
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
                                        $('#analysis_sub_l_no_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year + " Year"));
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_sub_l_no_year').append($("<option></option>").text(current_year + " Year"));
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
                                                $('#analysis_sub_l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                                $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                } else {
                                                if (lookup_flag) {
                                                $('#analysis_sub_l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                                }
                                                } else {
                                                if (lookup_flag) {
                                                $('#analysis_sub_l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
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

                                function analysis_sub_load_semester_exam() {

                                var analys_course_id = $('#analysis_sub_l_Dcode').val();
                                var batch_id = $('#analysis_sub_l_Bcode').val();
                                var analys_year = $('#analysis_sub_l_no_year').val();
                                var analys_semester = $('#analysis_sub_l_no_semester').val();
                                $('#analysis_sub_exam').find('option').remove().end().append('<option value="">---Select Exam---</option>').val('');
                                $.post("<?php echo base_url('Report/analysis_load_semester_exam') ?>", {'batch_id': batch_id, 'analys_course_id': analys_course_id, 'analys_year': analys_year, 'analys_semester': analys_semester},
                                        function (data) {
                                        for (var i = 0; i < data.length; i++) {

                                        $('#analysis_sub_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code'] + " - " + data[i]['exam_name']));
                                        }
                                        },
                                        "json"
                                        );
                                }

                                function analysis_sub_load_semesters(year_no, semester_no, lookup_flag) {
                                $('#analysis_sub_l_no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                                $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                                if (lookup_flag) {
                                var course_id = $('#analysis_sub_l_Dcode').val();
                                } else {
                                var course_id = $('#load_Dcode').val();
                                }
                                if (course_id == '' || course_id == null) {
                                var course_id = $('#course').val();
                                }
                                $.post("<?php echo base_url('Report/analysis_load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
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
                                        $('#analysis_sub_l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                                        } else {
                                        if (lookup_flag) {
                                        $('#analysis_sub_l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                                        }
                                        }
                                        } else {
                                        var current_semester = data['current_semester'];
                                        if (lookup_flag) {
                                        $('#analysis_sub_l_no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester + " Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester + " Semester"));
                                        }
                                        }
                                        }
                                        },
                                        "json"
                                        );
                                }

                                function analysis_sub_wise_search() {
                                $('.se-pre-con').fadeIn('slow');
                                $('#chartsubj1').empty();
                                $('#chartsubj2').empty();
                                $('#chartsubj3').empty();
                                $('#chartsubj4').empty();
                                var subj_key_id = 0;
                                var sta_exam_full = 0;
                                var sta_exam_part = 0;
                                var pass_exam_full = 0;
                                var pass_exam_part = 0;
                                var fail_exam_full = 0;
                                var fail_exam_part = 0;
                                var absent_exam_full = 0;
                                var absent_exam_part = 0;
                                var pass_rate_full = 0;
                                var pass_rate_part = 0;
                                var stu_full = 0;
                                var stu_part = 0;
                                var course_id = $('#analysis_sub_l_Dcode').val();
                                var batch_id = $('#analysis_sub_l_Bcode').val();
                                var year = $('#analysis_sub_l_no_year').val();
                                var semester = $('#analysis_sub_l_no_semester').val();
                                var exam_id = $('#analysis_sub_exam').val();
                                var attempt = $('#analysis_sub_attempt').val();
                                var exam_name = $('#analysis_exam').text().replace("---Select Exam---", "");
                                $('#analysis_subject').find('option').remove().end().append('<option>---Select Subject---</option>').val(0);
                                if (batch_id == '' || course_id == '' || year == '' || semester == '' || exam_id == '') {
                                res['status'] = 'denied';
                                res['message'] = 'Please select batch, course, year, semester and exam to search';
                                result_notification(res);
                                $('.se-pre-con').fadeOut('slow');
                                $('#print_analysis_sub_wise').attr('disabled', true);
                                } else {

                                $.post("<?php echo base_url('Report/load_data_for_subj_analysis_report') ?>", {
                                'batch_id': batch_id,
                                        'course_id': course_id,
                                        'year': year,
                                        'semester': semester,
                                        'exam_id': exam_id,
                                        'attempt': attempt
                                },
                                        function (data) {

                                        $('#analysis_subj_wise_tbl').DataTable().destroy();
                                        $('#analysis_subj_wise_tbl').DataTable({
//                                                dom: 'Bfrtip',
//                                                buttons: [{
//                                                    extend: 'pdfHtml5',
//                                                    download: 'open'
//                                                }],
                                                'ordering': false,
                                                'paging': false,
                                                'searching': false,
                                                'lengthMenu': [10, 25, 50, 75, 100],
                                                "columnDefs": [ {
                                                "targets": 0,
                                                        "visible":false
                                                },
                                                {
                                                "targets": 1,
                                                        "width": "20%"
                                                        //"className": 'text-center'               
                                                },
                                                {
                                                "targets": 2,
                                                        "className": 'text-center',
                                                        "width": "10%"
                                                },
                                                {
                                                "targets": 3,
                                                        "className": 'text-center',
                                                        "width": "10%"
                                                },
                                                {
                                                "targets": 4,
                                                        "className": 'text-center',
                                                        "width": "10%"
                                                },
                                                {
                                                "targets": 5,
                                                        "className": 'text-center',
                                                        "width": "10%"
                                                },
                                                {
                                                "targets": 6,
                                                        "className": 'text-center',
                                                        "width": "10%"
                                                },
                                                {
                                                "targets": 7,
                                                        "className": 'text-center',
                                                        "width": "10%"
                                                }],
                                                "createdRow": function(row, data, dataIndex) {
                                                if (data[0] == 1) {
                                                $(row).css("background-color", "#f9f9f9");
                                                $('td', row).css('border-right', 0);
                                                }

                                                if (data[0] == 2) {
                                                $(row).css("background-color", "#c7c3c4");
                                                $('td', row).css('border-right', 0);
                                                }
                                                }
                                        });
                                        $('#analysis_subj_wise_tbl').DataTable().clear();
                                        //-----------------START - No of students VS subjects----------------

                                        $('#student_vs_subj_tbl').DataTable().destroy();
                                        $('#student_vs_subj_tbl').DataTable({
//                                                dom: 'Bfrtip',
//                                                buttons: [{
//                                                    extend: 'pdfHtml5',
//                                                    download: 'open'
//                                                }],
                                                'ordering': false,
                                                'paging': false,
                                                'searching': false,
                                                'lengthMenu': [10, 25, 50, 75, 100],
                                                "columnDefs": [{
                                                "targets": 1,
                                                        //"width": "20%"
                                                        "className": 'text-center'
                                                },
                                                {
                                                "targets": 2,
                                                        "className": 'text-center',
                                                        //"width": "10%"
                                                },
                                                {
                                                "targets": 3,
                                                        "className": 'text-center',
                                                        //"width": "10%"
                                                },
                                                {
                                                "targets": 4,
                                                        "className": 'text-center',
                                                        //"width": "10%"
                                                },
                                                {
                                                "targets": 5,
                                                        "className": 'text-center',
                                                        //"width": "10%"
                                                },
                                                {
                                                "targets": 6,
                                                        "className": 'text-center',
                                                        //"width": "10%"
                                                }]
                                        });
                                        $('#student_vs_subj_tbl').DataTable().clear();
                                        //------------END - No of students VS subjects------------------

                                        //-----------------START - Percentage VS Subject----------------

                                        $('#percent_vs_subj_tbl').DataTable().destroy();
                                        $('#percent_vs_subj_tbl').DataTable({
                                        'ordering': false,
                                                'paging': false,
                                                'searching': false,
                                                'lengthMenu': [10, 25, 50, 75, 100],
                                                "columnDefs": [{
                                                "targets": 1,
                                                        //"width": "20%"
                                                        "className": 'text-center'
                                                }]
                                        });
                                        $('#percent_vs_subj_tbl').DataTable().clear();
                                        //------------END - Percentage VS Subject------------------


                                        //-----------------START - Individual Subject wise Pass Rate----------------

                                        $('#subj_vs_pass_rate_tbl').DataTable().destroy();
                                        $('#subj_vs_pass_rate_tbl').DataTable({
                                        'ordering': false,
                                                'paging': false,
                                                'searching': false,
                                                'lengthMenu': [10, 25, 50, 75, 100],
                                                "columnDefs": [{
                                                "targets": 1,
                                                        "className": 'text-center'
                                                }]
                                        });
                                        $('#subj_vs_pass_rate_tbl').DataTable().clear();
                                        //------------END - Individual Subject wise Pass Rate------------------

                                        $('.se-pre-con').fadeOut('slow');
                                        if (data['subj_data'].length > 0) {
                                        if (data['subjects'].length > 0) {

                                        var chart_data_1 = [];
                                        var chart_data_2 = [];
                                        for (var i = 0; i < data['subjects'].length; i++){

                                        $('#analysis_subject').append($("<option></option>").attr("value", data['subjects'][i]['id']).text("[" + data['subjects'][i]['code'] + "] - " + data['subjects'][i]['subject']));
                                        var subjId = data['subjects'][i]['id'];
                                        if (i > 0){
                                        var prevId = data['subjects'][i - 1]['id'];
                                        }

                                        if (subjId != prevId){
                                        $('#analysis_subj_wise_tbl').DataTable().row.add([
                                                1,
                                                "<b>[" + data['subjects'][i]['code'] + "] - " + data['subjects'][i]['subject'] + "</b>",
                                                '',
                                                '',
                                                '',
                                                '',
                                                '',
                                                ''
                                        ]).draw(false);
                                        }

                                        var total_applicant = 0;
                                        var total_exm_sat_applicant = 0;
                                        var total_pass = 0;
                                        var total_fail = 0;
                                        var total_absent = 0;
                                        var total_pass_rate = 0;
                                        for (var j = 0; j < data['subj_data'].length; j++) {

                                        for (var k = 0; k < data['subj_data'][j]['sat_exam'].length; k++) {

                                        $.each(data['subj_data'][j]['sat_exam'][k], function(key, value) {
                                        subj_key_id = key;
                                        });
                                        if (subj_key_id == data['subjects'][i]['id']){
                                        sta_exam_full = data['subj_data'][j]['sat_exam'][k][data['subjects'][i]['id']]['full_time'];
                                        sta_exam_part = data['subj_data'][j]['sat_exam'][k][data['subjects'][i]['id']]['part_time'];
                                        pass_exam_full = data['subj_data'][j]['pass_count'][k][data['subjects'][i]['id']]['full_time'];
                                        pass_exam_part = data['subj_data'][j]['pass_count'][k][data['subjects'][i]['id']]['part_time'];
                                        fail_exam_full = data['subj_data'][j]['fail_count'][k][data['subjects'][i]['id']]['full_time'];
                                        fail_exam_part = data['subj_data'][j]['fail_count'][k][data['subjects'][i]['id']]['part_time'];
                                        absent_exam_full = data['subj_data'][j]['absent_count'][k][data['subjects'][i]['id']]['full_time'];
                                        absent_exam_part = data['subj_data'][j]['absent_count'][k][data['subjects'][i]['id']]['part_time'];
                                        pass_rate_full = data['subj_data'][j]['pass_rate'][k][data['subjects'][i]['id']]['full_time'];
                                        pass_rate_part = data['subj_data'][j]['pass_rate'][k][data['subjects'][i]['id']]['part_time'];
                                        stu_full = data['subj_data'][j]['stu_count'][k][data['subjects'][i]['id']]['full_time'];
                                        stu_part = data['subj_data'][j]['stu_count'][k][data['subjects'][i]['id']]['part_time'];
                                        //calculate total
                                        total_applicant += (stu_full + stu_part);
                                        total_exm_sat_applicant += (sta_exam_full + sta_exam_part);
                                        total_pass += (pass_exam_full + pass_exam_part);
                                        total_fail += (fail_exam_full + fail_exam_part);
                                        total_absent += (absent_exam_full + absent_exam_part);
                                        total_pass_rate += (pass_rate_full + pass_rate_part);
                                        }
                                        }

                                        $('#analysis_subj_wise_tbl').DataTable().row.add([
                                                0,
                                                data['subj_data'][j]['br_name']['full_time'],
                                                stu_full,
                                                sta_exam_full,
                                                pass_exam_full,
                                                fail_exam_full,
                                                absent_exam_full,
                                                pass_rate_full
                                        ]).draw(false);
                                        $('#analysis_subj_wise_tbl').DataTable().row.add([
                                                0,
                                                data['subj_data'][j]['br_name']['part_time'],
                                                stu_part,
                                                sta_exam_part,
                                                pass_exam_part,
                                                fail_exam_part,
                                                absent_exam_part,
                                                pass_rate_part
                                        ]).draw(false);
                                        }

                                        $('#analysis_subj_wise_tbl').DataTable().row.add([
                                                2,
                                                "<b>Total</b>",
                                                "<b>" + total_applicant + "</b>",
                                                "<b>" + total_exm_sat_applicant + "</b>",
                                                "<b>" + total_pass + "</b>",
                                                "<b>" + total_fail + "</b>",
                                                "<b>" + total_absent + "</b>",
                                                "<b>" + total_pass_rate + "</b>"
                                        ]).draw(false);
                                        //-------------------------START - No of students VS subjects-------------------------------------

                                        $('#student_vs_subj_tbl').DataTable().row.add([
                                                "[" + data['subjects'][i]['code'] + "] - " + data['subjects'][i]['subject'],
                                                total_applicant,
                                                total_exm_sat_applicant,
                                                total_pass,
                                                total_fail,
                                                total_absent,
                                                total_pass_rate
                                        ]).draw(false);
                                        chart_data_1 [i] = { Subject:data['subjects'][i]['code'], Passed: total_pass, Failed: total_fail, Absent:total_absent };
                                        //pass_rate_data_1[j] = {Students:total_applicant, Subject: data['subjects'][i]['code'] };

                                        //-------------------------END - No of students VS subjects-------------------------------------  

                                        //-------------------------START - Percentage VS Subject-------------------------------------

                                        $('#percent_vs_subj_tbl').DataTable().row.add([
                                                "[" + data['subjects'][i]['code'] + "] - " + data['subjects'][i]['subject'],
                                                total_pass_rate
                                        ]).draw(false);
                                        chart_data_2 [i] = { Subject:data['subjects'][i]['code'], Pass_rate: total_pass_rate };
                                        //-------------------------END - Percentage VS Subject-------------------------------------

                                        loadedData = data;
                                        }


                                        Morris.Bar({
                                        barGap:2,
                                                barSizeRatio:0.55,
                                                element: 'chartsubj1',
                                                data: chart_data_1,
                                                xkey: 'Subject',
                                                horizontal: true,
                                                ykeys:['Passed', 'Failed', 'Absent'],
                                                labels: ['Passed', 'Failed', 'Absent'],
                                                hideHover:'auto',
                                                stacked:true
                                                //xLabelAngle: 80
                                        });
                                        Morris.Line({
                                        element: 'chartsubj2',
                                                data: chart_data_2,
                                                xkey: 'Subject',
                                                parseTime: false,
                                                ykeys:['Pass_rate'],
                                                labels: ['Pass Rate %']
                                                //xLabelAngle: 80
                                        });
                                        subj_wise_radio_click($("input[name='category']:checked").val());
                                        $('#print_analysis_sub_wise').attr('disabled', false);
                                        }
                                        else{
                                        $('#print_analysis_sub_wise').attr('disabled', true);
                                        }
                                        }
                                        else{
                                        $('#print_analysis_sub_wise').attr('disabled', true);
                                        }
                                        },
                                        "json"
                                        );
                                }
                                }


                                function print_analysis_sub_wise_data_load(){

                                var course_id = $('#analysis_sub_l_Dcode').val();
                                var batch_id = $('#analysis_sub_l_Bcode').val();
                                var year = $('#analysis_sub_l_no_year').val();
                                var semester = $('#analysis_sub_l_no_semester').val();
                                var exam_id = $('#analysis_sub_exam').val();
                                var attempt = $('#analysis_sub_attempt').val();
                                var sub = $('#analysis_subject').val();
//                                var attempt = $('#analysis_sub_attempt').val();
                                var cat = $('input[name=category]:checked').val();
                                window.open('<?php echo base_url("report/print_analysis_sub_wise_data_load") ?>?&cou=' + course_id + '&bat=' + batch_id + '&yea=' + year + '&sem=' + semester + '&exm=' + exam_id + '&analy_att=' + attempt + '&cat=' + cat + '&sub=' + sub);
                                }


                                function subj_wise_radio_click(radio_value){
                                if (radio_value == 1){

                                $('#chartsubj1').hide();
                                $('#chartsubj2').hide();
                                $('#chartsubj3').hide();
                                $('#chartsubj4').hide();
                                $('#chartsubj1_div').hide();
                                $('#chartsubj2_div').hide();
                                $('#chartsubj3_div').hide();
                                $('#chartsubj4_div').hide();
                                //chart
//                                    $('#chartsubj1').css('visibility', 'hidden');  
//                                    $('#chartsubj2').css('visibility', 'hidden');
//                                    $('#chartsubj3').css('visibility', 'hidden');
//                                    $('#chartsubj4').css('visibility', 'hidden');

                                //$('#student_vs_subj_chart').hide();
                                //$('#percent_vs_subj_chart').hide();
                                //$('#subj_vs_pass_rate_chart').hide();

                                //table
                                $('#subj_wise_details_table').show();
                                $('#student_vs_subj_table').hide();
                                $('#percent_vs_subj_table').hide();
                                $('#subj_vs_pass_rate_table').hide();
                                }
                                else if (radio_value == 2){

                                //chart
//                                    $('#chartsubj1').css('visibility', 'visible');  
//                                    $('#chartsubj2').css('visibility', 'hidden');
//                                    $('#chartsubj3').css('visibility', 'hidden');
//                                    $('#chartsubj4').css('visibility', 'hidden');

                                $('#chartsubj1').show();
                                $('#chartsubj2').hide();
                                $('#chartsubj3').hide();
                                $('#chartsubj4').hide();
                                if (loadedData['subj_data'].length > 0){
                                $('#chartsubj1_div').show();
                                $('#chartsubj2_div').hide();
                                $('#chartsubj3_div').hide();
                                $('#chartsubj4_div').hide();
                                }

//                                    $('#student_vs_subj_chart').show();
//                                    $('#percent_vs_subj_chart').hide();
//                                    $('#subj_vs_pass_rate_chart').hide();

                                //table
                                $('#student_vs_subj_table').show();
                                $('#subj_wise_details_table').hide();
                                $('#percent_vs_subj_table').hide();
                                $('#subj_vs_pass_rate_table').hide();
                                }
                                else if (radio_value == 3){

                                $('#chartsubj1').hide();
                                $('#chartsubj2').show();
                                $('#chartsubj3').hide();
                                $('#chartsubj4').hide();
                                if (loadedData['subj_data'].length > 0){
                                $('#chartsubj1_div').hide();
                                $('#chartsubj2_div').show();
                                $('#chartsubj3_div').hide();
                                $('#chartsubj4_div').hide();
                                }

                                //chart
//                                    $('#student_vs_subj_chart').hide();
//                                    $('#percent_vs_subj_chart').show();
//                                    $('#subj_vs_pass_rate_chart').hide();

//                                    $('#chartsubj1').css('visibility', 'hidden');  
//                                    $('#chartsubj2').css('visibility', 'visible');
//                                    $('#chartsubj3').css('visibility', 'hidden');
//                                    $('#chartsubj4').css('visibility', 'hidden');

                                //table
                                $('#percent_vs_subj_table').show();
                                $('#subj_wise_details_table').hide();
                                $('#student_vs_subj_table').hide();
                                $('#subj_vs_pass_rate_table').hide();
                                }
                                else{

                                $('#chartsubj1').hide();
                                $('#chartsubj2').hide();
                                $('#chartsubj3').show();
                                $('#chartsubj4').show();
                                $('#chartsubj1_div').hide();
                                $('#chartsubj2_div').hide();
                                //chart
//                                    $('#student_vs_subj_chart').hide();
//                                    $('#percent_vs_subj_chart').hide();
//                                    $('#subj_vs_pass_rate_chart').show();

//                                    $('#chartsubj1').css('visibility', 'hidden');  
//                                    $('#chartsubj2').css('visibility', 'hidden');
//                                    $('#chartsubj3').css('visibility', 'visible');
//                                    $('#chartsubj4').css('visibility', 'visible');

                                //table
                                $('#subj_vs_pass_rate_table').show();
                                $('#subj_wise_details_table').hide();
                                $('#student_vs_subj_table').hide();
                                $('#percent_vs_subj_table').hide();
                                }
                                }

                                function individual_subject_pass_rate_load(select_value){

                                var pass_fulltime_rate = 0;
                                var pass_parttime_rate = 0;
                                var key_id = 0;
                                $('#chartsubj3').empty();
                                $('#chartsubj4').empty();
                                $('#subj_vs_pass_rate_tbl').DataTable().destroy();
                                $('#subj_vs_pass_rate_tbl').DataTable({
                                'ordering': false,
                                        'paging': false,
                                        'searching': false,
                                        'lengthMenu': [10, 25, 50, 75, 100],
                                        "columnDefs": [{
                                        "targets": 1,
                                                "className": 'text-center'
                                        }]
                                });
                                $('#subj_vs_pass_rate_tbl').DataTable().clear();
                                if (loadedData['subj_data'].length > 0) {

                                var chart_data_3 = [];
                                var chart_data_4 = [];
                                for (var t = 0; t < loadedData['subjects'].length; t++){
                                for (var u = 0; u < loadedData['subj_data'].length; u++) {
                                for (var p = 0; p < loadedData['subj_data'][u]['pass_rate'].length; p++) {

                                $.each(loadedData['subj_data'][u]['pass_rate'][p], function(key, value) {
                                key_id = key;
                                });
                                if (key_id == loadedData['subjects'][t]['id']){
                                pass_fulltime_rate = loadedData['subj_data'][u]['pass_rate'][p][loadedData['subjects'][t]['id']]['full_time'];
                                pass_parttime_rate = loadedData['subj_data'][u]['pass_rate'][p][loadedData['subjects'][t]['id']]['part_time'];
                                }
                                }

                                //-------------------------START - Individual Subject wise Pass Rate-------------------------------------

                                if (select_value == loadedData['subjects'][t]['id']){

                                $('#subj_vs_pass_rate_tbl').DataTable().row.add([
                                        loadedData['subj_data'][u]['br_name']['full_time'],
                                        pass_fulltime_rate.toFixed(0)
                                ]).draw(false);
                                $('#subj_vs_pass_rate_tbl').DataTable().row.add([
                                        loadedData['subj_data'][u]['br_name']['part_time'],
                                        pass_parttime_rate.toFixed(0)
                                ]).draw(false);
                                chart_data_3.push({ Center:loadedData['subj_data'][u]['br_name']['full_time'], Pass_rate: pass_fulltime_rate.toFixed(0) },
                                { Center:loadedData['subj_data'][u]['br_name']['part_time'], Pass_rate: pass_parttime_rate.toFixed(0) });
                                chart_data_4.push({ Center:loadedData['subj_data'][u]['br_name']['full_time'], Pass_rate: pass_fulltime_rate.toFixed(0) },
                                { Center:loadedData['subj_data'][u]['br_name']['part_time'], Pass_rate: pass_parttime_rate.toFixed(0) });
                                }

                                //-------------------------END - Individual Subject wise Pass Rate-------------------------------------
                                }
                                }

                                $('#chartsubj3_div').show();
                                $('#chartsubj4_div').show();
                                Morris.Bar({
                                barGap:2,
                                        barSizeRatio:0.55,
                                        element: 'chartsubj3',
                                        data: chart_data_3,
                                        xkey: 'Center',
                                        horizontal: true,
                                        ykeys:['Pass_rate'],
                                        labels: ['Pass %'],
                                        hideHover:'auto',
                                        stacked:true
                                        //xLabelAngle: 80
                                });
                                Morris.Line({
                                element: 'chartsubj4',
                                        data: chart_data_4,
                                        xkey: 'Center',
                                        parseTime: false,
                                        ykeys:['Pass_rate'],
                                        labels: ['Pass %']
                                        //xLabelAngle: 80
                                });
                                }
                                }

                                function print_charts_summary(){
                                xepOnline.Formatter.Format('chart', {render:'download', pageWidth:'18.5in', pageHeight:'18in', srctype:'svg', filename:'analysis_summary_chart'});
                                }

                                function print_charts_pass_rate(){
                                xepOnline.Formatter.Format('chartPassRate', {render:'download', pageWidth:'18.5in', pageHeight:'18in', srctype:'svg', filename:'analysis_summary_chart'});
                                }


                                //--------subject wise analysisi charts----------------
                                function print_student_vs_subj_charts_summary(){
                                xepOnline.Formatter.Format('chartsubj1', {render:'download', pageWidth:'18.5in', pageHeight:'18in', srctype:'svg', filename:'no_of_students_vs_subjects_graph'});
                                }

                                function print_percent_vs_subj_charts_summary(){
                                xepOnline.Formatter.Format('chartsubj2', {render:'download', pageWidth:'18.5in', pageHeight:'18in', srctype:'svg', filename:'percentage_vs_subjects_graph'});
                                }

                                function individual_subject_pass_rate_charts_summary(){
                                xepOnline.Formatter.Format('chartsubj3', {render:'download', pageWidth:'18.5in', pageHeight:'18in', srctype:'svg', filename:'individual_subject_pass_rate_graph'});
                                }

                                function individual_subject_pass_rate_line_charts_summary(){
                                xepOnline.Formatter.Format('chartsubj4', {render:'download', pageWidth:'18.5in', pageHeight:'18in', srctype:'svg', filename:'individual_subject_pass_rate_line_graph'});
                                }



</script>
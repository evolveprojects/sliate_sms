<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Academic</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Approvals</li>
            <li><i class="fa fa-share-alt"></i>Academic</li>
        </ol>

    </div>
</div>
<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <!--<li role="presentation" class="active"><a id="#lookup_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab">Lookup</a></li>-->
    <li role="presentation" class="active"><a id="#subject_approval_tab" href="#subject_approval_tab"
                                              aria-controls="subject_approval_tab"
                                              role="tab" data-toggle="tab">Subject Aproval</a></li>
    <li role="presentation"><a id="#appexam_tab" href="#appexam_tab" aria-controls="appexam_tab"

                               role="tab" data-toggle="tab">Student Exam Request</a></li>
<!--    <li role="presentation"><a id="#postpone_tab" href="#postpone_tab" aria-controls="postpone_tab" role="tab"
                               data-toggle="tab">Postpone / Graduation Request</a></li>-->
    <li role="presentation"><a id="#med_tab" href="#med_tab" aria-controls="med_tab" role="tab" data-toggle="tab">Request
            Deferment</a></li>
<!--    <li role="presentation"><a id="#timetable_tab" href="#timetable_tab" aria-controls="timetable_tab" role="tab"
                               data-toggle="tab">Time Table</a></li>-->
    <li role="presentation" class="hidden"><a id="#exam_mark_approval" href="#exam_mark_approval"
                                              aria-controls="exam_mark_approval"
                                              role="tab"
                                              data-toggle="tab">Exam Mark Approval</a></li>
</ul>

<div class="tab-content" id="tabs">
    <div role="tabpanel" class="tab-pane active" id="subject_approval_tab">
        <form class="form-horizontal" role="form" method="post" action="" id="subject_approval_form"
              name="subject_approval_form"
              autocomplete="off">
            <div class="panel">
                <header class="panel-heading">
                    Subject Approvals
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center</label>
                                <div class="col-md-7">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="subject_prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                                    echo form_dropdown('subject_prom_centre', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subject_course" name="subject_course"
                                            onchange="subject_get_course_code(this.value, 0)" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="batch" class="col-md-3 control-label">Batch</label>
                                <div class="col-md-7">
                                    <select id="subject_batch" class="form-control" style="width:100%"
                                            name="subject_batch"
                                            data-validation="required"
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
                                <label for="inputyear" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year"
                                            onchange="subject_load_semester(this.value, null, 1)" required
                                            placeholder="field cannot be empty" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Year---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputYear" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester"
                                            required placeholder="field cannot be empty" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Semester---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-11">

                                    <button type='button' class='btn btn-primary'
                                            onclick='event.preventDefault(); load_student_subject_approval_list();'>
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <table class="table table-bordered" id="subject_approval_tbl">
                        <thead id="subject_approval_load_thead">
                        <tr>
                            <th>#</th>
                            <th>Reg No</th>
                            <th>Student Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="subject_approval_load_student">
<!--                        <tr>
                            <td colspan="10" align="center">No records to show.</td>
                        </tr>-->
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer hidden">
                    <button type="submit" class="btn btn-primary" id="submitbtn"
                            onclick="event.preventDefault(); apply_exam()">Apply
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div role="tabpanel" class="tab-pane " id="appexam_tab">
        <!--  <form class="form-horizontal" role="form" method="post" action="" id="apply_exam_form" name="apply_exam_form"
                autocomplete="off">-->
        <div class="panel">
            <header class="panel-heading">
                Apply Exam
            </header>

            <div class="panel-body">

                <ul class="nav nav-tabs" role="tablist" id="all_tabs">
                    <li role="presentation" class="active"><a id="#exam_request_current" href="#exam_request_current"
                                                              aria-controls="appexam_tab" role="tab" data-toggle="tab">Current
                            Students</a></li>
<!--                    <li role="presentation"><a id="#exam_request_repeat" href="#exam_request_repeat"
                                               aria-controls="exam_request_repeat"
                                               role="tab" data-toggle="tab">Repeat Students</a></li>-->
                    <li role="presentation"><a id="#exam_request_recorrection" href="#exam_request_recorrection"
                                               aria-controls="exam_request_recorrection"
                                               role="tab" data-toggle="tab">Recorrection Applied Students</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="exam_request_current">
                        
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="center" class="col-md-3 control-label">Center</label>
                                            <div class="col-md-7">
                                                <?php
                                                global $branchdrop;
                                                global $selectedbr;
                                                $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                                                echo form_dropdown('prom_centre', $branchdrop, $selectedbr, $extraattrs);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="course" class="col-md-3 control-label">Course</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="course" name="course"
                                                        onchange="get_course_code(this.value, 0)"
                                                        data-validation="required"
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
                                                <select id="batch" class="form-control" style="width:100%" name="batch"
                                                        onchange="load_semester_exam(this.value)"
                                                        data-validation="required"
                                                        data-validation-error-msg-required="Field can not be empty">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-11">
                                                <button type='button' class='btn btn-info'
                                                        onclick='event.preventDefault(); load_apply_exam_data();'>
                                                    Current Students
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exam" class="col-md-3 control-label hidden">Exam</label>
                                            <div class="col-md-7">
                                                <select id="exam" class="form-control hidden" style="width:100%"
                                                        name="exam"
                                                        data-validation=""
                                                        data-validation-error-msg-required="Field can not be empty">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <br/>
                                <br/>
                                <br/>
                                <label style="font-size: 13px;color: #ff2d55">
                                    If you perform Bulk Approval, all applied subjects of each selected students  will be approved.
                                </label>
                                <br/>
                                <br/>
                                <div class="row">
                                    <div class="col-md-offset-10 col-md-12">
                                        <button type='button' class='btn btn-danger' disabled id="exam_request_bulk_approval_btn"
                                                        onclick='event.preventDefault(); exam_request_bulk_approval();'>
                                                    Bulk Approval
                                        </button>
                                        <i id="bulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px;"></i>
                                    </div>
                                </div>
                                <br/>
                                <table class="table table-bordered" id="apply_exam_req">
                                    <thead id="load_thead">
                                    <tr>
                                        <th>#</th>
                                        <th>Reg No</th>
                                        <th>Student Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="load_student">
                                    <tr>
                                        <td colspan="10" align="center">No records to show.</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="exam_request_recorrection">
                        
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="req_recorrection_center"
                                                   class="col-md-3 control-label">Center</label>
                                            <div class="col-md-7">
                                                <?php
                                                global $branchdrop;
                                                global $selectedbr;
                                                $extraattrs = 'id="req_recorrection_centre" class="form-control" style="width:100%" onchange="load_recorrection_courses(this.value);"';
                                                echo form_dropdown('rpt_centre', $branchdrop, $selectedbr, $extraattrs);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="req_recorrection_course"
                                                   class="col-md-3 control-label">Course</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="req_recorrection_course"
                                                        name="req_recorrection_course"
                                                        onchange="load_recorrection_batches(this.value)"
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
                                                        onchange="load_recorrection_exams(this.value)"
                                                        data-validation="required"
                                                        data-validation-error-msg-required="Field can not be empty">
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
                                                        onclick='event.preventDefault(); load_recorrection_students();'>
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <br/>
                                <table class="table table-bordered" id="apply_recorrection_exam_tbl">
                                    <thead id="load_thead">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Result</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="load_student">
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exam_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Exam Rejection Reason</h5>
                    </div>
                    <div class="modal-body">

                        <br>
                        <div id="rejected_subject">
                        </div>
                        <input type="text" value="" id="reject_sub_id" class="form-control  text-field hidden">
                        <input type="text" value="" id="reject_sub_code" class="form-control  text-field hidden">
                        <input type="text" value="" id="approved_sub_id" class="form-control  text-field hidden"
                               hidden>
                        <input type="text" value="" id="reject_semester_id" class="form-control text-field hidden"
                               hidden>
                        <input type="text" value="" id="student_ids" class="form-control text-field hidden" >
                        <br>
                        <label style="color: red" id="lbl_error" >Select valid reason to proceed !</label>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary rejectreasonmodel"
                                onclick="event.preventDefault();update_exam_rej_status(3)" id="reject_model_btn">
                            Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!--  </form>-->

    </div>
    <div role="tabpanel" class="tab-pane" id="med_tab">
        <div class="panel">
            <div class="panel-heading">
                Student Exam Deferment
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-11">
                        <input type="radio" name="exm_type" class="col-md-1" id="current_exam" value="C" onclick="reset_fields_deferements(this.value);" checked><label class="col-md-2 control-label" style="text-align: left;">Current Exam</label>

                        <input type="radio" name="exm_type" class="col-md-1" id="repeat_exam" value="R" onclick="reset_fields_deferements(this.value);"><label class="col-md-2 control-label" style="text-align: left;">Repeat Exam</label>
                    </div>
                </div>
                <br/>
                <br/>
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
                                        $extraattrs = 'id="eh_center" class="form-control" onchange="sem_load_course_list(this.value, 1, null);"';
                                        echo form_dropdown('eh_center', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
<!--                                    <select class="form-control" id="eh_center" name="eh_center" class="form-control"
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty"
                                            onchange="sem_load_course_list(this.value, 1, null);">
                                        <option value="">---Select center---</option>
                                        <?php
                                        //foreach ($centers as $row):
                                            ?>
                                            <option value="<?php //echo $row['br_id']; ?>">
                                                <?php //echo $row['br_code'] . " - " . $row['br_name']; ?>
                                            </option>
                                        <?php
                                        //endforeach;
                                        ?>
                                    </select>-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="eh_course" name="eh_course"
                                            onchange="get_course_year(this.value, 1, null, null, 1)" required
                                            placeholder="field cannot be empty" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Course---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="eh_batch" name="eh_batch" required
                                            placeholder="field cannot be empty" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" value="">
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
                                    <select type="text" class="form-control" id="eh_year" name="eh_year"
                                            onchange="load_semesters_defer(this.value, null, 1)" required
                                            placeholder="field cannot be empty" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="">---Select Year---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="eh_semester" name="eh_semester"
                                            required placeholder="field cannot be empty" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty" value=""
                                            onchange="get_exam_list();">
                                        <option value="">---Select Semester---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="eh_exam" class="col-md-3 control-label">Exam</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="eh_exam" name="eh_exam">
                                        <option value="">---Select Exam---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-md" name="search" id="search_students"
                                onclick="search_students_absented_approval()">Search Students
                        </button>
                        
                        
                        <button type="button" class="btn btn-primary btn-md" name="search_repeat" id="search_students_repeat"
                                onclick="search_students_absented_approval_repeat()">Search Repeat Students
                        </button>

                    </div>
<!--                    <div class="col-md-2">
                        <button type="button" class="btn btn-success btn-md" id="print_students_semester_subject_btn"
                                name="print_students_semester_subject_btn" onclick="print_students_semester_subject();">
                            <span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report
                        </button>
                    </div>-->
                </div>
                <br>
                <br>
                <table class="table table-bordered" id="student_absent_tbl">
                    <thead id="load_absent_thead">
                    <tr>
                        <th>#</th>
                        <th>Reg No</th>
                        <th>Student</th>
                        <th>Deferement</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="student_absent_tbl_body">
                    <tr>
                        <td colspan="10" align="center">No records to show.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!--    <div role="tabpanel" class="tab-pane" id="timetable_tab">
        <div class="panel">
            <header class="panel-heading">
                Time Table
            </header>
            <br>
            <div class="container">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a id="#lectures_timetable_tab" href="#lectures_timetable_tab" aria-controls="lectures_timetable_tab" role="tab" data-toggle="tab">Lectures Time Table</a></li>
                    <li role="presentation" class="active"><a id="#exam_timetable_tab" href="#exam_timetable_tab"
                                                              aria-controls="exam_timetable_tab" role="tab"
                                                              data-toggle="tab">Exam Time Table to Approval</a></li>
                    <li role="presentation" class=""><a id="#exam_timetable_reject_tab"
                                                        href="#exam_timetable_reject_tab"
                                                        aria-controls="exam_timetable_reject_tab" role="tab"
                                                        data-toggle="tab">Rejected Exam Time Table</a></li>
                </ul>
            </div>
            <div class="tab-content container">
                <div role="tabpanel" class="tab-pane active" id="exam_timetable_tab">
                    <form class="form-horizontal" role="form" method="post" action="" id="exam_timetable_form"
                          name="exam_timetable_form" autocomplete="off">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                </div>
                                <table class="table table-bordered" id="exam_time_tbl">
                                    <thead id="load_thead">
                                    <tr>
                                        <th>#</th>
                                        <th>Table code</th>
                                        <th>Description</th>
                                        <th>Exam</th>

                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="load_student">
                                    <?php
                                    $i = 1;
                                    if (!empty($lecture_ttbl)) {

                                        // var_dump($lecture_ttbl);
                                        foreach ($lecture_ttbl as $stf) {
                                            echo "<tr>";
                                            echo "<td align='center'>" . $i . "</td>";
                                            echo "<td>" . $stf['ttbl_code'] . "</td>";
                                            echo "<td>" . $stf['ttbl_description'] . "</td>";
                                            echo "<td>" . $stf['exam_name'] . "</td>";
                                            echo "<td align='center'>" . $stf['ttbl_year'] . "</td>";
                                            echo "<td align='center'>" . $stf['ttbl_semester'] . "</td>";
//                                                        echo "<td>" . $stf['exam_name'] ."</td>";
//                                                        echo "<td>" . $stf['course_code'] ."</td>";

                                            echo "<td align='center'>";
                                            //  "<button title='Edit' onclick='event.preventDefault();edit_timetable(" . $stf["ttbl_id"] . ",1)' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button> | ";
                                            $descript = $stf['ttbl_code'] . ' - ' . $stf['ttbl_description'] . ' [ ' . $stf['course_code'] . ' - ' . $stf['course_code'] . ' / Y : ' . $stf['ttbl_year'] . ' / S : ' .$stf['ttbl_semester'] . ' ]';

                                            echo "<button title='View' onclick='event.preventDefault();view_exam_timetable(" . $stf['ttbl_id'] . ",\"" . $descript . "\"," . $stf['ttbl_course'] . "," . $stf['ttbl_year'] . "," . $stf['ttbl_semester'] . ");' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button> | ";
                                            
                                            echo "<button title='Approve' onclick='event.preventDefault();update_examtime_status(" . $stf["ttbl_id"] . ",1)' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> | ";

                                            echo "<button title='Reject' onclick='event.preventDefault();update_examtime_status(" . $stf["ttbl_id"] . ",3)' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";


                                            echo "</td></tr>";

                                            $i++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane " id="exam_timetable_reject_tab">
                    <form class="form-horizontal" role="form" method="post" action="" id="exam_timetable_reject_form"
                          name="exam_timetable_reject_form" autocomplete="off">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                </div>
                                <table class="table table-bordered" id="exam_time_reject_tbl">
                                    <thead id="load_thead">
                                    <tr>
                                        <th>#</th>
                                        <th>Table code</th>
                                        <th>Description</th>
                                        <th>Exam</th>

                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="load_student">
                                    <?php
                                    $i = 1;
                                    if (!empty($lecture_ttbl_reject)) {

                                        foreach ($lecture_ttbl_reject as $rtbl) {
                                            echo "<tr>";
                                            echo "<td align='center'>" . $i . "</td>";
                                            echo "<td>" . $rtbl['ttbl_code'] . "</td>";
                                            echo "<td>" . $rtbl['ttbl_description'] . "</td>";
                                            echo "<td>" . $stf['exam_name'] . "</td>";
                                            echo "<td align='center'>" . $rtbl['ttbl_year'] . "</td>";
                                            echo "<td align='center'>" . $rtbl['ttbl_semester'] . "</td>";

                                            echo "<td align='center'>";
                                            // "<button title='Edit' onclick='event.preventDefault();edit_timetable(" . $rtbl["ttbl_id"] . ",1)' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button> | ";

                                            echo "<button title='Approve' onclick='event.preventDefault();update_examtime_status(" . $rtbl["ttbl_id"] . ",1)' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";

                                            echo "</td></tr>";

                                            $i++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>-->
    <div role="tabpanel" class="tab-pane hidden" id="exam_mark_approval">
        <form class="form-horizontal" role="form" method="post" id="exam_marks_form" name="exam_marks_form"
              autocomplete="off">
            <div class="panel">
                <header class="panel-heading">
                    Exam Marks Approval
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center</label>
                                <div class="col-md-7">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null)"';
                                    echo form_dropdown('prom_centre', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 hidden">
                            <div class="form-group ">
                                <label for="faculty" class="col-md-3 control-label">Faculty</label>
                                <div class="col-md-9">
                                    <?php
                                    global $facultydrop;
                                    global $selectedfac;
                                    $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null)"';
                                    echo form_dropdown('faculty', $facultydrop, $selectedfac, $facextraattrs);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Mark course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="mark_course" name="mark_course"
                                            onchange="get_course_code(this.value, false)" data-validation="required"
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
                                    <select id="mark_batch" name="mark_batch" class="form-control" style="width:100%"
                                            onchange="event.preventDefault();load_semester_exam(this.value)"
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
                                    <select id="mark_exam" name="mark_exam" class="form-control"
                                            onchange="event.preventDefault();load_year_data(this.value,'')"
                                            style="width:100%" data-validation="required"
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
                                <label for="Mark course" class="col-md-3 control-label">Year</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="mark_year" name="mark_year"
                                            onchange="load_semesters(this.value)" data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Mark course" class="col-md-3 control-label">Semester</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="mark_semester" name="mark_semester" onchange=""
                                            data-validation="required"
                                            data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-11">
                                    <button type='button' class='btn btn-info'
                                            onclick='event.preventDefault();load_student_data_mark_approval();'>Search
                                        Students
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <table class="table table-bordered exam_marks_tbl" id="exam_marks_tbl">
                        <thead id="exam_marks_load_thead">
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
        </form>
    </div>
<!--    <div role="tabpanel" class="tab-pane" id="postpone_tab">
        <form class="form-horizontal" role="form" method="post" action="" id="postpone_form" name="postpone_form"
              autocomplete="off">
            <div class="panel">
                <header class="panel-heading">
                    Postpone
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Search Type:</label>
                        <div class="col-md-9">
                            <input type="radio" name="type" class="col-md-1" id="postpone_type" value="postpone" checked="checked" onchange="load_type_wise();">
                            <label class="col-md-1 control-label">Postpone</label>

                            <input type="radio" name="type" class="col-md-1" id="graduation_type" value="graduation" onchange="load_type_wise();">
                            <label class="col-md-1 control-label">Graduation</label>
                        </div>
                         <div class="col-md-12">
                        <button style="float: right; margin-right: -109%;" class="btn btn-success" id="print_course_wise" name="print_course_wise" onclick="load_pdf_course_wise();">Print Report</button>
                        </div>
                    </div>
                    <table class="table table-bordered display nowrap" id="approve_postpone_tbl" style="width:100%">
                        <thead id="load_thead">
                        <tr>
                            <th>Student ID</th>
                            <th>Reg No</th>
                            <th>Student Name</th>
                            <th>Center</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Reason</th>
                            <th>Request Type</th>
                            <th>Next Join</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="load_student">
                        <?php if ($POSTPONE != null) {
                            foreach ($POSTPONE as $postp) {
                                ?>
                                <tr>
                                    <td><?= $postp->student_id; ?></td>
                                    <td><?= $postp->reg_no; ?></td>
                                    <td><?= $postp->first_name; ?></td>
                                    <td><?= $postp->br_name; ?></td>
                                    <td><?= $postp->course_code; ?></td>
                                    <td><?= $postp->batch_code; ?></td>
                                    <td><?= $postp->year_id; ?></td>
                                    <td><?= $postp->semester_id; ?></td>
                                    <td><?= $postp->reason; ?></td>
                                    <td><?= $postp->request_type ==1 ?'Postpone':'Graduation' ?></td>
                                    <td><?= $postp->next_join; ?></td>
                                    <td>
                                        <?php
                                        if ($postp->status == "0") { ?>
                                            <button title="Approve" onclick="event.preventDefault();update_approval_status('<?= $postp->request_id ?>', '<?= $postp->student_id ?>','1')"
                                                    class='btn btn-success btn-xs'><span
                                                        class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span>
                                            </button> |

                                        <?php } else { ?>
                                            <button title="Revise Approve" onclick="event.preventDefault();update_approval_status('<?= $postp->request_id ?>', '<?= $postp->student_id ?>','0')"
                                                    class='btn btn-info btn-xs'><span
                                                        class='glyphicon glyphicon-repeat'
                                                        aria-hidden='true'></span></button> |
                                        <?php } ?>
                                        <button title="View" id="view_gpa" name="view_gpa" class='btn btn-warning btn-xs' data-toggle="modal" data-target="#myModal" onclick="event.preventDefault();view_gpa_results('<?= $postp->request_id ?>', '<?= $postp->student_id ?>', '<?= $postp->reg_no ?>', '<?= $postp->first_name ?>', '<?= $postp->last_name ?>')"><span
                                                    class='glyphicon glyphicon-search' aria-hidden='true'></span>
                                        </button>
                                            <button title="Cancel" onclick="event.preventDefault();cancel_postpone_status('<?= $postp->request_id ?>', '<?= $postp->student_id ?>','2')"
                                                    class='btn btn-danger btn-xs'><span
                                                        class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>
                                            </button>
                                    </td>
                                </tr>
                            <?php }
                        } ?>

                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                         Modal content
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <input type="text" id="post_stu_id" name="post_stu_id" value="" disabled hidden>
                                <h4 class="modal-title"><b>GPA Details</b> </h4><br>
                                <label id="post_stu_name" name="post_stu_name" > </label><br>
                                <label id="post_stu_reg_no" name="post_stu_reg_no"></label>

                                <input type="text" id="post_stu_reg" name="post_stu_reg" value="" disabled>
                                 <input type="text" id="post_stu_name" name="post_stu_name" value="" disabled>

                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered" id="view_postpone_stu_tbl">
                                    <thead id="load_thead">
                                    <tr>
                                        <th>#</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>GPA</th>
                                    </tr>
                                    </thead>
                                    <tbody id="view_postpone_stu_tbl_bdy">
                                    <tr>
                                        <td colspan="10" align="center">No records to show.</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="event.preventDefault();update_approval_status('<?= $postp->request_id ?>', null,'1')">Approve</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>-->
</div>
<!-- Subject Approve model    -->

<div id="Subject_approve" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Subject Approve</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" id="grp_form" autocomplete="off">
                    <div class="row">
                        <div class="col-md-12" id="div_subjects" style="display: none;">
                            <div class="form-group">
                                <input type="hidden" id="group_id" name="group_id">
                                <label for="grname" class="col-md-12"><b>Core Subjects</b></label>
                                <div class="col-md-8">
                                    <table class="table">
                                        <tbody id="core_subjects" class="core_subjects">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="grname" class="col-md-12"><b>Please select elective subjects from
                                    bellow</b></label>
                                <div class="col-md-8">
                                    <table class="table">
                                        <tbody id="elective_subjects" class="elective_subjects">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="subj_group" name="subj_group"/>
                    <input type="hidden" id="stu_subj_id" name="stu_subj_id"/>
                    <input type="hidden" id="stu_id" name="stu_id"/>
                    <input type="hidden" id="center_id" name="center_id"/>
                    <input type="hidden" id="course_id" name="course_id"/>
                    <input type="hidden" id="batch_id" name="batch_id"/>
                    <input type="hidden" id="semester_no" name="semester_no"/>
                    <input type="hidden" id="year_no" name="year_no"/>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info btn-md" name="submit"
                        onclick="event.preventDefault(); approve_student_subject()">Approve
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>

    </div>
</div>

<!-- end  Subject Approve model    -->

<!-- Exam Mark Modal-->
<div class="modal fade bs-example-modal-lg" id="marks_modal">
    <div class="modal-dialog modal-lg" style="width:70%;padding-top:13px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal_title" id="modal_title">Student Marks</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" id="student_mark_form"
                      name="student_mark_form" autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" id="student_id" name="student_id" hidden>
                            <label for="student" class="control-label">Student Name: </label>
                            <label for="student_name" id="student_name" class="control-label"> </label>
                        </div>
                        <div class="col-md-4">
                            <label for="reg_no" class="control-label">Reg No: </label>
                            <label for="reg_no_data" id="reg_no" class="control-label"></label>
                        </div>
                        <div class="col-md-4">
                            <label for="admmision" class="control-label">Admission No : </label>
                            <label for="admmision_data" id="addmission_no" class="control-label"></label>
                        </div>
                    </div>
                    <div>
                        <table class="table table-bordered" id="mark_data_tbl">
                        </table>
                        <div id="hidden_div" style="">
                        </div>
                        <div id="note">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" onclick="mark_approve_status_level1(1);">
                    Approve
                </button>
                <button type="button" class="btn btn-primary pull-left hidden" onclick="mark_approve_status_level1(2);">
                    Reject
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Exam Mark Modal-->

<!-- Exam timetable view modal -->
<div class="modal fade bs-example-modal-lg" id="viewtimetable">
    <div class="modal-dialog modal-lg" style="width:100%;padding-top:13px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <span id="view_description"></span>
            </div>
            <div class="modal-body">
                <table id="tbllkupvw" class="cell-border" style="width:100%" cellspacing="0">
                    <thead id="tbllkupvw_head">
                    <tr>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody id="tbllkupvw_body"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end exam timetable view modal -->
<div id="dialog-confirm"></div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

var rpt_selected_batch = "";

    $(function () {
        $('#exam_marks_tbl').DataTable({
            'ordering': true,
            'lengthMenu': [25, 50]
        });
        
        $('#subject_approval_tbl').DataTable({
            'ordering': false,
            'paging':false,
             columnDefs: [
                { targets: [0, 3], className: 'text-center'}
            ]
        });

    });
    if ($('#l_course').length) {
        load_course_list(($('#l_course').val()), 1, null);
    }

    $(document).ready(function () {
        $('#bulkSpinner').hide();
        $('#exam_request_bulk_approval_btn').prop("disabled", true);
        
        $('#lbl_error').hide();
        $('#apply_recorrection_exam_tbl').DataTable({
            'ordering': false,
            'lengthMenu': [10, 25, 50, 75, 100]
        });
        
        var promCourse = $('#prom_centre').val();
        if(promCourse != ""){
            get_courses(promCourse, 1, null, 0);
        }
        
        
        var recorrectCourse = $('#req_recorrection_centre').val();
        if(recorrectCourse != ""){
            load_recorrection_courses(recorrectCourse);
        }
        
        if($('#eh_center').length){
            sem_load_course_list($('#eh_center').val(), 1, null);
        }
        


        //datatable initial

        $('#exam_time_tbl').DataTable({
            "ordering": false,
            "lengthMenu": [10, 25, 50, 75, 100],
            "columnDefs": [{
                "targets": 4,
                "orderable": false
            }]
        });

        $('#exam_time_reject_tbl').DataTable({
            "ordering": false,
            "lengthMenu": [10, 25, 50, 75, 100],
            "columnDefs": [{
                "targets": 4,
                "orderable": false
            }]
        });
        
        $('#print_students_semester_subject_btn').attr("disabled", true);

        ////////////////////////Postpone Radio Button Filter - Bavithran////////////////

        var table = $('#approve_postpone_tbl').DataTable({
            "scrollX": true
        });

        var type = $("input[name='type']:checked").val();
        table
            .columns(9)
            .search(type)
            .draw();

        $('input:radio').change(function () {
            // alert('changed');
            table
                .columns(9)
                .search($("input[name='type']:checked").val())
                .draw();
        });
        ////////////////////////End of Postpone Radio Button Filter - Bavithran/////////

        //===================repeat student ======
        $("#rpt_exam_data_div").hide();
        //===================end repeat student ======
        
        
        if($('#current_exam').is(":checked") == true){
            $('#search_students').show();
            $('#search_students_repeat').hide();
        }

    });

    $.validate({
        form: '#apply_exam_form'
    });


    $.validate({
        form: '#postpone_form'
    });

    $.validate({
        form: '#med_def_form'
    });

    function get_courses(center_id, flag, course_id, lookup_flag) {

        $('#subject_course').find('option').remove().end().append('<option value=""></option>').val('');
        $('#course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#coursep').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#l_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#course_med').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#mark_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#rpt_exam_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');


        $('#lecture_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (lookup_flag) {
                            $('#l_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                        } else {
                            $('#course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#coursep').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#lecture_ttbl_center').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#course_med').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#mark_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#subject_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#exam_ttbl_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                            $('#rpt_exam_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                        }

                    }
                },
                "json"
            );
        }
    }

//    function update_examtime_status(ttbl_id, approved) {
//        $.ajax(
//            {
//                url: "<?php // echo base_url('Approvals/update_examtime_status') ?>",
//                type: 'POST',
//                async: true,
//                cache: false,
//                dataType: 'json',
//                data: {'ttbl_id': ttbl_id, 'approved': approved},
//                success: function () {
//                    location.reload();
//                }
//            });
//    }


    function update_exam_status(semester_id, stu_id, is_approved, sub_count) {
        var rej_subjects = [];
        var rejected_reason = [];
        var rejected_sub_code = [];
        var req_subjects = [];
        var chk_class = 'class=' + stu_id;
        var sub_rejects = 0;
         var disable_count = 0;
        $('input:checkbox[' + chk_class + ']').each(function () {
            if ($(this).is(':disabled')) {
                disable_count++;
            }
            else {
                if ($(this).is(":checked")) {
                    req_subjects.push($(this).val());
                }
                else {
                    rej_subjects.push($(this).val());
                    rejected_sub_code.push($(this).attr("name"));
                    sub_rejects++;
                }
            }
        });
        
        if(disable_count == sub_count){
            funcres = {status: "denied", message: "Request Already Done."};
            result_notification(funcres);
        } else {
        
        //console.log(rej_subjects);
        // console.log(rejected_sub_code);
        //console.log(sub_rejects);
        // $("#apply_exam_form :input").prop("disabled", false);
        if (sub_rejects > 0) {
            $("#rejected_subject").empty();
            
            $.post("<?php echo base_url('approvals/get_exam_reject_reason') ?>", {},
                    function (data) {
                        
                        for (a = 0; a < rejected_sub_code.length; a++) 
                        {  
                            //alert(a); <textarea class="form-control" id="rejected_reason" rows="3" value=""></textarea>
                            var reason_cntrl_id = "reject_reason_"+rejected_sub_code[a];
                            var txt_reason_cntrl_id = "rejected_reason_"+rejected_sub_code[a];
                            $("#rejected_subject").append('<label>Enter Reason : ' + rejected_sub_code[a] + ' </label><br/><select id="'+reason_cntrl_id+'" class="form-control" style="width:75%" \n\
                                        name="reject_reason" onchange="show_text_area(this.value, \''+ rejected_sub_code[a]+'\');" data-validation="required" data-validation-error-msg-required="Field can not be empty"></select><br/>\n\
                                        <div id="other_reason"><label id="other_label">Please Enter Other Reject Reason Here.</label><textarea class="form-control" id="'+txt_reason_cntrl_id+'" rows="2" value=""></textarea>\n\
                                        </div>');

                            $('#'+reason_cntrl_id).append('<option value="0">--Select Reason--</option>');
                            for (var x = 0; x < data.length; x++) {
                                $('#' + reason_cntrl_id).append($("<option></option>").attr("value", data[x]['reason_id']).text(data[x]['reject_reason']));
                            }
                            $('#'+reason_cntrl_id).append('<option value="-1">Other Reason</option>');
                            $('#other_label').attr('disabled', true);
                            $('input[type="text"], textarea').attr('readonly','readonly');

                        }
                        
                    },
                    "json");
            
            

            $(".modal-body #student_ids").val(stu_id);// text box value
            $(".modal-body #approved_sub_id").val(req_subjects);// text box value
            $(".modal-body #reject_sub_id").val(rej_subjects);// text box value
            $(".modal-body #reject_sub_code").val(rejected_sub_code);// text box value
            $(".modal-body #reject_semester_id").val(semester_id);// text box value
            // $(".modal-body #rejected_reason").val(''); //clearing after new

            $("#exam_reject").modal();
        }
        else {
            update_subject_request_approvals(semester_id, stu_id, rej_subjects, req_subjects, rejected_reason);
        }
        }
    }
    
    
    function show_text_area(reason, rejected_sub_code){    
    contrl_id = "rejected_reason_"+rejected_sub_code;
        if(reason != ""){
            if(reason == "-1"){
                
                //alert(contrl_id);
                $('#other_label').attr('disabled', false);
                $('#'+contrl_id).attr('readonly', false);
                //$('input[type="text"], textarea').attr('readonly',false);
            }
            else{
                $('#other_label').attr('disabled', true);
                //$('input[type="text"], textarea').attr('readonly','readonly');
                $('#'+contrl_id).attr('readonly', true);
                $('#'+contrl_id).val("");
            }
        }
//        else{
//            $('#other_label').attr('disabled', true);
//            //$('input[type="text"], textarea').attr('readonly','readonly');
//            $('#'+contrl_id).attr('readonly', true);
//            $('#'+contrl_id).val("");
//        }
    }
    
    

    //approval exam subject wise
    function update_subject_request_approvals(semester_id, stu_id, rej_subjects, req_subjects, rejected_reason) {
        $.ajax(
            {
                url: "<?php echo base_url('Approvals/update_exam_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    'stu_id': stu_id,
                    'semester_id': semester_id,
                    'rej_subjects': rej_subjects,
                    'req_subjects': req_subjects,
                    'rejected_reason': rejected_reason
                },
                success: function (data) {

                    var jsonData = JSON.parse(data);
                    if (jsonData == 'denied') {

                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        //alert(jsonData.status);
                        //alert(jsonData);
                        result_notification(jsonData);

                        if (jsonData.status == 'success') {
                            load_apply_exam_data();
                            $('#exam_reject').modal('hide');
                        }
                    }

                }
            });

    }

    function update_exam_rej_status(is_approved) {

        var rejected_reasons = [];
        var rej_subjects = [];
        var req_subjects = [];

        // var rejected_reason=$("#rejected_reason").val();

        var rejected_sub = $("#reject_sub_id").val();
        var rejected_sub_code = $("#reject_sub_code").val();
        var approved_sub = $("#approved_sub_id").val();
        var stu_id = $("#student_ids").val();
        var semester_id = $("#reject_semester_id").val();

        var rej_subjects = rejected_sub.split(',');
        var req_subjects = approved_sub.split(',');
        var rej_subjects_code = rejected_sub_code.split(',');

        // alert(rej_subjects.length)
        for (s = 0; s < rej_subjects.length; s++) 
        {
            var contrl_id = "rejected_reason_"+rej_subjects_code[s];
            var reason_cntrl_id = "reject_reason_"+ rej_subjects_code[s];
            if($('#' + reason_cntrl_id).val() == "0")
            {
                $('#lbl_error').show();
                return false;
            }
            else if($('#' + reason_cntrl_id).val() == "-1"){
                if($('#'+contrl_id).val() == "")
                {
                    $('#lbl_error').show();
                    return false;
                }
                else
                {
                    rejected_reasons.push($('#'+contrl_id).val());
                    $('#lbl_error').hide();
                }
            }
            else{
                rejected_reasons.push($('#'+reason_cntrl_id + ' option:selected').text());
                $('#lbl_error').hide();
            }
        }

        update_subject_request_approvals(semester_id, stu_id, rej_subjects, req_subjects, rejected_reasons);

    }

    function load_semester_exam(batch_id) {
        $('#exam').find('option').remove().end();
        $('#exam').append('<option value="">---Select Course Code---</option>').val('');
        $('#mark_exam').find('option').remove().end();
        $('#mark_exam').append('<option value="">---Select Exam Code---</option>').val('');
//            $('#exam1').find('option').remove().end().append('<option value=""></option>').val('');
//            //$('#exam2').find('option').remove().end().append('<option value=""></option>').val('');
//            $('#lecture_ttbl_exam').find('option').remove().end().append('<option value=""></option>').val('');
//            $('#exam_ttbl_exam').find('option').remove().end().append('<option value=""></option>').val('');


        //if(flag ===1){
        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#exam').append($("<option></option>").attr("value", data[i]['sem_exam_id']).text(data[i]['exam_code']));
                    $('#mark_exam').append($("<option></option>").attr("value", data[i]['sem_exam_id']).text(data[i]['exam_code']));
//                                if (lookup_flag) {
//                                    $('#exam').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['exam_code']));
//                                } 
//                                else  {
//                                    
////                                    $('#exam1').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
////                                    $('#exam2').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
////                                    $('#lecture_ttbl_exam').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
////                                    $('#exam_ttbl_exam').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
//                                }
                }
            },
            "json"
        );
        //}
    }

    function load_course_list(center_id, selectedid, selected) {
        //set REG NUmber..
        var sel_val = selected.options[selected.selectedIndex].text;
        center_code = sel_val.split('-')[0].trim();

        //$('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('approvals/load_course_list') ?>", {'center_id': center_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {

                    $("#course_id").append($('<option>', {
                        value: data[i]['course_id'],
                        text: data[i]['course_code'] + ' - ' + data[i]['course_name']
                    }));


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

    function set_reg_no(sel) {
        //set REG NUmber..
        var sel_val = sel.options[sel.selectedIndex].text;
        course_code = sel_val.split('-')[0].trim();

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        if ($('#reg_no_part2').val() != "") {
            load_data($('#reg_no_part1').val() + $('#reg_no_part2').val());
        }
    }

    function subject_get_course_code(course_id, lookup_flag) {

        $('#subject_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#l_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#batchp').find('option').remove().end().append('<option value=""></option>').val('');
        $('#batch_med').find('option').remove().end().append('<option value=""></option>').val('');

        $('#lecture_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');

        $('#l_no_year').find('option').remove().end().append('<option value="0">---Select Year---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    if (lookup_flag) {
                        $('#l_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                    } else {
                        $('#batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#batchp').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#batch_med').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#subject_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#lecture_ttble_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#exam_ttble_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                    }
                }


                $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
                    function (data) {

                        if (data != null) {
//                            console.log(data);
                            if (typeof data['current_year'] === 'undefined') {
                                //alert('true');
                                for (var i = 1; i <= data['no_of_year']; i++) {
                                    //if (flag) {
                                    //if (i == year_no) {
                                    // if (lookup_flag) {
                                    // $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
//                                                }
//                                                $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
//                                            } else {
//                                                if (lookup_flag) {
                                    $('#l_no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
//                                                }
//                                                $('#no_year').append($("<option></option>").attr("value", i).text(i));
//                                            }
                                    //} else {
                                    //    if (lookup_flag) {
                                    //        $('#l_no_year').append($("<option></option>").text(i));
                                    //    }
                                    //    $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                    //}
                                }
                            } else {


                                //alert('false');
                                var current_year = data['current_year'];

                                //if (flag) {

                                //if (lookup_flag) {
                                $('#l_no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                //}
                                //$('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));

//                                    }else{
//                                        if (lookup_flag) {
//                                            $('#l_no_year').append($("<option></option>").text(current_year));
//                                        }
//                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));
//                                    }


                            }


                        }

                    },
                    "json"
                );

            },
            "json"
        );
    }

    function subject_load_semester(year_no) {
        $('#l_no_semester').find('option').remove().end().append('<option value="0">---Select Semester---</option>').val('');

        var course_id = $('#subject_course').val();


        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
//                console.log(data);
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (typeof data['current_semester'] === 'undefined') {
                        for (var i = 1; i <= data; i++) {

                            $('#l_no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));

                        }
                    } else {

                        var current_semester = data['current_semester'];
                        $('#l_no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));


                    }


                }
            },
            "json"
        );
    }

    function get_course_code(course_id, lookup_flag) {
        $('#l_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#batchp').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#batch_med').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#mark_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

        $('#lecture_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');


        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    if (lookup_flag) {
                        $('#l_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                    } else {
                        $('#batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#batchp').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#batch_med').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#mark_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#lecture_ttble_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        $('#exam_ttble_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                    }
                }


            },
            "json"
        );
    }

    function load_student_subject_approval_list() {
        
        $('.se-pre-con').fadeIn('slow');

        var res = [];
        var obj = {};
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        var sem_codes_subjects = [];
        var center_id = $("#subject_prom_centre").val();
        var course_id = $("#subject_course").val();
        var batch_id = $("#subject_batch").val();
        var semester_no = $("#l_no_semester").val();
        var year_no = $("#l_no_year").val();

        if (batch_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        }
        else {

            $.post("<?php echo base_url('approvals/load_student_request_approval_subjects') ?>", {
                    'center_id': center_id,
                    'course_id': course_id,
                    'batch_id': batch_id,
                    'semester_no': semester_no,
                    'year_no': year_no
                },

                function (data) {

//                    console.log(data);
                    if (data == null || data == '') {

                        $('#subject_approval_load_thead').find('tr').remove();
                        $('#subject_approval_load_student').find('tr').remove();
                        $('#subject_approval_load_thead').append("<tr><th>#</th><th>Reg No</th><th >Student Name</th><th >Action </th></tr>");
                        $('#subject_approval_load_student').append('<tr><td colspan="10" align="center">No records to show.</td></tr>');


                    }
                    else {
                        $('#subject_approval_tbl').DataTable().clear();
                        $("#subject_approval_tbl").find('tbody').empty();
                        // $('#subject_approval_load_thead').find('tr').remove();
                        if (data.length > 0) {
                            $('#subject_approval_load_student').find('tr').remove();
                            // $('#subject_approval_load_thead').append("<tr><th>#</th><th>Reg No</th><th >Student Name</th></tr>");

                            /*$('#subject_approval_tbl tr:last').append(sem_subject_code
                                .map(id => `<th>${id}</th>`)
                                .join(''))
                                .appendTo($('#subject_approval_load_thead'));*/
                            /*//   $('#subject_approval_tbl tr:last').append("<th >Action </th>").appendTo($('#subject_approval_load_student'));*/
                            for (j = 0; j < data.length; j++) {
 
                                for (x = 0; x < data[j]['selected_subjects'].length; x++) {

                                    selected_subjects.push(data[j]['selected_subjects'][x]['subject_id']);//current_semester   data-target='#Subject_approve'  stu_id  Subject_approve   approve_student_subject("+ data[j]['stu_id'] +", 1)
                                }

                                var approval_btn = "<button id='subject_approval_"+data[j]['stu_id']+"' title='Subject Approve'  data-toggle='modal'  onclick='event.preventDefault();show_subject_approvel(" + data[j]['stu_id'] + "," + data[j]['selected_subjects'][0]['student_subject_id'] + ")' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";// +

                                //----$('#subject_approval_load_student').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + "</td> </tr>");
                                /*  $('#subject_approval_tbl tr:last').append(sem_subject_ids
                                      .map(id => `<td style='text-align: center' >${selected_subjects.includes(id) ? '<input type="checkbox" class="' + data[j]['stu_id'] + '" id="chk_subject_'+ data[j]['stu_id']+'" name="' + findObjectByKey(sem_codes_subjects, "id", id) + '" value="' + id+data[j]['selected_subjects'][0]['stu_id'] + '" checked > ' : ' <input type="checkbox" class="' + data[j]['stu_id'] + '" id="' + data[j]['stu_id'] + "_" + id + '" name="' + findObjectByKey(sem_codes_subjects, "id", id) + '" value="3"  >'}</td>`)
                                      .join(''))
                                      .appendTo($('#subject_approval_load_student'));*/
                               //--- $('#subject_approval_tbl tr:last').append("<td style='text-align: center'>" + approval_btn + "</td>").appendTo($('#subject_approval_load_student'));
                               $('#subject_approval_tbl').DataTable().row.add([
                                    (j + 1),
                                    data[j]['reg_no'],
                                    data[j]['first_name'],
                                    approval_btn
                                ]).draw(false);
                                
                                selected_subjects = [];

                            }

                        }
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
            );

        }
    }

    function load_apply_exam_data() {
        
        $('.se-pre-con').fadeIn('slow');
        var res = [];
        var obj = {};
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        var sem_codes_subjects = [];
        var batch_id = $('#batch').val();
        if (batch_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/load_semester_subjects') ?>", {'batch_id': batch_id},
                function (data1) {
//                      console.log(data1);
                    var sub_count = data1.length;
//                    console.log(sub_count);
                    for (var i = 0; i < data1.length; i++) {
                        sem_subject_ids.push(data1[i]['subject_id']);
                        sem_subject_code.push(data1[i]['code']);
                        sem_subject_names.push(data1[i]['subject']);
                        //sem_codes_subjects.push( data1[i]['subject_id']);
                        //obj[{ data1[i]['subject_id']}]=data1[i]['code'];
                        sem_codes_subjects.push({id: data1[i]['subject_id'], code: data1[i]['code']});


                        if (data1[i]['subject_type'] == '1') {
                            sem_subject_types.push("Core");
                        } else {
                            sem_subject_types.push("Elective");
                        }

                    }//sem_codes_subjects.push(obj);

                    $.post("<?php echo base_url('student/load_student_applied_exam') ?>", {
                            'batch_id': batch_id,
                            'branch': $('#prom_centre').val()
                        },
                        function (data) {

//                            console.log(data);
                            //console.log(sem_codes_subjects);
                            if (data == null || data == '') {

                                $('#load_thead').find('tr').remove();
                                $('#load_student').find('tr').remove();
                                $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th >Student Name</th><th >Action </th></tr>");
                                $('#load_student').append('<tr><td colspan="10" align="center">No records to show.</td></tr>');


                            }
                            else {
                                $('#exam_request_bulk_approval_btn').prop("disabled", false);
                                //console.log(sem_codes_subjects);
                                //console.log("sem_subject_code:" + sem_subject_code);
                                $('#load_thead').find('tr').remove();
                                if (data.length > 0) {
                                    $('#load_student').find('tr').remove();
                                    $('#load_thead').append("<tr><th><input type='checkbox' onchange='exam_request_check_all()' name='select_all_exam_request'/><br/>Select All</th><th>#</th><th>Reg No</th><th >Student Name</th></tr>");

                                    $('#apply_exam_req tr:last').append(sem_subject_code
                                        .map(id => `<th>${id}</th>`)
                                        .join(''))
                                        .appendTo($('#load_thead'));
                                    $('#apply_exam_req tr:last').append("<th >Action </th>").appendTo($('#load_student'));
                                    
                                    for (j = 0; j < data.length; j++) {

                                        //console.log(sem_subject_ids);
                                        // console.log(sem_subject_code);
                                        // console.log(sem_subject_names);
                                        // console.log(sem_subject_types);

                                        // " | <button id =\"reject_btn\" title=\"Reject\" data-toggle=\"modal\" data-id=\"\" data-target=\"#exam_reject\" onclick=\"\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";

//console.info(data[j]['selected_subjects']);
                                        for (x = 0; x < data[j]['selected_subjects'].length; x++) {
                                            if(data[j]['selected_subjects'][x]['is_approved'] == 1){
                                                selected_subjects.push(data[j]['selected_subjects'][x]['subject_id']);//current_semester   stu_id
                                            }
                                            
                                        }

                                        var approval_btn = "<button id=\"exam_approval_"+(j+1)+"\" title=\"Approve\"  data-toggle=\"modal\" data-id=\"\" data-target=\"#\" onclick=\"event.preventDefault();update_exam_status('" + data[j]['semester_exam_id'] + "','" + data[j]['stu_id'] + "', '1','"+sub_count+"')\" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";// +

                                        // var zz = findObjectByKey(sem_codes_subjects, 'code', 'TC02');
                                        // alert(zz);

                                        $('#load_student').append("<tr " + (j + 1) + "' id = 'tr_"+ (j+1) +"'><td><input type='checkbox' id='exm_request_check_box-"+ (j+1) +"' onchange='exam_request_check(this.id)' name='exm_request_check_box' value='"+data[j]['stu_id']+"'/></td><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + "</td> </tr>");
                                        $('#apply_exam_req tr:last').append(sem_subject_ids
                                            .map(id => `<td style='text-align: center'>${selected_subjects.includes(id) ? '<input type="checkbox" class="' + data[j]['stu_id'] + '" id="' + data[j]['stu_id'] + "_" + id + '" name="' + findObjectByKey(sem_codes_subjects, "id", id) + '" value="' + id + '" checked >' : ' <input type="checkbox" class="' + data[j]['stu_id'] + '" id="' + data[j]['stu_id'] + "_" + id + '" name="' + findObjectByKey(sem_codes_subjects, "id", id) + '" value="3" disabled="disabled" >'}</td>`)
                                            .join(''))
                                            .appendTo($('#load_student'));
                                        $('#apply_exam_req tr:last').append("<td style='text-align: center'>" + approval_btn + "</td>").appendTo($('#load_student'));
                                        selected_subjects = [];

                                    }

                                }
                            }
                        },
                        "json"
                    );
                $('.se-pre-con').fadeOut('slow');    
                },
                "json"
            );

        }
    }

    function findObjectByKey(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return array[i]["code"];
            }
        }
        return null;
    }

    function load_student_data() {
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        var batch_id = $('#batch').val();
        // var batch_id = $('#mark_batch').val();
        if (batch_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch';
            result_notification(res);
        } else {
            $.post("<?php echo base_url('subject/load_semester_subjects') ?>", {'batch_id': batch_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        sem_subject_ids.push(data[i]['subject_id']);
                        sem_subject_code.push(data[i]['code']);
                        sem_subject_names.push(data[i]['subject']);
                        if (data[i]['subject_type'] == '1') {
                            sem_subject_types.push("Core");
                        } else {
                            sem_subject_types.push("Elective");
                        }

                    }
                },
                "json"
            );
            $.post("<?php echo base_url('student/load_student_for_apply_exam') ?>", {
                    'batch_id': batch_id,
                    'branch': $('#prom_centre').val()
                },
                function (data) {
                    $('#load_thead').find('tr').remove();
                    if (data.length > 0) {
                        $('#load_student').find('tr').remove();
                        $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                        $('#apply_exam_tbl tr:last').append(sem_subject_code
                            .map(id => `<th>${id}</th>`)
                            .join(''))
                            .appendTo($('#load_thead'));
                        for (j = 0; j < data.length; j++) {
                            $('#load_student').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['admission_no'] + "</td><td>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td></tr>");
                            for (x = 0; x < data[j]['selected_subjects'].length; x++) {
                                selected_subjects.push(data[j]['selected_subjects'][x]['subject_code']);
                            }

                            $('#apply_exam_tbl tr:last').append(sem_subject_code
                                .map(e => `<td>${selected_subjects.includes(e) ? '<input type="checkbox" name="apply_exam[' + data[j]['stu_id'] + '][]" value="' + e + '">' : "Not Selected"}</td>`)
                                .join(''))
                                .appendTo($('#load_student'));
                            selected_subjects = [];
                        }

                    }
                },
                "json"
            );
        }
    }

    function load_year_data(exam_id, year_no) {
        $('#mark_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');


        var course_id = $('#mark_course').val();

        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        //if (flag) {
                        if (i == year_no) {
                            $('#mark_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                        } else {
                            $('#mark_year').append($("<option></option>").attr("value", i).text(i+" Year"));
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

    function apply_exam() {
        $.ajax(
            {
                url: "<?php echo base_url('student/apply_exam') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#apply_exam_form').serialize(),
                success: function (data) {
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        result_notification(data);
                        if (data['status'] == 'success') {
                            location.reload();
                        }
                    }
                }
            });
    }

    function load_applied_data() {
        $('#lookup_body').find('tr').remove();
        $.post("<?php echo base_url('exam/applied_exams_for_lookup') ?>", $('#lookup_form').serialize(),
            function (data) {
                for (i = 0; i < data.length; i++) {
                    action = "<button title='view' type='button' class='btn btn-success btn-xs' onclick='open_modal(" + data[i]['sem_ex_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></button>";
                    $('#lookup_body').append("<tr><td>" + (i + 1) + "</td><td>" + data[i]['year_no'] + "</td><td>" + data[i]['semester_no'] + "</td><td>" + data[i]['exam_code'] + "</td><th>" + action + "</th></tr>");
                }
            },
            "json"
        );
    }

    function open_modal(sem_exam_id) {

        $('#view_modal').modal('show');
        var course_id = $('#l_course').val();
        var batch_id = $('#l_batch').val();

        $.ajax(
            {
                url: "<?php echo base_url('exam/load_applied_students')  ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    'sem_exam_id': sem_exam_id,
                    'course_id': course_id,
                    'batch_id': batch_id,
                    'branch': $('#l_prom_centre').val()
                },
                success: function (data) {
                    for (i = 0; i < data.length; i++) {
                        $('#app_stu_body').append("<tr><td>" + (i + 1) + "</td><td>" + data[i]['reg_no'] + "</td><td>" + data[i]['admission_no'] + "</td><td>" + data[i]['first_name'] + " " + data[i]['last_name'] + "</td><td>" + data[i]['code'] + "</td></tr>");
                    }


                }
            });
    }

    function load_semesters(year_no) {
        $('#mark_semester').find('option').remove().end().append('<option value="0">---Select Semester---</option>').val('');
        var course_id = $('#mark_course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    for (var i = 1; i <= data; i++) {
                        //if (semester_no == i) {


                        $('#mark_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));

                        // }
                    }

                }
            },
            "json"
        );
    }

    function approve_student_subject() {
        
        var studentId = $('#stu_id').val();

        $.ajax(
            {
                url: "<?php echo base_url('Approvals/approve_student_subject') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#grp_form').serialize(),
                success: function (data) {

                    // var jsonData = JSON.parse(data);
                    var jsonData = data;
                    if (jsonData == 'denied') {

                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        //alert(jsonData.status);
                        //alert(jsonData);
                        result_notification(jsonData);

                        if (jsonData.status == 'success') {
                            $('#Subject_approve').modal('hide');
                            //load_student_subject_approval_list();
                            //var rowIndex = $('#subject_approval_'+studentId).closest('tr').index();
                           // $('#subject_approval_tbl').DataTable().row(rowIndex).remove().draw(false);
                            load_student_subject_approval_list();
                            

                        }
                    }

                }
            });
    }

    function show_subject_approvel(stu_id, subject_student_id) {
    
        var year = $('#l_no_year').val();
        var semester = $('#l_no_semester').val();

        //alert(stu_id);
        $.post("<?php echo base_url('subject/load_edit_student_subjects') ?>", {'id': subject_student_id, 'year_no': year, 'semester_no': semester},
            function (data) {
//                console.log(data);

                $('#stu_subj_id').val(subject_student_id);
                $('#subj_group').val(data['follow_subject'][0]['subj_group']);
                $('#stu_id').val(stu_id);
                $('#center_id').val($("#subject_prom_centre").val());
                $('#course_id').val($("#subject_course").val());
                $('#batch_id').val($("#subject_batch").val());
                $('#semester_no').val($("#l_no_semester").val());
                $('#year_no').val($("#l_no_year").val());


                $(".core_subjects").empty();
                $(".elective_subjects").empty();
                $("#div_subjects").css("display", "block");

                for (x = 0; x < data['all_subjects'].length; x++) {
                    if (data['all_subjects'][x]['type'] == 1) {
                        $("#core_subjects").append("<tr><td><input type='hidden' name='c_subject[]' id='c_subject' value='" + data['all_subjects'][x]['subject_id'] + "'> <input type='hidden' name='c_subject_version[]' id='c_subject_version' value='" + data['all_subjects'][x]['version_id'] + "'>[" + data['all_subjects'][x]['code'] + "] - " + data['all_subjects'][x]['subject'] + "</td></tr>");
                    } else {
                        $("#elective_subjects").append("<tr><td><input type='checkbox' name='e_subject[]' id ='e_subject' value='" + data['all_subjects'][x]['subject_id'] + "'><input type='hidden' name='e_subject_version[]' id='e_subject_version' value='" + data['all_subjects'][x]['version_id'] + "'>&nbsp;&nbsp;&nbsp;[" + data['all_subjects'][x]['code'] + "] - " + data['all_subjects'][x]['subject'] + "</td></tr>");

                        for (y = 0; y < data['follow_subject'].length; y++) {

                            if ((data['follow_subject'][y]) != undefined) {

                                var follow_subj = (data['follow_subject'][y]['subject_id']);
                                //
                                if ((data['all_subjects'][x]['subject_id']) == follow_subj) {
                                    //$("#elective_subjects").append("<tr><td><input type='checkbox' name='e_subject[]' id ='e_subject' value='" + data['all_subjects'][x]['subject_id'] + "' checked><input type='hidden' name='e_subject_version[]' id='e_subject_version' value='" + data['all_subjects'][x]['version_id'] + "'>&nbsp;&nbsp;&nbsp;" + data['all_subjects'][x]['subject'] + "</td></tr>");
                                    $("input[type=checkbox][value=" + data['all_subjects'][x]['subject_id'] + "]").prop("checked", true);
                                }
                            }
                        }
                    }
                }
                $('#Subject_approve').modal('show');
            },
            "json"
        );

    }

    //Approval markes

    function click_mark(subject_code, stu_id) {
        $("#" + stu_id + "_subject_mark_" + subject_code)[0].click();

    }

    function load_student_data_mark_approval() {
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var applied_subjects = [];
        var subjects_marks = {};
        var subjects_code = [];
        var batch_id = $('#mark_batch').val();
        var course_id = $('#mark_course').val();
        var year = $('#mark_year').val();
        var semester = $('#mark_semester').val();

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
        } else {
            $.post("<?php echo base_url('subject/semester_subjects_by_semester') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
//                    console.log(header_data);
                    for (var i = 0; i < header_data.length; i++) {
                        sem_subject_ids.push(header_data[i]['subject_id']);
                        sem_subject_code.push(header_data[i]['code']);
                        sem_subject_names.push(header_data[i]['subject']);
                        if (header_data[i]['subject_type'] == '1') {
                            sem_subject_types.push("Core");
                        } else {
                            sem_subject_types.push("Elective");
                        }

                    }
                    //create table heard
                    $('#exam_marks_tbl').DataTable().clear();

                    $('#exam_marks_tbl').find('tbody').empty();
                    $('#exam_marks_load_thead').find('tr').remove();
                    $('#exam_marks_tbl').DataTable().rows().remove();

                    $('#exam_marks_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                    $('#exam_marks_tbl tr:last').append(sem_subject_code
                        .map(id => `<th>${id}</th>`)
                        .join(''))
                        .appendTo($('#exam_marks_load_thead'));

                    // end create table heard
                    $.post("<?php echo base_url('student/load_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester
                        },
                        function (data) {
//                            console.log(data);

                            $('#exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {


                                for (j = 0; j < data.length; j++) {
                                    $('#exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['admission_no'],
                                        data[j]['first_name'] + " " + data[j]['last_name']
                                    ]).draw(false);
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_code']);
                                        subjects_marks[data[j]['applied_subjects'][x]['subject_code']] = "N/A";

                                    }


//                                    console.log(data[j]['exam_mark']);
                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs

                                        if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {
                                            var style_class = 'btn btn-success btn-xs';
                                            var tooltip = 'Approved'
                                        }
                                        else {
                                            var style_class = 'btn btn-warning btn-xs';
                                            var tooltip = 'To be Approve '
                                        }


                                        var approval_btn = '<button id="mark_approval" title="' + tooltip + '"    onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_code'] + '\',' + data[j]['stu_id'] + ')" class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';


                                        subjects_marks[data[j]['exam_mark'][z]['subject_code']] = data[j]['exam_mark'][z]['total_marks'] + "/" + data[j]['exam_mark'][z]['overall_grade'] + "<br>" + approval_btn;

                                    }

                                    //console.log(subjects_marks);
                                    $('#exam_marks_tbl tr:last').append(sem_subject_code
                                        .map(e => `<td>${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\');"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
//
                                }

                            } else {
                                $('#exam_marks_load_student').append("<tr><td colspan='10' align='center' >No records to show.</td></tr>");

                            }
                        },
                        "json"
                    );
                },
                "json"
            );


        }
    }

    function calculate_total(id) {

        totalmarks = 0;
        grade = '';
        marks = '';
        $('.marks_' + id).each(function (i, obj) {
            temp = this.id.split('_');
            inp_perc = $('#pers_' + temp[1] + '_' + temp[2]).val();

            if (isNaN(this.value)) {
                marks = '';
            } else {
                marks = this.value;
            }
            totalmarks += (marks / 100) * inp_perc;

            $.post("<?php echo base_url('grading_method/get_grade_by_marks') ?>", {
                    'grading_id': temp[3],
                    'totalmarks': totalmarks
                },
                function (data) {
                    $('#grade_' + id).val(data);
                },
                "json"
            );

        });
        $('#totalmark_' + id).val(totalmarks);
    }

    function open_mark_model(batch_id, stu_id, subject_code) {
        //alert($("#subject_mark_"+subject_code).text());
        var mark = $("#" + stu_id + "_subject_mark_" + subject_code).text();
//alert(mark);
        if (mark == 'N/A') {
            funcres = {status: "Fail", message: "Mark Not Available"};
            result_notification(funcres);
        }
        else {
            $('#note').empty();
            $('#hidden_div').empty();
            $('#mark_data_tbl').find('tr').remove();
            $('#marks_modal').modal({
                show: 'false'
            });
            $('#marks_modal').modal('show');

            var course_id = $('#mark_course').val();
            var year = $('#mark_year').val();
            var semester = $('#mark_semester').val();
            var exam_id = $('#mark_exam').val();

            //set val
            $('#student_id').val(stu_id);

            $.post("<?php echo base_url('student/load_student_exam_marks') ?>", {
                    'stu_id': stu_id,
                    'subject_code': subject_code,
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester,
                    'exam_id': exam_id
                },
                function (data) {
//                    console.log(data);
                    $(".modal_title").text("Exam Marks : Course: " + data['course_code'] + "- Batch : " + data['batch_code'] + "  Y" + year + "/ S" + semester);
                    jQuery("label[for='student_name']").html(data['first_name']);
                    jQuery("label[for='reg_no_data']").html(data['reg_no']);
                    jQuery("label[for='admmision_data']").html(data['admission_no']);
//
                    $('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['subject_id'] + "' hidden>");
                    $("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['subject_code'] + " - " + data['subject_details']['subject'] + " </th></tr>");
                    $("#mark_data_tbl").append("<tr><th>#</th><th>Type</th><th>Precentage</th><th>Mark</th></tr>");
                    for (j = 0; j < data['subject_details']['marking_details'].length; j++) {
                        if (data['exam_mark'][j]) {
                            var subject_mark = data['exam_mark'][j]['mark'];
                        } else {
                            var subject_mark = '';
                        }
                        if (data['subject_details']['is_attend'] == 0) {
                            var is_attempt = "readonly='readonly'";
                            subject_mark = 0;
                        }
                        else
                            var is_attempt = '';
                        $("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['subject_details']['marking_details'][j]['type'] + "</td><td>" + data['subject_details']['marking_details'][j]['percentage'] + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][j]['percentage'] + "'> <input   type='text'   name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(" + data['subject_details']['subject_id'] + ");' " + is_attempt + " /></div></td></tr>");
                    }

                    if (data['exam_mark'].length != 0) {
                        var total_marks = data['exam_mark'][0]['total_marks'];
                        var overall_grade = data['exam_mark'][0]['overall_grade'];
                    } else {
                        var total_marks = '';
                        var overall_grade = '';
                    }
                    if (data['subject_details']['is_attend'] == 0) {
                        total_marks = 0;
                        overall_grade = 'AB';
                        $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                    }
                    else
                        var is_attempt = '';
                    $("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-4'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-4'> Overall Grade :<input type='text' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");
                },
                "json"
            );
        }

    }

    function mark_approve_status_level1(status) {

        var course_id = $('#mark_course').val();
        var year = $('#mark_year').val();
        var semester = $('#mark_semester').val();
        var batch_id = $('#mark_batch').val();
        var exam_id = $('#mark_exam').val();

        $.ajax(
            {
                url: "<?php echo base_url('approvals/mark_approve_status_level1') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#student_mark_form').serialize() + "&course_id=" + course_id + "&year_no=" + year + "&semester_no=" + semester + "&exam_id=" + exam_id + "&batch_id=" + batch_id + "" + "&status=" + status + "",
                success: function (data) {
//                    console.log(data);
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        result_notification(data);
                        if (data['status'] == "success") {
                            load_student_data_mark_approval();
                            $('#marks_modal').modal('hide');
                        }
                    }
                }
            });

    }


    //////////////////////////////Request Deferement - Bavithran/////////////////////////

    function sem_load_course_list(center_id, status, edit_course) {
        if (status == 1) {
            $('#eh_course').find('option').remove().end();
            $('#eh_course').append('<option value="">---Select Course---</option>').val('');

            $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#eh_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                    }

                },
                "json"
            );
        } else {
            $('#load_Dcode').find('option').remove().end();
            $('#load_Dcode').append('<option value="">---Select Course---</option>').val('');

            $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
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


    function get_course_year(id, flag, year_no, batch_id, lookup_flag) {

        $('#load_Dname').val(id);
        $('#eh_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
        $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
        $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#eh_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    if (data != null) {
//                        console.log(data);
                        if (typeof data['current_year'] === 'undefined') {
                            //alert('true');
                            for (var i = 1; i <= data['no_of_year']; i++) {
                                if (flag) {
                                    if (i == year_no) {
                                        if (lookup_flag) {
                                            $('#eh_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                    } else {
                                        if (lookup_flag) {
                                            $('#eh_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                    }
                                } else {
                                    if (lookup_flag) {
                                        $('#eh_year').append($("<option></option>").text(i+" Year"));
                                    }
                                    $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                }
                            }
                        } else {

                            var current_year = data['current_year'];

                            if (flag) {

                                if (lookup_flag) {
                                    $('#eh_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                }
                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));

                            } else {
                                if (lookup_flag) {
                                    $('#eh_year').append($("<option></option>").text(current_year+" Year"));
                                }
                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                            }
                        }

                        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                            function (data) {

                                if (typeof data['current_year'] === 'undefined') {
                                    for (j = 0; j < data.length; j++) {
                                        if (data[j]['id'] == batch_id) {
                                            if (lookup_flag) {
                                                $('#eh_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                            $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        } else {
                                            if (lookup_flag) {
                                                $('#eh_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                            $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        }
                                    }
                                } else {


                                    if (lookup_flag) {
                                        $('#eh_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
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


    function load_semesters_defer(year_no, semester_no, lookup_flag) {

        $('#eh_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        if (lookup_flag) {
            var course_id = $('#eh_semester').val();
        } else {
            var course_id = $('#load_Dcode').val();
        }
        if (course_id == '' || course_id == null) {
            var course_id = $('#eh_course').val();
        }
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                if (data != null) {
//                    console.log(data);
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        if (typeof data['current_semester'] === 'undefined' || data['current_semester'] === null) {
                            for (var i = 1; i <= data; i++) {
                                if (semester_no == i) {
                                    if (lookup_flag) {
                                        $('#eh_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                                    }
                                    $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                                } else {
                                    if (lookup_flag) {
                                        $('#eh_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                                    }
                                    $('#no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                                }
                            }
                        } else {

                            var current_semester = data['current_semester'];

                            if (lookup_flag) {
                                $('#eh_semester').append($("<option></option>").attr("value", current_semester).text(current_semester+" Semester"));
                            }
                            $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester+" Semester"));
                        }
                    }
                }
            },
            "json"
        );
    }


    function load_exams_deferement_approval(eh_year, eh_semester, eh_course, eh_batch, selexm) {

        if (eh_course == null)
            eh_course = $('#eh_course').val();

        if (eh_year == null)
            eh_year = $('#eh_year').val();

        if (eh_semester == null)
            eh_semester = $('#eh_semester').val();

//          if (eh_batch == null)
//          eh_batch = $('#eh_batch').val();

        $.post("<?php echo base_url('exam/load_exams_deferement_approval') ?>", {
                'tt_semester': eh_semester,
                'tt_course': eh_course,
                'tt_year': eh_year,
                'tt_center': $('#eh_center').val(),
                'tt_batch': $('#eh_batch').val()
                
            },
            function (data) {
                $('#eh_exam').empty();
                $('#eh_exam').append("<option value=''>---Select Exam---</option>");
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            selectedtxt = '';
                            if (selexm == data[i]['id']) {
                                selectedtxt = 'selected';
                            }
                            $('#eh_exam').append("<option value='" + data[i]['exam_id'] + "' " + selectedtxt + ">" + data[i]['exam_code'] + " - " + data[i]['exam_name'] + "</option>");
                        }
                    }
                }
            },
            "json"
        );
    }


    function search_students_absented_approval() {
               
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        var selected_subjects1 = [];
        var subject_attendance = [];

        var center_id = $('#eh_center').val();
        var course_id = $('#eh_course').val();
        var batch_id = $('#eh_batch').val();
        var year_no = $('#eh_year').val();
        var semester_no = $('#eh_semester').val();
        var exam_id = $('#eh_exam').val();
        if (batch_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch and Exam !';
            result_notification(res);
        } else {
            
            $('.se-pre-con').fadeIn('slow');
            
            $.post("<?php echo base_url('approvals/load_semester_subjects_deferement') ?>", {'batch_id': batch_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
                function (data) {
                    //console.log(data);


                    for (var i = 0; i < data.length; i++) {
                        sem_subject_ids.push(data[i]['subject_id']);
                        sem_subject_code.push(data[i]['code']);
                        sem_subject_names.push(data[i]['subject']);
                        if (data[i]['subject_type'] == '1') {
                            sem_subject_types.push("Core");
                        } else {
                            sem_subject_types.push("Elective");
                        }

                    }

                    $.post("<?php echo base_url('approvals/load_student_who_absent_exam') ?>", {
                            'center_id': center_id,
                            'course_id': course_id,
                            'batch_id': batch_id,
                            'semester_no': semester_no,
                            'year_no': year_no,
                            'exam_id': exam_id
                            // 'student_id': exam_id,


//                                                                                                  'branch':$('#eh_center').val(),
                        },
                        function (data1) {
                            //  console.log(sem_subject_code);

                            $('#load_absent_thead').find('tr').remove();
                            if (data1.length > 0) {
                                $('#student_absent_tbl_body').find('tr').remove();
                                $('#load_absent_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                                $('#student_absent_tbl tr:last').append(sem_subject_code
                                    .map(id => `<th>${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_absent_thead'));
                                $('#student_absent_tbl tr:last').append(
                                    '<th>Deferment</th><th>Action</th>')
                                    .appendTo($('#load_absent_thead'));

                                for (j = 0; j < data1.length; j++) {
//                                    console.log(data1);
//                                    console.log('kasun');

                                    $('#student_absent_tbl_body').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data1[j]['reg_no'] + "</td><td>" + data1[j]['first_name'] + "</td></tr>");
                                    for (x = 0; x < data1[j]['selected_subjects'].length; x++) {
                                        // alert(data1[j]['selected_subjects'][x]['code']);
                                        // selected_subjects.push(data1[j]['selected_subjects'][x]['code']);
                                        if (data1[j]['selected_subjects'][x]['is_absent'] == 1){
                                            selected_subjects1.push(data1[j]['selected_subjects'][x]['subject_id']);
                                        }

                                        selected_subjects.push(data1[j]['selected_subjects'][x]['subject_id']);
                                        
                                        var subject = data1[j]['selected_subjects'][x]['subject_id'];
                                        var is_attend = data1[j]['selected_subjects'][x]['is_attend'];
                                        
                                        subject_attendance[subject] = is_attend;
                                    }
                                    
                                    //console.log("selected_subjects = "+selected_subjects);
                                    $('#student_absent_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td align='center'>${selected_subjects.includes(e) ? ((subject_attendance[e] == 0) ? (selected_subjects1.includes(e) ? '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" checked disabled >' : '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" disabled >') : "Attended") : "Not Applied"}</td>`)
                                        .join(''))
                                        .appendTo($('#student_absent_tbl_body'));
                                
//                                    $('#student_absent_tbl tr:last').append(sem_subject_ids
//                                        .map(e => `<td align='center'>${selected_subjects.includes(e) ? (selected_subjects1.includes(e) ? '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" checked disabled >' : '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" disabled >') : "Attended"}</td>`)
//                                        .join(''))
//                                        .appendTo($('#student_absent_tbl_body'));    
                                
                                
                                    $('#student_absent_tbl tr:last').append(
                                        "<td style='width:200px' align='center'>" + data1[j]['absent_deferement'] + "\n\
                                                    <td align='center'><button type='button' class='btn btn-success btn-xs' onclick='deferement_approval(" + data1[j]['semester_exam_id'] + "," + data1[j]['stu_id'] + ");'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button> | <button type='button' class='btn btn-danger btn-xs' onclick='deferement_reject(" + data1[j]['semester_exam_id'] + "," + data1[j]['stu_id'] + ");'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span> </button></td>")
                                        .appendTo($('#load_absent_thead'));
                                    selected_subjects = [];
                                    selected_subjects1 = [];
                                }
                                
                                $('#print_students_semester_subject_btn').attr("disabled", false);

                            } else {
                                $('#student_absent_tbl_body').find('tr').remove();
                                $('#load_absent_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                                $('#student_absent_tbl tr:last').append(sem_subject_code
                                    .map(id => `<th>${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_absent_thead'));
                                $('#student_absent_tbl tr:last').append(
                                    '<th>Deferment</th><th>Action</th>')
                                    .appendTo($('#load_absent_thead'));
                            
                                 var numCols = $("#student_absent_tbl").find('tr')[0].cells.length;

                                $('#student_absent_tbl_body').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");
                                
                                $('#print_students_semester_subject_btn').attr("disabled", true);
                            }
                        },
                        "json"
                    );
                $('.se-pre-con').fadeOut('slow');
                },
                "json"
            );
        }
    }


    function deferement_approval(semester_exam_id, stu_id) {
        var subjects = [];

        $('input.chk_box_' + stu_id + '[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? $(this).val() : "");
            subjects.push(sThisVal);
            // alert(sThisVal);
        });

//        console.log(subjects);
        $.ajax(
            {
                url: "<?php echo base_url('approvals/deferement_approval') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    'stu_id': stu_id,
                    'semester_exam_id': semester_exam_id,
                    'subjects': subjects

                },
                success: function (data) {


                    if (data == 'denied') {

                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        
                        funcres = {status: data['status'], message: data['message']};
                        result_notification(funcres);
                        
                        var row_count = $('#student_absent_tbl tr').length;
 
                        if (row_count > 0) {
                            search_students_absented_approval();
                        }
                    }

                }
            });

    }

    function deferement_reject(semester_exam_id, stu_id) {
        var subjects = [];

        $('input.chk_box_' + stu_id + '[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? $(this).val() : "");
            subjects.push(sThisVal);
            // alert(sThisVal);
        });

//        console.log(subjects);
        $.ajax(
            {
                url: "<?php echo base_url('approvals/deferement_reject') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    'stu_id': stu_id,
                    'semester_exam_id': semester_exam_id,
                    'subjects': subjects

                },
                success: function (data) {


                    if (data == 'denied') {

                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        funcres = {status: data['status'], message: data['message']};
                        result_notification(funcres);
                        
                        var row_count = $('#student_absent_tbl tr').length;
 
                        if (row_count > 0) {
                            search_students_absented_approval();
                        }

                    }

                }
            });

    }


    
    
    
    function cancel_postpone_status(request_id, student_id, status){
        
        $.ajax(
            {
                url: "<?php echo base_url('approvals/cancel_postpone_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'request_id': request_id, 'status': status, 'student_id': student_id},
                success: function () {
                    location.reload();
                }
            });
        
    }

    //////////////////////////////End of Request Deferement - Bavithran/////////////////////////


    //===============================================Repeat Student model (kasun) ==============================================================================
    function rpt_load_year() {
    
    var batch_id = $('#rpt_exam_batch').val();
        $.ajax({
            url: "<?php echo base_url('batch/get_batch_details') ?>",
            type: 'POST',
            async: true,
            cache: false,
            dataType: 'json',
            data: {'batch_id': batch_id},
            success: function (data)
            {
                $('#batch_start_date').val(data['start_date']);
            }
        });
    
        var course_id = $('#rpt_exam_course').val();
        
        $('#rpt_exam_no_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');

        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        $('#rpt_exam_no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                    }
                }

            },
            "json"
        );
    }

    function rpt_exam_load_semesters(year_no) {
        $('#rpt_exam_no_semester').find('option').remove().end().append('<option value="0">---Select Semester---</option>').val('');
        var course_id = $('#rpt_exam_course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    for (var i = 1; i <= data; i++) {
                        $('#rpt_exam_no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));

                    }

                }
            },
            "json"
        );
    }
    
    
    function load_semester_batches(course_id) {

        $('#rpt_exam_batch').find('option').remove().end();
        $('#rpt_exam_batch').append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    //if (lookup_flag) {
                    //    $('#l_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                    //} else {
                    $('#rpt_exam_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                    // }
                }

            },
            "json"
        );
    }

    function rpt_exam_load_student() {

        //check the number of attempts for student for each repeat subject. if.. not 4 attempts will give the apply option...
        // when add the record in to exam details table.. make is_repeat=1.

        var rptCenter = $('#rpt_exam_centre').val();
        var rptCourse = $('#rpt_exam_course').val();
        var rptBatch = $('#rpt_exam_batch').val();
        var rptYear = $('#rpt_exam_no_year').val().split('-')[0].trim();
        var rptSemester = $('#rpt_exam_no_semester').val();
        // var rptExam = $('#rpt_exam').val();
        rpt_selected_batch = rptBatch;
        

        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var selected_subjects = [];
        var sem_exam_detail_ids = [];


        $.post("<?php echo base_url('exam/rpt_load_students') ?>", {
                'rptCenter': rptCenter,
                'rptCourse': rptCourse,
                'rptBatch': rptBatch,
                'rptYear': rptYear,
                'rptSemester': rptSemester
                //'rptExam': rptExam
            },
            function (data) {
                //console.log(data);
                if(data != null){
                    for (var i = 0; i < data['sem_sub'].length; i++) {
                        sem_subject_ids.push(data['sem_sub'][i]['subject_id']);
                        sem_subject_code.push(data['sem_sub'][i]['code']);
                        sem_subject_names.push(data['sem_sub'][i]['subject']);
                    }

                    $('#rpt_apply_exam').find('tr').remove();
                    if (data['students'].length > 0) {
                        $('#rpt_load_student').find('tr').remove();
                        $('#rpt_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                        $('#rpt_apply_exam tr:last').append(sem_subject_code
                            .map(id => `<th>${id}</th>`)
                            .join(''))
                            .appendTo($('#rpt_load_thead'));

                        for (j = 0; j < data['students'].length; j++) {

                            $('#rpt_load_student').append("<tr " + (j + 1) + "'><td><input type='checkbox' id='student_box' name='stu_" + data['students'][j]['stu_id'] + "' onchange='rpt_student_select(this.value,this)' class='repeat_student' value='" + data['students'][j]['stu_id'] + "' checked> </td><td>" + data['students'][j]['reg_no'] + "</td><td>" + data['students'][j]['first_name'] + "</td></tr>");
                            for (x = 0; x < data['students'][j]['repeat_subject'].length; x++) {
                                //selected_subjects.push(data['students'][j]['repeat_subject'][x]['subject_code']);
                                selected_subjects.push(data['students'][j]['repeat_subject'][x]['subject_id']);
                                sem_exam_detail_ids[data['students'][j]['repeat_subject'][x]['subject_id']] = data['students'][j]['repeat_subject'][x]['exm_semester_exam_details'];

                            }
//                            console.log(sem_exam_detail_ids);
//                            console.log(sem_subject_ids);
                            $('#rpt_apply_exam tr:last').append(sem_subject_ids
                                .map(e => `<td>${selected_subjects.includes(e) ? '<input type="checkbox" id="subject_box" name="apply_exam[' + data['students'][j]['stu_id'] + '][]" onchange="rpt_subject_select('+data['students'][j]['stu_id']+',this)" value="' + e + '_' + sem_exam_detail_ids[e] + '" checked>' : ''}</td>`)
                                .join(''))
                                .appendTo($('#rpt_load_student'));
                            selected_subjects = [];
                        }
                        //================================================= LOAD repeat request batch  ====================================================

                        $("#rpt_exam_data_div").show();
                        $('#rpt_batch_apply').find('option').remove().end();

                        var batch_start_date = $('#batch_start_date').val();                        
                        $.post("<?php echo base_url('batch/load_batches_for_rpt_apply') ?>", {
                                'course_id': rptCourse,
                                'rpt_selected_batch':rpt_selected_batch
                            },
                            function (data) {
                                data.sort(function(a,b){
                                return new Date(b.date) - new Date(a.date);
                                });
                                for (j = 0; j < data.length; j++) {
                                    if(data[j]['start_date']>batch_start_date){
                                        $('#rpt_batch_apply').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        
                                        //exam load
                                            $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id':  data[j]['id']},
                                                function (data) {
                                                    if (data != null) {
                                                        for (var i = 0; i < data.length; i++) {
                                                            $('#rpt_exam_apply').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']));
                                                        }
                                                    }
                                                },
                                                "json"
                                            );
                                        break;
                                    }
                                    
                                }
                            },
                            "json"
                        );
                        //repeat year
                        var year_no = $('#rpt_exam_no_year').val();
                        var year_text = $('#rpt_exam_no_year option:selected').text();
                        $('#rpt_year_apply').append($("<option></option>").attr("value", year_no).text(year_text));
                        
                        //repeat semester
                        var semester_no = $('#rpt_exam_no_semester').val();
                        var semester_text = $('#rpt_exam_no_semester option:selected').text();
                        $('#rpt_semester_apply').append($("<option></option>").attr("value", semester_no).text(semester_text));
                        
                        //================================================= END LOAD repeat request batch  ====================================================
                    }
                    else{
                        $('#rpt_apply_exam').find('tr').remove();
                        $('#rpt_load_thead').find('tr').remove();
                        $('#rpt_load_student').find('tr').remove();
                        $('#rpt_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th><th>Subject<th></tr>");
                        $('#rpt_load_student').append("<tr ><td colspan='5' align='center'>No records to show.</td></tr>");
                        
                        $("#rpt_exam_data_div").hide();
                    }
                }
                else{
                    $('#rpt_apply_exam').find('tr').remove();
                    $('#rpt_load_thead').find('tr').remove();
                    $('#rpt_load_student').find('tr').remove();
                    $('#rpt_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th><th>Subject<th></tr>");
                    $('#rpt_load_student').append("<tr ><td colspan='5' align='center'>No records to show.</td></tr>");
                    
                    $("#rpt_exam_data_div").hide();
                }    
            },
            "json"
        );
    }

//    function rpt_year_list() {
//
//        var course_id = $('#rpt_exam_course').val();
//        $('#rpt_year_apply').find('option').remove().end();
//        $('#rpt_year_apply').append('<option value="">---Select Year---</option>').val('');
//
//        $.post("<?php //echo base_url('Student/load_year_list') ?>", {'selected_course_id': course_id},
//
//            function (data) {
//                var year = data['no_of_year'];
//                var id = data['id'];
//
//                for (var i = 1; i <= year; i++) {
//                    $('#rpt_year_apply').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
//                }
//            },
//            "json"
//        );
//    }

//    function rpt_load_semesters(year_no) {
//        var sel_year = year_no.split('-')[0].trim();
//        var sel_year_id = year_no.split('-')[1].trim();
//
//        $('#rpt_semester_apply').find('option').remove().end();
//        $('#rpt_semester_apply').append('<option value="">---Select Semester---</option>').val('');
//
//        $.post("<?php echo base_url('Student/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
//
//            function (data) {
//
//                for (var i = 1; i <= data; i++) {
//
//                    $('#rpt_semester_apply').append($("<option></option>").attr("value", i).text(i + " Semester"));
//
//                }
//            },
//            "json"
//        );
//    }

//    function rpt_load_semester_exam(semester) {
//        $('#rpt_exam_apply').find('option').remove().end();
//        $('#rpt_exam_apply').append('<option value="">---Select Exam---</option>').val('');
//
//        $.post("<?php //echo base_url('exam/load_semester_exam') ?>", {'batch_id': $('#rpt_batch_apply').val()},
//            function (data) {
//                if (data != null) {
//                    for (var i = 0; i < data.length; i++) {
//                        $('#rpt_exam_apply').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']));
//                    }
//                }
//            },
//            "json"
//        );
//    }

    function rpt_student_select(id, status) {

        if (status.checked) {
            $("input[name='apply_exam[" + id + "][]']").each(function () {
                // alert($(this).val());
                $(this).attr('checked', true);

            });
            //alert(id);
        } else {
            $("input[name='apply_exam[" + id + "][]']").each(function () {
                // alert($(this).val());
                $(this).attr('checked', false);

            });
        }
    }
    
    
    function rpt_subject_select(id, status) {
        
        if (status.checked) {
            $("input[name='stu_" + id + "']").attr('checked', true);
        }
    }
    

    function rpt_approve_student() {
        
        var aprv_batch = $('#rpt_batch_apply').val();
        var aprv_year = $('#rpt_year_apply').val();
        var aprv_semester = $('#rpt_semester_apply').val();
        var aprv_exam = $('#rpt_exam_apply').val();
        
        if(aprv_batch == ""){
            funcres = {status: "denied", message: "Please select the next facing examination batch."};
            result_notification(funcres);
        }
        else if(aprv_year == ""){
            funcres = {status: "denied", message: "Please select the next facing examination year."};
            result_notification(funcres);
        }
        else if(aprv_semester == ""){
            funcres = {status: "denied", message: "Please select the next facing examination semester."};
            result_notification(funcres);
        }
        else if(aprv_exam == ""){
            funcres = {status: "denied", message: "Please select the next facing examination exam code."};
            result_notification(funcres);
        }
        else{
            
            var selected_apprv_status = 0;
		
            $('#rpt_apply_exam tr').each(function(i, val){
                var checkbox_amount = 0;
                var stu_is_checked = $(this).find('#student_box').is(':checked');

                if(stu_is_checked){
                    var apprv_row = $(this);                        
                    apprv_row.find('td').each(function(j, value){
                        var subj_is_checked = $(this).find('#subject_box').is(':checked');
                        if(subj_is_checked){
                            checkbox_amount += 1;                              
                        } 
                    });
                    //alert(amount);
                    if(checkbox_amount === 0){
                        selected_apprv_status = 1;
                        funcres = {status: "denied", message: "If student is checked, at least one relevent subject should be selected."};
                        result_notification(funcres);
                    }
                }                   	
            });
            
            if(selected_apprv_status === 0){
                
                var rpt_approve_student = [];

                $('input.repeat_student:checkbox:checked').each(function () {

                    rpt_approve_student.push($(this).val());

                });

                $.ajax(
                {
                    url: "<?php echo base_url('approvals/rpt_approve_student') ?>",
                    type: 'POST',
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: $('#rpt_request_approve').serialize(),//+ "&rpt_approve_students=" + rpt_approve_student,
                    success: function () {
                        location.reload();
                    }
                });
            }         
        }        
    }

    function rpt_reject_student() {
    
    
          
	var selected_status = 0;
		
        $('#rpt_apply_exam tr').each(function(i, val){
            var checked_amount = 0;
            var student_is_checked = $(this).find('#student_box').is(':checked');

            if(student_is_checked){
                var row = $(this);                        
                row.find('td').each(function(j, value){
                    var subject_is_checked = $(this).find('#subject_box').is(':checked');
                    if(subject_is_checked){
                        checked_amount += 1;                              
                    } 
                });
                //alert(amount);
                if(checked_amount === 0){
                    selected_status = 1;
                    funcres = {status: "denied", message: "If student is checked, at least one relevent subject should be selected."};
                    result_notification(funcres);
                }
            }                   	
        });

    //alert("sts = "+sts);
    
        if(selected_status === 0){
            var rpt_reject_student = [];

            $('input.repeat_student:checkbox:checked').each(function () {

                rpt_reject_student.push($(this).val());

            });


            $.ajax(
            {
                url: "<?php echo base_url('approvals/rpt_reject_student') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#rpt_request_approve').serialize(),//+ "&rpt_approve_students=" + rpt_approve_student,
                success: function () {
                    location.reload();
                }
            });
        }
    
    
       
    }

    //===============================================END Repeat Student model (kasun) ==========================================================================


    //==================================================== START Recorrection Approval - Saumya ========================================================================

    function load_recorrection_courses(center_id) {
        $('#req_recorrection_course').find('option').remove().end();
        $('#req_recorrection_course').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('approvals/load_recorrect_course_list') ?>", {'center_id': center_id},

            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#req_recorrection_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                }
            },
            "json"
        );
    }

    function load_recorrection_batches(course_id) {
        $('#req_recorrection_batch').find('option').remove().end();
        $('#req_recorrection_batch').append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('approvals/load_recorrect_batches') ?>", {'course_id': course_id},

            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#req_recorrection_batch').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']));
                }
            },
            "json"
        );
    }

    function load_recorrection_exams(batch_id) {
        $('#req_recorrection_exam').find('option').remove().end();
        $('#req_recorrection_exam').append('<option value="">---Select Exam---</option>').val('');

        $.post("<?php echo base_url('approvals/load_recorrect_exam') ?>", {'batch_id': batch_id},
            function (data) {
//                console.log("exam=" + data);
                for (var i = 0; i < data.length; i++) {
                    $('#req_recorrection_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text('['+data[i]['exam_code']+'] - '+data[i]['exam_name']));
                }
            },
            "json"
        );
    }

    //to load students to approve for recorrection
    function load_recorrection_students() {
        
        $('.se-pre-con').fadeIn('slow');
        var recorectCenter = $('#req_recorrection_centre').val();
        var recorectCourse = $('#req_recorrection_course').val();
        var recorectBatch = $('#req_recorrection_batch').val();
        var recorectExam = $('#req_recorrection_exam').val();

        var name = "";
        var regNo = "";
        var stu_id = "";

        var btn_content = "";
        var btn_content2 = "";

        $('#apply_recorrection_exam_tbl').DataTable().destroy();
        $('#apply_recorrection_exam_tbl').DataTable({
            'ordering': false,
            'lengthMenu': [10, 25, 50, 75, 100],
            "columnDefs": [{
                "targets": 0,
                "visible":false
            },
            {
                "targets": 1,
                "className": 'text-center'
            },
            {
                "targets": 3,
                "className": 'text-center'
            },
            {
                "targets": 4,
                "className": 'text-center'
            },
            {
                "targets": 5,
                "className": 'text-center'
            }],
            "createdRow": function( row, data, dataIndex ) {
//                console.log(data[0]);
                if (data[0] == 1) {        
                    $( row ).css( "background-color", "#f9f9f9" );
                    $('td', row).css('border-right', 0);         	        	
                }
            }
        });
        $('#apply_recorrection_exam_tbl').DataTable().clear().draw();


        $.post("<?php echo base_url('approvals/load_recorrection_students_to_approve') ?>", {
                'recorectCenter': recorectCenter,
                'recorectCourse': recorectCourse,
                'recorectBatch': recorectBatch,
                'recorectExam': recorectExam
            },
            function (data) {
                if(data != null)
                {
                    var x = 1;
                    var prevId = "";
                    
                    for (var i = 0; i < data.length; i++) {

                        regNo = data[i]['reg_no'];
                        name = data[i]['first_name'];
                        stu_id = data[i]['stu_id'];
                                              
                        var stuId = data[i]['stu_id'];
                    
                        if(i > 0){
                            var prevId = data[i-1]['stu_id'];
                        }

                        if(stuId != prevId){
                            $('#apply_recorrection_exam_tbl').DataTable().row.add([                           
                                1,
                                "<b>Reg No - "+regNo+"</b>",
                                "<b>Name - "+name+"</b>",
                                '',
                                '',
                                ''
                            ]).draw(false);  
                        }

                        for (var j = 0; j < data[i]['subjects'].length; j++) {

                            btn_content = "<button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();approve_recorrection_apply(" + stu_id + ", " + data[i]['subjects'][j]['exam_id'] + ", " + data[i]['subjects'][j]['subject_id'] + ", 1, " + data[i]['subjects'][j]['mark_id'] + ")' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> | ";

                            btn_content2 = "<button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();approve_recorrection_apply(" + stu_id + ", " + data[i]['subjects'][j]['exam_id'] + ", " + data[i]['subjects'][j]['subject_id'] + ", 3, " + data[i]['subjects'][j]['mark_id'] + ")' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";

                            $('#apply_recorrection_exam_tbl').DataTable().row.add([
                                0,
                                x,
                                data[i]['subjects'][j]['subject'] + " [" + data[i]['subjects'][j]['code'] + "]",
                                data[i]['subjects'][j]['overall_grade'],
                                data[i]['subjects'][j]['result'],
                                btn_content + btn_content2
                            ]).draw(false);

                            x++;
                        }
                    }
                }
                $('.se-pre-con').fadeOut('slow');
            },
            "json"
        );
    }


    //Update approve/reject status of students for recorrection
    function approve_recorrection_apply(student_id, exam_id, subject_id, status, mark_id) {

        $.post("<?php echo base_url('approvals/update_recorrection_status') ?>", {
                'student_id': student_id,
                'exam_id': exam_id,
                'subject_id': subject_id,
                'status': status,
                'mark_id': mark_id
            },
            function (data) {
                if (data['status'] == "success") {
                    if (data['approve'] == 1) {
                        funcres = {status: "success", message: "Successfully approved student for recorrection."};
                        result_notification(funcres);
                    }
                    else {
                        funcres = {status: "success", message: "Successfully rejected student for recorrection."};
                        result_notification(funcres);
                    }
                    $('#apply_recorrection_exam_tbl').DataTable().row(this).remove().draw(false);

                    var row_count = $('#apply_recorrection_exam_tbl').DataTable().rows().count();

                    if (row_count > 0) {
                        load_recorrection_students();
                    }
                }
                else {
                    if (data['approve'] == 1) {
                        funcres = {status: "danger", message: "Failed to approved student for recorrection."};
                        result_notification(funcres);
                    }
                    else {
                        funcres = {status: "danger", message: "Failed to rejected student for recorrection."};
                        result_notification(funcres);
                    }
                }
            },
            "json"
        );
    }

    //==================================================== END Recorrection Approval - Saumya ========================================================================


    ////////////////////////Postpone gpa view -  Bavithran//////////////////////////

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');
    });

    ////////////////////////End ofPostpone gpa view - Bavithran/////////////////////


    ////////////////////////Postpone - Bavithran////////////////////////////////////

    function load_type_wise() {
        $('.se-pre-con').fadeIn('slow');
        var type_val;

        if ($('input[name=type]:checked')) {
            type_val = $('input[name=type]:checked').val();
        }

        if (type_val == "postpone") {
            $('#header1').text("Postpone");
//            $('#header2').text("Female");
        }
        if (type_val == "graduate") {
            $('#header1').text("Graduation");
//            $('#header2').text("Full Time");
        }

        $.post("<?php echo base_url('Report/student_course_wise_details')?>", {'type_val': type_val},
            function (data) {
//                console.log(data);
                $('#center_full_sum').DataTable().destroy();


                $('#center_full_sum').DataTable({
                    'ordering': true,
                    'paging': false,
                    "columnDefs": [{
                        "targets": 4,
                        "className": "text-center"
                    },
                        {
                            "targets": 5,
                            "className": "text-center"
                        },
                        {
                            "targets": 6,
                            "className": "text-center"
                        }],
                    'footerCallback': function (row, data, start, end, display) {

                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        total_5 = api
                            .column(4)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        total_6 = api
                            .column(5)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        total_7 = api
                            .column(6)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
//                        pageTotal = api
//                            .column(5, {page: 'current'})
//                            .data()
//                            .reduce(function (a, b) {
//                                return intVal(a) + intVal(b);
//                        }, 0);

                        // Update footer
                        $(api.column(0).footer()).html(
                            'Grand Total'
                        );

                        $(api.column(4).footer()).html(
                            total_5
                        );

                        $(api.column(5).footer()).html(
                            total_6
                        );

                        $(api.column(6).footer()).html(
                            total_7
                        );
                    }
                });

                $('#center_full_sum').DataTable().clear();

                var r = 1;
                if (data.length > 0) {
                    $('#print_course_wise').attr('disabled', false);

                    for (x = 0; x < data.length; x++) {

                        $('#center_full_sum').DataTable().row.add([
                            data[x]['br_name'],
                            data[x]['br_code'],
                            data[x]['course_name'],
                            data[x]['course_code'],
                            data[x]['type1'],
                            data[x]['type2'],
                            data[x]['type3']
                        ]).draw(false);

                        r++;
                    }
                }
                else {
                    $('#print_course_wise').attr('disabled', true);
                }
                $('.se-pre-con').fadeOut('slow');
            },
            "json"
        );
    }

    function view_gpa_results(stu_request_id, stu_id, reg_no, first_name, last_name) {
        var res = [];


        $.post("<?php echo base_url('approvals/view_gpa_results') ?>", {'stu_id': stu_id},
            function (data) {
//                                    $(".modal_title").text("Exam Marks : Course: " + data['course_code'] + "- Batch : " + data['batch_code'] + "  Y" + year + "/ S" + semester);
                $('#post_stu_id').val(stu_id);

                $('#myModal').append("<input type='text' name='post_stu_reg' id='post_stu_reg' value='" + data['reg_no'] + "'>");


                $('#').val(reg_no);
//                                    $('#post_stu_name').val(first_name);
                jQuery("#post_stu_name").html(first_name + ' ' + last_name);
                jQuery("#post_stu_reg_no").html(reg_no);

                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (data.length == 0) {
//                                            res['status'] = 'denied';
//                                            //res['message'] = 'There are no students without subjects';
//                                            result_notification(res);
                    } else if (data.length > 0) {
                        $('#view_postpone_stu_tbl_bdy').find('tr').remove();
                        $('#myModal').modal('show');
                        for (j = 0; j < data.length; j++) {
                            $('#view_postpone_stu_tbl_bdy').append("<tr><td style='width:14%;text-align: center'>" + (j + 1) + "</td><td style='width:14%;text-align: center'>" + data[j]['year'] + "</td><td style='width:14%;text-align: center'>" + data[j]['semester'] + "</td><td style='width:14%;text-align: center'>" + data[j]['gpa'] + "</td></tr>");
                        }
                    } else {
                        res['status'] = 'denied';
                        res['message'] = 'All Students subjects selected.';
                        result_notification(res);
                    }
                }
            },
            "json"
        );

    }

//    function update_approval_status(request_id, student_id, status) {
//        if (student_id == null) {
//            student_id = $('#post_stu_id').val();
//        }
//        $.ajax(
//            {
//                url: "<?php // echo base_url('approvals/update_approval_status') ?>",
//                type: 'POST',
//                async: true,
//                cache: false,
//                dataType: 'json',
//                data: {'request_id': request_id, 'status': status, 'student_id': student_id},
//                success: function () {
//                    location.reload();
//
//                }
//            });
//    }
    
//    function update_approval_status(request_id, student_id, status) {
//        $.ajax(
//            {
//                url: "<?php echo base_url('approvals/update_approval_status') ?>",
//                type: 'POST',
//                async: true,
//                cache: false,
//                dataType: 'json',
//                data: {'request_id': request_id, 'status': status, 'student_id': student_id},
//                success: function () {
//                    location.reload();
//                }
//            });
//    }
    

    ////////////////////////End of Postpone - Bavithran/////////////////////////////

//    function view_exam_timetable(id, desc, tt_course, tt_year, tt_semester){
//        $('#view_description').empty();
//        $('#view_description').append('<h4 class="modal-title">' + desc + '</h4>');
//        $('#viewtimetable').modal('show');
//
//        subsequence = new Array();
//
//        $.post("<?php // echo base_url('time_table/load_subjects')?>", {
//                'tt_semester': tt_semester,
//                'tt_course': tt_course,
//                'tt_year': tt_year
//            },
//            function (data) {
//                $('#tbllkupvw').DataTable().destroy();
//                tblheadstr = "<tr><th>Date</th>";
//                if (data == 'denied') {
//                    funcres = {status: "denied", message: "You have no right to proceed the action"};
//                    result_notification(funcres);
//                }
//                else {
//                    if (data.length > 0) {
//                        for (i = 0; i < data.length; i++) {
//
//                            tblheadstr += "<th>" + data[i]['subject'] + "</th>";
//                            subsequence.push(data[i]['id']);
//
//                        }
//                    }
//                }
//                $.post("<?php // echo base_url('exam/load_savedschedules')?>", {'id': id},
//                    function (data) {
//
//                        for (i = 0; i < data.length; i++) {
//                            tempary = new Array();
//                            tempary[0] = '<div style="text-align:center;width:100px">' + data[i]['esch_date'] + '</div>';
//
//                            for (j = 0; j < subsequence.length; j++) {
//                                if (subsequence[j] == data[i]['esch_subject']) {
//
//                                    tempary[j + 1] = '<div style="text-align:center;width:100%">' + data[i]['name'] + '<br>' + formatAMPM(data[i]['esch_stime']) + ' - ' + formatAMPM(data[i]['esch_etime']) + '</div>';
//                                }
//                                else {
//                                    tempary[j + 1] = '';
//                                }
//                            }
//
//                            $('#tbllkupvw').DataTable().row.add(tempary).draw(false);
//                        }
//                    },
//                    "json"
//                );
//
//                tblheadstr += "</tr>";
//                $('#tbllkupvw_head').empty();
//                $('#tbllkupvw_head').append(tblheadstr);
//                $('#tbllkupvw').DataTable({
//                    'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
//                    "paging": false,
//                    "ordering": false,
//                    "info": false
//                });
//
//            },
//            "json"
//        );
//
//        $('#tbllkupvw').DataTable().clear();
//
//    }

    function formatAMPM(date) {
            // alert(date);
            //alert (new Date (new Date().toDateString() + ' ' + date))
            var mydate = new Date(new Date(new Date().toDateString() + ' ' + date));
            var hours = mydate.getHours();
            var minutes = mydate.getMinutes();
            // alert(mydate);
            // alert(hours);
            // alert(minutes);
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }
        
    
    function get_exam_list(){
   
        var exam_type = $("input[name='exm_type']:checked").val();
        
        if(exam_type == "C"){
            load_exams_deferement_approval(null, null, null, null, null);
        }
        else{
            load_exams_repeat_deferment_approval();
        }
    }
    
    
    function load_exams_repeat_deferment_approval() {

        $.post("<?php echo base_url('exam/load_exams_repeat_deferment_approval') ?>", {
                'batch_id': $('#eh_batch').val(),
                'year': $('#eh_year').val(),
                'semester': $('#eh_semester').val(),
                'course': $('#eh_course').val(),
                'center': $('#eh_center').val() 
            },
            function (data) {
                $('#eh_exam').empty();
                $('#eh_exam').find('option').remove().end().append("<option value=''>---Select Exam--</option>");
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            $('#eh_exam').append("<option value='" + data[i]['exam_id'] + "'>" + data[i]['exam_code'] + " - " + data[i]['exam_name'] + "</option>");
                        }
                    }
                }
            },
            "json"
        );
    }
     
    function reset_fields_deferements(sel_id){
        $('#eh_center').val("");
        $('#eh_course').val("");
        $('#eh_batch').val("");
        $('#eh_year').val("");
        $('#eh_semester').val("");
        $('#eh_exam').val("");
        
        
        if(sel_id == "C"){
            $('#search_students').show();
            $('#search_students_repeat').hide();
        }
        else{
            $('#search_students').hide();
            $('#search_students_repeat').show();
        }
        
        $('#load_absent_thead').find('tr').remove();
        $('#student_absent_tbl_body').find('tr').remove();
        $('#load_absent_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
        $('#student_absent_tbl tr:last').append(
            '<th>Deferment</th><th>Action</th>')
            .appendTo($('#load_absent_thead'));

        var numCols = $("#student_absent_tbl").find('tr')[0].cells.length;

        $('#student_absent_tbl_body').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");
    }
    
    
    function search_students_absented_approval_repeat(){
        
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        var selected_subjects1 = [];

        var center_id = $('#eh_center').val();
        var course_id = $('#eh_course').val();
        var batch_id = $('#eh_batch').val();
        var year_no = $('#eh_year').val();
        var semester_no = $('#eh_semester').val();
        var exam_id = $('#eh_exam').val();
        if (batch_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch and Exam !';
            result_notification(res);
        } else {
            
            $('.se-pre-con').fadeIn('slow');
            
            $.post("<?php echo base_url('approvals/load_semester_subjects_deferement') ?>", {'batch_id': batch_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
                function (data) {
                    //console.log(data);


                    for (var i = 0; i < data.length; i++) {
                        sem_subject_ids.push(data[i]['subject_id']);
                        sem_subject_code.push(data[i]['code']);
                        sem_subject_names.push(data[i]['subject']);
                        if (data[i]['subject_type'] == '1') {
                            sem_subject_types.push("Core");
                        } else {
                            sem_subject_types.push("Elective");
                        }

                    }

                    $.post("<?php echo base_url('approvals/load_student_who_absent_exam_repeat') ?>", {
                            'center_id': center_id,
                            'course_id': course_id,
                            'batch_id': batch_id,
                            'semester_no': semester_no,
                            'year_no': year_no,
                            'exam_id': exam_id
                            // 'student_id': exam_id,


//                                                                                                  'branch':$('#eh_center').val(),
                        },
                        function (data1) {
                            //  console.log(sem_subject_code);

                            $('#load_absent_thead').find('tr').remove();
                            if (data1.length > 0) {
                                $('#student_absent_tbl_body').find('tr').remove();
                                $('#load_absent_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                                $('#student_absent_tbl tr:last').append(sem_subject_code
                                    .map(id => `<th>${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_absent_thead'));
                                $('#student_absent_tbl tr:last').append(
                                    '<th>Deferment</th><th>Action</th>')
                                    .appendTo($('#load_absent_thead'));

                                for (j = 0; j < data1.length; j++) {
//                                    console.log(data1);
//                                    console.log('kasun');

                                    $('#student_absent_tbl_body').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data1[j]['reg_no'] + "</td><td>" + data1[j]['first_name'] + "</td></tr>");
                                    for (x = 0; x < data1[j]['selected_subjects'].length; x++) {
                                        // alert(data1[j]['selected_subjects'][x]['code']);
                                        // selected_subjects.push(data1[j]['selected_subjects'][x]['code']);
                                        if (data1[j]['selected_subjects'][x]['is_absent'] == 1){
                                            selected_subjects1.push(data1[j]['selected_subjects'][x]['subject_id']);
                                        }

                                        selected_subjects.push(data1[j]['selected_subjects'][x]['subject_id']);
                                    }
                                    
                                    //console.log("selected_subjects = "+selected_subjects);
                                    $('#student_absent_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td align='center'>${selected_subjects.includes(e) ? (selected_subjects1.includes(e) ? '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" checked disabled >' : '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" disabled >') : "Attended"}</td>`)
                                        .join(''))
                                        .appendTo($('#student_absent_tbl_body'));
                                    $('#student_absent_tbl tr:last').append(
                                        "<td style='width:200px' align='center'>" + data1[j]['absent_deferement'] + "\n\
                                                    <td align='center'><button type='button' class='btn btn-success btn-xs' onclick='deferement_approval_repeat(" + data1[j]['semester_exam_id_rpt'] + "," + data1[j]['stu_id'] + ");'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button> | <button type='button' class='btn btn-danger btn-xs' onclick='deferement_reject_repeat(" + data1[j]['semester_exam_id_rpt'] + "," + data1[j]['stu_id'] + ");'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span> </button></td>")
                                        .appendTo($('#load_absent_thead'));
                                    selected_subjects = [];
                                    selected_subjects1 = [];
                                }
                                
                                $('#print_students_semester_subject_btn').attr("disabled", false);

                            } else {
                                $('#student_absent_tbl_body').find('tr').remove();
                                $('#load_absent_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                                $('#student_absent_tbl tr:last').append(sem_subject_code
                                    .map(id => `<th>${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_absent_thead'));
                                $('#student_absent_tbl tr:last').append(
                                    '<th>Deferment</th><th>Action</th>')
                                    .appendTo($('#load_absent_thead'));
                            
                                 var numCols = $("#student_absent_tbl").find('tr')[0].cells.length;

                                $('#student_absent_tbl_body').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");
                                
                                $('#print_students_semester_subject_btn').attr("disabled", true);
                            }
                        },
                        "json"
                    );
                $('.se-pre-con').fadeOut('slow');
                },
                "json"
            );
        }
        
    }
    
    
    
    function deferement_approval_repeat(semester_exam_id, stu_id) {
        var subjects = [];

        $('input.chk_box_' + stu_id + '[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? $(this).val() : "");
            subjects.push(sThisVal);
            // alert(sThisVal);
        });

//        console.log(subjects);
        $.ajax(
            {
                url: "<?php echo base_url('approvals/deferement_approval_repeat') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    'stu_id': stu_id,
                    'semester_exam_id': semester_exam_id,
                    'subjects': subjects

                },
                success: function (data) {


                    if (data == 'denied') {

                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        
                        funcres = {status: data['status'], message: data['message']};
                        result_notification(funcres);
                        
                        var row_count = $('#student_absent_tbl tr').length;
 
                        if (row_count > 0) {
                            search_students_absented_approval_repeat();
                        }
                    }

                }
            });

    }

    function deferement_reject_repeat(semester_exam_id, stu_id) {
        var subjects = [];

        $('input.chk_box_' + stu_id + '[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? $(this).val() : "");
            subjects.push(sThisVal);
            // alert(sThisVal);
        });

//        console.log(subjects);
        $.ajax(
            {
                url: "<?php echo base_url('approvals/deferement_reject_repeat') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    'stu_id': stu_id,
                    'semester_exam_id': semester_exam_id,
                    'subjects': subjects

                },
                success: function (data) {


                    if (data == 'denied') {

                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        funcres = {status: data['status'], message: data['message']};
                        result_notification(funcres);
                        
                        var row_count = $('#student_absent_tbl tr').length;
 
                        if (row_count > 0) {
                            search_students_absented_approval_repeat();
                        }

                    }

                }
            });

    }
    
    function exam_request_bulk_approval (){

        var center = $('#prom_centre').val();
        var course = $('#course').val();
        var batch = $('#batch').val();
        var approve_stu_ids = [];
        var res = [];
        $.each($("input[name='exm_request_check_box']:checked"), function(){            
            approve_stu_ids.push($(this).val());
        });
        
        if(approve_stu_ids.length > 0){
            $('#bulkSpinner').show();
            
            $("#dialog-confirm").html("Are you sure to perform bulk approval on selected records?");
            
            // Define the Dialog and its properties.
            $("#dialog-confirm").dialog({
                resizable: false,
                modal: true,
                title: "Student Exam Request Bulk Approval",
                height: 170,
                width: 500,
                draggable: false,
                buttons: [
                        {
                                text: "Yes",
                                "class": 'btn btn',
                                click: function() {
                                        $(this).dialog('close');
                                        
                                        $.post("<?php echo base_url('approvals/academic_exam_request_bulk_approval') ?>", {
                                            'center': center,
                                            'course': course,
                                            'batch': batch,
                                            'approve_stu_ids':approve_stu_ids
                                        },
                                function (data) {
                                    $('#bulkSpinner').hide();
                                    if (data['result'] == true ) {
                                        load_apply_exam_data();
                                        res['status'] = 'success';
                                        res['message'] = 'Selected Exam Requests approved succesfully.';
                                        result_notification(res);
                                    } else {
                                        res['status'] = 'denied';
                                        res['message'] = 'Failed to approve selected requestes.';
                                        result_notification(res);
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
                                            $('#bulkSpinner').hide();
                                    }
                            }
                    ]
                    //$('.se-pre-con').fadeOut('slow');
            }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'});
            
        }else {
            $('#bulkSpinner').hide();
            res['status'] = 'denied';
            res['message'] = 'Select one or more to perform Bulk Approval.';
            result_notification(res);
        }
    }
    
    function exam_request_check_all(){
    
        if ($("input[name='select_all_exam_request']").is(':checked')){
            $.each($("input[name='exm_request_check_box']"), function(){   
                $(this).prop('checked', true);
                exam_request_check($(this).attr('id'));
            });
        } else {
            $.each($("input[name='exm_request_check_box']"), function(){            
                $(this).prop('checked', false);
                exam_request_check($(this).attr('id'));
            });
        }

    }
    
    function exam_request_check(check_box_id){
        var temp = check_box_id.split("-");
        var disabled = false;
        if($('#' + check_box_id).is(":checked")){
            disabled = true;
        }
        
        $('#tr_'+temp[1]+' [type="checkbox"]').each(function(i, chk) {
            var name = $(this).attr('name');
            var disabled_attr = $(this).is('[disabled=disabled]');
            if(name != 'exm_request_check_box'){
//                if (chk.checked) {
                if(disabled_attr == false){
                    var id = $(this).attr('id');
                    $('#'+id).prop("checked", true);
                    $('#'+id).prop("disabled",disabled);
                }
              }
          });
          
        $('#tr_'+temp[1]+' button').each(function() {
            var btn_id = $(this).attr('id');
            $('#'+btn_id).prop("disabled",disabled);
        });
    }

</script>

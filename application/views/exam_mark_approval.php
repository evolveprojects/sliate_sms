<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Exam Mark Approvals</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Approvals</li>
            <li><i class="fa fa-share-alt"></i>Exam Mark Approvals</li>
        </ol>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="post" id="exam_marks_form" name="exam_marks_form"
              autocomplete="off">
            <div class="panel">
                <header class="panel-heading">
                    Exam Marks Approval
                </header>
                <div class="panel-body">
                    <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-university" href="#exam_mark_tab" aria-controls="exam_mark_tab" role="tab" data-toggle="tab"> Exam Mark</a></li>
                                <li role="presentation"><a class="fa fa-university" href="#rpt_exam_mark_tab" aria-controls="rpt_exam_mark_tab" role="tab" data-toggle="tab"> Repeat Exam Mark</a></li>
                            </ul>
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
$extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null)"';
echo form_dropdown('prom_centre', $branchdrop, $selectedbr, $extraattrs);
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
                                            <div class="">
                                                <?php if ($user_level == 'hod') {?>
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault();load_student_data_mark_approval_hod();'>
                                                        Search
                                                        Students
                                                    </button>
                                                <?PHP } elseif ($user_level == 'dir') {?>
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault();load_student_data_mark_approval_dir();'>
                                                        Search
                                                        Students
                                                    </button>
                                                    <button id="bulk_approve_btn_dir" type='button' class='btn btn-danger' style="margin-left: 30px;"
                                                            onclick='event.preventDefault();mark_bulk_approve_status();'>
                                                        Bulk
                                                        Approve
                                                    </button>
                                                    <i id="bulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
                                                <?PHP } elseif ($user_level == 'ex_dir') {?>
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault();load_student_data_mark_approval_ex_dir();'>
                                                        Search
                                                        Students
                                                    </button>
                                                    <button id="bulk_approve_btn" type='button' class='btn btn-danger' style="margin-left: 30px;"
                                                            onclick='event.preventDefault();mark_bulk_approve_status();'>
                                                        Bulk
                                                        Approve
                                                    </button>
                                                    <i id="bulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
                                                <?PHP }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div style="overflow-x:auto;">
                                <table class="table table-bordered exam_marks_tbl" id="exam_marks_tbl" style="overflow: auto;">
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
                                <!-- STARTING OF REPEAT SECTION DIV-- -->
				<div role="tabpanel" class="tab-pane" id="rpt_exam_mark_tab"><br/>
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
                                                            onchange="event.preventDefault();rpt_load_semester_exam(this.value)"
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
                                                            onchange="event.preventDefault();rpt_load_year_data(this.value,'')"
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
                                                    <select class="form-control" id="rpt_mark_year" name="rpt_mark_year"
                                                            onchange="rpt_load_semesters(this.value)" data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_Mark course" class="col-md-3 control-label">Semester</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="rpt_mark_semester" name="rpt_mark_semester" onchange=""
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="">
                                                    <?php if ($user_level == 'hod') {?>
                                                        <button type='button' class='btn btn-primary'
                                                                onclick='event.preventDefault();rpt_load_student_data_mark_approval_hod();'>
                                                            Search
                                                            Students
                                                        </button>
                                                    <?PHP } elseif ($user_level == 'dir') {?>
                                                        <button type='button' class='btn btn-primary'
                                                                onclick='event.preventDefault();rpt_load_student_data_mark_approval_dir();'>
                                                            Search
                                                            Students
                                                        </button>
                                                        <button id="rpt_bulk_approve_btn_dir" type='button' class='btn btn-danger' style="margin-left: 30px;"
                                                            onclick='event.preventDefault();mark_rpt_bulk_approve_status();'>
                                                        Bulk
                                                        Approve
                                                        </button>
                                                        <i id="rptBulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
                                                    <?PHP } elseif ($user_level == 'ex_dir') {?>
                                                        <button type='button' class='btn btn-primary'
                                                                onclick='event.preventDefault();rpt_load_student_data_mark_approval_ex_dir();'>
                                                            Search
                                                            Students
                                                        </button>
                                                        <button id="rpt_bulk_approve_btn" type='button' class='btn btn-danger' style="margin-left: 30px;"
                                                            onclick='event.preventDefault();mark_rpt_bulk_approve_status();'>
                                                        Bulk
                                                        Approve
                                                        </button>
                                                        <i id="rptBulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
                                                    <?PHP }?>
                                                </div>
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
                                        <tbody id="rpt_exam_marks_load_student">

                                        </tbody>
                                    </table>
                                    </div>

                                    </div>
                                </div>
				</div>
			    </div>
                    </div>

            </div>
        </form>
    </div>
</div>

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
                <?php //if($user_level=='hod'){ ?>
                <button type="button" id="mark_approve_button" class="btn btn-primary pull-left" onclick="mark_approve_status(1);">Approve
                </button>
                <?php // }elseif($user_level=='dir'){ ?>
                <button type="button" id="mark_approve_button" class="btn btn-primary pull-left hidden" onclick="mark_approve_status_dir(1);">
                    Approve
                </button>
                <?php //} elseif ($user_level=='ex_dir'){ ?>
                <button type="button" id="mark_approve_button" class="btn btn-primary pull-left hidden" onclick="mark_approve_status_ex_dir(1);">
                    Approve
                </button>
                <?php //} ?>
                <button type="button" id="mark_approve_button" class="btn btn-primary pull-left hidden" onclick="mark_approve_status_hod(2);">
                    Reject
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Exam Mark Modal-->

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/util.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

    var user_level = '<?php echo $user_level; ?>';
    var repeat_status = 0;

    var bulk_approve_subjects = [];
    var bulk_approve_students = [];

    $(function () {
        var promCourse = $('#prom_centre').val();
        if(promCourse != ""){
            get_courses(promCourse, 1, null, 0);
        }
        var promCourse = $('#rpt_prom_centre').val();
        if(promCourse != ""){
            rpt_get_courses(promCourse, 1, null);
        }
        $('#exam_marks_tbl').DataTable({
            'ordering': true,
            'lengthMenu': [25, 50],
            'paging':false,
            'searching':false
        });

        $('#rpt_exam_marks_tbl').DataTable({
            'ordering': true,
            'lengthMenu': [25, 50],
            'paging':false,
            'searching':false
        });

        $('#bulk_approve_btn').attr('disabled', true);
        $('#bulk_approve_btn_dir').attr('disabled', true);

        $('#rpt_bulk_approve_btn').attr('disabled', true);

    });

    function get_courses(center_id, flag, course_id, lookup_flag) {

        $('#subject_course').find('option').remove().end().append('<option value=""></option>').val('');
        $('#course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#coursep').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#l_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#course_med').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#mark_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');


        $('#lecture_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('Course/load_course_list') ?>", {'center_id': center_id},
                function (data) {
                    if(data.length == 1){
                        $('#mark_course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code']+" - "+data[0]['course_name']).attr("selected","selected"));
                        $('#rpt_mark_course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code']+" - "+data[0]['course_name']).attr("selected","selected"));
                        get_course_code(data[0]['course_id'],false);
                        rpt_get_course_code(data[0]['course_id'],false);
                    } else {
                        for (var i = 0; i < data.length; i++) {
                            if (lookup_flag) {
                                $('#mark_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                            } else {
                                $('#course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                                $('#coursep').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                                $('#lecture_ttbl_center').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                                $('#course_med').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                                $('#mark_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                                $('#subject_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                                $('#exam_ttbl_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                            }

                        }
                    }
                },
                "json"
            );
        }
    }
    //rpt_get_courses(this.value, 1, null)
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
                },
                "json"
            );
        }
    }

    function load_semester_exam(batch_id) {
        $('#exam').find('option').remove().end();
        $('#exam').append('<option value="">---Select Exam---</option>').val('');
        $('#mark_exam').find('option').remove().end();
        $('#mark_exam').append('<option value="">---Select Exam---</option>').val('');
//            $('#exam1').find('option').remove().end().append('<option value=""></option>').val('');
//            //$('#exam2').find('option').remove().end().append('<option value=""></option>').val('');
//            $('#lecture_ttbl_exam').find('option').remove().end().append('<option value=""></option>').val('');
//            $('#exam_ttbl_exam').find('option').remove().end().append('<option value=""></option>').val('');


        //if(flag ===1){
        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
                    $('#mark_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
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

    function rpt_load_semester_exam(batch_id) {
            //$('#rpt_exam').find('option').remove().end();
            //$('#rpt_exam').append('<option value="">---Select Exam---</option>').val('');
            $('#rpt_mark_exam').find('option').remove().end();
            $('#rpt_mark_exam').append('<option value="">---Select Exam---</option>').val('');


            //if(flag ===1){
            $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
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
    function get_course_code(course_id, lookup_flag) {
        $('#l_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        $('#batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        $('#batchp').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        $('#batch_med').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        $('#mark_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

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

function rpt_get_course_code(course_id, lookup_flag) {

        $('#rpt_mark_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

        $('#lecture_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttble_batch').find('option').remove().end().append('<option value=""></option>').val('');


        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {

                    $('#rpt_mark_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                }
            },
            "json"
        );
    }
    function findObjectByKey(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return array[i]["code"];
            }
        }
        return null;
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
    function rpt_load_year_data(exam_id, year_no) {
        $('#rpt_mark_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');


        var course_id = $('#rpt_mark_course').val();

        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        //if (flag) {
                        if (i == year_no) {
                            $('#rpt_mark_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                        } else {
                            $('#rpt_mark_year').append($("<option></option>").attr("value", i).text(i+" Year"));
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
                        $('#mark_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                    }
                }
            },
            "json"
        );
    }

    function rpt_load_semesters(year_no) {
        $('#rpt_mark_semester').find('option').remove().end().append('<option value="0">---Select Semester---</option>').val('');
        var course_id = $('#rpt_mark_course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
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

    function click_mark(subject_id, stu_id) {
        $("#" + stu_id + "_subject_mark_" + subject_id)[0].click();

    }

   /* function calculate_total(id) {

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
    }*/

    function calculate_total(ca_mark,is_attend,absent_reson_approve,grading_id,id, flag, repeat_status) {
        // alert(is_attend);
        // alert(absent_reson_approve);
        //  alert(grading_id);
        // alert(id);
         //alert(flag);

        var repeat_total = 0;

        if (flag) {
            if(ca_mark<=100){
                var pers = $('#pers_' +id + '_2').val();

                var pre_ca = ((parseFloat((ca_mark*(pers/100)))).toFixed(2)).split('.');
                var ca_value = pre_ca[1];

                if(ca_value == '00'){
                   var ca_total = pre_ca[0];
                }
                else{
                   var ca_total = (parseFloat((ca_mark*(pers/100)))).toFixed(2);
                }

                $('#totalmark_' + id).val(ca_total);
                $('#grade_' + id).val('-');
                $("#mark_approve_button").prop("disabled",false);
            }
            else{
                totalmarks=0;
                $('#totalmark_' + id).val("invalid");
                $("#mark_approve_button").prop("disabled",true);

            }
        } else {
            totalmarks = 0;
            total_rounded_marks = 0;
            grade = '';
            marks = '';
            // $('.marks_' + id).each(function (i, obj) {

            //temp = this.id.split('_');
            //alert(this.id);
            // var text_id=this.id;
            //  inp_perc = $('#pers_' + temp[1] + '_' + temp[2]).val();

            /*    if (isNaN(this.value)) {
                    marks = '';
                } else {
                    marks = this.value;
                }
                totalmarks += (marks / 100) * inp_perc;*/

            // alert(grade); grading_method/get_grades

            $.post("<?php echo base_url('grading_method/get_grades') ?>", {
                    'grading_id': grading_id

                },
                function (data) {
                    //var grade=
                    //system_grade(50,data);
                    // alert($('#'+text_id).val());
                    // alert(system_grade($('#'+text_id).val(),data));
                    var ca_mark=0;
                    var se_mark=0;
                    $('.marks_' + id).each(function (i, obj) {
                        // alert(i);
                        // alert(obj);
                        // var text_id=this.id;
                        temp = this.id.split('_');
                        //alert(this.id);
                        // var text_id=this.id;
                        inp_perc = $('#pers_' + temp[1] + '_' + temp[2]).val();


                        if(i==0){

                            se_mark=$('#'+this.id).val();
                            if(se_mark==''){
                                se_mark=0;
                                $('#'+this.id).val(0);
                                //  alert(is_attend);

                            }
                            if(is_attend==0)
                                $('#'+this.id).attr('readonly', true);


                        }

                        if(i==1)
                            ca_mark=$('#'+this.id).val();

                    });
                    //alert("se : "+se_mark+", ca :"+ca_mark);
                    if(se_mark<=100) {
                        if(se_mark != 0) {
                            totalmarks = ((parseFloat(se_mark) * (1 - inp_perc / 100)) + (parseFloat(ca_mark) * (inp_perc / 100))).toFixed(2);

                            if(repeat_status == 1){
                                for(x=0; x<data.length; x++){
                                    if(data[x]['grade'] == 'C'){
                                        c_grade_marks = data[x]['grade_mark'];
                                    }
                                }
                                repeat_total = totalmarks;

                                if(parseFloat(totalmarks) > parseFloat(c_grade_marks)){
                                    totalmarks = c_grade_marks;
                                }
                                else{
                                    totalmarks = totalmarks;
                                }
                            }

                            total_rounded_marks = Math.ceil(totalmarks);

                            $('#grade_' + id).val(overall_grade(se_mark,ca_mark,total_rounded_marks,data,false));

                            $('#grade_point_' + id).val(overall_grade(se_mark,ca_mark,total_rounded_marks,data,true));

                            // $('#result_grade_' + id).val(overall_grade(se_mark,ca_mark,totalmarks,data));
                            $('#result_grade_' + id).val(result_grades(is_attend,absent_reson_approve,se_mark,ca_mark,total_rounded_marks,data));
                            $("#mark_approve_button").prop("disabled",false);
                        }
                        else{
                            totalmarks = (parseFloat((ca_mark*(inp_perc/100)))).toFixed(2);
                        }
                    }
                    else{
                        totalmarks=0;
                        $('#grade_' + id).val('invalid');
                        $('#result_grade_' + id).val('invalid');//mark_approve_button
                        $("#mark_approve_button").prop("disabled",true);
                        $('#grade_point_' + id).val('0.00');

                    }


                    if(repeat_status == 1){
                        if(repeat_total != 0)
                        {
                            var pre_rtotal = repeat_total.split('.');
                            var pre_rtot = pre_rtotal[1];

                            if(pre_rtot == "00"){
                                totalmarks = pre_rtotal[0];
                            }
                            else{
                                totalmarks = repeat_total;
                            }
                        }
                        //$('#totalmark_' + id).val(totalmarks);
                    }
                    else{
                        if(totalmarks != 0)
                        {
                            var pre_total = totalmarks.split('.');
                            var pre_tot = pre_total[1];

                            if(pre_tot == "00"){
                                totalmarks = pre_total[0];
                            }
                            else{
                                totalmarks = totalmarks;
                            }
                        }
                    }

                    $('#totalmark_' + id).val(totalmarks);
                },
                "json"
            );

            //   });


        }
    }

    function approval_notify() {
        funcres = {status: "denied", message: "Subject Already Approved."};
        result_notification(funcres);


    }

    function mark_approve_status(status)
    {
        //debugger;
        var form_approve_data = $('#student_mark_form').serialize() + "&course_id=" + course_id + "&year_no=" + year + "&semester_no=" + semester + "&exam_id=" + exam_id + "&batch_id=" + batch_id + "" + "&status=" + status + "" + "&page=" + user_level + "&repeat_status=" + repeat_status + "";
        var course_id = 0;var year=0; var semester = 0; var batch_id=0;var exam_id = 0;

        if(repeat_status == 0)
        {
            course_id = $('#mark_course').val();
            year = $('#mark_year').val();
            semester = $('#mark_semester').val();
            batch_id = $('#mark_batch').val();
            exam_id = $('#mark_exam').val();
        }
        else
        {
            course_id = $('#rpt_mark_course').val();
            year = $('#rpt_mark_year').val();
            semester = $('#rpt_mark_semester').val();
            batch_id = $('#rpt_mark_batch').val();
            exam_id = $('#rpt_mark_exam').val();
        }
        $.ajax(
            {
                url: "<?php echo base_url('approvals/mark_approve_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#student_mark_form').serialize() + "&course_id=" + course_id + "&year_no=" + year + "&semester_no=" + semester + "&exam_id=" + exam_id + "&batch_id=" + batch_id + "" + "&status=" + status + "" + "&page=" + user_level + "&repeat_status=" + repeat_status + "",
                success: function (data) {
                    //console.log(data);
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        result_notification(data);
                        if (data['page'] == 'hod') {
                            if (data['status'] == "success") {
                                if(repeat_status == 0)
                                    load_student_data_mark_approval_hod();
                                else
                                    rpt_load_student_data_mark_approval_hod();
                            }
                        } else if (data['page'] == 'dir') {
                            if(repeat_status == 0)
                                load_student_data_mark_approval_dir();
                            else
                                rpt_load_student_data_mark_approval_dir();

                        } else if (data['page'] == 'ex_dir') {
                            if(repeat_status == 0)
                                load_student_data_mark_approval_ex_dir();
                             else
                                rpt_load_student_data_mark_approval_ex_dir();
                        }
                        $('#marks_modal').modal('hide');


                    }
                }
            });

    }

    function mark_bulk_approve_status()
    {
        var table = $('.exam_marks_tbl').dataTable();
        var tableData = table.fnGetData();

        var res = [];

        var batch_id = $('#mark_batch').val();
        var course_id = $('#mark_course').val();
        var year = $('#mark_year').val();
        var semester = $('#mark_semester').val();
        var exam_id = $('#mark_exam').val();
        var center_id = $('#prom_centre').val();
        if(batch_id == '' || course_id == '' || year == '' || semester == '' || exam_id == '' || center_id == ''){
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester.';
            result_notification(res);
        } else {
            if (tableData.length == 0) {
                res['status'] = 'denied';
                res['message'] = 'Make sure data exists or Search students before bulk approval.';
                result_notification(res);
            } else {
                $('#bulkSpinner').show();
                $.post("<?php echo base_url('approvals/bulk_dir_mark_approval') ?>", {
                                'batch_id': batch_id,
                                'course_id': course_id,
                                'year': year,
                                'semester': semester,
                                'exam_id': exam_id,
                                'user_level': user_level,
                                'center_id':center_id

                            },
                    function (data) {
                        $('#bulkSpinner').hide();
                        if (data['dataFlag'] == false) {
                            res['status'] = 'denied';
                            res['message'] = 'Data do not exist for approval.';
                            result_notification(res);
                        } else if (data['result'] == true ) {
                            if(user_level == 'dir') {
                                load_student_data_mark_approval_dir();
                            } else if (user_level == 'ex_dir') {
                                load_student_data_mark_approval_ex_dir();
                            }
                            res['status'] = 'success';
                            res['message'] = 'All marks approved succesfully.';
                            result_notification(res);
                        } else {
                            res['status'] = 'denied';
                            res['message'] = 'Failed to approve all marks.Please check unapproved marks.';
                            result_notification(res);
                        }

                    },
                    "json"
                );
            }
        }


    }

    function open_mark_model(batch_id, stu_id, subject_id, approve_status, status) {
        //alert($("#subject_mark_"+subject_code).text());
        var mark = $("#" + stu_id + "_subject_mark_" + subject_id).text();

        // alert(user_level);
        // alert(mark);exam_type_id  is_hod_mark_aproved
        var repeat = 0;

        if (mark == 'N/A') {
            funcres = {status: "denied", message: "Marks not available to approve."};
            result_notification(funcres);
        }
        else if (mark == 'HOD Not Approved') {
            funcres = {status: "denied", message: "Please get the approval from HOD before Director approval."};
            result_notification(funcres);
        }
        else if ((mark == 'Rejected') || (mark == 'NE')) {
            funcres = {status: "denied", message: "Cannot approve rejected subject"};
            result_notification(funcres);
        }
        else if (mark == 'ATI Director Not Approved') {
            funcres = {status: "denied", message: "Please get the approval from ATI Director before SE Director appraval."};
            result_notification(funcres);
        }
        else if(approve_status == 1)
        {
            funcres = {status: "denied", message: "Subject Already Approved."};
            result_notification(funcres);
        }

        else {
            $('#note').empty();
            $('#hidden_div').empty();
            $('#mark_data_tbl').find('tr').remove();

            if(user_level == 'ex_dir'){
                $('#mark_approve_button').hide();
            }

            $('#marks_modal').modal({
                show: 'false'
            });
            $('#marks_modal').modal('show');



            if(status == 0){
            var course_id = $('#mark_course').val();
            var year = $('#mark_year').val();
            var semester = $('#mark_semester').val();
            var exam_id = $('#mark_exam').val();
                repeat = 0;
                repeat_status = 0;
            }
            else{
                course_id = $('#rpt_mark_course').val();
                year = $('#rpt_mark_year').val();
                semester = $('#rpt_mark_semester').val();
                exam_id = $('#rpt_mark_exam').val();
                repeat = 1;
                repeat_status = 1;
            }
            //set val
            $('#student_id').val(stu_id);

            $.post("<?php echo base_url('student/load_student_exam_marks') ?>", {
                    'stu_id': stu_id,
                    'subject_id': subject_id,
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester,
                    'exam_id': exam_id,
                    'repeat': repeat
                },
                function (data) {
                  //  debugger;
                    var test = data;
                    var di_exam_mark = data['exam_mark'];
                    var di_marking_details = data['subject_details']['marking_details'];

                for (var j = 0; j < data['exam_mark'].length; j++) {
                        if (user_level == 'hod' || user_level == 'dir') {
                            if (data['exam_mark'][j]['exam_type_id'] == 2) {

                                switch (data['user_level']) {
                                    case "1":
                                        var write_mark = '';
                                        var Assignment_mark = '';
                                        break;
                                    case "2":
                                        var write_mark = "";
                                        var Assignment_mark = "readonly='readonly'";
                                        break;
                                    case "3":
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = "readonly='readonly'";
                                        break;
                                    case "4":
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = '';
                                        break;
                                    case "5":
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = "readonly='readonly'";
                                        break;

                                    default:
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = "readonly='readonly'";
                                }
                                    //alert('write_mark'+write_mark);
                                        //alert('Assignment_mark'+Assignment_mark);
                                $(".modal_title").text("Exam Marks : Course: " + data['course_code'] + "- Batch : " + data['batch_code'] + "  Y" + year + "/ S" + semester);
                                jQuery("label[for='student_name']").html(data['first_name']);
                                jQuery("label[for='reg_no_data']").html(data['reg_no']);
                                jQuery("label[for='admmision_data']").html(data['reg_no']);
                                    //
                                //$('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['subject_id'] + "' hidden>");
                                //$("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['subject_code'] + " - " + data['subject_details']['subject'] + " </th></tr>");
                                //$("#mark_data_tbl").append("<tr><th>#</th><th>Type</th><th>Precentage</th><th>Mark</th></tr>");


                                var repeat_status = 0;
                                for (var z = 0; z < data['subject_details']['repeat_details'].length; z++) {
                                    if (data['subject_details']['repeat_details'][z]['is_repeat_approved'] == 1) {
                                        repeat_status = 1;
                                    }
                                }

                                if (repeat_status == 1) {
                                    $(".modal_title").text("Exam Marks : Course: " + data['subject_details']['repeat_details'][0]['course_code'] + "- Batch : " + data['subject_details']['repeat_details'][0]['batch_code'] + "  Y" + year + "/ S" + semester);
                                    jQuery("label[for='student_name']").html(data['subject_details']['repeat_details'][0]['first_name']);
                                    jQuery("label[for='reg_no_data']").html(data['subject_details']['repeat_details'][0]['reg_no']);
                                    jQuery("label[for='admmision_data']").html(data['subject_details']['repeat_details'][0]['reg_no']);
                                    $('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['repeat_details'][0]['subject_id'] + "' hidden>");
                                    $("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['repeat_details'][0]['code'] + " - " + data['subject_details']['repeat_details'][0]['subject'] + " </th></tr>");
                                } else {
                                    $('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['subject_id'] + "' hidden>");
                                    $("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['subject_code'] + " - " + data['subject_details']['subject'] + " </th></tr>");
                                }
                                $("#mark_data_tbl").append("<tr><th>#</th><th>Type</th><th>Precentage</th><th>Mark</th></tr>");

                               // debugger;
                                // di_exam_mark;
                                // di_marking_details;

                                // for (var j = 0; j < data['subject_details']['marking_details'].length; j++) {
                                //if(data['exam_mark'][k]['exam_type_id'] == 2) {
                                if (typeof data['exam_mark'][j]==='undefined') {
                                    if (data['exam_mark'][j]['mark'] === null || data['exam_mark'][j]['mark'] === '') {
                                        var subject_mark = '';
                                    } else {
                                        var pre_mark = data['exam_mark'][j]['mark'].split('.');
                                        var decimalvalue = pre_mark[1];

                                        if (decimalvalue == '00') {
                                            var subject_mark = pre_mark[0];
                                        } else {
                                            var subject_mark = data['exam_mark'][j]['mark'];
                                        }
                                    }
                                } else {
                                    var subject_mark = '';
                                }

                                if (user_level == 'ex_dir') {
                                    if (repeat_status == 1) {
                                        if (data['subject_details']['repeat_details'][0]['is_attend'] == 0) {
                                            var is_attempt = "readonly='readonly'";
                                            //subject_mark = 0;
                                        } else {
                                            var is_attempt = '';
                                        }
                                    } else {
                                        if (data['subject_details']['is_attend'] == 0) {
                                            var is_attempt = "readonly='readonly'";
                                            //subject_mark = 0;
                                        } else {
                                            var is_attempt = '';
                                        }
                                    }
                                } else {
                                    if (data['exam_mark'][data['exam_mark'].length - 1]['overall_grade'] == 'AB')
                                        var is_attempt = "readonly='readonly'";
                                    else
                                        var is_attempt = '';
                                }

                                var readonly_text = '';
                                var change_function = '';
                                if (data['subject_details']['marking_details'][j]['type_id'] == 1) {
                                    change_function = false;
                                    readonly_text = write_mark;
                                    if (user_level == 'hod')
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'dir')
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'ex_dir')
                                        readonly_text = "readonly='readonly'";

                                    if ((user_level == 'hod') || (user_level == 'dir')) {
                                        var marks_value = "<input type='text' name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value," + data['subject_details']['is_attend'] + "," + data['subject_details']['is_absent_approve'] + "," + data['subject_details']['marking_details'][j]['grading_method_id'] + "," + data['subject_details']['subject_id'] + "," + change_function + "," + repeat_status + ");' " + is_attempt + " " + readonly_text + "  />";
                                    } else {
                                        var marks_value = "<input type='text' name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value," + data['subject_details']['is_attend'] + "," + data['subject_details']['is_absent_approve'] + "," + data['subject_details']['marking_details'][j]['grading_method_id'] + "," + data['subject_details']['subject_id'] + "," + change_function + "," + repeat_status + ");' " + is_attempt + " " + readonly_text + "  />";
                                    }
                                } else if (data['subject_details']['marking_details'][j]['type_id'] == 2) {
                                    readonly_text = Assignment_mark;
                                    change_function = true;
                                    if (user_level == 'hod')
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'dir')
                                        //readonly_text = "readonly='readonly'";
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'ex_dir')
                                        readonly_text = "readonly='readonly'";
                                    var marks_value = "<input type='text' name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value," + data['subject_details']['is_attend'] + "," + data['subject_details']['is_absent_approve'] + "," + data['subject_details']['marking_details'][j]['grading_method_id'] + "," + data['subject_details']['subject_id'] + "," + change_function + "," + repeat_status + ");' " + is_attempt + " " + readonly_text + "  />";

                                    $("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['subject_details']['marking_details'][j]['type'] + "</td><td>" + data['exam_mark'][j].persentage + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][j]['percentage'] + "'>" + marks_value + "</div></td></tr>");
                          
                                } else {
                                    readonly_text = "readonly='readonly'";
                                    change_function = '';
                                }
                                        //alert(readonly_text);
                                //$("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['subject_details']['marking_details'][j]['type'] + "</td><td>" + data['subject_details']['marking_details'][j]['percentage'] + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][j]['percentage'] + "'> <input   type='text'   name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total("+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ");'  " + readonly_text + " /> </div></td></tr>");

                                //kasun//  $("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['subject_details']['marking_details'][j]['type'] + "</td><td>" + data['exam_mark'][j].persentage + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][j]['percentage'] + "'>" + marks_value + "</div></td></tr>");
                                   //     } //modified
                                // }

                                if (data['exam_mark'].length != 0) {

                                    var pre_totalmark = data['exam_mark'][j]['total_marks'].split('.');
                                    var totaldecimalvalue = pre_totalmark[1];

                                    if (totaldecimalvalue == '00') {
                                        var total_marks = pre_totalmark[0];
                                    } else {
                                        var total_marks = data['exam_mark'][j]['total_marks'];
                                    }


                                    if ((user_level == 'hod') || (user_level == 'dir')) {
                                        var totmark_prec_ca = ((data['exam_mark'][j]['mark']) * ((data['exam_mark'][j]['persentage']) / 100)).toFixed(2);

                                        var pre_totmark_ca = totmark_prec_ca.split('.');

                                        var pre_mark_total_ca = pre_totmark_ca[1];

                                        if (pre_mark_total_ca == '00') {
                                            var total_marks = pre_totmark_ca[0];
                                        } else {
                                            var total_marks = totmark_prec_ca;
                                        }
                                    }

                                    var overall_grade = data['exam_mark'][0]['overall_grade'];
                                    var grade_point = data['exam_mark'][0]['grade_point'];
                                    var subject_point = data['subject_details']['credits'];
                                    var result_grade = data['exam_mark'][0]['result'];
                                    var GPA_temp = data['gpa_value'];
                                    var GPA = parseFloat(GPA_temp).toFixed(2);

                                } else {
                                    var total_marks = '';
                                    var overall_grade = '';
                                    var grade_point = '';
                                    var subject_point = '';
                                    var result_grade = '';

                                }


                                if (user_level == 'ex_dir') {
                                    if (repeat_status == 1) {
                                        if (data['subject_details']['repeat_details'][0]['is_attend'] == 0) {
                                            //total_marks = 0;
                                            total_marks = data['exam_mark'][0]['total_marks'];
                                            overall_grade = 'AB';
                                            $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                                        } else {
                                            var is_attempt = '';
                                        }
                                    } else {
                                        if (data['subject_details']['is_attend'] == 0) {
                                            //total_marks = 0;
                                            total_marks = data['exam_mark'][0]['total_marks'];
                                            overall_grade = 'AB';
                                            $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                                        } else {
                                            var is_attempt = '';
                                        }
                                    }

                                    //$("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-6'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-3'> Overall Grade :<input type='text' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='grade_point' value='" + grade_point + "' id='grade_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='subject_point'  value='" + subject_point + "' id='subject_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> </div><div class='col-xs-3'> Result Grade :<input type='text' name='result_grade' value='" + result_grade + "' id='result_grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> <div class='col-xs-3'> GPA  :<input type='text' name='gpa_value' value='" + GPA + "' id='gpa_value_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");
                                    $("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-6'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-3'><input type='hidden' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='grade_point' value='" + grade_point + "' id='grade_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='subject_point'  value='" + subject_point + "' id='subject_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> </div><div class='col-xs-3'> Result Grade :<input type='text' name='result_grade' value='" + result_grade + "' id='result_grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> <div class='col-xs-3'> GPA  :<input type='text' name='gpa_value' value='" + GPA + "' id='gpa_value_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");


                                } else {
                                    if (data['exam_mark'][j]['overall_grade'] == 'AB') {
                                        total_marks = 0;
                                        overall_grade = 'AB';
                                        $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                                    } else {
                                        var is_attempt = '';
                                    }
                                    $("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-4'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-4' hidden> Overall Grade :<input type='text' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");
                                }
                                //disable approve button
                            } // top if ends here
                        } else {
                            if(data['exam_mark'][j]['exam_type_id'] == 1) {

                                switch (data['user_level']) {
                                    case "1":
                                        var write_mark = '';
                                        var Assignment_mark = '';
                                        break;
                                    case "2":
                                        var write_mark = "";
                                        var Assignment_mark = "readonly='readonly'";
                                        break;
                                    case "3":
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = "readonly='readonly'";
                                        break;
                                    case "4":
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = '';
                                        break;
                                    case "5":
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = "readonly='readonly'";
                                        break;

                                    default:
                                        var write_mark = "readonly='readonly'";
                                        var Assignment_mark = "readonly='readonly'";
                                }
                                                //alert('write_mark'+write_mark);
                                            //alert('Assignment_mark'+Assignment_mark);
                                $(".modal_title").text("Exam Marks : Course: " + data['course_code'] + "- Batch : " + data['batch_code'] + "  Y" + year + "/ S" + semester);
                                jQuery("label[for='student_name']").html(data['first_name']);
                                jQuery("label[for='reg_no_data']").html(data['reg_no']);
                                jQuery("label[for='admmision_data']").html(data['reg_no']);
                                        //
                                //$('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['subject_id'] + "' hidden>");
                                //$("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['subject_code'] + " - " + data['subject_details']['subject'] + " </th></tr>");
                                //$("#mark_data_tbl").append("<tr><th>#</th><th>Type</th><th>Precentage</th><th>Mark</th></tr>");


                                var repeat_status = 0;
                                for (var z = 0; z < data['subject_details']['repeat_details'].length; z++) {
                                    if(data['subject_details']['repeat_details'][z]['is_repeat_approved'] == 1){
                                        repeat_status = 1;
                                    }
                                }

                                if(repeat_status == 1){
                                    $(".modal_title").text("Exam Marks : Course: " + data['subject_details']['repeat_details'][0]['course_code'] + "- Batch : " + data['subject_details']['repeat_details'][0]['batch_code'] + "  Y" + year + "/ S" + semester);
                                    jQuery("label[for='student_name']").html(data['subject_details']['repeat_details'][0]['first_name']);
                                    jQuery("label[for='reg_no_data']").html(data['subject_details']['repeat_details'][0]['reg_no']);
                                    jQuery("label[for='admmision_data']").html(data['subject_details']['repeat_details'][0]['reg_no']);
                                    $('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['repeat_details'][0]['subject_id'] + "' hidden>");
                                    $("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['repeat_details'][0]['code'] + " - " + data['subject_details']['repeat_details'][0]['subject'] + " </th></tr>");
                                }
                                else{
                                    $('#hidden_div').append("<input type='text' name='subject_id' id='subject_id' value='" + data['subject_details']['subject_id'] + "' hidden>");
                                    $("#mark_data_tbl").append("<tr><th colspan='4'>" + data['subject_details']['subject_code'] + " - " + data['subject_details']['subject'] + " </th></tr>");
                                }
                                $("#mark_data_tbl").append("<tr><th>#</th><th>Type</th><th>Precentage</th><th>Mark</th></tr>");

                                         //  debugger;
                                // di_exam_mark;
                                // di_marking_details;

                                // for (var j = 0; j < data['subject_details']['marking_details'].length; j++) {
                                //if(data['exam_mark'][k]['exam_type_id'] == 2) {
                                if (data['exam_mark'][j]) {
                                    if (data['exam_mark'][j]['mark'] === null || data['exam_mark'][j]['mark'] === '') {
                                        var subject_mark = '';
                                    } else {
                                        var pre_mark = data['exam_mark'][j]['mark'].split('.');
                                        var decimalvalue = pre_mark[1];

                                        if (decimalvalue == '00') {
                                            var subject_mark = pre_mark[0];
                                        } else {
                                            var subject_mark = data['exam_mark'][j]['mark'];
                                        }
                                    }
                                } else {
                                    var subject_mark = '';
                                }

                                if (user_level == 'ex_dir') {
                                    if (repeat_status == 1) {
                                        if (data['subject_details']['repeat_details'][0]['is_attend'] == 0) {
                                            var is_attempt = "readonly='readonly'";
                                            //subject_mark = 0;
                                        } else {
                                            var is_attempt = '';
                                        }
                                    } else {
                                        if (data['subject_details']['is_attend'] == 0) {
                                            var is_attempt = "readonly='readonly'";
                                            //subject_mark = 0;
                                        } else {
                                            var is_attempt = '';
                                        }
                                    }
                                } else {
                                    if (data['exam_mark'][data['exam_mark'].length - 1]['overall_grade'] == 'AB')
                                        var is_attempt = "readonly='readonly'";
                                    else
                                        var is_attempt = '';
                                }

                                var readonly_text = '';
                                var change_function = '';
                                if (data['subject_details']['marking_details'][j]['type_id'] == 1) {
                                    change_function = false;
                                    readonly_text = write_mark;
                                    if (user_level == 'hod')
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'dir')
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'ex_dir')
                                        readonly_text = "readonly='readonly'";

                                    if ((user_level == 'hod') || (user_level == 'dir')) {
                                        var marks_value = "<input type='text' name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value," + data['subject_details']['is_attend'] + "," + data['subject_details']['is_absent_approve'] + "," + data['subject_details']['marking_details'][j]['grading_method_id'] + "," + data['subject_details']['subject_id'] + "," + change_function + "," + repeat_status + ");' " + is_attempt + " " + readonly_text + "  />";
                                    } else {
                                        var marks_value = "<input type='text' name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value," + data['subject_details']['is_attend'] + "," + data['subject_details']['is_absent_approve'] + "," + data['subject_details']['marking_details'][j]['grading_method_id'] + "," + data['subject_details']['subject_id'] + "," + change_function + "," + repeat_status + ");' " + is_attempt + " " + readonly_text + "  />";
                                    }
                                } else if (data['subject_details']['marking_details'][j]['type_id'] == 2) {
                                    readonly_text = Assignment_mark;
                                    change_function = true;
                                    if (user_level == 'hod')
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'dir')
                                        //readonly_text = "readonly='readonly'";
                                        readonly_text = "readonly='readonly'";
                                    else if (user_level == 'ex_dir')
                                        readonly_text = "readonly='readonly'";
                                    var marks_value = "<input type='text' name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value," + data['subject_details']['is_attend'] + "," + data['subject_details']['is_absent_approve'] + "," + data['subject_details']['marking_details'][j]['grading_method_id'] + "," + data['subject_details']['subject_id'] + "," + change_function + "," + repeat_status + ");' " + is_attempt + " " + readonly_text + "  />";


                                } else {
                                    readonly_text = "readonly='readonly'";
                                    change_function = '';
                                }
                                        //alert(readonly_text);
                                //$("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['subject_details']['marking_details'][j]['type'] + "</td><td>" + data['subject_details']['marking_details'][j]['percentage'] + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][j]['percentage'] + "'> <input   type='text'   name='subject_mark[]' value='" + subject_mark + "' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total("+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ");'  " + readonly_text + " /> </div></td></tr>");

                               // $("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['subject_details']['marking_details'][j]['type'] + "</td><td>" + data['exam_mark'][j].persentage + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][j]['percentage'] + "'>" + marks_value + "</div></td></tr>");
                                $("#mark_data_tbl").append("<tr><td>" + (j + 1) + "</td><td>" + data['exam_mark'][j]['exam_type_id'] + "</td><td>" + data['exam_mark'][j].persentage + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['exam_mark'][j]['exam_type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['exam_mark'][j]['exam_type_id'] + "' value='" + data['exam_mark'][j].persentage  + "'>" + marks_value + "</div></td></tr>");
                                //     } //modified
                                // }

                                if (data['exam_mark'].length != 0) {

                                    var pre_totalmark = data['exam_mark'][j]['total_marks'].split('.');
                                    var totaldecimalvalue = pre_totalmark[1];

                                    if(totaldecimalvalue == '00'){
                                        var total_marks = pre_totalmark[0];
                                    }
                                    else{
                                        var total_marks = data['exam_mark'][j]['total_marks'];
                                    }


                                    if ((user_level == 'hod') || (user_level == 'dir')) {
                                        var totmark_prec_ca = ((data['exam_mark'][j]['mark']) * ((data['exam_mark'][j]['persentage'])/100)).toFixed(2);

                                        var pre_totmark_ca = totmark_prec_ca.split('.');

                                        var pre_mark_total_ca = pre_totmark_ca[1];

                                        if(pre_mark_total_ca == '00'){
                                            var total_marks = pre_totmark_ca[0];
                                        }
                                        else{
                                            var total_marks = totmark_prec_ca;
                                        }
                                    }

                                    var overall_grade = data['exam_mark'][0]['overall_grade'];
                                    var grade_point = data['exam_mark'][0]['grade_point'];
                                    var subject_point = data['subject_details']['credits'];
                                    var result_grade = data['exam_mark'][0]['result'];
                                    var GPA_temp = data['gpa_value'];
                                    var GPA = parseFloat(GPA_temp).toFixed(2);

                                } else {
                                    var total_marks = '';
                                    var overall_grade = '';
                                    var grade_point = '';
                                    var subject_point = '';
                                    var result_grade = '';

                                }



                                if(user_level=='ex_dir') {
                                    if(repeat_status == 1){
                                        if (data['subject_details']['repeat_details'][0]['is_attend'] == 0) {
                                            //total_marks = 0;
                                            total_marks = data['exam_mark'][0]['total_marks'];
                                            overall_grade = 'AB';
                                            $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                                        }
                                        else{
                                            var is_attempt = '';
                                        }
                                    }
                                    else{
                                        if (data['subject_details']['is_attend'] == 0) {
                                            //total_marks = 0;
                                            total_marks = data['exam_mark'][0]['total_marks'];
                                            overall_grade = 'AB';
                                            $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                                        }
                                        else{
                                            var is_attempt = '';
                                        }
                                    }

                                    //$("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-6'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-3'> Overall Grade :<input type='text' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='grade_point' value='" + grade_point + "' id='grade_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='subject_point'  value='" + subject_point + "' id='subject_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> </div><div class='col-xs-3'> Result Grade :<input type='text' name='result_grade' value='" + result_grade + "' id='result_grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> <div class='col-xs-3'> GPA  :<input type='text' name='gpa_value' value='" + GPA + "' id='gpa_value_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");
                                    $("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-6'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-3'><input type='hidden' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='grade_point' value='" + grade_point + "' id='grade_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='subject_point'  value='" + subject_point + "' id='subject_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> </div><div class='col-xs-3'> Result Grade :<input type='text' name='result_grade' value='" + result_grade + "' id='result_grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> <div class='col-xs-3'> GPA  :<input type='text' name='gpa_value' value='" + GPA + "' id='gpa_value_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");


                                } else {
                                    if (data['exam_mark'][j]['overall_grade'] == 'AB'  ) {
                                        total_marks = 0;
                                        overall_grade = 'AB';
                                        $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");

                                    }
                                    else{
                                        var is_attempt = '';
                                    }
                                    $("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-4'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div> </th><th colspan='2'><div class='col-xs-4' hidden> Overall Grade :<input type='text' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div></th></tr>");
                                }
                                //disable approve button
                            } // top if ends here
                        } // top for ends here
                    }
               
               
               
               
                },
                "json"
            );
        }
    }

    //=============================== CA HOD Approval ============================================


    function load_student_data_mark_approval_hod() {
        $('.se-pre-con').fadeIn('slow');
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
        var exam_id = $('#mark_exam').val();
        var center_id = $('#prom_centre').val();
        var hod_style_cell = [];

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/semester_subjects_by_semester') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
                   // console.log(header_data);
                    /* for (var i = 0; i < header_data.length; i++) {
                         sem_subject_ids.push(header_data[i]['subject_id']);
                         sem_subject_code.push(header_data[i]['code']);
                         sem_subject_names.push(header_data[i]['subject']);
                         if (header_data[i]['subject_type'] == '1') {
                             sem_subject_types.push("Core");
                         } else {
                             sem_subject_types.push("Elective");
                         }

                     }*/
                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
                        // sem_subject_names.push(header_data[i]['subject']);
                    }

                    //create table heard
                    $('#exam_marks_tbl').DataTable().clear();

                    $('#exam_marks_tbl').find('tbody').empty();
                    $('#exam_marks_load_thead').find('tr').remove();
                    $('#exam_marks_tbl').DataTable().rows().remove();

                    $('#exam_marks_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                    $('#exam_marks_tbl tr:last').append(sem_subject_code
                        .map(id => `<th style="width:10%;">${id}</th>`)
                        .join(''))
                        .appendTo($('#exam_marks_load_thead'));

                    // end create table heard
                    $.post("<?php echo base_url('student/load_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'user_level': user_level,
                            'center_id':center_id

                        },
                        function (data) {
                            //console.log('kasun :');
                          //  console.log(data);
                            $('#exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {
                                for (var j = 0; j < data.length; j++) {
                                    $('#exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);

                                    for (var x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);

                                        if (data[j]['applied_subjects'][x]['is_approved'] > 2){
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                            //console.log(data[j]['exam_mark'].length);
                                            if(data[j]['exam_mark'].length > 0 && data[j]['exam_mark'].length > x)
                                                hod_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }
                                        else{
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "N/A";
                                            //console.log(data[j]['exam_mark'].length);
                                            if(data[j]['exam_mark'].length > 0 && data[j]['exam_mark'].length > x)
                                               hod_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                              // console.log('kasun'+j+'/'+x); && data[j]['exam_mark'].length > x
                                        }
                                    }

                                    if (j == 1) {
                                        //debugger;
                                    }
                                    var exam_marks_all = data[j]['exam_mark'];
                                    var exam_type_id = data[j]['exam_mark']['exam_type_id'];

                                    for (var z = 0; z < data[j]['exam_mark'].length; z++) {
                                        if(data[j]['exam_mark'][z]['exam_type_id'] == 2) {
                                            if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {
                                                var style_class = 'btn btn-success btn-xs';
                                                var tooltip = 'Approved';
                                                var onchange_function = 'onclick="event.preventDefault();approval_notify()"';

                                                hod_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                            }
                                            else {
                                                var style_class = 'btn btn-warning btn-xs';
                                                var tooltip = 'To be Approve ';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"'
                                                repeat_status = 1;

                                                ////////// check if condition for re correction ///////////
                                                if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                    hod_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                }
                                                else{
                                                    hod_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }
                                            }

                                            var di_exam_mark = data[j]['exam_mark'][z]['mark'];
                                            var di_exam_precentage = data[j]['exam_mark'][z]['persentage'];

                                            var approval_btn = '<button id="mark_approval" title="' + tooltip + '"  ' + onchange_function + '   class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';

                                            var exammark_prec_ca = ((di_exam_mark) * ((di_exam_precentage)/100)).toFixed(2);;

                                            var pre_exammark_ca = exammark_prec_ca.split('.');

                                            var pre_exam_total_ca = pre_exammark_ca[1];

                                            if(pre_exam_total_ca == '00'){
                                                var exam_total = pre_exammark_ca[0];
                                            }
                                            else{
                                                var exam_total = exammark_prec_ca;
                                            }

                                            var di_subject_id = data[j]['exam_mark'][z]['subject_id'];
                                            subjects_marks[di_subject_id] = exam_total + "<br>" + approval_btn;
                                        }
                                    }

                                    $('#exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+hod_style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\', 0, 0);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
                                    hod_style_cell = [];
                                }
                            $('.se-pre-con').fadeOut('slow');
                            } else {
                                var numCols1 = $("#exam_marks_tbl").find('tr')[0].cells.length;
                                $('#exam_marks_load_student').append("<tr><td colspan='"+numCols1+"' align='center' >No records to show.</td></tr>");
                                $('.se-pre-con').fadeOut('slow');
                            }
                        },
                        "json"
                    );
                },
                "json"
            );
        }
    }

    function mark_rpt_bulk_approve_status()
    {
        var table = $('.rpt_exam_marks_tbl').dataTable();
        var tableData = table.fnGetData();

        var res = [];

        var batch_id = $('#rpt_mark_batch').val();
        var course_id = $('#rpt_mark_course').val();
        var year = $('#rpt_mark_year').val();
        var semester = $('#rpt_mark_semester').val();
        var exam_id = $('#rpt_mark_exam').val();
        var center_id = $('#rpt_prom_centre').val();
        if(batch_id == '' || course_id == '' || year == '' || semester == '' || exam_id == '' || center_id == ''){
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester.';
            result_notification(res);
        } else {
            if (tableData.length == 0) {
                res['status'] = 'denied';
                res['message'] = 'Make sure data exists or Search students before bulk approval.';
                result_notification(res);
            } else {
                $('#rptBulkSpinner').show();
                $.post("<?php echo base_url('approvals/bulk_rpt_dir_mark_approval') ?>", {
                                'batch_id': batch_id,
                                'course_id': course_id,
                                'year': year,
                                'semester': semester,
                                'exam_id': exam_id,
                                'user_level': user_level,
                                'center_id':center_id
                            },
                    function (data) {
                        $('#rptBulkSpinner').hide();
                        if (data['dataFlag'] == false) {
                            res['status'] = 'denied';
                            res['message'] = 'Data do not exist for approval.';
                            result_notification(res);
                        } else if (data['result'] == true ) {
                            if(user_level == 'dir') {
                                rpt_load_student_data_mark_approval_dir();
                            } else if (user_level == 'ex_dir') {
                                rpt_load_student_data_mark_approval_ex_dir();
                            }
                            res['status'] = 'success';
                            res['message'] = 'All marks approved succesfully.';
                            result_notification(res);
                        } else {
                            res['status'] = 'denied';
                            res['message'] = 'Failed to approve all marks.Please check unapproved marks.';
                            result_notification(res);
                        }
                    },
                    "json"
                );
            }
        }


    }

    //REPEAT HOD------

    function rpt_load_student_data_mark_approval_hod() {
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
        var batch_id = $('#rpt_mark_batch').val();
        var course_id = $('#rpt_mark_course').val();
        var year = $('#rpt_mark_year').val();
        var semester = $('#rpt_mark_semester').val();
        var exam_id = $('#rpt_mark_exam').val();
        var center_id = $('#rpt_prom_centre').val();
        var hod_rpt_style_cell = [];

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/load_rpt_semester_subjects_by_semester') ?>", {
                    'center_id': center_id,
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
                    //console.log(header_data);

                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
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

                    // end create table heard
                    $.post("<?php echo base_url('student/load_rpt_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'user_level': user_level,
                            'center_id':center_id

                        },
                        function (data) {
                            //console.log(data);

                            $('#rpt_exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {

                                for (j = 0; j < data.length; j++) {
                                    $('#rpt_exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);
                                        if (data[j]['applied_subjects'][x]['is_approved'] > 2){
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                            hod_rpt_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }
                                        else{
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "N/A";
                                            hod_rpt_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }

                                    }

                                    //console.log(data[j]['exam_mark']);

                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs


                                        if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {
                                            var style_class = 'btn btn-success btn-xs';
                                            var tooltip = 'Approved';
                                            var onchange_function = 'onclick="event.preventDefault();approval_notify()"';
                                            //alert(data[j]['exam_mark'][z]['subject_id']);
                                            sbj_stat_array[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['is_hod_mark_aproved'];

                                            hod_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                        }
                                        else {
                                            var style_class = 'btn btn-warning btn-xs';
                                            var tooltip = 'To be Approve ';
                                            var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"'
                                            sbj_stat_array[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['is_hod_mark_aproved'];

                                            ////////// check if condition for re correction ///////////
                                            if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                hod_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                            }
                                            else{
                                                hod_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                            }
                                        }
                                        //console.log("sub_array :" );
                                        //console.log(sbj_stat_array);
                                        var approval_btn = '<button id="mark_approval" title="' + tooltip + '"  ' + onchange_function + '   class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';

//                                        var pre_exammark = data[j]['exam_mark'][z]['total_marks'].split('.');
//                                        var pre_exam_total = pre_exammark[1];
//
//                                        if(pre_exam_total == '00'){
//                                            var exam_total = pre_exammark[0];
//                                        }
//                                        else{
//                                            var exam_total = data[j]['exam_mark'][z]['total_marks'];
//                                        }


                                        var exammark_prec_ca = ((data[j]['exam_mark'][z]['mark']) * ((data[j]['exam_mark'][z]['persentage'])/100)).toFixed(2);;

                                        var pre_exammark_ca = exammark_prec_ca.split('.');

                                        var pre_exam_total_ca = pre_exammark_ca[1];

                                        if(pre_exam_total_ca == '00'){
                                            var exam_total = pre_exammark_ca[0];
                                        }
                                        else{
                                            var exam_total = exammark_prec_ca;
                                        }

//                                        if(data[j]['exam_mark'][z]['is_repeat'] == 3){
//                                            subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
//                                        }
//                                        else{
                                            subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "<br>" + approval_btn;
                                        //}

                                    }


                                    //console.log(sbj_stat_array);

                                    $('#rpt_exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+hod_rpt_style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\',' + sbj_stat_array[e] + ', 1);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#rpt_exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
                                    hod_rpt_style_cell = [];
//
                                }
                            $('.se-pre-con').fadeOut('slow');
                            } else {
                                var numCols5 = $("#rpt_exam_marks_tbl").find('tr')[0].cells.length;
                                $('#rpt_exam_marks_load_student').append("<tr><td colspan='"+numCols5+"' align='center' >No records to show.</td></tr>");
                                $('.se-pre-con').fadeOut('slow');
                            }
                        },
                        "json"
                    );
                },
                "json"
            );


        }
    }

    //=============================== End CA HOD Approval ============================================
    //=============================== CA Director  Approval ============================================
    function load_student_data_mark_approval_dir() {
        $('.se-pre-con').fadeIn('slow');
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var applied_subjects = [];
        var subjects_marks = {};
        var subjects_code = [];
        var dir_style_cell = [];

        bulk_approve_students = [];
        bulk_approve_subjects = [];

        var batch_id = $('#mark_batch').val();
        var course_id = $('#mark_course').val();
        var year = $('#mark_year').val();
        var semester = $('#mark_semester').val();
        var exam_id = $('#mark_exam').val();
        var center_id = $('#prom_centre').val();

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/semester_subjects_by_semester') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
                    //console.log(header_data);
                    /* for (var i = 0; i < header_data.length; i++) {
                         sem_subject_ids.push(header_data[i]['subject_id']);
                         sem_subject_code.push(header_data[i]['code']);
                         sem_subject_names.push(header_data[i]['subject']);
                         if (header_data[i]['subject_type'] == '1') {
                             sem_subject_types.push("Core");
                         } else {
                             sem_subject_types.push("Elective");
                         }

                     }*/
                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
                        // sem_subject_names.push(header_data[i]['subject']);


                    }

                    //create table heard
                    $('#exam_marks_tbl').DataTable().clear();

                    $('#exam_marks_tbl').find('tbody').empty();
                    $('#exam_marks_load_thead').find('tr').remove();
                    $('#exam_marks_tbl').DataTable().rows().remove();

                    $('#exam_marks_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                    $('#exam_marks_tbl tr:last').append(sem_subject_code
                        .map(id => `<th style="width:10%;">${id}</th>`)
                        .join(''))
                        .appendTo($('#exam_marks_load_thead'));

                    // end create table heard
                    $.post("<?php echo base_url('student/load_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'user_level': user_level,
                            'center_id':center_id

                        },
                        function (data) {
                            //console.log(data);

                            $('#exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {

                                $('#bulk_approve_btn_dir').attr('disabled', false);

                                for (j = 0; j < data.length; j++) {
                                    bulk_approve_students.push(data[j]['stu_id']);
                                    $('#exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);

                                    bulk_approve_subjects[data[j]['stu_id']] = [];

                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);

                                        if (data[j]['applied_subjects'][x]['is_approved']> 2){
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                            if(data[j]['exam_mark'].length> 0 && data[j]['exam_mark'].length > x)
                                                dir_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }
                                        else{
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "N/A";
                                            if(data[j]['exam_mark'].length >0 && data[j]['exam_mark'].length > x)
                                                dir_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }

                                    }


                                    //console.log(data[j]['exam_mark']);
                                    for (z = 0; z < data[j]['exam_mark'].length; z++){//btn btn-warning btn-xs

                                        if(data[j]['exam_mark'][z]['exam_type_id'] == 2){
                                            var link_id = '';
                                            if (data[j]['exam_mark'][z]['is_director_mark_approved'] == 1) {
                                                var style_class = 'btn btn-success btn-xs';
                                                var tooltip = 'Approved';
                                                var onchange_function = 'onclick="event.preventDefault();approval_notify()"';
                                                link_id = data[j]['stu_id'] + '_subject_mark_' + data[j]['exam_mark'][z]['subject_id'];
                                                $('#84_subject_mark_CRS01').removeAttr("href");
                                                // alert(link_id);
                                                //$('#'+link_id).unbind('click');

                                                dir_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";

                                            }
                                            else {
                                                var style_class = 'btn btn-warning btn-xs';
                                                var tooltip = 'To be Approve ';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';

                                                bulk_approve_subjects[data[j]['stu_id']][z] = data[j]['exam_mark'][z]['subject_id'];

                                                ////////// check if condition for re correction ///////////
                                                if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                    dir_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                }
                                                else{
                                                    dir_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }
                                            }


                                            var approval_btn = '<button id="mark_approval" title="' + tooltip + '" ' + onchange_function + '   class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';

                                            if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {

                                                //                                            var pre_mrk = data[j]['exam_mark'][z]['total_marks'].split('.');
                                                //                                            var decivalue = pre_mrk[1];
                                                //
                                                //                                            if(decivalue == '00'){
                                                //                                               var subjectmrk = pre_mrk[0];
                                                //                                            }
                                                //                                            else{
                                                //                                                var subjectmrk = data[j]['exam_mark'][z]['total_marks'];
                                                //                                            }

                                                    var exammark_prec_ca = ((data[j]['exam_mark'][z]['mark']) * ((data[j]['exam_mark'][z]['persentage'])/100)).toFixed(2);
                                                // var exammark_prec_ca = '99.00'//((data[j]['exam_mark'][z]['mark']) * ((data[j]['exam_mark'][z]['persentage'])/100)).toFixed(2);

                                                    var pre_exammark_ca = exammark_prec_ca.split('.');

                                                    var pre_exam_total_ca = pre_exammark_ca[1];

                                                    if(pre_exam_total_ca == '00'){
                                                        var subjectmrk = pre_exammark_ca[0];
                                                    }
                                                    else{
                                                        var subjectmrk = exammark_prec_ca;
                                                    }

                                                //                                            if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                //                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
                                                //                                            }
                                                //                                            else{
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = subjectmrk + "<br>" + approval_btn;
                                                //}
                                            } else {
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'HOD Not Approved';

                                            }
                                                      }
                                    }

                                    //console.log(subjects_marks);
                                    $('#exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+dir_style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\', 0, 0);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#exam_marks_load_student'));
                                        applied_subjects = [];
                                        subjects_marks   = {};
                                        dir_style_cell   = [];
                                        //
                                }
                            $('.se-pre-con').fadeOut('slow');
                            } else {

                                $('#bulk_approve_btn_dir').attr('disabled', true);
                                var numCols4 = $("#exam_marks_tbl").find('tr')[0].cells.length;

                                $('#exam_marks_load_student').append("<tr><td colspan='"+numCols4+"' align='center' >No records to show.</td></tr>");
                                $('.se-pre-con').fadeOut('slow');
                            }
                        },
                        "json"
                    );
                },
                "json"
            );


        }
    }


    //REPEAT DIRECTOR------

    function rpt_load_student_data_mark_approval_dir() {
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
        var batch_id = $('#rpt_mark_batch').val();
        var course_id = $('#rpt_mark_course').val();
        var year = $('#rpt_mark_year').val();
        var semester = $('#rpt_mark_semester').val();
        var exam_id = $('#rpt_mark_exam').val();
        var center_id = $('#rpt_prom_centre').val();
        var dir_rpt_style_cell = [];

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/load_rpt_semester_subjects_by_semester') ?>", {
                    'center_id': center_id,
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
                    //console.log(header_data);

                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
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

                    // end create table heard
                    $.post("<?php echo base_url('student/load_rpt_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'user_level': user_level,
                            'center_id':center_id

                        },
                        function (data) {
                            //console.log(data);

                            $('#rpt_exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {

                                for (j = 0; j < data.length; j++) {
                                    $('#rpt_exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);
                                        if (data[j]['applied_subjects'][x]['is_approved'] > 2){
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                            if(data[j]['exam_mark'].length> 0 && data[j]['exam_mark'].length > x)
                                                dir_rpt_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }
                                        else{
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "N/A";
                                            if(data[j]['exam_mark'].length> 0 && data[j]['exam_mark'].length > x)
                                                dir_rpt_style_cell[data[j]['exam_mark'][x]['subject_id']]= "";
                                        }

                                    }

                                    //console.log(data[j]['exam_mark']);

                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs

                                        dir_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";

                                        var link_id = '';
                                        if (data[j]['exam_mark'][z]['is_director_mark_approved'] == 1) {
                                            var style_class = 'btn btn-success btn-xs';
                                            var tooltip = 'Approved';
                                            var onchange_function = 'onclick="event.preventDefault();approval_notify()"';
                                            link_id = data[j]['stu_id'] + '_subject_mark_' + data[j]['exam_mark'][z]['subject_id'];
                                            $('#84_subject_mark_CRS01').removeAttr("href");
                                            sbj_stat_array[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['is_director_mark_approved'];

                                            dir_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";

                                        }
                                        else {
                                            var style_class = 'btn btn-warning btn-xs';
                                            var tooltip = 'To be Approve ';
                                            var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"'
                                            sbj_stat_array[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['is_director_mark_approved'];

                                            ////////// check if condition for re correction ///////////
                                            if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                dir_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                            }
                                            else{
                                                dir_rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                            }
                                        }
                                        //console.log("sub_array :" );
                                        //console.log(sbj_stat_array);
                                        var approval_btn = '<button id="mark_approval" title="' + tooltip + '"  ' + onchange_function + '   class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';

                                        if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {
//                                            var pre_mrk = data[j]['exam_mark'][z]['total_marks'].split('.');
//                                            var decivalue = pre_mrk[1];
//
//                                            if(decivalue == '00'){
//                                               var subjectmrk = pre_mrk[0];
//                                            }
//                                            else{
//                                                var subjectmrk = data[j]['exam_mark'][z]['total_marks'];
//                                            }

                                            var exammark_prec_ca = ((data[j]['exam_mark'][z]['mark']) * ((data[j]['exam_mark'][z]['persentage'])/100)).toFixed(2);;

                                            var pre_exammark_ca = exammark_prec_ca.split('.');

                                            var pre_exam_total_ca = pre_exammark_ca[1];

                                            if(pre_exam_total_ca == '00'){
                                                var subjectmrk = pre_exammark_ca[0];
                                            }
                                            else{
                                                var subjectmrk = exammark_prec_ca;
                                            }

//                                            if(data[j]['exam_mark'][z]['is_repeat'] == 3){
//                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
//                                            }
//                                            else{
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = subjectmrk + "<br>" + approval_btn;
                                            //}
                                        } else {
                                            subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'HOD Not Approved';

                                        }
                                    }


                                    //console.log(sbj_stat_array);

                                    $('#rpt_exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+dir_rpt_style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\',' + sbj_stat_array[e] + ', 1);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#rpt_exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
                                    dir_rpt_style_cell = [];
                                }
                            $('.se-pre-con').fadeOut('slow');
                            } else {
                                var numCols3 = $("#rpt_exam_marks_tbl").find('tr')[0].cells.length;

                                $('#rpt_exam_marks_load_student').append("<tr><td colspan='"+numCols3+"' align='center' >No records to show.</td></tr>");
                                $('.se-pre-con').fadeOut('slow');
                            }
                        },
                        "json"
                    );
                },
                "json"
            );


        }
    }


    //=============================== END CA Director  Approval ============================================
    //=============================== SE Director  Approval ============================================
    function load_student_data_mark_approval_ex_dir() {
        $('.se-pre-con').fadeIn('slow');
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
        var exam_id = $('#mark_exam').val();
        var center_id = $('#prom_centre').val();
        var style_cell = [];
        var se_marks_blank = 0;

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/semester_subjects_by_semester') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
                    //console.log(header_data);
                    /* for (var i = 0; i < header_data.length; i++) {
                         sem_subject_ids.push(header_data[i]['subject_id']);
                         sem_subject_code.push(header_data[i]['code']);
                         sem_subject_names.push(header_data[i]['subject']);
                         if (header_data[i]['subject_type'] == '1') {
                             sem_subject_types.push("Core");
                         } else {
                             sem_subject_types.push("Elective");
                         }

                     }*/
                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
                        // sem_subject_names.push(header_data[i]['subject']);


                    }

                    //create table heard
                    $('#exam_marks_tbl').DataTable().clear();

                    $('#exam_marks_tbl').find('tbody').empty();
                    $('#exam_marks_load_thead').find('tr').remove();
                    $('#exam_marks_tbl').DataTable().rows().remove();

                    $('#exam_marks_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                    $('#exam_marks_tbl tr:last').append(sem_subject_code
                        .map(id => `<th style="width:10%;">${id}</th>`)
                        .join(''))
                        .appendTo($('#exam_marks_load_thead'));

                    // end create table heard
                    $.post("<?php echo base_url('student/load_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'user_level': user_level,
                            'center_id':center_id

                        },
                        function (data) {
                            //console.log(data);

                            $('#exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {


                                for (j = 0; j < data.length; j++) {
                                    $('#exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);

                                        if (data[j]['applied_subjects'][x]['is_approved'] > 2){
                                            //subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "NE";
                                            style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }
                                        else{
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "N/A";
                                            style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }

                                    }


                                    //console.log(data[j]['exam_mark']);
                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs
                                        if((data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['mark'] >= 0 && data[j]['exam_mark'][z]['result'] != "-") || (data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['result'] == 'AB') || (data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['result'] == 'DFR') || (data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['result'] == 'NE')){

                                            if (data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == 1) {
                                                var style_class = 'btn btn-success btn-xs';
                                                var tooltip = 'Approved';
                                                var onchange_function = 'onclick="event.preventDefault();approval_notify()"';

                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";

                                                //                                                ////////// check if condition for re correction ///////////
                                                //                                                if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                //                                                    style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                //                                                }
                                                //                                                else{
                                                //                                                    style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                //                                                }
                                            }
                                            else {
                                                var style_class = 'btn btn-warning btn-xs';
                                                var tooltip = 'To be Approve';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';

                                                ////////// check if condition for re correction ///////////
                                                if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                    style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                }
                                                else{
                                                    style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }

                                            }


                                            var approval_btn = '<button id="mark_approval" title="' + tooltip + '" ' + onchange_function + ' class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';


                                            //  subjects_marks[data[j]['exam_mark'][z]['subject_code']] = data[j]['exam_mark'][z]['total_marks'] + "/" + data[j]['exam_mark'][z]['overall_grade'] + "<br>" + approval_btn;


                                            if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {
                                                if (data[j]['exam_mark'][z]['is_director_mark_approved'] == 1){
                                                  
                                                    var pre_subjmrk = data[j]['exam_mark'][z]['total_marks'].split('.');
                                                    var subjdecivalue = pre_subjmrk[1];

                                                    if(subjdecivalue == '00'){
                                                       var subjmrk = pre_subjmrk[0];
                                                    }
                                                    else{
                                                        var subjmrk = data[j]['exam_mark'][z]['total_marks'];
                                                    }

                                                    if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
                                                    }
                                                    else{
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = subjmrk + "/" + data[j]['exam_mark'][z]['result'] + "<br>" + approval_btn;
                                                    }
                                                }else{
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'ATI Director Not Approved';
                                                }
                                            } else {
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'HOD Not Approved';

                                            }
                                        }
                                        else{
                                            if((data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['mark'] == null && data[j]['exam_mark'][z]['is_exam_held'] == 1 && data[j]['exam_mark'][z]['is_attend'] == 1)){
                                                if((data[j]['exam_mark'][z]['subj_approved'] > 0) && (data[j]['exam_mark'][z]['subj_approved'] <=2)){
                                                    se_marks_blank = 1;
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "SE Marks Not Entered.";
                                                    style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #e62626;';
                                                }
                                                
                                            }else{
                                                if(data[j]['exam_mark'][z]['is_attend'] == 0){
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['total_marks'] + "/ "+ data[j]['exam_mark'][z]['result'] + "<br>" + approval_btn;//" + data[j]['exam_mark'][z]['result'] + "
                                                   
                                                }

                                            }
                                          //  console.log(data[j]['exam_mark'][z]['id']);
                                        }
                                    }

                                    //console.log(subjects_marks);
                                    $('#exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\', 0, 0);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
                                    style_cell = [];
//
                                }
                            $('.se-pre-con').fadeOut('slow');

                            if(se_marks_blank == 1){
                                $('#bulk_approve_btn').attr('disabled', true);
                            }
                            else{
                                $('#bulk_approve_btn').attr('disabled', false);
                            }

                            } else {
                                $('#bulk_approve_btn').attr('disabled', true);
                                var numCols2 = $("#exam_marks_tbl").find('tr')[0].cells.length;

                                $('#exam_marks_load_student').append("<tr><td colspan='"+numCols2+"' align='center' >No records to show.</td></tr>");
                                $('.se-pre-con').fadeOut('slow');
                            }
                        },
                        "json"
                    );
                },
                "json"
            );


        }
    }


    //REPEAT EX DIRECTOR------

    function rpt_load_student_data_mark_approval_ex_dir() {
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
        var batch_id = $('#rpt_mark_batch').val();
        var course_id = $('#rpt_mark_course').val();
        var year = $('#rpt_mark_year').val();
        var semester = $('#rpt_mark_semester').val();
        var exam_id = $('#rpt_mark_exam').val();
        var center_id = $('#rpt_prom_centre').val();
        var rpt_style_cell = [];
        var rpt_se_marks_blank = 0;

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('subject/load_rpt_semester_subjects_by_semester') ?>", {
                    'center_id': center_id,
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (header_data) {
                    //console.log(header_data);

                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
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

                    // end create table heard
                    $.post("<?php echo base_url('student/load_rpt_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'user_level': user_level,
                            'center_id':center_id

                        },
                        function (data) {
                            //console.log(data);

                            $('#rpt_exam_marks_load_student').find('tr').remove();
                            if (data.length > 0) {

                                for (j = 0; j < data.length; j++) {
                                    $('#rpt_exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);
                                        if (data[j]['applied_subjects'][x]['is_approved'] > 2){
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                            rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }
                                        else{
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "N/A";
                                            rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }

                                    }

                                    //console.log(data[j]['exam_mark']);

                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs

                                        if((data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['mark'] > 0) || (data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['result'] == 'AB') || (data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['result'] == 'NE')|| (data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['mark'] == null) ){

                                            if (data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == 1) {
                                                var style_class = 'btn btn-success btn-xs';
                                                var tooltip = 'Approved';
                                                var onchange_function = 'onclick="event.preventDefault();approval_notify()"';
                                                sbj_stat_array[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['is_ex_director_mark_approved'];

                                                ////////// check if condition for re correction ///////////
                                                if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1' && (exam_id == data[j]['exam_mark'][z]['sem_exam_id'])){
                                                    rpt_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                }
                                                else{
                                                    rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }
                                            }
                                            else {
                                                var style_class = 'btn btn-warning btn-xs';
                                                var tooltip = 'To be Approve';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';
                                                sbj_stat_array[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['is_ex_director_mark_approved'];

                                                ////////// check if condition for re correction ///////////
                                                if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1' && (exam_id == data[j]['exam_mark'][z]['sem_exam_id'])){
                                                    rpt_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                }
                                                else{
                                                    rpt_style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }
                                            }

                                            var approval_btn = '<button id="mark_approval" title="' + tooltip + '" ' + onchange_function + ' class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';


                                            //  subjects_marks[data[j]['exam_mark'][z]['subject_code']] = data[j]['exam_mark'][z]['total_marks'] + "/" + data[j]['exam_mark'][z]['overall_grade'] + "<br>" + approval_btn;


                                            if (data[j]['exam_mark'][z]['is_hod_mark_aproved'] == 1) {
                                                if (data[j]['exam_mark'][z]['is_director_mark_approved'] == 1){

                                                    var pre_subjmrk = data[j]['exam_mark'][z]['total_marks'].split('.');
                                                    var subjdecivalue = pre_subjmrk[1];

                                                    if(subjdecivalue == '00'){
                                                       var subjmrk = pre_subjmrk[0];
                                                    }
                                                    else{
                                                        var subjmrk = data[j]['exam_mark'][z]['total_marks'];
                                                    }

                                                    if(data[j]['exam_mark'][z]['is_repeat'] == 3){
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
                                                    }
                                                    else{
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = subjmrk + "/" + data[j]['exam_mark'][z]['result'] + "<br>" + approval_btn;
                                                    }
                                                }else{
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'ATI Director Not Approved';
                                                }
                                            } else {
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'HOD Not Approved';

                                            }

                                            if((data[j]['exam_mark'][z]['exam_type_id'] == '1' && data[j]['exam_mark'][z]['mark'] == null && data[j]['exam_mark'][z]['is_exam_held'] == 1 && data[j]['exam_mark'][z]['is_attend'] == 1)){
                                                if((data[j]['exam_mark'][z]['is_repeat_approved'] == 1) && (data[j]['exam_mark'][z]['is_repeat'] == 1)){
                                                    rpt_se_marks_blank = 1;
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "SE Marks Not Entered.";
                                                    rpt_style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #e62626;';
                                                }
                                            }
                                        }
                                    }


                                    //console.log(sbj_stat_array);

                                    $('#rpt_exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+rpt_style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? '<a  id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_mark_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\',' + sbj_stat_array[e] + ', 1);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#rpt_exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
                                    rpt_style_cell = [];
                                }
                            $('.se-pre-con').fadeOut('slow');

                            if(rpt_se_marks_blank == 1){
                                $('#rpt_bulk_approve_btn').attr('disabled', true);
                            }
                            else{
                                $('#rpt_bulk_approve_btn').attr('disabled', false);
                            }

                            } else {
                                var numCols = $("#rpt_exam_marks_tbl").find('tr')[0].cells.length;

                                $('#rpt_exam_marks_load_student').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");
                                $('.se-pre-con').fadeOut('slow');
                            }
                        },
                        "json"
                    );
                },
                "json"
            );


        }
    }


    //=============================== END CA Director  Approval ============================================


</script>

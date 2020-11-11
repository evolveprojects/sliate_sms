<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Training Exam Mark Approvals</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Approvals</li>
            <li><i class="fa fa-share-alt"></i>Training Exam Mark Approvals</li>
        </ol>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="post" id="exam_marks_form" name="exam_marks_form"
              autocomplete="off">
            <div class="panel">
                <header class="panel-heading">
                    Training Exam Marks Approval
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
                                                <button type='button' class='btn btn-primary'
                                                        onclick='event.preventDefault();load_student_data_mark_approval_training();'>
                                                    Search
                                                    Students
                                                </button>
                                                <button id="bulk_approve_btn" type='button' class='btn btn-danger' style="margin-left: 30px;"
                                                        onclick='event.preventDefault();mark_bulk_approve_status();'>
                                                    Bulk
                                                    Approve
                                                </button>
                                                <i id="bulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
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
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault();rpt_load_student_data_mark_approval_training();'>
                                                        Search
                                                        Students
                                                    </button>
                                                    <button id="rpt_bulk_approve_btn" type='button' class='btn btn-danger' style="margin-left: 30px;"
                                                        onclick='event.preventDefault();mark_rpt_bulk_approve_status();'>
                                                    Bulk
                                                    Approve
                                                    </button>
                                                    <i id="rptBulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
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
        $('#rpt_bulk_approve_btn').attr('disabled', true);     

    });

    function get_courses(center_id, flag, course_id, lookup_flag) {

        $('#mark_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

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
                                $('#mark_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
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
        $('#mark_exam').find('option').remove().end();
        $('#mark_exam').append('<option value="">---Select Exam---</option>').val('');

        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#mark_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
                }
            },
            "json"
        );
    }

    function rpt_load_semester_exam(batch_id) {
            $('#rpt_mark_exam').find('option').remove().end();
            $('#rpt_mark_exam').append('<option value="">---Select Exam---</option>').val('');

            $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#rpt_mark_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));

                    }
                },
                "json"
            );
        }
    function get_course_code(course_id, lookup_flag) {
        $('#mark_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    $('#mark_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                }
            },
            "json"
        );
    }

function rpt_get_course_code(course_id, lookup_flag) {
        
        $('#rpt_mark_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        
        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {
                for (j = 0; j < data.length; j++) {
                    $('#rpt_mark_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                }
            },
            "json"
        );
    }
    

    function load_year_data(exam_id, year_no) {
        $('#mark_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');

        var course_id = $('#mark_course').val();

        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (i == year_no) {
                            $('#mark_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                        } else {
                            $('#mark_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                        }
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
                        if (i == year_no) {
                            $('#rpt_mark_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                        } else {
                            $('#rpt_mark_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                        }
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
                $.post("<?php echo base_url('approvals/bulk_mark_approval_training') ?>", {
                                'batch_id': batch_id,
                                'course_id': course_id,
                                'year': year,
                                'semester': semester,
                                'exam_id': exam_id,
                                'center_id':center_id

                            },
                    function (data) {
                        $('#bulkSpinner').hide();
                        if (data['dataFlag'] == false) {
                            res['status'] = 'denied';
                            res['message'] = 'Data do not exist for approval.';
                            result_notification(res);
                        } else if (data['result'] == true ) {
                            load_student_data_mark_approval_training();
                            
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
                $.post("<?php echo base_url('approvals/rpt_bulk_mark_approval_training') ?>", {
                                'batch_id': batch_id,
                                'course_id': course_id,
                                'year': year,
                                'semester': semester,
                                'exam_id': exam_id,
                                'center_id':center_id

                            },
                    function (data) {
                        $('#rptBulkSpinner').hide();
                        if (data['dataFlag'] == false) {
                            res['status'] = 'denied';
                            res['message'] = 'Data do not exist for approval.';
                            result_notification(res);
                        } else if (data['result'] == true ) {
                            rpt_load_student_data_mark_approval_training();
                            
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
    
    
    //=============================== TRAINING DIRECTOR APPROVAL ============================================
    function load_student_data_mark_approval_training() {
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
                    for (var i = 0; i < header_data[(header_data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(header_data[(header_data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+header_data[(header_data.length - 1)]['lecturer_subject'][i]['code']+"]");
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
                    $.post("<?php echo base_url('student/load_student_for_exam_marks_training') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'center_id':center_id

                        },
                        function (data) {
                            
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
         
                                        if (data[j]['applied_subjects'][x]['is_approved'] > 0 && data[j]['applied_subjects'][x]['is_approved'] <= 2)//is_approved
                                        {
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "--";
                                            style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }
                                    }

                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs
                                        
                                        if((data[j]['exam_mark'][z]['mark'] == 0 && data[j]['exam_mark'][z]['result'] != "-") && (data[j]['exam_mark'][z]['mark'] == 0 && data[j]['exam_mark'][z]['result'] != '')){
                                            
                                            if (data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == 1) {
                                                var style_class = 'btn btn-success btn-xs';
                                                var tooltip = 'Approved';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';
                                            }
                                            else {
                                                if(data[j]['exam_mark'][z]['is_repeat_mark'] == 1){
                                                    var style_class = 'btn btn-success btn-xs';
                                                    var tooltip = 'Approved & Applied as Repeat';
                                                    var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';
                                                }
                                                else{
                                                    var style_class = 'btn btn-warning btn-xs';
                                                    var tooltip = 'To be Approve';
                                                    var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';
                                                }
                                            }

                                            var approval_btn = '<button id="'+data[j]['stu_id']+'_subject_mark_'+data[j]['exam_mark'][z]['subject_id']+'" title="' + tooltip + '"  ' + onchange_function + ' class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';
                                            
                                             subjects_marks[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['result']+'<br>'+approval_btn;
                                        }
                                        else{
                                            if((data[j]['exam_mark'][z]['subj_approved'] > 0) && (data[j]['exam_mark'][z]['subj_approved'] <=2)){ 
                                                se_marks_blank = 1;
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "Training Marks Not Entered.";
                                                style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #e62626;';
                                            }
                                        }
                                    }

                                    $('#exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? subjects_marks[e] : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
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
    
    
    function click_mark(subject_id, stu_id) {
        $("#" + stu_id + "_subject_mark_" + subject_id)[0].click();

    }
    
  
    //=============================== REPEAT - TRAINING DIRECTOR APPROVAL ============================================
    
    function rpt_load_student_data_mark_approval_training() {
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
                    $.post("<?php echo base_url('student/load_rpt_student_for_exam_marks_training') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'center_id':center_id

                        },
                        function (data) {
                            $('#rpt_exam_marks_load_student').find('tr').remove();
                            
                            if (data.length > 0) {
                                
                                $('#rpt_bulk_approve_btn').attr('disabled', false);   

                                for (j = 0; j < data.length; j++) {
                                    $('#rpt_exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']
                                    ]).draw(false);
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);
                                        if (data[j]['applied_subjects'][x]['is_repeat_approved'] == 1){
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "--";
                                            rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }
                                    }
                                    
                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {//btn btn-warning btn-xs
       
                                        if((data[j]['exam_mark'][z]['mark'] == 0 && data[j]['exam_mark'][z]['result'] != "-") || (data[j]['exam_mark'][z]['mark'] == 0 && data[j]['exam_mark'][z]['result'] != '')){
                                            
                                            if (data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == 1) {
                                                var style_class = 'btn btn-success btn-xs';
                                                var tooltip = 'Approved';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';
                                            }
                                            else {
                                                var style_class = 'btn btn-warning btn-xs';
                                                var tooltip = 'To be Approve';
                                                var onchange_function = 'onclick="event.preventDefault();click_mark(\'' + data[j]['exam_mark'][z]['subject_id'] + '\',' + data[j]['stu_id'] + ')"';
                                            }

                                            var approval_btn = '<button id="'+data[j]['stu_id']+'_subject_mark_'+data[j]['exam_mark'][z]['subject_id']+'" title="' + tooltip + '"  ' + onchange_function + ' class="' + style_class + '"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';
                                            
                                             subjects_marks[data[j]['exam_mark'][z]['subject_id']] = data[j]['exam_mark'][z]['result']+'<br>'+approval_btn;
                                        }
                                    }
                                    
                                    $('#rpt_exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+rpt_style_cell[e]+`text-align:center; width:10%;">${applied_subjects.includes(e) ? subjects_marks[e] : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#rpt_exam_marks_load_student'));
                                    applied_subjects = [];
                                    subjects_marks = {};
                                }
                            $('.se-pre-con').fadeOut('slow');
                            } else {
                                $('#rpt_bulk_approve_btn').attr('disabled', true);   
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


</script>

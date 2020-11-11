<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Training Exam Marks</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Exam</li>
            <li><i class="fa fa-book"></i>Training Exam Mark</li>
        </ol>
    </div>
</div>
<!-- Nav tabs -->
<form class="form-horizontal" role="form" method="post" id="exam_marks_form" name="exam_marks_form" autocomplete="off">
    <div class="panel">
        <header class="panel-heading">
            Training Exam Marks
        </header>
        <div class="panel-body">
            <div class="row">
                <input type="hidden" id="repeat_status_id">
                    <!-- ------------------ -->
                    <div class="col-md-12">
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
                                                <label for="course" class="col-md-3 control-label">Course</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="course" name="course"
                                                            onchange="get_course_code(this.value, 1, null, null)" data-validation="required"
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
                                                <label for="course" class="col-md-3 control-label">Year</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="year" name="year"
                                                            onchange="load_semesters(this.value, null)" data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="course" class="col-md-3 control-label">Semester</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="semester" name="semester" onchange=""
                                                            data-validation="required"
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
                                                <label for="batch" class="col-md-3 control-label">Batch</label>
                                                <div class="col-md-7">
                                                    <select id="batch" class="form-control" style="width:100%" name="batch"
                                                            onchange="load_semester_exam(this.value)" data-validation="required"
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
                                                    <select id="exam" class="form-control" style="width:100%" name="exam"
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <!--  <div class="col-md-offset-4 col-md-11">-->
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault();load_student_data();'>Search Students
                                                    </button>
                                              
                                                    <button type='button' id="bulk_save_btn" class='btn btn-success' style='margin-left: 30px;'
                                                            onclick='event.preventDefault();bulk_save_training_marks();'>Bulk Save marks
                                                    </button>
                                              <!--  </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div style="overflow-x:auto;overflow-y:300px;">
                                    <table class="table table-bordered exam_marks_tbl" id="exam_marks_tbl">
                                        <thead id="load_thead" style="overflow-y:300px;">
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
                                <div role="tabpanel" class="tab-pane" id="rpt_exam_mark_tab"><br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_center" class="col-md-3 control-label">Center</label>
                                                <div class="col-md-7">
                                                    <?php      
                                                    global $branchdrop;
                                                    global $selectedbr;
                                                    $extraattrs = 'id="rpt_centre" class="form-control" style="width:100%" onchange="get_rpt_courses(this.value, 1, null)"';
                                                    echo form_dropdown('rpt_centre', $branchdrop, $selectedbr, $extraattrs);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_course" class="col-md-3 control-label">Course</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="rpt_course" name="rpt_course"
                                                            onchange="get_rpt_course_code(this.value, 1, null, null)" data-validation="required"
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
                                                <label for="course" class="col-md-3 control-label">Year</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="rpt_year" name="rpt_year"
                                                            onchange="load_rpt_semesters(this.value, null)" data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="course" class="col-md-3 control-label">Semester</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="rpt_semester" name="rpt_semester" onchange=""
                                                            data-validation="required"
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
                                                <label for="batch" class="col-md-3 control-label">Batch</label>
                                                <div class="col-md-7">
                                                    <select id="rpt_batch" class="form-control" style="width:100%" name="rpt_batch"
                                                            onchange="load_rpt_semester_exam(this.value)" data-validation="required"
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
                                                    <select id="rpt_exam" class="form-control" style="width:100%" name="rpt_exam"
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <!--  <div class="col-md-offset-4 col-md-11">-->
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault();load_rpt_student_data();'>Search Students
                                                    </button>
                                                    <button type='button' id="bulk_save_btn_rpt" class='btn btn-success' style='margin-left: 30px;'
                                                            onclick='event.preventDefault();bulk_save_training_marks();'>Bulk Save marks
                                                    </button>
                                              <!--  </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div style="overflow-x:auto;overflow-y:300px;">
                                    <table class="table table-bordered exam_marks_tbl" id="rpt_exam_marks_tbl">
                                        <thead id="load_rpt_thead">
                                        <tr>
                                            <th>#</th>
                                            <th>Reg No</th>
                                            <th>Admission No</th>
                                            <th>Student</th>
                                        </tr>
                                        </thead>
                                        <tbody id="load_rpt_student">
                                        <!--<tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade bs-example-modal-lg" id="marks_modal">
    <div class="modal-dialog modal-lg" style="width:70%;padding-top:13px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal_title" id="modal_title">Student Marks</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" id="student_mark_form" name="student_mark_form"
                      autocomplete="off">
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
                <button type="button" class="save_marks_btn btn btn-primary pull-left" onclick="save_marks();" id="subject_mark_save">Save</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/util.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

    
    $.validate({
        form: '#exam_marks_form'
    });

    $.validate({
        form: '#student_mark_form'
    });


    var readonly_text_ca = '';

    $(function () {
        
        $('#repeat_status_id').val('0');  
        
        $("#bulk_save_btn").prop("disabled",true);
        $("#bulk_save_btn_rpt").prop("disabled",true);

        //for autoload course
        if ($('#prom_centre').val() != '') {
            get_courses($('#prom_centre').val(), 1, null);
        }

        $('#exam_marks_tbl').DataTable({
            'ordering': true,
            'paging':false,
            'searching':false
            //,'lengthMenu': [25, 50]
        });
        
        
        //for autoload repeat course
        if ($('#rpt_centre').val() != '') {
            get_rpt_courses($('#rpt_centre').val(), 1, null);
        }

        $('#rpt_exam_marks_tbl').DataTable({
            'ordering': true,
            'paging':false,
            'searching':false
            //'lengthMenu': [25, 50]
        });

    });

    function get_courses(center_id, flag, course_id) {
        $('#course').find('option').remove().end().append('<option value="">------Select Course------</option>').val('');
        if (flag === 1) {
            $.post("<?php echo base_url('Year/load_course_programs') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (course_id == data[i]['course_id']) {
                            $('#course').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                        } else {
                            $('#course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                        }
                    }
                },
                "json"
            );
        }
    }
    
    
    function get_rpt_courses(center_id, flag, course_id) {

        $('#rpt_course').find('option').remove().end().append('<option value="">------Select Course------</option>').val('');
        if (flag === 1) {
            $.post("<?php echo base_url('Year/load_course_programs') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (course_id == data[i]['course_id']) {
                            $('#rpt_course').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                        } else {
                            $('#rpt_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+" - "+data[i]['course_name']));
                        }
                    }
                },
                "json"
            );
        }
    }

    function get_course_code(course_id, flag, year_no, batch_id) {
        $('#year').find('option').remove().end().append('<option value="">------Select Year-----</option>').val('');
        $('#batch').find('option').remove().end().append('<option value="">-----Select Batch-----</option>').val('');
        
        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (flag) {
                            if (i == year_no) {
                                $('#year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                            } else {
                                $('#year').append($("<option></option>").attr("value", i).text(i+" Year"));
                            }
                        } else {
                            $('#year').append($("<option></option>").attr("value", i).text(i+" Year"));
                            
                        }
                    }
                }

                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
                    function (data) {

                        for (j = 0; j < data.length; j++) {
                            if (data[j]['id'] == batch_id) {
                                $('#batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                            } else {
                                $('#batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            }
                        }

                    },
                    "json"
                );
            },
            "json"
        );
    }
    
    
    function get_rpt_course_code(course_id, flag, year_no, batch_id) {
        
        $('#rpt_year').find('option').remove().end().append('<option value="">------Select Year-----</option>').val('');
        $('#rpt_batch').find('option').remove().end().append('<option value="">-----Select Batch-----</option>').val('');
        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (flag) {
                            if (i == year_no) {
                                $('#rpt_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                            } else {
                                $('#rpt_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                            }
                        } else {
                            $('#rpt_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                        }
                    }
                }

                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
                    function (data) {

                        for (j = 0; j < data.length; j++) {
                            if (data[j]['id'] == batch_id) {
                                $('#rpt_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                            } else {
                                $('#rpt_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            }
                        }

                    },
                    "json"
                );
            },
            "json"
        );
    }

    function load_semesters(year_no, semester_no) {
        //$('#year').find('option').remove().end().append('<option value=""></option>').val('');
        //$('#semester').find('option').remove().end();
        $('#semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        $('#rpt_semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        var course_id = $('#course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                for (var i = 1; i <= data; i++) {
                    if (semester_no == i) {

                        $('#semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                        $('#rpt_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                    } else {
                        $('#semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                        $('#rpt_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                    }
                }
            },
            "json"
        );
    }
    
    
    function load_rpt_semesters(year_no, semester_no) {
        //$('#year').find('option').remove().end().append('<option value=""></option>').val('');
        //$('#semester').find('option').remove().end();
        $('#rpt_semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        var course_id = $('#rpt_course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                for (var i = 1; i <= data; i++) {
                    if (semester_no == i) {

                        $('#rpt_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                    } else {
                        $('#rpt_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                    }
                }
            },
            "json"
        );
    }
    

    function load_semester_exam(batch_id) {
        $('#exam').find('option').remove().end().append('<option value="">-----Select Exam-----</option>').val('');
        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {

                    $('#exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
                }
            },
            "json"
        );
    }
    
    
    function load_rpt_semester_exam(batch_id) {
        $('#rpt_exam').find('option').remove().end().append('<option value="">-----Select Exam-----</option>').val('');
        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {

                    $('#rpt_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code']+" - "+data[i]['exam_name']));
                }
            },
            "json"
        );
    }
    



    function load_student_data() {
        $('.se-pre-con').fadeIn('slow');
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var applied_subjects = [];
        var subjects_marks = {};
        var subjects_code = [];
        var batch_id = $('#batch').val();
        var course_id = $('#course').val();
        var year = $('#year').val();
        var semester = $('#semester').val();
        var exam_id = $('#exam').val();
        var center_id = $('#prom_centre').val();
        var style_cell = [];
        var select_list = '';
        var select_status = [];
        var disable_status = '';
        
        
        var select_grade_option = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'E', 'Pass', 'Fail'];
        
        
        
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
                function (data) {
        
                    for (var i = 0; i < data[(data.length - 1)]['lecturer_subject'].length; i++) {
                        sem_subject_ids.push(data[(data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        sem_subject_code.push(data[(data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+data[(data.length - 1)]['lecturer_subject'][i]['code']+"]");
                    }
                    
                    $.post("<?php echo base_url('student/load_student_for_exam_marks_training') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'center_id': center_id
                        },
                        function (data) {
                            
                            $('#exam_marks_tbl').DataTable().clear();
                            $("#exam_marks_tbl").find('tbody').empty();
                            $('#load_thead').find('tr').remove();
                            
                            if (data.length > 0) {
                                
                                $("#bulk_save_btn").prop("disabled",false);

                                $('#exam_marks_tbl').DataTable().rows().remove();
                                $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                                $('#exam_marks_tbl tr:last').append(sem_subject_code
                                    .map(id => `<th style="width: 10%;">${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_thead'));
                            
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
                                            $('#repeat_status_id').val('0');
                                            
                                            select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['applied_subjects'][x]['subject_id']+'" name="training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['applied_subjects'][x]['subject_id']+ ']" class="form-control"'+disable_status+'><option value="">---Please Select---</option>';
                                            for (y = 0; y < select_grade_option.length; y++) {
                                                select_list += '<option value="'+select_grade_option[y]+'"'+select_status[select_grade_option[y]]+'>'+select_grade_option[y]+'</option>';
                                            }
                                            select_list += '</select>';
                                            subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = select_list;
                                            style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }
                                    }

                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {
                                        if(data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == '0'){
                                            if(data[j]['exam_mark'][z]['is_repeat_mark'] == '1'){
                                                select_list = '';
                                                disable_status = ' disabled';
                                                select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == select_grade_option[y]){
                                                        select_status[select_grade_option[y]] = 'selected';
                                                    }
                                                    else{
                                                        select_status[select_grade_option[y]] = '';
                                                    }
                                                    select_list += '<option value="'+select_grade_option[y]+'"'+select_status[select_grade_option[y]]+'>'+select_grade_option[y]+'</option>';
                                                }
                                                select_list += '</select>';
                                                select_list += '<br>Applied as Repeat';
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = select_list;
                                            }
                                            else{
                                                select_list = '';
                                                disable_status = '';
                                                select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == select_grade_option[y]){
                                                        select_status[select_grade_option[y]] = ' selected';
                                                    }
                                                    else{
                                                        select_status[select_grade_option[y]] = '';
                                                    }
                                                    
                                                    select_list += '<option value="'+select_grade_option[y]+'"'+select_status[select_grade_option[y]]+'>'+select_grade_option[y]+'</option>';
                                                }
                                                select_list += '</select>';
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = select_list;
                                            }
                                        }
                                        else{
                                            if(data[j]['exam_mark'][z]['is_repeat_approve'] == 1){
                                                select_list = '';
                                                disable_status = ' disabled';
                                                select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == select_grade_option[y]){
                                                        select_status[select_grade_option[y]] = ' selected';
                                                    }
                                                    else{
                                                        select_status[select_grade_option[y]] = '';
                                                    }
                                                    
                                                    select_list += '<option value="'+select_grade_option[y]+'"'+select_status[select_grade_option[y]]+'>'+select_grade_option[y]+'</option>';
                                                }
                                                select_list += '</select>';
                                                select_list += '<br>Applied as Repeat';
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = select_list;
                                            }
                                            else if(data[j]['exam_mark'][z]['is_repeat_approve'] == 3){
                                                select_list = '';
                                                disable_status = ' disabled';
                                                select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == select_grade_option[y]){
                                                        select_status[select_grade_option[y]] = ' selected';
                                                    }
                                                    else{
                                                        select_status[select_grade_option[y]] = '';
                                                    }
                                                    
                                                    select_list += '<option value="'+select_grade_option[y]+'"'+select_status[select_grade_option[y]]+'>'+select_grade_option[y]+'</option>';
                                                }
                                                select_list += '</select>';
                                                select_list += '<br>Repeat Exam Rejected';
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = select_list;
                                            }
                                            else{
                                                select_list = '';
                                                disable_status = ' disabled';
                                                select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == select_grade_option[y]){
                                                        select_status[select_grade_option[y]] = ' selected';
                                                    }
                                                    else{
                                                        select_status[select_grade_option[y]] = '';
                                                    }
                                                    
                                                    select_list += '<option value="'+select_grade_option[y]+'"'+select_status[select_grade_option[y]]+'>'+select_grade_option[y]+'</option>';
                                                }
                                                select_list += '</select>';
                                                select_list += '<br>Training Marks Approved';
                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = select_list;
                                            }  
                                        }
                                    }

                                    $('#exam_marks_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td style="`+style_cell[e]+`text-align:center; width: 15%;">${applied_subjects.includes(e) ? subjects_marks[e] : "--"}</td>`)
                                        .join(''))
                                        .appendTo($('#load_student'));

                                    applied_subjects = [];
                                    subjects_marks = {};
                                }
                                
                            }
                            else {
                                $("#bulk_save_btn").prop("disabled",true);
                                
                                $('#load_student').find('tr').remove();
                                $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                                $('#exam_marks_tbl tr:last').append(sem_subject_code
                                    .map(id => `<th style="width: 10%;">${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_thead'));
                            
                                var numCols = $("#exam_marks_tbl").find('tr')[0].cells.length;

                                $('#load_student').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");
                                

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
    
    
    
    function bulk_save_training_marks(){
    
        var repeat_val = $('#repeat_status_id').val();
   
        $.ajax(
        {
            url: "<?php echo base_url('exam/bulk_save_training_marks') ?>",
            type: 'POST',
            async: true,
            cache: false,
            dataType: 'json',
//            data: $('#exam_marks_form').serialize() + "&course_id=" + course_id + "&year_no=" + year + "&semester_no=" + semester + "&exam_id=" + exam_id + "&batch_id=" + batch_id + "&repeat_val=" + repeat_val + "&mark_type=" + mark_type + "",
            data: $('#exam_marks_form').serialize() + "&repeat_val=" + repeat_val + "",
            success: function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    result_notification(data);
                    if (data['status'] == "success") {
                        if(repeat_val == 1){
                            load_rpt_student_data();
                        }
                        else{
                            load_student_data();
                        }
                    }
                }
            }
        });
    }


    
    
   //------------------------------------------------ REPEAT EXAM MARK --------------------------------------------------------// 
    
    function load_rpt_student_data() {
        $('.se-pre-con').fadeIn('slow');
        var res = [];
        var rpt_sem_subject_ids = [];
        var rpt_sem_subject_names = [];
        var rpt_sem_subject_code = [];
        var rpt_sem_subject_types = [];
        var rpt_applied_subjects = [];
        var rpt_subjects_marks = {};
        var rpt_subjects_code = [];
        var batch_id = $('#rpt_batch').val();
        var course_id = $('#rpt_course').val();
        var year = $('#rpt_year').val();
        var semester = $('#rpt_semester').val();
        var exam_id = $('#rpt_exam').val();
        var center_id = $('#rpt_centre').val();
        var rpt_style_cell = [];
        var rpt_select_list = '';
        var rpt_select_status = [];
        var rpt_disable_status = '';
        
        var rpt_select_grade_option = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'E', 'Pass', 'Fail'];
        

        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            //$('.se-pre-con').fadeIn('slow');
            $.post("<?php echo base_url('subject/load_rpt_semester_subjects_by_semester') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (data) {
        
                    for (var i = 0; i < data[(data.length - 1)]['lecturer_subject'].length; i++) {
                        rpt_sem_subject_ids.push(data[(data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        rpt_sem_subject_code.push(data[(data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+data[(data.length - 1)]['lecturer_subject'][i]['code']+"]");
                    }
                    $.post("<?php echo base_url('student/load_rpt_student_for_exam_marks_training') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'exam_id': exam_id,
                            'center_id': center_id
                        },
                        function (data) {
                            
                            $('#rpt_exam_marks_tbl').DataTable().clear();
                            $("#rpt_exam_marks_tbl").find('tbody').empty();
                            $('#load_rpt_thead').find('tr').remove();
                            
                            if (data.length > 0) {
                                
                                $("#bulk_save_btn_rpt").prop("disabled",false);

                                $('#rpt_exam_marks_tbl').DataTable().rows().remove();
                                $('#load_rpt_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                                $('#rpt_exam_marks_tbl tr:last').append(rpt_sem_subject_code
                                    .map(id => `<th style="width: 10%;">${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_rpt_thead'));
                                for (j = 0; j < data.length; j++) {
                                    $('#rpt_exam_marks_tbl').DataTable().row.add([
                                        (j + 1),
                                        data[j]['reg_no'],
                                        data[j]['reg_no'],
                                        data[j]['first_name']

                                    ]).draw(false);
                                                          
                                    for (x = 0; x < data[j]['applied_subjects'].length; x++) {
                                        rpt_applied_subjects.push(data[j]['applied_subjects'][x]['subject_id']);
                                        
                                        if (data[j]['applied_subjects'][x]['is_repeat_approved'] == 1)//is_approved
                                        {
                                            $('#repeat_status_id').val('1');
                                            
                                            rpt_select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['applied_subjects'][x]['subject_id']+'" name="rpt_training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['applied_subjects'][x]['subject_id']+ ']" class="form-control"'+rpt_disable_status+'><option value="">---Please Select---</option>';
                                            for (y = 0; y < rpt_select_grade_option.length; y++) {
                                                rpt_select_list += '<option value="'+rpt_select_grade_option[y]+'"'+rpt_select_status[rpt_select_grade_option[y]]+'>'+rpt_select_grade_option[y]+'</option>';
                                            }
                                            rpt_select_list += '</select>';
                                            rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = rpt_select_list;
                                            rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }
                                    }


                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {
                                        
                                        if(data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == '0'){ 
                                            rpt_select_list = '';
                                            rpt_disable_status = '';
                                            rpt_select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="rpt_training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+rpt_disable_status+'><option value="">---Please Select---</option>';
                                            for (y = 0; y < rpt_select_grade_option.length; y++) {
                                                if(data[j]['exam_mark'][z]['result'] == rpt_select_grade_option[y]){
                                                    rpt_select_status[rpt_select_grade_option[y]] = 'selected';
                                                }
                                                else{
                                                    rpt_select_status[rpt_select_grade_option[y]] = '';
                                                }
                                                rpt_select_list += '<option value="'+rpt_select_grade_option[y]+'"'+rpt_select_status[rpt_select_grade_option[y]]+'>'+rpt_select_grade_option[y]+'</option>';
                                            }
                                            rpt_select_list += '</select>';
                                            //rpt_select_list += '<br>Applied as Repeat';
                                            rpt_subjects_marks[data[j]['exam_mark'][z]['subject_id']] = rpt_select_list;   
                                        }
                                        else{
                                            if(data[j]['exam_mark'][z]['sem_exam_id'] == exam_id){
                                                rpt_select_list = '';
                                                rpt_disable_status = ' disabled';
                                                rpt_select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="rpt_training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+rpt_disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < rpt_select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == rpt_select_grade_option[y]){
                                                        rpt_select_status[rpt_select_grade_option[y]] = 'selected';
                                                    }
                                                    else{
                                                        rpt_select_status[rpt_select_grade_option[y]] = '';
                                                    }
                                                    rpt_select_list += '<option value="'+rpt_select_grade_option[y]+'"'+rpt_select_status[rpt_select_grade_option[y]]+'>'+rpt_select_grade_option[y]+'</option>';
                                                }
                                                rpt_select_list += '</select>';
                                                rpt_select_list += '<br>Training Marks Approved';
                                                rpt_subjects_marks[data[j]['exam_mark'][z]['subject_id']] = rpt_select_list;
                                            }
                                            else{
                                                rpt_select_list = '';
                                                rpt_disable_status = '';
                                                rpt_select_list = '<select id="trgrade_'+data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+'" name="rpt_training_exam_mark[' +data[j]['stu_id']+"_"+data[j]['exam_mark'][z]['subject_id']+ ']" class="form-control"'+rpt_disable_status+'><option value="">---Please Select---</option>';
                                                for (y = 0; y < rpt_select_grade_option.length; y++) {
                                                    if(data[j]['exam_mark'][z]['result'] == rpt_select_grade_option[y]){
                                                        rpt_select_status[rpt_select_grade_option[y]] = 'selected';
                                                    }
                                                    else{
                                                        rpt_select_status[rpt_select_grade_option[y]] = '';
                                                    }
                                                    rpt_select_list += '<option value="'+rpt_select_grade_option[y]+'"'+rpt_select_status[rpt_select_grade_option[y]]+'>'+rpt_select_grade_option[y]+'</option>';
                                                }
                                                rpt_select_list += '</select>';
                                                //rpt_select_list += '<br>Training Marks Approved';
                                                rpt_subjects_marks[data[j]['exam_mark'][z]['subject_id']] = rpt_select_list;
                                            }
                                        }
                                    }


                                        $('#rpt_exam_marks_tbl tr:last').append(rpt_sem_subject_ids
                                            .map(e => `<td style="`+rpt_style_cell[e]+`text-align:center; width: 10%;">${rpt_applied_subjects.includes(e) ? rpt_subjects_marks[e] : "--"}</td>`)
                                            .join(''))
                                            .appendTo($('#load_rpt_student'));

                                    rpt_applied_subjects = [];
                                    rpt_subjects_marks = {};
//
                                }

                            }
                            else{
                                $("#bulk_save_btn_rpt").prop("disabled",true);
                            
                                $('#load_rpt_student').find('tr').remove();
                                $('#load_rpt_thead').append("<tr><th>#</th><th>Reg No</th><th>Admission No</th><th>Student</th></tr>");
                                $('#rpt_exam_marks_tbl tr:last').append(rpt_sem_subject_code
                                    .map(id => `<th style="width: 10%;">${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_rpt_thead'));
                            
                                var numCols = $("#rpt_exam_marks_tbl").find('tr')[0].cells.length;

                                $('#load_rpt_student').append("<tr><td colspan='"+numCols+"' align='center' >No records to show.</td></tr>");
                            }
                        },
                        "json"
                    );
                },
                "json"
            );
           $('.se-pre-con').fadeOut('slow');
        }
    }
    


</script>

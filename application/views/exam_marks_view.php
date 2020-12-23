<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i><span id="exam_mark_header_lbl" name="exam_mark_header_lbl"></span> Exam Marks</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Exam</li>
            <li><i class="fa fa-book"></i><span id="exam_mark_path_lbl" name="exam_mark_path_lbl"></span> Exam Mark</li>
        </ol>
    </div>
</div>
<!-- Nav tabs -->
<form class="form-horizontal" role="form" method="post" id="exam_marks_form" name="exam_marks_form" autocomplete="off">
    <div class="panel">
        <header class="panel-heading">
            <span id="exam_mark_header2_lbl" name="exam_mark_header2_lbl"></span> Exam Marks
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

    var user_level = '<?php echo $user_level; ?>';
    //alert(user_level);
    $.validate({
        form: '#exam_marks_form'
    });

    $.validate({
        form: '#student_mark_form'
    });


    var readonly_text_ca = '';

    $(function () {

        if(user_level=='ca_mark'){
            $('#exam_mark_header_lbl').text("Continuous Assessment");
            $('#exam_mark_path_lbl').text("CA");
            $('#exam_mark_header2_lbl').text("CA");
        }
        else{
            $('#exam_mark_header_lbl').text("Semester");
            $('#exam_mark_path_lbl').text("SE");
            $('#exam_mark_header2_lbl').text("SE");
        }

        $('#repeat_status_id').val('0');

        //$("#subject_mark_save").prop("disabled",true);

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
                //console.log(data);
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


    function calculate_total(ca_mark,is_attend,absent_reson_approve,grading_id,id, flag, repeat_status, assignment_only) {
       // alert(is_attend);
       // alert(absent_reson_approve);
      //  alert(grading_id);
       // alert(id);
       //alert(flag);
        //alert("caMark;"+ca_mark);
        var c_grade_marks = 0;
        var repeat_total = 0;

        if (flag) {
            if(ca_mark<=100 && ca_mark != null && ca_mark != ''){
                $("#subject_mark_save").prop("disabled",false);

                var pers = $('#pers_'+id +'_2').val();

                var pre_ca = ((parseFloat((ca_mark*(pers/100)))).toFixed(2)).split('.');
                var ca_value = pre_ca[1];
                if(ca_value == '00'){
                   var ca_total = pre_ca[0];
                }
                else{
                   var ca_total = (parseFloat((ca_mark*(pers/100)))).toFixed(2);
                }

                //alert("ca_total = "+ca_total);

                $('#totalmark_' + id).val(ca_total);
                $('#grade_' + id).val('-');
                $('#result_grade_' + id).val('-');

                $('#total_note_label').text("Note: This is calculated for CA marks only.");
            }
            else{
                totalmarks=0;
                $('#totalmark_' + id).val("invalid");

                if(is_attend == 0 && assignment_only == 1){
                    $("#subject_mark_save").prop("disabled",false);
                }
                else{
                    $("#subject_mark_save").prop("disabled",true);
                }

            }

            //----FOR ASSIGNMENT ONLY SUBJECTS----
            if(assignment_only == 1){
                $.post("<?php echo base_url('grading_method/get_grades') ?>", {
                    'grading_id': grading_id

                },
                function (data) {

                    if(ca_mark<=100 && ca_mark != null && ca_mark != ''){
                        ca_total_rounded_marks = Math.ceil(ca_total);
                        $('#grade_' + id).val(overall_grade('NE',ca_mark,ca_total_rounded_marks,data,false));
                        $('#grade_point_' + id).val(overall_grade('NE',ca_mark,ca_total_rounded_marks,data,true));
                    }
                    else{
                        ca_total_rounded_marks = ca_mark;
                    }

                    $('#result_grade_' + id).val(result_grades(is_attend,absent_reson_approve,'NE',ca_mark,ca_total_rounded_marks,data));
                },
                    "json"
                );
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
                        var se_mark_for_total = 0;
                        var ca_mark_for_total = 0;
                        $('.marks_' + id).each(function (i, obj) {
                           // alert(i);
                           // alert(obj);
                           // var text_id=this.id;
                            temp = this.id.split('_');
                            //alert(this.id);
                            // var text_id=this.id;
                              inp_perc = $('#pers_' + temp[1] + '_' + temp[2]).val();

                      //  console.log(obj);//kasun
                      //  console.log(this.id);//kasun
                      //  console.log(temp);//kasun

                        if(typeof temp[2] !='undefined'){
                            if(temp[2]==1){
                                se_mark=$('#'+this.id).val();
                                if(se_mark === '' || se_mark === null){
                                    se_mark_for_total=0;
                                    //$('#'+this.id).val(0);
                                } else {
                                    se_mark_for_total = se_mark;
                                }
                                if(is_attend==0){
                                    $('#'+this.id).attr('readonly', true);
                                }
                            }

                            if(temp[2]==2){
                                ca_mark=$('#'+this.id).val();
                            }

                        }

                        });

                        if(ca_mark === '' || ca_mark === null){
                            ca_mark_for_total = 0;
                            $('#subject_mark_save').prop("disabled",true);
                        } else {
                            ca_mark_for_total = ca_mark;
                            $('#subject_mark_save').prop("disabled",false);
                        }

                        if(se_mark === '' || se_mark === null){
                            se_mark_for_total = 0;
                            if(is_attend == 0){
                                $('#subject_mark_save').prop("disabled",false);
                            } else {
                                $('#subject_mark_save').prop("disabled",true);
                            }
                        } else {
                            se_mark_for_total = se_mark;
                           $('#subject_mark_save').prop("disabled",false);
                        }



                        if(se_mark<=100 || se_mark==0 ) {
                            //if(se_mark != 0) {
                               totalmarks = ((parseFloat(se_mark_for_total) * (1 - inp_perc / 100)) + (parseFloat(ca_mark_for_total) * (inp_perc / 100))).toFixed(2);


                               // console.log('aa tot :'+totalmarks);
                             //   console.log('aa inp :'+inp_perc);
                              //  console.log('aa ca:'+ca_mark_for_total);
                              //  console.log('aa se :'+se_mark_for_total);

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


                               // alert(total_rounded_marks);

                               $('#grade_' + id).val(overall_grade(se_mark,ca_mark,total_rounded_marks,data,false));

                                $('#grade_point_' + id).val(overall_grade(se_mark,ca_mark,total_rounded_marks,data,true));

                               // $('#result_grade_' + id).val(overall_grade(se_mark,ca_mark,totalmarks,data));
                                $('#result_grade_' + id).val(result_grades(is_attend,absent_reson_approve,se_mark,ca_mark,total_rounded_marks,data));
                                //$("#subject_mark_save").prop("disabled",false);
                                //                            }
                                //                            else{
                                //                                totalmarks = (parseFloat((ca_mark*(inp_perc/100)))).toFixed(2);
                                //                            }
                        }
                        else{
                            totalmarks=0;
                            $('#grade_' + id).val('invalid');
                            $('#result_grade_' + id).val('invalid');//subject_mark_save
                            $("#subject_mark_save").prop("disabled",true);
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

    function save_marks() {

        var repeat_val = $('#repeat_status_id').val();

        var course_id = "";
        var year = "";
        var semester = "";
        var batch_id = "";
        var exam_id = "";
        var mark_type = user_level;

        var form_data = $('#student_mark_form').serialize() + "&course_id=" + course_id + "&year_no=" + year + "&semester_no=" + semester + "&exam_id=" + exam_id + "&batch_id=" + batch_id + "&repeat_val=" + repeat_val + "&mark_type=" + mark_type + "";

        //debugger;

        if(repeat_val == 1) {
            course_id = $('#rpt_course').val();
            year = $('#rpt_year').val();
            semester = $('#rpt_semester').val();
            batch_id = $('#rpt_batch').val();
            exam_id = $('#rpt_exam').val();
        }
        else{
            course_id = $('#course').val();
            year = $('#year').val();
            semester = $('#semester').val();
            batch_id = $('#batch').val();
            exam_id = $('#exam').val();
        }

        $.ajax(
            {
                url: "<?php echo base_url('exam/save_exam_marks') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#student_mark_form').serialize() + "&course_id=" + course_id + "&year_no=" + year + "&semester_no=" + semester + "&exam_id=" + exam_id + "&batch_id=" + batch_id + "&repeat_val=" + repeat_val + "&mark_type=" + mark_type + "",
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
                            $('#marks_modal').modal('hide');
                        }
                    }
                }
            });
    }

    function isArrayInArray(arr, item) {
        var item_as_string = JSON.stringify(item);

        var contains = arr.some(function (ele) {
            return JSON.stringify(ele) === item_as_string;
        });
        return contains;
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
        // alert(exam_id);
        if (batch_id == '' || course_id == '' || year == '' || semester == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select all batch, course, year and semester';
            result_notification(res);
            $('.se-pre-con').fadeOut('slow');
        } else {
            //$('.se-pre-con').fadeIn('slow');
            $.post("<?php echo base_url('subject/semester_subjects_by_semester') ?>", {
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year': year,
                    'semester': semester
                },
                function (data) {
                //$('.se-pre-con').fadeOut('slow');
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
                        sem_subject_code.push(data[(data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+data[(data.length - 1)]['lecturer_subject'][i]['code']+"]");
                        // sem_subject_names.push(header_data[i]['subject']);


                    }
                    $.post("<?php echo base_url('student/load_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'user_level': user_level,
                            'exam_id': exam_id,
                            'center_id': center_id
                        },
                        function (data) {

                            //console.log(data);

                            $('#exam_marks_tbl').DataTable().clear();
                            $("#exam_marks_tbl").find('tbody').empty();
                            $('#load_thead').find('tr').remove();
                            var FRLable='';
                            if (data.length > 0) {

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
                                        //alert(data[j]['applied_subjects'][x]['is_approved']);
                                        if (data[j]['applied_subjects'][x]['is_approved'] > 0 && data[j]['applied_subjects'][x]['is_approved'] <= 2)//is_approved
                                        {
                                            if(data[j]['applied_subjects'][x]['is_approved'] == 1) {
                                                subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Exam Subject not approved by Lecturer";
                                                style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                            } else {

                                                if(user_level=='ca_mark'){
                                                    subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Enter Marks";
                                                    style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                    //style_cell = "background: red;";
                                                }
                                                else{
                                                    subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Assignment Mark Not Entered";
                                                    style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                // style_cell = "background: red;";
                                                }
                                            }
                                        }
                                        else{//(data[j]['applied_subjects'][x]['is_approved'] > 2)
                                            if(data[j]['applied_subjects'][x]['is_approved'] == 0){
                                                subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Exam Request Not Approved";
                                                style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                            }
                                            else{
                                                if(user_level=='ca_mark'){
                                                    subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Enter Marks";
                                                    style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                //     style_cell = "background: red;";
                                                }
                                                else{
                                                    //subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Rejected";
                                                    subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "NE";
                                                    style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                }
                                            }
                                        }
                                    }


                                   // console.log(data[j]['exam_mark']);
                                    for (z = 0; z < data[j]['exam_mark'].length; z++) {

                                       //SE marks
                                        var pre_exammark = data[j]['exam_mark'][z]['total_marks'].split('.');
                                        var pre_exam_total = pre_exammark[1];

                                        if(pre_exam_total == '00'){
                                            var exam_total = pre_exammark[0];
                                        }
                                        else{
                                            var exam_total = data[j]['exam_mark'][z]['total_marks'];
                                        }

                                        //CA marks
                                        if(data[j]['exam_mark'][z]['exam_type_id'] == 2){
                                            //var exammark_ca = data[j]['exam_mark'][z]['mark'];

                                            var exammark_prec_ca = ((data[j]['exam_mark'][z]['mark']) * ((data[j]['exam_mark'][z]['persentage'])/100)).toFixed(2);;

                                            var pre_exammark_ca = exammark_prec_ca.split('.');

                                            var pre_exam_total_ca = pre_exammark_ca[1];

                                            if(pre_exam_total_ca == '00'){
                                                var exam_total_ca = pre_exammark_ca[0];
                                            }
                                            else{
                                                var exam_total_ca = exammark_prec_ca;
                                            }
                                        }

                                        if(user_level=='ca_mark'){
                                            if(data[j]['exam_mark'][z]['detail_is_hod_mark_aproved'] == '0' && data[j]['exam_mark'][z]['detail_is_director_mark_approved'] == '0'){
                                                if(data[j]['exam_mark'][z]['is_repeat_mark'] == '1'){
                                                        //                                                    if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                        //                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE<br/>Applied as Repeat<p hidden> 3</p>";
                                                        //                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                        //                                                    }
                                                        //                                                    else{
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total_ca +"<br/>Applied as Repeat<p hidden> 3</p>";
                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    //}
                                                }
                                                else{
                                                    //                                                    if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                    //                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
                                                    //                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    //                                                    }
                                                    //                                                    else{
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total_ca;
                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    //}

                                                    ////////// check if condition for re correction ///////////
                                                    if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                        style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                    }
                                                    else{
                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    }
                                                }
                                            }
                                            else{
                                                if(data[j]['exam_mark'][z]['is_repeat_approve'] == 1){
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total_ca +"<br/>Applied as Repeat<p hidden> 3</p>";
                                                    style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }
                                                else if(data[j]['exam_mark'][z]['is_repeat_approve'] == 3){
                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total_ca +"<br/>Repeat Exam Rejected<p hidden> 4</p>";
                                                    style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                }
                                                else{
                                                    //                                                    if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                    //                                                        if(data[j]['exam_mark'][z]['is_repeat_mark'] == '1'){
                                                    //                                                            subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE<br/>Applied as Repeat<p hidden> 3</p>";
                                                    //                                                            style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    //                                                        }
                                                    //                                                        else{
                                                    //                                                            subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
                                                    //                                                            style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    //                                                        }
                                                    //                                                    }
                                                    //                                                    else{
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total_ca +"<br/>CA Marks Approved<p hidden> 1</p>";
                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    //}
                                                }
                                            }
                                        }
                                        else{
                                          //  if(data[j]['exam_mark'][z]['detail_is_hod_mark_aproved'] == '1' && data[j]['exam_mark'][z]['detail_is_director_mark_approved'] == '1'){
                                          //      subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['overall_grade'];
                                          //  }
                                          //  else{
                                                if(data[j]['exam_mark'][z]['exam_type_id'] == '2')
                                                {
                                                    if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                        subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'NE';
                                                        style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                    }
                                                    else{
                                                        if(data[j]['exam_mark'][z]['detail_is_hod_mark_aproved'] == '0'){
                                                            subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "CA marks not approved by HOD";
                                                            style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                        }
                                                        else{
                                                            if(data[j]['exam_mark'][z]['detail_is_director_mark_approved'] == '0'){
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "CA marks not approved by Director";
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }

                                                            if((data[j]['exam_mark'][z]['marking_details'].length == 1) && (data[j]['exam_mark'][z]['marking_details'][0]['type_id'] == 2)){ //---ASSIGNMENT ONLY---
                                                                if(data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == '1'){
                                                                    subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['result']+"<br/>SE Marks Approved<p hidden> 2</p>";
                                                                    style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                else{
                                                    if(data[j]['exam_mark'][z]['is_ex_director_mark_approved'] == '0'){
                                                        if(data[j]['exam_mark'][z]['is_repeat_mark'] == '1'){
                                                            if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE<br/>Applied as Repeat<p hidden> 3</p>";
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                            else{
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['result']+"<br/>Applied as Repeat<p hidden> 3</p>";
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                        }
                                                        else{

                                                            if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = 'NE';
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                            else{
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['result'];
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }

                                                            ////////// check if condition for re correction ///////////
                                                            if(data[j]['exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                            }
                                                            else{
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        if(data[j]['exam_mark'][z]['sem_exam_id'] == exam_id){
                                                            if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE";
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                            else{
                                                               subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['result']+"<br/>SE Marks Approved<p hidden> 2</p>";
                                                               style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }

                                                        }
                                                        else{
                                                            if(data[j]['exam_mark'][z]['subj_approved'] > 2){
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = "NE<br/>Applied as Repeat<p hidden> 3</p>";
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                            else{
                                                                subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['result']+"<br/>Applied as Repeat<p hidden> 3</p>";
                                                                style_cell[data[j]['exam_mark'][z]['subject_id']]= "";
                                                            }
                                                        }


                                                    }
                                                }
                                           // }
                                        }
                                    }
                                     //fraud student display
                                   if(data[j]['fraud_status']==1){
                                    FRLable='background-color:red;';
                                   }

                                        $('#exam_marks_tbl tr:last').append(sem_subject_ids
                                            .map(e => `<td style="`+style_cell[e]+`text-align:center; width: 10%;`+FRLable+`">${applied_subjects.includes(e) ? '<a id="' + data[j]['stu_id'] + '_subject_mark_' + e + '" href="javascript:open_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\', 0);"><span>' + subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                            .join(''))
                                            .appendTo($('#load_student'));

                                    applied_subjects = [];
                                    subjects_marks = {};
                                    style_cell = [];
                                    FRLable='';
                                }
                            }
                            else {
                                //$('#student_absent_tbl').DataTable();

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

    function set_as_absent(text_id, grading_id, assignment_only) {

        var txtbox_id=$("#absent_chk").val();
        if ($("#absent_chk").attr("checked") || assignment_only == 1) {
            $("#subject_mark_save").prop("disabled",false);
            $('#'+txtbox_id).removeAttr('value');
            $('#totalmark_'+text_id).val(0);
            $('#grade_'+text_id).val('AB');
            $('#result_grade_'+text_id).val('');
            $('#marks_'+text_id+'_2_'+grading_id).attr("readonly", true);
            $('#marks_'+text_id+'_2_'+grading_id).val(0);
            $('#total_note_label').text('');
           // $('#marks_'+text_id+'_2_'+grading_id).val(null);
        } else {
            $("#subject_mark_save").prop("disabled",true);
            $('#'+txtbox_id).removeAttr('value');
            $('#totalmark_'+text_id).val(0);
            $('#grade_'+text_id).val('');
            $('#result_grade_'+text_id).val('');
            $('#marks_'+text_id+'_2_'+grading_id).attr("readonly", false);
           // $('#marks_'+text_id+'_2_'+grading_id).val(null);
        }
    }

    function open_model(batch_id, stu_id, subject_id, status) {

        if ($("#absent_chk").attr("checked")) {
            $("#subject_mark_save").prop("disabled",false);
        } else {
            $("#subject_mark_save").prop("disabled",true);
        }

        var course_id = "";
        var year = "";
        var semester = "";
        var exam_id = "";
        var repeat = 0;
        var assignment_only = 0;
        var assignment_only_absent = 0;


        if(status == 0){
            var mark = $("#" + stu_id + "_subject_mark_" + subject_id).text();
            var mark_split = mark.split(" ");
        }
        else{
            var mark = $("#" + stu_id + "_rpt_subject_mark_" + subject_id).text();
            var mark_split = mark.split(" ");
        }

        if ((mark == 'Rejected') || (mark == 'NE')) {
            funcres = {status: "denied", message: "Cannot enter marks for rejected subjects."};
            result_notification(funcres);
        }
        else if (mark=='Assignment Mark Not Entered')
        {
            funcres = {status: "denied", message: "Please enter assignment marks before enter exam marks."};
            result_notification(funcres);
        }else if (mark=='Subject not approved by Lecturer')
        {
            funcres = {status: "denied", message: "Pending Lecturer Approval. Please approve subject before enter marks."};
            result_notification(funcres);
        }else if (mark=='CA marks not approved by HOD')
        {
            funcres = {status: "denied", message: "Please approve CA marks before enter SE marks."};
            result_notification(funcres);
        }else if (mark=='CA marks not approved by Director')
        {
            funcres = {status: "denied", message: "Please approve CA marks before enter SE marks."};
            result_notification(funcres);
        }
        else if (mark_split[3] =='1')
        {
            funcres = {status: "denied", message: "CA Marks already approved."};
            result_notification(funcres);
        }
        else if(mark_split[3] =='2'){
            funcres = {status: "denied", message: "SE Marks already approved."};
            result_notification(funcres);
        }
        else if(mark_split[3] =='3'){
            funcres = {status: "denied", message: "Subject applied as repeat."};
            result_notification(funcres);
        }
        else if(mark_split[3] =='4'){
            funcres = {status: "denied", message: "Subject already rejected for repeat exam."};
            result_notification(funcres);
        }
        else {
            $('#hidden_div').empty();
            $('#note').empty();
            $('#mark_data_tbl').find('tr').remove();
            $('#marks_modal').modal({
                show: 'false'
            });
            $('#marks_modal').modal('show');

            if(status == 0){
                course_id = $('#course').val();
                year = $('#year').val();
                semester = $('#semester').val();
                exam_id = $('#exam').val();
                repeat = 0;
            }
            else{
                course_id = $('#rpt_course').val();
                year = $('#rpt_year').val();
                semester = $('#rpt_semester').val();
                exam_id = $('#rpt_exam').val();
                repeat = 1;
            }

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
                   // console.log(data);
                    //debugger;
                    
                    result_grade = '-';
                    switch (data['user_level']) {
                        case "1":
                            var write_mark = '';
                            var Assignment_mark = '';
                            break;
                        case "2":
                            var write_mark = "";
                            var Assignment_mark = "";
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

                    $(".modal_title").text("Exam Marks : Course: " + data['course_code'] + "- Batch : " + data['batch_code'] + "  Y" + year + "/ S" + semester);
                    jQuery("label[for='student_name']").html(data['first_name']);
                    jQuery("label[for='reg_no_data']").html(data['reg_no']);
                    jQuery("label[for='admmision_data']").html(data['reg_no']);

                    var repeat_status = 0;
                    $('#repeat_status_id').val('0');
                    for (var z = 0; z < data['subject_details']['repeat_details'].length; z++) {
                        if(data['subject_details']['repeat_details'][z]['is_repeat_approved'] == 1){
                            repeat_status = 1;
                            $('#repeat_status_id').val('1');
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


                    var grading_method_id = '';
                    var subject_mark = '';
                    for (var j = 0; j < data['subject_details']['marking_details'].length; j++) {

                        //debugger;

                        var readonly_text = '';
                        var absent_chk = '';
                        subject_mark = '';
                        grading_method_id = data['subject_details']['marking_details'][j]['grading_method_id'];

                        //----Assignment ONLY Subject----
                        if((user_level=='ca_mark') && (data['subject_details']['marking_details'].length == 1) && (data['subject_details']['marking_details'][j]['type_id'] == 2)){
                            assignment_only = 1;
                        }
                        else {
                            assignment_only = 0;
                        }

                        var change_function = '';
                        var mark_value = '';


                       

                        
                        if (data['subject_details']['marking_details'][j]['type_id'] == 1) {

                            if (data['exam_mark'].length > 0) {
                                var exam_mark_index=0;
                                exam_mark_index= data['exam_mark'].findIndex(x => x.exam_type_id ==="1");
                            }
                          //  console.log(exam_mark_index+"type 1");
                          // alert(exam_mark_index);

                            readonly_text = write_mark;
                            change_function = false;
                            if (data['exam_mark'].length != 0)
                                if (data['exam_mark'][j]['is_hod_mark_aproved'] == 1 && data['exam_mark'][j]['is_director_mark_approved'] == 1 && user_level == 'ca_mark' )//SE enable after two approval stage
                                    readonly_text = "readonly='readonly'";
                            if (user_level == 'ca_mark') {
                                readonly_text = "readonly='readonly'";
                            }

                            if (data['exam_mark'].length != 0){
                                if (data['exam_mark'][j]['mark'] != 0){
                                    if(repeat_status == 1){
                                        if(user_level=='se_mark'){
                                            calculate_total(data['exam_mark'][j]['mark'],data['subject_details']['repeat_details'][0]['is_attend'],data['subject_details']['repeat_details'][0]['is_absent_approve'],data['subject_details']['marking_details'][j]['grading_method_id'], data['subject_details']['subject_id'],change_function,repeat_status,assignment_only);
                                        }
                                        else{
                                            calculate_total(data['exam_mark'][j]['mark'],data['subject_details']['repeat_details'][0]['is_attend'],data['subject_details']['repeat_details'][0]['is_absent_approve'],data['subject_details']['marking_details'][j]['grading_method_id'], data['subject_details']['subject_id'],true,repeat_status,assignment_only);
                                        }
                                    }
                                    else{
                                        calculate_total(data['exam_mark'][j]['mark'],data['subject_details']['is_attend'],data['subject_details']['is_absent_approve'],data['subject_details']['marking_details'][j]['grading_method_id'], data['subject_details']['subject_id'],change_function,repeat_status,assignment_only);
                                    }
                                }
                            }
                        } else if (data['subject_details']['marking_details'][j]['type_id'] == 2) {

                            if (data['exam_mark'].length > 0) {
                                var exam_mark_index=0;
                                exam_mark_index= data['exam_mark'].findIndex(x => x.exam_type_id ==="2");
                            }
                           // console.log(exam_mark_index+"type 2");
                            //alert(exam_mark_index);
                          

                            readonly_text = Assignment_mark;
                            change_function = true;
                            if (data['exam_mark'].length > 0) {
                                if (data['exam_mark'][exam_mark_index]['detail_is_hod_mark_aproved'] == 1 && data['exam_mark'][exam_mark_index]['detail_is_director_mark_approved'] == 1) {
                                    if(data['exam_mark'][exam_mark_index]['result'] == "NE" || data['exam_mark'][exam_mark_index]['result'] == "N/E") {
                                        readonly_text = "";
                                    }
                                    else {
                                        readonly_text = "readonly='readonly'";
                                    }
                                }
                                else{
                                    $("#subject_mark_save").prop("disabled",false);
                                }
                            }
                            if(user_level=='se_mark') {
                                readonly_text = "readonly='readonly'";
                                if (data['subject_details']['is_attend'] == 0) {
                                    subject_mark = 0;
                                    readonly_text = "readonly='readonly'";
                                }
                            }
                            var textbox_id="marks_"+data['subject_details']['subject_id']+"_"+ data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'];
                            var subject_id=data['subject_details']['subject_id'];

                            //Set absent or not
                            var is_absent = "";
                            if (data['exam_mark'].length > 0) {
                                if (data['exam_mark'][exam_mark_index]['exam_type_id'] == 1 && data['exam_mark'][exam_mark_index]['overall_grade'] == 'AB') {
                                    is_absent = "checked";
                                } else {
                                    is_absent = "";
                                }
                            }

                            if (user_level == 'ca_mark'){
                                if (data['exam_mark'].length > 0){
                                    if (data['exam_mark'][exam_mark_index]['detail_is_hod_mark_aproved'] == 1 && data['exam_mark'][exam_mark_index]['detail_is_director_mark_approved'] == 1){
                                        if((repeat_status == 1) && (data['exam_mark'][exam_mark_index]['mark'] == null)){
                                            if((data['subject_details']['marking_details'].length == 1) && (data['subject_details']['marking_details'][j]['type_id'] == 2)){ //--ASSIGNMENT ONLY SUBJECT--
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' style='display:none' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")'" + is_absent +">";
                                                readonly_text = "";
                                            }
                                            else{
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">Mark as Absent";
                                                $("#subject_mark_save").prop("disabled",false);
                                            }
                                        }
                                        else{
                                            if(data['exam_mark'][exam_mark_index]['result'] == "NE" || data['exam_mark'][exam_mark_index]['result'] == "N/E"){
                                                if((data['subject_details']['marking_details'].length == 1) && (data['subject_details']['marking_details'][j]['type_id'] == 2)){ //--ASSIGNMENT ONLY SUBJECT--
                                                    absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' style='display:none' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">";
                                                }
                                                else{
                                                    absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">Mark as Absent";
                                                    readonly_text = "";
                                                    $("#subject_mark_save").prop("disabled",false);
                                                }
                                            }
                                            else if((repeat_status == 1) && (data['exam_mark'][exam_mark_index]['mark'] >= 0)){
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">Mark as Absent";
                                                readonly_text = "";
                                            }
                                            else{
                                                absent_chk='';
                                            }
                                        }
                                    }
                                    else{
                                        if(data['exam_mark'][exam_mark_index]['exam_type_id'] == 2 && data['exam_mark'][exam_mark_index]['mark'] == null){
                                            if((data['subject_details']['marking_details'].length == 1) && (data['subject_details']['marking_details'][j]['type_id'] == 2)){ //--ASSIGNMENT ONLY SUBJECT--
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' style='display:none' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">";
                                            }
                                            else{
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">Mark as Absent";
                                            }
                                            readonly_text = "readonly='readonly'";
                                        }
                                        else{
                                            if((data['subject_details']['marking_details'].length == 1) && (data['subject_details']['marking_details'][j]['type_id'] == 2)){ //--ASSIGNMENT ONLY SUBJECT--
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' style='display:none' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">";
                                            }
                                            else{
                                                absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">Mark as Absent";
                                            }
                                        }
                                    }
                                }
                                else{
                                    if((data['subject_details']['marking_details'].length == 1) && (data['subject_details']['marking_details'][j]['type_id'] == 2)){ //--ASSIGNMENT ONLY SUBJECT--
                                        absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' style='display:none' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")'" + is_absent +">";
                                    }
                                    else {
                                        absent_chk = "<input id='absent_chk' type='checkbox' value='"+textbox_id+"' onchange='set_as_absent("+subject_id+","+grading_method_id+","+assignment_only+")' " + is_absent +">Mark as Absent";
                                    }
                                }
                            }

                            

                            

                       




                        } else {
                            readonly_text = "readonly='readonly'";
                            change_function = '';
                        }



                       // console.log("Kasun : "+" id :"+exam_mark_index );
                         //debugger;
                         console.log("Kasun : "+" id :"+exam_mark_index +"/");
                       //  exam_mark_index=0;

                         if(exam_mark_index==-1)
                         continue;
                            if (data['exam_mark'][exam_mark_index]) {
                                if (data['exam_mark'][exam_mark_index]['mark'] === null || data['exam_mark'][exam_mark_index]['mark'] === '') { // when absent mark is null
                                     subject_mark = '';
                                } else {
                                    var pre_mark = data['exam_mark'][exam_mark_index]['mark'].split('.');
                                    var decimalvalue = pre_mark[1];

                                    if(decimalvalue == '00'){
                                     subject_mark = pre_mark[0];
                                    }
                                    else{
                                         subject_mark = data['exam_mark'][exam_mark_index]['mark'];
                                    }
                                }
                            } else {
                                var subject_mark = '';
                            }
                                    //debugger;
                                   //console.log("Kasun : "+" id :"+exam_mark_index +"/");
                                  

                            if (user_level == 'ca_mark') {
                                if(data['exam_mark'].length > 0) {
                                    if(data['exam_mark'][exam_mark_index]['exam_type_id'] == 1){
                                        if(repeat_status==1)
                                         mark_value = "<input type='hidden' name='subject_mark[]'  value='0' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " />";
                                        else
                                         mark_value = "<input type='hidden' name='subject_mark[]'  value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " />";
                                    }
                                    else {
                                        if(repeat_status == 1){
                                            if(assignment_only == 1 ){
                                                readonly_text = "";
                                            }
                                             mark_value = "<input type='text' name='subject_mark[]' value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['repeat_details'][0]['is_attend']+","+data['subject_details']['repeat_details'][0]['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " /><b>(Marks out of 100)</b>";
                                        }
                                        else{
                                             mark_value = "<input type='text' name='subject_mark[]'  value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status + ","+assignment_only+");'  " + readonly_text + " /><b>(Marks out of 100)</b>";
                                        }
                                    }
                                }
                                else{
                                    if(data['subject_details']['marking_details'][j]['type_id'] == 1){
                                         mark_value = "<input type='hidden' name='subject_mark[]'  value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " />";
                                    }
                                    else{
                                         mark_value = "<input type='text' name='subject_mark[]'  value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " /><b>(Marks out of 100)</b>";

                                    }
                                }
                            }
                            else{
                                if(repeat_status == 1){
                                     mark_value = "<input type='text' name='subject_mark[]' value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['repeat_details'][0]['is_attend']+","+data['subject_details']['repeat_details'][0]['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " /><b>(Marks out of 100)</b>";
                                    calculate_total(subject_mark,data['subject_details']['repeat_details'][0]['is_attend'],data['subject_details']['repeat_details'][0]['is_absent_approve'],data['subject_details']['marking_details'][j]['grading_method_id'], data['subject_details']['subject_id'] ,  change_function ,repeat_status, assignment_only );
                                }
                                else{
                                     mark_value = "<input type='text' name='subject_mark[]' value='"+subject_mark+"' id='marks_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "_" + data['subject_details']['marking_details'][j]['grading_method_id'] + "' class='ca_mark_txt form-control marks_" + data['subject_details']['subject_id'] + "' onkeyup='calculate_total(this.value,"+data['subject_details']['is_attend']+","+data['subject_details']['is_absent_approve']+","+data['subject_details']['marking_details'][j]['grading_method_id']+"," + data['subject_details']['subject_id'] + "," + change_function + ","+ repeat_status +","+assignment_only+");'  " + readonly_text + " /><b>(Marks out of 100)</b>";
                                    calculate_total(subject_mark,data['subject_details']['is_attend'],data['subject_details']['is_absent_approve'],data['subject_details']['marking_details'][j]['grading_method_id'], data['subject_details']['subject_id'] ,  change_function ,repeat_status, assignment_only );
                                }
                            }





                             //Set exam type and percentage
                        var exam_type;


                        //if (data['exam_mark'][j]['exam_type_id'] == 2) {
                            var percentage_index=0;
                        if (data['subject_details']['marking_details'][j]['type_id'] == 2) {
                            percentage_index=data['subject_details']['marking_details'].findIndex(x => x.type_id ==="2");
                            exam_type = "Assignment";
                        } else {
                            exam_type = "Written";
                            percentage_index=data['subject_details']['marking_details'].findIndex(x => x.type_id ==="1");
                        }
                        $("#mark_data_tbl").append("<tr ><td>" + (j + 1) + "</td><td>" + exam_type + "</td><td>" + data['subject_details']['marking_details'][percentage_index]['percentage'] + "%</td><td><div class='col-xs-6'><input type='hidden' name='type_id[]' value='" + data['subject_details']['marking_details'][j]['type_id'] + "'><input type='hidden' name='persentage[]' id='pers_" + data['subject_details']['subject_id'] + "_" + data['subject_details']['marking_details'][j]['type_id'] + "' value='" + data['subject_details']['marking_details'][percentage_index]['percentage'] + "'>"+mark_value+"</div>"+absent_chk+"</td></tr>");

                       // console.log(data['subject_details']['marking_details'][j]['type_id']+" and : "+user_level);

                    }

                    if (data['exam_mark'].length != 0) {

                        //debugger;

                        var pre_totalmark = data['exam_mark'][0]['total_marks'].split('.');
                        var totaldecimalvalue = pre_totalmark[1];

                        if(totaldecimalvalue == '00') {
                           var total_marks = pre_totalmark[0];
                        }
                        else {
                            var total_marks = data['exam_mark'][0]['total_marks'];
                        }

                        if (user_level == 'ca_mark'){
                            var total_marks=0;
                            
                             data['exam_mark'].forEach(element => total_marks=element['total_marks']);

                           /* var totmark_prec_ca = ((data['exam_mark'][data['exam_mark'].length-1]['mark']) * ((data['exam_mark'][data['exam_mark'].length-1]['persentage'])/100)).toFixed(2);
                            var pre_totmark_ca = totmark_prec_ca.split('.');
                            var pre_mark_total_ca = pre_totmark_ca[1];
                            console.log(totmark_prec_ca);
                            console.log(pre_totmark_ca);
                            console.log(pre_mark_total_ca);

                            if(pre_mark_total_ca == '00'){
                                var total_marks = pre_totmark_ca[0];
                            }
                            else{
                                var total_marks = totmark_prec_ca;
                            }*/
                        }

                        var overall_grade = data['exam_mark'][0]['overall_grade'];
                        var result_grade = data['exam_mark'][0]['result'];
                        if(repeat_status == 1){
                            var subject_point = data['subject_details']['repeat_details'][0]['credits'];
                        }
                        else{
                            var subject_point = data['subject_details']['credits'];
                        }
                        var grade_point = data['exam_mark'][0]['grade_point'];
                       
                    } else {
                      
                        var total_marks = '';
                        var overall_grade = '';
                        var result_grade = '';

                        if((user_level=='ca_mark') && (assignment_only == 1)){
                            if(repeat_status == 1){
                                var subject_point = data['subject_details']['repeat_details'][0]['credits'];
                            }
                            else{
                                var subject_point = data['subject_details']['credits'];
                            }
                        }
                        else{
                            var subject_point = '';
                        }
                        var grade_point = '';
                    }

                    if(repeat_status == 1){
                        if (user_level=='se_mark' && data['subject_details']['repeat_details'][0]['is_attend'] == 0) {
                            total_marks = 0;
                            overall_grade = 'AB';
                            result_grade = 'AB';

                            $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");
                            calculate_total(0,data['subject_details']['repeat_details'][0]['is_attend'],data['subject_details']['repeat_details'][0]['is_absent_approve'],grading_method_id, data['subject_details']['subject_id'] , false, repeat_status, assignment_only);
                        }

                        if((user_level=='ca_mark') && (assignment_only == 1)){
                                if (data['subject_details']['repeat_details'][0]['is_attend'] == 0) {
                                    assignment_only_absent = 1;
                                    total_marks = 0;
                                    overall_grade = 'AB';
                                    $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");
                                }
                                calculate_total(subject_mark,data['subject_details']['repeat_details'][0]['is_attend'],data['subject_details']['repeat_details'][0]['is_absent_approve'],data['subject_details']['marking_details'][0]['grading_method_id'], data['subject_details']['subject_id'],true,repeat_status,assignment_only);
                        }else{
                             overall_grade="-";
                        result_grade="-";
                        }
                       
                    }
                    else{
                        if (user_level=='se_mark'&& data['subject_details']['is_attend'] == 0) {
                            total_marks = 0;
                            overall_grade = 'AB';
                            result_grade = 'AB';

                            $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");
                            calculate_total(0,data['subject_details']['is_attend'],data['subject_details']['is_absent_approve'],grading_method_id, data['subject_details']['subject_id'] , false, repeat_status, assignment_only);
                        }

                        if((user_level=='ca_mark') && (assignment_only == 1)){
                                if (data['subject_details']['is_attend'] == 0) {
                                    assignment_only_absent = 1;
                                    total_marks = 0;
                                    overall_grade = 'AB';
                                    $('#note').append("<div style='background-color:#ffdddd;border-left:6px solid #f44336;margin-bottom: 15px;padding: 4px 12px;'><p><strong>Student is Absent for this subject</strong> </p></div>");
                                }

                                calculate_total(subject_mark,data['subject_details']['is_attend'],data['subject_details']['is_absent_approve'],data['subject_details']['marking_details'][0]['grading_method_id'], data['subject_details']['subject_id'],true,repeat_status,assignment_only);
                        }
                    }
                   

                   if (user_level == 'ca_mark') {//kasun
                       var se_result_div = "<div class='col-xs-4'  style='display: block;'> Overall Grade :<input type='text' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='grade_point' value='" + grade_point + "' id='grade_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='subject_point'  value='" + subject_point + "' id='subject_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> </div><div class='col-xs-4' style='display:block;'> Result Grade :<input type='text' name='result_grade' value='" + result_grade + "' id='result_grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div>";
                   }
                   else{
                       var se_result_div = "<div class='col-xs-4'><input type='hidden' name='overall_grade' value='" + overall_grade + "' id='grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='grade_point' value='" + grade_point + "' id='grade_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> <input type='hidden' name='subject_point'  value='" + subject_point + "' id='subject_point_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /> </div><div class='col-xs-4'> Result Grade :<input type='text' name='result_grade' value='" + result_grade + "' id='result_grade_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /></div>";
                   }
                    $("#mark_data_tbl").append("<tr><th colspan='2'><div class='col-xs-6'> Total Mark : <input type='text' name='total_mark' value='" + total_marks + "' id='totalmark_" + data['subject_details']['subject_id'] + "' class='form-control' readonly /><label id='total_note_label' style='color:red'></label></div> </th><th colspan='2'>"+se_result_div+"</th></tr>");

                    //----FOR ASSIGNMENT ONLY SUBJECTS-----
                    if(assignment_only_absent == 1) {
                        set_as_absent(data['subject_details']['subject_id'], data['subject_details']['marking_details'][0]['grading_method_id'], assignment_only);
                    }
                },
                "json"
            );
        }
    }


   //------------------------------------------------ REPEAT EXAM MARK --------------------------------------------------------//
    function load_rpt_student_data() {
        console.log('repeat data load se')
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
        // alert(exam_id);

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
                //$('.se-pre-con').fadeOut('slow');
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
                        rpt_sem_subject_ids.push(data[(data.length - 1)]['lecturer_subject'][i]['subject_id']);
                        rpt_sem_subject_code.push(data[(data.length - 1)]['lecturer_subject'][i]['subject']+"<br/>["+data[(data.length - 1)]['lecturer_subject'][i]['code']+"]");
                        // sem_subject_names.push(header_data[i]['subject']);


                    }
                    $.post("<?php echo base_url('student/load_rpt_student_for_exam_marks') ?>", {
                            'batch_id': batch_id,
                            'course_id': course_id,
                            'year': year,
                            'semester': semester,
                            'user_level': user_level,
                            'exam_id': exam_id,
                            'center_id': center_id
                        },
                        function (data) {

                            $('#rpt_exam_marks_tbl').DataTable().clear();
                            $("#rpt_exam_marks_tbl").find('tbody').empty();
                            $('#load_rpt_thead').find('tr').remove();
                            if (data.length > 0) {

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
                                        //alert(data[j]['applied_subjects'][x]['is_approved']);
                                        if (data[j]['applied_subjects'][x]['is_approved'] > 0 && data[j]['applied_subjects'][x]['is_approved'] <= 2)//is_approved
                                        {
                                            if(data[j]['applied_subjects'][x]['is_approved'] == 1) {
                                                rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Exam Subject not approved by Lecturer";
                                                rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                            } else {

                                                if(user_level=='ca_mark'){
                                                    if(data[j]['applied_subjects'][x]['is_repeat'] == 3){
                                                        rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Repeat Exam Rejected";
                                                        rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                    }
                                                    else{
                                                        rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Enter Marks";
                                                        rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                    }
                                                }
                                                else{
                                                    if(data[j]['applied_subjects'][x]['is_repeat'] == 3){
                                                        rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Repeat Exam Rejected";
                                                        rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                    }
                                                    else{
                                                        rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "Assignment Mark Not Entered";
                                                        rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                                    }
                                                }
                                            }
                                        }
                                        else{//(data[j]['applied_subjects'][x]['is_approved'] > 2)
                                            rpt_subjects_marks[data[j]['applied_subjects'][x]['subject_id']] = "NE";
                                            rpt_style_cell[data[j]['applied_subjects'][x]['subject_id']]= "";
                                        }

                                    }


                                    for (z = 0; z < data[j]['rpt_exam_mark'].length; z++) {
                                          //  continue;
                                       //SE mark
                                        var pre_exammark = data[j]['rpt_exam_mark'][z]['total_marks'].split('.');
                                        var pre_exam_total = pre_exammark[1];

                                        if(pre_exam_total == '00'){
                                            var exam_total = pre_exammark[0];
                                        }
                                        else{
                                            var exam_total = data[j]['rpt_exam_mark'][z]['total_marks'];
                                        }

                                        //CA marks
                                        if(data[j]['rpt_exam_mark'][z]['exam_type_id'] == 2){
                                            //var exammark_ca = data[j]['exam_mark'][z]['mark'];

                                            var exammark_prec_ca = ((data[j]['rpt_exam_mark'][z]['mark']) * ((data[j]['rpt_exam_mark'][z]['persentage'])/100)).toFixed(2);;

                                            var pre_exammark_ca = exammark_prec_ca.split('.');

                                            var pre_exam_total_ca = pre_exammark_ca[1];

                                            if(pre_exam_total_ca == '00'){
                                                var exam_total_ca = pre_exammark_ca[0];
                                            }
                                            else{
                                                var exam_total_ca = exammark_prec_ca;
                                            }
                                        }
                                       //console.log(data[j]['rpt_exam_mark'][z]['mark']);
                                     //  console.log(data[j]['rpt_exam_mark'][z]['persentage']);

                                        if(user_level=='ca_mark'){
                                           // continue;
                                            if(data[j]['rpt_exam_mark'][z]['detail_is_hod_mark_aproved'] == '0' && data[j]['rpt_exam_mark'][z]['detail_is_director_mark_approved'] == '0'){
                                                if(data[j]['rpt_exam_mark'][z]['repeat_apply_for'] == 1){
                                                    rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total_ca;
                                                    rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";

                                                    ////////// check if condition for re correction ///////////
                                                    if(data[j]['rpt_exam_mark'][z]['is_recorrection_approved'] == '1'){
                                                        rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                    }
                                                    else{
                                                        rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                    }
                                                }
                                            }
                                            else{
                                                if(data[j]['rpt_exam_mark'][z]['mark'] == 0 || data[j]['rpt_exam_mark'][z]['mark'] == null){
                                                    if(data[j]['rpt_exam_mark'][z]['is_repeat'] == 3){
                                                        rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = "NE";
                                                        rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                    }
                                                    else{
                                                        if(data[j]['rpt_exam_mark'][z]['repeat_apply_for'] == 1){
                                                            rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total_ca;
                                                            rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                        }
                                                    }
                                                }
                                                else{
                                                    if(data[j]['rpt_exam_mark'][z]['repeat_apply_for'] == 1){
                                                        rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total_ca+ "<br/>CA Marks Approved<p hidden> 1</p>";
                                                        rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                    }else{
                                                        rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total_ca + "<br/>CA Marks Approved<p hidden> 1</p>";
                                                        rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                    }
                                                }
                                            }
                                        }
                                        else{
                                          //  if(data[j]['exam_mark'][z]['detail_is_hod_mark_aproved'] == '1' && data[j]['exam_mark'][z]['detail_is_director_mark_approved'] == '1'){
                                          //      subjects_marks[data[j]['exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['exam_mark'][z]['overall_grade'];
                                          //  }
                                          //  else{
                                                if(data[j]['rpt_exam_mark'][z]['exam_type_id'] == '2')
                                                {
                                                    if(data[j]['rpt_exam_mark'][z]['is_repeat_approved'] > 2){
                                                        rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = 'NE';
                                                        rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                    }
                                                    else{
                                                        if(data[j]['rpt_exam_mark'][z]['detail_is_hod_mark_aproved'] == '0'){
                                                            rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = "CA marks not approved by HOD";
                                                            rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                        }
                                                        else{
                                                            if(data[j]['rpt_exam_mark'][z]['detail_is_director_mark_approved'] == '0'){
                                                                rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = "CA marks not approved by Director";
                                                                rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                            }


                                                            if((data[j]['rpt_exam_mark'][z]['marking_details'].length == 1) && (data[j]['rpt_exam_mark'][z]['marking_details'][0]['type_id'] == 2)){ //---ASSIGNMENT ONLY---
                                                                if(data[j]['rpt_exam_mark'][z]['is_ex_director_mark_approved'] == '1'){
                                                                    rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['rpt_exam_mark'][z]['result']+"<br/>SE Marks Approved<p hidden> 2</p>";
                                                                    rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                else{
                                                    if(data[j]['rpt_exam_mark'][z]['is_ex_director_mark_approved'] == '0'){
                                                        rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['rpt_exam_mark'][z]['result'];

                                                        ////////// check if condition for re correction ///////////
                                                        if(data[j]['rpt_exam_mark'][z]['is_recorrection_approved'] == '1' && (exam_id == data[j]['rpt_exam_mark'][z]['sem_exam_id'])){
                                                            rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']] = 'background: #c0e6f6;';
                                                        }
                                                        else{
                                                            rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                        }
                                                    }
                                                    else{
                                                        if(data[j]['rpt_exam_mark'][z]['sem_exam_id'] == exam_id){
                                                            if(data[j]['rpt_exam_mark'][z]['is_repeat'] == 3){
                                                                rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = "NE";
                                                                rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                            }else{
                                                                rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['rpt_exam_mark'][z]['result']+"<br/>SE Marks Approved<p hidden> 2</p>";
                                                                rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                            }
                                                        }
                                                        else{
                                                            if(data[j]['rpt_exam_mark'][z]['is_repeat'] == 3){
                                                                rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = "NE";
                                                                rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                            }
                                                            else{
                                                                rpt_subjects_marks[data[j]['rpt_exam_mark'][z]['subject_id']] = exam_total + "/" + data[j]['rpt_exam_mark'][z]['result'];
                                                                rpt_style_cell[data[j]['rpt_exam_mark'][z]['subject_id']]= "";
                                                            }
                                                        }
                                                    }
                                                }
                                           // }
                                        }
                                    }


                                        $('#rpt_exam_marks_tbl tr:last').append(rpt_sem_subject_ids
                                            .map(e => `<td style="`+rpt_style_cell[e]+`text-align:center; width: 10%;">${rpt_applied_subjects.includes(e) ? '<a id="' + data[j]['stu_id'] + '_rpt_subject_mark_' + e + '" href="javascript:open_model(' + batch_id + ',' + data[j]['stu_id'] + ',\'' + e + '\', 1);"><span>' + rpt_subjects_marks[e] + '</span></a>' : "--"}</td>`)
                                            .join(''))
                                            .appendTo($('#load_rpt_student'));

                                    rpt_applied_subjects = [];
                                    rpt_subjects_marks = {};
                                    rpt_style_cell = [];

                                }

                            }
                            else{
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

function isset_element(element){
    if(typeof element === 'undefined') {
   return false;
}
else {
   return true;
}
}

</script>

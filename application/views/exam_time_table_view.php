<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<style type="text/css">
    bordered.dataTable td:last-child {
        border-right-width: 1;
    }

    bordered.dataTable tbody td {
        border-bottom-width: 1;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Exam Time Table</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>TimeTable</li>
            <li><i class="fa fa-bank"></i>Exam TimeTable</li>
        </ol>
    </div>
</div>


<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class="active"><a id="grp_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab"
                                              data-toggle="tab">Look Up</a></li>
    <li role="presentation"><a id="create_tab" href="#addexam_tab" aria-controls="addexam_tab" role="tab"
                               data-toggle="tab">Add Exam Time Table</a></li>
</ul>


<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <header class="panel-heading">
                Exam Time Table Look Up
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label class="control-label" style="text-align: left; padding-top: 8px; padding-bottom: 10px">Approval Status:</label>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" name="app_status" class="" id="app_status" value="1" checked style="margin: 9px 0 0;" onclick="">  Approved
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="app_status" class="" id="app_status" value="0" style="margin: 9px 0 0;" onclick="">  Rejected and Pending Approval
                        </div>
                    </div>
                  
                  
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="approved_ttbl_div" style="display: bolck">
                            <table id="ttmaintbl" class="table table-bordered" style="width:100%" cellspacing="0">
                                <thead id="ttmaintbl_head">
                                <tr>
                                    <th style="text-align: center">Study Season</th>
                                    <th style="text-align: center">Time Table</th>
                                    <th style="width:75px;text-align: center">Course</th>
                                    <th style="width:75px;text-align: center">Year</th>
                                    <th style="width:75px;text-align: center">Semester</th>
                                    <th style="width:75px;text-align: center">Exam</th>
                                    <th style="width:300px;text-align: center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="ttmaintbl_body">
                                </tbody>
                            </table>
                        </div>
                        <div id="pending_ttbl_div" style="display: none">
                            <table id="ttpendingtbl" class="table table-bordered" style="width:100%" cellspacing="0">
                                <thead id="ttpendingtbl_head">
                                <tr>
                                    <th style="text-align: center">Study Season</th>
                                    <th style="text-align: center">Time Table</th>
                                    <th style="width:75px;text-align: center">Course</th>
                                    <th style="width:75px;text-align: center">Year</th>
                                    <th style="width:75px;text-align: center">Semester</th>
                                    <th style="width:75px;text-align: center">Exam</th>
                                    <th style="width:300px;text-align: center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="ttpendingtbl_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="addexam_tab">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-heading">
                        Exam Timetable
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" id="tt_form" autocomplete="off"
                              novalidate>
                            <div class="row">
                                <!--                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="tt_faculty" class="col-md-3 control-label">Faculty</label>
                                <div class="col-md-9">
                                    <?php
                                global $facultydrop;
                                global $selectedfac;
                                $facextraattrs = 'id="tt_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_courses_list(this.value,null)" style="width:100%"';
                                echo form_dropdown('tt_faculty', $facultydrop, $selectedfac, $facextraattrs);
                                ?>
                                </div>
                            </div>
                        </div>-->
                                <div class="col-md-3" style="">
                                    <div class="form-group">
                                        <label for="tt_course" class="col-md-3 control-label">Course</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_course" name="tt_course"
                                                    onchange="load_years(this.value,null)" style="width:100%">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="">
                                    <div class="form-group">
                                        <label for="tt_year" class="col-md-3 control-label">Year</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_year" name="tt_year"
                                                    onchange="load_semester(this.value,null,null)" style="width:100%">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="">
                                    <div class="form-group">
                                        <label for="tt_semester" class="col-md-3 control-label">Semester</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_semester" name="tt_semester"
                                                    style="width:100%"
                                                    onchange="load_subjects(null,null,null);load_exams(null,null,null,null,null);">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3" style="">
                                    <input type="hidden" id="tt_id" name="tt_id">
                                    <input type="hidden" id="tt_code" name="tt_code">
                                    <input type="hidden" id="tt_action" name="tt_action">
                                    <input type="hidden" id="tt_clonett" name="tt_clonett">
                                    <div class="form-group">
                                        <label for="tt_season" class="col-md-3 control-label">S.Season</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_season" name="tt_season"
                                                    onchange="load_exams(null,null,null,null,null);" style="width:100%">
                                                <option value=""></option>
                                                <?php
                                                foreach ($ay_info as $ay) {
                                                    if ($ay['ac_iscurryear'] == 1) {
                                                        $ayselected = 'selected';
                                                    } else {
                                                        $ayselected = '';
                                                    }
                                                    echo '<option value="' . $ay['es_ac_year_id'] . '" ' . $ayselected . '>' . $ay['ac_startdate'] . ' - ' . $ay['ac_enddate'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="">
                                    <div class="form-group">
                                        <label for="tt_exam" class="col-md-3 control-label">Exam</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_exam" name="tt_exam" style="width:100%">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="">
                                    <div class="form-group">
                                        <label for="tt_description" class="col-md-3 control-label">Description</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="tt_description"
                                                   name="tt_description" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="">
                                    <div class="form-group">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="submit" value="Create" id="savebtn" name="savebtn"
                                               class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-9" style=""></div>
                                <div class="col-md-3" style="">
                                    <div class="form-group hidden">
                                        <label for="tt_clone" class="col-md-3 control-label">Clone</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_clone" name="tt_clone"
                                                    onchange="load_update_view(this.value,'clone')" style="width:100%">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row" id="tt_detailvw">
                            <div class="col-md-3">
                                <form class="form-horizontal" role="form" method="post" id="tt_timeform"
                                      autocomplete="off" novalidate>
                                    <input type="hidden" id="tt_schedid" name="tt_schedid">
                                    <div class="form-group">
                                        <label for="tt_date" class="col-md-3 control-label">Date</label>
                                        <div class="col-md-9">
                                            <div id="" class="input-group date">
                                                <input class="form-control datepicker" type="text" name="tt_date"
                                                       id="tt_date" data-format="YYYY-MM-DD">
                                                <span class="input-group-addon"><span
                                                            class="glyphicon-calendar "></span>
                                        </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tt_subject" class="col-md-3 control-label">Subject</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_subject" name="tt_subject"
                                                    style="width:100%" onchange="load_examtypes(null,null)">
                                                <option value=""></option>
                                            </select>
                                            <div class="col-md-9 checkbox" id="subject_versions_checkbox" >

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="tt_extype" class="col-md-3 control-label">Exam Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="tt_extype" name="tt_extype"
                                                    style="width:100%" onchange="check_duplicate()">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tt_starttime" class="col-md-3 control-label">St. Time</label>
                                        <div class='col-md-7 input-group date' id='ttstarttime'>
                                            <input type='text' class="form-control" id="tt_starttime"
                                                   name="tt_starttime"/>
                                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="tt_endtime" class="col-md-3 control-label">End Time</label>
                                        <div class='col-md-7 input-group date' id='ttendtime'>
                                            <input type='text' class="form-control" id="tt_endtime" name="tt_endtime"/>
                                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group container">
                                        <input type="submit" value="Add" id="addtimebtn" name="addtimebtn"
                                               class="btn btn-primary">
                                        <input type="reset" value="Reset" id="resetbtn" name="resetbtn"
                                               class="btn btn-primary" onClick="reset_btn()">
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-9">
                                <table id="tt_tblvw" class="cell-border" style="width:100%" cellspacing="0">
                                    <thead id="tt_tblvw_head">
                                    <tr>
                                       <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tt_tblvw_body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</div>

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
<!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>

<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<script src="//oss.maxcdn.com/momentjs/2.8.2/moment.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css') ?>">
<script type="text/javascript">

var editFlag = 0;

    $(document).ready(function () {
        $('#tt_detailvw').hide();
        load_courses_list(null);
        load_exam_timetables();   
        
        $('#ttmaintbl').DataTable({
            'searchable':true,
            'ordering':false
            //'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">'
        });

        $('#ttpendingtbl').DataTable({
            'searching':true,
            'ordering':false
            //'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">'
        });

        $('#grp_tab').click(function () {
            $('#ttmaintbl').DataTable().clear();
            $('#ttpendingtbl').DataTable().clear();
            load_exam_timetables();

        });
        
        
        //changing the approval status radio btn
        $('input[type=radio][name=app_status]').change(function() {
            if (this.value == 1) {
                $('#pending_ttbl_div').hide();
                $('#approved_ttbl_div').show();
            }
            else if (this.value == 0) {
                $('#approved_ttbl_div').hide();
                $('#pending_ttbl_div').show();
            }
        });
        

    });


    //    function edit_timetable(ttbl_id) {
    //            $('#all_tabs a[href="#addexam_tab"]').tab('show');
    //            $.post("<?php echo base_url('exam/exam_timetable') ?>", {'ttbl_id': ttbl_id},
    //            function (data)
    //            {
    //                if(data == 'denied')
    //                {
    //                    funcres = {status:"denied", message:"You have no right to proceed the action"};
    //                    result_notification(funcres);
    //                }
    //                else
    //                {
    //                    $('#tt_course').val(data['ttbl_course']);
    //                    $('#tt_year').val(data['ttbl_year']);
    //                    $('#tt_semester').val(data['ttbl_semester']);
    //                    $('#tt_season').val(data['ttbl_season']);
    //                    $('#tt_exam').val(data['ttbl_exam']);
    //                    $('#tt_description').val(data['ttbl_description']);
    //
    //                    //get_course_year(data['course_id'], data['no_of_year']);
    ////                    get_course_year(data['course_id'], data['year_no']);
    ////                    load_semesters(data['year_no'], data['semester_no']);
    ////                    $('#subject_group').val(data['group_id']);
    ////                    $('#s_season').val(data['study_season_id']);
    ////                    $('#stdy_season').val(data['study_season_id']);
    ////                    load_batches(data['study_season_id'],data['course_id'],data['batch_id'])
    //                }
    //            },
    //            "json"
    //            );
    ////            load_group_details_edit(se_subject_id, subject_group_id);
    ////            $('#se_subject_id').val(se_subject_id);
    ////            $('#load_Dcode').prop("disabled", true);
    ////            $('#no_year').prop("disabled", true);
    ////            $('#no_semester').prop("disabled", true);
    ////            $('#s_season').prop("disabled", true);
    ////            $('#batch_code').prop("disabled", true);
    //        }


    function check_duplicate() {
        $('.se-pre-con').fadeIn('slow');
        exam_id = $('#tt_exam').val();
        subject_id = $('#tt_subject').val();
        exam_type = $('#tt_extype').val();
        $.post("<?php echo base_url('exam/timetable_check_duplicate')?>", {'exam_id': exam_id,'subject_id': subject_id,'exam_type': exam_type},
            function (data) {
               // console.log(data);
                //alert(data['is_check'])

                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                    $('.se-pre-con').fadeOut('slow');
                }else {
                    if(data['is_check']==1){
                        funcres = {status: "Fail", message: "Alredy added this Subject"};
                        result_notification(funcres);

                        $('#addtimebtn').prop("disabled", true);
                        $('.se-pre-con').fadeOut('slow');
                    }else{
                        $('#addtimebtn').prop("disabled", false);
                        $('.se-pre-con').fadeOut('slow');
                    }
                }
            },
            "json"
        );

    }


    function reset_btn() {
//        window.location.reload();
        $('[href="#addexam_tab"]').tab('show');
        $('#tt_extype').val("");
        editFlag = 0;
    }

    function load_exam_timetables() {
         // $('#ttmaintbl').DataTable().clear();
        $('.se-pre-con').fadeIn('slow');
        $.post("<?php echo base_url('exam/load_exam_timetables')?>",
            function (data) {
                console.log(data);
                for (i = 0; i < data.length; i++) {
                    descript = data[i]['ttbl_code'] + ' - ' + data[i]['ttbl_description'] + ' [ ' + data[i]['course_code'] + ' - ' + data[i]['course_code'] + ' / Y : ' + data[i]['ttbl_year'] + ' / S : ' + data[i]['ttbl_semester'] + ' ]';
                    editbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_update_view(" + data[i]['ttbl_id'] + ",\"save\")'>Edit</a>";
                    clonbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_update_view(" + data[i]['ttbl_id'] + ",\"clone\")'>Clone</a>";
                    viewbtn = " <a class='btn btn-primary btn-xs' onclick='event.preventDefault();load_timetable_view(" + data[i]['ttbl_id'] + ",\"" + descript + "\"," + data[i]['ttbl_course'] + "," + data[i]['ttbl_year'] + "," + data[i]['ttbl_semester'] + ")'>View</a>";
                    deltbtn = " <a class='btn btn-danger btn-xs' onclick='event.preventDefault();delete_timetable(" + data[i]['ttbl_id'] + ",\"" + descript + "\")'>Delete</a>";
                    verfbtn = " <a class='btn btn-success btn-xs' onclick='event.preventDefault();verify_timetable(" + data[i]['ttbl_id'] + ",\"" + descript + "\")'>Verify</a>";
                    confbtn = " <a class='btn btn-success btn-xs' onclick='event.preventDefault();confirm_timetable(" + data[i]['ttbl_id'] + ",\"" + descript + "\")'>Confirm</a>";
                    // prntbtn = " <a class='btn btn-warning btn-xs' onclick='event.preventDefault();print_timetable("+data[i]['ttbl_id']+",\""+descript+"\")'>Print</a>";

                    if (data[i]['ttbl_isverified'] == 0) {
                        confbtn = '';
                    }
                    else {
                        verfbtn = '';
                    }

                    if (data[i]['ttbl_isconfirmed'] == 0) {
                    }
                    else {
                        confbtn = '';
                        editbtn = '';
                        deltbtn = '';
                    }

                    if(data[i]['approved'] == 1){
                        $('#ttmaintbl').DataTable().row.add([
                            data[i]['ac_startdate'] + ' - ' + data[i]['ac_enddate'],
                            '[ ' + data[i]['ttbl_code'] + ' ]' + data[i]['ttbl_description'],
                            '[ ' + data[i]['course_code'] + ' ]' + data[i]['course_code'],
                            data[i]['ttbl_year'],
                            data[i]['ttbl_semester'],
                            '[ ' + data[i]['exam_code'] + ' ]' + data[i]['exam_name'],
//                            viewbtn + editbtn + deltbtn,
                              viewbtn + "" + deltbtn,
                        ]).draw(false);
                    } else {
                        $('#ttpendingtbl').DataTable().row.add([
                            data[i]['ac_startdate'] + ' - ' + data[i]['ac_enddate'],
                            '[ ' + data[i]['ttbl_code'] + ' ]' + data[i]['ttbl_description'],
                            '[ ' + data[i]['course_code'] + ' ]' + data[i]['course_code'],
                            data[i]['ttbl_year'],
                            data[i]['ttbl_semester'],
                            '[ ' + data[i]['exam_code'] + ' ]' + data[i]['exam_name'],
                            viewbtn + editbtn + deltbtn,
                        ]).draw(false);
                    }
                    
                }
                $('.se-pre-con').fadeOut('slow');
            },
            "json"
        );
    }

    //$('#tt_tblvw').DataTable({
    //    'dom':'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
    //    "paging":   false,
    //    "ordering": false,
    //    "info":     false
    //});

    $('#tt_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d');?>", pickTime: false});

    $(function () {
        $('#ttstarttime').datetimepicker({
            pickDate: false,
            //format: 'LT'
        });
    });

    $(function () {
        $('#ttendtime').datetimepicker({
            pickDate: false,
            //format: 'LT'
        });
    });

    $('#tt_form').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        fields: {
            tt_description:
                {
                    validators:
                        {
                            notEmpty: {message: 'Description is required.'}
                        }
                },
            tt_exam:
                {
                    validators:
                        {
                            notEmpty: {message: 'Exam is required.'}
                        }
                },
            tt_course:
                {
                    validators:
                        {
                            notEmpty: {message: 'Course is required.'}
                        }
                },
            tt_year:
                {
                    validators:
                        {
                            notEmpty: {message: 'Year is required.'}
                        }
                },
            tt_semester:
                {
                    validators:
                        {
                            notEmpty: {message: 'Semester is required.'}
                        }
                },
            tt_season:
                {
                    validators:
                        {
                            notEmpty: {message: 'Study Season is required.'}
                        }
                }

        },
        onSuccess: function (e) {
            e.preventDefault();
            savetimetbl();
        }
    });

    $('#tt_timeform').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        fields: {
            tt_date:
                {
                    validators:
                        {
                            notEmpty: {message: 'Date is required.'}
                        }
                },
            tt_starttime:
                {
                    validators:
                        {
                            notEmpty: {message: 'Start Time is required.'},
                            callback: function (value, validator) {
                                var m = new moment(value, 'H:ia', true);
                                if (!m.isValid()) {
                                    return false;
                                }
                                return m.isAfter('07:30AM') && m.isBefore('18:30PM');
                            }
                        }
                },
            tt_endtime:
                {
                    validators:
                        {
                            notEmpty: {message: 'End Time is required.'}
                        }
                },
            tt_subject:
                {
                    validators:
                        {

                            notEmpty: {message: 'Subject is required.'},

                        }
                },
            tt_extype:
                {
                    validators:
                        {
                            notEmpty: {message: 'Exam Type is required.'}
                        }
                }
        },
        onSuccess: function (e) {
            e.preventDefault();
            save_schedule();
        }
    });

    function load_years(tt_course, selyear) {
        $.post("<?php echo base_url('time_table/load_years')?>", {'tt_course': tt_course},
            function (data) {
                $('#tt_year').empty();
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    $('#tt_year').append("<option value=''></option>");
                    if (data > 0) {
                        for (i = 0; i < data; i++) {
                            selectedtxt = '';
                            if (selyear == (i + 1)) {
                                selectedtxt = 'selected';
                            }

                            $('#tt_year').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + " Year</option>");
                        }
                    }
                }
            },
            "json"
        );
    }

    function load_semester(tt_year, selsemester, tt_course) {
        if (tt_course == null) {
            tt_course = $('#tt_course').val();
        }

        $.post("<?php echo base_url('time_table/load_semester')?>", {'tt_year': tt_year, "tt_course": tt_course},
            function (data) {
                $('#tt_semester').empty();
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    $('#tt_semester').append("<option value=''></option>");
                    if (data > 0) {
                        for (i = 0; i < data; i++) {

                            selectedtxt = '';
                            if (selsemester == (i + 1)) {
                                selectedtxt = 'selected';
                            }

                            $('#tt_semester').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + " Semester</option>");
                        }
                    }
                }
            },
            "json"
        );
    }

    function load_subjects(tt_year, tt_semester, tt_course) {
        if (tt_course == null)
            tt_course = $('#tt_course').val();

        if (tt_year == null)
            tt_year = $('#tt_year').val();

        if (tt_semester == null)
            tt_semester = $('#tt_semester').val();

        $.post("<?php echo base_url('time_table/load_subjects')?>", {
                'tt_semester': tt_semester,
                'tt_course': tt_course,
                'tt_year': tt_year
            },
            function (data) {
                $('#tt_subject').empty();
                $('#tt_subject').append("<option value=''></option>");

                // $('#tt_tblvw').DataTable().destroy();;
                // tblheadstr = "<tr><th>Date</th>";
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            selectedtxt = '';
                            // if(sel == data[i]['id'])
                            // {
                            //     selectedtxt = 'selected';
                            // }
                            $('#tt_subject').append("<option value='" + data[i]['id'] + "' " + selectedtxt + ">" + data[i]['code'] + " - " + data[i]['subject'] + "</option>");

                            // tblheadstr += "<th>"+data[i]['subject']+"</th>";

                        }
                    }
                }
                // tblheadstr += "</tr>";
                // $('#tt_tblvw_head').empty();
                // $('#tt_tblvw_head').append(tblheadstr);
                // $('#tt_tblvw').DataTable({
                //     'dom':'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
                //     "paging":   false,
                //     "ordering": false,
                //     "info":     false
                // });
            },
            "json"
        );
    }

    function load_examtypes(tt_subject, seltype) {

        tt_course = $('#tt_course').val();
        tt_year = $('#tt_year').val();
        tt_semester = $('#tt_semester').val();
        tt_season = $('#tt_season').val();

        if (tt_subject == null)
            tt_subject = $('#tt_subject').val();


        $.post("<?php echo base_url('exam/load_examtypes')?>", {
                'tt_semester': tt_semester,
                'tt_course': tt_course,
                'tt_year': tt_year,
                'tt_subject': tt_subject,
                'tt_season': tt_season
            },
            function (data) {
                $('#tt_extype').empty();
                $('#tt_extype').append("<option value=''></option>");
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (data['details'].length > 0) {
                       // alert('load_examtypes');
                        $('#subject_versions_checkbox').empty();
                        for (i = 0; i < data['details'].length; i++) {
                            selectedtxt = '';
                            if (seltype == data['details'][i]['id']) {
                                selectedtxt = 'selected';
                            }
                            $('#tt_extype').append("<option value='" + data['details'][i]['id'] + "' " + selectedtxt + ">" + data['details'][i]['name'] + "</option>");

                        }
                        for (q = 0; q < data['subject_versions'].length; q++) {
                            $('#subject_versions_checkbox').append("<label> <input type='checkbox' class='"+tt_subject+"' value='"+data['subject_versions'][q]['old_version_id']+"' id='check_"+data['subject_versions'][q]['old_version_id']+"'>"+data['subject_versions'][q]['version_name']+"</label><br>");//
                        }
                    }
                }
            },
            "json"
        );
    }

    function load_edit_examtypes(tt_subject, seltype,checked_sub) {

        tt_course = $('#tt_course').val();
        tt_year = $('#tt_year').val();
        tt_semester = $('#tt_semester').val();
        tt_season = $('#tt_season').val();

        if (tt_subject == null)
            tt_subject = $('#tt_subject').val();


        $.post("<?php echo base_url('exam/load_examtypes')?>", {
                'tt_semester': tt_semester,
                'tt_course': tt_course,
                'tt_year': tt_year,
                'tt_subject': tt_subject,
                'tt_season': tt_season
            },
            function (data) {
                $('#tt_extype').empty();
                $('#tt_extype').append("<option value=''></option>");
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (data['details'].length > 0) {

                        $('#subject_versions_checkbox').empty();
                        for (i = 0; i < data['details'].length; i++) {
                            selectedtxt = '';
                            if (seltype == data['details'][i]['id']) {
                                selectedtxt = 'selected';
                            }
                            $('#tt_extype').append("<option value='" + data['details'][i]['id'] + "' " + selectedtxt + ">" + data['details'][i]['name'] + "</option>");

                        }
                        for (q = 0; q < data['subject_versions'].length; q++) {
                            $('#subject_versions_checkbox').append("<label> <input type='checkbox' class='"+tt_subject+"' value='"+data['subject_versions'][q]['old_version_id']+"' id='check_"+data['subject_versions'][q]['old_version_id']+"'>"+data['subject_versions'][q]['version_name']+"</label><br>");//
                        }

                        for(w=0;w<checked_sub.length;w++) {

                            //  var temp='#'+data['subjects_version'][w]['version_id'];
                           // alert('retr');
                            $('#check_'+checked_sub[w]['version_id']).prop('checked', true);
                        }
                    }
                }
            },
            "json"
        );
    }

    function load_exams(tt_year, tt_semester, tt_course, tt_season, selexm) {
        if (tt_course == null)
            tt_course = $('#tt_course').val();

        if (tt_year == null)
            tt_year = $('#tt_year').val();

        if (tt_semester == null)
            tt_semester = $('#tt_semester').val();

        if (tt_season == null)
            tt_season = $('#tt_season').val();

        $.post("<?php echo base_url('exam/load_exams')?>", {
                'tt_semester': tt_semester,
                'tt_course': tt_course,
                'tt_year': tt_year,
                'tt_season': tt_season
            },
            function (data) {
                $('#tt_exam').empty();
                $('#tt_exam').append("<option value=''></option>");
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            selectedtxt = '';
                            if (selexm == data[i]['id']) {
                                selectedtxt = 'selected';
                            }
                            $('#tt_exam').append("<option value='" + data[i]['id'] + "' " + selectedtxt + ">" + data[i]['exam_code'] + " - " + data[i]['exam_name'] + "</option>");
                        }
                    }
                }
            },
            "json"
        );
    }

    function savetimetbl() {
        tt_description = $('#tt_description').val();
        tt_exam = $('#tt_exam').val();
        tt_course = $('#tt_course').val();
        tt_year = $('#tt_year').val();
        tt_semester = $('#tt_semester').val();
        tt_id = $('#tt_id').val();
        tt_action = $('#tt_action').val();
        tt_clonett = $('#tt_clonett').val();
        tt_season = $('#tt_season').val();
        tt_faculty = $('#tt_faculty').val();

        $.post("<?php echo base_url('exam/savetimetbl')?>", {
                'tt_id': tt_id,
                'tt_description': tt_description,
                'tt_exam': tt_exam,
                'tt_course': tt_course,
                'tt_year': tt_year,
                'tt_semester': tt_semester,
                'tt_season': tt_season,
                'tt_action': tt_action,
                'tt_faculty': tt_faculty,
                'tt_clonett': tt_clonett
            },
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    result_notification(data);
                    load_exam_timetables();
                    if (data['status'] == 'success') {
                        load_update_view(data['tt_id'], 'save');
                    }
                }
            },
            "json"
        );
    }

    function load_update_view(id, type) {
        
        $('.se-pre-con').fadeIn('slow');
        $("#tt_course").prop("disabled", true);
        $("#tt_year").prop("disabled", true);
        $("#tt_semester").prop("disabled", true);
        $("#tt_season").prop("disabled", true);
        $("#tt_exam").prop("disabled", true);

        $('#tt_detailvw').show();
        
        $.ajax(
            {
                url: "<?php echo base_url('exam/edit_change_approval_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'ttbl_id': id},
                success: function (data)
                {                          
                    console.info(data);
                }
            });
        
        $.post("<?php echo base_url('exam/load_timetable_data')?>", {'id': id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                    $('.se-pre-con').fadeOut('slow');
                }
                else {
                    $('#tt_form').data('bootstrapValidator').resetForm();
                    $("#create_tab").trigger("click");
                    $('#tt_type').val(data['ttbl_type']);
                    $('#tt_faculty').val(data['ttbl_faculty']);
                    load_courses_list(data['ttbl_course']);
                    load_years(data['ttbl_course'], data['ttbl_year']);
                    load_semester(data['ttbl_year'], data['ttbl_semester'], data['ttbl_course']);
                    load_exams(data['ttbl_year'], data['ttbl_semester'], data['ttbl_course'], data['ttbl_season'], data['ttbl_exam']);
                    load_subjects(data['ttbl_year'], data['ttbl_semester'], data['ttbl_course']);

                    if (type == "save") {
                        $('#tt_description').val(data['ttbl_description']);
                        $('#tt_id').val(data['ttbl_id']);
                        $('#tt_code').val(data['ttbl_code']);
                        $('#tt_action').val('');
                        $('#tt_clonett').val('');
                        $('#tt_season').val(data['ttbl_season']);
                        $("#savebtn").prop('value', 'Update');
                    }
                    else if (type == "clone") {
                        $('#tt_description').val('');
                        $('#tt_id').val('');
                        $('#tt_code').val('');
                        $('#tt_action').val(type);
                        $('#tt_clonett').val(id);
                        $("#savebtn").prop('value', 'Save as New');
                        $('#tt_season').val('');
                    }
                    else {
                        $('#tt_description').val(data['ttbl_description']);
                        $('#tt_id').val('');
                        $('#tt_code').val('');
                        $('#tt_action').val('');
                        $('#tt_clonett').val('');
                        $("#savebtn").prop('value', 'Create');
                        $('#tt_season').val('');
                    }

                    load_timetabledetails(id, data['ttbl_year'], data['ttbl_semester'], data['ttbl_course']);
                    $('.se-pre-con').fadeOut('slow');
                }
            },
            "json"
        );
    }

    function refresh_sheduleform() {
        $('#tt_date').val('');
        $('#tt_starttime').val('');
        $('#tt_endtime').val('');
        $('#tt_subject').val('');
        $('#tt_extype').val('');
        $('#tt_schedid').val('');
        $('#subject_versions_checkbox').empty();
        editFlag = 0;
    }

    function load_timetabledetails(id, tt_year, tt_semester, tt_course) {
        if (tt_course == null)
            tt_course = $('#tt_course').val();

        if (tt_year == null)
            tt_year = $('#tt_year').val();

        if (tt_semester == null)
            tt_semester = $('#tt_semester').val();
        subsequence = new Array();

        $.post("<?php echo base_url('time_table/load_subjects')?>", {
                'tt_semester': tt_semester,
                'tt_course': tt_course,
                'tt_year': tt_year
            },
            function (data) {
                console.log("1== "+data);
                if(data.length > 0)
                {               
                    $('#tt_tblvw').DataTable().destroy();

                    tblheadstr = "<tr><th>Date</th>";
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else {
                        if (data.length > 0) {
                            for (i = 0; i < data.length; i++) {

                                tblheadstr += "<th>" + data[i]['subject'] + "</th>";
                                subsequence.push(data[i]['id']);

                            }
                        }
                    }
                    tblheadstr += "</tr>";
                    $('#tt_tblvw_head').empty();
                    $('#tt_tblvw_head').append(tblheadstr);
                    $('#tt_tblvw').DataTable({
                        'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
                        "paging": false,
                        "ordering": false,
                        "info": false
                    });
                    
                    $('#tt_tblvw').DataTable().clear().draw();

                    $.post("<?php echo base_url('exam/load_savedschedules')?>", {'id': id},
                        function (data) {
                        console.log("2== "+data);
                            if(data.length > 0)
                            {
                                for (i = 0; i < data.length; i++) {
                                    tempary = new Array();
                                    tempary[0] = '<div style="text-align:center;width:100px">' + data[i]['esch_date'] + '</div>';

                                    for (j = 0; j < subsequence.length; j++) {
                                        if (subsequence[j] == data[i]['esch_subject']) {
                                            clzbtn = '<button type="button" class="close" style="font-size:11px !important;opacity: 0.5;" onclick="event.preventDefault();delete_schedule(' + data[i]['esch_id'] + ')"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="font-size:11px !important"></span></button>';
                                            editbtn = '<button type="button" class="close" style="font-size:11px !important;opacity: 0.5;" onclick="event.preventDefault();edit_schedule(' + data[i]['esch_id'] + ')"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="font-size:11px !important"></span></button>';
                                            subject_version='';
                                            for(s=0;s<data[i]['subjects_version'].length;s++){
                                                subject_version+=data[i]['subjects_version'][s]['version_name']+'/';
                                            }
                                            subject_version+=data[i]['version_name'];
                                            tempary[j + 1] = '<div class="panel"><div class="panel-heading" style="max-height:100%;font-size:12px;padding:5px;text-align:center">' + clzbtn + editbtn + '<br>' + data[i]['name'] + '<br> ('+subject_version+')<br>' + formatAMPM(data[i]['esch_stime']) + ' - ' + formatAMPM(data[i]['esch_etime']) + '</div></div>';
                                        }
                                        else {
                                            tempary[j + 1] = '';
                                        }
                                    }

                                    $('#tt_tblvw').DataTable().row.add(tempary).draw(false);
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

    function delete_schedule(id) {
        $.post("<?php echo base_url('exam/delete_schedule')?>", {"id": id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    tt_id = $('#tt_id').val();
                    load_timetabledetails(tt_id, null, null, null);
                    result_notification(data);
                }
            },
            "json"
        );
    }

    function edit_schedule(id) {
        
        editFlag = 1;
        $('#addtimebtn').prop("disabled", false);
        
        $.post("<?php echo base_url('exam/load_scheduledata')?>", {'id': id},
            function (data) {
            console.log(data);
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    $('#tt_schedid').val(data['esch_id']);
                    $('#tt_date').val(data['esch_date']);
                    $('#tt_starttime').val(data['esch_stime']);
                    $('#tt_endtime').val(data['esch_etime']);
                    $('#tt_subject').val(data['esch_subject']);
                   // load_examtypes(data['esch_subject'], data['esch_examtype']);

                    load_edit_examtypes(data['esch_subject'], data['esch_examtype'],data['subjects_version'])


                }
            },
            "json"
        );
    }

    function save_schedule() {
        tt_date = $('#tt_date').val();
        tt_starttime = $('#tt_starttime').val();
        tt_endtime = $('#tt_endtime').val();
        tt_subject = $('#tt_subject').val();
        tt_extype = $('#tt_extype').val();
        tt_id = $('#tt_id').val();
        tt_schedid = $('#tt_schedid').val();

        tt_course = $('#tt_course').val();
        tt_year = $('#tt_year').val();
        tt_semester = $('#tt_semester').val();
        tt_exam = $('#tt_exam').val();
        var subject_version_selected=[];
        var subject_version=[];



        displaytxt = $("#tt_code").val() + ' : ' + $("#tt_subject :selected").text() + ' - ' + $('#tt_date').val() + ' ' + $("#tt_extype :selected").text() + ' [ ' + tt_starttime + ' - ' + tt_endtime + ' ]';

        $("input:checkbox[class='"+tt_subject+"']:checked").each(function () {
            //alert("Id: " + $(this).attr("id") + " Value: " + $(this).val());
            subject_version_selected.push($(this).val());
        });
        $("input:checkbox[class='"+tt_subject+"']:not(:checked)").each(function () {
            //alert("Id: " + $(this).attr("id") + " Value: " + $(this).val());
            subject_version.push($(this).val());
        });
       console.log(subject_version_selected);
       console.log(subject_version);
        $.post("<?php echo base_url('exam/save_schedule')?>", {
                'tt_year': tt_year,
                'tt_course': tt_course,
                'tt_exam': tt_exam,
                'tt_semester': tt_semester,
                'tt_id': tt_id,
                'tt_date': tt_date,
                'tt_starttime': tt_starttime,
                'tt_endtime': tt_endtime,
                'tt_subject': tt_subject,
                'tt_extype': tt_extype,
                'displaytxt': displaytxt,
                'subject_version_selected': subject_version_selected,
                'subject_version': subject_version,
                'tt_schedid': tt_schedid,
                'editFlag': editFlag
            },
            function (data) {
                //savebtn alert(data);
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    result_notification(data);
                    if (data['status'] == 'success') {
                        load_timetabledetails(tt_id);
                        refresh_sheduleform();
                        editFlag = 0;
                    }
                    else{
                        $('#addtimebtn').attr('disabled', false);
                    }
                }
            },
            "json"
        );
    }

    function verify_timetable(id, desc) {
        $.post("<?php echo base_url('exam/verify_timetable')?>", {"id": id, "desc": desc},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    load_exam_timetables();
                    result_notification(data);
                }
            },
            "json"
        );
    }

    function confirm_timetable(id, desc) {
        $.post("<?php echo base_url('exam/confirm_timetable')?>", {"id": id, "desc": desc},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    load_exam_timetables();
                    result_notification(data);
                }
            },
            "json"
        );
    }

    function delete_timetable(id, desc) {
        $('.se-pre-con').fadeIn('slow');
        $.post("<?php echo base_url('exam/delete_timetable')?>", {"id": id, "desc": desc},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                    $('.se-pre-con').fadeOut('slow');
                }
                else {
                    location.reload();
//                    load_exam_timetables();
                    result_notification(data);
                    $('.se-pre-con').fadeOut('slow');
                }
            },
            "json"
        );
    }

    function load_timetable_view(id, desc, tt_course, tt_year, tt_semester) {
        $('#view_description').empty();
        $('#view_description').append('<h4 class="modal-title">' + desc + '</h4>');
        $('#viewtimetable').modal('show');

        subsequence = new Array();

        $.post("<?php echo base_url('time_table/load_subjects')?>", {
                'tt_semester': tt_semester,
                'tt_course': tt_course,
                'tt_year': tt_year
            },
            function (data) {
                $('#tbllkupvw').DataTable().destroy();
                tblheadstr = "<tr><th>Date</th>";
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {

                            tblheadstr += "<th>" + data[i]['subject'] + "</th>";
                            subsequence.push(data[i]['id']);

                        }
                    }
                }
                $.post("<?php echo base_url('exam/load_savedschedules')?>", {'id': id},
                    function (data) {

                        for (i = 0; i < data.length; i++) {
                            tempary = new Array();
                            tempary[0] = '<div style="text-align:center;width:100px">' + data[i]['esch_date'] + '</div>';

                            for (j = 0; j < subsequence.length; j++) {
                                if (subsequence[j] == data[i]['esch_subject']) {

                                    tempary[j + 1] = '<div style="text-align:center;width:100%">' + data[i]['name'] + '<br>' + formatAMPM(data[i]['esch_stime']) + ' - ' + formatAMPM(data[i]['esch_etime']) + '</div>';
                                }
                                else {
                                    tempary[j + 1] = '';
                                }
                            }

                            $('#tbllkupvw').DataTable().row.add(tempary).draw(false);
                        }
                    },
                    "json"
                );

                tblheadstr += "</tr>";
                $('#tbllkupvw_head').empty();
                $('#tbllkupvw_head').append(tblheadstr);
                $('#tbllkupvw').DataTable({
                    'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
                    "paging": false,
                    "ordering": false,
                    "info": false
                });

            },
            "json"
        );

        $('#tbllkupvw').DataTable().clear();


    }

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

    function load_courses_list(selectedid) {
        $('.se-pre-con').fadeIn('slow');
        $('#tt_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('time_table/load_courses_list') ?>",
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else {
                    for (var i = 0; i < data.length; i++) {

                        if (selectedid == data[i]['id']) {
                            $('#tt_course').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        }
                        else {
                            $('#tt_course').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        }
                    }
                }
            },
            "json"
        );
        $('.se-pre-con').fadeOut('slow');
    }
</script>
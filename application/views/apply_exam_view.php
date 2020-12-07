<div class="se-pre-con"></div>
<style>
    .panel-heading, .modal-header {
        background: #3cb5e8b5;
    }

    .modal-header h4.modal-title {
        font-weight: bold;
        color: white;
    }

    .widget .widget-head, .modal-header {
        text-shadow: none;
    }
    
    .table_border_remove{
        border-right: 0;
    }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<style>
    .form-horizontal .control-label {
        text-align: right;
    }

    .input-group-addon {
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Request</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Exam</li>
            <li><i class="fa fa-share-alt"></i>Request</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class="active"><a id="#lookup_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab"
                                              data-toggle="tab">Lookup</a></li>
    <li role="presentation"><a id="#applyexam_tab" href="#applyexam_tab" aria-controls="applyexam_tab" role="tab"
                               data-toggle="tab">Apply Exam</a></li>
    <li role="presentation"><a id="#postpone_tab" href="#postpone_tab" aria-controls="postpone_tab" role="tab"
                               data-toggle="tab">Request</a></li>
    <li role="presentation"><a id="#deferment_tab" href="#deferment_tab" aria-controls="deferment_tab" role="tab"
                               data-toggle="tab">Deferment</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <header class="panel-heading">
                Lookup
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="" id="lookup_form" name="lookup_form"
                      autocomplete="off">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="center" class="col-md-3 control-label">Center</label>
                                        <div class="col-md-7">
                                            <?php
                                            global $branchdrop;
                                            global $selectedbr;
                                            $extraattrs = 'id="l_prom_centre" class="form-control" style="width:100%" onchange="load_course_list(this.value, 1,null);"';
                                            echo form_dropdown('l_prom_centre', $branchdrop, $selectedbr, $extraattrs);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="l_faculty" class="col-md-3 control-label">Faculty</label>
                                    <div class="col-md-9">
                                        <?php
                            //                                            global $facultydrop;
                            //                                            global $selectedfac;
                            //                                            $facextraattrs = 'id="l_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 1)"';
                            //                                            echo form_dropdown('l_faculty',$facultydrop,$selectedfac, $facextraattrs);
                            ?>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="course" class="col-md-3 control-label">Course</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="l_course" name="l_course"
                                                onchange="get_course_code(this.value, 1)" data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty">
                                            <option value=""></option>
                                            <?php

                                            foreach ($exam_course as $ec):
                                                ?>
                                                <option value="<?php echo $ec['course_id']; ?>"><?php echo "[" . $ec['course_code'] . "] - " . $ec['course_name'] ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="batch" class="col-md-3 control-label">Batch</label>
                                    <div class="col-md-7">
                                        <select id="l_batch" class="form-control" style="width:100%" name="l_batch"
                                                data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button type='button' class='btn btn-info'
                                        onclick='event.preventDefault(); search_post_something();'>Search
                                        <!--onclick='event.preventDefault(); load_applied_data();'>Search-->
                                </button>
                            </div>
                        </div>
                        <br/>
                        <div class="col-md-7" style="padding: 25px;">
                            <div class="row">
                                <label>Search Type: </label>
                            </div>
                            <input type="radio" name="type" class="col-md-1" id="apply_exam" value="1"
                                   checked style="margin: 9px 0 0;" onclick="search_post_something();"><label class="col-md-2 control-label"
                                                                                     style="text-align: left;">Apply
                                Exam</label>

                            <input type="radio" name="type" class="col-md-1" id="pospone" value="2"
                                   style="margin: 9px 0 0;" onclick="search_post_something();"><label class="col-md-2 control-label"
                                                                   style="text-align: left;" >Postpone</label>

                            <input type="radio" name="type" class="col-md-1" id="medical_deferment"
                                   value="3" style="margin: 9px 0 0;" onclick="search_post_something();"><label
                                    class="col-md-3 control-label" style="text-align: left;">Medical Deferment</label>
                        </div>
                        
                        
                        <div id="div_lookup_tbl" style="display:none;">
                        <table class="table table-bordered" id="lookup_tbl">
                            <thead id="lookup_thead">
                            <tr>
                                <th>#</th>
                                <th align="center">Year</th>
                                <th align="center">Semester</th>
                                <th align="center">Exam</th>
                                <th align="center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="lookup_body" style="text-align:center;">
<!--                            <tr>
                                <td colspan="10" align="center">No records to show.</td>
                            </tr>-->
                            </tbody>
                        </table>
                        </div>
                        
                        <br>
                        <br>
                        
                        <div id="div_postpone_tbl" style="display:none;">
                        <table class="table table-bordered" id="postpone_tbl">
                            <thead id="lookup_thead">
                            <tr>
                                <th>#</th>
                                <th align="center">Reg No</th>
                                <th align="center">NIC No</th>
                                <th align="center">Year</th>
                                <th align="center">Semester</th>
                                <th align="center">Status</th>
                            </tr>
                            </thead>
                            <tbody id="lookup_body">
                            
                            </tbody>
                        </table>
                        </div>
                        
                            
                        <div id="div_medical_differ_tbl" style="display:none;">
                        <table class="table table-bordered" id="medical_differ_tbl">
                            <thead id="lookup_thead">
                            <tr>
                                <th>#</th>
                                <th align="center">Reg No</th>
                                <th align="center">NIC No</th>
                                <th align="center">Year</th>
                                <th align="center">Semester</th>
                                <th align="center">Subject</th>
                            </tr>
                            </thead>
                            <tbody id="lookup_body" style="text-align:center;">
                            
                            </tbody>
                        </table>
                        </div>

                        <div class="modal fade bs-example-modal-lg" id="view_modal">
                            <div class="modal-dialog modal-lg" style="width:70%;padding-top:13px">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Applied Students</h4>
                                    </div>
                                    <div class="modal-body" style="height: 400px; overflow:auto">
                                        <table class="table table-bordered" id="app_stu_tbl">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Registration No</th>
                                                <!--                                                    <th>Admission No</th>-->
                                                <th>Student Name</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th style="width: 30%">Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody id="app_stu_body">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <!--                                        <button type="button" class="btn btn-primary pull-left">Update</button>-->
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="applyexam_tab">
        <div class="panel">
            <header class="panel-heading">
                Apply Exam
            </header>
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist" id="all_tabs">
                    <li role="presentation" class="active"><a id="#appexam_tab" href="#appexam_tab"
                                                              aria-controls="appexam_tab" role="tab" data-toggle="tab">Current
                            Students</a></li>
                    <li role="presentation"><a id="#appexam_tab" href="#app_rptexam_tab" aria-controls="app_rptexam_tab"
                                               role="tab" data-toggle="tab">Repeat Students</a></li>
                    <li role="presentation"><a id="#appexam_tab" href="#app_req_recorrection_tab"
                                               aria-controls="app_req_recorrection_tab" role="tab" data-toggle="tab">Re-correction
                            Exam</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="appexam_tab">
                        <form class="form-horizontal" role="form" method="post" action="" id="apply_exam_form"
                              name="apply_exam_form" autocomplete="off">
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
                                                    $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="load_current_course_list(this.value, 2, null);"';
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
                                                            onchange="get_course_code(this.value, 2)"
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                        <?php

                                                        foreach ($exam_course as $ec):
                                                            ?>
                                                            <option value="<?php echo $ec['course_id']; ?>"><?php echo "[" . $ec['course_code'] . "] - " . $ec['course_name'] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
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
                                                    <select id="batch" class="form-control" style="width:100%"
                                                            name="batch" onchange="load_semester_exam(this.value)"
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
                                                    <select id="exam1" class="form-control" style="width:100%"
                                                            name="exam1" data-validation="required"
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
                                                            onclick='event.preventDefault(); load_student_data();'>
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <table class="table table-bordered" id="apply_exam_tbl">
                                        <thead id="load_thead">
                                        <tr>
                                            <th>#</th>
                                            <th>Reg No</th>
                                            <!--                                                    <th>Admission No</th>-->
                                            <th>Student</th>
                                        </tr>
                                        </thead>
                                        <tbody id="load_student">
                                        <tr>
                                            <td colspan="10" align="center">No records to show.</td>
                                        </tr>
                                        </tbody>
                                    </table>
									<button type="submit" class="btn btn-primary" id="submitbtn"
                                            onclick="event.preventDefault(); apply_exam_1()">Apply
                                    </button>
                                </div>
                                <!--<div class="panel-footer">
                                </div>-->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="app_rptexam_tab">
                        <form class="form-horizontal" role="form" method="post" action="" id="apply_exam_repeat_form"
                              name="apply_exam_repeat_form" autocomplete="off">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_center" class="col-md-3 control-label">Center</label>
                                                <div class="col-md-7">
                                                    <?php
                                                    global $branchdrop;
                                                    global $selectedbr;
                                                    $extraattrs = 'id="rpt_centre" class="form-control" style="width:100%" onchange="load_rpt_course_list(this.value, 3, null);"';
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
                                                            onchange="get_course_code_for_repeat(this.value, 0)"
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                        <?php

                                                        foreach ($exam_course as $ec):
                                                            ?>
                                                            <option value="<?php echo $ec['course_id']; ?>"><?php echo "[" . $ec['course_code'] . "] - " . $ec['course_name'] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_batch" class="col-md-3 control-label">Batch</label>
                                                <div class="col-md-7">
                                                    <select id="rpt_batch" class="form-control" style="width:100%"
                                                            name="rpt_batch" onchange="load_repeat_year_list()"
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_year" class="col-md-3 control-label">Year</label>
                                                <div class="col-md-7">
                                                    <select id="rpt_year" class="form-control" style="width:100%"
                                                            name="rpt_year" data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty"
                                                            onchange="load_repeat_semesters(this.value);">
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
                                                <label for="rpt_semester"
                                                       class="col-md-3 control-label">Semester</label>
                                                <div class="col-md-7">
                                                    <select id="rpt_semester" class="form-control" style="width:100%"
                                                            name="rpt_semester"
                                                            onchange="load_repeat_semester_exam(this.value)"
                                                            data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rpt_exam" class="col-md-3 control-label">Exam</label>
                                                <div class="col-md-7">
                                                    <select id="rpt_exam" class="form-control" style="width:100%"
                                                            name="rpt_exam" data-validation="required"
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
                                                            onclick='event.preventDefault(); load_repeat_student_data();'>
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <table class="table table-bordered" id="apply_rpt_exam_tbl">
                                        <thead id="apply_rpt_exam_load_thead">
                                        <tr>
                                            <th>#</th>
                                            <th>Reg No</th>
                                            <!--                                                        <th>Admission No</th>-->
                                            <th>Student</th>
                                        </tr>
                                        </thead>
                                        <tbody id="apply_rpt_exam_load_student">
<!--                                        <tr>
                                            <td colspan="10" align="center">No records to show.</td>
                                        </tr>-->
                                        </tbody>
                                    </table>
                                    <div id="rpt_exam_data_div">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="rpt_batch" class="col-md-3 control-label"> Repeat
                                                        Batch</label>
                                                    <div class="col-md-7">
                                                        <select id="rpt_batch_apply" class="form-control"
                                                                style="width:100%" name="rpt_batch_apply"
                                                                onchange="load_repeat_year_list_apply()"
                                                                data-validation="required"
                                                                data-validation-error-msg-required="Field can not be empty">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="rpt_year" class="col-md-3 control-label">Repeat
                                                        Year</label>
                                                    <div class="col-md-7">
                                                        <select id="rpt_year_apply" class="form-control"
                                                                style="width:100%" name="rpt_year_apply"
                                                                data-validation="required"
                                                                data-validation-error-msg-required="Field can not be empty"
                                                                onchange="load_repeat_semesters_apply(this.value);">
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
                                                    <label for="rpt_semester" class="col-md-3 control-label">Repeat
                                                        Semester</label>
                                                    <div class="col-md-7">
                                                        <select id="rpt_semester_apply" class="form-control"
                                                                style="width:100%" name="rpt_semester_apply"
                                                                onchange="load_repeat_semester_exam_apply(this.value)"
                                                                data-validation="required"
                                                                data-validation-error-msg-required="Field can not be empty">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="rpt_exam" class="col-md-3 control-label">Repeat
                                                        Exam</label>
                                                    <div class="col-md-7">
                                                        <select id="rpt_exam_apply" class="form-control"
                                                                style="width:100%" name="rpt_exam_apply"
                                                                data-validation="required"
                                                                data-validation-error-msg-required="Field can not be empty">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>

                                    </div>
									<button type="submit" class="btn btn-primary" id="apply_rpt_exam_submitbtn"
                                            onclick="event.preventDefault(); apply_rpt_exam()">Apply
                                    </button>
                                </div>
                                <!--<div class="panel-footer">
                                </div>-->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="app_req_recorrection_tab">
                        <form class="form-horizontal" role="form" method="post" action="" id="req_recorrection_form"
                              name="req_recorrection_form" autocomplete="off">
                            <div class="panel">
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
                                                            onchange="load_semester_exam_recorrection(this.value)"
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
                                                    <button type='button' class='btn btn-info'
                                                            onclick='event.preventDefault(); load_recorrection_student_data();'>
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
<!--                                                    <tr><td colspan="10" align="center" >No records to show.</td></tr>-->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <!--<button type="submit" class="btn btn-primary" id="submitbtn" onclick="event.preventDefault(); apply_exam()">Apply</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="postpone_tab">
        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('exam/save_postpone') ?>"
              id="postpone_tab" name="postpone_tab" autocomplete="off">
            <div class="panel">
                <div class="panel-heading">
                    Request
                </div>
                <?php
                $panel1 =
                    '<form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off" name="reqe">
			<div class="panel-body">
                        <div class="col-md-12">
						<div class="form-group">
							<label class="col-md-1 control-label">Request Type</label>
								<div class="col-md-3">
									<select type="text" class="form-control" id="reqs_ty" name="reqs_ty" required placeholder="field cannot be empty" data-validation="required" onchange="dis_able(); check_post_grad_apply_status(this.value);" data-validation-error-msg-required="Field can not be empty" value="">
										<option value="">--Please Select--</option>
                                                                                <option value="1">Postpone</option>
										<option value="2">Graduation</option>
									</select>
								</div>
						</div>
					</div>
                                        <br/>
				<div class="well well-lg" id="postpone_details">
					<div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center:</label>
                                <div class="col-md-7">';

                global $branchdrop;
                global $selectedbr;

                if (isset($stu_data)) {
                    $selectedbr = $stu_data['center_id'];
                }

                $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_request_course_list(this.value, 4, this)"';

                $form_drop = form_dropdown('center_id', $branchdrop, $selectedbr, $extraattrs);

                $panel2 = '</div>
                            </div>				
                        </div>
                        <div class="col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                <div class="col-md-9">
                                    <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                    <select class="form-control" id="course_id" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="get_course_code(this.value, 3)">    
                                        <option value="0">---Select Course Code---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_year_list()">
                                        <option value="0">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
					<br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Current Year:</label>
                                <div class="col-md-9">

                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="postpone_load_semesters(this.value)">
                                        <option value="0">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-6">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Current Semester:</label>
                                <div class="col-md-6">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
				</div>
				<div class="col-md-12">
						<!--<div class="form-group">
							<label class="col-md-1 control-label">Request Type</label>
								<div class="col-md-3">
									<select type="text" class="form-control" id="reqs_ty" name="reqs_ty" required placeholder="field cannot be empty" data-validation="required" onchange="dis_able(); check_post_grad_apply_status(this.value);" data-validation-error-msg-required="Field can not be empty" value="">
										<option value="">--Please Select--</option>
                                                                                <option value="1">Postpone</option>
										<option value="2">Graduation</option>
									</select>
								</div>
						</div>-->
						<div class="form-group" id="reason_div">
							<label class="col-md-1 control-label">Reason</label>
								<div class="col-md-3">
									<textarea rows="4" type="text" class="form-control" id="resn" name="resn"></textarea>
								</div>
						</div>
					</div>
					<br>
					<div class="form-group" id="date_div">
                            <label  class="col-md-1 control-label">Next Join<br>(if possible)</label>
                            <div class="col-sm-3" style="padding-left: 2.5%;">
                                <div id="" class="input-group date" >
                                    <input class="form-control datepicker" type="date" name="nxt" id="nxt" data-format="YYYY-MM-DD" value="" data-validation="required" data-validation-error-msg-required="*">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div id="button_div">
                            <button type="submit" class="btn btn-primary" id="submitbtn_save" onclick="event.preventDefault();$("").trigger("submit");" style="margin-right: 5px;">Save</button>
					<button type="reset" class="btn btn-primary" id="submitbtn_reset" onclick="event.preventDefault(); reset_postpone()">Reset</button>
                        </div>
                        
                        <div id="graduate_div">
                            <label id="graduate_label" style="float: right;margin-right: 2%; font-size: medium;"></label>
                            <br>
                            <br>
                            <button type="button" class="btn btn-primary" id="apply_graduation" style="float: right;margin-right: 2%;" onclick="apply_graduation_request();">Apply Graduation</button>
                            <br><br>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="apply_graduation_tbl" style="overflow-x: auto; max-height: 200px; overflow-y: auto; -ms-overflow-style: -ms-autohiding-scrollbar;">  <!--display: block;-->
                                    <thead id="graduation_thead">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Subject</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody id="graduation_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
				    </div>
            </form>';

                echo $panel1 . $form_drop . $panel2;

                ?>
            </div>
        </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="deferment_tab">
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
                <div id="current_deferement">
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
                                            echo form_dropdown('rpt_centre', $branchdrop, $selectedbr, $extraattrs);
                                        ?>
    <!--                                    <select class="form-control" id="eh_center" name="eh_center" class="form-control"
                                                data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty"
                                                onchange="sem_load_course_list(this.value, 1, null);">
                                            <option value="">---Select center---</option>
                                            <?php
                                           // foreach ($centers as $row):
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
                                                data-validation-error-msg-required="Field can not be empty" value="" onchange="reset_exam();">
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
                                                onchange="deferement_load_semesters(this.value, null, 1)" required
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

                            <button type="button" class="btn btn-info btn-md" name="search" id="search_students"
                                    onclick="search_students_absented()">Search Students
                            </button>
                        </div>

    <!--                    <div class="col-md-2">
                            <button type="button" class="btn btn-success btn-md" id="print_students_semester_subject_btn"
                                    name="print_students_semester_subject_btn" onclick="print_students_semester_subject();">
                                <span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report
                            </button>
                        </div>-->
                    </div>
                </div>
                
                <div id="repeat_deferement">
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
                                            $extraattrs = 'id="eh_rpt_center" class="form-control" onchange="sem_load_course_list(this.value, 2, null);"';
                                            echo form_dropdown('eh_rpt_center', $branchdrop, $selectedbr, $extraattrs);
                                        ?>
    <!--                                    <select class="form-control" id="eh_center" name="eh_center" class="form-control"
                                                data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty"
                                                onchange="sem_load_course_list(this.value, 1, null);">
                                            <option value="">---Select center---</option>
                                            <?php
                                           // foreach ($centers as $row):
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
                                        <select type="text" class="form-control" id="eh_rpt_course" name="eh_rpt_course"
                                                onchange="get_course_year(this.value, 1, null, null, 2)" required
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
                                        <select type="text" class="form-control" id="eh_rpt_batch" name="eh_rpt_batch" required
                                                placeholder="field cannot be empty" data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty" value="" onchange="reset_exam_rpt(); load_deferement_rpt_years();">
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
                                        <select type="text" class="form-control" id="eh_rpt_year" name="eh_rpt_year"
                                                onchange="load_deferement_rpt_semesters(this.value)" required
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
                                        <select type="text" class="form-control" id="eh_rpt_semester" name="eh_rpt_semester"
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
                                        <select class="form-control" id="eh_rpt_exam" name="eh_rpt_exam">
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
                            <button type="button" class="btn btn-info btn-md" name="search_repeat" id="search_students_repeat"
                                    onclick="search_students_absented_repeat()">Search Repeat Students
                            </button>

                        </div>

    <!--                    <div class="col-md-2">
                            <button type="button" class="btn btn-success btn-md" id="print_students_semester_subject_btn"
                                    name="print_students_semester_subject_btn" onclick="print_students_semester_subject();">
                                <span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report
                            </button>
                        </div>-->
                    </div>
                </div>
                <br>
                <br>

                <table class="table table-bordered" id="student_absent_tbl">
                    <thead id="load_absent_thead">
                    <tr>
                        <th>#</th>
                        <th>Registration No</th>
                        <th>Student Name</th>
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

</div>


<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<script type="text/javascript">

    $.validate({
        form: '#apply_exam_form'
    });

    $.validate({
        form: '#apply_exam_repeat_form'
    });

    function dis_able() {
//        if (document.reqe.reqs_ty.value != '1') {
//            document.reqe.resn.disabled = 1;
//        }
//
//        else {
//            document.reqe.resn.disabled = 0;
//        }
    }

    $(document).ready(function () {
        
         $('#apply_rpt_exam_tbl').DataTable();
         
         $('#apply_graduation_tbl').DataTable({
            'ordering': false,
            'searching': false,
            'paging': false
        });
        
        $('#apply_graduation').attr('disabled', true);
        $('#graduate_label').hide();
         
         $('#submitbtn').attr('disabled', true);
        
         $('#div_lookup_tbl').hide();
         $('#div_postpone_tbl').hide();
         $('#div_medical_differ_tbl').hide();
        //load_course list for lookup;
        if ($('#l_prom_centre').length) {
            load_course_list(($('#l_prom_centre').val()), 1, null);
        }
        
        //load_course list for current students;
        if ($('#prom_centre').length) {
            load_current_course_list(($('#prom_centre').val()), 2, null);
        }

        //load_course list for repeat students;
        if ($('#rpt_course').length) {
            load_rpt_course_list(($('#rpt_centre').val()), 3, null);
        }

        //load_course list for request;
        if ($('#center_id').length) {
            load_request_course_list(($('#center_id').val()), 4, null);
        }
        //hide repeat apply dropdown
        $("#rpt_exam_data_div").hide();
        
        if($('#req_recorrection_centre').val() != ""){
            load_recorrection__course_list($('#req_recorrection_centre').val());
        }
        
        $('#apply_recorrection_exam_tbl').DataTable({
            'ordering': false,
            'lengthMenu': [10, 25, 50, 75, 100]
        });
        
        $('#apply_rpt_exam_submitbtn').attr("disabled", true);
        
        check_student_approved_status();
        
        if($('#eh_center').length){
            sem_load_course_list(($('#eh_center').val()), 1, null);
        }
        
        if($('#eh_rpt_center').length){
            sem_load_course_list(($('#eh_rpt_center').val()), 2, null);
        }
        
        if($('#current_exam').is(":checked") == true){
            $('#search_students').show();
            $('#search_students_repeat').hide();
        }
        
        reset_fields_deferements("C");
        
        <?php
                $access_level = $this->Util_model->check_access_level();
                $ug_level = $access_level[0]['ug_level']; 
        ?>
        
        <?php if($ug_level == 5){ ?>                
                    document.getElementById("eh_center").selectedIndex = "1";
        <?php } ?>
//        $('#postpone_tbl').DataTable();
//        $('#medical_differ_tbl').DataTable();
        });


    function postpone_load_semesters(year_no) {
        var sel_year = "";
        var sel_year_id = "";

        if (year_no != "") {
            sel_year = year_no.split('-')[0].trim();
            sel_year_id = year_no.split('-')[1].trim();
        }
        $.post("<?php echo base_url('Student/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},

            function (data) {
                $('#l_no_semester').find('option').remove().end();
                $('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                for (var i = 1; i <= data; i++) {
                    $('#l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                }
            },
            "json"
        );
    }

    function get_course_code(course_id, lookup_flag) {
        $('#l_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {
                for (j = 0; j < data.length; j++) {
                    if ((data[j]['batch_code'] != "0") || data[j]['batch_code'] != null) {
                        if (lookup_flag == 1) {
                            $('#l_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        }
                        else if (lookup_flag == 2) {
                            $('#batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        }
                        else {
                            $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        }
                    }
                }
                <?php
                        $access_level = $this->Util_model->check_access_level();
                        $ug_level = $access_level[0]['ug_level']; 
                    ?>
        
                    <?php if($ug_level == 5){ ?>
                    document.getElementById("l_batch").selectedIndex = "1";
                    document.getElementById("batch").selectedIndex = "1";
                    
                    load_semester_exam($('#batch').val());

                <?php } ?>
            },
            "json"
        );
    }

    function load_year_list() {
        var cou_id = $('#course_id').val();
               
        $.post("<?php echo base_url('Student/load_year_list_for_request') ?>", {'selected_course_id': cou_id},
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

    function load_semesters(year_no) {
        var sel_year = "";
        var sel_year_id = "";

        if (year_no != "") {
            sel_year = year_no.split('-')[0].trim();
            sel_year_id = year_no.split('-')[1].trim();
        }
        $.post("<?php echo base_url('Student/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},

            function (data) {
                $('#l_no_semester').find('option').remove().end();
                $('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                for (var i = 1; i <= data; i++) {
                    $('#l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                }
            },
            "json"
        );
    }


    function get_course_code_for_repeat(course_id, lookup_flag) {

        $('#rpt_batch').find('option').remove().end();
        $('#rpt_batch').append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    //if (lookup_flag) {
                    //    $('#l_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                    //} else {
                    $('#rpt_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                    // }
                }
                <?php
                        $access_level = $this->Util_model->check_access_level();
                        $ug_level = $access_level[0]['ug_level']; 
                ?>
        
                    <?php if($ug_level == 5){ ?>
                    document.getElementById("rpt_batch").selectedIndex = "1";
                    
                    load_repeat_year_list();
                <?php } ?>

            },
            "json"
        );
    }

    function load_student_data() {
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        var batch_id = $('#batch').val();
        var exam_id = $('#exam1').val();
        
        $('#submitbtn').attr('disabled', true);
        
        if (batch_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch and Exam !';
            result_notification(res);
        } else {
            $.post("<?php echo base_url('subject/load_semester_subjects') ?>", {'batch_id': batch_id},
                function (data) {

                    for (var i = 0; i < data.length; i++) {
                        sem_subject_ids.push(data[i]['subject_id']);
                        sem_subject_code.push(data[i]['code']);
                        sem_subject_names.push(data[i]['subject']+"<br/>["+data[i]['code']+"]");
                        if (data[i]['subject_type'] == '1') {
                            sem_subject_types.push("Core");
                        } else {
                            sem_subject_types.push("Elective");
                        }

                    }

                    $.post("<?php echo base_url('student/load_student_for_apply_exam') ?>", {
                            'batch_id': batch_id,
                            'branch': $('#prom_centre').val(),
                            'sem_exam_id': $('#exam1').val()
                        },
                        function (data1) {
                            $('#load_thead').find('tr').remove();
                            if (data1.length > 0) {
                                $('#load_student').find('tr').remove();
                                $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                                $('#apply_exam_tbl tr:last').append(sem_subject_names
                                    .map(id => `<th style="width:10%;">${id}</th>`)
                                    .join(''))
                                    .appendTo($('#load_thead'));

                                for (j = 0; j < data1.length; j++) {

                                    $('#load_student').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data1[j]['reg_no'] + "</td><td>" + data1[j]['first_name'] + "</td></tr>");
                                    for (x = 0; x < data1[j]['selected_subjects'].length; x++) {
                                        selected_subjects.push(data1[j]['selected_subjects'][x]['subject_code']);
                                    }
                                    $('#apply_exam_tbl tr:last').append(sem_subject_code
                                        .map(e => `<td style="text-align:center; width:10%;">${selected_subjects.includes(e) ? '<input type="checkbox" name="apply_exam[' + data1[j]['stu_id'] + '][]" value="' + e + '" checked disabled>' : "Not Selected"}</td>`)
                                        .join(''))
                                        .appendTo($('#load_student'));
                                    selected_subjects = [];
                                }
                                
                                $('#submitbtn').attr('disabled', false);

                            }
                            else{
                                $('#load_student').find('tr').remove();
                                $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                                $('#apply_exam_tbl tr:last').append(
                                    '<th>Subject</th><th>Action</th>')
                                    .appendTo($('#load_thead'));

                                $('#load_student').append("<tr><td colspan='5' align='center' >No records to show.</td></tr>");
                                
                                $('#submitbtn').attr('disabled', true);
                            }
                        },
                        "json"
                    );

                },
                "json"
            );
        }
    }

    function apply_exam_1() {

        $("#apply_exam_form :input").prop("disabled", false);
        var batch_id = $('#batch').val();
        var exam_id = $('#exam1').val();
        if (batch_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch and Exam !';
            result_notification(res);
        } else {
            $.ajax(
                {
                    url: "<?php echo base_url('student/apply_exam') ?>",
                    type: 'POST',
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: $('#apply_exam_form').serialize(),
                    success: function (data) {
                        location.reload();
                    }
                });
        }
    }

    function load_applied_data() {
    $("#lookup_tbl").show();
        $('#lookup_body').find('tr').remove();
        $.post("<?php echo base_url('exam/applied_exams_for_lookup') ?>", $('#lookup_form').serialize(),
            function (data) {
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        //                                            alert("deleted" + data[i]['sem_ex_deleted']);
                        //                                            if (data[i]['sem_ex_deleted'] == '1') {
                        //                                                alert("deleted");
                        //                                                delete_btn = "<button title='activate' type='button' class='btn btn-success btn-xs' onclick='update_applied_status(" + data[i]['sem_ex_id'] + ",0)'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
                        //                                            } else {
                        //                                                alert("not deleted");
                        //                                                delete_btn = "<button title='deactivate' type='button' class='btn btn-warning btn-xs' onclick='update_applied_status(" + data[i]['sem_ex_id'] + ",1)'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                        //                                            }
                        action = "<button title='view' type='button' class='btn btn-success btn-xs' onclick='open_modal(" + data[i]['sem_ex_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></button>";
                        $('#lookup_body').append("<tr><td>" + (i + 1) + "</td><td>" + data[i]['year_no'] + "</td><td>" + data[i]['semester_no'] + "</td><td>" + data[i]['exam_code'] + "</td><th>" + action + "</th></tr>");
                    }
                }
                else {
                    $('#lookup_body').append("<tr><td colspan='10' align='center' >No records to show.</td></tr>");
                }
            },
            "json"
        );
    }

    function open_modal(sem_exam_id) {

        $('#app_stu_body').empty();

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
                        var approve = '';
                        if (data[i]['exam_approved'] == 0)
                            approve = "Pending";
                        else if (data[i]['exam_approved'] == 1)
                            approve = "Registrar Approved";
                        else if (data[i]['exam_approved'] == 2)
                            approve = "Lecturer Approved";
                        else if (data[i]['exam_approved'] == 3)
                            approve = "Rejected";
                        var reason = "";
                        if (data[i]['rejected_reason'] != null)
                            reason = data[i]['rejected_reason'];

                        $('#app_stu_body').append("<tr><td>" + (i + 1) + "</td><td>" + data[i]['reg_no'] + "</td><td>" + data[i]['first_name'] + "</td><td>" + data[i]['code'] + "</td><td>" + approve + "</td><td style=\"width: 30%;bgcolor:#FF0000;\">" + reason + "</td></tr>");
                        //<td>"+data[i]['admission_no']+"</td>
                    }
                }
            });
    }

    function load_semester_exam(batch_id) {
        $('#exam1').find('option').remove().end();
        $('#exam1').append('<option value="">---Select Exam---</option>').val('');

        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#exam1').append($("<option></option>").attr("value", data[i]['sem_exam_id']).text("["+data[i]['exam_code'] +"] - "+ data[i]['exam_name']));
                }
            },
            "json"
        );
    }

    function load_repeat_year_list() {

        var course_id = $('#rpt_course').val();

        $.post("<?php echo base_url('Student/load_year_list') ?>", {'selected_course_id': course_id},

            function (data) {
                var year = data['no_of_year'];
                var id = data['id'];

                $('#rpt_year').find('option').remove().end();
                $('#rpt_year').append('<option value="">---Select Year---</option>').val('');

                for (var i = 1; i <= year; i++) {
                    $('#rpt_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                }
            },
            "json"
        );
    }

    function load_repeat_year_list_apply() {

        var course_id = $('#rpt_course').val();
        $('#rpt_year_apply').find('option').remove().end();
        $('#rpt_year_apply').append('<option value="">---Select Year---</option>').val('');

        $.post("<?php echo base_url('Student/load_year_list') ?>", {'selected_course_id': course_id},

            function (data) {
                var year = data['no_of_year'];
                var id = data['id'];

                for (var i = 1; i <= year; i++) {
                    $('#rpt_year_apply').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                }
            },
            "json"
        );
    }

    function load_repeat_semesters(year_no) {
        var sel_year = year_no.split('-')[0].trim();
        var sel_year_id = year_no.split('-')[1].trim();

        $('#rpt_semester').find('option').remove().end();
        $('#rpt_semester').append('<option value="">---Select Semester---</option>').val('');

        $.post("<?php echo base_url('Student/load_semesters_from_year') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
            
            function (data) {
                //var sem_id = data['id'];
                //for (var i = 1; i <= data; i++) {
                for (var i = 1; i <= data; i++) {
                    //$('#rpt_semester').append($("<option></option>").attr("value", i+'-'+sem_id).text(i + " Semester"));
                    $('#rpt_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                }
            },
            "json"
        );
    }

    function load_repeat_semesters_apply(year_no) {
        var sel_year = year_no.split('-')[0].trim();
        var sel_year_id = year_no.split('-')[1].trim();

        $('#rpt_semester_apply').find('option').remove().end();
        $('#rpt_semester_apply').append('<option value="">---Select Semester---</option>').val('');

        $.post("<?php echo base_url('Student/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},

            function (data) {

                for (var i = 1; i <= data; i++) {

                    $('#rpt_semester_apply').append($("<option></option>").attr("value", i).text(i + " Semester"));

                }
            },
            "json"
        );
    }

    function load_repeat_semester_exam(semester) {
        
        var rptbatch = $('#rpt_batch').val();
        
        var rptyear = $('#rpt_year').val().split('-')[0].trim();
        var rptsemester = $('#rpt_semester').val();
        
        $('#rpt_exam').find('option').remove().end();
        $('#rpt_exam').append('<option value="">---Select Exam---</option>').val('');

        $.post("<?php echo base_url('exam/load_repeat_exam_to_apply_exam') ?>", {'rptbatch': rptbatch, 'rptyear':rptyear, 'rptsemester':rptsemester},
            function (data) {
                if (data != null) {
                    for (var i = 0; i < data.length; i++) {
                        $('#rpt_exam').append($("<option></option>").attr("value", data[i]['exmid']).text("["+data[i]['exam_code']+"] - "+data[i]['exam_name']));
                    }
                }
            },
            "json"
        );
    }

    function load_repeat_semester_exam_apply(semester) {
        $('#rpt_exam_apply').find('option').remove().end();
        $('#rpt_exam_apply').append('<option value="">---Select Exam---</option>').val('');

        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': $('#rpt_batch_apply').val()},
            function (data) {
                if (data != null) {
                    for (var i = 0; i < data.length; i++) {
                        $('#rpt_exam_apply').append($("<option></option>").attr("value", data[i]['exmid']).text("["+data[i]['exam_code']+"] "+data[i]['exam_name']));
                    }
                }
            },
            "json"
        );
    }

    function load_repeat_student_data() {

        //check the number of attempts for student for each repeat subject. if.. not 4 attempts will give the apply option...
        // when add the record in to exam details table.. make is_repeat=1.

        var rptCenter = $('#rpt_centre').val();
        var rptCourse = $('#rpt_course').val();
        var rptBatch = $('#rpt_batch').val();
        var rptYear = $('#rpt_year').val().split('-')[0].trim();
        var rptSemester = $('#rpt_semester').val();
        var rptExam = $('#rpt_exam').val();

        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var selected_subjects = [];
        var sem_exam_detail_ids = [];
        var sem_subject_marking_method = [];
        
        $('#apply_rpt_exam_submitbtn').attr("disabled", true);
        $('#apply_rpt_exam_load_thead').find('tr').remove();
        $('#apply_rpt_exam_load_student').find('tr').remove();
        $('#apply_rpt_exam_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");

        var numCols = $("#apply_rpt_exam_tbl").find('tr')[0].cells.length;

        $('#apply_rpt_exam_load_student').append("<tr ><td colspan='"+numCols+"' align='center'>No records to show.</td></tr>");
        $('#apply_rpt_exam_submitbtn').attr("disabled", true);


        if(rptExam == ""){
            funcres = {status: "denied", message: "Select exam before search."};
            result_notification(funcres);
        }
        else{
            $.post("<?php echo base_url('exam/load_repeat_students') ?>", {
                    'rptCenter': rptCenter,
                    'rptCourse': rptCourse,
                    'rptBatch': rptBatch,
                    'rptYear': rptYear,
                    'rptSemester': rptSemester,
                    'rptExam': rptExam
                },
                function (data) {
                    if(data!=null) {

                        $('#apply_rpt_exam_submitbtn').attr("disabled", false);

                        for (var i = 0; i < data['sem_sub'].length - 1; i++) {
                            sem_subject_ids.push(data['sem_sub'][i]['subject_id']);
                            sem_subject_code.push(data['sem_sub'][i]['code']);
                            sem_subject_names.push(data['sem_sub'][i]['subject']);
                            
                            sem_subject_marking_method[data['sem_sub'][i]['subject_id']] = (data['sem_sub'][i]['marking_details'].length);
                            
                        }             

                        $('#apply_rpt_exam_load_thead').find('tr').remove();
                        if (data['students'].length > 0) {
                            $('#apply_rpt_exam_load_student').find('tr').remove();
                            $('#apply_rpt_exam_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                            $('#apply_rpt_exam_tbl tr:last').append(sem_subject_code
                                .map(id => `<th>${id}</th>`)
                                .join(''))
                                .appendTo($('#apply_rpt_exam_load_thead'));

                            for (j = 0; j < data['students'].length; j++) {

                                $('#apply_rpt_exam_load_student').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data['students'][j]['reg_no'] + "</td><td>" + data['students'][j]['first_name'] + "</td></tr>");
                                for (x = 0; x < data['students'][j]['repeat_subject'].length; x++) {
                                    //selected_subjects.push(data['students'][j]['repeat_subject'][x]['subject_code']);
                                    selected_subjects.push(data['students'][j]['repeat_subject'][x]['subject_id']);
                                    sem_exam_detail_ids[data['students'][j]['repeat_subject'][x]['subject_id']] = data['students'][j]['repeat_subject'][x]['sem_exam_detail_id'];
                                }
                                
                                
                                console.log(sem_subject_ids);
                                console.log(selected_subjects);
                                //checked
                                $('#apply_rpt_exam_tbl tr:last').append(sem_subject_ids
                                    .map(e => `<td>${selected_subjects.includes(e) ? '<input type="checkbox" name="rpt_apply_exam_request[' + data['students'][j]['stu_id'] + '][]" value="' + e + '_' + sem_exam_detail_ids[e] + '" >  '+ get_mark_by_id(data['students'][j]['subject_maks'], 'subject_id', e, 'result') +' <br>No of Attempt:' + get_mark_by_id(data['students'][j]['subject_maks'], 'subject_id', e, 'no_of_attempts') + '<br><br><b>Repeat Apply For:</b><br><select type="text" class="form-control" id="repeat_apply_type" name="repeat_apply_type[' + e + ']">'+(sem_subject_marking_method[e]==1 ? '<option value="1">Assignment Only</option>' : '<option value="1">Assignment & Written Both</option><option value="0">Written Only</option><option value="1">Assignment Only</option>')+'</select>' : '' + get_mark_by_id(data['students'][j]['subject_maks'], 'subject_id', e, 'result') + '<br>No of Attempt:' + get_mark_by_id(data['students'][j]['subject_maks'], 'subject_id', e, 'no_of_attempts')} </td>`)
                                    .join(''))
                                    .appendTo($('#apply_rpt_exam_load_student'));
                                selected_subjects = [];
                            }
                        }
                    }else{
                        $('#apply_rpt_exam_load_thead').find('tr').remove();
                        $('#apply_rpt_exam_load_student').find('tr').remove();
                        $('#apply_rpt_exam_load_thead').append("<tr><th>#</th><th>Reg No</th><th>Student</th></tr>");
                        
                        var numCols = $("#apply_rpt_exam_tbl").find('tr')[0].cells.length;
     
                        $('#apply_rpt_exam_load_student').append("<tr ><td colspan='"+numCols+"' align='center'>No records to show.</td></tr>");
                        $('#apply_rpt_exam_submitbtn').attr("disabled", true);
                    }
                },
                "json"
            );
        }

    }

    function load_course_list(center_id) {
        $('#l_course').find('option').remove().end();
        $('#l_course').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#l_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                }
                <?php
                        $access_level = $this->Util_model->check_access_level();
                        $ug_level = $access_level[0]['ug_level']; 
                    ?>
        
                    <?php if($ug_level == 5){ ?>
                    document.getElementById("l_course").selectedIndex = "1";
                    get_course_code(($('#l_course').val()), 1)
                <?php } ?>
            },
            "json"
        );
    }

    function load_current_course_list(center_id) {
        $('#course').find('option').remove().end();
        $('#course').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                }
                <?php
                        $access_level = $this->Util_model->check_access_level();
                        $ug_level = $access_level[0]['ug_level']; 
                    ?>
        
                    <?php if($ug_level == 5){ ?>
                    document.getElementById("course").selectedIndex = "1";
                    get_course_code(($('#course').val()), 2);
                <?php } ?>
            },
            "json"
        );
    }

    function load_rpt_course_list(center_id) {
        $('#rpt_course').find('option').remove().end();
        $('#rpt_course').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#rpt_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                }
                <?php
                        $access_level = $this->Util_model->check_access_level();
                        $ug_level = $access_level[0]['ug_level']; 
                    ?>
        
                    <?php if($ug_level == 5){ ?>
                    document.getElementById("rpt_course").selectedIndex = "1";
                    get_course_code_for_repeat(($('#rpt_course').val()), 0);
                <?php } ?>
            },
            "json"
        );
    }

    function load_request_course_list(center_id) {
        $('#course_id').find('option').remove().end();
        $('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                }
            },
            "json"
        );
    }

    function get_mark_by_id(array, key, value,return_val) {      
        for (var i = 0; i < array.length; i++) {   
            if (array[i][key] === value) {
                return array[i][return_val];
            }
        }
        return "-";
    }

    function apply_rpt_exam() {

        $("#apply_exam_repeat_form :input").prop("disabled", false);
        var batch_id = $('#rpt_batch').val();
        var exam_id = $('#rpt_exam').val();
        
        var check_count = $('input:checkbox:checked').length;

        if (batch_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select Request batch and Exam !';
            result_notification(res);
        } else if(check_count == 0){
            funcres = {status: "denied", message: "Please select at least one subject to apply for exam."};
            result_notification(funcres);
        }
        else {
            
            $.ajax(
            {
                url: "<?php echo base_url('student/check_repeat_attempts') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#apply_exam_repeat_form').serialize(),
                success: function (data) {
                    if(data['no_of_attempts'] >= 4){
                        funcres = {status: "denied", message: "Number of repeat attempts exceeded for subject "+data['subject']+" - ("+data['code']+"). Please contact administrator."};
                        result_notification(funcres);
                    }
                    else{
                        $.ajax(
                        {
                            url: "<?php echo base_url('student/apply_repeat_exam_request') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: $('#apply_exam_repeat_form').serialize(),
                            success: function (data) {
                                location.reload();
                            }
                        });
                    }
                    
                }
            });
            
            
            
            //$('#dropDownId :selected').text();
            
            

        }
        
    }

    //////////////////Deferment Tab////////////////

    function sem_load_course_list(center_id, status, edit_course) {
        if (status == 1) {
            $('#eh_course').find('option').remove().end();
            $('#eh_course').append('<option value="">---Select Course---</option>').val('');
            
            $('#eh_rpt_batch').find('option').remove().end();
            $('#eh_rpt_batch').append('<option value="">---Select Batch---</option>').val('');
            
            $('#eh_rpt_year').find('option').remove().end();
            $('#eh_rpt_year').append('<option value="">---Select Year---</option>').val('');
            
            $('#eh_rpt_semester').find('option').remove().end();
            $('#eh_rpt_semester').append('<option value="">---Select Semester---</option>').val('');
            
            $('#eh_rpt_exam').find('option').remove().end();
            $('#eh_rpt_exam').append('<option value="">---Select Exam---</option>').val('');
            

            $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#eh_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }
                <?php
                $access_level = $this->Util_model->check_access_level();
                $ug_level = $access_level[0]['ug_level']; 
                ?>
        
                <?php if($ug_level == 5){ ?>                
                    document.getElementById("eh_course").selectedIndex = "1";
                    get_course_year(($('#eh_course').val()), 1, null, null, 1);
                <?php } ?>

                },
                "json"
            );
        } 
        else if(status == 2){
            $('#eh_rpt_course').find('option').remove().end();
            $('#eh_rpt_course').append('<option value="">---Select Course---</option>').val('');
            
            $('#eh_rpt_batch').find('option').remove().end();
            $('#eh_rpt_batch').append('<option value="">---Select Batch---</option>').val('');
            
            $('#eh_rpt_year').find('option').remove().end();
            $('#eh_rpt_year').append('<option value="">---Select Year---</option>').val('');
            
            $('#eh_rpt_semester').find('option').remove().end();
            $('#eh_rpt_semester').append('<option value="">---Select Semester---</option>').val('');
            
            $('#eh_rpt_exam').find('option').remove().end();
            $('#eh_rpt_exam').append('<option value="">---Select Exam---</option>').val('');

            $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#eh_rpt_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }
                    <?php
                    $access_level = $this->Util_model->check_access_level();
                    $ug_level = $access_level[0]['ug_level']; 
                    ?>
        
                <?php if($ug_level == 5){ ?>                
                    document.getElementById("eh_rpt_course").selectedIndex = "1";
                    get_course_year(($('#eh_rpt_course').val()), 1, null, null, 2);
                <?php } ?>

                },
                "json"
            );
        }
        else {
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


    function get_batch(year_no, batch_id, lookup_flag) {
        if (lookup_flag) {
            var id = $('#eh_course').val();
        } else {
            var id = $('#load_Dcode').val();
        }

        //$('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#eh_course').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                        function (data) {
                            for (j = 0; j < data.length; j++) {
                                if (data[j]['id'] == batch_id) {
                                    if (lookup_flag) {
                                        $('#eh_course').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    }
                                    $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                } else {
                                    if (lookup_flag) {
                                        $('#eh_course').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
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
        $('#eh_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
        $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
        $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#eh_batch').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
        $('#eh_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
        $('#eh_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        $('#eh_exam').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        
        
        $('#eh_rpt_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        $('#eh_rpt_year').find('option').remove().end().append('<option value="">---Select Year---</option>').val('');
        $('#eh_rpt_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        $('#eh_rpt_exam').find('option').remove().end().append('<option value="">---Select Exam---</option>').val('');
        
        $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    if (data != null) {
                        if (typeof data['current_year'] === 'undefined') {
                            //alert('true');
                            for (var i = 1; i <= data['no_of_year']; i++) {
                                if (flag) {
                                    if (i == year_no) {
                                        if (lookup_flag == 1) {
                                            $('#eh_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                    } else {
                                        if (lookup_flag == 1) {
                                            $('#eh_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                        }
                                        $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                    }
                                } else {
                                    if (lookup_flag == 1) {
                                        $('#eh_year').append($("<option></option>").text(i+" Year"));
                                    }
                                    $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                }
                            }
                        } else {


                            //alert('false');
                            var current_year = data['current_year'];

                            if(current_year != 0){
                                if (flag) {

                                    if (lookup_flag == 1) {
                                        $('#eh_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                    }
                                    $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));

                                } else {
                                    if (lookup_flag == 1) {
                                        $('#eh_year').append($("<option></option>").text(current_year+" Year"));
                                    }
                                    $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                }
                            }
                        }

                        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                            function (data) {

                                if (typeof data['current_year'] === 'undefined') {
                                    for (j = 0; j < data.length; j++) {
                                        if (data[j]['id'] == batch_id) {
                                            if (lookup_flag == 1) {
                                                $('#eh_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                            
                                            if (lookup_flag == 2) {
                                                $('#eh_rpt_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                            
                                            $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        } else {
                                            if (lookup_flag == 1) {
                                                $('#eh_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                            
                                            if (lookup_flag == 2) {
                                                $('#eh_rpt_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                            $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        }
                                    }
                                } else {


                                    if (lookup_flag == 1) {
                                        $('#eh_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    }
                                    
                                    if (lookup_flag == 2) {
                                        $('#eh_rpt_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    }
                                    $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                                }
                                <?php
                                $access_level = $this->Util_model->check_access_level();
                                $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>                
                                document.getElementById("eh_batch").selectedIndex = "1";
                                document.getElementById("eh_rpt_batch").selectedIndex = "1";
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

    function deferement_load_semesters(year_no, semester_no, lookup_flag) {
        $('#eh_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        $('#eh_exam').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
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

    function load_exams(eh_year, eh_semester, eh_course, eh_batch, selexm) {
        if (eh_course == null)
            eh_course = $('#eh_course').val();

        if (eh_year == null)
            eh_year = $('#eh_year').val();

        if (eh_semester == null)
            eh_semester = $('#eh_semester').val();

        //if (eh_batch == null)
        //eh_batch = $('#eh_batch').val();       
        $.post("<?php echo base_url('exam/load_exams_deferement') ?>", {
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

    function search_students_absented() {
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        
        var subject_attendance = [];
        
        var subject_approve = [];
        
        var check = [];

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
            $.post("<?php echo base_url('exam/load_semester_subjects') ?>", {'batch_id': batch_id},
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

                    $.post("<?php echo base_url('exam/load_student_who_absent_exam') ?>", {
                            'center_id': center_id,
                            'course_id': course_id,
                            'batch_id': batch_id,
                            'semester_no': semester_no,
                            'year_no': year_no,
                            'exam_id': exam_id
                            // 'student_id': exam_id,


                            //'branch':$('#eh_center').val(),
                        },
                        function (data1) {

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
                                    $('#student_absent_tbl_body').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data1[j]['reg_no'] + "</td><td>" + data1[j]['first_name'] + "</td></tr>");
                                    for (x = 0; x < data1[j]['selected_subjects'].length; x++) {
                                        // alert(data1[j]['selected_subjects'][x]['code']);
                                        // selected_subjects.push(data1[j]['selected_subjects'][x]['code']);
                                        selected_subjects.push(data1[j]['selected_subjects'][x]['subject_id']);
                                        
                                        if(data1[j]['selected_subjects'][x]['is_absent'] == 1){
                                            check[data1[j]['selected_subjects'][x]['subject_id']] = "checked disabled";
                                        }
                                        else{
                                            check[data1[j]['selected_subjects'][x]['subject_id']] = "";
                                        }
                                        
                                        var subject = data1[j]['selected_subjects'][x]['subject_id'];
                                        var is_attend = data1[j]['selected_subjects'][x]['is_attend'];
                                        var is_approve = data1[j]['selected_subjects'][x]['subj_apprv'];
                                        
                                        subject_attendance[subject] = is_attend;
                                        subject_approve[subject] = is_approve;
                                    }
                                    
                                    $('#student_absent_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td align="center">${selected_subjects.includes(e) ? ((subject_attendance[e] == 0) ? ((subject_approve[e] > 2) ? "NE" :'<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" '+check[e]+'>') : "Attended") : "Not Applied"}</td>`)
                                        .join(''))
                                        .appendTo($('#student_absent_tbl_body'));
                                
                                
//                                    $('#student_absent_tbl tr:last').append(sem_subject_ids
//                                        .map(e => `<td align="center">${selected_subjects.includes(e) ? '<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" '+check[e]+'>' : "Attended"}</td>`)
//                                        .join(''))
//                                        .appendTo($('#student_absent_tbl_body'));    
                                
                                
                                
                                    $('#student_absent_tbl tr:last').append(
                                        "<td style='width:200px' align='center'>\n\
                                        <select class='form-control' id='eh_defer_" + data1[j]['stu_id'] + "' name='eh_defer_" + data1[j]['stu_id'] + "' onchange='show_textarea(" + data1[j]['stu_id'] + ",this.value)'><option value=''>---Select Option---</option>\n\
										<?php foreach ($deferment as $row): ?><option value='<?php echo $row['absent_defered_id']; ?>'><?php echo $row['deferement']; ?></option><?php endforeach; ?></select><br>\n\
										<textarea style='display: none;' id='eh_other_" + data1[j]['stu_id'] + "' name='eh_other_" + data1[j]['stu_id'] + "'></textarea></td>\n\
									<td align='center'><button type='button' class='btn btn-primary' onclick='deferement_approve(" + data1[j]['semester_exam_id'] + "," + data1[j]['stu_id'] + ");'> Request</button></td>")
                                        .appendTo($('#load_absent_thead'));
                                    selected_subjects = [];
                                }
                                

                            } else {
                                //$('#student_absent_tbl').DataTable();
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
                                

                            }
                        },
                        "json"
                    );

                },
                "json"
            );
        }
    }


    function deferement_approve(semester_exam_id, stu_id) {
        var subjects = [];
        var count = 0;

        $('input.chk_box_' + stu_id + '[type=checkbox]').each(function () {
            
            if(this.checked && !this.disabled){
                // var sThisVal = (this.checked && !this.disabled ? $(this).val() : "");
                var sThisVal = $(this).val();
                subjects.push(sThisVal);  
            }
        });
        
        if(subjects.length == 0){
            funcres = {status: 'fail', message: 'Please select a subject to apply for deferment.'};
            result_notification(funcres);
        }
        else{

            var defer_option_val = $('#eh_defer_' + stu_id).find(":selected").val();
            var defer_option = '';
            if (defer_option_val == 3) {
                defer_option = $('#eh_other_' + stu_id).val();
            } else {
                defer_option = $('#eh_defer_' + stu_id).find(":selected").text();
            }

            var other_reason = $('#eh_other_' + stu_id).val();
  
            if (defer_option_val != "") {
                
                if(defer_option_val == 3 && defer_option == ''){
                    funcres = {status: 'denied', message: 'Please fill the other deferment reason.'};
                    result_notification(funcres);
                }
                else{

                    $.ajax(
                    {
                        url: "<?php echo base_url('exam/deferement_approve') ?>",
                        type: 'POST',
                        async: true,
                        cache: false,
                        dataType: 'json',
                        data: {
                            'stu_id': stu_id,
                            'semester_exam_id': semester_exam_id,
                            'subjects': subjects,
                            'defer_option': defer_option,
                            'other_reason': other_reason

                        },
                        success: function (data) {
                            if (data == 'denied') {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else {
                                //if (data) {
                                    //load_apply_exam_data();
                                    funcres = {status: data['status'], message: data['message']};
                                    result_notification(funcres);
                                    
                                    var row_count = $('#student_absent_tbl tr').length;
 
                                    if (row_count > 0) {
                                        search_students_absented();
                                    }
                                    
                               // } else {
                                   // funcres = {status: data['status'], message: data['message']};
                                   // result_notification(funcres);
                               // }
                            }

                        }
                    });
                }
            } else {
                funcres = {status: 'denied', message: 'Please select a deferement option for selected subject.'};
                result_notification(funcres);
            }
        }
    }
    

    function show_textarea(id, select_id) {
        // alert(select_id);
        // alert(id);

        var aria_id = 'eh_other_' + id;
        if (select_id == 3) {
            $("#" + aria_id).show();
        } else {
            $("#" + aria_id).hide();
        }
    }
    
 
    function show_textarea_rpt(id, select_id) {
        // alert(select_id);
        // alert(id);

        var aria_id = 'eh_other_rpt_' + id;
        if (select_id == 3) {
            $("#" + aria_id).show();
        } else {
            $("#" + aria_id).hide();
        }
    }

    /////////////////////////////////////////////////// Re-correction exam ////////////////////////////////////////////////////////////////////
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
                    
                    load_semester_exam_recorrection($('#req_recorrection_batch').val());
                <?php } ?>
            },
            "json"
        );
    }

    function load_semester_exam_recorrection(batch_id) {
        $('#req_recorrection_exam').find('option').remove().end();
        $('#req_recorrection_exam').append('<option value="">---Select Exam---</option>').val('');
        
        var mrk_batch = $('#req_recorrection_batch').val();
        var mrk_course = $('#req_recorrection_course').val();
        var mrk_year = $('#recorrection_mark_year').val();
        var mrk_semester = $('#recorrection_mark_semester').val();

        $.post("<?php echo base_url('exam/load_semester_exam_recorrection') ?>", {'batch_id': batch_id},
        //$.post("<?php //echo base_url('exam/load_semester_exam_recorrection_apply_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#req_recorrection_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text("["+data[i]['exam_code']+"] "+data[i]['exam_name']));
                }
            },
            "json"
        );
    }

    //to load students to apply recorrection
    function load_recorrection_student_data() {

        var recorectCenter = $('#req_recorrection_centre').val();
        var recorectCourse = $('#req_recorrection_course').val();
        var recorectBatch = $('#req_recorrection_batch').val();  
        var recorectExam = $('#req_recorrection_exam').val();

        var name = "";
        var regNo = "";
        var stu_id = "";

        $('#apply_recorrection_exam_tbl').DataTable().destroy();
        $('#apply_recorrection_exam_tbl').DataTable({
            'ordering': false,
            'lengthMenu': [10, 25, 50, 75, 100],
            "columnDefs": [ {
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
                if (data[0] == 1) {        
                    $( row ).css( "background-color", "#f0f8ff" ); //#f0f8ff //#f9f9f9
                    $('td', row).css('border-right', 0);         	        	
                }
                
                if (data[0] == 2) {        
                    $( row ).css( "background-color", "#f9fae0" );  //#ebf8ca  //#ebfcc1
                    $('td', row).css('border-right', 0);         	        	
                }
            }
        });
        $('#apply_recorrection_exam_tbl').DataTable().clear().draw();

        if(recorectExam == ""){
            funcres = {status:"denied", message:"Select exam before search."};
            result_notification(funcres);  
        }
        else{
            $.post("<?php echo base_url('exam/load_recorrection_student_data_for_recorrection_apply') ?>", {'recorectCenter': recorectCenter, 'recorectCourse': recorectCourse, 'recorectBatch':recorectBatch, 'recorectExam': recorectExam},
                function (data)
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
                           // if(data[i]['subjects'][0].length > 0){
                                $('#apply_recorrection_exam_tbl').DataTable().row.add([                           
                                    1,
                                    "<b>Reg No - "+regNo+"</b>",
                                    "<b>Name - "+name+"</b>",
                                    '',
                                    '',
                                    ''
                                ]).draw(false);  
                            //}
                        }

                        for (var j = 0; j < data[i]['subjects'].length; j++) {
                            var r = 0;
                            for (var k = 0; k < data[i]['subjects'][j].length; k++) {
                                
                                if(data[i]['subjects'][j][k]['recorrection'] == 0){
                                    btn_content = " <button data-toggle='tooltip' title='Apply for Recorrection' id='recorrect_req_"+x+"' onclick='event.preventDefault();add_recorrection_apply(" + stu_id + ", "+data[i]['subjects'][j][k]['exam_id']+", "+data[i]['subjects'][j][k]['subject_id']+", "+x+")' class='btn btn-info btn-md'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Request</button> ";
                                }
                                else{
                                    btn_content = " <button data-toggle='tooltip' title='Already applied for Recorrection' id='recorrect_req_"+x+"' onclick='event.preventDefault();add_recorrection_apply(" + stu_id + ", "+data[i]['subjects'][j][k]['exam_id']+", "+data[i]['subjects'][j][k]['subject_id']+", "+x+")' class='btn btn-info btn-md' style='background-color:#f0ad4e; border-color:#f0ad4e' disabled><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Request</button> ";
                                }
                                
                                if(data[i]['subjects'][j][k]['is_repeat'] == 1){
                                    repeat_status = " - REPEAT";
                                    year_and_sem = " ("+data[i]['subjects'][j][k]['year_no']+" Year /"+data[i]['subjects'][j][k]['semester_no']+" Semester)"
                                    
                                    if(r == 0){
                                        $('#apply_recorrection_exam_tbl').DataTable().row.add([                           
                                            2,
                                            "<b>"+regNo+" - Repeat Subjects</b>",
                                            '',
                                            '',
                                            '',
                                            ''
                                        ]).draw(false);
                                    }
                                    r++;
                                    
                                }
                                else{
                                    repeat_status = "";
                                    year_and_sem = "";
                                }

                                $('#apply_recorrection_exam_tbl').DataTable().row.add([
                                    0,
                                    x,
                                    data[i]['subjects'][j][k]['subject']+" ["+data[i]['subjects'][j][k]['code']+"]"+repeat_status+year_and_sem,
                                    data[i]['subjects'][j][k]['overall_grade'],
                                    data[i]['subjects'][j][k]['result'],
                                    btn_content
                                ]).draw(false);  

                                x++;
                            }
                        } 
                    }
                },
                "json"
            );
        }
    }
    
    
    //Apply students for recorrection
    function add_recorrection_apply(student_id, exam_id, subject_id, btn_id){
       
        $.post("<?php echo base_url('exam/save_recorrection_student_attempt') ?>", {'student_id': student_id, 'exam_id': exam_id, 'subject_id':subject_id},
            function (data)
            {   
                if(data['status'] == "success"){
                    $('#recorrect_req_'+btn_id).attr('disabled', true);
                    funcres = {status:"success", message:"Successfully applied for recorrection."};
                    result_notification(funcres);               
                }
            },
            "json"
        );
    }

    /////////////////////////////////////////////////// END Re-correction exam ////////////////////////////////////////////////////////////////////

    //=================================START Student Request lookup - saumya=============================================================
    
    function load_lookup_year() {

        var course_id = $('#rpt_course').val();
        $('#rpt_year_apply').find('option').remove().end();
        $('#rpt_year_apply').append('<option value="">---Select Year---</option>').val('');

        $.post("<?php echo base_url('Student/load_year_list') ?>", {'selected_course_id': course_id},

            function (data) {
                var year = data['no_of_year'];
                var id = data['id'];

                for (var i = 1; i <= year; i++) {
                    $('#rpt_year_apply').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                }
            },
            "json"
        );
    }

    function load_lookup_semesters(year_no) {
        var sel_year = year_no.split('-')[0].trim();
        var sel_year_id = year_no.split('-')[1].trim();

        $('#rpt_semester').find('option').remove().end();
        $('#rpt_semester').append('<option value="">---Select Semester---</option>').val('');

        $.post("<?php echo base_url('Student/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},

            function (data) {
                //var sem_id = data['id'];
                for (var i = 1; i <= data; i++) {
                    //$('#rpt_semester').append($("<option></option>").attr("value", i+'-'+sem_id).text(i + " Semester"));
                    $('#rpt_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                }
            },
            "json"
        );
    }
    
    //===============================END Student Request lookup - saumya=============================================================


    //var table = $('#postpone_tbl').DataTable();

    function search_post_something(){
//        alert("Do something radio button was checked");
        
        var type = $("input[name='type']:checked").val();
        
        var post_status = "";
          
        var center_id = $('#l_prom_centre').val();
        var course_id = $('#l_course').val();
        var batch_id = $('#l_batch').val();
       
        if (center_id == "") {
            funcres = {status: "denied", message: "Center cannot be empty!"};
            result_notification(funcres);
        } else if (course_id == "") {
            funcres = {status: "denied", message: "Course cannot be empty!"};
            result_notification(funcres);
        } else if (batch_id == "") {
            funcres = {status: "denied", message: "Batch cannot be empty!"};
            result_notification(funcres);
        }  else {
            if(type== "1"){
                $("#div_postpone_tbl").hide();
                $("#div_medical_differ_tbl").hide();
                $("#div_lookup_tbl").show();
                load_applied_data();
            }else if(type == "2"){
                $("#div_lookup_tbl").hide();
                $("#div_medical_differ_tbl").hide();
                $("#div_postpone_tbl").show();
                //y.style.display = "block";
            $.post("<?php echo base_url('exam/search_post_something') ?>", {'center_id': center_id,
                                                                            'course_id': course_id,
                                                                            'batch_id' : batch_id
                                                                                         },
                    function (data) {
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else {
                            $('#postpone_tbl').DataTable().destroy();
                            $('#postpone_tbl').DataTable({
                                'ordering': true,
                                'lengthMenu': [10, 25, 50, 75, 100]
                            });

                            $('#postpone_tbl').DataTable().clear().draw();

                            if (data.length > 0) {




                                $('#print_search_diploma_eligible_students_btn').removeAttr('disabled');
                                $('#postpone_tbl').removeAttr('disabled');
                                for (j = 0; j < data.length; j++) {

                                    number_content = "<td align='center'>" + (j + 1) + "</td>";
                                    
                                    if(data[j]['status'] == 0){
                                        post_status = "Approval Pending";
                                    }
                                    else if(data[j]['status'] == 1){
                                        post_status = "Postpone Approved";
                                    }
                                    else{
                                        post_status = "Postpone Canceled";
                                    }

                                    action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                    $('#postpone_tbl').DataTable().row.add([
                                        number_content,
                                        data[j]['reg_no'],
                                        data[j]['nic_no'],
                                        data[j]['year_id'],
                                        data[j]['semester_id'],
                                        post_status
                                        
                                        
                                        
                                    ]).draw(false);
                                }
                            } else {
                                

                                //$('#bulk_approve').attr('disabled', true);
                            }
                        }
                    },
                    "json"
                    );
                    
                }else{
                $("#div_lookup_tbl").hide();
                $("#div_postpone_tbl").hide();
                $("#div_medical_differ_tbl").show();
                
                $.post("<?php echo base_url('exam/search_differ_something') ?>", {'center_id': center_id,
                                                                                  'course_id': course_id,
                                                                                  'batch_id' : batch_id
                                                                                 },
                    function (data) {
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else {
                            $('#medical_differ_tbl').DataTable().destroy();
                            $('#medical_differ_tbl').DataTable({
                                'ordering': true,
                                'lengthMenu': [10, 25, 50, 75, 100]
                            });

                            $('#medical_differ_tbl').DataTable().clear().draw();

                            if (data.length > 0) {




                                $('#print_search_diploma_eligible_students_btn').removeAttr('disabled');
                                $('#medical_differ_tbl').removeAttr('disabled');
                                for (j = 0; j < data.length; j++) {
                                    var code = '';
                                    for (e = 0; e < data[j]['subjects'].length; e++) {
                                        code += data[j]['subjects'][e]['code'] + " - " + data[j]['subjects'][e]['deferement']+ "<br> ";
//                                        attempts += data[j]['subjects'][e]['no_of_attempts']+ "<br>";
                                    }
                                    number_content = "<td align='center'>" + (j + 1) + "</td>";

                                    action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                    $('#medical_differ_tbl').DataTable().row.add([
                                        number_content,
                                        data[j]['reg_no'],
                                        data[j]['nic_no'],
                                        data[j]['year_no'],
                                        data[j]['semester_no'],
                                        code
                                        
                                        
                                        
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
        }
        

    }
    
    
    function check_student_approved_status(){
    
        $.post("<?php echo base_url('Student/check_student_approved_status') ?>", {},

            function(data) {              
                if(data.length > 0){    
                    for(var r=0; r<data.length; r++){
                        if(data[r]['approved'] == 1){
                            if($('#reqs_ty').val() != ""){
                                $('#submitbtn_save').attr('disabled', false);
                            }
                            else{
                                $('#submitbtn_save').attr('disabled', true);
                                $('#postpone_details').hide();
                                $('#reason_div').hide();
                                $('#date_div').hide();
                                $('#button_div').hide();
                                $('#graduate_div').hide();
                            }
                        }
                        else{
                            $('#submitbtn_save').attr('disabled', true);
                            $('#postpone_details').hide();
                            $('#reason_div').hide();
                            $('#date_div').hide();
                            $('#button_div').hide();
                            $('#graduate_div').hide();
                        }
                    }                   
                }
                else{
                    if($('#reqs_ty').val() != ""){
                        $('#submitbtn_save').attr('disabled', false); 
                    }
                    else{
                        $('#submitbtn_save').attr('disabled', true);
                        $('#postpone_details').hide();
                        $('#reason_div').hide();
                        $('#date_div').hide();
                        $('#button_div').hide();
                        $('#graduate_div').hide();
                    }
                }
            },
            "json"
        );
    }
    
    
    
    function check_post_grad_apply_status(sel_option){
        if(sel_option == 2){
            $('.se-pre-con').fadeIn('slow');
            $('#submitbtn_save').attr('disabled', true);
            $('#postpone_details').hide();
            $('#reason_div').hide();
            $('#date_div').hide();
            $('#button_div').hide();
            $('#graduate_div').show();
            
            var fail_data = [];
            var result_not_released_array = [];
            
            
            $('#apply_graduation_tbl').DataTable().destroy();
            $('#apply_graduation_tbl').DataTable({
                'ordering': false,
                'searching': false,
                'paging': false,
                "columnDefs": [{
                    "targets": [0,1],
                    "visible":false
                },
                {
                    "targets": 3,
                    "className": 'text-center'               
                }],
                "createdRow": function( row, data, dataIndex ) {
                    if (data[0] == 1) {        
                        $( row ).css( "background-color", "#D7D7D7" );
                        //$('td', row).css('border-right', 0);         	        	
                    }
                    
                    if(fail_data.length > 0){
                        for (var r = 0; r < fail_data.length; r++) {
                            if (data[1] == fail_data[r]['subj_id']) {        
                                $( row ).css( "background-color", "#ffb0b0" );     	        	
                            }
                        }
                    }
                    
                    if(result_not_released_array.length > 0){
                        for (var s = 0; s < result_not_released_array.length; s++) {
                            if (data[1] == result_not_released_array[s]['subj_id']) {        
                                $( row ).css( "background-color", "#fffbe9" );     	        	
                            }
                        }
                    }
                }
            });
            $('#apply_graduation_tbl').DataTable().clear().draw();
            
     
            $.post("<?php echo base_url('exam/load_graduation_eligibility') ?>", {},
                function (data) {
                    if(data == null){
                        $('.se-pre-con').fadeOut('slow');
                        $('#graduate_div').hide();
                        funcres = {status: "denied", message: "Still you are not eligible to apply for graduation."};
                        result_notification(funcres);
                    }
                    else if(data == 1){
                        $('.se-pre-con').fadeOut('slow');
                        $('#graduate_label').show();
                        $('#apply_graduation').attr('disabled', true);
                        $('#graduate_label').text("You Have Applied For The Graduation. Cannot Apply Again.").css("color", "#e62626");
                        $('#apply_graduation_tbl').DataTable().clear().draw();
                    }
                    else{
                        
                        $('#graduate_label').show();
                        
                        var prevId = "";
                        var yearId = "";
                        var semId = "";
                        var prevSemId = "";
                        var sgpa = "";
                        var NE_count = 0;
                        //var fail_count = 0;
                        var student_fail_data = [];
                        var fail_status_all = 0;
                        var fail_status = 0;
                        var results_not_released = 0;
                        var stu_fail_training = 0;
                        
                        
                        var fail_result_array = ["E", "D", "D+", "C-", "Fail", "-", "", " ", null];
                        
                        var NE_result_array = ["I(CA)", "I(SE)", "INC", "AB", "DFR", "NE", "N/E"];
                        
                        
                        for (var x = 0; x < data.length; x++) {
                            var fail_count = 0;
                            for (var y = 0; y < data[x]['graduate_data']['exam_mark'].length; y++) {
                               
                                if(jQuery.inArray(data[x]['graduate_data']['exam_mark'][y]['result'], NE_result_array) != -1){
                                    NE_count++;
                                    
                                    fail_data.push({'year_no':data[x]['year'], 'semester_no':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'subj_id':data[x]['graduate_data']['exam_mark'][y]['subject_id']});
                                }
                                
                                if(jQuery.inArray(data[x]['graduate_data']['exam_mark'][y]['result'], fail_result_array) != -1){
                                    fail_count++;
                                    
                                    fail_data.push({'year_no':data[x]['year'], 'semester_no':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'subj_id':data[x]['graduate_data']['exam_mark'][y]['subject_id']});
                                }
                                
                                if(data[x]['graduate_data']['exam_mark'][y]['release_result'] == 0){ //result not released status
                                    results_not_released++;
                                    
                                    result_not_released_array.push({'year_no':data[x]['year'], 'semester_no':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'subj_id':data[x]['graduate_data']['exam_mark'][y]['subject_id']});
                                }
                                else{
                                    if(data[x]['graduate_data']['exam_mark'][y]['is_training_apply'] == 1){ //check training apply subject
                                        if(jQuery.inArray(data[x]['graduate_data']['exam_mark'][y]['result'], fail_result_array) != -1){
                                            stu_fail_training++;
                                            
                                            fail_data.push({'year_no':data[x]['year'], 'semester_no':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'subj_id':data[x]['graduate_data']['exam_mark'][y]['subject_id']});
                                        } 
                                    }
                                }
                            }
                            
                            student_fail_data.push({'year':data[x]['year'], 'semester':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'fail_count':fail_count});
                        }
                        
                        for (var k = 0; k < student_fail_data.length; k++) { 
                            if(student_fail_data[k]['fail_count'] >= 2){
                                fail_status_all = 1;
                            }
                            
                            if(student_fail_data[k]['fail_count'] == 1){
                                if(student_fail_data[k]['sgpa'] < 2.00){
                                    fail_status = 1;
                                }
                            }
                        }
                        
                        if(results_not_released == 0 && stu_fail_training == 0){  //check all results released officially status
                        
                            if((NE_count > 0) || fail_status_all == 1){
                                $('#apply_graduation').attr('disabled', true);
                                $('#graduate_label').text("You are not entitled to request for the graduation.").css("color", "#e62626");
                            }
                            else if(fail_status == 1){
                                //if(fail_data[0]['sgpa'] < 2.00){
                                    $('#apply_graduation').attr('disabled', true);
                                    $('#graduate_label').text("You are not entitled to request for the graduation.").css("color", "#e62626");
    //                            }
    //                            else{
    //                               $('#apply_graduation').attr('disabled', false);
    //                               $('#graduate_label').text("You are eltitled to request for the graduation.").css("color", "#009900");
    //                            }
                            }
                            else{
                                $('#apply_graduation').attr('disabled', false);
                                $('#graduate_label').text("You are entitled to request for the graduation.").css("color", "#009900");
                            }
                        }
                        else{
                            $('#apply_graduation').attr('disabled', true);
                            $('#graduate_label').text("You are not entitled to request for the graduation.").css("color", "#e62626");
                        }

                        for (var i = 0; i < data.length; i++) { 
                            
                            yearId = data[i]['year'];
                            semId = data[i]['semester'];
                            
                            if(data[i]['graduate_data']['gpa'] == null){
                                sgpa = "--";
                            }
                            else{
                                sgpa = data[i]['graduate_data']['gpa'];
                            }
                            
                            if(i > 0){
                                prevId = data[i-1]['year'];
                                prevSemId = data[i-1]['semester'];
                            }

                            if(yearId != prevId){
                                $('#apply_graduation_tbl').DataTable().row.add([ 
                                    "1",
                                    "",
                                    "<b>"+yearId+" Year - "+semId+" Semester</b>",
                                    "<b>SGPA -: "+sgpa+"</b>"
                                ]).draw(false);  
                            }
                            else{
                               if(semId != prevSemId){
                                    $('#apply_graduation_tbl').DataTable().row.add([  
                                        "1",
                                        "",
                                        "<b>"+yearId+" Year - "+semId+" Semester</b>",
                                        "<b>SGPA -: "+sgpa+"</b>"
                                    ]).draw(false);  
                                } 
                            }
                            
                            
                            for (var t = 0; t < data[i]['graduate_data']['exam_mark'].length; t++) {
                                
                                var result = '';
                                if(data[i]['graduate_data']['exam_mark'][t]['release_result'] == 1){
                                    result = data[i]['graduate_data']['exam_mark'][t]['result'];
                                }
                                else{
                                    result = 'Results not released.';
                                }
                                
                                $('#apply_graduation_tbl').DataTable().row.add([
                                    "0",
                                    data[i]['graduate_data']['exam_mark'][t]['subject_id'],
                                    "["+data[i]['graduate_data']['exam_mark'][t]['subject_code']+"] - "+data[i]['graduate_data']['exam_mark'][t]['subject'],
                                    result
                                ]).draw(false);  
                            }
                        }
                        
                        $('.se-pre-con').fadeOut('slow');
                    }
                },
                "json"
            );
        }
        else if(sel_option == 1){
            $('#submitbtn_save').attr('disabled', false);
            $('#postpone_details').show();
            $('#reason_div').show();
            $('#date_div').show();
            $('#button_div').show();
            $('#graduate_div').hide();
        }
        else{
            $('#submitbtn_save').attr('disabled', true);
            $('#postpone_details').hide();
            $('#reason_div').hide();
            $('#date_div').hide();
            $('#button_div').hide();
            $('#graduate_div').hide();
        }
    }
    
    
    function apply_graduation_request(){
        
        $('.se-pre-con').fadeIn('slow');
    
        $.post("<?php echo base_url('exam/save_graduation_request') ?>", {},
            function (data) {
                if (data == 'denied') {
                    $('.se-pre-con').fadeOut('slow');
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    $('.se-pre-con').fadeOut('slow');
                    funcres = {status:data['status'], message:data['message']};
                    result_notification(funcres); 
                    
                    if(data['status'] == "success" || data['status'] == "sent"){
                       $('#apply_graduation').attr('disabled', true);
                       $('#graduate_label').text("You Have Applied For The Graduation. Cannot Apply Again.").css("color", "#e62626");
                       $('#apply_graduation_tbl').DataTable().clear().draw();
                    }
                    else{
                       $('#apply_graduation').attr('disabled', false); 
                    }
                }
            },
            "json"
        );
    }
    
    
    
    
    
    
    function reset_postpone(){
        $('#reqs_ty').val("");
        $('#center_id').val("");
        $('#course_id').val("");
        $('#l_Bcode').val("");
        $('#l_no_year').val("");
        $('#l_no_semester').val("");
        $('#resn').val("");
        $('#nxt').val("");
        $('#postpone_details').hide();
        $('#reason_div').hide();
        $('#date_div').hide(); 
        $('#button_div').hide();
        $('#graduate_div').hide();
    }
    
    
    function get_exam_list(){
   
        var exam_type = $("input[name='exm_type']:checked").val();
        
        if(exam_type == "C"){
            load_exams(null, null, null, null, null);
        }
        else{
            load_exams_repeat_deferment();
        }
    }
    
    
    function load_exams_repeat_deferment() {

        $.post("<?php echo base_url('exam/load_exams_repeat_deferment') ?>", {
                'batch_id': $('#eh_rpt_batch').val(),
                'year': $('#eh_rpt_year').val().split('-')[0].trim(),
                'semester': $('#eh_rpt_semester').val(),
                'course': $('#eh_rpt_course').val(),
                'center': $('#eh_rpt_center').val() 
            },
            function (data) {
                $('#eh_rpt_exam').empty();
                $('#eh_rpt_exam').find('option').remove().end().append("<option value=''>---Select Exam--</option>");
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            $('#eh_rpt_exam').append("<option value='" + data[i]['exam_id'] + "'>" + data[i]['exam_code'] + " - " + data[i]['exam_name'] + "</option>");
                        }
                    }
                }
            },
            "json"
        );
    }
    
    
    function load_deferement_rpt_years() {
        var cour_id = $('#eh_rpt_course').val();
        
        $('#eh_rpt_year').empty();
        $('#eh_rpt_year').find('option').remove().end().append("<option value=''>---Select year--</option>");
        
        $('#eh_rpt_semester').empty();
        $('#eh_rpt_semester').find('option').remove().end().append("<option value=''>---Select Semester--</option>");
        
        $('#eh_rpt_exam').empty();
        $('#eh_rpt_exam').find('option').remove().end().append("<option value=''>---Select Exam--</option>");
               
        $.post("<?php echo base_url('Student/load_year_list_for_request') ?>", {'selected_course_id': cour_id},
            function (data) {
                var year = data['no_of_year'];
                var id = data['id'];

                $('#eh_rpt_year').find('option').remove().end();
                $('#eh_rpt_year').append('<option value="">---Select Year---</option>').val('');

                for (var i = 1; i <= year; i++) {
                    $('#eh_rpt_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                }
            },
            "json"
        );
    }
    
    
    function load_deferement_rpt_semesters(year_no) {
        var sel_year = year_no.split('-')[0].trim();
        var sel_year_id = year_no.split('-')[1].trim();

        $('#eh_rpt_semester').find('option').remove().end();
        $('#eh_rpt_semester').append('<option value="">---Select Semester---</option>').val('');
        
        $('#eh_rpt_exam').find('option').remove().end();
        $('#eh_rpt_exam').append('<option value="">---Select Semester---</option>').val('');

        $.post("<?php echo base_url('Student/load_semesters_from_year') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
            
            function (data) {
                //var sem_id = data['id'];
                //for (var i = 1; i <= data; i++) {
                for (var i = 1; i <= data; i++) {
                    //$('#rpt_semester').append($("<option></option>").attr("value", i+'-'+sem_id).text(i + " Semester"));
                    $('#eh_rpt_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

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
        
        $('#eh_rpt_center').val("");
        $('#eh_rpt_course').val("");
        $('#eh_rpt_batch').val("");
        $('#eh_rpt_year').val("");
        $('#eh_rpt_semester').val("");
        $('#eh_rpt_exam').val("");
        
        
        if(sel_id == "C"){
            $('#current_deferement').show();
            $('#repeat_deferement').hide();
            $('#search_students').show();
            $('#search_students_repeat').hide();
        }
        else{
            $('#current_deferement').hide();
            $('#repeat_deferement').show();
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
    
    function reset_exam(){
        $('#eh_exam').find('option').remove().end().append("<option value=''>---Select Exam--</option>");
        $('#eh_year').val('');
        $('#eh_semester').val('');
    }
    
    
    function reset_exam_rpt(){
        $('#eh_rpt_exam').find('option').remove().end().append("<option value=''>---Select Exam--</option>");
        $('#eh_rpt_year').val('');
        $('#eh_rpt_semester').val('');
    }
    
    function search_students_absented_repeat(){
        var res = [];
        var sem_subject_ids = [];
        var sem_subject_names = [];
        var sem_subject_code = [];
        var sem_subject_types = [];
        var selected_subjects = [];
        
        var subj_apprv = [];
        
        var check = [];

        var center_id = $('#eh_rpt_center').val();
        var course_id = $('#eh_rpt_course').val();
        var batch_id = $('#eh_rpt_batch').val();
        var year_no = $('#eh_rpt_year').val();
        var semester_no = $('#eh_rpt_semester').val();
        var exam_id = $('#eh_rpt_exam').val();
        if (batch_id == '' || exam_id == '') {
            res['status'] = 'denied';
            res['message'] = 'Please Select relevent batch and Exam !';
            result_notification(res);
        } else {
            $.post("<?php echo base_url('exam/load_semester_subjects_deferement_repeat') ?>", {'batch_id': batch_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
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

                    $.post("<?php echo base_url('exam/load_student_who_absent_exam_repeat') ?>", {
                            'center_id': center_id,
                            'course_id': course_id,
                            'batch_id': batch_id,
                            'semester_no': semester_no,
                            'year_no': year_no,
                            'exam_id': exam_id
                            // 'student_id': exam_id,


                            //'branch':$('#eh_center').val(),
                        },
                        function (data1) {

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
                                    $('#student_absent_tbl_body').append("<tr " + (j + 1) + "'><td>" + (j + 1) + "</td><td>" + data1[j]['reg_no'] + "</td><td>" + data1[j]['first_name'] + "</td></tr>");
                                    for (x = 0; x < data1[j]['selected_subjects'].length; x++) {
                                        // alert(data1[j]['selected_subjects'][x]['code']);
                                        // selected_subjects.push(data1[j]['selected_subjects'][x]['code']);
                                        selected_subjects.push(data1[j]['selected_subjects'][x]['subject_id']);
                                        
                                        if(data1[j]['selected_subjects'][x]['is_absent'] == 1){
                                            check[data1[j]['selected_subjects'][x]['subject_id']] = "checked disabled";
                                        }
                                        else{
                                            check[data1[j]['selected_subjects'][x]['subject_id']] = "";
                                        }
                                        
                                        var subject = data1[j]['selected_subjects'][x]['subject_id'];
                                        var is_approve = data1[j]['selected_subjects'][x]['rpt_subj_apprv'];
                                        subj_apprv[subject] = is_approve;
                                        
                                    }
                                    $('#student_absent_tbl tr:last').append(sem_subject_ids
                                        .map(e => `<td align="center">${selected_subjects.includes(e) ? ((subj_apprv[e] == 3) ? "NE" :'<input type="checkbox" class="chk_box_' + data1[j]['stu_id'] + '" name="chk_box' + data1[j]['stu_id'] + '_' + data1[j]['subject_id'] + '" value="' + e + '" '+check[e]+'>') : "Attended"}</td>`)
                                        .join(''))
                                        .appendTo($('#student_absent_tbl_body'));
                                    $('#student_absent_tbl tr:last').append(
                                        "<td style='width:200px' align='center'>\n\
                                        <select class='form-control' id='eh_defer_rpt_" + data1[j]['stu_id'] + "' name='eh_defer_rpt_" + data1[j]['stu_id'] + "' onchange='show_textarea_rpt(" + data1[j]['stu_id'] + ",this.value)'><option value=''>---Select Option---</option>\n\
										<?php foreach ($deferment as $row): ?><option value='<?php echo $row['absent_defered_id']; ?>'><?php echo $row['deferement']; ?></option><?php endforeach; ?></select><br>\n\
										<textarea style='display: none;' id='eh_other_rpt_" + data1[j]['stu_id'] + "' name='eh_other_rpt_" + data1[j]['stu_id'] + "'></textarea></td>\n\
									<td align='center'><button type='button' class='btn btn-primary' onclick='deferement_approve_repeat(" + data1[j]['semester_exam_id_rpt'] + "," + data1[j]['stu_id'] + ");'> Request</button></td>")
                                        .appendTo($('#load_absent_thead'));
                                    selected_subjects = [];
                                }
                                

                            } else {
                                //$('#student_absent_tbl').DataTable();
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
                                

                            }
                        },
                        "json"
                    );

                },
                "json"
            );
        }
    }
    
    
    
    function deferement_approve_repeat(semester_exam_id, stu_id){
        
        var subjects_rpt = [];

        $('input.chk_box_' + stu_id + '[type=checkbox]').each(function () {
            
            if(this.checked && !this.disabled){
                // var sThisVal = (this.checked && !this.disabled ? $(this).val() : "");
                var sThisVal = $(this).val();
                subjects_rpt.push(sThisVal);  
            }
        });
        
        if(subjects_rpt.length == 0){
            funcres = {status: 'fail', message: 'Please select a subject to apply for deferment.'};
            result_notification(funcres);
        }
        else{

            var defer_option_val = $('#eh_defer_rpt_' + stu_id).find(":selected").val();
            var defer_option = '';
            if (defer_option_val == 3) {
                defer_option = $('#eh_other_rpt_' + stu_id).val();
            } else {
                defer_option = $('#eh_defer_rpt_' + stu_id).find(":selected").text();
            }

            var other_reason = $('#eh_other_rpt_' + stu_id).val();
  
            if (defer_option_val != "") {
                
                if(defer_option_val == 3 && defer_option == ''){
                    funcres = {status: 'denied', message: 'Please fill the other deferment reason.'};
                    result_notification(funcres);
                }
                else{

                    $.ajax(
                    {
                        url: "<?php echo base_url('exam/deferement_approve_repeat') ?>",
                        type: 'POST',
                        async: true,
                        cache: false,
                        dataType: 'json',
                        data: {
                            'stu_id': stu_id,
                            'semester_exam_id': semester_exam_id,
                            'subjects': subjects_rpt,
                            'defer_option': defer_option,
                            'other_reason': other_reason

                        },
                        success: function (data) {
                            if (data == 'denied') {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else {
                                //if (data) {
                                    //load_apply_exam_data();
                                    funcres = {status: data['status'], message: data['message']};
                                    result_notification(funcres);
                                    
                                    var row_count = $('#student_absent_tbl tr').length;
 
                                    if (row_count > 0) {
                                        search_students_absented_repeat();
                                    }
                                    
                               // } else {
                                   // funcres = {status: data['status'], message: data['message']};
                                   // result_notification(funcres);
                               // }
                            }

                        }
                    });
                }
            } else {
                funcres = {status: 'denied', message: 'Please select a deferement option for selected subject.'};
                result_notification(funcres);
            }
        }
    }

    

</script>

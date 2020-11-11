<style>
    .dialog-confirm.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info {
        color: #fff;
        background: #42b8dd;
        border-color: #42b8dd;
    }

    #common {
        display: block;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->

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

<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Non-Academic</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Approvals</li>
            <li><i class="fa fa-users"></i>Non-Academic</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Non-Academic
            </div>
            <hr>
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php if($user_type == 'admin' || $user_type == 'dir') {?>
                                    <li role="presentation" class="active"><a class="fa fa-user" href="#mahapola_apprv_tab"
                                                                              aria-controls="mahapola_apprv_tab" role="tab"
                                                                              data-toggle="tab" onclick="ndispc()"> Mahapola
                                            Approval</a></li>
                                    <li role="presentation"><a class="fa fa-university" href="#mahapola_update_tab"
                                                               aria-controls="mahapola_update_tab" role="tab"
                                                               data-toggle="tab" onclick="dispc()"> Mahapola Update List</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($user_type == 'admin' || $user_type == 'hod') {?>
                                    <li role="presentation" id="hod_first_tab"><a class="fa fa-user" href="#exam_approval_tab"
                                                               aria-controls="exam_approval_tab" role="tab"
                                                               data-toggle="tab" onclick="dispc()">Student Exam Request</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($user_type == 'admin' || $user_type == 'dir') {?>
                                    <li role="presentation"><a class="fa fa-user" href="#defined_exam_approval_tab"
                                                               aria-controls="defined_exam_approval_tab" role="tab"
                                                               data-toggle="tab" onclick="dispc()"> Defined Exam
                                            Approval</a></li>
                                    <?php } ?>
                                    <?php if($user_type == 'admin' || $user_type == 'hod') {?>
                                    <li role="presentation"><a class="fa fa-user" href="#exam_request_repeat"
                                                               aria-controls="exam_request_repeat" role="tab" 
                                                               data-toggle="tab" onclick="dispc()"> Repeat Students</a></li>
                                    <?php } ?>
                                     <?php if($user_type == 'admin' || $user_type == 'dir') {?>                           
                                    <li role="presentation">
                                            <a class="fa fa-university" href="#postpone_tab"
                                        aria-controls="postpone_tab" role="tab" 
                                        data-toggle="tab" onclick="dispc()">Postpone / Graduation Request</a>
                                    </li>

                                    <li role="presentation">
                                            <a class="fa fa-book" href="#timetable_tab"
                                        aria-controls="timetable_tab" role="tab" 
                                        data-toggle="tab" onclick="dispc()">Timetable</a>
                                    </li>
                                     <?php } ?>
                                </ul>
                            
                            <div class="tab-content"><br/><br/>
                                <div id="common" class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11">
                                        <div class="form-group col-md-5">
                                            <div class="form-group">
                                                <input type="hidden" id="user_level" name="user_level"
                                                       value="<?php echo $ug_level ?>">
                                                <label for="center" class="col-md-3 control-label">Center : </label>
                                                <div class="col-md-7">
                                                    <?php
                                                    global $branchdrop;
                                                    global $selectedbr;

                                                    if (isset($stu_data)) {
                                                        $selectedbr = $stu_data['center_id'];
                                                    }

                                                    $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value,null,this);"';

                                                    echo form_dropdown('center_id', $branchdrop, $selectedbr, $extraattrs);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Course
                                                    Code:</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="course_id" name="course_id"
                                                            value="">
                                                        <option value="0">---Select Course Code---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                            <div class="col-md-2">
                                                                                    <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_mahapola_student_details('reject');">Search</button>
                                                                                    </div>-->
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane active" id="mahapola_apprv_tab">

                                    <div class="row">
                                        <label for="center" style="margin-left: 11%;" class="col-md-1 control-label">Mahapola Year:</label>
                                        <div class="col-md-3" style="margin-left: 0.5%;">
                                            <select class="form-control" id="mp_app_year" name="mp_app_year" onchange="" data-validation="required">
                                                <option value="all">All</option>
                                                <?php
                                                foreach ($mpyear_list as $yr):

                                                    if ($yr['year'] != 0) {
                                                        ?>
                                                        <option value="<?php echo $yr['year']; ?>">
                                                            <?php echo $yr['year']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="margin-left: 80%;">
                                            <button type="button" class="btn btn-primary btn-md" name="search"
                                                    onclick="search_mahapola_students();">Search
                                            </button>
                                        </div>
                                    </div>

                                    <table id="director_apprv"
                                           class="table table-striped table-bordered dt-responsive nowrap"
                                           style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>NIC No</th>
                                                <th>Need Index</th>
                                                <th class="hidden"></th>
                                                <th class="hidden"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
                                            //$i = 1;
                                            //if (!empty($result_array)) {
                                            //    foreach ($result_array as $va) {
                                            ?>

                                        <!--                                                    <tr>
                                                        <td align="center"> <?php //echo $i                                 ?></td>
                                                        <td> <?php //echo $va['reg_no']                                 ?></td>
                                                        <td> <?php //echo $va['first_name'] //. " " . $va['last_name']                                 ?></td>
                                                        <td> <?php //echo $va['nic_no']                                 ?></td>
                                                        <td> <?php //echo $va['need_index']                                 ?></td>-->
                                        <!--                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php //echo $va['stu_id']                                 ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_mahapola_apprv_status('<?php //print_r($va["stu_id"])                                 ?>', '1', '<?php //print_r($va["reg_no"])                                 ?>', '<?php //print_r($va["nic_no"])                                 ?>', '<?php //print_r($va["center_id"])                                 ?>','<?php //print_r($va["mahapola_email_status"])                                 ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                            <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_stu_mahapola_apprv_status('<?php //print_r($va["stu_id"])                                 ?>', '3', '<?php //print_r($va["reg_no"])                                 ?>', '<?php //print_r($va["nic_no"])                                 ?>', '<?php //print_r($va["center_id"])                                 ?>','<?php //print_r($va["mahapola_email_status"])                                 ?>')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>-->
                                            <!--</tr>-->

                                            <?php
                                            //$i++;
                                            //}
                                            //}
                                            ?>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-2" style="margin-left: 85%; margin-top: 2%;">
                                            <button type="button" class="btn btn-danger btn-md" id="bulk_approve"
                                                    name="bulk_approve" onclick="bulk_approve_students();">Bulk Approve
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <!--<div role="tabpanel" class="tab-pane" id="rejected_list_tab">
                                    <div class="row">
                                        <div class="col-md-2" style="margin-left: 80%; margin-top: -5%;">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_mahapola_student_details('reject');">Search</button>
                                        </div>
                                    </div>
                                    <table id="reject_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rej_tbl_body">
                                <?php /*                                            //$x = 1;
                                  //if (!empty($reject_array)) {
                                  //foreach ($reject_array as $rj) {
                                 */ ?>

                                                    <tr>
                                                        <td align="center"> <?php /* //echo $x */ ?></td>
                                                        <td> <?php /* //echo $rj['reg_no'] */ ?></td>
                                                        <td> <?php /* //echo $rj['first_name'] //. " " . $rj['last_name'] */ ?></td>
                                                        <td> <?php /* //echo $rj['nic_no'] */ ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php /* echo $rj['stu_id'] */ ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_mahapola_apprv_status('<?php /* print_r($rj["stu_id"]) */ ?>', '1', '<?php /* print_r($rj["reg_no"]) */ ?>', '<?php /* print_r($rj["nic_no"]) */ ?>', '<?php /* print_r($rj["center_id"]) */ ?>','<?php /* print_r($va["mahapola_email_status"]) */ ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                                                            <button title="Reject" onclick="event.preventDefault();update_stu_apprv_status('<?php /* //print_r($rj["stu_id"]) */ ?>', '3')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>
                                                    </tr>

                                <?php /*                                                    //$x++;
                                  //}
                                  // }
                                 */ ?>
                                        </tbody>
                                    </table>
                                </div>-->
                                <div role="tabpanel" class="tab-pane" id="mahapola_update_tab">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="center" class="col-md-3 control-label">Eligibility Update Year:</label>
                                                <div class="col-md-4">
                                                    <select class="form-control" id="mpyear" name="mpyear" onchange="mahapola_year_check();" data-validation="required">
                                                        <option value="">---Select Year---</option>
                                                        <?php
                                                        foreach ($mpyear_list as $yr):

                                                            if ($yr['year'] != 0) {
                                                                ?>
                                                                <option value="<?php echo $yr['year']; ?>">
                                                                    <?php echo $yr['year']; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        endforeach;
                                                        ?>
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <span style="font-weight: bold">Please click below button to process the Mahapola Eligible list.</span>
                                    <br><br>
                                    <?php if (($br_code == "001" && $br_name == "Head Office" && $ug_level == 2) || $ug_level == 1) { ?>
                                        <button type="button" class="btn btn-primary btn-md" name="mahapola_update"
                                                id="mahapola_update" onclick="update_mahapola_eligible_status();">Update Mahapola Status</button>
                                            <?php } ?>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="exam_approval_tab">

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
                                        <!--<div class="col-md-4">
                            <div class="form-group">
                                <label for="faculty" class="col-md-3 control-label">Faculty</label>
                                <div class="col-md-9">
                                        <?php
                                        //global $facultydrop;
                                        //global $selectedfac;
                                        //$facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 0)"';
                                        //echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs);
                                        ?>
                                </div>
                            </div>
                        </div>-->
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
                                                    <select id="batch" class="form-control" style="width:100%"
                                                            name="batch"
                                                            onchange="" data-validation="required"
                                                            data-validation-error-msg-required="Field can not be empty">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <div class="form-group">
                                                        <div class="col-md-offset-3 col-md-11">
                                                                <button type='button' class='btn btn-info'
                                                                                onclick='event.preventDefault(); load_apply_exam_data();'>
                                                                        Search Current Students
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
                                    <div class="row">
                                        <div class="col-md-offset-10 col-md-12">
                                            <button type='button' class='btn btn-danger' id="exam_request_bulk_approval_btn"
                                                        onclick='event.preventDefault(); exam_request_bulk_approval();' disabled>
                                                        Bulk Approval
                                                </button>
                                                <i id="bulkSpinner" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px;"></i>
                                        </div>
                                       </div>
                                    <table class="table table-bordered" id="apply_exam_req">
                                        <thead id="load_thead">
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Reg No</th>
                                                <th>Student Name</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="load_student">
<!--                                            <tr>
                                                <td colspan="10" align="center">No records to show.</td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-2" style="margin-left: 85%; margin-top: 2%;">
                                            <button type="button" class="btn btn-danger btn-md hidden" id="bulk_approve"
                                                    name="bulk_approve" onclick="bulk_approve_students();">Bulk Approve
                                            </button>
                                        </div>
                                    </div>

                                </div>


                                <div role="tabpanel" class="tab-pane" id="defined_exam_approval_tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a class="fa fa-user"
                                                                                  href="#approval_defined_tab"
                                                                                  accesskey=""
                                                                                  aria-controls="approval_defined_tab"
                                                                                  role="tab" data-toggle="tab">
                                                Approvals</a></li>

                                        <!--                                    <li role="presentation"><a class="fa fa-university" href="#rejected_defined_tab"
                                                                                                           aria-controls="rejected_defined_tab" role="tab"
                                                                                                           data-toggle="tab" onclick="dispc()"> Rejected Approvals</a>
                                                                                </li>-->
                                    </ul>

                                    <div role="tabpanel" class="tab-pane active" id="approval_defined_tab">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="course" class="col-md-3 control-label">Course</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="defined_exam_course"
                                                                name="defined_exam_course" onchange="load_year_list();">
                                                            <option>---Select Course---</option>
                                                            <?php
                                                            for ($sub = 0; $sub < sizeof($courses); $sub++) {
                                                                echo '<option value="' . $courses[$sub]['id'] . '">' . $courses[$sub]['course_code'].' - '.$courses[$sub]['course_name'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--                                        <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label for="batch" class="col-md-3 control-label">Batch</label>
                                                                                            <div class="col-md-7">
                                                                                                <select id="defined_batch" class="form-control" style="width:100%" name="defined_batch" onchange="load_year_list()" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_year_list();">
                                                                                                    <option value="">---Select Batch---</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>-->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="batch" class="col-md-3 control-label">Year</label>
                                                    <div class="col-md-7">
                                                        <select id="defined_year" class="form-control"
                                                                style="width:100%" name="defined_year"
                                                                data-validation="required"
                                                                data-validation-error-msg-required="Field can not be empty"
                                                                onchange="load_semesters(this.value);">
                                                            <option value="">Select Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="batch" class="col-md-3 control-label">Semester</label>
                                                    <div class="col-md-7">
                                                        <select id="defined_semester" class="form-control"
                                                                style="width:100%" name="defined_semester"
                                                                data-validation="required"
                                                                data-validation-error-msg-required="Field can not be empty"
                                                                <!--onchange="load_exam(this.value);"-->>
                                                                <option value="">Select Semester</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--                                        <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label for="batch" class="col-md-3 control-label">Exam</label>
                                                                                            <div class="col-md-7">
                                                                                                <select id="defined_exam" class="form-control" style="width:100%" name="defined_exam" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                                                                                    <option value="">Select Exam</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>-->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-7">
                                                    <button type='button' class='btn btn-primary'
                                                            onclick='event.preventDefault(); load_exam_data();'>
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="row"></div>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <table class="table table-bordered" id="defined_exam_tbl">
                                            <thead id="load_thead">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Exam Name</th>
                                                    <th>Course</th>
                                                    <th>Batch</th>
                                                    <th>Year</th>
                                                    <th>Semester</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="defined_exam_tbl_body">

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <div role="tabpanel" class="tab-pane" id="exam_request_repeat">
                                    <div class="panel">
                                        <div class="panel-body">

                                            <form class="form-horizontal" role="form" method="post" action=""
                                                  id="rpt_request_approve"
                                                  name="rpt_request_approve" autocomplete="off">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="center" class="col-md-3 control-label"> Center</label>
                                                            <div class="col-md-7">
                                                                <?php
                                                                global $branchdrop;
                                                                global $selectedbr;
                                                                $extraattrs = 'id="rpt_exam_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                                                                echo form_dropdown('rpt_exam_centre', $branchdrop, $selectedbr, $extraattrs);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="batch" class="col-md-3 control-label">Course</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" id="rpt_exam_course"
                                                                        name="rpt_exam_course"
                                                                        onchange="load_semester_batches(this.value)"
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
                                                            <label for="Batch" class="col-md-3 control-label">Batch:</label>
                                                            <div class="col-md-9">

                                                                <select id="rpt_exam_batch" type="text" class="form-control" name="rpt_exam_batch"
                                                                        onchange="rpt_load_year()"
                                                                        data-validation="required"
                                                                        data-validation-error-msg-required="Field can not be empty">
                                                                    <option value="0">---Select Batch---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Year" class="col-md-3 control-label">Year:</label>
                                                            <div class="col-md-9">

                                                                <select type="text" class="form-control" id="rpt_exam_no_year"
                                                                        name="rpt_exam_no_year" required
                                                                        placeholder="field cannot be empty"
                                                                        data-validation="required"
                                                                        data-validation-error-msg-required="Field can not be empty"
                                                                        value="" onchange="rpt_exam_load_semesters(this.value)">
                                                                    <option value="0">---Select Year---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Semester" class="col-md-3 control-label">Semester:</label>
                                                            <div class="col-md-9">
                                                                <select type="text" class="form-control" id="rpt_exam_no_semester"
                                                                        name="rpt_exam_no_semester" required
                                                                        placeholder="field cannot be empty"
                                                                        data-validation="required"
                                                                        data-validation-error-msg-required="Field can not be empty"
                                                                        value="">
                                                                    <option value="0">---Select Semester---</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="col-md-offset-11 col-md-11">
                                                                <button type='button' class='btn btn-info'
                                                                        onclick='event.preventDefault(); rpt_exam_load_student()'>
                                                                    Search Repeat Students
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                <br/>
                                                <br/>
                                                <table class="table table-bordered" id="rpt_apply_exam">
                                                    <thead id="rpt_load_thead">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Reg No</th>
                                                            <th>Student Name</th>
                                                            <th>Subject</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="rpt_load_student">
                                                        <tr>
                                                            <td colspan="10" align="center">No records to show.</td>
                                                        </tr>
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
                                                                            onchange="rpt_load_semester_exam()"
                                                                            data-validation="required"
                                                                            data-validation-error-msg-required="Field can not be empty">
                                                                        <option value=""></option>
                                                                        <!--rpt_year_list();-->
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
                                                                            onchange="" disabled>
                                                                        <!--<option value=""></option>-->
                                                                        <!--rpt_load_semesters(this.value);-->
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
                                                                            onchange=""
                                                                            data-validation="required"
                                                                            data-validation-error-msg-required="Field can not be empty" disabled>
                                                                        <!--<option value=""></option>-->
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

                                                    <button type='button' class='btn btn-info'
                                                            onclick='event.preventDefault(); rpt_approve_student()'>
                                                        Approve
                                                    </button>
                                                    <button type='button' class='btn btn-info'
                                                            onclick='event.preventDefault(); rpt_reject_student()' style='display:none;'>
                                                        Reject
                                                    </button>

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                             
                                 <div role="tabpanel" class="tab-pane" id="timetable_tab">
                                    <div class="panel">
                                        
                                        <br>
                                        <div class="container">
                                            <ul class="nav nav-tabs">
                                                <!--<li role="presentation" class="active"><a id="#lectures_timetable_tab" href="#lectures_timetable_tab" aria-controls="lectures_timetable_tab" role="tab" data-toggle="tab">Lectures Time Table</a></li>-->
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
                                                                        echo "<td>" . $rtbl['exam_name'] . "</td>";
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
                                </div>  
                                
                                <div role="tabpanel" class="tab-pane" id="postpone_tab">
                                <form class="form-horizontal" role="form" method="post" action="" id="postpone_form" name="postpone_form"
                                      autocomplete="off">
                                    <div class="panel">
                                        
                                        <div class="panel-body">
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="center" class="col-md-3 control-label"> Center</label>
                                                            <div class="col-md-7">
                                                                <?php
                                                                global $branchdrop;
                                                                global $selectedbr;
                                                                $extraattrs = 'id="post_center" class="form-control" style="width:100%" onchange="get_courses(this.value, 1, null, 0)"';
                                                                echo form_dropdown('post_center', $branchdrop, $selectedbr, $extraattrs);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="batch" class="col-md-3 control-label">Course</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" id="post_course"
                                                                        name="post_course"
                                                                        onchange="load_semester_batches_postpone(this.value)"
                                                                        data-validation="required"
                                                                        data-validation-error-msg-required="Field can not be empty">
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="batch" class="col-md-3 control-label">Batch</label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control" id="post_batch"
                                                                            name="post_batch"
                                                                            onchange=""
                                                                            data-validation="required"
                                                                            data-validation-error-msg-required="Field can not be empty">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            <div class="row">
                                                <br/><br/>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-md-3 control-label">Search Type:</label>
                                                        <div class="col-md-9">
                                                            <input type="radio" name="type" class="col-md-1" id="postpone_type" value="postpone" checked="checked" onchange=";">
                                                            <label class="col-md-1 control-label">Postpone</label>

                                                            <input type="radio" name="type" class="col-md-1" id="graduation_type" value="graduation" onchange="">
                                                            <label class="col-md-1 control-label">Graduation</label>
                                                        </div>
                                                        <!-- <div class="col-md-12">
                                                        <button style="float: right; margin-right: -109%;" class="btn btn-success" id="print_course_wise" name="print_course_wise" onclick="load_pdf_course_wise();">Print Report</button>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-offset-10 col-md-3">
                                                    <div class="form-group">
                                                        <button type='button' class='btn btn-primary'
                                                            onclick='load_type_wise()'>
                                                        Search
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/><br/>
                                            
                                            <div id="graduation_tbl_div" style="display: none;">
                                                <table class="table table-bordered display nowrap" id="graduation_tbl" style="width:100%">
                                                    <thead id="load_thead">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Reg No</th>
                                                        <th>Student Name</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="graduation_body">
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div id="postpone_tbl_div" style="display: none;">
                                                <table class="table table-bordered display nowrap" id="postpone_tbl" style="width:100%">
                                                    <thead id="load_thead">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Reg No</th>
                                                        <th>Student Name</th>
                                                        <th>Year</th>
                                                        <th>Semester</th>
                                                        <th>Reason</th>
                                                        <th>Next Join</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="postpone_body">
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="modal fade" id="gpaModal" role="dialog">
                                            <div class="modal-dialog" style="width: 75%;">
                                                 Modal content
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><b>Academic Details</b> </h4><br>
                                                    </div>
                                                    <div class="modal-body">                                                                                                               
                                                        <table width="75%" class="table table-bordered" id="apply_graduation_tbl" style="overflow-x: auto; max-height: 200px; overflow-y: auto; -ms-overflow-style: -ms-autohiding-scrollbar;">  <!--display: block;-->
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
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
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
                            </div>
                                
                                
                               
                                
                            </div>
                             
                        </div>
                    </div>
                    <!-- ------------------- -->
                </div>
                <!--                </br>
                <div class="col-xs-12 text-right">
                    <button onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve All</button>
                    <button onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject All</button>
                </div>-->
            </div>
        </div>
    </div>
</div>
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

<!-- Modal -->
    <div class="modal fade" id="exam_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exam Request Rejection Reason</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="rej_sem_exam_id">
                    <input type="hidden" id="rej_stu_id">
                    <input type="hidden" id="rej_is_approval">
                    <br>
                    <div id="rejected_reason_div">
                    </div>
                    <div id="lbl_error" style="display: none">
                       <label style="color: red">Type a valid reason to proceed !</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="rejectreasonmodel"
                            onclick="event.preventDefault();update_exam_rej_status_db()" id="reject_model_btn">
                        Reject
                    </button>
                </div>
            </div>
        </div>
    </div>
<div id="dialog-confirm"></div>
<script type="text/javascript">

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        
    });

    $(document).ready(function () {

        $('#exam_request_bulk_approval_btn').prop("disabled", true);
        $('#bulkSpinner').hide();
        
        var user_type = '<?php echo $user_type ?>';
        if(user_type == 'hod'){
            $('#hod_first_tab' ).addClass('active');
            $('#exam_approval_tab').addClass('active');
            $('#mahapola_apprv_tab').removeClass('active');
            dispc();
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
        
        $('#apply_exam_req').DataTable({
            "ordering": false,
            "searching": false,
            "bLengthChange" : false,
            "bInfo" : false,
            "bPaginate": false
        });


        $('#exam_time_reject_tbl').DataTable({
            "ordering": false,
            "lengthMenu": [10, 25, 50, 75, 100],
            "columnDefs": [{
                "targets": 4,
                "orderable": false
            }]
        });
        
        $('#apply_graduation_tbl').DataTable({
            'ordering': false,
            'searching': false,
            'paging': false
        });
        
        $('#text_load').hide();

        $('#mahapola_update').attr('disabled', true);

        $('#bulk_approve').attr('disabled', true);

        $('#director_apprv').DataTable({
            'ordering': true,
            'paging': false
        });

        if ($('#user_level').val() == "1") {
            $('#center_id').find('option').get(0).remove();
            $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        }

        load_course_list($("#center_id").val());
        get_courses($("#center_id").val(),1,null,0);


        search_mahapola_students();
        // $(document).prop('title', 'test');

//            $('#reject_list').DataTable({
//                'ordering': true,
//                'lengthMenu': [10, 25, 50, 75, 100]
//            });  

//            $('#center_id').find('option').get(0).remove();
//            $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));

//            $('#center_id2').find('option').get(0).remove();
//            $("#center_id2").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));

//            load_course_list($("#center_id").val());

        //load_reject_course_list($("#center_id2").val());

    });

    function dispc() {
        document.getElementById("common").style.display = "none";
    }

    function ndispc() {
        document.getElementById("common").style.display = "block";
    }


    function bulk_approve_students(student_id, approved, reg_no, nic, branch, email_sent_status) {
        $('.se-pre-con').fadeIn('slow');
        var title = "";
        var approve_array = [];

        $('#director_apprv').find('tr').each(function (i) {
            var tds = $(this).find('td'),
                    student_id = tds.eq(5).text(),
                    mahapola_id = tds.eq(6).text();

            if (i != 0) {
                approve_array.push({'student_id': student_id, 'mahapola_id': mahapola_id});
            }
        });


        $("#dialog-confirm").html("Do you really want to approve all students for mahapola?");
        title = 'Approve Students for Mahapola';


        // Define the Dialog and its properties.
        $("#dialog-confirm").dialog({
            resizable: false,
            modal: true,
            title: title,
            height: 140,
            width: 400,
            draggable: false,
            buttons: [
                {
                    text: "Yes",
                    "class": 'btn btn',
                    click: function () {
                        $(this).dialog('close');

                        $.post("<?php echo base_url('approvals/bulk_approve_mahapola_students') ?>", {'approve_array': approve_array},
                                function (data) {
                                    if (data) {
                                        location.reload();
                                    }
                                },
                                "json"
                                );
                    }
                },
                {
                    text: "No",
                    "class": 'btn btn-info',
                    click: function () {
                        $(this).dialog('close');
                    }
                }
            ]
        }).prev(".ui-dialog-titlebar").css({'background': '#74caee', 'border-color': '#74caee'});
        $('.se-pre-con').fadeOut('slow');
    }

    //         function stueditview(stu)
    //        {
    //            window.location = '<?php echo base_url("student/mahapola_application_view") ?>?id='+ (window.btoa(stu)) +'&type=mahapola_approval';
    //
    //        }


    /*
     * load courses
     */
    function load_course_list(center_id) {
        $('#course_id').find('option').remove().end();
        $("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Approvals/load_mahapola_course_list') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                },
                "json"
                );
    }

    function formatDate(date) {
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return day + '_' + monthNames[monthIndex] + '_' + year;
    }

    function search_mahapola_students() {
        $('.se-pre-con').fadeIn('slow');
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var mp_year = $('#mp_app_year').val();

        var header_log = '<img src="<?PHP echo base_url("uploads/sliate_logo.jpg"); ?>" style="position:absolute; top:0; left:10;" />';
        $.post("<?php echo base_url('Approvals/search_mahapola_director_approval_list') ?>", {
            'center_id': center_id,
            'course_id': course_id,
            'mp_year': mp_year
        },
                function (data) {
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        $('#director_apprv').DataTable().destroy();
                        $('#director_apprv').DataTable({
                            'ordering': true,
                            'paging': false,
                            "columnDefs": [
                                {
                                    "targets": 0,
                                    "className": "text-center"
                                },
                                {
                                    "targets": 5,
                                    "className": "hidden"
                                },
                                {
                                    "targets": 6,
                                    "className": "hidden"
                                }],
                            /*dom: 'Bfrtip',
                             buttons: [
                             'copy', 'csv', 'excel', 'pdf', 'print'
                             ]*/
                            dom: 'Bfrtip',
                            buttons: [{
                                    // extend: 'pdf',
                                    extend: 'pdfHtml5',
                                    pageSize: 'A4',
                                    //orientation: 'landscape',
                                    title: 'Mahapola Approval List',
                                    filename: 'mahapola_approval_' + formatDate(new Date()),
                                    customize: function (doc) {

                                        doc.content.splice(0, 0,
                                                {
                                                    margin: [0, 0, 0, 12],
                                                    width: 100,
                                                    height: 100,
                                                    alignment: 'center',
                                                    image: 'data:image/jpeg;base64,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',

                                                },
                                                {
                                                    margin: [0, 0, 0, 12],
                                                    alignment: 'center',
                                                    text: 'USER GROUP MANAGEMENT'
                                                }
                                        );
                                    }


                                }, {
                                    extend: 'excel',
                                    title: 'Mahapola Approval List',
                                    filename: 'mahapola_approval_' + formatDate(new Date())
                                }, {
                                    extend: 'print',
                                    title: 'Mahapola Approval List',
                                    filename: 'mahapola_approval_' + formatDate(new Date()),
                                    customize: function (win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                        $(win.document.body).css('font-size', '9px');
                                        $(win.document.body).find('table')
                                                .addClass('compact')
                                                .css('font-size', 'inherit');
                                    }
                                }]
                        });
                        $('#director_apprv').DataTable().clear().draw();

                        if (data.length > 0) {
                            $('#bulk_approve').attr('disabled', false);

                            for (j = 0; j < data.length; j++) {

                                number_content = "<td align='center'>" + (j + 1) + "</td>";

                                // action_content = "<td align='center'><a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> | <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_stu_mahapola_apprv_status(" + data[j]['stu_id'] + ", \""+1+"\", \"" +data[j]["reg_no"]+ "\", \"" +data[j]["nic_no"]+ "\", " +data[j]["center_id"]+ ")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |<button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_stu_mahapola_apprv_status(" + data[j]['stu_id'] + ", \""+3+"\", \"" +data[j]["reg_no"]+ "\", \"" +data[j]["nic_no"]+ "\", " +data[j]["center_id"]+ ")' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                $('#director_apprv').DataTable().row.add([
                                    number_content,
                                    data[j]['reg_no'],
                                    data[j]['first_name'],
                                    data[j]['nic_no'],
                                    data[j]['need_index'],
                                    data[j]['student_id'],
                                    data[j]['mahapola_id']
                                            //action_content
                                ]).draw(false);
                            }
                        } else {
                            $('#bulk_approve').attr('disabled', true);
                        }
                    }
                $('.se-pre-con').fadeOut('slow');
                },
                "json"
                );

    }


    function mahapola_year_check() {

        var mpyearchng = $('#mpyear').val();

        if (mpyearchng == "") {
            $('#mahapola_update').attr('disabled', true);
        } else {
            $('#mahapola_update').attr('disabled', false);
        }
    }

    function update_mahapola_eligible_status() {
        $('.se-pre-con').fadeIn('slow');
        var mpyear = $('#mpyear').val();

        if (mpyear == "") {
            funcres = {status: "denied", message: "Please select relevant year to update eligibility list."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else {
            $.post("<?php echo base_url('Student/update_mahapola_eligible_status') ?>", {'mpyear': mpyear},
                    function (data) {
                        // console.log(data);
                        if (data == 'denied') {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else {
                            location.reload();
                        }
                    $('.se-pre-con').fadeOut('slow');
                    },
                    "json"
                    );
        }
    }

    //kasun
//    function get_courses(center_id, flag, course_id, lookup_flag) {
//
//        $('#course').find('option').remove().end().append('<option value=""></option>').val('');
//        $('#coursep').find('option').remove().end().append('<option value=""></option>').val('');
//        $('#l_course').find('option').remove().end().append('<option value=""></option>').val('');
//        $('#course_med').find('option').remove().end().append('<option value=""></option>').val('');
//        $('#post_course').find('option').remove().end().append('<option value=""></option>').val('');
//
//
//        $('#lecture_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');
//        $('#exam_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');
//
//        if (flag === 1) {
//            $.post("<?php // echo base_url('Course/load_course_list') ?>", {'center_id': center_id},
//                    function (data) {
//                        if(data.length == 1 ){
//                            $('#course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code'] + " - " + data[0]['course_name']).attr("selected","selected"));
//                            $('#rpt_exam_course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code'] + ' - ' + data[0]['course_name']).attr("selected","selected"));
//                            get_course_code(data[0]['course_id']);
//                        } else {
//                            for (var i = 0; i < data.length; i++) {
//                                if (lookup_flag) {
//                                    $('#l_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                } else {
//                                    $('#course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                    $('#coursep').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                    $('#lecture_ttbl_center').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                    $('#course_med').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                    $('#exam_ttbl_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                    $('#post_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
//                                }
//
//                        }
//                        }
//                        
//                        
//                    },
//                    "json"
//                    );
//        }
//    }

    function get_course_code(course_id, lookup_flag) {
        $('#l_batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#batch').find('option').remove().end().append('<option value=""></option>').val('');
        $('#batchp').find('option').remove().end().append('<option value=""></option>').val('');
        $('#batch_med').find('option').remove().end().append('<option value=""></option>').val('');
        $('#defined_batch').find('option').remove().end().append('<option value=""></option>').val('');

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
                            $('#lecture_ttble_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            $('#exam_ttble_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            $('#defined_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                        }
                    }

                },
                "json"
                );
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
            //$('.se-pre-con').fadeIn('slow');
            $.post("<?php echo base_url('subject/load_semester_subjects') ?>", {'batch_id': batch_id},
                    function (data1) {
                        //  console.log(data1);
                        var abc = data1.length;
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

                        $.post("<?php echo base_url('student/load_student_approved_exam') ?>", {
                            'batch_id': batch_id,
                            'branch': $('#prom_centre').val()
                        },
                                function (data) {
//                                    console.log(data);
                                    if (data == null || data == '') {
                                        $('.se-pre-con').fadeOut('slow');
                                        $('#load_thead').find('tr').remove();
                                        $('#load_student').find('tr').remove();
                                        $('#load_thead').append("<tr><th>#</th><th>Reg No</th><th >Student Name</th><th >Action </th></tr>");
                                        $('#load_student').append('<tr><td colspan="10" align="center">No records to show.</td></tr>');
                                        $('.se-pre-con').fadeOut('slow');


                                    } else {
                                        $('#exam_request_bulk_approval_btn').prop("disabled", false);
                                        //$('.se-pre-con').fadeOut('slow');
                                        //console.log(sem_codes_subjects);
                                        //console.log("sem_subject_code:" + sem_subject_code);
                                        $('#load_thead').find('tr').remove();
                                        if (data.length > 0) {
                                            $('#load_student').find('tr').remove();
                                            $('#load_thead').append("<tr><th><input type='checkbox' onchange='exam_request_check_all()' name='select_all_exam_request'/><br/>Select All</th><th>#</th><th>Reg No</th><th>Student Name</th></tr>");

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


                                                for (x = 0; x < data[j]['selected_subjects'].length; x++) {

                                                    selected_subjects.push(data[j]['selected_subjects'][x]['subject_id']);//current_semester   stu_id
                                                }

                                                var approval_btn = "<button id=\"exam_approval\" title=\"Approve\"  data-toggle=\"modal\" data-id=\"\" data-target=\"#\" onclick=\"event.preventDefault();update_exam_status('" + data[j]['semester_exam_id'] + "','" + data[j]['stu_id'] + "', '1')\" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>" +
                                                        " | <button id =\"reject_btn\" title=\"Reject\"  onclick=\"event.preventDefault();update_exam_rej_status('" + data[j]['semester_exam_id'] + "','" + data[j]['stu_id'] + "', '4')\" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";

                                                // var zz = findObjectByKey(sem_codes_subjects, 'code', 'TC02');
                                                // alert(zz);

                                                $('#load_student').append("<tr " + (j + 1) + "'><td><input type='checkbox' id='exm_request_check_box' name='exm_request_check_box' value='"+data[j]['stu_id']+"'/></td><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + "</td> </tr>");
                                                $('#apply_exam_req tr:last').append(sem_subject_ids
                                                        .map(id => `<td style='text-align: center'>${selected_subjects.includes(id) ? '<input type="checkbox" class="' + data[j]['stu_id'] + '" id="' + data[j]['stu_id'] + "_" + id + '" name="' + findObjectByKey(sem_codes_subjects, "id", id) + '" value="' + id + '" checked disabled >' : ' <input type="checkbox" class="' + data[j]['stu_id'] + '" id="' + data[j]['stu_id'] + "_" + id + '" name="' + findObjectByKey(sem_codes_subjects, "id", id) + '" value="3" disabled >'}</td>`)
                                                        .join(''))
                                                        .appendTo($('#load_student'));
                                                $('#apply_exam_req tr:last').append("<td style='text-align: center'>" + approval_btn + "</td>").appendTo($('#load_student'));
                                                selected_subjects = [];

                                            }

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

    function findObjectByKey(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return array[i]["code"];
            }
        }
        return null;
    }

    function update_exam_status(semester_id, stu_id, is_approval) {
        $('.se-pre-con').fadeIn('slow');
        $.ajax(
                {
                    url: "<?php echo base_url('Approvals/update_exam_approval_status') ?>",
                    type: 'POST',
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
                        'stu_id': stu_id,
                        'semester_id': semester_id,
                        'is_approved': is_approval
                    },
                    success: function (data) {

                        if (data == 'denied') {

                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                            $('.se-pre-con').fadeOut('slow');
                        } else {
                            //alert(jsonData.status);
                            //alert(jsonData);

                            //alert(data['message']);
                            if (data) {

                                load_apply_exam_data();
                                funcres = {status: data['status'], message: data['message']};
                                result_notification(funcres);
                            } else {
                                funcres = {status: data['status'], message: data['message']};
                                result_notification(funcres);
                                $('.se-pre-con').fadeOut('slow');
                            }
                        }

                    }
                    //$('.se-pre-con').fadeOut('slow');
                });                
    }


    function update_exam_rej_status(semester_id, stu_id, is_approval) {
        $('#rej_sem_exam_id').val(semester_id);
        $('#rej_stu_id').val(stu_id);
        $('#rej_is_approval').val(is_approval);
        $("#rejected_reason_div").empty();
            
        $.post("<?php echo base_url('approvals/get_exam_reject_reason') ?>", {},
                function (data) {
                    $("#rejected_reason_div").append('<label>Enter Reason : </label><br/>\n\
                            <select id="reject_dropdown" class="form-control" onchange="show_text_area(this.value)" style="width:75%" \n\
                            name="reject_reason" \n\
                            data-validation="required" data-validation-error-msg-required="Field can not be empty"></select><br/>\n\
                            <div id="other_reason"><label id="other_label">Please Enter Other Reject Reason Here.</label><textarea disabled class="form-control" id="other_text_area" rows="2" value=""></textarea>\n\
                            </div>');
                for (var x = 0; x < data.length; x++) {
                    $('#reject_dropdown').append($("<option></option>").attr("value", data[x]['reason_id']).text(data[x]['reject_reason']));
                }    
                $('#reject_dropdown').append('<option value="-1">Other Reason</option>');
                },
                "json");
            $('#lbl_error').hide();
            $("#exam_reject").modal();

    }

    function show_text_area(val){
        if(val == -1){
            $('#other_text_area').prop("disabled", false);
        } else {
            $('#other_text_area').val("");
            $('#other_text_area').prop("disabled", true);
        }
    }
    
    function load_year_list() {
        if (($('#defined_exam_course').val()) != "0") {
            var cou_id = $('#defined_exam_course').val();

            $.post("<?php echo base_url('Approvals/load_year_list') ?>", {'selected_course_id': cou_id},
                    function (data) {
                        var year = data['no_of_year'];
                        var id = data['id'];

                        //console.log(year+"-"+id);

                        $('#defined_year').find('option').remove().end();
                        $('#defined_year').prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Year---"));

                        for (var i = 1; i <= year; i++) {
                            $('#defined_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                        }

                        load_semesters($('#defined_year').val());
                    },
                    "json"
                    );
        }
    }


    function load_semesters(year_no) {
        var sel_year = "";
        var sel_year_id = "";

        if (year_no != "all") {
            sel_year = year_no.split('-')[0].trim();
            sel_year_id = year_no.split('-')[1].trim();
        }

        $.post("<?php echo base_url('Approvals/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
                function (data) {
                    $('#defined_semester').find('option').remove().end();
                    $("#defined_semester").prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Semester---"));
                    //$('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                    for (var i = 1; i <= data; i++) {
                        $('#defined_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                    }
                },
                "json"
                );
    }


    //    function load_exam(semester_no)
    //    {
    //        var sel_semester = "";
    //
    //        var sel_semester_id = $("#defined_semester").val();
    //        var course_id = $("#defined_exam_course").val();
    //        var year_no = $("#defined_year").val();
    //
    //        var batch_id = $("#defined_batch").val();
    //
    //        if (year_no != "all") {
    //            sel_year = year_no.split('-')[0].trim();
    //            sel_year_id = year_no.split('-')[1].trim();
    //        }
    //
    //
    //        //  if (sel_semester_id != "all") {
    //        //sel_semester = semester_no.split('-')[0].trim();
    //        //sel_semester_id = semester_no.split('-')[1].trim();
    //        //  }
    ////'year_no': sel_year
    //
    //        $.post("<?php //echo base_url('Approvals/load_exam_list')                ?>", {'semester_no': sel_semester_id, 'course_id': course_id, 'year_no': sel_year, 'batch_id': batch_id},
    //                function (data)
    //                {
    //                    $('#defined_exam').find('option').remove().end();
    //                    $("#defined_exam").prepend($("<option selected='selected'></option>").attr("value", "all").text("---Select Exam---"));
    //                    //$('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');
    //                    console.log(data);
    //                    for (var i = 0; i < data.length; i++)
    //                    {
    //                        if ((data[i]['id'].length) != 0)
    //                        {
    //                            $('#defined_exam').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['exam_code']));
    //                        }
    //                    }
    //                },
    //                "json"
    //                );
    //    }

    function load_exam_data() {
        $('.se-pre-con').fadeIn('slow');

        var course_id = $('#defined_exam_course').val();
        //var batch_id = $('#defined_batch').val();
        var year_no = $('#defined_year').val();
        var semester_no = $('#defined_semester').val();
        //var exam_id = $('#defined_exam').val();

// if (year_no != "all") {
//           sel_year = year_no.split('-')[0].trim();
//           sel_year_id = year_no.split('-')[1].trim();
//      }
        //'batch_id': batch_id, 'exam_id': exam_id
        $.post("<?php echo base_url('Approvals/search_students_lookup1') ?>", {
            'course_id': course_id,
            'year_no': year_no,
            'semester_no': semester_no
        },
                function (data) {
//                    console.log(data);
                    if (data == 'denied') {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        $('.se-pre-con').fadeIn('slow');
                        $('#defined_exam_tbl').DataTable().destroy();
                        $('#defined_exam_tbl').DataTable({
                            'ordering': true,
                            'lengthMenu': [10, 25, 50, 75, 100]

                        });
                        $('#defined_exam_tbl').DataTable().clear().draw();

                        if (data.length > 0) {
                            for (j = 0; j < data.length; j++) {

                                number_content = "<td align='center'>" + (j + 1) + "</td>";

                                action_content = "<td align='center'> \n\
                                                    <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
                                                    <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";
                                // <a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' ></span></a> |
                                $('#defined_exam_tbl').DataTable().row.add([
                                    number_content,
                                    data[j]['exam_name'],
                                    data[j]['course_name'],
                                    data[j]['batch_code'],
                                    data[j]['year_no'],
                                    data[j]['semester_no'],
                                    action_content


                                            //action_content
                                ]).draw(false);
                                $('.se-pre-con').fadeOut('slow');
                            }
                        } else {
                            //$('#bulk_approve').attr('disabled', true);
                        }
                    }
                    $('.se-pre-con').fadeOut('slow');  
                },
                "json"
                );
    }


    function update_defined_exam_status(exam_id, is_approved) {
        $.ajax(
                {
                    url: "<?php echo base_url('Approvals/update_exam_approval_status1') ?>",
                    type: 'POST',
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
                        'exam_id': exam_id,
                        //'semester_id': semester_id,
                        'is_approved': is_approved
                    },
                    success: function (data) {
                        if (data == 'denied') {

                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                            //load_exam_data($('#defined_exam_tbl').val());
                        } else {
                            if (data == 1) {
                                funcres = {status: 'success', message: 'Subject Exam Approved'};
                                result_notification(funcres);
                                load_exam_data();


                            } else {
                                funcres = {status: 'fail', message: 'bad'};
                                result_notification(funcres);
                            }
                        }

                    }
                });
    }



    ////////////////////Repeat Students ---- Bavithran///////////////////////
    
    //===================repeat student ======
        $("#rpt_exam_data_div").hide();
    //===================end repeat student ======
    
    
    
    function get_courses(center_id, flag, course_id, lookup_flag) {

        $('#subject_course').find('option').remove().end().append('<option value=""></option>').val('');
        $('#course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#coursep').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#l_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#course_med').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#mark_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#rpt_exam_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
        $('#post_course').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');

        $('#lecture_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');
        $('#exam_ttbl_center').find('option').remove().end().append('<option value=""></option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('Course/load_course_list') ?>", {'center_id': center_id},
                    function (data) {
                        if(data.length == 1 ){
                            $('#course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code'] + ' - ' + data[0]['course_name']).attr("selected","selected"));
                            $('#rpt_exam_course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code'] + ' - ' + data[0]['course_name']).attr("selected","selected"));
                            get_course_code(data[0]['course_id']);
                            load_semester_batches(data[0]['course_id']);
                        } else {
                            for (var i = 0; i < data.length; i++) {
                                if (lookup_flag) {
                                    $('#l_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                } else {
                                    $('#course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#coursep').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#lecture_ttbl_center').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#course_med').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#mark_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#subject_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#exam_ttbl_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#rpt_exam_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                                    $('#post_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));

                                }
                            
                            }
                        }
                        
                    },
                    "json"
                    );
        }
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
    
    function rpt_load_year() {
    
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

    function rpt_exam_load_student() {
        $('.se-pre-con').fadeIn('slow');
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
                if(data != null){
                    //setting year and semester
                    var year_no = $('#rpt_exam_no_year').val();
                    $('#rpt_year_apply').append($("<option></option>").attr("value", year_no).text(year_no + " Year"));
                    var semester_no = $('#rpt_exam_no_semester').val();
                    $('#rpt_semester_apply').append($("<option></option>").attr("value", semester_no).text(semester_no + " Semester"));
                    
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
                        $('#rpt_batch_apply').append('<option value="">---Select Repeat Batch---</option>').val('');
                        $.post("<?php echo base_url('batch/load_batches_for_rpt_approve') ?>", {
                                'course_id': rptCourse,
                                'rpt_selected_batch':rpt_selected_batch,
                                'rptYear':rptYear,
                                'rptSemester':rptSemester
                                //'batch_id': rptBatch
                            },
                            function (data) {

                                for (j = 0; j < data.length; j++) {

                                    $('#rpt_batch_apply').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                                }


                            },
                            "json"
                        );
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
            $('.se-pre-con').fadeOut('slow');
            },
            "json"
        );
    }

    function rpt_year_list() {

        var course_id = $('#rpt_exam_course').val();
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
    
    function rpt_load_semesters(year_no) {
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
    
    function rpt_load_semester_exam() {
        $('#rpt_exam_apply').find('option').remove().end();
        $('#rpt_exam_apply').append('<option value="">---Select Exam---</option>').val('');

        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': $('#rpt_batch_apply').val()},
            function (data) {
                if (data != null) {
                    for (var i = 0; i < data.length; i++) {
                        $('#rpt_exam_apply').append($("<option></option>").attr("value", data[i]['exam_id']).text('['+data[i]['exam_code']+'] - '+data[i]['exam_name']));
                    }
                }
            },
            "json"
        );
    }
    
    function rpt_approve_student() {
        $('.se-pre-con').fadeIn('slow');
        var aprv_batch = $('#rpt_batch_apply').val();
        var aprv_year = $('#rpt_year_apply').val();
        var aprv_semester = $('#rpt_semester_apply').val();
        var aprv_exam = $('#rpt_exam_apply').val();
        
        if(aprv_batch == ""){
            funcres = {status: "denied", message: "Please select the next facing examination batch."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else if(aprv_year == ""){
            funcres = {status: "denied", message: "Please select the next facing examination year."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else if(aprv_semester == ""){
            funcres = {status: "denied", message: "Please select the next facing examination semester."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else if(aprv_exam == ""){
            funcres = {status: "denied", message: "Please select the next facing examination exam code."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
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
            $('.se-pre-con').fadeOut('slow');
        }        
    }
    
    function rpt_reject_student() {
        $('.se-pre-con').fadeIn('slow'); 
        var aprv_batch = $('#rpt_batch_apply').val();
        var aprv_year = $('#rpt_year_apply').val();
        var aprv_semester = $('#rpt_semester_apply').val();
        var aprv_exam = $('#rpt_exam_apply').val();
        
        if(aprv_batch == ""){
            funcres = {status: "denied", message: "Please select the next facing examination batch."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else if(aprv_year == ""){
            funcres = {status: "denied", message: "Please select the next facing examination year."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else if(aprv_semester == ""){
            funcres = {status: "denied", message: "Please select the next facing examination semester."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else if(aprv_exam == ""){
            funcres = {status: "denied", message: "Please select the next facing examination exam code."};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else{
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
            $('.se-pre-con').fadeOut('slow');
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
        
       
    }
    
    
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
    
    ////////////////////End of Repeat Students ---- Bavithran///////////////////////
    
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
        
        var post_center = $('#post_center').val();
        var post_course = $('#post_course').val();
        var post_batch = $('#post_batch').val();
        
        if (type_val == "postpone") {
            $('#header1').text("Postpone");
            $('#graduation_tbl_div').hide();
            $('#postpone_tbl_div').show();
        }
        if (type_val == "graduation") {
            $('#header1').text("Graduation");
            $('#postpone_tbl_div').hide();
            $('#graduation_tbl_div').show();
            
        }
                        
        $.post("<?php echo base_url('approvals/student_course_wise_details')?>", {
            'type_val': type_val, 
            'post_center': post_center, 
            'post_course': post_course, 
            'post_batch':post_batch
        },
            function (data) {
//                console.info(data);
                if(type_val == 'postpone'){
                    
                    $('#postpone_tbl').DataTable().destroy();
                    
                    $('#postpone_tbl').DataTable({
                        'ordering': true,
                        'paging': false
                    });
                    
                    $('#postpone_tbl').DataTable().clear();
                     if (data.length > 0) {
                         for (x = 0; x < data.length; x++) {
                             var approve_btn = '<button id="app_graduation" name="app_postpone" class="btn btn-primary btn-xs" onclick="event.preventDefault();update_postpone_approval_status('+data[x]['request_id']+','+data[x]['stu_id']+',1);"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';
                             var reject_btn = '<button id="rej_graduation" name="rej_postpone" class="btn btn-warning btn-xs" onclick="event.preventDefault();update_postpone_approval_status('+data[x]['request_id']+','+data[x]['stu_id']+',3);"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button>';

                             var action_content = approve_btn+" | "+reject_btn;
                             
                            $('#postpone_tbl').DataTable().row.add([
                                x+1,
                                data[x]['reg_no'],
                                data[x]['first_name'],
                                data[x]['current_year'],
                                data[x]['current_semester'],
                                data[x]['reason'],
                                data[x]['next_join'],
                                action_content
                            ]).draw(false);
                            
                        }
                     }
                    
                } else if(type_val == 'graduation') {
                    
                    $('#graduation_tbl').DataTable().destroy();
                    
                    $('#graduation_tbl').DataTable({
                        'ordering': true,
                        'paging': false
                    });
                    
                    $('#graduation_tbl').DataTable().clear();
                     if (data.length > 0) {
                         for (x = 0; x < data.length; x++) {
                             var view_btn = '<button id="view_graduation" name="view_graduation" class="btn btn-success btn-xs" onclick="event.preventDefault();view_graduation_info('+data[x]['stu_id']+');"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>';
                             var approve_btn = '<button id="app_graduation" name="app_graduation" class="btn btn-primary btn-xs" onclick="event.preventDefault();update_graduation_approval_status('+data[x]['request_id']+','+data[x]['stu_id']+',1);"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>';
                             var reject_btn = '<button id="rej_graduation" name="rej_graduation" class="btn btn-warning btn-xs" onclick="event.preventDefault();update_graduation_approval_status('+data[x]['request_id']+','+data[x]['stu_id']+',3);"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button>';

                             var action_content = view_btn+" | "+approve_btn+" | "+reject_btn;
                             
                            $('#graduation_tbl').DataTable().row.add([
                                x+1,
                                data[x]['reg_no'],
                                data[x]['first_name'],
                                action_content
                            ]).draw(false);
                            
                        }
                     }
                }

                $('.se-pre-con').fadeOut('slow');
            },
            "json"
        );
    }
    
//    function view_gpa_results(stu_request_id, stu_id, reg_no, first_name, last_name) {
//        var res = [];
//
//
//        $.post("<?php echo base_url('approvals/view_gpa_results') ?>", {'stu_id': stu_id},
//            function (data) {
////                                    $(".modal_title").text("Exam Marks : Course: " + data['course_code'] + "- Batch : " + data['batch_code'] + "  Y" + year + "/ S" + semester);
//                $('#post_stu_id').val(stu_id);
//
//                $('#myModal').append("<input type='text' name='post_stu_reg' id='post_stu_reg' value='" + data['reg_no'] + "'>");
//
//
//                $('#').val(reg_no);
////                                    $('#post_stu_name').val(first_name);
//                jQuery("#post_stu_name").html(first_name + ' ' + last_name);
//                jQuery("#post_stu_reg_no").html(reg_no);
//
//                if (data == 'denied') {
//                    funcres = {status: "denied", message: "You have no right to proceed the action"};
//                    result_notification(funcres);
//                }
//                else {
//                    if (data.length == 0) {
////                                            res['status'] = 'denied';
////                                            //res['message'] = 'There are no students without subjects';
////                                            result_notification(res);
//                    } else if (data.length > 0) {
//                        $('#view_postpone_stu_tbl_bdy').find('tr').remove();
//                        $('#myModal').modal('show');
//                        for (j = 0; j < data.length; j++) {
//                            $('#view_postpone_stu_tbl_bdy').append("<tr><td style='width:14%;text-align: center'>" + (j + 1) + "</td><td style='width:14%;text-align: center'>" + data[j]['year'] + "</td><td style='width:14%;text-align: center'>" + data[j]['semester'] + "</td><td style='width:14%;text-align: center'>" + data[j]['gpa'] + "</td></tr>");
//                        }
//                    } else {
//                        res['status'] = 'denied';
//                        res['message'] = 'All Students subjects selected.';
//                        result_notification(res);
//                    }
//                }
//            },
//            "json"
//        );
//
//    }
    
    function update_graduation_approval_status(request_id, student_id, status) {

        $.ajax(
            {
                url: "<?php echo base_url('approvals/update_graduation_approval_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'request_id': request_id, 'status': status, 'student_id': student_id},
                success: function (data) {
                   $('#graduation_tbl').DataTable().clear();
                   load_type_wise();
                   result_notification(data);
                }
            });
    }
    
        function update_postpone_approval_status(request_id, student_id, status) {

        $.ajax(
            {
                url: "<?php echo base_url('approvals/update_approval_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'request_id': request_id, 'status': status, 'student_id': student_id},
                success: function (data) {
                   $('#postpone_tbl').DataTable().clear();
                   load_type_wise();
                   result_notification(data);
                }
            });
    }
    
    function update_approval_status(request_id, student_id, status) {

        $.ajax(
            {
                url: "<?php echo base_url('approvals/update_approval_status') ?>",
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
    
    function load_semester_batches_postpone(course_id) {

        $('#post_batch').find('option').remove().end();
        $('#post_batch').append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
                function (data) {

                    for (j = 0; j < data.length; j++) {
                        //if (lookup_flag) {
                        //    $('#l_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        //} else {
                        $('#post_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        // }
                    }

                },
                "json"
                );
    }
    
//    $('#gpaModal').on('shown.bs.modal', function () {
//        $('#myInput').trigger('focus');
//    });
    
    function view_graduation_info(stu_id){
        
        var fail_data = [];
        
        $('#apply_graduation_tbl').DataTable().destroy();
            $('#apply_graduation_tbl').DataTable({
                'ordering': false,
                'searching': false,
                'paging': false,
                'info': false,
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
                }
            });
            $('#apply_graduation_tbl').DataTable().clear().draw();
        
        $.post("<?php echo base_url('exam/load_graduation_eligibility_for_approval') ?>", {'stu_id':stu_id},
                function (data) {
                        $('#gpaModal').modal('show');
                        
                        var prevId = "";
                        var yearId = "";
                        var semId = "";
                        var prevSemId = "";
                        var sgpa = "";
                        var NE_count = 0;
                        var fail_count = 0;
                        
                        
                        var fail_result_array = ["E", "D", "D+", "C-", "-", "", " ", null];
                        
                        var NE_result_array = ["I(CA)", "I(SE)", "INC", "AB", "DFR", "NE", "N/E"];
                        
                        
                        for (var x = 0; x < data.length; x++) {
                            for (var y = 0; y < data[x]['graduate_data']['exam_mark'].length; y++) {
                               
                                if(jQuery.inArray(data[x]['graduate_data']['exam_mark'][y]['result'], NE_result_array) != -1){
                                    NE_count++;
                                    
                                    fail_data.push({'year_no':data[x]['year'], 'semester_no':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'subj_id':data[x]['graduate_data']['exam_mark'][y]['subject_id']});
                                }
                                
                                if(jQuery.inArray(data[x]['graduate_data']['exam_mark'][y]['result'], fail_result_array) != -1){
                                    fail_count++;
                                    
                                    fail_data.push({'year_no':data[x]['year'], 'semester_no':data[x]['semester'], 'sgpa':data[x]['graduate_data']['gpa'], 'subj_id':data[x]['graduate_data']['exam_mark'][y]['subject_id']});
                                }
                                
                            }
                        }

//                        if((NE_count > 0) || fail_count > 1){
//                            $('#graduate_label').text("You are not eltitled to request for the graduation.").css("color", "#e62626");
//                        }
//                        else if(fail_count == 1){
//                            if(fail_data[0]['sgpa'] < 2.00){
//                                $('#graduate_label').text("You are not eltitled to request for the graduation.").css("color", "#e62626");
//                            }
//                            else{
//                               $('#graduate_label').text("You are eltitled to request for the graduation.").css("color", "#009900");
//                            }
//                        }
//                        else{
//                            $('#graduate_label').text("You are eltitled to request for the graduation.").css("color", "#009900");
//                        }

                        for (var i = 0; i < data.length; i++) { 
                            
                            yearId = data[i]['year'];
                            semId = data[i]['semester'];
                            
                            sgpa = data[i]['graduate_data']['gpa'];
                            
                            if(i > 0){
                                prevId = data[i-1]['year'];
                                prevSemId = data[i-1]['semester'];
                            }

                            if(yearId != prevId){
                                $('#apply_graduation_tbl').DataTable().row.add([ 
                                    "1",
                                    "",
                                    "<b>"+yearId+" Year - "+semId+" Semester</b>",
                                    "<b>SGPA - "+sgpa+"</b>"
                                ]).draw(false);  
                            }
                            else{
                               if(semId != prevSemId){
                                    $('#apply_graduation_tbl').DataTable().row.add([  
                                        "1",
                                        "",
                                        "<b>"+yearId+" Year - "+semId+" Semester</b>",
                                        "<b>SGPA - "+sgpa+"</b>"
                                    ]).draw(false);  
                                } 
                            }
                            
                            
                            for (var t = 0; t < data[i]['graduate_data']['exam_mark'].length; t++) {
                                $('#apply_graduation_tbl').DataTable().row.add([
                                    "0",
                                    data[i]['graduate_data']['exam_mark'][t]['subject_id'],
                                    "["+data[i]['graduate_data']['exam_mark'][t]['subject_code']+"] - "+data[i]['graduate_data']['exam_mark'][t]['subject'],
                                    data[i]['graduate_data']['exam_mark'][t]['result']
                                ]).draw(false);  
                            }
                        }
//                    }
                },
                "json"
            );
        
       
        
        
    }
    
    //////////////////////timetable tab////////////////////////
    function view_exam_timetable(id, desc, tt_course, tt_year, tt_semester){
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
        
        function update_examtime_status(ttbl_id, approved) {
        $.ajax(
            {
                url: "<?php echo base_url('Approvals/update_examtime_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'ttbl_id': ttbl_id, 'approved': approved},
                success: function (data) {
                    location.reload();
                    result_notification(data);
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
                                        
                                        $.post("<?php echo base_url('approvals/exam_request_bulk_approval') ?>", {
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
            
        } else {
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
            });
        } else {
            $.each($("input[name='exm_request_check_box']"), function(){            
                $(this).prop('checked', false);
            });
        }

    }
    
    function update_exam_rej_status_db(){
        var txt_area = $('#other_text_area').val().trim();
        var reason_id = $('#reject_dropdown').val();
        if(reason_id == -1 &&(txt_area == null || txt_area == '')){
            $('#lbl_error').show();
        } else {
            $("#exam_reject").modal('hide');
            var semester_id = $('#rej_sem_exam_id').val();
            var stu_id = $('#rej_stu_id').val();
            var is_approval = $('#rej_is_approval').val();
            var reject_reason = '';
            
            if(reason_id == -1){
                 reject_reason = $('#other_text_area').val();
            } else {
                  reject_reason = $('#reject_dropdown option:selected').text();
            }

            $.ajax(
                    {
                        url: "<?php echo base_url('Approvals/update_exam_rej_status') ?>",
                        type: 'POST',
                        async: true,
                        cache: false,
                        dataType: 'json',
                        data: {
                            'stu_id': stu_id,
                            'semester_id': semester_id,
                            'is_approved': is_approval,
                            'reject_reason' : reject_reason
                        },
                        success: function (data) {


                            if (data == 'denied') {

                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else {
                                //alert(jsonData.status);
                                //alert(jsonData);


                                if (data) {

                                    load_apply_exam_data();
                                    funcres = {status: "success", message: "Rejected successfully"};
                                    result_notification(funcres);
                                } else {
                                    funcres = {status: "Failed", message: "Rejected Failed"};
                                    result_notification(funcres);
                                }
                            }

                        }
                    });
        }
        
        
    }
</script>





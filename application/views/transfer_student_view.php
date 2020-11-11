<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Jquery File Uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput-rtl.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/purify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/fileinput.min.js') ?>"></script>


<style type="text/css">

    .affix-top {
        position: relative;
    }

    .affix {
        top: 70px;
    }

    .affix,
    .affix-bottom {
        width: 168px;
    }

    .affix-bottom {
        position: absolute;
    }

</style>


<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> TRANSFER STUDENT INFORMATION</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Transfer Student</li>
        </ol>
    </div>
</div>

<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class=""><a id="#transfer_tab" href="#transfer_tab" aria-controls="transfer_tab"
                                        role="tab" data-toggle="tab">Transfer Student</a></li>
    <li role="presentation"><a id="#remove_tab" href="#remove_tab" aria-controls="remove_tab" role="tab"
                               data-toggle="tab">Remove Student</a></li>
    <li role="presentation"><a id="#remove_student_tab" href="#remove_student_tab" aria-controls="remove_student_tab"
                               role="tab" data-toggle="tab">Deactivated Student List</a></li>
    <li role="presentation"><a id="#terminate_batch_tab" href="#terminate_batch_tab" aria-controls="terminate_batch_tab"
                               role="tab" data-toggle="tab">Terminate Batch</a></li>
    <li role="presentation" class="active"><a id="#enter_marks_tab" href="#enter_marks_tab" aria-controls="enter_marks_tab"
                                              role="tab" data-toggle="tab">Upload Marks File</a></li>
    <li role="presentation" class=""><a id="#bulk_subject_approve_tab" href="#bulk_subject_approve_tab" aria-controls="enter_marks_tab"
                                        role="tab" data-toggle="tab">Bulk Subject Selection</a></li>
    <!--    <li role="presentation" class=""><a id="#upload_tab" href="#upload_tab" aria-controls="upload_tab"
                                   role="tab" data-toggle="tab">Upload Tab</a></li>                                                      -->
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane " id="transfer_tab">
        <div class="panel">
            <header class="panel-heading">
                Transfer Student
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="container col-md-12">
                        <form class="form-horizontal" role="form" method="post" id="reg_form"
                              action="<?php echo base_url('student/save_transfer_student') ?>" autocomplete="off"
                              novalidate enctype="multipart/form-data">

                            <section class="panel affixpanel" id="generaldata">

                                <div class="panel-body" style="padding-bottom: 30px;">
                                    <div class="row">
                                        <div class="form-group col-md-6" style="border-bottom: 0px;">
                                            <label class="col-md-3 control-label">Search Type</label>
                                            <div class="col-md-8">
                                                <input type="radio" name="search_type" id="search_reg_no" class="col-md-1"
                                                       value="0" onclick="search_stu_type()" checked="checked">
                                                <label class="col-md-3 control-label">Reg No</label>

                                                <input type="radio" name="search_type" id="search_nic_no" class="col-md-1"
                                                       value="1" onclick="search_stu_type()">
                                                <label class="col-md-4 control-label">NIC</label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="form-group col-md-6" style="border-bottom: 0px;">
                                            <label class="col-md-3 control-label" id="label_reg">Reg. No</label><label class="col-md-3 control-label" id="label_nic" hidden>NIC No</label>
                                            <div class="col-md-6">

                                                <input class="form-control student_search_transfer" list="reg_no_lists" name="reg_no_lists"
                                                       placeholder="Enter reg no">
                                                <datalist class="reg_no_lists" id="reg_no_lists">
                                                    <?php
                                                    foreach ($reg_no_list as $reg):
                                                        ?>
                                                        <option id="<?php echo $reg['stu_id']; ?>"
                                                                value="<?php echo $reg['reg_no']; ?>"></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </datalist>
                                                <datalist class="nic_no_lists" id="nic_no_lists">
                                                    <?php
                                                    foreach ($nic_no_list as $nic):
                                                        ?>
                                                        <option id="<?php echo $nic['stu_id']; ?>"
                                                                value="<?php echo $nic['nic_no']; ?>"></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary btn-md" name="search"
                                                        onclick="load_stu_id();">Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section class="panel_2">
                                <header class="panel-heading">
                                    Personal Details
                                </header>
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td width="20%">Register Number</td>
                                        <td><b><label id="lbl_reg_number_transfer"></label></b></td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Full Name</td>
                                        <td><b><label id="lbl_name_transfer"></label></b></td>
                                    </tr>
                                    <tr>
                                        <td width="20%">NIC Number</td>
                                        <td><b><label id="lbl_nic_no_transfer"></label></b></td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Address</td>
                                        <td><b><label id="lbl_permanent_address_transfer"></label></b></td>
                                    </tr>
                                    <tr>
                                        <td width="20%">E-Mail Address</td>
                                        <td><b><label id="lbl_email_transfer"></label></b></td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Gender</td>
                                        <td><b><label id="lbl_sex_transfer"></label></b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </section>

                            <section class="panel">
                                <header class="panel-heading">
                                    Student Details
                                </header>
                                <input type="hidden" id="stu_id" name="stu_id">
                                <br>
                                <div class="panel-body" style="padding-bottom: 30px;">
                                    <div class="row">
                                        <div class="form-group col-md-6" style="border-bottom: 0px;">
                                            <label class="col-md-3 control-label">ATI Center<span
                                                        style="color:red;font-size: 16px">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                global $branchdrop;
                                                global $selectedbr;
                                                //
                                                //                                if (isset($stu_data)) {
                                                //                                    $selectedbr = $stu_data['center_id'];
                                                //                                }

                                                $extraattrs = 'id="tt_branch" class="form-control" style="width:100%" data-validation="required" onchange="load_course_list(this.value,null,this)"';
                                                echo form_dropdown('center_id', $branchdrop, $selectedbr, $extraattrs);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="fax" class="col-md-2 control-label">Course<span
                                                        style="color:red;font-size: 16px">*</span></label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="course_id" name="course_id"
                                                        style="width:100%" data-validation="required"
                                                        onchange="set_reg_no(this)">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6" style="border-bottom: 0px;">
                                            <label for="fax" class="col-md-4 control-label">Course Type</label>
                                            <div class="col-md-8">
                                                <input type="radio" name="course_type" class="col-md-1" id="course_type"
                                                       value="F" checked="checked" onchange="course_type_on_change()">
                                                <label class="col-md-3 control-label">Full Time</label>

                                                <input type="radio" name="course_type" id="course_type" class="col-md-1"
                                                       value="P" onchange="course_type_on_change()">
                                                <label class="col-md-4 control-label">Part Time</label>
                                            </div>
                                            <label class="control-label" style="margin-left: 35%; color: red" id="partTimeChangeStatus_lbl"></label>
                                        </div>
                                        <div class="form-group col-md-6">

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="fax" class="col-md-3 control-label">Reg. No. <span
                                                        style="color:red;font-size: 16px">*</span></label>
                                            <table>
                                                <tr>
                                                    <td style="">
                                                        <input type="text" class="form-control" id="reg_no_part1"
                                                               name="reg_no_part1" placeholder="" value=""
                                                               style="width:100%;margin-left: 18px;">
                                                    </td>
                                                    <td id="td_reg_no_2">

                                                        <select class="form-control select22" name="reg_no_part2"
                                                                name="state" id="reg_no_part2"
                                                                onchange="reg_range_on_change()">
                                                            <option value=""></option>
                                                            <?php
                                                            $array_reg = explode("-", $student_reg_range[0]['RANGE_VALUES']);
                                                            for ($i = $array_reg[0]; $i <= $array_reg[1]; $i++) {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label style="width:100%;margin-left: 18px;color: red"
                                                               id="reg_no_error_txt"></label>
                                                    </td>
                                                    <td>
                                                        <label style="width:100%;margin-left: 18px;color: red"
                                                               id="reg_no_error_txt2"></label>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                            </section>
                            <section class="panel">
                                <div class="panel-body">
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-11" style="margin-left: 0;">

                                            <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" style="margin-right: 1%;">
                                                Save
                                            </button>

                                            <button onclick="event.preventDefault();$('#reg_form').trigger('reset');$('#id');$('#ref_t').val('');"
                                                    class="btn btn-default">Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="remove_tab">
        <div class="panel">
            <header class="panel-heading">
                Remove Student
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="" id="form_remove_student"
                      name="form_remove_student" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-md-6" style="border-bottom: 0px;">
                            <label class="col-md-3 control-label">Search Type</label>
                            <div class="col-md-8">
                                <input type="radio" name="search_type_remove" id="search_reg_no_remove" class="col-md-1"
                                       value="0" onclick="search_stu_remove_type()" checked="checked">
                                <label class="col-md-3 control-label">Reg No</label>

                                <input type="radio" name="search_type_remove" id="search_nic_no_remove" class="col-md-1"
                                       value="1" onclick="search_stu_remove_type()">
                                <label class="col-md-4 control-label">NIC</label>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label id="reg_remove" class="col-md-3 control-label">Reg. No</label><label id="nic_remove" class="col-md-3 control-label" hidden>NIC No</label>
                            <div class="col-md-6">

                                <input class="form-control remove_search_student" list="remove_reg_no_lists" name="remove_reg_no_lists"
                                       placeholder="Select Reg. No">
                                <datalist class="remove_reg_no_lists" id="remove_reg_no_lists">
                                    <?php
                                    foreach ($reg_no_list_remove as $reg):
                                        ?>
                                        <option id="<?php echo $reg['stu_id']; ?>"
                                                value="<?php echo $reg['reg_no']; ?>"></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </datalist>
                                <datalist class="remove_nic_no_lists" id="remove_nic_no_lists">
                                    <?php
                                    foreach ($nic_no_list_remove as $nic):
                                        ?>
                                        <option id="<?php echo $nic['stu_id']; ?>"
                                                value="<?php echo $nic['nic_no']; ?>"></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-md" name="search"
                                        onclick="load_remove_stu_id();">Search
                                </button>
                            </div>
                        </div>
                        <div class="container" style="width: 60%; float: left;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Personal Details</div>
                                <div class="panel-body">

                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td width="20%">Register Number</td>
                                            <td><b><label id="lbl_reg_number"></label></b></td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Full Name</td>
                                            <td><b><label id="lbl_name"></label></b></td>
                                        </tr>
                                        <tr>
                                            <td width="20%">NIC Number</td>
                                            <td><b><label id="lbl_nic_no"></label></b></td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Address</td>
                                            <td><b><label id="lbl_permanent_address"></label></b></td>
                                        </tr>
                                        <tr>
                                            <td width="20%">E-Mail Address</td>
                                            <td><b><label id="lbl_email"></label></b></td>
                                        </tr>
                                        <tr>
                                            <td width="20%">Gender</td>
                                            <td><b><label id="lbl_sex"></label></b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-md" name="search" onclick="remove_student()">Remove
                        Student
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="remove_student_tab">
        <div class="panel">
            <header class="panel-heading">
                Deactivated Students
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="student_removed_list" class="table table-striped table-bordered dt-responsive nowrap"
                               style="width:100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Register Number</th>
                                <th>Student Name</th>
                                <th>NIC No</th>
                                <th>Course Code</th>
                                <th>Batch Code</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tbl_body">
                            <?php
                            $i = 1;
                            if (!empty($removed_student_list)) {
                                foreach ($removed_student_list as $student) {
                                    ?>

                                    <tr>
                                        <td align="center"> <?php echo $i ?></td>
                                        <td style="width: 200px"> <?php echo $student['reg_no'] ?></td>
                                        <td> <?php echo $student['first_name']; //. " " . $student['last_name']                 ?></td>
                                        <td style="width: 140px"> <?php echo $student['nic_no'] ?></td>
                                        <td style="width: 140px"> <?php echo $student['course_code'] ?></td>
                                        <td style="width: 140px"> <?php echo $student['batch_code'] ?></td>
                                        <td align="left" style="width: 2px">
                                            <button data-toggle="tooltip" title="Activate"
                                                    onclick="event.preventDefault();update_stu_status('<?php print_r($student["stu_id"]) ?>', '0')"
                                                    class='btn btn-success btn-xs'><span
                                                        class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span>
                                            </button>
                                        </td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="terminate_batch_tab">
        <div class="panel">
            <div class="panel-heading">
                Terminate Batch
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="tb_course_id" name="tb_course_id" >
                                        <option value="">---Select Course---</option>
                                        <?php
                                        for ($sub = 0; $sub < sizeof($courses); $sub++) {
                                            echo '<option value="' . $courses[$sub]['id'] . '">' . $courses[$sub]['course_code'] . ' - ' . $courses[$sub]['course_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" id="terminate_batch_btn" name="terminate_batch_btn" onclick="load_terminate_batches();">Search</button>
                    </div>
                    <!--                    <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-md" id="load_transfer_full_data_btn" name="load_transfer_full_data_btn" onclick="load_transfer_full_data();"><span class="glyphicon glyphicon-print" id="basic-addon1"></span> Print Report</button>
                                        </div>-->
                </div>





                <br>
                <table class="table table-bordered" id="terminate_batch_table">
                    <thead id="load_thead">
                    <tr>
                        <th>Batch</th>
                        <th>Study Season</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="terminate_batch_table_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane active" id="enter_marks_tab">
        <div class="panel">
            <div class="panel-heading">
                Upload Exam Marks File
            </div>
            <div class="se-pre-con" style="display: none"></div>
            <div class="panel-body">
                <!--<form action="" method="" enctype="">-->

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="center" class="col-md-3 control-label">Center</label>
                            <div class="col-md-7">
                                <?php
                                global $branchdrop;
                                global $selectedbr;
                                $extraattrs = 'id="upload_centre" name="upload_centre" class="form-control" style="width:100%" onchange="upload_get_courses(this.value, 1, null)"';
                                echo form_dropdown('upload_centre', $branchdrop, $selectedbr, $extraattrs);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="course" class="col-md-3 control-label">Course</label>
                            <div class="col-md-9">
                                <select class="form-control" id="upload_course" name="upload_course"
                                        onchange="upload_get_course_code(this.value, 1, null, null)" data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="course" class="col-md-3 control-label">Year</label>
                            <div class="col-md-9">
                                <select class="form-control" id="upload_year" name="upload_year"
                                        onchange="upload_load_semesters(this.value, null)" data-validation="required"
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
                                <select class="form-control" id="upload_semester" name="upload_semester" onchange=""
                                        data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="batch" class="col-md-3 control-label">Batch</label>
                            <div class="col-md-7">
                                <select id="upload_batch" class="form-control" style="width:100%" name="upload_batch"
                                        onchange="upload_load_semester_exam(this.value)" data-validation="required"
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
                                <select id="upload_exam" class="form-control" style="width:100%" name="upload_exam"
                                        data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-7">
                                <label for="exampleFormControlFile1">Select File</label>
                                <input type="file" name="fileUpload" id="fileUpload" size="20" />
                            </div>
                        </div>
                    </div>
                </div> <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-4">
                                <button type="button" id="upload" class="btn btn-primary" onclick="uploadExcel()">Upload</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" id="upload" class="btn btn-primary" onclick="calculate_GPA()">Calculate GPA</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="bulk_subject_approve_tab">
        <div class="panel">
            <div class="panel-heading">
                Bulk Student Subject Selection
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Center</label>
                            <div class="col-md-7">
                                <?php
                                global $branchdrop;
                                global $selectedbr;
                                $extraattrs = 'id="bulk_centre" name="bulk_centre" class="form-control" style="width:100%" onchange="bulk_get_courses(this.value, 1, null)"';
                                echo form_dropdown('bulk_centre', $branchdrop, $selectedbr, $extraattrs);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Course</label>
                            <div class="col-md-9">
                                <select class="form-control" id="bulk_course" name="bulk_course"
                                        onchange="bulk_get_course_code(this.value, 1, null, null)" data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Year</label>
                            <div class="col-md-9">
                                <select class="form-control" id="bulk_year" name="bulk_year"
                                        onchange="bulk_load_semesters(this.value, null)" data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Semester</label>
                            <div class="col-md-9">
                                <select class="form-control" id="bulk_semester" name="bulk_semester" onchange=""
                                        data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Batch</label>
                            <div class="col-md-7">
                                <select id="bulk_batch" class="form-control" style="width:100%" name="bulk_batch"
                                        onchange="get_student_list(this.value, null);" data-validation="required"
                                        data-validation-error-msg-required="Field can not be empty">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <div class="col-md-7">
                                <button type="button" class="btn btn-primary" onclick="event.preventDefault();search_students();">Search</button>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-7">
                                <!--  <div class="col-md-offset-4 col-md-11">-->
                                <!--<button type="button" class="btn btn-primary" onclick="event.preventDefault();search_students();">Search</button>-->
                                <!--  </div>-->
                            </div>

                        </div>
                    </div>
                </div>
                <table id="bulk_approve_tbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll" name="chkAll"  /></th>
                        <th>Reg No</th>
                        <th>Core Subjects</th>
                        <th>Elective Subjects</th>
                    </tr>
                    </thead>
                    <tbody id="bulk_approve_body">

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-7">
                                <button type="button" id="approve_students" class="btn btn-primary" onclick="event.preventDefault();approve_students();">Save</button>
                            </div>
                        </div>
                    </div>
                </div><br>

            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane " id="upload_tab">
        <form action="" method="post" id="form_upload" enctype="multipart/form-data">
            <input type="file" name="image_file" id="image_file" />
            <br /><br />
            <input type="submit" value="upload" id="upload_img" name="upload_img" />
        </form><br><br>
        <div id="uploaded_image">

        </div>
    </div>
    <div id="dialog-confirm"></div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/util.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/upload_excel/xlsx.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/upload_excel/jszip.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript">

    $.validate({
        form: '#reg_form'
    });

    $('.datepicker').datepicker({
        autoclose: true
    });

    var center_code = '-';
    var course_code = '-';
    var course_type = 'F';

    var year = (new Date).getFullYear();

    var reg_part2 = "";

    $(document).ready(function () {
        $('#form_upload').on('submit',function(e){
            e.preventDefault();
            alert($('#image_file').val());
            if($('#image_file').val() == ""){
                alert('please select file');
            }else{
                $.ajax({
                    url:"<?php echo base_url('Student/do_upload'); ?>",
                    method:"POST",
                    data:new Formdata(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        $("#uploaded_image").html(data);
                    }
                });
            }
        });



        $('#div_course_type').hide();
        $("#reg_no_part1").prop('readonly', true);
        $('.select22').select2();

        $('#tt_branch').val("").attr('disabled', true);
        $('#course_id').attr('disabled', true);
        $("input[name=course_type]").attr('disabled', true);
        $('#reg_no_part2').attr('disabled', true);

        $('#student_removed_list').DataTable({
            'ordering': false,
            'lengthMenu': [10, 25, 50, 75, 100],
            "columnDefs": [{
                "targets": 4,
                "orderable": false
            }]
        });
        $('#bulk_approve_tbl').DataTable();


        $("#chkAll").click(function () {
            //Determine the reference CheckBox in Header row.
            var chkAll = this;

            //Fetch all row CheckBoxes in the Table.
            var chkRows = $("#bulk_approve_tbl").find(".sub_chk");

            //Execute loop over the CheckBoxes and check and uncheck based on
            //checked status of Header row CheckBox.
            chkRows.each(function () {
                $(this)[0].checked = chkAll.checked;
            });
        });

        $(".sub_chk").click(function () {
            //Determine the reference CheckBox in Header row.
            var chkAll = $("#chkAll");

            //By default set to Checked.
            chkAll.attr("checked", "checked");

            //Fetch all row CheckBoxes in the Table.
            var chkRows = $("#bulk_approve_tbl").find(".sub_chk");

            //Execute loop over the CheckBoxes and if even one CheckBox
            //is unchecked then Uncheck the Header CheckBox.
            chkRows.each(function () {
                if (!$(this).is(":checked")) {
                    chkAll.removeAttr("checked", "checked");
                    return;
                }
            });
        });






    });

    function clear_fields() {
        $('#lbl_reg_number').text('');
        $('#lbl_name').text('');
        $('#lbl_nic_no').text('');
        $('#lbl_permanent_address').text('');
        $('#lbl_email').text('');
        $('#lbl_sex').text('');
    }

    function remove_student() {
        var search_type_remove = $("input[name='search_type_remove']:checked").val();
        var reg_no = $("input[name=remove_reg_no_lists]").val();
        $("#dialog-confirm").html("Are you sure want to delete this record ?");

        $("#dialog-confirm").dialog({
            resizable: false,
            modal: true,
            title: "Remove Student",
            height: 140,
            width: 400,
            draggable: false,
            buttons: [
                {
                    text: "Yes",
                    "class": 'btn btn',
                    click: function () {
                        $(this).dialog('close');
                        $.post("<?php echo base_url('student/remove_student') ?>", {'reg_no': reg_no, 'search_type_remove': search_type_remove},
                            function (data) {
                                if (data != "") {
                                    clear_fields();
                                    //location.reload();
                                    funcres = {status: "success", message: "Student removed successfully !"};
                                    result_notification(funcres);
                                }
                            });
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

    }

    function load_stu_id() {
        var search_type = $("input[name='search_type']:checked").val();
        var reg_no = $("input[name=reg_no_lists]").val();

        $.post("<?php echo base_url('student/get_student_reg_id') ?>", {'reg_no': reg_no, 'search_type': search_type},
            function (data) {
                if (data != "") {
                    $('#tt_branch').attr('disabled', false);
                    $('#course_id').attr('disabled', false);
                    $("input[name=course_type]").attr('disabled', false);
                    $('#reg_no_part2').attr('disabled', false);


                    //console.log(data);
                    var sid = data[0]['stu_id'];

                    if (data[0]['course_type'] == 'F') {
                        $('#course_type').val('F');
                    } else {
                        $('#course_type').val('P');
                    }

                    $('#stu_id').val(sid);
                    $('#tt_branch').val(data[0]['center_id']);
                    $('#course_id').val(data[0]['course_id']);

                    load_course_list_by_id(data[0]['center_id'], data[0]['course_id']);

                    $('input[name=course_type][value=' + data[0]['course_type'] + ']').attr({checked: 'checked'});

                    if (data[0]['course_type'] == 'P') {
                        $('input[name=course_type][value="F"]').attr({disabled: true});
                        $('#partTimeChangeStatus_lbl').text("Part time students cannot transfer to full time.");
                    } else {
                        $('input[name=course_type][value="F"]').attr({disabled: false});
                        $('#partTimeChangeStatus_lbl').text("");
                    }

                    var reg = data[0]['reg_no'];
                    var reg_array = reg.split('/');

                    $('#reg_no_part1').val(reg_array[0] + "/" + reg_array[1] + "/" + reg_array[2] + "/" + reg_array[3] + "/");
                    $('#select2-reg_no_part2-container').text(reg_array[4]);
                    $('#reg_no_part2').val(reg_array[4]);

                    var reg_part1 = $('#reg_no_part1').val();
                    reg_part2 = reg_part1 + reg_array[4];

                    $('#lbl_reg_number_transfer').text(data[0]['reg_no']);
                    $('#lbl_name_transfer').text(data[0]['first_name']);
                    $('#lbl_nic_no_transfer').text(data[0]['nic_no']);
                    $('#lbl_permanent_address_transfer').text(data[0]['permanent_address']);
                    $('#lbl_email_transfer').text(data[0]['email']);
                    if (data[0]['sex'] == 'M')
                        $('#lbl_sex_transfer').text('Male');
                    else
                        $('#lbl_sex_transfer').text('Female');
                }

            },
            "json"
        );
    }

    function load_remove_stu_id() {
        var search_type = $("input[name='search_type_remove']:checked").val();
        var reg_no = $("input[name=remove_reg_no_lists]").val();
        clear_fields();

        $.post("<?php echo base_url('student/get_student_reg_id') ?>", {'reg_no': reg_no, 'search_type': search_type},
            function (data) {
                if (data != "") {
                    $('#lbl_reg_number').text(data[0]['reg_no']);
                    $('#lbl_name').text(data[0]['first_name']);
                    $('#lbl_nic_no').text(data[0]['nic_no']);
                    $('#lbl_permanent_address').text(data[0]['permanent_address']);
                    $('#lbl_email').text(data[0]['email']);
                    if (data[0]['sex'] == 'M')
                        $('#lbl_sex').text('Male');
                    else
                        $('#lbl_sex').text('Female');
                }


            },
            "json"
        );
    }

    function load_course_list(center_id, selected_id, selected) {
        //set REG NUmber..
        var sel_val = selected.options[selected.selectedIndex].text;
        center_code = sel_val.split('-')[0].trim();

        course_code = '-';

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                }
            },
            "json"
        );

    }

    function load_course_list_by_id(center_id, selected_course_id) {
        $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    if (selected_course_id == data[i]['course_id']) {
                        $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    } else {
                        $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }
                }
            },
            "json"
        );
    }

    function set_reg_no(sel) {
        //set REG NUmber..
        var sel_val = sel.options[sel.selectedIndex].text;
        course_code = sel_val.split('-')[0].trim();

        var sel_val2 = $("#tt_branch option:selected").text();
        center_code = sel_val2.split('-')[0].trim();

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        if ($('#reg_no_part2').val() != "") {
            load_data($('#reg_no_part1').val() + $('#reg_no_part2').val());
        }
    }

    function load_batches(id, selectedid, selected) {

        $('#batch_id').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('student/load_batches') ?>", {'id': id},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    for (var i = 0; i < data.length; i++) {

                        if (selectedid == data[i]['id']) {
                            $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['batch_code'] + ' - ' + data[i]['description']));
                        } else {
                            $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code'] + ' - ' + data[i]['description']));
                        }
                    }
                }
            },
            "json"
        );
    }

    function course_type_on_change() {
        var course_type_full = $('input[name=course_type]:checked').val();

        if (course_type_full == 'F') {
            $('#div_course_type').hide();
            course_type = 'F';
        } else if (course_type_full == 'P') {
            $('#div_course_type').show();
            course_type = 'P';
        }
        var sel_val = $("#tt_branch option:selected").text();
        center_code = sel_val.split('-')[0].trim();

        var sel_val2 = $("#course_id option:selected").text();
        course_code = sel_val2.split('-')[0].trim();

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        if ($('#reg_no_part2').val() != "") {
            load_data($('#reg_no_part1').val() + $('#reg_no_part2').val());
        }
    }

    function reg_range_on_change() {
        $.post("<?php echo base_url('student/load_student_reg_range') ?>", {},
            function (data) {
                var range = data[0]['RANGE_VALUES'].split('-');
                var range_array = [];
                console.info(range[0] + '-' + range[1]);
                for (var i = range[0]; i <= range[1]; i++) {
                    range_array.push(i);
                }
                $("#reg_no_part2").autocomplete({
                    source: range_array
                });
            },
            "json");

        if (($('#reg_no_part2').val()) != "") {
            $('#reg_no_error_txt2').text("");
        }

        load_data($('#reg_no_part1').val() + $('#reg_no_part2').val());
    }

    function load_data(reg_no) {

        $.post("<?php echo base_url('student/check_student_reg_no') ?>", {'reg_no': reg_no},
            function (data) {
                if (data['reg_count'] == "1") {
                    if (reg_no != reg_part2) {

                        $('#reg_no_error_txt').text("Register Number Already Exists");
                    } else {
                        $('#reg_no_error_txt').text("");
                    }

                } else {
                    $('#reg_no_error_txt').text("");
                }
            },
            "json"
        );
    }

    $('#reg_form').on('submit', function (e) {
        validateRegNoField(e)
    });

    function validateRegNoField(e) {
        var txt = $('#reg_no_error_txt').text();

        var reg_no_part2 = $('#reg_no_part2').val();

        if (reg_no_part2 == "") {
            e.preventDefault();

            funcres = {status: "denied", message: "Invalid Register Number"};
            result_notification(funcres);

            $('#reg_no_error_txt2').text("Invalid Register Number");

            return false;
        }

        if (txt != "") {
            e.preventDefault();

            funcres = {status: "denied", message: "Register Number Already Exists"};
            result_notification(funcres);

            return false;
        }

    }

    function update_stu_status(student_id, new_status) {
        var title = "";

        if (new_status == '1') {
            $("#dialog-confirm").html("Do you really want to deactivate this student?");
            title = 'Deactivate Student';
        } else {
            $("#dialog-confirm").html("Do you really want to activate this student?");
            title = 'Activate Student';
        }


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

                        // var batch_id = $('#l_Bcode').val();
                        $.ajax(
                            {
                                url: "<?php echo base_url('student/change_student_status') ?>",
                                type: 'POST',
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: {'student_id': student_id, 'new_status': new_status},
                                success: function (data) {
                                    if (data == 'denied') {
                                        funcres = {
                                            status: "denied",
                                            message: "You have no right to proceed the action"
                                        };
                                        result_notification(funcres);
                                    } else {
                                        /* if (batch_id == '' || batch_id == 0 || batch_id == null) {
                                         location.reload();
                                         } else {
                                         search_details();
                                         }*/
                                        // location.reload();
                                        search_details();
                                        result_notification(data);
                                        // $("#tabs").tabs("select", "#remove_student_tab");
                                    }
                                }
                            });
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

    }


    function search_details() {


        $.post("<?php echo base_url('Student/load_remove_student_list') ?>", {},
            function (data) {
                if (data == 'denied') {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else {
                    if (data.length > 0) {
                        $('#tbl_body').find('tr').remove();
                        $('#student_removed_list').DataTable().clear();
                        for (j = 0; j < data.length; j++) {
                            action_content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='update_stu_status(" + data[j]['stu_id'] + ",0);'></span></button>";

                            // content2 = " |<a class='btn btn-info btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>|";
                            //  $('#tbl_body').append("<tr><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td><td>" + data[j]['nic_no'] + "</td><td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_co_id'] + ");'></span></button>"  + content + "</td></tr>");
                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                            //action_content = "<td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='event.preventDefault();load_stueditview(" + data[j]['stu_co_id'] + ");'></span></button>|" + content + "</td>";
                            $('#student_removed_list').DataTable().row.add([
                                number_content,
                                data[j]['reg_no'],
                                data[j]['first_name'], // + " " + data[j]['last_name'],
                                data[j]['nic_no'],
                                data[j]['course_code'],
                                data[j]['batch_code'],
                                action_content
                            ]).draw(false);
                        }


                    } else {
                        $('#tbl_body').find('tr').remove();
                        $('#student_removed_list').DataTable().clear();
                        $('#tbl_body').append("<tr><td colspan='8' align='center'>No data available in table</td></tr>");


                    }
                }
            },
            "json"
        );

    }

    function load_terminate_batches() {
        $('.se-pre-con').fadeIn('slow');
        var tb_course_id = $('#tb_course_id').val();
        if (tb_course_id == "") {
            funcres = {status: "denied", message: "Course cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else {

            $.post("<?php echo base_url('Student/search_terminate_batch_lookup') ?>", {'tb_course_id': tb_course_id},
                function (data)
                {
                    console.log(data);
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else {
                        $('#terminate_batch_table').DataTable().destroy();
                        $('#terminate_batch_table').DataTable({
                            'ordering': true,
                            'lengthMenu': [10, 25, 50, 75, 100],
                            "columnDefs": [
                                {"targets": 3,
                                    "className": 'text-center'
                                }
                            ]
                        });
                        $('#terminate_batch_table').DataTable().clear().draw();
                        $('#terminate_batch_table').removeAttr('disabled');
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";

                            action_content = "<td align='center'>\n\
                                                     <button data-toggle='tooltip' title='Deactivate'onclick='event.preventDefault();update_terminate_batch(" + data[j]['id'] + ")' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                            $('#terminate_batch_table').DataTable().row.add([
                                //number_content,
                                data[j]['batch_code'],
                                data[j]['ac_startdate'] + "   -   " + data[j]['ac_enddate'],
                                data[j]['description'],
                                action_content



                            ]).draw(false);
                        }
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
            );
        }
    }


    function update_terminate_batch(batch_id)
    {
        var title = "";

        $("#dialog-confirm").html("Do you really want to deactivate this batch?");
        title = 'Deactivate Batch';
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

                        $.ajax(
                            {
                                url: "<?php echo base_url('Student/update_batch_terminate_status') ?>",
                                type: 'POST',
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: {'batch_id': batch_id},
                                success: function (data)
                                {
                                    if (data == 'denied')
                                    {
                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                        result_notification(funcres);
                                    } else
                                    {
//                                        if (batch_id == '' || batch_id == 0 || batch_id == null) {
//                                            location.reload();
//                                        } else {

                                        load_terminate_batches();
//                                        }

                                        result_notification(data);
                                    }
                                }
                            });
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

    }

    function search_stu_type() {
        if ($('#search_reg_no').is(":checked")) {
            $('#label_nic').hide();
            $('#label_reg').show();
            $(".student_search_transfer").attr("placeholder", "Enter reg no");
            $(".student_search_transfer").attr("list", "reg_no_lists");
            $(".reg_no_lists").attr("id", "reg_no_lists");
//        $(".nic_no_lists").removeAttr("id");
            $(".student_search_transfer").val('');
            $('#reg_form').trigger("reset");

            //reset fields
            $('.student_search_transfer').val("");
            $('#tt_branch').val("");
            $("#course_id option").remove();
            $("input[name=course_type]").val("");
            $('#reg_no_part1').val("");
            $('#reg_no_part2').val("");
            $('#lbl_reg_number_transfer').text('');
            $('#lbl_name_transfer').text('');
            $('#lbl_nic_no_transfer').text('');
            $('#lbl_permanent_address_transfer').text('');
            $('#lbl_email_transfer').text('');
            $('#lbl_sex_transfer').text('');

        } else if ($('#search_nic_no').is(":checked")) {
            $('#label_nic').show();
            $('#label_reg').hide();
            $(".student_search_transfer").attr("placeholder", "Enter nic no");
            $(".student_search_transfer").attr("list", "nic_no_lists");
            $(".nic_no_lists").attr("id", "nic_no_lists");
            $(".reg_no_lists").removeAttr("id");
            $(".student_search_transfer").val('');


            //reset fields
            $('.student_search_transfer').val("");
            $('#tt_branch').val("");
            $("#course_id option").remove();
            $("input[name=course_type]").val("");
            $('#reg_no_part1').val("");
            $('#reg_no_part2').val("");
            $('#lbl_reg_number_transfer').text('');
            $('#lbl_name_transfer').text('');
            $('#lbl_nic_no_transfer').text('');
            $('#lbl_permanent_address_transfer').text('');
            $('#lbl_email_transfer').text('');
            $('#lbl_sex_transfer').text('');
        }
    }


    function search_stu_remove_type() {
        if ($('#search_reg_no_remove').is(":checked")) {
            $('#nic_remove').hide();
            $('#reg_remove').show();
            $(".remove_search_student").attr("placeholder", "Enter reg no");
            $(".remove_search_student").attr("list", "remove_reg_no_lists");
            $(".remove_reg_no_lists").attr("id", "remove_reg_no_lists");
            $(".remove_search_student").val('');


            //reset fields
            $('#lbl_reg_number').text('');
            $('#lbl_name').text('');
            $('#lbl_nic_no').text('');
            $('#lbl_permanent_address').text('');
            $('#lbl_email').text('');
            $('#lbl_sex').text('');



        } else if ($('#search_nic_no_remove').is(":checked")) {
            $('#nic_remove').show();
            $('#reg_remove').hide();
            $(".remove_search_student").attr("placeholder", "Enter nic no");
            $(".remove_search_student").attr("list", "remove_nic_no_lists");
            $(".remove_nic_no_lists").attr("id", "remove_nic_no_lists");
            $(".remove_search_student").val('');

            //reset fields
            $('#lbl_reg_number').text('');
            $('#lbl_name').text('');
            $('#lbl_nic_no').text('');
            $('#lbl_permanent_address').text('');
            $('#lbl_email').text('');
            $('#lbl_sex').text('');

        }
    }


    //////////////////////////////////////////

    function upload_get_courses(center_id, flag, course_id) {
//                                                $('#uppload_course').find('option').remove().end().append('<option value="">------Select Course------</option>').val('');
        $('#upload_course').find('option').remove().end().append('<option value="">------Select Course------</option>').val('');
        if (flag === 1) {
            $.post("<?php echo base_url('Year/load_course_programs') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (course_id == data[i]['course_id']) {
                            $('#upload_course').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                        } else {
                            $('#upload_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    }
                },
                "json"
            );
        }
    }

    function upload_get_course_code(course_id, flag, year_no, batch_id) {
        $('#upload_year').find('option').remove().end().append('<option value="">------Select Year-----</option>').val('');
        $('#upload_batch').find('option').remove().end().append('<option value="">-----Select Batch-----</option>').val('');

        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (flag) {
                            if (i == year_no) {
                                $('#upload_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                            } else {
                                $('#upload_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                            }
                        } else {
                            $('#upload_year').append($("<option></option>").attr("value", i).text(i + " Year"));

                        }
                    }
                }

                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
                    function (data) {

                        for (j = 0; j < data.length; j++) {
                            if (data[j]['id'] == batch_id) {
                                $('#upload_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                            } else {
                                $('#upload_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            }
                        }

                    },
                    "json"
                );
            },
            "json"
        );
    }

    function upload_load_semesters(year_no, semester_no) {
        //$('#year').find('option').remove().end().append('<option value=""></option>').val('');
        //$('#semester').find('option').remove().end();
        $('#upload_semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        $('#upload_rpt_semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        var course_id = $('#upload_course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                for (var i = 1; i <= data; i++) {
                    if (semester_no == i) {

                        $('#upload_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                        $('#upload_rpt_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                    } else {
                        $('#upload_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                        $('#upload_rpt_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                    }
                }
            },
            "json"
        );
    }

    function upload_load_semester_exam(batch_id) {
        $('#upload_exam').find('option').remove().end().append('<option value="">-----Select Exam-----</option>').val('');
        $.post("<?php echo base_url('exam/load_semester_exam') ?>", {'batch_id': batch_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {

                    $('#upload_exam').append($("<option></option>").attr("value", data[i]['exam_id']).text(data[i]['exam_code'] + " - " + data[i]['exam_name']));
                }
            },
            "json"
        );
    }
    /*
    function upload_marks() {
        var name = 1;
        var email = 1;
        //var phone = $("#phone").val();
        //var message = $("#message").val();

        $.ajax({
            url: "<?php// echo base_url('subject/dummy_save_exam_marks') ?>",
                                                    type: 'POST',
                                                    async: true,
                                                    cache: false,
                                                    dataType: 'json',
                                                    data: {name: name, email: email},
                                                    success: function (data)
                                                    {
                                                        if (data == 'denied')
                                                        {
                                                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                            result_notification(funcres);
                                                        } else
                                                        {

                                                            //location.reload();
                                                        }
                                                    }
                                                });


//                                                var center_id = $('#upload_centre').val();
//                                                var course_id = $('#upload_course').val();
//                                                var year_id = $('#upload_year').val();
//                                                var semester_id = $('#upload_semester').val();
//                                                var batch_id = $('#upload_batch').val();
//                                                var exam_id = $('#upload_exam').val();
//                                                var exam_id = $('#upload_exam').val();
//                                                //var file = $('#upload_file').val();
//                                                var res = [];
//                                                //alert(file);
//
//                                                var file = $('#upload_file').val().split('.').pop().toLowerCase();
//
//
//                                                if (center_id == "") {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Center';
//                                                    result_notification(res);
//                                                } else if (course_id == "") {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Course';
//                                                    result_notification(res);
//                                                } else if (year_id == "") {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Year';
//                                                    result_notification(res);
//                                                } else if (semester_id == "") {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Semester';
//                                                    result_notification(res);
//                                                } else if (batch_id == "") {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Batch';
//                                                    result_notification(res);
//                                                } else if (exam_id == "") {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Exam';
//                                                    result_notification(res);
//                                                }else if ($.inArray(file, ['xlsx', 'xls', 'xlsm']) == -1) {
//                                                    res['status'] = 'denied';
//                                                    res['message'] = 'Please Select Excel Document';
//                                                    result_notification(res);
//                                                }else{
//                                                    //code
//                                                }
                                            }
                                            */
    //////////////////////////////////////////

    function bulk_get_courses(center_id, flag, course_id){
        $('#bulk_course').find('option').remove().end().append('<option value="">------Select Course------</option>').val('');
        if (flag === 1) {
            $.post("<?php echo base_url('Year/load_course_programs') ?>", {'center_id': center_id},
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        if (course_id == data[i]['course_id']) {
                            $('#bulk_course').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                        } else {
                            $('#bulk_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    }
                },
                "json"
            );
        }
    }

    function bulk_get_course_code(course_id, flag, year_no, batch_id) {
        $('#bulk_year').find('option').remove().end().append('<option value="">------Select Year-----</option>').val('');
        $('#bulk_batch').find('option').remove().end().append('<option value="">-----Select Batch-----</option>').val('');

        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (flag) {
                            if (i == year_no) {
                                $('#bulk_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                            } else {
                                $('#bulk_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                            }
                        } else {
                            $('#bulk_year').append($("<option></option>").attr("value", i).text(i + " Year"));

                        }
                    }
                }

                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
                    function (data) {

                        for (j = 0; j < data.length; j++) {
                            if (data[j]['id'] == batch_id) {
                                $('#bulk_batch').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                            } else {
                                $('#bulk_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            }
                        }

                    },
                    "json"
                );
            },
            "json"
        );
    }

    function bulk_load_semesters(year_no, semester_no) {
        //$('#year').find('option').remove().end().append('<option value=""></option>').val('');
        //$('#semester').find('option').remove().end();
        $('#bulk_semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        $('#bulk_rpt_semester').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');
        var course_id = $('#bulk_course').val();
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data) {
                for (var i = 1; i <= data; i++) {
                    if (semester_no == i) {

                        $('#bulk_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                        $('#bulk_rpt_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                    } else {
                        $('#bulk_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                        $('#bulk_rpt_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                    }
                }
            },
            "json"
        );
    }

    function load_year_subjects(){






    }

    function get_student_list(batch_id, student_id){
        var status = 0;
        if(student_id != null){
            status = 1;
        }else{
            status = 0;
        }

        return status;
        //alert(status);
        //search_students(status);
    }

    function search_students(){
        var status = get_student_list();
        //alert(status);
        var course_id = $('#bulk_course').val();
        var semester_no = $('#bulk_semester').val();
        var year_no = $('#bulk_year').val();
        var batch_id = $('#bulk_batch').val();
        var branch = $('#bulk_centre').val();


        $('.se-pre-con').fadeIn('slow');
        $.post("<?php echo base_url('student/get_student_list_by_level') ?>",{
                'batch_id': batch_id,
                'branch': $('#bulk_centre').val(),
                'year':  $('#bulk_year').val(),
                'semester':  $('#bulk_semester').val(),
                'status': status
            },function (data){
                if (data == 'denied'){
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                }else{
                    $('#bulk_approve_tbl').DataTable().destroy();
                    $('#bulk_approve_tbl').DataTable({
                        'ordering': false,
                        'paging': false
                    });

                    $('#bulk_approve_tbl').DataTable().clear().draw();

                    if (data.length > 0) {
                        for (var j = 0; j < data.length; j++) {
                            var check = "<td align='center'><input name='app_stu_id[]' id='app_stu_id' value='"+ data[j]['stu_id'] +"' type='hidden' /><input class='sub_chk' type='checkbox' name='student_check' id ='"+ data[j]['stu_id'] +"' value='' data-id='"+ data[j]['stu_id'] +"'></div></td>";
                            var core_sel_subs = "<td align='center'><div class='cb' name='core_subjects'><input type='hidden' id='subj_group' name='subj_group' /></div></td>";
                            var elec_sel_subs = "<td align='center'><div class='eb' name='elec_subjects'><input type='hidden' id='subj_group' name='subj_group' /></div></td>";
                            //var check_box_subs = "<td align='center'><p class='ee_group' id'555'><input type='hidden' name='e_subject_version' id='e_subject_version' value='111'><input type='checkbox' id='vehicle' name='vehicle' value='1'> I have a bike</p><br><p><input type='hidden' name='e_subject_version' id='e_subject_version' value='222'><input type='checkbox' id='vehicle' name='vehicle' value='2'> I have a car</p><br><p><input type='hidden' name='e_subject_version' id='e_subject_version' value='333'><input type='checkbox' id='vehicle' name='vehicle' value='3'> I have a boat</p><br><br></div></td>";
                            $('#bulk_approve_tbl').DataTable().row.add([
                                check,
                                data[j]['reg_no'],
                                core_sel_subs,
                                //check_box_subs,
                                elec_sel_subs
                            ]).draw(false);

                        }
                    }
                }

                $.post("<?php echo base_url('student/get_semester_subjects') ?>", {
                        'course_id': course_id,
                        'semester_no': semester_no,
                        'batch_id': batch_id,
                        'year_no': year_no
                    },
                    function (data)
                    {
                        if(data == 'denied')
                        {
                            funcres = {status:"denied", message:"You have no right to proceed the action"};
                            result_notification(funcres);
                        }
                        else
                        {
                            if(data.length > 0){
                                for (j = 0; j < data.length; j++) {

                                    $('#subj_group').val(data[j]['subject_group_id']);
                                    $('.cs_div').attr('id', data[j]['subject_group_id']);
                                    $('.es_div').attr('id', data[j]['subject_group_id']);

                                    if (data[j]['type'] == 1) {
                                        $(".cb").append("<p class='cs_div' id=''><input type='hidden' name='c_subject' id='c_subject' value='" + data[j]['subject_id'] + "'> <input type='hidden' name='c_subject_version' id='c_subject_version' value='" + data[j]['version_id'] + "'>" + data[j]['subject'] + "<p>");
                                        //$(".eb").text('N/A');
                                    } else {
//                                                                        $("#elective_subjects").append("<tr><td><input type='checkbox' name='e_subject[]' id ='e_subject' value='" + data[j]['subject_id'] + "'><input type='hidden' name='e_subject_version[]' id='e_subject_version' value='" + data[j]['version_id'] + "'>&nbsp;&nbsp;&nbsp;" + data[j]['subject'] + "</td></tr>");
                                        $(".eb").append("<p class='es_div' id=''><input type='checkbox' name='e_subject' id ='e_subject' value='" + data[j]['subject_id'] + "'><input type='hidden' name='e_subject_version' id='e_subject_version' value='" + data[j]['version_id'] + "'>&nbsp;&nbsp;&nbsp;" + data[j]['subject'] + "<p>");
                                    }
                                }

                                $('#subject_save').attr('disabled', false);
                            }
                            else{
                                $('#subject_save').attr('disabled', true);
                            }
                        }

                    },
                    "json"
                );
                $('.se-pre-con').fadeOut('slow');
            },"json"
        );







    }

    function approve_students(){
        var subj_center_t = $('#bulk_centre').val();
        var subj_course_t = $('#bulk_course').val();
        var subj_year_t = $('#bulk_year').val();
        var subj_semester_t = $('#bulk_semester').val();
        var subj_batch_t = $('#bulk_batch').val();
        var subj_version_t = $('#c_subject_version').val();
        var e_subj_version_t = $('#e_subject_version').val();

        //var subj_group_t = $('#subj_group').val();


        var values = $("#bulk_approve_tbl input[name=student_check]:checked").map(function() {
            var row = $(this).closest("tr");


            return {
                //checkbox_id : $(this).val(),
                //hidden_id   : $(row).find("input[name=id]").val(),

                ccheck_student_id     : $(row).find("input[id=app_stu_id]").val(),
                core_sub_group        : $(row).find(".cs_div").attr("id"),
                elect_sub_group        : $(row).find(".cs_div").attr("id"),
                core_subsjects: $(row).find("p input[name=c_subject]").map(function() {
                    return {
                        arrayOfValues1: $(this).val(),
                        arrayOfValues2: $(this).closest("p").find("input[name=c_subject_version]").val()
                    };
                }).get(),

                elect_subs: $(row).find("p input[name=e_subject]:checked").map(function() {
                    return {
                        arrayOfValues1: $(this).val(),
                        arrayOfValues2: $(this).closest("p").find("input[name=e_subject_version]").val()
                    }
                }).get(),





//                                                        elect_subs: $(row).find("p input[name=e_subject]:checked").map(function() {
//                                                            return {
//                                                                arrayOfValues1: $(this).val(),
//                                                                arrayOfValues2: $(this).closest("p").find("input[name=e_subject_version]").val()
//                                                            }
//                                                        }).get(),

                //core_subs             : $(row).find("input[id=subj_group]").map(function(){return $(this).val();}).get(),
                //check_box_subs        : $(row).find("input[id=vehicle]:checked").map(function(){return $(this).val();}).get()
                //radio       : $(row).find('input[type=radio]:checked').val() || "not selected"
            };
        }).get();

        console.log(values);
        //console.log(values.length);

        var a = 1;
        var studentString = [];
        var coreString = [];
        for(var i=0; i < values.length; i++){
            for(var j=0; j < values[i]['ccheck_student_id'].length; j++){
                studentString  += values[i]['ccheck_student_id'] + ",";
            }
        }
        console.log(studentString);
        console.log(coreString);

        var dataString = JSON.stringify(values);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('student/dummy_update_subjects') ?>',
            dataType: 'json',
            data: {
                myData: dataString,
                subj_center:subj_center_t,
                subj_course:subj_course_t,
                subj_year:subj_year_t,
                subj_semester:subj_semester_t,
                subj_batch:subj_batch_t,
                //subj_group:subj_group_t,
                //c_subject_version:subj_version_t,
                //e_subject_version:e_subj_version_t
            },
            success: function(msg) {
                //alert(msg);
                funcres = {status: "success", message: "Students Subjects are Saved"};
                result_notification(funcres);
                location.reload();
            }
        });





//                                                var allVals = [];
//                                                $(".sub_chk:checked").each(function() {
//                                                    allVals.push($(this).attr('id'));
//                                                });
//
//                                                if(allVals.length <= 0){
//                                                    alert("Please select row.");
//                                                }else{
//                                                    var check = confirm("Are you sure you want to add those rows");
//                                                    if(check == true){
//                                                        var join_selected_values = allVals.join(",");
//
//                                                        $.ajax({
//                                                           url: '<?php //echo base_url('student/dummy_update_subjects') ?>',
//                                                           type: 'POST',
//                                                           dataType: 'json',
//                                                           data: 'ids='+join_selected_values,
//                                                           success: function (data) {
//
////                                                             $(".sub_chk:checked").each(function() {
////                                                                 $(this).parents("tr").remove();
////                                                             });
//                                                             alert("Item Deleted successfully.");
//                                                           },
//                                                           error: function (data) {
//                                                               alert(data.responseText);
//                                                            }
//                                                        });
//
//
//                                                     }
//                                                }
    }




    function uploadExcel() {
        $(".se-pre-con").css("display", "block");
        //$('.se-pre-con').fadeIn('slow');
        //Reference the FileUpload element.
        var fileUpload = document.getElementById("fileUpload");

        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();

                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        processExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        processExcel(data);

                    };

                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Please upload a valid Excel file.");
        }

    };


    function processExcel(data) {

        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
        var batch_id = $('#upload_batch').val();
        var course_id = $('#upload_course').val();
        var year_no = $('#upload_year').val();
        var semester_no = $('#upload_semester').val();
        var sem_exam_id = $('#upload_exam').val();
        var center_id = $('#upload_centre').val();
        var data_array = [];
        //$('.se-pre-con').fadeOut('slow');
        //$('.se-pre-con').fadeIn('slow');
        //$('.se-pre-con').show();
        //$(".se-pre-con").css("display", "block");
        $.ajax(
            {
                url: "<?php echo base_url('upload_exam_marks/get_student_details_for_excel_file_upload')  ?>",
                type: 'POST',
                async: false,
                cache: false,
                dataType: 'json',
                data: {
                    'excelRows': excelRows,
                    'batch_id': batch_id,
                    'course_id': course_id,
                    'year_no': year_no,
                    'semester_no': semester_no,
                    'sem_exam_id': sem_exam_id,
                    'center_id': center_id
                    // 'student_registration_number': value['StudentRegNo'],
                    // 'subject_code': value['SubjectName'],

                },
                success: function (data) {
                    // console.log("success");
                    //$('.se-pre-con').fadeIn('slow');
                    //$('.se-pre-con').hide();

                    //$('.se-pre-con').fadeOut('slow');
                    $('#fileUpload').attr('value', '');
                    
                    $(".se-pre-con").css("display", "none");
                    console.log(data['status']);
                    if (data['status'] == "success" ) {

                        data1['status'] = 'success';
                        data1['message'] = 'Bulk student marks updated successfully!';
                        result_notification(data1);
                    } else {
                        data1['status'] = 'denied';
                        data1['message'] = 'Bulk student marks updated failed to be updated successfully!';
                        result_notification(data1);
                    }
                }
            }
        );
    };


    function processExcel_Back(data) {
        //Read the Excel File data.
        var workbook = XLSX.read(data, {
            type: 'binary'
        });

        //Fetch the name of First Sheet.
        var firstSheet = workbook.SheetNames[0];

        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

        var batch_id = $('#upload_batch').val();
        var course_id = $('#upload_course').val();
        var year_no = $('#upload_year').val();
        var semester_no = $('#upload_semester').val();
        var sem_exam_id = $('#upload_exam').val();
        var center_id = $('#upload_centre').val();

        var data_array = [];

        jQuery.each( excelRows, function( index, value ) {
            var flag = null;
            var ca_mark = null;
            var se_mark = null;
            var assignment_only = 0;

            if(value['ExamType'] == 'CA'){
                //for CA marks
                flag = true;
                ca_mark = parseInt(value['Marks']);
            }else{
                //for SE marks
                flag = false;
                se_mark = parseInt(value['Marks']);
            }

            $.ajax(
                {
                    url: "<?php echo base_url('subject/get_student_details_for_excel_file_upload')  ?>",
                    type: 'POST',
                    async: false,
                    cache: false,
                    dataType: 'json',
                    data: {
                        'student_registration_number': value['StudentRegNo'],
                        'subject_code': value['SubjectName']
                    },
                    success: function (data) {
                        data_array = {
                            'student_id' : data['student_id'],
                            'course_id' : course_id,
                            'center_id': center_id,
                            'year_no' : year_no,
                            'semester_no' : semester_no,
                            'batch_id' : batch_id,
                            'sem_exam_id' : sem_exam_id,
                            'subject_id' : data['subject_id']
                        };
                        generateResultAndGrade(ca_mark,se_mark,flag,assignment_only,data_array);
                    }
                });
        });
    };


    function generateResultAndGrade(ca_mark,se_mark,flag,assignment_only,row) {

        /* For flag send true if a CA mark,else send false.
         * For percentage if flag is true send CA percentage, else if flag is flase send SE percentage.
         * If assignment only subject then pass 1 as parameter.
         * When calculating result for SE, if CA mark is already saved in exm_mark_detail table retrieve it from table and pass to this functionto calculate total grade.
         * $absent_reson_approve and $is_attend parameters can retrieve by exm_semester_exam_details table and pass those values to this function to calculate result grade.        
         */
        var totalmarks = 0;
        var grade = null;
        var grade_point = null;
        var result_grade = null;
        var gradeing_details = null;
        var absent_reson_approve = null;
        var is_attend = null;
        var se_percentage = 0;
        var subject_credits = 0;
        var ca_percentage = 0;
        var ca_type = 0;
        var se_type = 0;
        var mark_type = null;
        var persentage = [];
        var type_id = [];
        var subject_mark = [];
        var ca_type_in_db = 0;
        var ca_percentage_in_db = 0;

        $.ajax(
            {
                url: "<?php echo base_url('Student/get_relevent_marking_details')  ?>",
                type: 'POST',
                async: false,
                cache: false,
                dataType: 'json',
                data: {'course_id': row['course_id'], 'year_no': row['year_no'], 'sem_no': row['semester_no'], 'batch_no': row['batch_id'], 'subject_id': row['subject_id']},
                success: function (data) {

                    for (var i = 0; i < data.length; i++) {
                        var grading_id = data[i]['grading_method_id'];
                        if(data[i]['type_id'] == 1){
                            se_percentage = parseInt(data[i]['percentage']);
                            //se_type = data[i]['type_id'];
                        } else{
                            ca_percentage = parseInt(data[i]['percentage']);
                            //ca_type = data[i]['type_id'];
                        }
                        subject_credits = parseInt(data[i]['new_credits']);

                        $.ajax(
                            {
                                url: "<?php echo base_url('Grading_method/get_grades')  ?>",
                                type: 'POST',
                                async: false,
                                cache: false,
                                dataType: 'json',
                                data: {'grading_id': grading_id},
                                success: function (data) {
                                    gradeing_details = data;

                                    $.ajax(
                                        {
                                            url: "<?php echo base_url('subject/get_is_attend_and_absent_reson_approve')  ?>",
                                            type: 'POST',
                                            async: false,
                                            cache: false,
                                            dataType: 'json',
                                            data: {'student_id': row['student_id'], 'subject_id': row['subject_id']},
                                            success: function (data) {

                                                is_attend = data['is_attend'];
                                                absent_reson_approve = data['is_absent_approve'];

                                                if (flag) {
                                                    //----CALCULATE CA RESULT-----
                                                    mark_type = "ca_mark";
                                                    if(ca_mark<=100 && ca_mark != null && ca_mark != ''){
                                                        totalmarks = ((parseFloat((ca_mark*(ca_percentage/100)))).toFixed(2));

                                                        persentage[0] = se_percentage;
                                                        persentage[1] = ca_percentage;

                                                        type_id[0] = 1;
                                                        type_id[1] = 2;

                                                        subject_mark[0] = 0;
                                                        subject_mark[1] = ca_mark;

                                                        console.log("--------CA MARK----------------");
                                                        console.log(ca_mark);
                                                        console.log(totalmarks);
                                                        console.log(ca_percentage);
                                                        console.log(is_attend);
                                                        console.log(absent_reson_approve);

                                                        //----FOR ASSIGNMENT(CA) ONLY SUBJECTS----
                                                        if(assignment_only == 1){
                                                            var ca_total_rounded_marks = 0;

                                                            ca_total_rounded_marks = Math.ceil(totalmarks);
                                                            grade = overall_grade('NE',ca_mark,ca_total_rounded_marks,gradeing_details,false);
                                                            grade_point = overall_grade('NE',ca_mark,ca_total_rounded_marks,gradeing_details,true);
                                                            result_grade = result_grades(is_attend,absent_reson_approve,'NE',ca_mark,ca_total_rounded_marks,gradeing_details);
                                                        }

                                                        save_exam_marks_to_db(row, totalmarks, grade, result_grade, persentage, type_id, subject_mark, grade_point, subject_credits, mark_type);
                                                    }

                                                } else {
                                                    //----CALCULATE SE RESULT-----
                                                    mark_type = "se_mark";
                                                    var total_rounded_marks = 0;
                                                    var se_mark_for_total = 0;
                                                    var ca_mark_for_total = 0;

                                                    $.ajax(
                                                        {
                                                            url: "<?php echo base_url('Student/load_student_wise_exam_marks_for_file_upload')  ?>",
                                                            type: 'POST',
                                                            async: false,
                                                            cache: false,
                                                            dataType: 'json',
                                                            data: {
                                                                'batch_id': row['batch_id'],
                                                                'year': row['year_no'],
                                                                'semester': row['semester_no'],
                                                                'course_id': row['course_id'],
                                                                'center_id': row['center_id'],
                                                                'exam_id': row['sem_exam_id'],
                                                                'student_id': row['student_id'],
                                                                'subject_id': row['subject_id']
                                                            },
                                                            success: function (data) {

                                                                for (var j = 0; j < data.length; j++) {
                                                                    for (var x = 0; x < data[j]['exam_mark'].length; x++) {
                                                                        if(data[j]['exam_mark'][x]['exam_type_id'] == 2){
                                                                            ca_type_in_db = parseInt(data[j]['exam_mark'][x]['exam_type_id']);
                                                                            ca_percentage_in_db = parseInt(data[j]['exam_mark'][x]['persentage']);
                                                                            ca_mark_for_total = parseInt(data[j]['exam_mark'][x]['mark']);
                                                                        }
                                                                    }
                                                                }

                                                                if(se_mark === '' || se_mark === null){
                                                                    se_mark_for_total=0;
                                                                } else {
                                                                    se_mark_for_total = se_mark;
                                                                }

                                                                persentage[0] = se_percentage;
                                                                persentage[1] = ca_percentage_in_db;

                                                                type_id[0] = 1;
                                                                type_id[1] = ca_type_in_db;

                                                                subject_mark[0] = se_mark;
                                                                subject_mark[1] = ca_mark_for_total;

                                                                console.log(persentage);
                                                                console.log(type_id);
                                                                console.log(subject_mark);

                                                                if(se_mark<=100 || se_mark==0 ) {
                                                                    totalmarks = ((parseFloat(se_mark_for_total) * (1 - se_percentage / 100)) + (parseFloat(ca_mark_for_total) * (ca_percentage_in_db / 100))).toFixed(2);
                                                                    total_rounded_marks = Math.ceil(totalmarks);

                                                                    console.log("--------SE MARK----------------");
                                                                    console.log(se_mark);
                                                                    console.log(se_mark_for_total);
                                                                    console.log(ca_mark_for_total);
                                                                    console.log(totalmarks);
                                                                    console.log(total_rounded_marks);
                                                                    console.log(ca_percentage);
                                                                    console.log(se_percentage);
                                                                    console.log(is_attend);
                                                                    console.log(absent_reson_approve);

                                                                    grade = overall_grade(se_mark,totalmarks,total_rounded_marks,gradeing_details,false);
                                                                    grade_point = overall_grade(se_mark,ca_mark_for_total,total_rounded_marks,gradeing_details,true);
                                                                    result_grade = result_grades(is_attend,absent_reson_approve,se_mark,ca_mark_for_total,total_rounded_marks,gradeing_details);

                                                                    save_exam_marks_to_db(row, totalmarks, grade, result_grade, persentage, type_id, subject_mark, grade_point, subject_credits, mark_type);
                                                                }
                                                            }
                                                        });
                                                }
                                            }
                                        });
                                }
                            });
                    }
                }
            });
    }


    function save_exam_marks_to_db(row, totalmarks, grade, result_grade, persentage, type_id, subject_mark, grade_point, subject_credits, mark_type){

        $.ajax(
            {
                url: "<?php echo base_url('exam/save_exam_marks')  ?>",
                type: 'POST',
                async: false,
                cache: false,
                dataType: 'json',
                data: {
                    'student_id': row['student_id'],
                    'subject_id': row['subject_id'],
                    'total_mark': totalmarks,
                    'overall_grade': grade,
                    'result_grade': result_grade,
                    'course_id': row['course_id'],
                    'year_no': row['year_no'],
                    'semester_no': row['semester_no'],
                    'batch_id': row['batch_id'],
                    'persentage': persentage,
                    'type_id': type_id,
                    'subject_mark': subject_mark,
                    'exam_id': row['sem_exam_id'],
                    'grade_point': grade_point,
                    'subject_point': subject_credits,
                    'repeat_val': 0,
                    'mark_type': mark_type
                },
                success: function (data) {
                    console.log("success");
                    $('.se-pre-con').fadeOut('slow');
                    $('#fileUpload').attr('value', '');
                    data['status'] = "success";
                    data['message'] = "Bulk student marks successfully !";
                    result_notification(data);
                }
            });
    }



    function calculate_GPA()
    {
        var gpa_batch = $('#upload_batch').val();
        var gpa_course = $('#upload_course').val();
        var gpa_year = $('#upload_year').val();
        var gpa_semester = $('#upload_semester').val();
        var gpa_sem_exam_id = $('#upload_exam').val();
        var gpa_center = $('#upload_centre').val();

        //1. get student SE student IDs from DB according to exam..
        $.ajax(
            {
                url: "<?php echo base_url('exam/calculate_student_gpa')  ?>",
                type: 'POST',
                async: false,
                cache: false,
                dataType: 'json',
                data: {
                    'gpa_center': gpa_center,
                    'gpa_course': gpa_course,
                    'gpa_year': gpa_year,
                    'gpa_semester': gpa_semester,
                    'gpa_batch': gpa_batch,
                    gpa_sem_exam_id : gpa_sem_exam_id
                },
                success: function (data) {

                    console.log("success");
                    if (data['status'] == "success" ) {

                        data['status'] = 'success';
                        data['message'] = 'Bulk student GPA updated successfully!';
                        result_notification(data);
                    } else {
                        data['status'] = 'denied';
                        data['message'] = 'Bulk student GPA updated successfully!';
                        result_notification(data);
                    }
                }
            });
        //2. calculate GPA and  overall GPA for each students.
        //3. Save  GPA and Overall GPA in to DB.


    }


</script>

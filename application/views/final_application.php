<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Jquery File Uploader -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrapfile/css/fileinput-rtl.min.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/plugins/purify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrapfile/js/fileinput.min.js') ?>"></script>
<style>
    .panel .panel-heading i {
        border-right: none;
    }

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal1 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal1-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close1 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close1:hover,
    .close1:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal2 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal2-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close2 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close2:hover,
    .close2:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal3 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal3-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close3 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close3:hover,
    .close3:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal4 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal4-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close4 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close4:hover,
    .close4:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal5 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal5-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close5 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close5:hover,
    .close5:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal6 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal6-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close6 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close6:hover,
    .close6:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal7 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    .modal7-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close7 {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close7:hover,
    .close7:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Final Application (Mahapola)</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Student</li>
            <li><i class="fa fa-bank"></i>Mahapola form</li>
        </ol>
    </div>
</div>
<div class="panel">
    <header class="panel-heading">
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="post"
                      action="<?php echo base_url('student/save_student_mahapola'); ?>" id="stu_reg_mahapola"
                      enctype="multipart/form-data" autocomplete="off" novalidate>
                    <img height="109" width="67"
                         src="https://upload.wikimedia.org/wikipedia/commons/5/5f/Emblem_of_Sri_Lanka.svg" alt="logo">
                    <img style="float: right;" height="109" width="67"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/SLIATE_LOGO2.png/220px-SLIATE_LOGO2.png"
                         alt="logo">
                    <h2 style="text-align:center" ;>Sri Lanka Institute of Advanced Technological Education</h2>
                    <h4 style="text-align:center;background: #d4d3d3;" ;>Application for mahapola scholarship awarded by
                        the mahapola Higher education scholarships trust fund</h4>
                    <b>Very important – Please carefully read the instructions given , before completing this
                        application form.</b>

                    <!--                    <input type="hidden" id="stu_id" name="stu_id" value="<?php //echo $stu_id; ?>">-->
                    <!--                    <input type="hidden" id="stu_id" name="stu_id" value="<?php //echo($_COOKIE["stu_id"]); ?>">-->
                    <input type="hidden" id="stu_id" name="stu_id"
                           value="<?php echo urldecode(base64_decode($_GET["id"])); ?>">
                    <input type="hidden" id="mahapola_id" name="mahapola_id" value="">
                    <input type="hidden" id="reg_no" name="reg_no" value="">
                    <input type="hidden" id="center_id" name="center_id" value="">
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            01. Primary Student Information
                        </header>
                        <div class="panel-body">
                            <div class="form-group col-md-12">
                                <!--<label for="name" class="col-md-2 control-label">Title:</label>-->
                                <div class="col-md-6">
                                    <div class="col-xs-12">
                                        <table style="width:70%" cellspacing="0">
                                            <tr>
                                                <?php
                                                $i = 1;
                                                foreach ($title_list as $title) {
                                                    if ($i == 1) {
                                                        ?>
                                                        <td><input type="radio" name="title"
                                                                   value="<?php echo $title['id'] ?>"
                                                                   checked=""><?php echo $title['title_name'] ?><br>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td><input type="radio" name="title"
                                                                   value="<?php echo $title['id'] ?>"><?php echo $title['title_name'] ?>
                                                            <br></td>
                                                        <?php
                                                    }
                                                    $i++;
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Full Name of Applicant (in English
                                        block letters):<span style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" placeholder="Full Name"
                                               data-validation="required"
                                               data-validation-error-msg-required="Field can not be empty"
                                               name="full_name" id="full_name">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label class="col-md-12 control-label">Postal Address:<span
                                                style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        <textarea rows="4" class="form-control" placeholder="Postal Address"
                                                  data-validation="required"
                                                  data-validation-error-msg-required="Field can not be empty"
                                                  name="address" id="address" readonly="true"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">National Identity Card No:<span
                                                style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="National Identity Card No"
                                               data-validation="required"
                                               data-validation-error-msg-required="Field can not be empty" name="nic"
                                               id="nic" readonly="true">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label class="col-md-12 control-label">Fixed Telephone No:</label>
                                    <div class="col-xs-7">
                                        <input type="text" class="form-control" placeholder="Fixed Telephone No"
                                               name="telephone" id="telephone" data-validation="number length"
                                               data-validation-length="10-10"
                                               data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567"
                                               data-validation-error-msg-length="Must be 10 characters long"
                                               readonly="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" class="col-md-12 control-label">Mobile No:</label>
                                    <div class="col-md-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="Mobile No" name="mobile"
                                               id="mobile" data-validation-length="10-10"
                                               data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567"
                                               data-validation-error-msg-length="Must be 10 characters long">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-md-12 control-label">Distance(KM):<span
                                                style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-md-7" style="margin-bottom: 10px;">

                                        <input type="text" class="form-control" placeholder="Distance" name="distance" id="distance" data-validation="required number" data-validation-error-msg-required="Field cannot be empty" data-validation-error-msg-number="Invalid distance" data-validation-allowing="range[0.00;500.00],float">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">G.C.E. (A/L) Examination
                                        Year:<span style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="(A/L) Examination Yar"
                                               data-validation="number required"
                                               data-validation-error-msg-required="Field can not be empty"
                                               name="al_year" id="al_year" readonly="true">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Index Number:<span
                                                style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="Index Number"
                                               data-validation="required"
                                               data-validation-error-msg-required="Field can not be empty"
                                               name="al_index" id="al_index" readonly="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" class="col-md-12 control-label">Average Z- score:<span
                                                style="color:red;font-size: 16px">*</span></label>
                                    <div class="col-xs-8">
                                        <table>
                                            <td>
                                                <select id="operator" name="operator">
                                                    <option value="+">+</option>
                                                    <option value="-">-</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Average Z- score"
                                                       data-validation="required "
                                                       data-validation-error-msg-required="Field can not be empty"
                                                       name="al_z_score" id="al_z_score" readonly="true">

                                            </td>
                                        </table>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 10px;"></div>
                                </div>
                            </div>
                            <hr style="width: 100%;">
                            <div class="row">
                                <div class="col-xs-10" style="margin-bottom: 20px;">
                                    <label for="name" class="col-md-12 control-label">Subject Stream:</label>
                                    <div class="col-xs-10">
                                        <table style="width:100%" cellspacing="5">
                                            <tr>
                                                <td><input type="radio" name="al_subject_stream" value="ART">Art<br>
                                                </td>
                                                <td><input type="radio" name="al_subject_stream" value="BIO_S"
                                                           checked="">Bio Science<br></td>
                                                <td><input type="radio" name="al_subject_stream"
                                                           value="COM">Commerce<br></td>
                                                <td><input type="radio" name="al_subject_stream" value="MTH">Mathematics<br>
                                                </td>
                                                <td><input type="radio" name="al_subject_stream" value="TECH">Technology<br>
                                                </td>
                                                <td><input type="radio" name="al_subject_stream" value="OTHR">Other<br>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            02. Family Details <!-- FD : famil details-->
                        </header>
                        <div class="panel-body">
                            <p>(a) State details of school going brothers and sisters who are 18 years or below else the
                                details of children, if you are married.&nbsp;&nbsp;<i class="fa fa-question-circle"
                                                                                       id="myBtn"
                                                                                       style="font-size: 120%"></i>
                                <br><B>You should send the certified copies of the relevant birth certificates along
                                    with the application.</B></p>
                            <!--<table class="table table-bordered table-striped exam_table dataTable no-footer" id="exam_table" role="grid" aria-describedby="exam_table_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 35%;">Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15%;">Date of Birth</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15%;">Age as at</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 35%;">Name of school where he/ she is studying</th>
                                    </tr>	
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_name1" id="fd_name1" onblur="calculate_schl_attendies()"></td>
                                        <td>
                                            <div id="" class="input-group date" >
                                                <input class="form-control datepicker" type="text" name="fd_dob1" id="fd_dob1"  data-format="YYYY-MM-DD" value="">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                                </span>
                                            </div>
                                        </td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_age_as_at1" id="fd_age_as_at1" onblur="calculate_schl_attendies()" data-validation="number" data-validation-error-msg-number="Invalid year" data-validation-optional="true"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_scl_name1" id="fd_scl_name1"></td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_name2" id="fd_name2" onblur="calculate_schl_attendies()"></td>
                                        <td>
                                            <div id="" class="input-group date" >
                                                <input class="form-control datepicker" type="text" name="fd_dob2" id="fd_dob2"  data-format="YYYY-MM-DD" value="">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                                </span>
                                            </div>
                                        </td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_age_as_at2" id="fd_age_as_at2" onblur="calculate_schl_attendies()" data-validation="number" data-validation-error-msg-number="Invalid year" data-validation-optional="true"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_scl_name2" id="fd_scl_name2"></td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_name3" id="fd_name3" onblur="calculate_schl_attendies()"></td>
                                        <td>
                                            <div id="" class="input-group date" >
                                                <input class="form-control datepicker" type="text" name="fd_dob3" id="fd_dob3"  data-format="YYYY-MM-DD" value="">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                                </span>
                                            </div>
                                        </td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_age_as_at3" id="fd_age_as_at3" onblur="calculate_schl_attendies()" data-validation="number" data-validation-error-msg-number="Invalid year" data-validation-optional="true"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_scl_name3" id="fd_scl_name3"></td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_name4" id="fd_name4"></td>
                                        <td>
                                            <div id="" class="input-group date" >
                                                <input class="form-control datepicker" type="text" name="fd_dob4" id="fd_dob4"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                                </span>
                                            </div>
                                        </td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_age_as_at4" id="fd_age_as_at4" data-validation="number" data-validation-error-msg-number="Invalid year" data-validation-optional="true"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="fd_scl_name4" id="fd_scl_name4"></td>
                                    </tr>
                                </tbody>
                            </table>-->

                            <!--Models start-->
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate1.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal1" class="modal">
                                <div class="modal-content">
                                    <span class="close1">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate2.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal2" class="modal">
                                <div class="modal-content">
                                    <span class="close2">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate3.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal3" class="modal">
                                <div class="modal-content">
                                    <span class="close3">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate4.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal4" class="modal">
                                <div class="modal-content">
                                    <span class="close4">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate5.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal5" class="modal">
                                <div class="modal-content">
                                    <span class="close5">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate6.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal6" class="modal">
                                <div class="modal-content">
                                    <span class="close6">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate7.PNG') ?>">
                                </div>
                            </div>

                            <div id="myModal7" class="modal">
                                <div class="modal-content">
                                    <span class="close7">&times;</span>
                                    <img height="100%" width="100%" src="<?php echo base_url('img/translate8.PNG') ?>">
                                </div>
                            </div>
                            <!--Models end-->

                            <br><br>

                            <div class="col-md-4">
                                <label name="schl_concession" id="schl_concession">Number of Student below 18 years who
                                    are attending Schools :</label>
                            </div>
                            <div class="col-md-8">
                                <input style="width:100px" type="text" class="form-control" placeholder=""
                                       name="fd_scl_attendies" id="fd_scl_attendies" onblur="calculate_schl_attendies()"
                                       data-validation="number" data-validation-error-msg-number="Invalid number"
                                       data-validation-optional="true">
                            </div>
                            <br><br>
                            <label name="schl_concession" id="schl_concession">School children Concession RS. : </label><span
                                    style="font-weight: bold"><label name="lbl_schl_concession"
                                                                     id="lbl_schl_concession"></label></span>
                            <br><br>
                            <hr>
                            <p>(b) If you have any brothers or sisters following courses of study in a
                                university/institute/ ATI, give following details.&nbsp;&nbsp;&nbsp;&nbsp;<i
                                        class="fa fa-question-circle" id="myBtn1" style="font-size: 120%"></i></p>
                            <!--<table class="table table-bordered table-striped exam_table dataTable no-footer" id="exam_table" role="grid" aria-describedby="exam_table_info">
                                <thead> 
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 25%;">Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15%;">Name of the university/ institute/ ATI where the course of study is being followed</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15%;">Course of study</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15%;">Year of G.C.E. (A/L) Examination</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 15%;">Index number of G.C.E. (A/L) Examination</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 25%;">Whether in receipt of a Mahapola scholarship/ Bursary or not</th>
                                    </tr>	
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_stu_name1" id="ou_stu_name1" onblur="calculate_uni_attendies()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_uni_name1" id="ou_uni_name1" onblur="calculate_uni_attendies()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_course_name1" id="ou_course_name1" onblur="calculate_uni_attendies()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_al_year1" id="ou_al_year1" data-validation="number" data-validation-error-msg-number="Invalid year" data-validation-optional="true"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_al_index1" id="ou_al_index1"></td>
                                        <td align="center">
                                            <label class="col-md-3 control-label">Yes</label><input type="radio" name="ou_mahapola_bursary1" class="col-md-1" id="ou_mahapola_bursary1" value="Y" checked="" onchange="calculate_uni_attendies()">
                                            <label class="col-md-3 control-label">No</label><input type="radio" name="ou_mahapola_bursary1" class="col-md-1" id="ou_mahapola_bursary1" value="N" onchange="calculate_uni_attendies()">
                                        </td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_stu_name2" id="ou_stu_name2" onblur="calculate_uni_attendies()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_uni_name2" id="ou_uni_name2" onblur="calculate_uni_attendies()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_course_name2" id="ou_course_name2" onblur="calculate_uni_attendies()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_al_year2" id="ou_al_year2" data-validation="number" data-validation-error-msg-number="Invalid year" data-validation-optional="true"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou_al_index2" id="ou_al_index2"></td>
                                        <td align="center">
                                            <label class="col-md-3 control-label">Yes</label><input type="radio" name="ou_mahapola_bursary2" class="col-md-1" id="ou_mahapola_bursary2" value="Y" checked="" onchange="calculate_uni_attendies()">
                                            <label class="col-md-3 control-label">No</label><input type="radio" name="ou_mahapola_bursary2" class="col-md-1" id="ou_mahapola_bursary2" value="N" onchange="calculate_uni_attendies()">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>-->
                            <br>
                            <br><br>

                            <div class="col-md-4">
                                <label name="ou_concession" id="ou_concession">Number of university attendees:</label>
                            </div>
                            <div class="col-md-8">
                                <input style="width:100px" type="text" class="form-control" placeholder=""
                                       name="ou_attendies" id="ou_attendies" onblur="calculate_uni_attendies()"
                                       data-validation="number" data-validation-error-msg-number="Number should less than 2 !"
                                       data-validation-optional="true" data-validation-allowing="range[0;1]">
                            </div>
                            <br><br><br><br>
                            <b>Note:- You should attach the original letter from the respective university/
                                institute/Advanced Technological Institute certifying that your brother/ sister (stated
                                above) is not in receipt of a Mahapola scholarship or a Bursary.</b>
                            <br>
                            <label name="uni_concession" id="schl_concession">University student Concession RS.
                                : </label><span style="font-weight: bold"><label name="lbl_uni_concession"
                                                                                 id="lbl_uni_concession"></label></span>
                            <!--<hr>
                            <p>(c) Give details of any brothers or sisters selected to follow a course of study in a university/ institute/ ATI based on the results of the G.C.E. (A/L) Examination, 2016.</p>
                            <table class="table table-bordered table-striped exam_table dataTable no-footer" id="exam_table" role="grid" aria-describedby="exam_table_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Name</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Index number</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >NIC Number</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Course of study</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >University Institute or ATI</th>
                                    </tr>	
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_stu_name1" id="ou2_stu_name1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_al_index1" id="ou2_al_index1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_nic1" id="ou2_nic1" onkeyup="validate_nic('ou2_nic1')">
                                            <label id="lbl_nic1_validate" class="col-md-10 control-label" style="color: red"></label></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_course_name1" id="ou2_course_name1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_uni_name1" id="ou2_uni_name1"></td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_stu_name2" id="ou2_stu_name2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_al_index2" id="ou2_al_index2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_nic2" id="ou2_nic2" onkeyup="validate_nic('ou2_nic2')">
                                        <label id="lbl_nic2_validate" class="col-md-10 control-label" style="color: red"></label></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_course_name2" id="ou2_course_name2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="ou2_uni_name2" id="ou2_uni_name2"></td>
                                    </tr>
                                </tbody>
                            </table>-->
                        </div>
                    </section>

                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            03. Income from estates, fields, lands etc.   <!-- ic : income -->
                        </header>
                        <div class="panel-body">
                            <!--<table class="table table-bordered table-striped exam_table dataTable no-footer" id="exam_table" role="grid" aria-describedby="exam_table_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Name of Owner</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Relationship</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Location</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Nature of cultivation</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Extent of land & details of property</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Annual income (in Rs.)</th>
                                    </tr>	
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_owner_name1" id="inc_owner_name1" onblur="calculate_land_income()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_relation1" id="inc_relation1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_location1" id="inc_location1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_cultivation1" id="inc_cultivation1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_prop_details1" id="inc_prop_details1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_annual_income1" id="inc_annual_income1" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true" onblur="calculate_land_income()"></td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_owner_name2" id="inc_owner_name2" onblur="calculate_land_income()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_relation2" id="inc_relation2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_location2" id="inc_location2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_cultivation2" id="inc_cultivation2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_prop_details2" id="inc_prop_details2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inc_annual_income2" id="inc_annual_income2" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true" onblur="calculate_land_income()"></td>
                                    </tr>
                                </tbody>
                            </table>-->

                            <div class="col-md-4">
                                <label name="ou_concession" id="ou_concession"> Income from estates, fields, lands
                                    etc.</label>
                            </div>
                            <div class="col-md-8">
                                <input style="width:100px" type="text" class="form-control" placeholder=""
                                       name="land_income" id="land_income" onblur="calculate_land_income()"
                                       data-validation="number" data-validation-error-msg-number="Invalid number"
                                       data-validation-optional="true">
                            </div>
                            <br><br>

                            <b>Note:- You should attach an income assessment report issued and certified by the
                                Divisional Secretariat to prove the income from estates, fields, lands etc stated in
                                above 3.&nbsp;&nbsp;<i class="fa fa-question-circle" id="myBtn2"
                                                       style="font-size: 120%"></i></b>
                            <br><br>
                            <label name="land_income" id="land_income">Income from estates, land, etc Rs.
                                : </label><span style="font-weight: bold"><label name="lbl_land_income"
                                                                                 id="lbl_land_income"></label></span>
                        </div>
                    </section>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            04. Income from houses rented or leased.
                        </header>
                        <div class="panel-body">
                            <!--<table class="table table-bordered table-striped exam_table dataTable no-footer" id="exam_table" role="grid" aria-describedby="exam_table_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Name of Owner</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Relationship</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Assessment No.</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Address</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >Annual income (in Rs.)</th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="exam_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" >If given on rent/ lease name and address of tenant/ lessee</th>
                                    </tr>	
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd"> 
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_owner_name1" id="inct_owner_name1" onblur="calculate_rent_income()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_relation1" id="inct_relation1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_assessment_no1" id="inct_assessment_no1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_address1" id="inct_address1"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_anual_income1" id="inct_anual_income1" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true" onblur="calculate_rent_income()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_lease_name1" id="inct_lease_name1"></td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_owner_name2" id="inct_owner_name2" onblur="calculate_rent_income()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_relation2" id="inct_relation2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_assessment_no2" id="inct_assessment_no2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_address2" id="inct_address2"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_anual_income2" id="inct_anual_income2" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true" onblur="calculate_rent_income()"></td>
                                        <td><input type="text" class="form-control" placeholder=""  name="inct_lease_name2" id="inct_lease_name2"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">No. of the Grama Niladhari Division where the above houses are located:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="no_of_division" id="no_of_division">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">D.S. Division:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="ds_division" id="ds_division">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="name" class="col-md-12 control-label">Name of the local authority:</label>
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="Name of the local authority" name="local_authority" id="local_authority">
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-4">
                                <label name="ou_concession" id="ou_concession"> Income from houses rented or leased.&nbsp;&nbsp;<i
                                            class="fa fa-question-circle" id="myBtn3"
                                            style="font-size: 120%"></i></label>
                            </div>
                            <div class="col-md-8">
                                <input style="width:100px" type="text" class="form-control" placeholder=""
                                       name="rent_income" id="rent_income" onblur="calculate_rent_income()"
                                       data-validation="number" data-validation-error-msg-number="Invalid number"
                                       data-validation-optional="true">
                            </div>
                            <br><br>
                            <b>Note:- You should attach an income assessment report issued and certified by the
                                Divisional Secretariat to prove the income from houses rented or leased stated in above
                                4.</b>
                            <br><br>
                            <label name="land_income" id="land_income">Income from Rent or Leased Rs. : </label><span
                                    style="font-weight: bold"><label name="lbl_rent_income"
                                                                     id="lbl_rent_income"></label></span>

                        </div>
                    </section>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            05. If you are involved in any work that generating income&nbsp;&nbsp;<i
                                    class="fa fa-question-circle" id="myBtn4" style="font-size: 90%"></i>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="col-sm-7">
                                        <label class="col-md-3 control-label">Yes</label>
                                        <input type="radio" name="employeement_status" class="col-md-1"
                                               id="employeement_status" value="Y"
                                               onchange="load_employeement_status()"<?php //echo $selected_cvlstat  ?>>

                                        <label class="col-md-3 control-label">No</label>
                                        <input type="radio" name="employeement_status" id="employeement_status"
                                               class="col-md-1" value="N" onchange="load_employeement_status()"
                                               checked="true" <?php //echo  $selected_cvlstat2  ?>>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Name of the Company / Department:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="empld_name" id="empld_name">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Address of the Company / Department:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <textarea  rows="4" class="form-control" placeholder="" name="empld_address" id="empld_address"></textarea>
                                    </div>
                                </div>
                            </div>-->
                            <br><br>
                            <div class="row">
                                <!--                                <div class="col-xs-6">
                                                                    <label for="name" class="col-md-12 control-label">Post:</label>
                                                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                        <input type="text" class="form-control" placeholder="" name="empld_post" id="empld_post">
                                                                    </div>
                                                                </div>-->
                                <div class="col-md-2">
                                    <label for="name" class="col-md-12 control-label">Salary:</label>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="" name="empld_salary"
                                           id="empld_salary" data-validation="number"
                                           data-validation-error-msg-number="only digits"
                                           data-validation-optional="true" onblur="calculate_employment_income()">
                                </div>
                            </div>
                            <!--</div>-->
                            <!--<div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Date of appointment:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <div id="" class="input-group date" >
                                            <input class="form-control datepicker" type="text" name="empld_dateofapp" id="empld_dateofapp"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <label name="schl_concession" id="employment_sal">Employment Income Rs. : </label><span
                                    style="font-weight: bold"><label name="lbl_emplyment_income"
                                                                     id="lbl_emplyment_income"></label></span>
                        </div>
                    </section>
                    <h5></h5>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            06. If you are married&nbsp;&nbsp;<i class="fa fa-question-circle" id="myBtn5"
                                                                 style="font-size: 90%"></i><!-- sp : spouse-->
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="col-sm-7">
                                        <label class="col-md-3 control-label">Single</label>
                                        <input type="radio" name="civil_status" class="col-md-1" id="civil_status"
                                               value="S"
                                               onchange="load_married_data()"<?php //echo $selected_cvlstat  ?>>

                                        <label class="col-md-3 control-label">Married</label>
                                        <input type="radio" name="civil_status" id="civil_status" class="col-md-1"
                                               value="M"
                                               onchange="load_married_data()" <?php //echo  $selected_cvlstat2  ?>>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!--                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Date of marriage:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <div id="" class="input-group date" >
                                            <input class="form-control datepicker" type="text" name="sp_date_of_marriage" id="sp_date_of_marriage"  data-format="YYYY-MM-DD" value="<?php ?>" data-validation="required" data-validation-error-msg-required="Required field !" data-validation-optional="true">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Name of the spouse:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="spouse_name" id="spouse_name">
                                    </div>
                                </div>
                            </div>-->
                            <!--                            <p>If he/she is employed</p>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">The Name of the company:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="spouse_com_name" id="spouse_com_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">The Address of the company:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <textarea  rows="4" class="form-control" placeholder="" name="spouse_com_address" id="spouse_com_address"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="row">
                                <!--                                <div class="col-xs-6">
                                                                    <label for="name" class="col-md-12 control-label">Present salary (State monthly gross salary including all allowances. Salary particulars certified by the respective employer should be attached):</label>
                                                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                        <input type="text" class="form-control" placeholder="" name="spouse_salary" id="spouse_salary" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true">
                                                                    </div>
                                                                </div>-->
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Total Gross annual income of the
                                        family (from all sources including the occupation) as at 31.12.2017:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder=""
                                               name="spouse_annual_income" id="spouse_annual_income"
                                               onblur="calculate_full_income()" data-validation="number"
                                               data-validation-error-msg-number="only digits"
                                               data-validation-optional="true">
                                    </div>
                                </div>
                            </div>
                            <b>Note :- If you are married, a certified copy of the marriage certificate should be
                                attached.</b>
                            <br><br>
                            <label name="family_income" id="employment_sal">Family Income Rs. : </label><span
                                    style="font-weight: bold"><label name="lbl_family_income"
                                                                     id="lbl_family_income"></label></span>
                        </div>
                    </section>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            07. Details of Father <!-- fa : father -->
                        </header>
                        <div class="panel-body">
                            <!--                            <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Full Name:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="fa_name" id="fa_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <label for="name" class="col-md-12 control-label">Whether living or not:</label>
                                                                <table style="width:50%" cellspacing="0">
                                                                    <tr>
                                                                        <td><input type="radio" name="fa_live" value="A" checked=""> Alive<br></td>
                                                                        <td><input type="radio" name="fa_live" value="D"> Dead<br></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>-->
                            <!--                            &nbsp;<p>(If expired, copy of the death certificate should be submitted)</p>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">If living, age:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="fa_age" id="fa_age">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Father’s occupation (If not living or retired, employment prior to death or retirement):</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="fa_occupation" id="fa_occupation">
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <!--                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">If your father is retired, state the date of retirement:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <div id="" class="input-group date" >
                                            <input class="form-control datepicker" type="text" name="fa_retired_date" id="fa_retired_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">If your father’s service is terminated state the date of termination:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <div id="" class="input-group date" >
                                            <input class="form-control datepicker" type="text" name="fa_termination_date" id="fa_termination_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!--                            <p>(You should attach a certified copy of the letter issued by the respective employer as a documentary evidence. )</p>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Address of the place of work / worked:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <textarea  rows="4" class="form-control" placeholder="" name="fa_wp_address" id="fa_wp_address"></textarea>  fa_wp_address : wprk place address
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">State gross annual income from occupation / pension (from 01st January to 31st December 2017) Rs.</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="fa_annual_income" id="fa_annual_income" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true">
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <p>Note :- State father’s gross annual income from occupation / Pension [Salary particulars
                                including all allowances certified by the respective employer should be attached
                                (Original letter) or, if your father is an entrepreneur/ self-employed, an income
                                assessment report certified by the relevant authorities should be attached. (From
                                January 2017 to December 2017) ]</p>
                            <div class="col-xs-6">
                                <label for="name" class="col-md-12 control-label">Father’s annual income from all other
                                    sources in addition to the income mentioned in section 3,4 and 7(8) above
                                    Rs.</label>
                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" placeholder="" name="fa_other_income"
                                           id="fa_other_income" data-validation="number"
                                           data-validation-error-msg-number="only digits"
                                           data-validation-optional="true" onblur="calculate_full_income()">
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            08. Details of Mother
                        </header>
                        <div class="panel-body">
                            <!--                            <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Full Name:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="mo_name" id="mo_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Whether living or not:</label>
                                                                <table style="width:50%" cellspacing="0">
                                                                    <tr>
                                                                        <td><input type="radio" name="mo_live" value="A" checked=""> Alive<br></td>
                                                                        <td><input type="radio" name="mo_live" value="D"> Dead<br></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>-->
                            <!--                            &nbsp;<p>(If expired, copy of the death certificate should be submitted)</p>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">If living, age:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="mo_age" id="mo_age">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Mother’s occupation (If not living or retired, employment prior to death or retirement):</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="mo_occupation" id="mo_occupation">
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <!--                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">If your mother is retired, state the date of retirement:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="mo_retired_date" id="mo_retired_date">
                                        <div id="" class="input-group date" >
                                            <input class="form-control datepicker" type="text" name="mo_retired_date" id="mo_retired_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">If your mother’s service is terminated state the date of termination:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="mo_termination_date" id="mo_termination_date">
                                        <div id="" class="input-group date" >
                                            <input class="form-control datepicker" type="text" name="mo_termination_date" id="mo_termination_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!--                            <p>(You should attach a certified copy of the letter issued by the respective employer as a documentary evidence. )</p>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Address of the place of work / worked:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <textarea  rows="4" class="form-control" placeholder="" name="mo_wp_address" id="mo_wp_address"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">State gross annual income from occupation / pension (from 01st January to 31st December 2017) Rs.</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="mo_annual_income" id="mo_annual_income" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true">
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <p>Note :- State mother’s gross annual income from occupation / Pension [Salary particulars
                                including all allowances certified by the respective employer should be attached
                                (Original letter) or, if your father is an entrepreneur/ self-employed, an income
                                assessment report certified by the relevant authorities should be attached. (From
                                January 2017 to December 2017) ]</p>
                            <div class="col-xs-6">
                                <label for="name" class="col-md-12 control-label">Mother’s annual income from all other
                                    sources in addition to the income mentioned in section 3,4 and 7(8) above
                                    Rs.</label>
                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" placeholder="" name="mo_other_income"
                                           id="mo_other_income" data-validation="number"
                                           data-validation-error-msg-number="only digits"
                                           data-validation-optional="true" onblur="calculate_full_income()">
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            09. Total gross annual income of father and mother [grand total of sections 7 and 8]:&nbsp;&nbsp;<i
                                    class="fa fa-question-circle" id="myBtn6" style="font-size: 90%"></i>
                        </header>
                        <div class="panel-body">
                            <div class="col-xs-2" style="margin-bottom: 10px;">
                                <input type="text" class="form-control" placeholder="" name="total_income"
                                       id="total_income" data-validation="required number"
                                       data-validation-error-msg-number="only digits"
                                       data-validation-error-msg-required="Required field !">
                            </div>
                        </div>
                    </section>
                    <section class="panel affixpanel" id="studentinfo">
                        <header class="panel-heading">
                            10. Details of Guardians:&nbsp;&nbsp;<i class="fa fa-question-circle" id="myBtn7"
                                                                    style="font-size: 90%"></i>
                        </header>
                        <div class="panel-body">
                            <div class="row">

                                <div class="form-group col-md-7">
                                    <div class="col-sm-7">

                                        <label class="col-md-6 control-label">With Guardians &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Yes</label>
                                        <input type="radio" name="guardians_status" id="guardians_status"
                                               class="col-md-1" value="Y"
                                               onchange="load_guardians_data()"<?php //echo $selected_cvlstat  ?>>

                                        <label class="col-md-2 control-label">No</label>
                                        <input type="radio" name="guardians_status" id="guardians_status"
                                               class="col-md-1" value="N" checked="true"
                                               onchange="load_guardians_data()" <?php //echo  $selected_cvlstat2  ?>>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!--                            <p>This cage should be filled by orphans, clergy or any other applicants who are under the custody of a legal guardian.</p>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Name of Guardian:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" data-validation-optional="true" name="ga_name" id="ga_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Permanent Address:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <textarea  rows="4" class="form-control" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty" data-validation-optional="true" name="ga_address" id="ga_address"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <!--                            <div class="row">
                                                            <div class="col-xs-6">
                                                                <label for="name" class="col-md-12 control-label">Post if employed:</label>
                                                                <div class="col-xs-7" style="margin-bottom: 10px;">
                                                                    <input type="text" class="form-control" placeholder="" name="ga_post" id="ga_post" data-validation="number" data-validation-error-msg-number="only digits" data-validation-optional="true">
                                                                </div>
                                                            </div>

                                                        </div>-->
                            <br>
                            <p>Gross annual income from occupation /pension from 1st January to 31st December 2017
                                [Salary particulars including all allowances certified by the relevant authorities
                                should be attached. If retired, pension certificate should be attached (original
                                letter)]</p>


                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name" class="col-md-12 control-label">Total Gross Annual income of the
                                        family, inclusive of the income from houses and property Rs:</label>
                                    <div class="col-xs-7" style="margin-bottom: 10px;">
                                        <input type="text" class="form-control" placeholder="" name="ga_income"
                                               id="ga_income" data-validation="number"
                                               data-validation-error-msg-number="only digits"
                                               data-validation-optional="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="panel">
                        <div class="panel-body">
                            <br>
                            <label class="col-md-12 control-label">Checked and approved by</label>
                            <br><br>
                            <label class="col-md-2 control-label" style="padding-top: 0px;">Grama Sewaka</label>
                            <input style="margin-left: -50px;" type="checkbox" name="chk_gramasewaka"
                                   id="chk_gramasewaka" class="col-md-1" value="Y"
                                   checked="true"<?php //echo $selected_cvlstat  ?>>


                            <label class="col-md-2 control-label" style="padding-top: 0px;">Divisional
                                Secretariat</label>
                            <input style="margin-left: -50px;" type="checkbox" name="chk_divisional_secretariat"
                                   id="chk_divisional_secretariat" class="col-md-1" value="N"
                                   checked="true" <?php //echo  $selected_cvlstat2  ?>>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-11">
                                    <br><br>


                                    <?php
                                    // if($_GET['type']=='edit')
                                    // {
                                    ?>
                                    <input type="hidden" id="need_index" name="need_index" value="">

                                    <?php
                                    if (isset($type)) {
                                        if ($type != 'mahapola_approval') {
                                            ?>
                                            <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">
                                                Save
                                            </button>
                                            <?php
                                            // }
                                            // if($_GET['type']=='regi')
                                            // {
                                            ?>
                                            <!--  <button type="submit" onclick="event.preventDefault();verify_data()" name="regi_btn" id="regi_btn" class="btn btn-info">Register</button> -->
                                            <?php
                                            // }
                                            ?>
                                            <button onclick="event.preventDefault();$('#reg_form').trigger('reset');$('#id');$('#ref_t').val('');"
                                                    class="btn btn-default">Reset
                                            </button>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (isset($type)) {
                                        if ($type == 'mahapola_approval') {
                                            if ($access_mahapola['user_rights']['rgt_id'] != null) {
                                                ?>
                                                <!--<div style="width: 100%; float: left; margin-left: 20%;">-->
                                                <button style="margin-left: 60%;"
                                                        onclick="event.preventDefault();update_stu_mahapola_apprv_status('1')"
                                                        class='btn btn-info btn-md'><span class='glyphicon glyphicon-ok'
                                                                                          aria-hidden='true'></span>Approve
                                                </button> |
                                                <button onclick="event.preventDefault();update_stu_mahapola_apprv_status('3')"
                                                        class='btn btn-warning btn-md'><span
                                                            class='glyphicon glyphicon-ban-circle'
                                                            aria-hidden='true'></span>Reject
                                                </button>
                                                <!--</div>-->
                                                <?php
                                            } else {

                                                if ($access_mahapola['user_level']['ug_level'] == 1) {
                                                    ?>
                                                    <!--<div style="width: 100%; float: left; margin-left: 1.3%;">-->
                                                    <button style="margin-left: 60%;"
                                                            onclick="event.preventDefault();update_stu_mahapola_apprv_status('1')"
                                                            class='btn btn-info btn-md'><span
                                                                class='glyphicon glyphicon-ok'
                                                                aria-hidden='true'></span>Approve
                                                    </button> |
                                                    <button onclick="event.preventDefault();update_stu_mahapola_apprv_status('3')"
                                                            class='btn btn-warning btn-md'><span
                                                                class='glyphicon glyphicon-ban-circle'
                                                                aria-hidden='true'></span>Reject
                                                    </button>
                                                    <!--</div>-->
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>

        </div>

    </div>

</div>

<div id="dialog-confirm"></div>

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css') ?>">
<script type="text/javascript">

    $.validate({
        form: '#stu_reg_mahapola'
    });

    $('.datepicker').datepicker({
        autoclose: true
    });

    var schl_going_concession = 0;
    var schl_attendies = 0;
    var uni_going_concession = 0;
    var uni_attendies = 0;
    var land_income = 0;
    var rent_income = 0;
    var total_parant_income = 0;
    var grand_total = 0;
    var emp_income = 0;
    var family_married_income = 0;

    //function calculate
    function calculate_schl_attendies() {
        schl_attendies = 0;
        schl_going_concession = 0;
        //fd_name1, fd_name2, fd_name3,
        // fd_age_as_at1, fd_age_as_at2, fd_age_as_at3
//        if ($('#fd_name1').val()!= '' &&  ($('#fd_age_as_at1').val() >= 6 && $('#fd_age_as_at1').val() <= 18))
//        {
//            schl_attendies += 1;
//        }
//        if ($('#fd_name2').val()!= '' &&  ($('#fd_age_as_at2').val() >= 6 && $('#fd_age_as_at2').val() <= 18))
//        {
//            schl_attendies += 1;
//        }
//        if ($('#fd_name3').val()!= '' &&  ($('#fd_age_as_at3').val() >= 6 && $('#fd_age_as_at3').val() <= 18))
//        {
//            schl_attendies += 1;
//        }
        schl_attendies = $('#fd_scl_attendies').val();
        if(schl_attendies == '')
            schl_attendies=0;
        
        if (schl_attendies > 0) {
            if (schl_attendies > 3)
                schl_attendies = 3;

            schl_going_concession = schl_attendies * 24000;
        }
        $('#lbl_schl_concession').text(schl_going_concession);
    }

    function calculate_uni_attendies() {
        uni_attendies = 0;
        uni_going_concession = 0;
        //ou_stu_name1 , ou_uni_name1, ou_course_name1, ou_al_year1, ou_al_index1 , ou_mahapola_bursary1
        // ou_stu_name2, ou_uni_name2, ou_course_name2, ou_al_year2, ou_al_index2, ou_mahapola_bursary2

//        if (($('#ou_stu_name1').val()!= '' && $('#ou_uni_name1').val() != '' && $('#ou_course_name1').val() != '') && $("#ou_mahapola_bursary1").prop("checked") == false)
//        {
//            uni_attendies += 1;
//        }
//        if ($('#ou_stu_name2').val()!= '' && $('#ou_uni_name2').val() != '' && $('#ou_course_name2').val() != '' && $("#ou_mahapola_bursary2").prop("checked") == false)  //&& $('#ou_mahapola_bursary2').val() == 'N'
//        {
//            uni_attendies += 1;
//        }
        uni_attendies = $('#ou_attendies').val()
        if(uni_attendies == '')
            uni_attendies = 0;
        
        if (uni_attendies > 0) {
            uni_going_concession = uni_attendies * 36000;
        }
        $('#lbl_uni_concession').text(uni_going_concession);
    }

    function calculate_employment_income() {
        var emp_status = $('input[name=employeement_status]:checked').val();
        if (emp_status == "Y") {
            var emp_income1 = $('#empld_salary').val();
            $('#lbl_emplyment_income').text($('#empld_salary').val());
            if (emp_income1 == '')
                $('#lbl_emplyment_income').text(0);
            else
                $('#lbl_emplyment_income').text($('#empld_salary').val());
        }
        else
            $('#lbl_emplyment_income').text(0);

    }

    function calculate_land_income() {
        land_income = 0;
//        if($('#inc_annual_income1').val() >= 0 && $('#inc_owner_name1').val() != '')
//        {
//            land_income =  land_income + parseFloat($('#inc_annual_income1').val()); 
//        }
//        if($('#inc_annual_income2').val() >= 0 && $('#inc_owner_name2').val() != '')
//        {
//            land_income = land_income + parseFloat($('#inc_annual_income2').val()); 
//        }
        land_income = $('#land_income').val();
        if(land_income == '')
            land_income = 0;
        
        if (land_income > 0)
            $('#lbl_land_income').text(land_income);
    }

    function calculate_rent_income() {
        rent_income = 0;
//        if($('#inct_anual_income1').val() >= 0 && $('#inct_owner_name1').val() != '')
//        {
//            rent_income =  rent_income + parseFloat($('#inct_anual_income1').val()); 
//        }
//        if($('#inct_anual_income2').val() >= 0 && $('#inct_owner_name2').val() != '')
//        {
//            rent_income = rent_income + parseFloat($('#inct_anual_income2').val()); 
//        }
        rent_income = $('#rent_income').val();
        if(rent_income == '')
            rent_income = 0;
        
        if (rent_income > 0)
            $('#lbl_rent_income').text(rent_income);

    }

    function calculate_full_income() {
        calculate_schl_attendies();
        calculate_uni_attendies();
        calculate_land_income();
        calculate_rent_income();
        calculate_employment_income();
        if ($('#spouse_annual_income').val() != '')
            $('#lbl_family_income').text($('#spouse_annual_income').val());
        else
            $('#lbl_family_income').text(0);

        //calculate parent income from all sources.
        var fa_other_income = $('#fa_other_income').val();
        if (fa_other_income == '')
            fa_other_income = 0;

        var mo_other_income = $('#mo_other_income').val();
        if (mo_other_income == '')
            mo_other_income = 0;

        var parent_income = parseFloat(fa_other_income) + parseFloat(mo_other_income);// + land_income + rent_income;
        $('#total_income').val(parent_income);

        //check if Student is empleyee
        var emp_status = $('input[name=employeement_status]:checked').val();
        if (emp_status == "Y") {
            emp_income = parseFloat($('#lbl_emplyment_income').text());
        }
        //Check if student is Married
        var c_status = $('input[name=civil_status]:checked').val();
        if (c_status == "M") {
            if ($('#spouse_annual_income').val() != '') {
                $('#lbl_family_income').text();
                family_married_income = parseFloat($('#spouse_annual_income').val());
            }
            else {
                $('#lbl_family_income').text(0);
                family_married_income = 0;
            }
        }
        //sum of Land + Rent + tot income from section 9
        total_parant_income = parseFloat(parent_income) + parseFloat(land_income) + parseFloat(rent_income);

        // get gaurdian status ..
        var guardians_status = $('input[name=guardians_status]:checked').val();
        if (guardians_status == "Y") {
            total_parant_income = parseFloat($('#ga_income').val());
        }

        //check the student as Emp
        if (emp_status == "Y") {
            grand_total = parseFloat(total_parant_income) - parseFloat(emp_income);
        }
        else
            grand_total = parseFloat(total_parant_income);

        //check the student as married. then ignore the parent income and get income as family income.
        if (c_status == "M") {
            grand_total = parseFloat(family_married_income);
        }
        //check School children and Uni student.
        if (grand_total > 100000) {
            grand_total = grand_total - (parseFloat(schl_going_concession) + parseFloat(uni_going_concession));
        }
        else {
            grand_total = grand_total;
        }

        // on form submit jquery.. Check calculate the  need index and show ass confirm box to continue..

    }

    function load_married_data() {
        var status = $('input[name=civil_status]:checked').val();
        if (status == "S") {
            $('#sp_date_of_marriage').val('');
            $('#spouse_name').val('');
            $('#spouse_com_name').val('');
            $('#spouse_com_address').val('');
            $('#spouse_salary').val('');
            $('#spouse_annual_income').val('');
            //
            $('#sp_date_of_marriage').prop('readonly', true);
            $('#spouse_name').prop('readonly', true);
            $('#spouse_com_name').prop('readonly', true);
            $('#spouse_com_address').prop('readonly', true);
            $('#spouse_salary').prop('readonly', true);
            $('#spouse_annual_income').prop('readonly', true);
            $('#lbl_family_income').text(0);

        }
        else {
            $('#sp_date_of_marriage').prop('readonly', false);
            $('#spouse_name').prop('readonly', false);
            $('#spouse_com_name').prop('readonly', false);
            $('#spouse_com_address').prop('readonly', false);
            $('#spouse_salary').prop('readonly', false);
            $('#spouse_annual_income').prop('readonly', false);
        }
    }

    function load_employeement_status() {
        var guardians_status = $('input[name=employeement_status]:checked').val();
        if (guardians_status == "N") {
            $('#empld_name').val('');
            $('#empld_address').val('');
            $('#empld_post').val('');
            $('#empld_salary').val('');
            $('#empld_dateofapp').val('');
            //
            $('#empld_name').prop('readonly', true);
            $('#empld_address').prop('readonly', true);
            $('#empld_post').prop('readonly', true);
            $('#empld_salary').prop('readonly', true);
            $('#empld_dateofapp').prop('readonly', true);

        }
        else {
            $('#empld_name').prop('readonly', false);
            $('#empld_address').prop('readonly', false);
            $('#empld_post').prop('readonly', false);
            $('#empld_salary').prop('readonly', false);
            $('#empld_dateofapp').prop('readonly', false);
        }
    }

    function load_guardians_data() {
        var status = $('input[name=guardians_status]:checked').val();
        if (status == "N") {
            $('#ga_name').val('');
            $('#ga_address').val('');
            $('#ga_post').val('');
            $('#ga_income').val('');
            //
            $('#ga_name').prop('readonly', true);
            $('#ga_address').prop('readonly', true);
            $('#ga_post').prop('readonly', true);
            $('#ga_income').prop('readonly', true);

        }
        else {
            $('#ga_name').prop('readonly', false);
            $('#ga_address').prop('readonly', false);
            $('#ga_post').prop('readonly', false);
            $('#ga_income').prop('readonly', false);
        }
    }

    function validate_nic(name) {
        var contrl_name = "#" + name;
        if ($(contrl_name).val()) {
            var nic = $(contrl_name).val();
            if (nic.length == 10 || nic.length == 12) {
                if (nic.length == 10) {
                    var idToTest = nic,
                        myRegExp = new RegExp(/[0-9]{9}[x|X|v|V]$/);

                    if (myRegExp.test(idToTest)) {
                        $('#lbl_nic1_validate').text('');
                        $('#lbl_nic2_validate').text('');
                    }
                    else {
                        if (contrl_name == 'ou2_nic1')
                            $('#lbl_nic1_validate').text('Invalid NIC number format !');
                        else
                            $('#lbl_nic2_validate').text('Invalid NIC number format !');

                    }
                }
                else {
                    var idToTest = nic,
                        myRegExp = new RegExp(/[0-9]{9}$/);

                    if (myRegExp.test(idToTest)) {
                        $('#lbl_nic1_validate').text('');
                        $('#lbl_nic2_validate').text('');
                    }
                    else {
                        if (contrl_name == '#ou2_nic1')
                            $('#lbl_nic1_validate').text('Invalid NIC number format !');
                        else
                            $('#lbl_nic2_validate').text('Invalid NIC number format !');

                    }
                }
            }
            else {
                if (contrl_name == '#ou2_nic1')
                    $('#lbl_nic1_validate').text('NIC Length should be 10 0r 12 characters !');
                else
                    $('#lbl_nic2_validate').text('NIC Length should be 10 0r 12 characters !');

            }
        }
        else {
            $('#lbl_nic1_validate').text('');
            $('#lbl_nic2_validate').text('');
//            if(contrl_name == 'ou2_nic1')
//                $('#lbl_nic1_validate').text('NIC cannot be empty !');
//            else
//                $('#lbl_nic2_validate').text('NIC cannot be empty !');

        }
    }

    $('.datepicker').datepicker({
        autoclose: true,
        setDate: '2015-01-01'
    }).on('changeDate', function (ev) {
        //my work here
        var name = ev.currentTarget.name;
        calculate_age(name);
    });

    function calculate_age(name) {
        var cntl_name = '#' + name;
        var dob = $(cntl_name).val();

        var split_dob = dob.split("-");
        dobYear = split_dob[0];
        dobMonth = split_dob[1];
        dobDay = split_dob[2];

        var bthDate, curDate, days;
        var ageYears, ageMonths, ageDays;
        bthDate = new Date(dobYear, dobMonth - 1, dobDay);
        curDate = new Date();
        if (bthDate > curDate) return;
        days = Math.floor((curDate - bthDate) / (1000 * 60 * 60 * 24));
        ageYears = Math.floor(days / 365);
        ageMonths = Math.floor((days % 365) / 31);
        ageDays = days - (ageYears * 365) - (ageMonths * 31);
        if (ageYears > 0) {
            if (name == 'fd_dob1')
                $('#fd_age_as_at1').val(ageYears);
            if (name == 'fd_dob2')
                $('#fd_age_as_at2').val(ageYears);
            if (name == 'fd_dob3')
                $('#fd_age_as_at3').val(ageYears);
            if (name == 'fd_dob4')
                $('#fd_age_as_at4').val(ageYears);
        }

    }

    $('#stu_reg_mahapola').on('submit', function (e) {

//        var nic1 = $('#lbl_nic1_validate').text('');
//        var nic2 = $('#lbl_nic2_validate').text('');
//        
//        if(nic1.length == 1 && nic2.length == 1)
//        {
        calculate_full_income();
        //Calculate the marks
        //1. For School attendies.
        var school_marks = 0;
        if (schl_attendies > 0)
            school_marks = schl_attendies * 5;
        //2. For Uni attendies.
        var uni_marks = 0;
        if (uni_attendies > 0)
            uni_marks = uni_attendies * 10;

        //3. For Distance.
        var dis_marks = 0;
        var distance = $('#distance').val();
        if (distance >= 0 && distance <= 25)
            dis_marks = 2;
        else if (distance > 25 && distance <= 50)
            dis_marks = 5;
        else if (distance > 50 && distance <= 100)
            dis_marks = 10;
        else
            dis_marks = 15;
        //alert(grand_total);
        //4. For Total Income.
        var income_marks = 0;
        if (grand_total <= 10000)//(grand_total >= 1 && grand_total <= 10000)
            income_marks = 60;
        else if (grand_total >= 10001 && grand_total <= 25000)
            income_marks = 55;
        else if (grand_total >= 25001 && grand_total <= 50000)
            income_marks = 50;
        else if (grand_total >= 50001 && grand_total <= 100000)
            income_marks = 45;
        else if (grand_total >= 100001 && grand_total <= 150000)
            income_marks = 40;
        else if (grand_total >= 150001 && grand_total <= 200000)
            income_marks = 35;
        else if (grand_total >= 200001 && grand_total <= 250001)
            income_marks = 30;
        else if (grand_total >= 250001 && grand_total <= 300000)
            income_marks = 25;
        else if (grand_total >= 300001 && grand_total <= 350000)
            income_marks = 20;
        else if (grand_total >= 350001 && grand_total <= 400000)
            income_marks = 15;
        else if (grand_total >= 400001 && grand_total <= 450000)
            income_marks = 10;
        else if (grand_total >= 450001 && grand_total <= 500000)
            income_marks = 5;

        var Total_marks = school_marks + uni_marks + dis_marks + income_marks;
        $('#need_index').val(Total_marks);

        //alert(dis_marks + " : " +grand_total + " : " + income_marks);
        $("#dialog-confirm").html('Please check the Marks to confirm? <br><br>\n\
                <table><tr><td>Distance Marks </td><td>' + dis_marks + '</td></tr>' +
            '<tr><td>Under 19 years Children </td><td>' + school_marks + '</td></tr>' +
            '<tr><td>University Students </td><td>' + uni_marks + '</td></tr>' +
            '<tr style="border-bottom: 1px solid black;"><td>Income </td><td>' + income_marks + '</td></tr>' +
            '<tr style="font-weight:bold;margin-top:10px;border-bottom: 1px solid black;"><td>Need Index </td><td>' + Total_marks + '</td></tr></table>');

        title = 'Need index';
        e.preventDefault();

        //comment because of not useed..
        //fd_name1:$('#fd_name1').val(), fd_dob1:$('#fd_dob1').val(), fd_age_as_at1:$('#fd_age_as_at1').val(),fd_scl_name1:$('#fd_scl_name1').val(),
//            fd_name2:$('#fd_name2').val(), fd_dob2:$('#fd_dob2').val(), fd_age_as_at2:$('#fd_age_as_at2').val(),fd_scl_name2:$('#fd_scl_name2').val(),
//            fd_name3:$('#fd_name3').val(), fd_dob3:$('#fd_dob3').val(), fd_age_as_at3:$('#fd_age_as_at3').val(),fd_scl_name3:$('#fd_scl_name3').val(),
//            fd_name4:$('#fd_name4').val(), fd_dob4:$('#fd_dob4').val(), fd_age_as_at4:$('#fd_age_as_at4').val(),fd_scl_name4:$('#fd_scl_name4').val(),
//            ou_stu_name1:$('#ou_stu_name1').val(),ou_uni_name1:$('#ou_uni_name1').val(),ou_course_name1:$('#ou_course_name1').val(),ou_al_year1:$('#ou_al_year1').val(),ou_al_index1:$('#ou_al_index1').val(),ou_mahapola_bursary1:$('input[name=ou_mahapola_bursary1]:checked').val(),
//            ou_stu_name2:$('#ou_stu_name2').val(),ou_uni_name2:$('#ou_uni_name2').val(),ou_course_name2:$('#ou_course_name2').val(),ou_al_year2:$('#ou_al_year2').val(),ou_al_index2:$('#ou_al_index2').val(),ou_mahapola_bursary2:$('input[name=ou_mahapola_bursary2]:checked').val(),
//            ou2_stu_name1:$('#ou2_stu_name1').val(),ou2_al_index1:$('#ou2_al_index1').val(),ou2_nic1:$('#ou2_nic1').val(),ou2_course_name1:$('#ou2_course_name1').val(),ou2_uni_name1:$('#ou2_uni_name1').val(),
//            ou2_stu_name2:$('#ou2_stu_name2').val(),ou2_al_index2:$('#ou2_al_index2').val(),ou2_nic2:$('#ou2_nic2').val(),ou2_course_name2:$('#ou2_course_name2').val(),ou2_uni_name2:$('#ou2_uni_name2').val(),
//            inc_owner_name1:$('#inc_owner_name1').val(),inc_relation1:$('#inc_relation1').val(),inc_location1:$('#inc_location1').val(),inc_cultivation1:$('#inc_cultivation1').val(),inc_prop_details1:$('#inc_prop_details1').val(),inc_annual_income1:$('#inc_annual_income1').val(),
//                                    inc_owner_name2:$('#inc_owner_name2').val(),inc_relation2:$('#inc_relation2').val(),inc_location2:$('#inc_location2').val(),inc_cultivation2:$('#inc_cultivation2').val(),inc_prop_details2:$('#inc_prop_details2').val(),inc_annual_income2:$('#inc_annual_income2').val(),
//                                    inct_owner_name1:$('#inct_owner_name1').val(),inct_relation1:$('#inct_relation1').val(),inct_assessment_no1:$('#inct_assessment_no1').val(),inct_address1:$('#inct_address1').val(),inct_anual_income1:$('#inct_anual_income1').val(),inct_lease_name1:$('#inct_lease_name1').val(),
//                                    inct_owner_name2:$('#inct_owner_name2').val(),inct_relation2:$('#inct_relation2').val(),inct_assessment_no2:$('#inct_assessment_no2').val(),inct_address2:$('#inct_address2').val(),inct_anual_income2:$('#inct_anual_income2').val(),inct_lease_name2:$('#inct_lease_name2').val(),
//                                    no_of_division:$('#no_of_division').val(),ds_division:$('#ds_division').val(),local_authority:$('#local_authority').val(),
//                                    empld_name:$('#empld_name').val(),empld_address:$('#empld_address').val(),empld_post:$('#empld_post').val(),empld_salary:$('#empld_salary').val(),empld_dateofapp:$('#empld_dateofapp').val(),
//                                    sp_date_of_marriage:$('#sp_date_of_marriage').val(), spouse_name:$('#spouse_name').val(),spouse_com_name:$('#spouse_com_name').val(),spouse_com_address:$('#spouse_com_address').val(),spouse_salary:$('#spouse_salary').val(),spouse_annual_income:$('#spouse_annual_income').val(),
//                                    fa_name:$('#fa_name').val(),fa_live:$('input[name=fa_live]:checked').val(),fa_age:$('#fa_age').val(), fa_occupation:$('#fa_occupation').val(),fa_retired_date:$('#fa_retired_date').val(),fa_termination_date:$('#fa_termination_date').val(),fa_wp_address:$('#fa_wp_address').val(),fa_annual_income:$('#fa_annual_income').val(),fa_other_income:$('#fa_other_income').val(),
//                                    mo_name:$('#mo_name').val(),mo_live:$('input[name=mo_live]:checked').val(),mo_age:$('#mo_age').val(), mo_occupation:$('#mo_occupation').val(),mo_retired_date:$('#mo_retired_date').val(),mo_termination_date:$('#mo_termination_date').val(),mo_wp_address:$('#mo_wp_address').val(),mo_annual_income:$('#mo_annual_income').val(),mo_other_income:$('#mo_other_income').val(),
//                                    guardians_status:$('input[name=guardians_status]:checked').val(),ga_name:$('#ga_name').val(),ga_address:$('#ga_address').val(),ga_post:$('#ga_post').val(),ga_income:$('#ga_income').val(),
//                                    
        chk_gramasewaka = 0;
        chk_divisional_secretariat = 0;
        if ($('#chk_gramasewaka').prop('checked') == true)
            chk_gramasewaka = 1
        if ($('#chk_divisional_secretariat').prop('checked') == true)
            chk_divisional_secretariat = 1

        // Define the Dialog and its properties.
        $("#dialog-confirm").dialog({
            resizable: false,
            modal: true,
            title: title,
            height: 300,
            width: 400,
            draggable: false,
            buttons: [
                {
                    text: "Yes",
                    "class": 'btn btn',
                    click: function () {
                        $(this).dialog('close');
                        //$("#stu_reg_mahapola").submit();
                        $.post("<?php echo base_url('student/save_student_mahapola') ?>",
                            {
                                stu_id: $('#stu_id').val(),
                                mahapola_id: $('#mahapola_id').val(),
                                title: $('input[name=title]:checked').val(),
                                full_name: $('#full_name').val(),
                                address: $('#address').val(),
                                nic: $('#nic').val(),
                                telephone: $('#telephone').val(),
                                mobile: $('#mobile').val(),
                                distance: $('#distance').val(),
                                al_year: $('#al_year').val(),
                                al_index: $('#al_index').val(),
                                al_z_score: $('#operator').val() + $('#al_z_score').val(),
                                al_subject_stream: $('input[name=al_subject_stream]:checked').val(),
                                schl_attendies: $('#fd_scl_attendies').val(),
                                schl_going_concession: $('#lbl_schl_concession').text(),
                                ou_attendies: $('#ou_attendies').val(),
                                ou_going_concession: $('#lbl_uni_concession').text(),
                                income_from_land: $('#land_income').val(),
                                income_from_rent: $('#rent_income').val(),
                                employeement_status: $('input[name=employeement_status]:checked').val(),
                                empld_salary: $('#empld_salary').val(),
                                civil_status: $('input[name=civil_status]:checked').val(),
                                spouse_annual_income: $('#spouse_annual_income').val(),
                                fa_other_income: $('#fa_other_income').val(),
                                mo_other_income: $('#mo_other_income').val(),
                                total_income: $('#total_income').val(),
                                guardians_status: $('input[name=guardians_status]:checked').val(),
                                ga_income: $('#ga_income').val(),
                                need_index: $('#need_index').val(),
                                chk_gramasewaka: chk_gramasewaka,
                                chk_divisional_secretariat: chk_divisional_secretariat
                            },
                            function (data) {
                                window.location = '<?php echo base_url("student/student_lookup")?>';
                            });
                    }
                },
                {
                    text: "No",
                    "class": 'btn btn-info',
                    click: function () {
                        $(this).dialog('close');
                        e.preventDefault();
                    }
                }
            ]
        }).prev(".ui-dialog-titlebar").css({'background': '#74caee', 'border-color': '#74caee'});

//        }
//        else
//        {
//            e.preventDefault();
//            funcres = {status: "denied", message: "Please correct errors before proceed !"};
//            result_notification(funcres);
//            validate_nic('ou2_nic1');
//            validate_nic('ou2_nic2');
//        }
    });

    $(document).ready(function () {

        //alert($('#stu_id').val());

        $.post("<?php echo base_url('Student/load_mahapola_details') ?>", {stu_id: $('#stu_id').val()},
            function (full_data) {
                console.log(full_data);
                var data = full_data['stu_reg'];
                var mahapola = full_data['res_stu_reg_mahapola'];

                $('#reg_no').val(full_data['stu_reg'][0]['reg_no']);
                $('#center_id').val(full_data['stu_reg'][0]['center_id']);
                var first__name = data[0]['first_name'].split(".");
                var firstname_index = first__name.length - 1;
                // alert(first__name[firstname_index]);
                var temp_name = "";

                var first__name_temp = first__name[firstname_index].split(" ");
                for (var q = 0; q < first__name_temp.length; q++) {
                    if (first__name_temp[q].length != 1)
                        temp_name = temp_name + ' ' + first__name_temp[q];
                }

                // var new_full_name=data[0]['last_name']+" "+first__name[firstname_index];
                var new_full_name = data[0]['last_name'] + " " + temp_name;


                $('#full_name').val(new_full_name.toUpperCase());  //data[0]['first_name']+" "+data[0]['last_name']
                $('#address').val(data[0]['permanent_address']);
                $('#nic').val(data[0]['nic_no']);
                $('#telephone').val(data[0]['fixed_tp']);
                $('#mobile').val(data[0]['mobile_no']);
                $('#al_year').val(data[0]['al_year']);
                $('#al_index').val(data[0]['al_index_no']);

                zscore = data[0]['al_z_core'];
                oprator = zscore.charAt(0);
                value = zscore.substring(1, zscore.length);

                $('#al_z_score').val(value);

                
                //alert(oprator);
                if (oprator == "+") {
                    $("#operator option[value='+']").prop('selected', true);
                }
                else {
                    $("#operator option[value='-']").prop('selected', true);
                }
                $('#operator').attr('disabled', true);
                
                if (data[0]['al_stream'] == 1)
                    $('input[name=al_subject_stream][value="COM"]').attr('checked', 'checked');
                else if (data[0]['al_stream'] == 2)
                    $('input[name=al_subject_stream][value="ART"]').attr('checked', 'checked');
                else if (data[0]['al_stream'] == 3)
                    $('input[name=al_subject_stream][value="BIO_S"]').attr('checked', 'checked');
                else if (data[0]['al_stream'] == 4)
                    $('input[name=al_subject_stream][value="MTH"]').attr('checked', 'checked');
                else if (data[0]['al_stream'] == 5)
                    $('input[name=al_subject_stream][value="TECH"]').attr('checked', 'checked');
                else
                    $('input[name=al_subject_stream][value="OTHR"]').attr('checked', 'checked');

                //Check for civil status
                $('input[name=civil_status][value=' + data[0]['civil_status'] + ']').attr('checked', 'checked');
                load_married_data();
                $('input[name=employeement_status][value=' + 'N' + ']').attr('checked', 'checked');
                load_employeement_status();
                load_guardians_data();
                if (mahapola.length != 0) {
                    $('#mahapola_id').val(mahapola[0]['mahapola_id']);
                    $('#distance').val(mahapola[0]['distance']);
                    $('input[name=title][value=' + mahapola[0]['title'] + ']').attr('checked', 'checked');

                    //02. Family Details
                    /*$('#fd_name1').val(mahapola[0]['fd_name1']);
                    $('#fd_dob1').val(mahapola[0]['fd_dob1']);
                    $('#fd_age_as_at1').val(mahapola[0]['fd_age_as_at1']);
                    $('#fd_scl_name1').val(mahapola[0]['fd_scl_name1']);

                    $('#fd_name2').val(mahapola[0]['fd_name2']);
                    $('#fd_dob2').val(mahapola[0]['fd_dob2']);
                    $('#fd_age_as_at2').val(mahapola[0]['fd_age_as_at2']);
                    $('#fd_scl_name2').val(mahapola[0]['fd_scl_name2']);

                    $('#fd_name3').val(mahapola[0]['fd_name3']);
                    $('#fd_dob3').val(mahapola[0]['fd_dob3']);
                    $('#fd_age_as_at3').val(mahapola[0]['fd_age_as_at3']);
                    $('#fd_scl_name3').val(mahapola[0]['fd_scl_name3']);

                    $('#fd_name4').val(mahapola[0]['fd_name4']);
                    $('#fd_dob4').val(mahapola[0]['fd_dob4']);
                    $('#fd_age_as_at4').val(mahapola[0]['fd_age_as_at4']);
                    $('#fd_scl_name4').val(mahapola[0]['fd_scl_name4']);*/
                    $('#fd_scl_attendies').val(mahapola[0]['schl_attendies']);
                    $('#lbl_schl_concession').text(mahapola[0]['schl_going_concession']);

                    /*$('#ou_stu_name1').val(mahapola[0]['ou_stu_name1']);
                    $('#ou_uni_name1').val(mahapola[0]['ou_uni_name1']);
                    $('#ou_course_name1').val(mahapola[0]['ou_course_name1']);
                    $('#ou_al_year1').val(mahapola[0]['ou_al_year1']);
                    $('#ou_al_index1').val(mahapola[0]['ou_al_index1']);
                    $('input[name=ou_mahapola_bursary1][value=' + mahapola[0]['ou_mahapola_bursary1'] + ']').attr('checked', 'checked');

                    $('#ou_stu_name2').val(mahapola[0]['ou_stu_name2']);
                    $('#ou_uni_name2').val(mahapola[0]['ou_uni_name2']);
                    $('#ou_course_name2').val(mahapola[0]['ou_course_name2']);
                    $('#ou_al_year2').val(mahapola[0]['ou_al_year2']);
                    $('#ou_al_index2').val(mahapola[0]['ou_al_index2']);
                    $('input[name=ou_mahapola_bursary2][value=' + mahapola[0]['ou_mahapola_bursary2'] + ']').attr('checked', 'checked');

                    $('#ou2_stu_name1').val(mahapola[0]['ou2_stu_name1']);
                    $('#ou2_al_index1').val(mahapola[0]['ou2_al_index1']);
                    $('#ou2_nic1').val(mahapola[0]['ou2_nic1']);
                    $('#ou2_course_name1').val(mahapola[0]['ou2_course_name1']);
                    $('#ou2_uni_name1').val(mahapola[0]['ou2_uni_name1']);

                    $('#ou2_stu_name2').val(mahapola[0]['ou2_stu_name2']);
                    $('#ou2_al_index2').val(mahapola[0]['ou2_al_index2']);
                    $('#ou2_nic2').val(mahapola[0]['ou2_nic2']);
                    $('#ou2_course_name2').val(mahapola[0]['ou2_course_name2']);
                    $('#ou2_uni_name2').val(mahapola[0]['ou2_uni_name2']);*/
                    $('#ou_attendies').val(mahapola[0]['ou_attendies']);
                    $('#lbl_uni_concession').text(mahapola[0]['ou_going_concession']);

                    //03. Income from estates, fields, lands etc.
                    /*$('#inc_owner_name1').val(mahapola[0]['inc_owner_name1']);
                    $('#inc_relation1').val(mahapola[0]['inc_relation1']);
                    $('#inc_location1').val(mahapola[0]['inc_location1']);
                    $('#inc_cultivation1').val(mahapola[0]['inc_cultivation1']);
                    $('#inc_prop_details1').val(mahapola[0]['inc_prop_details1']);
                    $('#inc_annual_income1').val(mahapola[0]['inc_annual_income1']);

                    $('#inc_owner_name2').val(mahapola[0]['inc_owner_name2']);
                    $('#inc_relation2').val(mahapola[0]['inc_relation2']);
                    $('#inc_location2').val(mahapola[0]['inc_location2']);
                    $('#inc_cultivation2').val(mahapola[0]['inc_cultivation2']);
                    $('#inc_prop_details2').val(mahapola[0]['inc_prop_details2']);
                    $('#inc_annual_income2').val(mahapola[0]['inc_annual_income2']);*/
                    $('#land_income').val(mahapola[0]['income_from_land']);

                    //Tax for assets
                    /*$('#inct_owner_name1').val(mahapola[0]['inct_owner_name1']);
                    $('#inct_relation1').val(mahapola[0]['inct_relation1']);
                    $('#inct_assessment_no1').val(mahapola[0]['inct_assessment_no1']);
                    $('#inct_address1').val(mahapola[0]['inct_address1']);
                    $('#inct_anual_income1').val(mahapola[0]['inct_anual_income1']);
                    $('#inct_lease_name1').val(mahapola[0]['inct_lease_name1']);

                    $('#inct_owner_name2').val(mahapola[0]['inct_owner_name2']);
                    $('#inct_relation2').val(mahapola[0]['inct_relation2']);
                    $('#inct_assessment_no2').val(mahapola[0]['inct_assessment_no2']);
                    $('#inct_address2').val(mahapola[0]['inct_address2']);
                    $('#inct_anual_income2').val(mahapola[0]['inct_anual_income2']);
                    $('#inct_lease_name2').val(mahapola[0]['inct_lease_name2']);

                    //04. Income from houses rented or leased.
                    $('#no_of_division').val(mahapola[0]['no_of_division']);
                    $('#ds_division').val(mahapola[0]['ds_division']);
                    $('#local_authority').val(mahapola[0]['local_authority']);*/
                    $('#rent_income').val(mahapola[0]['income_from_rent']);

                    //05. If you are involved in any work that generating income
                    var employeement_status = "";
                    if (mahapola[0]['employeement_status'] == null)
                        employeement_status = "N";
                    else
                        employeement_status = mahapola[0]['employeement_status'];

                    //alert(employeement_status);
                    //$('input[name=employeement_status]:checked').val();
                    $('input[name=employeement_status][value=' + employeement_status + ']').attr('checked', 'checked');
                    $('#empld_salary').val(mahapola[0]['empld_salary']);
                    load_employeement_status();
                    /*$('#empld_name').val(mahapola[0]['empld_name']);
                    $('#empld_address').val(mahapola[0]['empld_address']);
                    $('#empld_post').val(mahapola[0]['empld_post']);
                    $('#empld_salary').val(mahapola[0]['empld_salary']);
                    $('#empld_dateofapp').val(mahapola[0]['empld_dateofapp']);
                    $('#sp_date_of_marriage').val(mahapola[0]['sp_date_of_marriage']);*/

                    //06. If you are married
                    /*$('#sp_date_of_marriage').val(mahapola[0]['sp_date_of_marriage']);
                    $('#spouse_name').val(mahapola[0]['spouse_name']);
                    $('#spouse_com_name').val(mahapola[0]['spouse_com_name']);
                    $('#spouse_com_address').val(mahapola[0]['spouse_com_address']);
                    $('#spouse_salary').val(mahapola[0]['spouse_salary']);
                    $('#spouse_annual_income').val(mahapola[0]['spouse_annual_income']);*/
                    $('#spouse_annual_income').val(mahapola[0]['spouse_annual_income']);

                    //07. Details of Father
                    /*$('#fa_name').val(mahapola[0]['fa_name']);
                    $('input[name=fa_live][value=' + mahapola[0]['fa_live'] + ']').attr('checked', 'checked');
                    $('#fa_age').val(mahapola[0]['fa_age']);
                    $('#fa_occupation').val(mahapola[0]['fa_occupation']);
                    $('#fa_retired_date').val(mahapola[0]['fa_retired_date']);
                    $('#fa_termination_date').val(mahapola[0]['fa_termination_date']);
                    $('#fa_wp_address').val(mahapola[0]['fa_wp_address']);
                    $('#fa_annual_income').val(mahapola[0]['fa_annual_income']);*/
                    $('#fa_other_income').val(mahapola[0]['fa_other_income']);

                    //08. Details of Mother
                    /*$('#mo_name').val(mahapola[0]['mo_name']);
                    $('input[name=mo_live][value=' + mahapola[0]['mo_live'] + ']').attr('checked', 'checked');
                    $('#mo_age').val(mahapola[0]['mo_age']);
                    $('#mo_occupation').val(mahapola[0]['mo_occupation']);
                    $('#mo_retired_date').val(mahapola[0]['mo_retired_date']);
                    $('#mo_termination_date').val(mahapola[0]['mo_termination_date']);
                    $('#mo_wp_address').val(mahapola[0]['mo_wp_address']);
                    $('#mo_annual_income').val(mahapola[0]['mo_annual_income']);*/
                    $('#mo_other_income').val(mahapola[0]['mo_other_income']);

                    //09. Total gross annual income of father and mother [grand total of sections 7 and 8]:
                    $('#total_income').val(mahapola[0]['total_income']);

                    //10. Details of Guardians:
                    var guardians_status = "";
                    if (mahapola[0]['guardians_status'] == null)
                        guardians_status = "N";
                    else
                        guardians_status = mahapola[0]['guardians_status'];

                    $('input[name=guardians_status][value=' + guardians_status + ']').attr('checked', 'checked');
                    load_guardians_data();
                    /*$('#ga_name').val(mahapola[0]['ga_name']);
                    $('#ga_address').val(mahapola[0]['ga_address']);
                    $('#ga_post').val(mahapola[0]['ga_post']);*/
                    $('#ga_income').val(mahapola[0]['ga_income']);


                    if (mahapola[0]['gramasewaka'] == 1)
                        $('#chk_gramasewaka').prop('checked', true);
                    else
                        $('#chk_gramasewaka').prop('checked', false);

                    if (mahapola[0]['divisional_secretariat'] == 1)
                        $('#chk_divisional_secretariat').prop('checked', true);
                    else
                        $('#chk_divisional_secretariat').prop('checked', false);

                    calculate_full_income();
                }
            },
            "json"
        );


    });


    function update_stu_mahapola_apprv_status(approved) {
        var student_id = $('#stu_id').val();
        var reg_no = $('#reg_no').val();
        var nic = $('#nic').val();
        var branch = $('#center_id').val();

        $.post("<?php echo base_url('approvals/change_student_mahapola_approval_status') ?>", {
                'student_id': student_id,
                'approved': approved,
                'reg_no': reg_no,
                'nic': nic,
                'branch': branch
            },
            function (data) {
                //location.reload();
                window.location = '<?php echo base_url("approvals/mahapola_approvals") ?>';
            },
            "json"
        );
    }

    //translation
    var modal = document.getElementById('myModal');

    var btn = document.getElementById("myBtn");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    //translation end

    //translation1
    var modal1 = document.getElementById('myModal1');

    var btn = document.getElementById("myBtn1");

    var span = document.getElementsByClassName("close1")[0];

    btn.onclick = function () {
        modal1.style.display = "block";
    }

    span.onclick = function () {
        modal1.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
    //translation1 end

    //translation2
    var modal2 = document.getElementById('myModal2');

    var btn = document.getElementById("myBtn2");

    var span = document.getElementsByClassName("close2")[0];

    btn.onclick = function () {
        modal2.style.display = "block";
    }

    span.onclick = function () {
        modal2.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
    //translation2 end

    //translation3
    var modal3 = document.getElementById('myModal3');

    var btn = document.getElementById("myBtn3");

    var span = document.getElementsByClassName("close3")[0];

    btn.onclick = function () {
        modal3.style.display = "block";
    }

    span.onclick = function () {
        modal3.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal3) {
            modal3.style.display = "none";
        }
    }
    //translation3 end

    //translation4
    var modal4 = document.getElementById('myModal4');

    var btn = document.getElementById("myBtn4");

    var span = document.getElementsByClassName("close4")[0];

    btn.onclick = function () {
        modal4.style.display = "block";
    }

    span.onclick = function () {
        modal4.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal4) {
            modal4.style.display = "none";
        }
    }
    //translation4 end

    //translation5
    var modal5 = document.getElementById('myModal5');

    var btn = document.getElementById("myBtn5");

    var span = document.getElementsByClassName("close5")[0];

    btn.onclick = function () {
        modal5.style.display = "block";
    }

    span.onclick = function () {
        modal5.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal5) {
            modal5.style.display = "none";
        }
    }
    //translation5 end

    //translation6
    var modal6 = document.getElementById('myModal6');

    var btn = document.getElementById("myBtn6");

    var span = document.getElementsByClassName("close6")[0];

    btn.onclick = function () {
        modal6.style.display = "block";
    }

    span.onclick = function () {
        modal6.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal6) {
            modal6.style.display = "none";
        }
    }
    //translation6 end

    //translation7
    var modal7 = document.getElementById('myModal7');

    var btn = document.getElementById("myBtn7");

    var span = document.getElementsByClassName("close7")[0];

    btn.onclick = function () {
        modal7.style.display = "block";
    }

    span.onclick = function () {
        modal7.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal7) {
            modal7.style.display = "none";
        }
    }
    //translation7 end


</script>
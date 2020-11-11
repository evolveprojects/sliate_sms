<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style>
    .ubuntu{
        font-family: 'Ubuntu', sans-serif;
    }
    
    .normal-tab{
        color: #04632e;
    }
    
    .card-primary.card-outline-tabs .card-header a.active {
        border-top: none;
        border-bottom: 3px solid #04632e;
        background-color: #04632e;
        color: #FFFFFF;
    }
    
    .row-bottom{
        border-width: 1px; 
        border-bottom-color: #dedede; 
        border-bottom-style: solid;
        margin-bottom: 0px;
    }
    
    .des-col{
        background-color: #f4f4f4;
    }
</style>
<br><div class="row">
    <div class="container-fluid">

        <div class="col-md-12">
            <div class="form-horizontal">

                <div class="container">
                    <h4 class="ubuntu"><i class="icon fas fa-user"></i> &nbsp;Student Profile</h4><hr>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('img/Artboard_20-512.png') ?>" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center ubuntu"><?php echo $student_profile['fullname']; ?></h3>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item ubuntu">
                                            <b>Title</b> <a class="float-right"><?php echo $student_profile['titname']; ?></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Full Name</b> <a class="float-right"><?php echo $student_profile['fullname']; ?></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Name With Initials</b> <a class="float-right"><?php echo $student_profile['initials_name']; ?></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Mobile No</b> <a class="float-right"><?php echo $student_profile['phoneno']; ?></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Email</b> <a class="float-right"><?php echo $student_profile['email']; ?></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Date of Birth</b> <a class="float-right"><?php echo $student_profile['d_o_b']; ?></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Age</b> <a id="age"class="float-right"></a>
                                        </li>
                                        <li class="list-group-item ubuntu">
                                            <b>Status</b><?php if ($student_profile['or_approved'] == 1) { ?>
                                            <a class="float-right"><h5><span class="badge badge-success">Approved</span></h5></a>
                                            <?php } else if ($student_profile['or_approved'] == 0) { ?>
                                                <a class="float-right"><h5><span class="badge badge-warning">Pending</span></h5></a>
                                            <?php } else if ($student_profile['or_approved'] == 2) { ?>
                                                <a class="float-right"><h5><span class="badge badge-danger">Rejected</span></h5></a>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                    <button type="button" onclick="update_student_reject_status();" class="float-left border-radius btn btn-outline-danger btn-sm ubuntu">Reject</button>
                                    <button type="button" onclick="update_student_apprv_status();" class="float-right border-radius btn btn-success btn-sm ubuntu">Approve</button>
                                    <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist" style="border-bottom: 2px solid #04632e;">
                                        <li class="nav-item">
                                            <a class="nav-link ubuntu normal-tab active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false"><i class="icon fas fa-id-card-alt"></i> &nbsp;Index</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link ubuntu normal-tab" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="true"><i class="icon fas fa-user"></i> &nbsp;Personal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link ubuntu normal-tab" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false"><i class="icon fas fa-id-card"></i> &nbsp;Contact</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link ubuntu normal-tab" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"><i class="icon fas fa-school"></i> &nbsp;A/L</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link ubuntu normal-tab" id="custom-tabs-three-ol-tab" data-toggle="pill" href="#custom-tabs-three-ol" role="tab" aria-controls="custom-tabs-three-ol" aria-selected="false"><i class="icon fas fa-school"></i> &nbsp;O/L</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link ubuntu normal-tab" id="custom-tabs-three-course-tab" data-toggle="pill" href="#custom-tabs-three-course" role="tab" aria-controls="custom-tabs-three-course" aria-selected="false"><i class="icon fas fa-university"></i> &nbsp;Course</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body" style="/* border-top: 1px solid #007bff; */">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <h6 class="ubuntu"><i class="icon fas fa-question-circle"></i> &nbsp;Index Information</h6><hr>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-3 col-form-label des-col">Index No</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_indexno" name="view_indexno" class="col-sm-4 col-form-label"><?php echo $student_profile['indexno']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <h6 class="ubuntu"><i class="icon fas fa-info-circle"></i> &nbsp;Personal Information</h6><hr>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Title</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_title" name="view_title" class="col-sm col-form-label"><?php echo $student_profile['titname']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Full Name</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_fullname" name="view_fullname" class="col-sm col-form-label"><?php echo $student_profile['fullname']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Name with intials</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_initials_name" name="view_initials_name" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['initials_name']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">National Identity Card No</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_nic" name="view_nic" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['nic']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Date of Birth (YYYY/MM/DD)</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_d_o_b" name="view_d_o_b" class="col-sm-4 col-form-label col-form-label-sm"><?php echo $student_profile['d_o_b']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Gender</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_gender" name="view_gender" class="col-sm-4 col-form-label col-form-label-sm"><?php echo $student_profile['gender']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                            <h6 class="ubuntu"><i class="icon fas fa-address-book"></i> &nbsp;Contact Information</h6><hr>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Email Address</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_email" name="view_email" class="col-sm col-form-label"><?php echo $student_profile['email']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">phone no</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_phoneno" name="view_phoneno" class="col-sm col-form-label"><?php echo $student_profile['phoneno']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Land no</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_landno" name="view_landno" class="col-sm col-form-label"><?php echo $student_profile['landno']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Address</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_address" name="view_address" class="col-sm col-form-label"><?php echo $student_profile['address']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">District</label>
                                                <div class="col-sm">
                                                    <label for="" id="view_district" name="view_district" class="col-sm col-form-label"><?php echo $student_profile['or_district']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                                            <h6 class="ubuntu"><i class="icon fas fa-book-open"></i> &nbsp;G.C.E A/L Information</h6><hr>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Academic Year</label>
                                                <div class="col-sm-8">
                                                    <label for="" id="view_al_academic_year" name="view_al_academic_year" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['al_academic_year']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Index No</label>
                                                <div class="col-sm-8">
                                                    <label for="" id="view_al_index_no" name="view_al_index_no" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['al_index_no']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Z-Score</label>
                                                <div class="col-sm-8">
                                                    <label for="" id="view_full_z_score" name="view_full_z_score" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['z_score']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">Stream</label>
                                                <div class="col-sm-8">
                                                    <label for="" id="view_al_stream" name="view_al_stream" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['al_stream_name']; ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group row row-bottom">
                                                <label for="" class="col-sm-4 col-form-label des-col">A/L Subjects</label><br>
                                                <div class="col-sm">
                                                    <div class="row">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"><label>Subjects</label></th>
                                                                    <th scope="col"><label>Grade</label></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><label style="font-weight:normal;" id="view_al_subject1" name="view_al_subject1"><?php echo $student_profile['al_sub_1']; ?></label></td>
                                                                    <td><label style="font-weight:normal;" id="view_al_sub1_grade" name="view_al_sub1_grade"><?php echo $student_profile['al_subg_1']; ?></label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label style="font-weight:normal;" id="view_al_subject2" name="view_al_subject2"><?php echo $student_profile['al_sub_2']; ?></label></td>
                                                                    <td><label style="font-weight:normal;" id="view_al_sub2_grade" name="view_al_sub2_grade"><?php echo $student_profile['al_subg_2']; ?></label></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label style="font-weight:normal;" id="view_al_subject3" name="view_al_subject3"><?php echo $student_profile['al_sub_3']; ?></label></td>
                                                                    <td><label style="font-weight:normal;" id="view_al_sub3_grade" name="view_al_sub3_grade"><?php echo $student_profile['al_subg_3']; ?></label></td>
                                                                </tr>
                                                                <tr id="al_row_4">
                                                                    <td><label style="font-weight:normal;" id="view_al_subject4" name="view_al_subject4"><?php echo $student_profile['al_sub_4']; ?></label></td>
                                                                    <td><label style="font-weight:normal;" id="view_al_sub4_grade" name="view_al_sub4_grade"><?php echo $student_profile['al_subg_4']; ?></label></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <label id="lbl_al_subjects" class="col-md-10 control-label" style="color: red"></label>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-ol" role="tabpanel" aria-labelledby="custom-tabs-three-ol-tab">
                                            <h6 class="ubuntu"><i class="icon fas fa-book-open"></i> &nbsp;G.C.E O/L Information</h6><hr>
                                            <?php if ($student_profile['ol_english_index_no'] === 0 || $student_profile['ol_english_index_no'] === "" || $student_profile['ol_english_index_no'] === null) { ?>
                                            <div id="view_aa">
                                                <div class='form-group row row-bottom'>
                                                    <label for='' class='col-sm-4 col-form-label des-col'>Year</label>
                                                    <div class='col-sm-8'>
                                                        <label for='' id='view_ol_year' name='view_ol_year' class='col-sm col-form-label col-form-label-sm'><?php echo $student_profile['ol_year']; ?></label>
                                                    </div>
                                                </div>
                                                <div class='form-group row row-bottom'>
                                                    <label for='' class='col-sm-4 col-form-label des-col'>Results</label>
                                                    <div class='form-group col-md'>
                                                        <table class='table'>
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'><label>Mathematics</label></th>
                                                                    <th scope='col'><label>English</label></th>
                                                                    <th scope='col'><label>Index No</label></th>
                                                                </tr>
                                                            <thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><label style="font-weight:normal;" id='view_ol_maths_grade' name='view_ol_maths_grade'><?php echo $student_profile['ol_math']; ?></label></td>
                                                                    <td><label style="font-weight:normal;" id='view_ol_english_grade' name='view_ol_english_grade'><?php echo $student_profile['ol_english']; ?></label></td>
                                                                    <td><label style="font-weight:normal;" id='view_ol_index_no' name='view_ol_index_no'><?php echo $student_profile['ol_index_no']; ?></label></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div id="bb">
                                                <div class="form-group row row-bottom">
                                                    <label for="" class="col-sm-4 col-form-label des-col">Results</label>
                                                    <div class="form-group col-md">
                                                        <table class='table'>
                                                            <tr>
                                                                <td><label>Subjects</label></td>
                                                                <td><label>Grade</label></td>
                                                                <td><label>Year</label></td>
                                                                <td><label>Index No</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label style="font-weight:normal;" id="view_ol_maths_grade" name="view_ol_maths_grade">Mathematics</label></td>
                                                                <td><label style="font-weight:normal;" id="view_ol_maths_grade" name="view_ol_maths_grade"><?php echo $student_profile['ol_math']; ?></label></td>
                                                                <td><label style="font-weight:normal;" id="view_ol_year" name="view_ol_year"><?php echo $student_profile['ol_year']; ?></label></td>
                                                                <td><label style="font-weight:normal;" id="view_ol_index_no" name="view_ol_index_no"><?php echo $student_profile['ol_index_no']; ?></label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label style="font-weight:normal;" id="view_ol_english_grade" name="view_ol_english_grade">English</label></td>
                                                                <td><label style="font-weight:normal;" id="view_ol_english_grade" name="view_ol_english_grade"><?php echo $student_profile['ol_english']; ?></label></td>
                                                                <td><label style="font-weight:normal;" id="view_ol_english_year" name="view_ol_english_year"><?php echo $student_profile['ol_english_year']; ?></label></td>
                                                                <td><label style="font-weight:normal;" id="view_ol_english_index_no" name="view_ol_english_index_no"><?php echo $student_profile['ol_english_index_no']; ?></label></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-course" role="tabpanel" aria-labelledby="custom-tabs-three-course-tab">
                                            <h6 class="ubuntu"><i class="icon fas fa-university"></i> &nbsp;Course Information</h6><hr>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Center</th>
                                                        <th scope="col">Course</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="priority_1_row">
                                                        <th style="font-weight:normal;" scope="row">Priority 1</th>
                                                        <td><label style="font-weight:normal;" id="view_priority1_center" name="view_priority1_center"><?php echo $student_profile['p1center']; ?></label></td>
                                                        <td><label style="font-weight:normal;" id="view_priority1_course" name="view_priority1_course"><?php echo $student_profile['p1course']; ?></label></td>
                                                        <td><label style="font-weight:normal;" id="view_priority1_time" name="view_priority1_time"><?php
                                                                if ($student_profile['priority1_time'] == 1) {
                                                                    echo "Full Time";
                                                                } else {
                                                                    echo "Part Time";
                                                                }
                                                                ?></label></td>
                                                    </tr>
                                                    <tr id="priority_2_row" >
                                                        <th style="font-weight:normal;" scope="row">Priority 2</th>
                                                        <td><label style="font-weight:normal;" id="view_priority2_center" name="view_priority2_center"><?php
                                                                if ($student_profile['priority2_center'] != 0 || $student_profile['priority2_center'] != "" || $student_profile['priority2_center'] != NULL) {
                                                                    echo $student_profile['p2center'];
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?></label></td>
                                                        <td><label style="font-weight:normal;" id="view_priority2_course" name="view_priority2_course"><?php
                                                                if ($student_profile['priority2_course'] != 0 || $student_profile['priority2_course'] != "" || $student_profile['priority2_course'] != NULL) {
                                                                    echo $student_profile['p2course'];
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?></label></td>
                                                        <td><label style="font-weight:normal;" id="view_priority2_time" name="view_priority2_time"><?php
                                                                if ($student_profile['priority2_time'] != 0 || $student_profile['priority2_time'] != "" || $student_profile['priority2_time'] != NULL) {
                                                                    if ($student_profile['priority2_time'] == 1) {
                                                                        echo "Full Time";
                                                                    } else if ($student_profile['priority2_time'] == 2) {
                                                                        echo "Part Time";
                                                                    }
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?></label></td>
                                                    </tr>
                                                    <tr id="priority_3_row">
                                                        <th style="font-weight:normal;" scope="row">Priority 3</th>
                                                        <td><label style="font-weight:normal;" id="view_priority3_center" name="view_priority3_center"><?php
                                                                if ($student_profile['priority3_center'] != 0 || $student_profile['priority3_center'] != "" || $student_profile['priority3_center'] != NULL) {
                                                                    echo $student_profile['p3center'];
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?></label></td>
                                                        <td><label style="font-weight:normal;" id="view_priority3_course" name="view_priority3_course"><?php
                                                                if ($student_profile['priority3_course'] != 0 || $student_profile['priority3_course'] != "" || $student_profile['priority3_course'] != NULL) {
                                                                    echo $student_profile['p3course'];
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?></label></td>
                                                        <td><label style="font-weight:normal;" id="view_priority3_time" name="view_priority3_time"><?php
                                                                if ($student_profile['priority3_time'] != 0 || $student_profile['priority3_time'] != "" || $student_profile['priority3_time'] != NULL) {
                                                                    if ($student_profile['priority3_time'] == 1) {
                                                                        echo "Full Time";
                                                                    } else if ($student_profile['priority3_time'] == 2) {
                                                                        echo "Part Time";
                                                                    }
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?></label></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <input id="reg_student_id" name="reg_student_id" type="text" value="<?php echo $student_profile['or_stu_id']; ?>" hidden>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="container">
                    <!--Please Enter Your Index No-->
                  <!--  <div class="card card-info shadow">
                        <input id="reg_student_id" name="reg_student_id" type="text" value="<?php echo $student_profile['or_stu_id']; ?>">
                        <div class="card-header">
                            <h3 class="card-title">Please enter your Index No/</h3>
                        </div>

                        <div class="card-body mandatory">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Index No</label>
                                <div class="col-sm">
                                    <label for="" id="view_indexno" name="view_indexno" class="col-sm-4 col-form-label"><?php echo $student_profile['indexno']; ?></label>
                                </div>
                            </div>
                        </div>

                    </div> -->

                    <!--Personal Details-->
                   <!-- <div class="card card-info shadow">
                        <div class="card-header ">
                            <h3 class="card-title ">Personal Details/</h3>
                        </div>

                        <div class="card-body mandatory">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Full Name</label>
                                <div class="col-sm">
                                    <label for="" id="view_fullname" name="view_fullname" class="col-sm col-form-label"><?php echo $student_profile['fullname']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Name with intials</label>
                                <div class="col-sm">
                                    <label for="" id="view_initials_name" name="view_initials_name" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['initials_name']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">National Identity Card No</label>
                                <div class="col-sm-4">
                                    <label for="" id="view_nic" name="view_nic" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['nic']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Date of Birth (DD/MM/YYYY)</label>
                                <div class="col-sm">
                                    <label for="" id="view_d_o_b" name="view_d_o_b" class="col-sm-4 col-form-label col-form-label-sm"><?php echo $student_profile['d_o_b']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm">
                                    <label for="" id="view_gender" name="view_gender" class="col-sm-4 col-form-label col-form-label-sm"><?php echo $student_profile['gender']; ?></label>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!--Contact Details-->
                   <!-- <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Contact Details</h3>
                        </div>

                        <div class="card-body mandatory">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Email Address</label>
                                <div class="col-sm">
                                    <label for="" id="view_email" name="view_email" class="col-sm col-form-label"><?php echo $student_profile['email']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">phone no</label>
                                <div class="col-sm">
                                    <label for="" id="view_phoneno" name="view_phoneno" class="col-sm col-form-label"><?php echo $student_profile['phoneno']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Land no</label>
                                <div class="col-sm">
                                    <label for="" id="view_landno" name="view_landno" class="col-sm col-form-label"><?php echo $student_profile['landno']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm">
                                    <label for="" id="view_address" name="view_address" class="col-sm col-form-label"><?php echo $student_profile['address']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">District</label>
                                <div class="col-sm">
                                    <label for="" id="view_district" name="view_district" class="col-sm col-form-label"><?php echo $student_profile['district']; ?></label>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!--A/L Examinations-->
                    <!-- <div class="card card-info shadow">
                        <div class="card-header ">
                            <h3 class="card-title ">G.C.E A/L Examination</h3>
                        </div>

                        <div class="card-body mandatory">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Academic Year</label>
                                <div class="col-sm-8">
                                    <label for="" id="view_al_academic_year" name="view_al_academic_year" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['al_academic_year']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Index No</label>
                                <div class="col-sm-8">
                                    <label for="" id="view_al_index_no" name="view_al_index_no" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['al_index_no']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Z-Score</label>
                                <div class="col-sm-8">
                                    <label for="" id="view_full_z_score" name="view_full_z_score" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['z_score']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Stream</label>
                                <div class="col-sm-8">
                                    <label for="" id="view_al_stream" name="view_al_stream" class="col-sm col-form-label col-form-label-sm"><?php echo $student_profile['al_stream_name']; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">A/L Subjects</label><br>
                                <div class="col-sm">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><label>Subjects</label></th>
                                                    <th scope="col"><label>Grade</label></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label id="view_al_subject1" name="view_al_subject1"><?php echo $student_profile['al_sub_1']; ?></label></td>
                                                    <td><label id="view_al_sub1_grade" name="view_al_sub1_grade"><?php echo $student_profile['al_subg_1']; ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="view_al_subject2" name="view_al_subject2"><?php echo $student_profile['al_sub_2']; ?></label></td>
                                                    <td><label id="view_al_sub2_grade" name="view_al_sub2_grade"><?php echo $student_profile['al_subg_2']; ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="view_al_subject3" name="view_al_subject3"><?php echo $student_profile['al_sub_3']; ?></label></td>
                                                    <td><label id="view_al_sub3_grade" name="view_al_sub3_grade"><?php echo $student_profile['al_subg_3']; ?></label></td>
                                                </tr>
                                                <tr id="al_row_4">
                                                    <td><label id="view_al_subject4" name="view_al_subject4"><?php echo $student_profile['al_sub_4']; ?></label></td>
                                                    <td><label id="view_al_sub4_grade" name="view_al_sub4_grade"><?php echo $student_profile['al_subg_4']; ?></label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <label id="lbl_al_subjects" class="col-md-10 control-label" style="color: red"></label>
                            </div>
                        </div>


                    </div> -->


                    <!--O/L Examinations-->
                    <!-- <div class="card card-info shadow">
                        <div class="card-header ">
                            <h3 class="card-title ">G.C.E O/L Examination</h3>
                        </div>

                        <div class="card-body mandatory">
                            <?php if ($student_profile['ol_english_index_no'] === 0 || $student_profile['ol_english_index_no'] === "" || $student_profile['ol_english_index_no'] === null) { ?>
                                <div id="view_aa">
                                    <div class='form-group row'>
                                        <label for='' class='col-sm-4 col-form-label'>Year</label>
                                        <div class='col-sm-8'>
                                            <label for='' id='view_ol_year' name='view_ol_year' class='col-sm col-form-label col-form-label-sm'><?php echo $student_profile['ol_year']; ?></label>
                                        </div>
                                    </div>
                                    <div class='form-group row'>
                                        <label for='' class='col-sm-4 col-form-label'>Results</label>
                                        <div class='form-group col-md'>
                                            <table class='table'>
                                                <thead>
                                                    <tr>
                                                        <th scope='col'><label>Mathematics</label></th>
                                                        <th scope='col'><label>English</label></th>
                                                        <th scope='col'><label>Index No</label></th>
                                                    </tr>
                                                <thead>
                                                <tbody>
                                                    <tr>
                                                        <td><label id='view_ol_maths_grade' name='view_ol_maths_grade'><?php echo $student_profile['ol_math']; ?></label></td>
                                                        <td><label id='view_ol_english_grade' name='view_ol_english_grade'><?php echo $student_profile['ol_english']; ?></label></td>
                                                        <td><label id='view_ol_index_no' name='view_ol_index_no'><?php echo $student_profile['ol_index_no']; ?></label></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div id="bb">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Results</label>
                                        <div class="form-group col-md">
                                            <table>
                                                <tr>
                                                    <td><label>Subjects</label></td>
                                                    <td><label>Grade</label></td>
                                                    <td><label>Year</label></td>
                                                    <td><label>Index No</label></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="view_ol_maths_grade" name="view_ol_maths_grade">Mathematics</label></td>
                                                    <td><label id="view_ol_maths_grade" name="view_ol_maths_grade"><?php echo $student_profile['ol_math']; ?></label></td>
                                                    <td><label id="view_ol_year" name="view_ol_year"><?php echo $student_profile['ol_year']; ?></label></td>
                                                    <td><label id="view_ol_index_no" name="view_ol_index_no"><?php echo $student_profile['ol_index_no']; ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td><label id="view_ol_english_grade" name="view_ol_english_grade">English</label></td>
                                                    <td><label id="view_ol_english_grade" name="view_ol_english_grade"><?php echo $student_profile['ol_english']; ?></label></td>
                                                    <td><label id="view_ol_english_year" name="view_ol_english_year"><?php echo $student_profile['ol_english_year']; ?></label></td>
                                                    <td><label id="view_ol_english_index_no" name="view_ol_english_index_no"><?php echo $student_profile['ol_english_index_no']; ?></label></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>



                            
                        </div>
                    </div> -->


                    <!--Select Course-->
                    <!-- <div class="card card-info shadow">
                        <div class="card-header ">
                            <h3 class="card-title ">Select Course/</h3>
                        </div>

                        <div class="card-body mandatory">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Center</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="priority_1_row">
                                        <th scope="row">Priority 1</th>
                                        <td><label id="view_priority1_center" name="view_priority1_center"><?php echo $student_profile['p1center']; ?></label></td>
                                        <td><label id="view_priority1_course" name="view_priority1_course"><?php echo $student_profile['p1course']; ?></label></td>
                                        <td><label id="view_priority1_time" name="view_priority1_time"><?php
                                                if ($student_profile['priority1_time'] == 1) {
                                                    echo "Full Time";
                                                } else {
                                                    echo "Part Time";
                                                }
                                                ?></label></td>
                                    </tr>
                                    <tr id="priority_2_row" >
                                        <th scope="row">Priority 2</th>
                                        <td><label id="view_priority2_center" name="view_priority2_center"><?php
                                                if ($student_profile['priority2_center'] != 0 || $student_profile['priority2_center'] != "" || $student_profile['priority2_center'] != NULL) {
                                                    echo $student_profile['p2center'];
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?></label></td>
                                        <td><label id="view_priority2_course" name="view_priority2_course"><?php
                                                if ($student_profile['priority2_course'] != 0 || $student_profile['priority2_course'] != "" || $student_profile['priority2_course'] != NULL) {
                                                    echo $student_profile['p2course'];
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?></label></td>
                                        <td><label id="view_priority2_time" name="view_priority2_time"><?php
                                                if ($student_profile['priority2_time'] != 0 || $student_profile['priority2_time'] != "" || $student_profile['priority2_time'] != NULL) {
                                                    if ($student_profile['priority2_time'] == 1) {
                                                        echo "Full Time";
                                                    } else if ($student_profile['priority2_time'] == 2) {
                                                        echo "Part Time";
                                                    }
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?></label></td>
                                    </tr>
                                    <tr id="priority_3_row">
                                        <th scope="row">Priority 3</th>
                                        <td><label id="view_priority3_center" name="view_priority3_center"><?php
                                                if ($student_profile['priority3_center'] != 0 || $student_profile['priority3_center'] != "" || $student_profile['priority3_center'] != NULL) {
                                                    echo $student_profile['p3center'];
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?></label></td>
                                        <td><label id="view_priority3_course" name="view_priority3_course"><?php
                                                if ($student_profile['priority3_course'] != 0 || $student_profile['priority3_course'] != "" || $student_profile['priority3_course'] != NULL) {
                                                    echo $student_profile['p3course'];
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?></label></td>
                                        <td><label id="view_priority3_time" name="view_priority3_time"><?php
                                                if ($student_profile['priority3_time'] != 0 || $student_profile['priority3_time'] != "" || $student_profile['priority3_time'] != NULL) {
                                                    if ($student_profile['priority3_time'] == 1) {
                                                        echo "Full Time";
                                                    } else if ($student_profile['priority3_time'] == 2) {
                                                        echo "Part Time";
                                                    }
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?></label></td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>  -->

                    
                    <!-- <div class="card card-info shadow">
                        <div class="card-body mandatory">I Agree To The ... A sample code to make sure your "I Agree" checkbox is checked by .<br>
                            <button type="button" onclick="update_student_apprv_status();" class="btn btn-default sl-btn btn-sm">Approve</button>
                            <button type="button" onclick="update_student_reject_status();"id="confirm" class="btn btn-default sl-btn btn-sm">Reject</button>
                        </div>
                    </div> -->
                </div> 
            </div>


        </div>

    </div>
</div>
<script>
    $(document).ready( function () {
        var value = "<?php echo $student_profile['d_o_b']; ?>";
        
        var today = new Date(),dob = new Date(value.replace(/(\d{2})-(\d{2})-(\d{4})/, "$3/$1/$2"));
        var age = today.getFullYear() - dob.getFullYear(); //This is the update
        $("#age").html(age+" years old");
    });
    
    function update_student_apprv_status()
    {
        var status = 1;
        var id = $('#reg_student_id').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('App/update_student_apprv_status') ?>",
            data: {"id": id, "status": status},
            success: function (data) {
                location.reload();
            }});

    }

    function update_student_reject_status() {
        var status = 2;
        var id = $('#reg_student_id').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('App/update_student_reject_status') ?>",
            data: {"id": id, "status": status},
            success: function (data) {
                location.reload();
            }});
    }


</script>




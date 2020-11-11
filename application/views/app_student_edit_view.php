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
                    <?php 
                        $check_success = $this->session->flashdata('message');
                        if($check_success == "success"){
                    ?>
                        <script type="text/javascript">
                           $(document).ready(function(){
                                $.notify({
                                // options
                                message: 'Successfully Updated' 
                                },{
                                // settings
                                    type: 'success'
                                });
                            });
                       </script>
                    <?php 
                        } 
                    ?>
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
                                <form class="form-horizontal ml-5 mr-5" id="reg_form" name="reg_form" method="post" action="<?php echo base_url('App/update_online_student')  ?>">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs reg_tabs" id="custom-tabs-three-tab" role="tablist" style="border-bottom: 2px solid #04632e;">
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab active" style="/*pointer-events: none; */" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false"><i class="icon fas fa-id-card-alt"></i> &nbsp;Index</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab" style="/*pointer-events: none; */" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="true"><i class="icon fas fa-user"></i> &nbsp;Personal</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab" style="/*pointer-events: none; */" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false"><i class="icon fas fa-id-card"></i> &nbsp;Contact</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab" style="/*pointer-events: none; */" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"><i class="icon fas fa-school"></i> &nbsp;A/L</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab" style="/*pointer-events: none; */" id="custom-tabs-three-ol-tab" data-toggle="pill" href="#custom-tabs-three-ol" role="tab" aria-controls="custom-tabs-three-ol" aria-selected="false"><i class="icon fas fa-school"></i> &nbsp;O/L</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab" style="/*pointer-events: none; */" id="custom-tabs-three-course-tab" data-toggle="pill" href="#custom-tabs-three-course" role="tab" aria-controls="custom-tabs-three-course" aria-selected="false"><i class="icon fas fa-university"></i> &nbsp;Course</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link ubuntu normal-tab" style="/*pointer-events: none; */" id="custom-tabs-three-preview-tab" data-toggle="pill" href="#custom-tabs-three-preview" role="tab" aria-controls="custom-tabs-three-preview" aria-selected="false"><i class="icon fas fa-university"></i> &nbsp;preview</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body" style="/* border-top: 1px solid #007bff; */">
                                        <div class="tab-content" id="custom-tabs-three-tabContent">
                                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                                <h6 class="ubuntu"><i class="icon fas fa-question-circle"></i> &nbsp;Index Information</h6><hr>
                                                <div class="form-group row">
                                                    <div class="form-row">
                                                        <div class="form-group col-md">
                                                            <label for="indexno" class="ubuntu">Index No<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                            <input type="text" class="form-control border-radius ubuntu" id="indexno" name="indexno" placeholder="Index No" value="<?php echo $student_profile['indexno']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                                <h6 class="ubuntu"><i class="icon fas fa-info-circle"></i> &nbsp;Personal Information</h6><hr>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="district" class="ubuntu">Title<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <select type="text" class="form-control border-radius ubuntu" id="title" name="title">
                                                            <option value="">Select Title</option>
                                                            <?php
                                                            foreach ($titles as $row):
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>" name="<?php echo $row['title_name']; ?>">
                                                                    <?php echo $row['title_name']; ?>
                                                                </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="fullname" class="ubuntu">Full Name<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control border-radius ubuntu" id="fullname" name="fullname" placeholder="" value="<?php echo $student_profile['fullname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="initials_name" class="ubuntu">Name with Initials<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control border-radius ubuntu" id="initials_name" name="initials_name" placeholder="" value="<?php echo $student_profile['initials_name']; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="initials_name" class="ubuntu">NIC<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control border-radius nic-validate ubuntu" id="nic" name="nic" value="<?php echo $student_profile['nic']; ?>" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="initials_name" class="ubuntu">Date of Birth (YYYY/MM/DD)<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text border-radius"><i class="far fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control border-radius ubuntu" id="d_o_b" name="d_o_b" placeholder="DD/MM/YYYY" value="<?php echo $student_profile['d_o_b']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="initials_name" class="ubuntu">Gender<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <div class="col-sm">
                                                            <input type="radio" name="gender" value="male" id="male"> <label class="form-check-label ubuntu">Male</label><br>
                                                        </div>
                                                        <div class="col-sm">
                                                            <input type="radio" name="gender" value="female" id="female"> <label class="form-check-label ubuntu">Female</label><br>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct1();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                                <h6 class="ubuntu"><i class="icon fas fa-address-book"></i> &nbsp;Contact Information</h6><hr>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="email" class="ubuntu">Email Address<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control border-radius ubuntu" id="email" name="email" placeholder="" value="<?php echo $student_profile['email']; ?>">
                                                        <span id="email_v_message" class="ubuntu"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="phoneno" class="ubuntu">Phone no<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control border-radius ubuntu" id="phoneno" name="phoneno" placeholder="" value="<?php echo $student_profile['phoneno']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="landno" class="ubuntu">Land no<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control border-radius ubuntu" id="landno" name="landno" placeholder="" value="<?php echo $student_profile['landno']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="address" class="ubuntu">Address<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <textarea class="form-control border-radius ubuntu" id="address" name="address" placeholder="" value=""><?php echo $student_profile['address']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="district" class="ubuntu">District<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <select type="text" class="form-control border-radius ubuntu" id="district" name="district">
                                                            <option value="">---Select District---</option>
                                                            <?php
                                                            $dsrt = $this->db->get('cfg_district')->result_array();
                                                            foreach ($districts as $row):
                                                                $selected = "";
                                                                if ($row['district'] == $student_profile['district']) {
                                                                    $selected = "selected";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $row['code']; ?>" name="<?php echo $row['district']; ?>" <?php echo $selected ?>>
                                                                    <?php echo $row['district']; ?>
                                                                </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                        <span id="desig" class="ubuntu"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct2();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                                                <h6 class="ubuntu"><i class="icon fas fa-book-open"></i> &nbsp;G.C.E A/L Information</h6><hr>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="indexno" class="ubuntu">A/L Academic Year<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control ubuntu border-radius" id="al_academic_year" name="al_academic_year" placeholder="Year" value="<?php echo $student_profile['al_academic_year']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="indexno" class="ubuntu">Index No<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <input type="text" class="form-control ubuntu border-radius" id="al_index_no" name="al_index_no" placeholder="" value="<?php echo $student_profile['al_index_no']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="indexno" class="ubuntu">Z-Score<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <select class="form-control border-radius ubuntu" id="plus_minus" name="plus_minus">
                                                                    <?php
                                                                    $zcore = $student_profile['z_score'];

                                                                    $operator = $zcore[0];
                                                                    $core = substr($zcore, 1);

                                                                    if ($operator == '+') {
                                                                        ?>
                                                                        <option selected>+</option>
                                                                        <option>-</option>
                                                                        <?php
                                                                    }

                                                                    if ($operator == '-') {
                                                                        ?>
                                                                        <option>+</option>
                                                                        <option selected>-</option> 
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <input type="text" class="form-control border-radius ubuntu" id="z_score" name="z_score" placeholder="Z-Score" value="<?php echo $core ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <label for="indexno" class="ubuntu">Stream<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                        <select type="text" class="form-control border-radius ubuntu" id="al_stream" name="al_stream" onload="load_subjects_onload(this.value, null, this);" onchange="load_subjects(this.value, null, this);">
                                                            <option value="">---Select Stream---</option>
                                                            <?php
                                                            $sub_stream = $this->db->get('com_al_subject_stream')->result_array();
                                                            foreach ($al_subject_streams as $row):
                                                                //$selected = "";
                                                                //if ($row['stream_id'] == $student_profile['al_stream']) {
                                                                //    $selected = "selected";
                                                                //}
                                                                ?>
                                                                <option value="<?php echo $row['stream_id']; ?>" name="<?php echo $row['stream_name']; ?>" <?php // echo $selected  ?>>
                                                                    <?php echo $row['stream_name']; ?>
                                                                </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="form-group row">
                                                    <label for="" class="col-sm-3 ubuntu">A/L Subjects <span id="select_subject_alert" style="color:red;"><b> </b></span></label><br>
                                                    <div class="col-sm">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Subject 1<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="al_subject1" name="al_subject1" onchange="">
                                                                    <option value="">--Select Subject--</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Grade 1<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" id="al_sub1_grade" name="al_sub1_grade" class="form-control border-radius ubuntu" placeholder=".col-3" onchange="">
                                                                    <option value="">-Grade-</option>
                                                                    <?php
                                                                    foreach ($al_grade as $row):
                                                                        $selected = "";
                                                                        if ($row['grade_id'] == $student_profile['al_sub1_grade']) {
                                                                            $selected = "selected";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>" <?php echo $selected; ?>>
                                                                            <?php echo $row['grade']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <p id="demo1" style="color: red"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Subject 2<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="al_subject2" name="al_subject2" onchange="">
                                                                    <option value="">--Select Subject--</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Grade 2<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" id="al_sub2_grade" name="al_sub2_grade" class="form-control border-radius ubuntu" placeholder=".col-3" onchange="">
                                                                    <option value="">-Grade-</option>
                                                                    <?php
                                                                    foreach ($al_grade as $row):
                                                                        $selected = "";
                                                                        if ($row['grade_id'] == $student_profile['al_sub2_grade']) {
                                                                            $selected = "selected";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>" <?php echo $selected; ?>>
                                                                            <?php echo $row['grade']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <p id="demo2" style="color: red"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Subject 3<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="al_subject3" name="al_subject3" onchange="">
                                                                    <option value="">--Select Subject--</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Grade 3<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" id="al_sub3_grade" name="al_sub3_grade" class="form-control border-radius ubuntu" placeholder=".col-3" onchange="">
                                                                    <option value="">-Grade-</option>
                                                                    <?php
                                                                    foreach ($al_grade as $row):
                                                                        $selected = "";
                                                                        if ($row['grade_id'] == $student_profile['al_sub3_grade']) {
                                                                            $selected = "selected";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>" <?php echo $selected; ?>>
                                                                            <?php echo $row['grade']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <p id="demo3" style="color: red"></p>
                                                            </div>
                                                            <div class="col">
                                                                <button type="button" id="add_section" name="add_section" onclick="add_row();" class="btn btn-primary btn-sm ubuntu">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="subject4_row" name="subject4_row" style="display:none">
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Subject 4<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="al_subject4" name="al_subject4" onchange="">
                                                                    <option value="">--Select Subject--</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="col-sm col-form-label ubuntu">Grade 4<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" id="al_sub4_grade" name="al_sub4_grade" class="form-control border-radius ubuntu" placeholder=".col-3" onchange="">
                                                                    <option value="" name="">-Grade-</option>
                                                                    <?php
                                                                    foreach ($al_grade as $row):
                                                                        $selected = "";
                                                                        if ($row['grade_id'] == $student_profile['al_sub4_grade']) {
                                                                            $selected = "selected";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>" <?php echo $selected; ?>>
                                                                            <?php echo $row['grade']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <p id="demo4" style="color: red"></p>
                                                            </div>
                                                            <div class="col">
                                                                <button type="button" id="delete_section" name="delete_section" onclick="delete_row();" class="btn btn-primary btn-sm ubuntu">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md">
                                                                <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct3();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                                <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-three-ol" role="tabpanel" aria-labelledby="custom-tabs-three-ol-tab">
                                                <h6 class="ubuntu"><i class="icon fas fa-book-open"></i> &nbsp;G.C.E O/L Information</h6><hr>
                                                <div class="form-group row">
                                                    <!--<label for="" class="col-sm-3 col-form-label">Sat For Exam In</label>-->
                                                    <div class="col-sm">
                                                        <div class="row" hidden>
                                                            <?php if ($student_profile['ol_english_index_no'] === 0 || $student_profile['ol_english_index_no'] === "" || $student_profile['ol_english_index_no'] === null) { ?>
                                                                <div class="col-sm-2">
                                                                    <input class="user-radio" type="radio" name="ol_diff_year" value="1" id="single_year" onchange="ol_section();view_section();" checked> Single<br>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <input class="user-radio" type="radio" name="ol_diff_year" value="2" onchange="ol_section();view_section();" id="multiple_year"> Several Years<br>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="col-sm-2">
                                                                    <input class="user-radio" type="radio" name="ol_diff_year" value="1" id="single_year" onchange="ol_section();view_section();"> Single<br>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <input class="user-radio" type="radio" name="ol_diff_year" value="2" onchange="ol_section();view_section();" id="multiple_year" checked> Several Years<br>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="ol_box" name="ol_box">
                                                    <div id="aa"></div>
                                                    <div id="bb"></div>
                                                </div><br>
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct4();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="custom-tabs-three-course" role="tabpanel" aria-labelledby="custom-tabs-three-course-tab">
                                                <h6 class="ubuntu"><i class="icon fas fa-university"></i> &nbsp;Course Information</h6><hr>
                                                <div class=" row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label ubuntu">Priority - 1<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                            <div class="col-sm">
                                                                <label for="" class="col-sm col-form-label ubuntu">Center<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority1_center" name="priority1_center" onchange="priority1_get_courses(this.value, 1, null)" data-validation="required">
                                                                    <option value="" name="">-Select Center-</option>
                                                                    <?php
                                                                    foreach ($center as $row):
//                                                                    $selected="";
//                                                                    if($row['br_id'] == $student_profile['priority1_center']){
//                                                                        $selected = "selected";
//                                                                    }
//                                                                    
                                                                        ?>
                                                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>" <?php //echo $selected; ?>>
                                                                        <?php echo $row['br_name']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm">
                                                                <div class="col-sm">
                                                                    <label for="" class="col-sm col-form-label ubuntu">Course<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                    <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority1_course" name="priority1_course" onchange="priority1_load_time()" data-validation="required">
                                                                        <option value="" name="">-Select Course-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm">
                                                                <div class="col-sm">
                                                                    <label for="" class="col-sm col-form-label ubuntu">Time<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                                    <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority1_time" name="priority1_time" data-validation="required">
                                                                        <option value="" name="">-Select Time-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--course select row-->

                                                <div class=" row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label ubuntu">Priority - 2</label>
                                                            <div class="col-sm">
                                                                <label for="" class="col-sm col-form-label ubuntu">Center</label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority2_center" name="priority2_center" onchange="priority2_get_courses(this.value, 1, null)" data-validation="required">
                                                                    <option value="" name="">-Select Center-</option>
                                                                    <?php
                                                                    foreach ($center as $row):
                                                                        //$selected="";
                                                                        //if($row['br_id'] == $student_profile['priority2_center']){
                                                                        //    $selected = "selected";
                                                                        //}
                                                                        ?>
                                                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>" <?php echo $selected; ?>>
                                                                        <?php echo $row['br_name']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm">
                                                                <div class="col-sm">
                                                                    <label for="" class="col-sm col-form-label ubuntu">Course</label>
                                                                    <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority2_course" name="priority2_course" onchange="priority2_load_time()" data-validation="required">
                                                                        <option value="" name="">-Select Course-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm">
                                                                <div class="col-sm">
                                                                    <label for="" class="col-sm col-form-label ubuntu">Time</label>
                                                                    <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority2_time" name="priority2_time" data-validation="required">
                                                                        <option value="" name="">-Select Time-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--course select row-->

                                                <div class=" row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label ubuntu">Priority - 3</label>
                                                            <div class="col-sm">
                                                                <label for="" class="col-sm col-form-label ubuntu">Center</label>
                                                                <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority3_center" name="priority3_center" onchange="priority3_get_courses(this.value, 1, null)" data-validation="required">
                                                                    <option value="" name="">-Select Center-</option>
                                                                    <?php
                                                                    foreach ($center as $row):
                                                                        //$selected="";
                                                                        //if($row['br_id'] == $student_profile['priority3_center']){
                                                                        //    $selected = "selected";
                                                                        //}
                                                                        ?>
                                                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>" <?php echo $selected; ?>>
                                                                        <?php echo $row['br_name']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm">
                                                                <div class="col-sm">
                                                                    <label for="" class="col-sm col-form-label ubuntu">Course</label>
                                                                    <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority3_course" name="priority3_course" onchange="priority3_load_time()" data-validation="required">
                                                                        <option value="" name="">-Select Course-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group row">
                                                            <div class="col-sm">
                                                                <div class="col-sm">
                                                                    <label for="" class="col-sm col-form-label ubuntu">Time</label>
                                                                    <select type="text" class="form-control border-radius ubuntu" placeholder=".col-3" id="priority3_time" name="priority3_time" data-validation="required">
                                                                        <option value="">-Select Time-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct5();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-three-preview" role="tabpanel" aria-labelledby="custom-tabs-three-preview-tab">
                                                <div class="form-row">
                                                    <div class="form-group col-md">
                                                        <button type="submit" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick=""><span class="fas fa-pen-alt"></span> &nbsp;Update</button>
                                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="reg_student_id" name="reg_student_id" type="text" value="<?php echo $student_profile['or_stu_id']; ?>" hidden>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <!--Please Enter Your Index No-->
                    <!-- <div class="card card-info shadow">
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
                    </div> -->







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
    function load_subjects_edit_load(stream_id, al_subject1, al_subject2, al_subject3, al_subject4)
    {
        $('#al_subject1').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject2').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject3').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');
        $('#al_subject4').find('option').remove().end().append('<option value="">---Select subject---</option>').val('');

        $.post("<?php echo base_url('Student/load_al_subject_list') ?>", {'stream_id': stream_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $("#al_subject1").append($('<option>', {value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', {value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', {value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', {value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }

                    $('#al_subject1').val(al_subject1);
                    $('#al_subject2').val(al_subject2);
                    $('#al_subject3').val(al_subject3);
                    $('#al_subject4').val(al_subject4);
                },
                "json"
                );

    }

    function load_priority1_load(priority1_center, priority1_course, priority1_time) {
        $('#priority1_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#priority1_time').find('option').remove().end().append('<option value="">---Select Time---</option>').val('');

        $.post("<?php echo base_url('App/load_course_list') ?>", {'center_id': priority1_center},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#priority1_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));


                        //$("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }

                    $('#priority1_course').val(priority1_course);

                    //$('#al_subject4').val(al_subject4);

                },
                "json"
                );

        $('#priority1_time').empty();

        var x = $('#priority1_course').val();

        $('#priority1_time').append('<option value="" name="">Select Time</option>');
        $('#priority1_time').append('<option value="1" name="full">Full Time</option>');
        $('#priority1_time').append('<option value="2" name="part">Part Time</option>');

        $('#priority1_time').val(priority1_time);
    }

    function load_priority2_load(priority2_center, priority2_course, priority2_time) {
        $('#priority2_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#priority2_time').find('option').remove().end().append('<option value="">---Select Time---</option>').val('');

        $.post("<?php echo base_url('App/load_course_list') ?>", {'center_id': priority2_center},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#priority2_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));


                        //$("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }

                    $('#priority2_course').val(priority2_course);

                    //$('#al_subject4').val(al_subject4);

                },
                "json"
                );

        $('#priority2_time').empty();

        var x = $('#priority2_course').val();

        $('#priority2_time').append('<option value="" name="">Select Time</option>');
        $('#priority2_time').append('<option value="1" name="full">Full Time</option>');
        $('#priority2_time').append('<option value="2" name="part">Part Time</option>');

        $('#priority2_time').val(priority2_time);
    }

    function load_priority3_load(priority3_center, priority3_course, priority3_time) {
        $('#priority3_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        $('#priority3_time').find('option').remove().end().append('<option value="">---Select Time---</option>').val('');

        $.post("<?php echo base_url('App/load_course_list') ?>", {'center_id': priority3_center},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#priority3_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));


                        //$("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }

                    $('#priority3_course').val(priority3_course);

                    //$('#al_subject4').val(al_subject4);

                },
                "json"
                );

        $('#priority3_time').empty();

        var x = $('#priority3_course').val();

        $('#priority3_time').append('<option value="" name="">Select Time</option>');
        $('#priority3_time').append('<option value="1" name="full">Full Time</option>');
        $('#priority3_time').append('<option value="2" name="part">Part Time</option>');

        $('#priority3_time').val(priority3_time);
    }

    $(document).ready(function () {
        $("#al_academic_year").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        
        $("#title").change(function () {
            var title = $('#title').val();
            if (title == "") {
                $('#title').removeClass("is-valid").addClass("is-invalid");
            } else {
                //document.getElementById("district").style.borderColor = "green";
                $('#title').removeClass("is-invalid").addClass("is-valid");
            }
        });
        
        var value = "<?php echo $student_profile['d_o_b']; ?>";

        var today = new Date(), dob = new Date(value.replace(/(\d{2})-(\d{2})-(\d{4})/, "$3/$1/$2"));
        var age = today.getFullYear() - dob.getFullYear(); //This is the update
        $("#age").html(age + " years old");

        var stu_id = $('#reg_student_id').val();

        $.post("<?php echo base_url('App/load_student_details') ?>", {stu_id: stu_id},
                function (data)
                {
                    $('#title').val(data['title']);
                    $('#al_stream').val(data['al_stream']);
                    load_subjects_edit_load(data['al_stream'], data['al_subject1'], data['al_subject2'], data['al_subject3'], data['al_subject4']);
                    $('#priority1_center').val(data['priority1_center']);
                    $('#priority2_center').val(data['priority2_center']);
                    $('#priority3_center').val(data['priority3_center']);

                    load_priority1_load(data['priority1_center'], data['priority1_course'], data['priority1_time']);
                    load_priority2_load(data['priority2_center'], data['priority2_course'], data['priority2_time']);
                    load_priority3_load(data['priority3_center'], data['priority3_course'], data['priority3_time']);
                },
                "json");




        $('.btnPrevious').click(function () {
            $('.reg_tabs .active').parent().prev('li').find('a').trigger('click');
        });
        //-----Same Subject Validation---http://jsfiddle.net/z4rknhg2/----//
        var backups = {};
        $("select[id^=al_subject]").change(function () {
            var v = $(this).val();
            var f = false;
            $("select[id^=al_subject]").not(this).each(function () {
                if ($(this).val() == v) {
                    f = true;
                    return;
                }
            });
            if (f) {
                $(this).val(backups[$(this).attr("id")]);
//                $.notify({
//                        // options
//                        message: 'You Cant Select Same Subject.' 
//                },{
//                        // settings
//                        type: 'warning'
//                });
                alert("You can't Choose the Same Subject");
            } else {
                backups[$(this).attr("id")] = v;
            }
        }).val(null);
        //-----End Same Subject Validation----//

        var stream = $("#al_stream").val();
        var ol_years = $("input[name='ol_diff_year']:checked").val();

        if (ol_years == 1) {
            $("#bb").empty();
            $("#aa").append("<div class='form-row'>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='indexno' class='ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                    <input type='text' class='form-control ubuntu border-radius' id='ol_year' name='ol_year' placeholder='' onkeyup='single_ol_year()' value='<?php echo $student_profile['ol_year']; ?>'>\n\
                                </div>\n\
                            </div>\n\
                            <div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label ubuntu'>Results<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label ubuntu'>Mathematics<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                    <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                        <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = '';
                                                    if ($row["grade_id"] == $student_profile["ol_maths_grade"]) {
                                                        $selected = "selected";
                                                    } ?>\n\
                                            <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected ?>><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                    </select>\n\
                                </div>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label ubuntu'>English<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = '';
                                                    if ($row["grade_id"] == $student_profile["ol_english_grade"]) {
                                                        $selected = "selected";
                                                    } ?>\n\
                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected ?>><?php echo $row["grade"]; ?></option>\n\
<?php endforeach; ?>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class='form-group col-md'>\n\
                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                        <input type='text' class='form-control border-radius ubuntu' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_index_no"]; ?>'>\n\
                                    </div>\n\
                                </div>");
                                $("#ol_year").datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
        } else {
            $("#aa").empty();
            $("#bb").append("<div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label'>Results</label>\n\
                                    <div class='col-sm'>\n\
                                        <div class='row'>\n\
                                            <div class='col-sm'>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Mathematics<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = '';
    if ($row["grade_id"] == $student_profile["ol_maths_grade"]) {
        $selected = "selected";
    } ?>\n\
                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected ?>><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_year' name='ol_year' placeholder='' data-validation='required' value='<?php echo $student_profile['ol_year']; ?>'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required' value='<?php echo $student_profile['ol_index_no']; ?>'>\n\
                                                    </div>\n\
                                                </div><br>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>English<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = '';
    if ($row["grade_id"] == $student_profile["ol_english_grade"]) {
        $selected = "selected";
    } ?>\n\
                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected ?>><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_english_year' name='ol_english_year' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_english_year"]; ?>'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_english_index_no' name='ol_english_index_no' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_english_index_no"]; ?>'>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                 </div>");
                                $("#ol_year").datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
                                $("#ol_english_year").datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
        }

        $("#phoneno").inputmask("999-999-9999");
        $("#landno").inputmask("999-999-9999");

<?php
$al_sub_four = $student_profile['al_subject4'];
if ($al_sub_four == 0 || $al_sub_four == "" || $al_sub_four == NULL) {
    ?>
            $("#subject4_row").hide("");
            //alert('full');
<?php } else { ?>
            $("#subject4_row").show();
            $("#add_section").hide();
            //alert('empt');
<?php } ?>

        /*---- Index No Validation ----*/
        $("#indexno").on('keyup focusout', function () {
            var indexno = $('#indexno').val();
            if (indexno == "") {
                $('#indexno').removeClass("is-valid").addClass("is-invalid");
            } else {
                $('#indexno').removeClass("is-invalid").addClass("is-valid");
            }
        });

        $("#ol_maths_grade").change(function () {
            var ol_maths_grade = $('#ol_maths_grade').val();

            if (ol_maths_grade == "") {
                $('#ol_maths_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_maths_grade").style.borderColor = "red";
            } else {
                $('#ol_maths_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_maths_grade").style.borderColor = "green";
            }
        });

        $("#ol_english_grade").change(function () {
            var ol_english_grade = $('#ol_english_grade').val();

            if (ol_english_grade == "") {
                $('#ol_english_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_grade").style.borderColor = "red";
            } else {
                $('#ol_english_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_grade").style.borderColor = "green";
            }
        });

        $("#ol_index_no").keyup(function () {
            var ol_index_no = $('#ol_index_no').val();
            if (ol_index_no == "") {
                $('#ol_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_index_no").style.borderColor = "red";
            } else {
                $('#ol_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_index_no").style.borderColor = "green";
            }
        });

        $("#ol_english_year").keyup(function () {
            var ol_english_year = $('#ol_english_year').val();
            if (ol_english_year == "") {
                $('#ol_english_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_year").style.borderColor = "red";
            } else {
                $('#ol_english_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_year").style.borderColor = "green";
            }
        });

        $("#ol_english_index_no").keyup(function () {
            var ol_english_index_no = $('#ol_english_index_no').val();
            if (ol_english_index_no == "") {
                $('#ol_english_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_index_no").style.borderColor = "red";
            } else {
                $('#ol_english_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_index_no").style.borderColor = "green";
            }
        });


        $("#priority1_center").change(function () {
            var priority1_center = $('#priority1_center').val();

            if (priority1_center == "") {
                $('#priority1_center').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority1_center").style.borderColor = "red";
            } else {
                $('#priority1_center').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority1_center").style.borderColor = "green";
            }
        });

        $("#priority1_course").change(function () {
            var priority1_course = $('#priority1_course').val();

            if (priority1_course == "") {
                $('#priority1_course').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority1_course").style.borderColor = "red";
            } else {
                $('#priority1_course').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority1_course").style.borderColor = "green";
            }
        });

        $("#priority1_time").change(function () {
            var priority1_time = $('#priority1_time').val();

            if (priority1_time == "") {
                $('#priority1_time').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority1_time").style.borderColor = "red";
            } else {
                $('#priority1_time').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority1_time").style.borderColor = "green";
            }
        });


        $("#priority2_center").change(function () {
            var priority2_center = $('#priority2_center').val();

            if (priority2_center == "") {
                $('#priority2_center').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority2_center").style.borderColor = "red";
            } else {
                $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority2_center").style.borderColor = "green";
            }
        });

        $("#priority2_course").change(function () {
            var priority2_course = $('#priority2_course').val();

            if (priority2_course == "") {
                $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority2_course").style.borderColor = "red";
            } else {
                $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority2_course").style.borderColor = "green";
            }
        });

        $("#priority2_time").change(function () {
            var priority2_time = $('#priority2_time').val();

            if (priority2_time == "") {
                $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority2_time").style.borderColor = "red";
            } else {
                $('#priority2_time').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority2_time").style.borderColor = "green";
            }
        });


        $("#priority3_center").change(function () {
            var priority3_center = $('#priority3_center').val();

            if (priority3_center == "") {
                $('#priority3_center').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority3_center").style.borderColor = "red";
            } else {
                $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority3_center").style.borderColor = "green";
            }
        });

        $("#priority3_course").change(function () {
            var priority3_course = $('#priority3_course').val();

            if (priority3_course == "") {
                $('#priority3_course').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority3_course").style.borderColor = "red";
            } else {
                $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority3_course").style.borderColor = "green";
            }
        });

        $("#priority3_time").change(function () {
            var priority3_time = $('#priority3_time').val();

            if (priority3_time == "") {
                $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("priority3_time").style.borderColor = "red";
            } else {
                $('#priority3_time').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("priority3_time").style.borderColor = "green";
            }
        });
    });

    var toggleElements = function () {
        var stream_id = $('#al_stream').val();
        $('#al_subject1').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject2').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject3').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject4').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');

        $.post("<?php echo base_url('App/load_al_subject_list') ?>", {
            'stream_id': stream_id
        },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#al_subject1").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']
                        }));
                    }
                    $("#al_subject1").find('option[value="' + <?php echo $student_profile['al_subject1']; ?> + '"]').prop('selected', true);
                    $("#al_subject2").find('option[value="' + <?php echo $student_profile['al_subject2']; ?> + '"]').prop('selected', true);
                    $("#al_subject3").find('option[value="' + <?php echo $student_profile['al_subject3']; ?> + '"]').prop('selected', true);
                    $("#al_subject4").find('option[value="' + <?php echo $student_profile['al_subject4']; ?> + '"]').prop('selected', true);


                },
                "json"
                );
    };
    /*$('#al_stream').on('change', toggleElements);
     $(document).ready(toggleElements); */

    /*
     var togglePriority1Course1 = function () {
     var center_id = $("#priority1_center").val();
     var flag = 1;
     $('#priority1_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
     $('#priority1_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
     
     if (flag === 1) {
     $.post("<?php echo base_url('App/load_course_list') ?>", {
     'center_id': center_id
     },
     function (data) {
     for (var i = 0; i < data.length; i++) {
     $('#priority1_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
     }
     $("#priority1_course").find('option[value="'+ <?php echo $student_profile['priority1_course']; ?> +'"]').prop('selected', true);
     priority1_load_time();
     $("#priority1_time").find('option[value="'+ <?php echo $student_profile['priority1_time']; ?> +'"]').prop('selected', true);
     },
     "json"
     );
     }
     };
     $('#priority1_center').on('change', togglePriority1Course1);
     $(document).ready(togglePriority1Course1);
     
     var togglePriority2Course1 = function () {
     var center_id = $("#priority2_center").val();
     var flag = 1;
     $('#priority2_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
     $('#priority2_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
     
     if (flag === 1) {
     $.post("<?php echo base_url('App/load_course_list') ?>", {
     'center_id': center_id
     },
     function (data) {
     for (var i = 0; i < data.length; i++) {
     $('#priority2_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
     }
     $("#priority2_course").find('option[value="'+ <?php echo $student_profile['priority2_course']; ?> +'"]').prop('selected', true);
     priority2_load_time();
     $("#priority2_time").find('option[value="'+ <?php echo $student_profile['priority2_time']; ?> +'"]').prop('selected', true);
     },
     "json"
     );
     }
     };
     $('#priority2_center').on('change', togglePriority2Course1);
     $(document).ready(togglePriority2Course1);
     
     var togglePriority3Course1 = function () {
     var center_id = $("#priority3_center").val();
     var flag = 1;
     $('#priority3_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
     $('#priority3_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
     
     if (flag === 1) {
     $.post("<?php echo base_url('App/load_course_list') ?>", {
     'center_id': center_id
     },
     function (data) {
     for (var i = 0; i < data.length; i++) {
     $('#priority3_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
     }
     $("#priority3_course").find('option[value="'+ <?php echo $student_profile['priority3_course']; ?> +'"]').prop('selected', true);
     priority3_load_time();
     $("#priority3_time").find('option[value="'+ <?php echo $student_profile['priority3_time']; ?> +'"]').prop('selected', true);
     },
     "json"
     );
     }
     };
     $('#priority3_center').on('change', togglePriority3Course1);
     $(document).ready(togglePriority3Course1);
     */




    /*---- Fullname Validation ----*/
    $("#fullname").on('keyup focusout', function () {
        var x;
        if (/\w+\s+\w+/.test($("#fullname").val())) {
            var name = document.getElementById("fullname").value;
            var fname = document.getElementById("fullname").value;

            var res = fname.split(' ');
            var iname = res[(res.length) - 1];

            var getInitials = function (name) {
                var parts = name.split(' ');
                var initials = '';

                for (var i = 0; i < parts.length; i++) {
                    if (i != (parts.length) - 1) {
                        if (parts[i].length > 0 && parts[i] !== '') {
                            initials += parts[i][0].trim() + ".";
                        }
                    }
                }
                return initials;
                $("#fullname").removeClass("is-invalid").addClass("is-valid");
                $("#initials_name").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("fullname").style.borderColor = "green";
                //document.getElementById("initials_name").style.borderColor = "green";
                x = true;
            };
            document.getElementById("initials_name").value = getInitials(name) + " " + iname;
            $("#fullname").removeClass("is-invalid").addClass("is-valid");
            $("#initials_name").removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("fullname").style.borderColor = "green";
            //document.getElementById("initials_name").style.borderColor = "green";
            return true;
            x = true;
        } else {
            document.getElementById("initials_name").value = "";
            $("#fullname").removeClass("is-valid").addClass("is-invalid");
            $("#initials_name").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("fullname").style.borderColor = "red";
            //document.getElementById("initials_name").style.borderColor = "red";
            return false;
            x = false;
        }
    });

    /*---- NIC Validation ----*/
    var d_array = [{
            month: 'January',
            days: 31
        },
        {
            month: 'Febr0ary',
            days: 29
        },
        {
            month: 'March',
            days: 31
        },
        {
            month: 'April',
            days: 30
        },
        {
            month: 'May',
            days: 31
        },
        {
            month: 'June',
            days: 30
        },
        {
            month: 'July',
            days: 31
        },
        {
            month: 'August',
            days: 31
        },
        {
            month: 'Septhember',
            days: 30
        },
        {
            month: 'October',
            days: 31
        },
        {
            month: 'November',
            days: 30
        },
        {
            month: 'December',
            days: 31
        }
    ];

    function findDayANDGender(days, d_array) {
        var dayList = days;
        var month = '';
        var result = {
            day: '',
            month: '',
            gender: ''
        };


        if (dayList < 500) {
            result.gender = 'Male';
        } else {
            result.gender = 'Female';
            dayList = dayList - 500;
        }

        for (var i = 0; i < d_array.length; i++) {
            if (d_array[i]['days'] < dayList) {
                dayList = dayList - d_array[i]['days'];
            } else {
                month = d_array[i]['month'];
                break;
            }
        }
        result.day = dayList;
        result.month = month;
        return result;
    }

    function extractData(nicNumber) {
        var nicNumber = nicNumber;
        var result = {
            year: '',
            dayList: '',
            character: ''
        };

        if (nicNumber.length === 10) {
            result.year = nicNumber.substr(0, 2);
            result.dayList = nicNumber.substr(2, 3);
            result.character = nicNumber.substr(9, 10);
        } else if (nicNumber.length === 12) {
            result.year = nicNumber.substr(0, 4);
            result.dayList = nicNumber.substr(4, 3);
            result.character = 'no';
        }
        return result;
    }

    function validation(nicNumber) {
        var result = false;
        if (nicNumber.length === 10 && !isNaN(nicNumber.substr(0, 9)) && isNaN(nicNumber.substr(9, 1).toLowerCase()) && ['x', 'v'].includes(nicNumber.substr(9, 1).toLowerCase())) {
            result = true;
        } else if (nicNumber.length === 12 && !isNaN(nicNumber)) {
            result = true;
        } else {
            result = false;
        }
        return result;
    }

    function getFormattedDate(date) {
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;

        //return month + '/' + day + '/' + year;
        return year + '-' + month + '-' + day;
    }

    $("#nic").on('keyup focusout', function () {
        var y;
        $('.nic-validate-error').html('');
        $('#d_o_b').val('');
        $('.nic-gender').html('');
        var nicNumber = $('.nic-validate').val();
        if (validation(nicNumber)) {
            console.log(nicNumber);
            var extracttedData = extractData(nicNumber);
            var days = extracttedData.dayList;
            var findedData = findDayANDGender(days, d_array);

            var month = findedData.month;
            var year = extracttedData.year;
            var day = findedData.day;
            var gender = findedData.gender;
            var bday = day + '-' + month + '-' + year;
            var birthday = new Date(bday.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
            var birthday = getFormattedDate(birthday);
            $('#d_o_b').val(birthday);
            $('.nic-gender').html(gender);

            if (findedData.gender == "Male") {
                $("#male").prop("checked", true);
            } else {
                $("#female").prop("checked", true);
            }

            $("#nic").removeClass("is-invalid").addClass("is-valid");
            $("#d_o_b").removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("nic").style.borderColor = "green";
            //document.getElementById("d_o_b").style.borderColor = "green";

            y = true;

        } else {
            $("#nic").removeClass("is-valid").addClass("is-invalid");
            $("#d_o_b").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("nic").style.borderColor = "red";
            //document.getElementById("d_o_b").style.borderColor = "red";
            y = true;
        }
    });

    /*---- Phoneno Validation ----*/
    $("#phoneno").on('keyup focusout', function () {
        var ph;
        var phoneno = $('#phoneno').val();

        if (phoneno.length === 0) {
            $("#phoneno").removeClass("is-valid").addClass("is-invalid");
            //ph = false;
        } else {
            $("#phoneno").removeClass("is-invalid").addClass("is-valid");
            //ph = true;
        }

        var phonenoregex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        if (!(phoneno).match(phonenoregex)) {
            $("#phoneno").removeClass("is-valid").addClass("is-invalid");
            ph = false;
        } else {
            $("#phoneno").removeClass("is-invalid").addClass("is-valid");
            ph = true;
        }

        //var inputphone = document.getElementById('phoneno');
        //if (inputphone.value.length === 0)
        //    return;
        //document.getElementById("phoneno").style.borderColor = "green";
    });

    /*---- Landno Validation ----*/
    $("#landno").on('keyup focusout', function () {
        var la;
        var landno = $('#landno').val();

        if (landno.length === 0) {
            $("#landno").removeClass("is-valid").addClass("is-invalid");
            //la = false;
        } else {
            $("#landno").removeClass("is-invalid").addClass("is-valid");
            //la = true;
        }

        var landnoregex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        if (!(landno).match(landnoregex)) {
            $("#landno").removeClass("is-valid").addClass("is-invalid");
            la = false;
        } else {
            $("#landno").removeClass("is-invalid").addClass("is-valid");
            la = true;
        }

        //var inputphone = document.getElementById('phoneno');
        //if (inputphone.value.length === 0)
        //    return;
        //document.getElementById("phoneno").style.borderColor = "green";
    });

    /*---- Address Validation ----*/
    $("#address").on('keyup focusout', function () {
        var address = $('#address').val();
        if (address == "") {
            $('#address').removeClass("is-valid").addClass("is-invalid");
        } else {
            $('#address').removeClass("is-invalid").addClass("is-valid");
        }
//                return;
//            document.getElementById("indexno").style.borderColor = "green";
    });

    /*---- District Validation ----*/
    $("#district").change(function () {
        var inputdesignaiton = $('#district').val();
        if (inputdesignaiton == "") {
            $('#district').removeClass("is-valid").addClass("is-invalid");
            return;
        } else {
            //document.getElementById("district").style.borderColor = "green";
            $('#district').removeClass("is-invalid").addClass("is-valid");
            document.getElementById("desig").innerHTML = "";
        }
    });

    /*---- Email Validation ----*/
    $("#email").on('keyup focusout', function () {
        var inpemail = document.getElementById('email');
        if (inpemail.value.length === 0)
            return;
        $('#email').removeClass("is-invalid").addClass("is-valid");
        //document.getElementById("email").style.borderColor = "green";
        var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

        if (!(inpemail.value).match(reEmail)) {
            //alert("Invalid email address");
            document.getElementById("email_v_message").innerHTML = "Invalid email address";
            $('#email').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("email").style.borderColor = "red";

            return false;
        }
        $('#email').removeClass("is-invalid").addClass("is-valid");
        document.getElementById("email_v_message").innerHTML = "";
        return true;
    });


    $("#al_academic_year").on('keyup focusout', function () {
        var al_academic_year = $('#al_academic_year').val();

        if (al_academic_year.length != 4) {
            $('#al_academic_year').removeClass("is-valid").addClass("is-invalid");
        } else {
            $('#al_academic_year').removeClass("is-invalid").addClass("is-valid");
        }

        if (!al_academic_year.match(/\d{4}/)) {
            $('#al_academic_year').removeClass("is-valid").addClass("is-invalid");
        } else {
            $('#al_academic_year').removeClass("is-invalid").addClass("is-valid");
        }

        /*if (al_academic_year == ""){
         $('#al_academic_year').removeClass("is-valid").addClass("is-invalid");
         //return;
         }else{
         $('#al_academic_year').removeClass("is-invalid").addClass("is-valid");
         }*/
        //document.getElementById("al_academic_year").style.borderColor = "green";
    });

    $("#al_index_no").on('keyup focusout', function () {
        var al_index_no = $("#al_index_no").val(); /*document.getElementById('al_index_no');*/
        if (al_index_no == "") {
            $('#al_index_no').removeClass("is-valid").addClass("is-invalid");
        } else {
            $('#al_index_no').removeClass("is-invalid").addClass("is-valid");
        }
        //return;

        //document.getElementById("al_index_no").style.borderColor = "green";
    });

    $("#z_score").on('keyup focusout', function () {
        var z_score = $('#z_score').val();  /* document.getElementById('z_score'); */
        if (z_score == "") {
            $('#z_score').removeClass("is-valid").addClass("is-invalid");
            //return;
        } else {
            $('#z_score').removeClass("is-invalid").addClass("is-valid");
        }
    });


    $("#al_stream").change(function () {
        var al_subject1 = $('#al_stream').val();

        if (al_subject1 == "") {
            $('#al_stream').removeClass("is-valid").addClass("is-invalid");
            return;
            //document.getElementById("al_stream").style.borderColor = "red";
        } else {
            $('#al_stream').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_stream").style.borderColor = "green";
        }
    });

    $("#al_subject1").change(function () {
        var al_subject1 = $('#al_subject1').val();

        if (al_subject1 == "") {
            $('#al_subject1').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject1").style.borderColor = "red";
        } else {
            $('#al_subject1').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_subject1").style.borderColor = "green";
        }
    });

    $("#al_sub1_grade").change(function () {
        var al_sub1_grade = $('#al_sub1_grade').val();

        if (al_sub1_grade == "") {
            $('#al_sub1_grade').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub1_grade").style.borderColor = "red";
        } else {
            $('#al_sub1_grade').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_sub1_grade").style.borderColor = "green";
        }
    });

    $("#al_subject2").change(function () {
        var al_subject2 = $('#al_subject2').val();

        if (al_subject2 == "") {
            $('#al_subject2').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject2").style.borderColor = "red";
        } else {
            $('#al_subject2').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_subject2").style.borderColor = "green";
        }
    });

    $("#al_sub2_grade").change(function () {
        var al_sub2_grade = $('#al_sub2_grade').val();

        if (al_sub2_grade == "") {
            $('#al_sub2_grade').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub2_grade").style.borderColor = "red";
        } else {
            $('#al_sub2_grade').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_sub2_grade").style.borderColor = "green";
        }
    });

    $("#al_subject3").change(function () {
        var al_subject3 = $('#al_subject3').val();

        if (al_subject3 == "") {
            $('#al_subject3').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject3").style.borderColor = "red";
        } else {
            $('#al_subject3').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_subject3").style.borderColor = "green";
        }
    });

    $("#al_sub3_grade").change(function () {
        var al_sub3_grade = $('#al_sub3_grade').val();

        if (al_sub3_grade == "") {
            $('#al_sub3_grade').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub3_grade").style.borderColor = "red";
        } else {
            $('#al_sub3_grade').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_sub3_grade").style.borderColor = "green";
        }
    });

    $("#al_subject4").change(function () {
        var al_subject4 = $('#al_subject4').val();

        if (al_subject4 == "") {
            $('#al_subject4').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub3_grade").style.borderColor = "red";
        } else {
            $('#al_subject4').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_sub3_grade").style.borderColor = "green";
        }
    });

    $("#al_sub4_grade").change(function () {
        var al_sub4_grade = $('#al_sub4_grade').val();

        if (al_sub4_grade == "") {
            $('#al_sub4_grade').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub3_grade").style.borderColor = "red";
        } else {
            $('#al_sub4_grade').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("al_sub3_grade").style.borderColor = "green";
        }
    });

    $("#ol_year").on('keyup focusout', function () {
        var ol_year = $('#ol_year').val();  /* document.getElementById('z_score'); */
        if (ol_year == "") {
            $('#ol_year').removeClass("is-valid").addClass("is-invalid");
            document.getElementById("ol_year").style.borderColor = "#dc3545";
            //return;
        } else {
            $('#ol_year').removeClass("is-invalid").addClass("is-valid");
            document.getElementById("ol_year").style.borderColor = "#28a745";
        }
    });



    function update_student_apprv_status(){
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

    function load_subjects(stream_id) {
        $('#al_subject1').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject2').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject3').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject4').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');

        $.post("<?php echo base_url('App/load_al_subject_list') ?>", {
            'stream_id': stream_id
        },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#al_subject1").append($('<option>', {
                            value: data[i]['subject_id'],
                            name: data[i]['subject_name'],
                            text: data[i]['subject_name']
                        }));
                        $("#al_subject2").append($('<option>', {
                            value: data[i]['subject_id'],
                            name: data[i]['subject_name'],
                            text: data[i]['subject_name']
                        }));
                        $("#al_subject3").append($('<option>', {
                            value: data[i]['subject_id'],
                            name: data[i]['subject_name'],
                            text: data[i]['subject_name']
                        }));
                        $("#al_subject4").append($('<option>', {
                            value: data[i]['subject_id'],
                            name: data[i]['subject_name'],
                            text: data[i]['subject_name']
                        }));
                    }
                },
                "json"
                );
    }

    function load_subjects_onload(stream_id) {
        $('#al_subject1').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject2').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject3').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');
        $('#al_subject4').find('option').remove().end().append('<option value="" name="">---Select subject---</option>').val('');

        $.post("<?php echo base_url('App/load_al_subject_list') ?>", {
            'stream_id': stream_id
        },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $("#al_subject1").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', {value: data[i]['subject_id'], name: data[i]['subject_name'], text: data[i]['subject_name']
                        }));
                    }



                },
                "json"
                );
    }

    function ol_section() {
        var type_year = $("input[name='ol_diff_year']:checked").val();

        if (type_year == 1) {
            $("#bb").empty();
            $("#aa").append("<div class='form-row'>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='indexno' class='ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                    <input type='text' class='form-control ubuntu border-radius' id='ol_year' name='ol_year' placeholder='' onkeyup='single_ol_year()' value='<?php echo $student_profile["ol_year"]; ?>'>\n\
                                </div>\n\
                            </div>\n\
                            <div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label ubuntu'>Results<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label ubuntu'>Mathematics<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                    <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                        <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = "";
    if ($row['grade_id'] == $student_profile['ol_maths_grade']) {
        $selected = "selected";
    } ?>\n\
                                            <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected; ?>><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                    </select>\n\
                                </div>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label ubuntu'>English<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = "";
    if ($row['grade_id'] == $student_profile['ol_english_grade']) {
        $selected = "selected";
    } ?>\n\
                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected; ?>><?php echo $row["grade"]; ?></option>\n\
<?php endforeach; ?>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class='form-group col-md'>\n\
                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                        <input type='text' class='form-control border-radius ubuntu' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_index_no"]; ?>'>\n\
                                    </div>\n\
                                </div>");
                                $("#ol_year").datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
        } else {
            $("#aa").empty();
            $("#bb").append("<div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label'>Results</label>\n\
                                    <div class='col-sm'>\n\
                                        <div class='row'>\n\
                                            <div class='col-sm'>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Mathematics<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = "";
    if ($row['grade_id'] == $student_profile['ol_maths_grade']) {
        $selected = "selected";
    } ?>\n\
                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' <?php echo $selected; ?>><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_year' name='ol_year' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_year"]; ?>'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_index_no"]; ?>'>\n\
                                                    </div>\n\
                                                </div><br>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>English<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): $selected = "";
    if ($row['grade_id'] == $student_profile['ol_english_grade']) {
        $selected = "selected";
    } ?>\n\
                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>' value='<?php echo $selected; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_english_year' name='ol_english_year' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_english_year"]; ?>'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_english_index_no' name='ol_english_index_no' placeholder='' data-validation='required' value='<?php echo $student_profile["ol_english_index_no"]; ?>'>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                 </div>");
                                $("#ol_year").datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
                                $("#ol_english_year").datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
        }
    }


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

    function add_row() {
        $("#al_subject4").val("");
        $("#al_sub4_grade").val("");
        $("#subject4_row").show();
        $("#add_section").hide();
    }

    function delete_row() {
        $("#al_subject4").val("");
        $("#al_subject4").removeClass("is-valid").removeClass("is-invalid");
        $("#al_sub4_grade").val("");
        $("#al_sub4_grade").removeClass("is-valid").removeClass("is-invalid");
        $("#subject4_row").hide();
        $("#add_section").show();
    }

    function priority1_get_courses(center_id, flag, course_id) {
        $('#priority1_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority1_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                'center_id': center_id
            },
                    function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#priority1_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    },
                    "json"
                    );
        }
    }

    function priority2_get_courses(center_id, flag, course_id) {
        $('#priority2_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority2_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                'center_id': center_id
            },
                    function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#priority2_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    },
                    "json"
                    );
        }
    }

    function priority3_get_courses(center_id, flag, course_id) {
        $('#priority3_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority3_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                'center_id': center_id
            },
                    function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#priority3_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    },
                    "json"
                    );
        }
    }



    function priority1_load_time() {
        $('#priority1_time').empty();

        var x = $('#priority1_course').val();


        if (x == "" || x == 0) {
            $('#priority1_time').find('option').remove().end().append('<option value="" name="">---Select Time---</option>').val('');
        } else {
            $('#priority1_time').append('<option value="" name="">Select Time</option>');
            $('#priority1_time').append('<option value="1" name="full">Full Time</option>');
            $('#priority1_time').append('<option value="2" name="part">Part Time</option>');
            //            $('#priority1_course').append($('<option></option>').val(val).html(text));
        }
    }

    function priority2_load_time() {
        $('#priority2_time').empty();

        var x = $('#priority2_course').val();


        if (x == "" || x == 0) {
            $('#priority2_time').find('option').remove().end().append('<option value="" name="">---Select Time---</option>').val('');
        } else {
            $('#priority2_time').append('<option value="" name="">Select Time</option>');
            $('#priority2_time').append('<option value="1" name="full">Full Time</option>');
            $('#priority2_time').append('<option value="2" name="part">Part Time</option>');
            //            $('#priority1_course').append($('<option></option>').val(val).html(text));
        }
    }

    function priority3_load_time() {
        $('#priority3_time').empty();

        var x = $('#priority3_course').val();


        if (x == "" || x == 0) {
            $('#priority3_time').find('option').remove().end().append('<option value="" name="">---Select Time---</option>').val('');
        } else {
            $('#priority3_time').append('<option value="" name="">Select Time</option>');
            $('#priority3_time').append('<option value="1" name="full">Full Time</option>');
            $('#priority3_time').append('<option value="2" name="part">Part Time</option>');
            //            $('#priority1_course').append($('<option></option>').val(val).html(text));
        }
    }


    function vali_funct() {
        var indexno = $('#indexno').val();

        if (indexno == "") {
            $('#indexno').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("indexno").style.borderColor = "red";
        } else {
            $('#indexno').removeClass("is-invalid").addClass("is-valid");
            $("#indexno").on('keyup', function () {
                $('#indexno').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("indexno").style.borderColor = "green";
            });
        }

        if (indexno !== "") {
            $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
        }


    }

    function vali_funct1() {
        var fullname = $('#fullname').val();
        var nic = $('#nic').val();
        var d_o_b = $('#d_o_b').val();
        var title = $('#title').val();
        var x;
        var y;
        
        if (title == "") {
            $('#title').removeClass("invalid").addClass("is-invalid");
        } else {
            $("#title").change(function () {
                $('#title').removeClass("is-invalid").addClass("is-valid");
            });
        }
        
        if (fullname === "") {
            $("#fullname").removeClass("is-valid").addClass("is-invalid");
            $("#initials_name").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("fullname").style.borderColor = "red";
            //document.getElementById("initials_name").style.borderColor = "red";
            x = false;


        } else {
            if (/\w+\s+\w+/.test($("#fullname").val())) {
                var name = document.getElementById("fullname").value;
                var fname = document.getElementById("fullname").value;

                var res = fname.split(' ');
                var iname = res[(res.length) - 1];

                var getInitials = function (name) {
                    var parts = name.split(' ');
                    var initials = '';

                    for (var i = 0; i < parts.length; i++) {
                        if (i != (parts.length) - 1) {
                            if (parts[i].length > 0 && parts[i] !== '') {
                                initials += parts[i][0].trim() + ".";
                            }
                        }
                    }
                    $("#fullname").removeClass("is-invalid").addClass("is-valid");
                    $("#initials_name").removeClass("is-invalid").addClass("is-valid");
                    //document.getElementById("fullname").style.borderColor = "green";
                    //document.getElementById("initials_name").style.borderColor = "green";
                    return initials;
                };
                document.getElementById("initials_name").value = getInitials(name) + " " + iname;
                $("#fullname").removeClass("is-invalid").addClass("is-valid");
                $("#initials_name").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("fullname").style.borderColor = "green";
                //document.getElementById("initials_name").style.borderColor = "green";

                x = true;
            } else {
                document.getElementById("initials_name").value = "";
                $("#fullname").removeClass("is-valid").addClass("is-invalid");
                $("#initials_name").removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("fullname").style.borderColor = "red";
                //document.getElementById("initials_name").style.borderColor = "red";

                x = false;
            }
        }

        if (nic === "" || d_o_b === "") {
            $("#nic").removeClass("is-valid").addClass("is-invalid");
            $("#d_o_b").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("nic").style.borderColor = "red";
            //document.getElementById("d_o_b").style.borderColor = "red";
            y = false;
        } else {
            $('.nic-validate-error').html('');
            $('#d_o_b').val('');
            $('.nic-gender').html('');
            var nicNumber = $('.nic-validate').val();
            if (validation(nicNumber)) {
                console.log(nicNumber);
                var extracttedData = extractData(nicNumber);
                var days = extracttedData.dayList;
                var findedData = findDayANDGender(days, d_array);

                var month = findedData.month;
                var year = extracttedData.year;
                var day = findedData.day;
                var gender = findedData.gender;
                var bday = day + '-' + month + '-' + year;
                var birthday = new Date(bday.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
                var birthday = getFormattedDate(birthday);
                $('#d_o_b').val(birthday);
                $('.nic-gender').html(gender);

                if (findedData.gender == "Male") {
                    $("#male").prop("checked", true);
                } else {
                    $("#female").prop("checked", true);
                }
                $("#nic").removeClass("is-invalid").addClass("is-valid");
                $("#d_o_b").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("nic").style.borderColor = "green";
                //document.getElementById("d_o_b").style.borderColor = "green";

                y = true;

            } else {
                $("#nic").removeClass("is-valid").addClass("is-invalid");
                $("#d_o_b").removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("nic").style.borderColor = "red";
                //document.getElementById("d_o_b").style.borderColor = "red";
                y = true;
            }
        }


        if (x !== false && y !== false && title !== "") {
            $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
        }
    }

    function vali_funct2() {
        var ph;
        var la;

        var address = $('#address').val();
        var phoneno = $('#phoneno').val();
        var landno = $('#landno').val();
        var district = $('#district').val();
        var email = $('#email').val();

        if (phoneno == "") {
            $("#phoneno").removeClass("is-valid").addClass("is-invalid");
            ph = false;
        } else {
            $("#phone").on('keyup', function () {
                $("#phoneno").removeClass("is-invalid").addClass("is-valid");
                ph = true;
            });
        }
        var phonenoregex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        if (landno == "") {
            $("#landno").removeClass("is-valid").addClass("is-invalid");
            la = false;
        } else {
            $("#landno").on('keyup', function () {
                $("#landno").removeClass("is-invalid").addClass("is-valid");
                la = true;
            });
        }
        var landnoregex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;


        if (address == "") {
            $('#address').removeClass("invalid").addClass("is-invalid");
        } else {
            $("#address").on('keyup', function () {
                $('#address').removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (district == "") {
            $('#district').removeClass("invalid").addClass("is-invalid");
            document.getElementById("desig").style.color = "red";
            document.getElementById("desig").innerHTML = 'District Required';
        } else {
            $("#district").change(function () {
                $('#district').removeClass("is-invalid").addClass("is-valid");
                document.getElementById("desig").innerHTML = '';
            });
        }

        if (email == "") {
            $('#email').removeClass("is-valid").addClass("is-invalid");
            return false;
        } else {
            $("#email").on('keyup', function () {
                //document.getElementById("email").style.borderColor = "green";
                $('#email').removeClass("is-invalid").addClass("is-valid");
            });
        }


        var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

        if (email !== "" && email.match(reEmail) && phoneno !== "" && phoneno.match(phonenoregex) && landno !== "" && landno.match(landnoregex) && district !== "" && address !== "") {
            $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
        }
    }

    function vali_funct3() {
        var al_academic_year = $('#al_academic_year').val();
        var al_index_no = $('#al_index_no').val();
        var z_score = $('#z_score').val();
        var al_stream = $('#al_stream').val();
        var al_subject1 = $('#al_subject1').val();
        var al_subject2 = $('#al_subject2').val();
        var al_subject3 = $('#al_subject3').val();
        var al_subject4 = $('#al_subject4').val();
        var al_sub1_grade = $('#al_sub1_grade').val();
        var al_sub2_grade = $('#al_sub2_grade').val();
        var al_sub3_grade = $('#al_sub3_grade').val();
        var al_sub4_grade = $('#al_sub4_grade').val();
        //alert(al_academic_year);
        if (al_academic_year.length != 4) {
            $("#al_academic_year").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_academic_year").style.borderColor = "red";
        } else {
            $("#al_academic_year").removeClass("is-invalid").addClass("is-valid");
            $("#al_academic_year").on('keyup focusout', function () {
                $("#al_academic_year").removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (al_index_no == "") {
            $("#al_index_no").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_index_no").style.borderColor = "red";
        } else {
            $("#al_index_no").removeClass("is-invalid").addClass("is-valid");
            $("#al_index_no").on('keyup focusout', function () {
                $("#al_index_no").removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (z_score == "") {
            $("#z_score").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("z_score").style.borderColor = "red";
        } else {
            $("#z_score").removeClass("is-invalid").addClass("is-valid");
            $("#z_score").on('keyup focusout', function () {
                $("#z_score").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("z_score").style.borderColor = "green";
            });
        }

        if (al_stream == "") {
            $("#al_stream").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_stream").style.borderColor = "red";
        } else {
            $("#al_stream").removeClass("is-invalid").addClass("is-valid");
            $("#al_stream").on('change', function () {
                $("#al_stream").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_stream").style.borderColor = "green";
            });
        }

        if (al_subject1 == "") {
            $("#al_subject1").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject1").style.borderColor = "red";
        } else {
            $("#al_subject1").removeClass("is-invalid").addClass("is-valid");
            $("#al_subject1").on('change', function () {
                $("#al_subject1").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject1").style.borderColor = "green";
            });
        }

        if (al_sub1_grade == "") {
            $("#al_sub1_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub1_grade").style.borderColor = "red";
        } else {
            $("#al_sub1_grade").removeClass("is-invalid").addClass("is-valid");
            $("#al_sub1_grade").on('change', function () {
                $("#al_sub1_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub1_grade").style.borderColor = "green";
            });
        }

        if (al_subject2 == "") {
            $("#al_subject2").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject2").style.borderColor = "red";
        } else {
            $("#al_subject2").removeClass("is-invalid").addClass("is-valid");
            $("#al_subject2").on('change', function () {
                $("#al_subject2").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject2").style.borderColor = "green";
            });
        }

        if (al_sub2_grade == "") {
            $("#al_sub2_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub2_grade").style.borderColor = "red";
        } else {
            $("#al_sub2_grade").removeClass("is-invalid").addClass("is-valid");
            $("#al_sub2_grade").on('change', function () {
                $("#al_subject2").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub2_grade").style.borderColor = "green";
            });
        }

        if (al_subject3 == "") {
            $("#al_subject3").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject3").style.borderColor = "red";
        } else {
            $("#al_subject3").removeClass("is-invalid").addClass("is-valid");
            $("#al_subject3").on('change', function () {
                $("#al_subject3").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject3").style.borderColor = "green";
            });
        }

        if (al_sub3_grade == "") {
            $("#al_sub3_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub3_grade").style.borderColor = "red";
        } else {
            $("#al_sub3_grade").removeClass("is-invalid").addClass("is-valid");
            $("#al_sub3_grade").on('change', function () {
                $("#al_sub3_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub3_grade").style.borderColor = "green";
            });
        }


        if ($('#subject4_row').css('display') !== 'none') {
//        alert('subject4_row is visible');
            var al_subject4 = $('#al_subject4').val();
            var al_sub4_grade = $('#al_sub4_grade').val();



            /* $("#al_subject4").change(function () {
             var al_subject4 = $('#al_subject4').val();
             
             if (al_subject4 == "") {
             $("#al_subject4").removeClass("is-valid").addClass("is-invalid");
             //document.getElementById("al_subject4").style.borderColor = "red";
             } else {
             $("#al_subject4").removeClass("is-invalid").addClass("is-valid");
             //document.getElementById("al_subject4").style.borderColor = "green";
             }
             }); */

            /* $("#al_sub4_grade").change(function () {
             var al_sub4_grade = $('#al_sub4_grade').val();
             
             if (al_sub4_grade == "") {
             $("#al_sub4_grade").removeClass("is-valid").addClass("is-invalid");
             //document.getElementById("al_sub4_grade").style.borderColor = "red";
             } else {
             $("#al_sub4_grade").removeClass("is-invalid").addClass("is-valid");
             //document.getElementById("al_sub4_grade").style.borderColor = "green";
             }
             }); */

            if (al_subject4 == "") {
                $("#al_subject4").removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("al_subject4").style.borderColor = "red";
            } else {
                $("#al_subject4").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject4").style.borderColor = "green";
            }

            if (al_sub4_grade == "") {
                $("#al_sub4_grade").removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("al_sub4_grade").style.borderColor = "red";
            } else {
                $("#al_sub4_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub4_grade").style.borderColor = "green";
            }

            if (al_academic_year !== "" && al_index_no !== "" && z_score !== "" && al_stream !== "" && al_subject1 !== "" && al_subject2 !== "" && al_subject3 !== "" &&
                    al_sub1_grade !== "" && al_sub2_grade !== "" && al_sub3_grade !== "" && al_subject4 !== "" && al_sub4_grade !== "") {
                //alert(al_subject1);
                //alert(al_subject2);
                //alert(al_subject3);
                //alert(al_subject4);
                $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
            }
        } else {

            //alert('subject4_row is hidden');
            //alert(al_subject1);
            //alert(al_subject2);
            //alert(al_subject3);
            //alert(al_subject4);
            if (al_academic_year !== "" && al_index_no !== "" && z_score !== "" && al_stream !== "" && al_subject1 !== "" && al_subject2 !== "" && al_subject3 !== "" &&
                    al_sub1_grade !== "" && al_sub2_grade !== "" && al_sub3_grade !== "") {
                $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
            }
        }









    }

    function vali_funct4() {
        var sat = $("input[name='ol_diff_year']:checked").val();

        var ol_english_year = $("#ol_english_year").val();
        var ol_english_index_no = $("#ol_english_index_no").val();
        var ol_maths_grade = $("#ol_maths_grade").val();
        var ol_english_grade = $("#ol_english_grade").val();
        var ol_year = $("#ol_year").val();
        var ol_index_no = $("#ol_index_no").val();

        if (sat == 1) {

            if (ol_year == "") {
                $('#ol_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_year").style.borderColor = "red";
            } else {
                //$('#ol_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_year").style.borderColor = "green";

                $("#ol_year").on('keyup', function () {
                    $("#ol_year").removeClass("is-invalid").addClass("is-valid");
                });
            }

            if (ol_maths_grade == "") {
                $('#ol_maths_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_maths_grade").style.borderColor = "red";
            } else {
                $('#ol_maths_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_maths_grade").style.borderColor = "green";
            }

            if (ol_english_grade == "") {
                $('#ol_english_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_grade").style.borderColor = "red";
            } else {
                $('#ol_english_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_grade").style.borderColor = "green";
            }

            if (ol_index_no == "") {
                $('#ol_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_index_no").style.borderColor = "red";
            } else {
                $('#ol_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_index_no").style.borderColor = "green";
            }


            if (ol_year !== "" && ol_maths_grade !== "" && ol_english_grade !== "" && ol_index_no !== "") {
                $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
            }
        } else {

            if (ol_year == "") {
                $('#ol_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_year").style.borderColor = "red";
            } else {
                $('#ol_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_year").style.borderColor = "green";
            }

            if (ol_maths_grade == "") {
                $('#ol_maths_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_maths_grade").style.borderColor = "red";
            } else {
                $('#ol_maths_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_maths_grade").style.borderColor = "green";
            }

            if (ol_english_grade == "") {
                $('#ol_english_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_grade").style.borderColor = "red";
            } else {
                $('#ol_english_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_grade").style.borderColor = "green";
            }

            if (ol_index_no == "") {
                $('#ol_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_index_no").style.borderColor = "red";
            } else {
                $('#ol_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_index_no").style.borderColor = "green";
            }

            if (ol_english_year == "") {
                $('#ol_english_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_year").style.borderColor = "red";
            } else {
                $('#ol_english_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_year").style.borderColor = "green";
            }

            if (ol_english_index_no == "") {
                $('#ol_english_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_index_no").style.borderColor = "red";
            } else {
                $('#ol_english_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_index_no").style.borderColor = "green";
            }





            if (ol_year !== "" && ol_maths_grade !== "" && ol_english_grade !== "" && ol_index_no !== "" &&
                    ol_english_index_no !== "" && ol_english_year !== "") {
                $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
            }
        }


    }

    function vali_funct5() {
        var priority1_center = $('#priority1_center').val();
        var priority1_course = $('#priority1_course').val();
        var priority1_time = $('#priority1_time').val();

        var priority2_center = $('#priority2_center').val();
        var priority2_course = $('#priority2_course').val();
        var priority2_time = $('#priority2_time').val();

        var priority3_center = $('#priority3_center').val();
        var priority3_course = $('#priority3_course').val();
        var priority3_time = $('#priority3_time').val();
        
        alert(priority1_center);

        if (priority1_center == "") {
            $('#priority1_center').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("priority1_center").style.borderColor = "red";
        } else {
            $('#priority1_center').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("priority1_center").style.borderColor = "green";
        }

        if (priority1_course == "") {
            $('#priority1_course').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("priority1_course").style.borderColor = "red";
        } else {
            $('#priority1_course').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("priority1_course").style.borderColor = "green";
        }

        if (priority1_time == "") {
            $('#priority1_time').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("priority1_time").style.borderColor = "red";
        } else {
            $('#priority1_time').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("priority1_time").style.borderColor = "green";
        }

        if (priority2_center !== "") {
//            document.getElementById("priority2_center").style.borderColor = "green";
//            document.getElementById("priority2_course").style.borderColor = "red";
//            document.getElementById("priority2_time").style.borderColor = "red";

            $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
            $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
            $('#priority2_time').removeClass("is-valid").addClass("is-invalid");

            if (priority2_course !== "") {
                $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
                $('#priority2_time').removeClass("is-valid").addClass("is-invalid");

                if (priority2_time !== "") {
                    $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_time').removeClass("is-invalid").addClass("is-valid");

                } else {
                    $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
                }

            } else {
                $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
                $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
            }



            if (priority3_center !== "") {
//                document.getElementById("priority3_center").style.borderColor = "green";
//                document.getElementById("priority3_course").style.borderColor = "red";
//                document.getElementById("priority3_time").style.borderColor = "red";

                $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority3_course').removeClass("is-valid").addClass("is-invalid");
                $('#priority3_time').removeClass("is-valid").addClass("is-invalid");

                if (priority3_course !== "") {
                    $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority3_course').removeClass("is-valid").addClass("is-valid");
                    $('#priority3_time').removeClass("is-valid").addClass("is-invalid");

                    if (priority3_time !== "") {
                        $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_time').removeClass("is-invalid").addClass("is-valid");
                    } else {
                        $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                    }

                } else {
                    $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority3_course').removeClass("is-invalid").addClass("is-invalid");
                    $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                }


                if (priority1_center !== "" && priority1_course !== "" && priority1_time !== "" &&
                        priority2_center !== "" && priority2_course !== "" && priority2_time !== ""
                        && priority3_center !== "" && priority3_course !== "" && priority3_time !== "") {
                    $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
                }
            } else {
//                document.getElementById("priority3_center").style.borderColor = "green";
//                document.getElementById("priority3_course").style.borderColor = "green";
//                document.getElementById("priority3_time").style.borderColor = "green";

                $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                $('#priority3_time').removeClass("is-invalid").addClass("is-valid");


                if (priority1_center !== "" && priority1_course !== "" && priority1_time !== "" &&
                        priority2_center !== "" && priority2_course !== "" && priority2_time !== "") {
                    $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
                }
            }
        } else {
//            document.getElementById("priority2_center").style.borderColor = "green";
//            document.getElementById("priority2_course").style.borderColor = "green";
//            document.getElementById("priority2_time").style.borderColor = "green";

            $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
            $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
            $('#priority2_time').removeClass("is-invalid").addClass("is-valid");

//            document.getElementById("priority3_center").style.borderColor = "green";
//            document.getElementById("priority3_course").style.borderColor = "green";
//            document.getElementById("priority3_time").style.borderColor = "green";

            $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
            $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
            $('#priority3_time').removeClass("is-invalid").addClass("is-valid");

            if (priority1_center !== "" && priority1_course !== "" && priority1_time !== "") {
                $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
            }
        }
    }
</script>




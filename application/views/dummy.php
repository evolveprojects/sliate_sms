<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style>
    .nav-link.active{
        border-top: 3px solid #007bff;
    }

    .ubuntu{
        font-family: 'Ubuntu', sans-serif;
    }

    .card-primary.card-outline-tabs .card-header a.active {
        border-top: 3px solid #19734b;
    }

    .filepond--drop-label {
        color: #4c4e53;
    }

    .filepond--label-action {
        text-decoration-color: #babdc0;
    }

    .filepond--panel-root {
        background-color: #edf0f4;
    }

    .filepond--root {
        width:150px;
        margin: 0 auto;
    }




</style>

<?php
$check_success = $this->session->flashdata('message');
if ($check_success == "success") {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.notify({
                // options
                message: 'You have entered the data successfully.'
            }, {
                // settings
                type: 'success'
            });

        });
    </script>
<?php } else if ($check_success == "warning") {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.notify({
                // options
                message: 'You have Already Entered the Data.'
            }, {
                // settings
                type: 'warning'
            });
        });

<?php } ?>
</script>



<div class="wrapper " id="reg_page" name="reg_page">
    <div class="sl-header center">
        <div class="container"><img src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/dist/img/logo.png') ?>" class="img-fluid"></div>
    </div>
    <nav class="navbar navbar-expand navbar-white navbar-light sl-top-bar">
        <!-- Left navbar links -->
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block"><a href="index3.html" class="nav-link">Home</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Contact</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="<?php echo base_url('App/Login') ?>" class="nav-link">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="container mt-5">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2 ml-5 mr-5">
                    <div class="col-sm-6">
                        <h1 style="font-family: 'Ubuntu', sans-serif;">Application Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" class="ubuntu">Home</a></li>
                            <li class="breadcrumb-item active" class="ubuntu">Application Form</li>
                        </ol>
                    </div>
                </div><hr style="background-color: #2ba672" class="ml-5 mr-5 pt-1">
            </div>
        </section>    
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal ml-5 mr-5" id="reg_form" name="reg_form" method="post" action="<?php echo base_url('App/online_register') ?>">
                        <ul class="nav nav-tabs reg_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link ubuntu active" style="//pointer-events: none;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Index No</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ubuntu" style="//pointer-events: none;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Personal Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ubuntu" style="//pointer-events: none;" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ubuntu" style="//pointer-events: none;" id="al-tab" data-toggle="tab" href="#al" role="tab" aria-controls="al" aria-selected="false">A/L Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ubuntu" style="//pointer-events: none;" id="ol-tab" data-toggle="tab" href="#ol" role="tab" aria-controls="ol" aria-selected="false">O/L Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ubuntu" style="//pointer-events: none;" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="false">Select Course</a>
                            <li class="nav-item">
                                <a class="nav-link ubuntu" style="//pointer-events: none;" id="dummy-tab" data-toggle="tab" href="#dummy" role="tab" aria-controls="dummy" aria-selected="false">Preview</a>
                            </li>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent" style="background-color: #ffffff">
                            <input type="text" id="next_id_value" name="next_id_value" value="<?php echo $next_value; ?>" hidden>
                            <div class="tab-pane fade show active ml-3 mr-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 0px; color: #1e7e34;"><i class="fas fa-question-circle"></i> &nbsp;Index No Details</h5>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="indexno" class="ubuntu">Index No<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius ubuntu" id="indexno" name="indexno" placeholder="Index No">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <button type="button" class="btn btn-secondary border-radius ubuntu">Search</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="" class="ubuntu">Profile Picture<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="file" name="userfile" id="userfile" />
                                            <!--<input class="form-control" type="file" name="file" id="file" accept="image/*"/>-->
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <!--<label for="profile_picture" class="ubuntu">Profile Picture<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>-->
                                            <!--<input type="file" accept="image/jpeg" class="filepond border-radius ubuntu" id="profile_picture" name="profile_picture" placeholder="">-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade ml-3 mr-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 0px; color: #1e7e34;"><span><i class="fas fa-info-circle"></i></span> &nbsp;Personal Information</h5>
                                </div>
                                <hr>
                                <div class="container">
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
                                            <span id="desig" class="ubuntu"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="fullname" class="ubuntu">Full Name<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius ubuntu" id="fullname" name="fullname" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="initials_name" class="ubuntu">Name with Initials<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius ubuntu" id="initials_name" name="initials_name" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="initials_name" class="ubuntu">NIC<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius nic-validate ubuntu" id="nic" name="nic" placeholder="">
                                            <span class="ubuntu" id="nic_message" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="initials_name" class="ubuntu">Date of Birth (YYYY/MM/DD)<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-radius"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control border-radius ubuntu" id="d_o_b" name="d_o_b" placeholder="DD/MM/YYYY" value="" readonly>
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
                            </div>
                            <div class="tab-pane fade ml-3 mr-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 5px;color: #1e7e34;"><span><i class="fas fa-address-book"></i></span> &nbsp;Contact Information</h5>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="email" class="ubuntu">Email Address<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius ubuntu" id="email" name="email" placeholder="">
                                            <span id="email_v_message" class="ubuntu"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="phoneno" class="ubuntu">Phone no<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius ubuntu" id="phoneno" name="phoneno" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="landno" class="ubuntu">Land no<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control border-radius ubuntu" id="landno" name="landno" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="address" class="ubuntu">Address<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <textarea class="form-control border-radius ubuntu" id="address" name="address" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="district" class="ubuntu">District<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <select type="text" class="form-control border-radius ubuntu" id="district" name="district">
                                                <option value="">---Select District---</option>
                                                <?php
                                                foreach ($districts as $row):
                                                    ?>
                                                    <option value="<?php echo $row['code']; ?>" name="<?php echo $row['district']; ?>">
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
                            </div>
                            <div class="tab-pane fade ml-3 mr-3" id="al" role="tabpanel" aria-labelledby="contact-tab">
                                <br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 5px;color: #1e7e34;"><span><i class="fas fa-school"></i></span> &nbsp;G.C.E Advanced Level (A/L) Information</h5>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="indexno" class="ubuntu">A/L Academic Year<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control ubuntu border-radius" id="al_academic_year" name="al_academic_year" placeholder="Year" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="indexno" class="ubuntu">Index No<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <input type="text" class="form-control ubuntu border-radius" id="al_index_no" name="al_index_no" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="indexno" class="ubuntu">Z-Score<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select class="form-control border-radius ubuntu" id="plus_minus" name="plus_minus">
                                                        <option value="+">+</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control border-radius ubuntu" id="z_score" name="z_score" placeholder="Z-Score">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label for="indexno" class="ubuntu">Stream<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <select type="text" class="form-control border-radius ubuntu" id="al_stream" name="al_stream" onchange="load_subjects(this.value, null, this);">
                                                <option value="">---Select Stream---</option>
                                                <?php
                                                foreach ($al_subject_streams as $row):
                                                    ?>
                                                    <option value="<?php echo $row['stream_id']; ?>" name="<?php echo $row['stream_name']; ?>">
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
                                                            ?>
                                                            <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>">
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
                                                            ?>
                                                            <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>">
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
                                                            ?>
                                                            <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>">
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
                                                            ?>
                                                            <option value="<?php echo $row['grade_id']; ?>" name="<?php echo $row['grade']; ?>">
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
                            <div class="tab-pane fade ml-3 mr-3" id="ol" role="tabpanel" aria-labelledby="ol-tab"><br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 5px;color: #1e7e34;"><span><i class="fas fa-school"></i></span> &nbsp;G.C.E Ordinary Level (O/L) Information</h5>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <label for="initials_name" class="ubuntu">Sat For Exam In</label>
                                        <div class="col-sm-1">
                                            <input class="user-radio ubuntu" type="radio" name="ol_diff_year" value="1" id="single_year" onchange="ol_section();view_section();" checked> <label class="form-check-label ubuntu">Single</label><br>
                                        </div>
                                        <div class="col-sm">
                                            <input class="user-radio" type="radio" name="ol_diff_year" value="2" onchange="ol_section();view_section();" id="multiple_year"> <label class="form-check-label ubuntu">Several Years</label><br>
                                        </div>
                                    </div>
                                </div>
                                <div id="ol_box" name="ol_box">
                                    <div id="aa">
                                        <div class="form-row">
                                            <div class="form-group col-md">
                                                <label for="indexno" class="ubuntu">Year<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                <input type="text" class="form-control ubuntu border-radius" id="ol_year" name="ol_year" placeholder="Year" onkeyup="single_ol_year()" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 ubuntu">Results<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                            <div class="form-group col-md">
                                                <label for="" class="col-sm col-form-label ubuntu">Mathematics<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                <select type="text" id="ol_maths_grade" name="ol_maths_grade" class="form-control border-radius ubuntu" placeholder=".col-3" data-validation="required">
                                                    <option value="">-Grade-</option>
                                                    <?php
                                                    foreach ($ol_grade as $row):
                                                        ?>
                                                        <option name="<?php echo $row['grade']; ?>" value="<?php echo $row['grade_id']; ?>">
                                                            <?php echo $row['grade']; ?>
                                                        </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md">
                                                <label for="" class="col-sm col-form-label ubuntu">English<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                <select type="text" id="ol_english_grade" name="ol_english_grade" class="form-control border-radius ubuntu" placeholder=".col-3" data-validation="required">
                                                    <option value="">-Grade-</option>
                                                    <?php
                                                    foreach ($ol_grade as $row):
                                                        ?>
                                                        <option name="<?php echo $row['grade']; ?>" value="<?php echo $row['grade_id']; ?>">
                                                            <?php echo $row['grade']; ?>
                                                        </option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md">
                                                <label for="" class="col-sm col-form-label ubuntu">Index No<sup style="color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;">*</sup></label>
                                                <input type="text" class="form-control border-radius ubuntu" id="ol_index_no" name="ol_index_no" placeholder="" data-validation="required">
                                            </div>
                                        </div>

                                    </div>
                                    <div id="bb"></div>

                                </div> 
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct4();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade ml-3 mr-3" id="course" role="tabpanel" aria-labelledby="ol-tab"><br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 5px;color: #1e7e34;"><span><i class="fas fa-university"></i></span> &nbsp;Selecting Course Information</h5>
                                </div>
                                <hr>
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
                                                        ?>
                                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>">
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
                                                        ?>
                                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>">
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
                                                        ?>
                                                        <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>">
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
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="vali_funct5();">Next <span class="fas fa-arrow-circle-right"></span></button>
                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade ml-3 mr-3" id="dummy" role="tabpanel" aria-labelledby="dummy-tab"><br>
                                <div class="callout callout-success border-radius ubuntu" style="background-color: #e7ffeb; box-shadow: none;">
                                    <h5 style="margin-bottom: 5px;color: #1e7e34;"><span><i class="fas fa-file-alt"></i></span> &nbsp;Preview Entered Information for Confirmation</h5>
                                </div>
                                <hr>
                                <button type="button" class="btn btn-secondary border-radius ubuntu" data-toggle="modal" data-target="#exampleModal" onclick="view();">
                                    <span><i class="fas fa-file-alt"></i></span> &nbsp;Preview Information
                                </button>

                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <button type="button" class="btnPrevious btn btn-default float-right border-radius sl-btn ubuntu"><span class="fas fa-arrow-circle-left"></span> Previous</button>
                                    </div>
                                </div>

                                <div class="modal fade bd-example-modal-lg" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="callout callout-warning border-radius ubuntu" style="background-color: #fff2cb; box-shadow: none;width: 100%;margin-bottom: 0px;">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="margin-bottom: 5px;color: #d39e00;"><span><i class="fas fa-file-alt"></i></span> &nbsp;Preview Information</h5>
                                                </div>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="background-color: whitesmoke;">
                                                <div class="card card-primary card-outline card-outline-tabs shadow">
                                                    <div class="card-header p-0 border-bottom-0">
                                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Index</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Personal</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Contact</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="true">A/L</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-tabs-three-ol-tab" data-toggle="pill" href="#custom-tabs-three-ol" role="tab" aria-controls="custom-tabs-three-ol" aria-selected="true">O/L</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-tabs-three-course-tab" data-toggle="pill" href="#custom-tabs-three-course" role="tab" aria-controls="custom-tabs-three-course" aria-selected="true">Course</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="tab-content" id="custom-tabs-three-tabContent">
                                                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                                                <h5 style="margin-bottom: 0px;"><i class="fas fa-question-circle"></i> &nbsp;Index No Details</h5>
                                                                <hr>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Index No</label>
                                                                    <div class="col-sm-6">
                                                                        <label for="" id="view_indexno" name="view_indexno" class="col-sm-4 col-form-label">Index No</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                                                <h5 style="margin-bottom: 0px;"><span><i class="fas fa-info-circle"></i></span> &nbsp;Personal Information</h5>
                                                                <hr>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Title</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_title" name="view_title" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Full Name</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_fullname" name="view_fullname" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Name with intials</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_initials_name" name="view_initials_name" class="col-sm col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">National Identity Card No</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_nic" name="view_nic" class="col-sm col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Date of Birth (DD/MM/YYYY)</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_d_o_b" name="view_d_o_b" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Gender</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_gender" name="view_gender" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                                                <h5 style="margin-bottom: 5px;"><span><i class="fas fa-address-book"></i></span> &nbsp;Contact Information</h5>
                                                                <hr>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Email Address</label>
                                                                    <div class="col-sm">
                                                                        <label for="" id="view_email" name="view_email" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">phone no</label>
                                                                    <div class="col-sm">
                                                                        <label for="" id="view_phoneno" name="view_phoneno" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Land no</label>
                                                                    <div class="col-sm">
                                                                        <label for="" id="view_landno" name="view_landno" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Address</label>
                                                                    <div class="col-sm">
                                                                        <label for="" id="view_address" name="view_address" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">District</label>
                                                                    <div class="col-sm">
                                                                        <label for="" id="view_district" name="view_district" class="col-sm col-form-label"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                                                                <h5 style="margin-bottom: 5px;"><span><i class="fas fa-school"></i></span> &nbsp;G.C.E Advanced Level (A/L) Information</h5>
                                                                <hr>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Academic Year</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_al_academic_year" name="view_al_academic_year" class="col-sm col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Index No</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_al_index_no" name="view_al_index_no" class="col-sm col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Z-Score</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_full_z_score" name="view_full_z_score" class="col-sm col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Stream</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="" id="view_al_stream" name="view_al_stream" class="col-sm col-form-label col-form-label-sm"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                    <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">A/L Subjects</label><br>
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
                                                                                        <td><label id="view_al_subject1" name="view_al_subject1"></label></td>
                                                                                        <td><label id="view_al_sub1_grade" name="view_al_sub1_grade"></label></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><label id="view_al_subject2" name="view_al_subject2"></label></td>
                                                                                        <td><label id="view_al_sub2_grade" name="view_al_sub2_grade"></label></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><label id="view_al_subject3" name="view_al_subject3"></label></td>
                                                                                        <td><label id="view_al_sub3_grade" name="view_al_sub3_grade"></label></td>
                                                                                    </tr>
                                                                                    <tr id="al_row_4">
                                                                                        <td><label id="view_al_subject4" name="view_al_subject4"></label></td>
                                                                                        <td><label id="view_al_sub4_grade" name="view_al_sub4_grade"></label></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <label id="lbl_al_subjects" class="col-md-10 control-label" style="color: red"></label>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-tabs-three-ol" role="tabpanel" aria-labelledby="custom-tabs-three-ol-tab">
                                                                <h5 style="margin-bottom: 5px;"><span><i class="fas fa-school"></i></span> &nbsp;G.C.E Ordinary Level (O/L) Information</h5>
                                                                <hr>
                                                                <div id="ol_box" name="ol_box">
                                                                    <div id="view_aa">
                                                                        <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                            <label for="" class="col-sm-4 col-form-label">Year</label>
                                                                            <div class="col-sm-8">
                                                                                <label for="" id="view_ol_year" name="view_ol_year" class="col-sm col-form-label col-form-label-sm">
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class='form-group row' style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
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
                                                                                            <td><label id='view_ol_maths_grade' name='view_ol_maths_grade'></label></td>
                                                                                            <td><label id='view_ol_english_grade' name='view_ol_english_grade'></label></td>
                                                                                            <td><label id='view_ol_index_no' name='view_ol_index_no'></label></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="bb">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-tabs-three-course" role="tabpanel" aria-labelledby="custom-tabs-three-course-tab">
                                                                <h5 style="margin-bottom: 5px;"><span><i class="fas fa-university"></i></span> &nbsp;Selecting Course Information</h5>
                                                                <hr>
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
                                                                            <td><label id="view_priority1_center" name="view_priority1_center"></label></td>
                                                                            <td><label id="view_priority1_course" name="view_priority1_course"></label></td>
                                                                            <td><label id="view_priority1_time" name="view_priority1_time"></label></td>
                                                                        </tr>
                                                                        <tr id="priority_2_row" >
                                                                            <th scope="row">Priority 2</th>
                                                                            <td><label id="view_priority2_center" name="view_priority2_center"></label></td>
                                                                            <td><label id="view_priority2_course" name="view_priority2_course"></label></td>
                                                                            <td><label id="view_priority2_time" name="view_priority2_time"></label></td>
                                                                        </tr>
                                                                        <tr id="priority_3_row">
                                                                            <th scope="row">Priority 3</th>
                                                                            <td><label id="view_priority3_center" name="view_priority3_center"></label></td>
                                                                            <td><label id="view_priority3_course" name="view_priority3_course"></label></td>
                                                                            <td><label id="view_priority3_time" name="view_priority3_time"></label></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>


                                                <!--Straight Modal-->

                                                <!--Please Enter Your Index No-->
                                                <!--<div class="card card-info shadow">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Please enter your Index No/</h3>
                                                    </div>

                                                    <div class="card-body mandatory">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Index No</label>
                                                            <div class="col-sm-6">
                                                                <label for="" id="view_indexno" name="view_indexno" class="col-sm-4 col-form-label"></label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>  -->

                                                <!--Personal Details-->
                                                <!--<div class="card card-info shadow">
                                                    <div class="card-header ">
                                                        <h3 class="card-title ">Personal Details/</h3>
                                                    </div>

                                                    <div class="card-body mandatory">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Full Name</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_fullname" name="view_fullname" class="col-sm col-form-label"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Name with intials</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_initials_name" name="view_initials_name" class="col-sm col-form-label col-form-label-sm"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">National Identity Card No</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_nic" name="view_nic" class="col-sm col-form-label col-form-label-sm"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Date of Birth (DD/MM/YYYY)</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_d_o_b" name="view_d_o_b" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Gender</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_gender" name="view_gender" class="col-sm-4 col-form-label col-form-label-sm"></label>
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
                                                                <label for="" id="view_email" name="view_email" class="col-sm col-form-label"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">phone no</label>
                                                            <div class="col-sm">
                                                                <label for="" id="view_phoneno" name="view_phoneno" class="col-sm col-form-label"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Land no</label>
                                                            <div class="col-sm">
                                                                <label for="" id="view_landno" name="view_landno" class="col-sm col-form-label"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Address</label>
                                                            <div class="col-sm">
                                                                <label for="" id="view_address" name="view_address" class="col-sm col-form-label"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">District</label>
                                                            <div class="col-sm">
                                                                <label for="" id="view_district" name="view_district" class="col-sm col-form-label"></label>
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
                                                                <label for="" id="view_al_academic_year" name="view_al_academic_year" class="col-sm col-form-label col-form-label-sm"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Index No</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_al_index_no" name="view_al_index_no" class="col-sm col-form-label col-form-label-sm"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Z-Score</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_full_z_score" name="view_full_z_score" class="col-sm col-form-label col-form-label-sm"></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-4 col-form-label">Stream</label>
                                                            <div class="col-sm-8">
                                                                <label for="" id="view_al_stream" name="view_al_stream" class="col-sm col-form-label col-form-label-sm"></label>
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
                                                                                <td><label id="view_al_subject1" name="view_al_subject1"></label></td>
                                                                                <td><label id="view_al_sub1_grade" name="view_al_sub1_grade"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><label id="view_al_subject2" name="view_al_subject2"></label></td>
                                                                                <td><label id="view_al_sub2_grade" name="view_al_sub2_grade"></label></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><label id="view_al_subject3" name="view_al_subject3"></label></td>
                                                                                <td><label id="view_al_sub3_grade" name="view_al_sub3_grade"></label></td>
                                                                            </tr>
                                                                            <tr id="al_row_4">
                                                                                <td><label id="view_al_subject4" name="view_al_subject4"></label></td>
                                                                                <td><label id="view_al_sub4_grade" name="view_al_sub4_grade"></label></td>
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
                                                       <div id="ol_box" name="ol_box">
                                                            <div id="view_aa">
                                                                <div class='form-group row'>
                                                                    <label for='' class='col-sm-4 col-form-label'>Year</label>
                                                                    <div class='col-sm-8'>
                                                                        <label for='' id='view_ol_year' name='view_ol_year' class='col-sm col-form-label col-form-label-sm'>
                                                                        </label>
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
                                                                                    <td><label id='view_ol_maths_grade' name='view_ol_maths_grade'></label></td>
                                                                                    <td><label id='view_ol_english_grade' name='view_ol_english_grade'></label></td>
                                                                                    <td><label id='view_ol_index_no' name='view_ol_index_no'></label></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>


                                                            <div id="bb">
                                                                
                                                            </div>
                                                        </div>
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
                                                                    <td><label id="view_priority1_center" name="view_priority1_center"></label></td>
                                                                    <td><label id="view_priority1_course" name="view_priority1_course"></label></td>
                                                                    <td><label id="view_priority1_time" name="view_priority1_time"></label></td>
                                                                </tr>
                                                                <tr id="priority_2_row" >
                                                                    <th scope="row">Priority 2</th>
                                                                    <td><label id="view_priority2_center" name="view_priority2_center"></label></td>
                                                                    <td><label id="view_priority2_course" name="view_priority2_course"></label></td>
                                                                    <td><label id="view_priority2_time" name="view_priority2_time"></label></td>
                                                                </tr>
                                                                <tr id="priority_3_row">
                                                                    <th scope="row">Priority 3</th>
                                                                    <td><label id="view_priority3_center" name="view_priority3_center"></label></td>
                                                                    <td><label id="view_priority3_course" name="view_priority3_course"></label></td>
                                                                    <td><label id="view_priority3_time" name="view_priority3_time"></label></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                </div>  -->

                                                <!--Straight Modal End-->


                                                <!--
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()">
                                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                                </div>
                                                <div id="agreement_box"><p style="color: #dc3545"><b>* Please check the agreement above</b></p></div> -->
                                            </div>
                                            <div class="" style="padding: 1rem; border-top: 1px solid #e9ecef; border-bottom-right-radius: .3rem; border-bottom-left-radius: .3rem;">
                                                <div class="container">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()">
                                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                                    </div>
                                                    <div id="agreement_box"><p style="color: #dc3545"><b>* Please check the agreement above</b></p></div>
                                                </div>
                                                <br>

                                                <div class="">
                                                    <button type="button" class="btn btn-secondary border-radius ubuntu" data-dismiss="modal" onclick="back();"><span><i class="far fa-times-circle"></i></span> &nbsp; Close</button>
                                                    <button type="submit" id="confirm" class="btn btn-default border-radius ubuntu sl-btn float-right"><span><i class="fas fa-check-circle"></i></span> &nbsp; Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

</div>


</div>


<script>

//    FilePond.registerPlugin(
//        FilePondPluginFileValidateSize,
//        FilePondPluginImagePreview,
//        FilePondPluginImageTransform,
//        FilePondPluginImageResize,
//        FilePondPluginImageValidateSize,
//        FilePondPluginImageCrop,
//        FilePondPluginFileValidateType
//    );

//    FilePond.create(
//        document.querySelector('#profile_picture'),
//        {
//            allowImagePreview: true,
//            allowFileTypeValidation: true,
//            acceptedFileTypes: ['image/jpeg'],
//            labelFileTypeNotAllowed: 'File of invalid type',
//            allowFileSizeValidation: true,
//            maxFileSize: 750000,
//            labelMaxFileSizeExceeded: 'File is too large',
//            labelMaxFileSize: 'Maximum file size is {750KB}',
//            allowImageValidateSize: true,
//            imageValidateSizeMinWidth: 150,
//            imageValidateSizeMaxWidth: 150,
//            imageValidateSizeMinHeight: 150,
//            imageValidateSizeMaxHeight: 150,
//            imageValidateSizeLabelFormatError: 'Image type not supported',
//            labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
//            imageCropAspectRatio: '1:1',
//            stylePanelLayout: 'compact circle',
//            imagePreviewHeight: 150,
//            //styleLoadIndicatorPosition: 'center',
//            styleButtonRemoveItemPosition: 'center bottom',
//            imageResizeTargetWidth: 200,
//            imageResizeTargetHeight: 200,
//            
//            
//            
//        }
//    );

    function view() {
        var indexno = $('#indexno').val();
        var title = $('#title').find('option:selected').attr("name");
        var fullname = $('#fullname').val();
        var initials_name = $('#initials_name').val();
        var nic = $('#nic').val();
        var d_o_b = $('#d_o_b').val();
        var gender = $("input[name='gender']:checked").val();
        var sex;
        if (gender == 'male') {
            sex = "Male";
        } else {
            sex = "Female";
        }

        var email = $('#email').val();
        var phoneno = $('#phoneno').val();
        var landno = $('#landno').val();
        var address = $('#address').val();
        var district = $('#district').find('option:selected').attr("name");





        var al_year = $('#al_year').val();
        var plus_minus = $('#plus_minus').val();
        var z_score = $('#z_score').val();
        var al_index_no = $('#al_index_no').val();
        var al_academic_year = $('#al_academic_year').val();
        var al_stream = $('#al_stream').find('option:selected').attr("name");
        var al_subject1 = $('#al_subject1').find('option:selected').attr("name");
        var al_subject2 = $('#al_subject2').find('option:selected').attr("name");
        var al_subject3 = $('#al_subject3').find('option:selected').attr("name");
        var al_subject4 = $('#al_subject4').find('option:selected').attr("name");
        var al_sub1_grade = $('#al_sub1_grade').find('option:selected').attr("name");
        var al_sub2_grade = $('#al_sub2_grade').find('option:selected').attr("name");
        var al_sub3_grade = $('#al_sub3_grade').find('option:selected').attr("name");
        var al_sub4_grade = $('#al_sub4_grade').find('option:selected').attr("name");

        var ol_academic_year = $('#ol_academic_year').val();
        var ol_diff_year = $("input[name='ol_diff_year']:checked").val();
        var ol_year = $('#ol_year').val();
        var ol_english_year = $('#ol_english_year').val();
        var ol_maths_grade = $('#ol_maths_grade').find('option:selected').attr("name");
        var ol_english_grade = $('#ol_english_grade').find('option:selected').attr("name");
        var ol_index_no = $('#ol_index_no').val();
        var ol_english_index_no = $('#ol_english_index_no').val();

        var priority1_center = $('#priority1_center').find('option:selected').attr("name");
        var priority1_course = $('#priority1_course').find('option:selected').attr("name");
        var priority1_time = $('#priority1_time').find('option:selected').attr("name");

        var priority2_center = $('#priority2_center').find('option:selected').attr("name");
        var priority2_course = $('#priority2_course').find('option:selected').attr("name");
        var priority2_time = $('#priority2_time').find('option:selected').attr("name");

        var priority3_center = $('#priority3_center').find('option:selected').attr("name");
        var priority3_course = $('#priority3_course').find('option:selected').attr("name");
        var priority3_time = $('#priority3_time').find('option:selected').attr("name");


        $('#view_indexno').html(indexno);
        $('#view_title').html(title);
        $('#view_initials_name').html(initials_name);
        $('#view_fullname').html(fullname);
        $('#view_nic').html(nic);
        $('#view_d_o_b').html(d_o_b);
        $('#view_gender').html(sex);

        $('#view_email').html(email);
        $('#view_phoneno').html(phoneno);
        $('#view_landno').html(landno);
        $('#view_address').html(address);
        $('#view_district').html(district);





        $('#view_al_year').html(al_year);
        $('#view_full_z_score').html(plus_minus + z_score);
        $('#view_al_index_no').html(al_index_no);
        $('#view_al_academic_year').html(al_academic_year);
        $('#view_al_stream').html(al_stream);
        $('#view_al_subject1').html(al_subject1);
        $('#view_al_subject2').html(al_subject2);
        $('#view_al_subject3').html(al_subject3);
        $('#view_al_subject4').html(al_subject4);
        $('#view_al_sub1_grade').html(al_sub1_grade);
        $('#view_al_sub2_grade').html(al_sub2_grade);
        $('#view_al_sub3_grade').html(al_sub3_grade);
        $('#view_al_sub4_grade').html(al_sub4_grade);

        $('#view_ol_academic_year').html(ol_academic_year);
        $('#view_ol_year').html(ol_year);
        $('#view_ol_english_year').html(ol_english_year);
        $('#view_ol_maths_grade').html(ol_maths_grade);
        $('#view_ol_english_grade').html(ol_english_grade);
        $('#view_ol_index_no').html(ol_index_no);
        $('#view_ol_english_index_no').html(ol_english_index_no);

        $('#view_priority1_center').html(priority1_center);
        $('#view_priority1_course').html(priority1_course);
        $('#view_priority1_time').html(priority1_time);

        if (priority2_center == "") {
            $('#view_priority2_center').html("N/A");
            $('#view_priority2_course').html("N/A");
            $('#view_priority2_time').html("N/A");
        } else {
            $('#view_priority2_center').html(priority2_center);
            $('#view_priority2_course').html(priority2_course);
            $('#view_priority2_time').html(priority2_time);
        }

        if (priority3_center == "") {
            $('#view_priority3_center').html("N/A");
            $('#view_priority3_course').html("N/A");
            $('#view_priority3_time').html("N/A");
        } else {
            $('#view_priority3_center').html(priority3_center);
            $('#view_priority3_course').html(priority3_course);
            $('#view_priority3_time').html(priority3_time);
        }


    }

//    function validate_duplicate_nic_number(){
//        var nic = $('#nic').val();
//        
//        $.post("<?php //echo base_url('App/validate_duplicate_nic_number')   ?>", {'nic':nic},
//        function (data)
//        {
//            if(data['nic_count'] >= 1)
//            {
//                alert('NIC Already Exixts.');
//                $('#nic').removeClass("is-valid").addClass("is-invalid");
//            }
//            else{
//                alert('NIC Available.');
//                $('#nic').removeClass("is-invalid").addClass("is-valid");
//            }
//        },"json");
//    }

    $(document).ready(function () {

        $("#confirm").attr("disabled", true);


        $("#al_academic_year").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        
        $("#ol_year").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        
        
        $('.btnPrevious').click(function () {
            $('.reg_tabs .active').parent().prev('li').find('a').trigger('click');
        });

        $("#phoneno").inputmask("999-999-9999");
        $("#landno").inputmask("999-999-9999");

        $("#indexno").on('keyup', function () {
            var indexno = $('#indexno').val();
            if (indexno == "") {
                $('#indexno').removeClass("is-valid").addClass("is-invalid");
            } else {
                $('#indexno').removeClass("is-invalid").addClass("is-valid");
            }
//                return;
//            document.getElementById("indexno").style.borderColor = "green";
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
                $.notify({
                    // options
                    message: 'You Cant Select Same Subject.'
                }, {
                    // settings
                    type: 'warning'
                });
                //alert("You can't Choose the Same Subject");
            } else {
                backups[$(this).attr("id")] = v;
            }
        }).val(null);
        //-----End Same Subject Validation----//




        /*$("#ol_year").keyup(function () {
         var ol_year = $('#ol_year').val();
         if (ol_year == "") {
         $('#ol_year').removeClass("is-valid").addClass("is-invalid");
         //document.getElementById("ol_year").style.borderColor = "red";
         } else {
         $('#ol_year').removeClass("is-invalid").addClass("is-valid");
         //document.getElementById("ol_year").style.borderColor = "green";
         }
         });*/



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

    ////////////////////////////////////////////
    function single_ol_year() {
        var ol_year = document.getElementById('ol_year');
        if (ol_year.value.length === 0)
            document.getElementById("ol_year").style.borderColor = "red";
        return;
        document.getElementById("ol_year").style.borderColor = "green";
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

    function ol_section() {
        var type_year = $("input[name='ol_diff_year']:checked").val();

        if (type_year == 1) {
            $("#bb").empty();
            $("#aa").append("<div class='form-row'>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='indexno' class='ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                    <input type='text' class='form-control border-radius ubuntu' id='ol_year' name='ol_year' placeholder='Year' onkeyup='single_ol_year()' autocomplete='off'>\n\
                                </div>\n\
                            </div>\n\
                            <div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label ubuntu'>Results<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label ubuntu'>Mathematics<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                    <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                        <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                    </select>\n\
                                </div>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label ubuntu'>English<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option>\n\
<?php endforeach; ?>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class='form-group col-md'>\n\
                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                        <input type='text' class='form-control border-radius ubuntu' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required'>\n\
                                    </div>\n\
                                </div>");
                                $('#ol_year').datepicker({
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
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_year' name='ol_year' placeholder='Year' data-validation='required' autocomplete='off'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required'>\n\
                                                    </div>\n\
                                                </div><br>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>English<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius ubuntu' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Year<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_english_year' name='ol_english_year' placeholder='Year' data-validation='required' autocomplete='off'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label ubuntu'>Index No<sup style='color: #E5343D !important;top: -.5em;position: relative;line-height: 0;vertical-align: baseline;'>*</sup></label>\n\
                                                        <input type='text' class='form-control border-radius ubuntu' id='ol_english_index_no' name='ol_english_index_no' placeholder='' data-validation='required'>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                 </div>");
                                $('#ol_year').datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
                                
                                $('#ol_english_year').datepicker({
                                    format: "yyyy", // Notice the Extra space at the beginning
                                    viewMode: "years",
                                    minViewMode: "years"
                                });
        }
    }

    function view_section() {
        var ol_diff_year = $("input[name='ol_diff_year']:checked").val();
        if (ol_diff_year == 1) {
            $("#view_aa").empty();
            $("#view_aa").append("<div class='form-group row' style='border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;'>\n\
                                        <label for='' class='col-sm-4 col-form-label'>Year</label>\n\
                                        <div class='col-sm-8'>\n\
                                            <label for='' id='view_ol_year' name='view_ol_year' class='col-sm col-form-label col-form-label-sm'>\n\
                                            </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class='form-group row' style='border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;'>\n\
                                        <label for='' class='col-sm-4 col-form-label'>Results</label>\n\
                                        <div class='form-group col-md'>\n\
                                            <table class='table'>\n\
                                                <thead>\n\
                                                    <tr>\n\
                                                        <th scope='col'><label>Mathematics</label></th>\n\
                                                        <th scope='col'><label>English</label></th>\n\
                                                        <th scope='col'><label>Index No</label></th>\n\
                                                    </tr>\n\
                                                <thead>\n\
                                                <tbody>\n\
                                                    <tr>\n\
                                                        <td><label id='view_ol_maths_grade' name='view_ol_maths_grade'></label></td>\n\
                                                        <td><label id='view_ol_english_grade' name='view_ol_english_grade'></label></td>\n\
                                                        <td><label id='view_ol_index_no' name='view_ol_index_no'></label></td>\n\
                                                    </tr>\n\
                                                </tbody>\n\
                                            </table>\n\
                                        </div>\n\
                                    </div>");
        } else {
            $("#view_aa").empty();
            $("#view_aa").append("<div class='form-group row' style='border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;'>\n\
                                                <label for='' class='col-sm-4 col-form-label'>Results</label>\n\
                                                <div class='form-group col-md'>\n\
                                                    <table class='table'>\n\
                                                        <thead>\n\
                                                            <tr>\n\
                                                                <th scope='col'><label>Subjects</label></th>\n\
                                                                <th scope='col'><label>Year</label></th>\n\
                                                                <th scope='col'><label>Index No</label></th>\n\
                                                            </tr>\n\
                                                        </thead>\n\
                                                        <tbody>\n\
                                                            <tr>\n\
                                                                <td><label id='view_ol_maths_grade' name='view_ol_maths_grade'>Maths</label></td>\n\
                                                                <td><label id='view_ol_year' name='view_ol_year'></label></td>\n\
                                                                <td><label id='view_ol_index_no' name='view_ol_index_no'></label></td>\n\
                                                            </tr>\n\
                                                            <tr>\n\
                                                                <td><label id='view_ol_english_grade' name='view_ol_english_grade'>English</label></td>\n\
                                                                <td><label id='view_ol_english_year' name='view_ol_english_year'></label></td>\n\
                                                                <td><label id='view_ol_english_index_no' name='view_ol_english_index_no'></label></td>\n\
                                                            </tr>\n\
                                                        </tbody>\n\
                                                    </table>\n\
                                                </div>\n\
                                            </div>");
        }
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

    ////////////////////////////////////////////





    /* $("#indexno").on('keyup', function () {
     var indexno = document.getElementById('indexno');
     if (indexno.value.length === 0)
     return;
     document.getElementById("indexno").style.borderColor = "green";
     });*/

    $("#title").change(function () {
        var title = $('#title').val();

        if (title == "") {
            $('#title').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("ol_maths_grade").style.borderColor = "red";
        } else {
            $('#title').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("ol_maths_grade").style.borderColor = "green";
        }
    });

    $("#fullname").on('keyup', function () {
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

    $("#nic").on('blur', function () {
        var nic_validate = $('#nic').val();
        $.post("<?php echo base_url('App/validate_duplicate_nic_number') ?>", {'nic': nic_validate},
                function (data)
                {
                    if (data['nic_count'] >= 1)
                    {
                        $("#nic").removeClass("is-valid").addClass("is-invalid");
                        $("#nic_message").html('NIC Already Exists');
                        y = false;
                    } else {
                        $("#nic_message").html('');
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
                    }
                }, "json");








    });

    $("#phoneno").on('keyup', function () {
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

    $("#landno").on('keyup', function () {
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

    /* $("#landno").on('keyup', function () {
     var la;
     var landno = $('#landno').val();
     
     if (landno.length === 0) {
     $("#landno").removeClass("is-valid").addClass("is-invalid");
     la = false;
     } else {
     $("#landno").removeClass("is-invalid").addClass("is-valid");
     la = true;
     }
     
     var landnoregex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
     
     if (!(landno).match(landnoregex)) {
     $("#landno").removeClass("is-valid").addClass("is-invalid");
     la = false;
     }else{
     $("#landno").removeClass("is-invalid").addClass("is-valid");
     la = true;
     }
     
     //var inputphone = document.getElementById('landno');
     //if (inputphone.value.length === 0)
     //    return;
     //document.getElementById("landno").style.borderColor = "green";
     }); */

    $("#address").on('keyup', function () {
        var address = $('#address').val();
        if (address == "") {
            $('#address').removeClass("is-valid").addClass("is-invalid");
        } else {
            $('#address').removeClass("is-invalid").addClass("is-valid");
        }
//                return;
//            document.getElementById("indexno").style.borderColor = "green";
    });

    /*$("#address").on('keyup', function () {
     var inputphone = document.getElementById('address');
     if (inputphone.value.length === 0)
     return;
     document.getElementById("address").style.borderColor = "green";
     }); */

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

    $("#email").on('keyup', function () {
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






    /////////////////////NIC Validation///////////////////////////////////////
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


    function vali_funct() {
        var indexno = $('#indexno').val();

        if (indexno == "") {
            $('#indexno').removeClass("invalid").addClass("is-invalid");
            //document.getElementById("indexno").style.borderColor = "red";
        } else {
            $("#indexno").on('keyup', function () {
                $('#indexno').addClass("is-valid");
                //document.getElementById("indexno").style.borderColor = "green";
            });
        }

        if (indexno !== "") {
            $('.reg_tabs .active').parent().next('li').find('a').trigger('click');
        }


    }

    function vali_funct1() {
        var title = $('#title').val();
        var fullname = $('#fullname').val();
        var nic = $('#nic').val();
        var d_o_b = $('#d_o_b').val();
        var x;
        var y;

        if (title == "") {
            //document.getElementById("district").style.borderColor = "red";
            $('#title').removeClass("invalid").addClass("is-invalid");

        } else {
            $("#title").change(function () {
                //document.getElementById("district").style.borderColor = "green";
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
            $.post("<?php echo base_url('App/validate_duplicate_nic_number') ?>", {'nic': nic},
                    function (data)
                    {
                        if (data['nic_count'] >= 1)
                        {
                            $("#nic").removeClass("is-valid").addClass("is-invalid");
                            $("#nic_message").html('NIC Already Exists');
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
                    }, "json");

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

        //alert(phone);

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

        /*if (landno == "") {
         $("#landno").removeClass("is-valid").addClass("is-invalid");
         //document.getElementById("landno").style.borderColor = "red";
         la = false;
         } else {
         $("#landno").on('keyup', function () {
         $("#landno").removeClass("is-invalid").addClass("is-valid");
         la = true;
         });
         //$("#landno").on('keyup', function () {
         //    document.getElementById("landno").style.borderColor = "green";
         //});
         }
         var landnoregex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
         */
        /* if (address == "") {
         document.getElementById("address").style.borderColor = "red";
         } else {
         $("#address").on('keyup', function () {
         document.getElementById("address").style.borderColor = "green";
         });
         } */

        if (address == "") {
            $('#address').removeClass("invalid").addClass("is-invalid");
            //document.getElementById("indexno").style.borderColor = "red";
        } else {
            $("#address").on('keyup', function () {
                $('#address').addClass("is-valid");
                //document.getElementById("indexno").style.borderColor = "green";
            });
        }

        if (district == "") {
            //document.getElementById("district").style.borderColor = "red";
            $('#district').removeClass("invalid").addClass("is-invalid");
            document.getElementById("desig").style.color = "red";
            document.getElementById("desig").innerHTML = 'District Required';

        } else {
            $("#district").change(function () {
                //document.getElementById("district").style.borderColor = "green";
                $('#district').removeClass("is-invalid").addClass("is-valid");
                document.getElementById("desig").innerHTML = '';
            });
        }

        if (email == "") {
            //document.getElementById("email").style.borderColor = "red";
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
            $("#al_academic_year").on('keyup focusout', function () {
                $("#al_academic_year").removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (al_index_no == "") {
            $("#al_index_no").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_index_no").style.borderColor = "red";
        } else {
            $("#al_index_no").on('keyup focusout', function () {
                $("#al_index_no").removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (z_score == "") {
            $("#z_score").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("z_score").style.borderColor = "red";
        } else {
            $("#z_score").on('keyup focusout', function () {
                $("#z_score").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("z_score").style.borderColor = "green";
            });
        }

        if (al_stream == "") {
            $("#al_stream").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_stream").style.borderColor = "red";
        } else {
            $("#al_stream").on('change', function () {
                $("#al_stream").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_stream").style.borderColor = "green";
            });
        }

        if (al_subject1 == "") {
            $("#al_subject1").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject1").style.borderColor = "red";
        } else {
            $("#al_subject1").on('change', function () {
                $("#al_subject1").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject1").style.borderColor = "green";
            });
        }

        if (al_sub1_grade == "") {
            $("#al_sub1_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub1_grade").style.borderColor = "red";
        } else {
            $("#al_sub1_grade").on('change', function () {
                $("#al_sub1_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub1_grade").style.borderColor = "green";
            });
        }

        if (al_subject2 == "") {
            $("#al_subject2").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject2").style.borderColor = "red";
        } else {
            $("#al_subject2").on('change', function () {
                $("#al_subject2").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject2").style.borderColor = "green";
            });
        }

        if (al_sub2_grade == "") {
            $("#al_sub2_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub2_grade").style.borderColor = "red";
        } else {
            $("#al_sub2_grade").on('change', function () {
                $("#al_subject2").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub2_grade").style.borderColor = "green";
            });
        }

        if (al_subject3 == "") {
            $("#al_subject3").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject3").style.borderColor = "red";
        } else {
            $("#al_subject3").on('change', function () {
                $("#al_subject3").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject3").style.borderColor = "green";
            });
        }

        if (al_sub3_grade == "") {
            $("#al_sub3_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub3_grade").style.borderColor = "red";
        } else {
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

    function myFunction() {
        var checkBox = document.getElementById("exampleCheck1");
        //        var text = document.getElementById("text");
        if (checkBox.checked == true) {
            $('#agreement_box').hide();
            $('#confirm').attr("disabled", false);
        } else {
            $('#agreement_box').show();
            $('#confirm').attr("disabled", true);
        }
    }

    function back() {
        $('#agreement_box').show();
        $("#exampleCheck1").prop("checked", false);
        $('#confirm').attr("disabled", true);
        //$('#reg_page').show();
        //$('#view_page').hide();
    }
</script>
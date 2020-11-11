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
<!--                <li class="nav-item d-none d-sm-inline-block"><a href="index3.html" class="nav-link">Home</a></li>-->
                <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Contact</a></li>
<!--                <li class="nav-item d-none d-sm-inline-block"><a href="--><?php //echo base_url('App/Login') ?><!--" class="nav-link">Login</a></li>-->
            </ul>
        </div>
    </nav>

    <!-- Content Wrapper. Contains page content -->
    <div class="container  main-padding">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Application Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Application Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" id="reg_form" name="reg_form" method="post" action="<?php echo base_url('App/online_register') ?>">
                            <!--Please Enter Your Index No-->
                            <div class="card card-info shadow" style="display: none;">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title">Please enter your Index No / කරුණාකර ඔබේ දර්ශක අංකය / உங்கள்  சுட்டெண்ணை இடவும் </h3>
                                </div>

                                <div class="card-body mandatory">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Index No<br>දර්ශක අංකය<br>சுட்டெண் </label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="indexno" name="indexno" placeholder="Index No">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-default sl-btn border-radius">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title ">Selection Year</h3>
                                </div>

                                <div class="card card-info shadow">
                                    <div class="card-body mandatory">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Student Selection Year<br><br></label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control border-radius" id="student_selection_year" name="student_selection_year" placeholder="Student Selection Year" value="<?php echo $stu_reg_year ? $stu_reg_year : ''; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Select Course-->
                            <br/>
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title ">Selection type</h3>
                                </div>

                                <div class="card-body mandatory">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Selection type<br><br></label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input class="user-radio" type="radio" name="selection_type" value="zscore" id="single_year" checked>Z-Score<br><br>
                                                </div>
                                                <div class="col-sm">
                                                    <input class="user-radio" type="radio" name="selection_type" value="aptitude_test" id="multiple_year">Aptitude Test Marks<br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title ">Select Course / පාඨමාලාව තෝරන්න </h3>
                                </div>

                                <div class="card-body mandatory">
                                    <!--course select row-->

                                    <div class=" row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">Priority - 1<br>ප්‍රමුඛතාව - 1<br>முன்னுரிமை - 1</label>
                                                <div class="col-sm">
                                                    <label for="" class="col-sm col-form-label">Center<br>මධ්යස්ථානය<br>மையம் </label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority1_center" name="priority1_center" onchange="priority1_get_courses(this.value, 1, null)" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Course<br>පාඨමාලාව<br>பாடக்கோப்பு</label>
                                                        <div class="priority1_course">
                                                            <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority1_course" name="priority1_course" onchange="priority1_load_time()" data-validation="required">
                                                                <option value="" name="">-Select Course-</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <div class="col-sm">
                                                    <div class="col-sm">
                                                        <label for="" class="col-sm col-form-label">Time<br>කාලය<br>நேரம் </label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority1_time" name="priority1_time" data-validation="required">
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
                                                <label for="" class="col-sm-4 col-form-label">Priority - 2<br>ප්‍රමුඛතාව - 2<br>முன்னுரிமை - 2</label>
                                                <div class="col-sm">
                                                    <label for="" class="col-sm col-form-label">Center<br>මධ්යස්ථානය<br>மையம் </label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority2_center" name="priority2_center" onchange="priority2_get_courses(this.value, 1, null)" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Course<br>පාඨමාලාව<br>பாடக்கோப்பு</label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority2_course" name="priority2_course" onchange="priority2_load_time()" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Time<br>කාලය<br>நேரம் </label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority2_time" name="priority2_time" data-validation="required">
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
                                                <label for="" class="col-sm-4 col-form-label">Priority - 3<br>ප්‍රමුඛතාව - 3 <br>முன்னுரிமை - 3</label>
                                                <div class="col-sm">
                                                    <label for="" class="col-sm col-form-label">Center<br>මධ්යස්ථානය<br>மையம் </label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority3_center" name="priority3_center" onchange="priority3_get_courses(this.value, 1, null)" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Course<br>පාඨමාලාව<br>பாடக்கோப்பு</label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority3_course" name="priority3_course" onchange="priority3_load_time()" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Time<br>කාලය<br>நேரம் </label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority3_time" name="priority3_time" data-validation="required">
                                                            <option value="">-Select Time-</option>
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
                                                <label for="" class="col-sm-4 col-form-label">Priority - 4<br>ප්‍රමුඛතාව - 4 <br>முன்னுரிமை - 4</label>
                                                <div class="col-sm">
                                                    <label for="" class="col-sm col-form-label">Center<br>මධ්යස්ථානය<br>மையம் </label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority4_center" name="priority4_center" onchange="priority4_get_courses(this.value, 1, null)" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Course<br>පාඨමාලාව<br>பாடக்கோப்பு</label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority4_course" name="priority4_course" onchange="priority4_load_time()" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Time<br>කාලය<br>நேரம் </label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority4_time" name="priority4_time" data-validation="required">
                                                            <option value="">-Select Time-</option>
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
                                                <label for="" class="col-sm-4 col-form-label">Priority - 5<br>ප්‍රමුඛතාව - 5 <br>முன்னுரிமை - 5</label>
                                                <div class="col-sm">
                                                    <label for="" class="col-sm col-form-label">Center<br>මධ්යස්ථානය<br>மையம் </label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority5_center" name="priority5_center" onchange="priority5_get_courses(this.value, 1, null)" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Course<br>පාඨමාලාව<br>பாடக்கோப்பு</label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority5_course" name="priority5_course" onchange="priority5_load_time()" data-validation="required">
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
                                                        <label for="" class="col-sm col-form-label">Time<br>කාලය<br>நேரம் </label>
                                                        <select type="text" class="form-control border-radius" placeholder=".col-3" id="priority5_time" name="priority5_time" data-validation="required">
                                                            <option value="">-Select Time-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!--Personal Details-->
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title ">Personal Details / පුද්ගලික තොරතුරු / சொந்த விபரங்கள் </h3>
                                </div>

                                <div class="card-body mandatory">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Title<br>ශීර්ෂය<br>தலைப்பு</label>
                                        <div class="col-sm">
                                            <select type="text" class="form-control border-radius" id="title" name="title">
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
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Full Name<br>සම්පූර්ණ නම<br>முழு பெயர் </label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="fullname" name="fullname" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Name with intials<br>සහිත නම<br>முதல் எழுத்துக்களுடன் பெயர்</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="initials_name" name="initials_name" placeholder="Name with Initials" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">National Identity Card No<br>ජාතික හැඳුනුම්පත අංක<br>தேசிய அடையாள அட்டை எண்</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control nic-validate border-radius" id="nic" name="nic" placeholder="NIC">
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <h6 class="text-left text-success nic-birthday"></h6>
                                            <h6 class="text-left text-info nic-gender"></h6>
                                        </div>
                                        <h6 class="text-center" hidden="">
                                            <button type="button" class="btn btn-success mx-auto nic-validate-btn">Validate</button>
                                            <button type="button" class="btn btn-warning mx-auto nic-clear-btn">Clear</button>
                                        </h6>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Date of Birth (DD/MM/YYYY)<br>උපන්දිනය<br>பிறந்த திகதி</label>
                                        <div class="col-sm">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-radius"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control border-radius" id="d_o_b" name="d_o_b" placeholder="DD/MM/YYYY" value="" readonly>
                                                <input type="hidden" name="d_o_b" id="d_o_b_hidden" value="">
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Gender<br>ස්තී පුරුෂ භාවය<br>பால்</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="radio" name="gender" value="male" id="male"> Male<br> &nbsp;&nbsp;&nbsp;&nbsp;පිරිමි<br>&nbsp;&nbsp;&nbsp;&nbsp;ஆண் 
                                                </div>
                                                <div class="col-sm">
                                                    <input type="radio" name="gender" value="female" id="female"> Female<br> &nbsp;&nbsp;&nbsp;&nbsp;ගැහැණු<br>&nbsp;&nbsp;&nbsp;&nbsp;பெண் 

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!--Contact Details-->
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title">Contact Details / ඇමතුම් විස්තර / தொடர்பு விபரங்கள்</h3>
                                </div>

                                <div class="card-body mandatory">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Email Address<br>විද්යුත් තැපැල් ලිපිනය<br>மின்னஞ்சல் முகவரி</label>
                                        <div class="col-sm">
                                            <input type="email" class="form-control border-radius" id="email" name="email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Phone no<br>දුරකතන අංකය<br>தொலைபேசி எண் </label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="phoneno" name="phoneno" placeholder="Phone No">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Land phone number<br>ස්ථිර දුරකථන අංකය<br>வீட்டுத்  தொலைபேசி எண் </label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="landno" name="landno" placeholder="Land phone number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Address<br>ලිපිනය<br>முகவரி</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="address" name="address" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">District<br>දිසා<br>மாவட்டம்</label>
                                        <div class="col-sm">
                                            <select type="text" class="form-control border-radius" id="district" name="district">
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--A/L Examinations-->
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title ">G.C.E A/L Examination / අ.පො.ස (උසස් පෙළ) / கல்விப் பொதுத் தராதரப் பத்திர(உயர்தர)ப் பரீட்சை </h3>
                                </div>

                                <div class="card-body mandatory">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Academic Year<br>අධ්යන වර්ෂය<br>கல்வி ஆண்டு</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="al_academic_year" name="al_academic_year" placeholder="A/L Academic Year">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Index No<br>විභාග අංකය<br>சுட்டெண் </label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="al_index_no" name="al_index_no" placeholder="A/L Index No">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">A/L General marks<br>උසස් පෙළ සාමාන්‍ය ලකුණු<br>A / L பொது மதிப்பெண்கள்</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control border-radius" id="al_general_marks" name="al_general_marks" placeholder="A/L General Marks">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Z-Score<br>Z-අගය<br>Z-மதிப்பெண் </label>
                                        <div class="col-sm">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select class="form-control border-radius" id="plus_minus" name="plus_minus">
                                                        <option value="+">+</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control border-radius" id="z_score" name="z_score" placeholder="Z-Score">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Stream<br>විෂය ධාරාව<br>பிரிவு</label>
                                        <div class="col-sm">
                                            <select type="text" class="form-control border-radius" id="al_stream" name="al_stream" onchange="load_subjects(this.value, null, this);">
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
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">A/L Subjects<br>උ.පෙ විෂයයන් <br>உயர் தர பாடங்கள் <span id="select_subject_alert" style="color:red;"><b> </b></span></label><br>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="" class="col-sm col-form-label">Subject 1<br>විෂයයන්  1<br>பாடம்  1</label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="al_subject1" name="al_subject1" onchange="">
                                                        <option value="">--Select Subject--</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="col-sm col-form-label">Grade 1<br>සාමාර්ථය 1<br>தரம்  1</label>
                                                    <select type="text" id="al_sub1_grade" name="al_sub1_grade" class="form-control border-radius" placeholder=".col-3" onchange="">
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
                                                    <label for="" class="col-sm col-form-label">Subject 2<br>විෂයයන්  2<br>பாடம்  2</label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="al_subject2" name="al_subject2" onchange="">
                                                        <option value="">--Select Subject--</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="col-sm col-form-label">Grade 2<br>සාමාර්ථය 2<br>தரம்  2</label>
                                                    <select type="text" id="al_sub2_grade" name="al_sub2_grade" class="form-control border-radius" placeholder=".col-3" onchange="">
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
                                                    <label for="" class="col-sm col-form-label">Subject 3<br>විෂයයන්  3<br>பாடம்  3</label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="al_subject3" name="al_subject3" onchange="">
                                                        <option value="">--Select Subject--</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="col-sm col-form-label">Grade 3<br>සාමාර්ථය 3<br>தரம்  3</label>
                                                    <select type="text" id="al_sub3_grade" name="al_sub3_grade" class="form-control border-radius" placeholder=".col-3" onchange="">
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
                                                    <button type="button" id="add_section" name="add_section" onclick="add_row();" class="btn btn-primary btn-sm">+</button>
                                                </div>
                                            </div>
                                            <div class="row" id="subject4_row" name="subject4_row">
                                                <div class="col">
                                                    <label for="" class="col-sm col-form-label">Subject 4<br>විෂයයන්  4<br>பாடம்  4</label>
                                                    <select type="text" class="form-control border-radius" placeholder=".col-3" id="al_subject4" name="al_subject4" onchange="">
                                                        <option value="">--Select Subject--</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="" class="col-sm col-form-label">Grade 4<br>සාමාර්ථය 4<br>தரம்  4</label>
                                                    <select type="text" id="al_sub4_grade" name="al_sub4_grade" class="form-control border-radius" placeholder=".col-3" onchange="">
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
                                                    <button type="button" id="delete_section" name="delete_section" onclick="delete_row();" class="btn btn-primary btn-sm">-</button>
                                                </div>
                                            </div>
                                        </div>
                                        <label id="lbl_al_subjects" class="col-md-10 control-label" style="color: red"></label>
                                    </div>
                                </div>


                            </div>
                            
                            

                            <!--O/L Examinations-->
                            <div class="card card-info shadow">
                                <div class="card-header" style="background: #2ba672; color: white;">
                                    <h3 class="card-title ">G.C.E O/L Examination / අ.පො.ස(සාමාන්‍ය පෙළ) / கல்விப் பொதுத் தராதரப் பத்திர (சாதாரண தர)ப் பரீட்சை</h3>
                                </div>

                                <div class="card-body mandatory">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Sat For Exam In<br>විභාගය සඳහා පෙනී සිටි වාර ගණන<br>தேர்வு தடவை</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input class="user-radio" type="radio" name="ol_diff_year" value="1" id="single_year" onchange="ol_section();view_section();" checked> Single<br>&nbsp;&nbsp;&nbsp;&nbsp;එක වරක් <br>&nbsp;&nbsp;&nbsp;&nbsp;ஒரு தடவை
                                                </div>
                                                <div class="col-sm">
                                                    <input class="user-radio" type="radio" name="ol_diff_year" value="2" onchange="ol_section();view_section();" id="multiple_year"> Several Years<br>&nbsp;&nbsp;&nbsp;&nbsp;කිහිප වරක් <br>&nbsp;&nbsp;&nbsp;&nbsp;பல தடவை
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ol_box" name="ol_box">
                                        <div id="aa">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Year<br>අවුරුදු<br>ஆண்டு</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control border-radius" id="ol_year" name="ol_year" placeholder="Year" data-validation="required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Results<br>ප්රතිපල<br>முடிவுகள்</label>
                                                <div class="form-group col-md">
                                                    <label for="" class="col-sm col-form-label">Mathematics<br>ගණිතය<br>கணிதம் </label>
                                                    <select type="text" id="ol_maths_grade" name="ol_maths_grade" class="form-control border-radius" placeholder=".col-3" data-validation="required">
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
                                                    <label for="" class="col-sm col-form-label">English<br>ඉංග්රීසි<br>ஆங்கிலம் </label>
                                                    <select type="text" id="ol_english_grade" name="ol_english_grade" class="form-control border-radius" placeholder=".col-3" data-validation="required">
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
                                                    <label for="" class="col-sm col-form-label">Index No<br>විභාග අංකය<br>சுட்டெண் </label>
                                                    <input type="text" class="form-control border-radius" id="ol_index_no" name="ol_index_no" placeholder="" data-validation="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="bb"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-info shadow">
                                <div class="card-body mandatory"><br>
                                    <!--<button type="submit" id="save_btn" class="btn btn-default sl-btn btn-sm">Click Next to Preview</button>-->
                                    <button type="button" id="view_btn" class="btn btn-default sl-btn btn-sm" data-toggle="modal" data-target="" onclick="view_open_modal();">Click Next to View</button>
                                </div>
                            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Preview Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!--Please Enter Your Index No-->
                                        <div class="modal-body">
                                            <div class="card card-info" style="display: none">
                                                <div class="card-header">
                                                    <h3 class="card-title">Please enter your Index No/ පුද්ගලික තොරතුරු / சொந்த விபரங்கள் </h3>
                                                </div>

                                                <div class="card-body mandatory">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label col-form-label-sm">Index No<br>දර්ශක අංකය<br>சுட்டெண் </label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_indexno" name="view_indexno" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card card-info">
                                                <div class="card-header" style="background: #2ba672; color: white;">
                                                    <h3 class="card-title">Selection Type</h3>
                                                </div>

                                                <div class="card-body mandatory">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label col-form-label-sm">Selection Type<br><br></label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_selection_type" name="view_selection_type" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Course Selection-->
                                            <div class="card card-info">
                                                <div class="card-header " style="background: #2ba672; color: white;">
                                                    <h3 class="card-title ">Course Selection / පාඨමාලාව තෝරන්න /  பாடநெறி தேர்ந்தெடுத்தல் </h3>
                                                </div>

                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Center / මධ්යස්ථානය / மையம் </th>
                                                        <th scope="col">Course / පාඨමාලාව / பாடக்கோப்பு</th>
                                                        <th scope="col">Time / කාලය / நேரம் </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr id="priority_1_row">
                                                        <th scope="row">Priority 1 / ප්‍රමුඛතාව - 1 / முன்னுரிமை - 1</th>
                                                        <td><label id="view_priority1_center" name="view_priority1_center"></label></td>
                                                        <td><label id="view_priority1_course" name="view_priority1_course"></label></td>
                                                        <td><label id="view_priority1_time" name="view_priority1_time"></label></td>
                                                    </tr>
                                                    <tr id="priority_2_row" >
                                                        <th scope="row">Priority 2 / ප්‍රමුඛතාව - 2 / முன்னுரிமை - 2</th>
                                                        <td><label id="view_priority2_center" name="view_priority2_center"></label></td>
                                                        <td><label id="view_priority2_course" name="view_priority2_course"></label></td>
                                                        <td><label id="view_priority2_time" name="view_priority2_time"></label></td>
                                                    </tr>
                                                    <tr id="priority_3_row">
                                                        <th scope="row">Priority 3 / ප්‍රමුඛතාව - 3 / முன்னுரிமை - 3</th>
                                                        <td><label id="view_priority3_center" name="view_priority3_center"></label></td>
                                                        <td><label id="view_priority3_course" name="view_priority3_course"></label></td>
                                                        <td><label id="view_priority3_time" name="view_priority3_time"></label></td>
                                                    </tr>
                                                    <tr id="priority_4_row">
                                                        <th scope="row">Priority 4 / ප්‍රමුඛතාව - 4 / முன்னுரிமை - 4</th>
                                                        <td><label id="view_priority4_center" name="view_priority4_center"></label></td>
                                                        <td><label id="view_priority4_course" name="view_priority4_course"></label></td>
                                                        <td><label id="view_priority4_time" name="view_priority4_time"></label></td>
                                                    </tr>
                                                    <tr id="priority_5_row">
                                                        <th scope="row">Priority 5 / ප්‍රමුඛතාව - 5 / முன்னுரிமை - 5</th>
                                                        <td><label id="view_priority5_center" name="view_priority5_center"></label></td>
                                                        <td><label id="view_priority5_course" name="view_priority5_course"></label></td>
                                                        <td><label id="view_priority5_time" name="view_priority5_time"></label></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!--Personal Details-->
                                            <div class="card card-info">
                                                <div class="card-header" style="background: #2ba672; color: white;">
                                                    <h3 class="card-title ">Personal Details / පුද්ගලික තොරතුරු / சொந்த விபரங்கள் </h3>
                                                </div>

                                                <div class="card-body mandatory">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label col-form-label-sm">Full Name<br>ශීර්ෂය<br>தலைப்பு</label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_fullname" name="view_fullname" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label col-form-label-sm">Name with intials<br>සම්පූර්ණ නම<br>முழு பெயர்</label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_initials_name" name="view_initials_name" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label col-form-label-sm">National Identity Card No<br>සහිත නම<br>முதல் எழுத்துக்களுடன் பெயர்</label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_nic" name="view_nic" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label col-form-label-sm">Date of Birth (DD/MM/YYYY)<br>උපන්දිනය<br>பிறந்த திகதி</label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_d_o_b" name="view_d_o_b" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Gender<br>ස්තී පුරුෂ භාවය<br>பால் </label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_gender" name="view_gender" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Contact Details-->
                                            <div class="card card-info">
                                                <div class="card-header " style="background: #2ba672; color: white;">
                                                    <h3 class="card-title ">Contact Details / ඇමතුම් විස්තර / தொடர்பு விபரங்கள்</h3>
                                                </div>

                                                <div class="card-body mandatory">
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Email Address / විද්යුත් තැපැල් ලිපිනය / மின்னஞ்சல் முகவரி</label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_email" name="view_email" class="col-sm col-form-label"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">phone no / දුරකතන අංකය / தொலைபேசி எண் </label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_phoneno" name="view_phoneno" class="col-sm col-form-label"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Land phone no / ස්ථිර දුරකථන අංකය / வீட்டுத் தொலைபேசி எண் </label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_landno" name="view_landno" class="col-sm col-form-label"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Address / ලිපිනය / முகவரி</label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_address" name="view_address" class="col-sm col-form-label"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">District / දිසා / மாவட்டம் </label>
                                                        <div class="col-sm">
                                                            <label for="" id="view_district" name="view_district" class="col-sm col-form-label"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--G.C.E A/L Examination-->
                                            <div class="card card-info">
                                                <div class="card-header " style="background: #2ba672; color: white;">
                                                    <h3 class="card-title ">G.C.E A/L Examination / අ.පො.ස (උසස් පෙළ)/ கல்விப் பொதுத் தராதரப் பத்திர(உயர்தர)ப் பரீட்சை</h3>
                                                </div>

                                                <div class="card-body mandatory">
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Academic Year / අධ්යන වර්ෂය / கல்வி ஆண்டு</label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_al_academic_year" name="view_al_academic_year" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Index No / විභාග අංකය / சுட்டெண் </label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_al_index_no" name="view_al_index_no" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">A/L General marks / උසස් පෙළ සාමාන්‍ය ලකුණු / A / L பொது மதிப்பெண்கள் </label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_al_general_marks" name="view_al_general_marks" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Z-Score / Z-අගය / Z-மதிப்பெண்  </label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_full_z_score" name="view_full_z_score" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">Stream / විෂය ධාරාව / பிரிவு</label>
                                                        <div class="col-sm-8">
                                                            <label for="" id="view_al_stream" name="view_al_stream" class="col-sm col-form-label col-form-label-sm"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                        <label for="" style="background-color: #f4f4f4" class="col-sm-4 col-form-label">A/L Subjects / උ.පෙ විෂයයන්  / உயர் தர பாடங்கள் </label><br>
                                                        <div class="col-sm">
                                                            <div class="row">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col"><label>Subjects / විෂයයන්  / பாடங்கள் </label></th>
                                                                            <th scope="col"><label>Grade / සාමාර්ථය / தரம் </label></th>
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
                                            </div>

                                            <!--G.C.E O/L Examination-->
                                            <div class="card card-info">
                                                <div class="card-header " style="background: #2ba672; color: white;">
                                                    <h3 class="card-title ">G.C.E O/L Examination / අ.පො.ස(සාමාන්‍ය පෙළ) / கல்விப் பொதுத் தராதரப் பத்திர (சாதாரண தர)ப் பரீட்சை</h3>
                                                </div>
                                                      
                                                <div class="card-body mandatory">
                                                    <div id="ol_box" name="ol_box">
                                                        <div id="view_aa">
                                                            <div class="form-group row" style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                <label for="" class="col-sm-4 col-form-label">Year / අවුරුදු / ஆண்டு</label>
                                                                <div class="col-sm-8">
                                                                    <label for="" id="view_ol_year" name="view_ol_year" class="col-sm col-form-label col-form-label-sm">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class='form-group row' style="border-width: 1px; border-bottom-color: #dedede; border-bottom-style: solid; margin-bottom: 0px;">
                                                                <label for='' class='col-sm-4 col-form-label'>Results / සාමාර්ථය / தரம் </label>
                                                                <div class='form-group col-md'>
                                                                    <table class='table'>
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope='col'><label>Mathematics / ගණිතය  / கணிதம் </label></th>
                                                                                <th scope='col'><label>English / ඉංග්රීසි / ஆங்கிலம் </label></th>
                                                                                <th scope='col'><label>Index No / විභාග අංකය / சுட்டெண் </label></th>
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
                                            </div>

                                        </div>



                                        <div class="modal-footer">
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
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="SubForm" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </section>
    </div>
    

    
</div>




<script>
    
    function view_open_modal(){
        var indexno = $('#indexno').val();
        var selection_type = $("input:radio[name=selection_type]:checked").val();
        var title = $('#title').val();
        var fullname = $('#fullname').val();
        var nic = $('#nic').val();
        var d_o_b = $('#d_o_b').val();
        var x;
        var y;
        var ph;
        var la;

        var address = $('#address').val();
        var phoneno = $('#phoneno').val();
        var landno = $('#landno').val();
        var district = $('#district').val();
        var email = $('#email').val();
        
        var al_academic_year = $('#al_academic_year').val();
        var al_index_no = $('#al_index_no').val();
        var al_general_marks = $('#al_general_marks').val();
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
        
        
        

        // if (indexno == "") {
        //     $('#indexno').removeClass("invalid").addClass("is-invalid");
        //     $.notify({
        //             // options
        //             message: 'Please Enter Indexno.'
        //         }, {
        //             // settings
        //             type: 'warning'
        //     });
        //     //document.getElementById("indexno").style.borderColor = "red";
        // } else {
        //     $("#indexno").on('keyup', function () {
        //         $('#indexno').addClass("is-valid");
        //         //document.getElementById("indexno").style.borderColor = "green";
        //     });
        // }
        
        if (title == "") {
            //document.getElementById("district").style.borderColor = "red";
            $('#title').removeClass("invalid").addClass("is-invalid");
            $.notify({
                    // options
                    message: 'Please Select Title.'
                }, {
                    // settings
                    type: 'warning'
            });

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
            $.notify({
                    // options
                    message: 'Please Enter Full Name.'
                }, {
                    // settings
                    type: 'warning'
            });

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
                $.notify({
                    // options
                    message: 'Please Enter Full in Proper Format.'
                }, {
                    // settings
                    type: 'warning'
                });
            }
        }

        if (nic === "" || d_o_b === "") {
            $("#nic").removeClass("is-valid").addClass("is-invalid");
            $("#d_o_b").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("nic").style.borderColor = "red";
            //document.getElementById("d_o_b").style.borderColor = "red";
            y = false;
            $.notify({
                    // options
                    message: 'Please Enter Your NIC in Proper Format.'
                }, {
                    // settings
                    type: 'warning'
            });
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
                                $("#d_o_b_hidden").val(birthday);
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
                                $.notify({
                                        // options
                                        message: 'Please Enter valid NIC No.'
                                    }, {
                                        // settings
                                        type: 'warning'
                                });
                            }
                        }
                    }, "json");

        }
        
        if (phoneno == "") {
            $("#phoneno").removeClass("is-valid").addClass("is-invalid");
            ph = false;
            $.notify({
                    // options
                    message: 'Please Enter Phone No.'
                }, {
                    // settings
                    type: 'warning'
            });
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
            $.notify({
                    // options
                    message: 'Please Enter Land Phone No.'
                }, {
                    // settings
                    type: 'warning'
            });
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
            $.notify({
                    // options
                    message: 'Please Enter Address.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#address").on('keyup', function () {
                $('#address').addClass("is-valid");
                //document.getElementById("indexno").style.borderColor = "green";
            });
        }

        if (district == "") {
            //document.getElementById("district").style.borderColor = "red";
            $('#district').removeClass("invalid").addClass("is-invalid");
            //document.getElementById("desig").style.color = "red";
            //document.getElementById("desig").innerHTML = 'District Required';
            $.notify({
                    // options
                    message: 'Please Select District Phone No.'
                }, {
                    // settings
                    type: 'warning'
            });

        } else {
            $("#district").change(function () {
                //document.getElementById("district").style.borderColor = "green";
                $('#district').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("desig").innerHTML = '';
            });
        }

        if (email == "") {
            //document.getElementById("email").style.borderColor = "red";
            $('#email').removeClass("is-valid").addClass("is-invalid");
            return false;
            $.notify({
                    // options
                    message: 'Please Enter Email Address.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#email").on('keyup', function () {
                //document.getElementById("email").style.borderColor = "green";
                $('#email').removeClass("is-invalid").addClass("is-valid");
            });
        }



        var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
        
        
        if (al_academic_year.length != 4) {
            $("#al_academic_year").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_academic_year").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Enter A/L Year.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#al_academic_year").on('keyup focusout', function () {
                $("#al_academic_year").removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (al_index_no == "") {
            $("#al_index_no").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_index_no").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Enter Index No.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#al_index_no").on('keyup focusout', function () {
                $("#al_index_no").removeClass("is-invalid").addClass("is-valid");
            });
        }

        if (z_score == "") {
            $("#z_score").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("z_score").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Enter Z-Score Address.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#z_score").on('keyup focusout', function () {
                $("#z_score").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("z_score").style.borderColor = "green";
            });
        }

        if (al_stream == "") {
            $("#al_stream").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_stream").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please A/L Select Stream.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#al_stream").on('change', function () {
                $("#al_stream").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_stream").style.borderColor = "green";
            });
        }

        if (al_subject1 == "") {
            $("#al_subject1").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject1").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Select A/L Subject 1.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#al_subject1").on('change', function () {
                $("#al_subject1").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject1").style.borderColor = "green";
            });
        }

        if (al_sub1_grade == "") {
            $("#al_sub1_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub1_grade").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Select A/L Grade 1.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#al_sub1_grade").on('change', function () {
                $("#al_sub1_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub1_grade").style.borderColor = "green";
            });
        }

        if (al_subject2 == "") {
            $("#al_subject2").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject2").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Select A/L Subject 2.'
                }, {
                    // settings
                    type: 'warning'
            });
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
                $.notify({
                    // options
                    message: 'Please Select A/L Grade 2.'
                }, {
                    // settings
                    type: 'warning'
                });
            });
        }

        if (al_subject3 == "") {
            $("#al_subject3").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_subject3").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Select A/L Subject 3.'
                }, {
                    // settings
                    type: 'warning'
                });
        } else {
            $("#al_subject3").on('change', function () {
                $("#al_subject3").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject3").style.borderColor = "green";
            });
        }

        if (al_sub3_grade == "") {
            $("#al_sub3_grade").removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("al_sub3_grade").style.borderColor = "red";
            $.notify({
                    // options
                    message: 'Please Select A/L Grade 3.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $("#al_sub3_grade").on('change', function () {
                $("#al_sub3_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub3_grade").style.borderColor = "green";
            });
        }
        
        var alsub4;
        var alsub4_grade;
        
        if ($('#subject4_row').css('display') !== 'none') {
            var al_subject4 = $('#al_subject4').val();
            var al_sub4_grade = $('#al_sub4_grade').val();
            
            if (al_subject4 == "") {
                $("#al_subject4").removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("al_subject4").style.borderColor = "red";
                alsub4 = false;
                $.notify({
                    // options
                    message: 'Please Select A/L Subject 4.'
                }, {
                    // settings
                    type: 'warning'
            });
            } else {
                $("#al_subject4").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_subject4").style.borderColor = "green";
                alsub4 = true;
            }

            if (al_sub4_grade == "") {
                $("#al_sub4_grade").removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("al_sub4_grade").style.borderColor = "red";
                alsub4_grade = false;
                $.notify({
                    // options
                    message: 'Please Select A/L Grade 4.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $("#al_sub4_grade").removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("al_sub4_grade").style.borderColor = "green";
                alsub4_grade = true;
            }
        }else{
            alsub4 = true;
            alsub4_grade = true;
        }
        
        var sat = $("input[name='ol_diff_year']:checked").val();
        var ol_english_year = $("#ol_english_year").val();
        var ol_english_index_no = $("#ol_english_index_no").val();
        var ol_maths_grade = $("#ol_maths_grade").val();
        var ol_english_grade = $("#ol_english_grade").val();
        var ol_year = $("#ol_year").val();
        var ol_index_no = $("#ol_index_no").val();
        
        var flag_ol_year;
        var flag_ol_english_year;
        var flag_ol_english_index_no;
        var flag_ol_maths_grade;
        var flag_ol_english_grade;
        var flag_ol_year;
        var flag_ol_index_no;
        
        
        if (sat == 1) {
            flag_ol_english_year = true;
            flag_ol_english_index_no = true;
            
            if (ol_year == "") {
                $('#ol_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_year").style.borderColor = "red";
                flag_ol_year = false;
                $.notify({
                    // options
                    message: 'Please Enter O/L Year.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                //$('#ol_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_year").style.borderColor = "green";

                $("#ol_year").on('keyup', function () {
                    $("#ol_year").removeClass("is-invalid").addClass("is-valid");
                });
                flag_ol_year = true;
            }

            if (ol_maths_grade == "") {
                $('#ol_maths_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_maths_grade").style.borderColor = "red";
                flag_ol_maths_grade = false;
                $.notify({
                    // options
                    message: 'Please Select O/L Mathematics Grade.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_maths_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_maths_grade").style.borderColor = "green";
                flag_ol_maths_grade = true;
            }

            if (ol_english_grade == "") {
                $('#ol_english_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_grade").style.borderColor = "red";
                flag_ol_english_grade = false;
                $.notify({
                    // options
                    message: 'Please Select O/L English Grade.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_english_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_grade").style.borderColor = "green";
                flag_ol_english_grade = true;
            }

            if (ol_index_no == "") {
                $('#ol_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_index_no").style.borderColor = "red";
                flag_ol_index_no = false;
                $.notify({
                    // options
                    message: 'Please Enter O/L Index No.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_index_no").style.borderColor = "green";
                flag_ol_index_no = true;
            }
        }else{
            if (ol_year == "") {
                $('#ol_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_year").style.borderColor = "red";
                flag_ol_year = false;
                $.notify({
                    // options
                    message: 'Please Select O/L Year.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_year").style.borderColor = "green";
                flag_ol_year = true;
            }

            if (ol_maths_grade == "") {
                $('#ol_maths_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_maths_grade").style.borderColor = "red";
                flag_ol_maths_grade == false;
                $.notify({
                    // options
                    message: 'Please Select O/L Math Grade.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_maths_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_maths_grade").style.borderColor = "green";
                flag_ol_maths_grade == true;
            }

            if (ol_english_grade == "") {
                $('#ol_english_grade').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_grade").style.borderColor = "red";
                flag_ol_english_grade = false;
                $.notify({
                    // options
                    message: 'Please Select O/L English Grade.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_english_grade').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_grade").style.borderColor = "green";
                flag_ol_english_grade = true;
            }

            if (ol_index_no == "") {
                $('#ol_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_index_no").style.borderColor = "red";
                flag_ol_index_no = false;
                $.notify({
                    // options
                    message: 'Please Select O/L Index No.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_index_no").style.borderColor = "green";
                flag_ol_index_no = true;
            }

            if (ol_english_year == "") {
                $('#ol_english_year').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_year").style.borderColor = "red";
                flag_ol_english_year = false;
                $.notify({
                    // options
                    message: 'Please Select O/L English Year.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_english_year').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_year").style.borderColor = "green";
                flag_ol_english_year = true;
            }

            if (ol_english_index_no == "") {
                $('#ol_english_index_no').removeClass("is-valid").addClass("is-invalid");
                //document.getElementById("ol_english_index_no").style.borderColor = "red";
                flag_ol_english_index_no = false;
                $.notify({
                    // options
                    message: 'Please Select O/L English Index No.'
                }, {
                    // settings
                    type: 'warning'
                });
            } else {
                $('#ol_english_index_no').removeClass("is-invalid").addClass("is-valid");
                //document.getElementById("ol_english_index_no").style.borderColor = "green";
                flag_ol_english_index_no = true;
            }
        }
        
        //var flag_ol_english_index_no;
        //var flag_ol_maths_grade;
        //var flag_ol_english_grade;
        //var flag_ol_year;
        //var flag_ol_index_no;
        
        var priority1_center = $('#priority1_center').val();
        var priority1_course = $('#priority1_course').val();
        var priority1_time = $('#priority1_time').val();

        var priority2_center = $('#priority2_center').val();
        var priority2_course = $('#priority2_course').val();
        var priority2_time = $('#priority2_time').val();

        var priority3_center = $('#priority3_center').val();
        var priority3_course = $('#priority3_course').val();
        var priority3_time = $('#priority3_time').val();

        var priority4_center = $('#priority4_center').val();
        var priority4_course = $('#priority4_course').val();
        var priority4_time = $('#priority4_time').val();

        var priority5_center = $('#priority5_center').val();
        var priority5_course = $('#priority5_course').val();
        var priority5_time = $('#priority5_time').val();
        
        var flag_priority1_center;
        var flag_priority1_course;
        var flag_priority1_time;
        
        var flag_priority2_center;
        var flag_priority2_course;
        var flag_priority2_time;
        
        var flag_priority3_center;
        var flag_priority3_course;
        var flag_priority3_time;

        var flag_priority4_center;
        var flag_priority4_course;
        var flag_priority4_time;

        var flag_priority5_center;
        var flag_priority5_course;
        var flag_priority5_time;
        
        if (priority1_center == "") {
            $('#priority1_center').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("priority1_center").style.borderColor = "red";
            flag_priority1_center = false;
            $.notify({
                    // options
                    message: 'Please Select Prioriority - 1 Center.'
                }, {
                    // settings
                    type: 'warning'
            });
        } else {
            $('#priority1_center').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("priority1_center").style.borderColor = "green";
            flag_priority1_center = true;
            
        }

        if (priority1_course == "") {
            $('#priority1_course').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("priority1_course").style.borderColor = "red";
            flag_priority1_course = false;
            $.notify({
                    // options
                    message: 'Please Select Prioriority - 1 Course.'
                }, {
                    // settings
                    type: 'warning'
            });
            
        } else {
            $('#priority1_course').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("priority1_course").style.borderColor = "green";
            flag_priority1_course = true;
        }

        if (priority1_time == "") {
            $('#priority1_time').removeClass("is-valid").addClass("is-invalid");
            //document.getElementById("priority1_time").style.borderColor = "red";
            flag_priority1_time = false;
            $.notify({
                    // options
                    message: 'Please Select Prioriority - 1 Time.'
                }, {
                    // settings
                    type: 'warning'
            });
            
        } else {
            $('#priority1_time').removeClass("is-invalid").addClass("is-valid");
            //document.getElementById("priority1_time").style.borderColor = "green";
            flag_priority1_time = true;
        }
        
        if (priority2_center !== "") {
//            document.getElementById("priority2_center").style.borderColor = "green";
//            document.getElementById("priority2_course").style.borderColor = "red";
//            document.getElementById("priority2_time").style.borderColor = "red";

            $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
            $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
            $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
            
            flag_priority2_center = true; 
            flag_priority2_course = false; 
            flag_priority2_time = false;
            
            // $.notify({
            //         message: 'Please Select Prioriority - 2 Course & Time.'
            //     }, {
            //         type: 'warning'
            // });

            if (priority2_course !== "") {
                $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
                $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
                
                flag_priority2_center = true; 
                flag_priority2_course = false; 
                flag_priority2_time = false;
                if (priority2_time === "") {
                    $.notify({
                        // options
                        message: 'Please Select Prioriority - 2 Course & Time.'
                    }, {
                        // settings
                        type: 'warning'
                    });
                }


                if (priority2_time !== "") {
                    $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_time').removeClass("is-invalid").addClass("is-valid");
                    
                    flag_priority2_center = true; 
                    flag_priority2_course = true; 
                    flag_priority2_time = true; 

                } else {
                    $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
                    $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
                    
                    flag_priority2_center = true; 
                    flag_priority2_course = true; 
                    flag_priority2_time = false; 
                    // $.notify({
                    //     // options
                    //     message: 'Please Select Prioriority - 2 Time.'
                    // }, {
                    //     // settings
                    //     type: 'warning'
                    // });
                }

            } else {
                $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority2_course').removeClass("is-valid").addClass("is-invalid");
                $('#priority2_time').removeClass("is-valid").addClass("is-invalid");
                
                flag_priority2_center = true; 
                flag_priority2_course = false; 
                flag_priority2_time = false; 
                
                $.notify({
                        // options
                        message: 'Please Select Prioriority - 2 Couse & Time.'
                    }, {
                        // settings
                        type: 'warning'
                });
            }



            if (priority3_center !== "") {
//                document.getElementById("priority3_center").style.borderColor = "green";
//                document.getElementById("priority3_course").style.borderColor = "red";
//                document.getElementById("priority3_time").style.borderColor = "red";

                $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority3_course').removeClass("is-valid").addClass("is-invalid");
                $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                
                flag_priority3_center = true; 
                flag_priority3_course = false; 
                flag_priority3_time = false;

                if (priority3_course !== "") {
                    $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority3_course').removeClass("is-valid").addClass("is-valid");
                    $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                    
                    flag_priority3_center = true; 
                    flag_priority3_course = true; 
                    flag_priority3_time = false; 

                    if (priority3_time == "") {
                        $.notify({
                            // options
                            message: 'Please Select Prioriority - 3 Time.'
                        }, {
                            // settings
                            type: 'warning'
                        });
                    }


                    if (priority3_time !== "") {
                        $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_time').removeClass("is-invalid").addClass("is-valid");
                        
                        flag_priority3_center = true; 
                        flag_priority3_course = true; 
                        flag_priority3_time = true; 
                    } else {
                        $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                        $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                        
                        flag_priority3_center = true; 
                        flag_priority3_course = true; 
                        flag_priority3_time = false;
                    }

                } else {
                    $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                    $('#priority3_course').removeClass("is-invalid").addClass("is-invalid");
                    $('#priority3_time').removeClass("is-valid").addClass("is-invalid");
                    
                    flag_priority3_center = true; 
                    flag_priority3_course = false; 
                    flag_priority3_time = false;
                }


                
            } else {
//                document.getElementById("priority3_center").style.borderColor = "green";
//                document.getElementById("priority3_course").style.borderColor = "green";
//                document.getElementById("priority3_time").style.borderColor = "green";

                $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
                $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
                $('#priority3_time').removeClass("is-invalid").addClass("is-valid");
                
                flag_priority3_center = true; 
                flag_priority3_course = true; 
                flag_priority3_time = true;


                
            }
        } else {
//            document.getElementById("priority2_center").style.borderColor = "green";
//            document.getElementById("priority2_course").style.borderColor = "green";
//            document.getElementById("priority2_time").style.borderColor = "green";

            $('#priority2_center').removeClass("is-invalid").addClass("is-valid");
            $('#priority2_course').removeClass("is-invalid").addClass("is-valid");
            $('#priority2_time').removeClass("is-invalid").addClass("is-valid");
            
            flag_priority2_center = true; 
            flag_priority2_course = true; 
            flag_priority2_time = true;

//            document.getElementById("priority3_center").style.borderColor = "green";
//            document.getElementById("priority3_course").style.borderColor = "green";
//            document.getElementById("priority3_time").style.borderColor = "green";

            $('#priority3_center').removeClass("is-invalid").addClass("is-valid");
            $('#priority3_course').removeClass("is-invalid").addClass("is-valid");
            $('#priority3_time').removeClass("is-invalid").addClass("is-valid");
            
            flag_priority3_center = true; 
            flag_priority3_course = true; 
            flag_priority3_time = true;

            
        }
        
        
        
        if (x !== false && y !== false && title !== "" && email !== "" && email.match(reEmail) && phoneno !== "" && phoneno.match(phonenoregex) && landno !== "" && landno.match(landnoregex) && district !== "" && address !== "" &&al_academic_year !== "" && al_index_no !== "" && z_score !== "" && al_stream !== "" && al_subject1 !== "" && al_subject2 !== "" && al_subject3 !== "" && al_sub1_grade !== "" && al_sub2_grade !== "" && al_sub3_grade !== "" && alsub4 !== false && alsub4_grade !== false &&
            flag_ol_year !== false && flag_ol_english_year !== false && flag_ol_english_index_no !== false && flag_ol_maths_grade !==  false && flag_ol_english_grade !==  false && flag_ol_year !== false && flag_ol_index_no !== false &&
            flag_priority1_center !== false && flag_priority2_center !== false && flag_priority3_center !== false &&
            flag_priority1_course !== false && flag_priority2_course !== false && flag_priority3_course !== false &&
            flag_priority1_time !== false && flag_priority2_time !== false && flag_priority3_time !== false){
        
        
            var indexno = $('#indexno').val();
            var selection_type = $("input:radio[name=selection_type]:checked").val();
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
            var al_general_marks = $('#al_general_marks').val();
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

            var priority4_center = $('#priority4_center').find('option:selected').attr("name");
            var priority4_course = $('#priority4_course').find('option:selected').attr("name");
            var priority4_time = $('#priority4_time').find('option:selected').attr("name");

            var priority5_center = $('#priority5_center').find('option:selected').attr("name");
            var priority5_course = $('#priority5_course').find('option:selected').attr("name");
            var priority5_time = $('#priority5_time').find('option:selected').attr("name");
            
            
            $('#view_indexno').html(indexno);
            $('#view_selection_type').html(selection_type);
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
            $('#view_al_general_marks').html(al_general_marks);
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

            if (priority4_center == "") {
                $('#view_priority4_center').html("N/A");
                $('#view_priority4_course').html("N/A");
                $('#view_priority4_time').html("N/A");
            } else {
                $('#view_priority4_center').html(priority4_center);
                $('#view_priority4_course').html(priority4_course);
                $('#view_priority4_time').html(priority4_time);
            }

            if (priority4_center == "") {
                $('#view_priority5_center').html("N/A");
                $('#view_priority5_course').html("N/A");
                $('#view_priority5_time').html("N/A");
            } else {
                $('#view_priority5_center').html(priority5_center);
                $('#view_priority5_course').html(priority5_course);
                $('#view_priority5_time').html(priority5_time);
            }
        
            $('#exampleModal').modal('show'); 
        }
    }
    
    function show() {

    }

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
                        $('#d_o_b_hidden').val('');
                        $('.nic-gender').html('');
                        var nicNumber = $('.nic-validate').val();
                        if (validation(nicNumber)) {
                            console.log(nicNumber);
                            var extracttedData = extractData(nicNumber);
                            var days = extracttedData.dayList;
                            var findedData = findDayANDGender(days);

                            var month = findedData.month;
                            var year = extracttedData.year;
                            var day = findedData.day;
                            var gender = findedData.gender;
                            var bday = day + '-' + month + '-' + year;
                            var birthday = new Date(bday.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
                            var birthday = getFormattedDate(birthday);
                            $('#d_o_b').val(birthday);
                            $('#d_o_b_hidden').val(birthday);
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

    $(document).ready(function () {
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
        
        $("#confirm").attr("disabled", true);
        // $("#indexno").on('keyup', function () {
        //     var indexno = $('#indexno').val();
        //     if (indexno == "") {
        //         $('#indexno').removeClass("is-valid").addClass("is-invalid");
        //     } else {
        //         $('#indexno').removeClass("is-invalid").addClass("is-valid");
        //     }
        // });
        
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
        
        
        
        $('#subject4_row').hide();
        $('#view_page').hide();
        $('#confirm').attr("disabled", true);

        //-----Same Subject Validation---http://jsfiddle.net/z4rknhg2/----//
//        var backups = {};
//        $("select[id^=al_subject]").change(function () {
//            var v = $(this).val();
//            var f = false;
//            $("select[id^=al_subject]").not(this).each(function () {
//                if ($(this).val() == v) {
//                    f = true;
//                    return;
//                }
//            });
//            if (f) {
//                $(this).val(backups[$(this).attr("id")]);
//                alert("You can't Choose the Same Subject");
//            } else {
//                backups[$(this).attr("id")] = v;
//            }
//        }).val(null);
        //-----End Same Subject Validation----//
    });


    

    function ol_section() {
        var type_year = $("input[name='ol_diff_year']:checked").val();

        if (type_year == 1) {
            $("#bb").empty();
            $("#aa").append("<div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label'>Year<br>අවුරුදු<br>ஆண்டு</label>\n\
                                <div class='col-sm'>\n\
                                    <input type='text' class='form-control border-radius' id='ol_year' name='ol_year' placeholder='' data-validation=''>\n\
                                </div>\n\
                            </div>\n\
                            <div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label'>Results<br>ප්රතිපල<br>முடிவுகள் </label>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label'>Mathematics<br>ගණිතය<br>கணிதம் </label>\n\
                                    <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius' placeholder='.col-3' data-validation='required'>\n\
                                        <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                    <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                    </select>\n\
                                </div>\n\
                                <div class='form-group col-md'>\n\
                                    <label for='' class='col-sm col-form-label'>English<br>ඉංග්රීසි<br>ஆங்கிலம் </label>\n\
                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius' placeholder='.col-3' data-validation='required'>\n\
                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                        <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option>\n\
<?php endforeach; ?>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class='form-group col-md'>\n\
                                        <label for='' class='col-sm col-form-label'>Index No<br>විභාග අංකය<br>சுட்டெண் </label>\n\
                                        <input type='text' class='form-control border-radius' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required'>\n\
                                    </div>\n\
                                </div>");
        } else {
            $("#aa").empty();
            $("#bb").append("<div class='form-group row'>\n\
                                <label for='' class='col-sm-3 col-form-label'>Results<br>ප්රතිපල<br>முடிவுகள் </label>\n\
                                    <div class='col-sm'>\n\
                                        <div class='row'>\n\
                                            <div class='col-sm'>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label'>Mathematics<br>ගණිතය<br>கணிதம் </label>\n\
                                                        <select type='text' id='ol_maths_grade' name='ol_maths_grade' class='form-control border-radius' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label'>Year<br>අවුරුදු<br>ஆண்டு</label>\n\
                                                        <input type='text' class='form-control border-radius' id='ol_year' name='ol_year' placeholder='' data-validation='required'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label'>Index No<br>විභාග අංකය<br>சுட்டெண் </label>\n\
                                                        <input type='text' class='form-control border-radius' id='ol_index_no' name='ol_index_no' placeholder='' data-validation='required'>\n\
                                                    </div>\n\
                                                </div><br>\n\
                                                <div class='row'>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label'>English<br>ඉංග්රීසි<br>ஆங்கிலம் </label>\n\
                                                        <select type='text' id='ol_english_grade' name='ol_english_grade' class='form-control border-radius' placeholder='.col-3' data-validation='required'>\n\
                                                            <option value=''>-Grade-</option><?php foreach ($ol_grade as $row): ?>\n\
                                                                                                                                                                                                                                                                <option name='<?php echo $row["grade"]; ?>' value='<?php echo $row["grade_id"]; ?>'><?php echo $row["grade"]; ?></option><?php endforeach; ?>\n\
                                                    </select>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label'>Year<br>අවුරුදු<br>ஆண்டு</label>\n\
                                                        <input type='text' class='form-control border-radius' id='ol_english_year' name='ol_english_year' placeholder='' data-validation='required'>\n\
                                                    </div>\n\
                                                    <div class='col'>\n\
                                                        <label for='' class='col-sm col-form-label'>Index No<br>විභාග අංකය<br>சுட்டெண் </label>\n\
                                                        <input type='text' class='form-control border-radius' id='ol_english_index_no' name='ol_english_index_no' placeholder='' data-validation='required'>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                 </div>");
        }
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

//    function alStreamLoadValidation(e) {
//        var al_stream = $('#al_stream').val();
//
//        var alsub1 = $('#al_subject1').val();
//        var alsub2 = $('#al_subject2').val();
//        var alsub3 = $('#al_subject3').val();
//        var alsub4 = $('#al_subject4').val();
//
//        if (al_stream != "") {
//            if (alsub1 == "" && alsub2 == "" && alsub3 == "" && alsub4 == "") {
//                $('#select_subject_alert').text('(*Please Select All Stream Subjects)');
//                $('#save_btn').attr('disabled', false);
//                e.preventDefault();
//            } else {
//                $('#select_subject_alert').text('');
//            }
//        } else {
//            $('#select_subject_alert').text('');
//        }
//    }

    function subject_grade_validation(e) {
        var alsub1 = $('#al_subject1').val();
        var alsub2 = $('#al_subject2').val();
        var alsub3 = $('#al_subject3').val();
        var alsub4 = $('#al_subject4').val();

        var alsub1G = $('#al_sub1_grade').val();
        var alsub2G = $('#al_sub2_grade').val();
        var alsub3G = $('#al_sub3_grade').val();
        var alsub4G = $('#al_sub4_grade').val();

        if (alsub1 != "" && alsub1G == "") {
            $('#demo1').text('Select A/L Grade');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else if (alsub1 == "" && alsub1G != "") {
            $('#demo1').text('You cant select grade without selecting subject');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else {
            $('#demo1').text('');
        }

        if (alsub2 != "" && alsub2G == "") {
            $('#demo2').text('Select A/L Grade');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else if (alsub2 == "" && alsub2G != "") {
            $('#demo2').text('You cant select grade without selecting subject');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else {
            $('#demo2').text('');
        }

        if (alsub3 != "" && alsub3G == "") {
            $('#demo3').text('Select A/L Grade');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else if (alsub3 == "" && alsub3G != "") {
            $('#demo3').text('You cant select grade without selecting subject');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else {
            $('#demo3').text('');
        }

        if (alsub4 != "" && alsub4G == "") {
            $('#demo4').text('Select A/L Grade');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else if (alsub4 == "" && alsub4G != "") {
            $('#demo4').text('You cant select grade without selecting subject');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        } else {
            $('#demo4').text('');
        }
    }

    function validate_al_subjects(e) {
        var sub1 = $('#al_subject1').val();
        var sub2 = $('#al_subject2').val();
        var sub3 = $('#al_subject3').val();
        var sub4 = $('#al_subject4').val();
        //alert(sub1 + "-" + sub2 + "-" + sub3 + "-" + sub4);
        if (sub1 != "" || sub2 != "" || sub3 != "" || sub4 != "") {
            if (sub1 == sub2 || sub1 == sub3 || sub1 == sub4 || sub2 == sub1 || sub2 == sub3 || sub1 == sub4 || sub3 == sub1 || sub3 == sub2 || sub3 == sub4 || sub4 == sub1 || sub4 == sub2 || sub4 == sub3) {
                alert('Same subject has been selected one or more !');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            } else {
                $('#lbl_al_subjects').text('');
            }
        }
    }





    function priority1_get_courses(center_id, flag, course_id) {
        $('#priority1_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority1_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        var selectionType = $("input:radio[name=selection_type]:checked").val();



        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list_for_student_registration') ?>", {
                'center_id': center_id,
                'selectionType' : selectionType
            },
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#priority1_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                }

                var priority2_course_selected = $('#priority2_course').val();
                var priority2_center_selected = $('#priority2_center').val();

                var priority3_course_selected = $('#priority3_course').val();
                var priority3_center_selected = $('#priority3_center').val();

                var priority4_course_selected = $('#priority4_course').val();
                var priority4_center_selected = $('#priority4_center').val();

                var priority5_course_selected = $('#priority5_course').val();
                var priority5_center_selected = $('#priority5_center').val();

                if (center_id === priority2_center_selected) {
                    $("#priority1_course option[value= "+priority2_course_selected+"]").remove();
                }
                if (center_id === priority3_center_selected) {
                    $("#priority1_course option[value= "+priority3_course_selected+"]").remove();
                }
                if (center_id === priority4_center_selected) {
                    $("#priority1_course option[value= "+priority4_course_selected+"]").remove();
                }
                if (center_id === priority5_center_selected) {
                    $("#priority1_course option[value= "+priority5_course_selected+"]").remove();
                }
            },
            "json"
            );
        }
    }

    function priority2_get_courses(center_id, flag, course_id) {
        $('#priority2_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority2_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        var selectionType = $("input:radio[name=selection_type]:checked").val();

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list_for_student_registration') ?>", {
                'center_id': center_id,
                'selectionType' : selectionType
            },
                    function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#priority2_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }

                        var priority1_course_selected = $('#priority1_course').val();
                        var priority1_center_selected = $('#priority1_center').val();

                        var priority3_course_selected = $('#priority3_course').val();
                        var priority3_center_selected = $('#priority3_center').val();

                        var priority4_course_selected = $('#priority4_course').val();
                        var priority4_center_selected = $('#priority4_center').val();

                        var priority5_course_selected = $('#priority5_course').val();
                        var priority5_center_selected = $('#priority5_center').val();

                        if (center_id === priority1_center_selected) {
                            $("#priority2_course option[value= "+priority1_course_selected+"]").remove();
                        }
                        if (center_id === priority3_center_selected) {
                            $("#priority2_course option[value= "+priority3_course_selected+"]").remove();
                        }
                        if (center_id === priority4_center_selected) {
                            $("#priority2_course option[value= "+priority4_course_selected+"]").remove();
                        }
                        if (center_id === priority5_center_selected) {
                            $("#priority2_course option[value= "+priority5_course_selected+"]").remove();
                        }
                    },
                    "json"
                    );
        }
    }

    function priority3_get_courses(center_id, flag, course_id) {
        $('#priority3_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority3_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        var selectionType = $("input:radio[name=selection_type]:checked").val();

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list_for_student_registration') ?>", {
                'center_id': center_id,
                'selectionType' : selectionType
            },
                    function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#priority3_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }

                        var priority1_course_selected = $('#priority1_course').val();
                        var priority1_center_selected = $('#priority1_center').val();

                        var priority2_course_selected = $('#priority2_course').val();
                        var priority2_center_selected = $('#priority2_center').val();

                        var priority4_course_selected = $('#priority4_course').val();
                        var priority4_center_selected = $('#priority4_center').val();

                        var priority5_course_selected = $('#priority5_course').val();
                        var priority5_center_selected = $('#priority5_center').val();

                        if (center_id === priority1_center_selected) {
                            $("#priority3_course option[value= "+priority1_course_selected+"]").remove();
                        }
                        if (center_id === priority2_center_selected) {
                            $("#priority3_course option[value= "+priority2_course_selected+"]").remove();
                        }
                        if (center_id === priority4_center_selected) {
                            $("#priority3_course option[value= "+priority4_course_selected+"]").remove();
                        }
                        if (center_id === priority5_center_selected) {
                            $("#priority3_course option[value= "+priority5_course_selected+"]").remove();
                        }
                    },
                    "json"
                    );
        }
    }


    function priority4_get_courses(center_id, flag, course_id) {
        $('#priority4_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority4_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        var selectionType = $("input:radio[name=selection_type]:checked").val();

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list_for_student_registration') ?>", {
                    'center_id': center_id,
                    'selectionType' : selectionType
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#priority4_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }

                    var priority1_course_selected = $('#priority1_course').val();
                    var priority1_center_selected = $('#priority1_center').val();

                    var priority2_course_selected = $('#priority2_course').val();
                    var priority2_center_selected = $('#priority2_center').val();

                    var priority3_course_selected = $('#priority3_course').val();
                    var priority3_center_selected = $('#priority3_center').val();

                    var priority5_course_selected = $('#priority5_course').val();
                    var priority5_center_selected = $('#priority5_center').val();

                    if (center_id === priority1_center_selected) {
                        $("#priority4_course option[value= "+priority1_course_selected+"]").remove();
                    }
                    if (center_id === priority2_center_selected) {
                        $("#priority4_course option[value= "+priority2_course_selected+"]").remove();
                    }

                    if (center_id === priority3_center_selected) {
                        $("#priority4_course option[value= "+priority3_course_selected+"]").remove();
                    }

                    if (center_id === priority5_center_selected) {
                        $("#priority4_course option[value= "+priority5_course_selected+"]").remove();
                    }
                },
                "json"
            );
        }
    }

    function priority5_get_courses(center_id, flag, course_id) {
        $('#priority5_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');
        $('#priority5_time').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

        var selectionType = $("input:radio[name=selection_type]:checked").val();

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list_for_student_registration') ?>", {
                    'center_id': center_id,
                    'selectionType' : selectionType
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#priority5_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }

                    var priority1_course_selected = $('#priority1_course').val();
                    var priority1_center_selected = $('#priority1_center').val();

                    var priority2_course_selected = $('#priority2_course').val();
                    var priority2_center_selected = $('#priority2_center').val();

                    var priority3_course_selected = $('#priority3_course').val();
                    var priority3_center_selected = $('#priority3_center').val();

                    var priority4_course_selected = $('#priority4_course').val();
                    var priority4_center_selected = $('#priority4_center').val();

                    if (center_id === priority1_center_selected) {
                        $("#priority5_course option[value= "+priority1_course_selected+"]").remove();
                    }
                    if (center_id === priority2_center_selected) {
                        $("#priority5_course option[value= "+priority2_course_selected+"]").remove();
                    }
                    if (center_id === priority3_center_selected) {
                        $("#priority5_course option[value= "+priority3_course_selected+"]").remove();
                    }
                    if (center_id === priority4_center_selected) {
                        $("#priority5_course option[value= "+priority4_course_selected+"]").remove();
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

    function priority4_load_time() {
        $('#priority4_time').empty();

        var x = $('#priority4_course').val();


        if (x == "" || x == 0) {
            $('#priority4_time').find('option').remove().end().append('<option value="" name="">---Select Time---</option>').val('');
        } else {
            $('#priority4_time').append('<option value="" name="">Select Time</option>');
            $('#priority4_time').append('<option value="1" name="full">Full Time</option>');
            $('#priority4_time').append('<option value="2" name="part">Part Time</option>');
        }
    }

    function priority5_load_time() {
        $('#priority5_time').empty();

        var x = $('#priority5_course').val();


        if (x == "" || x == 0) {
            $('#priority5_time').find('option').remove().end().append('<option value="" name="">---Select Time---</option>').val('');
        } else {
            $('#priority5_time').append('<option value="" name="">Select Time</option>');
            $('#priority5_time').append('<option value="1" name="full">Full Time</option>');
            $('#priority5_time').append('<option value="2" name="part">Part Time</option>');
        }
    }



    function add_row() {
        $("#al_subject4").val("");
        $("#al_sub4_grade").val("");
        $("#subject4_row").show();
        $("#add_section").hide();
        //        $("#subject4_row").empty();
        //        $("#subject4_row").append("<div class='col'>\n\
        //                                        <label for='' class='col-sm col-form-label'>Subject 4</label>\n\
        //                                        <select type='text' class='form-control form-control-sm' placeholder='.col-3' id='al_subject4' name='al_subject4' onchange='subject_grade_validation();validate_al_subjects();alStreamLoadValidation();'>\n\
        //                                            <option value=''>--Select Subject--</option>\n\
        //                                        </select>\n\
        //                                    </div>\n\
        //                                    <div class='col'>\n\
        //                                        <label for='' class='col-sm col-form-label'>Grade 4</label>\n\
        //                                        <select type='text' id='al_subject4_grade' name='al_subject4_grade' class='form-control form-control-sm' placeholder='.col-3' onchange='subject_grade_validation();'>\n\
        //                                            <option value=''>-Grade-</option><?php //foreach ($al_grade as $row):                                       ?>\n\
        //                                                <option value='<?php //echo $row["grade_id"];                                       ?>'> <?php //echo $row["grade"];                                       ?> </option> <?php //endforeach;                                       ?>\n\
        //                                        </select>\n\
        //                                        <p id='demo4' style='color: red'></p>\n\
        //                                    </div>\n\
        //                                    <div class='col'>\n\
        //                                        <button type='button' id='delete_section' name='delete_section' onclick='delete_row();'  class='btn btn-primary btn-sm'>-</button>\n\
        //                                    </div>");
    }

    function delete_row() {
        $("#al_subject4").val("");
        $("#al_sub4_grade").val("");

        $("#subject4_row").hide();
        $("#add_section").show();
    }


    ///////////////////////Full Name Validation/////////////////////////////////
    $.validator.addMethod("fullname_validation", function (value, element) {
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
            };
            document.getElementById("initials_name").value = getInitials(name) + " " + iname;
            return true;
        } else {
            document.getElementById("initials_name").value = "";
            return false;

        }
    }, "Please Enter Full Name in Proper Format");
    ///////////////////////End Full Name Validation/////////////////////////////////


    /////////////////////NIC Validation///////////////////////////////////////


    function findDayANDGender(days) {
        var dayList = days;
        var month = '';
        var result = {
            day: '',
            month: '',
            gender: ''
        };

        var d_array = [
            {
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

//    $.validator.addMethod("nic_validation", function (value, element) {
//        $('.nic-validate-error').html('');
//        $('#d_o_b').val('');
//        $('.nic-gender').html('');
//        var nicNumber = $('.nic-validate').val();
//        if (validation(nicNumber)) {
//            console.log(nicNumber);
//            var extracttedData = extractData(nicNumber);
//            var days = extracttedData.dayList;
//            var findedData = findDayANDGender(days, d_array);
//
//            var month = findedData.month;
//            var year = extracttedData.year;
//            var day = findedData.day;
//            var gender = findedData.gender;
//            var bday = day + '-' + month + '-' + year;
//            var birthday = new Date(bday.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
//            var birthday = getFormattedDate(birthday);
//            $('#d_o_b').val(birthday);
//            $('.nic-gender').html(gender);
//
//            if (findedData.gender == "Male") {
//                $("#male").prop("checked", true);
//            } else {
//                $("#female").prop("checked", true);
//            }
//            return true;
//
//        } else {
//            return false;
//        }
//    }, "Please enter your NIC no in proper format");

    /////////////////////End NIC Validation///////////////////////////////////////


    ////////////////////////////////////////////////////////////

//    $.validator.addMethod("select_course_validation", function (value, element) {
//        var center1 = $('#priority1_center').val();
//        var course1 = $('#priority1_course').val();
//        var time1 = $('#priority1_time').val();
//
//        var center2 = $('#priority2_center').val();
//        var course2 = $('#priority2_course').val();
//        var time2 = $('#priority2_time').val();
//
//        var center3 = $('#priority3_center').val();
//        var course3 = $('#priority3_course').val();
//        var time3 = $('#priority3_time').val();
//
//
//
//        //    if(center2 = 0 || center2 == ""){
//        //        if(center2 != 0 || center2 !== ""){
//        //            if(time2 != 0 || time2 !== ""){
//        //                return true;
//        //            }else{
//        //                return false;
//        //            }
//        //        }else{
//        //            return false;
//        //        }
//        //    }else{
//        //        
//        //    }
//    }, "Please Enter Full Name in Proper Format");

    /////////////////////Select Course Validation///////////////////////////////////////




    $(document).ready(function () {


        


    });


    function back() {
        $('#agreement_box').show();
        $("#exampleCheck1").prop("checked", false);
        $('#confirm').attr("disabled", true);
        $('#reg_page').show();
        $('#view_page').hide();
    }

    function view_section() {
        var ol_diff_year = $("input[name='ol_diff_year']:checked").val();
        if (ol_diff_year == 1) {
            $("#view_aa").empty();
            $("#view_aa").append("<div class='form-group row'>\n\
                                        <label for='' class='col-sm-4 col-form-label'>Year</label>\n\
                                        <div class='col-sm-8'>\n\
                                            <label for='' id='view_ol_year' name='view_ol_year' class='col-sm col-form-label col-form-label-sm'>\n\
                                            </label>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class='form-group row'>\n\
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
            $("#view_aa").append("<div class='form-group row'>\n\
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

</script>

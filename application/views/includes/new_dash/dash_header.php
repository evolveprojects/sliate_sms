<!doctype html>
<html lang="en">

    <?php
        if (!isset($_SESSION['u_id'])) 
        {
            redirect('login');
        } 

        global $authbranch;
        $authbranch = $this->auth->get_accessbranch();
        global $branchdrop;
        $branchdrop = array(''=>'');
        foreach ($authbranch as $aubr) 
        {
            $br_details = $this->db->get_where('cfg_branch',array('br_id'=>$aubr))->row_array();
            $branchdrop[$br_details['br_id']] = $br_details['br_code'].' - '.$br_details['br_name'];
        }

        global $selectedbr;
        $selectedbr = null;
        if(count($authbranch) == 1)
        {
            $selectedbr = $authbranch[0];
        }

        global $authfaculty;
        $authfaculty = $this->auth->get_accessfaculties();

        global $facultydrop;
        $facultydrop = array(''=>'');

        foreach ($authfaculty as $aufac) 
        {
            $fac_details = $this->db->get_where('edu_faculty',array('id'=>$aufac))->row_array();

            $facultydrop[$fac_details['id']] = $fac_details['faculty_code'].' - '.$fac_details['faculty_name'];
        }

        global $selectedfac;
        $selectedfac = null;
        if(count($authfaculty) == 1)
        {
            $selectedfac = $authfaculty[0];
        }
    ?>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="<?php //echo base_url('assets/AdminLTE-3.0.0/bootstrap-4.3.1-dist/css/bootstrap.min.css')           ?>" >-->

        <!-- FontAwesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/fontawesome-free/css/all.min.css') ?>" >

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        <!-- AdminLTE Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/dist/css/adminlte.min.css') ?>">

        <!-- Sliate Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/dist/css/theme.css') ?>">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
              rel="stylesheet" type="text/css" />

        <!-- Datatable -->
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">

        <!-- Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url('new_assets/assets/resources/css/style.css') ?>" >
        
        <!-- Datepicker CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
        
        <style>
            .error{
                color: #dc3545;
            }
            .border-radius{
                border-radius: 0;
            }
        </style>

        <style>.navbar-nav li:hover > ul.dropdown-menu {
                display: block;
            }
            .dropdown-submenu {
                position:relative;
            }
            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top:-6px;
            }

            /* rotate caret on hover */
            .dropdown-menu > li > a:hover:after {
                text-decoration: underline;
                transform: rotate(-90deg);
            } 
        </style>
        <!-- jQuery -->
        <!--<script src="<?php // echo base_url('new_assets/assets/resources/js/jquery-3.3.1.slim.min.js') ?>" ></script>-->
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/jquery/jquery.min.js') ?>" ></script>

        <!-- jQuery-validator JS -->
        <script src="<?php echo base_url('new_assets/assets/vendors/js/jquery-validation-1.19.1/dist/jquery.validate.min.js') ?>" ></script>
        <script src="<?php echo base_url('new_assets/assets/vendors/js/jquery-validation-1.19.1/dist/additional-methods.min.js') ?>" ></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js" ></script>-->

        <!-- form-validator JS -->
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>-->

        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/moment/moment.min.js') ?>" ></script>
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/inputmask/min/jquery.inputmask.bundle.min.js') ?>" ></script>
                <!--<script src="<?php // echo base_url('assets/vendors/js/jquery.form-validator.min.js')               ?>" ></script>-->
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

        <!-- bs-custom-file-input -->
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/dist/js/adminlte.min.js') ?>"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/dist/js/demo.js') ?>"></script>

        <!-- Popper JS -->
        <script src="<?php echo base_url('new_assets/assets/vendors/js/popper.min.js') ?>" ></script>
        <!-- DataTables -->
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('new_assets/assets/AdminLTE-3.0.0/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
        
        <!-- Notify JS -->
        <script src="<?php echo base_url('new_assets/assets/vendors/css/bootstrap-notify-master/bootstrap-notify.min.js') ?>"></script>
        
        <!-- Datepicker JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <title>Online Registration</title>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 0px;">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block dropdown">
                        <a href="index3.html" class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Approvals</a>
                        <ul class="dropdown-menu border-radius" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo base_url('App/app_approvals') ?>">Approval Students</a></li>
                            <li><a class="dropdown-item" href="#">Rejected Students</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/search_students') ?>">Search Students</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/process_selection_students_view') ?>">Process of Selection</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('Aptitude_test/aptitude_test_marks') ?>">Aptitude Test Marks</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                        <ul class="dropdown-menu border-radius" aria-labelledby="navbarDropdownMenuLink1">
                            <li><a class="dropdown-item" href="#">Approval Students</a></li>
                            <li><a class="dropdown-item" href="#">Rejected Students</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configurations</a>
                        <ul class="dropdown-menu border-radius" aria-labelledby="navbarDropdownMenuLink1">
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_capacity_view') ?>">Set Capacity</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_selectiion_process_view') ?>">Set Selection Process</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_selection_z_score_view') ?>">Set Z-Score Selection</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_selection_exam_marks_view') ?>">Set Exam Mark</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_selection_stream_percentage_view') ?>">Set Stream Percentage</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_selection_priority_view') ?>">Set Priority</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_selection_year_view') ?>">Set Year</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('App/set_student_registration_year_view') ?>">Set Student registration year</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Master</a>
                        <ul class="dropdown-menu border-radius" aria-labelledby="navbarDropdownMenuLink1">
                            <li><a class="dropdown-item" href="<?php echo base_url('App/centers') ?>">Center</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('master/courses') ?>">Course</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('master/center_courses') ?>">Center Course</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                        <ul class="dropdown-menu border-radius" aria-labelledby="navbarDropdownMenuLink1">
                            <li><a class="dropdown-item" href="<?php echo base_url('settings/users') ?>">Uses</a></li>
                        </ul>
                    </li>
                </ul>



                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bars"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo base_url('App/logout'); ?>" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                            </a>
                            <div class="dropdown-divider"></div>
                            
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="min-height: 253px;margin-left: 0px;" >




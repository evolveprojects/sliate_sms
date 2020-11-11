<!DOCTYPE html>
<html lang="en-US">
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
        <meta charset="UTF-8">   
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="shortcut icon" href="<?php echo base_url('img/sliate_logo.jpg') ?>"><!-- fav ico -->

        <title><?php echo "SMS :: " . $title; ?></title>

        <!-- Bootstrap CSS -->    
        <link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="<?php echo base_url('css/bootstrap-theme.css') ?>" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="<?php echo base_url('css/elegant-icons-style.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('css/font-awesome.min.css') ?>" rel="stylesheet" />    
        <!-- full calendar css-->
        <link href="<?php echo base_url('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/fullcalendar/fullcalendar/fullcalendar.css') ?>" rel="stylesheet" />
        <!-- easy pie chart-->
        <link href="<?php echo base_url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') ?>" rel="stylesheet" type="text/css" media="screen"/>
        <!-- owl carousel -->
        <link rel="stylesheet" href="<?php echo base_url('css/owl.carousel.css') ?>" type="text/css">
        <link href="<?php echo base_url('css/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="<?php echo base_url('css/fullcalendar.css') ?>">
        <link href="<?php echo base_url('css/widgets.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/style-responsive.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('css/xcharts.min.css') ?>" rel=" stylesheet">	
        <link href="<?php echo base_url('css/jquery-ui-1.10.4.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/validation/form-validator/theme-default.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('assets/datatable_13/css/jquery.dataTables.min.css'); ?>"/>

        <!-- javascripts -->
        <script src="<?php echo base_url('js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui-1.10.4.min.js') ?>"></script>
        <script src="<?php echo base_url('js/jquery-1.8.3.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/validation/form-validator/jquery.form-validator.js'); ?>"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable_13/css/dataTables.bootstrap.min.css'); ?>"/> 
        <script type="text/javascript" src="<?php echo base_url('assets/datatable_13/js/jquery.dataTables.min.js'); ?>"></script> 
        <script src="<?php echo base_url('js/typeahead.bundle.js') ?>"></script>
        <script src="static/js/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script src="static/js/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script>
            $(window).load(function() {
                    // Animate loader off screen
                    $(".se-pre-con").fadeOut("slow");;
            });
        </script>
        <style type="text/css">
            
            .no-js #loader { display: none;  }
            
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            
            .se-pre-con {
                    position: fixed;
                    left: 10%;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    z-index: 1000;
                    background: url(<?php echo base_url('img/preloader.gif') ?>) center no-repeat rgba(17, 17, 17, 0.28);
            }
		
            li.subactive a{
                    background-color: #0c6388 !important;
            }

            .mainactive{
                    background-color: #3295bf !important;
            }
            ul.sidebar-menu li.active a, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus{
                    background: #3295bf;
            }
		
            .form-control::-moz-placeholder {
                color: #858585;
            }

            /* Start typeahead */

            .twitter-typeahead .tt-query,
            .twitter-typeahead .tt-hint {
                margin-bottom: 0;
            }
            .tt-hint {
                display: block;
                width: 100%;
                height: 38px;
                padding: 8px 12px;
                font-size: 14px;
                line-height: 1.428571429;
                color: #999;
                vertical-align: middle;
                background-color: #ffffff;
                border: 1px solid #cccccc;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
                transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
            }
            .tt-dropdown-menu {
                min-width: 160px;
                margin-top: 2px;
                padding: 5px 0;
                background-color: #ffffff;
                border: 1px solid #cccccc;
                border: 1px solid rgba(0, 0, 0, 0.15);
                border-radius: 4px;
                -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
                background-clip: padding-box;

            }
            .tt-suggestion {
                display: block;
                padding: 3px 20px;
            }
            .tt-suggestion.tt-is-under-cursor {
                color: #fff;
                background-color: #428bca;
            }
            .tt-suggestion.tt-is-under-cursor a {
                color: #fff;
            }
            .tt-suggestion p {
                margin: 0;
            }

            span.twitter-typeahead .tt-menu,
            span.twitter-typeahead .tt-dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                z-index: 1000;
                display: none;
                float: left;
                width: 100%;
                padding: 5px 0;
                margin: 2px 0 0;
                list-style: none;
                font-size: 14px;
                text-align: left;
                background-color: #ffffff;
                border: 1px solid #cccccc;
                border: 1px solid rgba(0, 0, 0, 0.15);
                border-radius: 4px;
                -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
                background-clip: padding-box;
            }
            span.twitter-typeahead .tt-suggestion {
                display: block;
                padding: 3px 20px;
                clear: both;
                font-weight: normal;
                line-height: 1.42857143;
                color: #333333;
                white-space: nowrap;
            }
            span.twitter-typeahead .tt-suggestion.tt-cursor,
            span.twitter-typeahead .tt-suggestion:hover,
            span.twitter-typeahead .tt-suggestion:focus {
                color: #ffffff;
                text-decoration: none;
                outline: 0;
                background-color: #337ab7;
            }
            .input-group.input-group-lg span.twitter-typeahead .form-control {
                height: 46px;
                padding: 10px 16px;
                font-size: 18px;
                line-height: 1.3333333;
                border-radius: 6px;
            }
            .input-group.input-group-sm span.twitter-typeahead .form-control {
                height: 30px;
                padding: 5px 10px;
                font-size: 12px;
                line-height: 1.5;
                border-radius: 3px;
            }
            span.twitter-typeahead {
                width: 100%;
            }
            .input-group span.twitter-typeahead {
                display: block !important;
                height: 34px;
            }
            .input-group span.twitter-typeahead .tt-menu,
            .input-group span.twitter-typeahead .tt-dropdown-menu {
                top: 32px !important;
            }
            .input-group span.twitter-typeahead:not(:first-child):not(:last-child) .form-control {
                border-radius: 0;
            }
            .input-group span.twitter-typeahead:first-child .form-control {
                border-top-left-radius: 4px;
                border-bottom-left-radius: 4px;
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }
            .input-group span.twitter-typeahead:last-child .form-control {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
                border-top-right-radius: 4px;
                border-bottom-right-radius: 4px;
            }
            .input-group.input-group-sm span.twitter-typeahead {
                height: 30px;
            }
            .input-group.input-group-sm span.twitter-typeahead .tt-menu,
            .input-group.input-group-sm span.twitter-typeahead .tt-dropdown-menu {
                top: 30px !important;
            }
            .input-group.input-group-lg span.twitter-typeahead {
                height: 46px;
            }
            .input-group.input-group-lg span.twitter-typeahead .tt-menu,
            .input-group.input-group-lg span.twitter-typeahead .tt-dropdown-menu {
                top: 46px !important;
            }

            .dark-bg
            {
                color: #FFFFFF;
                background: #0c6388 ;
            }

            ul.sidebar-menu li a
            {
                color: #FFFFFF ;
                border-bottom: 1px solid #FFFFFF;
                background-color: #0c6388;
                border-right: 1px solid #FFFFFF;
            }

            .breadcrumb
            {
                color: #000000 ; 
            }

            .lite
            {
                color: #FCFCFF;
            }

            ul.sidebar-menu li ul.sub li a

            {
                color: #FFFFFF ;
            }

            .breadcrumb
            {
                color: #000000;
            }

            .page-header
            {
                color: #000000;
            }

            ul.top-menu > li > a
            {
                color: #FFFFFF;
            }

            .page-header i{
                color: #2F3537;
                font-weight: bold;
            }

            label
            {
                color: #2F3537;
                font-weight: bold;
                text-align: left;
            }

            .panel-heading
            {
                color: #000000;
                font-size: 16px;
            }

            table tr th
            {
                color: #414343;
                font-weight: bold;
                text-align: center;
            }

            body
            {
                color:#2F3537;
                font-size:12px !important;

            }

            h3, .h3{
                font-size:20px;
            }

            .badge.bg-important
            {
                background-color: #FE3838;
            }

            #sidebar
            {
                color: #FFFFFF;
            }

            h1, h2, h3, h4, h5{
                font-weight: bold;
            }

            .form-control
            {
                color: #524E4E;
                padding-top: 4px;
            }

            a 
            {
                color: #000000;
            }

            .page-header i
            {
                color: #000000;
            }

            a:hover, a:focus
            {
                color: #646665;
            }

            .nav-pills > li > a
            {
                color: #000000 ;
                border-bottom: 1px solid #E7E7E7;
                background-color: #E7E7E7;
                border-right: 1px solid #E7E7E7;
            }

            .nav-pills > li > a:hover, a:focus
            {
                color: #000000;
            }

            .nav-pills > li.active > a,
            .nav-pills > li.active > a:hover,
            .nav-pills > li.active > a:focus 
            {
                color: #ffffff;
                background-color: #000000;
            }

            .btn-info 
            {
                background-color:#42B8DD;
                border-color:#42B8DD;
                color:#FFFFFF;
            }

            .form-control {
                font-size: 12px;
                height: 29px;
                width:75%;
            }

            ul.sidebar-menu li a {
                padding-left:  5px;
                font-size: 13px;
            }

            ul.sidebar-menu li ul.sub li a {
                font-size: 12px;
            }

            #sidebar {
                background-color: #0c6388;
            }

            .alert {
                border:1px solid transparent;
                width: 320px ;
                position: fixed;
                top: 50px;
                margin-top:20px;
                padding:5px;
            }

            .alert-success {
                background-color:#E3F8CB;
                border-color:#7CFA91;
                color:#46BA59;
            }

            .alert-danger {
                background-color:#FFE0E6;
                border-color:#FC8C8C;
                color:#FF2D55;
            }

            .input-group-addon {
                background-color:#F7F7F7;
                border:1px solid #C7C7CC;
                border-radius:4px;
                font-size:13px;
                font-weight:normal;
                line-height:1;
                padding:6px 12px;
                text-align:center;
            }

            .input-group-addon, .input-group-btn {
                vertical-align:middle;
                white-space:nowrap;
                width:0;
            }

            .page-header {
                margin:1px 0 1px;
            }

            .breadcrumb {
                margin:0 0 4px;
            }

            /*.left-line{
                border-left: thick solid #D3D3D3;
            }
    
            .right-line{
                border-right: thick solid #D3D3D3;
            }*/

            .form-horizontal .form-group 
            {
                border-bottom:1px solid #EFF2F7;
                margin-bottom:10px;
                padding-bottom:8px;
            }
            /* End typeahead */

            .form-horizontal .control-label
            {
                text-align: left;
            }
            #sidebar{
                width:200px;
            }
            #main-content{
                margin-left: 200px;
            }

            .bootstrap-datetimepicker-widget 
            {
                z-index: 1200   !important;
            }
        </style>
    </head>
    <body data-spy="scroll" data-target=".scrollspy">
        <!-- container section start -->
        <section id="container" class=""> 
            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
                </div>

                <!--logo start-->
                <a target="_blank" href="http://www.sliate.ac.lk/" class="logo">SLIATE&nbsp;<a class="logo" href="<?php echo base_url('/dashboard') ?>" style="color:#00a0df">SMS</a></a>
				<!--<img src="img/sliate_logo.jpg" style="float: right;padding-top: 5px;" height="55" width="33">-->
				<!--<img style="float: right;padding-top: 5px;" height="55" width="33" src="<?php echo base_url('img/sliate_logo.jpg') ?>">
				<!--<img style="float: right;" height="70" width="48" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/SLIATE_LOGO2.png/220px-SLIATE_LOGO2.png" alt="logo">-->
                <!--logo end-->

                <!-- <div class="nav search-row" id="top_menu"> -->
                <!--  search form start -->
                <!-- <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" placeholder="Search" type="text">
                        </form>
                    </li>                    
                </ul> -->
                <!--  search form end -->                
                <!-- </div> -->

                <div class="top-nav notification-row">                
                    <!-- notificatoin dropdown start-->
                    <ul class="nav pull-right top-menu">

                        <!-- task notificatoin start -->
                        <!--<li id="task_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-task-l"></i>
                                <span class="badge bg-important">6</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 6 pending letter</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Design PSD </div>
                                            <div class="percent">90%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                <span class="sr-only">90% Complete (success)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">
                                                Project 1
                                            </div>
                                            <div class="percent">30%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                                <span class="sr-only">30% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Digital Marketing</div>
                                            <div class="percent">80%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Logo Designing</div>
                                            <div class="percent">78%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                                <span class="sr-only">78% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div class="desc">Mobile App</div>
                                            <div class="percent">50%</div>
                                        </div>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar"  role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                                <span class="sr-only">50% Complete</span>
                                            </div>
                                        </div>
        
                                    </a>
                                </li>
                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                        </li>-->
                        <!-- task notificatoin end -->
                        <!-- inbox notificatoin start-->
                        <li id="mail_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <!--<i class="icon-envelope-l"></i>
                                <!-- <span class="badge bg-important">5</span> -->
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <!-- <li>
                                    <p class="blue">You have 5 new messages</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                        <span class="subject">
                                        <span class="from">Greg  Martin</span>
                                        <span class="time">1 min</span>
                                        </span>
                                        <span class="message">
                                            I really like this admin panel.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                        <span class="subject">
                                        <span class="from">Bob   Mckenzie</span>
                                        <span class="time">5 mins</span>
                                        </span>
                                        <span class="message">
                                         Hi, What is next project plan?
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                        <span class="subject">
                                        <span class="from">Phillip   Park</span>
                                        <span class="time">2 hrs</span>
                                        </span>
                                        <span class="message">
                                            I am like to buy this Admin Template.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                        <span class="subject">
                                        <span class="from">Ray   Munoz</span>
                                        <span class="time">1 day</span>
                                        </span>
                                        <span class="message">
                                            Icon fonts are great.
                                        </span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="#">See all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox notificatoin end -->
                        <!-- alert notification start-->
                        <li id="alert_notificatoin_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <!--<i class="icon-bell-l"></i>
                                <!-- <span class="badge bg-important">7</span> -->
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <!-- <li>
                                    <p class="blue">You have 4 new notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-primary"><i class="icon_profile"></i></span> 
                                        Friend Request
                                        <span class="small italic pull-right">5 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-warning"><i class="icon_pin"></i></span>  
                                        John location.
                                        <span class="small italic pull-right">50 mins</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-danger"><i class="icon_book_alt"></i></span> 
                                        Project 3 Completed.
                                        <span class="small italic pull-right">1 hr</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="label label-success"><i class="icon_like"></i></span> 
                                        Mick appreciated your work.
                                        <span class="small italic pull-right"> Today</span>
                                    </a>
                                </li>  -->                           
                                <li>
                                    <a href="#">See all notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- alert notification end-->
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="profile-ava">
                                    <!-- <img alt="" src="img/avatar1_small.jpg"> -->
                                </span>
                                <span class="username"><?php print_r($_SESSION['u_name']) ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <!-- <li class="eborder-top">
                                    <a href="#"><i class="icon_profile"></i> My Profile</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon_chat_alt"></i> Chats</a>
                                </li> -->                           
				<li>
                                    <?php 
                                        $stu_username = substr($_SESSION['u_name'], 0, 3);
                                        
                                        if($stu_username != "stu")
                                        {
                                            echo '<a href="'.base_url('change_pw/change_pw_view') .'"><i class="icon_lock-open_alt"></i>Change Password</a>';
                                        }else{
                                            echo '';

                                        }
                                    ?>
                                </li>
				<li>
                                    <a href="<?php echo base_url('login/logout') ?>"><i class="icon_key_alt"></i> Log Out</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url('change_pw/change_pw_view') ?>" style="display:none;"><i class="icon_key_alt"></i>Changessss Password</a>
                                </li>
                                <!-- <li>
                                    <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
                                </li>
                                <li>
                                    <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
                                </li> -->
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!-- notificatoin dropdown end-->
                </div>
            </header>      
            <!--header end-->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  style="z-index: 1001;" class="nav-collapse ">
                    <!-- sidebar menu start-->
                <!-- <div style="padding-top:65px"><img alt="" width="100px" height="100px" src="<?php echo base_url('img/Untitled-1_03.png') ?>"></div>
                <ul class="sidebar-menu" style="margin-top: 5px">   -->
                    <ul class="sidebar-menu">	
<?php

$cur_controller = $this->uri->rsegments[1];
if(isset($this->uri->rsegments[3]))
    $cur_function   = $this->uri->rsegments[1].'/'.$this->uri->rsegments[2].'/'.$this->uri->rsegments[3];
else
$cur_function   = $this->uri->rsegments[1].'/'.$this->uri->rsegments[2];

$nav_rights = $this->auth->check_navright();

foreach ($nav_rights as $mainmod) {
    $ismainactive = '';
    $mainactiveclass = '';

    if (!empty($mainmod['subslist'])) {
        switch ($mainmod['func_module']) {
            case "System Access":
                $iconcss = "lock";
                
                if($cur_controller == 'authmanage' || $cur_controller == 'user')
                {
                    $ismainactive = 'active';
                }

                break;
            case "Configurations":
                $iconcss = "cog";

                if($cur_controller == 'company')
                {
                    $ismainactive = 'active';
                }

                break;
            case "Educational Structure":
                $iconcss = "graduation-cap";

                if($cur_controller == 'faculty' || $cur_controller == 'course' || $cur_controller == 'year' || $cur_controller == 'semester' || $cur_controller == 'batch')
                {
                    $ismainactive = 'active';
                }

                break;
            case "Staff" :
                $iconcss = "briefcase";

                if($cur_controller == 'staff')
                {
                    $ismainactive = 'active';
                }

                break;
            case "Subject" :
                $iconcss = "book";

                if($cur_controller == 'subject' || $cur_controller == 'grading_method' || $cur_controller == 'marking_method')
                {
                    $ismainactive = 'active';
                }

                break;
            case "Exams & Assignments" :
                $iconcss = "file-text";

                if($cur_controller == 'hall' || ($cur_controller == 'exam' && $cur_function != 'exam/apply_exam'))
                {
                    $ismainactive = 'active';
                }

                break;
            case "Time Table" :
                $iconcss = "calendar";

                if($cur_controller == 'time_table')
                {
                    $ismainactive = 'active';
                }

                break;
                
            case "Approvals" :
                $iconcss = "check-circle";
				
                if($cur_controller == 'approvals' || (strpos($_SERVER['REQUEST_URI'], "&type=approval") !== false))
                {
                    $ismainactive = 'active';
                }
				
                break;
                
            case "Report" :
                $iconcss = "list-alt";

                if($cur_controller == 'report')
                {
                    $ismainactive = 'active';
                }

                break;
                
            case "Student" :
                $iconcss = "user";

                if($cur_controller == 'student' && (strpos($_SERVER['REQUEST_URI'], "&type=approval") == false) || ($cur_controller == 'exam' && $cur_function == 'exam/apply_exam'))
                {
                    $ismainactive = 'active';
                }

                break;
        }

        if($ismainactive == 'active')
        {
            $mainactiveclass = 'mainactive';
        }
        ?>
                                <li class="sub-menu <?php echo $ismainactive; ?>">
                                    <a href="javascript:;" class="<?php echo $mainactiveclass?>">
                                        <i class="fa fa-<?php echo $iconcss; ?>"></i>
                                        <span style="font-size:14px"><?php echo $mainmod['func_module'] ?></span>
                                        <span class="menu-arrow arrow_carrot-right"></span>
                                    </a>
                                    <ul class="sub">
        <?php
        
        foreach ($mainmod['subslist'] as $submod) {

            $issubactive = '';

            if ($submod == 'Access Rights Management') {
                $url = 'authmanage/accessrights_view';
            }
            if ($submod == 'User') {
                $url = 'user/system_user';
            }
            if ($submod == 'User Group') {
                $url = 'user/usergroup_view';
            }
            if ($submod == 'System DB Backup') {
                $url = 'user/backup_view';
            }
            
            
            
            if ($submod == 'Company') {
                $url = 'company/index';
            }
            if ($submod == 'Release Results') {
                $url = 'company/release_results';
            }
            if ($submod == 'Department') {
                $url = 'hci_config/department_view';
            }
            //Educational Stucture Modules
            if ($submod == 'Faculty') {
                $url = 'faculty/faculty_view';
            }
            if ($submod == 'Course') {
                $url = 'course/course_view';
            }
            if ($submod == 'Year') {
                $url = 'year/year_view';
            }
            if ($submod == 'Semester') {
                $url = 'semester/semester_view';
            }
            if ($submod == 'Center Course') {
                $url = 'course/center_course';
            }
            if ($submod == 'Change Password') {
                $url = 'change_pw/change_pw_view';
            }
            //Staff Modules
            if ($submod == 'Add Staff') {
                $url = 'staff/stf_reg_view';
            }
            if ($submod == 'Staff Lookup') {
                $url = 'staff/stf_lookup';
            }
            if ($submod == 'Qualifications') {
                $url = 'staff/qualifications';
            }
            if ($submod == 'Assign') {
                $url = 'staff/assign';
            }
            if ($submod == 'Staff Attendance') {
                $url = 'staff/lecturer_attendance';
            }
            // Subject Module
            if ($submod == 'Subject') {
                $url = 'subject/subject_view';
            }
            if ($submod == 'Subject Groups') {
                $url = 'subject/subject_groups';
            }
            if ($submod == 'Semester Subjects') {
                $url = 'subject/semester_subjects';
            }
            //Exams & Assignments Module
            if ($submod == 'Halls') {
                $url = 'hall/hall_view';
            }
            if ($submod == 'Grading Method') {
                $url = 'grading_method/grading_view';
            }
             if ($submod == 'Marking Method') {
                $url = 'marking_method/marking_view';
            }
            if ($submod == 'Add Exam') {
                $url = 'exam/exam_view';
            }
            if ($submod == 'Lecture Time Table') {
                $url = 'time_table';
            }
            if ($submod == 'Paper Setter and Moderator') {
                $url = 'exam/paper_setter_moderator';
            }
            if ($submod == 'Training Exam Mark') {
                $url = 'exam/training_exam_mark';
            }
            
            
            //Student Module
            if ($submod == 'Add Student') {
                $url = 'student/student_view';
            }
            if ($submod == 'Student Lookup') {
                $url = 'student/student_lookup';
            }
            if ($submod == 'Subject Selection') {
                $url = 'student/Subject_selection';
            }
            if ($submod == 'Semester Upgrade') {
                $url = 'student/semester_upgrade';
            }
            if ($submod == 'Student Attendance') {
                $url = 'student/student_attendance';
            }
            if ($submod == 'Student Promotion') {
                $url = 'student/student_promote_view';
            }
            if ($submod == 'Assign Time Table') {
                $url = 'time_table/assign_timetable_view';
            }

            if ($submod == 'Request') {
                $url = 'exam/apply_exam';
            }
			
            if ($submod == 'Student Admin function') {
                $url = 'student/transfer_student';
            }

            if ($submod == 'CA Exam Mark') {
                $url = 'exam/exam_marks/ca_mark';
            }
            if ($submod == 'SE Exam Mark') {
                $url = 'exam/exam_marks/se_mark';
            }

            if ($submod == 'Exam Time Table') {
                $url = 'exam/exam_timetable';
            }

            if ($submod == 'Exam Hall Config') {
                $url = 'exam/config_exam_halls';
            }

            if ($submod == 'Exam Attendance') {
                $url = 'exam/exam_attendance';
            }
            
            //Approval Module
            if ($submod == 'Student Approvals') {
                $url = 'approvals/student_approvals';
            }
			
            if ($submod == 'Academic') {
                $url = 'approvals/request_approvals';
            }

            if ($submod == 'CA HOD Exam Mark') {
                $url = 'approvals/exam_mark_approvals/hod';
            }
            if ($submod == 'SE Director Exam Mark') {
                $url = 'approvals/exam_mark_approvals/ex_dir';
            }

            if ($submod == 'CA Director Exam Mark') {
                $url = 'approvals/exam_mark_approvals/dir';
            }
            
            if ($submod == 'Mahapola Approvals') {
                $url = 'approvals/mahapola_approvals';
            }

            if ($submod == 'Student Upgrade Approvals') {
                $url = 'approvals/student_upgade_approvals';
            }
            if ($submod == 'Staff Approvals') {
                $url = 'approvals/staff_approvals';
            }
            
            if ($submod == 'Exam Approvals') {
                $url = 'approvals/exam_approvals';
            }
            
            if ($submod == 'Non-Academic') {
                $url = 'approvals/director_approval';
            }
            
            if ($submod == 'Training Exam Mark Approvals') {
                $url = 'approvals/training_exam_mark_approval';
            }
            
            
            //Report Module
            if ($submod == 'Staff List View') {
                $url = 'report/staff_list_view';
            }
            
            if ($submod == 'Student List View') {
                $url = 'report/student_list_view';
            }
            
            if ($submod == 'Mahapola Eligible List') {
                $url = 'report/mahapola_eligible_list_view';
            }
            
            if ($submod == 'Mahapola Student List') {
                $url = 'report/mahapola_student_list_view';
            }
            
            if ($submod == 'Student ID Card Info Report') {
                $url = 'report/student_id_card_info_report';
            }
            
            if ($submod == 'Student Exam Report') {
                $url = 'report/student_exam_report';
            }
            if ($submod == 'Student Admissions') {
                $url = 'report/student_exam_report';
            }
            if ($submod == 'General Reports') {
                $url = 'report/lecturer_subject_report';
            }
            if ($submod == 'Students Exam Marks Report') {
                $url = 'report/student_exam_marks_report';
            }
            if ($submod == 'User Action Log') {
                $url = 'report/user_action_log_report';
            }
            if ($submod == 'Data Analysis Report') {
                $url = 'report/data_analysis_report';
            }
            

            if($cur_function == $url)
            {
                $issubactive = 'subactive';
            }
            ?>
                                            <li class="<?php echo $issubactive;?>"><a class="" href="<?php echo base_url($url) ?>"><?php echo $submod ?></a></li>  
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>

                                        <?php
                                    }
                                }
                                ?>   

                        <!-- <li class="sub-menu">
                         <a href="javascript:;" class="">
                             <i class="fa fa-graduation-cap"></i>
                             <span><?php //echo $mainmod['func_module']   ?></span>
                             <span class="menu-arrow arrow_carrot-right"></span>
                         </a>
                         <ul class="sub">
                             <li><a class="" href="<?php //echo base_url('faculty/faculty_view')   ?>">Faculty</a></li>
                             <li><a class="" href="<?php //echo base_url('course/course_view')   ?>">Course</a></li>
                             <li><a class="" href="<?php //echo base_url('year')   ?>">Year</a></li> 
                             <li><a class="" href="<?php //echo base_url('semester')    ?>">Semester</a></li>   
                             <!--<li><a class="" href="<?php //echo base_url('course/branch_course')     ?>">Branch Course</a></li>--> 

                        <!--</ul>
                    </li>-->

                        <!-- <li class="sub-menu">
                <a href="javascript:;" class="">
                <i class="fa fa-cog"></i>
                <span>Configuration</span>
                <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                <li><a class="" href="<?php echo base_url('company?tab_id=company') ?>">Company</a></li>  
                <li><a class="" href="<?php echo base_url('hci_config/department_view') ?>">Department</a></li>     
                <li><a class="" href="<?php echo base_url('hci_config/designation_view') ?>">Designation</a></li>                    
                <li><a class="" href="<?php echo base_url('hci_fee_structure/fee_cat_view') ?>">Fee Category</a></li>
                <li><a class="" href="<?php echo base_url('hci_fee_structure') ?>">Fee Structure</a></li>
                <li><a class="" href="<?php echo base_url('hci_fee_structure/payment_plan_view') ?>">Payment Plan</a></li>
                <li><a class="" href="<?php echo base_url('hci_accounts/adjusment_view') ?>">Adjusments</a></li>
                </ul>
        </li>  
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-lock"></i>
                <span>System Access</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">                  
                <li><a class="" href="<?php echo base_url('user/usergroup_view') ?>">User Group</a></li>
                <li><a class="" href="<?php echo base_url('authmanage/accessrights_view') ?>">Access Rights</a></li>
            </ul>
        </li>      
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-graduation-cap"></i>
                <span>Education Structure</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_edustructure/educationalsection') ?>">Section</a></li>
                <li><a class="" href="<?php echo base_url('hci_edustructure/educationalscheme') ?>">Scheme</a></li>
                <li><a class="" href="<?php echo base_url('hci_grade') ?>">Grade</a></li>      
                <li><a class="" href="<?php echo base_url('hci_grade/classmanage_view') ?>">Class</a></li>                    
            </ul>
        </li>      
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_document_alt"></i>
                <span>Front Office</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_admission/new_admission') ?>">Inquiry Form</a></li>                          
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-user"></i>
                <span>Student</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_studentreg/new_studentreg') ?>">Add Student</a></li>
                <li><a class="" href="<?php echo base_url('hci_student/student_lookup') ?>">Student Lookup</a></li>
                <li><a class="" href="<?php echo base_url('hci_student/annualgradepromotion_view') ?>">Grade Promotion</a></li>
                <li><a class="" href="<?php echo base_url('hci_student/student_sufflingview') ?>">Shuffle Students</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-book"></i>
                <span>Subject</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_subject/subjectgroup_view') ?>">Subject Group</a></li>
                <li><a class="" href="<?php echo base_url('hci_subject/subject_view') ?>">Subject</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_document_alt"></i>
                <span>Staff</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_staff') ?>">Add Staff</a></li>                          
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-car"></i>
                <span>Transport</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_transport/manage_routes_view') ?>">Route</a></li>
                <li><a class="" href="<?php echo base_url('hci_transport/manage_pickingpoints') ?>">Picking Points</a></li>
                <li><a class="" href="<?php echo base_url('hci_transport/transport_feestructure') ?>">Fee Structure</a></li>
                <li><a class="" href="<?php echo base_url('hci_transport/transport_registration') ?>">Registration</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-child"></i>
                <span>Childcare Centre</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_childcare/cc_fee_structure') ?>">Fee Structure</a></li>
                <li><a class="" href="<?php echo base_url('hci_childcare/cc_registration') ?>">Registration</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="fa fa-bar-chart-o"></i>
                <span>Accounts</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('hci_accounts/invoice_view') ?>">Student Invoice</a></li>
                <li><a class="" href="<?php echo base_url('hci_payment') ?>">Payment</a></li>
                <li><a class="" href="<?php echo base_url('hci_accounts/creditnote_view') ?>">Credit Note</a></li>
                <li><a class="" href="<?php echo base_url('hci_accounts/debitnote_view') ?>">Debit Note</a></li>         
                <li><a class="" href="<?php echo base_url('hci_accounts/monthend_view') ?>">Month End</a></li>
                <li><a class="" href="<?php echo base_url('hci_accounts/chequemanagment_view') ?>">Cheque Management</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_document_alt"></i>
                <span>Kids In Action</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="<?php echo base_url('kia/kia_grade') ?>">Grade</a></li>
                <li><a class="" href="<?php echo base_url('kia/kia_invoice/tax_table/update/1') ?>">Tax Table</a></li>
                <li><a class="" href="<?php echo base_url('kia/kia_feecategory') ?>">Fee Category</a></li>
                <li><a class="" href="<?php echo base_url('kia/kia_feestructure') ?>">Fee Structure</a></li>
                <li><a class="" href="<?php echo base_url('kia/kia_studentinfo') ?>">Inquary Form</a></li>
                <li><a class="" href="<?php echo base_url('kia/kia_admission/view_regstudent') ?>">View Invoice</a></li>
            </ul>
        </li> -->
                        <!-- <li class="sub-menu">
                                <a href="javascript:;" class="">
                                <i class="icon_desktop"></i>
                                <span>UI Fitures</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">
                                <li><a class="" href="general.html">Elements</a></li>
                                <li><a class="" href="buttons.html">Buttons</a></li>
                                <li><a class="" href="grids.html">Grids</a></li>
                                </ul>
                        </li>
                        <li>
                                <a class="" href="widgets.html">
                                <i class="icon_genius"></i>
                                <span>Widgets</span>
                                </a>
                        </li> -->
                        <!-- <li>                     
                                <a class="" href="chart-chartjs.html">
                                <i class="icon_piechart"></i>
                                <span>Charts</span>
                                </a>                   
                        </li>                  
                        <li class="sub-menu">
                                <a href="javascript:;" class="">
                                <i class="icon_table"></i>
                                <span>Tables</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">
                                <li><a class="" href="basic_table.html">Basic Table</a></li>
                                </ul>
                        </li>
                        <li class="sub-menu">
                                <a href="javascript:;" class="">
                                <i class="icon_documents_alt"></i>
                                <span>Pages</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">                          
                                <li><a class="" href="profile.html">Profile</a></li>
                                <li><a class="" href="login.html"><span>Login Page</span></a></li>
                                <li><a class="" href="blank.html">Blank Page</a></li>
                                <li><a class="" href="404.html">404 Error</a></li>
                                </ul>
                        </li> -->

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">  

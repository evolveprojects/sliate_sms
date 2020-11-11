<!DOCTYPE html>
<html lang="en-US">
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
	.select2-container--open .select2-dropdown--below{
		z-index: 1;
	}

</style>
<nav class="navbar navbar-light" style="background-color: #0c6388; margin-bottom: -120px;; height: 150px; border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <!--<a class="navbar-brand" href="#">WebSiteName</a>-->
    </div>
    <ul class="nav navbar-nav">
	<img src="<?php echo base_url('img/sliate_login.png') ?>" style="padding-left: 230px; padding-top: 10px;">
      <!--<li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>-->
    </ul>
  </div>
</nav>
<br>
<br/>
<br/>
<div class="col-md-12">
    <div class="row">
    <div class="col-md-12">
<!--        <h3 class="page-header"><i class="fa fa-users"></i> ONLINE STUDENT REGISTRATION</h3>-->
        <div class="row">
            <div class="container col-md-12"><br><br><br><br><br>

            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-header"><i class="fa fa-users"></i> STUDENT ONLINE REGISTRATION</h3><br>
                </div>
                <div class="col-md-6">
                    <a href="<?php echo base_url('login') ?>"><button name="save_btn" id="" class="btn btn-info" onclick="" style="float: right;">Back to Login</button></a>
                </div>
            </div>    
>
            <form class="form-horizontal" role="form" method="post"  id="reg_form" action="<?php echo base_url('student/save_online_registration') ?>"  autocomplete="on" novalidate enctype="multipart/form-data">
                <section class="panel affixpanel" id="generaldata">
                    <header class="panel-heading">
                        Registration information
                    </header>
                    <input type="hidden" id="edit_image_url" name="edit_image_url" value="">
                    <input type="hidden" id="stu_id" name="stu_id" value="<?php echo $stu_data['stu_id']; ?>">
                    <div class="panel-body" style="padding-bottom: 30px;">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">ATI Center<span style="color:red;font-size: 16px">*</span></label>
                                <div class="col-md-6">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    ?>
                                    <select class="form-control" id="center_id" name="center_id" style="width:100%" data-validation="required" onchange="load_course_list(this.value,null,this)">
                                        <option value="">---Select center---</option>
                                        <?php
                                            foreach ($centers as $row):
                                                ?>
                                            <option value="<?php echo $row['br_id']; ?>">
                                            <?php echo $row['br_code']." - ".$row['br_name']; ?>
                                            </option>
                                                <?php
                                            endforeach;
                                            ?>
                                    </select>  
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fax" class="col-md-3 control-label">Course<span style="color:red;font-size: 16px">*</span></label>
                                <div class="col-md-6">
                                    <select class="form-control" id="course_id" name="course_id" style="width:100%" data-validation="required">
                                    </select>  
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="fax" class="col-md-1 control-label">Course Type</label>
                                <div class="col-md-11">
                                    <input type="radio" name="course_type" class="col-md-1" id="course_type" value="F" checked="checked" onchange="course_type_on_change()">
                                    <label class="col-md-3 control-label">Full Time</label>

                                    <input type="radio" name="course_type" id="course_type" class="col-md-1" value="P" onchange="course_type_on_change()">
                                    <label class="col-md-4 control-label">Part Time</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                            </div>
                        </div>
                        <br>
                </section>
                <section class="panel affixpanel" id="studentinfo">
                    <header class="panel-heading">
                        Primary Student Information
                    </header>
                    <div class="panel-body">
                        <input type="hidden" id="id" name="id" value="<?php //echo $stu_data['id']; ?>">
                        <input type="hidden" id="ref_t" name="ref_t" value="<?php //echo $type ?>">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="col-md-9">
                                    <label for="name" class="control-label">Name with  initials<span style="color:red;font-size: 16px">*</span></label>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="first_name" name="first_name" placeholder="" value="<?php //echo $firstname; ?>" style="width:100%">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class=" form-group col-md-6">
                                <div class="col-md-9">
                                    <label for="brnum" class=" control-label">Name/Names denoted by Initials<span style="color:red;font-size: 16px">*</span></label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="last_name" name="last_name" placeholder="" value="<?php //echo $lastname; ?>" style="width:100%">
                                </div>
                            </div>
                        </div>
                        <br>  
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label  class="col-sm-3 control-label">Date Of Birth</label>
                                <div class="col-sm-6">
                                    <div id="" class="input-group date" >
                                        <input class="form-control datepicker" type="text" name="birth_date" id="birth_date"  data-format="YYYY-MM-DD" value="" data-validation="required" data-validation-error-msg-required="*">
                                        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nic_no" class="col-sm-1 control-label">NIC</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" name="nic_no" id="nic_no" value="" maxlength="12" onblur="validate_duplicate_nic_number()" onkeyup="validate_nic()">      
                                    <label id="lbl_nic_validate" class="col-md-10 control-label" style="color: red"></label>
                                    <label class="col-md-10 control-label" style="color: red" id="nic_no_error_txt"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="comcode" class="control-label col-sm-3">Gender </label>
                                <div class="col-sm-7">
                                    <label class="col-md-3 control-label">Male</label>
                                    <input type="radio" name="sex" class="col-md-1" id="sex" value="M" <?php //echo $selected_sex1  ?>>

                                    <label class="col-md-3 control-label">Female</label>
                                    <input type="radio" name="sex" id="sex" class="col-md-1" value="F" <?php //echo  $selected_sex2  ?>>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="comcode" class="control-label col-sm-3">Civil Status </label>
                                <div class="col-sm-7">
                                    <label class="col-md-3 control-label">Single</label>
                                    <input type="radio" name="civil_status" class="col-md-1" id="civil_status" value="S" <?php //echo $selected_cvlstat  ?>>

                                    <label class="col-md-3 control-label">Married</label>
                                    <input type="radio" name="civil_status" id="civil_status" class="col-md-1" value="M" <?php //echo  $selected_cvlstat2  ?>>
                                </div>
                            </div>

                            <div class="form-group col-md-9">
                                <label for="comcode" class="control-label col-sm-1">Age</label>

                                <label for="comcode" class="control-label col-sm-1">Years</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="txtAgeYear" name="txtAgeYear" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid year"  data-validation-optional="true" value="" readonly="true">

                                </div>
                                <label for="comcode" class="control-label col-sm-1">Months</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="txtAgeMonth" name="txtAgeMonth" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid month"  data-validation-optional="true" value="" readonly="true">

                                </div>
                                <label for="comcode" class="control-label col-sm-1">Days</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="txtAgeDays" name="txtAgeDays" placeholder="" data-validation="number" data-validation-error-msg-number="Invalid days"  data-validation-optional="true" value="" readonly="true">
                                </div>
                            </div>
                        </div>
                         <br>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="religion" class="col-md-3 control-label">Religion</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="religion" name="religion"  style="width: 100%;">
                                        <option value=""></option>
                                            <?php
                                            $rlgn = $this->db->get('com_religion')->result_array();
                                            foreach ($rlgn as $row):
                                            ?>
                                            <option value="<?php echo $row['rel_id']; ?>">
                                            <?php echo $row['rel_name']; ?>
                                            </option>
                                                <?php
                                            endforeach;
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="panel affixpanel" id="emergencycont">
                    <header class="panel-heading">
                        Contact Details
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fax" class="col-md-3 control-label">Address</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="permanent_address" name="permanent_address" placeholder="" value="<?php //echo $stu_data['permanent_address'] ?>" data-validation="required">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fax" class="col-md-3 control-label">Administrative District:</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="district" name="district"  style="width: 100%;">
                                            <?php
                                            foreach ($districts as $row):
                                                ?>
                                            <option value="<?php echo $row['code']; ?>">
                                            <?php echo $row['district']; ?>
                                            </option>
                                                <?php
                                            endforeach;
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="comcode" class="col-sm-3 control-label">Home Number </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" data-validation=" required number length" maxlength="10" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" id="fixed_tp" name="fixed_tp" placeholder="" value="<?php //echo $stu_data['fixed_tp'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number </label>
                                <div class="col-sm-7">
                                    <input value="07" type="text" class="form-control" data-validation="number length" data-validation-length="10-10" maxlength="10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" id="mobile_no" name="mobile_no" placeholder=""  data-validation-optional="true" value="<?php //echo $stu_data['mobile_no'] ?>">
                                </div>
                                <label id="lbl_mobileNo" class="col-md-10 control-label" style="color: red; margin-left: 140px;"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fax" class="col-md-3 control-label">Email Address</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="" data-validation="email" data-validation-error-msg-email="Invalid E-mail"  data-validation-optional="true" value="<?php //echo $stu_data['email']   ?>" style="width:100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="panel affixpanel" id="stuhistory">
                    <header class="panel-heading">
                        Results of GCE Advanced Level Examination
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="al_year" class="col-md-1 control-label">Year</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="al_year" name="al_year" value="" data-validation="required number length" data-validation-length="4-4">
                                </div>
                                <label for="al_index_no" class="col-md-2 control-label">Index No.</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="al_index_no" name="al_index_no" value="" data-validation="required number length" data-validation-length="6-10">
                                </div>
                            </div>
                            <label for="al_medium" class="col-md-1 control-label">Medium</label>
                            <div class="col-md-2">
                                <select class="form-control" id="al_medium" name="al_medium" >
                                    <option>Sinhala</option>
                                    <option>Tamil</option>>
                                    <option>English</option>
                                </select>  
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="en_mat_sc[o/l]" class="col-md-3 control-label">Stream</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="al_stream" name="al_stream"  style="width: 100%;" onchange="load_subjects(this.value,null,this)">
                                        <option value="">---Select Stream---</option>
                                            <?php
                                            foreach ($stream as $row):
                                                ?>
                                            <option value="<?php echo $row['stream_id']; ?>">
                                            <?php echo $row['stream_name']; ?>
                                            </option>
                                                <?php
                                            endforeach;
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="al_en_cgt" class="col-md-3 control-label">A/L Result</label>
                                <div class="col-md-8">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Grade</th>
                                            </tr>
                                        </thead>
                                        <tr><td> <!--<input type="text" class="form-control" id="al_subject1" name="al_subject1" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="al_subject1" name="al_subject1" onchange="validate_al_subjects()" style="width:100%">
                                                   <option value=""></option>
                                                </select>
                                            </td>
                                            <td><!--<input type="text" class="form-control" id="al_subject1_grade" name="al_subject1_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="al_subject1_grade" name="al_subject1_grade"  style="width: 80%;">
                                                    <option value="">-Grade-</option>
                                                        <?php
                                                        foreach ($al_grade as $row):
                                                            ?>
                                                        <option value="<?php echo $row['grade_id']; ?>">
                                                        <?php echo $row['grade']; ?>
                                                        </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>

                                            </td></tr>
                                        <tr><td><!--<input type="text" class="form-control" id="al_subject2" name="al_subject2" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                <select class="form-control" id="al_subject2" name="al_subject2" style="width:100%" onchange="validate_al_subjects()">
                                                    <option value=""></option>
                                                </select>
                                            </td>
                                            <td>
    <!--                                            <input type="text" class="form-control" id="al_subject2_grade" name="al_subject2_grade" placeholder="" value="<?php //echo $stu_data['al_en_cgt'] ?>">-->
                                                    <select class="form-control" id="al_subject2_grade" name="al_subject2_grade"  style="width: 80%;">
                                                        <option value="">-Grade-</option>
                                                            <?php
                                                            foreach ($al_grade as $row):
                                                                ?>
                                                            <option value="<?php echo $row['grade_id']; ?>">
                                                            <?php echo $row['grade']; ?>
                                                            </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                    </select>
                                            </td></tr>
                                    </table>
                                    <label id="lbl_al_subjects" class="col-md-10 control-label" style="color: red"></label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>
                                        <select class="form-control" id="al_subject3" name="al_subject3" style="width:100%" onchange="validate_al_subjects()">
                                            <option value=""></option>
                                        </select>
                                            </td>
                                            <td>
                                                    <select class="form-control" id="al_subject3_grade" name="al_subject3_grade"  style="width: 80%;">
                                                        <option value="">-Grade-</option>
                                                            <?php
                                                            foreach ($al_grade as $row):
                                                                ?>
                                                            <option value="<?php echo $row['grade_id']; ?>">
                                                            <?php echo $row['grade']; ?>
                                                            </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                    </select>
                                            </td>
                                        </tr>
                                        <tr><td>
                                            <select class="form-control" id="al_subject4" name="al_subject4" style="width:100%" onchange="validate_al_subjects()">
                                                <option value=""></option>
                                            </select>
                                            </td>
                                            <td>
                                                    <select class="form-control" id="al_subject4_grade" name="al_subject4_grade"  style="width: 80%;">
                                                        <option value="">-Grade-</option>
                                                                <?php
                                                                foreach ($al_grade as $row):
                                                                    ?>
                                                                <option value="<?php echo $row['grade_id']; ?>">
                                                                <?php echo $row['grade']; ?>
                                                                </option>
                                                                    <?php
                                                                endforeach;
                                                                ?>
                                                        </select>
                                            </td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="en_mat_sc[o/l]" class="col-md-3 control-label">Common General Paper Marks</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="com_gen_paper" name="com_gen_paper" placeholder=""  value="" onblur="validate_com_gen_paper();" onkeyup="validate_com_gen_paper();">
                                </div>
                                <label id="lbl_com_gen_validate" class="col-md-10 control-label" style="color: red; margin-left: 130px"></label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="al_z_core" class="col-md-3 control-label" style="margin-right: 14px;">A/L Z-Score</label>
                                <table >
                                    <tr>
                                        <td>
                                            <select class="form-control" id="al_score_mode" name="al_score_mode" style="width:70px">
                                                <option>+</option>
                                                <option>-</option>>
                                            </select>
                                        </td>
                                        <td style="position: absolute;">
                                            <input type="text" class="form-control" id="al_z_core" name="al_z_core" placeholder="" value="" data-validation="required" onblur="validate_z_score();" onkeyup="validate_z_score();">                                       
                                        </td>
                                    </tr>
                                </table>
                                <label id="lbl_zscore_validate" class="col-md-10 control-label" style="color: red; margin-left: 210px"></label>
                            </div>
                        </div>
                        <br>
                    </div>
                </section>
                <section class="panel affixpanel" id="stuhistory">
                    <header class="panel-heading">
                        Results of GCE Ordinary Level Examination:-
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="ol_year" class="col-md-1 control-label">Year</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="ol_year" name="ol_year" value="" data-validation="number length" data-validation-length="4-4" data-validation-optional="true">
                                </div>
                                <label for="ol_index_no" class="col-md-2 control-label">Index No.</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="ol_index_no" name="ol_index_no" value="" data-validation="number length" data-validation-length="6-10" data-validation-optional="true">
                                </div>
                            </div>
                            <label for="ol_stream" class="col-md-1 control-label">Medium</label>
                            <div class="col-md-2">
                                <select class="form-control" id="ol_medium" name="ol_medium" >
                                    <option>Sinhala</option>
                                    <option>Tamil</option>>
                                    <option>English</option>
                                </select>  
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="al_en_cgt" class="col-md-3 control-label">Result</label>
                                <div class="col-md-8">

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>
                                                    <label for="ol_maths" class="col-md-1 control-label">Maths</label>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="ol_maths_grade" name="ol_maths_grade"  style="width: 90%;">
                                                        <option value="">-Grade-</option>
                                                            <?php
                                                            foreach ($ol_grade as $row):
                                                                ?>
                                                            <option value="<?php echo $row['grade_id']; ?>">
                                                            <?php echo $row['grade']; ?>
                                                            </option>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group col-md-4">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="ol_english" class="col-md-1 control-label">English</label>
                                            </td>
                                            <td>
                                                <select class="form-control" id="ol_english_grade" name="ol_english_grade"  style="width: 90%;">
                                                    <option value="">-Grade-</option>
                                                        <?php
                                                        foreach ($ol_grade as $row):
                                                            ?>
                                                        <option value="<?php echo $row['grade_id']; ?>">
                                                        <?php echo $row['grade']; ?>
                                                        </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="div_course_type" class="panel affixpanel">
                    <header class="panel-heading">
                        Part Time Course Details
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <label for="prt_present_emp" class="col-md-4 control-label">Details of Present Employment / Self-employment</label>
                            <div class="col-md-6">
                                <!-- prt = Part time-->
                                <input type="text" class="form-control" id="prt_Present_emp" name="prt_Present_emp" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <label for="prt_post" class="col-md-4 control-label">Post</label>
                            <div class="col-md-6">
                                <!-- prt = Part time-->
                                <input type="text" class="form-control" id="prt_post" name="prt_post" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <label for="prt_EPF" class="col-md-4 control-label">E.P.F. Number</label>
                            <div class="col-md-6">
                                <!-- prt = Part time-->
                                <input type="text" class="form-control" id="prt_EPF" name="prt_EPF" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <label for="prt_address" class="col-md-4 control-label">Place of Work and Address</label>
                            <div class="col-md-6">
                                <!-- prt = Part time-->
                                <input type="text" class="form-control" id="prt_address" name="prt_address" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <label for="prt_app_date" class="col-md-4 control-label">Date of Appointments</label>
                            <div class="col-md-6">
                                <div id="" class="input-group date" >
                                    <input class="form-control datepicker" type="text" name="prt_app_date" id="prt_app_date"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <label for="prt_br" class="col-md-4 control-label">Business Registration Number</label>
                            <div class="col-md-6">
                                <!-- prt = Part time-->
                                <input type="text" class="form-control" id="prt_br" name="prt_br" placeholder="" value="<?php //echo $stu_data['al_z_core'] ?>">
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <label for="prt_date_br" class="col-md-4 control-label">Date of BR</label>
                            <div class="col-md-6">
                                <!-- prt = Part time-->
                                <div id="" class="input-group date" >
                                    <input class="form-control datepicker" type="text" name="prt_date_br" id="prt_date_br"  data-format="YYYY-MM-DD" value="<?php //echo ($stu_data['birth_date']!='0000-00-00'?$stu_data['birth_date']:'') ?>">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <br>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();validate_reg_no();">Save</button>
                                <button onclick="event.preventDefault();$('#reg_form').trigger('reset');$('#id');$('#ref_t').val('');" class="btn btn-default">Reset</button>
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



<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css') ?>">
<script type="text/javascript">

    $.validate({
        form: '#reg_form'
    });
    $('.datepicker').datepicker({
        autoclose: true,
        setDate: '2015-01-01'
    }).on('changeDate', function(ev){
           //my work here
           calculate_age($('#birth_date').val());

       });

    function calculate_age(dob) 
    {
        $('#txtAgeYear').val("0");
        $('#txtAgeMonth').val("0");
        $('#txtAgeDays').val("0");

        var split_dob = dob.split("-");
        dobYear = split_dob[0];
        dobMonth = split_dob[1];
        dobDay = split_dob[2];

        var bthDate, curDate, days;
        var ageYears, ageMonths, ageDays;
        bthDate = new Date(dobYear, dobMonth-1, dobDay);
        curDate = new Date();
        if (bthDate>curDate) return;
        days = Math.floor((curDate-bthDate)/(1000*60*60*24));
        ageYears = Math.floor(days/365);
        ageMonths = Math.floor((days%365)/31);
        ageDays = days - (ageYears*365) - (ageMonths*31);
        if (ageYears>0) {
                //console.log(ageYears+" year");
                $('#txtAgeYear').val(ageYears);
        }
        if (ageMonths>0) {
                //console.log(ageMonths+" month");
                $('#txtAgeMonth').val(ageMonths);
        }
        if (ageDays>0) {
                //console.log(ageDays+" day");
                $('#txtAgeDays').val(ageDays);
        }
        if(ageYears <= 25 )
        {
            $('#div_apply_mahapola').show();
        }
        else
        {
            $('#div_apply_mahapola').hide();
            $('input[name=apply_mahapola][value=' + 0 + ']').attr('checked', 'checked');
        }
    }

    function load_course_list(center_id, selectedid, selected)
    {
        //set REG NUmber..
        var sel_val = selected.options[selected.selectedIndex].text;
        center_code = sel_val.split('-')[0].trim();

        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        $('#course_id').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('Student/load_courses_for_center') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $("#course_id").append($('<option>', { value: data[i]['course_id'], text: data[i]['course_code'] + ' - ' + data[i]['course_name']}));
                    }
                },
                "json"
                );

    }
    function load_subjects(stream_id)
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
                        $("#al_subject1").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }
                },
                "json"
                );

    }
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
                        $("#al_subject1").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject2").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject3").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                        $("#al_subject4").append($('<option>', { value: data[i]['subject_id'], text: data[i]['subject_name']}));
                    }

                    $('#al_subject1').val(al_subject1);
                    $('#al_subject2').val(al_subject2);
                    $('#al_subject3').val(al_subject3);
                    $('#al_subject4').val(al_subject4);
                },
                "json"
                );

    }
    function load_course_list_by_id(center_id, selected_course_id)
    {

        $.post("<?php echo base_url('Student/load_course_list_add_student') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        if(selected_course_id == data[i]['course_id'])
                        {
                            $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        }
                        else
                        {
                            $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                        }
                    }
                    $('#course_id').val(selected_course_id);
                },
                "json"
                );
    }

    function load_batches(id, selectedid, selected)
    {

        $('#batch_id').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('student/load_batches') ?>", {'id': id},
                function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        for (var i = 0; i < data.length; i++) {

                            if (selectedid == data[i]['id'])
                            {
                                $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['batch_code'] + ' - ' + data[i]['description']));
                            } else
                            {
                                $('#batch_id').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code'] + ' - ' + data[i]['description']));
                            }
                        }
                    }
                },
                "json"
                );
    }

    function course_type_on_change()
    {
        var course_type_full = $('input[name=course_type]:checked').val();

        if (course_type_full == 'F')
        {
            course_type = 'F';
            $('#div_course_type').hide();
            $('#div_apply_mahapola').show();
        } else if (course_type_full == 'P')
        {
            course_type = 'P';
            $('#div_course_type').show();
            $('#div_apply_mahapola').hide();
            $('input[name=apply_mahapola][value=' + 0 + ']').attr('checked', 'checked');
        }
        var sel_val = $("#center_id option:selected").text();
        center_code = sel_val.split('-')[0].trim();

        var sel_val2 = $("#course_id option:selected").text();
        course_code = sel_val2.split('-')[0].trim();
        $('#reg_no_part1').val(center_code + '/' + course_code + '/' + year + '/' + course_type + '/');

        if($('#reg_no_part2').val() != ""){
            load_data($('#reg_no_part1').val()+$('#reg_no_part2').val());
        }
    }

    function reg_range_on_change()
    {
        $.post("<?php echo base_url('student/load_student_reg_range') ?>", {},
                function (data)
                {
                    var range = data[0]['RANGE_VALUES'].split('-');
                    var range_array = [];
                    console.info(range[0] + '-' + range[1]);
                    for (var i = range[0]; i <= range[1]; i++)
                    {
                        range_array.push(i);
                    }
                    $("#reg_no_part2").autocomplete({
                        source: range_array
                    });
                },
                "json");

        if(($('#reg_no_part2').val()) != ""){
            $('#reg_no_error_txt2').text("");
        }

            load_data($('#reg_no_part1').val()+$('#reg_no_part2').val());
    }

    function load_data(reg_no)
    {
        var frm_type = getUrlVars()["type"];

        $.post("<?php echo base_url('student/check_student_reg_no') ?>", {'reg_no':reg_no},
                function (data)
                {
                    if(data['reg_count'] >= "1")
                    {
                        if(frm_type == "edit"){

                            if(reg_no != reg_part2){

                                $('#reg_no_error_txt').text("Register Number Already Exists");
                            }
                            else{
                                $('#reg_no_error_txt').text("");
                            }

                        }else{
                            $('#reg_no_error_txt').text("Register Number Already Exists");
                        }
                    }
                    else{
                        $('#reg_no_error_txt').text("");
                    }
                },
                "json"
                );
    }
    
    function validate_reg_no()
    {
        var frm_type = getUrlVars()["type"];
        var reg_no = $('#reg_no_part1').val()+$('#reg_no_part2').val();
        
        $.post("<?php echo base_url('student/check_student_reg_no') ?>", {'reg_no':reg_no},
        function (data)
        {
            if(data['reg_count'] >="1")
            {
                //alert(frm_type + " - " + reg_part2 + " - " + reg_no)
                if(frm_type == "edit")
                {
                    if(reg_no != reg_part2){
                        var message = "Register Number Already Exists !";
                        $('#reg_no_error_txt').text(message);
                        funcres = {status: "denied", message: message};
                        result_notification(funcres);
                    }
                    else{
                        $('#reg_no_error_txt').text("");
                        $("#reg_form").submit();
                    }

                }else{
                    var message = "Register Number Already Exists !";
                        $('#reg_no_error_txt').text(message);
                        funcres = {status: "denied", message: message};
                        result_notification(funcres);
                }
            }
            else{
                $('#reg_no_error_txt').text("");
                $("#reg_form").submit();
            }
        },"json");
    }

    $('#reg_form').on('submit', function(e) {   
        
        $("#reg_form :input").prop("disabled", false);
        $('#save_btn').prop('disabled', true);
        
        validateRegNoField(e);
        validate_nic(e);
        var nic_vali = $('#lbl_nic_validate').text();
        if(nic_vali != '')
        {
            funcres = {status: "denied", message: nic_vali};
            result_notification(funcres);
        }
        //check for Duplicate NICNUmbers.
        var dup_nic = $('#nic_no_error_txt').text();
        if(dup_nic != '')
        {
            funcres = {status: "denied", message: dup_nic};
            result_notification(funcres);
            e.preventDefault();
        }
        
        validate_al_subjects(e);
        var al_vali = $('#lbl_al_subjects').text();
        if(al_vali != '')
        {
            funcres = {status: "denied", message: al_vali};
            result_notification(funcres);
        }
             
        validate_com_gen_paper(e);
        var com_vali = $('#lbl_com_gen_validate').text();
        if(com_vali != '')
        {
            funcres = {status: "denied", message: "Common general paper marks value invalid !"};
            result_notification(funcres);
        }
        
        validate_z_score(e);
        var zscore_vali = $('#lbl_zscore_validate').text();
        if(zscore_vali != '')
        {
            funcres = {status: "denied", message: zscore_vali};
            result_notification(funcres);
        }
    });

    function validateRegNoField(e) 
    {
       var txt = $('#reg_no_error_txt').text();

        var frm_type = getUrlVars()["type"];
        if(frm_type != "edit"){

            var reg_no_part2 = $('#reg_no_part2').val();

            if(reg_no_part2 == ""){
                e.preventDefault();

                funcres = {status: "denied", message: "Invalid Register Number"};
                result_notification(funcres);

                $('#reg_no_error_txt2').text("Invalid Register Number");
                $('#save_btn').attr('disabled', false);

                return false;
            }
        }


        if(frm_type == "edit"){

            var final_reg = ($('#reg_no_part1').val()+$('#reg_no_part2').val());

            if(final_reg != reg_part2){
                if(txt != ""){
                    e.preventDefault();

                    funcres = {status: "denied", message: "Register Number Already Exists"};
                    result_notification(funcres);

                    return false;
                }
            }

        }else{
            if(txt != ""){
                e.preventDefault();

                funcres = {status: "denied", message: "Register Number Already Exists"};
                result_notification(funcres);

                return false;
            }
        }

    };

    

    //Validate the NIC
    function validate_nic(e)
    {
        if($('#nic_no').val())
        {
            var nic = $('#nic_no').val();
            if(nic.length == 10 || nic.length == 12)
            {
                if(nic.length == 10)
                {
                    var idToTest = nic,
                    myRegExp = new RegExp(/[0-9]{9}[x|X|v|V]$/);

                    if(myRegExp.test(idToTest)) {
                        $('#lbl_nic_validate').text('');
                    }
                    else {
                        $('#lbl_nic_validate').text('Invalid NIC number format !');
                        $('#save_btn').attr('disabled', false);
                        e.preventDefault();
                    }
                }
                else{
                    var idToTest = nic,
                    myRegExp = new RegExp(/[0-9]{9}$/);

                    if(myRegExp.test(idToTest)) {
                        $('#lbl_nic_validate').text('');
                    }
                    else {
                        $('#lbl_nic_validate').text('Invalid NIC number format !');
                        $('#save_btn').attr('disabled', false);
                        e.preventDefault();
                    }
                }                
            }
            else
            {
                $('#lbl_nic_validate').text('NIC Length should be 10 0r 12 characters !');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
        }
        else
        {
            $('#lbl_nic_validate').text('NIC cannot be empty !');
            $('#save_btn').attr('disabled', false);
            e.preventDefault();
        }
    }   
    function validate_duplicate_nic_number()
    {
        var frm_type = getUrlVars()["type"];
        var nic_no = $('#nic_no').val();
        
        $.post("<?php echo base_url('student/check_duplicate_nic_no_online_reg') ?>", {'nic_no':nic_no},
        function (data)
        {
            if(data['nic_count'] >=1)
            {
                //alert(frm_type + " - " + reg_part2 + " - " + reg_no)
                if(frm_type == "edit")
                {
                    if(nic_no != pre_nic_no){
                        //e.preventDefault();
                        var message = "NIC Number Already Exists!";
                        $('#nic_no_error_txt').text(message);
                        
                        return false;
//                        funcres = {status: "denied", message: message};
//                        result_notification(funcres);
                    }
                    else{
                        $('#nic_no_error_txt').text("");
                        //$("#reg_form").submit();
                    }

                }else{
                    //e.preventDefault();
                    var message = "NIC Number Already Exists!";
                    $('#nic_no_error_txt').text(message);

                    return false;
//                        funcres = {status: "denied", message: message};
//                        result_notification(funcres);
                }
            }
            else{
                $('#nic_no_error_txt').text("");
                //$("#reg_form").submit();
            }
        },"json");
    }

   //validate the AL subject to check same subject has been selected.
   function validate_al_subjects(e)
   {
       var sub1 = $('#al_subject1').val();
       var sub2 = $('#al_subject2').val();
       var sub3 = $('#al_subject3').val();
       var sub4 = $('#al_subject4').val();
       //alert(sub1 + "-" + sub2 + "-" + sub3 + "-" + sub4);
        if(sub1 != "" || sub2 != "" || sub3 != "" || sub4 != "")
        {
            if(sub1 == sub2 || sub1 == sub3 || sub1 == sub4 || 
                    sub2 == sub1 || sub2 == sub3 || sub1 == sub4 || 
                    sub3 == sub1 || sub3 == sub2 || sub3 == sub4 ||
                    sub4 == sub1 || sub4 == sub2 || sub4 == sub3)
            {
                 //if(sub1 != "" && sub2 != "" && sub3 != "" && sub4 != "")
                     $('#lbl_al_subjects').text('Same subject has been selected one or more !');
                     $('#save_btn').attr('disabled', false);
                     e.preventDefault();
            }
            else
            {
                $('#lbl_al_subjects').text('');
            }
        }
   }
                           
// Read a page's GET URL variables and return them as an associative array.
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    var center_code = '-';
    var course_code = '-';
    var course_type = 'F';

    var year = (new Date).getFullYear();

    var reg_part2 = "";
    var pre_nic_no = "";
    
    $(document).ready(function ()
    {
        $('form').bind('submit', function () {
            $(this).find(':input').prop('disabled', false);
        });

        $('#div_course_type').hide();
        $('.select22').select2();
        //get Edit studetn Details
        var form_type = getUrlVars()["type"];


    });


    //Validate the Common general paper marks
    function validate_com_gen_paper(e)
    {
        if($('#com_gen_paper').val())
        {
            var com_marks = $('#com_gen_paper').val();

            myRegExp = new RegExp(/^[0-9][0-9]?$|^100$/);

            if(myRegExp.test(com_marks)) {
                $('#lbl_com_gen_validate').text('');
            }
            else {
                $('#lbl_com_gen_validate').text('Invalid marks !');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
              
        }
        else{
            $('#lbl_com_gen_validate').text('');
        }
    } 
    
    //Validate the Common general paper marks
    function validate_z_score(e)
    {
        if($('#al_z_core').val())
        {
            var zscore = $('#al_z_core').val();

            myRegExp = new RegExp(/^[0-3](\.\d{0,3})?$/);

            if(parseFloat(zscore) > 3.0) {
                $('#lbl_zscore_validate').text('Invalid z-score value.');
                $('#save_btn').attr('disabled', false);
                e.preventDefault();
            }
            else {
                
                if(myRegExp.test(zscore)){
                    $('#lbl_zscore_validate').text('');
                }
                else{
                    $('#lbl_zscore_validate').text('Invalid z-score value.');
                    $('#save_btn').attr('disabled', false);
                    e.preventDefault();
                }
            }  
        }
        else{
            $('#lbl_zscore_validate').text('');
        }
    } 
    
    
    $(document).on('input','#mobile_no',function(){
        var phone=$('#mobile_no').val();
        if(phone.indexOf('0')!==0){
              //alert('First number must be 0');
              $('#lbl_mobileNo').text('First number must be 0');
              $('#mobile_no').val('07');
        }else{
                if(phone.indexOf('7')!==1){
                     //alert('Second number must be 7');
                     $('#lbl_mobileNo').text('Second number must be 7');
                     $('#mobile_no').val('07');
                }
                else{
                    if(phone.indexOf('')!==2){
                        $('#lbl_mobileNo').text('');
                    }
                }    
        }
    });



</script> 
</body>
		</section>
		<div class="text-right">
            <div class="credits">
                <!-- 
                    All the links in the footer should remain intact. 
                    You can delete the links only if you purchased the pro version.
                    Licensing information: https://bootstrapmade.com/license/
                    Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
                -->
                <!-- <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </div>
    </section>
    <!--main content end-->
</section>
<!-- container section start -->
<div id = "js_notif_alerts" style="position: fixed;right: 7px;width: 400px;z-index: 1000;" >
	<?php if($this->session->flashdata('flashSuccess')){?>
		<div id="notif_alerts" class="alert alert-success" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashSuccess'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('flashError')){?>
		<div id="notif_alerts" class="alert alert-danger" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashError'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('flashInfo')){?>
		<div id="notif_alerts" class="alert alert-info" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashInfo'); ?>
		</div>
	<?php } ?>

	<?php if($this->session->flashdata('flashWarning')){?>
		<div id="notif_alerts" class="alert alert-warning" role="alert">  
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->session->flashdata('flashWarning'); ?>
		</div>
	<?php } ?>
</div>
<!-- feedback alert-end -->
</body>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.9.2.custom.min.js')?>"></script>
<!-- bootstrap -->
<script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
<!-- nice scroll -->
<script src="<?php echo base_url('js/jquery.scrollTo.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery.nicescroll.js')?>" type="text/javascript"></script>
<!-- charts scripts -->
<script src="<?php echo base_url('assets/jquery-knob/js/jquery.knob.js')?>"></script>
<script src="<?php echo base_url('js/jquery.sparkline.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')?>"></script>
<script src="<?php echo base_url('js/owl.carousel.js')?>" ></script>
<!-- jQuery full calendar -->
<<script src="<?php echo base_url('js/fullcalendar.min.js')?>"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo base_url('assets/fullcalendar/fullcalendar/fullcalendar.js')?>"></script>
<!--script for this page only-->
<script src="<?php echo base_url('js/calendar-custom.js')?>"></script>
<script src="<?php echo base_url('js/jquery.rateit.min.js')?>"></script>
<!-- custom select -->
<script src="<?php echo base_url('js/jquery.customSelect.min.js')?>" ></script>
<script src="<?php echo base_url('assets/chart-master/Chart.js')?>"></script>

<!--custome script for all page-->
<script src="<?php echo base_url('js/scripts.js')?>"></script>
<!-- custom script for this page-->
<script src="<?php echo base_url('js/sparkline-chart.js')?>"></script>
<script src="<?php echo base_url('js/easy-pie-chart.js')?>"></script>
<script src="<?php echo base_url('js/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery-jvectormap-world-mill-en.js')?>"></script>
<script src="<?php echo base_url('js/xcharts.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery.autosize.min.js')?>"></script>
<script src="<?php echo base_url('js/jquery.placeholder.min.js')?>"></script>
<script src="<?php echo base_url('js/gdp-data.js')?>"></script>	
<script src="<?php echo base_url('js/morris.min.js')?>"></script>
<script src="<?php echo base_url('js/sparklines.js')?>"></script>	
<script src="<?php echo base_url('js/charts.js')?>"></script>
<script src="<?php echo base_url('js/jquery.slimscroll.min.js')?>"></script>
<script>

    //knob
    $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
    });

    //carousel
    $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
    });

      //custom select box

    $(function(){
          $('select.styled').customSelect();
    });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

	$(function(){
		$('#notif_alerts').delay(5000).fadeOut();
	});

	function result_notification(res)
	{
		$('#js_notif_alerts').empty();
		if(res['status']=='success')
		{
			$('#js_notif_alerts').append('<div id="notif_alerts" class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+res['message']+'</div>');
		}
		else
		{
			$('#js_notif_alerts').append('<div id="notif_alerts" class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+res['message']+'</div>');
		}

		$(function(){
		$('#notif_alerts').delay(5000).fadeOut();
		});

	}

	$(".dataTables_length select").addClass(" form-control");
// $(".dataTables_filter").addClass("col-sm-8");
// // $(".dataTables_filter label").addClass("control-label ");
$(".dataTables_filter input").addClass(" form-control");
// $(".dataTables_paginate a").addClass(" btn btn-sm ");
</script>
</html> 
</html>










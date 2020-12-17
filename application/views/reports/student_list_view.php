<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
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
    #stu_idcard_tbl_wrapper {
        width: 100%;
        overflow-x: scroll;
    }

    /*    table{
            margin: 0 auto;
            width: 100%;
            clear: both;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap:break-word;
          }*/

</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT REPORT VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Student List View</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Student Reports
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-user" href="#full_summary_tab" aria-controls="full_summary_tab" role="tab" data-toggle="tab"> Full Summary</a></li>
                                <li role="presentation"><a class="fa fa-university" href="#center_wise_full_tab" aria-controls="center_wise_full_tab" role="tab" data-toggle="tab"> Center wise Full Summary</a></li>
                                <li role="presentation"><a class="fa fa-graduation-cap" href="#center_wise_detail_tab" aria-controls="center_wise_detail_tab" role="tab" data-toggle="tab"> Center wise Detail Summary</a></li>
                                <li role="presentation"><a class="fa fa-graduation-cap" href="#deactivated_student_tab" aria-controls="deactivated_student_tab" role="tab" data-toggle="tab"> De-activated Student List</a></li>
                                <li role="presentation"><a class="fa fa-graduation-cap" href="#rejected_student_tab" aria-controls="rejected_student_tab" role="tab" data-toggle="tab"> Rejected Student List</a></li>
                                <li role="presentation"><a class="fa fa-graduation-cap" href="#student_info_tab" aria-controls="student_info_tab" role="tab" data-toggle="tab">Student Info List </a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="full_summary_tab"><br/>
                                    <!--<form class="form-horizontal" role="form" method="post"  id="full_sum_form" action="<?php echo base_url('report/student_list_full_summary_pdf') ?>"  autocomplete="on" novalidate enctype="multipart/form-data">-->
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select class="form-control" id="fullsumyear" name="fullsumyear" onchange="full_summery_year_change(this.value);" data-validation="required">
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
                                        <div class="col-md-2">
                                            <button class="btn btn-info" id="full_summery_search_btn" onclick="ful_sumry_year();">Search</button>
                                        </div>
                                        <div class="col-md-8">
                                            <button style="float: right; margin-right: 1.5%;" class="btn btn-success" id="print_full" name="print_full" onclick="open_full_summery_report()">Print Report</button>
                                        </div>    
                                    </div>
                                    <table id="full_sum" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Center</th>
                                                <th>Center Code</th>
                                                <th>Course</th>
                                                <th>Course Code</th>
                                                <th>Total Students</th>
                                                <th>Approve</th>
                                                <th>Not Approve</th>
                                                <th>Reject</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
                                                                    //                                            $i = 1;
                                                                    //                                            $total_student = 0;
                                                                    //                                            $total_approved = 0;
                                                                    //                                            $total_reject = 0;
                                                                    //                                            $total_not_approve = 0;
                                                                    //                                            
                                                                    //                                            $center_total_student = 0;
                                                                    //                                            $center_total_approved = 0;
                                                                    //                                            $center_total_reject = 0;
                                                                    //                                            $center_total_not_approve = 0;
                                                                    //                                            
                                                                    //                                            
                                                                    //                                            if (!empty($stu_all_count_array)) 
                                                                    //                                            {
                                                                    //                                                //foreach ($stu_all_count_array as $va) 
                                                                    //                                                for($k=0; $k < count($stu_all_count_array);$k++)
                                                                    //                                                {
                                                                    //                                                    $va = $stu_all_count_array[$k];
                                                                    //                                                    
                                                                    //                                                    if($k == 0)
                                                                    //                                                    {
                                                                    //
                                                                    //                                                        echo '<tr>'.
                                                                    //                                                            '<td>'.$va['br_name'].'</td>'.
                                                                    //                                                            '<td>'.$va['br_code'].'</td>'.
                                                                    //                                                            '<td style="white-space: initial;">'.$va['course_name'].'</td>'.
                                                                    //                                                            '<td>'.$va['course_code'].'</td>'.
                                                                    //                                                            '<td align="center">'. $va['stu_count'].'</td>'.  
                                                                    //                                                            '<td align="center">'.$va['apprv_status'] .'</td>'.
                                                                    //                                                            '<td align="center">'.$va['status'].'</td>'. 
                                                                    //                                                            '<td align="center">'.$va['reject_status'].'</td>'. 
                                                                    //                                                        '</tr>';
                                                                    //                                                    }
                                                                    //                                                    else
                                                                    //                                                    {
                                                                    //                                                        if($stu_all_count_array[$k-1]['br_code'] != $stu_all_count_array[$k]['br_code'])
                                                                    //                                                        {
                                                                    //                                                            echo '<tr style="font-weight:bold;">'.
                                                                    //
                                                                    //                                                                '<td style="border-right: 0;">'.$stu_all_count_array[$k-1]['br_name'].' ATI Total</td>'.
                                                                    //                                                                '<td style="border-right: 0;"></td>'.
                                                                    //                                                                '<td style="border-right: 0;"></td>'.
                                                                    //                                                                '<td></td>'.
                                                                    //                                                                '<td align="center">'.$center_total_student.'</td>'.
                                                                    //                                                                '<td align="center">'. $center_total_approved.'</td>'.
                                                                    //                                                                '<td align="center">'. $center_total_not_approve.'</td>'.
                                                                    //                                                                '<td align="center">'. $center_total_reject.'</td>'.
                                                                    //                                                            '</tr>';
                                                                    //                                                            
                                                                    //                                                            $center_total_student = 0;
                                                                    //                                                            $center_total_approved = 0;
                                                                    //                                                            $center_total_reject = 0;
                                                                    //                                                            $center_total_not_approve = 0;
                                                                    //                                                        }
                                                                    //                                                        echo '<tr>'.
                                                                    //                                                                    '<td>'.$va['br_name'].'</td>'.
                                                                    //                                                                    '<td>'.$va['br_code'].'</td>'.
                                                                    //                                                                    '<td style="white-space: initial;">'.$va['course_name'].'</td>'.
                                                                    //                                                                    '<td>'.$va['course_code'].'</td>'.
                                                                    //                                                                    '<td align="center">'. $va['stu_count'].'</td>'.  
                                                                    //                                                                    '<td align="center">'.$va['apprv_status'] .'</td>'.
                                                                    //                                                                    '<td align="center">'.$va['status'].'</td>'. 
                                                                    //                                                                    '<td align="center">'.$va['reject_status'].'</td>'. 
                                                                    //                                                                '</tr>';
                                                                    //                                                    }
                                                                    //                                                    $i++;
                                                                    //                                                    $center_total_student += $va['stu_count'];
                                                                    //                                                    $center_total_approved += $va['apprv_status'];
                                                                    //                                                    $center_total_reject += $va['reject_status'];
                                                                    //                                                    $center_total_not_approve += $va['status']; 
                                                                    //                                                    
                                                                    //                                                    $total_student += $va['stu_count'];
                                                                    //                                                    $total_approved += $va['apprv_status'];
                                                                    //                                                    $total_reject += $va['reject_status'];
                                                                    //                                                    $total_not_approve += $va['status']; 
                                                                    //                                                }
                                                                    //                                                echo '<tr style="font-weight:bold;">'.
                                                                    //
                                                                    //                                                '<td style="font-weight:bold; border-right: 0;">'.$stu_all_count_array[$k-1]['br_name'].' ATI Total</td>'.
                                                                    //                                                '<td style="border-right: 0;"></td>'.
                                                                    //                                                '<td style="border-right: 0;"></td>'.
                                                                    //                                                '<td></td>'.
                                                                    //                                                '<td align="center">'.$center_total_student.'</td>'.
                                                                    //                                                '<td align="center">'. $center_total_approved.'</td>'.
                                                                    //                                                '<td align="center">'. $center_total_not_approve.'</td>'.
                                                                    //                                                '<td align="center">'. $center_total_reject.'</td>'.
                                                                    //                                            '</tr>';
                                                                    //                                            }
                                                                    //                                            
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Grand Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>0 <?php // echo $total_student  ?></th>
                                                <th>0 <?php // echo $total_approved  ?></th>
                                                <th>0 <?php // echo $total_not_approve  ?></th>
                                                <th>0 <?php // echo $total_reject  ?></th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <!--</form>-->
                                </div>
                                <div role="tabpanel" class="tab-pane" id="center_wise_full_tab"></br>
                                    <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                                <select class="form-control" id="center_wise_full_year" name="center_wise_full_year" onchange="full_summery_year_change(this.value)" data-validation="required">
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
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-md-3 control-label">Search Type:</label>
                                                    <div class="col-md-9">
                                                        <input type="radio" name="type" class="col-md-1" id="gender_type" value="gender" checked="checked">
                                                        <label class="col-md-5 control-label">Gender wise (Male/Female)</label>

                                                        <input type="radio" name="type" class="col-md-1" id="time_type" value="time">
                                                        <label class="col-md-5 control-label">Time wise (Part time/Full time)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <br/>
                                            <div class="col-md-9"></div>
                                            <div class="col-md-3">
                                                <button class="btn btn-info" id="center_full_search_btn" onclick="event.preventDefault();load_course_wise()">Search</button>
                                                <button class="btn btn-success" id="print_course_wise" name="print_course_wise" onclick="event.preventDefault();load_pdf_course_wise();">Print Report</button>
                                            </div>
                                        </div>
                                    </form>
                                    </br>
                                    <table id="center_full_sum" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Center</th>
                                                <th>Center Code</th>
                                                <th>Course</th>
                                                <th>Course Code</th>
                                                <th id="header1">Male</th>
                                                <th id="header2">Female</th>
                                                <th>Total Count</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Grand Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>0</th>
                                                <th>0</th>
                                                <th>0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="center_wise_detail_tab"><br>
                                    <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <div class="form-group col-md-4">
                                                    <div class="form-group">
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
                                                <div class="form-group col-md-4">							
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                        <div class="col-md-9">
                                                            <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                                            <select class="form-control" id="course_id" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_batch_list(this.value);">    
                                                                <option value="">---Select Course Code---</option>
                                                            </select>
                                                        </div>				         
                                                    </div>				
                                                </div>
                                                <div class="form-group col-md-4">							
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                                        <div class="col-md-9">
                                                            <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_year_list();">
                                                                <option value="">---Select Batch Code---</option>			
                                                            </select>											
                                                        </div>				         
                                                    </div>				
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <div class="form-group col-md-4">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                                        <div class="col-md-9">

                                                            <select type="text" class="form-control" id="l_no_year" name="l_no_year" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="" onchange="load_semesters(this.value);">
                                                                <option value="">---Select Year---</option>
                                                            </select>											
                                                        </div>				         
                                                    </div>				
                                                </div>
                                                <div class="form-group col-md-4">							
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                                        <div class="col-md-9">
                                                            <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                                                <option value="">---Select Semester---</option>	
                                                            </select>											
                                                        </div>				         
                                                    </div>				
                                                </div>
                                                <div class="row">
                                                    <div class="col-md">
                                                    <div class="form-group">
                                                        <div class="col-md-9">
                                                            <input type="radio" name="type_student" class="col-md-1" id="type_appr" value="0" checked="checked">
                                                            <label class="col-md-5 control-label">approved</label>

                                                            <input type="radio" name="type_student" class="col-md-1" id="type_non_appr" value="1">
                                                            <label class="col-md-5 control-label">Non Approved</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md"></div>
                                            <div class="col-md" style="float: right; margin-right: 12px;">
                                                <button style="margin-left: -30px;" type="button" class="btn btn-primary btn-md" name="search" onclick="search_student_details();">Search</button>        

                                                <button type="button" style="" id="print_btn" name="print_btn" class="btn btn-success" onclick="load_pdf_course_detail();">Print Report</button>
                                                <button type="button" style="" id="print_btn_excel" name="print_btn_excel" class="btn btn-success" onclick="load_pdf_course_detail_print_excel();">Print Excel</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--<div class="panel-body">-->
                                    <div class="row">
                                        <div class="col-md-12" style="overflow-x: scroll;">
                                            <table id="student_list" name="student_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Center</th>
                                                        <th>Register Number</th>
                                                        <th>Student Name</th>
                                                        <th>NIC No</th>
                                                        <th>Course</th>
                                                        <th>A/L results</th>
                                                        <th>O/L results</th>
                                                        <th>Mahapola</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_body">

                                                    <?php
                                            //                                                            $i = 1;
                                            //                                                            if (!empty($result_array)) {
                                            //                                                            foreach ($result_array as $va) {
                                                                                                ?>

                                            <!--                                                        <tr>
                                                            <td align="center"> <?php //echo $i  ?></td>
                                                            <td> <?php //echo $va['reg_no']  ?></td>
                                                            <td> <?php //echo $va['first_name'] . " " . $va['last_name']  ?></td>
                                                            <td> <?php //echo $va['nic_no']  ?></td>
                                                            <td align="center">
                                                                <a class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php //echo $va['stu_id']  ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> | 
                                                                <a class="btn btn-info btn-xs" onclick="event.preventDefault();load_stueditview('<?php //echo $va['stu_id']; ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> | 

                                                    <?php //if ($va["deleted"] == "0") {  ?>
                                                                    <button onclick="event.preventDefault();update_stu_status('<?php //print_r($va["stu_id"]) ?>', '1')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>
                                                    <?php //} else {  ?>
                                                                    <button onclick="event.preventDefault();update_stu_status('<?php //print_r($va["stu_id"]) ?>', '0')" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>
                                                    <?php //}  ?>
                                                            </td>
                                                        </tr>-->
                                                    <?php
                                                    // $i++;
                                                    //  }
                                                    //  }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--</div>-->
                                </div>

                                <div role="tabpanel" class="tab-pane" id="deactivated_student_tab"><br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select class="form-control" id="deactivated_student_fullsumyear" name="deactivated_student_fullsumyear" onchange="full_summery_year_change(this.value);" data-validation="required">
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
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="center" class="col-md-3 control-label">Center : </label>
                                                <div class="col-md-7">  
                                                    <?php
                                                    global $branchdrop;
                                                    global $selectedbr;
                                                    ?>

                                                    <select class="form-control" id="deactivate_student_center" name="deactivate_student_center" style="width:100%" data-validation="required" onchange="deactivate_students_course_list(this.value)">
                                                        <option value="all">---All---</option>
                                                        <?php
                                                        foreach ($centers as $row):
                                                            ?>
                                                            <option value="<?php echo $row['br_id']; ?>">
                                                                <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                                            </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select> 
                                                </div>
                                            </div>				
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="center" class="col-md-3 control-label">Course : </label>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="deactivate_student_course" name="deactivate_student_course" style="width:100%" data-validation="required" onchange="">
                                                        <option value="all">---All---</option>
                                                    </select>
                                                </div>
                                            </div>				
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-9">
                                        </div>
                                        <div class="col-md-1">
                                            <button style="" class="btn btn-info" id="deactivate_student_list_search_btn" onclick="deactivate_student_list_search();">Search</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button style="" class="btn btn-success" id="deactivate_student_list_search_print_btn" name="deactivate_student_list_search_print_btn" onclick="deactivate_student_list_search_print()">Print Report</button>
                                        </div> 
                                    </div>
                                    <br>
                                    <table id="deactivate_student_list_tbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Center</th>
                                                <th>Name</th>
                                                <th>Register No</th>
                                                <th>NIC</th>
                                                <th>Course</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">

                                        </tbody>
                                    </table>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="rejected_student_tab"><br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select class="form-control" id="rejected_student_fullsumyear" name="rejected_student_fullsumyear" onchange="full_summery_year_change(this.value);" data-validation="required">
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
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="center" class="col-md-3 control-label">Center : </label>
                                                <div class="col-md-7">  
                                                    <?php
                                                    global $branchdrop;
                                                    global $selectedbr;
                                                    ?>

                                                    <select class="form-control" id="rejected_student_center" name="rejected_student_center" style="width:100%" data-validation="required" onchange="rejected_students_course_list(this.value)">
                                                        <option value="all">---All---</option>
                                                        <?php
                                                        foreach ($centers as $row):
                                                            ?>
                                                            <option value="<?php echo $row['br_id']; ?>">
                                                                <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                                            </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select> 
                                                </div>
                                            </div>				
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="center" class="col-md-3 control-label">Course : </label>
                                                <div class="col-md-7">
                                                    <select class="form-control" id="rejected_student_course" name="rejected_student_course" style="width:100%" data-validation="required" onchange="">
                                                        <option value="all">---All---</option>
                                                    </select>
                                                </div>
                                            </div>				
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-9">
                                        </div>
                                        <div class="col-md-1">
                                            <button style="" class="btn btn-info" id="rejected_student_list_search_btn" onclick="rejected_student_list_search();">Search</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button style="" class="btn btn-success" id="rejected_student_list_search_print_btn" name="print_full" onclick="rejected_student_list_search_print()">Print Report</button>
                                        </div> 
                                    </div>
                                    <br>
                                    <table id="rejected_student_list_tbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Center</th>
                                                <th>Name</th>
                                                <th>Register No</th>
                                                <th>Course</th>
                                                <th>NIC</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">

                                        </tbody>
                                    </table>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="student_info_tab"><br>

                                <form class="form-horizontal" role="form" method="post" id="student_info_search_form" autocomplete="off">
                                            <div class="row">
                                                    <div class="col-md-2">
                                                        <select class="form-control" id="student_year" name="student_year" onchange="info_student_year(this.value);" data-validation="required">
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
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group">
                                                            <label for="center" class="col-md-3 control-label">Center : </label>
                                                            <div class="col-md-7">  
                                                                <?php
                                                                global $branchdrop;
                                                                global $selectedbr;
                                                                ?>

                                                                <select class="form-control" id="student_center" name="student_center" style="width:100%" data-validation="required" onchange="info_students_course_list(this.value)">
                                                                    <option value="all">---All---</option>
                                                                    <?php
                                                                    foreach ($centers as $row):
                                                                        ?>
                                                                        <option value="<?php echo $row['br_id']; ?>">
                                                                            <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                                                        </option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                        </div>				
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group">
                                                            <label for="center" class="col-md-3 control-label">Course : </label>
                                                            <div class="col-md-7">
                                                                <select class="form-control" id="student_course" name="student_course" style="width:100%" data-validation="required" onchange="">
                                                                    <option value="all">---All---</option>
                                                                </select>
                                                            </div>
                                                        </div>				
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                        
                                                        <div class="col-md-10">
                                                            
                                                            <!--<a data-toggle='tooltip' title='Download Image' href='download_bulk_profile_images'  >Download All images</a>-->  
                                                           
                                                            <button type="button" style="float: right; margin-right: 12px;" id="SI_print_btn" name="SI_print_btn" class="btn btn-success" onclick="load_student_info_pdf();">Print PDF</button>
                                                            <button type="button" style="float: right; margin-right: 12px;" id="SI_print_btn_excel" name="SI_print_btn_excel" class="btn btn-success" onclick="load_student_info_excel();">Print Excel</button>
                                                            <button type="button" style="float: right; margin-right: 12px;" id="info_search" name="info_search" class="btn btn-primary btn-md" onclick="search_info_student_details();">Search</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table id="stu_idcard_tbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>Center</th>
                                                                <th>Name</th>
                                                                <th>Register No</th>
                                                                <th>Course</th>
                                                                <th>NIC</th>
                                                                <th>District</th>
                                                                <th>Mobile Number</th>
                                                                <th>Home Number</th>
                                                                <th>Address</th>
                                                                <th>E-Mail Address</th>
                                                                <th>Date of Birth</th>
                                                                <th>Gender</th>
                                                                <th>Civil Status</th>
                                                                <th>Religion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbl_body">
                                                            
                                                        </tbody>
                                                    </table>
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ------------------- -->
                </div>
            </div>
        </div>
    </div>
</div>            

<script type="text/javascript">

    $.validate({
        form: '#stu_reg'
    });

    $(document).ready(function () {
        $('#print_full').attr('disabled', true);
        $('#full_summery_search_btn').prop("disabled", true);
        $('#center_full_search_btn').prop("disabled", true);
        $('#print_btn').attr('disabled', true);
        $('#print_course_wise').attr('disabled', true);
        $('#print_btn_excel').attr('disabled', true);


        $('#deactivate_student_list_search_print_btn').attr('disabled', true);
        $('#rejected_student_list_search_print_btn').attr('disabled', true);

        $('#student_list').DataTable({
        //            'scrollX':true,
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100]
        });

        if ($('#user_level').val() == "1") {
            $('#center_id').find('option').get(0).remove();
            $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        }

        load_course_list($("#center_id").val());

        load_batch_list($("#center_id").val());

        $('#full_sum').DataTable({
            'ordering': false,
            'paging': false,
            'searching': false
                    //'scrollX':true
        });

        $('#center_full_sum').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });

        $('#mahapola').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });

        //        load_course_wise();
        $('#deactivate_student_list_tbl').DataTable();
        $('#rejected_student_list_tbl').DataTable();

    ///=============== student info list====================== kasun 2020-12-16
        $('#SI_print_btn').prop('disabled', true);
        $('#SI_print_btn_excel').prop('disabled', true);
        $('#info_search').prop('disabled', true);
      
        
        $('#stu_idcard_tbl').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100],
            'paging': false
        });
        

     

    });

    function load_course_wise() {

        var type_val;

        if ($('input[name=type]:checked')) {
            type_val = $('input[name=type]:checked').val();
        }

        var year = $('#center_wise_full_year').val();

        if (type_val == "gender") {
            $('#header1').text("Male");
            $('#header2').text("Female");
        }
        if (type_val == "time") {
            $('#header1').text("Part Time");
            $('#header2').text("Full Time");
        }

        $.post("<?php echo base_url('Report/student_course_wise_details_stu_info') ?>", {'type_val': type_val, 'year': year},
                function (data)
                {
        //                console.log(data);
                    $('#center_full_sum').DataTable().destroy();


                    $('#center_full_sum').DataTable({
                        'ordering': true,
                        'paging': false,
                        "columnDefs": [{
                                "targets": 4,
                                "className": "text-center"
                            },
                            {
                                "targets": 5,
                                "className": "text-center"
                            },
                            {
                                "targets": 6,
                                "className": "text-center"
                            }],
                        'footerCallback': function (row, data, start, end, display) {

                            var api = this.api(), data;

                            // Remove the formatting to get integer data for summation
                            var intVal = function (i) {
                                return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '') * 1 :
                                        typeof i === 'number' ?
                                        i : 0;
                            };

                            // Total over all pages
                            total_5 = api
                                    .column(4)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                            total_6 = api
                                    .column(5)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                            total_7 = api
                                    .column(6)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                            // Total over this page
                            //                        pageTotal = api
                            //                            .column(5, {page: 'current'})
                            //                            .data()
                            //                            .reduce(function (a, b) {
                            //                                return intVal(a) + intVal(b);
                            //                        }, 0);

                            // Update footer
                            $(api.column(0).footer()).html(
                                    'Grand Total'
                                    );

                            $(api.column(4).footer()).html(
                                    total_5
                                    );

                            $(api.column(5).footer()).html(
                                    total_6
                                    );

                            $(api.column(6).footer()).html(
                                    total_7
                                    );


                        }
                    });

                    $('#center_full_sum').DataTable().clear();

                    var r = 1;
                    if (data.length > 0)
                    {
                        $('#print_course_wise').attr('disabled', false);

                        for (x = 0; x < data.length; x++) {

                            $('#center_full_sum').DataTable().row.add([
                                data[x]['br_name'],
                                data[x]['br_code'],
                                data[x]['course_name'],
                                data[x]['course_code'],
                                data[x]['type1'],
                                data[x]['type2'],
                                data[x]['type3']
                            ]).draw(false);

                            r++;
                        }
                    } else {
                        $('#print_course_wise').attr('disabled', true);
                    }
                },
                "json"
                );
    }


    function update_stu_status(student_id, new_status)
    {
        var batch_id = $('#l_Bcode').val();
        $.ajax(
                {
                    url: "<?php echo base_url('student/change_student_status') ?>",
                    type: 'POST',
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {'student_id': student_id, 'new_status': new_status},
                    success: function (data)
                    {
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            if (batch_id == '' || batch_id == 0 || batch_id == null) {
                                location.reload();
                            } else {
                                search_details();
                            }

                            result_notification(data);
                        }
                    }
                });

    }



    /*
     * load courses
     */
    function load_course_list(center_id)
    {
        $('#course_id').find('option').remove().end();
        $("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                    //load_batch_list($('#course_id').val());
                },
                "json"
                );
    }


    /*
     * load years
     */
    function load_year_list()
    {
        if (($('#course_id').val()) != "0") {
            var cou_id = $('#course_id').val();

            $.post("<?php echo base_url('Report/load_year_list') ?>", {'selected_course_id': cou_id},
                    function (data)
                    {
                        var year = data['no_of_year'];
                        var id = data['id'];

                        //console.log(year+"-"+id);

                        $('#l_no_year').find('option').remove().end();
                        $('#l_no_year').prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));

                        for (var i = 1; i <= year; i++)
                        {
                            $('#l_no_year').append($("<option></option>").attr("value", i + '-' + id).text(i + " Year"));
                        }

                        load_semesters($('#l_no_year').val());
                    },
                    "json"
                    );
        }
    }

    /*
     * load batches
     */
    function load_batch_list(selected_course_id)
    {
        $.post("<?php echo base_url('Report/load_batch_list') ?>", {'selected_course_id': selected_course_id},
                function (data)
                {
                    $('#l_Bcode').find('option').remove().end();
                    $('#l_Bcode').prepend($("<option selected='selected'>---No Batch Filter---</option>").attr("value", ""));

                    for (var i = 0; i < data.length; i++)
                    {
                        if ((data[i]['batch_code'].length) != 0)
                        {
                            $('#l_Bcode').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']));
                        }
                    }

                    load_year_list();
                },
                "json"
                );
    }


    function load_semesters(year_no)
    {
        var sel_year = "";
        var sel_year_id = "";

        if (year_no != "all") {
            sel_year = year_no.split('-')[0].trim();
            sel_year_id = year_no.split('-')[1].trim();
        }


        $.post("<?php echo base_url('Report/load_semesters') ?>", {'year_id': sel_year_id, 'year_no': sel_year},
                function (data)
                {
                    $('#l_no_semester').find('option').remove().end();
                    $("#l_no_semester").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
                    //$('#l_no_semester').append('<option value="">---Select Semester---</option>').val('');

                    for (var i = 1; i <= data; i++)
                    {
                        $('#l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));

                    }
                },
                "json"
                );
    }


    function search_student_details()
    {
        $('.se-pre-con').fadeIn('slow');

        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year_no = $('#l_no_year').val().split('-')[0].trim();
        var semester_no = $('#l_no_semester').val();
        var batch_id = $('#l_Bcode').val();
        var type_student = $('input[name=type_student]:checked').val();

        $.post("<?php echo base_url('Report/search_students_lookup') ?>", {'center_id': center_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id, 'type_student':type_student},
                function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        $('#student_list').DataTable().destroy();
                        $('#student_list').DataTable().clear().draw();

                        if (data.length > 0)
                        {
                            $('#print_btn').attr('disabled', false);
                            $('#print_btn_excel').attr('disabled', false);

                            for (j = 0; j < data.length; j++) {

                                number_content = "<td align='center'>" + (j + 1) + "</td>";
                                var alsub4 = data[j]['cas4s'];
                                var alsub4m = data[j]['sub4g'];
                                
                                var alsub4res;
                                if(alsub4 == null || alsub4m == null){
                                    alsub4res = '';
                                }else{
                                    alsub4res = data[j]['cas4s']+"-"+ data[j]['sub4g'];
                                }
                                
                                var maha = data[j]['apply_mahapola'];
                                if(maha == 1){
                                    var ma = 'Applied';
                                }else{
                                    var ma = 'Not applied';
                                }

                                $('#student_list').DataTable().row.add([
                                    "[" + data[j]['br_code'] + "] - " + data[j]['br_name'],
                                    data[j]['reg_no'],
                                    data[j]['first_name'], //+ " " + data[j]['last_name'],
                                    data[j]['nic_no'],
                                    "[" + data[j]['course_code'] + "] - " + data[j]['course_name'],
                                    //                                    data[j]['cas1s']+"-"+data[j]['sub1g']+", "data[j]['cas2s'] + "-"+data[j]['sub2g']+", "+data[j]['cas3s']+"-"+data[j]['sub3g']+", "+data[j]['cas4s']+"-"+data[j]['sub4g'],
                                    data[j]['cas1s']+"-"+ data[j]['sub1g']+"<br> "+data[j]['cas2s']+"-"+ data[j]['sub2g']+"<br>"+data[j]['cas3s']+"-"+ data[j]['sub3g']+"<br>"+alsub4res+"<br>",
                                    "Maths - "+data[j]['olmathg']+"<br> English - "+data[j]['olenglishg'],
                                    ma
                                ]).draw(false);
                            }
                        } else {
                            $('#print_btn').attr('disabled', true);
                            $('#print_btn_excel').attr('disabled', true);
                        }
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
                );


    }


    function load_pdf_course_wise() {

        var type_val2;

        if ($('input[name=type]:checked')) {
            type_val2 = $('input[name=type]:checked').val();
        }

        var year = $('#center_wise_full_year').val();

        window.open('<?php echo base_url("report/course_wise_full_summary_pdf") ?>?search_type=' + type_val2 + '&year=' + year);
    }

    function load_pdf_course_detail() {

        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year_no = $('#l_no_year').val().split('-')[0].trim();
        var semester_no = $('#l_no_semester').val();
        var batch_id = $('#l_Bcode').val();
        var type_student = $('input[name=type_student]:checked').val();
            //alert(type_student);
        window.open('<?php echo base_url("report/course_detail_summary_pdf") ?>?cen=' + center_id + '&cou=' + course_id + '&yr=' + year_no + '&sem=' + semester_no + '&bat=' + batch_id + '&type_student=' + type_student);

    }

    function ful_sumry_year() {

        var fulsumyr = $('#fullsumyear').val();

        $.post("<?php echo base_url('Report/get_rpt_student_list_view') ?>", {'fulsumyr': fulsumyr},
                function (data)
                {
                    $('#full_sum').DataTable().destroy();

                    $('#full_sum').DataTable({
                        'ordering': false,
                        'paging': false,
                        'searching': false,
                        'lengthMenu': [10, 25, 50, 75, 100],
                        "columnDefs": [{
                                "targets": 0,
                                "visible": true
                            },
                            {
                                "targets": 1,
                                "width": "20%"
                                        //"className": 'text-center'               
                            },
                            {
                                "targets": 2,
                                "className": 'text-center',
                                "width": "10%"
                            },
                            {
                                "targets": 3,
                                "className": 'text-center',
                                "width": "10%"
                            },
                            {
                                "targets": 4,
                                "className": 'text-center',
                                "width": "10%"
                            },
                            {
                                "targets": 5,
                                "className": 'text-center',
                                "width": "10%"
                            },
                            {
                                "targets": 6,
                                "className": 'text-center',
                                "width": "10%"
                            },
                            {
                                "targets": 7,
                                "className": 'text-center',
                                "width": "10%"
                            }],
                        'footerCallback': function (row, data, start, end, display) {
                            var api = this.api(), data;

                            // Remove the formatting to get integer data for summation
                            var intVal = function (i) {
                                return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '') * 1 :
                                        typeof i === 'number' ?
                                        i : 0;
                            };

                            // Total over all pages
                            total_4 = api
                                    .column(4)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                            total_5 = api
                                    .column(5)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                            total_6 = api
                                    .column(6)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                            total_7 = api
                                    .column(7)
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);


                            $(api.column(0).footer()).html(
                                    'Grand Total'
                                    );

                            $(api.column(1).footer()).html(
                                    ' '
                                    );

                            $(api.column(2).footer()).html(
                                    ' '
                                    );

                            $(api.column(3).footer()).html(
                                    ''
                                    );

                            $(api.column(4).footer()).html(
                                    total_4
                                    );

                            $(api.column(5).footer()).html(
                                    total_5
                                    );

                            $(api.column(6).footer()).html(
                                    total_6
                                    );

                            $(api.column(7).footer()).html(
                                    total_7
                                    );

                        },
                        "createdRow": function (row, data, dataIndex) {
                            if (data[0] == 1) {
                                $(row).css("background-color", "#f9f9f9");
                                $('td', row).css('border-right', 0);
                            }

                            if (data[0] == 2) {
                                $(row).css("background-color", "#c7c3c4");
                                $('td', row).css('border-right', 0);
                            }
                        }
                    });

                    $('#full_sum').DataTable().clear();

                    if (data.length > 0) {
                        $('#print_full').prop("disabled", false);
                        $('#full_summery_search_btn').prop('disabled', false);

                        for (j = 0; j < data.length; j++) {
                            $('#full_sum').DataTable().row.add([
                                data[j]['br_name'],
                                data[j]['br_code'],
                                data[j]['course_name'],
                                data[j]['course_code'],
                                data[j]['stu_count'],
                                data[j]['apprv_status'],
                                data[j]['status'],
                                data[j]['reject_status'],
                            ]).draw(false);
                        }
                    } else {
                        $('#print_full').prop("disabled", true);
                        $('#full_summery_search_btn').prop('disabled', true);
                    }

                },
                "json"
                );
    }

    function open_full_summery_report() {
        var year = $('#fullsumyear').val();
        window.open('<?php echo base_url("report/student_list_full_summary_pdf") ?>?year=' + year);
    }

    function full_summery_year_change(year) {
        if (year == null || year == '') {
            $('#full_summery_search_btn').prop('disabled', true);
            $('#center_full_search_btn').prop('disabled', true);

            $('#print_full').prop('disabled', true);
            $('#print_course_wise').prop('disabled', true);

        } else {
            $('#full_summery_search_btn').prop('disabled', false);
            $('#center_full_search_btn').prop('disabled', false);

            $('#print_full').prop('disabled', false);
            $('#print_course_wise').prop('disabled', false);
        }
    }

    function deactivate_students_course_list(center_id)
    {
        $('#deactivate_student_course').find('option').remove().end();
        $("#deactivate_student_course").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#deactivate_student_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                    //load_batch_list($('#course_id').val());
                },
                "json"
                );
    }




    function deactivate_student_list_search()
    {
        var year = $('#deactivated_student_fullsumyear').val();
        var center_id = $('#deactivate_student_center').val();
        var course_id = $('#deactivate_student_course').val();

        if (year == "") {
            funcres = {status: "denied", message: "Year cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else if (center_id == "") {
            funcres = {status: "denied", message: "Center cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else if (course_id == "") {
            funcres = {status: "denied", message: "Course cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else {

            $.post("<?php echo base_url('Report/deactivate_student_list_search') ?>", {'center_id': center_id, 'course_id': course_id, 'year': year},
                    function (data)
                    {
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            $('#deactivate_student_list_tbl').DataTable().destroy();
                            $('#deactivate_student_list_tbl').DataTable().clear().draw();

                            if (data.length > 0)
                            {
                                $('#deactivate_student_list_search_print_btn').attr('disabled', false);

                                for (j = 0; j < data.length; j++) {

                                    number_content = "<td align='center'>" + (j + 1) + "</td>";


                                    $('#deactivate_student_list_tbl').DataTable().row.add([
                                        "[" + data[j]['br_code'] + "] - " + data[j]['br_name'],
                                        data[j]['reg_no'],
                                        data[j]['first_name'], //+ " " + data[j]['last_name'],
                                        data[j]['nic_no'],
                                        "[" + data[j]['course_code'] + "] - " + data[j]['course_name']
                                    ]).draw(false);
                                }
                            } else {
                                $('#deactivate_student_list_search_print_btn').attr('disabled', true);
                            }
                        }
                    //                $('.se-pre-con').fadeOut('slow');
                    },
                    "json"
                    );

        }
    }

    function deactivate_student_list_search_print() {

        var center_id = $('#deactivate_student_center').val();
        var course_id = $('#deactivate_student_course').val();
        var year = $('#deactivated_student_fullsumyear').val();

        window.open('<?php echo base_url("report/deactivate_student_list_search_print") ?>?cen=' + center_id + '&cou=' + course_id + '&year=' + year);

    }



    function rejected_students_course_list(center_id) {
        $('#rejected_student_course').find('option').remove().end();
        $("#rejected_student_course").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#rejected_student_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                    //load_batch_list($('#course_id').val());
                },
                "json"
                );
    }

    function rejected_student_list_search() {
        var year = $('#rejected_student_fullsumyear').val();
        var center_id = $('#rejected_student_center').val();
        var course_id = $('#rejected_student_course').val();

        if (year == "") {
            funcres = {status: "denied", message: "Year cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else if (center_id == "") {
            funcres = {status: "denied", message: "Center cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else if (course_id == "") {
            funcres = {status: "denied", message: "Course cannot be empty!"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        } else {

            $.post("<?php echo base_url('Report/rejected_student_list_search') ?>", {'center_id': center_id, 'course_id': course_id, 'year': year},
                    function (data)
                    {
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            $('#rejected_student_list_tbl').DataTable().destroy();
                            $('#rejected_student_list_tbl').DataTable().clear().draw();

                            if (data.length > 0)
                            {
                                $('#rejected_student_list_search_print_btn').attr('disabled', false);

                                for (j = 0; j < data.length; j++) {

                                    number_content = "<td align='center'>" + (j + 1) + "</td>";


                                    $('#rejected_student_list_tbl').DataTable().row.add([
                                        "[" + data[j]['br_code'] + "] - " + data[j]['br_name'],
                                        data[j]['reg_no'],
                                        data[j]['first_name'], //+ " " + data[j]['last_name'],
                                        data[j]['nic_no'],
                                        "[" + data[j]['course_code'] + "] - " + data[j]['course_name']
                                    ]).draw(false);
                                }
                            } else {
                                $('#rejected_student_list_search_print_btn').attr('disabled', true);
                            }
                        }
                        //                $('.se-pre-con').fadeOut('slow');
                    },
                    "json"
                    );
        }
    }

    function rejected_student_list_search_print() {
        var center_id = $('#rejected_student_center').val();
        var course_id = $('#rejected_student_course').val();
        var year = $('#rejected_student_fullsumyear').val();

        window.open('<?php echo base_url("report/rejected_student_list_search_print") ?>?cen=' + center_id + '&cou=' + course_id + '&year=' + year);

    }
    
    function load_pdf_course_detail_print_excel(){
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var year_no = $('#l_no_year').val().split('-')[0].trim();
        var semester_no = $('#l_no_semester').val();
        var batch_id = $('#l_Bcode').val();
        var type_student = $('input[name=type_student]:checked').val();
            //alert(type_student);
        window.open('<?php echo base_url("report/load_pdf_course_detail_print_excel") ?>?cen=' + center_id + '&cou=' + course_id + '&yr=' + year_no + '&sem=' + semester_no + '&bat=' + batch_id + '&type_student=' + type_student);


      
    }

      ///=============== student info list====================== kasun 2020-12-16
     


    function info_student_year(year) {
            if (year == null || year == '') {
                $('#info_search').prop('disabled', true);
                $('#SI_print_btn_excel').prop('disabled', true);
                $('#SI_print_btn').prop('disabled', true);
            

            } else {
                $('#info_search').prop('disabled', false);
                $('#SI_print_btn_excel').prop('disabled', false);
                $('#SI_print_btn').prop('disabled', false);
            }
        }
      
    function info_students_course_list(center_id) {
        $('#student_course').find('option').remove().end();
        $("#student_course").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#student_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                    //load_batch_list($('#course_id').val());
                },
                "json"
                );
    }
 
    function search_info_student_details(){
        $('.se-pre-con').fadeIn('slow');
        var center_id = $('#student_center').val();
        var course_id = $('#student_course').val();
        var year = $('#student_year').val();
        

        $.post("<?php echo base_url('Report/search_info_students') ?>", {'center_id': center_id, 'course_id': course_id, 'year':year},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    $('#stu_idcard_tbl').DataTable().destroy();
                    $('#stu_idcard_tbl').DataTable().clear().draw();
                        
                    if (data.length > 0) 
                    {
                        $('#SI_print_btn').attr('disabled', false);
                        $('#info_search').attr('disabled', false);
                        $('#SI_print_btn_excel').attr('disabled', false);
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                            
                      
                        var District,M_no,H_no,address,email,dob,gender,civil_s,religen;
                            District=data[j]['district'];
                            M_no=data[j]['mobile_no'];
                            H_no=data[j]['fixed_tp'];
                            address=data[j]['permanent_address'];
                            email=data[j]['email'];
                            dob=data[j]['birth_date'];
                            gender=data[j]['sex'] ="F" ?  "Female":"Male";
                            civil_temp=data[j]['civil_status'];
                            civil_s=civil_temp="S" ? "Single":"Married";
                            religen=data[j]['rel_name'];

                            
                           
                            
                            $('#stu_idcard_tbl').DataTable().row.add([
                                "[" + data[j]['br_code'] + "] - " + data[j]['br_name'],
                                data[j]['first_name'],
                                data[j]['reg_no'],
                                "[" + data[j]['course_code'] + "] - " + data[j]['course_name'], //+ " " + data[j]['last_name'],
                                data[j]['nic_no'],
                                District,
                                M_no,
                                H_no,
                                address,
                                email,
                                dob,
                                gender,
                                civil_s,
                                religen
                            ]).draw(false);
                        }
                        $('.se-pre-con').fadeOut('slow');
                    }
                    else{
                         $('.se-pre-con').fadeOut('slow');
                        $('#SI_print_btn').attr('disabled', true);
                    }
                }
            },
            "json"
            );


    }
    function load_student_info_excel(){
        
        var center_id = $('#student_center').val();
        var course_id = $('#student_course').val();
        var year = $('#student_year').val();

        window.open('<?php echo base_url("report/student_info_report_excel") ?>?cen=' + center_id +'&cou=' +course_id + '&year='+year);
     
    }
    function load_student_info_pdf(){
        
        var center_id = $('#student_center').val();
        var course_id = $('#student_course').val();
        var year = $('#student_year').val();

        window.open('<?php echo base_url("report/student_info_report_pdf") ?>?cen=' + center_id +'&cou=' +course_id +'&year='+year);
  
         
    }
    
</script>

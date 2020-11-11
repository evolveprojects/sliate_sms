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

</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT MAHAPOLA REPORT VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Report</li>
            <li><i class="fa fa-bank"></i>Mahapola Eligible List View </li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Mahapola Reports
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <!--                                <li role="presentation" class="active"><a class="fa fa-user" href="#full_summary_tab" aria-controls="full_summary_tab" role="tab" data-toggle="tab"> Full Summary</a></li>
                                                            <li role="presentation"><a class="fa fa-university" href="#center_wise_full_tab" aria-controls="center_wise_full_tab" role="tab" data-toggle="tab"> Center wise Full Summary</a></li>
                                                            <li role="presentation"><a class="fa fa-graduation-cap" href="#center_wise_detail_tab" aria-controls="center_wise_detail_tab" role="tab" data-toggle="tab"> Center wise Detail Summary</a></li>-->
                            <!--<li role="presentation" class="active"><a class="fa fa-graduation-cap" href="#mahapola_summary_tab" aria-controls="mahapola_summary_tab" role="tab" data-toggle="tab"> Mahapola Summary</a></li>-->
                            <li role="presentation" class="active"><a class="fa fa-graduation-cap" href="#mahapola_tab" aria-controls="mahapola_tab" role="tab" data-toggle="tab"> Mahapola Scholarship Summary</a></li>
                            <li role="presentation"><a class="fa fa-university" href="#mahapola_scholarship_tab" aria-controls="mahapola_scholarship_tab" role="tab" data-toggle="tab"> Mahapola Scholarship Full List</a></li>
                            <li role="presentation"><a class="fa fa-university" href="#mahapola_notel_tab" aria-controls="mahapola_notel_tab" role="tab" data-toggle="tab"> Mahapola Not Eligible List</a></li>
                            <li role="presentation"><a class="fa fa-university" href="#mahapola_appr_stat_tab" aria-controls="mahapola_appr_stat_tab" role="tab" data-toggle="tab"> Mahapola Need index information</a></li>

                        </ul>
                        <div class="tab-content">
<!--                            <div role="tabpanel" class="tab-pane active" id="mahapola_summary_tab"><br/><br/>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="form-group">
                                            <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Mahapola Year:</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="mp_summary_year" name="mp_summary_year" onchange="" data-validation="required">
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
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <button class="btn btn-info" id="mp_summary_year_btn" name="mp_summary_year_btn" onclick="mp_summary_search()" >Search</button>
                                            <button class="btn btn-info" id="mp_summary_year_print_btn" name="mp_summary_year_print_btn" onclick="mp_summary_print()" >Search</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <table id="mp_summary_tbl" class="display" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">ATI</th>
                                            <th rowspan="2">Course</th>
                                            <th colspan="1">Registrar</th>
                                            <th colspan="1">Director</th>
                                            <th colspan="1">Mahapola Eligible</th>
                                            <th rowspan="2">Total</th>
                                        </tr>
                                        <tr>
                                            <th>Pending</th>
                                            <th>Pending</th>
                                            <th>Pending</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_body">

                                    </tbody>
                                </table>
                            </div>-->
                            
                            <div role="tabpanel" class="tab-pane active" id="mahapola_tab"><br/><br/>
                                <!-------------->
                                <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input type="checkbox" id="chkAll" name="chkAll"  onchange="disable_other_controls()">
                                                    <label class="col-md-0 control-label"> &nbsp;&nbsp;All </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Mahapola Year:</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="mp_sum_year" name="mp_sum_year" onchange="" data-validation="required">
                                                        <option value="all">All</option>
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
                                            </div>
                                        </div>
                                    </div>    
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label id="lbl_center" for="center" class="col-md-3 control-label">Center : </label>
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
                                                    <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Course Code:</label>
                                                    <div class="col-md-9">
                                                        <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                                        <select class="form-control" id="mahapola_course" name="mahapola_course" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">    
                                                            <option value="">---Select Course Code---</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button style="float: right;margin-top: 10%;" type="button" class="btn btn-primary btn-md" id="search" name="search" onclick="load_mahapola_data();">Search</button>

                                                        <button style="float: right;margin-top: 10%; margin-right: -60%;" id="print_btn" name="print_btn" onclick="event.preventDefault();print_mahapola_data();" class="btn btn-success">Print PDF</button>
                                                        
                                                        <button style="float: right;margin-top: 10%; margin-right: -100%;" id="print_btn_excel" name="print_btn_excel" onclick="event.preventDefault();print_excel_mahapola_data();" class="btn btn-success">Print Excel</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                    </div>    
                                        
                                </form>
                                <br/>
                                <!----------------------->
<!--                                <input type="hidden" id="student_count" name="student_count" value="">
                                <input type="hidden" id="mahapola_count" name="mahapola_count" value="">
                                <input type="hidden" id="course_name" name="course_name" value="">-->
                                <div id="printareadiv" style="overflow-x: scroll;">
                                    <table id="mahapola" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S/No</th>
                                                <th>Name in Full</th>
                                                <th>Name with Initial</th>
                                                <th>Year (A/L)</th>
                                                <th>Index No (G.C.E. A/L)</th>
                                                <th>Z-Score</th>
                                                <th>Gender</th>
                                                <th>NIC No</th>
                                                <th>Name of the Course</th>
                                                <th>Registration No</th>
                                                <th>Address</th>
                                                <th>Need Index</th>
<!--                                                <th>Other</th>-->
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="mahapola_scholarship_tab"><br/><br/>
                                <!-------------->
                                <form class="form-horizontal" role="form" method="post" id="search_form_1" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input type="checkbox" id="chkAll_full_list" name="chkAll_full_list"  onchange="full_list_disable_other_controls()">
                                                <label class="col-md-0 control-label"> &nbsp;&nbsp;All </label>
                                            </div>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Mahapola Year:</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="mp_full_year" name="mp_full_year" onchange="" data-validation="required">
                                                            <option value="all">All</option>
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
                                                </div>
                                            </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input type="checkbox" id="limit_full_list" name="limit_full_list"  onchange="disable_limit_txt()">
                                                <label class="col-md-0 control-label">&nbsp;Limit Records</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <div class="form-group" style="padding-left:20px">
                                                <input type="text" id="limit_txt" name="limit_txt" class="form-control" value="" disabled style="width:190px" pattern="(5000|([1-4][0-9][0-9][0-9])|([1-9][0-9][0-9])|([1-9][0-9])|[1-9])" >
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label for="center" class="col-md-3 control-label">Center : </label>
                                                    <div class="col-md-8">


                                                        <?php
                                                        global $branchdrop;
                                                        global $selectedbr;

                                                        if (isset($stu_data)) {
                                                            $selectedbr = $stu_data['center_id'];
                                                        }

                                                        $extraattrs = 'id="center_id_full" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list_full(this.value,null,this);"';

                                                        echo form_dropdown('center_id_full', $branchdrop, $selectedbr, $extraattrs);
                                                        ?>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">							
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                    <div class="col-md-9">
                                                        <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                                        <select class="form-control" id="mahapola_course_full" name="mahapola_course_full" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">    
                                                            <option value="">---Select Course Code---</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <button style="float: right; margin-top: 10%;" type="button" class="btn btn-primary btn-md" id="search_full" name="search_full" onclick="load_mahapola_data_full();">Search</button>

                                                        <button style="float: right;margin-top: 10%; margin-right: -75%;" id="print_btn_full" name="print_btn_full" onclick="event.preventDefault();print_mahapola_data_full();" class="btn btn-success">Print Report</button>
                                                        
                                                        <button style="float: right;margin-top: 10%; margin-right: -120%;" id="print_btn_full_excel" name="print_btn_full_excel" onclick="event.preventDefault();print_excel_mahapola_data_full();" class="btn btn-success">Print Excel</button>
                                                    </div>
                                                </div>				
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                                <br/>
                                <!----------------------->
<!--                                <input type="hidden" id="student_count_1" name="student_count_1" value="">
                                <input type="hidden" id="mahapola_count_1" name="mahapola_count_1" value="">
                                <input type="hidden" id="course_name_1" name="course_name_1" value="">-->
                                <div id="printareadiv_full" style="overflow-x: scroll;">
                                    <table id="mahapola_full_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S/No</th>
                                                <th>Name in Full</th>
                                                <th>Name with Initial</th>
                                                <th>Year (A/L)</th>
                                                <th>Index No (G.C.E. A/L)</th>
                                                <th>Z-Score</th>
                                                <th>Gender</th>
                                                <th>NIC No</th>
                                                <th>Name of the Course</th>
                                                <th>Registration No</th>
                                                <th>Address</th>
                                                <th>Need Index</th>
                                                <th>Other</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            
                                        </tbody>
                                    </table>
                                </div>    
                            </div>

                            <div role="tabpanel" class="tab-pane" id="mahapola_notel_tab"><br/><br/>
                                <!-------------->
                                <form class="form-horizontal" role="form" method="post" id="search_form_not_elig" autocomplete="off">
                                    <div class="row">
                                       <div class="col-md-1"></div>
                                       <div class="col-md-1">
                                           <div class="form-group">
                                                <input type="checkbox" id="chkAll_ne" name="chkAll_ne"  onchange="ne_disable_other_controls()">
                                                <label class="col-md-0 control-label"> &nbsp;&nbsp;All </label>
                                            </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="form-group">
                                               <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Mahapola Year:</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="mp_not_year" name="mp_not_year" onchange="" data-validation="required">
                                                            <option value="all">All</option>
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
                                           </div>
                                       </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label for="center" class="col-md-3 control-label">Center : </label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        global $branchdrop;
                                                        global $selectedbr;

                                                        if (isset($stu_data)) {
                                                            $selectedbr = $stu_data['center_id'];
                                                        }

                                                        $extraattrs = 'id="center_id_not_elig" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list_not_elig(this.value,null,this);"';

                                                        echo form_dropdown('center_id_not_elig', $branchdrop, $selectedbr, $extraattrs);
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">							
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                    <div class="col-md-9">
                                                        <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                                        <select class="form-control" id="mahapola_course_not_elig" name="mahapola_course_not_elig" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">    
                                                            <option value="">---Select Course Code---</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>				
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <button style="margin-left: 65%;margin-right: 2%" type="button" class="btn btn-primary btn-md" id="search_not_elig" name="search_not_elig" onclick="load_mahapola_data_not_elig();">Search</button>

                                            <button style="margin-right: 2%" id="print_btn_not_elig" name="print_btn_not_elig" onclick="event.preventDefault();print_mahapola_data_not_elig();" class="btn btn-success">Print Report</button>

                                            <button style="margin-right: 2%" id="print_btn_not_elig_excel" name="print_btn_not_elig_excel" onclick="event.preventDefault();print_excel_mahapola_data_not_elig();" class="btn btn-success">Print Excel</button>
                                        </div>
                                    </div>
                                </form>
                                <br/>
                                <!----------------------->
<!--                                <input type="hidden" id="student_count_2" name="student_count_2" value="">
                                <input type="hidden" id="mahapola_count_2" name="mahapola_count_2" value="">
                                <input type="hidden" id="course_name_2" name="course_name_2" value="">-->
                                <div id="printareadiv_not_elig" style="overflow-x: scroll;">
                                    <table id="mahapola_not_eligible" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S/No</th>
                                                <th>Name in Full</th>
                                                <th>Name with Initial</th>
                                                <th>Year (A/L)</th>
                                                <th>Index No (G.C.E. A/L)</th>
                                                <th>Z-Score</th>
                                                <th>Gender</th>
                                                <th>NIC No</th>
                                                <th>Name of the Course</th>
                                                <th>Registration No</th>
                                                <th>Address</th>
                                                <th>Need Index</th>
                                                <th>Other</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">

                                        </tbody>
                                    </table>
                                </div>    
                            </div>

                            <div role="tabpanel" class="tab-pane" id="mahapola_appr_stat_tab">
                                <br><br>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input type="checkbox" id="chkAll_index" name="chkAll_index"  onchange="index_disable_other_controls()">
                                            <label class="col-md-0 control-label"> &nbsp;&nbsp;All </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Mahapola Year:</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="mp_ind_year" name="mp_ind_year" onchange="" data-validation="required">
                                                    <option value="all">All</option>
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
                                        </div>
                                    </div>
                                </div>
                                <hr/>
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

                                                        $extraattrs = 'id="mast_center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="mast_load_course_list(this.value,null,this);"';

                                                        echo form_dropdown('mast_center_id', $branchdrop, $selectedbr, $extraattrs);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">							
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                    <div class="col-md-9">
                                                        <!--<select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">-->
                                                        <select class="form-control" id="mast_course" name="mast_course" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">    
                                                            <option value="">---Select Course Code---</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>				
                                            </div>
                                           
                                        </div>
                                    </div> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <button style="margin-left:70%; margin-right: 2%;" type="button" class="btn btn-primary btn-md" id="mast_search" name="mast_search" onclick="search_mast_students();">Search</button>
                                        <button style="margin-right: 2%;" id="print_mast_search" name="print_mast_search" onclick="event.preventDefault();print_mast_search();" class="btn btn-success">Print Report</button>

                                    </div>
                                </div>
                                
                                <div style="overflow-x: scroll;">
                                    <table id="mahapola_appr_stat_tbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reg no</th>
                                                <th>Full name</th>
                                                <th>NIC</th>
                                                <th>A/L subject stream</th>
                                                <th>A/L Z-Score</th>
                                                <th>Distance</th>
                                                <th>No of school attendees</th>
                                                <th>School going concession</th>
                                                <th>No of university attendees</th>
                                                <th>University going concession</th>
                                                <th>Land income</th>
                                                <th>Rent income</th>
                                                <th>Employed salary</th>
                                                <th>Spouse annual income</th>
                                                <th>Father income</th>
                                                <th>Mother income</th>
                                                <th>Parent total income</th>
                                                <th>Guardian income</th>
                                                <th>Need index</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="mahapola_appr_stat_tbl_body">

                                        </tbody>
                                    </table>
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

    $(document).ready(function () {
        
        $("#limit_txt[pattern]").on("input", function () {
            if (!this.checkValidity())
                this.value = this.value.slice(0, -1);
        });
        
        $('#print_btn').attr('disabled', true);
        $('#print_btn_excel').attr('disabled', true);
        $('#print_btn_full_excel').prop('disabled', true);
        $('#print_btn_full').attr('disabled', true);
        $('#print_btn_not_elig').attr('disabled', true);
        $('#print_btn_not_elig_excel').attr('disabled', true);
        $('#mp_summary_year_print_btn').attr('disabled', true);

        $('#mahapola').DataTable({
            'ordering': true,
            'paging': true,
            //'scrollX':true,
            'lengthMenu': [20, 35, 50, 75, 100],
            'searching': false,
            'lengthChange': true,
            'info': false
        });

        if ($('#user_level').val() == "1") {
            $('#center_id').find('option').get(0).remove();
            $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        }

        load_course_list($('#center_id').val());
        load_mahapola_data();

        $('#mahapola_full_list').DataTable({
            'ordering': true,
            'paging': true,
            //'scrollX':true,
            'lengthMenu': [20, 35, 50, 75, 100],
            'searching': false,
            'lengthChange': false,
            'info': false
        });

        if ($('#user_level').val() == "1") {
            $('#center_id_full').find('option').get(0).remove();
            $('#center_id_full').prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        }

        load_course_list_full($('#center_id_full').val());
        load_mahapola_data_full();


        $('#mahapola_not_eligible').DataTable({
            'ordering': true,
            'paging': true,
            //'scrollX':true,
            'lengthMenu': [20, 35, 50, 75, 100],
            'searching': false,
            'lengthChange': false,
            'info': false
        });

        if ($('#user_level').val() == "1") {
            $('#center_id_not_elig').find('option').get(0).remove();
            $('#center_id_not_elig').prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        }
        load_course_list_not_elig($('#center_id_not_elig').val());
        load_mahapola_data_not_elig();


        $('#mp_summary_tbl').DataTable();
    });

    function disable_other_controls()
    {
        if($('#chkAll').is(":checked"))
        {
            $('#lbl_center').attr('disabled', true);
            $('#center_id').attr('disabled', true);
            $('#lbl_course').attr('disabled', true);
            $('#mahapola_course').attr('disabled', true);
//            $('#mp_sum_year').attr('disabled', true);
        }
        else
        {
            $('#lbl_centers').attr('disabled', false);
            $('#center_id').attr('disabled', false);
            $('#lbl_course').attr('disabled', false);
            $('#mahapola_course').attr('disabled', false);
//            $('#mp_sum_year').attr('disabled', false);
        }
        
    }
    
    function index_disable_other_controls()
    {
        if($('#chkAll_index').is(":checked"))
        {
            $('#mast_center_id').attr('disabled', true);
            $('#mast_course').attr('disabled', true);
        }
        else
        {
            $('#mast_center_id').attr('disabled', false);
            $('#mast_course').attr('disabled', false);
        }
        
    }
    
    function ne_disable_other_controls(){
        if($('#chkAll_ne').is(":checked"))
        {
            $('#center_id_not_elig').attr('disabled', true);
            $('#mahapola_course_not_elig').attr('disabled', true);
        }
        else
        {
            $('#center_id_not_elig').attr('disabled', false);
            $('#mahapola_course_not_elig').attr('disabled', false);
        }
    }
    
    function full_list_disable_other_controls()
    {
        if($('#chkAll_full_list').is(":checked"))
        {
            $('#center_id_full').attr('disabled', true);
            $('#mahapola_course_full').attr('disabled', true);
        }
        else
        {
            $('#center_id_full').attr('disabled', false);
            $('#mahapola_course_full').attr('disabled', false);
        }
        
    }
    
    function disable_limit_txt (){
        if($('#limit_full_list').is(":checked"))
        {
            $('#limit_txt').val("1500");
            $('#limit_txt').attr('disabled', false);
        }
        else
        {
            $('#limit_txt').val("");
            $('#limit_txt').attr('disabled', true);
        }
    }
    
    function load_mahapola_data() {
        $('.se-pre-con').fadeIn('slow');
        var course = $('#mahapola_course').val();
        var center = $('#center_id').val();
        var mp_year = $('#mp_sum_year').val();
        if($('#chkAll').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }
        $('#mahapola').DataTable().destroy();
            $('#mahapola').DataTable({
                'ordering': true,
                'paging': true,
                //'scrollX':true,
                'searching': false,
                'lengthChange': true,
                'lengthMenu': [20, 35, 50, 75, 100],
                'info': false,
                "columnDefs": [{
                        "targets": 0,
                        "className": "text-center"
                    },
                    {
                        "targets": 6,
                        "className": "text-center"
                    }]
            });
            $('#mahapola').DataTable().clear().draw();
            
        $.post("<?php echo base_url('Report/get_mahapola_data') ?>", {'course': course, 'center': center, 'all':all,'mp_year':mp_year},
                function (data)
                {
//                    console.log(data);
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        var t = 1;
                        if (data['mahapola'].length > 0)
                        {
                            $('#print_btn').attr('disabled', false);
                            $('#print_btn_excel').attr('disabled', false);

//                    $('#student_count').val(data['stu_count'][0]['stu_count']);
//                    $('#mahapola_count').val(data['mahapola'][0]['mp_count']);
//                    $('#course_name').val(data['mahapola'][0]['course_code']);

                            for (j = 0; j < data['mahapola'].length; j++) {

                                $('#mahapola').DataTable().row.add([
                                    t,
                                    data['mahapola'][j]['full_name'],
                                    data['mahapola'][j]['first_name'],
                                    data['mahapola'][j]['al_year'],
                                    data['mahapola'][j]['al_index_no'],
                                    data['mahapola'][j]['al_z_core'],
                                    data['mahapola'][j]['sex'],
                                    data['mahapola'][j]['nic_no'],
                                    data['mahapola'][j]['course_code_mahapola'],
                                    data['mahapola'][j]['reg_no'],
                                    data['mahapola'][j]['permanent_address'],
                                    data['mahapola'][j]['need_index']
                                    //,''
                                ]).draw(false);

                                t++;
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
    
    function print_mahapola_data()
    {
        var mahapola_course = $('#mahapola_course').val();
        if(mahapola_course == '')
            mahapola_course = "all";
        var mahapola_center = $('#center_id').val();
        if(mahapola_center == '')
            mahapola_center = "all";
        if($('#chkAll').is(":checked"))
            var all = 1;
        else
            var all = 0;

        var mp_year = $('#mp_sum_year').val();
        window.open('<?php echo base_url("report/mahapola_list_view_pdf") ?>?cou=' + mahapola_course + '&cen=' + mahapola_center+ '&all=' + all+'&mp_year='+mp_year);
    }
    
    // generate the excel file with eligible student.
    function print_excel_mahapola_data()
    {
        var mahapola_course = $('#mahapola_course').val();
        if(mahapola_course == '')
            mahapola_course = "all";
        var mahapola_center = $('#center_id').val();
        if(mahapola_center == '')
            mahapola_center = "all";
        if($('#chkAll').is(":checked"))
            var all = 1;
        else
            var all = 0;
        
        var mp_year = $('#mp_sum_year').val();
        window.open('<?php echo base_url("report/mahapola_list_view_excel") ?>?cou=' + mahapola_course + '&cen=' + mahapola_center+ '&all=' + all + '&mp_year='+mp_year);
    }


    function load_mahapola_data_full() {
        $('.se-pre-con').fadeIn('slow');
        var course1 = $('#mahapola_course_full').val();
        var center1 = $('#center_id_full').val();
        var mp_year = $('#mp_full_year').val();
        
        if($('#chkAll_full_list').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }
        
        if($('#limit_full_list').is(":checked")){
            var limit = $('#limit_txt').val().trim();
            if (limit == null || limit == ''){
                limit = 0;
            }
        }else{
            var limit = 'none';
        }
        
        $('#mahapola_full_list').DataTable().destroy();
        $('#mahapola_full_list').DataTable({
            'ordering': true,
            'paging': true,
            //'scrollX':true,
            'searching': false,
            'lengthChange': true,
            'lengthMenu': [20, 35, 50, 75, 100],
            'info': false,
            "columnDefs": [{
                    "targets": 0,
                    "className": "text-center"
                },
                {
                    "targets": 6,
                    "className": "text-center"
                }]
        });
        $('#mahapola_full_list').DataTable().clear().draw();

        $.post("<?php echo base_url('Report/get_mahapola_data_full') ?>", {'all': all, 'course1': course1, 'center1': center1, 'mp_year':mp_year, 'limit':limit},
                function (data)
                {
//                    console.log(data);
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        
                        

                        var w = 1;
                        if (data['mahapola'].length > 0)
                        {
                            $('#print_btn_full').attr('disabled', false);
                            $('#print_btn_full_excel').attr('disabled', false);

//                    $('#student_count').val(data['stu_count'][0]['stu_count']);
//                    $('#mahapola_count').val(data['mahapola'][0]['mp_count']);
//                    $('#course_name').val(data['mahapola'][0]['course_code']);

                            for (k = 0; k < data['mahapola'].length; k++) {

                                $('#mahapola_full_list').DataTable().row.add([
                                    w,
                                    data['mahapola'][k]['first_name'],
                                    data['mahapola'][k]['last_name'],
                                    data['mahapola'][k]['al_year'],
                                    data['mahapola'][k]['al_index_no'],
                                    data['mahapola'][k]['al_z_core'],
                                    data['mahapola'][k]['sex'],
                                    data['mahapola'][k]['nic_no'],
                                    data['mahapola'][k]['course_code'],
                                    data['mahapola'][k]['reg_no'],
                                    data['mahapola'][k]['permanent_address'],
                                    data['mahapola'][k]['need_index'],
                                    ''
                                ]).draw(false);

                                w++;
                            }
                        } else {
                            $('#print_btn_full').attr('disabled', true);
                            $('#print_btn_full_excel').attr('disabled', true);
                        }
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
                );
    }



    function load_mahapola_data_not_elig() {
        $('.se-pre-con').fadeIn('slow');
        var course2 = $('#mahapola_course_not_elig').val();
        var center2 = $('#center_id_not_elig').val();
        var mp_year = $('#mp_not_year').val();

	if($('#chkAll_ne').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }
        
        $.post("<?php echo base_url('Report/get_mahapola_data_ne') ?>", {'course2': course2, 'center2': center2, 'mp_year':mp_year, 'all':all},
                function (data)
                {
//                    console.log(data);
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        $('#mahapola_not_eligible').DataTable().destroy();
                        $('#mahapola_not_eligible').DataTable({
                            'ordering': true,
                            'paging': true,
                            //'scrollX':true,
                            'searching': false,
                            'lengthChange': true,
                            'lengthMenu': [20, 35, 50, 75, 100],
                            'info': false,
                            "columnDefs": [{
                                    "targets": 0,
                                    "className": "text-center"
                                },
                                {
                                    "targets": 6,
                                    "className": "text-center"
                                }]
                        });
                        $('#mahapola_not_eligible').DataTable().clear();

                        var a = 1;
                        if (data['mahapola'].length > 0)
                        {
                            $('#print_btn_not_elig').attr('disabled', false);
                            $('#print_btn_not_elig_excel').attr('disabled', false);

//                    $('#student_count').val(data['stu_count'][0]['stu_count']);
//                    $('#mahapola_count').val(data['mahapola'][0]['mp_count']);
//                    $('#course_name').val(data['mahapola'][0]['course_code']);

                            for (p = 0; p < data['mahapola'].length; p++) {

                                $('#mahapola_not_eligible').DataTable().row.add([
                                    a,
                                    data['mahapola'][p]['first_name'],
                                    data['mahapola'][p]['last_name'],
                                    data['mahapola'][p]['al_year'],
                                    data['mahapola'][p]['al_index_no'],
                                    data['mahapola'][p]['al_z_core'],
                                    data['mahapola'][p]['sex'],
                                    data['mahapola'][p]['nic_no'],
                                    data['mahapola'][p]['course_code'],
                                    data['mahapola'][p]['reg_no'],
                                    data['mahapola'][p]['permanent_address'],
                                    data['mahapola'][p]['need_index'],
                                    ''
                                ]).draw(false);

                                a++;
                            }
                        } else {
                            $('#print_btn_not_elig').attr('disabled', true);
                            $('#print_btn_not_elig_excel').attr('disabled', true);
                        }
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
                );
    }

    function print_mahapola_data_full()
    {
        var mahapola_course1 = $('#mahapola_course_full').val();
        var mahapola_center1 = $('#center_id_full').val();
        var mahapola_year = $('#mp_full_year').val();
        
        if($('#chkAll_full_list').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }
        
        if($('#limit_full_list').is(":checked")){
            var limit = $('#limit_txt').val().trim();
            if (limit == null || limit == ''){
                limit = 0;
            }
        }else{
            var limit = 'none';
        }
        
        window.open('<?php echo base_url("report/mahapola_full_list_view_pdf") ?>?cou1=' + mahapola_course1 + '&cen1=' + mahapola_center1+'&mp_year='+mahapola_year+'&all='+all+'&limit='+limit);
    }

    function print_excel_mahapola_data_full()
    {
        var mahapola_course1 = $('#mahapola_course_full').val();
        var mahapola_center1 = $('#center_id_full').val();
        var mahapola_year = $('#mp_full_year').val();

        if($('#chkAll_full_list').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }
        
        if($('#limit_full_list').is(":checked")){
            var limit = $('#limit_txt').val().trim();
            if (limit == null || limit == ''){
                limit = 0;
            }
        }else{
            var limit = 'none';
        }
        
        window.open('<?php echo base_url("report/print_mahapola_data_full_excel") ?>?cou1=' + mahapola_course1 + '&cen1=' + mahapola_center1+'&mp_year='+mahapola_year+'&all='+all+'&limit='+limit);
       
    }

    function print_mahapola_data_not_elig()
    {
        var mahapola_course2 = $('#mahapola_course_not_elig').val();
        var mahapola_center2 = $('#center_id_not_elig').val();
        var mahapola_year = $('#mp_not_year').val();
        
        if($('#chkAll_ne').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }

        window.open('<?php echo base_url("report/mahapola_not_eligible_list_view_pdf") ?>?cou2=' + mahapola_course2 + '&cen2=' + mahapola_center2+'&mp_year='+mahapola_year+'&all='+all);
    }
    
    function print_excel_mahapola_data_not_elig()
    {
        var mahapola_course2 = $('#mahapola_course_not_elig').val();
        var mahapola_center2 = $('#center_id_not_elig').val();
        var mahapola_year = $('#mp_not_year').val();
        
        if($('#chkAll_ne').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }
        
        window.open('<?php echo base_url("report/mahapola_not_eligible_list_view_excel") ?>?cou2=' + mahapola_course2 + '&cen2=' + mahapola_center2+'&mp_year='+mahapola_year+'&all='+all);
    }

    /*
     * load courses
     */
    function load_course_list(center_id)
    {
        $('#mahapola_course').find('option').remove().end();
        $("#mahapola_course").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_mahapola_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#mahapola_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                },
                "json"
                );
    }


    function load_course_list_full(center_id)
    {
        $('#mahapola_course_full').find('option').remove().end();
        $("#mahapola_course_full").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_mahapola_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#mahapola_course_full').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                },
                "json"
                );
    }

    function load_course_list_not_elig(center_id)
    {
        $('#mahapola_course_not_elig').find('option').remove().end();
        $("#mahapola_course_not_elig").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_mahapola_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#mahapola_course_not_elig').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                },
                "json"
                );
    }
    
    
    
//////////////////////////////MAST TAB/////////////////////////////////
    $(document).ready(function () {
        $('#mahapola_appr_stat_tbl').DataTable();
    });



function mast_load_course_list(){
        var center_id = $('#mast_center_id').val();
        
        $('#mast_course').find('option').remove().end();
        $("#mast_course").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Report/load_mahapola_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#mast_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code'] + ' - ' + data[i]['course_name']));
                    }

                },
                "json"
                );
    }

                                function search_mast_students() {
                                    $('.se-pre-con').fadeIn('slow');
                                    var center_id = $('#mast_center_id').val();
                                    var course_id = $('#mast_course').val();
                                    var mp_year = $('#mp_ind_year').val();
                                    
                                    if($('#chkAll_index').is(":checked")){
                                        var all = 1;
                                    }else{
                                        var all = 0;
                                    }

                                    if (all == 0 && center_id == "") {
                                        funcres = {status: "denied", message: "Center cannot be empty!"};
                                        result_notification(funcres);
                                        $('.se-pre-con').fadeOut('slow');
                                    } else {



                                        $.post("<?php echo base_url('Report/search_mast_students') ?>", {'center_id': center_id, 'course_id': course_id, 'mp_year':mp_year, 'all':all},
                                                function (data)
                                                {
//                                                    console.log(data);
                                                    if (data == 'denied')
                                                    {
                                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                                        result_notification(funcres);
                                                    } else {
                                                       
                                                        $('#mahapola_appr_stat_tbl').DataTable().clear().draw();

                                                        if (data.length > 0) {
                                                            $('#print_mast_search').removeAttr('disabled');
                                                            for (j = 0; j < data.length; j++) {

                                                                number_content = "<td align='center'>" + (j + 1) + "</td>";

                                                                action_content = "<td align='center'><a data-toggle='tooltip' title='View Print' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_info_report_view(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> | \n\
                        <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['exam_id'] + ", 1 )' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |\n\
                        <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_defined_exam_status(" + data[j]['id'] + ", 3 )' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                                                                $('#mahapola_appr_stat_tbl').DataTable().row.add([
                                                                    number_content,
                                                                    data[j]['reg_no'],
                                                                    data[j]['first_name'],
                                                                    data[j]['nic'],
                                                                    data[j]['al_subject_stream'],
                                                                    data[j]['al_z_score'],
                                                                    data[j]['distance'],
                                                                    data[j]['schl_attendies'],
                                                                    data[j]['schl_going_concession'],
                                                                    data[j]['ou_attendies'],
                                                                    data[j]['ou_going_concession'],
                                                                    data[j]['income_from_land'],
                                                                    data[j]['income_from_rent'],
                                                                    data[j]['empld_salary'],
                                                                    data[j]['spouse_annual_income'],
                                                                    data[j]['fa_annual_income'],
                                                                    data[j]['mo_annual_income'],
                                                                    data[j]['total_income'],
                                                                    data[j]['ga_income'],
                                                                    data[j]['need_index']
                                                                    
                                                                        //                                  ,action_content


                                                                        //action_content
                                                                ]).draw(false);
                                                            }
                                                        } else {
                                                            $('#print_mast_search').attr('disabled', 'disabled');
                                                            //$('#bulk_approve').attr('disabled', true);
                                                        }
                                                    }
                                                    $('.se-pre-con').fadeOut('slow');
                                                },
                                                "json"
                                                );
                                    }
                                }
                                
function print_mast_search(){
        var center_id = $('#mast_center_id').val();
        var course_id = $('#mast_course').val();
        var mp_year = $('#mp_ind_year').val();
        
        if($('#chkAll_index').is(":checked")){
            var all = 1;
        }else{
            var all = 0;
        }

        window.open('<?php echo base_url("report/print_mast_search") ?>?cen=' + center_id + '&cou=' + course_id +'&mp_year='+mp_year+'&all='+all);
    }

//function search_mast_students(){
//        
//        var center_id = $('#mast_center_id').val();
//        var course_id = $('#mast_course').val();
//        
//
//        $.post("<?php echo base_url('Report/search_mast_students') ?>", { 'center_id': center_id,
//                                                                       'course_id': course_id},
//                function (data)
//                {
//                    console.log(data);
//                    if (data == 'denied')
//                    {
//                        funcres = {status: "denied", message: "You have no right to proceed the action"};
//                        result_notification(funcres);
//                    } else
//                    {
//                        $('#mahapola_appr_stat_tbl').DataTable().destroy();
//                        $('#mahapola_appr_stat_tbl').DataTable({
//                            'ordering': true,
//                            'paging': true,
//                            //'scrollX':true,
//                            'searching': false,
//                            'lengthChange': true,
//                            'lengthMenu': [20, 35, 50, 75, 100],
//                            'info': false,
//                            "columnDefs": [{
//                                    "targets": 0,
//                                    "className": "text-center"
//                                },
//                                {
//                                    "targets": 6,
//                                    "className": "text-center"
//                                }]
//                        });
//                        $('#mahapola_appr_stat_tbl').DataTable().clear();
//
//                        var t = 1;
//                        if (data['mahapola'].length > 0)
//                        {
//                            $('#print_mast_search').attr('disabled', false);
//
////                    $('#student_count').val(data['stu_count'][0]['stu_count']);
////                    $('#mahapola_count').val(data['mahapola'][0]['mp_count']);
////                    $('#course_name').val(data['mahapola'][0]['course_code']);
//
//                            for (j = 0; j < data['mahapola'].length; j++) {
//
//                                $('#mahapola_appr_stat_tbl').DataTable().row.add([
//                                    t,
//                                    data['mahapola'][j]['first_name'],
//                                    data['mahapola'][j]['last_name'],
//                                    data['mahapola'][j]['al_year'],
//                                    data['mahapola'][j]['al_index_no'],
//                                    data['mahapola'][j]['al_z_core'],
//                                    data['mahapola'][j]['sex'],
//                                    data['mahapola'][j]['nic_no'],
//                                    data['mahapola'][j]['course_code'],
//                                    data['mahapola'][j]['reg_no'],
//                                    data['mahapola'][j]['permanent_address'],
//                                    data['mahapola'][j]['need_index'],
//                                    ''
//                                ]).draw(false);
//
//                                t++;
//                            }
//                        } else {
//                            $('#print_btn').attr('disabled', true);
//                        }
//                    }
//                },
//                "json"
//                );
//    
//}


    function mp_summary_search(){
        var mp_summary_year = $('#mp_summary_year').val();
        
        $('#mp_summary_tbl').DataTable().destroy();
        $('#mp_summary_tbl').DataTable({});
        $('#mp_summary_tbl').DataTable().clear().draw();

        $.post("<?php echo base_url('Report/mp_summary_search') ?>", {'mp_summary_year': mp_summary_year},
            function (data)
            {
                if (data == 'denied')
                {
                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                    result_notification(funcres);
                } else
                {
                    var w = 1;
                    if (data['registrar'].length > 0)
                    {
                        $('#mp_summary_tbl').attr('disabled', false);
                        for (k = 0; k < data['registrar'].length; k++) {

                            $('#mp_summary_tbl').DataTable().row.add([
                                w,
                                data['registrar'][k]['br_name']
                            ]).draw(false);

                            w++;
                        }
                    } else {
                        $('#mp_summary_year_print_btn').attr('disabled', true);
                    }
                }
            },
            "json"
        );
    }

</script>

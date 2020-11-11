<style>
    .ui-datepicker{
        display:none !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i> COMPANY</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Company</li>
        </ol>
    </div>
</div>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="myTab">
        <?php
        $isactive = '';
        if ($this->auth->check_tab_access("Group")) {
            $isactive = 'comp';
            ?>
            <li role="presentation" class="active"><a id="comp_tab" href="#company_tab" aria-controls="company_tab" role="tab" data-toggle="tab">Group</a></li>
            <?php
        }
        ?>
            <?php
        if ($this->auth->check_tab_access("Branch")) {
            if ($isactive == '') {
                $isactive = 'bran';
                ?>
                <li role="presentation" class="active"><a id="br_tab" href="#branch_tab" aria-controls="branch_tab" role="tab" data-toggle="tab">Center</a></li>
                <?php
            } else {
                ?>
                <li role="presentation"><a id="br_tab" href="#branch_tab" aria-controls="branch_tab" role="tab" data-toggle="tab">Center</a></li>
                <?php
            }
        }
        ?>
            
        <?php
        if ($this->auth->check_tab_access("Company")) {
            ?>
            <li role="presentation"><a id="grp_tab" href="#group_tab" aria-controls="group_tab" role="tab" data-toggle="tab">Company</a></li>
            <?php
        }
        ?>
        
                
        <?php
        if ($this->auth->check_tab_access("Hall")) {
            ?>
            <li role="presentation"><a id="hall_tab" href="#h_tab" aria-controls="hall_tab" role="tab" data-toggle="tab">Hall</a></li>
        <?php }
        ?>
                        
        <?php
        if ($this->auth->check_tab_access("Fyear")) {
            ?>
            <li role="presentation"><a id="fy_tab" href="#fyear_tab" aria-controls="fyear_tab" role="tab" data-toggle="tab">Financial Year</a></li>
            <?php
        }
        ?>
            
        <?php
        if ($this->auth->check_tab_access("Other")) {
            ?>
            <li role="presentation"><a data-toggle="tab" id="ay_tab" href="#ayear_tab" aria-controls="ayear_tab" role="tab" data-toggle="tab">Study Season</a></li>
            <!--<li role="presentation"><a id="tp_tab" href="#tperiod_tab" aria-controls="tperiod_tab" role="tab" data-toggle="tab">Term Period</a></li>-->

        <?php
             }
             ?>
            
        <?php
        if ($this->auth->check_tab_access("Range")) {
            ?>
            <li role="presentation"><a id="regrange_tab" href="#rrange_tab" aria-controls="rrange_tab" role="tab" data-toggle="tab">Student Registration Number Range</a></li>
            <?php
        }
        ?>
            
        <?php
        if ($this->auth->check_tab_access("Version")) {
            ?>
            <li role="presentation"><a id="vers_tab" href="#version_tab" aria-controls="version_tab" role="tab" data-toggle="tab">Subject Version</a></li>
            <?php
        }
        ?>
		
		<?php
        if ($this->auth->check_tab_access("News")) {
            ?>
            <li role="presentation"><a id="news1_tab" href="#news_tab" aria-controls="news_tab" role="tab" data-toggle="tab">News</a></li>
            <?php
        }
        ?>
		
		<?php
        if ($this->auth->check_tab_access("Events")) {
            ?>
            <li role="presentation"><a id="events1_tab" href="#event_tab" aria-controls="event_tab" role="tab" data-toggle="tab">Events</a></li>
            <?php
        }
        ?>
            
            <?php
        if ($this->auth->check_tab_access("Signature Authority")) {
            ?>
            <li role="presentation"><a id="sig_tab" href="#sigauth_tab" aria-controls="sigauth_tab" role="tab" data-toggle="tab">Signature Authority</a></li>
            <?php
        }
        ?>
            
            
            
            
        
            
        
        
       
       <!-- Student Registration Number Range -->
     
            
        
        
        
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <?php
        if ($isactive == 'comp') {
            echo '<div role="tabpanel" class="tab-pane active" id="company_tab">';
        } else {
            echo '<div role="tabpanel" class="tab-pane" id="company_tab">';
        }
        ?>
        <div class="panel">
            <header class="panel-heading">
                Group of Company Information
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/update_comp_info') ?>" id="comp_form" autocomplete="off" novalidate>

                            <div class="form-group">
                                <input type="hidden" id="comp_id" name="comp_id" value="<?php echo $comp_info['comp_id'] ?>">
                                <label for="name" class="col-md-1 control-label">Comp.Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="name" name="name" placeholder="" value="<?php echo $comp_info['comp_name'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="brnum" class="col-md-1 control-label">Reg.No.</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="brnum" name="brnum" placeholder="" value="<?php echo $comp_info['comp_brno'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>

                                <label for="comcode" class="col-md-1 control-label">Comp.Code</label>
                                <div class="col-md-2">
                                    <input type="text" data-validation="required" data-validation-error-msg-required="field cannot be empty" class="form-control" id="comcode" name="comcode" placeholder="" value="<?php echo $comp_info['comp_code'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="addl1" class="col-md-1 control-label">Address</label>
                                <div class="col-md-4">
                                    <input type="text" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="addl1" name="addl1" placeholder="" value="<?php echo $comp_info['comp_addl1'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="addl2" class="col-md-1 control-label"></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="addl2" name="addl2" placeholder="" value="<?php echo $comp_info['comp_addl2'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-md-1 control-label"></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $comp_info['comp_city'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="country" class="col-md-1 control-label"></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo $comp_info['comp_country'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telephone" class="col-md-1 control-label">Telephone</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="telephone" name="telephone" onkeypress = "return AllowNumbersOnly(event)" required="Enter Batch_No" data-validation="required number length " data-validation-length="10-10" data-validation-error-msg-required="Field can not be empty"  data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" value="<?php echo $comp_info['comp_telephone'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                                <!-- </div>
                                <div class="form-group"> -->
                                <label for="fax" class="col-md-1 control-label">Fax No</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="fax" name="fax" onkeypress = "return AllowNumbersOnly(event)" placeholder="" data-validation="required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long" value="<?php echo $comp_info['comp_fax'] ?>">
                                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                                </div>
                            </div>
                            <div class="panel-footer">
                <button onclick="event.preventDefault();$('#comp_form').trigger('submit');" class="btn btn-info">Save</button>
                <button onclick="event.preventDefault();
                    $('#comp_form').trigger('reset');
                    $('#comp_id').val('');
                    $('#name').val('');
                    $('#brnum').val('');
                    $('#comcode').val('');
                    $('#addl1').val('');
                    $('#addl2').val('');
                    $('#city').val('');
                    $('#country').val('');
                    $('#telephone').val('');
                    $('#fax').val('');
                    
                    " class="btn btn-default">Reset</button>
            </div>
                        </form>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="group_tab">
        <div class="panel">
            <header class="panel-heading">
                Manage Company
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_group') ?>" id="grp_form" autocomplete="off" novalidate>
                            <div class="form-group"><br/><br/>
                                <input type="hidden" id="group_id" name="group_id">
                                <label for="grname" class="col-md-2 control-label">Company Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="grname" name="grname" placeholder=""> 	
                                </div>
                            </div>  
                        </form>  	
                    </div>
                    <div class="col-md-7  left-line">
                        <!-- <header class="panel-heading">
                        Look Up
                        </header> -->
                        <table class="table table-bordered" id="table1">
                            <thead>
                                <tr bgcolor="#F0EEF1">
                                    <th>Company</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($grp_info as $grp) {
                                    echo "<tr>";
                                    echo "<td>" . $grp['grp_name'] . "</td>";
                                    echo "<td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_group_load(" . $grp['grp_id'] . ",\"" . $grp['grp_name'] . "\")'>Edit</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button onclick="event.preventDefault();$('#grp_form').trigger('submit');" class="btn btn-info btn-md">Save</button> 
                <button onclick="event.preventDefault();$('#grp_form').trigger('reset');$('#group_id').val('');" class="btn btn-default">Reset</button>  
            </div>
        </div>
    </div>
    <?php
    if ($isactive == 'bran') {
        echo '<div role="tabpanel" class="tab-pane active" id="branch_tab">';
    } else {
        echo '<div role="tabpanel" class="tab-pane" id="branch_tab">';
    }
    ?>
    <div class="panel">
        <header class="panel-heading">
            Manage Centers
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 right-line">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_branch') ?>" id="br_form" autocomplete="off" novalidate>


                        <div class="form-group"><br/>
                            <label for="br_grp" class="col-md-2 control-label">Company</label>
                            <div class="col-md-10">
                                <select type="text" class="form-control" data-validation="required" onchange="load_branches(this.value)" data-validation-error-msg-required="Field can not be empty" id="brgrp" name="brgrp">
                                    <option value=''>-----Select a group to load Centers-----</option>
                                    <?php
                                    foreach ($grp_info as $grp) {
                                        echo "<option value='" . $grp['grp_id'] . "'>" . $grp['grp_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="br_id" name="br_id">
                            <label for="brname" class="col-md-2 control-label">Center Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="brname" name="brname" placeholder="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <!-- </div>
                            <div class="form-group"> -->
                            <label for="brcode" class="col-md-1 control-label">Center Code</label>
                            <div class="col-md-4">
                                <input type="text" data-validation="required" maxlength="10" class="form-control" id="brcode" name="brcode" placeholder="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="braddl1" class="col-md-2 control-label">Address</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="braddl1" name="braddl1" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="braddl2" class="col-md-2 control-label"></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="braddl2" name="braddl2" placeholder="">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brcity" class="col-md-2 control-label"></label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="brcity" name="brcity" placeholder="City">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="brcountry" class="col-md-2 control-label"></label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="brcountry" name="brcountry" placeholder="Country">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brtelephone" class="col-md-2 control-label">Telephone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="brtelephone" name="brtelephone" onkeypress = "return AllowNumbersOnly(event)"  placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                            <!-- </div>
                            <div class="form-group"> -->
                            <label for="brfax" class="col-md-1 control-label">Fax</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="brfax" name="brfax" onkeypress = "return AllowNumbersOnly(event)" placeholder="" data-validation="required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="10-10" data-validation-error-msg-number="Invalid. Please Try Again. ex: 0111234567" data-validation-error-msg-length="Must be 10 characters long">
                                <!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 left-line"  style="height: 300px; overflow-y: scroll;">
                    <!--style="height: 300px; overflow-y: scroll;"-->
                    <table class="table table-striped table-bordered dt-responsive" id="table4" >
                        <thead>
                            <tr>
                                <th>Center</th>
                                <th>Address</th>
                                <th>Telephone</th>
                                <th>Fax</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="br_table_body" >
                            <tr>
                                <td colspan="5">Select a group to search branches</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>	  		
        </div>
        <div class="panel-footer">
            <button onclick="event.preventDefault();$('#br_form').trigger('submit');" class="btn btn-info">Save</button> 
            <button onclick="event.preventDefault();$('#br_form').trigger('reset');$('#br_id').val('');$('#br_table_body').empty('');" class="btn btn-default">Reset</button>		  
        </div>
    </div>

</div>

<div role="tabpanel" class="tab-pane" id="h_tab">
    <div class="panel">
        <header class="panel-heading">
            Manage Halls
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 right-line">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('hall/save_hall') ?>" name="hall_form" id="hall_form" autocomplete="off">
                        <br/>
<!--                        <input type="text" id="id_hall" name="id_hall">-->
                        <div class="form-group">
                            <label for="c_name" class="col-md-2 control-label">Center</label>
                            <div class="col-md-10">
                                <?php 
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="c_name" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                    echo form_dropdown('c_name',$branchdrop,$selectedbr, $extraattrs); 
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="hall_id" id="hall_id">
                            <label for="hall_name" class="col-md-2 control-label">Hall Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="h_name" name="h_name" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lec_capacity" class="col-md-2 control-label">Lecture Capacity</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="l_capacity" name="l_capacity" data-validation="required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="1-1500" data-validation-error-msg-number="Invalid Amount." data-validation-allowing="range[1;1500],int">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exam_capacity" class="col-md-2 control-label">Exam Capacity</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="e_capacity" name="e_capacity" data-validation="required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="1-1500" data-validation-error-msg-number="Invalid Amount." data-validation-allowing="range[1;1500],int">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="des" class="col-md-2 control-label">Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="des" name="des"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-bordered dt-responsive " id="table_hall">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Center</th>
                                <th>Hall</th>
                                <th>Lecture Capacity</th>
                                <th>Exam Capacity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($halls as $va) {
                                ?>
                                <tr>
                                    <td><?php echo $va['br_name']; ?></td>
                                    <td><?php echo $va['hall_name']; ?></td>
                                    <td><?php echo $va['lecture_capacity']; ?></td>
                                    <td><?php echo $va['exam_capacity']; ?></td>
                                    
                                    <th><a class="btn btn-info btn-xs" onclick="event.preventDefault();edit_hall_load('<?php echo $va['id'] ?>','<?php echo $va['center_id'] ?>', '<?php echo $va['hall_name'] ?>', '<?php echo $va['lecture_capacity'] ?>', '<?php echo $va['exam_capacity'] ?>', '<?php echo $va['description'] ?>')">Edit</a>
                                        <!--<a class="btn btn-info btn-xs" onclick="event.preventDefault();edit_hall_load('<?php echo $ver['version_id'] ?>','<?php echo $ver['version_name'] ?>','<?php echo $ver['description'] ?>')">Edit</a></th>-->
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>

            </div>	  		
        </div>
        <div class="panel-footer">
            <button onclick="event.preventDefault();$('#hall_form').trigger('submit');" class="btn btn-info">Save</button> 
            <button onclick="event.preventDefault();$('#hall_form').trigger('reset');$('#hall_id').val('');" class="btn btn-default">Reset</button>		  
        </div>
    </div>

</div>

<div role="tabpanel" class="tab-pane" id="fyear_tab">
    <div class="panel">
        <header class="panel-heading">
            Financial Year
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_fyear') ?>" id="fy_form" autocomplete="off" novalidate>
                        <div class="form-group"><br/><br/>
                            <input type="hidden" id="fy_id" name="fy_id">
                            <label for="br_grp" class="col-md-2 control-label">Start_Date</label>
                            <div class="col-md-7">
                                <div id="fs_date_div" class="input-group date">
                                    
                                    <input class="form-control datepicker error" onkeypress = "return AllowNumbersOnly(event)" data-validation="required" data-validation-error-msg-required="Empty field" type="text" name="fs_date" id="fs_date"  data-format="YYYY-MM-DD">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brname" class="col-md-2 control-label">End_Date</label>
                            <div class="col-md-7">
                                <div id="fe_date_div" class="input-group date">
                                    <input class="form-control datepicker error" data-validation="required" onkeypress = "return AllowNumbersOnly(event)" data-validation-error-msg-required="Empty field" type="text" name="fe_date" id="fe_date"  data-format="YYYY-MM-DD" >
                                    <span class="input-group-addon" ><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="developer" class="col-md-2 control-label">Current_Year</label>
                            <div class="col-md-5">
                                <input type="checkbox" id="is_curr" name="is_curr" >
                            </div>
                        </div> 
                    </form>
                </div>
                <div class="col-md-7 left-line">	
                    <table class="table table-bordered" id="table2">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>financial Year</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($fy_info as $fy) {
                                if ($fy['fi_iscurryear'] == 1) {
                                    echo "<tr class='danger'>";
                                } else {
                                    echo "<tr>";
                                }
                                echo "<td>" . $fy['fi_startdate'] . " - " . $fy['fi_enddate'] . "</td>";
                                echo "<td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_fy_year(" . $fy['es_finance_masterid'] . ",\"" . $fy['fi_startdate'] . "\",\"" . $fy['fi_enddate'] . "\",\"" . $fy['fi_iscurryear'] . "\")'>Edit</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button onclick="event.preventDefault();$('#fy_form').trigger('submit');" class="btn btn-info">Save</button> 
            <button onclick="event.preventDefault();$('#fy_form').trigger('reset');$('#fy_id').val('');" class="btn btn-default">Reset</button>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane" id="ayear_tab">
    <div class="panel">
        <header class="panel-heading">
            Study Season
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_ayear') ?>" id="ay_form" autocomplete="off" novalidate>
                        <div class="form-group"><br/><br/>
                            
                            <input type="hidden" id="ay_id" name="ay_id">
                            
                            <label for="as_date" class="col-md-2 control-label">Start Date</label>
                            <div class="col-md-6">
                                <div id="as_date_div" class="input-group date">
                                    <input class="form-control datepicker error" onkeypress = "return AllowNumbersOnly(event)" type="text" name="as_date" id="as_date" data-format="YYYY-MM-DD" value="" data-validation="required" data-validation-error-msg-required="&nbsp;&nbsp;Field is empty" style="border-color: rgb(185, 74, 72);" data-validation-has-keyup-event="true">                                    
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                                                     
                        </div>
                        
                        <div class="form-group"><br/><br/>
                        <label for="ae_date" class="col-md-2 control-label">End Date</label>
                            <div class="col-md-6">
                                <div id="ae_date_div" class="input-group date">
                                    <input class="form-control datepicker error" onkeypress = "return AllowNumbersOnly(event)" data-validation="required" data-validation-error-msg-required="&nbsp;&nbsp;Field is empty" type="text" name="ae_date" id="ae_date"  data-format="YYYY-MM-DD">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="developer" class="col-md-6 control-label">Current Season</label>
                                <div class="col-md-1">
                                    <input type="checkbox" id="is_curr_a" name="is_curr_a" >
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 left-line">	
                    <table class="table table-bordered" id="table3">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Study Season</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ay_info as $ay) {
                                if ($ay['ac_iscurryear'] == 1) {
                                    echo "<tr class='danger'>";
                                } else {
                                    echo "<tr>";
                                }
                                echo "<td>" . $ay['ac_startdate'] . " - " . $ay['ac_enddate'] . "</td>";
                                echo "<td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_ay_year(" . $ay['es_ac_year_id'] . ",\"" . $ay['ac_startdate'] . "\",\"" . $ay['ac_enddate'] . "\",\"" . $ay['ac_iscurryear'] . "\")'>Edit</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button onclick="event.preventDefault();$('#ay_form').trigger('submit');" class="btn btn-info">Save</button> 
            <button onclick="event.preventDefault();
                    $('#ay_form').trigger('reset');
                    $('#ay_id').val('');
                    $('#terms_div').empty();
                    $('#intakes_div').empty();" class="btn btn-default">Reset</button>
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane" id="tperiod_tab">
    <div class="panel">
        <header class="panel-heading">
            Term Period
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_termperiod') ?>" id="tp_form" autocomplete="off" novalidate>
                        <div class="form-group"><br/><br/>
                            <label for="tp_acayear" class="col-md-1 control-label">Academic_Year</label>
                            <div class="col-md-3">
                                <select type="text" class="form-control" data-validation="required" onchange="load_terms(this.value)" data-validation-error-msg-required="Field can not be empty" id="tp_acayear" name="tp_acayear">
                                    <option value=''></option>
                                    <?php
                                    foreach ($ay_info as $ay) {
                                        if ($ay['ac_iscurryear'] == 1) {
                                            $seltxt = "selected";
                                        } else {
                                            $seltxt = "";
                                        }
                                        echo "<option value='" . $ay['es_ac_year_id'] . "' " . $seltxt . ">" . $ay['ac_startdate'] . " - " . $ay['ac_enddate'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- </div>
                            <div class="form-group"> -->
                            <label for="tp_term" class="col-md-1 control-label">Term</label>
                            <div class="col-md-3">
                                <select type="text" class="form-control" data-validation="required" onchange="load_termsperiods(this.value)" data-validation-error-msg-required="Field can not be empty" id="tp_term" name="tp_term">
                                    <option value=''></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tp_periods" class="col-md-1 control-label">Number_of periods</label>
                            <div class="col-md-3">
                                <input type="text" onblur="load_periodinputs(this.value)" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="tp_periods" name="tp_periods" placeholder="">
                            </div><br/>
                        </div>
                        <div class="row" id="periods_div"></div>
                        <hr> 
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button onclick="event.preventDefault();$('#tp_form').trigger('submit');" class="btn btn-info">Save</button> 
            <button onclick="event.preventDefault();$('#tp_form').trigger('reset');$('#periods_div').empty();" class="btn btn-default">Reset</button>
        </div>
    </div>
</div>

<!-- Student Registration Number Range Form Design -->
<div role="tabpanel" class="tab-pane" id="rrange_tab">
    <div class="panel">
        <header class="panel-heading">
           Student Registration Number Range
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_range') ?>" id="range_form" autocomplete="off" novalidate>
                        <div class="form-group"><br/><br/>
                            <input type="hidden" name="range_id" id="range_id" value="<?php //echo $range_info['id'] ?>">
                            <label for="tp_acayear" class="col-md-1 control-label">Start: </label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" data-validation="required" onchange="" data-validation-error-msg-required="Field can not be empty" id="start" name="start" value="<?php echo $range_info['HGC_SEQ_NextValue'] ?>">
        
                            </div>
                          
                            <label for="tp_term" class="col-md-1 control-label">End: </label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" data-validation="required" onchange="" data-validation-error-msg-required="Field can not be empty" id="end" name="end" value="<?php echo $range_info['HGC_SEQ_Reserved'] ?>">
                            </div>
                            <button onclick="event.preventDefault();$('#range_form').trigger('submit');" class="btn btn-info">Save</button> 
                            <button onclick="event.preventDefault();$('#range_form').trigger('reset');$('#periods_div').empty();" class="btn btn-default">Reset</button>
                        </div>
                        <!-- <div class="form-group">
                            <label for="tp_periods" class="col-md-1 control-label">Number_of periods</label>
                            <div class="col-md-3">
                                <input type="text" onblur="load_periodinputs(this.value)" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="tp_periods" name="tp_periods" placeholder="">
                            </div><br/>
                        </div> -->
                        <div class="row" id="periods_div"></div>
<!--                        <table class="table table-striped table-bordered dt-responsive " id="table_hall">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>ID</th>
                                <th>Start Range</th>
                                <th>End Range</th>
                                <th>Full Range</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($RANGE as $range) {
                                ?>
                                <tr>
                                    <td><?=$range->id;?></td>
                                    <td><?=$range->start_range;?></td>
                                    <td><?=$range->end_range;?></td>
                                    <td><?=$range->full_range;?></td>
                                    <th><a class="btn btn-info btn-xs" onclick="event.preventDefault();edit_range_load('<?php print_r($va['hall_id']) ?>', '<?php print_r($va['id']) ?>', '<?php print_r($va['hall_name']) ?>', '<?php print_r($va['description']) ?>', '<?php print_r($va['lecture_capacity']) ?>', '<?php print_r($va['exam_capacity']) ?>')">Edit</a></th>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>-->
                       
                    </form>
                </div>
                 <div class="col-md-6">
                    
                </div>
                
            </div>
        </div>
        <div class="panel-footer">
            
        </div>
    </div>
</div>

<!-- Subject Version Tab -->
<div role="tabpanel" class="tab-pane" id="version_tab">
    <div class="panel">
        <header class="panel-heading">
           Subject Version
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('company/save_version') ?>" id="version_form" autocomplete="off" novalidate>
                        <div class="form-group"><br/><br/>
                            <input type="hidden" name="version_id" id="version_id">
                                                                                   
                            <label for="tp_acayear" class="col-md-2 control-label">Version Name : </label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" data-validation="required" onchange="load_termsperiods(this.value)" data-validation-error-msg-required="Field can not be empty" id="version_name" name="version_name" value="">
        
                            </div>
                            <!-- </div>
                            <div class="form-group"> -->
                            <label for="tp_term" class="col-md-2 control-label">Version Description: </label>
                            <div class="col-md-3">
                                
                                <input type="text" class="form-control" data-validation="required" onchange="load_termsperiods(this.value)" data-validation-error-msg-required="Field can not be empty" id="description" name="description" value="">
                            </div>
                            <button onclick="event.preventDefault();$('#version_form').trigger('submit');" class="btn btn-info">Save</button> 
                            <button onclick="event.preventDefault();$('#version_form').trigger('reset');$('#periods_div').empty();" class="btn btn-default">Reset</button>
                        </div>
                        <!-- <div class="form-group">
                            <label for="tp_periods" class="col-md-1 control-label">Number_of periods</label>
                            <div class="col-md-3">
                                <input type="text" onblur="load_periodinputs(this.value)" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" id="tp_periods" name="tp_periods" placeholder="">
                            </div><br/>
                        </div> -->
                        
                        <table class="table table-striped table-bordered dt-responsive " id="version_tbl">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>#</th>
                                <!--<th>Version ID</th>-->
                                <th>Version Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($VERSION as $ver) {
                                ?>
                                <tr>
                                    <th><?php echo $i++; ?></th>
                                    <!--<td id="vid"><?php echo $ver['version_id']?></td>-->
                                    <td id="vname"><?php echo $ver['version_name']?></td>
                                    <td id="vdesc"><?php echo  $ver['description']?></td> 
<!--                                    <th><a id="btn1" class="btn btn-info btn-xs" onclick='event.preventDefault();edit_version_load(" . $ver['version_id'] . ",\"" . $ver['version_name'] . "\",\"" . $ver['description'] . "\")'>Edit</a></th>-->
                                    <th>
                                        <!--<a id="btn1" class="btn btn-info btn-xs" onclick="event.preventDefault();edit_version_load('<?php echo $ver['version_id'] ?>','<?php echo $ver['version_name'] ?>','<?php echo $ver['description'] ?>')">Edit</a>-->
                                        <a id="btn1" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs" onclick="event.preventDefault();edit_version_load('<?php echo $ver['version_id'] ?>','<?php echo $ver['version_name'] ?>','<?php echo $ver['description'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> |  
                                        
                                    <?php 
                                    if ($ver["status"] == "0") { ?>
                                                    <button title="Deactivate" onclick="event.preventDefault();update_version_status('<?php print_r($ver["version_id"]) ?>', '1')" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>
                                                <?php } else { ?>
                                                    <button title="Activate" onclick="event.preventDefault();update_version_status('<?php print_r($ver["version_id"]) ?>', '0')" class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>
                                                    <?php } ?>                                    
                                    </th>
                                    
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                       
                    </form>
                </div>
                 <div class="col-md-6">
                    
                </div>
                
            </div>
        </div>
        <div class="panel-footer">
            
        </div>
    </div>
</div>
<div role="tabpanel" class="tab-pane" id="news_tab">
    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Company/savenews') ?>" id="news_form">
		<div class="panel">
			<header class="panel-heading">
				News
			</header>
			<div class="panel-body">
				<div class="col-md-5" style="float:left;">
					<input type="hidden" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="news_id" name="news_id" placeholder="">
					<label>Add News Title</label>
						<div>
							<input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="news_tile" name="news_tile" placeholder="">
						</div>
					<br>
					<label>Add News URL</label>
						<div>
							<textarea class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="news_url" name="news_url" placeholder=""></textarea>
						</div>
					<br>
					<button class="btn btn-info btn-md">Save</button>&nbsp;
					<button class="btn btn-default" onclick="event.preventDefault();
                    $('#news_form').trigger('reset');
                    $('#news_tile').val('');
                    $('#news_url').val('');
                    ">Clear</button>
				</div>
				<div class="col-md-7" style="float:right;"> 
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>News title</th>
                                <th>News URL</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($news as $new) {
								if ($new['is_deleted'] != 1) {
                                ?>
                                <tr>
                                    <td><?php echo $new['news_name']; ?></td>
                                    <td><?php echo $new['news_url']; ?></td>                                    
									<th><a class="btn btn-info btn-xs" onclick="event.preventDefault();edit_news_load('<?php echo $new['news_id'] ?>','<?php echo $new['news_name'] ?>','<?php echo $new['news_url'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <button onclick="event.preventDefault();update_delete_status('<?php echo $new['news_id'] ?>')" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
								</tr>
								<?php }} ?>
                        </tbody>
                    </table>
				</div>
			</div>
			<div class="panel-footer">
			</div>
		</div>
	</form>
</div>
<div role="tabpanel" class="tab-pane" id="event_tab">
    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Company/savevents') ?>" id="evn_fm">
		<div class="panel">
			<header class="panel-heading">
			   Events
			</header>
			<div class="panel-body">
				<div class="col-md-5" style="float:left;">
				<input type="hidden" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="event_id" name="event_id" placeholder="">
				<label>Add Event Title</label>
				<div>
					<input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="event_tile" name="event_tile" placeholder="">
				</div>
				<br>
				<label>Add Event URL</label>
				<div>
					<textarea class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="event_url" name="event_url" placeholder=""></textarea>
				</div>
				<br>
				<button class="btn btn-info btn-md">Save</button>&nbsp;
				<button class="btn btn-default" onclick="event.preventDefault();
                    $('#evn_fm').trigger('reset');
                    $('#event_tile').val('');
                    $('#event_url').val('');
                    ">Clear</button>
				</div>
				<div class="col-md-7" style="float:right;"> 
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Events title</th>
                                <th>Events URL</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($posts as $post) {
                                if ($post['is_deleted'] != 1) {
								?>
                                <tr>
                                    <td><?php echo $post['events_name']; ?></td>
                                    <td><?php echo $post['events_url']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs" onclick="event.preventDefault();edit_events_load('<?php echo $post['events_id'] ?>','<?php echo $post['events_name'] ?>','<?php echo $post['events_url'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();update_deletevent_status('<?php echo $post['events_id'] ?>')" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>
				</div>
			</div>
			<div class="panel-footer">
			
			</div>
		</div>
	</form>
</div>
<div role="tabpanel" class="tab-pane" id="sigauth_tab">
    <form class="form-horizontal" autocomplete="off" role="form" method="post" action="<?php echo base_url('Company/save_authority') ?>" id="sign_fm">
		<div class="panel">
			<header class="panel-heading">
			   Signature Authority
			</header>
			<div class="panel-body">
				<div class="col-md-5" style="float:left;">
				<input type="hidden" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="sign_id" name="sign_id" placeholder="">
                                    <label>Select Type</label>
                                        <div>
                                            <select type="text" class="form-control" id="sig_type" name="sig_type">
                                                <option value='1'>Report</option>          <!-- RPT -->
                                                <option value='2'>Designation</option>     <!-- DSG -->
                                                <option value='3'>Qualification</option>   <!-- QLF -->
                                                <option value='4'>Mahapola Report</option> <!-- MHPRPT -->
                                                <option value='5'>Result</option>          <!-- RSLT -->
                                                <option value='6'>Exam Directors</option>   <!-- EXM -->
                                            </select>
                                        </div>
                                        <br>
                                    <label>Add Name</label>
                                    <div>
                                        <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="sig_name" name="sig_name" placeholder="">
                                    </div>
                                    <br>
                                    <label>Add Position</label>
                                    <div>
                                        <textarea class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="sig_position" name="sig_position" placeholder=""></textarea>
                                    </div>
                                    <br>
                                    <label>Admitted Date</label>
                                    <div>
                                        <input class="form-control datepicker" onkeypress="" data-validation="required" data-validation-error-msg-required="Empty field" type="text" name="sig_admi" id="sig_admi" data-format="YYYY-MM-DD">
                                    </div>
                                    <br>
                                    <label>Commence Date</label>
                                    <div>
                                        <input class="form-control datepicker" onkeypress="" data-validation="required" data-validation-error-msg-required="Empty field" type="text" name="sig_comen" id="sig_comen" data-format="YYYY-MM-DD">
                                    </div>
                                    <br>
                                    <button class="btn btn-info btn-md">Save</button>&nbsp;
                                    <button class="btn btn-default" onclick="event.preventDefault();
                    $('#sign_fm').trigger('reset');
//                    $('#sig_name').val('');
//                    $('#sig_position').val('');
//                    $('#sig_admi').val('');
//                    $('#sig_comen').val('');
                    ">Clear</button>
				</div>
				<div class="col-md-7" style="float:right;"> 
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="pos_table">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Name</th>
                                <th>Position</th>
				<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authority as $auth) {
                                if ($auth['group'] == 1) {
								?>
                                <tr>
                                    <td><?php echo $auth['name']; ?></td>
                                    <td><?php echo $auth['position']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs" title="Edit Report" onclick="event.preventDefault();edit_auth_sig('<?php echo $auth['id'] ?>','<?php echo $auth['group'] ?>','<?php echo $auth['name'] ?>','<?php echo $auth['position'] ?>','<?php echo $auth['date_admitted'] ?>','<?php echo $auth['date_commence'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();delete_autho('<?php echo $auth['id'] ?>')" title="Delete Report" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="result_table">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Name</th>
                                <th>Position</th>
				<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authority as $auth) {
                                if ($auth['group'] == 5) {
								?>
                                <tr>
                                    <td><?php echo $auth['name']; ?></td>
                                    <td><?php echo $auth['position']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs" title="Edit Result" onclick="event.preventDefault();edit_auth_sig('<?php echo $auth['id'] ?>','<?php echo $auth['group'] ?>','<?php echo $auth['name'] ?>','<?php echo $auth['position'] ?>','<?php echo $auth['date_admitted'] ?>','<?php echo $auth['date_commence'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();delete_autho('<?php echo $auth['id'] ?>')" title="Delete Result" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>
                        <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="exm_table">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Name</th>
                                <th>Position</th>
				<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authority as $auth) {
                                if ($auth['group'] == 6) {
								?>
                                <tr>
                                    <td><?php echo $auth['name']; ?></td>
                                    <td><?php echo $auth['position']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs" Title="Edit Exam Auth" onclick="event.preventDefault();edit_auth_sig('<?php echo $auth['id'] ?>','<?php echo $auth['group'] ?>','<?php echo $auth['name'] ?>','<?php echo $auth['position'] ?>','<?php echo $auth['date_admitted'] ?>','<?php echo $auth['date_commence'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();delete_autho('<?php echo $auth['id'] ?>')" Title="Delete Exam Auth" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="pos2_table">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Name</th>
                                <th>Position</th>
				<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authority as $auth) {
                                if ($auth['group'] == 2) {
								?>
                                <tr>
                                    <td><?php echo $auth['name']; ?></td>
                                    <td><?php echo $auth['position']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs" title="Edit Designation" onclick="event.preventDefault();edit_auth_sig('<?php echo $auth['id'] ?>','<?php echo $auth['group'] ?>','<?php echo $auth['name'] ?>','<?php echo $auth['position'] ?>','<?php echo $auth['date_admitted'] ?>','<?php echo $auth['date_commence'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();delete_autho('<?php echo $auth['id'] ?>')" title="Delete Designation" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="pos3_table">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Name</th>
                                <th>Position</th>
				<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authority as $auth) {
                                if ($auth['group'] == 3) {
								?>
                                <tr>
                                    <td><?php echo $auth['name']; ?></td>
                                    <td><?php echo $auth['position']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs" title="Edit Qualification" onclick="event.preventDefault();edit_auth_sig('<?php echo $auth['id'] ?>','<?php echo $auth['group'] ?>','<?php echo $auth['name'] ?>','<?php echo $auth['position'] ?>','<?php echo $auth['date_admitted'] ?>','<?php echo $auth['date_commence'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();delete_autho('<?php echo $auth['id'] ?>')" title="Delete Qualification"  class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>                
                    <table class="table table-striped table-bordered dt-responsive  dataTable no-footer" id="date_table">
                        <thead>
                            <tr bgcolor="#F0EEF1">
                                <th>Admitted Date</th>
                                <th>Commence Date</th>
				<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($authority as $auth) {
                                if ($auth['group'] == 4) {
								?>
                                <tr>
                                    <td><?php echo $auth['date_admitted']; ?></td>
                                    <td><?php echo $auth['date_commence']; ?></td>                                    
                                    <th>
									<button class="btn btn-info btn-xs"  title="Edit Date" onclick="event.preventDefault();edit_auth_sig('<?php echo $auth['id'] ?>','<?php echo $auth['group'] ?>','<?php echo $auth['name'] ?>','<?php echo $auth['position'] ?>','<?php echo $auth['date_admitted'] ?>','<?php echo $auth['date_commence'] ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
									<button onclick="event.preventDefault();delete_autho('<?php echo $auth['id'] ?>')" title="Delete Date" class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                </tr>
								<?php }} ?>
                        </tbody>
                    </table>
				</div>
			</div>
			<div class="panel-footer">
			
			</div>
		</div>
	</form>
</div>






<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/select2/select2.full.min.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/select2/select2.min.css') ?>">
<script src='<?php echo base_url("assets/datepicker/bootstrap-datepicker.js") ?>'></script>
<link rel="stylesheet" href="<?php echo base_url('assets/datepicker/datepicker3.css') ?>">

<script type="text/javascript">
    function update_version_status(version_id, status)
        {
         $.ajax(
            {
                url: "<?php echo base_url('company/update_version_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'version_id': version_id, 'status': status},
                success: function ()
                {                          
                        location.reload();
                }
            });
        }
    

    $('.datepicker').datepicker({
        autoclose: true,
        setDate: '2015-01-01'
    }).on('changeDate', function(ev){
           //my work here
           calculate_age($('#birth_date').val());
    });
    
    $(document).ready(function(){
      $('#sig_admi').val('');
      $('#sig_admi').attr("disabled", "disabled");
      $('#sig_comen').val('');
      $('#sig_comen').attr("disabled", "disabled");
      $('#date_table').hide();
      $('#pos2_table').hide();
      $('#pos3_table').hide();
      $('#result_table').hide();
      $('#exm_table').hide();
      
      $('.datepicker').datepicker({
      autoclose: true
    });

    });
    
                 
//$("#fs_date, #fe_date").datepicker();
//
//$("#fe_date").change(function () {
//    var startDate = document.getElementById("fs_date").value;
//    var endDate = document.getElementById("fe_date").value;
// 
//    if ((Date.parse(endDate) <= Date.parse(startDate))) {
//        alert("End date should be greater than Start date");
//        document.getElementById("fe_date").value = "";
//    }
//});
//
//$("#StartDate").change(function () {
//    var startDate = document.getElementById("fs_date").value;
//    var endDate = document.getElementById("fe_date").value;
// 
//    if ((Date.parse(endDate) <= Date.parse(startDate))) {
//        alert("Start date should be lower than End date");
//        document.getElementById("fe_date").value = "";
//    }
//});
$('#sig_type').change(function() {
    if ($(this).val() == 4) {
        $('#sign_fm').trigger('reset');
        $('#sig_type').val('4');
        $('#sig_name').val('');
        $('#sig_name').attr("disabled", "disabled");
        $('#sig_position').val('');
        $('#sig_position').attr("disabled", "disabled");
        $('#sig_admi').val('');
        $('#sig_admi').removeAttr("disabled");
        $('#sig_comen').val('');
        $('#sig_comen').removeAttr("disabled");
        $('#pos_table').hide();
        $('#pos2_table').hide();
        $('#pos3_table').hide();
        $('#date_table').show();
        $('#result_table').hide();
        $('#exm_table').hide();
    } else if ($(this).val() == 1 || $(this).val() == 5 || $(this).val() == 6){
        //$('#sign_fm').trigger('reset');
        $('#sig_name').val('');
        $('#sig_name').removeAttr("disabled");
        $('#sig_position').val('');
        $('#sig_position').removeAttr("disabled");
        $('#sig_admi').val('');
        $('#sig_admi').attr("disabled", "disabled");
        $('#sig_comen').val('');
        $('#sig_comen').attr("disabled", "disabled");
        
        if($(this).val() == 1){
            $('#sig_type').val('1');
            $('#pos_table').show();
            $('#result_table').hide();
            $('#exm_table').hide();
        }
        else if($(this).val() == 5){
            $('#sig_type').val('5');
            $('#pos_table').hide();
            $('#result_table').show();
            $('#exm_table').hide();
        }
        else if($(this).val() == 6){
            $('#sig_type').val('6');
            $('#pos_table').hide();
            $('#result_table').hide();
            $('#exm_table').show();
        }
        $('#pos2_table').hide();
        $('#pos3_table').hide();
        $('#date_table').hide();
    } else if ($(this).val() == 2){
        $('#sign_fm').trigger('reset');
        $('#sig_type').val('2');
        $('#sig_name').val('');
        $('#sig_name').removeAttr("disabled");
        $('#sig_position').val('');
        $('#sig_position').removeAttr("disabled");
        $('#sig_admi').val('');
        $('#sig_admi').attr("disabled", "disabled");
        $('#sig_comen').val('');
        $('#sig_comen').attr("disabled", "disabled");
        $('#pos_table').hide();
        $('#pos2_table').show();
        $('#pos3_table').hide();
        $('#date_table').hide();
        $('#result_table').hide();
        $('#exm_table').hide();
    } else if ($(this).val() == 3){
        $('#sign_fm').trigger('reset');
        $('#sig_type').val('3');
        $('#sig_name').val('');
        $('#sig_name').removeAttr("disabled");
        $('#sig_position').val('');
        $('#sig_position').removeAttr("disabled");
        $('#sig_admi').val('');
        $('#sig_admi').attr("disabled", "disabled");
        $('#sig_comen').val('');
        $('#sig_comen').attr("disabled", "disabled");
        $('#pos_table').hide();
        $('#pos2_table').hide();
        $('#pos3_table').show();
        $('#date_table').hide();
        $('#result_table').hide();
        $('#exm_table').hide();
    }

});
                 
    $(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
	}
    });    
    
                
    $(document).ready(function(){
        $("#btn1").click(function(){
            $("#version_name").text("hello");
        });
    });
               
               
    function AllowNumbersOnly(e){
        var code = (e.which) ? e.which : e.keyCode;
            if (code > 31 && (code < 48 || code > 57)) {
                e.preventDefault();
            }
        }
//                 function editversionload()(){
//                     document.getElementById("v_name").value = "BMW";
//                     //document.getElementById("version_name").value = "BMW";
//                     //document.getElementById("description").value = "BMW";
//                 }

                 
    $(document).ready(function ()
        {
//            tab_id = "<?php //echo $_GET['tab_id'] ?>";
//            if (tab_id == 'group')
//            {
//                $("#grp_tab").trigger("click");
//            } else if (tab_id == 'branch')
//            {
//                $("#br_tab").trigger("click");
//            } else if (tab_id == 'fyear')
//            {
//                $("#fy_tab").trigger("click");
//            }   else if (tab_id == 'hall')
//            {
//                $("#hall_tab").trigger("click");
//            }else if (tab_id == 'other')
//            {
//                $("#ay_tab").trigger("click");
//            } else if (tab_id == 'range')
//            {
//                $("#regrange_tab").trigger("click");
//            }
//            else if (tab_id == 'version')
//            {
//                $("#vers_tab").trigger("click");
//            }
//			else if (tab_id == 'news')
//			{
//                $("#news_tab").trigger("click");
//            }
//	    else if (tab_id == 'events')
//			{
//                $("#events_tab").trigger("click");
//            }
//            else if (tab_id == 'authority')
//			{
//                $("#sig_tab").trigger("click");
//            }
//            else {
//                $("#comp_tab").trigger("click");
//            }
						

//                    else if (tab_id == 'hall')
//                    {
//                        $("#h_tab").trigger("click");
//                    }

//                    else if (tab_id == 'tperiod')
//                    {
//                        $("#tp_tab").trigger("click");
//                    }



//                    else  {
//                        $("#rrange_tab").trigger("click");
//                    }else  {
//                        $("#vers_tab").trigger("click");
//                    }

        load_terms(null);
    });

    $.validate({
        form: '#comp_form'
    });

    $.validate({
        form: '#grp_form'
    });

    $.validate({
        form: '#br_form'
    });

    $.validate({
        form: '#ay_form'
    });

    $.validate({
        form: '#fy_form'
    });

    $.validate({
        form: '#tp_form'
    });

    $.validate({
        form: '#hall_form'
    });

    $.validate({
        form: '#range_form'
    });

    $.validate({
        form: '#version_form'
    });
	
	$.validate({
        form: '#news_form'
    });
	
	$.validate({
        form: '#evn_fm'
    });
    
    $.validate({
        form: '#sign_fm'
    });

    $('#fs_date_div').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
    $('#fe_date_div').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
    $('#as_date_div').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
    $('#ae_date_div').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});

//to display data table....... change pagenation, inputs(student look up).......

    $(document).ready(function () {
        $('#table1').DataTable({
            'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
            "pageLength": 6,
            "columnDefs": [ {
            "targets": 1,
            "orderable": false
            } ]
        });

        $('#table2').DataTable({
            'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
            "pageLength": 6,
            "columnDefs": [ {
            "targets": 1,
            "orderable": false
            } ]
        });

        $('#table3').DataTable({
            'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
            "pageLength": 6,
            "columnDefs": [ {
            "targets": 1,
            "orderable": false
            } ]
        });

//                    $('#table4').DataTable({
//                         "paging": true,
//                        "lengthChange": true,
//                        "pageLength": 6,
//                        "ordering": false,
//                        "searching": false,
//                        "info": true,
//                        "autoWidth": true,
//                        "processing":true,
//                        "language": {
//                        "emptyTable": "Please select to view details."
//                        },"columnDefs": [ {
//                        "targets": 1,
//                        "orderable": false
//                        } ]
//                    });

//                    $('#table4').DataTable({
//                        'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
//                        "pageLength": 6,
//                        "columnDefs": [ {
//                        "targets": 1,
//                        "orderable": false
//                        } ]
//                    });



        $('#table_hall').DataTable({
            'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
            "pageLength": 6,
            "columnDefs": [ {
            "targets": 4,
            "orderable": false
            } ]
        });
        $('#version_tbl').DataTable({
            'dom': 'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
            "pageLength": 6,
            "columnDefs": [ {
            "targets": 3,
            "orderable": false
            } ]
        });


        // $('#table4').DataTable({
        //     "dom" : '<"row"<"col-md-6 form-group"l><"col-md-6 form-group text-left"f>>rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">'
        // });
    });


    function edit_group_load(id, name)
    {
        $('#group_id').val(id);
        $('#grname').val(name);
    }
    
    
    function edit_version_load(id, name, descr){ //, name, desc
        //alert(id);
        $('#version_id').val(id);
       $('#version_name').val(name);
       $('#description').val(descr);
    }
                
//                function update_version_status(version_id, status){
//                    $.ajax({
//                        url: "company/update_version_status",
//                        type: "post",
//                        data: {'version_id': version_id, 'status': status},
//                        success: function (response) {
//                        location.reload();              
//                            }
//                        });
//                    }
                
    function edit_hall_load(id, brname, hname, lcap, ecap, descr){
        console.log(descr);

        $('#hall_id').val(id);
        $('#c_name').val(brname);
        $('#h_name').val(hname);
        $('#l_capacity').val(lcap);
        $('#e_capacity').val(ecap);
        $('#des').val(descr);
    }

    function load_branches(id)
    {
        $('#br_table_body').empty();
        if (id != "")
        {
            $.post("<?php echo base_url('company/load_branches') ?>", {'id': id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    if (data.length > 0)
                    {
                        for (i = 0; i < data.length; i++) {
                            $('#br_table_body').append("<tr><td>[" + data[i]['br_code'] + '] - ' + data[i]['br_name'] + "</td><td>" + data[i]['br_addl1'] + ((data[i]['br_addl2'] != null) ? ', ' + data[i]['br_addl2'] : '') + ((data[i]['br_city'] != null) ? ', ' + data[i]['br_city'] : '') + ((data[i]['br_country'] != null) ? ', ' + data[i]['br_country'] : '') + "</td><td>" + data[i]['br_telephone'] + "</td><td>" + data[i]['br_fax'] + "</td><td><a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_branch_load(" + data[i]['br_id'] + ")'>Edit</a></td></tr>");
                        }
                    } else
                    {
                        $('#br_table_body').append("<tr><td colspan='5'>No Branch found under this group</td></tr>");
                    }
                }
            },
            "json"
            );
        } else
        {
            $('#br_table_body').append("<tr><td colspan='5'>Select a group to search branches</td></tr>");
        }

    }

    function edit_branch_load(id)
    {
        $.post("<?php echo base_url('company/edit_branch_load') ?>", {"id": id},
        function (data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#br_id').val(data.br_id);
                // $('#brgrp').val(data.br_group);
                $('#brname').val(data.br_name);
                $('#brcode').val(data.br_code);
                $('#braddl1').val(data.br_addl1);
                $('#braddl2').val(data.br_addl2);
                $('#brcity').val(data.br_city);
                $('#brcountry').val(data.br_country);
                $('#brtelephone').val(data.br_telephone);
                $('#brfax').val(data.br_fax);
            }
        },
        "json"
        );
    }
               
//               function edit_version_load(version_id)
//                {
//                    $.post("<?php echo base_url('company/edit_version_load') ?>", {"version_id": version_id},
//                    function (data)
//                    {
//                        if(data == 'denied')
//                        {
//                            funcres = {status:"denied", message:"You have no right to proceed the action"};
//                            result_notification(funcres);
//                        }
//                        else
//                        {
//                            $('#version_id').val(data.version_id);
//                            // $('#brgrp').val(data.br_group);
//                            $('#version_name').val(data.version_name);
//                            $('#description').val(data.description_code);
//                            
//                        }
//                    },
//                    "json"
//                    );
//                }
                
                
                
    function edit_fy_year(id, sdate, edate, stat)
    {
        $('#fy_id').val(id);
        $('#fs_date').val(sdate);
        $('#fe_date').val(edate);

        if (stat == 1)
        {
            $('#is_curr').prop('checked', true);
        } else
        {
            $('#is_curr').prop('checked', false);
        }
    }

    function edit_ay_year(id, sdate, edate, stat)
    {
        $('#ay_id').val(id);
        $('#as_date').val(sdate);
        $('#ae_date').val(edate);

        if (stat == 1)
        {
            $('#is_curr_a').prop('checked', true);
        } else
        {
            $('#is_curr_a').prop('checked', false);
        }
    }

    function load_termsperiods(id)
    {
        $('#periods_div').empty();
        $('#tp_periods').val('');
        $.post("<?php echo base_url('company/load_termsperiods') ?>", {'id': id},
        function (data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                if (data.length > 0)
                {
                    if (data.length > 0)
                    {
                        $('#tp_periods').val(data.length);
                        for (i = 0; i <= data.length; i++) {
                            $('#periods_div').append("<div class='col-md-12'><div class='row'><input type='hidden' value='" + data[i]['tprd_id'] + "' id='prdid_" + i + "' name='prdid[" + i + "]'>"
                                    + "<div class='col-md-3'><input type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='tprd_" + i + "' name='tprd_" + i + "' value='" + data[i]['tprd_name'] + "'></div>"
                                    + "<div class='col-md-4'><div id='tpsdate_" + i + "_div' class='input-group date'><input class='form-control' type='text' name='tpsdate_" + i + "' id='tpsdate_" + i + "' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
                                    + "<div class='col-md-4'><div id='tpedate_" + i + "_div' class='input-group date'><input class='form-control' type='text' name='tpedate_" + i + "' id='tpedate_" + i + "' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
                                    + "</div></div>");

                            $('#tpsdate_' + i + '_div').datetimepicker({defaultDate: data[i]['tprd_sdate'], pickTime: false});
                            $('#tpedate_' + i + '_div').datetimepicker({defaultDate: data[i]['tprd_edate'], pickTime: false});
                        }
                    }
                }
            }
        },
        "json"
        );
    }

    function load_periodinputs(num)
    {
        $('#periods_div').empty();
        for (i = 1; i <= num; i++) {
            $('#periods_div').append("<div class='col-md-12'><div class='row'><div class='col-md-1'></div><input type='hidden' id='prdid_" + i + "' name='prdid[" + i + "]'>"
                    + "<div class='col-md-2'><input type='text'  class='form-control' data-validation='required' data-validation-error-msg-required='Field can not be empty' id='tprd_" + i + "' name='tprd_" + i + "'></div>"
                    + "<div class='col-md-2'><div id='tpsdate_" + i + "_div' class='input-group date'><input class='form-control' type='text' name='tpsdate_" + i + "' id='tpsdate_" + i + "' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
                    + "<div class='col-md-2'><div id='tpedate_" + i + "_div' class='input-group date'><input class='form-control' type='text' name='tpedate_" + i + "' id='tpedate_" + i + "' data-validation='required' data-validation-error-msg-required='Field can not be empty' data-format='YYYY-MM-DD'><span class='input-group-addon'><span class='glyphicon-calendar glyphicon'></span></span></div></div>"
                    + "</div></div>");

            $('#tpsdate_' + i + '_div').datetimepicker({defaultDate: " ", pickTime: false});
            $('#tpedate_' + i + '_div').datetimepicker({defaultDate: " ", pickTime: false});
        }
    }

    function load_terms(accy)
    {
        if (accy == null)
        {
            accy = $('#tp_acayear').val();
        }

        $.post("<?php echo base_url('company/load_terms') ?>", {'id': accy},
        function (data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#tp_term').empty();
                $('#tp_term').append("<option value=''></option>");
                if (data['terms'].length > 0)
                {
                    for (i = 0; i < data['terms'].length; i++) {
                        $('#tp_term').append("<option value='" + data['terms'][i]['term_id'] + "'>" + data['terms'][i]['term_number'] + " - [" + data['terms'][i]['term_sdate'] + " - " + data['terms'][i]['term_edate'] + "]</option>");
                    }
                }
            }
        },
        "json"
        );
    }
                


    $('#range_form').on('submit', function(e) {                                                    
        validateRangeField(e);
    });
    

    function validateRangeField(e) 
    {
        var start = $('#start').val();
        var end = $('#end').val();

        if((parseInt(start)) >= (parseInt(end))){

                e.preventDefault();

                funcres = {status: "denied", message: "Start range should be lower than end range."};
                result_notification(funcres);


                return false;

        }  

    };


//$("#fs_date, #fe_date").datepicker();
//
//$("#fe_date").change(function () {
//    var startDate = document.getElementById("fs_date").value;
//    var endDate = document.getElementById("fe_date").value;
// 
//    if ((Date.parse(endDate) <= Date.parse(startDate))) {
//        alert("End date should be greater than Start date");
//        document.getElementById("fe_date").value = "";
//    }
//});
//
//$("#fs_date").change(function () {
//    var startDate = document.getElementById("fs_date").value;
//    var endDate = document.getElementById("fe_date").value;
// 
//    if ((Date.parse(endDate) <= Date.parse(startDate))) {
//        alert("Start date should be lower than End date");
//        document.getElementById("fe_date").value = "";
//    }
//});


    $('#fy_form').on('submit', function(e) {                                                    
        validateDateField(e);
    });


    function validateDateField(e) 
    {
        var start = $('#fs_date').val();
        var end = $('#fe_date').val();

        if((parseInt(fs_date)) > (parseInt(fe_date))){

                e.preventDefault();

                funcres = {status: "denied", message: "Start date is grater than end date."};
                result_notification(funcres);


                return false;

        }  

    };
	
	function edit_news_load(nid, ntil, nurl){
		$('#news_id').val(nid);
        $('#news_tile').val(ntil);
        $('#news_url').val(nurl);
    }
	
	function edit_events_load(eid, etil, eurl){
		$('#event_id').val(eid);
        $('#event_tile').val(etil);
        $('#event_url').val(eurl);
    }
    
    	function edit_auth_sig(sid, stype, sname, spos, sadate, scdate){
            $('#sign_id').val(sid);
            $('#sig_type').val(stype);
            $('#sig_name').val(sname);
            $('#sig_position').val(spos);
            $('#sig_admi').val(sadate);
            $('#sig_comen').val(scdate);

    }
	
	function update_delete_status(news_id, is_deleted)
    {
         $.ajax(
            {
                url: "<?php echo base_url('company/update_delete_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'news_id': news_id, 'is_deleted': is_deleted},
                success: function ()
                {                          
                        location.reload();
                }
            });
    }
	
	function update_deletevent_status(events_id, is_deleted)
    {
         $.ajax(
            {
                url: "<?php echo base_url('company/update_deletevent_status') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'events_id': events_id, 'is_deleted': is_deleted},
                success: function ()
                {                          
                        location.reload();
                }
            });
    }
    
    	function delete_autho(sign_id)
    {
         $.ajax(
            {
                url: "<?php echo base_url('company/delete_autho') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {'id': sign_id},
                success: function ()
                {                          
                        location.reload();
                }
            });
    }
             
</script>
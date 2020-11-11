<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> CENTER DEGREE </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Center Degree</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#batch_tab" href="#batch_tab" aria-controls="batch_tab" role="tab" data-toggle="tab">Batches</a></li>
    <li role="presentation"><a id="#years_tab" href="#years_tab" aria-controls="company_tab" role="tab" data-toggle="tab">Degree Years</a></li>
    <li role="presentation"><a id="#semesters_tab" href="#semesters_tab" aria-controls="group_tab" role="tab" data-toggle="tab">Semesters</a></li>
</ul>
<div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="batch_tab">
        <div class="row">
            <div class="col-md-7">
                <section class="panel">
                    <header class="panel-heading">
                        Degree Batches
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form id="batch_form" name="batch_form" class="form-horizontal" role="form" method="post"  autocomplete="off" novalidate>
                                <div class="form-group">
                                    <input type="hidden" id="batch_id" name="batch_id" >
                                    <input type="hidden" id="degree_id" name="degree_id" >
                                    <label for="faculty" class="col-md-3 control-label">Faculty : </label>
                                    <div class="col-md-7">
                                        <?php 
                                            global $facultydrop;
                                            global $selectedfac;
                                            $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degrees(this.value, 1, null, 0)"';
                                            echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Code:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="load_Dcode" name="load_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degree_name(this.value, 0, null, 0)">
                                            <option value="">---Select Degree Code---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Name:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="load_Dname" name="load_Dname" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degree_code(this.value, 0)">
                                            <option value="">---Select Degree Name---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" style="display: none" id="e_years">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Years:</label>
                                    <div class="col-md-7">
                                        <input type="text" height="70"  class="form-control" id="de_years" name="de_years"  data-validation="required" data-validation-error-msg-required="Field can not be empty" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code</label>
                                    <div class="col-md-7">
                                        <input type="text" height="70"  class="form-control" id="batch_code" name="batch_code"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Study Season :</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="s_season" name="s_season" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Study Season---</option>	
                                            <?php foreach ($study_seasons as $row) { 
                                                    $isselect = '';
                                                    if($row['ac_iscurryear'] == 1)
                                                    {
                                                        $isselect = 'selected';
                                                    }
                                            ?>
                                                <option value="<?php echo $row['es_ac_year_id']; ?>" <?php echo $isselect;?>> 
                                                    <?php echo $row['ac_startdate'] . " to " . $row['ac_enddate']; ?> 
                                                </option>                                    
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Start Date :</label>
                                    <div class="col-md-7">
                                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="YYYY-MM-DD" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                                    <div class="col-md-7">
                                        <textarea class="form-control" name="Bdes" id="Bdes"></textarea>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();save_batch();">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default" onclick="reset_batches();">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>	
                    </div>
                </section>
            </div>
            <div class="col-md-5">
                <section class="panel">
                    <header class="panel-heading">
                        Look Up
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table name="batch_table" id="batch_table" class="table table-striped table-bordered dt-responsive nowrap batch_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Faculty</th>
                                        <th>Degree</th>
                                        <th>Batch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($batches as $row) { ?>
                                        <tr>
                                            <th><?php echo $row['batch_id']; ?></th>
                                            <th><?php echo $row['faculty_code']; ?></th>
                                            <th><?php echo $row['degree_code']; ?></th>
                                            <th><?php echo $row['batch_code']; ?></th>
                                            <th>
                                                <button title="edit" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_batch(<?php echo $row['batch_id'] ?>)"></span></button> |
                                                <?php if ($row['batch_deleted']) { ?>
                                                    <button title="activate" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="change_batch_status('<?php print_r($row['batch_id']) ?>', '0', '<?php print_r($row['batch_code']) ?>')"></span></button></th>
                                            <?php } else { ?>
                                        <button title="deactivate" type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="change_batch_status('<?php print_r($row['batch_id']) ?>', '1', '<?php print_r($row['batch_code']) ?>')"></span></button></th>
                                    <?php } ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="years_tab">
        <div class="row">
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Degree Years
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form name="degree_year_form" id="degree_year_form" class="form-horizontal" role="form" method="post"  autocomplete="off">		
                                <div class="form-group">
                                    <input type="hidden" id="center_degree_id" name="center_degree_id" >
                                    <label for="center" class="col-md-3 control-label">Center : </label>
                                    <div class="col-md-7">
                                        <?php 
                                            global $branchdrop;
                                            global $selectedbr;
                                            $extraattrs = 'id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                            echo form_dropdown('center',$branchdrop,$selectedbr, $extraattrs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="year_faculty" class="col-md-3 control-label">Faculty : </label>
                                    <div class="col-md-7">
                                        <?php 
                                            global $facultydrop;
                                            global $selectedfac;
                                            $facextraattrs = 'id="year_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degrees(this.value, 1, null, 1)"';
                                            echo form_dropdown('year_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Code:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="year_Dcode" name="year_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degree_name(this.value, 1, null, 0)">
                                            <option value="">---Select Degree Code---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Name:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="year_Dname" name="year_Dname" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degree_code(this.value, 1)">
                                            <option value="">---Select Degree Name---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" style="display: none" id="div_years">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Years:</label>
                                    <div class="col-md-7">
                                        <input type="text" height="70"  class="form-control" id="y_years" name="y_years"  data-validation="required" data-validation-error-msg-required="Field can not be empty" readonly="">
                                    </div>
                                </div>
                                <div id="yr_des" class="form-group" style="display: none">
                                    <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                                    <div class="col-md-7">
                                        <textarea class="form-control" name="Ddes" id="Ddes" disabled="" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="yr_Bcode" name="yr_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" style="display:none" id="year_div">
                                    <div class="clone_div" id="clone_div">
                                        <div id="clonedInput1" class="clonedInput row">
                                            <label id="label_year_number1" class="label_year_number col-sm-2 control-label" for="comcode"> Year1:</label>
                                            <div class="col-md-5">
                                                From:<input type="date" class="yearStart form-control" id="year_start" name="year_start[]" placeholder="YYYY-MM-DD" value="">
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-5">
                                                To:<input type="date" class="yearEnd form-control" id="year_end" name="year_end[]" placeholder="YYYY-MM-DD" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();save_semester_years();">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default" onclick="reset_years();">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>	
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Look Up
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table name="year_table" id="year_table" class="table table-striped table-bordered dt-responsive nowrap year_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Center</th>
                                        <th>Faculty</th>
                                        <th>Degree</th>
                                        <th>Batch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($degree_years as $row) {
                                        ?>
                                        <tr>
                                            <th><?php echo $i ?></th>
                                            <th><?php echo $row['br_code'] . "-" . $row['br_name'] ?></th>
                                            <th><?php echo $row['faculty_code'] ?> </th>
                                            <th><?php echo $row['degree_code'] ?></th>
                                            <th><?php echo $row['batch_code'] ?></th>
                                            <th>
                                                <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_center_degree_yr('<?php print_r($row['center_degree_id']) ?>', '<?php print_r($row['center_id']) ?>', '<?php print_r($row['faculty_id']) ?>', '<?php print_r($row['degree_id']) ?>', '<?php print_r($row['batch_id']) ?>')"></span></button> |
                                                <?php if ($row['c_d_deleted']) { ?>
                                                    <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="change_year_status('<?php print_r($row['center_degree_id']) ?>', '0');"></span></button></th>
                                            <?php } else { ?>
                                        <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="change_year_status('<?php print_r($row['center_degree_id']) ?>', '1');"></span></button></th>
                                    <?php } ?>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="semesters_tab">
        <div class="row">
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Semesters
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form name="degree_semester_form" id="degree_semester_form" class="form-horizontal" role="form" action="" method="post"  autocomplete="off">		
                                <div class="form-group">
                                    <input type="hidden" id="center_year_id" name="center_year_id" >
                                    <input type="hidden" id="center_semester_id" name="center_semester_id">
                                    <label for="sem_center" class="col-md-3 control-label">Center : </label>
                                    <div class="col-md-7">
                                        <?php 
                                            global $branchdrop;
                                            global $selectedbr;
                                            $extraattrs = 'id="sem_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_faculty_bybranch(this.value,\'sem_faculty\')"';
                                            echo form_dropdown('sem_center',$branchdrop,$selectedbr, $extraattrs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sem_faculty" class="col-md-3 control-label">Faculty : </label>
                                    <div class="col-md-7">
                                        <?php 
                                            global $facultydrop;
                                            global $selectedfac;
                                            $facextraattrs = 'id="sem_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degrees(this.value, 1, null, 2)"';
                                            echo form_dropdown('sem_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Code:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="se_Dcode" name="se_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degree_name(this.value, 2, null, 0)">
                                            <option value="">---Select Degree Code---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Name:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="se_Dname" name="se_Dname" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_degree_code(this.value, 2)">
                                            <option value="">---Select Degree Name---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="sem_Bcode" name="sem_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" id="div_years">
                                    <label for="comcode" class="col-sm-3 control-label"> Degree Years:</label>
                                    <div class="col-md-7">
                                        <select type="text" class="form-control" id="s_years" name="s_years" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_semesters(this.value)">
                                            <option value="">---Select Degree Year---</option>
                                        </select> 
                                    </div>
                                </div>
                                <input type="hidden" id="total_years" name="total_years">
                                <input type="hidden" id="total_semesters" name="total_semesters">
                                <div class="col-md-12 semester_div" style="display:none;" id="semester_div">
                                    <div class="clone_div2" id="clone_div2">
                                        <div id="semesterInput1" class="semesterInput row">
                                            <div class="row form-group">
                                                <label id="label_sem_number1" class="label_sem_number col-sm-2 control-label"  for="comcode"> Semester1:</label>
                                                <div class="col-md-5">
                                                    From:<input type="date" class="semesterStart form-control" id="semester_start" name="semester_start[]" placeholder="YYYY-MM-DD" value="">
                                                </div>
                                                <div class="col-md-5">
                                                    To:<input type="date" class="semesterEnd form-control" id="semester_end" name="semester_end[]" placeholder="YYYY-MM-DD" value="">
                                                    <br/>
                                                </div>
                                                <!--<label for="comcode" class="col-sm-3 control-label"> Semester Weeks:</label>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" id="sem_weeks" name="sem_weeks"  data-validation="required" data-validation-error-msg-required="Field can not be empty" readonly="">
                                                    </div>-->
                                            </div><br/>
                                        </div>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();save_center_semester();">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default" onclick="reset_semesters();">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>	
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Look Up
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table name="semester_table" id="semester_table" class="table table-striped table-bordered dt-responsive nowrap semester_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Center</th>
                                        <th>Faculty & Degree</th>
                                        <th>Batch</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($degree_semesters as $row) {
                                        ?>
                                        <tr>
                                            <th><?php echo $i ?></th>
                                            <th><?php echo $row['br_code'] . "-" . $row['br_name'] ?></th>
                                            <th><?php echo $row['faculty_code'] . " & " . $row['degree_code'] ?> </th>
                                            <th><?php echo $row['batch_code'] ?></th>
                                            <th><?php echo $row['year_no'] ?></th>
                                            <th>
                                                <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_center_degree_sem('<?php print_r($row['center_year_id']) ?>', '<?php print_r($row['center_id']) ?>', '<?php print_r($row['faculty_id']) ?>', '<?php print_r($row['degree_id']) ?>', '<?php print_r($row['batch_id']) ?>')"></span></button> |
                                                <?php if ($row['c_d_s_deleted']) { ?>
                                                    <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="update_semester_status('<?php print_r($row['center_year_id']) ?>', '0');"></span></button></th>
                                            <?php } else { ?>
                                        <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="update_semester_status('<?php print_r($row['center_year_id']) ?>', '1');"></span></button></th>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>

        save_method = 'update';

        $(function () {
            $('.batch_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
        });

        $(function () {
            $('.year_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
        });

        $(function () {
            $('.semester_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
        });

        $.validate({
            form: '#batch_form'
        });
        $.validate({
            form: '#degree_year_form'
        });
        $.validate({
            form: '#degree_semester_form'
        });
        cloneid = 1;

        function clone_year(year_no)
        {
            for (i = 1; i <= (cloneid); i++) {
                if (i != 1) {
                    $('#clonedInput' + i).remove();
                }
            }
            cloneid = 1;

            for (i = 1; i <= year_no; i++) {
                if (i === 1) {
                    $("#year_dev").css("display", "block");
                    $('.clone_div').find('#year_start').attr('id', 'year_start1');
                    $('.clone_div').find('#year_end').attr('id', 'year_end1');
                } else {
                    $('.clone_div').append($('#clonedInput1').clone());
                    $('.clone_div').find('.clonedInput').last().attr('id', 'clonedInput' + cloneid);
                    $('.clone_div').find('.yearStart').last().attr('id', 'year_start' + cloneid);
                    $('.clone_div').find('.yearEnd').last().attr('id', 'year_end' + cloneid);
                    $('.clone_div').find('.label_year_number').last().attr('id', 'label_year_number' + cloneid);
                    $('#label_year_number' + cloneid).text("Year" + cloneid + ":");
                }
                cloneid++;
            }

        }
        cloneid2 = 1;
        function clone_semester(semesters) {
            for (i = 1; i <= (cloneid2); i++) {
                if (i != 1) {
                    $('#semesterInput' + i).remove();
                }
            }
            cloneid2 = 1;

            for (i = 1; i <= semesters; i++) {
                if (i == 1) {
                    $("#semester_div").css("display", "block");
                    $('.clone_div2').find('#semester_start').attr('id', 'semester_start1');
                    $('.clone_div2').find('#semester_end').attr('id', 'semester_end1');
                } else {
                    $("#semester_div").css("display", "block")
                    $('.clone_div2').append($('#semesterInput1').clone());
                    $('.clone_div2').find('.semesterInput').last().attr('id', 'semesterInput' + cloneid2);
                    $('.clone_div2').find('.label_sem_number').last().attr('id', 'label_sem_number' + cloneid2);
                    $('#label_sem_number' + cloneid2).text("Semester" + cloneid2 + ":");
                    $('.clone_div2').find('.semesterStart').last().attr('id', 'semester_start' + cloneid2);
                    $('.clone_div2').find('.semesterEnd').last().attr('id', 'semester_end' + cloneid2);
                }
                cloneid2++;
            }
        }
        function get_degree_name(id, tab_flag, batch_id, edit_flag) {
            if (tab_flag == 0) {
                $("#e_years").css("display", "none");
            } else if (tab_flag == 1) {
                $("#div_years").css("display", "none");
            }

            $.post("<?php echo base_url('degree/get_degree') ?>", {'id': id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    if (tab_flag == 0) {
                        get_degrees(data['faculty_id'], 1, id, 0);
                        $('#de_years').val(data['no_of_year']);
                        $("#e_years").css("display", "block");
                    } else if (tab_flag == 1) {
                        get_degrees(data['faculty_id'], 1, id, 1);
                        $('#y_years').val(data['no_of_year']);
                        $("#div_years").css("display", "block");
                        $("#year_div").css("display", "block");
                        clone_year(data['no_of_year']);

                        $('#yr_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

                        $.post("<?php echo base_url('batch/load_batches') ?>", {'degree_id': id},
                        function (data)
                        {
                            for (j = 0; j < data.length; j++) {
                                if (data[j]['id'] == batch_id) {
                                    $('#yr_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                } else {
                                    $('#yr_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                }
                            }

                        },
                        "json"
                        );
                    } else {
                        get_degrees(data['faculty_id'], 1, id, 2);
                        $('#total_years').val(data['no_of_year']);
                        $('#s_years').find('option').remove().end().append('<option value="">---Select Degree Year---</option>').val('');
                        if (edit_flag) {
                            clone_semester(data['no_of_semester']);
                            $('#s_years').append($("<option></option>").attr('selected', true).attr("value", data['year_no']).text(data['year_no']));
                        } else {
                            for (i = 1; i <= data['no_of_year']; i++) {
                                $('#s_years').append($("<option></option>").attr("value", i).text(i));
                            }
                        }

                        load_degree_batches(id, batch_id);

                    }
                }
            },
            "json"
            );
        }

        function load_degree_batches(degree_id, batch_id) {
            $('#sem_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

            $.post("<?php echo base_url('batch/load_batches') ?>", {'degree_id': degree_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (j = 0; j < data.length; j++) {
                        if (data[j]['id'] == batch_id) {
                            $('#sem_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                        } else {
                            $('#sem_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        }
                    }
                }

            },
            "json"
            );
        }

        function get_degree_code(id, tab_flag)
        {
            $.post("<?php echo base_url('degree/get_degree') ?>", {'id': id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    if (tab_flag == 0) {
                        get_degrees(data['faculty_id'], 1, id, 0);
                        $('#de_years').val(data['no_of_year']);
                        $("#e_years").css("display", "block");
                    } else if (tab_flag == 1) {
                        get_degrees(data['faculty_id'], 1, id, 1);
                        $('#y_years').val(data['no_of_year']);
                        $("#div_years").css("display", "block");
                        $("#year_div").css("display", "block");
                        clone_year(data['no_of_year']);

                        $('#yr_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

                        $.post("<?php echo base_url('batch/load_batches') ?>", {'degree_id': id},
                                function (data)
                                {
                                    for (j = 0; j < data.length; j++) {
                                        $('#yr_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    }
                                },
                                "json"
                                );
                    } else {
                        get_degrees(data['faculty_id'], 1, id, 2);

                        $('#total_years').val(data['no_of_year']);
                        $('#s_years').find('option').remove().end().append('<option value="">---Select Degree Year---</option>').val('');
                        for (i = 1; i <= data['no_of_year']; i++) {
                            $('#s_years').append($("<option></option>").attr("value", i).text(i));
                        }

                        $('#sem_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

                        $.post("<?php echo base_url('batch/load_batches') ?>", {'degree_id': id},
                                function (data)
                                {
                                    for (j = 0; j < data.length; j++) {
                                        $('#sem_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    }

                                },
                                "json"
                                );
                    }
                }
            },
            "json"
            );
        }

        function get_degrees(faculty_id, data_flag, degree_id, tab_flag) {
            if (tab_flag == 0) {
                $('#load_Dcode').find('option').remove().end().append('<option value="">---Select Degree Code---</option>').val('');
                $('#load_Dname').find('option').remove().end().append('<option value="">---Select Degree Name---</option>').val('');
                $('#Ddes').val("");
            } else if (tab_flag == 1) {
                $("#div_years").css("display", "none");
                $('#year_Dcode').find('option').remove().end().append('<option value="">---Select Degree Code---</option>').val('');
                $('#year_Dname').find('option').remove().end().append('<option value="">---Select Degree Name---</option>').val('');
            } else {
                $('#se_Dcode').find('option').remove().end().append('<option value="">---Select Degree Code---</option>').val('');
                $('#se_Dname').find('option').remove().end().append('<option value="">---Select Degree Name---</option>').val('');
            }
            if (data_flag === 1) {
                $.post("<?php echo base_url('degree/load_degree_programs') ?>", {'faculty_id': faculty_id},
                function (data)
                {
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        for (var i = 0; i < data.length; i++) {
                            if (degree_id == data[i]['degree_id']) {
                                if (tab_flag == 0) {
                                    $('#load_Dcode').append($("<option></option>").attr("value", data[i]['degree_id']).attr('selected', true).text(data[i]['degree_code']));
                                    $('#load_Dname').append($("<option></option>").attr("value", data[i]['degree_id']).attr('selected', true).text(data[i]['degree_name']));
                                } else if (tab_flag == 1) {
                                    $('#year_Dcode').append($("<option></option>").attr("value", data[i]['degree_id']).attr('selected', true).text(data[i]['degree_code']));
                                    $('#year_Dname').append($("<option></option>").attr("value", data[i]['degree_id']).attr('selected', true).text(data[i]['degree_name']));

                                } else {
                                    $('#se_Dcode').append($("<option></option>").attr("value", data[i]['degree_id']).attr('selected', true).text(data[i]['degree_code']));
                                    $('#se_Dname').append($("<option></option>").attr("value", data[i]['degree_id']).attr('selected', true).text(data[i]['degree_name']));
                                }

                            } else {
                                if (tab_flag == 0) {
                                    $('#load_Dcode').append($("<option></option>").attr("value", data[i]['degree_id']).text(data[i]['degree_code']));
                                    $('#load_Dname').append($("<option></option>").attr("value", data[i]['degree_id']).text(data[i]['degree_name']));
                                } else if (tab_flag == 1) {
                                    $('#year_Dcode').append($("<option></option>").attr("value", data[i]['degree_id']).text(data[i]['degree_code']));
                                    $('#year_Dname').append($("<option></option>").attr("value", data[i]['degree_id']).text(data[i]['degree_name']));

                                } else {
                                    $('#se_Dcode').append($("<option></option>").attr("value", data[i]['degree_id']).text(data[i]['degree_code']));
                                    $('#se_Dname').append($("<option></option>").attr("value", data[i]['degree_id']).text(data[i]['degree_name']));

                                }

                            }

                        }
                    }
                },
                "json"
                );
            }
        }

        function reset_years() {
            //css
            $("#year_div").css("display", "none");
            $("#div_years").css("display", "none");

            //call function
            get_degrees(null, null, null);
            get_degree_name(null, null, null, null);
            //enable
            $('#center').prop("disabled", false);
            $('#year_faculty').prop("disabled", false);
            $('#year_Dcode').prop("disabled", false);
            $('#year_Dname').prop("disabled", false);
//            $('#y_years').prop("disabled", false);
            $('#yr_Bcode').prop("disabled", false);
        }

        function reset_semesters() {
            //css
            $("#year_sem_details").css("display", "none");
            //call function
            get_degrees(null, null, null);
            get_degree_name(null, null, null, null);
            load_degree_batches(null, null);
            //enable
            $('#sem_center').prop("disabled", false);
            $('#sem_faculty').prop("disabled", false);
            $('#se_Dcode').prop("disabled", false);
            $('#se_Dname').prop("disabled", false);
            $('#s_years').prop("disabled", false);
            $('#sem_Bcode').prop("disabled", false);
            $('#s_years').find('option').remove().end().append('<option value="">---Select Degree Year---</option>').val('');
        }

        function reset_batches() {
            //css
            $("#e_years").css("display", "none");

            $('#load_Dcode').find('option').remove().end().append('<option value="">---Select Degree Code---</option>').val('');
            $('#load_Dname').find('option').remove().end().append('<option value="">---Select Degree Name---</option>').val('');
            //set values
            $('#batch_id').val("");
            $('#degree_id').val("");
            //enable
            $('#faculty').prop("disabled", false);
            $('#load_Dname').prop("disabled", false);
            $('#load_Dcode').prop("disabled", false);
        }

        function edit_batch(batch_id) {
            $.post("<?php echo base_url('batch/load_batch_edit') ?>", {'batch_id': batch_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    //css
                    $("#e_years").css("display", "block");
                    //disable
                    $('#faculty').prop("disabled", true);
                    $('#load_Dname').prop("disabled", true);
                    $('#load_Dcode').prop("disabled", true);
                    //call function
                    get_degrees(data['faculty_id'], 1, data['degree_id'], 0);
                    //set values
                    $('#batch_id').val(batch_id);
                    $('#degree_id').val(data['degree_id']);
                    $('#faculty').val(data['faculty_id']);
                    $("#de_years").val(data['no_of_year']);
                    $('#batch_code').val(data['batch_code']);
                    $('#batch_code').val(data['batch_code']);
                    $('#start_date').val(data['start_date']);
                    $('#Bdes').val(data['b_description']);
                    $('#s_season').val(data['study_season_id']);
                }
            },
            "json"
            );
        }

        function change_batch_status(batch_id, new_status, batch_code)
        {
            $.post("<?php echo base_url('batch/change_batch_status') ?>", {"batch_id": batch_id, "new_status": new_status, "batch_code": batch_code},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    location.reload();
                }
            },
            "json"
            );
        }

        function edit_center_degree_yr(center_degree_id, center_id, faculty_id, degree_id, batch_id) {
            $('#center_degree_id').val(center_degree_id);

            $('#center').val(center_id);
            $('#year_faculty').val(faculty_id);

            $('#center').prop("disabled", true);
            $('#year_faculty').prop("disabled", true);

            get_degrees(faculty_id, 1, degree_id, 1);
            get_degree_name(degree_id, 1, batch_id, 1);

            $('#year_Dcode').val(degree_id);

            $('#year_Dcode').prop("disabled", true);
            $('#year_Dname').prop("disabled", true);

            $.post("<?php echo base_url('degree/get_center_degree_years') ?>", {"center_degree_id": center_degree_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (i = 0; i < data.length; i++) {
                        j = i + 1;

                        $("#year_start" + j).val(data[i]['year_start']);
                        $("#year_end" + j).val(data[i]['year_end']);
                    }
                }
            },
            "json"
            );
        }

        function change_year_status(center_degree_id, new_status) {
            $.post("<?php echo base_url('degree/change_center_year_status') ?>", {"center_degree_id": center_degree_id, "new_status": new_status},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    location.reload();
                }
            },
            "json"
            );
        }

        function load_semesters(year_no) {
            var degree_id = $('#se_Dcode').val();
            $.post("<?php echo base_url('degree/get_year_semesters') ?>", {"degree_id": degree_id, "year_no": year_no},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    $("#total_semesters").val(data);
                    $("#semester_div").css("display", "block");
                    clone_semester(data);
                }
            },
            "json"
            );
        }

        function edit_center_degree_sem(center_year_id, center_id, faculty_id, degree_id, batch_id) {
            $('#center_year_id').val(center_year_id);

            $('#sem_center').val(center_id);
            $('#sem_faculty').val(faculty_id);

            $('#sem_center').prop("disabled", true);
            $('#sem_faculty').prop("disabled", true);

            get_degrees(faculty_id, 1, degree_id, 2);
            get_degree_name(degree_id, 2, batch_id, 1);

            $('#se_Dcode').val(degree_id);

            $('#se_Dcode').prop("disabled", true);
            $('#se_Dname').prop("disabled", true);
            $('#s_years').prop("disabled", true);
            $('#sem_Bcode').prop("disabled", true);


            $.post("<?php echo base_url('degree/get_center_degree_semesters') ?>", {"center_year_id": center_year_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (i = 0; i < data.length; i++) {
                        j = i + 1;

                        $("#semester_start" + j).val(data[i]['semester_start']);
                        $("#semester_end" + j).val(data[i]['semester_end']);
                    }
                }
            },
            "json"
            );
        }



        function update_semester_status(center_year_id, new_status) {
            $.post("<?php echo base_url('degree/change_center_semester_status') ?>", {"center_year_id": center_year_id, "new_status": new_status},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    location.reload();
                }
            },
            "json"
            );
        }

        function save_center_semester() {
            $.ajax(
            {
                url: "<?php echo base_url('degree/save_center_degree_semesters') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#degree_semester_form').serialize(),
                success: function (data)
                {

                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        result_notification(data);
                        if (data['status'] == 'success') {
                            location.reload();
                            $('#degree_semester_form')[0].reset();
                        }
                    }
                }
            });
        }

        function save_batch() {

            $.ajax(
            {
                url: "<?php echo base_url('batch/save_batch') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#batch_form').serialize(),
                success: function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        result_notification(data);
                        if (data['status'] == 'success') {
                            location.reload();
                        }
                    }
                }
            });
        }

        function save_semester_years() {
            $.ajax(
            {
                url: "<?php echo base_url('degree/save_center_degree_years') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#degree_year_form').serialize(),
                success: function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        result_notification(data);
                        if (data['status'] == 'success') {
                            $('#degree_year_form')[0].reset();
                        }
                    }
                }
            });
        }

        // function load_faculty_bybranch(id,inputid)
        // {
        //     $('#'+inputid).find('option').remove().end().append('<option value="">---Select Faculty---</option>').val('');

        //     $.post("<?php echo base_url('degree/load_faculty_bybranch') ?>", {'id': id},
        //     function (data)
        //     {
        //         if(data == 'denied')
        //         {
        //             funcres = {status:"denied", message:"You have no right to proceed the action"};
        //             result_notification(funcres);
        //         }
        //         else
        //         {
        //             for (var i = 0; i < data.length; i++) {
        //                 if(data.length == 1)
        //                 {
        //                     $('#'+inputid).append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['faculty_code']));
        //                 }
        //                 else
        //                 {
        //                     $('#'+inputid).append($("<option></option>").attr("value", data[i]['id']).text(data[i]['faculty_code']));
        //                 }
        //             }
        //         }
        //     },
        //     "json"
        //     );
        // }

    </script>

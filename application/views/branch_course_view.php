<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> CENTER COURSE </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Center Course</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#batch_tab" href="#batch_tab" aria-controls="batch_tab" role="tab" data-toggle="tab">Batches</a></li>
    <li role="presentation"><a id="#years_tab" href="#years_tab" aria-controls="company_tab" role="tab" data-toggle="tab">Course Years</a></li>
    <!--<li role="presentation"><a id="#semesters_tab" href="#semesters_tab" aria-controls="group_tab" role="tab" data-toggle="tab">Semesters</a></li>-->
</ul>
<div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="batch_tab">
        <div class="row">
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Course Batches
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form id="batch_form" name="batch_form" class="form-horizontal" role="form" method="post"  autocomplete="off" novalidate>
                                <div class="form-group">
                                    <input type="hidden" id="batch_id" name="batch_id" >
                                    <input type="hidden" id="course_id" name="course_id" >
                                    <label for="comcode" class="col-sm-3 control-label"> Course:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="load_Dcode" name="load_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_years(this.value, 0, null, 0)">
                                            <option value="">---Select Course---</option>
                                            <?php
                                                foreach ($all_courses as $course){ ?>
                                                <option value="<?php echo $course['course_id']?>"><?php echo "[".$course['course_code']."]-".$course['course_name'] ?></option>
                                             <?php   }
                                            ?>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" style="display: none" id="e_years">
                                    <label for="comcode" class="col-sm-3 control-label"> Course Years:</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" id="de_years" name="de_years"  data-validation="required" data-validation-error-msg-required="Field can not be empty" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" id="batch_code" name="batch_code"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Study Season :</label>
                                    <div class="col-md-9">
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
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="YYYY-MM-DD" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                                    <div class="col-md-9">
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
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Look Up
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <table name="batch_table" id="batch_table" class="table table-striped table-bordered dt-responsive batch_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($batches as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['batch_id']; ?></td>
                                            <td><?php echo "[".$row['course_code']."]-".$row['course_name']; ?></td>
                                            <td><?php echo $row['batch_code']; ?></td>
                                            <td>
                                                <button title="edit" type="button" class="btn btn-info btn-xs" onclick="edit_batch(<?php echo $row['batch_id'] ?>)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                                <?php if ($row['batch_deleted']) { ?>
                                                    <button title="activate" type="button" class="btn btn-success btn-xs" onclick="change_batch_status('<?php print_r($row['batch_id']) ?>', '0', '<?php print_r($row['batch_code']) ?>')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></td>
                                            <?php } else { ?>
                                        <button title="deactivate" type="button" class="btn btn-warning btn-xs" onclick="change_batch_status('<?php print_r($row['batch_id']) ?>', '1', '<?php print_r($row['batch_code']) ?>')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></td>
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
                        Course Years
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form name="course_year_form" id="course_year_form" class="form-horizontal" role="form" method="post"  autocomplete="off">		
                                <div class="form-group">
                                    <input type="hidden" id="center_course_id" name="center_course_id" >
                                    <label for="center" class="col-md-3 control-label">Center : </label>
                                    <div class="col-md-9">
                                        <?php 
                                            global $branchdrop;
                                            global $selectedbr;
                                            $extraattrs = 'id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                            echo form_dropdown('center',$branchdrop,$selectedbr, $extraattrs); 
                                        ?>
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <label for="year_faculty" class="col-md-3 control-label">Faculty : </label>
                                    <div class="col-md-7">
                                        <?php 
//                                            global $facultydrop;
//                                            global $selectedfac;
//                                            $facextraattrs = 'id="year_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 1)"';
//                                            echo form_dropdown('year_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Course:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="year_Dcode" name="year_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_years(this.value, 1, null, 0)">
                                            <option value="">---Select Course---</option>
                                            <?php
                                                foreach ($all_courses as $course){ ?>
                                                <option value="<?php echo $course['course_id']?>"><?php echo "[".$course['course_code']."]-".$course['course_name'] ?></option>
                                             <?php   }
                                            ?>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" style="display: none" id="div_years">
                                    <label for="comcode" class="col-sm-3 control-label"> Course Years:</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" id="y_years" name="y_years"  data-validation="required" data-validation-error-msg-required="Field can not be empty" readonly="">
                                    </div>
                                </div>
                                <div id="yr_des" class="form-group" style="display: none">
                                    <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="Ddes" id="Ddes" disabled="" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="yr_Bcode" name="yr_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>    
                                    </div>
                                </div>

                                <div class="form-group" style="display:none" id="year_div">
                                    <label id="msg_optional" style="color:red">Year Fields are optional</label>
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
                            <table name="year_table" id="year_table" class="table table-striped table-bordered dt-responsive year_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Center</th>
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($course_years as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo "[".$row['br_code'] . "]-" . $row['br_name'] ?></td>
                                            <td><?php echo "[".$row['course_code']."]-".$row['course_name'] ?></td>
                                            <td><?php echo $row['batch_code'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs" onclick="edit_center_course_yr('<?php print_r($row['center_course_id']) ?>', '<?php print_r($row['center_id']) ?>', '<?php print_r($row['course_id']) ?>', '<?php print_r($row['batch_id']) ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                                <?php if ($row['c_d_deleted']) { ?>
                                                    <button type="button" class="btn btn-success btn-xs" onclick="change_year_status('<?php print_r($row['center_course_id']) ?>', '0');"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></td>
                                            <?php } else { ?>
                                        <button type="button" class="btn btn-warning btn-xs" onclick="change_year_status('<?php print_r($row['center_course_id']) ?>', '1');"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></td>
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
                            <form name="course_semester_form" id="course_semester_form" class="form-horizontal" role="form" action="" method="post"  autocomplete="off">		
                                <div class="form-group">
                                    <input type="hidden" id="center_year_id" name="center_year_id" >
                                    <input type="hidden" id="center_semester_id" name="center_semester_id">
                                    <label for="sem_center" class="col-md-3 control-label">Center : </label>
                                    <div class="col-md-9">
                                        <?php 
                                            global $branchdrop;
                                            global $selectedbr;
                                            $extraattrs = 'id="sem_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                            echo form_dropdown('sem_center',$branchdrop,$selectedbr, $extraattrs); 
                                        ?>
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <label for="sem_faculty" class="col-md-3 control-label">Faculty : </label>
                                    <div class="col-md-7">
                                        <?php 
//                                            global $facultydrop;
//                                            global $selectedfac;
//                                            $facextraattrs = 'id="sem_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 2)"';
//                                            echo form_dropdown('sem_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Course:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="se_Dcode" name="se_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_years(this.value, 2, null, 0)">
                                            <option value="">---Select Course---</option>
                                            <?php
                                                foreach ($all_courses as $course){ ?>
                                                <option value="<?php echo $course['course_id']?>"><?php echo "[".$course['course_code']."]-".$course['course_name'] ?></option>
                                             <?php   }
                                            ?>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="sem_Bcode" name="sem_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>    
                                    </div>
                                </div>
                                <div class="form-group" id="div_years">
                                    <label for="comcode" class="col-sm-3 control-label"> Course Years:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="s_years" name="s_years" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_semesters(this.value)">
                                            <option value="">---Select Course Year---</option>
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
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($course_semesters as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></th>
                                            <td><?php echo "[".$row['br_code'] . "]-" . $row['br_name'] ?></td>
                                            <td><?php echo "[".$row['course_code']."]-".$row['course_name'] ?> </td>
                                            <td><?php echo $row['batch_code'] ?></td>
                                            <td><?php echo $row['year_no'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_center_course_sem('<?php print_r($row['center_year_id']) ?>', '<?php print_r($row['center_id']) ?>', '<?php print_r($row['course_id']) ?>', '<?php print_r($row['batch_id']) ?>')"></span></button> |
                                                <?php if ($row['c_d_s_deleted']) { ?>
                                                    <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="update_semester_status('<?php print_r($row['center_year_id']) ?>', '0');"></span></button></td>
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
            $('#batch_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
            $('#batch_table td').css('white-space','initial');
        });

        $(function () {
            $('#year_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
            $('#year_table td').css('white-space','initial');
        });

        $(function () {
            $('#semester_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
            $('#semester_table td').css('white-space','initial');
        });

        $.validate({
            form: '#batch_form'
        });
        $.validate({
            form: '#course_year_form'
        });
        $.validate({
            form: '#course_semester_form'
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
        function get_course_years(id, tab_flag, batch_id, edit_flag) {
            if (tab_flag == 0) {
                $("#e_years").css("display", "none");
            } else if (tab_flag == 1) {
                $("#div_years").css("display", "none");
            }

            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
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
                        $('#load_Dname').val(id);
                        $('#de_years').val(data['no_of_year']);
                        $("#e_years").css("display", "block");
                    } else if (tab_flag == 1) {
                        $('#year_Dname').val(id);
                        $('#y_years').val(data['no_of_year']);
                        $("#div_years").css("display", "block");
                        $("#year_div").css("display", "block");
                        clone_year(data['no_of_year']);

                        $('#yr_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

                        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
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
//                        get_courses(data['faculty_id'], 1, id, 2);
                        $('#se_Dname').val(id);
                        $('#total_years').val(data['no_of_year']);
                        $('#s_years').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                        if (edit_flag) {
                            clone_semester(data['no_of_semester']);
                            $('#s_years').append($("<option></option>").attr('selected', true).attr("value", data['year_no']).text(data['year_no']));
                        } else {
                            for (i = 1; i <= data['no_of_year']; i++) {
                                $('#s_years').append($("<option></option>").attr("value", i).text(i));
                            }
                        }

                        load_course_batches(id, batch_id);

                    }
                }
            },
            "json"
            );
        }

        function load_course_batches(course_id, batch_id) {
            $('#sem_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');

            $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
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

        function reset_years() {
            //css
            $("#year_div").css("display", "none");
            $("#div_years").css("display", "none");

            //call function
//            get_courses(null, null, null);
            get_course_years(null, null, null, null);
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
//            get_courses(null, null, null);
            get_course_years(null, null, null, null);
            load_course_batches(null, null);
            //enable
            $('#sem_center').prop("disabled", false);
            $('#sem_faculty').prop("disabled", false);
            $('#se_Dcode').prop("disabled", false);
            $('#se_Dname').prop("disabled", false);
            $('#s_years').prop("disabled", false);
            $('#sem_Bcode').prop("disabled", false);
            $('#s_years').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
        }

        function reset_batches() {
            //css
            $("#e_years").css("display", "none");

            $('#load_Dcode').val('');
            $('#load_Dname').val('');
            //set values
            $('#batch_id').val("");
            $('#course_id').val("");
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
                    //set values
                     $('#load_Dcode').val(data['course_id']);
                    $('#batch_id').val(batch_id);
                    $('#course_id').val(data['course_id']);
                    $('#faculty').val(data['faculty_id']);
                    $("#de_years").val(data['no_of_year']);
                    $('#batch_code').val(data['batch_code']);
                    $('#batch_code').val(data['batch_code']);
                    $('#start_date').val(data['start_date']);
                    $('#Bdes').val(data['b_description']);
                    $('#s_season').val(data['study_season_id']);
                     //disable
                    $('#faculty').prop("disabled", true);
                    $('#load_Dcode').prop("disabled", true);
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

        function edit_center_course_yr(center_course_id, center_id, course_id, batch_id) {
            $('#center_course_id').val(center_course_id);

            $('#center').val(center_id);

            $('#center').prop("disabled", true);

            get_course_years(course_id, 1, batch_id, 1);

            $('#year_Dcode').val(course_id);

            $('#year_Dcode').prop("disabled", true);
            $('#year_Dname').prop("disabled", true);

            $.post("<?php echo base_url('course/get_center_course_years') ?>", {"center_course_id": center_course_id},
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

        function change_year_status(center_course_id, new_status) {
            $.post("<?php echo base_url('course/change_center_year_status') ?>", {"center_course_id": center_course_id, "new_status": new_status},
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
            var course_id = $('#se_Dcode').val();
            $.post("<?php echo base_url('course/get_year_semesters') ?>", {"course_id": course_id, "year_no": year_no},
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

        function edit_center_course_sem(center_year_id, center_id, course_id, batch_id) {
            $('#center_year_id').val(center_year_id);

            $('#sem_center').val(center_id);

            $('#sem_center').prop("disabled", true);

            get_course_years(course_id, 2, batch_id, 1);

            $('#se_Dcode').val(course_id);

            $('#se_Dcode').prop("disabled", true);
            $('#se_Dname').prop("disabled", true);
            $('#s_years').prop("disabled", true);
            $('#sem_Bcode').prop("disabled", true);


            $.post("<?php echo base_url('course/get_center_course_semesters') ?>", {"center_year_id": center_year_id},
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
            $.post("<?php echo base_url('course/change_center_semester_status') ?>", {"center_year_id": center_year_id, "new_status": new_status},
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
                url: "<?php echo base_url('course/save_center_course_semesters') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#course_semester_form').serialize(),
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
                            $('#course_semester_form')[0].reset();
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
                url: "<?php echo base_url('course/save_center_course_years') ?>",
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: $('#course_year_form').serialize(),
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
                           $('#course_year_form')[0].reset();
                            location.reload();
                        }
                    }
                }
            });
        }

    </script>

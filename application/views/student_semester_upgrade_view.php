<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Student</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Student</li>
            <li><i class="fa fa-users"></i>Student Upgrade</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#batch_assign" href="#batch_assign" aria-controls="batch_assign" role="tab" data-toggle="tab">Initial Batch Assign</a></li>
    <li role="presentation"><a id="#sem_upgrade" href="#sem_upgrade" aria-controls="sem_upgrade" role="tab" data-toggle="tab">Student Upgrade</a></li>
</ul>
<div class="tab-content"> 
    <div role="tabpanel" class="tab-pane active" id="batch_assign">
        <section class="panel">
            <div class="panel-heading">
                Initial Batch Assign
            </div>
            <form class="form-horizontal" role="form" method="post" action="" id="initial_assign_form" name="semester_upgrade_form" autocomplete="off" novalidate>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="initial__branch" class="col-md-3 control-label">Center</label>
                                <div class="col-md-9">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="initial_branch" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" style="width:100%" onchange="load_course_list(this.value, 1);"';
                                    echo form_dropdown('initial_branch', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="initial_course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="initial_course" name="initial_course" onchange="initial_load_batches(this.value)" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>    
                                        <?php
                                        foreach ($courses as $course) {
                                            echo '<option value="' . $course['id'] . '">[ ' . $course['course_code'] . ' ] - ' . $course['course_name'] . '</option>';
                                        }
                                        ?>        
                                    </select>                                           
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="intake_type" class="col-md-3 control-label">Type</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="intake_type" name="intake_type" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value="All">All</option>    
                                        <option value="F">Full Time</option>
                                        <option value="P">Part Time</option>
                                    </select>                                           
                                </div>                       
                            </div>
                        </div>
                        <div class="col-md-1" style="">
                            <div class="form-group" style="text-align: right">
                                <button type='button' class='btn btn-info btn-sm' style="margin-top:-5px" onclick='event.preventDefault();load_approved_students();'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-3" style="">
                            <div class="form-group">
                                <label for="batches" class="col-md-3 control-label">Batch</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="batches" name="batches" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onclick="enable_assign_btn()">
                                        <option value=""></option>  
                                    </select>                                           
                                </div>                       
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table id="initial_assign_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                <thead>
                                    <tr bgcolor="#F0F8FF">
                                        <th>#</th>
                                        <th>Student Registration No</th>
                                        <th>Student Name</th>
                                        <th><input type="checkbox" disabled="" id="check_all" onclick="check_all_boxes();">&nbsp;Check all</th>
                                    </tr>
                                </thead>
                                <tbody id="ini_assign_tbl_body">
                                    <tr>
                                        <td></td>
                                        <td colspan="3">Search for Students</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="padding: 10px 25px;">                   
                    <div class="form-group">   
                        <button type="button" name="save_btn" id="assign_btn" class="btn btn-info" onclick="assign_students()">Assign</button>
                        <button type="reset" name="Reset" class="btn btn-default">Reset</button>                                                    
                    </div>            
                </div>
            </form>
        </section>
    </div>
    <div role="tabpanel" class="tab-pane" id="sem_upgrade">
        <section class="panel">
            <div class="panel-heading">
                Student Upgrade
            </div>
            <form class="form-horizontal" role="form" method="post" action="" id="semester_upgrade_form" name="semester_upgrade_form" autocomplete="off" novalidate>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3" style="">
                            <input type="hidden" id="sup_id" name="sup_id">
                            <div class="form-group">
                                <label for="sup_season" class="col-md-3 control-label">Study Season</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="sup_season" name="sup_season" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>    
                                        <?php
                                        foreach ($ay_info as $ay) {
                                            if ($ay['ac_iscurryear'] == 1) {
                                                $ayselected = 'selected';
                                            } else {
                                                $ayselected = '';
                                            }
                                            echo '<option value="' . $ay['es_ac_year_id'] . '" ' . $ayselected . '>' . $ay['ac_startdate'] . ' - ' . $ay['ac_enddate'] . '</option>';
                                        }
                                        ?>      
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sup_branch" class="col-md-3 control-label">Branch</label>
                                <div class="col-md-9">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="sup_branch" data-validation="required" data-validation-error-msg-required="Field can not be empty" class="form-control" style="width:100%" onchange="load_course_list(this.value, 2);"';
                                    echo form_dropdown('sup_branch', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                                </div>
                            </div>
                        </div> 
<!--                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="sup_faculty" class="col-md-3 control-label">Faculty</label>
                                <div class="col-md-9">
                                    <?php
                                    /*global $facultydrop;
                                    global $selectedfac;
                                    $facextraattrs = 'id="sup_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_courses_list(this.value,null,null)"';
                                    echo form_dropdown('sup_faculty', $facultydrop, $selectedfac, $facextraattrs);
                                    */?>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="initial_course" class="col-md-3 control-label">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="sup_course" name="sup_course" onchange="load_years(this.value, null)" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>    
                                        <?php
                                        foreach ($courses as $course) {
                                            echo '<option value="' . $course['id'] . '">[ ' . $course['course_code'] . ' ] - ' . $course['course_name'] . '</option>';
                                        }
                                        ?>        
                                    </select>                                           
                                </div>                       
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3" style="">
                            
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3" style="">
                            <div class="form-group" style="text-align: right">
                                <button type='button' class='btn btn-info btn-sm' style="margin-top:-5px" onclick='event.preventDefault();load_batches();'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <strong>Select Batch for Upgrade :</strong>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10" style="text-align: center;">
                            <ul class="nav nav-pills" id="batchlist">
                            </ul>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <hr>
                    <div class="row" id="upgradedetail">
                        <div class="col-md-1" style=""><input type="hidden" name="sup_batch" id="sup_batch"></div>
                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="sup_year" class="col-md-3 control-label">Year</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="sup_year" name="sup_year"  onchange="load_semester(this.value, null, null)" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>            
                                    </select>                                           
                                </div>                       
                            </div>
                        </div>
                        <div class="col-md-3" style="">
                            <div class="form-group">
                                <label for="sup_semester" class="col-md-3 control-label">Semester</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="sup_semester" name="sup_semester" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value=""></option>            
                                    </select>                                           
                                </div>                       
                            </div>  
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <table id="upgradestulisttbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                <thead>
                                    <tr bgcolor="#F0F8FF">
                                        <th>#</th>
                                        <th>Student Registration No</th>
                                        <th>Student Name</th>
<!--                                        <th>GPA</th>-->
                                        <th style="color:red;"><!-- <input type="checkbox">&nbsp;Check all -->Select if not upgrade</th>
                                    </tr>
                                </thead>
                                <tbody id="stulistbody">
                                    <tr>
                                        <td></td>
                                        <td colspan="4">Search for Students</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">                   
                    <div class="form-group">   
                        <button type="button" name="save_btn" id="upgrade_btn" class="btn btn-info" onclick="upgrade_students()">Upgrade</button>
                        <button type="reset" name="Reset" class="btn btn-default">Reset</button>                                                    
                    </div>            
                </div>
            </form>
        </section>				
    </div>			
    <script type="text/javascript">

        $(document).ready(function () {
            $('#upgradedetail').hide();
            
            if( $('#initial_branch').length ) {
                    load_course_list(($('#initial_branch').val()), 1);
                }
                
            if( $('#sup_branch').length ) {
                load_course_list(($('#sup_branch').val()), 2);
            }
            
            $('#assign_btn').prop('disabled', true);
            $('#upgrade_btn').prop('disabled', true);
            
            
        });
      
      $.validate({
        form: '#semester_upgrade_form'
        });
        $.validate({
            form: '#initial_assign_form'
        });


//        $('#semester_upgrade_form').bootstrapValidator({
//            live: 'enabled',
//            message: 'This value is not valid',
//            fields: {
//                sup_season:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Study Season is required.'}
//                                    }
//                        },
//                sup_course:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Course is required.'}
//                                    }
//                        },
//                sup_branch:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Branch is required.'}
//                                    }
//                        },
//                sup_batch:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Batch is required.'}
//                                    }
//                        },
//                sup_year:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Course Year is required.'}
//                                    }
//                        },
//                sup_semester:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Course Semester is required.'}
//                                    }
//                        }
//            },
//            onSuccess: function (e) {
//                e.preventDefault();
//                upgrade_students();
//            }
//        });

//        $('#initial_assign_form').bootstrapValidator({
//            live: 'enabled',
//            message: 'This value is not valid',
//            fields: {
//                initial_course:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Course is required.'}
//                                    }
//                        },
//                intake_type:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Type is required.'}
//                                    }
//                        },
//                batches:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Batch is required.'}
//                                    }
//                        },
//                initial_branch:
//                        {
//                            validators:
//                                    {
//                                        notEmpty: {message: 'Center is required.'}
//                                    }
//                        }
//
//            },
//            onSuccess: function (e) {
//                e.preventDefault();
//                assign_students();
//            }
//        });

        function upgrade_students()
        {
            $('#sup_year').attr('disabled', false);
            $('#sup_semester').attr('disabled', false);
            
            var year = $('#sup_year').val();
            var semester = $('#sup_semester').val();
            if (year == null || year == '' || semester == null || semester == ''){
                funcres = {status: "denied", message: "Please select upgrade year and semester."};
                result_notification(funcres);
            } else {
                $.ajax(
                    {
                        url: "<?php echo base_url('student/upgrade_students') ?>",
                        type: 'POST',
                        async: false,
                        cache: false,
                        dataType: 'json',
                        data: $('#semester_upgrade_form').serialize(),
                        success: function (data)
                        {
                            result_notification(data);
                            //load_batches();
                            //$('#upgrade_btn').prop('disabled',true);
                            location.reload();
                            // load_hallstudent_list($('#eh_schedule').val(),$('#eh_schedname').val());
                            // $('#mnghallview').modal('toggle');
                        }
                    });
            }
        }

        function load_years(sup_course, selyear)
        {
            $.post("<?php echo base_url('time_table/load_years') ?>", {'tt_course': sup_course},
                    function (data)
                    {
                        $('#sup_year').empty();
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            $('#sup_year').append("<option value=''></option>");
                            if (data > 0)
                            {
                                for (i = 0; i < data; i++) {
                                    selectedtxt = '';
                                    if (selyear == (i + 1))
                                    {
                                        selectedtxt = 'selected';
                                    }

                                    $('#sup_year').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + "</option>");
                                }
                            }
                        }
                    },
                    "json"
                    );
        }

        function load_semester(sup_year, selsemester, sup_course, upgrade_semester)
        {
            if (sup_course == null)
            {
                sup_course = $('#sup_course').val();
            }

            $.post("<?php echo base_url('time_table/load_semester') ?>", {'tt_year': sup_year, "tt_course": sup_course},
                    function (data)
                    {
                        $('#sup_semester').empty();
                        if (data == 'denied')
                        {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else
                        {
                            $('#sup_semester').append("<option value=''></option>");
                            if (data > 0)
                            {
                                for (i = 0; i < data; i++) {

                                    selectedtxt = '';
                                    if (selsemester == (i + 1))
                                    {
                                        selectedtxt = 'selected';
                                    }

                                    $('#sup_semester').append("<option value='" + (i + 1) + "' " + selectedtxt + ">" + (i + 1) + "</option>");
                                }
                            }
                        }
                        
                        $('#sup_semester').val(upgrade_semester).attr('disabled', true);
                    },
                    "json"
                    );
        }

        function load_batches()
        {
            $('#batchlist').empty();
            $('#stulistbody').empty();
            $('#stulistbody').append('<tr><td></td><td colspan="4">Search for Students</td></tr>');
            $.post("<?php echo base_url('student/load_batchesforupgrade') ?>", {'study_season_id': $('#sup_season').val(), 'course_id': $('#sup_course').val(), 'branch': $('#sup_branch').val()},
                    function (data)
                    {
                        x = 0;
                        for (j = 0; j < data.length; j++)
                        {
                            if (data[j]['isupgraded'] == 0)
                            {
                                $('#batchlist').append('<li role="presentation" style="margin-left: 10px;"><a href="#" onclick="load_batch_student(' + data[j]['id'] + ',' + data[j]['current_year'] + ',' + data[j]['current_semester'] + ')">' + data[j]['batch_code'] + '</a></li>');
                                x++;
                            }
                        }

                        if (x == 0)
                        {
                            $('#batchlist').append('There is no batch to upgrade');
                        }
                    },
                    "json"
                    );
        }

        function load_batch_student(id, curryear, currsem)
        {
            $('#upgrade_btn').prop('disabled',false)
            $('#upgradedetail').show();
            $('#stulistbody').empty();
            $('#sup_batch').val(id);
            
            var upgrade_year = 0;
            var upgrade_semester = 0;

            $.post("<?php echo base_url('student/load_batch_student') ?>", {'id': id, 'curryear': curryear, 'currsem': currsem, 'study_season_id': $('#sup_season').val(), 'course_id': $('#sup_course').val(), 'branch': $('#sup_branch').val()},
                    function (data)
                    {
                        if (data['course_years'].length > 0){
                            for (y = 0; y < data['course_years'].length; y++){
                                if(curryear <= data['course_years'][y]['no_of_year']){
                                    if(currsem < data['course_years'][y]['no_of_semester']){
                                        upgrade_year = curryear;
                                        upgrade_semester = parseInt(currsem)+1;
                                    }
                                    
                                    if(curryear != upgrade_year){
                                        if(currsem == data['course_years'][y]['no_of_semester']){
                                            upgrade_year = parseInt(curryear)+1;
                                            upgrade_semester = 1;
                                        }
                                    }
                                }
                            }
                        }
                        
                        load_semester(upgrade_year, null, null,upgrade_semester);
                        
                        $('#sup_year').val(upgrade_year).attr('disabled', true);
                              
                        if (data['notfailedstus'].length > 0)
                        {
                            //$('#stulistbody').append('<tr class="info"><td></td><td><strong></strong></td></tr>');

                            for (j = 0; j < data['notfailedstus'].length; j++)
                            {
                                var overall_gpa = '-';
                                if(data['notfailedstus'][j]['overall_gpa'] != null){
                                    overall_gpa = data['notfailedstus'][j]['overall_gpa'];
                                }
                                //$('#stulistbody').append('<tr class="info"><td>' + (j + 1) + '</td><td>' + data['notfailedstus'][j]['reg_no'] + '</td><td>' + data['notfailedstus'][j]['first_name'] + '</td><td>'+ overall_gpa +'</td><td><input type="checkbox" name="studentchk[]" id="upgrade_checkbox_'+j+'" value="' + data['notfailedstus'][j]['stu_id'] + '"><input type="hidden" name="studentlist[]" value="' + data['notfailedstus'][j]['stu_id'] + '"></td></tr>');
                                $('#stulistbody').append('<tr class="info"><td>' + (j + 1) + '</td><td>' + data['notfailedstus'][j]['reg_no'] + '</td><td>' + data['notfailedstus'][j]['first_name'] + '</td><td><input type="checkbox" name="studentchk[]" id="upgrade_checkbox_'+j+'" value="' + data['notfailedstus'][j]['stu_id'] + '"><input type="hidden" name="studentlist[]" value="' + data['notfailedstus'][j]['stu_id'] + '"></td></tr>');
                            }
                        }

                        if (data['oldstudentd'].length > 0)
                        {
                            $('#stulistbody').append('<tr class="warning" id="old_stu_title_tr"><td></td><td colspan="4"><strong>Old Students</strong></td></tr>');

                            for (j = 0; j < data['oldstudentd'].length; j++)
                            {
                                var overall_gpa_old = '-';
                                if(data['oldstudentd'][j]['overall_gpa'] != null){
                                    overall_gpa_old = data['oldstudentd'][j]['overall_gpa'];
                                }
                                //$('#stulistbody').append('<tr><td>' + (j + 1) + '</td><td>' + data['oldstudentd'][j]['reg_no'] + '</td><td>' + data['oldstudentd'][j]['first_name'] + '</td><td>'+ overall_gpa_old +'</td><td><input type="checkbox" name="studentchk[]" value="' + data['oldstudentd'][j]['stu_id'] + '"><input type="hidden" name="studentlist[]" value="' + data['oldstudentd'][j]['stu_id'] + '"></td></tr>');
                                $('#stulistbody').append('<tr><td>' + (j + 1) + '</td><td>' + data['oldstudentd'][j]['reg_no'] + '</td><td>' + data['oldstudentd'][j]['first_name'] + '</td><td><input type="checkbox" name="studentchk[]" value="' + data['oldstudentd'][j]['stu_id'] + '"><input type="hidden" name="studentlist[]" value="' + data['oldstudentd'][j]['stu_id'] + '"></td></tr>');
                            }
                        }

                        if (data['notfailedstus'].length == 0 && data['oldstudentd'].length == 0)
                        {
                            $('#upgrade_btn').prop('disabled',true)
                            $('#stulistbody').append('<tr class="danger"><td></td><td colspan="4">No Student found for upgrade</td></tr>');
                        }

                    },
                    "json"
                    );
        }

        function load_courses_list(id, selectedid)
        {
            $('#sup_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

            $.post("<?php echo base_url('time_table/load_courses_list') ?>", {'id': id},
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
                                    $('#sup_course').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code'] + ' - ' + data[i]['course_code']));
                                } else
                                {
                                    $('#sup_course').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['course_code'] + ' - ' + data[i]['course_code']));
                                }
                            }
                        }
                    },
                    "json"
                    );
        }

        function initial_load_batches(course_id) {
            $('#batches').find('option').remove().end();
            $('#batches').append('<option></option>').val('');
            $.post("<?php echo base_url('student/load_initial_batch_list') ?>", {'selected_course_id': course_id},
                    function (data) {
                        if (data == 'denied') {
                            funcres = {status: "denied", message: "You have no right to proceed the action"};
                            result_notification(funcres);
                        } else {
                            for (var i = 0; i < data.length; i++) {
                                $('#batches').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['batch_code']));
                            }
                        }
                    },
                    "json"
                    );
        }

        function load_approved_students() {
            var center_id = $('#initial_branch').val();
            var course_id = $('#initial_course').val();
            var intake_type = $('#intake_type').val();
            if (course_id != '') {
//                initial_assign_table
                $('#ini_assign_tbl_body').empty();
                $('input:checkbox').removeAttr('checked');
                $.post("<?php echo base_url('student/load_stu_initial_batch_assign') ?>", {'center_id': center_id, 'course_id': course_id, 'intake_type': intake_type},
                        function (data)
                        {
                            if (data == 'denied')
                            {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else
                            {
                                if (data.length > 0) {
                                    $('#check_all').removeAttr("disabled");
                                    for (var j = 0; j < data.length; j++) {
                                        $('#ini_assign_tbl_body').append('<tr class="info"><td>' + (j + 1) + '</td><td>' + data[j]['reg_no'] + '</td><td>' + data[j]['first_name'] + '</td><td><input type="checkbox" onclick="enable_assign_btn()" id="check_box_' + j + '" name="assignstudentchk[]" value="' + data[j]['stu_id'] + '"><input type="hidden" name="assignstudentlist[]" value="' + data[j]['stu_id'] + '"></td></tr>');
                                    }
                                } else {
                                    $('#check_all').prop("disabled", true);
                                    $('#ini_assign_tbl_body').append('<tr><td><td colspan=3>No Students</td></td></tr>');
                                }

                            }
                        },
                        "json"
                        );

            }
        }

        function assign_students()
        {
            $.ajax(
                    {
                        url: "<?php echo base_url('student/initial_batch_assign') ?>",
                        type: 'POST',
                        async: false,
                        cache: false,
                        dataType: 'json',
                        data: $('#initial_assign_form').serialize(),
                        success: function (data)
                        {
                            result_notification(data);
                        }
                    });
            load_approved_students();

        }

        function check_all_boxes() {
            var checked = $('#check_all').is(":checked");
            var tr_count = $('#initial_assign_table tbody tr').length;
            for (var i = 0; i < tr_count; i++) {
                $('#check_box_' + i).prop('checked', checked);
            }
            enable_assign_btn();
        }
        
         function load_course_list(center_id, status)
        {
            if(status == 1){
                $('#initial_course').find('option').remove().end();
                //$("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
                $('#initial_course').append('<option value=""></option>').val('');

                $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

                function (data)
                {
                    for (var i = 0; i < data.length; i++) 
                    {
                        $('#initial_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[ '+data[i]['course_code']+' ] - '+data[i]['course_name']));
                    }

                },
                "json"
                );
            }
            else{
                $('#sup_course').find('option').remove().end();
                //$("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
                $('#sup_course').append('<option value=""></option>').val('');

                $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

                function (data)
                {
                    for (var i = 0; i < data.length; i++) 
                    {
                        $('#sup_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[ '+data[i]['course_code']+' ] - '+data[i]['course_name']));
                    }

                },
                "json"
                );
            }
        }
        
        function enable_assign_btn()
        {
            var count = $('#initial_assign_table tbody').find('tr').length;
            var batch_id = $('#batches').val();
            var checked = false;
            var unchecked_count = 0;
            if (count > 0) {
                for (var j = 0; j<count; j++) {
                    if($('#check_box_'+j).is(':checked')){
                        checked = true;
                    } else {
                        unchecked_count++;
                    }
                }
            }
            
            if (checked && (batch_id != '' && batch_id != null)) {
                $('#assign_btn').prop('disabled',false);
            } else if (batch_id == '' || batch_id == null){
                 $('#assign_btn').prop('disabled',true);
            } else if(unchecked_count == count)  {
                $('#assign_btn').prop('disabled',true);
            }
        }
        

    </script>

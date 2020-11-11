<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>EXAM</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Exams and Assignments</li>
            <li><i class="fa fa-bank"></i>Exam</li>
        </ol>
    </div>

</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#addexam_tab" href="#addexam_tab" aria-controls="company_tab" role="tab" data-toggle="tab">Exam</a></li>
    <li role="presentation"><a id="#semexam_tab" href="#semexam_tab" aria-controls="group_tab" role="tab" data-toggle="tab">Semester Exam</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="addexam_tab">
        <div class="row">
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Add Exam
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form class="form-horizontal" role="form" action="<?php echo base_url('exam/save_exam') ?>" method="post"  id="exam_form" autocomplete="off" novalidate>
                                <br><br>
                                <div class="form-group">
                                    <input type="hidden" name="exam_id" id="exam_id">
                                    <input type="hidden" name="pre_exam_code" id="pre_exam_code">
                                    <label for="comcode" class="col-sm-3 control-label">Exam code:</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" maxlength="15" id="e_code" name="e_code"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Exam name:</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" id="e_name" name="e_name"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="des" name="des"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();validateExamCode();">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default" onclick="event.preventDefault();$('#exam_form').trigger('reset');$('#exam_id').val('');">Reset</button>
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
                            <table class="table table-bordered table-striped exam_table" id="exam_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam code</th>

                                        <th>Exam Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($exams_list as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['exam_code']; ?></td>

                                            <td><?php echo $row['exam_name']; ?></td>

                                            <td><a class='btn btn-info btn-xs' title="edit" onclick="edit_exam_load('<?php print_r($row['id']) ?>', '<?php print_r($row['exam_code']) ?>', '<?php print_r($row['exam_name']) ?>', '<?php print_r($row['description']) ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a> |
                                                <?php if ($row['deleted']) { ?>    
                                                    <button type="button" title="activate" class="btn btn-success btn-xs" onclick="change_status('<?php print_r($row['id']) ?>', '0')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></th>
                                                <?php } else { ?>
                                                    <button type="button" title="deactivate" class="btn btn-warning btn-xs" onclick="change_status('<?php print_r($row['id']) ?>', '1')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                                <?php } ?>
                                            </td>
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
    <div role="tabpanel" class="tab-pane" id="semexam_tab">
        <div class="row">
            <div class="col-md-5">
                <section class="panel">
                    <header class="panel-heading">
                        Semester Exams
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <form name="semester_exam_form" id="semester_exam_form" class="form-horizontal" role="form" method="post" autocomplete="off">
                                <input type="hidden" id="s_exam_id" name="s_exam_id">
                                <input type="hidden" id="pre_exm_course" name="pre_exm_course">
                                <input type="hidden" id="pre_exm_year" name="pre_exm_year">
                                <input type="hidden" id="pre_exm_semester" name="pre_exm_semester">
                                <input type="hidden" id="pre_exm_s_season" name="pre_exm_s_season">
                                <input type="hidden" id="pre_exm_batch" name="pre_exm_batch">
                                <input type="hidden" id="pre_exm_code" name="pre_exm_code">
                                <!--                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-md-3 control-label">Center:</label>
                                                                    <div class="col-md-9">
                                                                        <select type="text" class="form-control" id="l_center" name="l_center" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                                                            <option value="">---Select Center---</option>
                                <?php //foreach ($centers as $row) { ?>
                                                                                <option value="<?php //echo $row['br_id']                                    ?>"><?php //echo $row['br_code'] . "-" . $row['br_name']                                    ?></option>
                                <?php //} ?>
                                                                        </select>											
                                                                    </div>				         
                                                                </div>-->
<!--                                <div class="form-group">
                                    <label for="l_faculty" class="col-md-3 control-label">Faculty</label>
                                    <div class="col-md-9">
                                        <?php 
                                            //global $facultydrop;
                                            //global $selectedfac;
                                            //$facextraattrs = 'id="l_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null)"';
                                            //echo form_dropdown('l_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                            <option value="">---Select Course Code---</option> 
                                            <?php foreach ($all_exam_courses as $cours) { ?>
                                                <option value="<?php echo $cours['course_id']; ?>">
                                                    <?php echo $cours['course_code']; echo" - "; echo $cours['course_name']; ?> 
                                                </option>                                    
                                            <?php } ?>
                                        </select>											
                                    </div>				         
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters(this.value, null)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                            <option value="">---Select Year---</option>
                                        </select>											
                                    </div>				         
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                            <option value="">---Select Semester---</option>	
                                        </select>											
                                    </div>				         
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Study Season:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="s_season" name="s_season" onchange="load_batches(this.value, null, null);" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Study Season---</option>	
                                            <?php foreach ($study_seasons as $row) { ?>
                                                <option value="<?php echo $row['es_ac_year_id']; ?>">
                                                    <?php echo $row['ac_startdate'] . " to " . $row['ac_enddate']; ?> 
                                                </option>                                    
                                            <?php } ?>
                                        </select>											
                                    </div>				         
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                            <option value="">---Select Batch Code---</option>			
                                        </select>											
                                    </div>				         
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">Exam Code:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="l_exam_name" name="l_exam_name" onchange="load_exam_name(this.value)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                            <option value="">---Select Exam Code---</option>	
                                            <?php foreach ($exams_list as $row) { ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['exam_code'] ?></option>
                                            <?php } ?>
                                        </select>											
                                    </div>				         
                                </div>
                                <div class="form-group" id="div_exam_name" style="display: none;">
                                    <label for="inputEmail3" class="col-md-3 control-label">Exam Name:</label>
                                    <div class="col-md-9">
                                        <input type="text" height="70"  class="form-control" id="sem_e_name" name="sem_e_name" readonly>
                                    </div>				         
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-3 control-label"> Description:</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="s_des" name="s_des"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();validateSemesterExam();">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default" onclick="reset_sem_exams();">Reset</button>
                                    </div>
                                </div>
                            </form> 
                        </div>                        
                    </div>
                </section>
            </div>

            <div class="col-md-7">
                <section class="panel">
                    <header class="panel-heading">
                        Approved Semester Exam Lookup
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">	
                            <table class="table table-bordered table-striped " id="semester_exam_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>Year & Semester</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($semester_exams as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $row['course_code'] ?></td>
                                            <td><?php echo $row['batch_code'] ?></td>
                                            <td><?php echo $row['year_no'] . " & " . $row['semester_no'] ?></td>
                                            <td><?php echo $row['exam_code'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_semester_exam('<?php print_r($row['sem_exam_id']) ?>');"></span></button> |
                                                <?php if ($row['s_e_deleted']) { ?>
                                                    <button type="button" title="activate" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="change_sem_exam_status('<?php print_r($row['sem_exam_id']) ?>', '0');"></span></button>
                                                <?php } else { ?>
                                                    <button type="button" title="deactivate" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="change_sem_exam_status('<?php print_r($row['sem_exam_id']) ?>', '1');"></span></button>
                                                    <?php } ?>
                                            </td>

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

    <script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#semester_exam_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });

            $('#exam_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });

        });

        $.validate({
            form: '#exam_form'
        });

        $.validate({
            form: '#semester_exam_form'
        });

        function edit_exam_load(id, code, name, descri) {
            $('.se-pre-con').fadeIn('slow');
            $('#exam_id').val(id);
            $('#e_code').val(code);
            $('#pre_exam_code').val(code);
            $('#e_name').val(name);
            $('#des').val(descri);
            $('.se-pre-con').fadeOut('slow');

        }
        function change_status(exam_id, new_status)
        {
            $('.se-pre-con').fadeIn('slow');
            $.post("<?php echo base_url('exam/change_exam_status') ?>", {"exam_id": exam_id, "new_status": new_status},
                    function (data)
                    {
                        location.reload();
                        $('.se-pre-con').fadeOut('slow');
                    },
                    "json"
                    );
        }
        $(function () {
            $("#datepicker").datepicker();
        });

        function get_courses(flag, course_id) {
            $('#load_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
            $('#l_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
            if (flag === 1) {
                $.post("<?php echo base_url('Exam/load_course_programs') ?>", {},
                        function (data)
                        {
                            for (var i = 0; i < data.length; i++) {
                                var option_text = data[i]['course_code'] + " - " + data[i]['course_name'];
                                if (course_id == data[i]['course_id']) {
                                    $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(option_text));
                                } else {
                                    $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text(option_text));
                                }

                            }
                        },
                        "json"
                        );
            }
        }

        function get_course_code(id, flag, year_no)
        {
            $('#l_no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                    function (data)
                    {
                        if (data != null) {
                            for (var i = 1; i <= data['no_of_year']; i++) {
                                if (flag) {
                                    if (i == year_no) {
                                        $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i + " Year"));
                                    } else {
                                        $('#l_no_year').append($("<option></option>").attr("value", i).text(i + " Year"));
                                    }
                                } else {
                                    $('#l_no_year').append($("<option></option>").text(i + " Year"));
                                }
                            }
                        }
                    },
                    "json"
                    );
        }

        function load_semesters(year_no, semester_no, course_id) {
            $('#l_no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
            if (course_id == '' || course_id == null) {
                var course_id = $('#l_Dcode').val();
            }
            $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
                    function (data)
                    {
                        for (var i = 1; i <= data; i++) {
                            if (semester_no == i) {
                                $('#l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i + " Semester"));
                            } else {
                                $('#l_no_semester').append($("<option></option>").attr("value", i).text(i + " Semester"));
                            }
                        }
                    },
                    "json"
                    );
        }

        function load_exam_name(exam_id) {
            if (exam_id == '') {
                $("#div_exam_name").css("display", "none");
            } else {
                $("#div_exam_name").css("display", "block");

                $.post("<?php echo base_url('exam/get_exam_name_by_id') ?>", {'exam_id': exam_id},
                        function (data)
                        {
                            $('#sem_e_name').val(data['exam_name']);
                        },
                        "json"
                        );
            }

        }

        function load_batches(study_season_id, course_id, batch_id) {
            if (course_id == null || course_id == '') {
                var course_id = $('#l_Dcode').val();
            }
            //load batches
            $('#l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
            $.post("<?php echo base_url('batch/load_batches_by_season') ?>", {'study_season_id': study_season_id, 'course_id': course_id},
                    function (data)
                    {
                        for (j = 0; j < data.length; j++) {
                            if (data[j]['id'] == batch_id) {
                                $('#l_Bcode').append($("<option></option>").attr('selected', 'selected').attr("value", data[j]['id']).text(data[j]['batch_code']));
                            } else {
                                $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                            }


                        }

                    },
                    "json"
                    );
        }

        function save_semester_exam() {
            
            $('.se-pre-con').fadeIn('slow');
            var course = $('#l_Dcode').val();
            var year = $('#l_no_year').val();
            var semester = $('#l_no_semester').val();
            var stdy_season = $('#s_season').val();
            var batch = $('#l_Bcode').val();
            var exam_code = $('#l_exam_name').val();
            var exam_name = $('#sem_e_name').val();
            
            if(course == ""){
                funcres = {status: "denied", message: "Course Code cannot be empty!"};
                result_notification(funcres);
                $('.se-pre-con').fadeOut('slow');
            }
            else if(year == ""){
                funcres = {status: "denied", message: "Year cannot be empty!"};
                result_notification(funcres);
                $('.se-pre-con').fadeOut('slow');
            }
            else if(semester == ""){
                funcres = {status: "denied", message: "Semester cannot be empty!"};
                result_notification(funcres);
                $('.se-pre-con').fadeOut('slow');
            }
            else if(stdy_season == ""){
                funcres = {status: "denied", message: "Study Season cannot be empty!"};
                result_notification(funcres);
                $('.se-pre-con').fadeOut('slow');
            }
            else if(batch == ""){
                funcres = {status: "denied", message: "Batch Code cannot be empty!"};
                result_notification(funcres);
                $('.se-pre-con').fadeOut('slow');
            }
            else if(exam_code == ""){
                funcres = {status: "denied", message: "Exam Code cannot be empty!"};
                result_notification(funcres);
                $('.se-pre-con').fadeOut('slow');
            }
            else{
                $.ajax(
                        {
                            url: "<?php echo base_url('exam/save_semester_exam') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: $('#semester_exam_form').serialize(),
                            success: function (data)
                            {
                                if (data == 'denied')
                                {
                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                    result_notification(funcres);
                                } else
                                {
                                    result_notification(data);
                                    refresh_sem_exam_table();
                                    reset_sem_exams();
                                    //location.reload();
                                }
                            }
                        });
                    $('.se-pre-con').fadeOut('slow');
                    }
        }

        function edit_semester_exam(sem_exam_id) {
            $('#s_exam_id').val(sem_exam_id);
            $.post("<?php echo base_url('exam/load_sem_exam_by_id') ?>", {"sem_exam_id": sem_exam_id},
                    function (data)
                    {
                        console.info(data);
                        $('#l_faculty').val(data['faculty_id']);
                        get_courses(1, data['course_id']);
                        load_batches(data['study_season_id'], data['course_id'], data['batch_id'])
                        get_course_code(data['course_id'], 1, data['year_no']);
                        load_semesters(data['year_no'], data['semester_no'], data['course_id']);
                        $('#s_season').val(data['study_season_id']);
                        $('#l_exam_name').val(data['exam_id']);
                        $('#s_des').val(data['s_des']);
                        load_exam_name(data['exam_id']);
                        
                        $('#pre_exm_course').val(data['course_id']);
                        $('#pre_exm_year').val(data['year_no']);
                        $('#pre_exm_semester').val(data['semester_no']);
                        $('#pre_exm_batch').val(data['batch_id']);
                        $('#pre_exm_code').val(data['exam_id']);
                        $('#pre_exm_s_season').val(data['study_season_id']);
                    },
                    "json"
                    );
        }

        function change_sem_exam_status(sem_exam_id, new_status) {
            $.ajax(
                    {
                        url: "<?php echo base_url('exam/change_semester_exam_status') ?>",
                        type: 'POST',
                        async: true,
                        cache: false,
                        dataType: 'json',
                        data: {"sem_exam_id": sem_exam_id, "new_status": new_status},
                        success: function (data)
                        {
                            if (data == 'denied')
                            {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else
                            {
                                result_notification(data);
                                refresh_sem_exam_table();
                            }
                        }
                    });
        }

        function refresh_sem_exam_table() {
           // $('#semester_exam_table').DataTable().destroy();
            $('#semester_exam_table').DataTable().clear();

            $.post("<?php echo base_url('exam/load_sem_exam_data') ?>", {},
                    function (data)
                    {
                        for (j = 0; j < data.length; j++) {
                            if (data[j]['s_e_deleted'] == 1) {
                                content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='change_sem_exam_status(" + data[j]['sem_exam_id'] + ",0);'></span></button>";
                            } else {
                                content = "<button type='button' title='Deactivate' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true' onclick='change_sem_exam_status(" + data[j]['sem_exam_id'] + ",1);'></span></button>";
                            }
                            action_content = "</td><td align='center'><button type='button' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true' onclick='edit_semester_exam(" + data[j]['sem_exam_id'] + ");'></span></button> | " + content + "</td>";
                            $('#semester_exam_table').DataTable().row.add([
                                (j + 1),
                                data[j]['course_code'],
                                data[j]['batch_code'],
                                data[j]['year_no'] + " & " + data[j]['semester_no'],
                                data[j]['exam_code'],
                                action_content
                            ]).draw(false);
                        }
                    },
                    "json"
                    );
        }

        function reset_sem_exams() {
            $('#l_Dcode').val("");
            $('#s_exam_id').val("");
            $('#l_faculty').val("");
            load_batches(null, null, null)
            get_course_code(null, 0, null);
            load_semesters(null, null, null);
            $('#s_season').val("");
            $('#l_exam_name').val("");
            $('#s_des').val("");
            $('#div_exam_name').hide();
            $('#sem_e_name').val("");
        }
        
        
        function validateExamCode(){
                $('.se-pre-con').fadeIn('slow');
                var exam_code = $('#e_code').val().trim();
                
                if(exam_code != $('#pre_exam_code').val()){

                    $.post("<?php echo base_url('exam/check_duplicate_exam_code') ?>", {'exam_code': exam_code},
                    function (data)
                    {
                        if((data['exam_count']) != 0){
                            funcres = {status: "denied", message: "Exam Code Already Exists."};
                            result_notification(funcres);
                            $('.se-pre-con').fadeOut('slow');
                        }
                        else{
                            $('#exam_form').submit();
                            $('.se-pre-con').fadeOut('slow');
                        }
                    },
                    "json"
                    );
                }
                else{
                    $('#exam_form').submit();
                    $('.se-pre-con').fadeOut('slow');
                }
              
            }
            
            function validateSemesterExam(){
                $('.se-pre-con').fadeIn('slow');
                var id = $('#s_exam_id').val();
                var course = $('#l_Dcode').val().trim();
                var year = $('#l_no_year').val().trim();
                var semester = $('#l_no_semester').val().trim();
                var stdy_season = $('#s_season').val().trim();
                var batch = $('#l_Bcode').val().trim();
                var exam_code = $('#l_exam_name').val().trim();
                
                if(id != null){
                    
                //if((course != $('#pre_exm_course').val()) && (year != $('#pre_exm_year').val()) || (semester != $('#pre_exm_semester').val()) && (stdy_season != $('#pre_exm_s_season').val()) && (batch != $('#pre_exm_batch').val()) && (exam_code != $('#pre_exm_code').val())){

                    $.post("<?php echo base_url('Exam/check_duplicate_semester_exam') ?>", {'course': course, 'year': year, 'semester': semester, 'stdy_season': stdy_season, 'batch': batch, 'exam_code': exam_code},
                    function (data)
                    {
                        console.info(data);
                        if(id != data['sem_exam_id']){
                            if(data['count'] != 0){
                                funcres = {status: "denied", message: "Semester Exam Details Already Exists."};
                                result_notification(funcres);
                            }
                            else{
                                save_semester_exam();
                            }
                        }
                        else{
                            save_semester_exam();
                        }
                    },
                    "json"
                    );
                    $('.se-pre-con').fadeOut('slow');
                }
                else{
                     save_semester_exam();
                 }
            }
                                                

    </script>

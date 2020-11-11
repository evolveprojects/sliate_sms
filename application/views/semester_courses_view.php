<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i>Semester Courses</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-book"></i>Semester Courses</li>
        </ol>
    </div>
</div>

<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class="active"><a id="#lookup_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab">Lookup</a></li>
    <li role="presentation"><a id="#semcourses_tab" href="#semcourses_tab" aria-controls="semcourses_tab" role="tab" data-toggle="tab">Semester Courses</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab"> 
        <div class="row">
            <div class="col-md-12">    
                <div class="panel">
                    <header class="panel-heading">
                        Look Up
                    </header>
                    <div class="panel-body">
                        <div class="col-md-offset-1 col-md-10">	
                            <table class="table table-bordered table-striped viewregstudent">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>Study Season</th>
                                        <th>Batch Code</th>
                                        <th>Year & Semester</th>
                                        <th>Course Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($semester_courses as $row) {
                                        ?>
                                        <tr>
                                            <th><?php echo $i; ?></th>
                                            <th><?php echo $row['course_code'] ?></th>
                                            <th><?php echo $row['ac_startdate'] . " to " . $row['ac_enddate'] ?></th>
                                            <th><?php echo $row['batch_code'] ?></th>
                                            <th><?php echo $row['year_no'] . " & " . $row['semester_no'] ?></th>
                                            <th><?php echo $row['group_name'] ?></th>
                                            <th>
                                                <button type="button" class="btn btn-info btn-xs" id="tab_change_button"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_load('<?php print_r($row['se_course_id']) ?>', '<?php print_r($row['course_group_id']) ?>');"></span></button> |
                                                <?php if ($row['y_c_deleted']) { ?>
                                                    <button type="button" title="Activate" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="change_status('<?php print_r($row['se_course_id']) ?>', '0', '<?php print_r($row['faculty_id']) ?>', '<?php print_r($row['course_id']) ?>', '<?php print_r($row['year_no']) ?>', '<?php print_r($row['semester_no']) ?>');"></span></button></th>
                                            <?php } else { ?>
                                        <button type="button" title="Deactivate" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="change_status('<?php print_r($row['se_course_id']) ?>', '1', '<?php print_r($row['faculty_id']) ?>', '<?php print_r($row['course_id']) ?>', '<?php print_r($row['year_no']) ?>', '<?php print_r($row['semester_no']) ?>');"></span></button></th>
                                    <?php } ?>
                                    </th>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>	
            </div>
        </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="semcourses_tab">
        <div class="row">
            <div class="col-md-12">    
                <div class="panel">
                    <header class="panel-heading">
                        Semester Courses
                    </header>
                    <div class="panel-body">
                        <div class="col-md-offset-1 col-md-10">
                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('course/save_semester_courses') ?>" id="sem_course_form" name="sem_course_form" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" id="group_id" name="group_id">
                                    <input type="hidden" id="se_course_id" name="se_course_id">
                                    <input type="hidden" id="course" name="course">
                                    <label for="faculty" class="col-md-3 control-label">Faculty:</label>
                                    <div class="col-md-8">
                                        <?php 
                                            global $facultydrop;
                                            global $selectedfac;
                                            $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null);"';
                                            echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="grname" class="col-md-3 control-label">Course Code:</label>
                                    <div class="col-md-8">
                                        <select type="text" class="form-control new" id="load_Dcode" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_code(this.value)">
                                            <option value="">---Select Course Code---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="grname" class="col-md-3 control-label">Course Name:</label>
                                    <div class="col-md-8">
                                        <select type="text" class="form-control new" id="load_Dname" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_code(this.value)">
                                            <option value="">---Select Course Name---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Course Year:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="no_year" name="no_year" required data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_semesters(this.value, null)">
                                            <option value="">---Select Course Year---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Semester:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="no_semester" name="no_semester" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Semester---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Study Season:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="s_season" name="s_season" onchange="load_batches(this.value,null,null);" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Study Season---</option>
                                            <?php
                                            foreach ($study_seasons as $row) {
                                                ?>
                                                <option value="<?php echo $row['es_ac_year_id']; ?>">
                                                    <?php echo $row['ac_startdate'] . " to " . $row['ac_enddate']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="batch_code" name="batch_code" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="grname" class="col-md-3 control-label">Course Group:</label>
                                    <div class="col-md-8">
                                        <select type="text" class="form-control new" id="course_group" name="course_group" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_group_details(this.value);">
                                            <option value="">---Select Course Group---</option>
                                            <?php
                                            foreach ($active_groups as $row) {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['group_name']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div><br/>
                                <div class="form-group" id="course_details" style="display: none;">
                                    <label for="grname" class="col-md-12">All Courses :</label>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>type</th>
                                                    <th>Credits</th>
                                                    <th>Grading Method</th>
                                                    <th>Marking Method</th>
                                                </tr>
                                            </thead>
                                            <tbody id="course_list">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4">
                                    </div>
                                    <button type="submit" class="btn btn-info btn-md" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_semester_courses();">Reset</button>
                                </div>	
                            </form>  	
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>

        save_method = 'update';
        $(function () {
            $('.viewregstudent').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10, 20]
            });
        });
        $.validate({
            form: '#sem_course_form'
        });
        function get_course_code(id, year_no)
        {
            //load courses
            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
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
                    if (data['faculty_id'] != '' && data['faculty_id'] != null) {
                        get_courses(data['faculty_id'], 1, id);
                        for (var i = 1; i <= data['no_of_year']; i++) {
                            if (year_no == i) {
                                $('#no_year').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                            } else {
                                $('#no_year').append($("<option></option>").attr("value", i).text(i));
                            }
                        }
                    }
                }
            },
            "json"
            );
        }

        function load_batches(study_season_id, course_id ,batch_id) {
            if(course_id == null || course_id == ''){
                var course_id = $('#load_Dcode').val();
            }
            //load batches
            $('#batch_code').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
            $.post("<?php echo base_url('batch/load_batches_by_season') ?>", {'study_season_id': study_season_id, 'course_id': course_id},
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
                        if(data[j]['id'] == batch_id){
                            $('#batch_code').append($("<option></option>").attr('selected', 'selected').attr("value", data[j]['id']).text(data[j]['batch_code']));
                        } else {
                            $('#batch_code').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        }
                        

                    }
                }

            },
            "json"
            );
        }

        function get_course_code(id, year_no)
        {
            //load years
            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
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
                    get_courses(data['faculty_id'], 1, id);
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (year_no == i) {
                            $('#no_year').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                        } else {
                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
                        }
                    }
                }
            },
            "json"
            );

        }


        function get_courses(faculty_id, flag, course_id) {
            $('#load_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
            $('#load_Dname').find('option').remove().end().append('<option value="">---Select Course Name---</option>').val('');
            if (flag === 1) {
                $.post("<?php echo base_url('Year/load_course_programs') ?>", {'faculty_id': faculty_id},
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
                        if (course_id == data[i]['course_id']) {
                            $('#load_Dcode')
                                    .append($("<option></option>")
                                            .attr("value", data[i]['course_id'])
                                            .attr('selected', true)
                                            .text(data[i]['course_code']));
                            $('#load_Dname')
                                    .append($("<option></option>")
                                            .attr("value", data[i]['course_id'])
                                            .attr('selected', true)
                                            .text(data[i]['course_code']));
                        } else {
                            $('#load_Dcode')
                                    .append($("<option></option>")
                                            .attr("value", data[i]['course_id'])
                                            .text(data[i]['course_code']));
                            $('#load_Dname')
                                    .append($("<option></option>")
                                            .attr("value", data[i]['course_id'])
                                            .text(data[i]['course_code']));
                        }

                        }
                    }
                },
                "json"
                );
            }
        }

        function load_group_details(group_id) {
            if (group_id == "") {
                $("#course_details").css("display", "none");
            } else {
                $("#course_details").css("display", "block");
            }

            $.post("<?php echo base_url('course/get_group_details') ?>", {'group_id': group_id},
                    function (data)
                    {
                        if(data == 'denied')
                        {
                            funcres = {status:"denied", message:"You have no right to proceed the action"};
                            result_notification(funcres);
                        }
                        else
                        {
                            $('#course_list').empty();
                            for (i = 0; i < data['group_details'].length; i++) {
                                if (data['group_details'][i]['type'] == 1) {
                                    var type = "Core";
                                } else {
                                    var type = "Elective"
                                }
    //                          credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['group_details'][i]['credits'] + "' data-validation='required' data-validation-error-msg-required='Field can not be empty'>";
                                credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['group_details'][i]['credits'] + "' data-validation=' required number length' data-validation-error-msg-required='field can not be empty' data-validation-length='1-20' data-validation-error-msg-number='Invalid Credit Amount.' data-validation-allowing='range[1;20],int'>";
                                grading_options = "";
                                marking_options = "";
                                for (j = 0; j < data['grading_methods'].length; j++) {
                                    grading_options += "<option value='" + data['grading_methods'][j]['id'] + "'>" + data['grading_methods'][j]['grade_code'] + "</option>";
                                }
                                grading_select = "<select class='form-control' id='g_method' name='g_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + grading_options + "</select>";
                                for (k = 0; k < data['marking_methods'].length; k++) {
                                    marking_options += "<option value='" + data['marking_methods'][k]['id'] + "'>" + data['marking_methods'][k]['marking_code'] + "</option>";
                                }
                                marking_select = "<select class='form-control' id='m_method' name='m_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + marking_options + "</select>";
                                $("#course_list").append("<tr align='center'><td width='25px'>" + (i + 1) + "</td><td>" + data['group_details'][i]['code'] + "</td><td>" + data['group_details'][i]['course'] + "</td><td>" + type + "</td><td>" + credit_text + "</td><td>" + grading_select + "</td><td>" + marking_select + "</td></tr>");
                            }
                        }
                    },
                    "json"
                    );
        }

        function load_group_details_edit(se_course_id, course_group_id) {
            $("#course_details").css("display", "block");
            $.post("<?php echo base_url('course/get_sem_course_details') ?>", {'se_course_id': se_course_id, 'course_group_id': course_group_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (i = 0; i < data['sem_course_details'].length; i++) {
                        if (data['sem_course_details'][i]['type'] == 1) {
                            var type = "Core";
                        } else {
                            var type = "Elective"
                        }
    //                          credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['sem_course_details'][i]['new_credits'] + "' data-validation='required number length' data-validation-error-msg-required='field can not be empty' data-validation-length='1-20' data-validation-error-msg-number='Invalid Credit Amount.' data-validation-allowing='range[1;20],int'>";
                        credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['sem_course_details'][i]['new_credits'] + "' data-validation=' required number length' data-validation-error-msg-required='field can not be empty' data-validation-length='1-20' data-validation-error-msg-number='Invalid Credit Amount.' data-validation-allowing='range[1;20],int'>";
                        grading_options = "";
                        marking_options = "";
                        for (j = 0; j < data['grading_methods'].length; j++) {
                            if (data['sem_course_details'][i]['grading_method_id'] == data['grading_methods'][j]['id']) {
                                grading_options += "<option value='" + data['grading_methods'][j]['id'] + "' selected>" + data['grading_methods'][j]['grade_code'] + "</option>";
                            } else {
                                grading_options += "<option value='" + data['grading_methods'][j]['id'] + "'>" + data['grading_methods'][j]['grade_code'] + "</option>";
                            }
                        }
                        grading_select = "<select class='form-control' id='g_method' name='g_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + grading_options + "</select>";
                        for (k = 0; k < data['marking_methods'].length; k++) {
                            if (data['sem_course_details'][i]['marking_method_id'] == data['marking_methods'][k]['id']) {
                                marking_options += "<option value='" + data['marking_methods'][k]['id'] + "' selected>" + data['marking_methods'][k]['marking_code'] + "</option>";
                            } else {
                                marking_options += "<option value='" + data['marking_methods'][k]['id'] + "'>" + data['marking_methods'][k]['marking_code'] + "</option>";
                            }
                        }
                        marking_select = "<select class='form-control' id='m_method' name='m_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + marking_options + "</select>";
                        $("#course_list").append("<tr align='center'><td width='25px'>" + (i + 1) + "</td><td>" + data['sem_course_details'][i]['code'] + "</td><td>" + data['sem_course_details'][i]['course'] + "</td><td>" + type + "</td><td>" + credit_text + "</td><td>" + grading_select + "</td><td>" + marking_select + "</td></tr>");
                    }
                }
            },
            "json"
            );
        }

        function edit_load(se_course_id, course_group_id) {
            $('#all_tabs a[href="#semcourses_tab"]').tab('show');
            $.post("<?php echo base_url('course/edit_semester_course') ?>", {'se_course_id': se_course_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    $('#course').val(data['course_id']);
                    $('#faculty').val(data['faculty_id']);
                    get_courses(data['faculty_id'], 1, data['course_id']);
                    get_course_code(data['course_id'], data['no_of_year']);
                    load_semesters(data['year_no'], data['semester_no']);
                    $('#course_group').val(data['group_id']);
                    $('#s_season').val(data['study_season_id']);
                    load_batches(data['study_season_id'],data['course_id'],data['batch_id'])
                }
            },
            "json"
            );
            load_group_details_edit(se_course_id, course_group_id);
            $('#se_course_id').val(se_course_id);
            $('#faculty').prop("disabled", true);
            $('#load_Dcode').prop("disabled", true);
            $('#load_Dname').prop("disabled", true);
            $('#no_year').prop("disabled", true);
            $('#no_semester').prop("disabled", true);
            $('#s_season').prop("disabled", true);
            $('#batch_code').prop("disabled", true);
        }

        function change_status(se_course_id, new_status, faculty_id, course_id, year_no, semester_no) {
            $.post("<?php echo base_url('course/update_year_course_status') ?>", {'se_course_id': se_course_id, 'new_status': new_status, 'faculty_id': faculty_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
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

        function reset_semester_courses() {
            $('#se_course_id').val("");
            $('#faculty').prop("disabled", false);
            $('#load_Dcode').prop("disabled", false);
            $('#load_Dname').prop("disabled", false);
            $('#no_year').prop("disabled", false);
            $('#no_semester').prop("disabled", false);
            get_courses(null, null, null);
            get_course_code(null, null);
            load_semesters(null, null);
            $("#course_details").css("display", "none");
            $('#course_list').empty();
        }

        function load_semesters(year_no, semester_no) {
            $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
            var course_id = $('#load_Dcode').val();
            if (course_id == '' || course_id == null) {
                var course_id = $('#course').val();
            }
            $.post("<?php echo base_url('course/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (var i = 1; i <= data; i++) {
                        if (semester_no == i) {
                            $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                        } else {
                            $('#no_semester').append($("<option></option>").attr("value", i).text(i));
                        }
                    }
                }
            },
            "json"
            );
        }
    </script>

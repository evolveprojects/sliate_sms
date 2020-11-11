<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i>Semester Subjects</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-book"></i>Semester Subjects</li>
        </ol>
    </div>
</div>

<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class="active"><a id="#lookup_tab" href="#lookup_tab" aria-controls="lookup_tab" role="tab" data-toggle="tab">Lookup</a></li>
    <li role="presentation"><a id="#semsubjects_tab" href="#semsubjects_tab" aria-controls="semsubjects_tab" role="tab" data-toggle="tab">Semester Subjects</a></li>
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
                                        <th>Subject Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($semester_subjects as $row) {
                                        ?>
                                        <tr>
                                            <th><?php echo $i; ?></th>
                                            <th><?php echo $row['course_code'] ?></th>
                                            <th><?php echo $row['ac_startdate'] . " to " . $row['ac_enddate'] ?></th>
                                            <th><?php echo $row['batch_code'] ?></th>
                                            <th><?php echo $row['year_no'] . " & " . $row['semester_no'] ?></th>
                                            <th><?php echo $row['group_name'] ?></th>
                                            <th>
                                                <button type="button" class="btn btn-info btn-xs" id="tab_change_button"><span class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="edit_load('<?php print_r($row['se_subject_id']) ?>', '<?php print_r($row['subject_group_id']) ?>');"></span></button> |
                                                <?php if ($row['y_c_deleted']) { ?>
                                                    <button type="button" title="Activate" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" onclick="change_status('<?php print_r($row['se_subject_id']) ?>', '0', '<?php print_r($row['faculty_id']) ?>', '<?php print_r($row['course_id']) ?>', '<?php print_r($row['year_no']) ?>', '<?php print_r($row['semester_no']) ?>');"></span></button></th>
                                            <?php } else { ?>
                                        <button type="button" title="Deactivate" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true" onclick="change_status('<?php print_r($row['se_subject_id']) ?>', '1', '<?php print_r($row['faculty_id']) ?>', '<?php print_r($row['course_id']) ?>', '<?php print_r($row['year_no']) ?>', '<?php print_r($row['semester_no']) ?>');"></span></button></th>
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
    <div role="tabpanel" class="tab-pane" id="semsubjects_tab">
        <div class="row">
            <div class="col-md-12">    
                <div class="panel">
                    <header class="panel-heading">
                        Semester Subjects
                    </header>
                    <div class="panel-body">
                        <div class="col-md-offset-1 col-md-10">
                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('subject/save_semester_subjects') ?>" id="sem_subject_form" name="sem_subject_form" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" id="group_id" name="group_id">
                                    <input type="hidden" id="se_subject_id" name="se_subject_id">
                                    <input type="hidden" id="course" name="course">
                                    <input type="hidden" id="year" name="year">
                                    <input type="hidden" id="semester" name="semester">
                                    <input type="hidden" id="stdy_season" name="stdy_season">
                                    <input type="hidden" id="batch" name="batch">
                                    <label for="grname" class="col-md-3 control-label">Course:</label>
                                    <div class="col-md-8">
                                        <select type="text" class="form-control new" id="load_Dcode" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_year(this.value)">
                                            <option value="">---Select Course---</option>
                                            <?php foreach ($all_courses as $course){ ?>
                                            <option value="<?php echo $course['course_id'] ?>"><?php echo "[".$course['course_code']."]-".$course['course_name'] ?></option>
                                            <?php } ?>
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
                                    <label for="grname" class="col-md-3 control-label">Subject Group:</label>
                                    <div class="col-md-8">
                                        <select type="text" class="form-control new" id="subject_group" name="subject_group" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_group_details(this.value);">
                                            <option value="">---Select Subject Group---</option>
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
                                <div class="form-group" id="subject_details" style="display: none;">
                                    <label for="grname" class="col-md-12">All Subjects :</label>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>type</th>
                                                    <th>Credits</th>
                                                    <th>Subject Version</th>
                                                    <th>Grading Method</th>
                                                    <th>Marking Method</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="subject_list">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4">
                                    </div>
                                    <button type="submit" class="btn btn-info btn-md" name="save_btn" onclick="event.preventDefault();validateSemesterSubjects();">Submit</button>
                                    <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_semester_subjects();">Reset</button>
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
            form: '#sem_subject_form'
        });
        
        function get_course_year(id, year_no)
        {
            //load courses
            $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
            $.post("<?php echo base_url('subject/get_course') ?>", {'id': id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (year_no == i) {
                            $('#no_year').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                            $('#year').val(year_no);
                        } else {
                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
                        }
                    }
                }
            },
            "json"
            );
    
            $('#s_season').val("");
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
                            $('#batch').val(batch_id);
                        } else {
                            $('#batch_code').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                        }
                        

                    }
                }

            },
            "json"
            );
        }


        function load_group_details(group_id) {
            if (group_id == "") {
                $("#subject_details").css("display", "none");
            } else {
                $("#subject_details").css("display", "block");
            }

            $.post("<?php echo base_url('subject/get_group_details') ?>", {'group_id': group_id},
                    function (data)
                    {
                        if(data == 'denied')
                        {
                            funcres = {status:"denied", message:"You have no right to proceed the action"};
                            result_notification(funcres);
                        }
                        else
                        {
                            $('#subject_list').empty();
                            for (i = 0; i < data['group_details'].length; i++) {
                                if (data['group_details'][i]['type'] == 1) {
                                    var type = "Core";
                                } else {
                                    var type = "Elective"
                                }
    //                          credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['group_details'][i]['credits'] + "' data-validation='required' data-validation-error-msg-required='Field can not be empty'>";
                                credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['group_details'][i]['credits'] + "' data-validation=' required length' data-validation-error-msg-required='field can not be empty' data-validation-length='1-20' data-validation-allowing='range[1;20],int'>";
                                grading_options = "";
                                marking_options = "";
                                version_options = "";
                                
                                for (j = 0; j < data['grading_methods'].length; j++) {
                                    grading_options += "<option value='" + data['grading_methods'][j]['id'] + "'>" + data['grading_methods'][j]['grade_code'] + "</option>";
                                }
                                grading_select = "<select class='form-control' id='g_method' name='g_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + grading_options + "</select>";
                                
                                for (k = 0; k < data['marking_methods'].length; k++) {
                                    marking_options += "<option value='" + data['marking_methods'][k]['id'] + "'>" + data['marking_methods'][k]['marking_code'] + "</option>";
                                }
                                marking_select = "<select class='form-control' id='m_method' name='m_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + marking_options + "</select>";
                                
                                for (l = 0; l < data['versions'].length; l++) {
                                    version_options += "<option value='" + data['versions'][l]['version_id'] + "'>" + data['versions'][l]['version_name'] + "</option>";
                                }
                                version_select = "<select class='form-control' id='v_method' name='v_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + version_options + "</select>";
                                $("#subject_list").append("<tr align='center'><td width='25px'>" + (i + 1) + "</td><td>" + data['group_details'][i]['code'] + "</td><td>" + data['group_details'][i]['subject'] + "</td><td>" + type + "</td><td>" + credit_text + "</td><td>" + version_select + "</td><td>" + grading_select + "</td><td>" + marking_select + "</td></tr>");
                            }
                        }
                    },
                    "json"
                    );
        }

        function load_group_details_edit(se_subject_id, subject_group_id) {
            
            $('#subject_list').empty();
             
            $("#subject_details").css("display", "block");
            $.post("<?php echo base_url('subject/get_sem_subject_details') ?>", {'se_subject_id': se_subject_id, 'subject_group_id': subject_group_id},
            function (data)
            {
//                alert(data);
                console.info(data);
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    for (i = 0; i < data['sem_subject_details'].length; i++) {
                        if (data['sem_subject_details'][i]['type'] == 1) {
                            var type = "Core";
                        } else {
                            var type = "Elective"
                        }
    //                          credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['sem_subject_details'][i]['new_credits'] + "' data-validation='required number length' data-validation-error-msg-required='field can not be empty' data-validation-length='1-20' data-validation-error-msg-number='Invalid Credit Amount.' data-validation-allowing='range[1;20],int'>";
                        credit_text = "<input type='text' class='form-control' id='c_credit' name='c_credit[]' value='" + data['sem_subject_details'][i]['new_credits'] + "' data-validation=' required number length' data-validation-error-msg-required='field can not be empty' data-validation-length='1-20' data-validation-error-msg-number='Invalid Credit Amount.' data-validation-allowing='range[1;20],int'>";
                        grading_options = "";
                        marking_options = "";
                        version_options = "";
                        for (j = 0; j < data['grading_methods'].length; j++) {
                            if (data['sem_subject_details'][i]['grading_method_id'] == data['grading_methods'][j]['id']) {
                                grading_options += "<option value='" + data['grading_methods'][j]['id'] + "' selected>" + data['grading_methods'][j]['grade_code'] + "</option>";
                            } else {
                                grading_options += "<option value='" + data['grading_methods'][j]['id'] + "'>" + data['grading_methods'][j]['grade_code'] + "</option>";
                            }
                        }
                        grading_select = "<select class='form-control' id='g_method' name='g_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + grading_options + "</select>";
                        for (k = 0; k < data['marking_methods'].length; k++) {
                            if (data['sem_subject_details'][i]['marking_method_id'] == data['marking_methods'][k]['id']) {
                                marking_options += "<option value='" + data['marking_methods'][k]['id'] + "' selected>" + data['marking_methods'][k]['marking_code'] + "</option>";
                            } else {
                                marking_options += "<option value='" + data['marking_methods'][k]['id'] + "'>" + data['marking_methods'][k]['marking_code'] + "</option>";
                            }
                        }
                        marking_select = "<select class='form-control' id='m_method' name='m_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + marking_options + "</select>";
                        for (j = 0; j < data['versions'].length; j++) {
                            if (data['sem_subject_details'][i]['version_id'] == data['versions'][j]['version_id']) {
                                version_options += "<option value='" + data['versions'][j]['version_id'] + "' selected>" + data['versions'][j]['version_name'] + "</option>";
                            } else {
                                version_options += "<option value='" + data['versions'][j]['version_id'] + "'>" + data['versions'][j]['version_name'] + "</option>";
                            }
                        }
                        version_select = "<select class='form-control' id='v_method' name='v_method[]' data-validation='required' data-validation-error-msg-required='Field can not be empty'>" + version_options + "</select>";
                        $("#subject_list").append("<tr align='center'><td width='25px'>" + (i + 1) + "</td><td>" + data['sem_subject_details'][i]['code'] + "</td><td>" + data['sem_subject_details'][i]['subject'] + "</td><td>" + type + "</td><td>" + credit_text + "</td><td>" + version_select + "</td><td>" + grading_select + "</td><td>" + marking_select + "</td></tr>");
                    }
                }
            },
            "json"
            );
        }

        function edit_load(se_subject_id, subject_group_id) {
            $('#all_tabs a[href="#semsubjects_tab"]').tab('show');
            $.post("<?php echo base_url('subject/edit_semester_subject') ?>", {'se_subject_id': se_subject_id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    $('#load_Dcode').val(data['course_id']);
                    $('#course').val(data['course_id']);
                    //get_course_year(data['course_id'], data['no_of_year']);
                    get_course_year(data['course_id'], data['year_no']);
                    load_semesters(data['year_no'], data['semester_no']);
                    $('#subject_group').val(data['group_id']);
                    $('#s_season').val(data['study_season_id']);
                    $('#stdy_season').val(data['study_season_id']);
                    load_batches(data['study_season_id'],data['course_id'],data['batch_id'])
                }
            },
            "json"
            );
            load_group_details_edit(se_subject_id, subject_group_id);
            $('#se_subject_id').val(se_subject_id);
            $('#load_Dcode').prop("disabled", true);
            $('#no_year').prop("disabled", true);
            $('#no_semester').prop("disabled", true);
            $('#s_season').prop("disabled", true);
            $('#batch_code').prop("disabled", true);
        }

        function change_status(se_subject_id, new_status, faculty_id, course_id, year_no, semester_no) {
            $.post("<?php echo base_url('subject/update_year_subject_status') ?>", {'se_subject_id': se_subject_id, 'new_status': new_status, 'faculty_id': faculty_id, 'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no},
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

        function reset_semester_subjects() {
            $('#se_subject_id').val("");
            $('#faculty').prop("disabled", false);
            $('#load_Dcode').prop("disabled", false);
            $('#load_Dname').prop("disabled", false);
            $('#no_year').prop("disabled", false);
            $('#no_semester').prop("disabled", false);
            $('#batch_code').prop("disabled", false);
            $('#s_season').prop("disabled", false);
            //get_courses(null, null, null);
            load_batches(null, null, null);
            get_course_year(null, null);
            load_semesters(null, null);
            $("#subject_details").css("display", "none");
            $('#subject_list').empty();
        }

        function load_semesters(year_no, semester_no) {
            $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
            var course_id = $('#load_Dcode').val();
            if (course_id == '' || course_id == null) {
                var course_id = $('#course').val();
            }
            $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
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
                            $('#semester').val(semester_no);
                        } else {
                            $('#no_semester').append($("<option></option>").attr("value", i).text(i));
                        }
                    }
                }
            },
            "json"
            );
        }
        
        function validateSemesterSubjects(){
            
            var course = $('#load_Dcode').val().trim();
            var year = $('#no_year').val().trim();
            var semester = $('#no_semester').val().trim();
            var s_season = $('#s_season').val().trim();
            var batch_code = $('#batch_code').val().trim();
            
            if((course != $('#course').val()) || (year != $('#year').val()) || (semester != $('#semester').val()) || (s_season != $('#stdy_season').val()) || (batch_code != $('#batch').val())){
                
                $.post("<?php echo base_url('subject/check_duplicate_semester_subjects') ?>", {'course': course, 'year': year, 'semester': semester, 's_season': s_season, 'batch_code': batch_code},
                function (data)
                {
                    if(data['count'] > 0){
                        funcres = {status: "denied", message: "Semester Subjects already assigned for entered data!"};
                        result_notification(funcres);
                    }
                    else{
                        $("#sem_subject_form").submit();
                    }
                },
                "json"
                );
            }
            else{
                $("#sem_subject_form").submit();
            }
        }
    </script>

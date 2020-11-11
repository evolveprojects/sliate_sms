<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i>Paper Setter and Moderator</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-book"></i>Paper Setter and Moderator</li>
        </ol>
    </div>
</div>

<ul class="nav nav-tabs" role="tablist" id="all_tabs">
    <li role="presentation" class="active" ><a id="#papersetter_tab" href="#papersetter_tab" aria-controls="papersetter_tab" role="tab" data-toggle="tab">Paper setter Moderator</a></li>
</ul>

<div class="tab-content">
    
    <div role="tabpanel" class="tab-pane active" id="papersetter_tab">
        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('exam/save_paper_setter_and_moderator') ?>" id="paper_setter_moderator_form" name="paper_setter_moderator_form" autocomplete="off">
            <div class="panel">
                <header class="panel-heading">
                    Paper setter and Moderator
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="paper_setter_id" id="paper_setter_id">
                                <label for="grname" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-8" id="select_div">
                                    <select type="text" class="form-control new" id="load_Dcode" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_year_and_batches(this.value)">
                                        <option value="">---Select Course---</option>
                                        <?php foreach ($all_courses as $course){ ?>
                                        <option value="<?php echo $course['course_id'] ?>"><?php echo "[".$course['course_code']."]-".$course['course_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Course Year:</label>
                                <div class="col-md-8" id="select_div">
                                    <select type="text" class="form-control new" id="no_year" name="no_year" required data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_semesters(this.value, null)">
                                        <option value="">---Select Course Year---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Semester:</label>
                                <div class="col-md-8" id="select_div">
                                    <select type="text" class="form-control new" id="no_semester" name="no_semester" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                        <option value="">---Select Semester---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="batch_code" name="batch_code" onchange="load_exams(this.value);" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Batch Code---</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Exam:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="exam_code" name="exam_code" onchange="sem_exam_subjects(this.value);" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Exam---</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Exam Subject:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="sub_code" name="sub_code" onchange="get_assigned_lecturer(this.value);" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Subject---</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                         <br/><br/>
                         <div class="col-md-6">
                             <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Paper Setter:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="paper_setter" name="paper_setter" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Lecturer---</option>
                                        </select>
                                    </div>
                            </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                <label for="comcode" class="col-sm-3 control-label"> Paper Moderator:</label>
                                    <div class="col-md-8" id="select_div">
                                        <select type="text" class="form-control new" id="paper_moderator" name="paper_moderator" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Lecturer---</option>
                                        </select>
                                    </div>
                            </div>
                         </div>
                     </div>
                    
                     <div class="row">
                         <br/><br/>
                         <div class="col-md-offset-4">
                             <button type="submit" class="btn btn-info btn-md" name="save_btn" onclick="event.preventDefault();check_exist_data();">Save</button>
                            <button type="reset" class="btn btn-defult btn-md" name="reset">Reset</button>
                         </div>
                     </div>
                </div>
            </div>
        </form>
    </div>

    </div>
    <div id="dialog-confirm"></div>
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
        function load_year_and_batches(course_id){
            get_course_year(course_id);
            load_batches(course_id);
        }
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

        function load_batches(course_id) {
            if(course_id == null || course_id == ''){
                var course_id = $('#load_Dcode').val();
            }
            //load batches
            $('#batch_code').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
            $.post("<?php echo base_url('batch/get_course_batches') ?>", {'course_id': course_id},
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
                        $('#batch_code').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                    }
                }

            },
            "json"
            );
        }
        
        function load_exams(batch_id) {
            if(batch_id == null || batch_id == ''){
                var batch_id = $('#batch_code').val();
            }
            var year_no = $('#no_year').val();
            var sem_no = $('#no_semester').val();
            //load batches
            $('#exam_code').find('option').remove().end().append('<option value="">---Select Exam Code---</option>').val('');
            $.post("<?php echo base_url('batch/get_exams_for_batches') ?>", {'batch_id': batch_id,'year_no':year_no,'sem_no':sem_no},
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
                        $('#exam_code').append($("<option></option>").attr("value", data[j]['semester_exam_id']).text("["+data[j]['exam_code']+"] - "+data[j]['exam_name']));
                    }
                }

            },
            "json"
            );
        }
        
        function sem_exam_subjects(sem_exam_id) {
            if(sem_exam_id == null || sem_exam_id == ''){
                var sem_exam_id = $('#exam_code').val();
            }
            
            $('#sub_code').find('option').remove().end().append('<option value="">---Select Subject Code---</option>').val('');
            $.post("<?php echo base_url('batch/get_sem_exam_subjects') ?>", {'sem_exam_id': sem_exam_id},
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
                        $('#sub_code').append($("<option></option>").attr("value", data[j]['subject_id']).text("["+data[j]['code']+"] - "+data[j]['subject']));
                    }
                }

            },
            "json"
            );
        }


        function get_assigned_lecturer(sub_id){
             if(sub_id == null || sub_id == ''){
                var sub_id = $('#sub_code').val();
            }
            
            $('#paper_setter').find('option').remove().end().append('<option value="">---Select Lecturer---</option>').val('');
            $('#paper_moderator').find('option').remove().end().append('<option value="">---Select Lecturer---</option>').val('');
            $.post("<?php echo base_url('batch/get_assigned_lecturer') ?>", {'sub_id': sub_id},
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
                        $('#paper_setter').append($("<option></option>").attr("value", data[j]['stf_id']).text(data[j]['title_name']+"."+data[j]['stf_fname']+" "+data[j]['stf_lname']));
                        $('#paper_moderator').append($("<option></option>").attr("value", data[j]['stf_id']).text(data[j]['title_name']+"."+data[j]['stf_fname']+" "+data[j]['stf_lname']));
                    }
                }

            },
            "json"
            );
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
        
        function check_exist_data ()
        {
            var course = $('#load_Dcode').val().trim();
            var year = $('#no_year').val().trim();
            var semester = $('#no_semester').val().trim();
            var batch_code = $('#batch_code').val().trim();
            var sem_exam_id = $('#exam_code').val().trim();
            var sub_id = $('#sub_code').val().trim();
            var setter_lec_id = $('#paper_setter').val().trim();
            var mod_lec_id = $('#paper_moderator').val().trim();
            
            if(course == '' || year == '' || semester == '' || batch_code == '' || sem_exam_id == '' || sub_id == '' || setter_lec_id == '' || mod_lec_id == ''){
                funcres = {status: "denied", message: "Please select all fields!"};
                result_notification(funcres);
            } else {
                $.post("<?php echo base_url('exam/check_duplicate_setter_moderator') ?>", {'semester_exam_id': sem_exam_id, 'subject_id': sub_id, 'setter_lecturer_id': setter_lec_id, 'moderator_lecturer_id': mod_lec_id},
                function (data)
                {
                    if (data === undefined || data== null) {
                        $("#paper_setter_moderator_form").submit();
                    }
                    else{
                        $('#paper_setter_id').val(data['paper_setter_id']);
                        
                        $("#dialog-confirm").html("Paper setter and moderator lecturers already exists.Do you really want update existing paper setter and moderator lecturers?");
                        
                        // Define the Dialog and its properties.
                        $("#dialog-confirm").dialog({
                            resizable: false,
                            modal: true,
                            title: "Update existing paper setter and moderator",
                            height: 170,
                            width: 500,
                            draggable: false,
                            buttons: [
                                {
                                    text: "Yes",
                                    "class": 'btn btn',
                                    click: function() {
                                        $(this).dialog('close');
                                        $("#paper_setter_moderator_form").submit();
                                    }
                                },
                                {
                                    text: "No",
                                    "class": 'btn btn-info',
                                    click: function() {
                                        $(this).dialog('close');
                                    }
                                }
                            ]
                            //$('.se-pre-con').fadeOut('slow');
                        }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'});
                    }
                },
                "json"
                );
            }
            
            
            
        }
        
        
    </script>

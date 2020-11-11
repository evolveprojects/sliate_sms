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
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#lookup" href="#lookup" aria-controls="lookup" role="tab" data-toggle="tab">Lookup</a></li>
    <li role="presentation"><a id="#course_select" href="#course_select" aria-controls="course_select" role="tab" data-toggle="tab">Course Selection</a></li>
</ul>
<div class="tab-content"> 
    <div role="tabpanel" class="tab-pane active" id="lookup">
        <div class="panel">
            <div class="panel-heading">
                Lookup
            </div>
            <br/>
            <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-9">
                                    <?php 
                                        global $branchdrop;
                                        global $selectedbr;
                                        $extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                        echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                    ?>
                                </div>
                            </div>  			
                        </div>
                        <div class="form-group col-md-4">							                           
                            <div class="form-group">
                                <label for="l_faculty" class="col-md-3 control-label">Faculty:</label>
                                <div class="col-md-9">
                                    <?php 
                                        global $facultydrop;
                                        global $selectedfac;
                                        $facextraattrs = 'id="l_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 1)"';
                                        echo form_dropdown('l_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                    ?>
                                </div>
                            </div>          			
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_code(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Course Code---</option>
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
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters(this.value, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-md" name="search" onclick="search_details(1)">Students Without Courses</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_details(0);">Search</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table name="student_look" id="student_look" class="table table-striped table-bordered dt-responsive nowrap student_look" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Registration Number</th>
                                    <th>Student Name</th>
                                    <th>NIC</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_body">
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="modal fade bs-example-modal-lg" id="view_selected_course">
                    <div class="modal-dialog modal-lg" style="width:50%;padding-top:13px">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Selected Courses</h4>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class='list-group-item'><b>Core Courses</b></li>
                                    <ul class="list-group model_student_ccourses" id="model_student_ccourses"></ul>
                                </ul>
                                <ul class="list-group">
                                    <li class='list-group-item'><b>Elective Courses</b></li>
                                    <ul class="list-group model_student_ecourses" id="model_student_ecourses"></ul>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bs-example-modal-lg" id="view_not_selected">
                    <div class="modal-dialog modal-lg" style="width:50%;padding-top:13px">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Students without Courses</h4>
                            </div>
                            <div class="modal-body">
                                <table id="viewttbl" class="table table-bordered" style="width:100%" cellspacing="0">
                                    <thead id="viewttbl_head">
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="width:14%;text-align: center">Registration Number</th>
                                            <th style="width:14%;text-align: center">Full Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id='viewttbl_body'> 

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="course_select">
        <div class="row">
            <div class="col-md-12">    
                <div class="panel">
                    <form class="form-horizontal" role="form" method="post" id="grp_form" autocomplete="off">
                        <header class="panel-heading">
                            Courses Selection
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" id="group_id" name="group_id">
                                        <label for="center" class="col-md-3 control-label">Center : </label>
                                        <div class="col-md-8">
                                            <?php 
                                                global $branchdrop;
                                                global $selectedbr;
                                                $extraattrs = 'id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                                echo form_dropdown('center',$branchdrop,$selectedbr, $extraattrs); 
                                            ?>
                                        </div>
                                    </div>  
                                    <div class="form-group">                           
                                        <label for="comcode" class="col-md-3 control-label">Faculty Code : </label>
                                        <div class="col-md-8">
                                            <?php 
                                                global $facultydrop;
                                                global $selectedfac;
                                                $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 0)"';
                                                echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                            ?>
                                        </div>         
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="year_id" id="year_id">
                                        <label for="course_id" class="col-md-3 control-label">Course Code:</label>
                                        <div class="col-md-8">
                                            <select type="text" class="form-control new" id="load_Dcode" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_code(this.value, 1, null, null, 0)">
                                                <option value="">---Select Course Code---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_id" class="col-md-3 control-label">Course Name:</label>
                                        <div class="col-md-8">
                                            <select type="text" class="form-control new" id="load_Dname" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_code(this.value, 1, null, null)">
                                                <option value="">---Select Course Name---</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="comcode" class="col-sm-3 control-label"> Course Year:</label>
                                        <div class="col-md-8" id="select_div">
                                            <select type="text" class="form-control new" id="no_year" name="no_year" required data-validation="required" data-validation-error-msg-required="Field can not be empty"  onchange="load_semesters(this.value, null, 0)">
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
                                        <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                        <div class="col-md-8">
                                            <select type="text" class="form-control" id="Bcode" name="Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_student_list(this.value);">
                                                <option value="">---Select Batch Code---</option>
                                            </select>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="group_id" name="group_id">
                                        <label for="grname" class="col-md-3 control-label">Student:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="student" name="student" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_year_courses(0);">
                                                <option value="">---Select Student---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="div_courses" style="display: none;">
                                    <div class="form-group">
                                        <input type="hidden" id="group_id" name="group_id">
                                        <label for="grname" class="col-md-12">Core Courses</label>
                                        <div class="col-md-8">
                                            <table class="table">
                                                <tbody id="core_courses" class="core_courses">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="grname" class="col-md-12">Please select elective courses from bellow</label>
                                        <div class="col-md-8">
                                            <table class="table">
                                                <tbody id="elective_courses" class="elective_courses">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                        </div>
                                        <button type="submit" class="btn btn-info btn-md" name="submit" onclick="event.preventDefault(); save_courses()">Save</button>
                                        <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_course_list();">Reset</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>

            save_method = 'update';
            $(function () {
                $('.student_look').DataTable({
                    'ordering': true,
                    'lengthMenu': [10, 20]
                });
            });
            function get_courses(faculty_id, flag, course_id, lookup_flag) {
                $('#load_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
                $('#l_Dcode').find('option').remove().end().append('<option value="">---Select Course Code---</option>').val('');
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
                                            if (lookup_flag) {
                                                $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                                            }
                                            $('#load_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                                            $('#load_Dname').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']));
                                        } else {
                                            if (lookup_flag) {
                                                $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
                                            }
                                            $('#load_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
                                            $('#load_Dname').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']));
                                        }

                                    }
                                }
                            },
                            "json"
                            );
                }
            }
            function get_course_code(id, flag, year_no, batch_id, lookup_flag)
            {
                $('#load_Dname').val(id);
                $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
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
                                if (data != null) {
                                    for (var i = 1; i <= data['no_of_year']; i++) {
                                        if (flag) {
                                            if (i == year_no) {
                                                if (lookup_flag) {
                                                    $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                                }
                                                $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i));
                                            } else {
                                                if (lookup_flag) {
                                                    $('#l_no_year').append($("<option></option>").attr("value", i).text(i));
                                                }
                                                $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                            }
                                        } else {
                                            if (lookup_flag) {
                                                $('#l_no_year').append($("<option></option>").text(i));
                                            }
                                            $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                        }
                                    }
                                }

                                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                        function (data)
                                        {

                                            for (j = 0; j < data.length; j++) {
                                                if (data[j]['id'] == batch_id) {
                                                    if (lookup_flag) {
                                                        $('#l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                    }
                                                    $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                } else {
                                                    if (lookup_flag) {
                                                        $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                    }
                                                    $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                            }

                                        },
                                        "json"
                                        );
                            }
                        },
                        "json"
                        );
            }

            function get_course_code(id, flag, year_no, batch_id)
            {
                $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                $('#load_Dcode').val(id);
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
                                if (data != null) {
                                    for (var i = 1; i <= data['no_of_year']; i++) {
                                        $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                    }
                                }
                                $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                        function (data)
                                        {

                                            for (j = 0; j < data.length; j++) {
                                                if (data[j]['id'] == batch_id) {
                                                    $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                } else {
                                                    $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                            }

                                        },
                                        "json"
                                        );
                            }
                        },
                        "json"
                        );
            }

            function get_student_list(batch_id) {
                $('#student').find('option').remove().end().append('<option value="">---Select Student---</option>').val('');
                $.post("<?php echo base_url('student/get_student_list') ?>", {'batch_id': batch_id,'branch': $('#center').val(),'faculty' : $('#faculty').val()},
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
                                    $('#student').append($("<option></option>").attr("value", data[j]['stu_id']).text(data[j]['reg_no']));
                                }
                            }
                        },
                        "json"
                        );
            }

            function load_year_courses(flag) {
                $(".core_courses").empty();
                $(".elective_courses").empty();
                if (flag) {
                    $("#div_courses").css("display", "none");
                } else {
                    $("#div_courses").css("display", "block");
                    var course_id = $('#load_Dcode').val();
                    var semester_no = $('#no_semester').val();
                    var batch_id = $('#Bcode').val();
                    
                    $.post("<?php echo base_url('student/get_semester_courses') ?>", {'course_id': course_id, 'semester_no': semester_no, 'batch_id': batch_id},
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
                                        if (data[j]['type'] == 1) {
                                            $("#core_courses").append("<tr><td><input type='hidden' name='c_course[]' id='c_course' value='" + data[j]['course_id'] + "'> " + data[j]['course'] + "</td></tr>");
                                        } else {
                                            $("#elective_courses").append("<tr><td><input type='checkbox' name='e_course[]' id ='e_course' value='" + data[j]['course_id'] + "'>&nbsp;&nbsp;&nbsp;" + data[j]['course'] + "</td></tr>");
                                        }
                                    }
                                }
                            },
                            "json"
                            );
                }
            }

            function load_semesters(year_no, semester_no, lookup_flag) {
                $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                if (lookup_flag) {
                    var course_id = $('#l_Dcode').val();
                } else {
                    var course_id = $('#load_Dcode').val();
                }
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
                                        if (lookup_flag) {
                                            $('#l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                                        }
                                        $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i));
                                    } else {
                                        if (lookup_flag) {
                                            $('#l_no_semester').append($("<option></option>").attr("value", i).text(i));
                                        }
                                        $('#no_semester').append($("<option></option>").attr("value", i).text(i));
                                    }
                                }
                            }
                        },
                        "json"
                        );
            }

            function search_details(flag) {
                var res = [];
                var center_id = $('#l_center').val();
                var faculty_id = $('#l_faculty').val();
                var course_id = $('#l_Dcode').val();
                var year_no = $('#l_no_year').val();
                var semester_no = $('#l_no_semester').val();
                var batch_id = $('#l_Bcode').val();
                if (batch_id == null || batch_id == '' || batch_id == 0) {
                    res['status'] = 'denied';
                    res['message'] = 'Please Select Relevent Batch Code';
                    result_notification(res);
                } else {
                    if (flag == 1) {
                        $.post("<?php echo base_url('student/students_without_course') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id, 'center_id': center_id,'faculty_id':faculty_id},
                                function (data)
                                {   
                                    if(data == 'denied')
                                    {
                                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                                        result_notification(funcres);
                                    }
                                    else
                                    {
                                        if (data.length == 0) {
                                            res['status'] = 'denied';
                                            res['message'] = 'There are no students without courses.';
                                            result_notification(res);
                                        } else if (data.length > 0) {
                                            $('#viewttbl_body').find('tr').remove();
                                            $('#view_not_selected').modal('show');
                                            for (j = 0; j < data.length; j++) {
                                                $('#viewttbl_body').append("<tr><td style='width:14%;text-align: center'>"+(j+1)+"</td><td style='width:14%;text-align: center'>" + data[j]['reg_no'] + "</td><td style='width:14%;text-align: center'>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td></tr>");
                                            }
                                        } else {
                                            res['status'] = 'denied';
                                            res['message'] = 'All Students are selected courses.';
                                            result_notification(res);
                                        }
                                    }
                                },
                                "json"
                                );
                    } else {

                        $.post("<?php echo base_url('student/filter_students_course_selection') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id, 'center_id': center_id,'faculty_id':faculty_id},
                                function (data)
                                {
                                    if(data == 'denied')
                                    {
                                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                                        result_notification(funcres);
                                    }
                                    else
                                    {
                                        if (data.length > 0) {
    //                                        $('#tbl_body').find('tr').remove();
                                            $('#student_look').DataTable().clear();
                                            for (j = 0; j < data.length; j++) {
                                                if (data[j]['stu_c_deleted'] == 1) {
                                                    content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='change_status(" + data[j]['stu_co_id'] + ",0);'></span></button>";
                                                } else {
                                                    content = "<button type='button' title='Deactivate' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true' onclick='change_status(" + data[j]['stu_co_id'] + ",1);'></span></button>";
                                                }
    //                                            $('#tbl_body').append("<tr><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td><td>" + data[j]['nic_no'] + "</td><td align='center'><button type='button' title='Show Courses' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='load_course_modal(" + data[j]['stu_co_id'] + ");'></span></button> " + content + "</td></tr>");
                                                action_content = "</td><td align='center'><button type='button' title='Show Courses' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='load_course_modal(" + data[j]['stu_co_id'] + ");'></span></button> " + content + "</td>";
                                                $('#student_look').DataTable().row.add([
                                                    (j + 1),
                                                    data[j]['reg_no'],
                                                    data[j]['first_name'] + " " + data[j]['last_name'],
                                                    data[j]['nic_no'],
                                                    action_content
                                                ]).draw(false);

                                            }


                                        }
                                    }
                                },
                                "json"
                                );
                    }
                }
            }
            function load_course_modal(stu_co_id) {
                $(".model_student_ccourses").empty();
                $(".model_student_ecourses").empty();
                $('#view_selected_course').modal('show');
                $.post("<?php echo base_url('student/get_student_course_list') ?>", {'stu_co_id': stu_co_id},
                        function (data)
                        {
                            if (data == 'denied')
                            {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else {
                                for (j = 0; j < data.length; j++) {
                                    if (data[j]['type'] == 1) {
                                        $('#model_student_ccourses').append("<li class='list-group-item'>" + data[j]['course'] + "</li>");
                                    } else {
                                        $('#model_student_ecourses').append("<li class='list-group-item'>" + data[j]['course'] + "</li>");
                                    }

                                }
                            }
                        },
                        "json"
                        );


            }

            function change_status(stu_co_id, new_status) {
                $.ajax(
                        {
                            url: "<?php echo base_url('student/update_student_course_status') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: {'stu_co_id': stu_co_id, 'new_status': new_status},
                            success: function (data)
                            {
                                if (data == 'denied')
                                {
                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                    result_notification(funcres);
                                } else
                                {

                                    search_details(2);
                                    result_notification(data);
                                }
                            }
                        });
            }

            function save_courses() {
                //console.log($('#grp_form').serialize());
                $.ajax(
                        {
                            url: "<?php echo base_url('student/save_student_courses') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: $('#grp_form').serialize(),
                            success: function (data)
                            {
                                if (data == 'denied')
                                {
                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                    result_notification(funcres);
                                } else
                                {
                                    result_notification(data);
                                    reset_course_list();
                                }
                            }
                        });
            }

            function reset_course_list() {
                get_courses(null, 0, null, 0);
                get_course_code(null, 0, null, null, 0);
                load_semesters(null, null, 0);
                get_student_list(null);
                load_year_courses(1);
            }

        </script>

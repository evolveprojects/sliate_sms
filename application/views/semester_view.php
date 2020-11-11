<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> SEMESTER </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Semester</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Manage Semesters
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='myForm' class="form-horizontal" role="form" id="semester_reg" action="<?php echo base_url('semester/save_semester') ?>" method="post" autocomplete="off" novalidate>
                        <br>
                        <div class="form-group">
                            <input type="hidden" name="semester_id" id="semester_id">
                            <input type="hidden" name="course_id" id="course_id">
                            <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                            <div class="col-md-9">
                                <select type="text" class="form-control new" id="load_Dcode" name="load_Dcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_years(this.value, 0)">
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
                            <label for="comcode" class="col-sm-3 control-label"> Course Year:</label>
                            <div class="col-md-9" id="select_div">
                                <select type="text" class="form-control new" id="no_year" name="no_year" required data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                    <option value="">---Select Course Year---</option>
                                </select>
                            </div>
                        </div>	
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Total Semesters:</label>
                            <div class="col-md-9" id="select_div">
                                <input type="text" height="70" class="form-control" id="no_of_semester" name="no_of_semester" placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="1-5" data-validation-error-msg-number="Invalid number of semesters." data-validation-allowing="range[1;8],int">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button type="reset" name="Reset" class="btn btn-default" onclick="reset_fields();">Reset</button>
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
                    <table id="viewregstudent" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Code</th>
                                <th>Course Year</th>
                                <th>Course Semesters</th>
                                <th>Action</th>
                            </tr>				
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($sem_view)) {
                                $i = 1;
                                foreach ($sem_view as $sem) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td width=150px>" . "[".$sem['course_code']."]-".$sem['course_name']. "</td>";
                                    echo "<td>" . $sem['year_no'] . "</td>";
                                    echo "<td>" . $sem['no_of_semester'] . "</td>";
                                    echo "<td><a class='btn btn-info btn-xs' title='edit' onclick='event.preventDefault();edit_semester(" . $sem['semester_id'] . "," . $sem['course_id'] . "," . $sem['year_no'] . "," . $sem['no_of_semester'] . ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>| ";
                                    if ($sem["semester_deleted"] == "0") {
                                        echo "<button title='deactivate' onclick='event.preventDefault();update_year_status(" . $sem["course_id"] . "," . $sem["year_no"] . "," . $sem["semester_id"] . ",1)' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                                    } else {
                                        echo "<button title='activate' onclick='event.preventDefault();update_year_status(" . $sem["course_id"] . "," . $sem["year_no"] . "," . $sem["semester_id"] . ",0)' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
                                    }
                                    echo "</td></tr>";
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script type="text/javascript">

                                    $(document).ready(function () {
                                        $('#viewregstudent').DataTable({
                                            'ordering': true,
                                            'lengthMenu': [5, 10, 20, 50]
                                        });
                                        $('#viewregstudent td').css('white-space','initial');
                                    });

                                    $.validate({
                                        form: '#semester_reg'
                                    });

                                    function get_course_years(id, flag, year_no)
                                    {
                                        $('#load_Dcode').val(id);
                                        $('#no_year')
                                                .find('option')
                                                .remove()
                                                .end()
                                                .append('<option value="">---Select Course Year---</option>')
                                                .val('');
                                        $.post("<?php echo base_url('semester/link_course') ?>", {'id': id},
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
                                                                        $('#no_year')
                                                                                .append($("<option></option>")
                                                                                        .attr("value", i)
                                                                                        .attr('selected', 'selected')
                                                                                        .text(i));
                                                                    } else {
                                                                        $('#no_year')
                                                                                .append($("<option></option>")
                                                                                        .attr("value", i)
                                                                                        .text(i));
                                                                    }
                                                                } else {
                                                                    $('#no_year')
                                                                            .append($("<option></option>")
                                                                                    .attr("value", i)
                                                                                    .text(i));
                                                                }
                                                            }
                                                        }
                                                    }
                                                },
                                                "json"
                                                );
                                    }

                                    function edit_semester(semester_id, course_id, year_no, no_of_semester)
                                    {
                                        $('#load_Dcode').prop('disabled', true);
                                        $('#load_Dname').prop('disabled', true);
                                        $('#no_year').prop('disabled', true);
                                        
                                        get_course_years(course_id, 1, year_no);
                                        
                                        document.getElementById('semester_id').value = semester_id;
                                        document.getElementById('course_id').value = course_id;
                                        document.getElementById('no_year').value = year_no;
                                        document.getElementById('no_of_semester').value = no_of_semester;     
                                    }

                                    function update_year_status(course_id, year_no, semester_id, new_status)
                                    {
                                        $.post("<?php echo base_url('semester/update_semester_status') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_id': semester_id, 'new_status': new_status},
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

                                    function reset_fields() {
                                        $('#load_Dcode').prop('disabled', false);
                                        $('#load_Dname').prop('disabled', false);
                                        $('#no_year').prop('disabled', false);

                                        $('#load_Dcode').val("");
                                        $('#load_Dname').val("");
                                        $('#no_of_semester').val("");
                                        $('#semester_id').val("");
                                        get_course_years(null, null, null);
                                    }

//                                    function get_courses(flag, course_id) {
//                                        $('#load_Dcode')
//                                                .find('option')
//                                                .remove()
//                                                .end()
//                                                .append('<option value="">---Select Course Code---</option>')
//                                                .val('');
//                                        $('#load_Dname')
//                                                .find('option')
//                                                .remove()
//                                                .end()
//                                                .append('<option value="">---Select Course Name---</option>')
//                                                .val('');
//
//                                        if (flag === 1) {
//                                            $.post("<?php //echo base_url('Year/load_course_programs') ?>", {'faculty_id': faculty_id},
//                                            function (data)
//                                            {
//                                                if(data == 'denied')
//                                                {
//                                                    funcres = {status:"denied", message:"You have no right to proceed the action"};
//                                                    result_notification(funcres);
//                                                }
//                                                else
//                                                {
//                                                    for (var i = 0; i < data.length; i++) {
//                                                        if (course_id == data[i]['course_id']) {
//                                                            $('#load_Dcode')
//                                                                    .append($("<option></option>")
//                                                                            .attr("value", data[i]['course_id'])
//                                                                            .attr('selected', true)
//                                                                            .text(data[i]['course_code']));
//                                                            $('#load_Dname')
//                                                                    .append($("<option></option>")
//                                                                            .attr("value", data[i]['course_id'])
//                                                                            .attr('selected', true)
//                                                                            .text(data[i]['course_code']));
//                                                        } else {
//                                                            $('#load_Dcode')
//                                                                    .append($("<option></option>")
//                                                                            .attr("value", data[i]['course_id'])
//                                                                            .text(data[i]['course_code']));
//                                                            $('#load_Dname')
//                                                                    .append($("<option></option>")
//                                                                            .attr("value", data[i]['course_id'])
//                                                                            .text(data[i]['course_code']));
//                                                        }
//
//                                                    }
//                                                }
//                                            },
//                                            "json"
//                                            );
//                                        }
//                                    }

    </script>



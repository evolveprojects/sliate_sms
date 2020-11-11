<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> COURSE YEAR </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Course Year</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Manage Course Years
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='myForm' class="form-horizontal" role="form" action="<?php echo base_url('year/course_year_save') ?>" method="post"  id="reg_form" autocomplete="off" novalidate>
                        <br><br>
<!--                        <div class="form-group">
                            <label for="faculty" class="col-md-3 control-label">Faculty Code : </label>
                            <div class="col-md-7">
                                <?php 
//                                    global $facultydrop;
//                                    global $selectedfac;
//                                    $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null)"';
//                                    echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                ?>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <input type="hidden" name="year_id" id="year_id">
                            <label for="course_id" class="col-md-3 control-label">Course :</label>
                            <div class="col-md-9">
                                <select type="text" class="form-control new" id="load_Dcode" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
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
                            <label for="comcode" class="col-sm-3 control-label">Total Years: </label>
                            <div class="col-sm-9">
                                <input type="text" height="70" class="form-control" id="year" name="no_of_year" placeholder="" data-validation=" required number length" data-validation-error-msg-required="field can not be empty" data-validation-length="1-5" data-validation-error-msg-number="Invalid number of years." data-validation-allowing="range[1;5],int">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button type="reset" name="Reset" class="btn btn-default" onclick="reset_fields();">Reset</button>
                            </div>
                        </div><p id="load_Dname"><p>
                    </form>
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
                    <table id="table1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Course Years</th>
                                <th>Action</th>
                            </tr>				
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($degyear)) {
                                foreach ($degyear as $deg) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td style='white-space: initial;'>" . "[".$deg['course_code']."]-".$deg['course_name']. "</td>";
                                    echo "<td>" . $deg['no_of_year'] . "</td>";
                                    echo "<td><a class='btn btn-info btn-xs' title='edit' onclick='event.preventDefault();edit_course_year(" . $deg['year_id'] . ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>| ";
                                    if ($deg["deleted"] == "0") {
                                        echo "<button title='deactivate' onclick='event.preventDefault();update_year_status(" . $deg['id'] . "," . $deg['course_id'] . ",1)' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                                    } else {
                                        echo "<button title='activate' onclick='event.preventDefault();update_year_status(" . $deg['id'] . "," . $deg['course_id'] . ",0)' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
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
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">
                                    $.validate({
                                        form: '#reg_form'
                                    });

                                    $(document).ready(function () {
                                        $('#table1').DataTable({
                                            'ordering': true,
                                            'lengthMenu': [5, 10]
                                        });
                                        $('#table1 td').css('white-space','initial');
                                    });

                                    

                                    function edit_course_year(year_id)
                                    {
//                                        $('#faculty').val(faculty_id);
//                                        $('#faculty').prop('disabled', true);


                                        $.post("<?php echo base_url('year/edit_course_year') ?>", {'year_id': year_id},
                                        function (data)
                                        {
                                            if(data == 'denied')
                                            {
                                                funcres = {status:"denied", message:"You have no right to proceed the action"};
                                                result_notification(funcres);
                                            }
                                            else
                                            {
//                                                get_courses( 1, data['course_id']);
                                                $('#year_id').val(data['year_id']);
                                                $('#load_Dcode').val(data['course_id']);
                                                $('#load_Dname').val(data['course_id']);
                                                $('#year').val(data['no_of_year']);
                                            }
                                        },
                                        "json"
                                        );
                                        $('#load_Dcode').prop('disabled', true);
                                        $('#load_Dname').prop('disabled', true);
                                    }

                                    function update_year_status(year_id, course_id, new_status)
                                    {
                                        $.post("<?php echo base_url('year/update_year_status') ?>", {'year_id': year_id, 'course_id': course_id, 'new_status': new_status},
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
                                        $('#year_id').val("");
                                        $('#load_Dcode').val("");
                                        $('#load_Dname').val("");
                                        $('#year').val("");
//                                        $('#faculty').val("");
//                                        $('#faculty').prop('disabled', false);
//                                        get_courses( null, null);
                                    }

//                                    function get_courses( flag, course_id) {
//                                        $('#load_Dcode')
//                                                .find('option')
//                                                .remove()
//                                                .end()
//                                                .append('<option value="">---Select course Code---</option>')
//                                                .val('');
//                                        $('#load_Dname')
//                                                .find('option')
//                                                .remove()
//                                                .end()
//                                                .append('<option value="">---Select course Name---</option>')
//                                                .val('');
//
//                                        if (flag === 1) {
//                                            $.post("<?php //echo base_url('Year/load_course_programs') ?>",
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
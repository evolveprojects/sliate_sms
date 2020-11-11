<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Lecturer</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Lecturer</li>
            <li><i class="fa fa-bank"></i>Attendance</li>
        </ol>
    </div>
</div>

<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#atten_tab" aria-controls="atten_tab" role="tab" data-toggle="tab">Attendance Look Up</a></li>
        <li role="presentation"><a href="#reg_tab" aria-controls="reg_tab" role="tab" data-toggle="tab"> Mark Attendance</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="atten_tab">
            <div class="panel">
                <header class="panel-heading">
                    Lookup
                </header>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal"  role="form" method="post" action="" id="view_atten" name="view_atten" autocomplete="off" novalidate>
                    <div class="row">
                        <div class="col-md-1"></div>
<!--                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Faculty</label>
                                <div class="col-md-9">
                                    <?php 
                                        global $facultydrop;
                                        global $selectedfac;
                                        $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_staff_menbers(this.value, 1);"';
                                        echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                    ?>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Lecturer:</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="staff_member" id="staff_member">
                                        <option value="">---Select Lecturer---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date :</label>
                                <div class="col-md-9">
                                    <div id="" class="input-group date">
                                        <input class="form-control" type="text" name="l_att_date" id="l_att_date"  data-format="YYYY-MM-DD">
                                        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-info btn-md" name="search">Search</button>
                        </div>
                    </div>
                    </form>
                    <br><br>
                    <div class="col-md-12">
                        <table id="lec_atttbl" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr bgcolor="#F0F8FF">
                                    <th>#</th>
                                    <th>Branch</th>
                                    <th>Subject</th>
                                    <th>Timetable Time</th>
                                    <th>Actual Time</th>
                                    <th>No of Breaks</th>
                                    <th>Worked Hours</th>
                                    <th>Payment Rs.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="reg_tab">
            <div class="panel">
                <header class="panel-heading">
                    Lecturer Attendance
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="" id="attendence" autocomplete="off" novalidate>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="l_center" class="col-md-2 control-label">Center:</label>
                                        <div class="col-md-9">
                                            <?php 
                                                global $branchdrop;
                                                global $selectedbr;
                                                $extraattrs = 'id="l_center" class="form-control" style="width:100%"';
                                                echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                            ?>
                                        </div>
                                    </div>				
                                </div>
<!--                                <div class="form-group col-md-3">								
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Faculty:</label>
                                        <div class="col-md-10">
                                            <?php 
                                                global $facultydrop;
                                                global $selectedfac;
                                                $facextraattrs = 'id="l_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_staff_menbers(this.value, 0);"';
                                                echo form_dropdown('l_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                            ?>
                                        </div>
                                    </div>			
                                </div>-->
                                <div class="form-group col-md-3">							
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Lecturer:</label>
                                        <div class="col-md-10">
                                            <select type="text" class="form-control" id="l_staff_member" name="l_staff_member">
                                                <option value="">---Select Lecturer---</option>
                                            </select>											
                                        </div>				         
                                    </div>				
                                </div>
                                <div class="form-group col-md-3">							
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Date:</label>
                                        <div class="col-md-10">
                                            <div id="" class="input-group date">
                                                <input class="form-control" type="text" name="att_date" id="att_date"  data-format="YYYY-MM-DD">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                                </span>
                                            </div>										
                                        </div>				         
                                    </div>				
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_details();">Search</button>

                            </div>

                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <table name="student_look" id="student_look" class="table table-striped table-bordered dt-responsive nowrap student_look" style="width:100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>No of Breaks</th>
                                            <th>Worked Hours</th>
                                            <th><input type="checkbox" name="mark_all" id="mark_all" onclick="mark_all_checkboxes();"> Mark All</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_body">
                                        <tr><td colspan="8" align="center">No data available in table</td></tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                            </div>
                            <button type="submit" class="btn btn-info btn-md" name="submit">Submit</button>
                            <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_table();">Reset</button>
                            <br/>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="attendance_modal">
        <div class="modal-dialog modal-lg" style="width:70%;padding-top:13px">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal_title" id="modal_title">Update Attendance</h4>
                </div>
                <form class="form-horizontal" role="form" method="post" id="attendance_edit_form" name="attendance_edit_form" autocomplete="off">
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" id="atn_id" name="atn_id">
                            <label for="lecturer" class="control-label">Lecturer : </label>
                            <label for="lecturer_name" id="lecturer_name" class="control-label"> </label>
                        </div>
                        <div class="col-md-4">
                            <label for="reg_no" class="control-label">Subject : </label> 
                            <label for="subject_data" id="subject_data" class="control-label"></label> 
                        </div>
                        <div class="col-md-4">
                            <label for="att_date" class="control-label">Date : </label> 
                            <label for="atte_date" id="atte_date" class="control-label"></label>
                        </div>
                    </div>
                    <br/>
                    <div class="col-md-12">							
                        <div class="form-group">
                            <label class="col-md-2 control-label">Time Table Time:</label>
                            <div class="col-md-4">
                                <label class="col-md-3 control-label">From :</label>
                                <input class="col-md-1 form-control" type="text" name="tt_start_time" id="tt_start_time" readonly>
                            </div>

                            <div class="col-md-4">
                                <label class="col-md-3 control-label">To :</label>
                                <input class="col-md-1 form-control" type="text" name="tt_end_time" id="tt_end_time" readonly> 	
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Actual Time:</label>
                            <div class="col-md-4">
                                <label class="col-md-3 control-label">From :</label>
                                <input class="col-md-1 form-control date-picker" type="text" name="ac_start_time" id="ac_start_time" onblur="calculate_timediff()"  data-validation="required" data-validation-error-msg-required="Field cannot be empty" >
                            </div>

                            <div class="col-md-4">
                                <label class="col-md-3 control-label">To :</label>
                                <input class="col-md-1 form-control date-picker" type="text" name="ac_end_time" id="ac_end_time" onblur="calculate_timediff()"  data-validation="required" data-validation-error-msg-required="Field cannot be empty" > 	
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">No of Breaks:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="up_breaks" id="up_breaks" onkeyup="calculate_timediff()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Worked Hours:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="up_worked_hours" id="up_worked_hours" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Hourly Rate:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="up_hourly_rate" id="up_hourly_rate"  data-validation="required" data-validation-error-msg-required="Field cannot be empty"   onkeyup="calculate_timediff()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Payment:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="up_payment" id="up_payment" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-left">Update</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script type="text/javascript">

                        $('#attendence').bootstrapValidator({
                            live : 'enabled',
                            message : 'This value is not valid',
                            fields :{
                                l_center: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Center is required.'}
                                    }
                                },
                                l_faculty: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Faculty is required.'}
                                    }
                                },
                                l_staff_member: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Staff Member is required.'}
                                    }
                                },
                                att_date: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Date is required.'}
                                    }
                                }
                            },
                            onSuccess: function(e) {
                                e.preventDefault();
                                save_lecturer_attendance();
                            }
                        });

                        $('#view_atten').bootstrapValidator({
                            live : 'enabled',
                            message : 'This value is not valid',
                            fields :{
                                faculty: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Faculty is required.'}
                                    }
                                },
                                staff_member: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Staff Member is required.'}
                                    }
                                },
                                l_att_date: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Date is required.'}
                                    }
                                }
                            },
                            onSuccess: function(e) {
                                e.preventDefault();
                                view_attendance_details();
                            }
                        });

                        $('#attendance_edit_form').bootstrapValidator({
                            live : 'enabled',
                            message : 'This value is not valid',
                            fields :{
                                ac_start_time: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Actual start time is required.'}
                                    }
                                },
                                ac_end_time: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Actual end time is required.'}
                                    }
                                },
                                up_breaks: 
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Number of breaks is required.'}
                                    }
                                },
                                up_hourly_rate:
                                {
                                    validators: 
                                    {
                                        notEmpty: {message: 'Hourly rate is required.'}
                                    }
                                }
                            },
                            onSuccess: function(e) {
                                e.preventDefault();
                                update_attendance_data();
                            }
                        });

                        $('#lec_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
                        $('#att_st_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
                        $('#att_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
                        $('#l_att_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
                        $('#att_end_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
                        $(document).ready(function () {

                            $('#lec_atttbl').DataTable({
                                'ordering': true,
                                'lengthMenu': [10, 25, 50, 75, 100]
                            });
                        });
                        $(document).on('focus', ".date-picker", function () {
                            $(this).datetimepicker({
                                pickDate: false,
                                format: 'LT'
                            });
                        });
                        function search_details() {
                            var res = [];
                            var center_id = $('#l_center').val();
                            var faculty_id = $('#l_faculty').val();
                            var lecturer_id = $('#l_staff_member').val();
                            var att_date = $('#att_date').val();
                            if (lecturer_id == '' || center_id == '' || faculty_id == '' || (att_date == null || att_date == '')) {
                                res['status'] = 'denied';
                                res['message'] = 'Please Select All Center, Faculty, Lecturer and Date';
                                result_notification(res);
                            } else {
                                $.post("<?php echo base_url('staff/load_lecturers_by_date') ?>", {'lecturer_id': lecturer_id, 'center_id': center_id, 'faculty_id': faculty_id, 'att_date': att_date},
                                function (data)
                                {
                                    if(data == 'denied')
                                    {
                                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                                        result_notification(funcres);
                                    }
                                    else
                                    {
                                        $('#tbl_body').find('tr').remove();
                                        if (data.length > 0) {
                                            for (j = 0; j < data.length; j++) {
                                                $('#tbl_body').append("<tr><td style='width:14%;text-align: center'>" + (j + 1) + "</td><td style='width:14%;text-align: center'>" + data[j]['code'] + " - " + data[j]['subject'] + "</td><td style='width:25%;text-align: center'><input class='form-control date-picker' onchange='claculate_breaks_on_start_time(" + (j + 1) + ",this.value)' id='att_st_time" + (j + 1) + "' data-validation='required' data-validation-error-msg-required='Field cannot be Empty' type='text' name='ls_time[]' id='ls_time' time-format='H:M:S' value='" + data[j]['ttlc_starttimedisplay'] + "'> </td><td style='width:25%;text-align: center'><input class='form-control date-picker' onchange='claculate_breaks_on_end_time(" + (j + 1) + ", this.value)' id='att_end_time" + (j + 1) + "' data-validation='required' data-validation-error-msg-required='Field cannot be Empty' type='text' name='le_time[]' id='le_time'  time-format='H:M:S' value='" + data[j]['ttlc_endtimedisplay'] + "'></td><td style='width:25%;text-align: center'><input class='form-control' maxlength='1' id='no_breaks" + (j + 1) + "' onkeyup='calculate_worked_hours(" + (j + 1) + ",this.value);' data-validation='required' data-validation-error-msg-required='Field cannot be Empty' type='text' name='no_of_breaks[]' value='" + data[j]['no_of_breaks'] + "'></td><td style='width:25%;text-align: center' id='time_diff_td" + (j + 1) + "'>" + data[j]['time_diff'] + "</td><td style='width:14%;text-align: center'><input type='hidden' value='" + data[j]['time_diff'] + "' id='worked_hours" + (j + 1) + "' name='worked_hours[]'><input type='checkbox' class='mark_boxs' id='mark_box" + j + "' name='mark_box[]'></td></tr>");
                                            }

                                        } else {
                                            $('#tbl_body').append("<tr><td colspan='8' align='center'>No data available in table</td></tr>");
                                            res['status'] = 'denied';
                                            res['message'] = 'There is no records to show';
                                            result_notification(res);
                                        }
                                    }
                                },
                                "json"
                                );
                            }

                        }
                        function claculate_breaks_on_start_time(j, start_time) {
                            var res = [];
                            var end_time_val = $('#att_end_time' + j).val();
                            if (start_time.length > 0) {
                                var temp_start = start_time.split(":");
                                var temp_start2 = temp_start[1].split(" ");
                                if (temp_start2[1] == "PM" && temp_start[0] != '12') {
                                    temp_start[0] = parseInt(temp_start[0]) + 12;
                                }
                            }
                            if (end_time_val.length > 0) {
                                var temp_end = end_time_val.split(":");
                                var temp_end2 = temp_end[1].split(" ");
                                if (temp_end2[1] == "PM" && temp_end[0] != '12') {
                                    temp_end[0] = parseInt(temp_end[0]) + 12;
                                }
                            }

                            if ((parseInt(temp_start[0]) > parseInt(temp_end[0])) || (parseInt(temp_start[0]) == parseInt(temp_end[0])) && (parseInt(temp_start2[0]) >= parseInt(temp_end2[0]))) {
                                res['status'] = 'denied';
                                res['message'] = 'Start Time must be less than End Time';
                                result_notification(res);
                                $('#att_st_time' + j).val("");
                            } else {
                                no_of_hours = parseInt(temp_end[0]) - parseInt(temp_start[0]);
                                if (parseInt(no_of_hours) <= 3) {
                                    no_of_breaks = 0;
                                } else if (parseInt(no_of_hours) > 3 && parseInt(no_of_hours) <= 4) {
                                    no_of_breaks = 1;
                                } else if (parseInt(no_of_hours) > 4 && parseInt(no_of_hours) <= 6) {
                                    no_of_breaks = 3;
                                } else if (parseInt(no_of_hours) > 6) {
                                    no_of_breaks = 4;
                                } else {
                                    no_of_breaks = 0;
                                }
                                $('#no_breaks' + j).val(no_of_breaks);
                                calculate_worked_hours(j, no_of_breaks);
                            }

                        }

                        function claculate_breaks_on_end_time(j, end_time) {
                            var res = [];
                            var start_time_val = $('#att_st_time' + j).val();
                            if (start_time_val.length > 0) {
                                var temp_start = start_time_val.split(":");
                                var temp_start2 = temp_start[1].split(" ");
                                if (temp_start2[1] == "PM" && temp_start[0] != '12') {
                                    temp_start[0] = parseInt(temp_start[0]) + 12;
                                }
                            }
                            if (end_time.length > 0) {
                                var temp_end = end_time.split(":");
                                var temp_end2 = temp_end[1].split(" ");
                                if (temp_end2[1] == "PM" && temp_end[0] != '12') {
                                    temp_end[0] = parseInt(temp_end[0]) + 12;
                                }
                            }

                            if ((parseInt(temp_start[0]) > parseInt(temp_end[0])) || (parseInt(temp_start[0]) == parseInt(temp_end[0])) && (parseInt(temp_start2[0]) >= parseInt(temp_end2[0]))) {
                                res['status'] = 'denied';
                                res['message'] = 'End Time must be more than Start Time';
                                result_notification(res);
                                $('#att_end_time' + j).val("");
                            } else {
                                no_of_hours = parseInt(temp_end[0]) - parseInt(temp_start[0]);
                                if (parseInt(no_of_hours) <= 3) {
                                    no_of_breaks = 0;
                                } else if (parseInt(no_of_hours) > 3 && parseInt(no_of_hours) <= 4) {
                                    no_of_breaks = 1;
                                } else if (parseInt(no_of_hours) > 4 && parseInt(no_of_hours) <= 6) {
                                    no_of_breaks = 3;
                                } else if (parseInt(no_of_hours) > 6) {
                                    no_of_breaks = 4;
                                } else {
                                    no_of_breaks = 0;
                                }
                                $('#no_breaks' + j).val(no_of_breaks);
                                calculate_worked_hours(j, no_of_breaks);
                            }

                        }

                        function calculate_worked_hours(j, no_of_breaks) {
                            var start_time = $('#att_st_time' + j).val();
                            var end_time = $('#att_end_time' + j).val();

                            var temp_start = start_time.split(":");
                            var temp_start2 = temp_start[1].split(" ");
                            if (temp_start2[1] == "PM" && temp_start[0] != '12') {
                                temp_start[0] = parseInt(temp_start[0]) + 12;
                            }
                            var temp_end = end_time.split(":");
                            var temp_end2 = temp_end[1].split(" ");
                            if (temp_end2[1] == "PM" && temp_end[0] != '12') {
                                temp_end[0] = parseInt(temp_end[0]) + 12;
                            }

                            if (temp_start2[0] != '00') {
                                var hour_diff = (parseInt(temp_end[0]) - parseInt(temp_start[0])) - 1;
                            } else {
                                var hour_diff = parseInt(temp_end[0]) - parseInt(temp_start[0]);
                            }


                            if (parseInt(temp_start2[0]) > parseInt(temp_end2[0])) {
                                var minutes = (parseInt(temp_end2[0]) + 60) - parseInt(temp_start2[0]);
                            } else {
                                var minutes = parseInt(temp_end2[0]) - parseInt(temp_start2[0]);
                            }

                            var total_minutes = (hour_diff * 60) + minutes;

                            var deduct_minutes = total_minutes - (no_of_breaks * 15);
                            var final_hours = Math.floor(deduct_minutes / 60);
                            var final_minutes = deduct_minutes % 60;
                            if (final_hours.toString().length < 2) {
                                final_hours = '0' + final_hours;
                            }
                            if (final_minutes.toString().length < 2) {
                                final_minutes = '0' + final_minutes;
                            }
                            final_string = final_hours + ":" + final_minutes;
                            $('#time_diff_td' + j).html(final_string);
                            $('#worked_hours' + j).val(final_string);

                        }

                        function load_staff_menbers(faculty_id, flag) {
                            $('#staff_member').find('option').remove().end().append('<option value="">---Select Lecturer---</option>').val('');
                            $('#l_staff_member').find('option').remove().end().append('<option value="">---Select Lecturer---</option>').val('');
                            $.post("<?php echo base_url('staff/get_staff_by_faculty') ?>", {'faculty_id': faculty_id},
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
                                        if (flag) {
                                            $('#staff_member').append($("<option></option>").attr("value", data[j]['stf_id']).text(data[j]['title_name'] + data[j]['stf_fname'] + " " + data[j]['stf_lname']));
                                        } else {
                                            $('#l_staff_member').append($("<option></option>").attr("value", data[j]['stf_id']).text(data[j]['title_name'] + data[j]['stf_fname'] + " " + data[j]['stf_lname']));
                                        }

                                    }
                                }
                            },
                            "json"
                            );
                        }

                        function save_lecturer_attendance() {
                            var center_id = $('#l_center').val();
                            var faculty_id = $('#l_faculty').val();
                            var lecturer_id = $('#l_staff_member').val();
                            var att_date = $('#att_date').val();
                            var actual_ls_time = $("input[name='ls_time[]']").map(function () {
                                return $(this).val();
                            }).get();
                            var actual_le_time = $("input[name='le_time[]']").map(function () {
                                return $(this).val();
                            }).get();
                            var no_of_breaks = $("input[name='no_of_breaks[]']").map(function () {
                                return $(this).val();
                            }).get();
                            var worked_hours = $("input[name='worked_hours[]']").map(function () {
                                return $(this).val();
                            }).get();

                            var is_checked = $("input[name='mark_box[]']").map(function () {
                                return this.checked ? 1 : 0;
                            }).get();

                            $.ajax(
                            {
                                url: "<?php echo base_url('staff/save_lecturer_attendance') ?>",
                                type: 'POST',
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: {'lecturer_id': lecturer_id, 'center_id': center_id, 'faculty_id': faculty_id, 'att_date': att_date, 'actual_ls_time': actual_ls_time, 'actual_le_time': actual_le_time, 'is_checked': is_checked, 'no_of_breaks': no_of_breaks, 'worked_hours': worked_hours},
                                success: function (data)

                                {
                                    if (data == 'denied')
                                    {
                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                        result_notification(funcres);
                                    } else
                                    {
                                        result_notification(data);
                                        if (data['status'] != "Warning") {
                                            reset_table();
                                            $('#l_center').val("");
                                            $('#l_faculty').val("");
                                            $('#att_date').val("");
                                        }
                                    }
                                }
                            });
                        }

                        function reset_table() {
                            $('#tbl_body').find('tr').remove();
                            $('#tbl_body').append("<tr><td colspan='8' align='center'>No data available in table</td></tr>");
                        }

                        function view_attendance_details() {
                            var res = [];
                            var staff_member = $('#staff_member').val();
                            var att_date = $('#l_att_date').val();
                            $('#lec_atttbl').DataTable().clear();
                            if (staff_member == '' || att_date == '') {
                                res['status'] = 'denied';
                                res['message'] = 'Please Select All Faculty, Date and Lecturer';
                                result_notification(res);
                            } else {
                                $.post("<?php echo base_url('staff/view_lecturer_attendance') ?>", {'staff_member': staff_member, 'att_date': att_date},
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
                                            res['message'] = 'There is no records to show';
                                            result_notification(res);
                                        } else {
                                            for (j = 0; j < data.length; j++) {
                                                if (data[j]['la_deleted'] == 1) {
                                                    content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='change_status(" + data[j]['la_id'] + ",0);'></span></button>";
                                                } else {
                                                    content = "<button type='button' title='Deactivate' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true' onclick='change_status(" + data[j]['la_id'] + ",1);'></span></button>";
                                                }
                                                action_content = "<th><button type='button' title='Edit' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true' onclick='edit_attendance_data(" + data[j]['la_id'] + "," + staff_member + "," + data[j]['subject_id'] + ",\"" + att_date + "\");'></span></button> | " + content + "</th>";
                                                $('#lec_atttbl').DataTable().row.add([
                                                    (j + 1),
                                                    data[j]['br_code'] + " - " + data[j]['br_name'],
                                                    data[j]['code'] + " - " + data[j]['subject'],
                                                    data[j]['ttlc_eststarttimedisplay'] + " - " + data[j]['ttlc_estendtimedisplay'],
                                                    data[j]['actual_start_time'] + " - " + data[j]['actual_end_time'],
                                                    data[j]['no_of_breaks'],
                                                    data[j]['worked_hours'],
                                                    data[j]['payment'],
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

                        function change_status(lec_att_id, new_status) {
                            $.ajax(
                            {
                                url: "<?php echo base_url('staff/update_staff_attendance_status') ?>",
                                type: 'POST',
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: {'lec_att_id': lec_att_id, 'new_status': new_status},
                                success: function (data)
                                {
                                    if (data == 'denied')
                                    {
                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                        result_notification(funcres);
                                    } else
                                    {
                                        view_attendance_details();
                                        result_notification(data);
                                    }
                                }
                            });
                        }

                        function mark_all_checkboxes() {
                            if ($('#mark_all').is(':checked')) {
                                $('.mark_boxs').attr('checked', true);
                            } else {
                                $('.mark_boxs').attr('checked', false);
                            }
                        }

                        function edit_attendance_data(attendance_id, lecturer_id, subject_id, attendance_date) {

                            $('#attendance_modal').modal('show');

                            $.post("<?php echo base_url('staff/load_data_for_update_staff_attendance') ?>", {'attendance_id': attendance_id, 'lecturer_id': lecturer_id, 'subject_id': subject_id, 'attendance_date': attendance_date},
                            function (data)
                            {
                                if(data == 'denied')
                                {
                                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                                    result_notification(funcres);
                                }
                                else
                                {
                                    jQuery("label[for='lecturer_name']").html(data['stf_fname'] + " " + data['stf_lname']);
                                    jQuery("label[for='subject_data']").html(data['subject_code'] + " - " + data['subject']);
                                    jQuery("label[for='atte_date']").html(attendance_date);

                                    $('#tt_start_time').val(data['ttlc_eststarttimedisplay']);
                                    $('#tt_end_time').val(data['ttlc_estendtimedisplay']);
                                    $('#ac_start_time').val(data['actual_start_time']);
                                    $('#ac_end_time').val(data['actual_end_time']);
                                     $('#up_breaks').val(data['no_of_breaks']);
                                    
                                    $('#up_worked_hours').val(data['worked_hours']);
                                    $('#up_hourly_rate').val(data['hourly_rate']);
                                    $('#up_payment').val(data['payment']);

                                    $('#atn_id').val(data['id'])
                                }

                            },
                            "json"
                            );

                        }
                        
                        function update_attendance_data()
                        {
                            $.ajax(
                            {
                                url : "<?php echo base_url('staff/update_attendance_data')?>",
                                type : 'POST',
                                async : false,
                                cache: false,
                                dataType : 'json',
                                data: $('#attendance_edit_form').serialize(),
                                success:function(data)
                                {
                                    if(data == 'denied')
                                    {
                                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                                        result_notification(funcres);
                                    }
                                    else
                                    {
                                        result_notification(data);
                                        view_attendance_details();
                                        $('#attendance_modal').modal('toggle');
                                    }
                                }
                            });
                        }

                        function calculate_timediff()
                        {
                            actstart = $('#ac_start_time').val();
                            actend   = $('#ac_end_time').val();
                            breaks   = $('#up_breaks').val();
                            hrrate   = $('#up_hourly_rate').val();

                            if(breaks == '' || breaks == " ")
                            {
                                breaks = 0;
                            }

                            timediff = timediffinminute(actstart,actend,breaks);
                            balmints   = timediff%60;
                            hourscount = (timediff-balmints)/60;

                            hourspay = hourscount*hrrate;
                            minutpay = balmints*(hrrate/60);

                            if(hourscount<10)
                            {
                                hourscount = '0'+hourscount;
                            }
                            $('#up_worked_hours').val(hourscount+':'+balmints);
                            $('#up_payment').val(Number(hourspay+minutpay).toFixed(2));
                        }

                        function timediffinminute(start,end,breaks)
                        {
                            starttime   = converttime(start);
                            endtime     = converttime(end);

                            starttminmin = (starttime[0]*60)+starttime[1];
                            endtminmin   = (endtime[0]*60)+endtime[1];
                            tmdiffinmin  = (endtminmin-starttminmin)-(breaks*15);
                            return tmdiffinmin;
                        }

                        function converttime(timestr)
                        {
                            temp1 = timestr.split(' ');
                            meridiem = temp1[1];

                            temp2 = temp1[0].split(':');
                            hour = parseInt(temp2[0]);
                            mins = parseInt(temp2[1]);

                            hourval = hour;

                            if(meridiem == 'PM')
                            {
                                if(hour!=12)
                                {
                                    hourval = hour+12;
                                }
                            }
                            else
                            {
                                if(hour==12)
                                {
                                    hourval = hour+12;
                                }
                            }

                            timeary = Array(hourval,mins);

                            return timeary;
                        }

    </script>
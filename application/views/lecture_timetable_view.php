<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Lecture Time Table</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-calender"></i>Lecture Timetable</li>
        </ol>
    </div>
</div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="lookup_tab" href="#lookuppanel" aria-controls="lookuppanel" role="tab" data-toggle="tab">Time Tables Lookup</a></li>
    <li role="presentation"><a id="create_tab" href="#createpanel" aria-controls="createpanel" role="tab" data-toggle="tab">Create Time Table</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<!-- Look Up tab panel-->
<div role="tabpanel" class="tab-pane active" id="lookuppanel">
<div class="panel">
<header class="panel-heading">
    Time Tables Lookup
</header>
<div class="panel-body">
    <table id="ttmaintbl" class="table table-bordered" style="width:100%" cellspacing="0">
        <thead id="ttmaintbl_head">
            <tr>
                <th style="text-align: center">Time Table</th>
                <th style="width:75px;text-align: center">Branch</th>
                <th style="width:75px;text-align: center">Course</th>
                <th style="width:75px;text-align: center">Year</th>
                <th style="width:75px;text-align: center">Semester</th>
                <th style="width:300px;text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody id="ttmaintbl_body"> 
        </tbody>
    </table>
</div>
</div>
</div>
<!-- Look Up tab panel close-->
<!-- create tab panel -->
<div role="tabpanel" class="tab-pane" id="createpanel">
<section class="panel">
<header class="panel-heading">
    Create Time Table 
</header>
<div class="panel-body">
    <form class="form-horizontal" role="form" method="post" id="tt_form" autocomplete="off" novalidate>
    <div class="row">
        <div class="col-md-3" style="">
            <input type="hidden" id="tt_id" name="tt_id">
            <input type="hidden" id="tt_code" name="tt_code">
            <input type="hidden" id="tt_action" name="tt_action">
            <input type="hidden" id="tt_clonett" name="tt_clonett">
            <div class="form-group">
                <label for="tt_branch" class="col-md-3 control-label">Branch</label>
                <div class="col-md-9">
                    <?php 
                        global $branchdrop;
                        global $selectedbr;
                        $extraattrs = 'id="tt_branch" class="form-control" style="width:100%"';
                        echo form_dropdown('tt_faculty',$branchdrop,$selectedbr, $extraattrs); 
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="">  
            <div class="form-group">
                <label for="tt_faculty" class="col-md-3 control-label">Faculty</label>
                <div class="col-md-9">
                    <?php 
                        global $facultydrop;
                        global $selectedfac;
                        $facextraattrs = 'id="tt_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"  onchange="load_courses_list(this.value,null)"  style="width:100%"';
                        echo form_dropdown('tt_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="tt_description" class="col-md-3 control-label">Description</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="tt_description" name="tt_description" style="width:100%">
                </div>                       
            </div>
        </div>
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="tt_type" class="col-md-3 control-label">Type</label>
                <div class="col-md-9">
                    <select class="form-control" id="tt_type" name="tt_type" style="width:100%">
                        <option value=""></option>            
                        <option value="Regular">Regular</option>
                        <option value="Tempory">Tempory</option>
                    </select>                                           
                </div>                       
            </div>  
        </div>
        <!-- <div class="col-md-3" style="">
            <div class="form-group">
                <label for="tt_clone" class="col-md-3 control-label">Clone</label>
                <div class="col-md-9">
                    <select class="form-control" id="tt_clone" name="tt_clone" onchange="load_update_view(this.value,'clone')" style="width:100%">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>
        </div> -->
    </div>
    <br>
    <div class="row">
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="tt_course" class="col-md-3 control-label">Dourse</label>
                <div class="col-md-9">
                    <select class="form-control" id="tt_course" name="tt_course" onchange="load_years(this.value,null)" style="width:100%">
                             
                    </select>                                           
                </div>                       
            </div>
        </div>
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="tt_year" class="col-md-3 control-label">Year</label>
                <div class="col-md-9">
                    <select class="form-control" id="tt_year" name="tt_year"  onchange="load_semester(this.value,null,null)" style="width:100%">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>
        </div>
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="tt_semester" class="col-md-3 control-label">Semester</label>
                <div class="col-md-9">
                    <select class="form-control" id="tt_semester" name="tt_semester" style="width:100%">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>  
        </div>
        <div class="col-md-3" style="">
            <div class="form-group" >
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Create" id="savebtn" name="savebtn" class="btn btn-primary">
                <button type='button' class='btn btn-info' id="addlecbtn" onclick='event.preventDefault();load_addlecture_modal();'>Add Lecture</button>
            </div>
        </div>
    </div>
    </form>
    <hr>
    <table id="ttcr_table" class="table" style="width:100%" cellspacing="0">
        <thead id="ttcr_table_head">
            <tr>
                <th style="width:14%;text-align: center">Monday</th>
                <th style="width:14%;text-align: center">Tuesday</th>
                <th style="width:14%;text-align: center">WednesDay</th>
                <th style="width:14%;text-align: center">Thursday</th>
                <th style="width:14%;text-align: center">Friday</th>
                <th style="width:14%;text-align: center">Saturday</th>
                <th style="width:14%;text-align: center">Sunday</th>
            </tr>
        </thead>
        <tbody id="ttcr_table_body"> 
            <tr>
                <td style="width:14%;text-align: center" id="ttcr_mon"><div style="height:540px"></div></td>
                <td style="width:14%;text-align: center" id="ttcr_tue"><div style="height:540px"></div></td>
                <td style="width:14%;text-align: center" id="ttcr_wed"><div style="height:540px"></div></td>
                <td style="width:14%;text-align: center" id="ttcr_thu"><div style="height:540px"></div></td>
                <td style="width:14%;text-align: center" id="ttcr_fri"><div style="height:540px"></div></td>
                <td style="width:14%;text-align: center" id="ttcr_sat"><div style="height:540px"></div></td>
                <td style="width:14%;text-align: center" id="ttcr_sun"><div style="height:540px"></div></td>
            </tr>
        </tbody>
    </table>
</div>
</section>
<!-- end create pane -->
</div>
</div>
<div class="modal fade bs-example-modal-lg" id="viewtimetable">
    <div class="modal-dialog modal-lg" style="width:100%;padding-top:13px">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <span id="view_description"></span>
            </div>
            <div class="modal-body">
                <table id="viewttbl" class="table" style="width:100%" cellspacing="0">
                    <thead id="viewttbl_head">
                        <tr>
                            <th style="width:14%;text-align: center">Monday</th>
                            <th style="width:14%;text-align: center">Tuesday</th>
                            <th style="width:14%;text-align: center">WednesDay</th>
                            <th style="width:14%;text-align: center">Thursday</th>
                            <th style="width:14%;text-align: center">Friday</th>
                            <th style="width:14%;text-align: center">Saturday</th>
                            <th style="width:14%;text-align: center">Sunday</th>
                        </tr>
                    </thead>
                    <tbody id="viewttbl_body"> 
                        <tr>
                            <td style="width:14%;text-align: center" id="view_mon"><div style="height:540px"></div></td>
                            <td style="width:14%;text-align: center" id="view_tue"><div style="height:540px"></div></td>
                            <td style="width:14%;text-align: center" id="view_wed"><div style="height:540px"></div></td>
                            <td style="width:14%;text-align: center" id="view_thu"><div style="height:540px"></div></td>
                            <td style="width:14%;text-align: center" id="view_fri"><div style="height:540px"></div></td>
                            <td style="width:14%;text-align: center" id="view_sat"><div style="height:540px"></div></td>
                            <td style="width:14%;text-align: center" id="view_sun"><div style="height:540px"></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade bs-example-modal-lg" id="addlecturemodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Lecture</h4>
            </div>
            <form class="form-horizontal" role="form" method="post" id="addlectureform" autocomplete="off" novalidate>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="lect_id" id="lect_id"><div class="radio">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="lect_subject" class="col-md-2 control-label">Subject</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="lect_subject" name="lect_subject" onchange="load_lecturers(this.value,null)">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lect_hall" class="col-md-2 control-label">Hall</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="lect_hall" name="lect_hall">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lect_lecturer" class="col-md-2 control-label">Lecturer</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="lect_lecturer" name="lect_lecturer">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lect_starttime" class="col-md-2 control-label">Start Time</label>
                                    <div class='col-md-8 input-group date' id='lecstarttime'>
                                        <input type='text' class="form-control"  id="lect_starttime" name="lect_starttime"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lect_endtime" class="col-md-2 control-label">End Time</label>
                                    <div class='col-md-8 input-group date' id='lecendtime'>
                                        <input type='text' class="form-control"  id="lect_endtime" name="lect_endtime"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="mondayrdo" value="monday">
                                            Monday
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="tuesdayrdo" value="tuesday">
                                            Tuesday
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="wednesdayrdo" value="wednesday" >
                                            Wednesday
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="thursdayrdo" value="thursday">
                                            Thursday
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="fridayrdo" value="friday" >
                                            Friday
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="saturdayrdo" value="saturday">
                                            Saturday
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="weekdayrdo" id="sundayrdo" value="sunday" >
                                            Sunday
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="event.preventDefault();reset_lecture_modal()">Reset</button>
                <input type="submit" value="Create" id="lecsavebtn" name="lecsavebtn" class="btn btn-primary">
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#addlecbtn').hide();
    load_finalized_timetables();
});

$(function () {
    $('#lecstarttime').datetimepicker({
        pickDate: false,
       format: 'LT'
    });
});

$(function () {
    $('#lecendtime').datetimepicker({
        pickDate: false,
       format: 'LT'
    });
});

$('#ttmaintbl').DataTable({
    'dom':'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
    "pageLength": 6
});

$('#ttcr_table').DataTable({
    'dom':'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
    "paging":   false,
    "ordering": false,
    "info":     false
});

$('#viewttbl').DataTable({
    'dom':'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
    "paging":   false,
    "ordering": false,
    "info":     false
});

$('#tt_form').bootstrapValidator({
    live : 'enabled',
    message : 'This value is not valid',
    fields :{
        tt_branch: 
        {
            validators: 
            {
                notEmpty: {message: 'Branch is required.'}
            }
        },
        tt_description: 
        {
            validators: 
            {
                notEmpty: {message: 'Description is required.'}
            }
        },
        tt_type:
        {
            validators: 
            {
                notEmpty: {message: 'Type is required.'}
            }
        },
        tt_course:
        {
            validators: 
            {
                notEmpty: {message: 'Course is required.'}
            }
        },
        tt_year:
        {
            validators: 
            {
                notEmpty: {message: 'Year is required.'}
            }
        },
        tt_semester:
        {
            validators: 
            {
                notEmpty: {message: 'Semester is required.'}
            }
        }

    },
    onSuccess: function(e) {
        e.preventDefault();
        savetimetbl();
    }
});

$('#addlectureform').bootstrapValidator({
    live : 'enabled',
    message : 'This value is not valid',
    fields :{
        lect_subject: 
        {
            validators: 
            {
                notEmpty: {message: 'Subject is required.'}
            }
        },
        lect_hall: 
        {
            validators: 
            {
                notEmpty: {message: 'Lecture Hall is required.'}
            }
        },
        lect_lecturer:
        {
            validators: 
            {
                notEmpty: {message: 'Lecturer is required.'}
            }
        },
        lect_starttime:
        {
            validators: 
            {
                notEmpty: {message: 'Start Time is required.'}
            }
        },
        lect_endtime:
        {
            validators: 
            {
                notEmpty: {message: 'End Time is required.'}
            }
        },
        weekdayrdo:
        {
            validators: 
            {
                notEmpty: {message: 'Day is required.'}
            }
        }
    },
    onSuccess: function(e) {
        e.preventDefault();
        save_lecture();
    }
});

function load_courses_list(id,selectedid)
{
    $('#tt_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

    $.post("<?php echo base_url('time_table/load_courses_list') ?>", {'id': id},
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

                if(selectedid == data[i]['id'])
                {
                    $('#tt_course').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code']+' - '+data[i]['course_code']));
                }
                else
                {
                    $('#tt_course').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['course_code']+' - '+data[i]['course_code']));
                }
            }
        }
    },
    "json"
    );
}

function load_finalized_timetables()
{
    $.post("<?php echo base_url('time_table/load_finalized_timetables')?>",
        function(data)
        {
            $('#tt_clone').empty();
            $('#ttmaintbl_body').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#tt_clone').append("<option value=''></option>");
                if(data.length>0)
                {   
                    for (i = 0; i<data.length; i++) {

                        descript = data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+' [ '+data[i]['course_code']+' - '+data[i]['course_code']+' / Y : '+data[i]['ttbl_year']+' / S : '+data[i]['ttbl_semester']+' ]';

                        editbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_update_view("+data[i]['ttbl_id']+",\"save\")'>Edit</a>";
                        clonbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_update_view("+data[i]['ttbl_id']+",\"clone\")'>Clone</a>";
                        viewbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_timetable_view("+data[i]['ttbl_id']+",\""+descript+"\")'>View</a>";
                        deltbtn = " <a class='btn btn-danger btn-xs' onclick='event.preventDefault();delete_timetable("+data[i]['ttbl_id']+",\""+descript+"\")'>Delete</a>";
                        verfbtn = " <a class='btn btn-success btn-xs' onclick='event.preventDefault();verify_timetable("+data[i]['ttbl_id']+",\""+descript+"\")'>Verify</a>";
                        confbtn = " <a class='btn btn-success btn-xs' onclick='event.preventDefault();confirm_timetable("+data[i]['ttbl_id']+",\""+descript+"\")'>Confirm</a>";
                        prntbtn = " <a class='btn btn-warning btn-xs' onclick='event.preventDefault();print_timetable("+data[i]['ttbl_id']+",\""+descript+"\")'>Print</a>";
                        assibtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();assign_view_load("+data[i]['ttbl_id']+",\""+descript+"\")'>Assign</a>";

                        if(data[i]['ttbl_isverified']==0)
                        {
                            confbtn = '';
                            assibtn = '';
                        }
                        else
                        {
                            verfbtn = '';
                        }

                        if(data[i]['ttbl_isconfirmed']==0)
                        {
                            assibtn = '';  
                        }
                        else
                        {
                            confbtn = '';
                            editbtn = '';
                            deltbtn = '';
                        }


                        $('#tt_clone').append("<option value='"+data[i]['ttbl_id']+"'>"+data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+"</option>");
                        $('#ttmaintbl_body').append("<tr><td>"+data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+"</td><td>"+data[i]['br_name']+"</td><td>"+data[i]['course_code']+' - '+data[i]['course_code']+"</td><td>"+data[i]['ttbl_year']+"</td><td>"+data[i]['ttbl_semester']+"</td><td style='text-align:center'>"+viewbtn+verfbtn+confbtn+editbtn+clonbtn+prntbtn+deltbtn+"</td></tr>");
                    }
                }
            }
        },  
        "json"
    );
}

function verify_timetable(id,desc)
{
    $.post("<?php echo base_url('time_table/verify_timetable')?>",{"id":id,"desc":desc},
    function(data)
    {   
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
        }
        else
        {
            load_finalized_timetables();
            result_notification(data);
        }
    },  
    "json"
    );
}

function confirm_timetable(id,desc)
{
    $.post("<?php echo base_url('time_table/confirm_timetable')?>",{"id":id,"desc":desc},
    function(data)
    {   
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
        }
        else
        {
            load_finalized_timetables();
            result_notification(data);
        }
    },  
    "json"
    );
}

function load_years(tt_course,selyear)
{
    $.post("<?php echo base_url('time_table/load_years')?>",{'tt_course':tt_course},
        function(data)
        {
            $('#tt_year').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#tt_year').append("<option value=''></option>");
                if(data>0)
                {   
                    for (i = 0; i<data; i++) {
                        selectedtxt = '';
                        if(selyear==(i+1))
                        {
                            selectedtxt = 'selected';
                        }

                       $('#tt_year').append("<option value='"+(i+1)+"' "+selectedtxt+">"+(i+1)+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_semester(tt_year,selsemester,tt_course)
{
    if(tt_course==null)
    {
        tt_course = $('#tt_course').val();
    }

    $.post("<?php echo base_url('time_table/load_semester')?>",{'tt_year':tt_year,"tt_course":tt_course},
        function(data)
        {
            $('#tt_semester').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#tt_semester').append("<option value=''></option>");
                if(data>0)
                {   
                    for (i = 0; i<data; i++) {

                        selectedtxt = '';
                        if(selsemester==(i+1))
                        {
                            selectedtxt = 'selected';
                        }

                       $('#tt_semester').append("<option value='"+(i+1)+"' "+selectedtxt+">"+(i+1)+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function savetimetbl()
{
    tt_branch       = $('#tt_branch').val();
    tt_description  = $('#tt_description').val();
    tt_type         = $('#tt_type').val();
    tt_course       = $('#tt_course').val();
    tt_year         = $('#tt_year').val();
    tt_semester     = $('#tt_semester').val();
    tt_id           = $('#tt_id').val();
    tt_action       = $('#tt_action').val();
    tt_clonett      = $('#tt_clonett').val();
    tt_faculty      = $('#tt_faculty').val();


    $.post("<?php echo base_url('time_table/savetimetbl')?>",{'tt_id':tt_id,'tt_description':tt_description,'tt_type':tt_type,'tt_course':tt_course,'tt_year':tt_year,'tt_semester':tt_semester,'tt_branch':tt_branch,'tt_action':tt_action,'tt_clonett':tt_clonett,"tt_faculty":tt_faculty},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                result_notification(data);
                load_finalized_timetables();
                if(data['status'] == 'success')
                {
                    load_update_view(data['tt_id'],'save');
                }
            }
        },  
        "json"
    );
}

function load_update_view(id,type)
{
    $('#addlecbtn').show();
    $.post("<?php echo base_url('time_table/load_timetable_data')?>",{'id':id},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#tt_form').data('bootstrapValidator').resetForm();
                $("#create_tab").trigger( "click" );
                $('#tt_branch').val(data['ttbl_branch']);
                $('#tt_type').val(data['ttbl_type']);
                //load_faculty_bybranch(data['ttbl_branch'],'tt_faculty',data['ttbl_faculty']);
                load_courses_list(data['ttbl_faculty'],data['ttbl_course']);
                load_years(data['ttbl_course'],data['ttbl_year']);
                load_semester(data['ttbl_year'],data['ttbl_semester'],data['ttbl_course']);
                
                if(type=="save")
                {
                    $('#tt_description').val(data['ttbl_description']);
                    $('#tt_id').val(data['ttbl_id']);
                    $('#tt_code').val(data['ttbl_code']);
                    $('#tt_action').val('');
                    $('#tt_clonett').val('');
                    $("#savebtn").prop('value', 'Update');
                }
                else if(type=="clone")
                {
                    $('#tt_description').val('');
                    $('#tt_id').val('');
                    $('#tt_code').val('');
                    $('#tt_action').val(type);
                    $('#tt_clonett').val(id);
                    $("#savebtn").prop('value', 'Save as New');
                }
                else
                {
                    $('#tt_description').val(data['ttbl_description']);
                    $('#tt_id').val('');
                    $('#tt_code').val('');
                    $('#tt_action').val('');
                    $('#tt_clonett').val('');
                    $("#savebtn").prop('value', 'Create');
                }

                load_lectureslist(id);
            } 
        },  
        "json"
    );
}

function load_lectureslist(id)
{
    $.post("<?php echo base_url('time_table/load_lectureslist')?>",{'id':id},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#ttcr_mon').empty();
                $('#ttcr_tue').empty();
                $('#ttcr_wed').empty();
                $('#ttcr_thu').empty();
                $('#ttcr_fri').empty();
                $('#ttcr_sat').empty();
                $('#ttcr_sun').empty();  

                overallstart = Array();

                for (y= 0; y<data.length; y++) 
                {
                    if(data[y]['lectlist'].length > 0)
                    {
                        if(overallstart.length<=0)
                        {
                            overallstart = data[y]['lectlist'][0]['ttlc_starttime'];
                        }
                        else
                        {
                            if(data[y]['lectlist'].length>0)
                            {
                                currearliest = converttime(overallstart);
                                daystart = converttime(data[y]['lectlist'][0]['ttlc_starttime']);

                                if(daystart[0]<currearliest[0])
                                {
                                    overallstart = data[y]['lectlist'][0]['ttlc_starttime'];
                                }
                                else if(daystart[0]==currearliest[0])
                                {
                                    if(daystart[1]<currearliest[1])
                                    {
                                        overallstart = data[y]['lectlist'][0]['ttlc_starttime'];
                                    }
                                }
                            }
                        }
                    }
                }

                for (x= 0; x<data.length; x++) 
                {
                    load_table_view(data[x]['lectlist'],('ttcr_'+data[x]['day']),'Edit',overallstart);
                }
            }
        },  
        "json"
    );
}

function load_table_view(ary,day,type,overallstart)
{
    if(ary.length>0)
    {
        for (i = 0; i<ary.length; i++) {

            if(i==0 && overallstart!='')
            {
                startemptyslot = timediffinminute(overallstart,ary[i]['ttlc_starttime']);
                $('#'+day).append('<div style="height:'+startemptyslot+'px"></div>');
            }

            timeslot = timediffinminute(ary[i]['ttlc_starttime'],ary[i]['ttlc_endtime']);

            timerange = ary[i]['ttlc_starttime']+' - '+ary[i]['ttlc_endtime']+'<br>';
            hallname  = '[ '+ary[i]['hall_name']+' ]<br>';
            lecturer  = ary[i]['stf_fname']+' '+ary[i]['stf_lname'];
            subject   = ary[i]['subject']+' ';
            clzbtn    = '<button type="button" class="close" style="font-size:11px !important;opacity: 0.5;" onclick="event.preventDefault();delete_lecture('+ary[i]['ttlc_id']+')"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="font-size:11px !important"></span></button>';
            editbtn   = '<button type="button" class="close" style="font-size:11px !important;opacity: 0.5;" onclick="event.preventDefault();edit_lecture_view('+ary[i]['ttlc_id']+')"><span class="glyphicon glyphicon-edit" aria-hidden="true" style="font-size:11px !important"></span></button>';

            if(type=='Edit')
            {
                $('#'+day).append('<div class="panel panel-primary" style="margin-bottom:1px"><div class="panel-heading" style="height:'+(timeslot-1)+'px;font-size:11px;line-height:15px;padding:5px;">'+clzbtn+editbtn+'<br>'+timerange+subject+hallname+lecturer+'</div></div>');
            }
            else
            {
                $('#'+day).append('<div class="panel panel-success" style="margin-bottom:1px"><div class="panel-heading" style="height:'+(timeslot-1)+'px;font-size:11px;line-height:15px;padding:5px;">'+timerange+subject+hallname+lecturer+'</div></div>');
            }
            

            if(ary.length > (i+1) )
            {
                emptyslot = timediffinminute(ary[i]['ttlc_endtime'],ary[(i+1)]['ttlc_starttime']);
                $('#'+day).append('<div style="height:'+emptyslot+'px"></div>');
            }
        }
    }
    else
    {
        $('#'+day).append('<div style="height:540px"></div>');
    }
}

function edit_lecture_view(id)
{
    $.post("<?php echo base_url('time_table/load_lecture_timeslot')?>",{'id':id},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                tt_course       = $('#tt_course').val();
                tt_year         = $('#tt_year').val();
                tt_semester     = $('#tt_semester').val();

                $('#addlectureform').data('bootstrapValidator').resetForm();
                $('#lect_lecturer').empty();
                load_subjects(tt_course,tt_year,tt_semester,data['ttlc_subject']);
                load_halls(data['ttlc_hall']);
                load_lecturers(data['ttlc_subject'],data['ttlc_lecturer']);
                $('#addlecturemodal').modal('show');

                $('#lect_id').val(data['ttlc_id']);
                $('#lect_starttime').val(data['ttlc_starttime']);
                $('#lect_endtime').val(data['ttlc_endtime']);
                $("input[name=weekdayrdo][value="+data['ttlc_weekday']+"]").prop("checked",true);
            } 
        },  
        "json"
    );
}

function load_addlecture_modal()
{
    tt_course       = $('#tt_course').val();
    tt_year         = $('#tt_year').val();
    tt_semester     = $('#tt_semester').val();

    load_subjects(tt_course,tt_year,tt_semester,null);
    load_halls(null);
    $('#addlecturemodal').modal('show');
}

function load_subjects(tt_course,tt_year,tt_semester,sel)
{
    $.post("<?php echo base_url('time_table/load_subjects')?>",{'tt_semester':tt_semester,'tt_course':tt_course,'tt_year':tt_year},
        function(data)
        {
            $('#lect_subject').empty();
            $('#lect_subject').append("<option value=''></option>");
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                if(data.length>0)
                {   
                    for (i = 0; i<data.length; i++) {
                        selectedtxt = '';
                        if(sel == data[i]['id'])
                        {
                            selectedtxt = 'selected';
                        }
                       $('#lect_subject').append("<option value='"+data[i]['id']+"' "+selectedtxt+">"+data[i]['code']+" - "+data[i]['subject']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_halls(sel)
{
    $.post("<?php echo base_url('time_table/load_halls')?>",{'tt_branch':$('#tt_branch').val()},
        function(data)
        {
            $('#lect_hall').empty();
            $('#lect_hall').append("<option value=''></option>");
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                if(data.length>0)
                {  

                    for (i = 0; i<data.length; i++) {

                        selectedtxt = '';
                        if(sel == data[i]['id'])
                        {
                            selectedtxt = 'selected';
                        }
                       $('#lect_hall').append("<option value='"+data[i]['id']+"' "+selectedtxt+">"+data[i]['hall_name']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_lecturers(sub,sel)
{
    $.post("<?php echo base_url('time_table/load_lecturers')?>",{'sub':sub},
        function(data)
        {
            $('#lect_lecturer').empty();
            $('#lect_lecturer').append("<option value=''></option>");
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                if(data.length>0)
                {   
                    for (i = 0; i<data.length; i++) {

                        selectedtxt = '';
                        if(sel == data[i]['stf_id'])
                        {
                            selectedtxt = 'selected';
                        }
                        $('#lect_lecturer').append("<option value='"+data[i]['stf_id']+"' "+selectedtxt+">"+data[i]['stf_fname']+' '+data[i]['stf_lname']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function save_lecture()
{
    lect_id       = $('#lect_id').val();
    lect_subject  = $('#lect_subject').val();
    lect_hall     = $('#lect_hall').val();
    lect_lecturer = $('#lect_lecturer').val();
    lect_starttime= $('#lect_starttime').val();
    lect_endtime  = $('#lect_endtime').val();
    tt_id         = $('#tt_id').val();
    tt_weekday    = $("input[name='weekdayrdo']:checked").val();

    displaytxt = $("#tt_code").val()+' : '+$("#lect_subject :selected").text()+' - '+$("#lect_hall :selected").text()+' '+$("#lect_lecturer :selected").text()+' [ '+lect_starttime+' - '+lect_endtime+' ]';

    $.post("<?php echo base_url('time_table/save_lecture')?>",{'tt_id':tt_id,'lect_id':lect_id,'lect_subject':lect_subject,'lect_starttime':lect_starttime,'lect_endtime':lect_endtime,'lect_hall':lect_hall,'lect_lecturer':lect_lecturer,'displaytxt':displaytxt,'tt_weekday':tt_weekday},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                result_notification(data);
                if(data['status'] == 'success')
                {
                    load_lectureslist(tt_id);
                    reset_lecture_modal();
                }
            }
        },  
        "json"
    );
}

function reset_lecture_modal()
{
    $('#addlectureform').data('bootstrapValidator').resetForm();
    $('#addlecturemodal').modal('toggle');
    $('#lect_lecturer').empty();
    $('#lect_starttime').val('');
    $('#lect_endtime').val('');
    $("input[name=weekdayrdo]").prop("checked",false);
}

function timediffinminute(start,end)
{
    starttime   = converttime(start);
    endtime     = converttime(end);

    starttminmin = (starttime[0]*60)+starttime[1];
    endtminmin   = (endtime[0]*60)+endtime[1];
    tmdiffinmin  = endtminmin-starttminmin;
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

function load_timetable_view(tblid,descrip)
{
    $('#view_description').empty();
    $('#view_description').append('<h4 class="modal-title">'+descrip+'</h4>');
    $('#viewtimetable').modal('show');

        $.post("<?php echo base_url('time_table/load_lectureslist')?>",{'id':tblid},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#view_mon').empty();
                $('#view_tue').empty();
                $('#view_wed').empty();
                $('#view_thu').empty();
                $('#view_fri').empty();
                $('#view_sat').empty();
                $('#view_sun').empty();  

                overallstart = Array();

                for (y= 0; y<data.length; y++) 
                {
                    if(overallstart.length<=0)
                    {
                        overallstart = '8:00 AM';
                    }
                    else
                    {
                        if(data[y]['lectlist'].length>0)
                        {
                            currearliest = converttime(overallstart);
                            daystart = converttime(data[y]['lectlist'][0]['ttlc_starttime']);

                            if(daystart[0]<currearliest[0])
                            {
                                overallstart = data[y]['lectlist'][0]['ttlc_starttime'];
                            }
                            else if(daystart[0]==currearliest[0])
                            {
                                if(daystart[1]<currearliest[1])
                                {
                                    overallstart = data[y]['lectlist'][0]['ttlc_starttime'];
                                }
                            }
                        }
                    }
                }

                for (x= 0; x<data.length; x++) 
                {
                    load_table_view(data[x]['lectlist'],('view_'+data[x]['day']),'View',overallstart);
                }
            }
        },  
        "json"
    );
}

function delete_lecture(id)
{
    $.post("<?php echo base_url('time_table/delete_lecture')?>",{"id":id},
    function(data)
    {   
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
        }
        else
        {
            tt_id = $('#tt_id').val();
            load_lectureslist(tt_id);
            result_notification(data);
        }
    },  
    "json"
    );
}
</script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Assign Time Table</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-calender"></i>Assign Timetable</li>
        </ol>
    </div>
</div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="lookup_tab" href="#lookuppanel" aria-controls="lookuppanel" role="tab" data-toggle="tab">Lookup</a></li>
    <li role="presentation"><a id="create_tab" href="#assignpanel" aria-controls="assignpanel" role="tab" data-toggle="tab">Assign Time Table</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="lookuppanel">
<div class="panel">
<header class="panel-heading">
    Lookup
</header>
<div class="panel-body">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="search_branch" class="col-md-3 control-label">Branch</label>
            <div class="col-md-9">
                <?php 
                    global $branchdrop;
                    global $selectedbr;
                    $extraattrs = 'id="search_branch" class="form-control" ';
                    echo form_dropdown('search_branch',$branchdrop,$selectedbr, $extraattrs); 
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="">  
        <div class="form-group">
            <label for="search_faculty" class="col-md-2 control-label">Faculty</label>
            <div class="col-md-10">
                <?php 
                    global $facultydrop;
                    global $selectedfac;
                    $facextraattrs = 'id="search_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"  onchange="load_courses_list(this.value,null,\'search\')"';
                    echo form_dropdown('search_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="search_course" class="col-md-3 control-label">Course</label>
            <div class="col-md-9">
                <select class="form-control" id="search_course" name="search_course" onchange="load_years(this.value,null,'search')">
                    <option value=""></option>    
                    <?php
                        foreach ($courses as $course) 
                        {
                           echo '<option value="'.$course['id'].'">[ '.$course['course_code'].' ] - '.$course['course_code'].'</option>';
                        }
                    ?>        
                </select>                                           
            </div>                       
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="search_year" class="col-md-3 control-label">Year</label>
            <div class="col-md-9">
                <select class="form-control" id="search_year" name="search_year"  onchange="load_semester(this.value,null,null,'search')">
                    <option value=""></option>            
                </select>                                           
            </div>                       
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="search_semester" class="col-md-3 control-label">Semester</label>
            <div class="col-md-9">
                <select class="form-control" id="search_semester" name="search_semester">
                    <option value=""></option>            
                </select>                                           
            </div>                       
        </div>  
    </div>
    <!-- <div class="col-md-3">
        <div class="form-group">
            <label for="search_table" class="col-md-3 control-label">T. Table</label>
            <div class="col-md-9">
                <select class="form-control" id="search_table" name="search_table" onchange="load_update_view(this.value,'clone')">
                    <option value=""></option>            
                </select>                                           
            </div>                       
        </div>
    </div>
    <div class="col-md-3 form-group">
        <label for="search_startdate" class="col-md-3 control-label">S. Date</label>
        <div class="col-md-9">
            <div id="" class="input-group date" >
                <input class="form-control datepicker" type="text" name="search_startdate" id="search_startdate"  data-format="YYYY-MM-DD">
                <span class="input-group-addon"><span class="glyphicon-calendar "></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 form-group">
        <label for="search_enddate" class="col-md-3 control-label">E. Date</label>
        <div class="col-md-9">
            <div id="" class="input-group date" >
                <input class="form-control datepicker" type="text" name="search_enddate" id="search_enddate"  data-format="YYYY-MM-DD">
                <span class="input-group-addon"><span class="glyphicon-calendar "></span>
                </span>
            </div>
        </div>
    </div> -->
</div>
<br>
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">
        <div class="form-group">
            <button type='button' class='btn btn-info' onclick='event.preventDefault();load_assined_timetables();'>Search</button>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table id="assignmaintbl" class="table table-bordered" style="width:100%" cellspacing="0">
            <thead id="assignmaintbl_head">
                <tr>
                    <th style="text-align: center">Start Date</th>
                    <th style="text-align: center">End Date</th>
                    <th style="text-align: center">Actions</th>
                </tr>
            </thead>
            <tbody id="assignmaintbl_body"> 
                <tr><td colspan='3'>Search Time Table Assigned Data</td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>
</div>
</div>
</div>
<!-- assign pane -->
<div role="tabpanel" class="tab-pane" id="assignpanel">
<section class="panel">
<header class="panel-heading">
    Assign Time Table 
</header>
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('time_table/assign_time_table')?>" id="assign_form" autocomplete="off" novalidate>
<div class="panel-body">
<div class="row">
<div class="col-md-6">
    <div class="form-group">
        <label for="tt_branch" class="col-md-2 control-label">Branch</label>
        <div class="col-md-10">
            <?php 
                global $branchdrop;
                global $selectedbr;
                $extraattrs = 'id="tt_branch" class="form-control" onchange="$(\'#submitbtn\').hide();
    $(\'#tblloadbtn\').show();$(\'#ed_div\').hide();$(\'#sd_div\').hide();"';
                echo form_dropdown('tt_branch',$branchdrop,$selectedbr, $extraattrs); 
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="tt_faculty" class="col-md-2 control-label">Faculty</label>
        <div class="col-md-10">
            <?php 
                global $facultydrop;
                global $selectedfac;
                $facextraattrs = 'id="tt_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_courses_list(this.value,null,\'tt\')"';
                echo form_dropdown('tt_faculty',$facultydrop,$selectedfac, $facextraattrs); 
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="tt_course" class="col-md-2 control-label">Course</label>
        <div class="col-md-10">
            <select class="form-control" id="tt_course" name="tt_course" onchange="load_years(this.value,null,'tt')">
                <option value=""></option>         
            </select>                                           
        </div>                       
    </div>
    <div class="form-group">
        <label for="tt_year" class="col-md-2 control-label">Year</label>
        <div class="col-md-10">
            <select class="form-control" id="tt_year" name="tt_year"  onchange="load_semester(this.value,null,null,'tt')">
                <option value=""></option>            
            </select>                                           
        </div>                       
    </div>
    <div class="form-group">
        <label for="tt_semester" class="col-md-2 control-label">Semester</label>
        <div class="col-md-10">
            <select class="form-control" id="tt_semester" name="tt_semester">
                <option value=""></option>            
            </select>                                           
        </div>                       
    </div> 
    <br>
    <div class="form-group" id="sd_div">
        <label for="startdate" class="col-md-3 control-label">Start Date</label>
        <div class="col-md-9">
            <div id="" class="input-group date" >
                <input class="form-control datepicker" type="text" name="startdate" id="startdate"  data-format="YYYY-MM-DD">
                <span class="input-group-addon"><span class="glyphicon-calendar "></span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group" id="ed_div">
        <label for="enddate" class="col-md-3 control-label">End Date</label>
        <div class="col-md-9">
            <div id="" class="input-group date" >
                <input class="form-control datepicker" type="text" name="enddate" id="enddate"  data-format="YYYY-MM-DD">
                <span class="input-group-addon"><span class="glyphicon-calendar "></span>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <table id="ttassign_table" class="table table-bordered" style="width:100%" cellspacing="0">
        <thead id="ttassign_table_head">
            <tr>
                <th style="width:50px;text-align: center">#</th>
                <th style="text-align: center">Time Table</th>
                <th style="text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody id="ttassign_table_body"> 
        </tbody>
    </table>
    </div>
</div>
</div>
</div>
<div class="panel-footer">
    <button type='button' class='btn btn-info' id="tblloadbtn" onclick='event.preventDefault();load_timetbl_temp();'>Search Time Tables</button>
    <button type="submit" class="btn btn-primary" id="submitbtn">Save</button> 
    <!-- <button type="submit" class="btn btn-default">Reset</button> -->
</div>
</form>
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
                <table id="viewttbl" class="table table-bordered" style="width:100%" cellspacing="0">
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

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#submitbtn').hide();
    $('#ed_div').hide();
    $('#sd_div').hide();
    $('#tblloadbtn').show();
});

$('#startdate').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});
$('#enddate').datetimepicker({ defaultDate: null,  pickTime: false});
$('#search_startdate').datetimepicker({ pickTime: false});
$('#search_enddate').datetimepicker({ pickTime: false});

$('#startdate').on('change show', function(e) {
    $('#assign_form').bootstrapValidator('revalidateField', 'startdate');
});

$('#enddate').on('change show', function(e) {
    $('#assign_form').bootstrapValidator('revalidateField', 'enddate');
});

$('#viewttbl').DataTable({
    'dom':'rt<"row"<"col-md-3"i><"col-md-9"p>><"clear">',
    "paging":   false,
    "ordering": false,
    "info":     false
});

$('#assign_form').bootstrapValidator({
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
        },
        startdate:
        {
            validators: 
            {
                notEmpty: {message: 'Start Date is required.'}
            }
        },
        enddate:
        {
            validators: 
            {
                notEmpty: {message: 'End Date is required.'}
            }
        },
        assi_timetable:
        {
            validators: 
            {
                notEmpty: {message: 'Select the time table to assign'}
            }
        }
    }
});

function load_assined_timetables()
{
    srch_branch      = $('#search_branch').val();
    srch_course      = $('#search_course').val();
    srch_year        = $('#search_year').val();
    srch_semester    = $('#search_semester').val();
    srch_table       = $('#search_table').val();
    srch_startdate   = $('#search_startdate').val();
    srch_enddate     = $('#search_enddate').val();
    srch_faculty     = $('#search_faculty').val();

    $.post("<?php echo base_url('time_table/load_assined_timetables')?>",{'srch_branch':srch_branch,'srch_course':srch_course,'srch_year':srch_year,'srch_semester':srch_semester,'srch_table':srch_table,'srch_startdate':srch_startdate,'srch_enddate':srch_enddate,'srch_faculty':srch_faculty},
        function(data)
        {
            $('#assignmaintbl_body').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                if(data.length>0)
                {   
                    for (i = 0; i<data.length; i++) 
                    {
                        descript = data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+' [ '+data[i]['course_code']+' - '+data[i]['course_code']+' / Y : '+data[i]['ttbl_year']+' / S : '+data[i]['ttbl_semester']+' ]';
                        $('#assignmaintbl_body').append("<tr class='warning'><td colspan='3'>"+descript+"</td></tr>");

                        assilist = data[i]['assilist'];

                        if(assilist.length>0)
                        {
                            for (x = 0; x<assilist.length; x++) 
                            {
                                editbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();edit_ttblassign_load("+assilist[x]['ttas_id']+","+assilist[x]['ttas_branch']+","+assilist[x]['ttas_course']+","+assilist[x]['ttas_year']+","+assilist[x]['ttas_semester']+",\""+assilist[x]['ttas_startdate']+"\",\""+assilist[x]['ttas_enddate']+"\","+assilist[x]['ttas_timetable']+","+assilist[x]['ttas_faculty']+")'>Edit</a>";
                                deltbtn = " <a class='btn btn-danger btn-xs' onclick='event.preventDefault();delete_ttbl_assign("+assilist[x]['ttas_id']+")'>Delete</a>";

                                $('#assignmaintbl_body').append("<tr><td>"+assilist[x]['ttas_startdate']+"</td><td>"+assilist[x]['ttas_enddate']+"</td><td style='text-align: center'>"+editbtn+" "+deltbtn+"</td></tr>");
                            }
                        }
                        else
                        {
                            $('#assignmaintbl_body').append("<tr><td colspan='3'>Time Table Not Assigned</td></tr>");
                        }
                    }
                }
                else
                {
                    $('#assignmaintbl_body').append("<tr><td colspan='3'>No data Found</td></tr>");
                }
            }
        },  
        "json"
    );
}

function delete_ttbl_assign(id)
{

}

function edit_ttblassign_load(id,branch,course,year,semester,sdate,edate,table,fac)
{
    // $('#tt_branch').val(branch);
    // $('#tt_course').val(course);
    // load_years(course,year,inputname,'tt');
    // load_semester(year,semester,'tt');
    // load_timetableslist(branch,course,year,semester,table,fac);
    // $('#startdate').val(sdate);
    // $('#enddate').val(edate);
}

function load_timetbl_temp()
{
    tt_branch       = $('#tt_branch').val();
    tt_course       = $('#tt_course').val();
    tt_year         = $('#tt_year').val();
    tt_semester     = $('#tt_semester').val();
    tt_faculty      = $('#tt_faculty').val();

    load_timetableslist(tt_branch,tt_course,tt_year,tt_semester,null,tt_faculty);
}

function load_timetableslist(tt_branch,tt_course,tt_year,tt_semester,seltbl,tt_faculty)
{
    $.post("<?php echo base_url('time_table/load_finalized_timetables')?>",
        function(data)
        {
            $('#ttassign_table_body').empty();
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

                        if(data[i]['ttbl_isconfirmed']==1 && tt_branch == data[i]['ttbl_branch'] && tt_course == data[i]['ttbl_course'] && tt_year == data[i]['ttbl_year'] && tt_semester == data[i]['ttbl_semester'] && tt_faculty == data[i]['ttbl_faculty'])
                        {
                            descript = data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+' [ '+data[i]['course_code']+' - '+data[i]['course_code']+' / Y : '+data[i]['ttbl_year']+' / S : '+data[i]['ttbl_semester']+' ]';

                            viewbtn = " <a class='btn btn-info btn-xs' onclick='event.preventDefault();load_timetable_view("+data[i]['ttbl_id']+",\""+descript+"\")'>View</a>";

                            seltxt = '';

                            if(seltbl == data[i]['ttbl_id'])
                            {
                                seltxt = 'checked';
                            }

                            $('#ttassign_table_body').append("<tr><td style='text-align:center'><div class='radio'><label><input type='radio' name='assi_timetable' value='"+data[i]['ttbl_id']+"' onclick='get_startdate(this.value)' "+seltxt+"></label></div></td><td>"+descript+"</td><td style='text-align:center'>"+viewbtn+"</td></tr>");
                        
                            $('#submitbtn').show();
                            $('#ed_div').show();
                            $('#sd_div').show();
                            $('#tblloadbtn').hide();
                        }
                    }
                }
            }
        },  
        "json"
    );
}

function load_years(tt_course,selyear,inputname)
{
    $.post("<?php echo base_url('time_table/load_years')?>",{'tt_course':tt_course},
        function(data)
        {
            $('#'+inputname+'_year').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#'+inputname+'_year').append("<option value=''></option>");
                if(data>0)
                {   
                    for (i = 0; i<data; i++) {
                        selectedtxt = '';
                        if(selyear==(i+1))
                        {
                            selectedtxt = 'selected';
                        }

                       $('#'+inputname+'_year').append("<option value='"+(i+1)+"' "+selectedtxt+">"+(i+1)+"</option>");
                    }

                    $('#submitbtn').hide();
                    $('#ed_div').hide();
                    $('#sd_div').hide();
                    $('#tblloadbtn').show();
                }
            }
        },  
        "json"
    );
}

function load_semester(tt_year,selsemester,tt_course,inputname)
{
    if(tt_course==null)
    {
        tt_course = $('#'+inputname+'_course').val();
    }

    $.post("<?php echo base_url('time_table/load_semester')?>",{'tt_year':tt_year,"tt_course":tt_course},
        function(data)
        {
            $('#'+inputname+'_semester').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#'+inputname+'_semester').append("<option value=''></option>");
                if(data>0)
                {   
                    for (i = 0; i<data; i++) {

                        selectedtxt = '';
                        if(selsemester==(i+1))
                        {
                            selectedtxt = 'selected';
                        }

                       $('#'+inputname+'_semester').append("<option value='"+(i+1)+"' "+selectedtxt+">"+(i+1)+"</option>");
                    }
                }
            }
        },  
        "json"
    );
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

                for (x= 0; x<data.length; x++) 
                {
                    load_table_view(data[x]['lectlist'],('view_'+data[x]['day']),'View',overallstart);
                }
            }
        },  
        "json"
    );
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

function get_startdate(tt_tmtbl)
{
    tt_branch       = $('#tt_branch').val();
    tt_course       = $('#tt_course').val();
    tt_year         = $('#tt_year').val();
    tt_semester     = $('#tt_semester').val();

    $.post("<?php echo base_url('time_table/get_startdate')?>",{'tt_branch':tt_branch,'tt_course':tt_course,'tt_year':tt_year,'tt_semester':tt_semester,'tt_tmtbl':tt_tmtbl},
        function(data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                if(data!='')
                {
                    $('#startdate').val(data);
                    $('#startdate').prop('readonly', true);
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

function load_courses_list(id,selectedid,pref)
{
    $('#'+pref+'_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

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
                    $('#'+pref+'_course').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code']+' - '+data[i]['course_code']));
                }
                else
                {
                    $('#'+pref+'_course').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['course_code']+' - '+data[i]['course_code']));
                }
            }
        }
    },
    "json"
    );
}
</script>


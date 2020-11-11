<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Student Attendance</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Student</li>
            <li><i class="fa fa-users"></i>Attendance</li>
        </ol>
    </div>
</div>
<!-- Nav tabs -->
<form class="form-horizontal" role="form" method="post" id="attendance_form" autocomplete="off" novalidate>
<ul class="nav nav-pills" role="tablist" style="margin-bottom: 5px">
    <li style="width:10%" role="presentation" class="active"><a href="#searchbyhall" aria-controls="searchbyhall" role="tab" data-toggle="tab">Search By Hall</a></li>
    <!-- <li style="width:12%" role="presentation"><a href="#serchbysubject" aria-controls="serchbysubject" role="tab" data-toggle="tab">Search By Subject</a></li> -->
    <li style="width:89%;">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group" style="margin-top: 5px;width:100%">
                    <label for="atn_branch" class="col-md-2 control-label" style="padding-top: 5px">Branch</label>
                    <div class="col-md-10">
                        <?php 
                            global $branchdrop;
                            global $selectedbr;
                            $extraattrs = 'id="atn_branch" class="form-control" style="width:100%" onchange="load_halls(this.value);"';
                            echo form_dropdown('atn_branch',$branchdrop,$selectedbr, $extraattrs); 
                        ?>
                    </div>                      
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-top: 5px;width:100%">
                    <label for="atn_date" class="col-md-2 control-label" style="padding-top: 5px">Date</label>
                    <div class="col-md-10">
                        <div id="" class="input-group date"  style="width:100%">
                            <input class="form-control datepicker" type="text" name="atn_date" id="atn_date"  data-format="YYYY-MM-DD">
                            <span class="input-group-addon"><span class="glyphicon-calendar "></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="searchbyhall">
        <div class="panel" style="margin-bottom: 0px">
            <header class="panel-heading" style="padding-top: 5px;height: 42px">
                <div class="col-md-5">
                        Student Attendance By Hall
                    <!-- <div class="col-md-6" id="payment_id">
                        <h4><?php if(!empty($_SESSION['u_branch'])){echo $payindex[$_SESSION['u_branch']];}?></h4>
                    </div> -->
                </div>
            </header>
        </div>
    </div>
<!--     <div role="tabpanel" class="tab-pane" id="serchbysubject">
        <div class="panel" style="margin-bottom:5px">
            <div class="panel-heading">
                Student Attendance By Subject
            </div>
        </div>
    </div> -->
</div>
<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3" >
                <div class="row col-md-12" id="searchview">
                    <div class="form-group">
                        <label for="srch_hallsel" class="col-md-2 control-label">Hall</label>
                        <div class="col-md-10">
                            <select name="srch_hallsel" id="srch_hallsel" class="form-control">
                            </select>
                        </div>
                    </div>                        
                    <div class="form-group">
                        <label for="srch_faculty" class="col-md-2 control-label">Faculty</label>
                        <div class="col-md-10">
                            <?php 
                                global $facultydrop;
                                global $selectedfac;
                                $facextraattrs = 'id="srch_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                echo form_dropdown('srch_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                            ?>
                        </div>
                    </div>          
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type='button' class='btn btn-info btn-sm' onclick='event.preventDefault();load_times_slots();'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="list-group" id="timeslotdiv">
                    <a href="#" class="list-group-item list-group-item-warning">
                        <p class="list-group-item-text">Select Hall and Date to Find Time Slots </p>
                    </a>
                </div>
            </div>
            <div class="col-md-8" id="printareadiv">
                <input type="hidden" name="atn_subject" id="atn_subject">
                <input type="hidden" name="atn_lecturer" id="atn_lecturer">
                <input type="hidden" name="atn_day" id="atn_day">
                <input type="hidden" name="atn_stime" id="atn_stime">
                <input type="hidden" name="atn_etime" id="atn_etime">
                <input type="hidden" name="atn_hallsel" id="atn_hallsel">
                <input type="hidden" name="atn_halltxt" id="atn_halltxt">
                <input type="hidden" name="atn_faculty" id="atn_faculty">
                <input type="hidden" name="atnfactext" id="atnfactext">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>P/A</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="stulistbody">
                        <tr>
                            <td colspan="3">Search students for attendance</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="col-md-2"></div> -->
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary" id="submitbtn">Save</button> 
        <button onclick="event.preventDefault();print_attendance();" class="btn btn-success">Print</button>
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

$('#atn_date').datetimepicker({ defaultDate: "<?php echo date('Y-m-d');?>",  pickTime: false});

$('#attendance_form').bootstrapValidator({
    live : 'enabled',
    message : 'This value is not valid',
    fields :{
        atn_branch: 
        {
            validators: 
            {
                notEmpty: {message: 'Branch is required.'}
            }
        },
        // atn_subject: 
        // {
        //     validators: 
        //     {
        //         notEmpty: {message: 'Subject is required.'}
        //     }
        // },
        atn_date:
        {
            validators: 
            {
                notEmpty: {message: 'Date is required.'}
            }
        }
    },
    onSuccess: function(e) {
        e.preventDefault();
        update_attendance();
    }
});

function update_attendance()
{
    $.ajax(
    {
        url : "<?php echo base_url('student/update_attendance')?>",
        type : 'POST',
        async : false,
        cache: false,
        dataType : 'json',
        data: $('#attendance_form').serialize(),
        success:function(data)
        {
            // Sub,lec,day,stm,etm
            // load_student_list();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                result_notification(data);
                Sub = $('#atn_subject').val();
                lec = $('#atn_lecturer').val();
                day = $('#atn_day').val();
                stm = $('#atn_stime').val();
                etm = $('#atn_etime').val();
                load_student_list(Sub,lec,day,stm,etm);
                $('#attendance_form').data('bootstrapValidator').resetForm();
            }
        }
    });
}

function load_halls(id)
{
    $.post("<?php echo base_url('time_table/load_halls')?>",{'tt_branch':id},
        function(data)
        {
            $('#srch_hallsel').empty();
            $('#srch_hallsel').append("<option value=''></option>");
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
                        // if(sel == data[i]['id'])
                        // {
                        //     selectedtxt = 'selected';
                        // }
                       $('#srch_hallsel').append("<option value='"+data[i]['id']+"' "+selectedtxt+">"+data[i]['hall_name']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_times_slots()
{
    date    = $('#atn_date').val();
    hall    = $('#srch_hallsel').val();
    branch  = $('#atn_branch').val();
    faculty = $('#srch_faculty').val();

    $('#stulistbody').empty();
    $('#timeslotdiv').empty();
    $('#timeslotdiv').show();

    $.post("<?php echo base_url('student/load_times_slots')?>",{'date':date,'hall':hall,'branch':branch,'faculty':faculty},
    function(data)
    {
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
                    $('#timeslotdiv').append('<a onclick="load_student_list('+data[i]['ttlc_subject']+','+data[i]['ttlc_lecturer']+',\''+data[i]['ttlc_weekday']+'\',\''+data[i]['ttlc_starttime']+'\',\''+data[i]['ttlc_endtime']+'\')" id="listgrplink_'+data[i]['ttlc_id']+'" class="list-group-item">'+
                        '<h5 class="list-group-item-heading">[ '+data[i]['code']+' ] - '+data[i]['subject']+'</h5>'+
                        '<p class="list-group-item-text">'+data[i]['ttlc_starttimedisplay']+' - '+data[i]['ttlc_endtimedisplay']+'</p>'+
                        '<p class="list-group-item-text">'+data[i]['stf_fname']+' - '+data[i]['stf_lname']+'</p>'+
                        '</a>');
                }
                $('#timeslotdiv').append('<br><div class="col-md-12"><button type="button" class="btn btn-sm" onclick="event.preventDefault();$(\'#searchview\').show();$(\'#timeslotdiv\').empty();$(\'#stulistbody\').empty();" style="background-color: #212425;border-color: #212425;color: #FFFFFF;"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refreash</button></div>');
                $('#searchview').hide();
                halltxt   = $("#srch_hallsel :selected").text();
                facltxt   = $("#srch_faculty :selected").text();
                hall      = $("#srch_hallsel").val();
                facl      = $("#srch_faculty").val();

                $('#atn_hallsel').val(hall);
                $('#atn_halltxt').val(halltxt);
                $('#atn_faculty').val(facl);
                $('#atnfactext').val(facltxt);
            }
            else
            {
                $('#timeslotdiv').append('<a href="#" class="list-group-item list-group-item-danger">No Time Slot Found</a>');
                $('#atn_hallsel').val('');
                $('#atn_halltxt').val('');
                $('#atn_faculty').val('');
                $('#atnfactext').val('');
            }
        }
    },  
    "json"
    );
    $('#stulistbody').append("<tr><td colspan='3'>Search students for attendance</td></tr>");
}

function load_student_list(Sub,lec,day,stm,etm)
{
    date   = $('#atn_date').val();
    hall   = $('#srch_hallsel').val();
    branch = $('#atn_branch').val();
    faculty = $('#atn_faculty').val();

    $('#atn_subject').val(Sub);
    $('#atn_lecturer').val(lec);
    $('#atn_day').val(day);
    $('#atn_stime').val(stm);
    $('#atn_etime').val(etm);

    $('#stulistbody').empty();
    $.post("<?php echo base_url('student/load_student_list')?>",{'date':date,'hall':hall,'branch':branch,'Sub':Sub,'lec':lec,'day':day,'stm':stm,'etm':etm,'faculty':faculty},
    function(data)
    {
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
        }
        else
        {
            if(data.length>0)
            {
                for (x = 0; x<data.length; x++)
                {
                    $('#stulistbody').append('<tr class="warning"><td colspan="3"><strong>'+data[x]['coursedesc']+'</strong></td></tr>');

                    stulist = data[x]['students'];

                    if(stulist.length > 0)
                    {
                        for (i = 0; i<stulist.length; i++) 
                        {
                            chcktxt = '';

                            if(stulist[i]['isabsent']==1)
                            {
                                chcktxt = 'checked';
                            }

                            $('#stulistbody').append("<tr><td>[ "+stulist[i]['stu_id']+" ] - "+stulist[i]['first_name']+" "+stulist[i]['last_name']+"</td><td><input name='stuchk["+stulist[i]['stu_id']+"]' value='"+stulist[i]['stu_id']+"' class='stuchklist' type='checkbox' "+chcktxt+"></td><td><input name='remarks_"+stulist[i]['stu_id']+"' id='remarks_'"+stulist[i]['stu_id']+"' value='' type='text' class='form-control'><input name='atnstudent[]' value='"+stulist[i]['stu_id']+"' type='hidden' class='form-control'></td></tr>");
                        }
                    }
                    else
                    {
                        $('#stulistbody').append("<tr><td colspan='3'>No Student Found under this course</td></tr>");
                    }
                }
            }
            else
            {
                $('#stulistbody').append("<tr><td colspan='3'>No Student Found for any subject</td></tr>");
            }
        }
    },  
    "json"
    );
}

function print_attendance()
{
    date   = $('#atn_date').val();
    hall   = $("#atn_halltxt").val();
    branch = $("#atn_branch :selected").text();
    faculty = $("#atnfactext").val();

    csstxt = ".table {width: 100%;margin-bottom: 20px;max-width: 100%;background-color: transparent;border-collapse: collapse;border-spacing: 0;display: table;} .table-bordered {border: 1px solid black;} tr {display: table-row;vertical-align: inherit;border-color: inherit;} .table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td{border-bottom-width: 2px; border: 1px solid black;vertical-align: bottom; padding: 8px;line-height: 1.428571429;}";

    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>Attendance Sheet</title></head><style type="text/css">'+csstxt+'</style><body>');
    mywindow.document.write('<h3>Attendance Sheet</h3>');
    mywindow.document.write('<h5> Branch : '+branch+'</h5>');
    mywindow.document.write('<h5> Hall : '+hall+'</h5>');
    mywindow.document.write('<h5> Date : '+date+'</h5>');
    mywindow.document.write(document.getElementById('printareadiv').innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

</script>

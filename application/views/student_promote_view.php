<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Student Promotion</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-user"></i>Student</li>
            <li><i class="fa fa-share-alt"></i>Student Promotion</li>
        </ol>
    </div>
</div>
<!-- Nav tabs -->
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('student/promote_students')?>" id="promotionform" autocomplete="off" novalidate>
<div class="panel">
    <header class="panel-heading" style="padding-top: 5px;height: 42px">
        <div class="col-md-12">
            <h4>Promote Students</h4>
        </div>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group" style="margin-top: 5px;width:100%">
                    <label for="prom_centre" class="col-md-2 control-label" style="padding-top: 5px">Branch</label>
                    <div class="col-md-10">
                        <?php 
                            global $branchdrop;
                            global $selectedbr;
                            $extraattrs = 'id="prom_centre" class="form-control" style="width:100%"';
                            echo form_dropdown('prom_centre',$branchdrop,$selectedbr, $extraattrs); 
                        ?>
                    </div>                      
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-top: 5px;width:100%">
                    <label for="prom_batch" class="col-md-2 control-label" style="padding-top: 5px">Batch</label>
                    <div class="col-md-10">
                        <select id="prom_batch" class="form-control" style="width:100%" name="prom_batch">
                            <option value=""></option>
                            <option value="1">qwer1236555</option>
                            <option value="2">asded22336666</option>
                            <option value="3">vgyy</option>
                            <option value="4">765</option>
                            <option value="5">0001</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-top: 5px;width:100%">
                    <label for="prom_course" class="col-md-2 control-label" style="padding-top: 5px">Course</label>
                    <div class="col-md-10">
                        <select id="prom_course" class="form-control" style="width:100%" name="prom_course">
                            <option value=""></option>
                            <option value="1">course1</option>
                            <option value="2">course2</option>
                            <option value="3">course3</option>
                            <option value="4">course4</option>
                            <option value="5">course5</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-11">
                        <button type='button' class='btn btn-info' onclick='event.preventDefault();$("#stulistbody").show();'>Search</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>GPA</th>
                    <th>Results</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody id="stulistbody" style="display:none">
                <!-- <tr>
                    <td colspan="3">Search students for attendance</td>
                </tr> -->
                <tr>
                    <td>W.P.P.N.</td>
                    <td>NAVODYA</td>
                    <td>2.35</td>
                    <td><input name='' value='' class='stuchklist' type='checkbox'></td>
                </tr>
                <tr>
                    <td>P.F.D.</td>
                    <td>VIMDDI</td>
                    <td>3.56</td>
                    <td><input name='' value='' class='stuchklist' type='checkbox'></td>
                </tr>
                <tr>
                    <td>G.D.S.C.</td>
                    <td>MADUSANKA </td>
                    <td>2.35</td>
                    <td><input name='' value='' class='stuchklist' type='checkbox'></td>
                </tr>
                <tr>
                    <td>M.R.</td>
                    <td>RAMSEEN</td>
                    <td>2.35</td>
                    <td><input name='' value='' class='stuchklist' type='checkbox'></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary" id="submitbtn">Promote</button> 
        <!-- <button onclick="event.preventDefault();print_attendance();" class="btn btn-success">Print</button> -->
    </div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

function load_halls(id)
{
    $.post("<?php echo base_url('time_table/load_halls')?>",{'tt_branch':id},
        function(data)
        {
            $('#atn_hallsel').empty();
            $('#atn_hallsel').append("<option value=''></option>");
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
                       $('#atn_hallsel').append("<option value='"+data[i]['id']+"' "+selectedtxt+">"+data[i]['hall_name']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_times_slots()
{
    date   = $('#atn_date').val();
    hall   = $('#atn_hallsel').val();
    branch = $('#atn_branch').val();

    $('#stulistbody').empty();
    $('#stulistbody').append("<tr><td colspan='3'>Search students for attendance</td></tr>");
    $('#timeslotdiv').empty();

    $.post("<?php echo base_url('student/load_times_slots')?>",{'date':date,'hall':hall,'branch':branch},
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
                        '<p class="list-group-item-text">'+data[i]['ttlc_starttime']+' - '+data[i]['ttlc_endtime']+'</p>'+
                        '<p class="list-group-item-text">'+data[i]['stf_fname']+' - '+data[i]['stf_lname']+'</p>'+
                        '</a>');
                }
            }
            else
            {
                $('#timeslotdiv').append('<a href="#" class="list-group-item list-group-item-danger">No Time Slot Found</a>');
            }
        }
    },  
    "json"
    );
}

function load_student_list(Sub,lec,day,stm,etm)
{
    date   = $('#atn_date').val();
    hall   = $('#atn_hallsel').val();
    branch = $('#atn_branch').val();

    $('#stulistbody').empty();
    $.post("<?php echo base_url('student/load_student_list')?>",{'date':date,'hall':hall,'branch':branch,'Sub':Sub,'lec':lec,'day':day,'stm':stm,'etm':etm},
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

                            // if(stulist[i]['ispresent']==1)
                            // {
                            //     chcktxt = 'checked';
                            // }

                            $('#stulistbody').append("<tr><td>[ "+stulist[i]['stu_id']+" ] - "+stulist[i]['first_name']+" "+stulist[i]['last_name']+"</td><td><input name='stuchk["+stulist[i]['stu_id']+"]' value='"+stulist[i]['stu_id']+"' class='stuchklist' type='checkbox' "+chcktxt+"></td><td><input name='remarks["+stulist[i]['stu_id']+"]' id='remarks_'"+stulist[i]['stu_id']+"' value='' type='text' class='form-control'><input name='atnstudent[]' value='"+stulist[i]['stu_id']+"' type='hidden' class='form-control'></td></tr>");
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
    hall   = $("#atn_hallsel :selected").text();
    branch = $("#atn_branch :selected").text();

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

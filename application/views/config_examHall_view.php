<div class="se-pre-con"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<!-- Bootstrap Validator -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/bootstrapValidator.js'); ?>"></script>
<style type="text/css">
    bordered.dataTable td:last-child {
        border-right-width: 1;
    }

    bordered.dataTable tbody td {
    border-bottom-width: 1;
}
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Exam Hall Configuration</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Exam</li>
            <li><i class="fa fa-bank"></i>Exam Hall</li>
        </ol>
    </div>
</div>
<section class="panel">
    <div class="panel-heading">
        Exam Timetable
    </div>
    <div class="panel-body">
    <div class="row">
        <div class="col-md-1" style=""></div>
        <div class="col-md-3" style="">
            <input type="hidden" id="eh_id" name="eh_id">
            <input type="hidden" id="eh_code" name="eh_code">
            <input type="hidden" id="eh_action" name="eh_action">
            <input type="hidden" id="eh_clonett" name="eh_clonett">
            <div class="form-group">
                <label for="eh_season" class="col-md-3 control-label">S.Season</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_season" name="eh_season" onchange="load_exams(null,null,null,null,null);" style="width:100%">
                        <option value=""></option>    
                        <?php
                            foreach ($ay_info as $ay) 
                            {
                                if ($ay['ac_iscurryear'] == 1) {
                                    $ayselected = 'selected';
                                } else {
                                    $ayselected = '';
                                }
                                echo '<option value="'.$ay['es_ac_year_id'].'" '.$ayselected.'>'.$ay['ac_startdate'] . ' - ' . $ay['ac_enddate'].'</option>';
                            }
                        ?>      
                    </select> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="eh_branch" class="col-md-3 control-label">Center</label>
                <div class="col-md-9">
                    <?php 
                        global $branchdrop;
                        global $selectedbr;
                        $extraattrs = 'id="eh_branch" class="form-control" style="width:100%" onchange="load_course_list(this.value, 2, null);"';
                        echo form_dropdown('eh_branch',$branchdrop,$selectedbr, $extraattrs); 
                    ?>
                </div>
            </div>
        </div>
		<div class="col-md-3" style="">
            <div class="form-group">
                <label for="eh_course" class="col-md-3 control-label">Course</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_course" name="eh_course" onchange="load_years(this.value,null)" style="width:100%">
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
<!--        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="eh_faculty" class="col-md-3 control-label">Faculty</label>
                <div class="col-md-9">
                    <?php 
                        global $facultydrop;
                        global $selectedfac;
                        $facextraattrs = 'id="eh_faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_courses_list(this.value,null,null)" style="width:100%"';
                        echo form_dropdown('eh_faculty',$facultydrop,$selectedfac, $facextraattrs); 
                    ?>
                </div>
            </div>
        </div>-->
    </div>
    <br>
    <div class="row">
        <div class="col-md-1" style=""></div>
    <!--<div class="col-md-3" style="">
            <div class="form-group">
                <label for="eh_course" class="col-md-3 control-label">Course</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_course" name="eh_course" onchange="load_years(this.value,null)" style="width:100%">
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
        </div>-->
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="eh_year" class="col-md-3 control-label">Year</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_year" name="eh_year"  onchange="load_semester(this.value,null,null)" style="width:100%">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>
        </div>
        <div class="col-md-3" style="">
            <div class="form-group">
                <label for="eh_semester" class="col-md-3 control-label">Semester</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_semester" name="eh_semester" style="width:100%" onchange="load_exams(null,null,null,null,null);">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>  
        </div>
		<div class="col-md-3" style="">
            <div class="form-group">
                <label for="eh_exam" class="col-md-3 control-label">Exam</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_exam" name="eh_exam" style="width:100%">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>  
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-1" style=""></div>
        <div class="col-md-3" style="">
            <!--<div class="form-group">
                <label for="eh_exam" class="col-md-3 control-label">Exam</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_exam" name="eh_exam" style="width:100%">
                        <option value=""></option>            
                    </select>                                           
                </div>                       
            </div>-->  
        </div>
        <div class="col-md-3" style=""></div>
        <div class="col-md-3">
            <div class="form-group" style="text-align: right">
                <button type='button' class='btn btn-primary btn-sm' style="margin-top:-5px" onclick='event.preventDefault();load_schedules();'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4" id="schedulediv">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-warning">
                    <p class="list-group-item-text">No Schedule Found. </p>
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Index No.</th>
                        <th>Student</th>
                        <th id="actionheadcol" style="text-align:center">Actions</th>
                    </tr>
                </thead>
                <tbody id="stulistbody">
                    <tr>
                        <td colspan="3">Search for schedule to see halls</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</section>

<div class="modal fade bs-example-modal-lg" id="mnghallview">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <span id="view_description"></span>
            </div>
            <form class="form-horizontal" role="form" method="post" id="eh_form" autocomplete="off" novalidate>
            <div class="modal-body">
                <input type="hidden" name="eh_schedule" id="eh_schedule">
                <input type="hidden" name="eh_subject" id="eh_subject">
                <div class="form-group">
                    <label for="eh_hall" class="col-md-2 control-label">Hall</label>
                    <div class="col-md-9" style="padding-right:27px;padding-left: 67px">
                        <select name="eh_hall" id="eh_hall" class="form-control" style="width:100%;padding-right:0px;">
                        </select>
                    </div>
                </div>
                <table id="selstutbl" class="table table-bordered" style="width:100%" cellspacing="0">
                    <thead id="selstutblhead">
                        <tr>
                            <th>Index No.</th>
                            <th>Student</th>        
                            <th><input type="checkbox" id="select_all"/></th>
                        </tr>
                    </thead>
                    <tbody id="selstutblbody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitbtn">Save</button> 
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
    
$("#select_all").change(function(){  //"select all" change 
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change 
$('.checkbox').change(function(){ 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){
        $("#select_all").prop('checked', true);
    }
});
    
    
    
    
    
    
    
function load_course_list(center_id)
        {
            $('#eh_course').find('option').remove().end();
            $('#eh_course').append('<option value="">---Select Course Code---</option>').val('');

            $.post("<?php echo base_url('Student/load_course_list') ?>", {'center_id': center_id},

            function (data)
            {
                for (var i = 0; i < data.length; i++) 
                {

                // if(selectedid == data[i]['id'])
                // {
                //     $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).attr('selected', true).text(data[i]['course_code']+' - '+data[i]['course_name']));
                // }
                //  else
                //  {
                $('#eh_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                
    //  }
                }
                },
                        "json"
            );
        }
    
    
    
    
    

$('#eh_form').bootstrapValidator({
    live : 'enabled',
    message : 'This value is not valid',
    fields :{
        eh_hall: 
        {
            validators: 
            {
                notEmpty: {message: 'Hall is required.'}
            }
        }

    },
    onSuccess: function(e) {
        e.preventDefault();
        update_hall_students();
    }
});

function update_hall_students()
{
    $.ajax(
    {
        url : "<?php echo base_url('exam/update_hall_students')?>",
        type : 'POST',
        async : false,
        cache: false,
        dataType : 'json',
        data: $('#eh_form').serialize() + "&eh_course=" + $('#eh_course').val() + "&eh_year=" + $('#eh_year').val() + "&eh_semester=" + $('#eh_semester').val() + "&eh_exam=" + $('#eh_exam').val()+ "&eh_season=" + $('#eh_season').val()+ "&eh_branch=" + $('#eh_branch').val() + "",
        success:function(data)
        {
            result_notification(data);
            load_hallstudent_list($('#eh_schedule').val(),$('#eh_schedname').val(),$('#eh_subject').val());
            $('#mnghallview').modal('toggle');
        }
    });
}

function load_years(eh_course,selyear)
{
    $.post("<?php echo base_url('time_table/load_years')?>",{'tt_course':eh_course},
        function(data)
        {
            $('#eh_year').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#eh_year').append("<option value=''></option>");
                if(data>0)
                {   
                    for (i = 0; i<data; i++) {
                        selectedtxt = '';
                        if(selyear==(i+1))
                        {
                            selectedtxt = 'selected';
                        }

                       $('#eh_year').append("<option value='"+(i+1)+"' "+selectedtxt+">"+(i+1)+" Year</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_semester(eh_year,selsemester,eh_course)
{
    if(eh_course==null)
    {
        eh_course = $('#eh_course').val();
    }

    $.post("<?php echo base_url('time_table/load_semester')?>",{'tt_year':eh_year,"tt_course":eh_course},
        function(data)
        {
            $('#eh_semester').empty();
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $('#eh_semester').append("<option value=''></option>");
                if(data>0)
                {   
                    for (i = 0; i<data; i++) {

                        selectedtxt = '';
                        if(selsemester==(i+1))
                        {
                            selectedtxt = 'selected';
                        }

                       $('#eh_semester').append("<option value='"+(i+1)+"' "+selectedtxt+">"+(i+1)+" Semester</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_exams(eh_year,eh_semester,eh_course,eh_season,selexm)
{
    if(eh_course==null)
        eh_course = $('#eh_course').val();

    if(eh_year==null)
        eh_year = $('#eh_year').val();

    if(eh_semester==null)
        eh_semester = $('#eh_semester').val();
    
    if(eh_season==null)
        eh_season = $('#eh_season').val();

    $.post("<?php echo base_url('exam/load_exams')?>",{'tt_semester':eh_semester,'tt_course':eh_course,'tt_year':eh_year,'tt_season':eh_season},
        function(data)
        {
            $('#eh_exam').empty();
            $('#eh_exam').append("<option value=''></option>");
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
                        if(selexm == data[i]['id'])
                        {
                            selectedtxt = 'selected';
                        }
                       $('#eh_exam').append("<option value='"+data[i]['id']+"' "+selectedtxt+">"+data[i]['exam_code']+" - "+data[i]['exam_name']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function load_schedules()
{
    $('.se-pre-con').fadeIn('slow');
    eh_course   = $('#eh_course').val();
    eh_year     = $('#eh_year').val();
    eh_semester = $('#eh_semester').val();
    eh_exam     = $('#eh_exam').val();
    eh_season   = $('#eh_season').val();
    eh_branch   = $('#eh_branch').val();
    eh_faculty  = $('#eh_faculty').val();

    $('#stulistbody').empty();
    $('#stulistbody').append("<tr><td colspan='3'>Search students for attendance</td></tr>");
    $('#schedulediv').empty();

    $.post("<?php echo base_url('exam/load_schedules')?>",{'eh_course':eh_course,'eh_year':eh_year,'eh_semester':eh_semester,'eh_exam':eh_exam,'eh_season':eh_season,'eh_branch':eh_branch,'eh_faculty':eh_faculty},
    function(data)
    {
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else
        {
            if(data.length>0)
            {
                for (i = 0; i<data.length; i++) 
                {
                    schedary = data[i]['schedules'];
                    listgrpstr  = '<h4>'+data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+'</h4>';
                    listgrpstr += '<div class="list-group">';

                    if(schedary.length>0)
                    {
                        for (x = 0; x<schedary.length; x++) 
                        {
                            displaytxt = '[ '+schedary[x]['code']+' ] '+schedary[x]['subject']+' - '+schedary[x]['name']+' ( '+schedary[x]['esch_date']+' / '+schedary[x]['esch_stime']+' - '+schedary[x]['esch_etime']+' )';

                            listgrpstr += '<a onclick="load_hallstudent_list('+schedary[x]['esch_id']+',\''+displaytxt+'\','+schedary[x]['esch_subject']+')" id="listgrplink_'+schedary[x]['esch_id']+'" class="list-group-item">';
                            listgrpstr += '<h5 class="list-group-item-heading">[ '+schedary[x]['code']+' ] - '+schedary[x]['subject']+'</h5>';
                            listgrpstr += '<p class="list-group-item-text">'+schedary[x]['name']+'</p>';
                            listgrpstr += '<p class="list-group-item-text">'+schedary[x]['esch_date']+'</p>';
                            listgrpstr += '<p class="list-group-item-text">'+schedary[x]['esch_stime']+' - '+schedary[x]['esch_etime']+'</p>';
                            listgrpstr += '</a>';
                        }
                    }
                    else
                    {
                        listgrpstr += '<a href="#" class="list-group-item list-group-item-danger">No Schedule Found</a>';
                    }

                    listgrpstr += '</div>';

                    $('#schedulediv').append(listgrpstr);
                }
            }
            else
            {
                $('#schedulediv').append('<a href="#" class="list-group-item list-group-item-danger">No Schedule Found</a>');
            }
            $('.se-pre-con').fadeOut('slow');
        }
    },  
    "json"
    );
}

function load_hallstudent_list(id,name,subject)
{
    $('.se-pre-con').fadeIn('slow');
    eh_course   = $('#eh_course').val();
    eh_year     = $('#eh_year').val();
    eh_semester = $('#eh_semester').val();
    eh_exam     = $('#eh_exam').val();
    eh_season   = $('#eh_season').val();
    eh_branch   = $('#eh_branch').val();
    eh_faculty  = $('#eh_faculty').val();
    
    
    $('#stulistbody').empty();

    $.post("<?php echo base_url('exam/load_hallstudent_list')?>",{'eh_course':eh_course,'eh_year':eh_year,'eh_semester':eh_semester,'eh_exam':eh_exam,'eh_season':eh_season,'eh_branch':eh_branch,'id':id,'subject':subject,'eh_faculty':eh_faculty},
    function(data)
    {
        if(data == 'denied')
        {
            funcres = {status:"denied", message:"You have no right to proceed the action"};
            result_notification(funcres);
            $('.se-pre-con').fadeOut('slow');
        }
        else
        {
            if(data['halls'].length>0)
            {
                for (i = 0; i<data['halls'].length; i++) 
                {
                    $('#stulistbody').append('<tr class="warning"><td colspan="2"><strong>'+data['halls'][i]['hall_name']+'</strong></td><td style="text-align:center"><button type="button" class="btn btn-danger btn-xs" onclick="event.preventDefault();remove_hall('+data['halls'][i]['ehall_id']+','+id+',\''+name+'\','+subject+')">Remove Hall</button></td></tr>');

                    stulist = data['halls'][i]['hallstu'];

                    if(stulist.length>0)
                    {
                        for (x = 0; x<stulist.length; x++) 
                        {
                            $('#stulistbody').append('<tr><td>'+stulist[x]['reg_no']+'</td><td>'+stulist[x]['last_name']+' '+stulist[x]['first_name']+'</td><td style="text-align:center"><button type="button" class="btn btn-danger btn-xs" style="margin-top:-5px" onclick="event.preventDefault();remove_hall_student('+stulist[x]['id']+','+id+',\''+name+'\','+subject+')">Remove Student</button></td></tr>');
                        }
                    }
                }
            }

            if(data['nohallstulist'].length>0)
            {
                $('#actionheadcol').empty();
                $('#actionheadcol').append('<button type="button" class="btn btn-info btn-sm" onclick="event.preventDefault();add_new_hall('+id+',\''+name+'\','+eh_course+','+eh_year+','+eh_semester+','+eh_exam+','+eh_season+','+eh_branch+','+subject+')">Add New Hall</button>');
                $('#stulistbody').append('<tr class="warning"><td colspan="2"><strong>Students to be appended to a hall</strong></td><td></td></tr>');

                for (x = 0; x<data['nohallstulist'].length; x++) 
                {
                    $('#stulistbody').append('<tr><td>'+data['nohallstulist'][x]['reg_no']+'</td><td>'+data['nohallstulist'][x]['last_name']+' '+data['nohallstulist'][x]['first_name']+'</td><td></td></tr>');
                }
            }
        $('.se-pre-con').fadeOut('slow');
        }
    },  
    "json"
    );
}

function add_new_hall(id,name,eh_course,eh_year,eh_semester,eh_exam,eh_season,eh_branch,subject)
{
    $('#mnghallview').modal('show');
    $('#view_description').empty();
    $('#view_description').append(name);
    $('#selstutblbody').empty();
    $('#eh_schedule').val(id);
    $('#eh_schedname').val(name);
    $('#eh_subject').val(subject);

    $.post("<?php echo base_url('exam/load_nohallstudents')?>",{'eh_course':eh_course,'eh_year':eh_year,'eh_semester':eh_semester,'eh_exam':eh_exam,'eh_season':eh_season,'eh_branch':eh_branch,'id':id,'subject':subject},
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
                    $('#selstutblbody').append('<tr><td>'+data[x]['reg_no']+'</td><td>'+data[x]['last_name']+' '+data[x]['first_name']+'</td><td><input type="checkbox" class="checkbox" name="hallstudent[]" value="'+data[x]['id']+'"></td></tr>');
                }
            }
        }
    },  
    "json"
    );

    $.post("<?php echo base_url('time_table/load_halls')?>",{'tt_branch':eh_branch},
        function(data)
        {
            $('#eh_hall').empty();
            $('#eh_hall').append("<option value=''></option>");
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
                       $('#eh_hall').append("<option value='"+data[i]['id']+"' "+selectedtxt+">"+data[i]['hall_name']+"</option>");
                    }
                }
            }
        },  
        "json"
    );
}

function remove_hall(id,sched,name,sub)
{
    $.post("<?php echo base_url('exam/remove_hall')?>",{'id':id},
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
            load_hallstudent_list(sched,name,sub);
        }
    },  
    "json"
    );
}

function remove_hall_student(id,sched,name,sub)
{
    $.post("<?php echo base_url('exam/remove_hall_student')?>",{'id':id},
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
            load_hallstudent_list(sched,name,sub);
        }
    },  
    "json"
    );
}

function load_courses_list(id,selectedid)
{
    $('#eh_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');

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
                    $('#eh_course').append($("<option></option>").attr("value", data[i]['id']).attr('selected', true).text(data[i]['course_code']+' - '+data[i]['course_code']));
                }
                else
                {
                    $('#eh_course').append($("<option></option>").attr("value", data[i]['id']).text(data[i]['course_code']+' - '+data[i]['course_code']));
                }
            }
        }
    },
    "json"
    );
}
</script>
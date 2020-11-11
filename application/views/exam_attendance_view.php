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

    .just-padding {
        padding: 15px;
    }

    .list-group.list-group-root {
        padding: 0;
        overflow: hidden;
    }

    .list-group.list-group-root .list-group {
        margin-bottom: 0;
    }

    .list-group.list-group-root .list-group-item {
        border-radius: 0;
        border-width: 1px 0 0 0;
    }

    .list-group.list-group-root > .list-group-item:first-child {
        border-top-width: 0;
    }

    .list-group.list-group-root > .list-group > .list-group-item {
        padding-left: 30px;
    }

    .list-group.list-group-root > .list-group > .list-group > .list-group-item {
        padding-left: 45px;
    }

    .list-group-item .glyphicon {
        margin-right: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-calendar"></i> Exam Attendance</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Exam</li>
            <li><i class="fa fa-bank"></i>Exam Attendance</li>
        </ol>
    </div>
</div>
<section class="panel">
    <div class="panel-heading">
        Exam Attendance
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
                    <select class="form-control" id="eh_season" name="eh_season" onchange="load_exams(null,null,null,null,null,null);" style="width:100%">
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
        <div class="col-md-3">
            <div class="form-group">
                <label for="eh_course" class="col-md-3 control-label">Course</label>
                <div class="col-md-9">
                    <select class="form-control" id="eh_course" name="eh_course" onchange="load_batches(this.value);" style="width:100%">
                        <option value=""></option>    
                        <?php
                            foreach ($courses as $course) 
                            {
                               echo '<option value="'.$course['id'].'">'.$course['course_code'].' - '.$course['course_name'].'</option>';
                            }
                        ?>        
                    </select>                                           
                </div>                       
            </div>
        </div> 
    </div>
    <br>
    <div class="row">
        <div class="col-md-1" style=""></div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="eh_batch" class="col-md-3 control-label">Batch</label>
                <div class="col-md-9">
                    <select id="eh_batch" class="form-control" style="width:100%" name="eh_batch" onchange="load_years()">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
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
    </div>
    <br/>
    <div class="row">
        <div class="col-md-1" style=""></div>
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
        <div class="col-md-3" style=""></div>
        <div class="col-md-7" style="text-align: right; margin-top: 40px;">
            <div class="form-group" >
                    <input type="radio" name="request_type" class="col-md-1" id="assign_subj" value="1" checked=""><label class="col-md-2 control-label" style="text-align: left;">Assignment Only Subjects</label>

                    <input type="radio" name="request_type" class="col-md-1" id="all_subj" value="2"><label class="col-md-2 control-label" style="text-align: left;">Assignment & Written Subjects</label>

                <button type='button' class='btn btn-primary btn-md' style="margin-top:-5px;" onclick='event.preventDefault();load_schedules();'>Current Students</button>
                <button type='button' class='btn btn-primary btn-md' style="margin-top:-5px;  margin-left: 10px;" onclick='event.preventDefault();load_repeat_schedules();'>Repeat Students</button>
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
            <form class="form-horizontal" role="form" method="post" id="eh_form" autocomplete="off" >
            <input type="hidden" name="ehall" id="ehall">
             <input type="hidden" name="subject_id" id="subject_id">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Index No.</th>
                        <th>Student</th>
                        <th style="text-align:center"><input type="checkbox" id="select_all"/></th>
                    </tr>
                </thead>
                <tbody id="stulistbody">
                    <tr>
                        <td colspan="3">Search for schedule to see students</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-info" id="submitbtn" onclick='return validate()' style="float: right;">Save</button> 
            </form>
            </div>
        </div>
    </div>
    
</section>	

<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">
    
    var repeat_or_not_status = 0; 
    
    //select all checkboxes
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
    
            
    
    function check_all_boxes() {
        var checked = $('#check_all').is(":checked");
        var tr_count = $('#initial_assign_table tbody tr').length;
        for (var i = 0; i < tr_count; i++) {
            $('#check_box_' + i).prop('checked', checked);
        }
    }  
    
    
    
    
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
    
    
    
    

    $(function() {

      $('.list-group-item').on('click', function() {
        $('.glyphicon', this)
          .toggleClass('glyphicon-chevron-right')
          .toggleClass('glyphicon-chevron-down');
      });

    });

    $('#eh_form').bootstrapValidator({
        live : 'enabled',
        message : 'This value is not valid',
        fields :{
        },
        onSuccess: function(e) {
            e.preventDefault();
            update_exam_attendance();
            $("#submitbtn").prop("disabled",false);
        }
    });

    function update_exam_attendance()
    {
        var subject_id = $('#subject_id').val();
        var exam_id = $('#eh_exam').val();
        
        
        $.ajax(
        {
            url : "<?php echo base_url('exam/update_exam_attendance')?>",
            type : 'POST',
            async : true,
            cache: false,
            dataType : 'json',
            data: $('#eh_form').serialize() + "&is_repeat=" + repeat_or_not_status + "&subj=" + subject_id + "&exm=" + exam_id + "",
            success:function(data)
            {
                result_notification(data);
                
                if(repeat_or_not_status == 1){
                    load_repeat_studentlist($('#subject_id').val()); 
                }
                else{
                   load_studentlist($('#subject_id').val()); 
                }
                
                $("#select_all").prop('checked', false);
               
            }
        });
    }
    
    
    
    function load_batches(course_id) {

        $('#eh_batch').find('option').remove().end();
        $('#eh_batch').append('<option value="">---Select Batch---</option>').val('');

        $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': course_id},
            function (data) {

                for (j = 0; j < data.length; j++) {
                    $('#eh_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                }

            },
            "json"
        );
    }
    
    

    function load_years()
    {
        var course = $('#eh_course').val();
        
        $.post("<?php echo base_url('time_table/load_years')?>",{'tt_course':course},
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
                           $('#eh_year').append("<option value='"+(i+1)+"'>"+(i+1)+" Year</option>");
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

    function load_exams(eh_year,eh_semester,eh_course,eh_batch,eh_season,selexm)
    {
        if(eh_course==null)
            eh_course = $('#eh_course').val();

        if(eh_year==null)
            eh_year = $('#eh_year').val();

        if(eh_semester==null)
            eh_semester = $('#eh_semester').val();

        if(eh_batch==null)
            eh_batch = $('#eh_batch').val();
        
        if(eh_season==null)
            eh_season = $('#eh_season').val();

        $.post("<?php echo base_url('exam/load_exams')?>",{'tt_semester':eh_semester,'tt_course':eh_course,'tt_year':eh_year,'tt_batch':eh_batch, 'tt_season':eh_season},
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
        $("#select_all").prop('checked', false);
        repeat_or_not_status = 0;
        
        eh_course   = $('#eh_course').val();
        eh_year     = $('#eh_year').val();
        eh_semester = $('#eh_semester').val();
        eh_exam     = $('#eh_exam').val();
        eh_branch   = $('#eh_branch').val();
        eh_batch    = $('#eh_batch').val();
        eh_season   = $('#eh_season').val();
        var selected_type = $('input[name=request_type]:checked').val();

        $('#stulistbody').empty();
        $('#stulistbody').append("<tr><td colspan='3'>Search students for attendance</td></tr>");
        $('#schedulediv').empty();

        $.post("<?php echo base_url('exam/load_schedules')?>",{'eh_course':eh_course,'eh_batch':eh_batch,'eh_season':eh_season,'eh_year':eh_year,'eh_semester':eh_semester,'eh_exam':eh_exam,'eh_branch':eh_branch,'selected_type':selected_type,'reqby':'attendance'},
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
                    listnewstr = '<div class="just-padding">';
                    for (i = 0; i<data.length; i++) 
                    {
                        schedary = data[i]['schedules'];
                        listnewstr  += '<h4>'+data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+'</h4>';
                        listnewstr  += '<div class="list-group list-group-root well">';

                        if(schedary.length>0)
                        {
                            for (x = 0; x<schedary.length; x++) 
                            {
                                displaytxt = '[ '+schedary[x]['code']+' ] '+schedary[x]['subject']+' - '+schedary[x]['name']+' ( '+schedary[x]['esch_date']+' / '+schedary[x]['esch_stime']+' - '+schedary[x]['esch_etime']+' )';

                                listnewstr += '<a href="#item_'+schedary[x]['esch_id']+'" class="list-group-item"  id="attend_subject_'+schedary[x]['esch_subject']+'" onclick="load_studentlist('+schedary[x]['esch_subject']+'); highlight_subject('+schedary[x]['esch_subject']+');">';
                                listnewstr += '<i class="glyphicon glyphicon-chevron-right"></i>'+displaytxt;
                                listnewstr += '</a>'; 
                                listnewstr += '<div class="list-group collapse" id="item_'+schedary[x]['esch_id']+'">';

                                if(schedary[x]['halls'].length>0)
                                { 
                                    for (y = 0; y<schedary[x]['halls'].length; y++) 
                                    {
                                        listnewstr += '<a href="#" class="list-group-item" data-toggle="collapse" onclick="load_studentlist('+schedary[x]['halls'][y]['ehall_id']+')">';
                                        listnewstr += schedary[x]['halls'][y]['hall_name'];
                                        listnewstr += '</a>';
                                    }
                                }

                                listnewstr += '</div>';
                            }
                        }
                        else
                        {
                            listnewstr += '<a href="#" class="list-group-item list-group-item-danger">No Schedule Found</a>';
                        }

                        listnewstr  += '</div>';
                    }

                    listnewstr += '</div>';

                    $('#schedulediv').append(listnewstr);
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
    
    
    
    function load_repeat_schedules()
    {
        $('.se-pre-con').fadeIn('slow');
        $("#select_all").prop('checked', false);
        repeat_or_not_status = 1;
        
        eh_course   = $('#eh_course').val();
        eh_year     = $('#eh_year').val();
        eh_semester = $('#eh_semester').val();
        eh_exam     = $('#eh_exam').val();
        eh_branch   = $('#eh_branch').val();
        eh_batch    = $('#eh_batch').val();
        eh_season   = $('#eh_season').val();
        var selected_type = $('input[name=request_type]:checked').val();

        $('#stulistbody').empty();
        $('#stulistbody').append("<tr><td colspan='3'>Search students for attendance</td></tr>");
        $('#schedulediv').empty();

        $.post("<?php echo base_url('exam/load_schedules')?>",{'eh_course':eh_course,'eh_batch':eh_batch,'eh_season':eh_season,'eh_year':eh_year,'eh_semester':eh_semester,'eh_exam':eh_exam,'eh_branch':eh_branch,'selected_type':selected_type,'reqby':'attendance'},
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
                    listnewstr = '<div class="just-padding">';
                    for (i = 0; i<data.length; i++) 
                    {
                        schedary = data[i]['schedules'];
                        listnewstr  += '<h4>'+data[i]['ttbl_code']+' - '+data[i]['ttbl_description']+'</h4>';
                        listnewstr  += '<div class="list-group list-group-root well">';

                        if(schedary.length>0)
                        {
                            for (x = 0; x<schedary.length; x++) 
                            {
                                displaytxt = '[ '+schedary[x]['code']+' ] '+schedary[x]['subject']+' - '+schedary[x]['name']+' ( '+schedary[x]['esch_date']+' / '+schedary[x]['esch_stime']+' - '+schedary[x]['esch_etime']+' )';

                                listnewstr += '<a href="#item_'+schedary[x]['esch_id']+'" class="list-group-item"  id="attend_rpt_subject_'+schedary[x]['esch_subject']+'" onclick="load_repeat_studentlist('+schedary[x]['esch_subject']+'); highlight_rpt_subject('+schedary[x]['esch_subject']+');">';
                                listnewstr += '<i class="glyphicon glyphicon-chevron-right"></i>'+displaytxt;
                                listnewstr += '</a>'; 
                                listnewstr += '<div class="list-group collapse" id="item_'+schedary[x]['esch_id']+'">';

                                if(schedary[x]['halls'].length>0)
                                { 
                                    for (y = 0; y<schedary[x]['halls'].length; y++) 
                                    {
                                        listnewstr += '<a href="#" class="list-group-item" data-toggle="collapse" onclick="load_repeat_studentlist('+schedary[x]['halls'][y]['ehall_id']+')">';
                                        listnewstr += schedary[x]['halls'][y]['hall_name'];
                                        listnewstr += '</a>';
                                    }
                                }

                                listnewstr += '</div>';
                            }
                        }
                        else
                        {
                            listnewstr += '<a href="#" class="list-group-item list-group-item-danger">No Schedule Found</a>';
                        }

                        listnewstr  += '</div>';
                    }

                    listnewstr += '</div>';

                    $('#schedulediv').append(listnewstr);
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
    
    
    function validate(form) {
        var checkboxs = document.getElementsByName("hallstudent[]");
        var okay = false;
        for (var i = 0, l = checkboxs.length; i < l; i++) {
            if (checkboxs[i].checked) {
                okay = true;
                break;
            }
        }
        if (okay) return true;
        else {
            //alert("Please select atleast one student");
            funcres = {status:"worning", message:"Please select student before submit."};
            result_notification(funcres);
            return false;
        }
    }
    
    
    
    
    

    function load_studentlist(subject_id)
    {
        $('.se-pre-con').fadeIn('slow');
        $('#stulistbody').empty();
        $("#select_all").prop('checked', false);
       // $('#ehall').val(id);
       $('#subject_id').val(subject_id);
      var exam_id=$('#eh_exam').val();
      var center_id = $('#eh_branch').val();
      var batch_id = $('#eh_batch').val();

        $.post("<?php echo base_url('exam/load_student_subjectwise')?>",{'id':subject_id,'exam_id':exam_id, 'center_id':center_id, 'batch_id':batch_id},
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
                    for (x = 0; x<data.length; x++) 
                    {
                        isattend = '';
                        if(data[x]['is_attend'] == 1)
                        {
                            isattend = 'checked';
                        }
                        $('#stulistbody').append('<tr><td>'+data[x]['reg_no']+'</td><td>'+data[x]['first_name']+'</td><td align="center"><input type="checkbox" class="checkbox" name="hallstudent[]" value="'+data[x]['id']+'" '+isattend+'></td></tr>');
                    }
                }
                else
                {
                    $('#stulistbody').append('<tr><td colspan="3" align="center">No students for the schedule</td></tr>');
                }
            $('.se-pre-con').fadeOut('slow');    
            }
        },  
        "json"
        );
    }
    
    
    
    function highlight_subject(subj_id){
    
        $("#schedulediv a").each(function(i){
            $('#'+this.id).css('background', '');
        });
        $('#attend_subject_'+subj_id).css('background', '#51af17');
    }
    
    
    function load_repeat_studentlist(subject_id)
    {
        $('.se-pre-con').fadeIn('slow');
        $('#stulistbody').empty();
        $("#select_all").prop('checked', false);
       // $('#ehall').val(id);
       $('#subject_id').val(subject_id);
      var exam_id=$('#eh_exam').val();
      var center_id = $('#eh_branch').val();
      var batch_id = $('#eh_batch').val();

        $.post("<?php echo base_url('exam/load_repeat_student_subjectwise')?>",{'id':subject_id,'exam_id':exam_id, 'center_id':center_id, 'batch_id':batch_id},
        function(data)
        {
            
            console.log(data);
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
                    for (x = 0; x<data.length; x++) 
                    {
                        isattend = '';
                        if(data[x]['is_attend'] == 1)
                        {
                            isattend = 'checked';
                        }
                        $('#stulistbody').append('<tr><td>'+data[x]['reg_no']+'</td><td>'+data[x]['first_name']+'</td><td align="center"><input type="checkbox" class="checkbox" name="hallstudent[]" value="'+data[x]['exm_semester_exam_details_repeat_id']+'" '+isattend+'></td></tr>');
                    }
                }
                else
                {
                    $('#stulistbody').append('<tr><td colspan="3" align="center">No students for the schedule</td></tr>');
                }
            $('.se-pre-con').fadeOut('slow');    
            }
        },  
        "json"
        );
    }
    
    
    function highlight_rpt_subject(subj_id){
    
        $("#schedulediv a").each(function(i){
            $('#'+this.id).css('background', '');
        });
        $('#attend_rpt_subject_'+subj_id).css('background', '#51af17');
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

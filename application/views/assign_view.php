<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STAFF</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-bank"></i>Assign</li>
        </ol>
    </div>
</div>
<?php if($view == 'hod_view'){ ?>
<div class="row" id="hod_view">
    <div class="col-md-6">
        <div class="panel">
            <header class="panel-heading">
                Assign Subjects
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" name="assign_form" id="assign_form" role="form" method="post" action="<?php echo base_url('staff/save_assign_dummy') ?>" id="lec_assign" autocomplete="off" novalidate>
                        <input type="hidden" id="assign_id" name="assign_id">
                        <input type="hidden" id="lecturer_id" name="lecturer_id">
                        <input type="hidden" id="course_id" name="course_id">
                        <br>
                         <div class="form-group">
                           <label class="col-md-3 control-label">Center :</label>
                            <div class="col-md-7">
                                    <?php
                                    global $branchdrop;
                                    global $selectedbr;
                                    $extraattrs = 'id="prom_centre" class="form-control" style="width:100%" onchange="get_courses(this.value, null); load_lecturers(this.value,null);" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                    echo form_dropdown('prom_centre', $branchdrop, $selectedbr, $extraattrs);
                                    ?>
                            </div> 
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label">Course :</label>
                            <div class="col-md-7">
                                    <select class="form-control" id="subject_course" name="subject_course"
                                            onchange="subject_load(this.value);get_course_year(this.value, null);"
                                            data-validation="required" data-validation-error-msg-required="Field can not be empty" 
                                            style="width:100%">
                                        <option value="">---Select Course---</option>
                                    </select>
                            </div> 
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label">Year :</label>
                            <div class="col-md-7">
                                    <select class="form-control" id="year_subject" name="year_subject"
                                            onchange="load_semesters(this.value);"
                                            data-validation="" data-validation-error-msg-required="Field can not be empty" 
                                            style="width:100%">
                                        <option value="">---Select Year---</option>
                                    </select>
                            </div> 
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label">Semester :</label>
                            <div class="col-md-7">
                                    <select class="form-control" id="semester_subject" name="semester_subject"
                                            onchange="load_subjects_to_assign_staff();"
                                            data-validation="" data-validation-error-msg-required="Field can not be empty" 
                                            style="width:100%">
                                        <option value="">---Select Semester---</option>
                                    </select>
                            </div> 
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Subject :</label>
                            <div class="col-md-5">
                                <select class="form-control col-md-1" data-validation="" data-validation-error-msg-required="Field is empty" name="aiisigning_subjects" id="aiisigning_subjects" onchange="">
                                    <option value="">Select Subject</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <button type="button" id="clone_add" name="clone_add" class="btn btn-warning btn-sm" name="submit" onclick="check_same_subject_dummy();">Add</button>
                            </div>
                        </div>
                       
<!--                        <hr>-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lecturer :</label>
                            <div class="col-md-5">
                                <select type="text" class="form-control" id="load_lecturer" name="lecturer"
                                            data-validation="required" data-validation-error-msg-required="Field can not be empty"
                                            value="">
                                        <option value="">---Select Lecturer---</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Type :</label>
                            <div class="col-md">
                                <input type="radio" name="lecturer_type" class="col-md-1" id="permanent_type" value="1" checked="checked" onchange="">
                                <label class="col-md-3 control-label">Full Time</label>
                            </div>
                            <div class="col-md">
                                <input type="radio" name="lecturer_type" class="col-md-1" id="visiting_type" value="2"  onchange="">
                                <label class="col-md-3 control-label">Visiting</label>
                            </div>
                        </div>
                        
                        
                        
                        <table class="table table-bordered exam_marks_tbl" id="assign_sub_tbl">
                            <thead id="">
                            <tr>
                                <th>Subject</th>
                                <th>Teaching Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="assign_sub_tbl_body">
                            </tbody>
                        </table>
                        
                        
                        
                        
<!--                        <div class="form-group">
                            <div class="clone_div" id="clone_div">
                                <div id="clonedInput1" class="clonedInput row">
                                    <input type="hidden" name="ssubid[]" id="ssubid">
                                    <input type="hidden" name="pre_subject[]" id="pre_subject">
                                    <label class="col-md-1 control-label">Subject:</label>
                                    <div class="col-md-5">
                                        <select class="form-control col-md-1" data-validation="required" data-validation-error-msg-required="Field is empty" name="subjects[]" id="subjects" onchange="check_same_subject(this.value, this.id);">
                                            <option value="">Select Subject</option>
                                            
                                        </select>
                                    </div>
                                    <label class="col-md-1 control-label">Hourly Rate:</label>
                                    <div class="col-md-3">
                                        <input type="text" height="70"  class="form-control" id="hourly_rate" name="hourly_rate[]"  data-validation="" data-validation-error-msg-required="Field is empty">
                                    </div>
                                    <div class="col-md-21">
                                        <span class="button-group">
                                            <button onclick="cloning(null, null)" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                            <button type="button" name = "remove_entry[]" class="btn btn-default btn-xs remove_entry"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </div>                          
                        </div>-->
                        <br>
                        <div class="form-group">
                            <div class="col-md-3">
                            </div>
                            <button type="submit" class="btn btn-info btn-md" name="submit" >Submit</button>
                            <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_id();">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <header class="panel-heading">
                Look Up
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="assign_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr bgcolor="#F0F8FF">
                                <th>#</th>
                                <th>Course</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($lecture_subjects)) {
                                foreach ($lecture_subjects as $row) {
                                    ?>
                                    <tr>
                                        <th><?php echo $row['assign_id'] ?></th>
                                        <th><?php echo $row['course_code'] ?></th>
                                        <th><?php echo $row['stf_fname'] . " " . $row['stf_lname'] ?></th>
                                        <th>
                                            <button type="button" class="btn btn-info btn-xs" onclick="edit_assign_load_dummy(<?php echo $row['assign_id'] ?>, <?php echo $row['stf_id'] ?>, <?php echo $row['course_id'] ?>)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                            <?php if ($row['assign_deleted']) { ?>
                                                <button type="button" class="btn btn-success btn-xs" onclick="change_status('<?php print_r($row['assign_id']) ?>', '0')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></th>
                                        <?php } else { ?>
                                    <button type="button" class="btn btn-warning btn-xs" onclick="change_status('<?php print_r($row['assign_id']) ?>', '1')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                    <?php } ?>
                                </th>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        </tbody>
                    </table>       
                </div>
            </div>    
        </div>
    </div>
    

</div>
<?php }else if($view == 'admin_view'){?>
<div class="row" id="admin_view">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading">
                Assign Subjects
            </header>
            <div class="panel-body">
                <h4 style="color: #990000">Please Login as HOD to assign Subjects</h4>
                <hr/>
                
                <div class="form-group col-md-5">
                    <label class="col-md-3 control-label">Center :</label>
                     <div class="col-md-7">
                             <?php
                             global $branchdrop;
                             global $selectedbr;
                             $extraattrs = 'id="prom_centre_lookup" class="form-control" style="width:100%" onchange=" load_lecturers(this.value,null);"';
                             echo form_dropdown('prom_centre_lookup', $branchdrop, $selectedbr, $extraattrs);
                             ?>
                     </div> 
                 </div>
                <div class="form-group col-md-5">
                    <label class="col-md-3 control-label">Lecturer :</label>
                     <div class="col-md-7">
                        <select type="text" class="form-control" id="lecturer_lookup" name="lecturer_lookup"
                                    data-validation="required" data-validation-error-msg-required="Field can not be empty"
                                    value="" style="width:100%">
                                <option value="">---Select Lecturer---</option>
                        </select>
                     </div> 
                 </div>
                <input type="button" value="Search" class="btn btn-info btn-md" onclick="load_lecturer_details()">

                <div><br/><br/>
                    <div class="col-md-offset-2 col-md-8">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject Code</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Teaching Type</th>
                              </tr>
                            </thead>
                            <tbody id="sub_table_body">
                                <tr>
                                    <th colspan="4">No Data to show</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<div></div>
<?php } ?>

<script>

    
    $.validate({
        form: '#assign_form'
    });
    
    var flag = '';
    var sub_id = null;
    $(document).ready(function(){
        
            
        $('#assign_look').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10]
        });
        
        $('#admin_table').DataTable({
            'ordering': true,
            'lengthMenu': [10, 20]
        });
        
        
        
        var promCourse = $('#prom_centre').val();
        if(promCourse != ""){
            get_courses(promCourse);
            load_lecturers(promCourse,null);
        }
       
//       var load_course = $('#subject_course').val(); 
//       if(load_course != ""){
//           get_course_year(load_course,null);
//       }
        
    });

    var cloneid = 0;

    function cloning(subject_id, hourly_rate)
    {
        cloneid += 1;
        var container = document.getElementById('clone_div');
        var clone = $('#clonedInput1').clone();

        clone.find('#subjects').attr("class", "form-control temprw");
        
        clone.find('#pre_subject').attr('name', 'pre_subject[]');
        
        if (subject_id != null) {
            flag = 'edit';
            
            clone.find('#subjects').val(subject_id);
            clone.find('#subjects').attr('name', 'subjects[]');
            clone.find('#subjects').attr('id', 'subjects' + cloneid + '');
            clone.find('#hourly_rate').val(hourly_rate);
            clone.find('#hourly_rate').attr('name', 'hourly_rate[]');
            clone.find('#hourly_rate').attr('id', 'hourly_rate' + cloneid + '');
            
            clone.find('#pre_subject').val(subject_id);
            clone.find('#pre_subject').attr('id', 'pre_subject' + cloneid + '');
    
        } else {
            clone.find('#subjects').val('');
            clone.find('#subjects').attr('name', 'subjects[]');
            clone.find('#subjects').attr('id', 'subjects' + cloneid + '');
            clone.find('#hourly_rate').val('');
            clone.find('#hourly_rate').attr('name', 'hourly_rate[]');
            clone.find('#hourly_rate').attr('id', 'hourly_rate' + cloneid + '');
            
            clone.find('#pre_subject').val('');
        }

        clone.find('.remove_entry').attr('id', cloneid);
        clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();');

        $('.clone_div').append(clone);
    }

    cloneid2 = 0;
    function cloning2($quali_id)
    {
        cloneid2 += 1;
        var container = document.getElementById('clone_div2');
        var clone = $('#clonedInput2').clone();

        clone.find('#qualifications').attr("class", "form-control temprw");
        if ($quali_id != null) {
            clone.find('#qualifications').val($quali_id);
            clone.find('#qualifications').attr('name', 'qualifications[]');
            clone.find('#qualifications').attr('id', 'qualifications' + cloneid2 + '');
        } else {
            clone.find('#qualifications').val('');
            clone.find('#qualifications').attr('name', 'qualifications[]');
            clone.find('#qualifications').attr('id', 'qualifications' + cloneid2 + '');
        }

        clone.find('.remove_entry').attr('id', $quali_id);
        clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();');

        $('.clone_div2').append(clone);
    }

    function edit_assign_load(assign_id, lecturer_id,course_id) {
        $(".temprw").each(function (index) {
            $(this).parents(".clonedInput").remove();
        });

        cloneid = 0;

        $('#subject').val('');
        $('#subject').attr('name', 'subject[]');
        $('#hourly_rate').val('');
        $('#hourly_rate').attr('name', 'hourly_rate[]');
        $('#pre_subject').val('');
        $('#pre_subject').attr('name', 'pre_subject[]');

        $.post("<?php echo base_url('staff/edit_assign_load') ?>", {"assign_id": assign_id, "lecturer_id": lecturer_id, "course_id":course_id},
        function (data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                console.info(data);
                $('#assign_id').val(data['assign']['id']);
                get_courses(data['assign']['center_id']);
                load_lecturers(data['assign']['center_id'],lecturer_id);
                $('#load_lecturer').prop('disabled', true);
                $('#prom_centre').prop('disabled', true);
                $('#subject_course').prop('disabled', true);
                $('#load_lecturer').val(data['assign']['lecturer_id']);
                $('#lecturer_id').val(data['assign']['lecturer_id']);
                $('#course_id').val(data['assign']['course_id']);


                for (i = 0; i < data['subjects'].length; i++)
                {
                    if (i == 0) {
                        sub_id = data['subjects'][i]['subject_id'];
                        $('#subjects').val(data['subjects'][i]['subject_id']);
                        $('#subjects').attr('name', 'subjects[]');

                        $('#hourly_rate').val(data['subjects'][i]['hourly_rate']);
                        $('#hourly_rate').attr('name', 'hourly_rate[]');
                        
                        $('#pre_subject').attr('name', 'pre_subject[]');
                        $('#pre_subject').val(data['subjects'][i]['subject_id']);
                    } else {
                        // alert("to clone");
                        cloning(data['subjects'][i]['subject_id'], data['subjects'][i]['hourly_rate']);
                    }
                }

//                for (i = 0; i < data['qualifications'].length; i++)
//                {
//                    if (i == 0) {
//                        $('#qualifications').val(data['qualifications'][i]['qualification_id']);
//                        $('#qualifications').attr('name', 'qualifications[]');
//                    } else {
//                        cloning2(data['qualifications'][i]['qualification_id']);
//                    }
//                }
            }
        },
        "json"
        );
    }

    function reset_id() {
        $(".temprw").each(function (index) {
            $(this).parents(".clonedInput").remove();
        });
        
//        $(".temprw").each(function (index) {
//            $(this).parents(".clonedInput2").remove();
//        });

        $('#assign_id').val('');
        $('#load_lecturer').prop('disabled', false);
        $('#pre_subject').val("");
        
        flag = '';
        cloneid = 0;

        $('#year_subject').val("");
        $('#semester_subject').val("");
        $('#aiisigning_subjects').val("");
        $('#load_lecturer').val("");
        $("#assign_sub_tbl  > tbody  > tr").remove();
    }

    function change_status(assign_id, new_status) {
        $.post("<?php echo base_url('staff/change_assign_status') ?>", {"assign_id": assign_id, "new_status": new_status},
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

    function check_same_qualification(value, id) {
        var resq = [];
        if (id.length > 13) {
            var number = id.substring(14);
            for (i = 0; i <= cloneid2; i++) {
                if (i === 0) {
                    var val = document.getElementById("qualifications").value;
                } else {
                    var val = document.getElementById("qualifications" + i).value;
                }
                if (val === value) {
                    if (number != i) {
                        document.getElementById('qualifications' + number).value = '';
                        resq['status'] = 'denied';
                        resq['message'] = 'Do not select the same qualification twice';
                        result_notification(resq);
                        break;
                    }
                }
            }
        } else {
            for (i = 0; i < cloneid2; i++) {
                if (i !== 0) {
                    var val = document.getElementById("qualifications" + i).value;
                }
                if (val === value) {
                    document.getElementById('qualifications').value = '';
                    resq['status'] = 'denied';
                    resq['message'] = 'Do not select the same qualification twice';
                    result_notification(resq);
                    break;
                }
            }
        }
    }

    function check_same_subject(value, id) {
 
        var res = [];
        if (id.length > 7) {
            var number = id.substring(8);
            for (i = 0; i <= cloneid; i++) {
                if (i === 0) {
                    var val = document.getElementById("subjects").value;
                } else {
                    var val = document.getElementById("subjects" + i).value;
                }
                
                if (val === value) {
                    if (number != i) {
                        if(flag == 'edit')
                        {
                            document.getElementById('subjects' + number).value = $('#pre_subject' + number).val();
                            res['status'] = 'denied';
                            res['message'] = 'Do not select the same subject twice';
                            result_notification(res);
                            break;
                        }
                        else{
                            document.getElementById('subjects' + number).value = '';
                            res['status'] = 'denied';
                            res['message'] = 'Do not select the same subject twice';
                            result_notification(res);
                            break;
                        }
                    }
                }
            }
        } else {
            for (i = 0; i < cloneid; i++) {
                if (i !== 0) {
                    var val = document.getElementById("subjects" + i).value;
                }
                if (val === value) {
                    document.getElementById('subjects').value = '';
                    res['status'] = 'denied';
                    res['message'] = 'Do not select the same subject twice';
                    result_notification(res);
                    break;
                }
            }
        }
    }
    
    function get_courses(center_id) {
        $('#subject_course').find('option').remove().end().append('<option value="">---Select Course---</option>').val('');
        
        $.post("<?php echo base_url('Staff/load_course_list') ?>", {'center_id': center_id},
            function (data) {
                if(data.length == 1){
                    $('#subject_course').append($("<option></option>").attr("value", data[0]['course_id']).text(data[0]['course_code']+' - '+data[0]['course_name']).attr("selected","selected"));
                    subject_load(data[0]['course_id']);
                    get_course_year(data[0]['course_id']);
                } else {
                    for (var i = 0; i < data.length; i++) {
                        $('#subject_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                    }
                }
            },
            "json"
        );
    }
    
    function load_lecturers(center_id,lecturer_id)
    {       
       $('#load_lecturer').find('option').remove().end().append('<option value="">---Select Lecturer---</option>').val('');
       $('#lecturer_lookup').find('option').remove().end().append('<option value="">---Select Lecturer---</option>').val('');
       
        
        $.post("<?php echo base_url('Staff/load_lecturers_for_center') ?>", {'center_id': center_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    if(lecturer_id == data[i]['stf_id'] ){
                        $('#load_lecturer').append($("<option></option>").attr("value", data[i]['stf_id']).text(data[i]['title_name']+' '+data[i]['stf_fname']+' '+data[i]['stf_lname']).attr("selected","selected"));
                    } else {
                        $('#load_lecturer').append($("<option></option>").attr("value", data[i]['stf_id']).text(data[i]['title_name']+' '+data[i]['stf_fname']+' '+data[i]['stf_lname']));
                        $('#lecturer_lookup').append($("<option></option>").attr("value", data[i]['stf_id']).text(data[i]['title_name']+' '+data[i]['stf_fname']+' '+data[i]['stf_lname']));
                    }
                }
            },
            "json"
        ); 
    }
    
    function subject_load(course_id){
        if(course_id == null){
            course_id = $('#subject_course').val();
        } 
        
        $('#subjects').find('option').remove().end().append('<option value="">Select Subject</option>').val('');
        $.post("<?php echo base_url('Staff/load_subjectss_for_course_details') ?>", {'course_id': course_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    if(sub_id == data[i]['subject_id'] ){
                        $('#subjects').append($("<option></option>").attr("value", data[i]['subject_id']).text(data[i]['code']+'-'+data[i]['subject']).attr("selected","selected"));
                    } else {
                        $('#subjects').append($("<option></option>").attr("value", data[i]['subject_id']).text(data[i]['code']+'-'+data[i]['subject']));
                    }
                    
                }
            },
            "json"
        ); 
    }
    
    function load_lecturer_details(){
        var center_id = $('#prom_centre_lookup').val();
        var lecturer_id = $('#lecturer_lookup').val();
        
        $.post("<?php echo base_url('Staff/load_subjects_lecturers') ?>", {'center_id': center_id, 'lecturer_id':lecturer_id},
            function (data) {
                $('#sub_table_body').empty();
                if(data.length == 0){
                    $('#sub_table_body').append('<tr><th colspan="4">No Data to show</th><tr>');
                } else {
                    for (j = 0; j < data.length; j++) {
                        $('#sub_table_body').append('<tr style="background-color: khaki"><th colspan="4">'+data[j]['course']['course_code']+' - '+data[j]['course']['course_name']+'</th></tr>');
                        for(k = 0; k < data[j]['subjects'].length; k++){
                            
                            if(data[j]['subjects'][k]['lecturer_type'] == 1){
                                var lec_type = 'Permanent';
                            }else{
                                var lec_type = 'Visiting';
                            }
                            $('#sub_table_body').append('<tr><td>'+(k+1)+'</td><td>'+data[j]['subjects'][k]['sub_code']+'</td><td>'+data[j]['subjects'][k]['sub_name']+'</td><td>'+lec_type+'</td></tr>');
                        }
                    }
                }
            },
            "json"
        ); 
    }
    
/////////////////////////////////////////////////////////////////////////////
function get_course_year(course_id, flag, year_no, batch_id) {
        $('#year_subject').find('option').remove().end().append('<option value="">------Select Year-----</option>').val('');
      
        $.post("<?php echo base_url('course/get_course') ?>", {'id': course_id},
            function (data) {
                if (data != null) {
                    for (var i = 1; i <= data['no_of_year']; i++) {
                        if (flag) {
                            if (i == year_no) {
                                $('#year_subject').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                            } else {
                                $('#year_subject').append($("<option></option>").attr("value", i).text(i+" Year"));
                            }
                        } else {
                            $('#year_subject').append($("<option></option>").attr("value", i).text(i+" Year"));
                            
                        }
                    }
                }


            },
            "json"
        );
    }
    
function load_semesters(year_no, semester_no) {
    $('#semester_subject').find('option').remove().end().append('<option value="">-----Select Semester-----</option>').val('');

    var course_id = $('#subject_course').val();

    $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
        function (data) {
            for (var i = 1; i <= data; i++) {
                if (semester_no == i) {
                    $('#semester_subject').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                } else {
                    $('#semester_subject').append($("<option></option>").attr("value", i).text(i+" Semester"));
                }
            }
        },
        "json"
    );
}

function load_subjects_to_assign_staff(){
        
        var course_id   = $('#subject_course').val();
        var year_id     = $('#year_subject').val();
        var semester_id = $('#semester_subject').val();
        
        
        
        $('#aiisigning_subjects').find('option').remove().end().append('<option value="">Select Subject</option>').val('');
        $.post("<?php echo base_url('Staff/load_subjects_to_assign_staff') ?>", {'course_id': course_id,'year_id':year_id,'semester_id':semester_id},
            function (data) {
                for (var i = 0; i < data.length; i++) {
                    if(sub_id == data[i]['subject_id'] ){
                        $('#aiisigning_subjects').append($("<option></option>").attr("value", data[i]['subject_id']).text(data[i]['code']+'-'+data[i]['subject']).attr("selected","selected"));
                    } else {
                        $('#aiisigning_subjects').append($("<option></option>").attr("value", data[i]['subject_id']).text(data[i]['code']+'-'+data[i]['subject']));
                    }
                    
                }
            },
            "json"
        ); 
    }

//function clone_subject(){
//    var elmnt = document.getElementById("dataRow").lastChild;
//    var cln = elmnt.cloneNode(true);
//    document.body.appendChild(cln);
//    
////    var itm = document.getElementById("dataRow").lastChild;
////    var cln = itm.cloneNode(true);
////    document.getElementById("assign_sub_tbl_body").appendChild(cln);
//}

$("#clone_add").click(function () {
    var subject = $('#aiisigning_subjects').find('option:selected').text();
    var tbl_sub_id = $('#aiisigning_subjects').val();
    var teachtype = $('input[name=lecturer_type]:checked').val();
    
//    var table = document.getElementById('assign_sub_tbl');
//
//    var rowLength = table.rows.length;
//
//    for(var i=0; i<rowLength; i+=1){
//        var row = table.rows[i];
//        
//        if (i === 0) {
//            var val = document.getElementById("subject_input_").value;
//        } else {
//            var val = document.getElementById("subject_input_'+tbl_sub_id+'" + i).value;
//        }
//    }
         var exist_flag = false;
        $('#assign_sub_tbl > tbody  > tr').each(function (i, row) {
//            console.log(i);
//            console.log($(this).find('#subject_input_'+tbl_sub_id).val());
            
            if($(this).find('#subject_input_'+tbl_sub_id).val()){
                exist_flag = true;
            } 
        });
    
    
    if(exist_flag == true){
        funcres = {status:"denied", message:"Same Subject cannot be selected"};
        result_notification(funcres);
    } else {
        //    var rowNum;
        cloneid += 1;

        if(teachtype == 1){
            var type_text = 'Permanent';
        }else{
            var type_text = 'Visiting';
        }

        if(tbl_sub_id == ""){
            alert("please select a subject");
        }else{
            $('#assign_sub_tbl_body').append('<tr id="row_'+tbl_sub_id+'"><td id="decription_'+tbl_sub_id+'">'+subject+'<input type="text" name="subject_input[]" id="subject_input_'+tbl_sub_id+'" value="'+tbl_sub_id+'" hidden></td><td id="teach_type_'+cloneid+'">'+type_text+'<input type="text" name="lecture_type_input[]" value="'+teachtype+'" hidden></td><td id="delete_'+tbl_sub_id+'"><button class="btn btn-danger btn-sm" name="" onclick="delete_row('+tbl_sub_id+')">Delete</button></td</tr>');
        }
    }
    
    

});

function delete_row(id){
    $('#row_'+id).remove();
}


function edit_assign_load_dummy(assign_id, lecturer_id,course_id) {
//        $(".temprw").each(function (index) {
//            $(this).parents(".clonedInput").remove();
//        });
//
//        cloneid = 0;
//
//        $('#subject').val('');
//        $('#subject').attr('name', 'subject[]');
//        $('#hourly_rate').val('');
//        $('#hourly_rate').attr('name', 'hourly_rate[]');
//        $('#pre_subject').val('');
//        $('#pre_subject').attr('name', 'pre_subject[]');

        $.post("<?php echo base_url('staff/edit_assign_load') ?>", {"assign_id": assign_id, "lecturer_id": lecturer_id, "course_id":course_id},
        function (data)
        {
            if(data == 'denied')
            {
                funcres = {status:"denied", message:"You have no right to proceed the action"};
                result_notification(funcres);
            }
            else
            {
                $("#assign_sub_tbl  > tbody  > tr").remove();
//                console.info(data);
                $('#assign_id').val(data['assign']['id']);
                get_courses(data['assign']['center_id']);
                load_lecturers(data['assign']['center_id'],lecturer_id);
                $('#load_lecturer').prop('disabled', true);
                $('#prom_centre').prop('disabled', true);
//                $('#subject_course').prop('disabled', true);
                $('#load_lecturer').val(data['assign']['lecturer_id']);
                $('#lecturer_id').val(data['assign']['lecturer_id']);
                $('#course_id').val(data['assign']['course_id']);

//                cloneid += 1;
//                var tbl_sub_id;
                var lec_type;
                for (i = 0; i < data['subjects'].length; i++)
                {
                    if(data['subjects'][i]['lecturer_type'] == 1){
                        lec_type = 'Permanent';
                    }else{
                        lec_type = 'Visiting';
                    }
                    
                    var tbl_sub_id = data['subjects'][i]['subject_id'];
                    $('#assign_sub_tbl_body').append('<tr id="row_'+data['subjects'][i]['subject_id']+'"><td id="decription_'+data['subjects'][i]['subject_id']+'">'+data['subjects'][i]['code']+' - '+data['subjects'][i]['subject']+'<input type="text" name="subject_input[]" id="subject_input_'+tbl_sub_id+'" value="'+data['subjects'][i]['subject_id']+'" hidden></td><td id="teach_type_'+cloneid+'">'+lec_type+'<input type="text" name="lecture_type_input[]" value="'+data['subjects'][i]['lecturer_type']+'" hidden></td><td id="delete_'+data['subjects'][i]['subject_id']+'"><button class="btn btn-danger btn-sm" name="" onclick="delete_row('+data['subjects'][i]['subject_id']+')">Delete</button></td</tr>');
                    
                }

//                for (i = 0; i < data['qualifications'].length; i++)
//                {
//                    if (i == 0) {
//                        $('#qualifications').val(data['qualifications'][i]['qualification_id']);
//                        $('#qualifications').attr('name', 'qualifications[]');
//                    } else {
//                        cloning2(data['qualifications'][i]['qualification_id']);
//                    }
//                }
            }
        },
        "json"
        );
    }

function check_same_subject_dummy() {
    
 
 
 
 
 
//        var res = [];
//        if (id.length > 7) {
//            var number = id.substring(8);
//            for (i = 0; i <= cloneid; i++) {
//                if (i === 0) {
//                    var val = document.getElementById("subjects").value;
//                } else {
//                    var val = document.getElementById("subjects" + i).value;
//                }
//                
//                if (val === value) {
//                    if (number != i) {
//                        if(flag == 'edit')
//                        {
//                            document.getElementById('subjects' + number).value = $('#pre_subject' + number).val();
//                            res['status'] = 'denied';
//                            res['message'] = 'Do not select the same subject twice';
//                            result_notification(res);
//                            break;
//                        }
//                        else{
//                            document.getElementById('subjects' + number).value = '';
//                            res['status'] = 'denied';
//                            res['message'] = 'Do not select the same subject twice';
//                            result_notification(res);
//                            break;
//                        }
//                    }
//                }
//            }
//        } else {
//            for (i = 0; i < cloneid; i++) {
//                if (i !== 0) {
//                    var val = document.getElementById("subjects" + i).value;
//                }
//                if (val === value) {
//                    document.getElementById('subjects').value = '';
//                    res['status'] = 'denied';
//                    res['message'] = 'Do not select the same subject twice';
//                    result_notification(res);
//                    break;
//                }
//            }
//        }
    }
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<style>
    /* Center the loader */
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
    }

    #myDiv {
        display: none;
        text-align: center;
    }
</style>
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> Script View </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Script View</li>

        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#bulk_subject" href="#bulk_subject" aria-controls="bulk_subject" role="tab" data-toggle="tab">Bulk Subject Selection</a></li>
    <li role="presentation"><a id="#new" href="#new" aria-controls="new" role="tab" data-toggle="tab">new</a></li>
</ul>
<div class="tab-content"> 
    <div role="tabpanel" class="tab-pane active" id="bulk_subject">
        <section class="panel">
            <header class="panel-heading">
                Student Bulk Subject Selection as support for SLIATE
            </header>
            <div class="panel-body">
                 <div class="col-md-6">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="center" class="col-md-3 control-label">Center:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value);">
                                    <option value="">---Select Center---</option>
                                    <?php
                                    foreach ($centers as $row):
                                        ?>
                                        <option value="<?php echo $row['br_id']; ?>">
                                            <?php echo $row['br_code'] . " - " . $row['br_name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="center" class="col-md-3 control-label">Course:</label>
                            <div class="col-md-9">
                                <select type="text" class="form-control" id="in_course" name="in_course" onchange="get_course_year(this.value)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                    <option value="">---Select Course---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="center" class="col-md-3 control-label">Course Year:</label>
                            <div class="col-md-9">
                                <select type="text" class="form-control" id="no_year" name="no_year" onchange="load_semesters(this.value)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                    <option value="">---Select Year---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br/> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="center" class="col-md-3 control-label">Semester:</label>
                            <div class="col-md-9">
                                <select type="text" class="form-control" id="no_semester" name="no_semester"  required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                    <option value="">---Select Semester---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br/>  
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="center" class="col-md-3 control-label">Batch:</label>
                            <div class="col-md-9">
                                <select type="text" class="form-control" id="in_batch" name="in_batch" onchange="get_student_list(this.value)"  required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                    <option value="">---Select Batch---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><br/>
                
                <div class="col-md-12" id="div_subjects" style="display: none;">
                <div class="form-group">
                    <input type="hidden" id="group_id" name="group_id">
                    <label for="grname" class="col-md-12">Core Subjects</label>
                    <div class="col-md-8">
                        <table class="table">
                            <tbody id="core_subjects" class="core_subjects">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <input type="hidden" id="subj_group" name="subj_group" />
                </div>
                <div class="col-md-6">
                    <table id="stu_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width:100%;">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Reg No</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <input type="button" id="save_btn" disabled class="btn btn-info" onclick="update_bulk_subject_selection()" value="Update Student Subjects"/>
                <i id="spinner_icon" class="fa fa-spinner fa-spin" style="font-size:16px; padding: 5px; display: none"></i>
            </div>
        </section>

    </div>
    <div role="tabpanel" class="tab-pane active" id="new">
        
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#stu_table').DataTable({
            'ordering': true,
            'lengthMenu': [15, 30, 45, 60, 75]
        });

    });

    function load_course_list(center_id)
    {
        $('#in_course').find('option').remove().end();
        $('#in_course').append('<option value="">---Select Course---</option>').val('');

        $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},
                function (data)
                {
                    for (var i = 0; i < data.length; i++)
                    {
                        $('#in_course').append($("<option></option>").attr("value", data[i]['course_id']).text('[' + data[i]['course_code'] + ']-' + data[i]['course_name']));
                    }
                },
                "json"
                );
    }

    function get_course_year(id)
    {
        $('#in_course').val(id);
        $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
        $('#in_batch').find('option').remove().end().append('<option value="">---Select Batch---</option>').val('');
        $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                function (data)
                {
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        if (data != null) {
                            if (typeof data['current_year'] === 'undefined') {
                                for (var i = 1; i <= data['no_of_year']; i++) {
                                    $('#no_year').append($("<option></option>").attr("value", i).text(i));
                                }
                            } else {
                                var current_year = data['current_year'];
                                $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year));
                            }

                            $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                    function (data)
                                    {
                                        if (typeof data['current_year'] === 'undefined') {
                                            for (j = 0; j < data.length; j++) {
                                                $('#in_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            }
                                        } else {
                                            $('#in_batch').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        }
                                    },
                                    "json"
                                    );
                        }
                    }
                },
                "json"
                );
    }
    
    function load_semesters(year_no) 
    {
        $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
        var course_id = $('#in_course').val();
        
        if (course_id == '' || course_id == null) {
            var course_id = $('#course').val();
        }
        $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
                function (data)
                {
                    if(data!=null){
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if(typeof data['current_semester'] ==='undefined' ||data['current_semester']===null ){
                            for (var i = 1; i <= data; i++) {
                                $('#no_semester').append($("<option></option>").attr("value", i).text(i));
                            }
                        }else{

                        var current_semester=data['current_semester'];
                            $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester));
                        }
                    }
                }
                },
                "json"
                );
    }
    
    function get_student_list(batch_id) {
        var dataTable = $('#stu_table').DataTable();
        dataTable.destroy();
        $('#stu_table tbody').empty();
        $('#stu_table').DataTable({
            'ordering': true,
            'lengthMenu': [15, 30, 45, 60, 75]
        });
        var branch = $('#l_center').val();
        var course = $('#in_course').val();
        var year = $('#no_year').val();
        var semester = $('#no_semester').val();
        var status = 0; 
        
        if(branch == '' || year == '' || semester =='' || course== '' ){
            funcres = {status:"denied", message:"Please fill all center, course, year, semester and batch"};
            result_notification(funcres);
        } else {
            load_year_subjects();
            $.post("<?php echo base_url('student/get_student_list_by_level') ?>", {'batch_id': batch_id,'branch': branch, 'year':  year, 'semester':  semester, 'status': status},
                function (data)
                {
                    console.log(data);
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if(data.length == 0){
                            funcres = {status:"denied", message:"No students exists."};
                             result_notification(funcres);
                        } else {
                            var table = $('#stu_table').DataTable();
                            $('#save_btn').prop("disabled", false);
                            for (j = 0; j < data.length; j++) 
                            {
                                table.row.add( [
                                j+1,
                                data[j]['reg_no'],
                                data[j]['first_name']
                            ] ).draw( false );                            
                            }
                        }
                        
                    }
                },
                "json"
                );
        }
            
        
    }
  
    function load_year_subjects() {
        $(".core_subjects").empty();
        
        $("#div_subjects").css("display", "block");
        var course_id = $('#in_course').val();
        var semester_no = $('#no_semester').val();
        var batch_id = $('#in_batch').val();
        var year_no = $('#no_year').val();

        $.post("<?php echo base_url('student/get_semester_subjects') ?>", {'course_id': course_id, 'semester_no': semester_no, 'batch_id': batch_id, 'year_no': year_no},
                function (data)
                {
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if(data.length > 0){
                            for (j = 0; j < data.length; j++) {

                                $('#subj_group').val(data[j]['subject_group_id']);

                                if (data[j]['type'] == 1) {
                                    $("#core_subjects").append("<tr><td><input type='text' name='c_subject[]' id='c_subject' value='" + data[j]['subject_id'] + "'> <input type='hidden' name='c_subject_version[]' id='c_subject_version' value='" + data[j]['version_id'] + "'>" + data[j]['subject'] + "</td></tr>");
                                } 
                            }

                            $('#subject_save').attr('disabled', false);
                        }
                        else{
                            $('#subject_save').attr('disabled', true);
                        }
                    }
                },
                "json"
                );
        
    }

    function update_bulk_subject_selection(){
        var branch = $('#l_center').val();
        var course = $('#in_course').val();
        var year = $('#no_year').val();
        var semester = $('#no_semester').val();
        var subj_group = $('#subj_group').val();
        var batch = $('#in_batch').val();
        var status = 0; 
        
        if(branch == '' || year == '' || semester =='' || course== '' || batch=='' ){
            funcres = {status:"denied", message:"Please fill all center, course, year, semester and batch"};
            result_notification(funcres);
        } else if (subj_group == ''){
            funcres = {status:"denied", message:"Course group is not selected"};
            result_notification(funcres);
        } else {
            $('#spinner_icon').show();
            $.ajax({
              url: "<?php echo base_url('student/save_student_subjects_support') ?>",
              type: 'POST',
              async: true,
              cache: false,
              dataType: 'json',
              data: {'center':branch , 'batch_id':batch , 'no_year':year , 'no_semester':semester, 'course_id':course, 'subj_group':subj_group },
              success: function (data)
              {
                  if (data == 'denied')
                  {
                      funcres = {status: "denied", message: "You have no right to proceed the action"};
                      result_notification(funcres);
                      $('#spinner_icon').hide();
                  } else
                  {
                      result_notification(data);
                      reset_subject_list();
                  }
                  $('#spinner_icon').hide();
              }
          });                           
        }
    }
    
    
    function reset_subject_list(){
    
        $(".core_subjects").empty();
        $("#div_subjects").css("display", "none");
        
        var dataTable = $('#stu_table').DataTable();
        dataTable.destroy();
        $('#stu_table tbody').empty();
        $('#stu_table').DataTable({
            'ordering': true,
            'lengthMenu': [15, 30, 45, 60, 75]
        });
        
        $('#l_center').val('');
        $('#in_course').val('');
        $('#in_course option:not(:first)').remove();
        $('#no_year').val('');
        $('#no_year option:not(:first)').remove();
        $('#no_semester').val('');
        $('#no_semester option:not(:first)').remove();
        $('#in_batch').val('');
        $('#in_batch option:not(:first)').remove();
        
    }
</script>
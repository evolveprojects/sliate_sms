<style>
    .panel-heading, .modal-header{
        background: #3cb5e8b5;
    }
    
    .modal-header h4.modal-title{
        font-weight: bold;
        color: white;
        
    }
    
    .widget .widget-head, .modal-header{
        text-shadow: none;
    }
</style>


<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i>Semester Subjects</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-book"></i>Semester Subjects</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a id="#lookup" href="#lookup" aria-controls="lookup" role="tab" data-toggle="tab">Lookup</a></li>
    <li role="presentation"><a id="#subject_select" href="#subject_select" aria-controls="subject_select" role="tab" data-toggle="tab">Subject Selection</a></li>
</ul>
<div class="tab-content"> 
    <div role="tabpanel" class="tab-pane active" id="lookup">
        <div class="panel">
            <div class="panel-heading">
                Lookup
            </div>
            <br/>
            <form class="form-horizontal" role="form" method="post" id="search_form" autocomplete="off">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="center" class="col-md-3 control-label">Center : </label>
                                <div class="col-md-9">
                                    <?php 
                                        global $branchdrop;
                                        global $selectedbr;
                                        //$extraattrs = 'id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);"';
                                        //echo form_dropdown('l_center',$branchdrop,$selectedbr, $extraattrs); 
                                    ?>
                                    <select class="form-control" id="l_center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 1, null);">
                                    <option value="">---Select center---</option>
                                    <?php
                                        foreach ($centers as $row):
                                            ?>
                                        <option value="<?php echo $row['br_id']; ?>">
                                        <?php echo $row['br_code']." - ".$row['br_name']; ?>
                                        </option>
                                            <?php
                                        endforeach;
                                        ?>
                                </select>  
                                </div>
                            </div>  			
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Course:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Dcode" name="l_Dcode" onchange="get_course_year(this.value, 1, null, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
<!--                                        <option value="">---Select Course---</option>-->
                                        <?php foreach ($all_courses as $course){ ?>
                                        <option value="<?php print_r($course['course_id'])?>"><?php print_r("[".$course['course_code']."]-".$course['course_name']); ?></option>
                                        <?php } ?>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Batch Code:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_Bcode" name="l_Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Batch Code---</option>			
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Year:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_year" name="l_no_year" onchange="load_semesters(this.value, null, 1)" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Year---</option>
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        <div class="form-group col-md-4">							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 control-label">Semester:</label>
                                <div class="col-md-9">
                                    <select type="text" class="form-control" id="l_no_semester" name="l_no_semester" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                        <option value="0">---Select Semester---</option>	
                                    </select>											
                                </div>				         
                            </div>				
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-md" name="search" onclick="search_details(1)">Students Without Subjects</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_details(0);">Search</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table name="student_look" id="student_look" class="table table-striped table-bordered dt-responsive nowrap student_look" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Registration Number</th>
                                    <th>Student Name</th>
                                    <th>NIC</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_body">
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="modal fade bs-example-modal-lg" id="view_selected_subject">
                    <div class="modal-dialog modal-lg" style="width:50%;padding-top:13px">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Selected Subjects</h4>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class='list-group-item'><b>Core Subjects</b></li>
                                    <ul class="list-group model_student_csubjects" id="model_student_csubjects"></ul>
                                </ul>
                                <ul class="list-group">
                                    <li class='list-group-item'><b>Elective Subjects</b></li>
                                    <ul class="list-group model_student_esubjects" id="model_student_esubjects"></ul>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bs-example-modal-lg" id="view_not_selected">
                    <div class="modal-dialog modal-lg" style="width:50%;padding-top:13px">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Students without Subjects</h4>
                            </div>
                            <div class="modal-body">
                                <table id="viewttbl" class="table table-bordered" style="width:100%" cellspacing="0">
                                    <thead id="viewttbl_head">
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="width:14%;text-align: center">Registration Number</th>
                                            <th style="width:14%;text-align: center">Full Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id='viewttbl_body'> 

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="subject_select">
        <div class="row">
            <div class="col-md-12">    
                <div class="panel">
                    <form class="form-horizontal" role="form" method="post" id="grp_form" autocomplete="off">
                        <header class="panel-heading">
                            Subjects Selection
                        </header>
                        <input type="hidden" id="stu_subj_id" name="stu_subj_id" />
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" id="group_id" name="group_id">
                                        <label for="center" class="col-md-3 control-label">Center : </label>
                                        <div class="col-md-8">
                                            <?php 
                                                global $branchdrop;
                                                global $selectedbr;
//                                                $extraattrs = 'id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 2, null);"';
//                                                echo form_dropdown('center',$branchdrop,$selectedbr, $extraattrs); 
                                            ?>
                                            <select class="form-control" id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value, 2, null);">
                                            <option value="">---Select center---</option>
                                            <?php
                                                foreach ($centers as $row):
                                                    ?>
                                                <option value="<?php echo $row['br_id']; ?>">
                                                <?php echo $row['br_code']." - ".$row['br_name']; ?>
                                                </option>
                                                    <?php
                                                endforeach;
                                                ?>
                                        </select>  
                                        </div>
                                    </div>  
<!--                                    <div class="form-group">                           
                                        <label for="comcode" class="col-md-3 control-label">Faculty Code : </label>
                                        <div class="col-md-8">
                                            <?php 
                                                global $facultydrop;
                                                global $selectedfac;
                                                $facextraattrs = 'id="faculty" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_courses(this.value, 1, null, 0)"';
                                                echo form_dropdown('faculty',$facultydrop,$selectedfac, $facextraattrs); 
                                            ?>
                                        </div>         
                                    </div>-->
                                    <div class="form-group">
                                        <input type="hidden" name="year_id" id="year_id">
                                        <label for="course_id" class="col-md-3 control-label">Course:</label>
                                        <div class="col-md-8">
                                            <select type="text" class="form-control new" id="load_Dcode" name="course_id" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_course_year(this.value, 1, null, null, 0)">
                                                <option value="">---Select Course---</option>
                                                <?php //foreach ($all_courses as $course){ ?>
                                                <!--<option value="//<?php print_r($course['course_id'])?>"><?php print_r("[".$course['course_code']."]-".$course['course_name']); ?></option>-->
                                                <?php //} ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="comcode" class="col-sm-3 control-label"> Course Year:</label>
                                        <div class="col-md-8" id="select_div">
                                            <select type="text" class="form-control new" id="no_year" name="no_year" required data-validation="required" data-validation-error-msg-required="Field can not be empty"  onchange="load_semesters(this.value, null, 0)">
                                                <option value="">---Select Course Year---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comcode" class="col-sm-3 control-label"> Semester:</label>
                                        <div class="col-md-8" id="select_div">
                                            <select type="text" class="form-control new" id="no_semester" name="no_semester" required data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_batch(null, null, 0)"> 
                                                <option value="">---Select Semester---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comcode" class="col-sm-3 control-label"> Batch Code:</label>
                                        <div class="col-md-8">
                                            <select type="text" class="form-control" id="Bcode" name="Bcode" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="get_student_list(this.value, null);">
                                                <option value="">---Select Batch Code---</option>
                                            </select>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="group_id" name="group_id">
                                        <label for="grname" class="col-md-3 control-label">Student:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="student" name="student" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_year_subjects(0);">
                                                <option value="">---Select Student---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="div_subjects" style="display: none;">
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
                                    <div class="form-group">
                                        <label for="grname" class="col-md-12">Please select elective subjects from bellow</label>
                                        <div class="col-md-8">
                                            <table class="table">
                                                <tbody id="elective_subjects" class="elective_subjects">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="subj_group" name="subj_group" />
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                        </div>
                                        <button type="submit" class="btn btn-info btn-md" name="submit" id="subject_save" onclick="event.preventDefault(); save_subjects()">Save</button>
                                        <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_subject_list();">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
        <script>

            save_method = 'update';
//            $(function () {
//                $('.student_look').DataTable({
//                    'ordering': true,
//                    'lengthMenu': [10, 20]
//                });
//            });
            
            $(document).ready(function () {
                $('.student_look').DataTable({
                    'ordering': true,
                    'lengthMenu': [10, 20]
                });

                //load_course list for lookup;
                
                
                $('#subject_save').attr('disabled', true);
                <?php
                $access_level = $this->Util_model->check_access_level();
                $ug_level = $access_level[0]['ug_level']; 
                ?>
        
                <?php if($ug_level == 5){ ?>                
                    document.getElementById("l_center").selectedIndex = "1";
//                    load_course_list(($('#l_center').val()), 1, null);
                    document.getElementById("center").selectedIndex = "1";
//                    load_course_list(($('#center').val()), 2, null);
                <?php } ?>
                    
                if( $('#l_center').length  ) {
                    load_course_list(($('#l_center').val()), 1, null);
                }
                
                //load_course list subject selection;
                if( $('#center').length ) {
                    load_course_list(($('#center').val()), 2, null);
                }
            });
            
            function get_course_year(id, flag, year_no, batch_id, lookup_flag)
            {
                $('#load_Dname').val(id);
                $('#l_no_year').find('option').remove().end().append('<option value="0">---Select Year---</option>').val('');
                $('#no_year').find('option').remove().end().append('<option value="">---Select Course Year---</option>').val('');
                $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                $('#l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
                $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
                    function (data)
                    {
                        if(data == 'denied')
                        {
                            funcres = {status:"denied", message:"You have no right to proceed the action"};
                            result_notification(funcres);
                        }
                        else
                        {
                            if (data != null) {
                                console.log(data['current_year']);
                                if(typeof data['current_year'] ==='undefined'){
                                   //alert('true');
                                    for (var i = 1; i <= data['no_of_year']; i++) {
                                        if (flag) {
                                            if (i == year_no) {
                                                if (lookup_flag) {
                                                    $('#l_no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                                } else {
                                                    $('#no_year').append($("<option></option>").attr("value", i).attr('selected', 'selected').text(i+" Year"));
                                                }
                                                
                                            } else {
                                                if (lookup_flag) {
                                                    $('#l_no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                                } else {
                                                    $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                                }
                                                
                                            }
                                        } else {
                                            if (lookup_flag) {
                                                $('#l_no_year').append($("<option></option>").text(i+" Year"));
                                            } else {
                                                $('#no_year').append($("<option></option>").attr("value", i).text(i+" Year"));
                                            }
                                            
                                        }
                                    }
                                }else {
                                    var current_year=data['current_year'];

                                    if(current_year != 0){
                                        if(current_year != null){
                                            if (flag) {
                                                if (lookup_flag) {
                                                    $('#l_no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                                } else {
                                                    $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                                }
                                                

                                            }else{
                                                    if (lookup_flag) {
                                                        $('#l_no_year').append($("<option></option>").text(current_year+" Year"));
                                                    } else {
                                                        $('#no_year').append($("<option></option>").attr("value", current_year).text(current_year+" Year"));
                                                    }
                                                    
                                            }
                                        }
                                    }





                            }


                            $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                                function (data)
                                {

                                    if(typeof data['current_year'] ==='undefined'){
                                        for (j = 0; j < data.length; j++) {
                                            if (data[j]['id'] == batch_id) {
                                                if (lookup_flag) {
                                                    $('#l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                } else {
                                                    $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                            } else {
                                                if (lookup_flag) {
                                                    $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                } else {  
                                                    $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                                }
                                            }
                                        }
                                    }else {


                                            if (lookup_flag) {
                                                $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                            } else {  
                                                $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));

                                            }

                                    }




                                <?php
                                    $access_level = $this->Util_model->check_access_level();
                                    $ug_level = $access_level[0]['ug_level']; 
                                ?>
        
                                <?php if($ug_level == 5){ ?>    
                                    document.getElementById("l_Bcode").selectedIndex = "1";
                                <?php } ?>
                                },
                                "json"
                            );
                        }
                        }
                    },
                    "json"
                );




            }

            

            function get_student_list(batch_id, student_id) {
            
                var status = 0; 
                if(student_id != null){
                  status = 1;  
                }
                
                $('#student').find('option').remove().end().append('<option value="">---Select Student---</option>').val('');
                $.post("<?php echo base_url('student/get_student_list_by_level') ?>", {'batch_id': batch_id,'branch': $('#center').val(), 'year':  $('#no_year').val(), 'semester':  $('#no_semester').val(), 'status': status},
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
                                for (j = 0; j < data.length; j++) 
                                {
                                    if(data[j]['stu_id'] == student_id){
                                        $('#student').append($("<option></option>").attr('selected', true).attr("value", data[j]['stu_id']).text(data[j]['reg_no']));
                                    }
                                    else{
                                        $('#student').append($("<option></option>").attr("value", data[j]['stu_id']).text(data[j]['reg_no']));
                                    }
                                }
                            }
                        },
                        "json"
                        );
            }

            function load_year_subjects(flag) {
                $(".core_subjects").empty();
                $(".elective_subjects").empty();
                if (flag) {
                    $("#div_subjects").css("display", "none");
                } else {
                    $("#div_subjects").css("display", "block");
                    var course_id = $('#load_Dcode').val();
                    var semester_no = $('#no_semester').val();
                    var batch_id = $('#Bcode').val();
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
                                                $("#core_subjects").append("<tr><td><input type='hidden' name='c_subject[]' id='c_subject' value='" + data[j]['subject_id'] + "'> <input type='hidden' name='c_subject_version[]' id='c_subject_version' value='" + data[j]['version_id'] + "'>" + data[j]['subject'] + "</td></tr>");
                                            } else {
                                                $("#elective_subjects").append("<tr><td><input type='checkbox' name='e_subject[]' id ='e_subject' value='" + data[j]['subject_id'] + "'><input type='hidden' name='e_subject_version[]' id='e_subject_version' value='" + data[j]['version_id'] + "'>&nbsp;&nbsp;&nbsp;" + data[j]['subject'] + "</td></tr>");
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
            }

            function load_semesters(year_no, semester_no, lookup_flag) {
                $('#l_no_semester').find('option').remove().end().append('<option value="0">---Select Semester---</option>').val('');
                $('#no_semester').find('option').remove().end().append('<option value="">---Select Semester---</option>').val('');
                if (lookup_flag) {
                    var course_id = $('#l_Dcode').val();
                } else {
                    var course_id = $('#load_Dcode').val();
                }
                if (course_id == '' || course_id == null) {
                    var course_id = $('#course').val();
                }
                $.post("<?php echo base_url('subject/load_semesters') ?>", {'course_id': course_id, 'year_no': year_no},
                        function (data)
                        {
                            if(data!=null){
                            console.log(data);
                            if(data == 'denied')
                            {
                                funcres = {status:"denied", message:"You have no right to proceed the action"};
                                result_notification(funcres);
                            }
                            else
                            {
                                if(typeof data['current_semester'] ==='undefined' ||data['current_semester']===null ){
                                    for (var i = 1; i <= data; i++) {
                                        if (semester_no == i) {
                                            if (lookup_flag) {
                                                $('#l_no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                                            }
                                            $('#no_semester').append($("<option></option>").attr('selected', 'selected').attr("value", i).text(i+" Semester"));
                                        } else {
                                            if (lookup_flag) {
                                                $('#l_no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                                            }
                                            $('#no_semester').append($("<option></option>").attr("value", i).text(i+" Semester"));
                                        }
                                    }
                                }else{

                                var current_semester=data['current_semester'];

                                        if (lookup_flag) {
                                            $('#l_no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester+" Semester"));
                                        }
                                        $('#no_semester').append($("<option></option>").attr("value", current_semester).text(current_semester+" Semester"));


                                }



                            }}
                        },
                        "json"
                        );
            }

            function search_details(flag) {
                var res = [];
                var center_id = $('#l_center').val();
                //var faculty_id = $('#l_faculty').val();
                var course_id = $('#l_Dcode').val();
                var year_no = $('#l_no_year').val();
                var semester_no = $('#l_no_semester').val();
                var batch_id = $('#l_Bcode').val();
                if (batch_id == null || batch_id == '' || batch_id == 0) {
                    res['status'] = 'denied';
                    res['message'] = 'Please Select Relevent Batch Code';
                    result_notification(res);
                } else {
                    if (flag == 1) {
                        $.post("<?php echo base_url('student/students_without_subject') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id, 'center_id': center_id},
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
                                            res['message'] = 'There are no students without subjects.';
                                            result_notification(res);
                                        } else if (data.length > 0) {
                                            $('#viewttbl_body').find('tr').remove();
                                            $('#view_not_selected').modal('show');
                                            for (j = 0; j < data.length; j++) {
                                                $('#viewttbl_body').append("<tr><td style='width:14%;text-align: center'>"+(j+1)+"</td><td style='width:14%;text-align: center'>" + data[j]['reg_no'] + "</td><td style='width:14%;text-align: center'>" + data[j]['first_name'] + "</td></tr>");
                                            }
                                        } else {
                                            res['status'] = 'denied';
                                            res['message'] = 'All Students subjects selected.';
                                            result_notification(res);
                                        }
                                    }
                                },
                                "json"
                                );
                    } else {

                        $.post("<?php echo base_url('student/filter_students_subject_selection') ?>", {'course_id': course_id, 'year_no': year_no, 'semester_no': semester_no, 'batch_id': batch_id, 'center_id': center_id},
                                function (data)
                                {
                                    if(data == 'denied')
                                    {
                                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                                        result_notification(funcres);
                                    }
                                    else
                                    {
                                        if (data.length > 0) {
    //                                        $('#tbl_body').find('tr').remove();
                                            $('#student_look').DataTable().clear();
                                            for (j = 0; j < data.length; j++) {
                                                content = '';
                                                if (data[j]['stu_c_deleted'] == 1) {
                                                   // content = "<button type='button' title='Activate' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true' onclick='change_status(" + data[j]['stu_co_id'] + ",0);'></span></button>";
                                                } else {
                                                    //content = "<button type='button' title='Deactivate' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true' onclick='change_status(" + data[j]['stu_co_id'] + ",1);'></span></button>";
                                                }
    //                                            $('#tbl_body').append("<tr><td>" + (j + 1) + "</td><td>" + data[j]['reg_no'] + "</td><td>" + data[j]['first_name'] + " " + data[j]['last_name'] + "</td><td>" + data[j]['nic_no'] + "</td><td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='load_subject_modal(" + data[j]['stu_co_id'] + ");'></span></button> " + content + "</td></tr>");
                                                
                                                edit_content = "<button type='button' title='Edit Subjects' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true' onclick='edit_student_subjects(" + data[j]['stu_co_id'] + ");'></span></button>  ";
                                                
                                                action_content = "</td><td align='center'><button type='button' title='Show Subjects' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-folder-open' aria-hidden='true' onclick='load_subject_modal(" + data[j]['stu_co_id'] + ");'></span></button>  " + content + "</td>";
                                                $('#student_look').DataTable().row.add([
                                                    (j + 1),
                                                    data[j]['reg_no'],
                                                    data[j]['first_name'],
                                                    data[j]['nic_no'],
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
            }
            function load_subject_modal(stu_co_id) {
                $(".model_student_csubjects").empty();
                $(".model_student_esubjects").empty();
                $('#view_selected_subject').modal('show');
                $.post("<?php echo base_url('student/get_student_subject_list') ?>", {'stu_co_id': stu_co_id},
                        function (data)
                        {
                            if (data == 'denied')
                            {
                                funcres = {status: "denied", message: "You have no right to proceed the action"};
                                result_notification(funcres);
                            } else {
                                for (j = 0; j < data.length; j++) {
                                    if (data[j]['type'] == 1) {
                                        $('#model_student_csubjects').append("<li class='list-group-item'>" + data[j]['subject'] + "</li>");
                                    } else {
                                        $('#model_student_esubjects').append("<li class='list-group-item'>" + data[j]['subject'] + "</li>");
                                    }

                                }
                            }
                        },
                        "json"
                        );


            }

            function change_status(stu_co_id, new_status) {
                $.ajax(
                        {
                            url: "<?php echo base_url('student/update_student_subject_status') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: {'stu_co_id': stu_co_id, 'new_status': new_status},
                            success: function (data)
                            {
                                if (data == 'denied')
                                {
                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                    result_notification(funcres);
                                } else
                                {

                                    search_details(2);
                                    result_notification(data);
                                }
                            }
                        });
            }

            function save_subjects() {
            
                var count = true;
                var subj_center = $('#center').val();
                var subj_course = $('#load_Dcode').val();
                var subj_year = $('#no_year').val();
                var subj_semester = $('#no_semester').val();
                var subj_batch = $('#Bcode').val();
                var subj_student = $('#student').val();
                
                var elective_count = $('#elective_subjects tr').length;
                
                if(subj_center == ""){
                    funcres = {status:"denied", message:"Center cannot be empty!"};
                    result_notification(funcres);
                }
                else if(subj_course == ""){
                    funcres = {status:"denied", message:"Course cannot be empty!"};
                    result_notification(funcres);
                }
                else if(subj_year == ""){
                    funcres = {status:"denied", message:"Course Year cannot be empty!"};
                    result_notification(funcres);
                }
                else if(subj_semester == ""){
                    funcres = {status:"denied", message:"Semester cannot be empty!"};
                    result_notification(funcres);
                }
                else if(subj_batch == ""){
                    funcres = {status:"denied", message:"Batch Code cannot be empty!"};
                    result_notification(funcres);
                }
                else if(subj_student == ""){
                    funcres = {status:"denied", message:"Student cannot be empty!"};
                    result_notification(funcres);
                }else{
                    
                    if(elective_count > 0){
                        var check_count = $('input:checkbox:checked').length;

                        if(check_count == 0){
                            funcres = {status:"denied", message:"You must select at least one Elective subject!"};
                            result_notification(funcres);
                            count = false;
                        }
                        else{
                            count = true;
                        }
                    }
                    
                    if(count == true){
                    
                        $("#grp_form :input").prop("disabled", false);

                        $.ajax(
                        {
                            url: "<?php echo base_url('student/save_student_subjects') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: $('#grp_form').serialize(),
                            success: function (data)
                            {
                                if (data == 'denied')
                                {
                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                    result_notification(funcres);
                                } else
                                {
                                    result_notification(data);
                                    reset_subject_list();
                                }
                            }
                        });
                    }
                }
            }

            function reset_subject_list() {
                $('#load_Dcode').val("");
                $('#center').val("");
                $('#l_Dcode').val("");
                $('#l_center').val("");
                get_course_year(null, 0, null, null, 0);
                load_semesters(null, null, 0);
                //get_student_list(null, null);
                $('#student').find('option').remove().end().append('<option value="">---Select Student---</option>').val('');
                load_year_subjects(1);
                get_batch(null, null, 0);
                load_course_list(null, 0, null);
                status = 0;
                $("#grp_form :input").prop("disabled", false);
                $('#stu_subj_id').val("");
                $('#subject_save').attr('disabled', true);
                
                $('#student_look').DataTable().destroy();
                $('.student_look').DataTable({
                    'ordering': true,
                    'lengthMenu': [10, 20]
                });
                $('#student_look').DataTable().clear().draw();
            }
            
            
        function load_course_list(center_id, status, edit_course){
            if(status == 1){
                $('#l_Dcode').find('option').remove().end();
                $('#l_Dcode').append('<option value="">---Select Course---</option>').val('');

                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},

                function (data)
                {
                    if(data.length == 1){
                        $('#l_Dcode').append($("<option></option>").attr("value", data[0]['course_id']).text('['+data[0]['course_code']+']-'+data[0]['course_name']).attr("selected", "selected"));
                        get_course_year(data[0]['course_id'],1, null,null,1);
                    } else {
                        for (var i = 0; i < data.length; i++) 
                        {
                            $('#l_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text('['+data[i]['course_code']+']-'+data[i]['course_name']));
                        }
                    }
                    
                   <?php
//                        $access_level = $this->Util_model->check_access_level();
//                        $ug_level = $access_level[0]['ug_level']; 
//                    ?>
        
                   <?php if($ug_level == 5){ ?>
//                    document.getElementById("l_Dcode").selectedIndex = "1";
//                    get_course_year(($('#l_Dcode').val()), 1, null, null, 1);
//                    document.getElementById("load_Dcode").selectedIndex = "1";
                   <?php } ?>
                },
                "json"
                );
            }
            else{
                $('#load_Dcode').find('option').remove().end();
                $('#load_Dcode').append('<option value="">---Select Course---</option>').val('');

                $.post("<?php echo base_url('Student/load_subject_selection_course_list') ?>", {'center_id': center_id},

                function (data)
                {
                    if(data.length == 1){
                        $('#load_Dcode').append($("<option></option>").attr("value", data[0]['course_id']).text('['+data[0]['course_code']+']-'+data[0]['course_name']).attr("selected", "selected"));
                        get_course_year(data[0]['course_id'],1, null,null,0);
                    } else {
                        for (var i = 0; i < data.length; i++) 
                        {
    //                        if(data[i]['course_id'] == edit_course){
    //                            $('#load_Dcode').append($("<option></option>").attr('selected', true).attr("value", data[i]['course_id']).text('['+data[i]['course_code']+']-'+data[i]['course_name']));
    //                        }
    //                        else{
                                $('#load_Dcode').append($("<option></option>").attr("value", data[i]['course_id']).text('['+data[i]['course_code']+']-'+data[i]['course_name']));
    //                        }
                        }
                    }
                    

                },
                "json"
                );
            }
        }
        
        
        function get_batch(year_no, batch_id, lookup_flag)
        {
            if(lookup_flag){ 
                var id = $('#l_Dcode').val();
            }
            else{
                var id = $('#load_Dcode').val();
            }
            
            $('#Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
            $('#l_Bcode').find('option').remove().end().append('<option value="">---Select Batch Code---</option>').val('');
            $.post("<?php echo base_url('course/get_course') ?>", {'id': id},
            function (data)
            {
                if(data == 'denied')
                {
                    funcres = {status:"denied", message:"You have no right to proceed the action"};
                    result_notification(funcres);
                }
                else
                {
                    $.post("<?php echo base_url('batch/load_batches') ?>", {'course_id': id},
                            function (data)
                            {
                                for (j = 0; j < data.length; j++) {
                                    if (data[j]['id'] == batch_id) {
                                        if (lookup_flag) {
                                            $('#l_Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        }
                                        $('#Bcode').append($("<option></option>").attr('selected', true).attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    } else {
                                        if (lookup_flag) {
                                            $('#l_Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                        }
                                        $('#Bcode').append($("<option></option>").attr("value", data[j]['id']).text(data[j]['batch_code']));
                                    }
                                }

                            },
                            "json"
                            );
                }
            },
            "json"
            );
        }
        
        
        function edit_student_subjects(id){
        
            var year = $('#l_no_year').val();
            var semester = $('#l_no_semester').val();
        
            $.post("<?php echo base_url('subject/load_edit_student_subjects') ?>", {'id': id, 'year_no': year, 'semester_no': semester},
            function (data)
            {
                console.log(data);
                
                $('a[href="#subject_select"]').click();
                
                $('#stu_subj_id').val(data['stu_data'][0]['stu_subj_id']);
                $('#subj_group').val(data['follow_subject'][0]['subj_group']);
                $('#center').val(data['stu_data'][0]['center_id']).prop('disabled', true);
                load_course_list(data['stu_data'][0]['center_id'], 2, data['stu_data'][0]['course_id']);
                $('#no_year').val(data['stu_data'][0]['current_year']).prop('disabled', true);
                $('#no_semester').val(data['stu_data'][0]['current_semester']).prop('disabled', true);
                $('#Bcode').val(data['stu_data'][0]['batch_id']).prop('disabled', true);
                get_student_list(data['stu_data'][0]['batch_id'], data['stu_data'][0]['student_id']);
                $('#student').prop('disabled', true);
                $('#load_Dcode').prop('disabled', true);
                $('#subject_save').attr('disabled', false);
                

                $(".core_subjects").empty();
                $(".elective_subjects").empty();
                $("#div_subjects").css("display", "block");
                
                    for (x = 0; x < data['all_subjects'].length; x++) {
                        if (data['all_subjects'][x]['type'] == 1) {
                            $("#core_subjects").append("<tr><td><input type='hidden' name='c_subject[]' id='c_subject' value='" + data['all_subjects'][x]['subject_id'] + "'> <input type='hidden' name='c_subject_version[]' id='c_subject_version' value='" + data['all_subjects'][x]['version_id'] + "'>" + data['all_subjects'][x]['subject'] + "</td></tr>");
                        } else {
                            $("#elective_subjects").append("<tr><td><input type='checkbox' name='e_subject[]' id ='e_subject' value='" + data['all_subjects'][x]['subject_id'] + "'><input type='hidden' name='e_subject_version[]' id='e_subject_version' value='" + data['all_subjects'][x]['version_id'] + "'>&nbsp;&nbsp;&nbsp;" + data['all_subjects'][x]['subject'] + "</td></tr>");
                          
                            for (y = 0; y < data['follow_subject'].length; y++) {
                                
                                if((data['follow_subject'][y]) != undefined){
                                      
                                    var follow_subj = (data['follow_subject'][y]['subject_id']);
    //
                                    if((data['all_subjects'][x]['subject_id']) == follow_subj){
                                        //$("#elective_subjects").append("<tr><td><input type='checkbox' name='e_subject[]' id ='e_subject' value='" + data['all_subjects'][x]['subject_id'] + "' checked><input type='hidden' name='e_subject_version[]' id='e_subject_version' value='" + data['all_subjects'][x]['version_id'] + "'>&nbsp;&nbsp;&nbsp;" + data['all_subjects'][x]['subject'] + "</td></tr>");
                                        $("input[type=checkbox][value="+ data['all_subjects'][x]['subject_id'] +"]").prop("checked",true);
                                    }
                                }
                            }
                        }
                    }
            },
            "json"
            );
        }

        </script>

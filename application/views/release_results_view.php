<style>
    .dialog-confirm.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info{
        color: #fff;
        background: #42b8dd;
        border-color: #42b8dd;
    }
    
/*------ON/OFF BUTTON START--------*/  
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 3px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input2:checked + .slider {
      background-color: #4cd964;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
/*------ON/OFF BUTTON END--------*/    
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Release Results</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Configurations</li>
            <li><i class="fa fa-users"></i>Release Results</li>
        </ol>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a  href="#results_tab" aria-controls="results_tab" role="tab" data-toggle="tab"> Release Results</a></li>
    <li role="presentation"><a  href="#reg_tab" aria-controls="reg_tab" role="tab" data-toggle="tab"> Online Registration</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="results_tab">
        <div class="panel">
            <div class="panel-heading">
                Release Results
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">                       
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="center" class="col-md-3 control-label">Center</label>
                                        <div class="col-md-7">
                                            <?php
//                                            global $branchdrop;
//                                            global $selectedbr;
//                                            $extraattrs = 'id="l_prom_centre" class="form-control" style="width:100%" onchange="load_course_list(this.value, 1,null);"';
//                                            echo form_dropdown('l_prom_centre', $branchdrop, $selectedbr, $extraattrs);
//                                            ?>
                                            
                                            <select class="form-control" style="width:100%" id="rs_center" name="rs_center"
                                                    onchange="get_results_course(this.value)" data-validation="required"
                                                    data-validation-error-msg-required="Field can not be empty">
                                                <option value="">---Select Center---</option>
                                                <?php
                                                foreach ($user_centers as $uc):
                                                    ?>
                                                    <option value="<?php echo $uc['br_id']; ?>"><?php echo $uc['br_code'] . " - " . $uc['br_name'] ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                </div>
                            </div>   
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="course" class="col-md-3 control-label">Course</label>
                                    <div class="col-md-7">
                                        <select class="form-control" style="width:100%" id="rs_course" name="rs_course"
                                                onchange="get_results_year(this.value)" data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Course---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year" class="col-md-3 control-label">Year</label>
                                    <div class="col-md-7">
                                        <select id="rs_year" name="rs_year" class="form-control" style="width:100%"
                                                data-validation="required"
                                                data-validation-error-msg-required="Field can not be empty">
                                            <option value="">---Select Year---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-md" name="rs_search" onclick="search_exams_for_results();">Search</button>
                            </div>
                        </div>  
                        <br/> 
                        <table id="results_exam_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Exam</th>
                                    <th>Release Results for Reports</th>
                                    <th>Release Results for Web</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_body">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-confirm"></div>

    <div role="tabpanel" class="tab-pane" id="reg_tab">
        <div role="tabpanel" class="tab-pane active" id="results_tab">
        <div class="panel">
            <div class="panel-heading">
                Online Registration
            </div>
            <div class="panel-body">
                <div class="row">
                    <input type="hidden" value="<?php echo $online_registration_flag ?>" id='current_reg_flg'>
                    <div class="col-md-12">                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="application" class="col-md-2 control-label" style="padding-top:10px">Allow Online Registration</label>
                                    <div class="col-md-7" id='reg_div'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function () {
            $('#results_exam_table').DataTable({
                'ordering': false,
                'lengthMenu': [10, 25, 50, 75, 100]
            });
            
            $('#reg_div').empty();
            var reg_flag = $('#current_reg_flg').val();
            if(reg_flag == true){
                $('#reg_div').append("<label class='switch'><input type='checkbox' id='on_off_reg_1' onclick='update_online_registration_flg(1);' checked><span class='slider round'></span></label>");
            } else {
                $('#reg_div').append("<label class='switch'><input type='checkbox' id='on_off_reg_0' onclick='update_online_registration_flg(0);'><span class='slider round'></span></label>");
            }
            
        });


        /*
        * load courses
        */
        function get_results_course(center_id)
        {
            $('#rs_course').find('option').remove().end();
            $('#rs_course').append('<option value="">---Select Course---</option>').val('');

            $.post("<?php echo base_url('Company/load_result_courses') ?>", {'center_id': center_id},

            function (data)
            {
                for (var i = 0; i < data.length; i++) 
                {
                    $('#rs_course').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
                }
            },
            "json"
            );
        }


        /*
        * load years
        */
        function get_results_year(course_id)
        {
            $.post("<?php echo base_url('Company/load_result_years') ?>",{'course_id': course_id},

            function (data)
            {     
               for (var x = 0; x < data.length; x++){ 
                    var year = data[x]['no_of_year'];
                    var id = data[x]['id'];

                    $('#rs_year').find('option').remove().end();
                    $('#rs_year').append('<option value="">---Select Year---</option>').val('');

                        for (var i=1; i <= year; i++) 
                        {
                            $('#rs_year').append($("<option></option>").attr("value", i+'-'+id).text(i + " Year"));
                        }
                }
            },
            "json"
            );
        }


        /*
        * search exams
        */   
        function search_exams_for_results()
        {
            $('.se-pre-con').fadeIn('slow');
            var year_no = "";
            var center_id = $('#rs_center').val();
            var course_id = $('#rs_course').val();

            if($('#rs_year').val() != ""){
                year_no = $('#rs_year').val().split('-')[0].trim();
            }

            $('#results_exam_table').DataTable().destroy();
            $('#results_exam_table').DataTable({
                'ordering': false,
                'lengthMenu': [10, 25, 50, 75, 100],
                "columnDefs": [{
                    "targets": 0,
                    "className": "text-center"
                },
                {
                    "targets": 1,
                    "className": "text-center"
                },
                {
                    "targets": 3,
                    "className": "text-center"
                },
                {
                    "targets": 4,
                    "className": "text-center"
                }]
            });
            $('#results_exam_table').DataTable().clear().draw();

            $.post("<?php echo base_url('Company/search_exams_for_results') ?>", {'center_id': center_id, 'course_id': course_id, 'year_no': year_no},
                function (data)
                {
                    $('.se-pre-con').fadeOut('slow');
                    console.log(data);
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if (data.length > 0) {
                            for (j = 0; j < data.length; j++) {
                                   
                                if(data[j]['release_result'] == 1){
                                    btn_content = "<label class='switch'><input type='checkbox' id='on_off_btn_"+j+"' onclick='update_release_result_exm("+j+","+data[j]['sem_exm_id']+");' checked><span class='slider round'></span></label>";
                                } 
                                else{
                                    btn_content = "<label class='switch'><input type='checkbox' id='on_off_btn_"+j+"' onclick='update_release_result_exm("+j+","+data[j]['sem_exm_id']+");'><span class='slider round'></span></label>"; 
                                }
                                action_content = "<td>"+btn_content+"</td>";
                                
                                
                                if(data[j]['release_result_web'] == 1){
                                    btn_content2 = "<label class='switch'><input type='checkbox' id='on_off_btn_web_"+j+"' onclick='update_release_result_exm_for_web("+j+","+data[j]['sem_exm_id']+");' checked><span class='slider round'></span></label>";
                                } 
                                else{
                                    btn_content2 = "<label class='switch'><input type='checkbox' id='on_off_btn_web_"+j+"' onclick='update_release_result_exm_for_web("+j+","+data[j]['sem_exm_id']+");'><span class='slider round'></span></label>"; 
                                }
                                action_content2 = "<td>"+btn_content2+"</td>";
                                                               
                                $('#results_exam_table').DataTable().row.add([
                                    data[j]['year_no']+" Year",
                                    data[j]['semester_no']+" Semester",
                                    "["+data[j]['exam_code']+"] - "+data[j]['exam_name'],
                                    action_content,
                                    action_content2
                                ]).draw(false);
                            }
                        }
                    }
                },
                "json"
            );
        } 
        
        
        
        function update_release_result_exm(val, sem_exm_id){
        
            var btn_checked = 0;
            
            if ($('#on_off_btn_'+val).is(":checked"))
            {
                btn_checked = 1;
            }
            else{
                btn_checked = 0;
            }
            
            
            $.post("<?php echo base_url('Company/update_release_result_exm_status') ?>", {'sem_exm_id': sem_exm_id, 'btn_checked': btn_checked},
                function (data)
                {
                        funcres = {status:data['status'], message:data['message']};
                        result_notification(funcres);
                        
                        search_exams_for_results();
                    
                },
                "json"
            );                 
        }
        
        
        
        function update_release_result_exm_for_web(val_web, sem_exm_id_web){
        
            var btn_checked_web = 0;
            
            if ($('#on_off_btn_web_'+val_web).is(":checked"))
            {
                btn_checked_web = 1;
            }
            else{
                btn_checked_web = 0;
            }
            
            
            $.post("<?php echo base_url('Company/update_release_result_exm_status_for_web') ?>", {'sem_exm_id': sem_exm_id_web, 'btn_checked': btn_checked_web},
                function (data)
                {
                        funcres = {status:data['status'], message:data['message']};
                        result_notification(funcres);
                        
                        search_exams_for_results();
                    
                },
                "json"
            );                 
        }
   
   function update_online_registration_flg(val) 
   {
               
        if ($('#on_off_reg_'+val).is(":checked"))
        {
                btn_checked = 1;
        }
        else{
            btn_checked = 0;
        }   
        
        $.post("<?php echo base_url('Company/set_online_registration_flag') ?>", {'btn_checked': btn_checked},
                function (data)
                {
                    funcres = {status:data['status'], message:data['message']};
                    result_notification(funcres);
                        
                    if(data['status'] == 'success'){
                       $('#reg_div').empty();
                       $('#current_reg_flg').val(btn_checked);
                        if(btn_checked == true){
                            $('#reg_div').append("<label class='switch'><input type='checkbox' id='on_off_reg_1' onclick='update_online_registration_flg(1);' checked><span class='slider round'></span></label>");
                        } else {
                            $('#reg_div').append("<label class='switch'><input type='checkbox' id='on_off_reg_0' onclick='update_online_registration_flg(0);'><span class='slider round'></span></label>");
                        } 
                    }
                    
                },
                "json"
            );
   }
    </script>


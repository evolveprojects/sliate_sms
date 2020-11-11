<style>
    .dialog-confirm.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info{
        color: #fff;
        background: #42b8dd;
        border-color: #42b8dd;
    }
    #common {
    display: block;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="se-pre-con"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>Approvals</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Approvals</li>
            <li><i class="fa fa-users"></i>Mahapola Approvals</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Mahapola Approvals
            </div>
            <hr>   
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <div> 
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-user" href="#to_apprv_tab" aria-controls="to_apprv_tab" role="tab" data-toggle="tab" onclick="ndispc()"> To Approval</a></li>
                                <li role="presentation"><a class="fa fa-university" href="#rejected_list_tab" aria-controls="rejected_list_tab" role="tab" data-toggle="tab" onclick="ndispc()"> Rejected List</a></li>
                                <!--<li role="presentation"><a class="fa fa-university" href="#mahapola_update_tab" aria-controls="mahapola_update_tab" role="tab" data-toggle="tab" onclick="dispc()"> Mahapola Process Eligible List</a></li>-->
                          
    
                          <!--  <li role="presentation"><a class="fa fa-graduation-cap" href="#achive_tab" aria-controls="achive_tab" role="tab" data-toggle="tab"> Achievements</a></li>
                                <li role="presentation"><a class="fa fa-book" href="#subject_tab" aria-controls="subject_tab" role="tab" data-toggle="tab"> Subjects</a></li>
                                <li role="presentation"><a class="fa fa-edit" href="#attendance_tab" aria-controls="attendance_tab" role="tab" data-toggle="tab"> Attendance</a></li>-->
                            </ul>
                            <div class="tab-content"><br/><br/>
                                <div id="common" class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label for="center" class="col-md-3 control-label">Center : </label>
                                                    <div class="col-md-7">
                                                        <?php 
                                                        global $branchdrop;
                                                        global $selectedbr;

                                                        if(isset($stu_data))
                                                        {
                                                            $selectedbr = $stu_data['center_id'];
                                                        }

                                                        $extraattrs = 'id="center_id" class="form-control" style="width:100%" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_list(this.value,null,this);"';

                                                        echo form_dropdown('center_id',$branchdrop,$selectedbr, $extraattrs);
                                                        ?>
                                                    </div>
                                                </div>				
                                            </div>
                                            <div class="form-group col-md-4">							
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="course_id" name="course_id" value="">    
                                                            <option value="0">---Select Course Code---</option>
                                                        </select>
                                                    </div>				         
                                                </div>				
                                            </div>
                                            <div class="form-group col-md-4">
                                                <div class="form-group">
                                                    <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Mahapola Year:</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="mp_sum_year" name="mp_sum_year" onchange="" data-validation="required">
<!--                                                            <option value="all">All</option>-->
                                                            <?php
                                                            foreach ($mpyear_list as $yr):

                                                                if ($yr['year'] != 0) {
                                                                    ?>
                                                                    <option value="<?php echo $yr['year']; ?>">
                                                                        <?php echo $yr['year']; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
<!--                                            <div class="col-md-2">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_mahapola_student_details('reject');">Search</button>
                                            </div>-->
                                        </div>
                                    </div>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <div role="tabpanel" class="tab-pane active" id="to_apprv_tab">
                                
                                   <div class="row">
                                        <div class="col-md-2" style="margin-left: 80%; margin-top: -5%;">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_mahapola_student_details('approve');">Search</button>
                                        </div>
                                    </div>     
                                
                                    <table id="stu_apprv" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
//                                            $i = 1;
//                                            if (!empty($result_array)) {
//                                                foreach ($result_array as $va) {
//                                                    ?>

<!--                                                    <tr>
                                                        <td align="center"> <?php //echo $i ?></td>
                                                        <td> <?php //echo $va['reg_no'] ?></td>
                                                        <td> <?php //echo $va['first_name'] //. " " . $va['last_name'] ?></td>
                                                        <td> <?php //echo $va['nic_no'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php //echo $va['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_mahapola_apprv_status('<?php //print_r($va["stu_id"]) ?>', '1', '<?php //print_r($va["reg_no"]) ?>', '<?php //print_r($va["nic_no"]) ?>', '<?php //print_r($va["center_id"]) ?>','<?php //print_r($va["mahapola_email_status"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                            <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_stu_mahapola_apprv_status('<?php //print_r($va["stu_id"]) ?>', '3', '<?php //print_r($va["reg_no"]) ?>', '<?php //print_r($va["nic_no"]) ?>', '<?php //print_r($va["center_id"]) ?>','<?php //print_r($va["mahapola_email_status"]) ?>')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>
                                                    </tr>-->

                                                    <?php
//                                                    $i++;
//                                                }
//                                            }
//                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="rejected_list_tab">
                                    <div class="row">
                                        <div class="col-md-2" style="margin-left: 80%; margin-top: -5%;">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_mahapola_student_details('reject');">Search</button>
                                        </div>
                                    </div>
                                    <table id="reject_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Register Number</th>
                                                <th>Student Name</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rej_tbl_body">
                                            <?php
                                           // $x = 1;
                                           // if (!empty($reject_array)) {
                                           //     foreach ($reject_array as $rj) {
                                                    ?>

<!--                                                    <tr>
                                                        <td align="center"> <?php //echo $x ?></td>
                                                        <td> <?php //echo $rj['reg_no'] ?></td>
                                                        <td> <?php //echo $rj['first_name'] //. " " . $rj['last_name'] ?></td>
                                                        <td> <?php //echo $rj['nic_no'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php //echo $rj['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_mahapola_apprv_status('<?php //print_r($rj["stu_id"]) ?>', '1', '<?php //print_r($rj["reg_no"]) ?>', '<?php //print_r($rj["nic_no"]) ?>', '<?php //print_r($rj["center_id"]) ?>','<?php //print_r($rj["mahapola_email_status"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                                                            <button title="Reject" onclick="event.preventDefault();update_stu_apprv_status('<?php //print_r($rj["stu_id"]) ?>', '3')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>
                                                    </tr>-->

                                                    <?php
                                                    //$x++;
                                                //}
                                           // }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
<!--                                <div role="tabpanel" class="tab-pane" id="mahapola_update_tab">
                                    <br>
                                    <span style="font-weight: bold">please click below button to process the Mahapola Eligible list.</span>
                                    <br><br>
                                    <button type="button" class="btn btn-primary btn-md" name="mahapola_update" id="mahapola_update" onclick="update_mahapola_eligible_status();">Update Mahapola Status</button>
                                </div>-->
                            </div>
                        </div>
                    </div>
                <!-- ------------------- -->
                </div>
<!--                </br>
                <div class="col-xs-12 text-right">
                    <button onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve All</button>
                    <button onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1')" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject All</button>
                </div>-->
            </div>
        </div>
    </div>

    <div id="dialog-confirm"></div>
    
    <script type="text/javascript">

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function () {
            $('#text_load').hide();
            
            $('#stu_apprv').DataTable({
                'ordering': true,
                'lengthMenu': [10, 25, 50, 75, 100]
            });
            
            $('#reject_list').DataTable({
                'ordering': true,
                'lengthMenu': [10, 25, 50, 75, 100]
            });  
            
            if($('#user_level').val() == "1"){
            $('#center_id').find('option').get(0).remove();
            $("#center_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
            }
//            $('#center_id2').find('option').get(0).remove();
//            $("#center_id2").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));

            load_course_list($("#center_id").val());
            
            //load_reject_course_list($("#center_id2").val());
            
        });
        
        function dispc() {
            document.getElementById("common").style.display = "none";
        }
        
        function ndispc() {
            document.getElementById("common").style.display = "block";
        }

        function update_stu_mahapola_apprv_status(student_id, approved, reg_no, nic, branch,email_sent_status)
        {
            var title = "";
            
            if(approved == '1'){
                $("#dialog-confirm").html("Do you really want to approve this student for mahapola?");
                title = 'Approve Student for Mahapola';
            }
            else{
               $("#dialog-confirm").html("Do you really want to reject this student for mahapola?"); 
               title = 'Reject Student for Mahapola';
            }
            
            // Define the Dialog and its properties.
            $("#dialog-confirm").dialog({
                resizable: false,
                modal: true,
                title: title,
                height: 140,
                width: 400,
                draggable: false,
                buttons: [
                    {
                        text: "Yes",
                        "class": 'btn btn',
                        click: function() {
                            $(this).dialog('close');
                            $.post("<?php echo base_url('approvals/change_student_mahapola_approval_status') ?>", {'student_id': student_id, 'approved': approved, 'reg_no': reg_no, 'nic': nic, 'branch': branch,'email_sent_status':email_sent_status},
                            function (data)
                            {
                                location.reload();
                            },
                            "json"
                            );
                        }
                    },
                    {
                        text: "No",
                        "class": 'btn btn-info',
                        click: function() {
                            $(this).dialog('close');
                        }
                    }
                ]
            }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'});
            
        }
        
         function stueditview(stu)
        {
            window.location = '<?php echo base_url("student/mahapola_application_view") ?>?id='+ (window.btoa(stu)) +'&type=mahapola_approval';
            
            
        }
        
        
    /*
    * load courses
    */
     function load_course_list(center_id)
    {
        $('#course_id').find('option').remove().end();
        $("#course_id").prepend($("<option selected='selected'></option>").attr("value", "all").text("All"));
        //$('#course_id').append('<option value="">---Select Course Code---</option>').val('');

        $.post("<?php echo base_url('Approvals/load_mahapola_course_list') ?>", {'center_id': center_id},

        function (data)
        {
            for (var i = 0; i < data.length; i++) 
            {
                $('#course_id').append($("<option></option>").attr("value", data[i]['course_id']).text(data[i]['course_code']+' - '+data[i]['course_name']));
            }
            
        },
        "json"
        );
    }
   
    function search_mahapola_student_details(status)
    {
        $('.se-pre-con').fadeIn('slow');
        var center_id = $('#center_id').val();
        var course_id = $('#course_id').val();
        var mahapola_year = $('#mp_sum_year').val();
        
        if(status == 'approve'){
            
            $.post("<?php echo base_url('Approvals/search_mahapola_approve_students_lookup') ?>", {'center_id': center_id, 'course_id': course_id, 'status': status, 'mahapola_year': mahapola_year},
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
                    $('#stu_apprv').DataTable().destroy();
                    $('#stu_apprv').DataTable().clear().draw();
                        
                    if (data.length > 0) 
                    {
                        
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                            
                            action_content = "<td align='center'><a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> | <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_stu_mahapola_apprv_status(" + data[j]['stu_id'] + ", \""+1+"\", \"" +data[j]["reg_no"]+ "\", \"" +data[j]["nic_no"]+ "\", " +data[j]["center_id"]+ ")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |<button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_stu_mahapola_apprv_status(" + data[j]['stu_id'] + ", \""+3+"\", \"" +data[j]["reg_no"]+ "\", \"" +data[j]["nic_no"]+ "\", " +data[j]["center_id"]+ ")' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";

                            
                            $('#stu_apprv').DataTable().row.add([
                                number_content,
                                data[j]['reg_no'],
                                data[j]['first_name'],
                                data[j]['nic_no'],
                                action_content
                            ]).draw(false);
                        }
                    }
                }
                $('.se-pre-con').fadeOut('slow');
            },
            "json"
            );
        }
        else{
        
            $.post("<?php echo base_url('Approvals/search_mahapola_approve_students_lookup') ?>", {'center_id': center_id, 'course_id': course_id, 'status': status, 'mahapola_year':mahapola_year},
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
                    $('.se-pre-con').fadeIn('slow');
                    $('#reject_list').DataTable().destroy();
                    $('#reject_list').DataTable().clear().draw();
                        
                    if (data.length > 0) 
                    {
                        
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                            
                            action_content = "<td align='center'><a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview(" + data[j]['stu_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> | <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_stu_mahapola_apprv_status(" + data[j]['stu_id'] + ", \""+1+"\", \"" +data[j]["reg_no"]+ "\", \"" +data[j]["nic_no"]+ "\", " +data[j]["center_id"]+ ")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button></td>";

                            
                            $('#reject_list').DataTable().row.add([
                                number_content,
                                data[j]['reg_no'],
                                data[j]['first_name'],
                                data[j]['nic_no'],
                                action_content
                            ]).draw(false);
                        }
                    }
                }
            $('.se-pre-con').fadeOut('slow');
            },
            "json"
            );
        }

    }
    
//    function update_mahapola_eligible_status(){
//        $.post("<?php //echo base_url('Student/update_mahapola_eligible_status') ?>", {},
//            function (data)
//            {
//                //console.log(data);
//                location.reload();
//
//            },
//            "json"
//            );
//    }
      
    </script>





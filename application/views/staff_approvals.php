<style>
    .dialog-confirm.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info{
        color: #fff;
        background: #42b8dd;
        border-color: #42b8dd;
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
            <li><i class="fa fa-users"></i>Staff Approvals</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Staff Approvals
            </div>
            <hr>   
            <div class="panel-body">
                <div class="row">
                    <!-- ------------------ -->
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a class="fa fa-user" href="#to_apprv_tab" aria-controls="to_apprv_tab" role="tab" data-toggle="tab"> To Approval</a></li>
                                <li role="presentation"><a class="fa fa-university" href="#rejected_list_tab" aria-controls="rejected_list_tab" role="tab" data-toggle="tab"> Rejected List</a></li>
                          
    
                          <!--  <li role="presentation"><a class="fa fa-graduation-cap" href="#achive_tab" aria-controls="achive_tab" role="tab" data-toggle="tab"> Achievements</a></li>
                                <li role="presentation"><a class="fa fa-book" href="#subject_tab" aria-controls="subject_tab" role="tab" data-toggle="tab"> Subjects</a></li>
                                <li role="presentation"><a class="fa fa-edit" href="#attendance_tab" aria-controls="attendance_tab" role="tab" data-toggle="tab"> Attendance</a></li>-->
                            </ul>
                            <div class="tab-content"><br/><br/>
                                <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <div class="form-group col-md-5">
                                                <div class="form-group">
                                                    <input type="hidden" id="user_level" name="user_level" value="<?php echo $ug_level ?>">
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
<!--                                            <div class="form-group col-md-5">							
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-md-3 control-label">Course Code:</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" id="course_id" name="course_id" value="">    
                                                            <option value="0">---Select Course Code---</option>
                                                        </select>
                                                    </div>				         
                                                </div>				
                                            </div>-->
<!--                                            <div class="col-md-2">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_mahapola_student_details('reject');">Search</button>
                                            </div>-->
                                        </div>
                                    </div>
                                <div role="tabpanel" class="tab-pane active" id="to_apprv_tab">
                                
                                   <div class="row">
                                        <div class="col-md-2" style="margin-left: 40%; margin-top: -4%;">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_staff_details('approve');">Search</button>
                                        </div>
                                    </div>     
                                
                                    <table id="staff_apprv" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Center</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_body">
                                            <?php
                                            $i = 1;
                                            if (!empty($result_array)) {
                                                foreach ($result_array as $va) {
                                                    ?>

                                                    <tr>
                                                        <td align="center"> <?php echo $i ?></td>
                                                        <td> <?php echo $va['title_name'] ." ".$va['stf_fname']. " ". $va['stf_lname'] ?></td>
                                                        <td> <?php echo $va['br_name'] ?></td>
                                                        <td> <?php echo $va['nic'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();staff_editview('<?php echo $va['stf_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($va["stf_id"]) ?>', '1','<?php print_r($va["staffindex"]) ?>','<?php print_r($va["nic"]) ?>', '<?php print_r($va["center_id"]) ?>','<?php print_r($va["stf_email"]) ?>','<?php print_r($va["email_sent_status"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                            <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($va["stf_id"]) ?>', '3','<?php print_r($va["staffindex"]) ?>','<?php print_r($va["nic"]) ?>', '<?php print_r($va["center_id"]) ?>','<?php print_r($va["stf_email"]) ?>','<?php print_r($va["email_sent_status"]) ?>')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="rejected_list_tab">
                                    <div class="row">
                                        <div class="col-md-2" style="margin-left: 40%; margin-top: -4%;">
                                            <button type="button" class="btn btn-primary btn-md" name="search" onclick="search_staff_details('reject');">Search</button>
                                        </div>
                                    </div>
                                    <table id="reject_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Center</th>
                                                <th>NIC No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rej_tbl_body">
                                            <?php
                                            $x = 1;
                                            if (!empty($reject_array)) {
                                                foreach ($reject_array as $rj) {
                                                    ?>

                                                    <tr>
                                                        <td align="center"> <?php echo $x ?></td>
                                                        <td> <?php echo $rj['title_name'] ." ".$rj['stf_fname']. " ". $rj['stf_lname'] ?></td>
                                                        <td> <?php echo $rj['br_name'] ?></td>
                                                        <td> <?php echo $rj['nic'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();staff_editview('<?php echo $rj['stf_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($rj["stf_id"]) ?>', '1','<?php print_r($rj["staffindex"]) ?>','<?php print_r($rj["nic"]) ?>', '<?php print_r($rj["center_id"]) ?>','<?php print_r($rj["stf_email"]) ?>','<?php print_r($rj["email_sent_status"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
<!--                                                            <button title="Reject" onclick="event.preventDefault();update_stu_apprv_status('<?php //print_r($rj["stu_id"]) ?>', '3')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>-->

                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $x++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
            
            $('#staff_apprv').DataTable({
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

            //load_course_list($("#center_id").val());
            
            //load_reject_course_list($("#center_id2").val());
            
        });


        function update_staff_apprv_status(stf_id, approved,staffindex, nic, center_id, stf_email, stf_email_status)
        {
            var title = "";
            
            if(approved == '1'){
                $("#dialog-confirm").html("Are you sure you want to approve this staff member ?");
                title = 'Approve Staff Members';
            }
            else{
               $("#dialog-confirm").html("Are you sure you want to reject this staff member ?"); 
               title = 'Reject Staff Members';
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
                            $.post("<?php echo base_url('approvals/change_staff_approval_status') ?>", {'stf_id':stf_id, 'approved':approved, 'staffindex':staffindex, 'nic':nic, 'center_id':center_id, 'stf_email':stf_email, 'stf_email_status':stf_email_status},
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
        
         function staff_editview(staff)
        {
            window.location = '<?php echo base_url("staff/staffprof_view") ?>?id='+ (window.btoa(staff)) +'&type=sfaff_approval';
            
            
        }
        
        //mahapola_application_view
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
   
    function search_staff_details(status)
    {
    $('.se-pre-con').fadeIn('slow');
        
        var center_id = $('#center_id').val();
        //var course_id = $('#course_id').val();
        
        if(status == 'approve'){
            
            $.post("<?php echo base_url('Approvals/search_staff_tobe_approve') ?>", {'center_id': center_id,  'status': status},//'course_id': course_id,
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
                    $('#staff_apprv').DataTable().destroy();
                    $('#staff_apprv').DataTable().clear().draw();
                        
                    if (data.length > 0) 
                    {
                        
                        for (j = 0; j < data.length; j++) {

                            number_content = "<td align='center'>" + (j + 1) + "</td>";
                                                                                                                                                                                            
                            action_content = "<td align='center'><a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_editview(" + data[j]['stf_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> | <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_staff_apprv_status(" + data[j]['stf_id'] + ", \""+1+"\", \"" +data[j]["staffindex"]+ "\", \"" +data[j]["nic"]+ "\", " +data[j]["center_id"]+ ", \"" +data[j]["stf_email"]+ "\", " +data[j]["email_sent_status"]+ ")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> | <button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_staff_apprv_status(" + data[j]['stf_id'] + ", \""+3+"\", \"" +data[j]["staffindex"]+ "\", \"" +data[j]["nic"]+ "\", " +data[j]["center_id"]+ ", \"" +data[j]["stf_email"]+ "\", " +data[j]["email_sent_status"]+ ")' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button></td>";
                            
                            
                            $('#staff_apprv').DataTable().row.add([
                                number_content,
                                data[j]['title_name'] + " "+ data[j]['stf_fname'] + " " +data[j]['stf_lname'],
                                data[j]['br_name'],
                                data[j]['nic'],
                                action_content
                            ]).draw(false);
                            $('.se-pre-con').fadeOut('slow');
                        }
                    }
                }
            $('.se-pre-con').fadeOut('slow');
            },
            "json"
            );
        }
        else{
        
            $.post("<?php echo base_url('Approvals/search_staff_tobe_approve') ?>", {'center_id': center_id,  'status': status},//'course_id': course_id,
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
                                                                                                                                                                                                                                                                                                                                                                                                                                            
                            action_content = "<td align='center'><a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();staff_editview(" + data[j]['stf_id'] + ")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a> | <button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_staff_apprv_status(" + data[j]['stf_id'] + ", \""+1+"\", \"" +data[j]["staffindex"]+ "\", \"" +data[j]["nic"]+ "\", " +data[j]["center_id"]+ ", \"" +data[j]["stf_email"]+ "\", " +data[j]["email_sent_status"]+ ")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button></td>";
                            
                            $('#reject_list').DataTable().row.add([
                                number_content,
                                data[j]['title_name'] + " "+ data[j]['stf_fname'] + " " +data[j]['stf_lname'],
                                data[j]['br_name'],
                                data[j]['nic'],
                                action_content
                            ]).draw(false);
                            $('.se-pre-con').fadeOut('slow');
                        }
                    }
                    $('.se-pre-con').fadeOut('slow');
                }
            },
            "json"
            );
        }

        


    }
      
    </script>





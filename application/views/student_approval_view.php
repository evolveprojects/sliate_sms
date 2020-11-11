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
            <li><i class="fa fa-users"></i>Student Approvals</li>
        </ol>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lookup_tab">
        <div class="panel">
            <div class="panel-heading">
                Student Approvals
            </div>
            <hr>   
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label for="inputEmail3" id="lbl_course" class="col-md-3 control-label">Year : </label>
                                <div class="col-md-9">
                                    <select class="form-control" id="mp_sum_year" name="mp_sum_year" onchange="" data-validation="required">
                                        <option value="">---Select Year---</option>
                                        <?php
                                        foreach ($year_list as $yr):

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
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-md" id="search" name="search" onclick="load_stu_approval_data(null);">Search</button>
                            </div>
                    </div>
                </div>
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
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="to_apprv_tab">
                                
<!--                                    <p id="text_load" style="text-align:center;"><img src="../img/loading_img.gif" id="loading-indicator" style="display:none" /></br>Loading..</p>-->
                                
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
                                                        <td align="center"> <?php // echo $i ?></td>
                                                        <td> <?php // echo $va['reg_no'] ?></td>
                                                        <td> <?php // echo $va['first_name'] //. " " . $va['last_name'] ?></td>
                                                        <td> <?php // echo $va['nic_no'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php echo $va['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '1', '<?php print_r($va["reg_no"]) ?>', '<?php print_r($va["nic_no"]) ?>', '<?php print_r($va["center_id"]) ?>', '<?php print_r($va["email"]) ?>', '<?php print_r($va["email_sent_status"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                            <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($va["stu_id"]) ?>', '3', '<?php print_r($va["reg_no"]) ?>', '<?php print_r($va["nic_no"]) ?>', '<?php print_r($va["center_id"]) ?>', '<?php print_r($va["email"]) ?>', '<?php print_r($va["email_sent_status"]) ?>')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>
                                                    </tr>-->

                                                    <?php
//                                                    $i++;
//                                                }
//                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="rejected_list_tab">
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
//                                            $x = 1;
//                                            if (!empty($reject_array)) {
//                                                foreach ($reject_array as $rj) {
//                                                    ?>

<!--                                                    <tr>
                                                        <td align="center"> <?php echo $x ?></td>
                                                        <td> <?php // echo $rj['reg_no'] ?></td>
                                                        <td> <?php // echo $rj['first_name'] //. " " . $rj['last_name'] ?></td>
                                                        <td> <?php // echo $rj['nic_no'] ?></td>
                                                        <td align="center">
                                                            <a data-toggle="tooltip" title="View Profile" class="btn btn-default btn-xs" onclick="event.preventDefault();stueditview('<?php echo $rj['stu_id'] ?>')"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a> |
                                                            <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($rj["stu_id"]) ?>', '1', '<?php print_r($rj["reg_no"]) ?>', '<?php print_r($rj["nic_no"]) ?>', '<?php print_r($rj["center_id"]) ?>', '<?php print_r($rj["email"]) ?>', '<?php print_r($rj["email_sent_status"]) ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                                                            <button title="Reject" onclick="event.preventDefault();update_stu_apprv_status('<?php //print_r($rj["stu_id"]) ?>', '3')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                        </td>
                                                    </tr>-->

                                                    <?php
//                                                    $x++;
//                                                }
//                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
    <!--                            <div role="tabpanel" class="tab-pane" id="attendance_tab"><br>
                                    <div class="container">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Attendance</div>
                                            <div class="panel-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
    <!--                            <div role="tabpanel" class="tab-pane" id="subject_tab"><br>
                                    <div class="container">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Subjects</div>
                                            <div class="panel-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">Assigned Faculty :<b> <?php echo $stf_prof['faculty_name']; ?> </b></li>
                                                </ul>
                                                <table class="table table-striped" id="subjects_table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Code</th>
                                                            <th>Subject</th>
                                                            <th>Hourly Rate</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (count($subjects) > 0) {
                                                            for ($i = 0; $i < count($subjects); $i++) {
                                                                ?>
                                                                <tr>
                                                                    <th scope="row"><?php echo $i + 1; ?></th>
                                                                    <td align="center"><?php echo $subjects[$i]['code'] ?></td>
                                                                    <td align="center"><?php echo $subjects[$i]['subject'] ?></td>
                                                                    <td align="center"><?php echo $subjects[$i]['hourly_rate'] ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="4" align="center">There are no assigned subjects.</td>

                                                            </tr>
                                                        <?php }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
    <!--                            <div role="tabpanel" class="tab-pane" id="achive_tab"><br/>
                                    <div class="container">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Achievements</div>
                                            <div class="panel-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <b>Research Interest</b><br/>
                                                        <?php
                                                        if (($stf_prof['research_interest'] != NULL) && ($stf_prof['research_interest'] != "")) {
                                                            echo $stf_prof['research_interest'];
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Publications</b><br/>
                                                        <?php
                                                        if (($stf_prof['publications_achive'] != NULL) && ($stf_prof['publications_achive'] != "")) {
                                                            echo $stf_prof['publications_achive'];
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Awards</b><br/>
                                                        <?php
                                                        if (($stf_prof['awards_achive'] != NULL) && ($stf_prof['awards_achive'] != "")) {
                                                            echo $stf_prof['awards_achive'];
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Memberships</b><br/>
                                                        <?php
                                                        if (($stf_prof['memberships_achive'] != NULL) && ($stf_prof['memberships_achive'] != "")) {
                                                            echo $stf_prof['memberships_achive'];
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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

        $.validate({
            form: '#stu_reg'
        });
        
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
            
        });


        function update_stu_apprv_status(student_id, approved, reg_no, nic, branch, email, email_sent_status)
        {
            $('.se-pre-con').fadeIn('slow');
            
            var year = $('#mp_sum_year').val();
            console.info(year);
            var title = "";
            
            if(approved == '1'){
                $("#dialog-confirm").html("Do you really want to approve this student?");
                title = 'Approve Student';
                $('.se-pre-con').fadeOut('slow');
            }
            else{
                $("#dialog-confirm").html("Do you really want to reject this student?");
                title = 'Reject Student';
                $('.se-pre-con').fadeOut('slow');
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
                            $.post("<?php echo base_url('approvals/change_student_approval_status') ?>", {'student_id': student_id, 'approved': approved, 'reg_no': reg_no, 'nic': nic, 'branch': branch, 'email': email, 'email_sent_status': email_sent_status},
                            function (data)
                            {
//                                location.reload();
                                $('#mp_sum_year').val(year);
                                load_stu_approval_data(year);
                                
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
                //$('.se-pre-con').fadeOut('slow');
            }).prev(".ui-dialog-titlebar").css({'background':'#74caee', 'border-color': '#74caee'});
       
        }
        
         function stueditview(stu)
        {

           // window.location = '<?php //echo base_url("approvals/apprvstuprof_view") ?>?id=' + stu;
            
          //  window.location = '<?php // echo base_url("student/stuprof_view") ?>?id=' + (window.btoa(stu)) +'&type=approval';
            window.open('<?php echo base_url("student/stuprof_view") ?>?id=' + (window.btoa(stu)) +'&type=approval');
            return false;
        }
      
      function load_stu_approval_data(year){
          console.info(year);
          $('.se-pre-con').fadeIn('slow');
          if(year == null){
              year = $('#mp_sum_year').val();
          } 
          

        $('#stu_apprv').DataTable().clear().draw();
        $('#reject_list').DataTable().clear().draw();

            $.post("<?php echo base_url('Approvals/get_student_approval_data') ?>", {'year':year},
                function (data)
                {
                    console.log(data);
                    if (data == 'denied')
                    {
                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                        result_notification(funcres);
                    } else
                    {
                        var t = 1;
                        if (data['result_array'].length > 0)
                        {
                           
                            for (j = 0; j < data['result_array'].length; j++) {
                                var profile_content = "<a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview("+ data['result_array'][j]['stu_id']+")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a>";
//                                var approve_content = "<button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_stu_apprv_status("+data['result_array'][j]['stu_id']+", 1, \""+data['result_array'][j]['reg_no']+"\", \""+data['result_array'][j]['nic_no']+"\", "+data['result_array'][j]['center_id']+", \""+data['result_array'][j]['email']+"\","+data['result_array'][j]['email_sent_status']+")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
//                                var reject_content = "<button data-toggle='tooltip' title='Reject' onclick='event.preventDefault();update_stu_apprv_status("+data['result_array'][j]['stu_id']+", 3, \""+data['result_array'][j]['reg_no']+"\", \""+data['result_array'][j]['nic_no']+"\", "+data['result_array'][j]['center_id']+", \""+data['result_array'][j]['email']+"\", "+data['result_array'][j]['email_sent_status']+")' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                                $('#stu_apprv').DataTable().row.add([
                                    t,
                                    data['result_array'][j]['reg_no'],
                                    data['result_array'][j]['first_name'], //+" "+data['result_array'][j]['last_name']
                                    data['result_array'][j]['nic_no'],
                                    profile_content 
                                    //,''
                                ]).draw(false);

                                t++;
                            }
                        } 
                        
                        var a = 1;
                        if (data['reject_array'].length > 0)
                        {
                           
                            for (i = 0; i < data['reject_array'].length; i++) {
                                var prof_view = "<a data-toggle='tooltip' title='View Profile' class='btn btn-default btn-xs' onclick='event.preventDefault();stueditview("+data['reject_array'][i]['stu_id']+")'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></a>";
                                var approve_view = "<button data-toggle='tooltip' title='Approve' onclick='event.preventDefault();update_stu_apprv_status("+data['reject_array'][i]['stu_id']+", 1, \""+data['reject_array'][i]['reg_no']+"\", \""+data['reject_array'][i]['nic_no']+"\", "+data['reject_array'][i]['center_id']+", \""+data['reject_array'][i]['email']+"\","+data['reject_array'][i]['email_sent_status']+")' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";

                                $('#reject_list').DataTable().row.add([
                                    a,
                                    data['reject_array'][i]['reg_no'],
                                    data['reject_array'][i]['first_name'] +" "+data['reject_array'][i]['last_name'],
                                    data['reject_array'][i]['nic_no'],
                                    prof_view+" | "+approve_view
                                ]).draw(false);

                                a++;
                            }
                        }
                        
                        
                    }
                    $('.se-pre-con').fadeOut('slow');
                },
                "json"
                );
        
      }
    </script>





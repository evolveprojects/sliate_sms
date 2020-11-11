<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STAFF PROFILE VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-bank"></i>Profile View</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading">
                Staff Member :<b> <?php echo $stf_prof['title_name'] . " " . $stf_prof['stf_fname'] . ' ' . $stf_prof['stf_lname']; ?></b>
            </header>
            <div class="panel-body">
                <!--<div class="col-md-5">
                    <br/><br/><br/>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th colspan="3"> Personal Details</th>
                            </tr>
                            <tr>
                                <td>Full Name </td>
                                <td width="20">:</td>
                                <td><b><?php echo $stf_prof['title_name'] . " " . $stf_prof['stf_fname'] . ' ' . $stf_prof['stf_lname']; ?></b></td>
                            </tr>

                            <tr>
                                <td>Permanent Address </td>
                                <td width="20">:</td>
                                <td><b><?php echo $stf_prof['stf_address']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Nationality </td>
                                <td width="10">:</td>
                                <td><b><?php echo $stf_prof['stf_national']; ?></b></td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Mobile Number </td>
                                <td width="20">:</td>
                                <td><b><?php echo $stf_prof['stf_mobi']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Home Number </td>
                                <td width="20">:</td>
                                <td><b><?php echo $stf_prof['stf_home']; ?></b></td>
                            </tr>
                            <tr>
                                <td>E-Mail Address </td>
                                <td width="10">:</td>
                                <td><b><?php echo $stf_prof['stf_email']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Marital Status </td>
                                <td width="20">:</td>
                                <td><b><?php
                                        if ($stf_prof['stf_marital'] == '1') {

                                            echo "Married";
                                        } else {

                                            echo "Unmarried";
                                        }
                                        ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>-->
                <div class="col-md-12" >
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a class="fa fa-user" href="#info_tab" aria-controls="info_tab" role="tab" data-toggle="tab"> Personal Info.</a></li>
                            <li role="presentation"><a class="fa fa-university" href="#quli_tab" aria-controls="quli_tab" role="tab" data-toggle="tab"> Others</a></li>
                            <!--<li role="presentation"><a class="fa fa-graduation-cap" href="#achive_tab" aria-controls="achive_tab" role="tab" data-toggle="tab"> Achievements</a></li>-->
                            <li role="presentation"><a class="fa fa-book" href="#subject_tab" aria-controls="subject_tab" role="tab" data-toggle="tab"> Subjects</a></li>
                            <li role="presentation"><a class="fa fa-edit" href="#attendance_tab" aria-controls="attendance_tab" role="tab" data-toggle="tab"> Attendance</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info_tab">
                                <br/><br>
				<div class="container" style="width: 60%; float: left;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Personal Details</div>
                                        <div class="panel-body">
                                            <table class="table table-striped">
                                                    <tbody>
                                                            <!--<tr>
                                                                    <th colspan="3"> Personal Details</th>
                                                            </tr>-->
                                                            <tr>
                                                                    <td>Full Name </td>
                                                                    <td width="20">:</td>
                                                                    <td><b><?php echo $stf_prof['title_name'] . " " . $stf_prof['stf_fname'] . ' ' . $stf_prof['stf_lname']; ?></b></td>
                                                            </tr>

                                                            <tr>
                                                                    <td>Permanent Address </td>
                                                                    <td width="20">:</td>
                                                                    <td><b><?php echo $stf_prof['stf_address']; ?></b></td>
                                                            </tr>
<!--                                                            <tr>
                                                                    <td>Nationality </td>
                                                                    <td width="10">:</td>
                                                                    <td><b><?php //echo $stf_prof['stf_national']; ?></b></td>
                                                            </tr>-->
                                                            <tr>
                                                            <tr>
                                                                    <td>Mobile Number </td>
                                                                    <td width="20">:</td>
                                                                    <td><b><?php echo $stf_prof['stf_mobi']; ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>Home Number </td>
                                                                    <td width="20">:</td>
                                                                    <td><b><?php echo $stf_prof['stf_home']; ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>E-Mail Address </td>
                                                                    <td width="10">:</td>
                                                                    <td><b><?php echo $stf_prof['stf_email']; ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>Marital Status </td>
                                                                    <td width="20">:</td>
                                                                    <td><b><?php
                                                                        if ($stf_prof['stf_marital'] == '1') {

                                                                                echo "Married";
                                                                        } else {

                                                                                echo "Unmarried";
                                                                        }
                                                                        ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>Designation </td>
                                                                    <td width="10">:</td>
                                                                    <td><b><?php echo $stf_prof['designation']; ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                    <td>Qualification</td>
                                                                    <td width="10">:</td>
                                                                    <td><b><?php echo $stf_prof['qualification']; ?></b></td>
                                                            </tr>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4" style="margin-left: 10px;">
                                    <label style="width: 320px; text-align: center; padding-right: 45px;" for="staffprof_pic" align="center">Profile Picture</label>
                                        <br/>
                                        <br/>
                                        <div class="col-md-4">
                                            <?php
                                            $profpic = $stf_prof['profileimage'];
                                            
                                            if($stf_prof['profileimage'] == ""  || $stf_prof['profileimage']==null)
                                            {
                                                $profpic ="uploads/defprof.png";
                                            }
                                            
                                            ?>
                                            
                                            <img src="<?php echo base_url().$profpic ?>" style="width:250px; height:285px;"/>
                                            
                                        </div>
                                        </div>
                                                        
                                                        
                            </div>
                            <div role="tabpanel" class="tab-pane" id="quli_tab"><br>
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Other Details</div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <?php echo $stf_prof['research_interest']; ?>
                                                <?php
//                                                if (count($qualifications) > 0) {
//                                                    for ($i = 0; $i < count($qualifications); $i++) {
//                                                        ?>
                                                        <!--<li class="list-group-item"><b>//<?php echo $qualifications[$i]['research_interest']; ?></b><br/><?php echo $qualifications[$i]['description']; ?></li>--> 
                                                        <?php
//                                                    }
//                                                } else {
//                                                    ?>
                                                    <!--<li class="list-group-item">There are no assigned qualifications.</li>--> 
                                                <?php // } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="attendance_tab"><br>
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Attendance</div>
                                        <div class="panel-body">
                                            There are no attendance to show.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="subject_tab"><br>
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Subjects</div>
                                        <div class="panel-body">
<!--                                            <ul class="list-group">
                                                <li class="list-group-item">Assigned Faculty :<b> <?php //echo $stf_prof['faculty_name']; ?> </b></li>
                                            </ul>-->
                                            <?php
                                            if (count($subjects) > 0) {
                                                ?>
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
                                            <?php 
                                            }else{
                                               ?>
                                               There are no assigned subjects. 
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="achive_tab"><br/>
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
                            </div>
                        </div>
                    </div>
                    
                </div><br><br>
                <div class="col-md-6">
                
                <?php 
                            if(isset($type)){
                            if($access_function['user_rights']['rgt_id'] != null){
                            ?>
                                <button style="width: 100px" onclick="event.preventDefault();load_staff_edit_view('<?php print_r($stf);?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Edit</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($stf) ?>', '1', '<?php print_r($stf_prof['staffindex'])?>','<?php print_r($stf_prof['nic']) ?>','<?php print_r($stf_prof['center_id']) ?>','<?php print_r($stf_prof['stf_email']) ?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($stf) ?>', '3', '<?php print_r($stf_prof['staffindex'])?>','<?php print_r($stf_prof['nic']) ?>','<?php print_r($stf_prof['center_id']) ?>','<?php print_r($stf_prof['stf_email']) ?>')" class='btn btn-warning btn-md'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject</button>
                                
                    <?php
                    }
                    else{

                        if($access_function['user_level']['ug_level'] == 1){
                    ?>
                                <button style="width: 100px" onclick="event.preventDefault();load_staff_edit_view('<?php print_r($stf);?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Edit</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($stf) ?>', '1', '<?php print_r($stf_prof['staffindex'])?>','<?php print_r($stf_prof['nic']) ?>','<?php print_r($stf_prof['center_id']) ?>','<?php print_r($stf_prof['stf_email']) ?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_staff_apprv_status('<?php print_r($stf) ?>', '3', '<?php print_r($stf_prof['staffindex'])?>','<?php print_r($stf_prof['nic']) ?>','<?php print_r($stf_prof['center_id']) ?>','<?php print_r($stf_prof['stf_email']) ?>')" class='btn btn-warning btn-md'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject</button>
                        <?php
                        }
                    }
                    }
                    ?>
                </div>
            </div>
             
        </div>
    </div>
    
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript">
    
    function update_staff_apprv_status(stf_id, approved, staffindex, nic, center_id, stf_email)
    {
        $.post("<?php echo base_url('approvals/change_staff_approval_status') ?>", {'stf_id': stf_id, 'approved': approved,staffindex:staffindex,nic:nic,center_id:center_id, stf_email:stf_email},
        function (data)
        {
            //location.reload();
            window.location = '<?php echo base_url("approvals/staff_approvals") ?>';
        },
        "json"
        );
    }
    $(document).ready(function () {
        $('#subjects_table').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 20]
        });
    });
    
    function load_staff_edit_view(staff)
    {
        window.location = '<?php echo base_url("staff/staffeditview") ?>?id=' + (window.btoa(staff))+"&type=edit";

    }    
    
</script>
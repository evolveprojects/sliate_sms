<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT PROFILE VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Student</li>
            <li><i class="fa fa-bank"></i>Profile View</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading">
                Registration Number :<b> <?php echo $stu_data['reg_no']; ?></b>&nbsp;&nbsp;&nbsp;
                Student Name :<b> <?php echo $stu_data['first_name'] //. ' ' . $stu_data['last_name']; ?></b>
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a class="fa fa-user" href="#info_tab" aria-controls="info_tab" role="tab" data-toggle="tab"> Personal Info.</a></li>
                            <li role="presentation"><a class="fa fa-university" href="#acad_tab" aria-controls="acad_tab" role="tab" data-toggle="tab"> Academic Info</a></li>
                            <!--<li role="presentation"><a class="fa fa-graduation-cap" href="#achive_tab" aria-controls="achive_tab" role="tab" data-toggle="tab"> Achievements</a></li>-->
                            <li role="presentation"><a class="fa fa-book" href="#subject_tab" aria-controls="subject_tab" role="tab" data-toggle="tab"> Subjects</a></li>
                            <!--<li role="presentation"><a class="fa fa-edit" href="#attendance_tab" aria-controls="attendance_tab" role="tab" data-toggle="tab"> Attendance</a></li>-->
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info_tab">
                                <br/><br/>
                                <div class="container" style="width: 60%; float: left;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Personal Details</div>
                                        <div class="panel-body">
                                            
                                            <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Full Name </td>
                                                    <td width="20">:</td>
                                                    <td><b><?php echo $stu_data['first_name'] //. ' ' . $stu_data['last_name']; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>NIC Number </td>
                                                    <td width="10">:</td>
                                                    <td><b><?php echo $stu_data['nic_no']; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>District </td>
                                                    <td width="20">:</td>
                                                    <td><b><?php echo $stu_data['district']; ?></b></td>
                                                </tr>

                                                <tr>
                                                <tr>
                                                    <td>Mobile Number </td>
                                                    <td width="20">:</td>
                                                    <td><b><?php echo $stu_data['mobile_no']; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Home Number </td>
                                                    <td width="20">:</td>
                                                    <td><b><?php echo $stu_data['fixed_tp']; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Address </td>
                                                    <td width="20">:</td>
                                                    <td><b><?php echo $stu_data['permanent_address']; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>E-Mail Address </td>
                                                    <td width="10">:</td>
                                                    <td><b><?php echo $stu_data['email']; ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Birth </td>
                                                    <td width="10">:</td>
                                                    <td><b><?php echo $stu_data['birth_date']; ?></b></td>
                                                </tr>
<!--                                                <tr>
                                                    <td>NIC </td>
                                                    <td width="10">:</td>
                                                    <td><b><?php echo $stu_data['nic_no']; ?></b></td>
                                                </tr>-->
                                                <tr>
                                                    <td>Gender </td>
                                                    <td width="10">:</td>
                                                    <td><b>
                                                        <?php
                                                        if($stu_data['sex'] == "M"){
                                                            echo "Male";
                                                        }elseif($stu_data['sex'] == "F"){
                                                            echo "Female";
                                                        }else{
                                                            echo "-";
                                                        } ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Civil Status </td>
                                                    <td width="10">:</td>
                                                    <td><b><?php
                                                        if($stu_data['civil_status'] == "S"){
                                                            echo "Single";
                                                        }elseif($stu_data['civil_status'] == "M"){
                                                            echo "Married";
                                                        }else{
                                                            echo "-";
                                                        }
                                                        ?></b></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Religion </td>
                                                    <td width="10">:</td>
                                                    <td><b><?php 
                                                    echo $stu_data['rel_name']; ?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4" style="margin-left: 40px;">
                                        <label style="width: 320px; text-align: center;" for="stuprof_pic" align="center">Profile Picture</label>
                                        <br/>
                                        <br/>
                                        <div class="col-md-4">
                                            <?php
                                            $profpic = $stu_data['profileimage'];
                                            
                                            if($stu_data['profileimage'] == ""  || $stu_data['profileimage']==null)
                                            {
                                                $profpic ="uploads/defprof.png";
                                            }
                                            
                                            ?>
                                            
                                            <img src="<?php echo base_url().$profpic ?>" style="width:300px;"/>
                                            
                                        </div>
                                        </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="acad_tab"><br>
                                <div class="container" style="width: 60%; float: left;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">GCE A/Ls</div>
                                        <div class="panel-body">
                                            <table class="table" style="font-size: 12px;">
                                                <tr>
                                                    <td width="150">Year</td><td width="20">:</td><td><?php echo $stu_data['al_year'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Index Number</td><td width="20">:</td><td><?php echo $stu_data['al_index_no'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Stream</td><td width="20">:</td><td><?php echo $stu_data['stream_name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Subjects</td><td width="20">:</td><td><table>
                                                            <thead style="background-color: #eff4f7; ">
                                                                <tr>
                                                                    <th >Subject</th>
                                                                    <th>Grade</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    if($stu_data['al_grade1'] == "F"){
                                                                ?>
                                                                <tr style="background-color:#ff7c7c">
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <tr>
                                                                <?php } ?>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_sub1'] ?></td>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_grade1']?></td>
                                                                </tr>
                                                                <?php
                                                                    if($stu_data['al_grade2'] == "F"){
                                                                ?>
                                                                <tr style="background-color:#ff7c7c">
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <tr>
                                                                <?php } ?>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_sub2'] ?></td>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_grade2']?></td>
                                                                </tr>
                                                                <?php
                                                                    if($stu_data['al_grade3'] == "F"){
                                                                ?>
                                                                <tr style="background-color:#ff7c7c">
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <tr>
                                                                <?php } ?>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_sub3'] ?></td>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_grade3']?></td>
                                                                </tr>
                                                                <?php
                                                                    if($stu_data['al_grade4'] == "F"){
                                                                ?>
                                                                <tr style="background-color:#ff7c7c">
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <tr>
                                                                <?php } ?>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_sub4'] ?></td>
                                                                    <td style="border: solid white;"><?php echo $stu_data['al_grade4']?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- <?php echo $stu_data['al_sub1'] ." - "  . $stu_data['al_grade1']?><br>
                                                        <?php echo $stu_data['al_sub2'] ." - "  . $stu_data['al_grade2']?><br>
                                                        <?php echo $stu_data['al_sub3'] ." - "  . $stu_data['al_grade3']?><br>
                                                        <?php echo $stu_data['al_sub4'] ." - "  . $stu_data['al_grade4']?><br> -->
                                                            <!--//$stu_data['subject_name'] ."     -      " .$stu_data['al_subject2_grade']."/".$stu_data['al_subject3']."-".$stu_data['al_subject3_grade']."/".$stu_data['al_subject4']."-".$stu_data['al_subject1_grade']--> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Z-core</td><td width="20">:</td><td><?php echo $stu_data['al_z_core'] ?></td>
                                                </tr>
                                                <?php if( $stu_data['common_gen_paper_index_no'] != null || $stu_data['common_gen_paper_index_no'] != "") 
                                                    
                                                    echo '<tr>'
                                                    . '<td width="150">Common General paper Index No : </td><td width="20">:</td><td>'. $stu_data['common_gen_paper_index_no']. '</td>'
                                                        . '</tr>';
                                                ?>
                                                
                                                <tr>
                                                    <td width="150">Common General Paper Marks</td><td width="20">:</td><td><?php echo $stu_data['common_gen_paper'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">District</td><td width="20">:</td><td><?php echo $stu_data['district'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">GCE O/Ls</div>
                                        <div class="panel-body">
                                            <table style="width:50%">
                                                <tr>
                                                    <th></th>
                                                    <th style="background-color: #eff4f7;">Maths</th>
                                                    <th style="background-color: #eff4f7;">English</th> 
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right;background-color: #eff4f7;">Grade</th>
                                                    <?php
                                                        if($stu_data['maths_grade'] == "F"){
                                                    ?>
                                                    <td style="text-align:center;background-color: #ff7c7c"><label><?php echo $stu_data['maths_grade'] ?></label></td>
                                                        <?php
                                                    }else{
                                                    ?>
                                                    <td style="text-align:center"><label><?php echo $stu_data['maths_grade'] ?></label></td>
                                                    <?php } ?>
                                                    
                                                    <?php
                                                        if($stu_data['eng_grade'] == "F"){
                                                    ?>
                                                    <td style="text-align:center;background-color: #ff7c7c"><label><?php echo $stu_data['eng_grade'] ?></label></td>
                                                        <?php
                                                    }else{
                                                    ?>
                                                    <td style="text-align:center"><label><?php echo $stu_data['eng_grade'] ?></label></td>
                                                    <?php } ?>
                                                    
                                                    <!--<td style="text-align:center"><label><?php //echo $stu_data['maths_grade'] ?></label></td>-->
                                                    <!--<td style="text-align:center"><label><?php //echo $stu_data['eng_grade'] ?></label></td>-->
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right;background-color: #eff4f7;">Index No</th>
                                                    <td style="text-align:center"><label><?php echo $stu_data['ol_index_no'] ?></label></td>
                                                    <td style="text-align:center"><label><?php echo $stu_data['ol_english_index_no'] ?></label></td>
                                                </tr>
                                                <tr>
                                                    <th style="text-align:right;background-color: #eff4f7;">Year</th>
                                                    <td style="text-align:center"><label><?php echo $stu_data['ol_year'] ?></label></td>
                                                    <td style="text-align:center"><label><?php echo $stu_data['ol_english_year'] ?></label></td>
                                                </tr>
                                              </table>
                                            
<!--                                            <table class="table" style="font-size: 12px">
                                                <tr>
                                                    <td width="150">Maths</td>
                                                    <td width="20">:</td>
                                                    <td><?php //echo $stu_data['ol_year'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Year</td>
                                                    <td width="20">:</td>
                                                    <td><?php //echo $stu_data['ol_year'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Index No</td>
                                                    <td width="20">:</td>
                                                    <td><?php //echo $stu_data['ol_index_no'] ?></td>
                                                </tr>
                                                <?php
                                                    if($stu_data['maths_grade'] == "F"){
                                                ?>
                                                <tr style="background-color:#ff7c7c">
                                                <?php
                                                    }else{
                                                ?>
                                                    <tr>
                                                <?php } ?>
                                                    <td width="150">Mathematics</td><td width="20">:</td><td><?php echo $stu_data['maths_grade'] ?></td>
                                                </tr>
                                                <?php
                                                    if($stu_data['maths_grade'] == "F"){
                                                ?>
                                                <tr style="background-color:#ff7c7c">
                                                <?php
                                                    }else{
                                                ?>
                                                    <tr>
                                                <?php } ?>
                                                    <td width="150">English</td><td width="20">:</td><td><?php echo $stu_data['eng_grade'] ?></td>
                                                </tr>
                                            </table>-->
                                        </div>
                                    </div>
                                </div>
                                <?php 
                            if(isset($type)){
                            if($access_function['user_rights']['rgt_id'] != null){
                            ?>
                            <div style="width: 100%; float: left; margin-left: 1.3%;">
                                <button style="width: 100px" onclick="event.preventDefault();load_stueditview('<?php echo $stu_data["stu_id"];?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Edit</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($stu_data["stu_id"]) ?>', '1', '<?php print_r($stu_data["reg_no"]) ?>', '<?php print_r($stu_data["nic_no"]) ?>', '<?php print_r($stu_data["center_id"]) ?>', '<?php print_r($stu_data["email"]) ?>', '<?php print_r($stu_data["email_sent_status"]) ?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($stu_data["stu_id"]) ?>', '3', '<?php print_r($stu_data["reg_no"]) ?>', '<?php print_r($stu_data["nic_no"]) ?>', '<?php print_r($stu_data["center_id"]) ?>', '<?php print_r($stu_data["email"]) ?>', '<?php print_r($stu_data["email_sent_status"]) ?>')" class='btn btn-warning btn-md'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject</button>
                            </div>
                            <?php
                            }
                            else{
                           
                                if($access_function['user_level']['ug_level'] == 1){
                            ?>
                            <div style="width: 100%; float: left; margin-left: 1.3%;">
                                <button style="width: 100px" onclick="event.preventDefault();load_stueditview('<?php echo $stu_data["stu_id"];?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>Edit</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($stu_data["stu_id"]) ?>', '1', '<?php print_r($stu_data["reg_no"]) ?>', '<?php print_r($stu_data["nic_no"]) ?>', '<?php print_r($stu_data["center_id"]) ?>', '<?php print_r($stu_data["email"]) ?>', '<?php print_r($stu_data["email_sent_status"]) ?>')" class='btn btn-info btn-md'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>Approve</button> |
                                <button style="width: 100px" onclick="event.preventDefault();update_stu_apprv_status('<?php print_r($stu_data["stu_id"]) ?>', '3', '<?php print_r($stu_data["reg_no"]) ?>', '<?php print_r($stu_data["nic_no"]) ?>', '<?php print_r($stu_data["center_id"]) ?>', '<?php print_r($stu_data["email"]) ?>', '<?php print_r($stu_data["email_sent_status"]) ?>')" class='btn btn-warning btn-md'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span>Reject</button>
                            </div>
                            <?php
                                }
                            }
                            }
                            ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="subject_tab"><br>
                                <div class="container" style="width: 60%; float: left;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Current Subjects</div>
                                        <div class="panel-body">
                                            <table class="table" style="font-size: 12px">
                                                <tr>
                                                    <th width="150">Subject Code</th><th>Subject</th><th>Core/Elective</th>
                                                </tr>
                                                <?php
                                                if (count($stu_subjects) > 0) {
                                                    //foreach ($stu_subjects as $row) {
                                                    for ($i=0; $i<count($stu_subjects); $i++){
                                                        $pre_year = 0;
                                                        $pre_semester = 0;
                                                        
                                                        $year = $stu_subjects[$i]['year_no'];
                                                        if($i != 0){
                                                            $pre_year = $stu_subjects[$i-1]['year_no'];
                                                        }
                                                        $semester = $stu_subjects[$i]['semester_no'];
                                                        if($i != 0){
                                                            $pre_semester = $stu_subjects[$i-1]['semester_no'];
                                                        }
                                                        
                                                        if($year != $pre_year){
                                                        ?>
                                                            <tr align="left" style="background: #D7D7D7">
                                                                <td width="150"><b><?php echo $year. " Year - ". $semester . " Semester" ?></b></td><td></td><td></td>
                                                            </tr>
                                                        <?php 
                                                        }
                                                        else{
                                                            if($semester != $pre_semester){
                                                            ?>
                                                                <tr align="left" style="background: #D7D7D7">
                                                                    <td width="150"><b><?php echo $year. " Year - ". $semester . " Semester"?></b></td><td></td><td></td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            else{
                                                        ?>
                                                        <tr align="center">
                                                            <td width="150"><?php echo $stu_subjects[$i]['code'] ?></td><td><?php echo $stu_subjects[$i]['subject'] ?></td><td><?php
                                                                if ($stu_subjects[$i]['type'] == 1) {
                                                                    echo 'Core';
                                                                } else {
                                                                    echo 'Elective';
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <tr align="center">
                                                        <th>There are no records to show</th>
                                                    </tr>
                                                <?php } ?>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="attendance_tab"><br>
                                <div class="container" style="width: 60%; float: left;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Attendance</div>
                                        <div class="panel-body">
                                            There are no attendance to show.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="achive_tab"><br/>
                                <div class="container" style="width: 60%; float: left;">
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#subjects_table').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 20]
        });
    });
    
    function update_stu_apprv_status(student_id, approved, reg_no, nic, branch, email, email_sent_status)
    {
        $.post("<?php echo base_url('approvals/change_student_approval_status') ?>", {'student_id': student_id, 'approved': approved, 'reg_no': reg_no, 'nic': nic, 'branch': branch, 'email': email, 'email_sent_status': email_sent_status},
        function (data)
        {
            //location.reload();
            window.location = '<?php echo base_url("approvals/student_approvals") ?>';
        },
        "json"
        );
    }
    
    function load_stueditview(stu)
    {
        $.post("<?php echo base_url('student/set_studentdatasession')?>",{'id':stu},
        function(data)
        {
           if(data)
           {
                load_edit_page('edit');
           } 
        },  
        "json"
        );
    }

    function load_edit_page(type)
    {
        window.location = '<?php echo base_url("student/load_stueditview")?>?type='+type;
    }
    
    function update_stu_mahapola_apprv_status(student_id, approved, reg_no, nic, branch)
    {
        $.post("<?php echo base_url('approvals/change_student_mahapola_approval_status') ?>", {'student_id': student_id, 'approved': approved, 'reg_no': reg_no, 'nic': nic, 'branch': branch},
        function (data)
        {
            location.reload();
        },
        "json"
        );
    }


</script>

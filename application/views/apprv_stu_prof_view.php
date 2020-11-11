<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> STUDENT PROFILE VIEW</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Approvals</li>
            <li><i class="fa fa-bank"></i>Profile View</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading">
                Registration Number :<b> <?php echo $stu_data['reg_no']; ?></b>&nbsp;&nbsp;&nbsp;
                Student Name :<b> <?php echo $stu_data['first_name'] . ' ' . $stu_data['last_name']; ?></b>
            </header>
            <div class="panel-body">
                <div class="col-md-5">
                    <br/><br/><br/>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th colspan="3"> Personal Details</th>
                            </tr>
                            <tr>
                                <td>Full Name </td>
                                <td width="20">:</td>
                                <td><b><?php echo $stu_data['first_name'] . ' ' . $stu_data['last_name']; ?></b></td>
                            </tr>
                            <tr>
                                <td>NIC Number </td>
                                <td width="10">:</td>
                                <td><b><?php echo $stu_data['nic_no']; ?></b></td>
                            </tr>
<!--                            <tr>
                                <td>Permanent Address </td>
                                <td width="20">:</td>
                                <td><b><?php //echo $stu_data['permanent_address'];        ?></b></td>
                            </tr>-->
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
                                <td>E-Mail Address </td>
                                <td width="10">:</td>
                                <td><b><?php echo $stu_data['email']; ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a class="fa fa-user" href="#info_tab" aria-controls="info_tab" role="tab" data-toggle="tab"> Personal Info.</a></li>
                            <li role="presentation"><a class="fa fa-university" href="#acad_tab" aria-controls="acad_tab" role="tab" data-toggle="tab"> Academic Info</a></li>
                            <!--<li role="presentation"><a class="fa fa-graduation-cap" href="#achive_tab" aria-controls="achive_tab" role="tab" data-toggle="tab"> Achievements</a></li>-->
                            <li role="presentation"><a class="fa fa-book" href="#subject_tab" aria-controls="subject_tab" role="tab" data-toggle="tab"> Subjects</a></li>
                            <li role="presentation"><a class="fa fa-edit" href="#attendance_tab" aria-controls="attendance_tab" role="tab" data-toggle="tab"> Attendance</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info_tab">
                            </div>
                            <div role="tabpanel" class="tab-pane" id="acad_tab"><br>
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">GCE A/Ls</div>
                                        <div class="panel-body">
                                            <table class="table" style="font-size: 12px">
                                                <tr>
                                                    <td width="150">Index Number</td><td width="20">:</td><td><?php echo $stu_data['al_index_no'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Stream</td><td width="20">:</td><td><?php echo $stu_data['al_stream'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Scores(Als-EN-CGT)</td><td width="20">:</td><td><?php echo $stu_data['al_en_cgt'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="150">Z-core</td><td width="20">:</td><td><?php echo $stu_data['al_z_core'] ?></td>
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
                                            <table class="table" style="font-size: 12px">
                                                <tr>
                                                    <td width="200">Scores (EN-MAT-SC[O/L YR])</td><td width="20">:</td><td><?php echo $stu_data['en_mat_sc[o/l]'] ?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="subject_tab"><br>
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Current Subjects</div>
                                        <div class="panel-body">
                                            <table class="table" style="font-size: 12px">
                                                <tr>
                                                    <th width="150">Subject Code</th><th>Subject</th><th>Core/Elective</th>
                                                </tr>
                                                <?php
                                                if (count($stu_subjects) > 0) {
                                                    foreach ($stu_subjects as $row) {
                                                        ?>
                                                        <tr align="center">
                                                            <td width="150"><?php echo $row['code'] ?></td><td><?php echo $row['subject'] ?></td><td><?php
                                                                if ($row['type'] == 1) {
                                                                    echo 'Core';
                                                                } else {
                                                                    echo 'Elective';
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <?php
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
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Attendance</div>
                                        <div class="panel-body">
                                            There are no attendance to show.
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


</script>

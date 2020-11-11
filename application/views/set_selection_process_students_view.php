<?php
if (!$this->session->userdata('u_name')) {
    redirect('App/Login');
}
$check_success = $this->session->flashdata('message');
if ($check_success == "success") {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.notify({
                // options
                message: 'You have entered the data successfully.'
            }, {
                // settings
                type: 'success'
            });

        });
    </script>
<?php } else if ($check_success == "warning") {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.notify({
                // options
                message: 'You have Already Entered the Data.'
            }, {
                // settings
                type: 'warning'
            });
        });

<?php } ?>
</script>

<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Filtered Student List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Filtered Student List</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="card ml-5 mr-5">
                <div class="card-header">
                    <h5 class="card-title">Filtered Student List</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <hr>
                    <table class="table table-striped table-bordered" id="student_table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>NIC</th>
                            <th>Gender</th>
                            <th>Date of birth</th>
                            <?php
                            if ($process_type == 1) { ?>
                                <th>Z Score</th>
                            <?php }
                            if ($process_type == 2) { ?>
                                <th>Exam Marks</th>
                            <?php } ?>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody id="reg_table_body">
                        <?php

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td align="center"> <?php echo $row['fullname'] ? $row['fullname'] :''; ?></td>
                                    <td class="stu_id"> <?php echo $row['nic'] ? $row['nic'] :''; ?></td>
                                    <td><?php echo $row['gender'] ? $row['gender'] :''; ?></td>
                                    <td> <?php echo $row['d_o_b'] ? $row['d_o_b'] :''; ?></td>

                                    <?php
                                    if ($process_type == 1) { ?>
                                        <td><?php echo $row['z_score'] ? $row['z_score'] :''; ?></td>

                                    <?php }
                                    if ($process_type == 2) { ?>
                                        <td><?php echo $row['mark'] ? $row['mark'] :''; ?></td>
                                    <?php }
                                    ?>
                                    <td><?php echo $row['email'] ? $row['email'] :''; ?></td>
                                </tr>

                                <?php
                            }
                        }
                        $i = 1;
                        if (!empty($results)) {
                            foreach ($results as $va) {
                                ?>
                                <tr>
                                    <td align="center"> <?php echo $i ?></td>
                                    <td id="<?php echo $va['indexno'] ?>" class="stu_id"> <?php echo $va['indexno'] ?></td>
                                    <td> <?php echo $va['fullname'] ?></td>
                                    <td> <?php echo $va['nic'] ?></td>
                                    <td class="text-right"><input value="<?php echo $va['mark'] ?>" type="textbox" class="stu_mark" id="input_aptitude_marks-<?php echo $va['indexno'] ?>" name="input_aptitude_marks"></td>
                                </tr>

                                <?php
                                $i++;
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
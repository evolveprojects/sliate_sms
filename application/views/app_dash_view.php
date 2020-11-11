<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Approvals</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
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
                    <h5 class="card-title">Online Registered Students Lists</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <table class="table table-striped table-bordered" id="reg_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Index No</th>
                                        <th>Full Name</th>
                                        <th>NIC No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="reg_table_body">
                                    <?php
                                    $i = 1;
                                    if (!empty($online_students)) {
                                        foreach ($online_students as $va) {
                                            ?>

                                            <tr>
                                                <td align="center"> <?php echo $i ?></td>
                                                <td> <?php echo $va['indexno'] ?></td>
                                                <td> <?php echo $va['fullname'] ?></td>
                                                <td> <?php echo $va['nic'] ?></td>
                                                <td align="center">
                                                    <a data-toggle="tooltip" title="View Profile" class="btn btn-warning btn-xs" onclick="event.preventDefault();student_view('<?php echo $va['id'] ?>')"><i class="fas fa-eye"></i></a> 
                                                    <a data-toggle="tooltip" title="Edit Profile" class="btn btn-info btn-xs" onclick="event.preventDefault();student_edit_view('<?php echo $va['id'] ?>')"><i class="fas fa-edit"></i></a>
                                                    <!--<button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_staff_apprv_status('<?php //print_r($va["stf_id"])  ?>', '1', '<?php //print_r($va["staffindex"])  ?>', '<?php //print_r($va["nic"])  ?>', '<?php //print_r($va["center_id"])  ?>', '<?php //print_r($va["stf_email"])  ?>', '<?php //print_r($va["email_sent_status"])  ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |-->
                                                    <!--<button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_staff_apprv_status('<?php //print_r($va["stf_id"])  ?>', '3', '<?php //print_r($va["staffindex"])  ?>', '<?php //print_r($va["nic"])  ?>', '<?php //print_r($va["center_id"])  ?>', '<?php //print_r($va["stf_email"])  ?>', '<?php //print_r($va["email_sent_status"])  ?>')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>-->

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
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#reg_table').DataTable();
    });

    function student_view (student)
    {
        window.open('<?php echo base_url("App/student_profile_view") ?>?id='+student); 
    }
    
    function student_edit_view(student){
        window.open('<?php echo base_url("App/student_edit_view") ?>?id='+student); 
    }


</script>











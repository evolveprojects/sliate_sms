<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style>
    .ubuntu{
        font-family: 'Ubuntu', sans-serif;
    }
</style>
<div class="content-header">
    <div class="container">
        <div class="row ml-5 mr-5">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Online Registered Students Lists</h1>
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
                <div class="card-header"><br>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="" class="ubuntu">Center</label>
                            <select type="text" class="ubuntu form-control custom-select border-radius" id="priority1_center" name="priority1_center" value="" onchange="get_courses(this.value, 1, null)">
                                <option value="" name="">Select Center</option>
                                <?php
                                foreach ($center as $row):
                                    ?>
                                    <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>" <?php //echo $selected;  ?>>
                                        <?php echo $row['br_name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="ubuntu">Course</label>
                            <select type="text" class="ubuntu form-control custom-select border-radius" id="priority1_course" name="priority1_course" value="" onchange="load_time()">
                                <option value="">Select Course</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="ubuntu">Time</label>
                            <select type="text" class="ubuntu form-control custom-select border-radius" id="priority1_time" name="priority1_time" value="">
                                <option value="">Select Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <button type="button" class="btnNext btn btn-default float-right border-radius sl-btn ubuntu" onclick="search_online_student_data();"><span class="fas fa-search"></span> &nbsp;Search</button>
                        </div>
                    </div>
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
                                    //$i = 1;
                                    //if (!empty($online_students)) {
                                    //    foreach ($online_students as $va) {
                                    ?>

<!--                                            <tr>
                                                <td align="center"> <?php // echo $i  ?></td>
                                                <td> <?php // echo $va['indexno']  ?></td>
                                                <td> <?php // echo $va['fullname']  ?></td>
                                                <td> <?php // echo $va['nic']  ?></td>
                                                <td align="center">
                                                    <a data-toggle="tooltip" title="View Profile" class="btn btn-warning btn-xs" onclick="event.preventDefault();student_view('<?php //echo $va['id']  ?>')"><i class="fas fa-eye"></i></a> 
                                                    <a data-toggle="tooltip" title="Edit Profile" class="btn btn-info btn-xs" onclick="event.preventDefault();student_edit_view('<?php //echo $va['id']  ?>')"><i class="fas fa-edit"></i></a>
                                                    <button data-toggle="tooltip" title="Approve" onclick="event.preventDefault();update_staff_apprv_status('<?php //print_r($va["stf_id"])    ?>', '1', '<?php //print_r($va["staffindex"])    ?>', '<?php //print_r($va["nic"])    ?>', '<?php //print_r($va["center_id"])    ?>', '<?php //print_r($va["stf_email"])    ?>', '<?php //print_r($va["email_sent_status"])    ?>')" class='btn btn-info btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button> |
                                                    <button data-toggle="tooltip" title="Reject" onclick="event.preventDefault();update_staff_apprv_status('<?php //print_r($va["stf_id"])    ?>', '3', '<?php //print_r($va["staffindex"])    ?>', '<?php //print_r($va["nic"])    ?>', '<?php //print_r($va["center_id"])    ?>', '<?php //print_r($va["stf_email"])    ?>', '<?php //print_r($va["email_sent_status"])    ?>')" class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>

                                                </td>
                                            </tr>-->

                                    <?php
                                    //$i++;
                                    //}
                                    //}
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

    function get_courses(center_id, flag, course_id) {
        $('#priority1_course').find('option').remove().end().append('<option value="" name="">Select Course</option>').val('');
        $('#priority1_time').find('option').remove().end().append('<option value="" name="">Select Time</option>').val('');

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                'center_id': center_id
            },
                    function (data) {
                        for (var i = 0; i < data.length; i++) {
                            $('#priority1_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                        }
                    },
                    "json"
                    );
        }
    }

    function load_time() {
        $('#priority1_time').empty();

        var x = $('#priority1_course').val();


        if (x == "" || x == 0) {
            $('#priority1_time').find('option').remove().end().append('<option value="" name="">Select Time</option>').val('');
        } else {
            $('#priority1_time').append('<option value="" name="">Select Time</option>');
            $('#priority1_time').append('<option value="1" name="full">Full Time</option>');
            $('#priority1_time').append('<option value="2" name="part">Part Time</option>');
            //            $('#priority1_course').append($('<option></option>').val(val).html(text));
        }
    }

    function search_online_student_data() {
        var priority1_center = $('#priority1_center').val();
        var priority1_course = $('#priority1_course').val();
        var priority1_time = $('#priority1_time').val();
            
        $.post("<?php echo base_url('App/search_online_student_data') ?>",{
            'priority1_center': priority1_center,
            'priority1_course': priority1_course,
            'priority1_time': priority1_time
        },function (data){
            if (data == 'denied'){
                funcres = {status: "denied", message: "You have no right to proceed the action"};
                result_notification(funcres);
            } else{
                $('#reg_table').DataTable().destroy();
                $('#reg_table').DataTable({
                    'ordering': false,
                    'lengthMenu': [10, 25, 50, 75, 100],
                    "columnDefs": [{
                        "targets": 4,
                        "orderable": false
                    }]
                });
                var x = 1;
                $('#reg_table').DataTable().clear().draw();
                    if (data.length > 0) {
                        for (var j = 0; j < data.length; j++) {
                            
                            var action = "<td align='center'><a data-toggle='tooltip' title='View Profile' style='color:#FFF;' class='btn btn-success btn-xs' onclick='event.preventDefault();student_view("+ data[j]['id'] +")'><i class='fas fa-eye'></i></a>  <a data-toggle='tooltip' title='Edit Profile' style='color:#FFF;' class='btn btn-info btn-xs' onclick='event.preventDefault();student_edit_view("+ data[j]['id'] +")'><i class='fas fa-edit'></i></a></td>";
                            $('#reg_table').DataTable().row.add([
                                x++,
                                data[j]['indexno'],
                                data[j]['fullname'],
                                data[j]['nic'],
                                action
                                
                            ]).draw(false);
                        }
                    }
                }
                    },
                    "json"
                );
        
    }

    function student_view(student)
    {
        window.open('<?php echo base_url("App/student_profile_view") ?>?id=' + student);
    }

    function student_edit_view(student) {
        window.open('<?php echo base_url("App/student_edit_view") ?>?id=' + student);
    }


</script>











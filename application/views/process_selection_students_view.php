<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Process of Selection</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Process of Selection</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Process of Selection</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_process_form" name="set_process_form" method="post" action="<?php echo base_url('App/set_process_students_select') ?>" onsubmit="return validateForm()">
                            <input type="hidden" id="set_priority_type" name="set_priority_type" value="<?php echo $priority_type['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Year</label>
                                    <input type="text" class="form-control" id="set_process_year" name="set_process_year" disabled="disabled" placeholder="" value="<?php echo  $set_process_year;?>">
                                    <input type="hidden" class="form-control" id="set_process_year" name="set_process_year" value="<?php echo  $set_process_year;?>" placeholder="">
                                </div> 
                                <div class="form-group"> 
                                    <label for="">Center</label>
                                    <select class="form-control" id="set_process_center" name="set_process_center" onchange="get_process_courses(this.value, 1, null);">
                                        <option>Select Center</option>
                                        <?php
                                        foreach ($center as $row):
                                            ?>
                                            <option value="<?php echo $row['br_id']; ?>" name="<?php echo $row['br_name']; ?>">
                                                <?php echo $row['br_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Course</label>
                                    <select class="form-control" id="set_process_course" name="set_process_course" onchange="get_process_details()" >
                                        <option>Select Course</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="" class="">Seats Capacity</label><br>
                                    <input type="text" class="form-control" id="capacity_label" name="capacity_label" placeholder="" readonly>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="" class="">Process Type</label><br>
                                    <input type="text" class="form-control" id="process_type_label" name="process_type_label" placeholder="" readonly>
                                    <input type="hidden" class="form-control" id="process_type_id" name="process_type_id" placeholder="">
                                    <input type="hidden" class="form-control" id="process_limit" name="process_limit" placeholder="">
                                </div>
                                <div id="percentage_list"></div>
                                <div>
                                    <table id="process_table" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">GPA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-primary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#process_table').DataTable();

        $("#set_process_year").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });


    });

    function get_process_courses(center_id, flag, course_id) {
        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': center_id
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#set_process_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }
                },
                "json"
            );

        }
    }


    function get_process_details() {
        $('#capacity_label').html("");
        $('#process_type_label').html("");
        var set_year = $('#set_process_year').val();
        var set_center = $('#set_process_center').val();
        var set_course = $('#set_process_course').val();
        var set_priority_type = $('#set_priority_type').val();
        

        $.post("<?php echo base_url('App/get_process_details') ?>", {
            'center_id': set_center,
            'course_id': set_course,
            'date': set_year,
            'priority_type': set_priority_type
        },
                function (data) {
                    $('#process_table').DataTable().clear();
                        $("#process_table").find('tbody').empty();
                        $('#process_table').find('tr').remove();
                    //$('#set_z_score').val(data['z_score']);
                    //$('#set_z_score_id').val(data['saszs_id']);
                    
                    for (var i = 0; i < data.length; i++) {
                        
                        $('#capacity_label').val(data[i]['limited_capacity']);
                        $('#process_type_label').val(data[i]['sss']);
                        $('#process_type_id').val(data[i]['selection_type']);
                        //$('#process_limit').val(data[i]['types']['limit_amount']);
                        var xyz = 0;
                        if(data[i]['types']['selection_type'] == 3){
                            for (var j = 0; j < data[i]['al_subjects_percentage'].length; j++) {
                            }
                        }
                        for(var j = 0; j < data[i]['types']['students'].length; j++){
                            if(data[i]['selection_type'] == 1){
                                xyz = data[i]['types']['students'][j]['z_score'];
                            }else if(data[i]['selection_type'] == 2){
                                xyz = data[i]['types']['students'][j]['mark'];
                            }else if(data[i]['selection_type'] == 3){
                                xyz = data[i]['types']['students'][j]['z_score'];
                            }
                            $('#process_table').DataTable().row.add([
                                data[i]['types']['students'][j]['fullname'],
                                xyz
                            ]).draw(false);
                        }
                    }
                },
                "json"
                );

    }


</script>
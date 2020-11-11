<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Z-Score Selection</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Set Z-Score Selection</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Set Z-Score Selection</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_z_score_form" name="set_z_score_form" method="post" action="<?php echo base_url('App/set_z_score') ?>">
                            <input type="hidden" id="set_priority_type" name="set_priority_type" value="<?php echo $priority_type['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="set_z_score_year">Year</label>
                                    <input type="text" class="form-control" id="set_z_score_year" name="set_z_score_year" disabled="disabled" placeholder="" value="<?php echo  $z_score_year;?>">
                                    <input type="hidden" class="form-control" id="set_z_score_year" name="set_z_score_year" placeholder="" value="<?php echo  $z_score_year;?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Center</label>
                                    <select class="form-control" id="set_z_score_center" name="set_z_score_center" onchange="get_z_score_courses(this.value, 1, null);">
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
                                    <select class="form-control" id="set_z_score_course" name="set_z_score_course" onchange="get_z_score_details()" >
                                        <option>Select Course</option>
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Z-Score</label>
                                    <input type="text" class="form-control" id="set_z_score" name="set_z_score" placeholder="">
                                    <input type="hidden" class="form-control" id="set_z_score_id" name="set_z_score_id" placeholder="">
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
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Set Z-Score Selection List</h5>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function set_z_score_load_course() {
        var set_center = $('#set_center').val();
        var set_course = $('#set_course').val();

        $('#set_capacity').val('');
        $('#set_capacity_id').val('');

        $.post("<?php echo base_url('App/set_z_score_load_course') ?>", {
            'center_id': set_center,
            'course_id': set_course
        },
                function (data) {
                    $('#set_capacity').val(data['capacity']);
                    $('#set_capacity_id').val(data['id']);
                    for (var i = 0; i < data.length; i++) {
                        $('#set_capacity').val(data[i]['capacity']);
                        $('#set_capacity_id').val(data[i]['id']);
                        //$('#set_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }
                },
                "json"
                );
    }

    function get_z_score_courses(center_id, flag, course_id) {

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': center_id
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#set_z_score_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }
                },
                "json"
            );

        }
    }

    function get_z_score_details() {
        var set_center = $('#set_z_score_center').val();
        var set_course = $('#set_z_score_course').val();
        var set_date = $('#set_z_score_year').val();
        var set_priority_type = $('#set_priority_type').val();
        
        $('#set_z_score').val('');
        $('#set_z_score_id').val('');
        
        $.post("<?php echo base_url('App/get_z_score_details') ?>", {
                'center_id': set_center,
                'course_id': set_course,
                'date': set_date,
                'priority_type':set_priority_type
            },
            function (data) {
                $('#set_z_score').val(data['z_score']);
                $('#set_z_score_id').val(data['saszs_id']);
                for (var i = 0; i < data.length; i++) {
                    $('#set_z_score').val(data[i]['z_score']);
                    $('#set_z_score_id').val(data[i]['saszs_id']);
                    //$('#set_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                }
            },
            "json"
            );
    
    }


</script>
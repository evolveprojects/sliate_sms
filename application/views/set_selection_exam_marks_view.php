<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Exam Score Selection</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Set Selection Exam Score</li>
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
                        <h5 class="m-0">Set Selection Exam Score</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_z_score_form" name="set_z_score_form" method="post" action="<?php echo base_url('App/set_exam_score') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Year</label>
                                    <input type="text" class="form-control" id="set_exam_year" name="set_exam_year" placeholder="" disabled="disabled" value="<?php echo  $set_exam_year;?>">
                                    <input type="hidden" class="form-control" id="set_exam_year" name="set_exam_year" placeholder="" value="<?php echo  $set_exam_year;?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Center</label>
                                    <select class="form-control" id="set_exam_center" name="set_exam_center" onchange="get_exam_courses(this.value, 1, null);">
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
                                    <select class="form-control" id="set_exam_course" name="set_exam_course" onchange="get_exam_details()" >
                                        <option>Select Course</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Selection Exam Marks</label>
                                    <input type="text" class="form-control" id="set_exam_mark" name="set_exam_mark" placeholder="">
                                    <input type="hidden" class="form-control" id="set_exam_mark_id" name="set_exam_mark_id" placeholder="">
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
                        <h5 class="m-0">Selection Exam Marks List</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function get_exam_courses(center_id, flag, course_id) {

        if (flag === 1) {
            $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': center_id
                },
                function (data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#set_exam_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                    }
                },
                "json"
            );

        }
    }

    function get_exam_details() {
        var set_center = $('#set_exam_center').val();
        var set_course = $('#set_exam_course').val();
        var set_date = $('#set_exam_year').val();
        
        $('#set_exam_mark').val('');
        $('#set_exam_mark_id').val('');
        
        $.post("<?php echo base_url('App/get_exam_details') ?>", {
                'center_id': set_center,
                'course_id': set_course,
                'date': set_date
            },
            function (data) {
                $('#set_exam_mark').val(data['selection_marks']);
                $('#set_exam_mark_id').val(data['id']);
                for (var i = 0; i < data.length; i++) {
                    $('#set_exam_mark').val(data[i]['selection_marks']);
                    $('#set_exam_mark_id').val(data[i]['sasem_id']);
                    //$('#set_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                }
            },
            "json"
            );
    }

</script>
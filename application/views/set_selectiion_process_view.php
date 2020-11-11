<?php
if (!$this->session->userdata('u_name')) {
    redirect('App/Login');
}
?>

<?php
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
                <h1 class="m-0 text-dark">Selection Process</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Selection Process</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Set Selection Process</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_selection_form" name="set_selection_form" method="post" action="<?php echo base_url('App/set_selection_process') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Year</label>
                                    <input type="text" class="form-control" id="set_selection_year" name="set_selection_year" disabled="disabled" placeholder="" value="<?php echo  $set_selection_year;?>">
                                    <input type="hidden" class="form-control" id="set_selection_year" name="set_selection_year" placeholder="" value="<?php echo  $set_selection_year;?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Course</label>
                                    <select class="form-control" id="set_selection_course" name="set_selection_course" onchange="get_selection_process_details(this.value, 1);">
                                        <option>Select Course</option>
                                        <?php
                                        foreach ($courses as $row):
                                            ?>
                                            <option value="<?php echo $row['id']; ?>" name="<?php echo $row['course_code']; ?>">
                                                <?php echo $row['course_code'] . " - " . $row['course_name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="set_seecion_type" id="exampleRadios1" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Z- Score
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="set_seecion_type" id="exampleRadios2" value="2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Selection Exam Marks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="set_seecion_type" id="exampleRadios3" value="3">
                                    <label class="form-check-label" for="exampleRadios3">
                                        Stream Percentage
                                    </label>
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




    <script>
        function set_value_load_course(center_id, flag, course_id) {
            var set_center = $('#set_center').val();
            $('#set_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

            if (flag === 1) {
                $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': set_center
                },
                        function (data) {
                            for (var i = 0; i < data.length; i++) {
                                $('#set_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                            }
                        },
                        "json"
                        );
            }
        }

        function set_value_load_course(center_id, flag, course_id) {
            var set_center = $('#set_center').val();
            $('#set_course').find('option').remove().end().append('<option value="" name="">---Select Course---</option>').val('');

            if (flag === 1) {
                $.post("<?php echo base_url('App/load_course_list') ?>", {
                    'center_id': set_center
                },
                        function (data) {
                            for (var i = 0; i < data.length; i++) {
                                $('#set_course').append($("<option></option>").attr("name", data[i]['course_name']).attr("value", data[i]['course_id']).text(data[i]['course_code'] + " - " + data[i]['course_name']));
                            }
                        },
                        "json"
                        );
            }
        }

        function set_value_load_details() {
            var set_center = $('#set_center').val();
            var set_course = $('#set_course').val();

            $('#set_capacity').val('');
            $('#set_capacity_id').val('');

            $.post("<?php echo base_url('App/set_value_load_details') ?>", {
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


        function get_selection_process_details(course_id, flag) {
            var set_date = $('#set_selection_year').val();

            $.post("<?php echo base_url('App/get_selection_process_details') ?>", {
                    'course_id': course_id,
                    'date': set_date
                },
                function (data) {
                    if (data["0"].selection_type ==='1') {
                        jQuery("#exampleRadios1").attr('checked', true);
                    }
                    if (data["0"].selection_type ==='2') {
                        jQuery("#exampleRadios2").attr('checked', true);
                    }
                    if (data["0"].selection_type ==='3') {
                        jQuery("#exampleRadios3").attr('checked', true);
                    }
                },
                "json"
            );
        }
    </script>
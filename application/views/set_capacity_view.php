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
                <h1 class="m-0 text-dark">Set Capacity</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Set Capacity</li>
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
                        <h5 class="m-0">Set Capacity of Student</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_capacity_form" name="set_capacity_form" method="post" action="<?php echo base_url('App/set_capacity_course') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Center</label>
                                    <select class="form-control" id="set_center" name="set_center" onchange="set_value_load_course(this.value, 1, null);" required>
                                        <option value="">Select Center</option>
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
                                    <label for="exampleInputPassword1">Course</label>
                                    <select class="form-control" id="set_course" name="set_course" onchange="set_value_load_details();" required>
                                        <option value="">Select Course</option>
                                    </select>                                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Capacity</label>
                                    <input type="text" class="form-control" id="set_capacity" name="set_capacity" placeholder="" required>
                                    <input type="hidden" class="form-control" id="set_capacity_id" name="set_capacity_id" placeholder="">
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
    
    <script>
    function set_value_load_course(center_id, flag, course_id){
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
    
    function set_value_load_course(center_id, flag, course_id){
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
    
    function set_value_load_details(){
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
    </script>
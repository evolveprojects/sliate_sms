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
                <h1 class="m-0 text-dark">Set Year</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Set Year</li>
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
                        <h5 class="m-0">Set Year of Student</h5>
                    </div>
                    <div class="card-body">
                        <form role="form" id="set_year_form" name="set_year_form" method="post" action="<?php echo base_url('App/set_selection_year') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Year</label>
                                    <input type="text" class="form-control" id="set_year" value="<?php echo $set_year;?>" name="set_year" placeholder="" required>
                                    <input type="hidden" class="form-control" id="set_year_id" name="set_year_id" placeholder="">
                                </div>
                            </div>
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
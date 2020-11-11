<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i>STAFF</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Staff</li>
            <li><i class="fa fa-bank"></i>Attendance</li>
        </ol>
    </div>
</div>

<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#atten_tab" aria-controls="atten_tab" role="tab" data-toggle="tab">Attendence Look Up</a></li>
        <li role="presentation"><a href="#reg_tab" aria-controls="reg_tab" role="tab" data-toggle="tab"> Mark Attendence</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="atten_tab">
            <div class="panel">
                <header class="panel-heading">
                    View Staff Attendance
                </header>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" role="form" method="post" action="" id="view_atten" autocomplete="off" novalidate>
                        <div class="form-group">
                            <div class="col-md-1">
                            </div>
                            <label class="col-md-1 control-label">Branch</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" data-validation="required" data-validation-error-msg-required="Field is empty" name="sub_name">
                                    <option value="">Select</option>
                                    <option value="1">Branch 1</option>
                                    <option value="2">Branch 2</option>
                                </select>
                            </div>
                            <label class="col-md-3 control-label">Staff_member</label>
                            <div class="col-md-3">
                                <select class="form-control col-md-1" data-validation="required" data-validation-error-msg-required="Field is empty" name="sub_name">
                                    <option value="">Select</option>
                                    <option value="1">test1</option>
                                    <option value="2">test2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <div class="col-md-1">
                            </div>
                            <label class="col-md-1 control-label">Start Date :</label>
                            <div class="col-md-3">
                                <div id="" class="input-group date">
                                    <input class="form-control" data-validation="required" data-validation-error-msg-required="Empty is field" type="text" name="fs_date" id="att_st_date"  data-format="YYYY-MM-DD">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                            <label class="col-md-3 control-label">End Date :</label>
                            <div class="col-md-3">
                                <div id="" class="input-group date">
                                    <input class="form-control" data-validation="required" data-validation-error-msg-required="Empty is field" type="text" name="fs_date" id="att_end_date"  data-format="YYYY-MM-DD">
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-sm" name="submit">Search</button>
                        </div>
                    </form>
                    <br><br>
                    <table id="quali_look" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                        <thead>
                            <tr bgcolor="#F0F8FF">
                                <th>#</th>
                                <th>Staff Member</th>
                                <th>Department</th>
                                <th>Present Date</th>
                                <th>Absent Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>Lakshan Dissanayaka</th>
                                <th>Academin</th>
                                <th>15</th>
                                <th>5</th>
                                <th>
                                    <a class="" href="<?php echo base_url('staff/staffprof_view') ?>"><button type="button" class="btn btn-defult btn-xs"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></button></a>
                                    <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                    <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                            </tr>

                            <tr>
                                <th>2</th>
                                <th>Irantha</th>
                                <th>Academin</th>
                                <th>18</th>
                                <th>2</th>
                                <th>
                                    <a class="" href="<?php echo base_url('staff/staffprof_view') ?>"><button type="button" class="btn btn-defult btn-xs"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></button></a>
                                    <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                    <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="reg_tab">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Staff Attendence
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post" action="" id="attendence" autocomplete="off" novalidate>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Department :</label>
                                    <div class="col-md-3">
                                        <select class="form-control col-md-1" data-validation="required" data-validation-error-msg-required="Field is empty" name="sub_name">
                                            <option value="">--Select---</option>
                                            <option value="1">Management</option>
                                            <option value="2">IT</option>
                                        </select>
                                    </div>

                                    <label class="col-md-2 control-label">Staff_Member:</label>
                                    <div class="col-md-3">
                                        <select class="form-control col-md-1" data-validation="required" data-validation-error-msg-required="Field is empty" name="sub_name">
                                            <option value="">--Select---</option>
                                            <option value="1">test1</option>
                                            <option value="2">test2</option>
                                            <option value="3">test3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Designation :</label>
                                    <div class="col-md-3">
                                        <input type="text" disabled class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" name="designation" value="Lecturer">
                                    </div>

                                    <label class="col-md-2 control-label">Date :</label>
                                    <div class="col-md-3">
                                        <div id="lec_date" class="col-md-12 input-group date">
                                            <input class="form-control" data-validation="required" data-validation-error-msg-required="Empty is field" type="text" name="fs_date" id="fs_date"  data-format="YYYY-MM-DD">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Start Time :</label>
                                    <div class="col-md-3">
                                        <div  class="col-md-12 input-group date">
                                            <input class="form-control" id="att_st_time" data-validation="required" data-validation-error-msg-required="Empty is field" type="text" name="fs_date" time-format="H:M:S">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <label class="col-md-2 control-label">End Time :</label>
                                    <div class="col-md-3">
                                        <div id="" class="col-md-12 input-group date">
                                            <input class="form-control" id="att_end_time" data-validation="required" data-validation-error-msg-required="Empty is field" type="text" name="fs_date" id="fs_date"  time-format="H:M:S">
                                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                    </div>
                                    <button type="submit" class="btn btn-info btn-md" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-defult btn-md" name="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript">

    $.validate({
        form: '#attendence'
    });

    $.validate({
        form: '#view_atten'
    });

    $('#lec_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
    $('#att_st_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
    $('#att_end_date').datetimepicker({defaultDate: "<?php echo date('Y-m-d'); ?>", pickTime: false});
    $('#att_st_time').datetimepicker({defaultTime: "<?php echo time('H:m:sa'); ?>", pickDate: false});
    $('#att_end_time').datetimepicker({defaultTime: "<?php echo time('H:m:sa'); ?>", pickDate: false});

    $(document).ready(function () {

        $('#quali_look').DataTable({
            'ordering': true,
            'lengthMenu': [10, 25, 50, 75, 100]
        });

    });


</script>
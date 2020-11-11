<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> FACULTY </h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Educational Structure</li>
            <li><i class="fa fa-graduation-cap"></i>Faculty</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Manage Faculties
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <form name='faculty_form' class="form-horizontal" role="form" action="<?php echo base_url('faculty/save_faculty') ?>" id="faculty_form" method="post"  autocomplete="off" novalidate>		
                        <input type="hidden" id="faculty_id" name="faculty_id">                       
                        <div class="form-group">
                            <label for="comcode" class="col-md-3 control-label">Faculty Code : </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" maxlength="10" id="faculty_code" name="faculty_code" placeholder="" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Faculty Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="faculty_name" name="faculty_name"  data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-sm-3 control-label"> Description:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="faculty_des" name="faculty_des"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info">Save</button>
                                <button type="reset" name="Reset" class="btn btn-default" onclick="reset_id()">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>	
            </div>
        </section>
    </div>
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                Look Up
            </header>
            <div class="panel-body">	
                <table id="course_lookup" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Faculty Code</th>
                            <th>Faculty name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($all_faculties)) {
                            foreach ($all_faculties as $fac) {
                                $this->db->where('id',$fac);
                                $row = $this->db->get('edu_faculty')->row_array();
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['faculty_code']; ?></td>
                                    <td><?php echo $row['faculty_name']; ?></td>
                                    <td><a class='btn btn-info btn-xs' title ="edit" onclick="edit_faculty_load('<?php print_r($row['id']) ?>', '<?php print_r($row['faculty_code']) ?>', '<?php print_r($row['faculty_name']) ?>', '<?php print_r($row['description']) ?>')"/><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a>|

                                        <?php if ($row['deleted']) { ?>    
                                            <button type="button" class="btn btn-success btn-xs" title="activate" onclick="change_status('<?php print_r($row['id']) ?>', '0','<?php print_r($row['faculty_code']) ?>')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true" ></span></button></th>
                                            <?php } else { ?>
                                            <button type="button" class="btn btn-warning btn-xs" title="deactivate" onclick="change_status('<?php print_r($row['id']) ?>', '1','<?php print_r($row['faculty_code']) ?>')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>                        </div>






<script type="text/javascript">

    $(document).ready(function () {
        $('#course_lookup').DataTable({
            'ordering': true,
            'lengthMenu': [5, 10, 15, 20, 25]
        });

    });
    function edit_faculty_load(id, code, name, descri) {
        $('#faculty_id').val(id);
        $('#faculty_code').val(code);
        $('#faculty_name').val(name);
        $('#faculty_des').val(descri);

    }

    function change_status(faculty_id, new_status, faculty_code)
    {
        $.post("<?php echo base_url('faculty/change_faculty_status') ?>", {"faculty_id": faculty_id, "new_status": new_status, "faculty_code":faculty_code},
                function (data)
                {
                    location.reload();
                },
                "json"
                );
    }

    save_method = 'update';
    $(function () {
        $('.viewregstudent').DataTable();
    });

    $(function () {
        $("#datepicker").datepicker();
    });

</script>
<script type="text/javascript">
    $.validate({
        form: '#faculty_form'
    });

    function reset_id() {
        $('#faculty_id').val("");
    }
</script>

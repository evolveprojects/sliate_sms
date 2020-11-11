<?php
if (!$this->session->userdata('u_name')) {
    redirect('App/Login');
}
?>

<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">CENTER COURSE</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Center Course Manager</li>
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
                        <h5 class="m-0">Center Course</h5>
                    </div>
                    <div class="card-body">
                    <form id="batch_form" name="batch_form" class="form-horizontal" role="form" method="post"  autocomplete="off" novalidate>
                        
                        <input type="hidden" id="center_corse_id" name="center_corse_id">
                                <div class="form-group">
                                    <input type="hidden" id="center_year_id" name="center_year_id" >
                                    <input type="hidden" id="center_semester_id" name="center_semester_id">
                                    <label for="sem_center" class="col-md-3 control-label">Center : </label>
                                    <div class="col-md-9">
                                        <?php 
                                            global $branchdrop;
                                            global $selectedbr;
                                            
                                            $extraattrs = 'id="center" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty"';
                                            echo form_dropdown('center',$branchdrop,$selectedbr, $extraattrs); 
                                        ?>
                                    </div>
                                    <small id="centerHelp" class="form-text text-danger" style="color:red;"></small>
                                </div>
                                
                                <div class="form-group">
                                    <input type="hidden" id="batch_id" name="batch_id" >
                                    <input type="hidden" id="course_id" name="course_id" >
                                    <label for="comcode" class="col-sm-3 control-label"> Course:</label>
                                    <div class="col-md-9">
                                        <select type="text" class="form-control" id="course" name="course" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                                            <option value="" selected disabled></option>
                                            <?php
                                                foreach ($all_courses as $course){ ?>
                                                <option value="<?php echo $course['course_id']?>"><?php echo "[".$course['course_code']."]-".$course['course_name'] ?></option>
                                             <?php   }
                                            ?>
                                        </select>    
                                    </div>
                                    <small id="courseHelp" class="form-text text-danger" style="color:red;"></small>
                                </div>
                                
                                
                                <div class="form-group" style="padding-left:8px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="full_time">
                                        <label class="form-check-label" for="full_time">
                                            Full Time
                                        </label>
                                    </div>  
                                
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="part_time">
                                        <label class="form-check-label" for="part_time">
                                            Part Time
                                        </label>
                                    </div>
                                    <small id="fopHelp" class="form-text text-danger" style="color:red;"></small>
                                </div>

                                <br/><br/>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-11">
                                        <button type="submit" name="save_btn" id="save_btn" class="btn btn-primary float-right">Save</button>
                                        <button type="reset" name="Reset" class="btn btn-default float-left">Reset</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Look Up</h5>
                    </div>
                    <div class="card-body">
                    <table name="year_table" id="year_table" class="table table-striped table-bordered dt-responsive year_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Center</th>
                                        <th>Course</th>
                                        <!-- <th>Batch</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($each_center_course as $row) {
                                        ?>
                                        <tr id="cc_tr_<?php echo $row['center_course_id'] ?>">
                                            <td><?php echo $i ?> <input type="hidden" name="cc_id" id="cc_id" value="<?php echo $row['center_course_id'] ?>"> </td>
                                            <td><?php echo "[".$row['br_code'] . "]-" . $row['br_name'] ?></td>
                                            <td><?php echo "[".$row['course_code']."]-".$row['course_name'] ?></td>
                                            <!-- <td><?php echo $row['batch_code'] ?></td> -->
                                            <td>

                                            <div class='btn-group' role='group' aria-label='Basic example'>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="edit_center_course('<?php print_r($row['center_course_id']) ?>','<?php print_r($row['center_id']) ?>', '<?php print_r($row['course_id']) ?>','<?php print_r($row['full_time']) ?>','<?php print_r($row['part_time']) ?>')">edit</button>
                                                <?php if ($row['c_d_deleted']) { ?>
                                                <button type="button" class="btn btn-sm btn-secondary" onclick="change_status('<?php print_r($row['center_course_id']) ?>', '0');">X</button></div></td>
                                                <?php } else { ?>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="change_status('<?php print_r($row['center_course_id']) ?>', '1');">X</button></div></td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
        $(function () {
            $('#batch_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
            $('#batch_table td').css('white-space','initial');

            $('#year_table').DataTable({
                'ordering': true,
                'lengthMenu': [5, 10]
            });
        });

        
        $("#save_btn").click(function(e) {

            e.preventDefault();

            let isValid = {};

            if(!$('#course').val()){
                $("#courseHelp").html('Choose course');
            } else {
                $("#courseHelp").html('');
                isValid['course'] = 1;
            }
            if(!$('#center').val()){
                $("#centerHelp").html('Choose center');
            } else {
                $("#centerHelp").html('');
                isValid['center'] = 1;
            }

            if(!$("#full_time").is(':checked') && !$("#part_time").is(':checked')) {
                $("#fopHelp").html('Select "Full time" or  "Part time"');
            } else {
                isValid['fop'] = 1;
            }


            let url = "<?php echo base_url('master/save_centercourse')?>";

            if(isValid['fop'] && isValid['center'] && isValid['course'])
            {
                $.ajax({
                url: url,
                type: "POST",
                data: {
                    cc_id: $("#center_corse_id").val(),
                    center: $("#center").val(),
                    course: $("#course").val(),
                    full_time: $("#full_time").prop('checked') ? 1 : 0,
                    part_time: $("#part_time").prop('checked') ? 1 : 0,
                },
                success:function(data) 
                    {
                        let options = JSON.parse(data);
                        // console.log(options['msg']);
                        alert(options['msg']);
                        $("#center").val('');
                        $("#course").val('');
                        $("#full_time").prop('checked', false);
                        $("#part_time").prop('checked', false);
                        $("#center_corse_id").val('');

                    }
                });
            }

        });
    
    function edit_center_course(cc_id, center_id, course_id, full_time, part_time)
    {
        $('#center').val(center_id);
        $('#course').val(course_id);
        $('#center_corse_id').val(cc_id);
        
        if(full_time == 1)
        {
            $("#full_time").prop('checked', true);
        }
        if(part_time == 1)
        {
            $("#part_time").prop('checked', true);
        }
    }


    function change_status(cc_id, isDel)
    {
        console.log(cc_id);
        if (confirm("Confirm delete!?")) {
            console.log(cc_id);
            $.post("<?php echo base_url('master/change_center_course_status') ?>", {"cc_id": cc_id, "isDel": isDel},
            function (data)
            {
                alert('Deleted!');
                location.reload();
            }
            );
        }
        return false;
    }
</script>
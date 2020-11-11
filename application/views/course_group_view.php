<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i> Subject Groups</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-book"></i>Course Groups</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-7">    
        <div class="panel">
            <header class="panel-heading">
                Semester Course Groups
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" id="course_group_form" name="course_group_form" autocomplete="off">
                        <div class="form-group">
                            <input type="hidden" id="group_id" name="group_id">
                            <label for="grname" class="col-md-3 control-label">Group Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" data-validation="required" data-validation-error-msg-required="Field can not be empty" id="group_name" name="group_name" placeholder=""> 	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="clone_div" id="clone_div">
                                <div id="clonedInput1" class="clonedInput row">
                                    <input type="hidden" name="ssubid[]" id="ssubid">
                                    <label class="col-md-1 control-label">Course</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="course_code" name="course_code[]" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="check_same_code(this.value, this.id); load_course_name(this.value, this.id);">
                                            <option value="">Select Code</option>
                                            <?php
                                            if (!empty($courses)) {
                                                foreach ($courses as $row) {
                                                    ?>	
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['code'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>  	
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" id="course_name" name="course_name[]" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="load_course_code(this.value, this.id)">
                                            <option value="">Select Course</option>
                                            <?php
                                            if (!empty($courses)) {
                                                foreach ($courses as $row) {
                                                    ?>	
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select> 	
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" height="70"  title="credit" class="form-control" id="course_credit" name="course_credit" readonly> 	
                                    </div>
                                    <div class="col-md-21">
                                        <span class="button-group">
                                            <button onclick="cloning(null, null)" type="button" class="btn btn-default btn-xs" onclick="fnone()"><span class="glyphicon glyphicon-plus"></span></button>
                                            <button type="button" name = "remove_entry[]" class="btn btn-default btn-xs remove_entry"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>

                                    </div>
                                    <br/>
                                </div>
                            </div>                          
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                            </div>
                            <button type="submit" class="btn btn-info btn-md" name="submit" onclick="event.preventDefault();save_course_group();">Submit</button>
                            <button type="reset" class="btn btn-defult btn-md" name="reset" onclick="reset_view();">Reset</button>
                        </div>	
                    </form>  	
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">    
        <div class="panel">
            <header class="panel-heading">
                Look Up
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <table class="table table-bordered table-striped viewregstudent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($course_group)) {
                                foreach ($course_group as $row) {
                                    ?>
                                    <tr>
                                        <th><?php echo $row['id'] ?></th>
                                        <th><?php echo $row['group_name'] ?></th>
                                        <th>
                                            <button type="button" class="btn btn-info btn-xs" onclick="edit_group_load(<?php echo $row['id'] ?>)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button> |
                                            <?php if ($row['deleted']) { ?>
                                                <button type="button" class="btn btn-success btn-xs" onclick="change_status('<?php print_r($row['id']) ?>', '0', '<?php print_r($row['group_name']) ?>')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button></th>
                                        <?php } else { ?>
                                    <button type="button" class="btn btn-warning btn-xs" onclick="change_status('<?php print_r($row['id']) ?>', '1', '<?php print_r($row['group_name']) ?>')"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></button></th>
                                    <?php } ?>
                                </th>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>		
        <script>
            save_method = 'update';
            $(function () {
                $('.viewregstudent').DataTable({
                    'ordering': true,
                    'lengthMenu': [5, 10]
                });

            });

            $.validate({
                form: '#course_group_form'
            });

            var cloneid = 0;
            
            function cloning(course_id, credits)
            {
                cloneid += 1;
                var container = document.getElementById('clone_div');
                var clone = $('#clonedInput1').clone();

                clone.find('#course_code').attr("class", "form-control temprw");

                clone.find('#course_code').attr('name', 'course_code[]');
                clone.find('#course_name').attr('name', 'course_name[]');

                if (course_id != null) {
                    clone.find('#course_code').val(course_id);
                    clone.find('#course_name').val(course_id);
                    clone.find('#course_credit').val(credits);
                    //clone.find('#course_code').removeAttr("id");
                    clone.find('#course_code').attr('id', 'course_code' + cloneid + '');
                    clone.find('#course_name').attr('id', 'course_name' + cloneid + '');
                    clone.find('#course_credit').attr('id', 'course_credit' + cloneid + '');
                } else {
                    clone.find('#course_code').val('');
                    clone.find('#course_code').attr('id', 'course_code' + cloneid + '');
                    //clone.find('#course_code').removeAttr("id");
                    clone.find('#course_credit').val('');
                    clone.find('#course_credit').attr('id', 'course_credit' + cloneid + '');
                    clone.find('#course_name').val('');
                    clone.find('#course_name').attr('id', 'course_name' + cloneid + '');
                }

                clone.find('.remove_entry').attr('id', cloneid);
                clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();');

                $('.clone_div').append(clone);
            }

            function load_course_name(course_id, id) {
                var id_val = id.charAt(11);
                $.post("<?php echo base_url('Course/load_course_credit') ?>", {"course_id": course_id},
                function (data)
                {
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if (id_val != "") {
                            $('#course_name' + id_val).val(course_id);
                            $('#course_credit' + id_val).val(data);
                        } else {
                            $('#course_name').val(course_id);
                            $('#course_credit').val(data);
                        }
                    }

                },
                "json"
                );
            }



            function load_course_code(course_id, id) {
                var id_val = id.charAt(11);

                $.post("<?php echo base_url('course/load_course_credit') ?>", {"course_id": course_id},
                function (data)
                {
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        if (id_val != "") {
                            $('#course_code' + id_val).val(course_id);
                            $('#course_credit' + id_val).val(data);
                        } else {
                            $('#course_code').val(course_id);
                            $('#course_credit').val(data);
                        }
                    }
                },
                "json"
                );
            }

            function fnone() {
                var count = document.querySelectorAll('.course_code');
                for (var i = 1; i <= count.length; i++)
                    count[i].id = 'course_code' + i;
            }

            function edit_group_load(group_id) {
                $(".temprw").each(function (index) {
                    $(this).parents(".clonedInput").remove();
                });

                $('#course_code').val('');
                $('#course_code').attr('name', 'course_code[]');
                $('#course_name').val('');
                $('#course_name').attr('name', 'course_name[]');

                $.post("<?php echo base_url('course/edit_group_load') ?>", {"group_id": group_id},
                function (data)
                {
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        $('#group_id').val(data['group']['id']);
                        $('#group_name').val(data['group']['group_name']);

                        for (i = 0; i < data['courses'].length; i++)
                        {
                            if (i == 0) {
                                $('#course_code').val(data['courses'][i]['id']);
                                //$('#course_code').attr('name', 'course_code_' + data['courses'][i]['id']);


                                $('#course_code').attr('name', 'course_code[]');
                                $('#course_name').attr('name', 'course_name[]');
                                $('#course_name').val(data['courses'][i]['id']);
                                $('#course_credit').val(data['courses'][i]['credits']);
                                //$('#course_name').attr('name', 'course_name[' + data['courses'][i]['id'] + ']');
                            } else {
                                cloning(data['courses'][i]['id'], data['courses'][i]['credits']);
                            }

                        }
                    }
                },
                "json"
                );
            }
            function change_status(group_id, new_status, group_name)
            {
                $.post("<?php echo base_url('course/change_course_group_status') ?>", {"group_id": group_id, "new_status": new_status, "group_name": group_name},
                    function (data)
                {
                    if(data == 'denied')
                    {
                        funcres = {status:"denied", message:"You have no right to proceed the action"};
                        result_notification(funcres);
                    }
                    else
                    {
                        location.reload();
                    }
                },
                "json"
                );
            }
            function check_same_code(value, id) {
                if (id.length > 11) {
                    var number = id.substring(11);
                    for (i = 0; i < cloneid; i++) {
                        if (i === 0) {
                            var val = document.getElementById("course_code").value;
                        } else {
                            var val = document.getElementById("course_code" + i).value;
                        }
                        if (val === value) {
                            if (number != i) {
                                document.getElementById('course_credit' + number).value = '';
                                document.getElementById('course_name' + number).value = '';
                                document.getElementById('course_code' + number).value = '';
                                alert("Don't select the same course twice");
                                break;
                            }
                        }
                    }
                } else {
                    for (i = 0; i < cloneid; i++) {
                        if (i !== 0) {
                            var val = document.getElementById("course_code" + i).value;
                        }
                        if (val === value) {
                            document.getElementById('course_credit').value = '';
                            document.getElementById('course_name').value = '';
                            document.getElementById('course_code').value = '';
                            alert("Don't select the same course twice");
                            break;
                        }
                    }
                }
            }

            function save_course_group() {
                $.ajax(
                        {
                            url: "<?php echo base_url('course/save_course_group') ?>",
                            type: 'POST',
                            async: true,
                            cache: false,
                            dataType: 'json',
                            data: $('#course_group_form').serialize(),
                            success: function (data)
                            {
                                if (data == 'denied')
                                {
                                    funcres = {status: "denied", message: "You have no right to proceed the action"};
                                    result_notification(funcres);
                                } else
                                {
                                    result_notification(data);
                                    if (data['status'] == 'success') {
                                        location.reload();
                                    }
                                }
                            }
                        });
            }
            
            function reset_view(){
             $(".temprw").each(function (index) {
                    $(this).parents(".clonedInput").remove();
                });
            }
        </script>
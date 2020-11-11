<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-confirm.css'); ?>"> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-confirm.js') ?>"></script><!--jquery-->
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-users"></i> GRADING METHOD</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-bank"></i>Grading Method</li>
        </ol>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-7">
        <section class="panel">
            <header class="panel-heading">
                Grading Method
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form name='myForm' class="form-horizontal" role="form" action="<?php echo base_url('grading_method/save_grade') ?>" method="post"  id="reg_form" autocomplete="off" novalidate>		

                        <div class="form-group">
                            <input type="hidden" id="grading_id" name="grading_id">
                            <input type="hidden" id="grading_code" name="grading_code">
                            <label for="comcode" class="col-md-4 control-label">Grading Code : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="10" id="grcode" name="grcode" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-md-4 control-label">Grading Name : </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="grname" name="grname" data-validation="required" data-validation-error-msg-required="Field can not be empty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comcode" class="col-md-4 control-label">Description : </label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="grdes" name="grdes"></textarea>
                            </div>
                        </div>
                        <div class="clone_div" id="clone_div">
                            <div id="clonedInput1" class="clonedInput row"><br>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <select type="text" class="form-control" id="grmethod" name="grmethod[]" required placeholder="field cannot be empty" data-validation="required" data-validation-error-msg-required="Field can not be empty" value="">
                                            <option value="">Criteria</option>
                                            <?php foreach ($gr_criteria as $row) { ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['criteria'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" title="Marks" placeholder="Marks" class="form-control" id="grmark" name="grmark[]" data-validation=" required number" data-validation-error-msg-required="Field cannot be empty" data-validation-error-msg-number="Invalid. Marks between 1-100 only" data-validation-allowing="range[1;100],int" >
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" title="Grade" placeholder="Grade" class="form-control" id="grade" name="grade[]" data-validation="required" data-validation-error-msg-required="Field cannot be empty">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" title="Grade Point" placeholder="Grade Point" class="form-control" id="grrate" name="grrate[]" data-validation=" required number" data-validation-error-msg-required="Field cannot be empty" data-validation-error-msg-number="Invalid. numbers only" data-validation-allowing="range[0.00;4.00],float">
                                    </div>	
                                    <div class="col-md-2">
                                        <span class="button-group">
                                            <button onclick="cloning(null, null, null)" type="button" class="btn btn-default btn-xs" title="add"><span class="glyphicon glyphicon-plus"></span></button>
                                            <button type="button" name = "remove_entry[]" class="btn btn-default btn-xs remove_entry" title="remove"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                    </div>
                                </div>


                            </div></div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-11">
                                <button type="submit" name="save_btn" id="save_btn" class="btn btn-info" onclick="event.preventDefault();validateGradingCode();">Save</button>
                                <button type="reset" name="reset" onclick="reset_view();" class="btn btn-default">Reset</button>
                                <!--<button onclick="event.preventDefault();$('#reg_form').trigger('reset');$('#id').val('');$('#grading_id').val('');$('#grading_code').val('');" class="btn btn-default">Reset</button>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-5">
        <section class="panel">
            <header class="panel-heading">
                Look Up
            </header>
            <div class="panel-body">
                <div class="col-md-12">	
                    <table class="table table-bordered table-striped viewregstudent">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Grading Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($gr_name)) {
                                foreach ($gr_name as $grade) {

                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . "[" . $grade['grade_code'] . "]-" . $grade['grade_name'] . "</td>";
                                    echo "<th><a class='btn btn-info btn-xs' title='edit' onclick='event.preventDefault();edit_grading_method(" . $grade['id'] . ")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>| ";


                                    if ($grade["deleted"] == "0") {
                                        echo "<button title='activate' onclick='event.preventDefault();change_status(" . $grade["id"] . ",\"1\")' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-ban-circle' aria-hidden='true'></span></button>";
                                    } else {
                                        echo "<button title='deactivate' onclick='event.preventDefault();change_status(" . $grade["id"] . ",\"0\")' class='btn btn-success btn-xs'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
                                    }

                                    echo "</th></tr>";

                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/bootstrap-datetimepicker.min.js'); ?>"></script>

<script>
        $(function () {
            $('.viewregstudent').DataTable(
                    {
                        'ordering': true,
                        'lengthMenu': [5, 10, 15, 20, 25]
                    });
            $('.viewregstudent td').css('white-space', 'initial');
        });

        $.validate({

            form: '#reg_form'
        });


        var cloneid = 0;
        function cloning(mark, criteria, grade, g_rate)
        {
            cloneid += 1;
            
            var container = document.getElementById('clone_div');
            var clone = $('#clonedInput1').clone();

            //clone.find('#grgroup').attr("class", "form-control temprw");
            clone.find('#grmethod').attr("class", "form-control temprw");

            if (criteria != null) {
                clone.find('#grmark').val(mark);
                clone.find('#grmethod').val(criteria);
                clone.find('#grade').val(grade);
                clone.find('#grrate').val(g_rate);

                clone.find('#grmark').attr('name', 'grmark[]');
                clone.find('#grmethod').attr('name', 'grmethod[]');
                clone.find('#grade').attr('name', 'grade[]');
                clone.find('#grrate').attr('name', 'grrate[]');

                clone.find('#grmark').attr('grade_mark' + cloneid + '');
                clone.find('#grmethod').attr('grade_method' + cloneid + '');
                clone.find('#grade').attr('grade' + cloneid + '');
                clone.find('#grrate').attr('id' + cloneid + '');

            } else {
                clone.find('#grmark').val('');
                clone.find('#grmark').attr('name', 'grmark[]');
                clone.find('#grmark').attr('id', 'grade_mark' + cloneid + '');

                //clone.find('#grgroup').val('');
                clone.find('#grmethod').val('');
                clone.find('#grmethod').attr('name', 'grmethod[]');
                //clone.find('#grgroup').attr('id', 'grade_group' + cloneid + '');
                clone.find('#grmethod').attr('id', 'grade_group' + cloneid + '');

                clone.find('#grade').val('');
                clone.find('#grade').attr('name', 'grade[]');
                clone.find('#grade').attr('id', 'grade' + cloneid + '');

                clone.find('#grrate').val('');
                clone.find('#grrate').attr('name', 'grrate[]');
                clone.find('#grrate').attr('id', 'grade_rate' + cloneid + '');
            }

            clone.find('.remove_entry').attr('id', cloneid);
            clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();');
    //      clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();Calculate_gr_tot()');

            $('.clone_div').append(clone);
        }


        function edit_grading_method(id) {
            $(".temprw").each(function (index) {
                $(this).parents(".clonedInput").remove();
            });

            $('#grmethod').val('');
            $('#grmethod').attr('name', 'grmethod[]');
            $('#grmark').val('');
            $('#grmark').attr('name', 'grmark[]');
            $('#grade').val('');
            $('#grade').attr('name', 'grade[]');
            $('#grrate').val('');
            $('#grrate').attr('name', 'grrate[]');

            $.post("<?php echo base_url('grading_method/edit_grading_method') ?>", {"id": id},
                    function (data)
                    {
                        $('#grading_id').val(data['method_gr']['id']);
                        $('#grcode').val(data['method_gr']['grade_code']);
                        $('#grading_code').val(data['method_gr']['grade_code']);
                        $('#grname').val(data['method_gr']['grade_name']);
                        $('#grdes').val(data['method_gr']['description']);

                        for (i = 0; i < data['gr_details'].length; i++)
                        {
                            if (i == 0) {

                                $('#grmethod').val('');
                                $('#grmethod').val(data['gr_details'][i]['grade_group']);

                                $('#grmark').attr('name', 'grmark[]');
                                $('#grmark').val(data['gr_details'][i]['grade_mark']);

                                $('#grade').attr('name', 'grade[]');
                                $('#grade').val(data['gr_details'][i]['grade']);

                                $('#grrate').attr('name', 'grrate[]');
                                $('#grrate').val(data['gr_details'][i]['grade_rate']);


                            } else {
                                cloning(data['gr_details'][i]['grade_mark'], data['gr_details'][i]['grade_group'], data['gr_details'][i]['grade'], data['gr_details'][i]['grade_rate']);
                            }

                        }

                    },
                    "json"
                    );
        }

        function change_status(id, new_status)
        {
            $.post("<?php echo base_url('grading_method/update_grading_method_status') ?>", {"id": id, "new_status": new_status},
                    function (data)
                    {
                        location.reload();
                    },
                    "json"
                    );
        }
                                    
                                    
        function validateGradingCode(){
            
            var grading_code = $('#grcode').val();
            
            if(grading_code != $('#grading_code').val()){

                $.post("<?php echo base_url('subject/check_duplicate_grading_codes') ?>", {'grading_code': grading_code},
                function (data)
                {
                    if(data['grade_count'] > 0){
                        funcres = {status: "denied", message: "Grading Code Already Exists!"};
                        result_notification(funcres);
                    }
                    else{
                        $("#reg_form").submit();
                    }
                },
                "json"
                );
            }
            else{
                $("#reg_form").submit();
            }
        }

        function reset_view() {
            $(".temprw").each(function (index) {
                $(this).parents(".clonedInput").remove();
            });
           
           $('#id').val('');
           $('#grading_id').val('');
           $('#grading_code').val('');
        }

</script>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-bank"></i> Subject Groups</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
            <li><i class="fa fa-cog"></i>Settings</li>
            <li><i class="fa fa-book"></i>Subject Groups</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-7">    
        <div class="panel">
            <header class="panel-heading">
                Semester Subject Groups
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form" method="post" id="subject_group_form" name="subject_group_form" autocomplete="off">
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
                                    <input type="hidden" name="subrowid[]" id="subrowid">
                                    <input type="hidden" name="pre_subject[]" id="pre_subject">
                                    <input type="hidden" name="pre_subj_credit[]" id="pre_subj_credit">
                                    <input type="hidden" name="pre_subj_group" id="pre_subj_group">
<!--                                    <input type="hidden" name="subversion[]" id="subversion">-->
                                    <label class="col-md-1 control-label">Subject</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="subject_code" name="subject_code[]" data-validation="required" data-validation-error-msg-required="Field can not be empty" onchange="check_same_code(this.value, this.id); load_subject_name(this.value, this.id);">
                                            <option value="">---Select Subject---</option>
                                            <?php
                                            if (!empty($subjects)) {
                                                foreach ($subjects as $row) {
                                                    ?>	
                                                    <option value="<?php echo $row['id'].'-'.$row['version_id'] ?>"><?php echo "[".$row['code']."]-".$row['subject'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="text" height="70"  title="credit" class="form-control" id="subject_credit" name="subject_credit" readonly> 	
                                    </div>
                                    <div class="col-md-21">
                                        <span class="button-group">
                                            <button onclick="cloning(null, null, null)" type="button" class="btn btn-default btn-xs" onclick="fnone()"><span class="glyphicon glyphicon-plus"></span></button>
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
                            <button type="submit" class="btn btn-info btn-md" name="submit" onclick="event.preventDefault();validateSubjectGroup();">Submit</button>
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
                            if (!empty($subject_group)) {
                                foreach ($subject_group as $row) {
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
            
            var flag = '';
            
            $(function () {
                $('.viewregstudent').DataTable({
                    'ordering': true,
                    'lengthMenu': [5, 10]
                });

            });

            $.validate({
                form: '#subject_group_form'
            });

            var cloneid = 0;
            
            function cloning(subject_id, credits, row_id)
            { 
                cloneid += 1;
                var container = document.getElementById('clone_div');
                var clone = $('#clonedInput1').clone();

                clone.find('#subject_code').attr("class", "form-control temprw");

                clone.find('#subject_code').attr('name', 'subject_code[]');
                clone.find('#subject_name').attr('name', 'subject_name[]');
                
                clone.find('#subrowid').attr('name', 'subrowid[]');
                
                clone.find('#pre_subject').attr('name', 'pre_subject[]');
                clone.find('#pre_subj_credit').attr('name', 'pre_subj_credit[]');
               // clone.find('#subversion').attr('name', 'subversion[]');
                
               // var subject_id = subj_id.split('-')[0].trim();
               // var version = subject_id.split('-')[1].trim();

                if (subject_id != null) {
                    
                    flag = 'edit';
                    
                    clone.find('#subject_code').val(subject_id);
                    clone.find('#subject_name').val(subject_id);
                    clone.find('#subject_credit').val(credits);
                    clone.find('#subrowid').val(row_id);
                    
                    clone.find('#pre_subject').val(subject_id);
                    clone.find('#pre_subj_credit').val(credits);
                    //clone.find('#subversion').val(version);
                    
                    //clone.find('#subject_code').removeAttr("id");
                    clone.find('#subject_code').attr('id', 'subject_code' + cloneid + '');
                    clone.find('#subject_name').attr('id', 'subject_name' + cloneid + '');
                    clone.find('#subject_credit').attr('id', 'subject_credit' + cloneid + '');
                    
                    clone.find('#pre_subject').attr('id', 'pre_subject' + cloneid + '');
                    clone.find('#pre_subj_credit').attr('id', 'pre_subj_credit' + cloneid + '');
                    
                } else {
                    clone.find('#subject_code').val('');
                    clone.find('#subject_code').attr('id', 'subject_code' + cloneid + '');
                    //clone.find('#subject_code').removeAttr("id");
                    clone.find('#subject_credit').val('');
                    clone.find('#subject_credit').attr('id', 'subject_credit' + cloneid + '');
                    clone.find('#subject_name').val('');
                    clone.find('#subject_name').attr('id', 'subject_name' + cloneid + '');
                    
                    clone.find('#subrowid').val('');
                    
                    clone.find('#pre_subject').val('');
                    clone.find('#pre_subj_credit').val('');
                   // clone.find('#subversion').val('');
                }

                clone.find('.remove_entry').attr('id', cloneid);
                clone.find('.remove_entry').attr('onclick', '$(this).parents(".clonedInput").remove();');

                $('.clone_div').append(clone);
            }

            function load_subject_name(subject_id, id) {
                
                var id_val = id.charAt(12);
                
                $.post("<?php echo base_url('subject/load_subject_credit') ?>", {"subject_id": subject_id},
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
                            $('#subject_name' + id_val).val(subject_id);
                            $('#subject_credit' + id_val).val(data);
                        } else {
                            $('#subject_name').val(subject_id);
                            $('#subject_credit').val(data);
                        }
                    }

                },
                "json"
                );
            }



            function load_subject_code(subject_id, id) {
                
                var id_val = id.charAt(12);

                $.post("<?php echo base_url('subject/load_subject_credit') ?>", {"subject_id": subject_id},
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
                            $('#subject_code' + id_val).val(subject_id);
                            $('#subject_credit' + id_val).val(data);
                        } else {
                            $('#subject_code').val(subject_id);
                            $('#subject_credit').val(data);
                        }
                    }
                },
                "json"
                );
            }

            function fnone() {
                var count = document.querySelectorAll('.subject_code');
                for (var i = 1; i <= count.length; i++)
                    count[i].id = 'subject_code' + i;
            }

            function edit_group_load(group_id) {
                $(".temprw").each(function (index) {
                    $(this).parents(".clonedInput").remove();
                });
                
                cloneid = 0;

                $('#subject_code').val('');
                $('#subject_code').attr('name', 'subject_code[]');
                $('#subject_name').val('');
                $('#subject_name').attr('name', 'subject_name[]');
                $('#subrowid').val('');
                $('#subrowid').attr('name', 'subrowid[]');
                
                $('#pre_subject').val('');
                $('#pre_subject').attr('name', 'pre_subject[]');
                
                $('#pre_subj_credit').val('');
                $('#pre_subj_credit').attr('name', 'pre_subj_credit[]');
                //$('#subversion').val('');
                //$('#subversion').attr('name', 'subversion[]');

                $.post("<?php echo base_url('subject/edit_group_load') ?>", {"group_id": group_id},
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
                        $('#pre_subj_group').val(data['group']['group_name']);
                        

                        for (i = 0; i < data['subjects'].length; i++)
                        {
                            if (i == 0) {
                                $('#subject_code').val(data['subjects'][i]['id']+'-'+data['subjects'][i]['version_id']);
                                //$('#subject_code').attr('name', 'subject_code_' + data['subjects'][i]['id']);

                                $('#subject_code').attr('name', 'subject_code[]');
                                $('#subject_name').attr('name', 'subject_name[]');
                                $('#subrowid').attr('name', 'subrowid[]');
                                $('#pre_subject').attr('name', 'pre_subject[]');
                                $('#pre_subj_credit').attr('name', 'pre_subj_credit[]');
                                
                                $('#subject_name').val(data['subjects'][i]['id']);
                                $('#subject_credit').val(data['subjects'][i]['credits']);
                                $('#subrowid').val(data['subjects'][i]['subj_row_id']);
                                
                                $('#pre_subject').val(data['subjects'][i]['id']+'-'+data['subjects'][i]['version_id']);
                                $('#pre_subj_credit').val(data['subjects'][i]['credits']);
                                //$('#subversion').val(data['subjects'][i]['version_id']);
                                
                                //$('#subject_name').attr('name', 'subject_name[' + data['subjects'][i]['id'] + ']');
                            } else {
                                cloning(data['subjects'][i]['id']+'-'+data['subjects'][i]['version_id'], data['subjects'][i]['credits'], data['subjects'][i]['subj_row_id']);
                            }

                        }
                    }
                },
                "json"
                );
            }
            function change_status(group_id, new_status, group_name)
            {
                $.post("<?php echo base_url('subject/change_subject_group_status') ?>", {"group_id": group_id, "new_status": new_status, "group_name": group_name},
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
                    var number = id.substring(12);                   
                    
//                    for (i = 0; i < cloneid; i++) {
                      for (i = 0; i <= cloneid; i++) {
                          
                        if (i === 0) {
                            var val = document.getElementById("subject_code").value;
                            
                        } else {
                            var val = document.getElementById("subject_code" + i).value;
                            
                        }
                        
                        if (val === value) {
                            if (number != i) {
                               
                                if(flag == 'edit')
                                {
                                    document.getElementById('subject_credit' + number).value = $('#pre_subj_credit' + number).val();
                                    //document.getElementById('subject_name' + number).value = '';
                                    document.getElementById('subject_code' + number).value = $('#pre_subject' + number).val();
                                    
                                    funcres = {status:"denied", message:"Don't select the same subject twice"};
                                    result_notification(funcres);
                                    break;
                                }
                                else{
                                    document.getElementById('subject_credit' + number).value = '';
                                    //document.getElementById('subject_name' + number).value = '';
                                    document.getElementById('subject_code' + number).value = '';
                                    
                                    funcres = {status:"denied", message:"Don't select the same subject twice"};
                                    result_notification(funcres);
                                    break; 
                                }
                                
                            }
                        }
                    }
                } else {
                    for (i = 0; i < cloneid; i++) {
                        if (i !== 0) {
                            var val = document.getElementById("subject_code" + i).value;
                            
                        }
                        if (val === value) {
                            document.getElementById('subject_credit').value = '';
                            //document.getElementById('subject_name').value = '';
                            document.getElementById('subject_code').value = '';
                            
                            funcres = {status:"denied", message:"Don't select the same subject twice"};
                            result_notification(funcres);
                            break;
                        }
                    }
                }
            }
            

            function save_subject_group() {
                
                var subj_group = $('#group_name').val();
                
                var val1 = "";
                var matches = 0;
                
                for (i = 0; i <= cloneid; i++) {
                    
                    var extra = $('#subject_code'+i+'').val();
                    
                    if (i === 0) {
                        val1 = document.getElementById("subject_code").value;

                    } else {
                        if(extra != null){
                           val1 = document.getElementById("subject_code"+i).value;
                        }
                        else{
                            val1 = "";
                        }
                    }
                    
                    if(val1 != ""){
                        matches++;
                    }

                }
                
                
                if(subj_group == ""){

                    funcres = {status: "denied", message: "Subject Group Name Cannot be Empty"};
                    result_notification(funcres);
                }
                else if(matches == 0){
                        
                        funcres = {status: "denied", message: "At least one subject should be selected!"};
                        result_notification(funcres);
                }
                else{
               
                    $.ajax(
                            {
                                url: "<?php echo base_url('subject/save_subject_group') ?>",
                                type: 'POST',
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: $('#subject_group_form').serialize(),
                                success: function (data)
                                {
                                    if (data == 'denied')
                                    {
                                        funcres = {status: "denied", message: "You have no right to proceed the action"};
                                        result_notification(funcres);
                                    } else
                                    {
                                        //result_notification(data);
                                        //if (data['status'] == 'success') {
                                            location.reload();
                                        //}
                                    }
                                }
                            });
                    }
            }
            
            function reset_view(){
                $(".temprw").each(function (index) {
                    $(this).parents(".clonedInput").remove();
                });
                
                flag = '';
                cloneid = 0;
                matches = 0;
                
                $('#group_id').val("");
                $('#subrowid').val("");
                $('#pre_subject').val("");
                $('#pre_subj_credit').val("");
                $('#pre_subj_group').val("");
            }
            
            
            function validateSubjectGroup(){
            
                var subject_group = $('#group_name').val().trim();

                if(subject_group != $('#pre_subj_group').val()){

                    $.post("<?php echo base_url('subject/check_duplicate_subject_group') ?>", {'subject_group': subject_group},
                    function (data)
                    {
                        if(data != null){
                            funcres = {status: "denied", message: "Group Name Already Exists."};
                            result_notification(funcres);
                        }
                        else{
                            save_subject_group();
                        }
                    },
                    "json"
                    );
                }
                else{
                    save_subject_group();
                }
            }
            
            
            
        </script>